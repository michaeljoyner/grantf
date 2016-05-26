@extends('front.base')

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => '/images/assets/logo_lg.png',
        'ogTitle' => 'Contact Grant Fowlds',
        'ogDescription' => 'I would love to work with you! Please feel free to get in touch with me. Bookings should be made well in advance.'
    ])
@endsection

@section('content')
    <div class="contact-page-container">
        <div class="top-divider"></div>
        <h1 class="main-heading">Contact me</h1>
        <p class="intro-text">I’d love to work with you! Please feel free to get in touch with me. Bookings should be made well in advance.</p>
        <section class="contact-details">
            <div class="phone">
                <h4>Call me on:</h4>
                <p class="body-text"><span class="phone-location">Cell: </span>+27 83 264 1978</p>
                <p class="body-text"><span class="phone-location">Office: </span>+27 42 235 1252</p>
            </div>
            <div class="email">
                <h4>Email me at:</h4>
                <p class="body-text"><a href="mailto:grant@rhinoart.co.za">grant@rhinoart.co.za</a></p>
                <p class="body-text"><a href="mailto:grant@amakhala.co.za">grant@amakhala.co.za</a></p>
            </div>
        </section>
        <p class="intro-text orange-text">or just send a message below</p>

        @include('front.partials.contactform')
    </div>
@endsection