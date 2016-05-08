@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <section class="gf-page-header">
        <h1 class="pull-left">{{ $writeup->title }}</h1>
        <div class="header-actions pull-right">
            <a href="{{ $editUrl }}">
                <div class="btn gf-btn">Edit</div>
            </a>
            @include('admin.partials.deletebutton', [
                'objectName' => $writeup->title,
                'deleteFormAction' => $deleteFormAction
            ])
        </div>
        <hr>
    </section>
    <section class="writeup-show">
        <div class="row">
            <div class="col-md-7">
                <div class="lead">
                    {!! $writeup->content !!}
                </div>
                <p class="writeup-link"><a href="{{ $writeup->link }}">{{ $writeup->link }}</a></p>
            </div>
            <div class="col-md-5 single-image-uploader-box" id="image-vue">
                <single-upload default="{{ $writeup->getImageSrc() }}"
                               url="/admin/writeups/{{ $writeup->id }}/image"
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