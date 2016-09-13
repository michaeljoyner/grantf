<?php

namespace App\Http\Controllers\Admin;

use App\Blog\Post;
use App\Newsletter\Issue;
use App\Newsletter\MailingList;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NewsletterController extends Controller
{
    public function index(MailingList $list)
    {
        $issues = Issue::with('posts')->paginate(10);
        $mailingList = $list->asArray();
        $unissued = Post::unissued();

        return view('admin.newsletter.index')->with(compact('issues', 'mailingList', 'unissued'));
    }
}
