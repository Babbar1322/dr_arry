<?php

namespace App\Http\Controllers;

use App\Models\ar_technician;
use Illuminate\Http\Request;

class ArTechnicianController extends Controller
{
    public function index(Request $request){
        $techs = ar_technician::orderBy("id","desc")->paginate();
        if(!empty($request->search)){
        $techs = ar_technician::where("name","like","%".$request->search."%")->orWhere("email","like","%".$request->search."%")->orWhere("phone","like","%".$request->search."%")->orderBy("id","desc")->paginate();
        $techs->appends(["search"=>$request->search]);
        }
        if(!empty($request->tech)){
            return response($techs);
        }
        return view('admin.techs', compact('techs'));
    }
    public function create(){
        return view('admin.techAdd');
    }
    public function store(Request $request){
        $this->validate($request,[
            "name"=>"required",
            "email"=>"required",
            "phone"=>"required",
            "city"=>"required",
            "state"=>"required",
            "zip"=>"required",
        ]);

        $provide = ar_technician::create([
            "name"=> $request->name,
            "email"=> $request->email,
            "phone"=> $request->phone,
            "address"=> $request->address,
            "city"=> $request->city,
            "state"=> $request->state,
            "zip"=> $request->zip,
        ]);

        return redirect()->route('tech.index')->with("success","Techincian Created Successfully");
    }
    public function edit($id){
        $tech = ar_technician::findOrFail($id);
        return view('admin.techEdit', compact('tech'));
    }
    public function update(Request $request,$id){
         ar_technician::where('id',$id)->update([
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
        return redirect()->route('tech.index')->with("success","Technician updated successfully");
    }
    public function delete($id){
        ar_technician::where('id',$id)->delete();
        return redirect()->back()->with("success","Technician deleted successfully");
    }

}
