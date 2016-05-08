<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WriteupFormRequest;
use App\Writeups\ConservationProject;
use Illuminate\Http\Request;

use App\Http\Requests;

class ConservationProjectsController extends WriteupController
{
    use DoesWriteupCrud;

    protected $editView = 'admin.conservation.edit';
    protected $createView = 'admin.conservation.create';
    protected $showView = 'admin.conservation.show';
    protected $redirectBasePath = 'admin/conservation';

    public function index()
    {
        $writeups = ConservationProject::all();
        return view('admin.conservation.index')->with(compact('writeups'));
    }



    public function store(WriteupFormRequest $request)
    {
        $writeup = ConservationProject::create($request->only(['title', 'content', 'link']));

        $this->flasher->success('Success!', 'Remember to add a picture!');

        return redirect($this->redirectBasePath . '/' . $writeup->id);
    }


}
