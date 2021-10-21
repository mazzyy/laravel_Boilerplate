<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class aqs extends Model
{
    use HasFactory;

    public static function getSideMenu(){

        $user = User::whereId(auth()->user()->id ?? 0)->first();
        if( $user->is_super > 0 ){
            return  menu::where('parent',0)
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

    public static function getParentMenuItems( $param=0 ){
        return  menu::where('parent',$param)
        ->orderBy('display_order','ASC')
        ->get();
    }

    public static function getChild( $parent_id = null ){
        return  menu::where('parent',$parent_id)->orderBy('display_order','ASC')->get();
    }

    public static function userPermissions( $param = null ){
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

    public static function activeChildMenu( $role_id, $parent_id, $child_id ){
        return route_permissions::where('role_id', $role_id)
            ->where('parent_id', $parent_id)
            ->where('child_id', $child_id)
            ->first();
    }

    public static function getChildtMenuItems($param=0){
        return  menu::select('*')
        ->where('parent',$param)
        ->where('permission','YES')
        ->orderBy('display_order','ASC')
        ->get();
    }

    public static function getCategiesByProductId( $service_id = null  ){
        return service_category_store::select('*')
            ->join('service_categories','service_categories.id','service_category_store.category_id')
            ->where('service_id', $service_id)
            ->get();
    }



}
