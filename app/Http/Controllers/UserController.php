<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        return view('admin.users.profile', ['user'=>$user]);
    }

    public function update(User $user)
    {
        $inputs = request()->validate([
            'username' => ['required', 'string', 'max:255', 'alpha_dash'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'avatar' => ['file'],
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
}
