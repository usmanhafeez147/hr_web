<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Company;
use App\location;
use App\User;
use App\Check;
use App\Timespent;
use App\Latecommers;
use App\Requirements;

use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use DateTime;
use DateTimeZone;
use DB;
class AdminController extends Controller
{

	public function index(){
		$users=User::where('company_id',Auth::user()->id)->get();
		$graphData=[];
		foreach ($users as $user) {
			$graphData['x'][]=$user->name;
			$graphData['y'][]=$user->checks->where('checked','in')->count();
		}

		return view('admin.index',[
			'graphData'=>$graphData

		]);
	}

	public function checks($uid)
	{
		//checks listing
		$checkdata=Check::where('user_id',$uid)->orderBy('created_at','desc')->get();


		$i=30;
		$j=7;
		$weekSum=$this->Timespent($uid,$j);
		
		$monthSum=$this->Timespent($uid,$i);
		
		$daily=$this->dailyHours($uid);
		$leaves=$this->leaves($uid,$i);
		//$weekSum=$weekSum+$daily;
		//$monthSum=$monthSum+$daily;
		
		return view('admin.check.list',compact('checkdata','daily','monthSum','weekSum','leaves'));
	}
	public function approve($checkId){
		$check=Check::find($checkId);

		if($check){
			$check->approved=($check->approved==true)?false:true;
			$check->save();
		}
		return redirect()->back();
	}
	public function dailyHours($uid){
        //Calculating today's time spent here
        $sum=0;
        $inTime=null;
        $outTime=null;
        $user=User::where('id',$uid)->first();
        $cid=$user->company_id;
        $loc=location::where('company_id',$cid)->first();
        $latitude=$loc->latitude;
        $longitude=$loc->longitude;

        $currentDate=Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now())->format('Y-m-d');
        $checks=Check::where('user_id',$uid)->where('created_at','like',$currentDate . '%')->get();
        
        $i=0;
        foreach ($checks as $check) {
            if($check->checked=='out' or $check->checked=='checked_out' or $check->checked=='OUT' or $check->checked=='CHECKED_OUT'){
                $outTime[$i]=$check->time;
                $i++;
            }
        }

        $i=0;
        foreach ($checks as $check) {
            if($check->checked=='in' or $check->checked=='checked_in' or 
        $check->checked=='IN' or $check->checked=='CHECKED_IN')
            {
                $inTime[$i]=$check->time;
                $i++;
            }
        }

        for($j=0;$j<$checks->count();$j++)
        {
            if(isset($outTime[$j])){
                 $inTime[$j]=Carbon::parse($inTime[$j]);
                 $outTime[$j]=Carbon::parse($outTime[$j]);
                 //$hours= $out->diffInSeconds($inTime);

                //$hours=gmdate('H:i:s', $hours);
                $diff=$outTime[$j]->diffInSeconds($inTime[$j]);
                $sum=$sum+$diff;
                

            }else{

       
                

                if(isset($inTime[$j]))
                {
                    $inTime[$j]=Carbon::parse($inTime[$j]);
                    $now=$this->timenow($latitude,$longitude);

                    $diff=$now->diffInSeconds($inTime[$j]);
                    
                    //dd($diff);

                    $sum= $sum + $diff;
                    //$sum=gmdate('H:i:s', $sum);
                }

            }
            
        }
        $sum=gmdate('H:i:s', $sum);
        return $sum;       
    }
	
	public function Timespent($uid,$days) 
	{

		$start_date=Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->subDays($days))->format('Y-m-d');


		$i=$days;

		$sum=0;
		while (true) {
			if(Carbon::now()->subDays($i)<=Carbon::now()){
				$currentDate=Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->subDays($i))->format('Y-m-d');

				$checks=Timespent::where('user_id',$uid)->where('created_at','like',$currentDate . '%')->get();
				foreach ($checks as $check)
				{
					$hours=$check->hoursSpent;
					$sum=$sum+$hours;
				}
			}
			else{
				break;
			}
			$i--;


		}
		$sum=gmdate('H:i:s', $sum);
		return $sum;


	}



	public function latecommers()
	{
		$cid=Auth::user()->id;

		$late=Latecommers::where('company_id',$cid)->orderBy('created_at','desc')->take(30)->get();

		return view('/admin/latecommers',compact('late'));
		
	}
	public function earlygoers()
	{
		$i=30;
		while(true)
		{
			if(Carbon::now()->subDays($i)<=Carbon::now())
				{
				
				$date=Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->subDays($i))->format('Y-m-d');
				
				$cid=Auth::user()->id;
				
				$requirements=Requirements::where('company_id',$cid)->first();

				if($requirements!=null){
					$required_hours=$requirements->required_hours;
				}
				
				

        		$user=DB::table('users')->whereNotIn('id', DB::table('on_times')->where('time','like',$date.'%')->select('user_id'))
        			->where('company_id',$cid)
        			->get();

			}else{
				break;
			}
			
			$datearr[$i]=[$date,$user];
			$i--;
		}
		
        return view('/admin/earlygoers',compact('datearr'));
		
	}

	public function timenow($latitude,$longitude)
    {
        
        $lat =$latitude; //"30.3753";//"40.748817";
        $lng =$longitude;//"69.3451"; //"-73.985428";
        $googleTime = $this->GetTimeZone($lat,$lng);
        //print_r($googleTime); exit;
        $timez = json_decode($googleTime);  
        $d = new DateTime("now", new DateTimeZone($timez->timeZoneId));
        $cruntDate = $d->format('Y-m-d H:i:s');
        $cruntDate=Carbon::parse($cruntDate);
         return ($cruntDate);
    }
	function GetTimeZone($lat,$lng){ 
        $api_key="AIzaSyAtpji5Vk271Qu6_QFSBXwK7wpoCQLY-zQ";
        $url ="https://maps.googleapis.com/maps/api/timezone/json?location=$lat,$lng&timestamp=1331161200&key=$api_key";
        $url=str_replace('&','&',$url); 
        $chin=curl_init(); 
        curl_setopt($chin, CURLOPT_URL, $url); 
        curl_setopt ($chin, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($chin, CURLOPT_SSL_VERIFYPEER, false);
        $json_output = curl_exec ($chin);
        curl_close ($chin); 
        return $json_output; 
    }


	public function leaves($uid,$days)
	{
		$leavecount=0;
		$i=0;
		while(Carbon::now()->subDays($days)<Carbon::now())
			{

				$currentDate=Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->subDays($days))->format('Y-m-d');

				

				$leaves=Check::where('user_id',$uid)->where('created_at','like',$currentDate.'%')->get();

				$holidays=Check::where('created_at','like',$currentDate.'%')
				->where('company_id',Auth::user()->id)
				->first();


				if(count($leaves)==0)
				{
					if($holidays!=null)
					{

						$leavecount++;
					}

				}



				$days--;
			}

			return $leavecount;

		}


	}

