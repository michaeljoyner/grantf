@extends('front.base')

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => '/images/assets/logo_lg.png',
        'ogTitle' => $ogTitle,
        'ogDescription' => $ogDescription
    ])
@endsection

@section('content')
    <div class="projects-page-container">
        <div class="top-divider"></div>
        <h1 class="main-heading">{{ $title }}</h1>
        <img class="hero-image" src="{{ $hero_image }}" alt="hero image of chameleon">
        <p class="intro-text">{{ $intro }}</p>
        <a href="/contact">
            <div class="gf-button center-btn medium-btn">Contact Grant Now</div>
        </a>
        <section class="projects-container">
            @foreach($projects as $project)
                <div class="project-card-wrapper">
                    <div class="project-card">
                        <p class="project-title second-heading">{{ $project->title }}</p>
                        <img src="{{ $project->getImageSrc('web') }}" alt="project image">
                        <div class="project-writeup body-text">{!! $project->content !!}</div>
                        <a class="bold-anchor" href="{{ $project->link }}" class="project-link">{{ $project->link }}</a>
                    </div>
                </div>
            @endforeach
        </section>
    </div>
@endsection