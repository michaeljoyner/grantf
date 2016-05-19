<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 5/16/16
 * Time: 10:25 AM
 */

namespace App\Mailing;


class AdminMailer extends AbstractMailer
{
    public function sendSiteMessage($fields)
    {
        $to = ['joyner.michael@gmail.com' => 'Michael Joyner'];
        $from = [$fields['email'] => $fields['name']];
        $view = 'emails.sitemessage';
        $subject = 'Website message from '.$fields['name'];
        $this->sendTo($to, $from, $subject, $view, compact('fields'));
    }
}