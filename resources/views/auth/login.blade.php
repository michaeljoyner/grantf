@extends('admin.base')

@section('head')
    <style>
        .login-logo-img {
            display: block;
            width: 100%;
            margin: 50px auto 10px;
        }
        .login-heading {
            text-align: center;
            text-transform: uppercase;
            color: #f48054;
        }
    </style>
@endsection

@section('content')
<div class="container">
    @include('admin.forms.login')
</div>
@endsection
