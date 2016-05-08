<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Occasions\Event::class, 7)->create()->each(function($event, $index) {
            $event->event_date = \Carbon\Carbon::now()->addWeeks($index);
            $event->save();
        });
    }
}
