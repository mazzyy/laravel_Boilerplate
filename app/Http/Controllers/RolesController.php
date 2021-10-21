<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\route_permissions;
use App\Models\User;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    //
    public function index(){

        return view('admin.roles.index',
        ['data' => roles::all()]
    );
}

public function store(Request $request){

    $this->validate($request,[
        'role_name' => 'required',
        'role_slug' => 'required'
    ]);

    $response =  Roles::create([
        'name'  => $request->role_name,
        'slug'  => $request->role_slug,
    ]);

    return \Response::json(array(
        'success'   => true,
        'status'    => 200,
        'data'      => $response,
        'notify'    => 'success',
        'message'   => 'Role has been created.'
    ));

}



    public function delete(Request $request){


        $response = Roles::whereId($request->input('id'))->delete();
// dd($request->input('id'));
        // $response =        Roles::where('id',$request->id)->delete();
        return \Response::json(array(
            'success'   => true,
            'status'    => 200,
            'data'      => $response,
            'notify'    => 'success',
            'message'   => 'Role has been deleted.'
        ));

}


public function editRoles(Request $request){
    return view('admin.roles.edit',
        ['data' => roles::whereId($request->id)->first()]
    )->render();
}

public function updateRoles(Request $request){

    $this->validate($request,[
        'role_name' => 'required',
        'role_slug' => 'required'
    ]);

    $response =  Roles::whereId($request->id)->update([
        'name'  => $request->role_name,
        'slug'  => $request->role_slug,
    ]);

    return \Response::json(array(
        'success'   => true,
        'status'    => 200,
        'data'      => $response,
        'notify'    => 'success',
        'message'   => 'Role has been updated.'
    ));
}

public function getRoleMenus(Request $request){
    return view('admin.roles.menu',
        [ 'role_id' => $request->id ]
    )->render();
}

public function storeRoleMenus(Request $request){
    $submenu = $request->submenu;

    $data = [];
    if(isset($submenu)){
        foreach($submenu as $id){
            $data[]=[
                'role_id'     => $request->role_id,
                'parent_id'   => $request->parent_id,
                'child_id'    => $id,
                'permission'  => 1
            ];
        }
        route_permissions::where('parent_id', $request->parent_id)
        ->where('role_id', $request->role_id)->delete();
        route_permissions::insert($data);
        return \Response::json(array(
            'success'   => true,
            'status'    => 200,
            'notify'    => 'success',
            'message'   => 'Updated.'
        ));
    }else{
        route_permissions::where('parent_id', $request->parent_id)
        ->where('role_id', $request->role_id)->delete();
        return \Response::json(array(
            'success'   => true,
            'status'    => 200,
            'notify'    => 'success',
            'message'   => 'Updated.'
        ));
    }
}


}
