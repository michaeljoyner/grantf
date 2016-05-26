@extends('front.base')

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => '/images/assets/logo_lg.png',
        'ogTitle' => 'Grant Fowlds - Speaker',
        'ogDescription' => 'I relate my abundant first hand experience of growing up in a natural environment with the consequences of 21st century greed for animals in the exploding demand in all forms of animal trafficking.'
    ])
@endsection

@section('content')
    <div class="projects-page-container speaking-page">
        <div class="top-divider"></div>
        <h1 class="main-heading">Speaking</h1>
        <img class="hero-image" src="/images/assets/speaking/speaking.jpg" alt="hero image of chameleon">
        <p class="intro-text">Global warming, poaching, human pressure are just some factors that are changing our world. Grant relates his first hand experience of growing up in a natural environment with the consequences of 21st century greed for animals in the exploding demand in all forms of animal trafficking. His presentation is centred on the vast increase in rhino poaching in the last decade, where animals are in serious threat of extinction. The presentation climaxes on his personal walk in a rhino project and a race against the theory – ‘endangered means we still have time but extinction is forever’.</p>
        <div class="text-divider"></div>
        <p class="intro-text">Grant has given presentations in locations far and wide, both in South Africa and abroad, including:</p>
        <div class="two-column">
            <ul>
                <li>University of Hanoi, Vietnam</li>
                <li>Biodiversity Agency, Hanoi, Vietnam</li>
                <li>Universidad Belgrano, Buenos Aires</li>
                <li>Top Service, Brazil</li>
                <li>Kangaroo, Brazil</li>
                <li>SAACI- South African Conference Industry</li>
                <li>Kashmir World Foundation, Washington DC</li>
                <li>University of Richmond, USA</li>
            </ul>
            <ul class="second-half">
                <li>Harvard University, Boston Mashachutes</li>
                <li>Madiba’s Brooklyn, New York</li>
                <li>WTM Africa 2015</li>
                <li>WTM Africa Thebe Reed Exhibition 2016</li>
                <li>Universidad San Sebastian de Chile</li>
                <li>Press Conference at Beatrice Hotel Kinshasa, DRC</li>
                <li>Bill Buchanan Home, Durban</li>
                <li>University of DUT, Durban</li>
            </ul>
        </div>
        <a href="/contact">
            <div class="gf-button center-btn medium-btn">Contact Grant Now</div>
        </a>
        <section class="projects-container">
            @foreach($projects as $project)
                <div class="project-card">
                    <p class="project-title second-heading">{{ $project->title }}</p>
                    <img src="{{ $project->getImageSrc('web') }}" alt="project image">
                    <div class="project-writeup body-text">{!! $project->content !!}</div>
                    <a class="bold-anchor" href="{{ $project->link }}" class="project-link">{{ $project->link }}</a>
                </div>
            @endforeach
        </section>
    </div>
@endsection
