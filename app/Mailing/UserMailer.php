<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 5/25/16
 * Time: 10:25 AM
 */

namespace App\Mailing;


class UserMailer extends AbstractMailer
{
    public function notifyOfUnsubscription($to)
    {
        $from = ['grant@rhinoart.co.za' => 'Grant Fowlds'];
        $view = 'emails.unsubscribed';

        $this->sendTo($to, $from, 'You have been unsubscribed', $view, []);
    }
}