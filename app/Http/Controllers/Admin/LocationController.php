<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use App\Company;
use App\Location;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations=Location::where('company_id',Auth::user()->id)->get();
        
        return view('admin.locations.addlocation',compact('locations')); 
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $otp=rand(pow(10, 4-1),pow(10, 4)-1);
        try{
            $location = new Location();
            $location->company_id=Auth::user()->id;
            $location->longitude = $request->longitude;
            $location->latitude = $request->latitude;
            $location->diameter =$request->diameter;
            
            $location->save();

            return response()->json(array(
                'error' => false,
                'status' => 'success',
                'status_code' => 200
            ));
    }
    catch(\Exception $e){
            return response()->json(array(
                'error' => $e->getMessage(),
                'status' => 'failed',
                'status_code' => 200
            ));
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $location=Location::findorfail($request->id);

            $location->longitude =$request->longitude;
            $location->latitude=$request->latitude;
            $location->diameter =$request->diameter;

            $location->save();

            return response()->json(array(
                'error' => false,
                'status' => 'success',
                'status_code' => 200
            ));
        }
        catch(\Exception $e){
            return response()->json(array(
                'error' => $e->getMessage(),
                'status' => 'failed',
                'status_code' => 200
            ));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location=Location::findorfail($id);
        $location->delete();
        return back()->withInput();
    }

    
}
