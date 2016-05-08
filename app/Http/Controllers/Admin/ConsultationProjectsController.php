<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WriteupFormRequest;
use App\Writeups\ConsultationProject;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ConsultationProjectsController extends WriteupController
{

    use DoesWriteupCrud;

    protected $editView = 'admin.consulting.edit';
    protected $createView = 'admin.consulting.create';
    protected $showView = 'admin.consulting.show';
    protected $redirectBasePath = 'admin/consulting';

    public function index()
    {
        $writeups = ConsultationProject::all();
        return view('admin.consulting.index')->with(compact('writeups'));
    }



    public function store(WriteupFormRequest $request)
    {
        $writeup = ConsultationProject::create($request->only(['title', 'content', 'link']));

        $this->flasher->success('Success!', 'Remember to add a picture!');

        return redirect($this->redirectBasePath . '/' . $writeup->id);
    }
}
