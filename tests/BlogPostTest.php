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
    use DatabaseMigrations, TestsImageUploads;

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

    /**
     *@test
     */
    public function an_unpublished_post_has_no_issue_id()
    {
        $post = factory(Post::class)->create(['title' => 'original', 'published_at' => null]);

        $this->assertNull($post->issue_id);
    }

    /**
     *@test
     */
    public function a_post_knows_if_it_has_been_issued_in_a_newletter()
    {
        $post = factory(Post::class)->create(['title' => 'original', 'published_at' => null]);

        $this->assertFalse($post->hasBeenIssued());

        $post->issue_id = 1;
        $post->save();

        $this->assertTrue($post->hasBeenIssued());
    }

    /**
     *@test
     */
    public function it_can_return_all_unissued_posts()
    {
        $post = factory(\App\Blog\Post::class)->create(['issue_id' => 9, 'published' => 1]);
        $post2 = factory(\App\Blog\Post::class)->create(['published' => 1]);
        $post3 = factory(\App\Blog\Post::class)->create(['published' => 1]);

        $unissued = Post::unissued();

        $this->assertCount(2, $unissued);

        $unissued->each(function($item) use ($post){
            $this->assertNotEquals($post->id, $item->id);
        });
    }
    
    /**
     *@test
     */
    public function a_blog_post_knows_if_it_has_any_images()
    {
        $post = factory(Post::class)->create();
        $post->addImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->assertTrue($post->hasImages());
    }


}