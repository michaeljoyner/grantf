<div class="event-card clearfix {{ $classnames }}">
    <h3 class="event-title">{{ $event->title }}</h3>
    <div class="event-card-details">
        <p class="event-date"><strong>Date: </strong>{{ $event->event_date->toFormattedDateString() }}</p>
        <p class="event-time"><strong>Time: </strong>{{ $event->event_time }}</p>
        <p class="event-location"><strong>Location: </strong>{{ $event->event_location }}</p>
    </div>
    <div class="event-card-description lead">
        {!! $event->description !!}
    </div>
    <div class="event-actions-container clearfix">
        <div class="event-actions pull-right">
            <a href="/admin/events/{{ $event->id }}/edit">
                <div class="btn gf-btn btn-light">Edit</div>
            </a>
            @include('admin.partials.deletebutton', [
                'objectName' => $event->title,
                'deleteFormAction' => '/admin/events/'.$event->id
            ])
        </div>
    </div>
</div>