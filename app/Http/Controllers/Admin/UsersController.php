<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\LastUserDeletionException;
use App\Http\FlashMessaging\Flasher;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
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
        $users = User::all();
        return view('admin.users.index')->with(compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit')->with(compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        $user->update($request->only(['name', 'email']));

        $this->flasher->success('Good Job!', 'User details successfully updated.');

        return redirect('admin/users');
    }

    public function delete(User $user)
    {
        $this->tryDeleteUser($user);

        return redirect('admin/users');
    }

    protected function tryDeleteUser($user)
    {
        try {
            $user->delete();
            $this->flasher->success('All done!', 'The user has been deleted.');
        } catch (LastUserDeletionException $lastUserException) {
            $this->flasher->error('Sorry, no can do.', 'There must always be at least one user');
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
