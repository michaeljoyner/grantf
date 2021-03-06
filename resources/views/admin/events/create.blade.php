@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@stop

@section('content')
    <section class="gf-page-header">
        <h1>Create a Event</h1>
    </section>
    @include('admin.forms.event', [
        'formAction' => '/admin/events',
        'buttonText' => 'Create Event'
    ])
@endsection

@section('bodyscripts')
    @include('admin.partials.tinymce.event')
@endsection