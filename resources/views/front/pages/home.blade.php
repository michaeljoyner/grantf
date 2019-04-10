@extends('front.base')

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => '/images/assets/logo_lg.png',
        'ogTitle' => 'Grant Fowlds | Conservationist, Speaker and Consultant',
        'ogDescription' => 'Hi, I am Grant Fowlds, conservationist, speaker and consultant. I have a great passion for wildlife conservation and tourism, and extensive experience in spreading awareness and in wildlife restoration and conservation projects.'
    ])
@endsection

@section('content')
    <div class="top-divider"></div>
    <section id="hero" class="home-section">
        <div class="hero-container">
            @include('svgicons.herologo')
        </div>
    </section>
    <section id="about" class="home-section">
        <h1 class="main-heading">About</h1>
        <div class="about-flex">
            <div>
                <p class="about-text">From a very young age, I lived and played in the African bush, enjoying the natural wonders provided by nature. My passion for nature in later life has forged a career in preserving wildlife, teaching our youth in the abundant wealth of nature and conserving a vanishing way of Life. Our natural wonders are disappearing through global warming and insatiable demand for wildlife products which I intend to halt through awareness.</p>
            </div>
            <div class="about-image-box pic1">
                <img class="about-img-one" src="/images/assets/home/about_1.jpg" alt="grant fowlds profile image">
            </div>
            <div class="about-image-box pic2">
                <img class="about-img-two" src="/images/assets/home/about_2.jpg" alt="grant fowlds profile image">
            </div>
            <div>
                <p class="about-text">For over a decade I have been involved in a private park restoration in Southern Africa and recently started consulting in West Africa. Our knowledge and passion has been conveyed to thousands of youth in schools through community conservation awareness. This work created a much needed fund raising drive for an NGO with the aid of the corporate social investment portfolios which spells out the slogan “Stop Wildlife Crime”.</p>
            </div>
        </div>
    </section>
    <section id="events" class="home-section">
        <h1 class="main-heading">Upcoming Events</h1>
        @if(! $events->count())
            <p class="intro-text">There are no upcoming events for now, but be sure to check back again soon.</p>
        @endif
        <div class="events-flex">
            @foreach($events as $event)
            <div>
                <div class="event-card">
                    <h4 class="event-title">{{ $event->title }}</h4>
                    <p class="event-date">{{ $event->event_date->toFormattedDateString() }}</p>
                    <p class="event-date">{{ $event->event_time }}</p>
                    <p class="event-date">{{ $event->event_location }}</p>
                    <div class="event-description">{!! $event->description !!}</div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <section id="trafficking" class="home-section">
        <h1 class="main-heading">Wildlife Trafficking</h1>
        <img src="/images/assets/home/trafficking.jpg" alt="wildlife trafficking section image">
        <p class="intro-text">Wildlife trafficking has become the fourth largest illegal trade in the world after drugs, weapons and humans. Never before, have our oceans, forests and wild places been plundered by human greed in exploitation of this natural commodity.</p>
        <p class="body-text">Our schools Rhino Education is a passive proactive programme used to create awareness through demand reduction. Project Rhino KZN have been supported in Vietnam by the Freeland Foundation and the US Embassy in Hanoi in a successful student exchange programme.  Since my work has involved South East Asia, I  have uncovered and learnt about the dark underworld of our endangered species being traded and utilized in all illicit forms.</p>
        <p class="body-text">Trafficking involves, many formats like, traditional medicines, the exotic pet trade, jewellery , ornaments and trade routes via harbours and airports and the contraband is always pushing the law to new and unsuspected heights. My journey explains the facts to the public, corporate companies, and non-profit organizations to solicit much needed fundraising to prevent such action.</p>
        <p class="body-text">The USA Trade in Wildlife has prioritized to fight trafficking and global Corporates like Google, Ebay and MSC Cruise Lines to name but a few are injecting millions into to campaigns.</p>
        <a href="/conservation">
            <div class="gf-button long-btn center-btn">See Conservation Projects</div>
        </a>
    </section>
    <section id="video" class="home-section">
        <h1 class="main-heading">South Africa: A Shorthand History</h1>
        <p class="intro-text">In this video I give the viewer an interesting shorthand history of South Africa. For anyone knowing nothing or little about South Africa, this video clip serves as an introductory teaser to some of the major events and people who shaped the country.</p>
        <div class="video-outer">
            <div class="video-container">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/jwTP-pmOzBU" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </section>
    <section id="affiliates" class="home-section">
        <h1 class="main-heading">Affiliates and Partners</h1>
        <p class="intro-text">These are a few of the amazing partners and affiliates that I work alongside with. I am very proud to say that all of them have a hand in the fight against Wildlife Trafficking. Please click the box to visit their websites.</p>
        <div class="affiliates-container">
            @foreach($affiliates as $affiliate)
                <div class="affiliate-card">
                    <img src="{{ $affiliate->getImageSrc('thumb') }}" alt="{{ $affiliate->name }} logo">
                    <p class="affiliate-name intro-text">{{ $affiliate->name }}</p>
                    <a href="{{ $affiliate->website }}" target="_blank"><p class="affiliate-description body-text">{{ $affiliate->description }}</p></a>
                </div>
            @endforeach
        </div>
    </section>
    <section id="donate" class="home-section">
        <h1 class="main-heading">Donate</h1>
        <div class="donate-container">
            <p class="intro-text">The Rhino Art Campaign remains the most comprehensive children’s rhino Conservation Education programme ever undertaken. Its clear objective is to gather Hearts and Minds Messages in a call to action against Rhino poaching and  other forms of Wildlife Crime.  Our motto known as LetOur Voices be heard.</p>
            <img src="/images/assets/home/rhinoart_logo.png" alt="call to donate image">
            <a href="https://www.givengain.com/cause/3213/campaigns/11081/" target="_blank">
                <div class="donate-button">Donate Now</div>
            </a>
        </div>
    </section>
@endsection

@section('bodyscripts')

@endsection
