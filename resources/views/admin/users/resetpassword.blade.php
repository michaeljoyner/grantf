@extends('admin.base')

@section('content')
    <section class="gf-page-header">
        <h1>Reset Your Password</h1>
    </section>
    <p class="lead">Reset the password for {{ Auth::user()->email }}</p>
    @include('admin.forms.passwordreset')
@endsection