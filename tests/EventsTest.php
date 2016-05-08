<?php
use App\Occasions\Event;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 5/7/16
 * Time: 10:16 AM
 */
class EventsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function an_event_can_be_created()
    {
        $this->asLoggedInUser();

        $this->visit('/admin/events/create')
            ->submitForm('Create Event', [
                'title'       => 'Speaking occasion',
                'description' => 'I speak to people',
                'event_date'  => Carbon::now()->addDays(10)->format('Y-m-d'),
                'event_time'  => 'after dinner',
                'event_location' => 'my house'
            ])->seeInDatabase('events', [
                'title'       => 'Speaking occasion',
                'description' => 'I speak to people',
//                'event_date'  => \Carbon\Carbon::now()->addDays(10)->format('Y-m-d'),
                'event_time'  => 'after dinner',
                'event_location' => 'my house'
            ]);
    }

    /**
     *@test
     */
    public function an_event_can_be_edited()
    {
        $event = factory(Event::class)->create(['event_date' => '2017-01-01']);
        $this->asLoggedInUser();

        $this->visit('/admin/events/'.$event->id.'/edit')
            ->type('updated event', 'title')
            ->type('updated description', 'description')
            ->type('now in the morning', 'event_time')
            ->type('pmb', 'event_location')
            ->press('Save Changes')
            ->seeInDatabase('events', [
                'id' => $event->id,
                'title' => 'updated event',
                'description' => 'updated description',
                'event_time' => 'now in the morning',
                'event_location' => 'pmb'
            ]);
    }

    /**
     *@test
     */
    public function an_event_can_be_deleted()
    {
        $event = factory(Event::class)->create(['event_date' => '2017-01-01']);
        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $response = $this->call('DELETE', '/admin/events/'.$event->id);
        $this->assertEquals(302, $response->status());

        $this->notSeeInDatabase('events', ['id' => $event->id]);
    }

    /**
     *@test
     */
    public function upcoming_test_can_be_queried()
    {
        factory(Event::class)->create(['event_date' => '2015-01-01']);
        factory(Event::class)->create(['event_date' => '2017-01-01']);
        factory(Event::class)->create(['event_date' => '2018-01-01']);

        $upcoming = Event::upcoming();

        $this->assertCount(2, $upcoming);
    }

    /**
     *@test
     */
    public function upcoming_events_are_returned_in_ascending_event_date_order()
    {
        factory(Event::class)->create(['event_date' => '2018-01-01']);
        factory(Event::class)->create(['event_date' => '2017-01-01']);

        $upcoming = Event::upcoming();
        $this->assertCount(2, $upcoming);

        $this->assertEquals('2017-01-01', $upcoming->first()->event_date->format('Y-m-d'));
    }
}