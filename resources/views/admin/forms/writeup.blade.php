{!! Form::model($writeup, ['url' => $formAction, 'class' => 'form-horizontal gf-form']) !!}
@include('errors')
<div class="form-group">
    <label for="title">Title: <span class="word-count-suggestion">Suggested length: 35 characters</span></label>
    {!! Form::text('title', null, ['class' => "form-control"]) !!}
</div>
<div class="form-group">
    <label for="content">Write-up: <span class="word-count-suggestion">Suggested word count: 60 words</span></label>
    {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'writeup-content']) !!}
</div>
<div class="form-group">
    <label for="link">Link: </label>
    {!! Form::text('link', null, ['class' => "form-control"]) !!}
</div>
<div class="form-group">
    <button type="submit" class="btn gf-btn">{{ $buttonText }}</button>
</div>
{!! Form::close() !!}