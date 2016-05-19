@extends('front.base')

@section('content')
    <section class="post-container">
        <div class="top-divider"></div>
        <h1 class="second-heading post-title">{{ $post->title }}</h1>
        <p class="post-published-date">{{ $post->published_at->toFormattedDateString() }}</p>
        <div class="post-content body-text">
            {!! $post->body !!}
        </div>
        <div class="sharing-links">
            <div class="social-icon-box">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}">
                    <img src="/images/assets/facebook_icon.png" alt="facebook link icon">
                </a>
            </div>
            <div class="social-icon-box">
                <a href="mailto:?&subject=Read&body={{ Request::url() }}">
                    <img src="/images/assets/email_icon.svg" alt="email link icon">
                </a>
            </div>
            <div class="social-icon-box">
                <a href="https://twitter.com/home?status={{ urlencode($post->title . ' ' . Request::url()) }}">
                    <img src="/images/assets/twitter_icon.png" alt="twitter link icon">
                </a>
            </div>
        </div>
        <a href="/blog">
            <div class="gf-button center-btn medium-btn">Back to Blog</div>
        </a>
    </section>
@endsection