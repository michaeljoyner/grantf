<p>Hi folks, here is the latest newsletter. Thanks so much for following, here is whatever you may have missed out on since last time.</p>
<p>Cheers, Grant Fowlds</p>
@foreach($posts as $post)
<a href="http://grantfowlds.com/blog/{{ $post->slug }}"><h3>{{ $post->title }}</h3></a>
<p>{{ $post->description }}</p>
<hr>
@endforeach