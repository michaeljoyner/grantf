<?php

namespace App\Http\Controllers\Admin;

use App\Writeups\Writeup;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WriteupImagesController extends Controller
{
    public function storeImage(Request $request, Writeup $writeup)
    {
        $this->validate($request, ['file' => 'required']);

        $writeup->setImage($request->file('file'));

        return response()->json('ok');
    }
}
