<?php

namespace App\Console\Commands;

use App\Blog\Post;
use App\Newsletter\Publisher;
use Illuminate\Console\Command;

class IssueNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:issue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send out latest newsletter';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Publisher $publisher)
    {
        $posts = Post::unissued();

        if($posts->count() > 0) {
            $publisher->publish($posts);
            return $this->info('Delivered to '. $publisher->issue->send_count . ' addresses');
        }

        $this->info('Nothing to deliver');


    }
}
