<?php

namespace App\Http\Controllers;

use App\Models\provider;
use Illuminate\Http\Request;
use App\Models\service;
use App\Models\subservice;
use App\Models\provider_record;

class ServiceController extends Controller
{

    public function index(Request $request)
    {
        $services = service::orderBy("id", "desc")->paginate();

        if(!empty($request->search)){
            $services = service::where("name",'like',"%".$request->search."%")->paginate();
            $services->appends(["search"=>$request->search]);
        }
        return view('admin.serviceList', compact('services'));
    }
    public function create()
    {
        return view('admin.serviceAdd');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            "name"=>"required"
        ]);
        
        $service = service::create([
            "name" => $request->name,
        ]);
        return redirect()->route('service.index')->with("success", "service created successfully");
    }
    public function edit($id)
    {
        $service = service::findOrFail($id);
        return view('admin.serviceEdit', compact('service'));
    }
    public function update(Request $request, $id)
    {
        $service = service::where('id', $id)->update([
            "name" => $request->name,
        ]);
        return redirect()->route('service.index')->with("success", "services updated successfully");
    }
    public function delete($id)
    {
        $service = subservice::where("service_id", $id)->first();
        if ($service) {
            return redirect()->back()->with("error", "Please Delete subservice for this service First!");
        } else {
            service::where('id', $id)->delete();
            return redirect()->back()->with("success", "service deleted successfully");
        }
    }

    public function getsubservice(Request $request)
    {
        $service = subservice::where('service_id', $request->service)->get();
        
        $provider =  provider_record::where("service_id", $request->service)->get()->map(function ($a) {
            $provide = provider::where('id', $a->provider_id)->first();
            if($provide){
                $a->name = $provide->name;
                $a->provideid = $provide->id;
            }
            return $a;
        });

        return response()->json(["status" => 1, "data" => $service, "provider" =>$provider, "mainservice"=>$request->service]);
    }
}
