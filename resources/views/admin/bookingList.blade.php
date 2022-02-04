@extends('layouts.admin_app')
@section('content')
<style>
    /* li , strong{
        color:white;
    } */
</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="form-head d-flex mb-3 mb-md-5 align-items-start">
            <div class="mr-auto d-none d-lg-block">
                <h3 class="text-primary font-w600">Booking List</h3>
            </div>
        </div>
        <div class="row">
            <!-- <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12"> -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        
                        <h4 class="card-title"><a onclick="history.back()" class="fa fa-arrow-left text-primary mr-4"></a> Customer Details</h4>

                    </div>
                    <div class="card-body pb-0">
                        <div class="recovered-chart-deta d-flex">
                            @if (!empty($cstmrs))
                            @foreach($cstmrs as $cstm)
                            @isset($cstm->booking->referby)
                            @php
                                $provider = \App\Models\provider::where("id",$cstm->booking->referby)->first();
                                $provider = $provider->name;
                                @endphp
                            @else
                                 @php
                                     $provider = "";
                                 @endphp
                            @endisset
                            <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <p>Name:
                                        <span><strong>{{$cstm->fname." ".$cstm->lname}}</strong></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <p>Email:
                                        <span><strong>{{$cstm->email}}</strong></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <p>Phone:
                                        <span><strong>{{$cstm->phone}}</strong></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <p>Date Of Birth:
                                        <span><strong>{{$cstm->dob}}</strong></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <p>Address:
                                        <span><strong>{{$cstm->address.', '.$cstm->area}}</strong></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <p>City:
                                        <span><strong>{{$cstm->city}}</strong></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <p>State:
                                        <span><strong>{{$cstm->state}}</strong></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <p>Pincode:
                                        <span><strong>{{$cstm->pincode}}</strong></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <p>Gender:
                                        <span><strong>{{$cstm->gender}}</strong></span>
                                    </p>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div>
                                    <p>Nationality:
                                        <span><strong>{{$cstm->nationality}}</strong></span>
                                    </p>
                                </div>
                            </div> --}}
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                </div>
            </div>
            

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <h4 class="card-title">Customer Service Details</h4>
                    </div>
                    <div class="card-body pb-0">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Subservice Name</th>
                                        <th>Source Type</th>
                                        <th>Shop Source Type</th>
                                        <th>Amount</th>
                                        <th>Appointment Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($bservices))
                                    @foreach($bservices as $bser)
                                    @for ($i =0; $i <count($bser);$i++)
                                        @isset($bser[$i]->ser_amount)
                                            @php
                                                $ser_amnt = $bser[$i]->ser_amount;
                                            @endphp
                                            @else
                                            @php
                                                $ser_amnt = $bser[$i]->total_amount;
                                            @endphp
                                        @endisset
                                        @php
                                            $dis = $bser[$i]->discount_amount;
                                            $amnt = $ser_amnt -($dis * $ser_amnt/100);
                                        @endphp
                                    <tr>
                                        <td>{{$bser[$i]->service->name}}</td>
                                        <td>{{$bser[$i]->subservice->name}}</td>
                                        <td>{{$bser[$i]->source_type}}</td>
                                        <td>{{$bser[$i]->type}}</td>
                                        <td>{{isset($bser[$i]->ser_amount)?$bser[$i]->ser_amount:$bser[$i]->total_amount}}</td>
                                        <td>{{$bser[$i]->appointment_time}}</td>
                                    </tr>
                                    @endfor
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <h5 class="card-title">Provider Details</h5>
                        {{-- <a href="{{route('provider.slip',["id"=>$id])}}" class="btn btn-info shadow btn-xs sharp mr-2 mt-2"><i class="fa fa-eye"></i></a> --}}

                    </div>
                    <div class="card-body pb-0">
                        <div class="recovered-chart-deta d-flex">
                            @if (!empty($cstmrs))
                            @foreach($cstmrs as $cstm)
                            @isset($cstm->booking->referby)
                            @php
                                $provider = \App\Models\provider::where("id",$cstm->booking->referby)->first();
                                $provider = $provider->name;
                                @endphp
                            @else
                                 @php
                                     $provider = "";
                                 @endphp
                            @endisset
                            <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <p>Name:
                                        <span><strong>{{$provider==null?$cstm->booking->referby_name:$provider}}</strong></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <p>Phone:
                                        <span><strong>{{$cstm->booking->refer_phone}}</strong></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <p>Commission:
                                        <span><strong>{{$cstm->booking->referral_comm}}</strong></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <p>Remarks:
                                        <span><strong>{{$cstm->booking->refer_remarks}}</strong></span>
                                    </p>
                                </div>
                            </div>
                            
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <h5 class="card-title"> Technician Details</h5>
                    </div>
                    <div class="card-body pb-0">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Commission</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($tech_com))
                                    @foreach($tech_com as $com)
                                        <tr>
                                            <td>{{$com->tech_name}}</td>
                                            <td>{{$com->phone}}</td>
                                            <td>{{$com->amount}}</td>
                                            <td>{{$com->remarks}}</td>
                                        </tr>       
                                        @endforeach
                                        @endif
                                </tbody>
                            </table>
                        </div>
                        </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <h5 class="card-title"> Credit Details</h5>
                        <div class="badge badge-primary">Cash Accepted:  {{$cash->cash_amount}}</div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th style="width:80px;"><strong>#</strong></th>
                                        <th><strong>Booking Id</strong></th> 
                                        <th><strong>Cash Amount</strong></th> 
                                        <th><strong>Credit Amount</strong></th> 
                                        <th><strong> Provider Name</strong></th>
                                        <th><strong> Provider Phone</strong></th>
                                        <th><strong> Date</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($credits))
                                    @php
                                        $i=1;
                                        $pamount =0;
                                    @endphp
                                    @foreach ($credits as $key=>$credit)
                                        @if($credit->status == 0)
                                            @php
                                                $pamount +=  $credit->amount;
                                            @endphp
                                            @else
                                            @php
                                                $pamount -=  $credit->amount;
                                            @endphp
                                        @endif
                                    <tr>
                                        <td><strong>{{$i}}</strong></td>
                                        <td>{{$credit->booking_id}}</td>
                                        <td>{{$credit->status == 1?$credit->amount:0}}</td>
                                        <td>{{$pamount}}</td>
                                        <td>{{$credit->name}}</td>
                                        <td>{{$credit->phone}}</td>
                                        <td>{{$credit->created_at}}</td>
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

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <h5 class="card-title"> Status Details</h5>
                    </div>
                    <div class="card-body pb-0">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                            <tr>
                                <th>Status</th>
                                <th>Remarks</th>
                            </tr>
                            @if (!empty($remarks))
                            @foreach ($remarks as $remark)
                            <tr>
                                <td>{{$remark->type}}</td>
                                <td>{{$remark->remarks}}</td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                        </div>
                </div>
                </div>
            </div>
           

            


        </div>
        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Booking List</h4>
                    </div>
                    <div class="card-body">
                        <div class="container">
                           <div class="row">
                               <div class="col-md-6">
                                   @if (!empty($cstmrs))
                                   @foreach($cstmrs as $cstm)
                                   @isset($cstm->booking->referby)
                                   @php
                                       $provider = \App\Models\provider::where("id",$cstm->booking->referby)->first();
                                       $provider = $provider->name;
                                       @endphp
                                   @else
                                        @php
                                            $provider = "";
                                        @endphp
                                   @endisset
                                   <ul>
                                       <li><strong>Customer Name: </strong>{{$cstm->fname." ".$cstm->lname}}</li>
                                       <li><strong>Customer Email: </strong>{{$cstm->email}}</li>
                                       <li><strong>Customer Phone: </strong>{{$cstm->phone}}</li>
                                       <li><strong>Customer Age: </strong>{{$cstm->age}}</li>
                                       <li><strong>Customer Date Of Birth: </strong>{{$cstm->dob}}</li>
                                       <li><strong>Customer Address: </strong>{{$cstm->address.', '.$cstm->area}}</li>
                                       <li><strong>Customer City: </strong>{{$cstm->city}}</li>
                                       <li><strong>Customer State: </strong>{{$cstm->state}}</li>
                                       <li><strong>Customer PinCode: </strong>{{$cstm->pincode}}</li>
                                       <li><strong>Customer Gender: </strong>{{$cstm->gender}}</li>
                                       <li><strong>Customer Nationality: </strong>{{$cstm->nationality}}</li>
                                       <li><strong>Customer Refer By: </strong>{{$provider}}</li>
                                       <li><strong>Customer Total Amount: </strong>{{$cstm->booking->total_amount}}</li>
                                       <li><strong>Customer Discount Amount: </strong>{{$cstm->booking->discount_amount}}</li>
                                       <li><strong>Customer Final Amount: </strong>{{$cstm->booking->final_amount}}</li>
                                       <li><strong>Customer Refer Phone No. : </strong>{{$cstm->booking->refer_phone}}</li>
                                       <li><strong>Customer Refer Remarks: </strong>{{$cstm->booking->refer_remarks}}</li>
                                       <li><strong>Customer Refer Commission: </strong>{{$cstm->booking->referral_comm}}</li>
                                    </ul>
                                    @endforeach
                                    @endif
                               </div>
                               <div class="col-md-6">
                                   @if(!empty($bservices))
                                  
                                   @foreach($bservices as $bser)
                                        @for ($i =0; $i <count($bser);$i++)
                                        <ul>
                                            <li><strong>Customer Service Name:</strong>{{$bser[$i]->service->name}}</li>
                                            <li><strong>Customer SubService Name:</strong>{{$bser[$i]->subservice->name}}</li>
                                            <li><strong>Customer Source Type:</strong>{{$bser[$i]->source_type}}</li>
                                            <li><strong>Customer Shop Source Type:</strong>{{$bser[$i]->type}}</li>
                                            <li><strong>Appointment Time:</strong>{{$bser[$i]->appointment_time}}</li>
                                            <li><strong>Amount:</strong>{{$bser[$i]->amount}}</li>
                                        </ul><br>
                                        @endfor
                                @endforeach
                                   @endif
                               </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection