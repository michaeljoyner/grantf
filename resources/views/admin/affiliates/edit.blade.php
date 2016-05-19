@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <section class="gf-page-header">
        <h1>Edit this Affiliate</h1>
    </section>
    @include('admin.forms.affiliate', [
        'formAction' => '/admin/affiliates/'.$affiliate->id,
        'buttonText' => 'Save Changes'
    ])
@endsection