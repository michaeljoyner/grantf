<?php

namespace App\Http\Controllers;

use App\Mailing\UserMailer;
use App\Newsletter\MailingList;
use Illuminate\Http\Request;

use App\Http\Requests;

class NewsletterSubscriptionsController extends Controller
{
    public function subscribe(Request $request, MailingList $mailingList)
    {
        $this->validate($request, ['email' => 'required|email']);

        if($mailingList->has($request->email)) {
            return response()->json('You are already subscribed', 400);
        }

        $mailingList->add($request->email);

        return response()->json('ok');
    }

    public function unsubscribe(Request $request, MailingList $mailingList, UserMailer $mailer)
    {
        $this->validate($request, ['email' => 'required|email']);

        if(! $mailingList->has($request->email)) {
            return response()->json('That address is not on the list', 400);
        }

        $mailingList->remove($request->email);

        $mailer->notifyOfUnsubscription($request->email);

        return response()->json('ok');
    }
}
