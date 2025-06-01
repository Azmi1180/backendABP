<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\RequestException;

class GeminiService
{
    protected string $apiKey;
    protected string $baseUrl = 'https://generativelanguage.googleapis.com/v1beta';    
    protected string $defaultModel = 'gemini-2.0-flash';


    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
        if (empty($this->apiKey)) {
            Log::critical('GEMINI_API_KEY is not configured in .env file. GeminiService will not function.');
        }
    }

    private function makeApiCall(string $model, array $requestBody, int $timeout = 60): ?array
    {
        if (empty($this->apiKey)) {
            Log::error("Gemini API call aborted: API key is missing.");
            return null;
        }

        $endpoint = "{$this->baseUrl}/models/{$model}:generateContent?key={$this->apiKey}";
        Log::info("Sending request to Gemini. Endpoint: {$endpoint}");
        // Log::debug("Request Body: ", $requestBody); // Uncomment for deep debugging of request body

        try {
            $response = Http::timeout($timeout)
                            ->asJson()
                            ->post($endpoint, $requestBody);

            if ($response->successful()) {
                Log::info("Successfully received response from Gemini for model {$model}.");
                return $response->json();
            } else {
                Log::error("Gemini API Error: Request failed for model {$model}.", [
                    'status_code' => $response->status(),
                    'endpoint' => $endpoint,
                    'response_body' => $response->body(),
                ]);
                return null;
            }
        } catch (RequestException $e) {
            Log::error("Gemini API HTTP Request Exception for model {$model}: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return null;
        } catch (\Exception $e) {
            Log::error("Gemini API General Exception for model {$model}: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return null;
        }
    }

    private function extractTextFromResponse(?array $responseData): ?string
    {
        if (!$responseData) {
            return null;
        }

        if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
            return $responseData['candidates'][0]['content']['parts'][0]['text'];
        } else {
            Log::error('Gemini API Error: Unexpected response structure, could not extract text.', [
                'response_body' => $responseData
            ]);
            return null;
        }
    }


    public function summarizeText(string $text, int $maxLength = 150, string $model = null): string
    {
        if (empty(trim($text))) {
            return "Cannot summarize empty text.";
        }

        $modelToUse = $model ?? $this->defaultModel;
        $prompt = "Summarize the following news article text very concisely, aiming for approximately {$maxLength} words. Focus only on the absolute main points and key information:\n\n---\n{$text}\n---";

        $requestBody = [
            'contents' => [['parts' => [['text' => $prompt]]]],
            'generationConfig' => ['maxOutputTokens' => $maxLength + 100],
        ];

        $responseData = $this->makeApiCall($modelToUse, $requestBody);
        $summary = $this->extractTextFromResponse($responseData);

        if ($summary !== null) {
            return $summary;
        } else {            
            return "Error summarizing article: Failed to get a valid response from AI service. Check logs for details.";
        }
    }

    public function generateDailyDigest(array $articles, int $maxDigestLength = 300, string $model = null): string
    {
        if (empty($articles)) {
            return "No articles provided for the daily digest.";
        }

        $modelToUse = $model ?? $this->defaultModel;
        $combinedTextForPrompt = "Create a concise daily news digest summarizing the following top stories. Keep the total digest length around {$maxDigestLength} words. For each story, briefly state its main point.\n\n";
        $articleCount = 0;
        foreach ($articles as $article) {
            if ($articleCount >= 7) break;
            $snippet = strip_tags($article->content);
            $snippet = preg_replace('/\s+/', ' ', $snippet);
            $snippet = substr($snippet, 0, 200) . (strlen($snippet) > 200 ? '...' : '');
            $combinedTextForPrompt .= "ARTICLE TITLE: " . $article->title . "\nARTICLE CONTENT SNIPPET: " . $snippet . "\n---\n\n";
            $articleCount++;
        }

        if (strlen(trim($combinedTextForPrompt)) <= 150) {
            return "Not enough substantial article content to generate a digest.";
        }

        $requestBody = [
            'contents' => [['parts' => [['text' => $combinedTextForPrompt]]]],
            'generationConfig' => ['maxOutputTokens' => $maxDigestLength + 150],
        ];

        $responseData = $this->makeApiCall($modelToUse, $requestBody, 90);
        $digest = $this->extractTextFromResponse($responseData);

        if ($digest !== null) {
            return $digest;
        } else {
            return "Error generating digest: Failed to get a valid response from AI service. Check logs for details.";
        }
    }
}