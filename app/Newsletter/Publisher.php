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
        $this->issue = new Issue(['send_count' => 0]);
    }

    public function publish($posts)
    {
        if($this->shouldSendIssue()) {
            return $this->sendNewIssue($posts);
        }

        return $this->issue;
    }

    public function sendNewIssue($posts)
    {
        try{
            $this->sendMail($this->mailingList->asArray(), $posts);
        } catch (\Exception $e) {
            return $this->issue;
        }
        return $this->persistIssue($posts);
    }

    private function shouldSendIssue()
    {
        return !! $this->mailingList->count();
    }

    private function sendMail($to, $posts)
    {
        foreach($to as $receiver) {
            Mail::send('emails.newsletter', compact('posts'), function ($message) use ($receiver) {
                $message->to($receiver)->subject('Grant Fowlds Newsletter ' . Carbon::now()->toFormattedDateString());
                $message->from(['grant@rhinoart.org' => 'Grant Fowlds']);
            });
        }

    }

    private function persistIssue($posts)
    {
        $this->issue->send_count = $this->mailingList->count();
        $this->issue->save();

        $posts->each(function ($post) {
            $this->issue->posts()->save($post);
        });

        return $this->issue;
    }
}