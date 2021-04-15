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
        session()->flash('role-deleted', 'Deleted Role'. $role->label);
        return back();
    }
}
