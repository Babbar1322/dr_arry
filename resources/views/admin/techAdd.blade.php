@extends('layouts.admin_app')
@section('content')


<style>
	#grad1 {
		background-image: linear-gradient(120deg, #FF4081, #81D4FA);
	}
	.f-9{
		font-size: 9px;
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
						<h4 class="card-title"><a onclick="history.back()" class="fa fa-arrow-left text-primary mr-4"></a>Create New Technician</h4>
					</div>
					<div class="card-body">
						@if (session('success'))
						<div class="alert alert-success">{{session('success')}}</div>
						@endif
						@if (session('error'))
						<div class="alert alert-danger">{{session('error')}}</div>
						@endif
						<div class="basic-form">
							<form method="POST" action="{{route('tech.store')}}" enctype="multipart/form-data">
								@csrf
								<div class="form-row">
									<div class="form-group col-md-6">
										{{-- <label class="text-white">Name</label> --}}
										<label>Name</label>
										<input type="text" name="name" class="form-control" placeholder="Enter Name">
										@error('name')
											<div class="text-danger f-9">{{$message}}</div>
										@enderror
									</div>
									<div class="form-group col-md-6">
										{{-- <label class="text-white">Email</label> --}}
										<label>Email</label>
										<input type="text" name="email" class="form-control" placeholder=" Enter Email Address">
										@error('email')
										<div class="text-danger f-9">{{$message}}</div>
										@enderror
									</div>
									<div class="form-group col-md-6">
										{{-- <label class="text-white">Contact No.</label> --}}
										<label>Contact No.</label>
										<input type="text" name="phone" class="form-control" placeholder=" Contact No.">
										@error('phone')
										<div class="text-danger f-9">{{$message}}</div>
										@enderror
									</div>
									<div class="form-group col-md-6">
										{{-- <label class="text-white">Address</label> --}}
										<label >Address</label>
										<input type="text" name="address" class="form-control" placeholder=" Enter Address">
									</div>

									<div class="form-group col-md-4">
										{{-- <label class="text-white">City</label> --}}
										<label>City</label>
										<input type="text" name="city" class="form-control" placeholder=" City">
										@error('city')
											<div class="text-danger f-9">{{$message}}</div>
										@enderror
									</div>
									<div class="form-group col-md-4">
										{{-- <label class="text-white">State</label> --}}
										<label>State</label>
										<input type="text" name="state" class="form-control" placeholder=" State">
									</div>
									<div class="form-group col-md-4">
										{{-- <label class="text-white">Zip</label> --}}
										<label >Zip</label>
										<input type="text" name="zip" class="form-control" placeholder="Zip Code">
										@error('zip')
										<div class="text-danger f-9">{{$message}}</div>
										@enderror
									</div>
								</div>
								
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