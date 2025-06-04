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
            'title' => 'The Evolving Landscape of AI in Modern Software Development',
            'content' => "Artificial Intelligence (AI) is no longer a futuristic concept but a tangible force reshaping the software development lifecycle. Its integration promises to automate mundane tasks, enhance code quality, and accelerate development timelines. From intelligent code completion tools that predict developer intent to sophisticated AI-driven testing frameworks that identify bugs with greater accuracy, the impact is profound and multifaceted. Developers are increasingly leveraging these tools to focus on more complex problem-solving and innovation, rather than getting bogged down in repetitive coding or debugging.

The current wave of AI tools in development includes advanced code generation platforms capable of creating entire modules from natural language specifications. Imagine describing a feature, and an AI drafts the initial boilerplate code, complete with unit tests. Furthermore, AI-powered project management tools are emerging, offering predictive analytics for project timelines, resource allocation, and risk assessment. These systems learn from past project data to provide insights that can help teams avoid common pitfalls and optimize their workflows for efficiency.

However, the adoption of AI in software development is not without its challenges. Concerns around job displacement, the ethical implications of AI-generated code, and the potential for AI systems to perpetuate biases present in their training data are valid and require careful consideration. The future will likely involve a symbiotic relationship where AI augments human developers, rather than replacing them entirely, leading to a new era of collaborative creation and more robust, intelligent software solutions. Continuous learning and adaptation will be key for developers to thrive in this AI-enhanced environment.",
            'source' => 'Tech Chronicle Advanced',
            'published_at' => Carbon::now()->subDays(3)->addHours(2)
        ]);

        Article::create([
            'category_id' => $tech->id,
            'title' => 'Quantum Computing: A Paradigm Shift on the Horizon',
            'content' => "Recent announcements from leading research institutions signal a significant leap forward in the realm of quantum computing. While still in its nascent stages for widespread commercial application, these breakthroughs are inching us closer to harnessing the mind-bending principles of quantum mechanics to solve problems currently deemed impossible for even the most powerful classical supercomputers. The core advantage lies in qubits, which, unlike classical bits, can exist in multiple states simultaneously (superposition) and can be entangled, allowing quantum computers to perform a vast number of calculations in parallel.

The implications of mature quantum computing are staggering across numerous fields. In cryptography, current encryption standards could become obsolete, necessitating the development of quantum-resistant algorithms. Materials science and drug discovery could be revolutionized, as quantum computers could accurately simulate molecular interactions, leading to the design of novel materials and highly effective pharmaceuticals. Financial modeling could achieve unprecedented accuracy in risk assessment and portfolio optimization, and complex logistical problems could be solved far more efficiently.

Despite the excitement, significant hurdles remain. Building and maintaining stable, scalable quantum computers is an immense engineering challenge, requiring extremely low temperatures and isolation from environmental noise to preserve qubit coherence. Furthermore, developing new algorithms tailored for quantum architectures is a specialized field that needs to grow. The journey to practical, fault-tolerant quantum computing is likely a marathon, not a sprint, but each breakthrough brings us closer to a future where computational power is redefined.",
            'source' => 'Quantum Dynamics Review',
            'published_at' => Carbon::now()->subDays(1)->subHours(8)
        ]);

        Article::create([
            'category_id' => $business->id,
            'title' => 'Navigating Volatility: Global Markets Brace for Economic Shifts',
            'content' => "Global financial markets are currently navigating a period of heightened uncertainty, primarily driven by central banks' aggressive monetary tightening policies aimed at curbing persistent inflation. The latest round of interest rate hikes has elicited a mixed bag of reactions from investors worldwide, with some sectors showing resilience while others exhibit significant vulnerability. This complex environment underscores the delicate balance central banks are attempting to strike: taming inflation without triggering a deep recession.

Investor sentiment remains cautious, with market participants closely scrutinizing economic indicators such as employment data, manufacturing output, and consumer spending. Technology and growth stocks, which benefited from an era of low interest rates, have faced considerable headwinds as borrowing costs rise. Conversely, value stocks and sectors like energy and commodities have, at times, shown relative strength. The increased cost of capital is also impacting corporate investment decisions and merger and acquisition activity, leading to a more conservative approach to expansion.

Looking ahead, market strategists predict continued volatility as economies adjust to the new interest rate paradigm. The long-term effects on global trade, supply chains, and geopolitical stability are also key factors influencing market dynamics. Diversification, careful risk management, and a focus on fundamentally sound companies are being emphasized as prudent strategies for investors seeking to weather the current storm and position themselves for eventual recovery and growth opportunities.",
            'source' => 'Global Financial Monitor',
            'published_at' => Carbon::now()->subDays(5)->addHours(4)
        ]);

        Article::create([
            'category_id' => $world->id,
            'title' => 'International Climate Summit: A Unified Front Against a Global Crisis?',
            'content' => "World leaders, scientists, and activists have converged for a crucial international summit focused squarely on the escalating climate change crisis. The urgency of the situation is palpable, with recent extreme weather events serving as stark reminders of the planet's vulnerability. The primary agenda revolves around strengthening commitments to reduce greenhouse gas emissions, accelerating the transition to renewable energy sources, and mobilizing financial support for developing nations disproportionately affected by climate impacts.

Discussions are expected to be intense, particularly around the phasing out of fossil fuels and the establishment of more ambitious Nationally Determined Contributions (NDCs) under the Paris Agreement. Key sticking points often include the allocation of responsibility between developed and developing countries, the mechanisms for technology transfer, and the adequacy of climate finance pledges. Activist groups are present in force, advocating for more radical and immediate action, challenging policymakers to move beyond rhetoric to concrete, legally binding commitments.

The outcomes of this summit will be closely watched, as they could significantly shape global climate policy for the next decade. While consensus on all fronts is unlikely, progress in specific areas, such as international carbon markets, adaptation strategies, and nature-based solutions, could provide much-needed momentum. The overarching question remains whether the collective political will can overcome national interests and economic constraints to forge a truly unified and effective response to what many consider the defining challenge of our time.",
            'source' => 'Global Diplomatic Wire',
            'published_at' => Carbon::now()->subHours(10)
        ]);

         Article::create([
            'category_id' => $tech->id,
            'title' => 'Demystifying Large Language Models: Power, Potential, and Pitfalls',
            'content' => "Large Language Models (LLMs), exemplified by systems like OpenAI's GPT series and Google's Gemini, have rapidly transitioned from research curiosities to transformative tools impacting various aspects of our digital lives. These sophisticated AI systems are trained on vast troves of text and code, enabling them to understand, generate, and manipulate human language with remarkable fluency. Their capabilities extend from drafting emails and writing articles to generating computer code, translating languages, and engaging in complex, nuanced conversations.

At their core, LLMs utilize deep learning architectures, particularly transformers, which allow them to process and understand the context of words in long sequences of text. This contextual understanding is key to their ability to produce coherent and relevant outputs. The training process involves exposing the model to billions of sentences, allowing it to learn grammatical structures, factual information, and even stylistic nuances. The sheer scale of these models and the data they are trained on is what gives them their impressive power and versatility.

However, the rise of LLMs also brings forth significant ethical considerations and practical challenges. Issues such as inherent biases learned from training data, the potential for misuse in generating misinformation or malicious content, and concerns about intellectual property and originality are at the forefront of public discussion. Furthermore, the computational resources required to train and run these models are immense, raising questions about environmental impact and accessibility. Responsible development and deployment, coupled with robust regulatory frameworks and ongoing research into safety and alignment, are crucial to harnessing the immense potential of LLMs while mitigating their risks.",
            'source' => 'AI & Society Journal',
            'published_at' => Carbon::now()->subMinutes(90)
        ]);

        Article::create([
            'category_id' => $business->id,
            'title' => 'The Gig Economy: Flexibility, Challenges, and the Future of Work',
            'content' => "The gig economy, characterized by short-term contracts and freelance work as opposed to permanent jobs, has fundamentally altered the employment landscape across numerous sectors. Driven by digital platforms that connect service providers with customers, it offers unprecedented flexibility for workers to choose their hours and projects. This model has proven particularly attractive for individuals seeking supplemental income, work-life balance, or autonomy over their careers. Industries from transportation and delivery to creative services and consulting have been reshaped by this trend.

Despite its benefits, the gig economy is not without its critics and challenges. A primary concern revolves around worker protections and benefits. Gig workers are often classified as independent contractors, meaning they typically lack access to employer-sponsored health insurance, retirement plans, paid time off, and other traditional employment benefits. This can lead to financial insecurity and a precarious work life for many. Debates are ongoing globally regarding the appropriate classification of gig workers and whether existing labor laws need to be updated to reflect this new mode of working.

The future of the gig economy will likely involve a push for a more balanced approach that preserves flexibility while addressing the legitimate concerns about worker welfare. Some platforms are experimenting with portable benefits systems, while policymakers are exploring new legal frameworks. As technology continues to evolve, and as more individuals seek non-traditional work arrangements, the gig economy is poised to remain a significant and evolving component of the global workforce, prompting ongoing dialogue about the nature of work itself in the 21st century.",
            'source' => 'Modern Workforce Today',
            'published_at' => Carbon::now()->subDays(4)->subHours(3)
        ]);
    }
}