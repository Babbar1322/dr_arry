<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\provider;
use App\Models\service;
use App\Models\provider_record;

class ProviderController extends Controller
{
    public function index(Request $request){
        $provider = provider::orderBy("id","desc")->paginate();
        if(!empty($request->search)){
        $provider = provider::where("name","like","%".$request->search."%")->orWhere("email","like","%".$request->search."%")->orWhere("phone","like","%".$request->search."%")->orderBy("id","desc")->paginate();
        $provider->appends(["search"=>$request->search]);
        }
        return view('admin.providerList', compact('provider'));
    }
    public function create(){
        $services = service::all();
        return view('admin.providerAdd',compact('services'));
    }
    public function store(Request $request){
        $this->validate($request,[
            "name"=>"required",
            "email"=>"required",
            "phone"=>"required",
            "city"=>"required",
            "state"=>"required",
            "zip"=>"required",
            "service"=>"required",
        ]);

        $provide = provider::create([
            "name"=> $request->name,
            "email"=> $request->email,
            "phone"=> $request->phone,
            "address"=> $request->address,
            "city"=> $request->city,
            "state"=> $request->state,
            "zip"=> $request->zip,
        ]);

        if(count($request->service) > 0) {
            foreach($request->service as $s) {
                provider_record::create([
                    "service_id"=> $s,
                    "provider_id"=> $provide->id,
                ]);
            }
        }
        return redirect()->route('provider.index')->with("success","Provider Created Successfully");
    }
    public function edit($id){
        $provider = provider::findOrFail($id);
        return view('admin.providerEdit', compact('provider'));
    }
    public function update(Request $request,$id){
        $service = provider::where('id',$id)->update([
            "name"=> $request->name,
            "email"=>$request->email,
            "phone"=>$request->phone,
            "address"=>$request->address,
            "city"=> $request->city,
            "state"=> $request->state,
            "zip"=> $request->zip,
            "bank_name"=> $request->bank_name,
            "account_no"=> $request->acc_no,
            "ifsc_code"=> $request->ifsc_code,
            "recipient_name"=> $request->recipient_name,
        ]);
        return redirect()->route('provider.index')->with("success","Provider updated successfully");
    }
    public function delete($id){
        provider::where('id',$id)->delete();
        return redirect()->back()->with("success","Provider deleted successfully");
    }

    public function subservice(Request $request){
        $services = service::whereIn("id",$request->id)->pluck('name')->all();
        return response($services);
    }

    
}
