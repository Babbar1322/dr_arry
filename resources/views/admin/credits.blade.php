@extends('layouts.admin_app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><a onclick="history.back()" class="fa fa-arrow-left text-primary mr-4"></a>Booking Credits</h4>
                        @if ($totals > 0)
                            <span class="badge badge-pill badge-success ml-auto">Total Credit: {{$totals}}</span>
                        @endif
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
                                        <th><strong>Booking Id</strong></th> 
                                        <th><strong>Credit Amount</strong></th> 
                                        <th><strong> Provider Name</strong></th>
                                        <th><strong> Provider Phone</strong></th>
                                        <th><strong> Action</strong></th>
                                        {{-- <th><strong> View Slip</strong></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($credits))
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach ($credits as $key=>$credit)
                                    @if($credit->amount > 0)
                                    <tr>
                                        <td><strong>{{$credits->firstItem()+$key}}</strong></td>
                                        <td>{{$credit->booking_id}}</td>
                                        <td>{{$credit->amount}}</td>
                                        <td>{{$credit->name}}</td>
                                        <td>{{$credit->phone}}</td>
                                        <td style="min-width: 301px;">
                                            <a href="{{route('admin.creditSend',['id'=>$credit->credit_id])}}" class="btn btn-xxs btn-warning">Update</a>
                                            <a href="{{route('admin.creditDetails',['id'=>$credit->booking_id])}}" class="btn btn-xxs btn-info">Details</a>
                                            <a href="{{route('admin.bookdetail',["id"=>$credit->booking_id])}}" class="btn btn-xxs btn-secondary">Booking Details</a>
                                        </td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                    @endif
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{$credits->render("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection