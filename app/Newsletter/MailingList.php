<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 5/18/16
 * Time: 10:03 AM
 */

namespace App\Newsletter;


class MailingList
{

    public function asArray()
    {
        return Subscriber::all()->pluck('email')->toArray();
    }

    public function add($address)
    {
        return Subscriber::create(['email' => $address]);
    }

    public function remove($address)
    {
        $subscriber = Subscriber::where('email', $address)->first();

        if($subscriber) {
            return $subscriber->delete();
        }
    }

    public function has($address)
    {
        return !! Subscriber::where('email', $address)->count();
    }

    public function count()
    {
        return Subscriber::count();
    }


}