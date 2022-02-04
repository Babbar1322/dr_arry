@extends('layouts.admin_app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <!-- <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, welcome back!</h4>
                    <p class="mb-0">Your business dashboard template</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Bootstrap</a></li>
                </ol>
            </div>
        </div> -->
        <!-- row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><a onclick="history.back()" class="fa fa-arrow-left text-primary mr-4"></a>All Sub Services</h4>
                        <form action=""  method="get" class="input-group search-area ml-auto d-inline-flex col-md-3 mr-2">
                            <input type="text" class="form-control" placeholder="Search here" name="search">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text p-0"><i class="flaticon-381-search-2"></i></button>
                            </div>
                        </form>
                        <a href="{{route('subservice.create')}}" class="btn btn-primary" class="ml-auto">Add Subservice</a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th style="width:80px;"><strong>#</strong></th>
                                        <th><strong>Service Name</strong></th>
                                        <th><strong>Home Amount</strong></th>
                                        <th><strong>Clinic Amount</strong></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($services))
                                  
                                    @foreach ($services as $key=>$service)
                                    <tr>
                                        <td><strong>{{$services->firstItem() + $key}}</strong></td>
                                        <td>{{$service->name}}</td>
                                        <td>{{$service->home_amt}}</td>
                                        <td>{{$service->clinic_amt}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <circle fill="#000000" cx="5" cy="12" r="2" />
                                                            <circle fill="#000000" cx="12" cy="12" r="2" />
                                                            <circle fill="#000000" cx="19" cy="12" r="2" />
                                                        </g>
                                                    </svg>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{route('subservice.edit',["id"=>$service->id])}}" >Edit</a>
                                                    <a class="dropdown-item" href="{{route('subservice.delete',["id"=>$service->id])}}" onclick="return confirm('Are you sure want to delete')">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    {{-- <tr>
                                        <td><strong>2</strong></td>
                                        <td>X-Ray at Home</td>
                                        
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <circle fill="#000000" cx="5" cy="12" r="2" />
                                                            <circle fill="#000000" cx="12" cy="12" r="2" />
                                                            <circle fill="#000000" cx="19" cy="12" r="2" />
                                                        </g>
                                                    </svg>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr> --}}
                                  
                                    
                                </tbody>
                            </table>
                        </div>
                        {{$services->render("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection