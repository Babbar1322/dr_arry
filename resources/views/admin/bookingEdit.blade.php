@extends('layouts.admin_app')
@section('content')

<style>
	#grad1 {
		background-image: linear-gradient(120deg, #FF4081, #81D4FA);
	}
</style>

<div class="content-body">
	<!-- <div class="container-fluid"  id="grad1"> -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title"><a onclick="history.back()" class="fa fa-arrow-left text-primary mr-4"></a>Edit Booking</h4>
					</div>
					<div class="card-body">
						@if (session('success'))
							<div class="alert alert-success">{{session('success')}}</div>
						@endif
						@if (session('error'))
							<div class="alert alert-danger">{{session('error')}}</div>
						@endif
						<div class="basic-form">
							<form method="POST" action="{{route('admin.bookUpdate',["id"=>$cstmr->id])}}">
								
							@csrf
								<div class="form-row">
									<div class="form-group col-md-4">
										<label class=""> First Name</label>
										<input type="text" name="c_fname" class="form-control" value="{{$cstmr->fname}}" placeholder="Customer First Name">
									</div>
									<div class="form-group col-md-4">
										<label class=""> Mid Name</label>
										<input type="text" name="c_mname" class="form-control" value="{{$cstmr->mname}}" placeholder="Customer Mid Name">
									</div>
									<div class="form-group col-md-4">
										<label class=""> Last  Name</label>
										<input type="text" name="c_lname" class="form-control" value="{{$cstmr->lname}}" placeholder="Customer Last Name">
									</div>
									<div class="form-group col-md-4">
										<label class=""> Age</label>
										<input type="text" name="c_age" class="form-control" value="{{$cstmr->age}}" placeholder="Customer Age">
									</div>
									<div class="form-group col-md-4">
										<label class=""> Gender</label><br>
										  <input type="radio" name="c_gender"  value="male" {{$cstmr->gender == "male"?"checked":""}}> Male
										 <input type="radio" name="c_gender"  value="female" {{$cstmr->gender == "female"?"checked":""}}> Female
									</div>
									<div class="form-group col-md-2">
										<label class=""> Address</label>
										<input type="text" name="c_address" class="form-control" value="{{$cstmr->address}}" placeholder="Customer Address">
									</div>
									<div class="form-group col-md-2">
										<label class=""> Area</label>
										<input type="text" name="c_area" class="form-control" value="{{$cstmr->area}}" placeholder="Customer Address">
									</div>

									<div class="form-group col-md-4">
										<label class=""> City</label>
										<input type="text" name="c_city" class="form-control" value="{{$cstmr->city}}" placeholder="Customer City">
									</div>
									<div class="form-group col-md-4">
										<label class=""> State</label>
										<input type="text" name="c_state" class="form-control" value="{{$cstmr->state}}" placeholder="Customer State">
									</div>
									<div class="form-group col-md-4">
										<label class=""> Zip</label>
										<input type="text" name="c_zip" class="form-control" value="{{$cstmr->pincode}}" placeholder="Customer Zip Code">
									</div>
									<div class="form-group col-md-6">
										<label class=""> Nationality</label>
										<input type="text" name="c_nation" class="form-control" value="{{$cstmr->nationality}}" placeholder="Customer Nationality">
									</div>
									{{-- <div class="form-group col-md-4">
										<label class=""> ReferBy</label>
										<input type="text" name="refer_by" class="form-control" value="{{$booking->referby}}" placeholder="Refer By">
									</div> --}}
									<div class="form-group col-md-6">
										<label class="">Total Amount</label>
										<input type="text" name="total_amount" class="form-control" value="{{$booking->total_amount}}" placeholder="Total amount">
									</div>
									<div class="form-group col-md-4">
										<label class="">Discount Amount</label>
										<input type="text" name="discount_amount" class="form-control" value="{{$booking->discount_amount}}" placeholder="Discount amount">
									</div>
									<div class="form-group col-md-4">
										<label class="">Final Amount</label>
										<input type="text" name="final_amount" class="form-control" value="{{$booking->final_amount}}" placeholder="Final amount">
									</div>
									<div class="form-group col-md-4">
										<label class="">Refer Phone No.</label>
										<input type="text" name="ref_phn" class="form-control" value="{{$booking->refer_phone}}" placeholder="Refer Phone No.">
									</div>
								</div>
								<div class="form-row">
									<!-- <div class="form-group col-md-6">
										<label class="">Password</label>
										<input type="password" name="password" class="form-control" placeholder="Password">
									</div>
									<div class="form-group col-md-6">
										<label class="">Confirm Password</label>
										<input type="password" name="cnfpassword" class="form-control" placeholder="Confirm Password">
									</div> -->

									<button type="submit" class="btn btn-primary btn-block">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
