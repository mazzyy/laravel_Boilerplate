<?php

namespace App\Http\Controllers;

use App\Models\menus_routes;
use Illuminate\Http\Request;


class MenusRoutesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.routes.index',
            ['data'=>menus_routes::all()]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'route_name' => 'required',
            'route_slug' => 'required'
        ]);

        $response =  menus_routes::create([
            'route'  => $request->route_name,
            'slug'  => $request->route_slug,
        ]);

        return \Response::json(array(
            'success'   => true,
            'status'    => 200,
            'data'      => $response,
            'notify'    => 'success',
            'message'   => 'Menu route has been created.'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\menus_routes  $menus_routes
     * @return \Illuminate\Http\Response
     */
    public function show(menus_routes $menus_routes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\menus_routes  $menus_routes
     * @return \Illuminate\Http\Response
     */
    public function edit(menus_routes $menus_routes,Request $request)
    {
        return view('admin.routes.edit',
            [
                'data'  => menus_routes::whereId($request->id)->first(),
            ]
        )->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\menus_routes  $menus_routes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, menus_routes $menus_routes)
    {
        $this->validate($request,[
            'route_name' => 'required',
            'route_slug' => 'required'
        ]);

        $response =  menus_routes::whereId($request->id)->update([
            'route'  => $request->route_name,
            'slug'  => $request->route_slug,
        ]);

        return \Response::json(array(
            'success'   => true,
            'status'    => 200,
            'data'      => $response,
            'notify'    => 'success',
            'message'   => 'Menu route has been created.'
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\menus_routes  $menus_routes
     * @return \Illuminate\Http\Response
     */
    public function destroy(menus_routes $menus_routes, Request $request)
    {
        $response = menus_routes::whereId($request->id)->delete();
        return \Response::json(array(
            'success'   => true,
            'status'    => 200,
            'data'      => $response,
            'notify'    => 'success',
            'message'   => 'Menu route has been deleted.'
        ));
    }
}
