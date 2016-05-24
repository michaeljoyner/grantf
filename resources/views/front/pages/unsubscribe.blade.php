@extends('front.base')

@section('head')

@endsection

@section('content')
    <div class="unsubscribe-page-container">
        <div class="top-divider"></div>
        <h1 class="main-heading">Unsubscribe from the Newsletter</h1>
        <p class="intro-text">Simply submit your email address, and we shall just send you one final email to let you know that you have been unsubscribed. After that you will no longer receive issues of the newsletter.</p>
        {!! Form::open(['url' => '/newsletter/unsubscribe', 'id' => 'newsletter-unsubscribe']) !!}
        <label for="Email address"></label>
        <input type="email" name="email" placeholder="your email address">
        <button type="submit" class="gf-button center-btn">Unsubscribe</button>
        <p class="success-panel"></p>
        {!! Form::close() !!}
    </div>
@endsection

@section('bodyscripts')

@endsection