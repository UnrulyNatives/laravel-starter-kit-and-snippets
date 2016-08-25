<?php

namespace App\Http\Controllers\Starter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User_setting;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class User_settingController
 *
 * @author  The scaffold-interface created at 2016-08-25 01:06:16am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class User_settingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $user_settings = User_setting::all();
        return view('user_setting.index',compact('user_settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('user_setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_setting = new User_setting();

        
        $user_setting->user_id = $request->user_id;

        
        $user_setting->setting_id = $request->setting_id;

        
        $user_setting->notes = $request->notes;

        
        
        $user_setting->save();

        return redirect('user_setting');
    }

    /**
     * Display the specified resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        if($request->ajax())
        {
            return URL::to('user_setting/'.$id);
        }

        $user_setting = User_setting::findOrfail($id);
        return view('user_setting.show',compact('user_setting'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        if($request->ajax())
        {
            return URL::to('user_setting/'. $id . '/edit');
        }

        
        $user_setting = User_setting::findOrfail($id);
        return view('user_setting.edit',compact('user_setting'  ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $user_setting = User_setting::findOrfail($id);
    	
        $user_setting->user_id = $request->user_id;
        
        $user_setting->setting_id = $request->setting_id;
        
        $user_setting->notes = $request->notes;
        
        
        $user_setting->save();

        return redirect('user_setting');
    }

    /**
     * Delete confirmation message by Ajaxis.
     *
     * @link      https://github.com/amranidev/ajaxis
     * @param    \Illuminate\Http\Request  $request
     * @return  String
     */
    public function DeleteMsg($id,Request $request)
    {
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/user_setting/'. $id . '/delete/');

        if($request->ajax())
        {
            return $msg;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     	$user_setting = User_setting::findOrfail($id);
     	$user_setting->delete();
        return URL::to('user_setting');
    }
}
