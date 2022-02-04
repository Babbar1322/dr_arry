@extends('layouts.admin_app')
@section('content')
<style>
    /* .table{
	color: white !important;
}
.bootstrap-select .btn{
    color:white !important;
}
[data-theme-version="dark"] .dropdown-menu .dropdown-item.selected, [data-theme-version="dark"] .dropdown-menu .dropdown-item.selected.active, [data-theme-version="dark"] .dropdown-menu .dropdown-item.active,[data-theme-version="dark"] .bootstrap-select .btn:hover{
    color: white;
}
.dropdown-menu .dropdown-item{
    color: white;
} */
</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="border:none;">
                        <h4 class="card-title"><a onclick="history.back()" class="fa fa-arrow-left text-primary mr-4"></a> All Bookings</h4>
                        <form action=""  method="get" class="input-group search-area ml-auto d-inline-flex col-md-3 mr-2">
                            <input type="text" class="form-control" placeholder="Search here" name="search">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text p-0"><i class="flaticon-381-search-2"></i></button>
                            </div>
                        </form>

                        <a href="{{route('adminpaitentform')}}" class="btn btn-primary" class="ml-auto">Add Booking</a>
                    </div>
                    <div class="card-header">
                        <form class="form-inline" method="get" action="">
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
                                        <th><strong>Name</strong></th>
                                        {{-- <th><strong>Age</strong></th> --}}
                                        {{-- <th><strong>Gender</strong></th> --}}
                                        <th><strong>Membership Id</strong></th>
                                        <th><strong>Phone</strong></th>
                                        {{-- <th><strong>Address</strong></th> --}}
                                        {{-- <th><strong>City</strong></th>
                                        <th><strong>State</strong></th> --}}
                                        {{-- <th><strong>Zip</strong></th> --}}
                                        <th><strong>Status</strong></th>
                                        <th><strong>Update Status</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($bookings))
                                        @foreach ($bookings as $key=>$book)
                                            <tr>
                                                <td>{{ $bookings->firstItem() + $key }}</td>
                                                <td>{{$book->id}}</td>
                                                <td>{{$book->fname." ".$book->lname}}</td>
                                                {{-- <td>{{$book->age}}</td> --}}
                                                {{-- <td>{{$book->gender}}</td> --}}
                                                <td>{{$book->mem_id}}</td>
                                                <td>{{$book->phone}}</td>
                                                {{-- <td>{{$book->address.",".$book->area}}</td> --}}
                                                {{-- <td>{{$book->city}}</td>
                                                <td>{{$book->state}}</td> --}}
                                                {{-- <td>{{$book->pincode}}</td> --}}
                                                <td>{{isset($book->booking->status_remarks) ? $book->booking->status_remarks: ""}}</td>
                                                {{-- <td><div class="basic-form">
                                                    <form>
                                                        <div class="form-row align-items-center">
                                                            <div class="col-auto my-1">
                                                                <select class="mr-sm-2 default-select status"  data-id="{{$book->id}}" >
                                                                    <option selected>Choose...</option>
                                                                    <option value="1">Processing</option>
                                                                    <option value="2">Reject</option>
                                                                    <option value="3">Approve</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div></td> --}}
                                                <td>
                                                    <select  data-id="{{$book->id}}" class="form-control status">
                                                        <option selected>Choose...</option>
                                                        <option value="{{$book->booking->is_active == 0 ? "active" : "deactive"}}" >{{$book->booking->is_active == 0? "DeActive":"Active"}}</option>
                                                        <option value="1">Processing</option>
                                                        <option value="2">Reject</option>
                                                        <option value="3">Approve</option>
                                                    </select>
                                                </td>
                                                <td  class="d-flex">
                                                    <a href="{{route('admin.bookdetail',["id"=>$book->id])}}" class="btn btn-info shadow btn-xs sharp mr-2 mt-2"><i class="fa fa-eye"></i></a>
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
                                                            <a class="dropdown-item" href="{{route('admin.bookedit',["id"=>$book->id])}}">Edit</a>
                                                            {{-- <a class="dropdown-item" href="" onclick="return confirm('Are you sure want to delete')">Delete</a> --}}
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{$bookings->render("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="statusModal">`
        <div class="modal-dialog" role="document">
            <form action="{{route('admin.updateStatus')}}" method="POST">
                @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="status" id="status">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="type" id="type">
                    <div class="form-group">
                        <textarea  rows="4" class="form-control" placeholder="Status Remarks" name="remarks"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(".status").change(function(){
               var id = $(this).data("id");
               var status = $(this).val();

               if(status == 1){
                  var type = "processing";
              }
              else if(status == 2){
                  var type = "rejected";
              }
              else if(status == 3){
                  var type = "approved";
              }
              else if(status == "active"){
                  var type = 1;
                 
              }
              else if(status == "deactive"){
                  var type = 0;
              }
            


               $("#status").val(status);
               $("#id").val(id);
               $("#type").val(type);
                $("#statusModal").modal('show');
            });

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': "{{csrf_token()}}"
            //     }
            // });
            // $(".status").change(function(){
            //    var status = $(this).val();
            //    var id = $(this).data("id");
            //   if(status == 1){
            //       var s_rem = "processing";
            //   }
            //   else if(status == 2){
            //       var s_rem = "rejected";
            //   }
            //   else if(status == 3){
            //       var s_rem = "approved";
            //   }

            //   $.ajax({
            //     url:"{{route('admin.updateStatus')}}",
            //     method:"post",
            //     data:{
            //         id:id,
            //         s_rem:s_rem,
            //         status:status
            //     },
            //     success:function(data){
            //         console.log(data);
            //         if(data == 200){
            //             window.location.reload();
            //         }
            //     }
            //   });
            // });
        });
    </script>
    @endsection