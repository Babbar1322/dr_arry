<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\test;
use App\Models\service;

class TestController extends Controller
{
    public function index(){
        $test = test::orderBy("id","desc")->get();
        return view('admin.Test.testList',compact('test'));
    }
    public function create() {
        $services = service::where("parent", 1)->get();
        return view('admin.Test.testAdd', compact('services'));
    }
    public function store(Request $request){
        $service = test::create([
            "test_name"=> $request->test_name,
            "test_code"=>$request->test_code,
            "test_rate"=>$request->test_rate,
            "service_id"=>$request->service_id,
        ]);
        return redirect()->route('test.index')->with("success","Test created successfully");
    }
    public function edit($id){
        $test = test::findOrFail($id);
        $services = service::where("parent", 1)->get();
        return view('admin.Test.testEdit',compact('test', 'services'));
    }
    public function update(Request $request , $id){
        $service = test::where('id',$id)->update([
            "test_name"=> $request->test_name,
            "test_code"=>$request->test_code,
            "test_rate"=>$request->test_rate,
            "service_id"=>$request->service_id,
        ]);
        return redirect()->route('test.index')->with("success","Test updated successfully");
    }
    public function delete($id){
        test::where('id',$id)->delete();
        return redirect()->back()->with("success","Test deleted successfully");
    }

}
