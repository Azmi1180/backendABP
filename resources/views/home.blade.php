@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Search Filters -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <form method="GET" action="{{ route('home') }}">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-end">
                <div class="lg:col-span-4">
                    <label for="keyword" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <div class="relative">
                        <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
                        <input
                            type="text"
                            id="keyword"
                            name="keyword"
                            placeholder="Search by keyword..."
                            value="{{ request('keyword') }}"
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 placeholder-gray-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        />
                    </div>
                </div>

                <div class="lg:col-span-3">
                    <label for="source" class="block text-sm font-medium text-gray-700 mb-2">Source</label>
                    <div class="relative">
                        <i data-lucide="globe" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
                        <select name="source" id="source" class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none bg-white">
                            <option value="">All Sources</option>
                            @foreach($sources as $sourceValue)
                                <option value="{{ $sourceValue }}" {{ request('source') == $sourceValue ? 'selected' : '' }}>
                                    {{ $sourceValue }}
                                </option>
                            @endforeach
                        </select>
                        <i data-lucide="chevron-down" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none w-4 h-4"></i>
                    </div>
                </div>

                <div class="lg:col-span-3">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <div class="relative">
                        <i data-lucide="tag" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
                        <select name="category" id="category" class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none bg-white">
                            <option value="">All Categories</option>
                            @foreach($categories as $categoryItem)
                                <option value="{{ $categoryItem->slug }}" {{ request('category') == $categoryItem->slug ? 'selected' : '' }}>
                                    {{ $categoryItem->name }}
                                </option>
                            @endforeach
                        </select>
                        <i data-lucide="chevron-down" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none w-4 h-4"></i>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Filter</button>
                </div>
                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}" class="w-full block text-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-200">
                        Clear
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- AI Daily Digest -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex items-center gap-2 mb-2">
            <i data-lucide="bot" class="text-blue-500 w-5 h-5"></i>
            <h2 class="text-xl font-bold text-gray-900">AI Daily Digest</h2>
        </div>
        @if(session('daily_digest'))
            <div class="bg-blue-50 p-4 rounded-md mb-4">
                <h3 class="font-semibold text-blue-700 mb-2">Today's Digest:</h3>
                <p class="text-gray-700 whitespace-pre-wrap">{{ session('daily_digest')['daily_digest'] }}</p>
                <p class="text-xs text-gray-500 mt-2">{{ session('daily_digest')['ai_disclaimer'] }}</p>
            </div>
        @endif
        @if(session('digest_error'))
            <p class="text-red-500 mb-4">{{ session('digest_error') }}</p>
        @endif
        <form method="POST" action="{{ route('digest.generate') }}">
            @csrf
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 flex items-center gap-2">
                <i data-lucide="bot" class="w-4 h-4"></i>
                Generate Today's Digest
            </button>
        </form>
    </div>

    <!-- Articles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse($articles as $article)
            <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-all duration-200">
                {{-- Placeholder for image --}}
                <a href="#" onclick="openModal('articleModal-{{ $article->id }}'); return false;">
                    <div class="bg-gray-200 flex items-center justify-center h-48 text-gray-400 text-lg font-medium">
                        {{-- You would ideally have an image URL for the article --}}
                        Article Image
                    </div>
                </a>
                <div class="p-4">
                    <h3 class="font-bold text-lg text-gray-900 mb-2 line-clamp-2">
                        <a href="#" onclick="openModal('articleModal-{{ $article->id }}'); return false;" class="hover:underline">
                            {{ $article->title }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-500 mb-2">
                        {{ $article->source }} • {{ $article->published_at->diffForHumans() }}
                    </p>
                    <span class="inline-block text-xs px-2 py-1 rounded-full mb-3 bg-gray-200">
                        {{ $article->category->name ?? 'Uncategorized' }}
                    </span>
                    <p class="text-sm text-gray-600 line-clamp-2">
                        {{ Str::limit(strip_tags($article->content), 120) }}
                    </p>
                    @auth
                    <div class="mt-3">
                        @if(Auth::user()->savedArticles->contains($article->id))
                            <form method="POST" action="{{ route('articles.unsave', $article) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 text-sm text-red-600 hover:text-red-800 rounded border border-red-300 hover:bg-red-50">
                                    <i data-lucide="bookmark-minus" class="inline w-4 h-4"></i> Unsave
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('articles.save', $article) }}" class="inline">
                                @csrf
                                <button type="submit" class="px-3 py-1 text-sm text-blue-600 hover:text-blue-800 rounded border border-blue-300 hover:bg-blue-50">
                                    <i data-lucide="bookmark-plus" class="inline w-4 h-4"></i> Save
                                </button>
                            </form>
                        @endif
                         <a href="{{ route('articles.summarize.view', $article) }}" class="ml-2 px-3 py-1 text-sm text-purple-600 hover:text-purple-800 rounded border border-purple-300 hover:bg-purple-50">
                             <i data-lucide="bot" class="inline w-4 h-4"></i> Summarize
                         </a>
                    </div>
                    @endauth
                </div>
            </div>

            <!-- Modal for each article -->
            <div id="articleModal-{{ $article->id }}" class="modal-overlay">
                <div class="modal-content">
                    <div class="flex justify-between items-start mb-4">
                        <h2 class="text-2xl font-bold text-gray-900 pr-4">{{ $article->title }}</h2>
                        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 text-2xl flex-shrink-0">
                            <i data-lucide="x" class="w-6 h-6"></i>
                        </button>
                    </div>
                    <p class="text-sm text-gray-500 mb-4">
                        Source: {{ $article->source }} | Category: {{ $article->category->name ?? 'N/A' }}
                    </p>
                    <div class="prose max-w-none mb-4">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                    <div class="flex flex-wrap justify-end gap-3 pt-4 border-t">
                        <a href="{{ route('articles.summarize.view', $article) }}" class="flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-gray-800">
                            <i data-lucide="bot" class="w-4 h-4"></i> AI Summary
                        </a>
                        {{-- <a href="#" class="flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-gray-800">
                            <i data-lucide="link" class="w-4 h-4"></i> Read Original (if you have original_url)
                        </a> --}}
                        <button onclick="closeModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500 py-10">No articles found.</p>
        @endforelse
    </div>

    @if($articles->hasPages())
    <div class="mt-8">
        {{ $articles->links() }} {{-- Tailwind pagination views should be set up --}}
    </div>
    @endif

@endsection