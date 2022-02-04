@extends('layouts.admin_app')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header" style="border:none">
                            <h4 class="card-title"><a onclick="history.back()" class="fa fa-arrow-left text-primary mr-4"></a>Name:{{isset($technician->name)?$technician->name:$tech->tech_name}}</h4>
                            <span class="badge badge-pill badge-success ml-auto">Total Commission: {{$total}}</span>

                        </div>
                        <div class="card-header">
                            <form class="form-inline" method="get" action="">
                                <input type="hidden" value="{{isset(Request()->phone)?Request()->phone : ""}}" name="phone">
                                <div class="mr-2">
                                  <label >From Date:</label>
                                  <input type="date" class="form-control" name="from_date" value="{{Carbon\Carbon::now()->toDateString()}}">
                                </div>
                                <div >
                                  <label >To Date:</label>
                                  <input type="date" class="form-control" name="to_date" value="{{Carbon\Carbon::now()->addDays(1)->toDateString()}}">
                                </div>
                                <button type="submit" class="btn btn-success mt-3 ml-2">Search</button>
                              </form>
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
   
                                    <tr>
                                        <th>No.</th>
                                        {{-- <th>Technician Name</th> --}}
                                        <th>Pending Amount</th>
                                        <th>Deposit Amount</th>
                                        <th>Total Amount</th>
                                        <th>Date</th>
                                    </tr>  
                                    @if (!empty($commissions))
                                    @php
                                        $pamount = 0;
                                        $i =1;
                                    @endphp 
                                    @foreach($commissions as $com)
                                        @if($com->status == 0)
                                            @php
                                                $amount = preg_replace('/[^0-9.]+/', '', $com->amount);
                                                $pamount += $amount;
                                            @endphp
                                            @else
                                            @php
                                                $amount = preg_replace('/[^0-9.]+/', '', $com->amount);
                                                $pamount -=  $amount;
                                            @endphp
                                        @endif  
                                    <tr>
                                        <td>{{$i}}</td>
                                        {{-- <td>{{isset($com->tech->name) ? $com->tech->name : ""}}</td> --}}
                                        <td>{{$pamount}}</td>
                                        <td>{{$com->status == 1 ? $amount : 0}}</td>
                                        <td>{{$com->status == 0 ? $amount : 0}}</td>
                                        <td>{{$com->created_at}}</td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                    @endforeach
                                    @endif
                             </table>
                        </div>
                        {{$commissions->render("pagination::bootstrap-4") }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Services</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($booked_services))
                                        @foreach ($booked_services->unique('services') as $service)
                                        <tr>
                                            <td>{{$service->services->name}}</td>
                                        </tr>
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
    </div>
<script>
     $(document).ready(function(){
        $('#print_page').click(function(){
            $(this).hide();
             window.print();
        });
     });
</script>
@endsection