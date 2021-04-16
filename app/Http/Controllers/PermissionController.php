<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\Permission;

class PermissionController extends Controller
{
    // View method
    public function index()
    {
        return view('admin.permissions.index', [
            'permissions' => Permission::all(),
        ]);
    }

    //Edit method
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', [
            'permission'=>$permission,
            // Display all the permissions
            'roles'=>Role::all(),
            ]);
    }

    //Update method
    public function update(Permission $permission)
    {
        // Requires always First letter to be upper case
        $permission->label = Str::ucfirst(request('label'));
        // Puts a separator between words
        $permission->slug = Str::of(request('label'))->slug('-');
        if ($permission->isDirty('label')) {
            // Updated message
            session()->flash('permission-updated', 'Role Updated: '. request('label'));
            $permission->save();
        }else{
            // Nothing to update message
            session()->flash('permission-updated', 'No chages to update');
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
        Permission::create([
            'label' => Str::ucfirst(request('label')),
            'slug' => Str::of(Str::lower(request('label')))->slug('-')
        ]);
        return back();
    }

    /* Attach the selected Role method */
    public function attachRole(Permission $permission)
    {
        $permission->roles()->attach(request('role'));
        return back();
    }

    /* Detach the selected Permission method */
    public function detachRole(Permission $permission)
    {
        $permission->roles()->detach(request('role'));
        return back();
    }

    // Delete method
    public function destroy(Permission $permission)
    {
        $permission->delete();
        /* Flash message for deleting, works with the session() in the index view */
        session()->flash('permission-deleted', 'Deleted Role: '. $permission->label);
        return back();
    }

}
