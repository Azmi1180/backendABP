@extends('layouts.app')

@section('title', 'Saved Articles')

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex items-center gap-2">
            <i data-lucide="bookmark" class="text-blue-500 w-6 h-6"></i>
            <h1 class="text-2xl font-bold text-gray-900">Saved Articles</h1>
        </div>
    </div>

    @if(session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if($savedArticles->isEmpty())
        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
            <i data-lucide="bookmark-x" class="w-16 h-16 text-gray-400 mx-auto mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No saved articles yet</h3>
            <p class="text-gray-600 mb-6">
                Start saving articles you want to read later from the home page.
            </p>
            <a href="{{ route('home') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 flex items-center gap-2 mx-auto">
                <i data-lucide="home" class="w-4 h-4"></i>
                Browse Articles
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($savedArticles as $article)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-all duration-200">
                    {{-- ... (Article card structure similar to home.blade.php) ... --}}
                    {{-- Key difference: Unsave button --}}
                    <div class="p-4">
                         <h3 class="font-bold text-lg text-gray-900 mb-2 line-clamp-2">
                            <a href="#" onclick="openModal('savedArticleModal-{{ $article->id }}'); return false;" class="hover:underline">
                                {{ $article->title }}
                            </a>
                        </h3>
                        <p class="text-sm text-gray-500 mb-2">
                            Source: {{ $article->source }} | Category: {{ $article->category->name ?? 'N/A' }}
                        </p>
                        <p class="text-sm text-gray-700 line-clamp-3 mb-4">
                            {!! nl2br(e($article->content)) !!}
                        </p>
                        <a href="#" onclick="openModal('savedArticleModal-{{ $article->id }}'); return false;" class="text-blue-500 hover:underline text-sm">
                            <i data-lucide="eye" class="w-4 h-4"></i> View Details
                        </a>
                        <a href="{{ route('articles.summarize.view', $article) }}" class="text-blue-500 hover:underline text-sm ml-4">
                            <i data-lucide="bot" class="w-4 h-4"></i> AI Summary
                        </a>                        
                        <div class="mt-3">
                            <button onclick="openModal('savedArticleModal-{{ $article->id }}')" class="w-full px-3 py-2 text-sm text-gray-600 hover:text-white hover:bg-blue-500 rounded border border-blue-300">
                                <i data-lucide="eye" class="inline w-4 h-4"></i> View Details
                            </button>      
                        </div>
                        <form method="POST" action="{{ route('articles.unsave', $article) }}" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-3 py-2 text-sm text-red-600 hover:text-white hover:bg-red-500 rounded border border-red-300">
                                <i data-lucide="trash-2" class="inline w-4 h-4"></i> Unsave Article
                            </button>
                        </form>
                    </div>
                </div>
                 <!-- Modal for each saved article -->
                <!-- <div id="savedArticleModal-{{ $article->id }}" class="modal-overlay">
                    {{-- ... Modal content similar to home.blade.php ... --}}
                </div> -->
                <div id="savedArticleModal-{{ $article->id }}" class="modal-overlay">
                    <div class="modal-content">
                        <div class="flex justify-between items-start mb-4">
                            <h2 class="text-2xl font-bold text-gray-900 pr-4">{{ $article->title }}</h2>
                            <button onclick="closeModal('savedArticleModal-{{ $article->id }}')" class="text-gray-400 hover:text-gray-600 text-2xl flex-shrink-0">
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
                            <button onclick="closeModal('savedArticleModal-{{ $article->id }}')" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>        
    @endif
@endsection