@extends('layouts.admin_app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><a onclick="history.back()" class="fa fa-arrow-left text-primary mr-4"></a>Referral Commissions</h4>
                        <form action=""  method="get" class="input-group search-area ml-auto d-inline-flex col-md-3 mr-2">
                            <input type="text" class="form-control" placeholder="Search here" name="search">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text p-0"><i class="flaticon-381-search-2"></i></button>
                            </div>
                        </form>
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
                                        <th><strong>Provider Name</strong></th>
                                        <th><strong>Booking Id</strong></th>
                                        <th><strong> Phone</strong></th>
                                        <th><strong> Total Amount</strong></th>
                                        <th><strong> Deposit Amount</strong></th>
                                        <th><strong> Pending Amount</strong></th>
                                        <th style="min-width:300px;"><strong> Action</strong></th>
                                        {{-- <th><strong> View Slip</strong></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($commissions))
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach ($commissions as $key=>$commission)
                                    @php
                                        $provider_id = isset($commission->provider_id) ? $commission->provider_id : $commission->phone ;
                                    @endphp
                                    <tr>
                                        <td><strong>{{$commissions->firstItem()+$key}}</strong></td>
                                        <td>{{$commission->com->provider_name}}</td>
                                        <td>{{$commission->com->booking_id}}</td>
                                        <td>{{$commission->phone}}</td>
                                        <td>{{$commission->tamount}}</td>
                                        <td>{{$commission->damount}}</td>
                                        <td>{{$commission->amount}}</td>
                                        <td class="d-flex">
                                            <a href="{{route('admin.cutComm',[isset($commission->provider_id) ? "provider_id" :"phone"=>$provider_id])}}" class="btn btn-warning btn-xxs mr-1">Send</a>
                                            <a href="{{route('provider.slip',['phone'=> $commission->phone,'booking_id'=>$commission->com->booking_id])}}" class="btn btn-info btn-xxs mr-1">Statements</a>
                                            <a href="{{route('admin.bookdetail',["id"=>$commission->com->booking_id])}}" class="btn btn-xxs btn-secondary">Booking Details</a>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{$commissions->render('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection