<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 5/18/16
 * Time: 11:00 AM
 */

namespace App\Newsletter;


use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class Publisher
{
    public $issue;
    /**
     * @var MailingList
     */
    private $mailingList;

    public function __construct(MailingList $mailingList)
    {
        $this->mailingList = $mailingList;
    }

    public function sendNewIssue($posts)
    {
        if (!$this->mailingList->count()) {
            $this->issue = new Issue(['send_count' => 0]);
            return;
        }

        $this->issue = Issue::create(['send_count' => $this->mailingList->count()]);

        $posts->each(function ($post) {
            $this->issue->posts()->save($post);
        });

        $this->sendMail($this->mailingList->asArray(), $posts);

        return $this->issue;
    }

    private function sendMail($to, $posts)
    {
        Mail::send('emails.newsletter', compact('posts'), function ($message) use ($to) {
            $message->to($to)->subject('Grant Fowlds Newsletter ' . Carbon::now()->toFormattedDateString());
            $message->from(['grant@rhinoart.org' => 'Grant Fowlds']);
        });
    }
}