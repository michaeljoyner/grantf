@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <section class="gf-page-header">
        <h1 class="pull-left">{{ $affiliate->name }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/affiliates/{{ $affiliate->id }}/edit">
                <div class="btn gf-btn">Edit</div>
            </a>
            @include('admin.partials.deletebutton', [
                'objectName' => $affiliate->name,
                'deleteFormAction' => '/admin/affiliates/'.$affiliate->id
            ])
        </div>
        <hr>
    </section>
    <section class="writeup-show">
        <div class="row">
            <div class="col-md-7">
                <p class="lead">
                    {{ $affiliate->description }}
                </p>
                <p class="writeup-link"><a href="{{ $affiliate->website }}">{{ $affiliate->website }}</a></p>
            </div>
            <div class="col-md-5 single-image-uploader-box" id="image-vue">
                <single-upload default="{{ $affiliate->getImageSrc() }}"
                               url="/admin/affiliates/{{ $affiliate->id }}/image"
                               shape="square"
                               size="large"
                ></single-upload>
            </div>
        </div>
    </section>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
    <script>
        new Vue({el: '#image-vue'});
    </script>
@endsection