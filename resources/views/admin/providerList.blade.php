@extends('layouts.admin_app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><a onclick="history.back()" class="fa fa-arrow-left text-primary mr-4"></a>All Providers</h4>
                        <form action=""  method="get" class="input-group search-area ml-auto d-inline-flex col-md-3 mr-2">
                            <input type="text" class="form-control" placeholder="Search here" name="search">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text p-0"><i class="flaticon-381-search-2"></i></button>
                            </div>
                        </form>
                        <a href="{{route('provider.create')}}" class="btn btn-primary" class="ml-auto">Add Provider</a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th style="width:80px;"><strong>#</strong></th>
                                        <th><strong>Name</strong></th>
                                        <th><strong>Email</strong></th>
                                        <th><strong>Phone</strong></th>
                                        {{-- <th><strong>Address</strong></th> --}}
                                        <th><strong>City</strong></th>
                                        {{-- <th><strong>State</strong></th>
                                        <th><strong>Zip</strong></th> --}}
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($provider))
                                    @foreach($provider as $p)
                                    <tr>
                                        <td>{{$p->id}}</td>
                                        <td>{{$p->name}}</td>
                                        <td>{{$p->email}}</td>
                                        <td>{{$p->phone}}</td>
                                        {{-- <td>{{$p->address}}</td> --}}
                                        <td>{{$p->city}}</td>
                                        {{-- <td>{{$p->state}}</td>
                                        <td>{{$p->zip}}</td> --}}
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
                                                    <a class="dropdown-item" href="{{route('provider.edit',["id"=>$p->id])}}" >Edit</a>
                                                    <a class="dropdown-item" href="{{route('provider.delete',["id"=>$p->id])}}" onclick="return confirm('Are you sure want to delete')">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{route('provider.slip',["phone"=>$p->phone])}}" class="btn btn-info shadow btn-xxs">Commission</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    
                                </tbody>
                            </table>
                        </div>
                        {{$provider->render("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection