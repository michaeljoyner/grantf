<?php

namespace App\Http\Controllers\Admin;

use App\Affiliate;
use App\Http\FlashMessaging\Flasher;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AffiliatesController extends Controller
{
    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

    public function index()
    {
        $affiliates = Affiliate::all();

        return view('admin.affiliates.index')->with(compact('affiliates'));
    }

    public function show(Affiliate $affiliate)
    {
        return view('admin.affiliates.show')->with(compact('affiliate'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        $affiliate = Affiliate::create($request->only(['name', 'description', 'website']));

        $this->flasher->success('Success', 'The new affiliate has been added.');

        return redirect('admin/affiliates/'.$affiliate->id);
    }

    public function edit(Affiliate $affiliate)
    {
        return view('admin.affiliates.edit')->with(compact('affiliate'));
    }

    public function update(Request $request, Affiliate $affiliate)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        $affiliate->update($request->only(['name', 'description', 'website']));

        $this->flasher->success('All done.', 'The affiliate has been updated.');

        return redirect('admin/affiliates/'.$affiliate->id);
    }

    public function delete(Affiliate $affiliate)
    {
        $affiliate->delete();

        $this->flasher->success('Success', 'The affiliate has been deleted.');

        return redirect('admin/affiliates');
    }

    public function setImage(Request $request, Affiliate $affiliate)
    {
        $this->validate($request, ['file' => 'required']);

        $affiliate->setImage($request->file('file'));

        return response()->json('ok');
    }


}
