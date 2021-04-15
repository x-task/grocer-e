<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Role;

class RoleController extends Controller
{
    // View method
    public function index()
    {
        return view('admin.roles.index', [
            'roles' => Role::all(),
        ]);
    }

    //Edit method
    public function edit(Role $role)
    {
        return view('admin.roles.edit', ['role'=>$role]);
    }

    //Update method
    public function update(Role $role)
    {
        // Requires always First letter to be upper case
        $role->label = Str::ucfirst(request('label'));
        // Puts a separator between words
        $role->slug = Str::of(request('label'))->slug('-');
        if ($role->isDirty('label')) {
            // Updated message
            session()->flash('role-updated', 'Role Updated: '. request('label'));
            $role->save();
        }else{
            // Nothing to update message
            session()->flash('role-updated', 'No chages to update');
        }
        return back();
    }

    // Store method
    public function store()
    {
        // dd(request('label'));

        request()->validate([
            'label'=>['required']
        ]); // Won't store anithing if 'Label' is null
        Role::create([
            'label' => Str::ucfirst(request('label')),
            'slug' => Str::of(Str::lower(request('label')))->slug('-')
        ]);
        return back();
    }

    public function destroy(Role $role)
    {
        $role->delete();
        /* Flash message for deleting, works with the session() in the index view */
        session()->flash('role-deleted', 'Deleted Role: '. $role->label);
        return back();
    }

}
