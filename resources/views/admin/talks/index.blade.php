@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    @include('admin.writeups.index', [
        'pageTitle' => 'Speaking',
        'createUrl' => '/admin/speaking/create'
    ])
@endsection
