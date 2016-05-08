<?php
use App\Blog\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 4/25/16
 * Time: 6:49 AM
 */
class BlogPostTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_blog_post_can_be_created()
    {
        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $this->call('POST', '/admin/blog/posts', [
            'title'       => 'My Test Post',
            'description' => 'Just a test',
            'body'        => 'Once upon a time.'
        ]);

        $this->seeInDatabase('posts', [
            'title'       => 'My Test Post',
            'description' => 'Just a test',
            'body'        => 'Once upon a time.'
        ]);
    }

    /**
     * @test
     */
    public function a_blog_post_can_be_edited()
    {
        $post = factory(Post::class)->create();
        $this->asLoggedInUser();

        $this->visit('/admin/blog/posts/' . $post->id . '/edit')
            ->type('a new description', 'description')
            ->type('a revitalised body', 'body')
            ->press('Save')
            ->seeInDatabase('posts', [
                'id'          => $post->id,
                'title'       => $post->title,
                'description' => 'a new description',
                'body'        => 'a revitalised body'
            ]);
    }

    /**
     * @test
     */
    public function a_blog_post_can_be_published_via_posting_to_endpoint()
    {
        $post = factory(Post::class)->create();
        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $this->assertFalse(!! $post->published);

        $response = $this->call('POST', '/admin/blog/posts/' . $post->id . '/publish', [
            'publish' => true
        ]);

        $this->assertEquals(200, $response->status());

        $this->seeInDatabase('posts', [
            'id'        => $post->id,
            'published' => 1
        ]);
    }

    /**
     *@test
     */
    public function a_blog_post_can_be_deleted()
    {
        $post = factory(Post::class)->create();
        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $response = $this->call('DELETE', '/admin/blog/posts/'.$post->id);
        $this->assertEquals(302, $response->status());

        $this->notSeeInDatabase('posts', [
            'id' => $post->id
        ]);
    }

    /**
     *@test
     */
    public function a_posts_slug_will_update_on_update_only_if_it_has_not_been_published_yet()
    {
        $post = factory(Post::class)->create(['title' => 'original', 'published_at' => null]);
        $this->assertNull($post->published_at);
        $this->assertEquals('original', $post->slug);

        $post->update(['title' => 'revised']);
        $this->assertEquals('revised', $post->slug);

        $post->published_at = '1999-01-01';
        $post->save();

        $post->update(['title' => 'newest']);

        $this->assertEquals('newest', $post->title);
        $this->assertEquals('revised', $post->slug);
    }

    /**
     *@test
     */
    public function a_post_can_be_published()
    {
        $post = factory(Post::class)->create(['title' => 'original', 'published_at' => null]);
        $this->assertNull($post->published_at);

        $post->publish();

        $this->assertTrue($post->hasBeenPublished());
        $this->assertNotNull($post->published_at);
    }
}