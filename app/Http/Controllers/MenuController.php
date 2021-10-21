<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\menus_routes;
use Illuminate\Http\Request;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.menu.index',
            [
                'data'   => Menu::all(),
                'routes' => menus_routes::all()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->all());
        $this->validate($request,[
            'mmenu_id' => 'required',
            'menu_name' => 'required',
            'menu_route' => 'required',
            'menu_order' => ['integer','required']
        ]);

        $response =  menu::create([
            'parent'        => $request->mmenu_id,
            'name'          => $request->menu_name,
            'class'         => $request->menu_icon,
            'url'           => $request->menu_route,
            'display_order' => $request->menu_order,
            'user_id'       => auth()->user()->id,

        ]);

        return \Response::json(array(
            'success'   => true,
            'status'    => 200,
            'data'      => $response,
            'notify'    => 'success',
            'message'   => 'Menu has been created.'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function show(menus $menus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return view('admin.menu.edit',
            [
                'data'   => menu::all(),
                'menu'   => menu::whereId($request->id)->first(),
                'routes' => menus_routes::all()
            ]
        )->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'mmenu_id' => 'required',
            'menu_name' => 'required',
            'menu_route' => 'required',
        ]);

        // dd($request);
        $response =  Menu::whereId($request->id)->update([
            'parent'        => $request->mmenu_id,
            'name'          => $request->menu_name,
            'class'         => $request->menu_icon,
            'url'           => $request->menu_route,
            'display_order' => $request->menu_order,
            'user_id'       => auth()->user()->id,

        ]);

        return \Response::json(array(
            'success'   => true,
            'status'    => 200,
            'data'      => $response,
            'notify'    => 'success',
            'message'   => 'Menu has been updated'
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $response = menu::whereId($request->id)->delete();
        return \Response::json(array(
            'success'   => true,
            'status'    => 200,
            'data'      => $response,
            'notify'    => 'success',
            'message'   => 'Menu has been deleted.'
        ));
    }
}
