<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class FeatureController
 *
 * @author  The scaffold-interface created at 2016-08-15 09:55:54am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $features = Feature::all();
        activity()->log('Feature index opened'); // spatie activity-log
        return view('feature.index',compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('feature.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $feature = new Feature();

        
        $feature->name = $request->name;

        
        $feature->description = $request->description;

        
        $feature->demonstration_URL = $request->demonstration_URL;

        
        
        $feature->save();

        return redirect('feature');
    }

    /**
     * Display the specified resource.
     *
     * @param        \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        if($request->ajax())
        {
            return URL::to('feature/'.$id);
        }

        $feature = Feature::findOrfail($id);
        return view('feature.show',compact('feature'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param        \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        if($request->ajax())
        {
            return URL::to('feature/'. $id . '/edit');
        }

        
        $feature = Feature::findOrfail($id);
        return view('feature.edit',compact('feature'  ));
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
        $feature = Feature::findOrfail($id);
    	
        $feature->name = $request->name;
        
        $feature->description = $request->description;
        
        $feature->demonstration_URL = $request->demonstration_URL;
        
        
        $feature->save();

        return redirect('feature');
    }

    /**
     * Delete confirmation message by Ajaxis
     *
     * @link  https://github.com/amranidev/ajaxis
     * @param        \Illuminate\Http\Request  $request
     * @return  String
     */
    public function DeleteMsg($id,Request $request)
    {
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/feature/'. $id . '/delete/');

        if($request->ajax())
        {
            return $msg;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     	$feature = Feature::findOrfail($id);
     	$feature->delete();
        return URL::to('feature');
    }
}
