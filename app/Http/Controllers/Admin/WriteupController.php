<?php

namespace App\Http\Controllers\Admin;

use App\Http\FlashMessaging\Flasher;
use App\Http\Requests\WriteupFormRequest;
use App\Writeups\Writeup;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WriteupController extends Controller
{
    /**
     * @var Flasher
     */
    protected $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }


}
