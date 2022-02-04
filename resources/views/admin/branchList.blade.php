@extends('layouts.admin_app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><a onclick="history.back()" class="fa fa-arrow-left text-primary mr-4"></a>All Branchs</h4>
                        <form action=""  method="get" class="input-group search-area ml-auto d-inline-flex col-md-3 mr-2">
                            <input type="text" class="form-control" placeholder="Search here" name="search">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text p-0"><i class="flaticon-381-search-2"></i></button>
                            </div>
                        </form>
                        <a href="{{route('adminBranchPage')}}" class="btn btn-primary" class="ml-auto">Add Branch</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
							<div class="alert alert-success">{{session('success')}}</div>
						@endif
						@if (session('error'))
							<div class="alert alert-danger">{{session('error')}}</div>
						@endif
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th style="width:80px;"><strong>#</strong></th>
                                        <th><strong>Name</strong></th>
                                        <th><strong> Email</strong></th>
                                        <th><strong> Head</strong></th>
                                        <th><strong> Address</strong></th>
                                        <th><strong> City</strong></th>
                                        <th><strong> State</strong></th>
                                        <th><strong> Zip</strong></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($branch))
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach ($branch as $brnch)
                                    <tr>
                                        {{-- <td><strong>{{$brnch->id}}</strong></td> --}}
                                        <td><strong>{{$i}}</strong></td>
                                        <td>{{$brnch->name}}</td>
                                        <td>{{$brnch->email}}</td>
                                        <td>{{$brnch->head_name}}</td>
                                        <td>{{$brnch->branch_address}}</td>
                                        <td>{{$brnch->city}}</td>
                                        <td>{{$brnch->state}}</td>
                                        <td>{{$brnch->zip}}</td>
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
                                                    <a class="dropdown-item" href="{{route('branch.Edit',["id"=>$brnch->id])}}">Edit</a>
                                                    <a class="dropdown-item" href="{{route('branch.delete',["id"=>$brnch->id])}}" onclick="return confirm('Are you sure want to delete')">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{$branch->render("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection