<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Package;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class PackageController
 *
 * @author  The scaffold-interface created at 2016-08-15 08:39:53am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        return view('package.index',compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $package = new Package();

        
        $package->name = $request->name;

        
        $package->description = $request->description;

        
        $package->string_composer = $request->string_composer;
        $package->description_does_what = $request->description_does_what;
        $package->dashboard_URL = $request->dashboard_URL;
        $package->github_URL = $request->github_URL;

        
        
        $package->save();

        return redirect('package');
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
            return URL::to('package/'.$id);
        }

        $package = Package::findOrfail($id);
        return view('package.show',compact('package'));
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
            return URL::to('package/'. $id . '/edit');
        }

        
        $package = Package::findOrfail($id);
        return view('package.edit',compact('package'  ));
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
        $package = Package::findOrfail($id);
    	
        $package->name = $request->name;
        
        $package->description = $request->description;
        
        $package->string_composer = $request->string_composer;
        $package->description_does_what = $request->description_does_what;
        $package->dashboard_URL = $request->dashboard_URL;
        $package->github_URL = $request->github_URL;

        
        $package->save();

        return redirect('package');
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
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/package/'. $id . '/delete/');

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
     	$package = Package::findOrfail($id);
     	$package->delete();
        return URL::to('package');
    }
}
