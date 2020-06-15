<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //

    
   

        
    public function index() {

        return view('admin.permissions.index', ['permissions'=>Permission::all()]);

    }

    public function store() {

        request()->validate([
            'name'=>['required']
        ]);

        Permission::create([
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('-'),

        ]);

            return back();
    }

    public function edit(Permission $permission){

        return view('admin.permissions.edit', ['permission'=>$permission]);



    }

    public function update(Permission $permission) {

        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(Str::lower(request('name')))->slug('-');

        if($permission->isDirty('name')) {

            session()->flash('permission-updated', 'Permission updated '. request('name'));
           
            $permission->update();



        } else {

            session()->flash('permission-no-updated', 'Nothing has been updated');

            return back();
            
        }
        return redirect(route('permissions.index',));


    }



    public function destroy(Permission $permission){

        $permission->delete();

        session()->flash('permission-deleted', 'Deleted permission '. $permission->name);

        return back();
    }



}
