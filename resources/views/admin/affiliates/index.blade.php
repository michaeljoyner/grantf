@extends('admin.base')

@section('head')

@endsection

@section('content')
    <section class="gf-page-header">
        <h1 class="pull-left">Affiliates</h1>
        <div class="header-actions pull-right">
            <button type="button" class="btn gf-btn" data-toggle="modal" data-target="#create-affiliate-modal">New</button>
        </div>
        <hr>
    </section>
    <section class="affiliates-index-list">
        @foreach($affiliates as $affiliate)
            <div class="affiliate-card">
                <div class="affiliate-card-image-box">
                    <img src="{{ $affiliate->getImageSrc('thumb') }}" alt="">
                </div>
                <div class="affiliate-card-details">
                    <a href="/admin/affiliates/{{ $affiliate->id }}">
                        <h3 class="affiliate-card-name">{{ $affiliate->name }}</h3>
                    </a>
                    <p class="affiliate-card-description">{{ $affiliate->description }}</p>
                </div>
            </div>
        @endforeach
    </section>
    @include('admin.forms.affiliatemodal')
@endsection