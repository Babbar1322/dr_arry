<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\service;
use App\Models\subservice;
use App\Models\ar_booking;
use App\Models\ar_commission;
use App\Models\ar_tech_commission;
use App\Models\provider;
use App\Models\ar_technician;
use App\Models\ar_providerCredit;
use App\Models\state;
use App\Models\city;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
       
            // $this->middleware('guest')->except('logout');
            // $this->middleware('guest:admin')->except('logout');
            // $this->middleware('guest:dealer')->except('logout');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.index');
    }
    // public function formPage()
    // {
    //     return view('user.form');
    // }
    public function memberPage()
    {
        return view('user.member');
    }


// admin route
    public function adminHome(Request $request)
    {
        $branchs = User::where("id","!=",1)->count();
        $services = service::count();
        $subservices = subservice::count();
        $total_booking = ar_booking::count();
        $process_booking = ar_booking::where('status',1)->count();
        $reject_booking = ar_booking::where('status',2)->count();
        $approve_booking = ar_booking::where('status',3)->count();
        $active_booking = ar_booking::where('status_remarks',"activated")->count();
        $deactive_booking = ar_booking::where('status_remarks',"deactivated")->count();
        $providers = provider::count();
        $techs = ar_technician::count();
        $ref_total = ar_commission::where("status",0)->sum('amount');
        $ref_deposit = ar_commission::where("status",1)->sum('amount');
        $ref_pending = $ref_total - $ref_deposit;
        $tech_total = ar_tech_commission::where("status",0)->sum('amount');
        $tech_deposit = ar_tech_commission::where("status",1)->sum('amount');
        $tech_pending = $tech_total - $tech_deposit;
        $credit_total = ar_providerCredit::where("status",0)->sum('amount');
        $credit_deposit = ar_providerCredit::where("status",1)->sum('amount');
        $credit_pending = $credit_total - $credit_deposit;
        return view('admin.index',compact('branchs','services','subservices','total_booking','process_booking','reject_booking','approve_booking','active_booking','deactive_booking','providers','techs','ref_total','ref_deposit','ref_pending','tech_total','tech_deposit','tech_pending','credit_total','credit_deposit','credit_pending'));
    }
    
    public function memberPageAdmin()
    {
        return view('admin.member');
    }
    public function branchPageAdmin()
    {
        return view('admin.branch');
    }
    public function servicePageAdmin()
    {
        return view('admin.serviceAdd');
    }
    public function subservicePageAdmin()
    {
        return view('admin.subserviceAdd');
    }
    public function serviceListPageAdmin()
    {
        return view('admin.serviceList');
    }

    public function state(Request $request){
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, "https://api.countrystatecity.in/v1/countries/IN/states");
         curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
         curl_setopt($ch, CURLOPT_HTTPHEADER  , array(
            'X-CSCAPI-KEY: eGRhUUJNMjBONW5saTFaWGh3VTJVMUJjNHBPZ2lRajVLTVhhc1IwUg=='
          ));
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
         $output = curl_exec($ch);
         $output = json_decode($output);
            curl_close($ch); 
            foreach($output as $out){
                $stat = state::where("name",$out->name)->get();
                if(count($stat) == 0){
                    state::create([
                        "name"=>$out->name,
                        "code"=>$out->iso2
                    ]);
                }
            }
    }


    public function city(Request $request){
        $state = state::where("name",$request->name)->first();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.countrystatecity.in/v1/countries/IN/states/".$state->code."/cities");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
        curl_setopt($ch, CURLOPT_HTTPHEADER  , array(
           'X-CSCAPI-KEY: eGRhUUJNMjBONW5saTFaWGh3VTJVMUJjNHBPZ2lRajVLTVhhc1IwUg=='
         ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        $output = json_decode($output);
        // curl_close($ch); 
        foreach($output as $out){
            $city = city::where("name",$out->name)->where("state_id",$state->id)->get();
            if(count($city) == 0){
                city::create([
                    "name"=>$out->name,
                    "state_id"=>$state->id
                ]);
            }
        }

    }

}
