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
						<h4 class="card-title"><a onclick="history.back()" class="fa fa-arrow-left text-primary mr-4"></a>Create New Branch</h4>
					</div>
					<div class="card-body">
						@if (session('success'))
							<div class="alert alert-success">{{session('success')}}</div>
						@endif
						@if (session('error'))
							<div class="alert alert-danger">{{session('error')}}</div>
						@endif
						<div class="basic-form">
							<form method="POST" action="{{route('branch.store')}}">
							@csrf
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="">Branch Name</label>
										<input type="text" name="b_name" class="form-control" placeholder="Branch Name">
											@error('b_name')
												<div class="text-danger f-9">{{$message}}</div>
											@enderror
									</div>
									<div class="form-group col-md-6">
										<label class="">Head Name</label>
										<input type="text" name="b_head" class="form-control" placeholder="Head Name">
									</div>
									<div class="form-group col-md-6">
										<label class="">Branch Email</label>
										<input type="email" name="b_email" class="form-control" placeholder="Branch Email">
										@error('b_email')
										<div class="text-danger f-9">{{$message}}</div>
										@enderror
									</div>
									<div class="form-group col-md-6">
										<label class="">Branch Address</label>
										<input type="text" name="b_address" class="form-control" placeholder="Branch Address">
										@error('b_address')
										<div class="text-danger f-9">{{$message}}</div>
										@enderror
									</div>

									<div class="form-group col-md-6">
										<label class="">City</label>
										<input type="text" name="b_city" class="form-control" placeholder="Branch City">
										@error('b_city')
										<div class="text-danger f-9">{{$message}}</div>
										@enderror
									</div>
									<div class="form-group col-md-4">
										<label class="">State</label>
										<input type="text" name="b_state" class="form-control" placeholder="Branch State">
										@error('b_state')
										<div class="text-danger f-9">{{$message}}</div>
										@enderror
									</div>
									<div class="form-group col-md-2">
										<label class="">Zip</label>
										<input type="text" name="b_zip" class="form-control" placeholder="Zip Code">
										@error('b_zip')
										<div class="text-danger f-9">{{$message}}</div>
										@enderror
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="">Password</label>
										<input type="password" name="password" class="form-control" placeholder="Password">
											@error('password')
												<div class="text-danger f-9">{{$message}}</div>
											@enderror
									</div>
									<div class="form-group col-md-6">
										<label class="">Confirm Password</label>
										<input type="password" name="cnfpassword" class="form-control" placeholder="Confirm Password">
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