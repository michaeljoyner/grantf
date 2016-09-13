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
        $to = ['grant@rhinoart.co.za' => 'Grant Fowlds'];
        $from = [$fields['email'] => $fields['name']];
        $view = 'emails.sitemessage';
        $subject = 'Website message from '.$fields['name'];
        $this->sendTo($to, $from, $subject, $view, compact('fields'));
    }
}