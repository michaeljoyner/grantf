{!! Form::model($event, ['url' => $formAction, 'class' => 'form horizontal dd-form']) !!}
@include('errors')
<div class="form-group">
    <label for="title">Title: </label>
    {!! Form::text('title', null, ['class' => "form-control"]) !!}
</div>
<div class="form-group">
    <label for="event_date">Date: </label>
    {!! Form::date('event_date', $event->event_date ? $event->event_date->format('Y-m-d') : \Carbon\Carbon::now()->format('Y-m-d'), ['class' => "form-control"]) !!}
</div>
<div class="form-group">
    <label for="event_time">Time: </label>
    {!! Form::text('event_time', null, ['class' => "form-control"]) !!}
</div>
<div class="form-group">
    <label for="event_location">Location: </label>
    {!! Form::text('event_location', null, ['class' => "form-control"]) !!}
</div>
<div class="form-group">
    <label for="description">Description: </label>
    {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'event-description']) !!}
</div>
<div class="form-group">
    <button type="submit" class="btn gf-btn">{{ $buttonText }}</button>
</div>
{!! Form::close() !!}