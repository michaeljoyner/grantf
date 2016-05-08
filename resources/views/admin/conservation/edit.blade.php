@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@stop

@section('content')
    @include('admin.writeups.edit', ['formAction' => '/admin/conservation/'.$writeup->id])
@endsection

@section('bodyscripts')
    @include('admin.partials.tinymce.writeup')
@endsection