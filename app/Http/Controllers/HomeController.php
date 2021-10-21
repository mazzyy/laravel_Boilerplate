<?php

namespace App\Http\Controllers;

use App\Models\company_information;
use App\Models\LogActivity;
use App\Models\login_settings;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function businessInfo(Request $request){

        $this->validate($request,[
            'name' => 'required',
        ]);

        if( $request->id > 0 ){
            $response =  company_information::whereId($request->id)->update([
                'name'    => $request->name,
                'email'   => $request->email,
                'contact' => $request->phone,
                'address' => $request->address,
                'website' => $request->website,
            ]);
        }else{
            $response =  company_information::create([
                'name'    => $request->name,
                'email'   => $request->email,
                'contact' => $request->phone,
                'address' => $request->address,
                'website' => $request->website,
            ]);
        }

        return \Response::json(array(
            'success'   => true,
            'status'    => 200,
            'data'      => $response,
            'notify'    => 'success',
            'message'   => 'Business Info Updated.'
        ));

    }

    public function loginSettings(Request $request){
        return  view('admin.app_settings.index',
            [ 'logins' => login_settings::first() ]
        );
    }


    public function saveLoginSettings(Request $request){

        if( isset($request->TwoFactorAuth) ){
            if( isset($request->id_login) > 0 ){
                login_settings::whereId($request->id_login)->update([
                    'two_factor_auth' => 1
                ]);
            }
        }else{
                login_settings::whereId($request->id_login)->update([
                    'two_factor_auth' => 0
                ]);
        }

        return \Response::json(array(
            'success'   => true,
            'status'    => 200,
            'notify'    => 'success',
            'message'   => 'Updated.'
        ));
    }

    public function userLogs(Request $request){
        if ($request->ajax()) {
            $data = LogActivity::select('log_activities.*','users.name')
                ->join('users','users.id','log_activities.user_id')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '<a onclick="getLocation('.$row->id.')" href="javascript:void(0)" class="edit btn btn-primary btn-sm"><em class="icon ni ni-location"></em>  Get Location</a>';
                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $uesrs = User::all();

        return view('admin.userlogs.index',compact('uesrs'));
    }






}
