<?php

namespace App\Http\Controllers;

use App\Models\EmailSettings;
use Illuminate\Http\Request;


class EmailSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.emailsetting.index',
            [
                'data'  => EmailSettings::all()
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
        $this->validate($request,[
            'host' => 'required',
            'username' => 'required',
            'password' => 'required',
            'mail_enc' => 'required',
            'port' => 'required',
            'title' => 'required',
        ]);

        $response =  EmailSettings::create([
            'host'          => $request->host,
            'port'          => $request->port,
            'username'      => $request->username,
            'password'      => $request->password,
            'sent_title'    => $request->title,
            'email_enc'     => $request->mail_enc,
            'status'        => $request->status,
            'user_id'       => auth()->user()->id,

        ]);

        return \Response::json(array(
            'success'   => true,
            'status'    => 200,
            'data'      => $response,
            'notify'    => 'success',
            'message'   => 'New role has been created.'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\email_settings  $email_settings
     * @return \Illuminate\Http\Response
     */
    public function show(EmailSettings $email_settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmailSettings  $email_settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return view('admin.emailsetting.edit',
            [
                'data'  => EmailSettings::whereId($request->id)->first()
            ]
        )->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\email_settings  $email_settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'host' => 'required',
            'username' => 'required',
            'password' => 'required',
            'mail_enc' => 'required',
            'port' => 'required',
            'title' => 'required',
        ]);

        $response =  EmailSettings::whereId($request->id)->update([
            'host'          => $request->host,
            'port'          => $request->port,
            'username'      => $request->username,
            'password'      => $request->password,
            'sent_title'    => $request->title,
            'email_enc'     => $request->mail_enc,
            'status'        => $request->status,
            'user_id'       => auth()->user()->id,

        ]);

        return \Response::json(array(
            'success'   => true,
            'status'    => 200,
            'data'      => $response,
            'notify'    => 'success',
            'message'   => 'updated.'
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\email_settings  $email_settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $response = EmailSettings::whereId($request->id)->delete();
        return \Response::json(array(
            'success'   => true,
            'status'    => 200,
            'data'      => $response,
            'notify'    => 'success',
            'message'   => 'Item has been deleted.'
        ));
    }
}
