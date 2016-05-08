@extends('layouts.app')

@section('content')
    @if(count($errors) > 0)
        <div class="alert error-box">
            <h4 class="error-header">There were some problems with your input</h4>
            @foreach($errors->all() as $error)
                <p class="text-danger">{{ $error }}</p>
            @endforeach
        </div>
    @endif
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Your Application's Landing Page.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
