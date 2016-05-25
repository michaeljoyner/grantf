<p>Hi folks, </p>
<p>Thanks so much for following, here are the latest posts from my blog!</p>
<p>Cheers, Grant Fowlds</p>
@foreach($posts as $post)
<a href="http://grantfowlds.com/blog/{{ $post->slug }}" style="text-decoration: none;">
    <h3 style="color: #F5855C; font-family: serif; text-transform: uppercase; text-align: center;">{{ $post->title }}</h3>
</a>
<p>{{ $post->description }}</p>
<a href="http://grantfowlds.com/blog/{{ $post->slug }}" style="text-decoration: none;">
    <div style="width: 80%; max-width: 250px; height: 32px; line-height: 32px; text-align: center; color: #ffffff; background: #73C7AC; margin: 1em auto">Read Article</div>
</a>
<hr style="width: 80%; display: block; margin: 1em auto">
@endforeach
<p>If you wish to stop receiving these emails, you may <a href="http://grantfowlds.com/mailinglist/unsubscribe">unsubscribe</a></p>