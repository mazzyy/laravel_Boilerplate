<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use App\Models\user_permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;




class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $data = User::select('users.*','roles.name as role')
            ->join('roles','roles.id','users.role_id')->get()->toArray();
        $mdata = [];


        foreach($data as $row){
            $res =  user_permissions::whereUserId($row)->get()->toArray();
            $per['permissions'] = $res;
            array_push($mdata, array_merge($row,$per));
        }

        return view('admin.users.index',
            [
                'data'  => $mdata,
                'roles' =>Roles::all()
            ]
        );
    }


    public function storeUser(Request $request){

        $this->validate($request,[
             'user_name' => 'required',
             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
             'user_password' => 'required',
             'user_role' => 'required',
         ]);

         $password = $request->user_password;
         $response =  User::create([
             'role_id'       => $request->user_role,
             'name'          => $request->user_name,
             'email'         => $request->email,
             'is_super'      => isset($request->is_super) ? 1 : 0,
             'password'      => Hash::make($password),
         ]);

         $permissions = array();
         if(isset($request->add)){
             $permissions[] = [
                 'user_id'           => $response->id,
                 'permissions'       => 'add',
             ];
         }
         if(isset($request->edit)){
             $permissions[] = [
                 'user_id'           => $response->id,
                 'permissions'       => 'edit',
             ];
         }
         if(isset($request->view)){
             $permissions[] = [
                 'user_id'           => $response->id,
                 'permissions'       => 'view',
             ];
         }
         if(isset($request->delete)){
             $permissions[] = [
                 'user_id'           => $response->id,
                 'permissions'       => 'delete',
             ];
         }
         if(sizeof($permissions) > 0){
             user_permissions::insert($permissions);
         }

         $details = [
             'name' => $request->user_name,
             'email' => $request->email,
             'password' => $password,
         ];
        //  \Mail::to($request->email)->send(new \App\Mail\newUser($details));

         return \Response::json(array(
             'success'   => true,
             'status'    => 200,
             'data'      => $response,
             'notify'    => 'success',
             'message'   => 'User has been created.'
         ));
     }

    public function deleteUser(Request $request){
        $response = User::whereId($request->id)->delete();
        return \Response::json(array(
            'success'   => true,
            'status'    => 200,
            'data'      => $response,
            'notify'    => 'success',
            'message'   => 'User has been deleted.'
        ));
    }

    public function editUser(Request $request){
        return view('admin.users.edit',
            [
                'data'  => User::whereId($request->id)->first(),
                'roles' =>roles::all(),
                'permissions' => user_permissions::whereUserId($request->id)->get()
            ]
        )->render();
    }
    public function updateUser(Request $request){
        $this->validate($request,[
             'user_name' => 'required',
             'user_role' => 'required',
         ]);

         if( isset($request->user_password) ){
             $response =  User::whereId($request->id)->update([
                 'role_id'       => $request->user_role,
                 'name'          => $request->user_name,
                 'is_super'      => isset($request->is_super) ? 1 : 0,
                 'password'      => Hash::make($request->user_password),
             ]);
         }else{
             $response =  User::whereId($request->id)->update([
                 'role_id'       => $request->user_role,
                 'name'          => $request->user_name,
                 'is_super'      => isset($request->is_super) ? 1 : 0,
             ]);
         }

         $permissions = array();
         if(isset($request->add)){
             $permissions[] = [
                 'user_id'           => $request->id,
                 'permissions'       => 'add',
             ];
         }
         if(isset($request->edit)){
             $permissions[] = [
                 'user_id'           => $request->id,
                 'permissions'       => 'edit',
             ];
         }
         if(isset($request->view)){
             $permissions[] = [
                 'user_id'           => $request->id,
                 'permissions'       => 'view',
             ];
         }
         if(isset($request->delete)){
             $permissions[] = [
                 'user_id'           => $request->id,
                 'permissions'       => 'delete',
             ];
         }

         if(sizeof($permissions) > 0){
             user_permissions::whereUserId($request->id)->delete();
             user_permissions::insert($permissions);
         }

         return \Response::json(array(
             'success'   => true,
             'status'    => 200,
             'data'      => $response,
             'notify'    => 'success',
             'message'   => 'User has been updated.'
         ));
     }


}
