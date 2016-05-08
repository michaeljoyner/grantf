<section class="gf-page-header">
    <h1 class="pull-left">{{ $pageTitle }}</h1>
    <div class="header-actions pull-right">
        <a href="{{ $createUrl }}">
            <div class="btn gf-btn">New Entry</div>
        </a>
    </div>
    <hr>
</section>
<section class="writeup-list">
    @foreach($writeups as $writeup)
        <div class="writeup-index-card">
            <div class="writeup-index-card-image-box">
                <img src="{{ $writeup->getImageSrc('thumb') }}" alt="" class="round">
            </div>
            <div class="writeup-index-card-detail">
                <a href="/admin/conservation/{{ $writeup->id }}">
                    <h3 class="writeup-index-title">{{ $writeup->title }}</h3>
                </a>
            </div>
        </div>

    @endforeach
</section>