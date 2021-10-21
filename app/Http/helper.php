<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\login_settings;
use App\Models\User;
use App\Models\route_permissions;
use App\Models\user_permissions;
use App\Models\Menu;

function twoFactorAuth(){

	$res = login_settings::first();
	if($res->two_factor_auth > 0){
		return true;
	}else{
	 	return false;
	}
}

function testing()
{
   echo "testing123";
}

function getSideMenuItem( $parent_id = 0 ){

	$user = User::whereId(auth()->user()->id)->first();
	if( $user->is_super > 0 ){
		return  Menu::where('parent',0)
			->orderBy('display_order','ASC')
			->get();
	}else{
		return route_permissions::select('*')
			->join('menus','menus.id','route_permissions.parent_id')
			->where('role_id', auth()->user()->role_id)
			->where('menus.parent',0)
			->groupBy('route_permissions.parent_id')
			->orderBy('parent_id','ASC')
			->get();
	}

}

function getParentMenuItems( $param=0 ){
	return  Menu::where('parent',$param)
	->orderBy('display_order','ASC')
	->get();
}

// this function  used only for assing role form
function getChild( $parent_id = null ){
	return  Menu::where('parent',$parent_id)->orderBy('display_order','ASC')->get();
}

function activeChildMenu( $role_id, $parent_id, $child_id ){
	return route_permissions::where('role_id', $role_id)
		->where('parent_id', $parent_id)
		->where('child_id', $child_id)
		->first();
}

function getChildtMenuItems($param=0){
	return  Menu::select('*')
	//->join('user_permission','user_permission.sub_menu_id','menus.id')
	->where('parent',$param)
	->where('permission','YES')
	->orderBy('display_order','ASC')
	->get();
}

// function getCategiesByProductId( $service_id = null  ){

// 	return service_category_store::select('*')
// 		->join('service_categories','service_categories.id','service_category_store.category_id')
// 		->where('service_id', $service_id)
// 		->get();
// }


function userPermissions( $param = null ){
	if(auth()->user()->is_super > 0){
		return true;
	}else{

		$res = user_permissions::where('user_id', auth()->user()->id,)
			->where('permissions',$param)->first();
		if(!empty($res)){
			return true;
		}else{
			return false;
		}
	}
}

?>
