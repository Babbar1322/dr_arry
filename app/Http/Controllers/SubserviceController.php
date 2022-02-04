<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\service;
use App\Models\subservice;

class SubserviceController extends Controller
{

    public function index(Request $request){
        $services = subservice::orderBy("id","desc")->paginate();

        if(!empty($request->search)){
            $services = subservice::where("name",'like',"%".$request->search."%")->orderBy("id","desc")->paginate();
            $services->appends(["search"=>$request->search]);
        }
        return view('admin.subserviceList',compact('services'));
    }
    public function create(){
        $services = service::orderBy("id","desc")->get();
        return view('admin.subserviceAdd', compact('services'));
    }
    public function store(Request $request){
        $rule = [
            "name"=>"required",
            "sid"=>["required","integer"]
        ];

        $msg = ["sid.integer"=> "Service name is required"];
        $this->validate($request,$rule,$msg);

        $service = subservice::create([
            "name"=> $request->name,
            "service_code"=> $request->service_code,
            "home_amt"=>$request->home_amt,
            "clinic_amt"=>$request->clinic_amt,
            "service_id"=>$request->sid,
            "in_home"=>$request->in_home,
            "out_source"=>$request->out_source,
            "home"=>$request->home,
            "clinic"=>$request->clinic
        ]);
        return redirect()->route('subservice.index')->with("success","Sub Service Created Successfully");
    }
    public function edit($id){
        $service = subservice::findOrFail($id);
        $allservice = service::all();
        return view('admin.subserviceEdit',compact('service', 'allservice'));
    }
    public function update(Request $request , $id){
        $service = subservice::where('id',$id)->update([
            "name"=> $request->name,
            "service_code"=> $request->service_code,
            "home_amt"=>$request->home_amt,
            "clinic_amt"=>$request->clinic_amt,
            "in_home"=>$request->in_home,
            "out_source"=>$request->out_source,
            "home"=>$request->home,
            "clinic"=>$request->clinic
        ]);
        return redirect()->route('subservice.index')->with("success","SubService updated successfully");
    }
    public function delete($id){
        subservice::where('id',$id)->delete();
        return redirect()->back()->with("success","subservice deleted successfully");
    }
   

}

