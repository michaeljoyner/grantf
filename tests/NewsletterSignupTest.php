<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 5/18/16
 * Time: 11:24 AM
 */
class NewsletterSignupTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_visitor_can_sign_up_for_the_newsletter()
    {
        $this->withoutMiddleware();

        $response = $this->call('POST', '/newsletter/subscribe', [
            'email' => 'joe@example.com'
        ]);
        $this->assertEquals(200, $response->status());

        $list = new \App\Newsletter\MailingList();

        $this->assertTrue($list->has('joe@example.com'));
    }

    /**
     *@test
     */
    public function a_subscriber_can_unsubscribe_from_the_mailing_list()
    {
        $mailing = new \App\Newsletter\MailingList();
        $mailing->add('joe@example.com');
        $this->withoutMiddleware();

        $response = $this->call('POST', '/newsletter/unsubscribe', [
            'email' => 'joe@example.com'
        ]);
        $this->assertEquals(200, $response->status());

        $list = new \App\Newsletter\MailingList();

        $this->assertFalse($list->has('joe@example.com'));

        $this->notSeeInDatabase('subscribers', [
            'email' => 'joe@example.com'
        ]);
    }
}