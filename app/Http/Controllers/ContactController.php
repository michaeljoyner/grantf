<?php

namespace App\Http\Controllers;

use App\Mailing\AdminMailer;
use Illuminate\Http\Request;

use App\Http\Requests;

class ContactController extends Controller
{
    public function show()
    {
        return view('front.pages.contact');
    }

    public function postMessage(Request $request, AdminMailer $mailer)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $mailer->sendSiteMessage($request->only(['name', 'email', 'enquiry']));

        return response()->json('ok');
    }
}
