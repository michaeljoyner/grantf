<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WriteupFormRequest;
use App\Writeups\Talk;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TalksController extends WriteupController
{

    use DoesWriteupCrud;

    protected $editView = 'admin.talks.edit';
    protected $createView = 'admin.talks.create';
    protected $showView = 'admin.talks.show';
    protected $redirectBasePath = 'admin/speaking';

    public function index()
    {
        $writeups = Talk::all();
        return view('admin.talks.index')->with(compact('writeups'));
    }



    public function store(WriteupFormRequest $request)
    {
        $writeup = Talk::create($request->only(['title', 'content', 'link']));

        $this->flasher->success('Success!', 'Remember to add a picture!');

        return redirect($this->redirectBasePath . '/' . $writeup->id);
    }
}
