@extends('front.base')

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => '/images/assets/logo_lg.png',
        'ogTitle' => 'The Blog of Grant Fowlds',
        'ogDescription' => 'Read through some of my latest adventures, experiences or opinions on my life as a wildlife conservationist, speaker and consultant'
    ])
@endsection

@section('content')
    <section class="blog-index-header">
        <div class="top-divider"></div>
        <h1 class="main-heading">The Grant Fowlds Blog</h1>
        <p class="intro-text">THIS IS AN INTRODUCTION TO THE WILDLIFE PROJECTS YOU ARE WORKING WITH. THIS IS AN INTRODUCTION TO THE WILDLIFE PROJECTS AND AFFILIATES YOU ARE WORKING WITH.</p>
    </section>
    <section class="blog-listing">
        @foreach($posts as $post)
            <div class="post-index-card">
                <h3 class="post-title">{{ $post->title }}</h3>
                <p class="post-published-date">{{ $post->published_at->toFormattedDateString() }}</p>
                <p class="post-description">{{ $post->description }}</p>
                <a href="/blog/{{ $post->slug }}">
                    <div class="gf-button center-btn medium-btn">Read Article</div>
                </a>
            </div>
        @endforeach
        {!! $posts->render() !!}
    </section>
@endsection