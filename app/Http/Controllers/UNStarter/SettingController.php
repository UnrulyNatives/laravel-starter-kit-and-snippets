<?php

namespace App\Http\Controllers\UNStarter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class SettingController
 *
 * @author  The scaffold-interface created at 2016-08-25 01:07:35am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();
        return view('setting.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $setting = new Setting();

        
        $setting->name = $request->name;

        
        $setting->description = $request->description;

        
        
        $setting->save();

        return redirect('setting');
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
            return URL::to('setting/'.$id);
        }

        $setting = Setting::findOrfail($id);
        return view('setting.show',compact('setting'));
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
            return URL::to('setting/'. $id . '/edit');
        }

        
        $setting = Setting::findOrfail($id);
        return view('setting.edit',compact('setting'  ));
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
        $setting = Setting::findOrfail($id);
    	
        $setting->name = $request->name;
        
        $setting->description = $request->description;
        
        
        $setting->save();

        return redirect('setting');
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
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/setting/'. $id . '/delete/');

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
     	$setting = Setting::findOrfail($id);
     	$setting->delete();
        return URL::to('setting');
    }
}
