<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAvatarAttribute($value)
    {
            if (strpos($value, 'https://') !== false || strpos($value, 'http://') !== false)
            {
                return $value;
            }

        return asset('images/' . $value);
    }

    public function index()
    {
        $users = User::all();
        $users = auth()->user()->paginate(10);

        foreach($users as $user)
        {
            $user->avatar = $this->getAvatarAttribute($user->avatar);
        }
        return view('admin.users.index', ['users'=>$users]);
    }

    /* Function that shows the user profiles */
    public function show(User $user)
    {
        return view('admin.users.profile', [
            'user'  => $user,
            'roles' => Role::all(),
            ]);
    }

    public function update(User $user)
    {
        $inputs = request()->validate([
            'username' => ['required', 'string', 'max:255', 'alpha_dash'],
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'max:255'],
            'avatar'   => ['file'],
            // 'password' => ['min:6', 'max:255', 'confirmed']
        ]);

        if($file = request('avatar')){
            $name = $file->getClientOriginalName();
            $file->move('images', $name);
            $inputs['avatar'] = $name;
            // $inputs['avatar'] = request('avatar')->store('images');
        }

        $user->update($inputs);
        return back();
    }

    public function destroy(User $user)
    {
        // $this->authorize('delete', $user);
        $user->delete();
        session()->flash('message', 'User was deleted');
        return back();
    }

    public function attach(User $user)
    {
        /* To test our vars and if they get the data we want we can use dd() function */
        // dd(request('role'));

        /* We get the user, then use the function roles(), then use the attach() fun
        to get the role from the helper function request(with of key: 'role') to
        attach the role from the user */
        $user->roles()->attach(request('role'));
        return back();
    }

    public function detach(User $user)
    {
        /* We get the user, then use the function roles(), then use the detach() fun
        to get the role from the helper function request(with of key: 'role') to
        detach the role from the user */
        $user->roles()->detach(request('role'));
        return back();
    }
}
