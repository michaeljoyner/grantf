<?php

namespace App\Http\Controllers;

use App\Affiliate;
use App\Blog\Post;
use App\Occasions\Event;
use App\Writeups\ConservationProject;
use App\Writeups\ConsultationProject;
use App\Writeups\Talk;
use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function home()
    {
        $events = Event::upcoming()->take(3);
        $affiliates = Affiliate::limit(10)->get();
        return view('front.pages.home')->with(compact('events', 'affiliates'));
    }

    public function conservation()
    {
        $projects = ConservationProject::all();
        return view('front.pages.conservation')->with(compact('projects'));
    }

    public function speaking()
    {
        $projects = Talk::all();
        return view('front.pages.speaking')->with(compact('projects'));
    }

    public function consultant()
    {
        $projects = ConsultationProject::all();
        return view('front.pages.consulting')->with(compact('projects'));
    }

    public function blog()
    {
        $posts = Post::where('published', 1)->latest()->simplePaginate(10);

        return view('front.pages.blogindex')->with(compact('posts'));
    }

    public function post($slug)
    {
        $post = Post::findBySlug($slug);

        return view('front.pages.blogpost')->with(compact('post'));
    }

    public function mailingListUnsubscribe()
    {
        return view('front.pages.unsubscribe');
    }
}
