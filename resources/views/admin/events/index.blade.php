@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <section class="gf-page-header">
        <h1 class="pull-left">Upcoming Events</h1>
        <div class="header-actions pull-right">
            <a href="/admin/events/create">
                <div class="btn gf-btn">Add Event</div>
            </a>
        </div>
        <hr>
    </section>
    <section class="events-list">
        @if($events->count() > 0)
        <div class="next-event-container">
            @include('admin.partials.eventcard', ['event' => $events->first(), 'classnames' => ' event-card-large'])
        </div>
        <h4 class="events-list-subheader">Following Events</h4>
        @foreach($events->slice(1) as $event)
            @include('admin.partials.eventcard', ['event' => $event, 'classnames' => null])
        @endforeach
        @endif
    </section>
@endsection
@include('admin.partials.deletemodal')

@section('bodyscripts')
    @include('admin.partials.modalscript')
@endsection