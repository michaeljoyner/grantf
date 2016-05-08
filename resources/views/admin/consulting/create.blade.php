@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@stop

@section('content')
    @include('admin.writeups.create', [
        'pageTitle' => 'Create a new Consulting write up',
        'formAction' => '/admin/consulting'
    ])
@endsection

@section('bodyscripts')
    @include('admin.partials.tinymce.writeup')
@endsection