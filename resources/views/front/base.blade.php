<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Grant Fowlds</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('head')
    @include('front.partials.favicons')
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="{{ elixir('css/fapp.css') }}">
    <script src="https://use.typekit.net/prb6med.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div class="main-page-wrapper">
    @include('front.partials.navbar')
    <section class="page-content">
        @yield('content')
    </section>
    @include('front.partials.footer')
</div>
<script src="{{ elixir('js/front.js') }}"></script>
@yield('bodyscripts')
<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
    window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
    ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>
</html>