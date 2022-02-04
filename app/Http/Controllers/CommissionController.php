<?php

namespace App\Http\Controllers;

use App\Models\ar_booked_service;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ar_commission;
use App\Models\ar_tech_commission;
use App\Models\ar_technician;
use App\Models\provider;
use App\Models\service;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;



class CommissionController extends Controller
{
    public function index(Request $request){
        $commissions = ar_commission::distinct()->orderBy("id","desc")->get(["phone"]);
        if(!empty($request->search)){
            $commissions = ar_commission::where("provider_name","like","%".$request->search."%")->orWhere("phone","like","%".$request->search."%")->distinct()->orderBy("id","desc")->get(["phone"]);
        }
        $commissions->map(function($data){
            $credit = ar_commission::where("status",0)->where("phone",$data->phone)->sum("amount");
            $debit = ar_commission::where("status",1)->where("phone",$data->phone)->sum("amount");
            $data->tamount = $credit;
            $data->damount = $debit;
            $data->amount = $credit -$debit;
            $data->provider = provider::where("phone",$data->phone)->first();
            $data->com = ar_commission::where("phone",$data->phone)->first();
            return $data;
        });

        $ar = $commissions->flatten();
        $commissions = $ar->all();  // get array

        $total = count($commissions);
        $per_page = 15;

        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $commissions = array_slice($commissions, $starting_point, $per_page, true);
        $commissions = new Paginator($commissions, $total, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        $commissions->appends(["search"=>$request->search]);

        return view('admin.commissions',compact('commissions'));
    }
    
    public function cutComm(Request $request){
        $provider ="";
        if(isset($request->provider_id)){
            $provider = ar_commission::where("provider_id",$request->provider_id)->first();
        }
        return view("admin.sendCommission",compact('provider'));
    }

    public function send(Request $request){
        $cr = ar_commission::where("phone",$request->phone)->where("status",0)->sum("amount");
        $de = ar_commission::where("phone",$request->phone)->where("status",1)->sum("amount");
        $total = $cr-$de;
        if($request->amount > $total){
            return redirect()->back()->with("error","not enough balance to send");
            exit;
        }

        ar_commission::create([
            "status"=>1,
            "provider_id"=>$request->provider_id,
            "phone"=>$request->phone,
            "amount"=>$request->amount
        ]);
        return redirect()->route('provider.commission')->with("success","commission send successfully");
    }

    public function tech_commission(Request $request){
        $commissions = ar_tech_commission::distinct()->orderBy("id","desc")->get(['phone']);
        if(!empty($request->search)){
            $commissions = ar_tech_commission::distinct()->where(function($q) use($request){ $q->where("tech_name","like","%".$request->search."%")->orWhere("phone","like","%".$request->search."%");})->orderBy("id","desc")->get(['phone']);
        }
        $commissions->map(function($data){
            $credit = ar_tech_commission::where("status",0)->where("phone",$data->phone)->sum("amount");
            $debit = ar_tech_commission::where("status",1)->where("phone",$data->phone)->sum("amount");
            $data->tamount = $credit;
            $data->damount = $debit;
            $data->amount = $credit -$debit;
            $data->tech = ar_technician::where("phone",$data->phone)->first();
            $data->com = ar_tech_commission::where("phone",$data->phone)->first();
            return $data;
        });


        $ar = $commissions->flatten();
        $commissions = $ar->all();  // get array

        $total = count($commissions);
        $per_page = 15;

        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $commissions = array_slice($commissions, $starting_point, $per_page, true);
        $commissions = new Paginator($commissions, $total, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        $commissions->appends(["search"=>$request->search]);

        return view('admin.techCommission',compact('commissions'));
    }
    
    public function cut_techComm(Request $request){
        $tech ="";
        if(isset($request->tech_id)){
            $tech = ar_tech_commission::where("tech_id",$request->tech_id)->first();
        }
        return view("admin.sendTechCommission",compact('tech'));
    }

    public function send_techComm(Request $request){
        $cr = ar_tech_commission::where("tech_id",$request->tech_id)->where("status",0)->sum("amount");
        $de = ar_tech_commission::where("tech_id",$request->tech_id)->where("status",1)->sum("amount");
        $total = $cr-$de;
        if($request->amount > $total){
            return redirect()->back()->with("error","not enough balance to send");
            exit;
        }

        ar_tech_commission::create([
            "status"=>1,
            "tech_id"=>$request->tech_id,
            "phone"=>$request->phone,
            "amount"=>$request->amount
        ]);
        return redirect()->route('tech.commission')->with("success","commission send successfully");
    }

    public function tech_slip(Request $request){
        $booking_id = $request->booking_id;
        $commissions = ar_tech_commission::where("phone",$request->phone)->paginate();
        $commissions->appends(["id"=>$request->id]);
        $technician = ar_technician::where("phone",$request->phone)->first();
        $tech = ar_tech_commission::where("phone",$request->phone)->first();
        $total = ar_tech_commission::where("phone",$request->phone)->where("status",0)->sum('amount');
        if ($request->from_date != "" && $request->to_date != "") {
            $commissions =  ar_tech_commission::where("phone",$request->phone)->whereBetween('created_at', [$request->from_date, $request->to_date])->paginate(); 
            $total  = ar_tech_commission::where("phone",$request->phone)->whereBetween('created_at', [$request->from_date, $request->to_date])->where("status",0)->sum('amount');
        }
        $booked_services = ar_booked_service::where("booking_id",$booking_id)->get();
        $booked_services->map(function($data) {
            $services = service::where("id",$data->service_id)->first();
            $data->services = $services;
        });

        return view('admin.techCom_slip',compact('commissions','technician','total','tech','booked_services'));
    }
    public function provider_slip(Request $request){
        $phone = $request->phone;
        $booking_id = $request->booking_id;
        if(!empty($request->id)){
            $comm = ar_commission::where("booking_id",$request->id)->first();
            $phone = $comm->phone;
        }
        $commissions = ar_commission::where("phone",$phone)->paginate();
        $commissions->appends(["phone"=>$phone]);
        $prov = ar_commission::where("phone",$phone)->first();
        $provider = provider::where("phone",$phone)->first();
        $total  = ar_commission::where("phone",$phone)->where("status",0)->sum('amount');

        if ($request->from_date != "" && $request->to_date != "") {
            $commissions =  ar_commission::where("phone",$phone)->whereBetween('created_at', [$request->from_date, $request->to_date])->paginate(); 
            $total  = ar_commission::where("phone",$phone)->whereBetween('created_at', [$request->from_date, $request->to_date])->where("status",0)->sum('amount');
        }

        $booked_services = ar_booked_service::where("booking_id",$booking_id)->get();
        $booked_services->map(function($data) {
            $services = service::where("id",$data->service_id)->first();
            $data->services = $services;
        });
        return view('admin.providerCom_slip',compact('commissions','provider','total','prov','booked_services'));
    }
}