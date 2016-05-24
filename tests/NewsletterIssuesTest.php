<?php
use App\Blog\Post;
use App\Newsletter\Issue;
use App\Newsletter\MailingList;
use App\Newsletter\Publisher;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 5/18/16
 * Time: 10:31 AM
 */
class NewsletterIssuesTest extends TestCase
{

    use DatabaseMigrations;

    /**
     *@test
     */
    public function it_issues_only_previously_unissued_posts()
    {
        $post = factory(Post::class)->create(['issue_id' => 9, 'published' => 1]);
        $post2 = factory(Post::class)->create(['published' => 1]);
        $post3 = factory(Post::class)->create(['published' => 1]);

        $publisher = new Publisher(new MailingList());
        $issue = $publisher->sendNewIssue(Post::unissued());

        $issuedPosts = $issue->posts;

        $issuedPosts->each(function($item) use ($post) {
           $this->assertNotEquals($post->id, $item->id);
        });

        $this->assertTrue(Post::findOrFail($post2->id)->hasBeenIssued());
        $this->assertTrue(Post::findOrFail($post3->id)->hasBeenIssued());
    }

    /**
     * @test
     */
    public function it_sends_to_the_correct_amount_of_addresses()
    {
        $list = new MailingList();
        $list->add('joe@example.com');
        $list->add('jane@example.com');
        $list->add('jack@example.com');

        $post = factory(Post::class)->create(['issue_id' => 9]);
        $post2 = factory(Post::class)->create();
        $post3 = factory(Post::class)->create();

        $publisher = new Publisher(new MailingList());
        $issue = $publisher->sendNewIssue(Post::unissued());

        $this->assertEquals(3, $issue->send_count);
    }

    /**
     * @test
     */
    public function there_are_no_unissued_posts_after_an_issue()
    {
        $list = new MailingList();
        $list->add('joe@example.com');
        $list->add('jane@example.com');
        $list->add('jack@example.com');

        $post = factory(Post::class)->create(['issue_id' => 9]);
        $post2 = factory(Post::class)->create();
        $post3 = factory(Post::class)->create();

        $publisher = new Publisher(new MailingList());
        $issue = $publisher->sendNewIssue(Post::unissued());

        $this->assertCount(0, Post::unissued());
    }

}