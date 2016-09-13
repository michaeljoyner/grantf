@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <section class="gf-page-header">
        <h1 class="pull-left">The Newsletter</h1>
        <div class="header-actions pull-right">
            <button type="button" class="btn gf-btn" data-toggle="modal" data-target="#mailing-list-modal">View List</button>
        </div>
        <hr>
    </section>
    <section class="newsletter-overview row">
        <div class="col-md-6">
            <p class="lead">There are currently <span class="shout-out">{{ count($mailingList) }}</span> people on the mailing list.</p>
            @if($issues->count())
                <p class="lead">The last issue was published <span class="shout-out">{{ $issues->first()->created_at->diffForHumans() }}</span></p>
            @endif
        </div>
        <div class="col-md-6">
            <div class="issue-card">
                <h3>In The next issue...</h3>
                @if($unissued->count())
                    <p>The following posts will be included in the next newsletter, to be issued on {{ (new \Carbon\Carbon('next saturday'))->toFormattedDateString() }}</p>
                    <ul class="list-group">
                    @foreach($unissued as $post)
                        <li class="list-group-item">{{ $post->title }}</li>
                    @endforeach
                    </ul>
                @else
                    <p>There is no new content for a newsletter issue yet.</p>
                @endif
            </div>
        </div>

    </section>
    <section class="recent-issues">
        <h2>Recent Issues</h2>
        @foreach($issues as $issue)
            <div class="issue-card">
                <h3>Issue #{{ $issue->id }} {{ $issue->created_at->toFormattedDateString() }}</h3>
                <p>This issue was sent to {{ $issue->send_count }} readers, and included the following blog posts:</p>
                <ul class="list-group">
                    @foreach($issue->posts as $post)
                        <li class="list-group-item">{{ $post->title }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
        {!! $issues->links() !!}
    </section>
    {{--modal--}}
    <div class="modal fade gf-modal" id="mailing-list-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">The Mailing List</h4>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        @foreach($mailingList as $address)
                            <li class="list-group-item">{{ $address }}</li>
                        @endforeach
                        @if(empty($mailingList))
                            <p class="lead">Your mailing list is currently empty</p>
                        @endif
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn gf-btn btn-light gf-modal-cancel-btn" data-dismiss="modal">Dismiss</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('bodyscripts')
@endsection