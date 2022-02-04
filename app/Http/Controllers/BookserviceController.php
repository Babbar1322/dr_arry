<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ar_customer;
use App\Models\ar_booked_service;
use App\Models\ar_booking;
use App\Models\ar_commission;
use App\Models\ar_technician;
use App\Models\ar_tech_commission;
use App\Models\ar_tech_records;
use App\Models\service;
use App\Models\subservice;
use App\Models\status;
use App\Models\provider;
use App\Models\state;
use App\Models\city;
use App\Models\ar_credit;
use App\Models\ar_providerCredit;
use Auth;
use GuzzleHttp\Promise\Create;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;


class BookserviceController extends Controller
{

    public function index(Request $request){
        if ($request->from_date != "" && $request->to_date != "") {
            $bookings = ar_customer::whereBetween('created_at', [$request->from_date, $request->to_date])->orderBy("id", "desc")->paginate();
            $bookings->appends(["from_date"=> $request->from_date, "to_date" => $request->to_date]);
        }
        elseif(!empty($request->search)){
            $bookings = ar_customer::where("phone",'like',"%".$request->search."%")->orWhere("mem_id",'like',"%".$request->search."%")->orWhere("fname",'like',"%".$request->search."%")->orWhere("lname",'like',"%".$request->search."%")->orderBy("id","desc")->paginate();
            $bookings->appends(['search'=>$request->search]);
        }
        else{
            $bookings = ar_customer::orderBy("id","desc")->paginate();
        }

        $bookings->map(function($data){
            $data->booking = ar_booking::where("customer_id",$data->id)->first();
            return $data;
        });
        return view('admin.bookings',compact('bookings'));
    }

    public function bookingDetails($id){
        $cstmrs = ar_customer::where("id",$id)->orderBy("id","desc")->get()->map(function($data){
            $booking = ar_booking::where("customer_id",$data->id)->first();
            $data->booking = $booking;
            return $data;
        });
        $bservices = [];
        foreach($cstmrs as $cst){
            $bservices[] = ar_booked_service::where('customer_id',$id)->where("booking_id",$cst->booking->id)->get()->map(function($data) use($id){
                $data->service = service::where("id",$data->service_id)->first();
                $data->subservice = subservice::where("id",$data->subservice_id)->first();
                $subservice = subservice::where("id",$data->subservice_id)->first();
                if($data->source_type == "In Home"){
                if($data->type == "home"){
                    $data->ser_amount = $subservice->home_amt;
                }
                else{
                    $data->ser_amount = $subservice->clinic_amt;
                }
            }
                return $data;
            });
        }
        $remarks = status::where("customer_id",$id)->orderBy("id","desc")->get();
        $credits = ar_credit::join("ar_provider_credits","ar_credits.id","ar_provider_credits.credit_id")->where("ar_credits.booking_id",$id)->orderBy("ar_credits.id","desc")->get();
        $tech_com = ar_tech_commission::where("booking_id",$id)->get();
        $cash = ar_credit::where("booking_id",$id)->first();

        return view("admin.bookingList",compact("cstmrs","bservices","remarks","credits",'tech_com','id','cash'));
    }

    public function formPageAdmin(Request $request)
    {
        if(!empty($request->pid)){
            $pid = $request->pid;
            $prov = provider::where("id",$pid)->first();
            return response($prov);
        }
        if(!empty($request->tid)){
            $tid = $request->tid;
            $tech = ar_technician::where("id",$tid)->first();
            return response($tech);
        }
        if(!empty($request->phone)){
            $phn = $request->phone;
            $cstmr = ar_customer::where("phone",$phn)->first();
            return response($cstmr);
        }
        if(!empty($request->mem_id)){
            $mem_id = $request->mem_id;
            $cstmr = ar_customer::where("mem_id",$mem_id)->first();
            return response($cstmr);
        }
        
        $service = service::all();
        $providers = provider::all(); 
        $technician = ar_technician::all(); 
        $states = state::orderBy("name")->get();
        $state = state::where("name",$request->name)->first();
        if(!empty($state))
        {
            $cities = city::where("state_id",$state->id)->get();
            return response($cities);
        }
        return view('admin.form', compact('service','providers','technician','states'));
    }
    public function submitform(Request $request)
    {
       
        $rule = [
            "ref_phn"=>["min:10","max:10"],
            "ref_com"=>["min:1"]
        ];
        $msg = [
            "ref_phn.min:10"=>"Refer Phone Must Be 10 Digit",
            "ref_com.min:1"=>"Commission amount is required"
        ];

        $this->validate($request,[
            "mobile"=>["required","min:10","max:10"],
            "fname"=>"required",
            "age"=>"required",
            "dob"=>"required",
            "gender"=>"required",
            "pincode"=>"required",
            "city"=>"required",
            "ref_phn"=>["min:10","max:10"],
            "ref_com"=>["min:1"]
            // "main_service"=>"required",
            // "subservice"=>"required",
        ],$msg);


        
        $input = $request->all();
        $main_serv = $input['main_service'];
        $ser = json_decode($main_serv[0]);
        if($ser == null){
            // return redirect()->back()->with("error","please choose valid service");
            return response()->json(["error"=>"please choose valid service"]);
            exit;
        }
        $ser = $ser[0];
        $sub = $input['subservice'];
        $sub = $sub[$ser];
        
        
        if( $sub[0] == null || count(json_decode($sub[0])) == 0){
            return response()->json(["error"=>"please select subservices"]);
            // return redirect()->back()->with("error","please select subservices");
            exit;
        }
        $mem_id = $request->membershipID;
        if($request->membershipID == ""){
            $mem_id = mt_rand(1000000, 9999999);
        }
        $book_id = mt_rand(1000000, 9999999);
   
    $customer =  ar_customer::create([
        'fname'=> $request->fname,
        'mname'=> $request->mname,
        'lname'=> $request->lname,
        'age'=> $request->age,
        'dob'=> $request->dob,
        'gender'=> $request->gender,
        'refdoct'=> $request->refdoct,
        'otherdoct'=> $request->otherdoct,
        'pincode'=> $request->pincode,
        'email'=> $request->email,
        'address'=> $request->address,
        'area'=> $request->area,
        'city'=> $request->city,
        'state'=> $request->state,
        'nationality'=> $request->nationality,
        "phone"=>$request->mobile,
        "mem_id"=>$mem_id,
        "user_id"=>Auth::user()->id
        // 'adhaar'=> $request->adhaar,
      ]);

      $booking = ar_booking::create([
          "customer_id"=>$customer->id,
          "booking_id"=>$book_id,
          "referby"=>$request->refer_by,
          "referby_name"=>$request->ref_name,
          "refer_phone"=>$request->ref_phn,
          "refer_remarks"=>$request->ref_remark,
          "referral_comm"=>$request->ref_com,
          "total_amount"=>$request->total_amount,
          "discount_amount"=>$request->discount_amount,
          "final_amount"=>$request->final_amount,
      ]);

      $main_serv = $input['main_service'];
      $alsub = $input['subservice'];
      $serv = json_decode($main_serv[0]);
      $totalserv = count($serv);
      for($j=0;$j<$totalserv;$j++){
          $keymianser = json_decode($main_serv[0])[$j];
          $subservice = $alsub[$keymianser];
          $allaubservice = json_decode($subservice[0]);
          $subcount = COUNT($allaubservice);
          $mainserviceId = $keymianser;
          for($i=0;$i<$subcount;$i++){
              $subkey =  $allaubservice[$i];
              $subserviceid = $subkey;
              $datasubserv = $subservice[$subkey];
              $book_ser = new ar_booked_service();
              $book_ser->booking_id = $booking->id;
              $book_ser->customer_id = $customer->id;
              $book_ser->service_id =  $mainserviceId;
              $book_ser->subservice_id = $subserviceid;
              $book_ser->source_type = $datasubserv[2];
              $book_ser->type = $datasubserv[5];
              $book_ser->amount = $datasubserv[3];
              if(isset($datasubserv[4])){
                $book_ser->provider_id = $datasubserv[4];
              }
              $book_ser->amount = $request->servamnt[$mainserviceId];
              $book_ser->discount_amount = $request->servdamnt[$mainserviceId];
              $book_ser->total_amount = $request->servtamnt[$mainserviceId];
              $book_ser->remarks = $datasubserv[9];
              $book_ser->final_payment = $request->final_amount;
              $book_ser->save();
            }
        }

        ar_commission::create([
            "provider_id"=>$request->refer_by,
            "provider_name"=>$request->ref_name,
            "booking_id"=>$booking->id,
            "phone"=>$request->ref_phn,
            "amount"=>$request->ref_com,
            "remarks"=>$request->ref_remark
        ]);

        if(!empty($request->tech_service)) {
            if(count($request->tech_service) > 0) {
                for($i=0;$i<count($request->tech_id);$i++)
                    foreach($request->tech_service as $s) {
                        ar_tech_records::create([
                            "service_id"=> $s,
                            "tech_id"=> $request->tech_id[$i],
                        ]);
                    }
                }
            for($j=0;$j<count($request->tech_id);$j++){
                ar_tech_commission::create([
                    "tech_id"=>$request->tech_id[$j],
                    "tech_name"=>$request->tech_name[$j],
                    "phone"=>$request->tech_phn[$j],
                    "amount"=>$request->tech_com[$j],
                    "remarks"=>$request->tech_remark[$j],
                    "booking_id"=>$booking->id,
                ]);
            }
        }

         $credit = ar_credit::create([
            "booking_id"=>$booking->id,
            "cash_amount"=>$request->cash,
            "amount"=>$request->credit,
            "remarks"=>$request->cre_remark
         ]);


         ar_providerCredit::create([
            "provider_id"=>$request->pro_id,
            "name"=>$request->pro_name,
            "phone"=>$request->pro_phn,
            "amount"=>$request->credit,
            "remarks"=>$request->pro_remark,
            "credit_id"=>$credit->id
         ]);

        $state = state::where("name",$request->state)->first();
         $city = city::where("name",$request->city)->where("state_id",$state->id)->get();
         if(count($city) == 0){
            city::create([
                "name"=>$request->city,
                "state_id"=>$state->id
            ]);
        }


         return response()->json(["success"=>"registration successfully"]);

    //   return redirect()->back()->with("success","Registration Successfully!");
    }
     

    public function edit($id){
            $cstmr = ar_customer::where("id",$id)->orderBy("id","desc")->first();
            $booking = ar_booking::where("customer_id",$id)->first();
        return view('admin.bookingEdit',compact('cstmr','booking'));
             
    }
    public function update(Request $request,$id){
        ar_customer::where("id",$id)->update([
        'fname'=> $request->c_fname,
        'mname'=> $request->c_mname,
        'lname'=> $request->c_lname,
        'age'=> $request->c_age,
        'dob'=> $request->c_dob,
        'gender'=> $request->c_gender,
        'refdoct'=> $request->c_refdoct,
        'otherdoct'=> $request->c_otherdoct,
        'pincode'=> $request->c_pincode,
        'email'=> $request->c_email,
        'address'=> $request->c_address,
        'area'=> $request->c_area,
        'city'=> $request->c_city,
        'state'=> $request->c_state,
        'nationality'=> $request->c_nation,
        "phone"=>$request->c_mobile,
        "pincode"=>$request->c_zip
        ]);

        ar_booking::where("customer_id",$id)->update([
            // "referby"=>$request->refer_by,
            "refer_phone"=>$request->ref_phn,
            "refer_remarks"=>$request->ref_remark,
            "referral_comm"=>$request->ref_com,
            "total_amount"=>$request->total_amount,
            "discount_amount"=>$request->discount_amount,
            "final_amount"=>$request->final_amount,
        ]);

        return redirect()->route('admin.bookingList')->with("success","Updated Successfully!");
    }

    public function updateStatus(Request $request){
        if($request->type == 0 || $request->type == 1){
            if($request->type == 0){
                $type = "activated";
            }
            if($request->type == 1){
                $type = "deactivated";
            }
            ar_booking::where("customer_id",$request->id)->update([
                "is_active"=>$request->type,
                "status_remarks"=>$type
            ]);
            status::create([
                "customer_id"=>$request->id,
                "type"=>$type,
                "remarks"=>$request->remarks,
            ]);
        }
        else if($request->id !="" && $request->status !=""){
            ar_booking::where("customer_id",$request->id)->update([
                "status"=>$request->status,
                "status_remarks"=>$request->type
            ]);
            status::create([
                "customer_id"=>$request->id,
                "type"=>$request->type,
                "remarks"=>$request->remarks,
            ]);

        }
        return redirect()->back()->with("success","status updated successfully");
    }


    public function credits(Request $request){
        $credits = ar_credit::join("ar_provider_credits","ar_credits.id","ar_provider_credits.credit_id")->orderBy("ar_credits.id","desc")->distinct()->get(["ar_provider_credits.credit_id","ar_credits.booking_id"]);
        $totals = 0;
        if(!empty($request->search)){
            $credits = ar_credit::join("ar_provider_credits","ar_credits.id","ar_provider_credits.credit_id")->where(function($q) use($request){ $q->where("name","like","%".$request->search."%")->orWhere("phone","like","%".$request->search."%");})->orderBy("ar_credits.id","desc")->distinct()->get(["ar_provider_credits.credit_id","ar_credits.booking_id"]);
            $total_credit = ar_credit::join("ar_provider_credits","ar_credits.id","ar_provider_credits.credit_id")->where(function($q) use($request){ $q->where("name","like","%".$request->search."%")->orWhere("phone","like","%".$request->search."%");})->where("status",0)->orderBy("ar_credits.id","desc")->sum('ar_provider_credits.amount');
            $total_debit = ar_credit::join("ar_provider_credits","ar_credits.id","ar_provider_credits.credit_id")->where(function($q) use($request){ $q->where("name","like","%".$request->search."%")->orWhere("phone","like","%".$request->search."%");})->where("status",1)->orderBy("ar_credits.id","desc")->sum('ar_provider_credits.amount');
           $totals = $total_credit - $total_debit;
        }
        $credits->map(function($data){
            $provider = ar_providerCredit::where("credit_id",$data->credit_id)->first();
            $credit = ar_providerCredit::where("credit_id",$data->credit_id)->where("status",0)->sum("amount");
            $debit = ar_providerCredit::where("credit_id",$data->credit_id)->where("status",1)->sum("amount");
            $data->amount = $credit-$debit;
            $data->name= $provider->name;
            $data->phone = $provider->phone;
            return $data;
        });

        $ar = $credits->flatten();
        $credits = $ar->all();  // get array
        $total = count($credits);
        $per_page = 15;

        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $credits = array_slice($credits, $starting_point, $per_page, true);
        $credits = new Paginator($credits, $total, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        $credits->appends(["search"=>$request->search]);

        return view("admin.credits",compact('credits','totals'));
    }

    public function creditSend(Request $request){
        $credit = ar_credit::join("ar_provider_credits","ar_credits.id","ar_provider_credits.credit_id")->where("ar_credits.id",$request->id)->first();
        $total = ar_providerCredit::where("status",0)->where('credit_id',$request->id)->sum("amount");
        $pending = ar_providerCredit::where("status",1)->where('credit_id',$request->id)->sum("amount");
        $amount = $total-$pending;
        return view("admin.sendCredits",compact('credit','amount'));
    }

    public function creditUpdate(Request $request){

        $total = ar_providerCredit::where("status",0)->where('credit_id',$request->provider_id)->sum("amount");
        $pending = ar_providerCredit::where("status",1)->where('credit_id',$request->provider_id)->sum("amount");
        $amount = $total-$pending;
        if($request->amount > $amount){
            return redirect()->back()->with("error","Not Enough Amount To Credit");
            exit;
        }

        $credit = ar_providerCredit::create([
            "credit_id"=>$request->credit_id,
            "provider_id"=>$request->provider_id,
            "name"=>$request->provider_name,
            "phone"=>$request->provider_phone,
            "amount"=>$request->amount,
            "remarks"=>$request->remarks,
            "status"=>1
        ]);

        return redirect()->route('admin.credits')->with("success","Credit Send Successfully");

    }

    public function creditDetails($id, Request $request){
        $credits = ar_credit::join("ar_provider_credits","ar_credits.id","ar_provider_credits.credit_id")->where("ar_credits.booking_id",$id)->orderBy("ar_credits.id","desc")->get();
        $credits->map(function($data){
            $cre = ar_providerCredit::where("phone",$data->phone)->where("status",0)->sum('amount');
            $debit = ar_providerCredit::where("phone",$data->phone)->where("status",1)->sum('amount');
            $data->credit_amount = $cre;
            $data->debit_amount = $debit;
            return $data;
        });
        $ar = $credits->flatten();
        $credits = $ar->all();  // get array
        $total = count($credits);
        $per_page = 15;

        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $credits = array_slice($credits, $starting_point, $per_page, true);
        $credits = new Paginator($credits, $total, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        return view("admin.creditDetails",compact('credits'));
    }
    
}     


    


