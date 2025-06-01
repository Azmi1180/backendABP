<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $tech = Category::where('slug', 'technology')->first();
        $business = Category::where('slug', 'business')->first();
        $world = Category::where('slug', 'world-news')->first();

        Article::create([
            'category_id' => $tech->id,
            'title' => 'The Future of AI in Software Development',
            'content' => 'Artificial Intelligence is rapidly changing the landscape of software development. From automated testing to code generation, AI tools are becoming indispensable for developers. This article explores the current trends and future possibilities.',
            'source' => 'Tech Chronicle',
            'published_at' => Carbon::now()->subDays(1)
        ]);

        Article::create([
            'category_id' => $tech->id,
            'title' => 'New Quantum Computing Breakthrough Announced',
            'content' => 'Researchers have announced a significant breakthrough in quantum computing, potentially paving the way for solving problems currently intractable for classical computers. The implications for cryptography and materials science are immense.',
            'source' => 'Quantum Leaps Today',
            'published_at' => Carbon::now()->subHours(5)
        ]);

        Article::create([
            'category_id' => $business->id,
            'title' => 'Global Markets React to Interest Rate Hikes',
            'content' => 'Stock markets around the world have shown mixed reactions to the latest round of interest rate hikes by central banks. Investors are cautiously optimistic, but volatility remains high.',
            'source' => 'Financial Times Global',
            'published_at' => Carbon::now()->subDays(2)
        ]);

        Article::create([
            'category_id' => $world->id,
            'title' => 'International Summit Focuses on Climate Change',
            'content' => 'Leaders from across the globe gathered today to discuss urgent actions needed to combat climate change. Key topics included renewable energy transition and carbon emission targets.',
            'source' => 'World News Agency',
            'published_at' => Carbon::now()
        ]);

         Article::create([
            'category_id' => $tech->id,
            'title' => 'Understanding Large Language Models',
            'content' => 'Large Language Models (LLMs) like GPT and Gemini are transforming how we interact with information. This piece dives into their architecture, training, and ethical considerations. They can generate text, translate languages, write different kinds of creative content, and answer your questions in an informative way.',
            'source' => 'AI Insights',
            'published_at' => Carbon::now()->subHours(2)
        ]);
    }
}