<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class BranchController extends Controller
{
    public function store(Request $request){
        $rule = [
            "b_name"=>"required",
            "b_email"=>"required",
            "b_address"=>"required",
            "b_city"=>"required", 
            "b_state"=>"required",  
            "b_zip"=>"required",  
            "password"=>["required","cnfpassword"],  
        ];
        $msg = [
            "b_name.required"=> "Branch name is required",
            "b_email.required"=> "Branch Email is required",
            "b_address.required"=> "Branch Address is required",
            "b_city.required"=> "Branch city is required",
            "b_state.required"=> "Branch state is required",
            "b_zip.required"=> "Branch Pincode is required",
        ];
        $this->validate($request,$rule,$msg);


        if($request->password == $request->cnfpassword){
            User::create([
                "name"=> $request->b_name,
                "email"=> $request->b_email,
                "head_name" => $request->b_head,
                "branch_address"=> $request->b_address,
                "city"=> $request->b_city,
                "state" => $request->b_state,
                "zip"=> $request->b_zip,
                "password"=> Hash::make($request->password),
                "show_pass"=> $request->password,
                "is_admin"=>2
            ]);
            return redirect()->back()->with("success","New Branch created successfully");
        }
        else{
            return redirect()->back()->with("error","password not match");
        }
    }

    public function list(Request $request){
        $branch = User::where('is_admin',2)->paginate();
        if(!empty($request->search)){
            $branch = User::where('is_admin',2)->where(function($q) use($request) { $q->where("name","like","%".$request->search."%")->orWhere("email","like","%".$request->search."%");})->paginate();
            $branch->appends(["search"=>$request->search]);
        }
        return view('admin.branchList',compact('branch'));
    }
    public function editBranch(Request $request, $id){

        $branch = User::findOrFail($id);
        return view('admin.branchEdit',compact('branch'));
    }
    public function edit(Request $request){

        $branch = User::findOrFail($request->id);
        $branch->name = $request->b_name;
        $branch->email = $request->b_email;
        $branch->head_name = $request->b_head;
        $branch->branch_address = $request->b_address;
        $branch->city = $request->b_city;
        $branch->state  = $request->b_state;
        $branch->zip = $request->b_zip;
        $branch->save();
        return redirect()->back()->with("success","Branch Update Successfully");
    }

    public function delete($id){
        User::where("id",$id)->delete();
        return redirect()->back()->with("success","Branch Deleted Successfully");
    }
}
