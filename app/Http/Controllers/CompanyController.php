<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


use App\Models\SubscriptionPackage as Package;
use App\Models\Subscription as Subscription;
use App\Company;
use App\location;
use App\User;
use App\Requirements;
use Auth;

use Mail;

class CompanyController extends Controller
{
    
    public function __construct(){

    }

    // step1
    public function subscribe($slug,$id){
        $package=Package::findOrFail($id);
        return view('guest.pages.register',compact('package'));
    }
    
    // step2
    public function register(Request $request)
    {   
        
        $this->validate($request,[
            'email' => 'required|email|unique:company',
            'package' => 'required'
        ]);

        $package=Package::findOrFail($request->package);
        $company=new Company();

        $company->first_name=$request->first_name;
        $company->last_name=$request->last_name;
        $company->company_name=$request->company_name;
        $company->address=$request->address;
        
        // $company->company_size=$request->company_size;
        
        $company->phone=$request->phone;
        $company->email=$request->email;
        $company->password=bcrypt($request->password);
        
        $company->company_enc=str_random(40);

        $company->save();
        
        // Adding subscription

        Subscription::create([
            'id_package' => $package->id_package,
            'id_company' => $company->id,
            'is_paid' => 1
        ]);
  
        $data = [
           'company_id' => $company->id,
            'token' => $company->company_enc
        ];

        Mail::send('emails.mail', $data ,function($message) use($company) {
                    
            $message->to($company->email,'to Usman')->subject('HR Management verification');
            $message->from('usmanhafeez147@gmail.com','Auto Attendence System');
        });


        return view('guest.pages.after_registered');
    }

    // verify Account
    public function verification($token)
    {   
        if($token){
            $company=Company::where('company_enc',$token)->where('company_enc','<>',null)->first();

            if($company){
                $company->update([
                    'status' => 'verified',
                ]);
                
                $cid=$company->id;
                return view('guest.pages.verify',compact('cid'));    
            }else{
                abort(404);
            }    
        }else{
            abort(404);
        }
        
    }

    public function verifyWizard(Request $request)
    {

        $this->validate($request,[
            'lng' => 'required',
            'lat' => 'required',
            'email' => 'unique:users',
            'hours' => 'required',
            'start_time' => 'required'
        ]);

        $company=Company::findOrFail($request->company_id);

        $this->addLocation($request,$company->id);
        
        $this->addUser($request,$company->id);

        $this->addSetting($request,$company->id);

        $company_name=$company->company_name;
        
        Auth::login($company, true);

        return redirect()->route('myhome')->with('success',$company_name.' registerd successfully');
        
        
    }

    public function addLocation($request,$compId){
        $location = new location();

        $location->longitude=$request->lng;
        $location->latitude=$request->lat;
        $location->diameter=100;
        $location->company_id=$compId;

        $location->save();

    }

    public function addUser($request,$compId)
    {
        $token=rand(pow(10, 4-1), pow(10, 4)-1);

        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->company_id=$compId;

        $user->api_token=Hash::make($token);
        
        $user->save();
            
        Mail::raw($token, function($msg) use($user) { 
            $msg->to($user->email); 
            $msg->from(['usman@beaconites.com']); 
        });
    }

    public function addSetting($request, $compId){
        $req= new Requirements();
        $req->company_id=$compId;
        $req->required_hours=$request->hours;
        $req->starting_time=$request->start_time;
        $req->save();

    }
    
    // public function invite(Request $request,$compToken)
    // {
    //     $this->validate($request,[
    //         'email' => 'unique:users'
    //     ]);

    //     // $company_id=$request->company_id;
    //     $company=Company::findOrFail($request->company_id);
    
                
    //     $token=rand(pow(10, 4-1), pow(10, 4)-1);

    //     $user=new User();
    //     $user->name=$request->name;
    //     $user->email=$request->email;
    //     $user->company_id=$request->company_id;
    //     $user->api_token=Hash::make($token);
    //     $user->save();
            
    //     Mail::raw($token, function($msg) use($user) { 
    //         $msg->to($user->email); 
    //         $msg->from(['usman@beaconites.com']); 
    //     });
        
    //    return view('guest.pages.requirements',compact('company'));
    
    // }

    // public function requirements(Request $request )
    // {
    //     $company=Company::findOrFail($request->company_id);
        
    //     $req= new Requirements();
    //     $req->company_id=$request->company_id;
    //     $req->required_hours=$request->hours;
    //     $req->starting_time=$request->start_time;
    //     $req->save();

    //     $company_name=$company->company_name;
        
    //     return redirect()->route('home')->with('success',$company_name.' registerd successfully');

    // }

}
