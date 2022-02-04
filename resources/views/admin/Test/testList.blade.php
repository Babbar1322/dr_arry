@extends('layouts.admin_app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Test List</h4>
                        <a href="{{route('test.create')}}" class="btn btn-primary" />Add New Test</a>
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
                                        <th><strong> Name</strong></th>
                                        <th><strong> Code</strong></th>
                                        <th><strong> Amount</strong></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($test))
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach ($test as $brnch)
                                    <tr>
                                        <td><strong>{{$i}}</strong></td>
                                        <td>{{$brnch->test_name}}</td>
                                        <td>{{$brnch->test_code}}</td>
                                        <td>{{$brnch->test_rate}}</td>
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
                                                    <a class="dropdown-item" href="{{route('test.edit',["id"=>$brnch->id])}}">Edit</a>
                                                    <a class="dropdown-item" href="{{route('test.delete',["id"=>$brnch->id])}}" onclick="return confirm('Are you sure want to delete')">Delete</a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection