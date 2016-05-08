<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 5/8/16
 * Time: 12:19 AM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Requests\WriteupFormRequest;
use App\Writeups\Writeup;

trait DoesWriteupCrud
{
    public function show(Writeup $writeup)
    {
        return view($this->showView)->with(compact('writeup'));
    }

    public function create()
    {
        $writeup = new Writeup();

        return view($this->createView)->with(compact('writeup'));
    }

    public function edit(Writeup $writeup)
    {
        return view($this->editView)->with(compact('writeup'));
    }

    public function update(WriteupFormRequest $request, Writeup $writeup)
    {
        $writeup->update($request->only(['title', 'content', 'link']));

        $this->flasher->success('Success!', 'The write-up has been updated');

        return redirect($this->redirectBasePath . '/' . $writeup->id);
    }

    public function delete(Writeup $writeup)
    {
        $writeup->delete();

        $this->flasher->success('Success!', 'The write-up has been deleted');

        return redirect($this->redirectBasePath);
    }
}