<?php

namespace App\Http\Controllers;

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
}
