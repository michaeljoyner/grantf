<?php
use App\Newsletter\MailingList;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 5/18/16
 * Time: 9:56 AM
 */
class MailingListTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_email_address_can_be_added_to_the_list()
    {
        $list = new MailingList;

        $list->add('joe@example.com');

        $this->assertEquals(1, $list->count());
    }

    /**
     *@test
     */
    public function an_email_address_can_be_removed_from_the_list()
    {
        $list = new MailingList;

        $list->add('joe@example.com');
        $list->add('jane@example.com');

        $this->assertEquals(2, $list->count());

        $list->remove('jane@example.com');
        $this->assertEquals(1, $list->count());

        $this->assertFalse($list->has('jane@example.com'));
    }

    /**
     *@test
     */
    public function it_can_return_an_array_of_addresses()
    {
        $list = new MailingList;

        $list->add('joe@example.com');
        $list->add('jane@example.com');

        $array = $list->asArray();

        $this->assertEquals(['joe@example.com', 'jane@example.com'], $array);
    }

}