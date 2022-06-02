<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Subscription as Plan;
use App\Models\SubscriptionPackage as Package;
use Carbon\Carbon;
use App\Company;
use App\location;
use App\User;
use App\Check;
use App\Timespent;
use App\Latecommers;
use App\Requirements;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Auth;
use DateTime;
use DateTimeZone;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::where('company_id',Auth::user()->id)->get();

        return view('admin.pages.index',compact('users'));
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            
            $otp=rand(pow(10, 4-1), pow(10, 4)-1);
            
            // $selected_plan=Plan::where('id_company',Auth::user()->id)->first();
            
            // if($selected_plan!=null){
            //     $package=Package::where('id_package',$selected_plan->id_package);
            //     $usersCount=User::where('company_id',Auth::user()->id)->get()->count();
            //     if($usersCount>=$package->no_of_users){

            //     }else{

            //     }

            // }else{

            // }

            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->company_id=Auth::user()->id;
            $user->api_token=Hash::make($otp);
            // send email
            Mail::raw($otp, function($msg) use($user) { 
                $msg->to($user->email); 
                $msg->from(['usman@beaconites.com']); 
            });
            // if record successfully entered, send success response()
            $user->save();

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
            $user=User::findorfail($request->id);

            $user->name=$request->name;
            $user->email=$request->email;

            $user->save();

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
        $user=User::findorfail($id);
        $user->delete();
        return back()->withInput();
    }

    public function reinvite(Request $request)
    {
        try{
             // Random Token Generation
            $token=rand(pow(10, 4-1), pow(10, 4)-1);

            $user=User::findorfail($request->id);
            $user->name=$request->name;
            $user->email=$request->email;
            $user->company_id=$request->company_id;
            $user->api_token=Hash::make($token);
            // send email
            Mail::raw($token, function($msg) use($user) { 
                $msg->to($user->email); 
                $msg->from(['usman@beaconites.com']); 
            });
            // if record successfully entered, send success response()
            $user->save();
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
}
