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
						<h4 class="card-title"><a onclick="history.back()" class="fa fa-arrow-left text-primary mr-4"></a>Edit Provider</h4>
					</div>
					<div class="card-body">
						@if (session('success'))
						<div class="alert alert-success">{{session('success')}}</div>
						@endif
						@if (session('error'))
						<div class="alert alert-danger">{{session('error')}}</div>
						@endif
						<div class="basic-form">
							<form method="POST" action="{{route('provider.update',["id"=>$provider->id])}}" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="{{$provider->id}}" />
								@csrf
								<div class="form-row">
									<div class="form-group col-md-6">
										{{-- <label class="text-white">Name</label> --}}
										<label >Name</label>
										<input type="text" name="name" class="form-control" value="{{$provider->name}}" placeholder="Enter Name">
									</div>
									<div class="form-group col-md-6">
										{{-- <label class="text-white">Email</label> --}}
										<label >Email</label>
										<input type="text" name="email" class="form-control" value="{{$provider->email}}" placeholder=" Enter Email Address">
									</div>
									<div class="form-group col-md-6">
										{{-- <label class="text-white">Contact No.</label> --}}
										<label >Contact No.</label>
										<input type="text" name="phone" class="form-control" value="{{$provider->phone}}" placeholder=" Contact No.">
									</div>
									<div class="form-group col-md-6">
										{{-- <label class="text-white">Address</label> --}}
										<label >Address</label>
										<input type="text" name="address" class="form-control" value="{{$provider->address}}" placeholder=" Enter Address">
									</div>

									<div class="form-group col-md-4">
										{{-- <label class="text-white">City</label> --}}
										<label >City</label>
										<input type="text" name="city" class="form-control" value="{{$provider->city}}" placeholder=" City">
									</div>
									<div class="form-group col-md-4">
										{{-- <label class="text-white">State</label> --}}
										<label >State</label>
										<input type="text" name="state" class="form-control" value="{{$provider->state}}" placeholder=" State">
									</div>
									<div class="form-group col-md-4">
										<label >Zip</label>
										<input type="text" name="zip" class="form-control" value="{{$provider->zip}}" placeholder="Zip Code">
									</div>
									<div class="form-group col-md-6">
										{{-- <label class="text-white">Zip</label> --}}
										<label>Bank Name</label>
										<input type="text" name="bank_name" class="form-control" value="{{$provider->bank_name}}" placeholder="Bank Name">
									</div>
									<div class="form-group col-md-6">
										<label >Account No.</label>
										<input type="text" name="acc_no" class="form-control" value="{{$provider->account_no}}" placeholder="Account Number">
									</div>
									<div class="form-group col-md-6">
										<label>IFSC Code</label>
										<input type="text" name="ifsc_code" class="form-control"  value="{{$provider->ifsc_code}}" placeholder="IFSC Code">
									</div>
									<div class="form-group col-md-6">
										<label >Recipient Name</label>
										<input type="text" name="recipient_name" class="form-control"  value="{{$provider->recipient_name}}" placeholder="Recipient Name">
									</div>
								</div>
								{{-- <div class="form-group">
									<label>Type</label>
									<div class="dropdown bootstrap-select show-tick form-control default-select">
										<select  name="type" class="form-control default-select" id="sel2" tabindex="-98">
											<option value="provider" {{$provider->type!=null && $provider->type == 'provider'?'selected':''}}>Provider</option>
											<option value="technician" {{$provider->type!=null && $provider->type == 'technician'?'selected':''}}>Technician</option>
										</select>
									</div>
								</div> --}}
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