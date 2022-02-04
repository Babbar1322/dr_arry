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
						<h4 class="card-title"><a onclick="history.back()" class="fa fa-arrow-left text-primary mr-4"></a>Edit Branch</h4>
					</div>
					<div class="card-body">
						@if (session('success'))
							<div class="alert alert-success">{{session('success')}}</div>
						@endif
						@if (session('error'))
							<div class="alert alert-danger">{{session('error')}}</div>
						@endif
						<div class="basic-form">
							<form method="POST" action="{{route('branch.update')}}">
								<input type="hidden" name="id" value="{{$branch->id}}" />
							@csrf
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="text-white">Branch Name</label>
										<input type="text" name="b_name" class="form-control" value="{{$branch->name}}" placeholder="Branch Name">
									</div>
									<div class="form-group col-md-6">
										<label class="text-white">Head Name</label>
										<input type="text" name="b_head" class="form-control" value="{{$branch->head_name}}" placeholder="Head Name">
									</div>
									<div class="form-group col-md-6">
										<label class="text-white">Branch Email</label>
										<input type="email" name="b_email" class="form-control" value="{{$branch->email}}"  placeholder="Branch Email">
									</div>
									<div class="form-group col-md-6">
										<label class="text-white">Branch Address</label>
										<input type="text" name="b_address" class="form-control" value="{{$branch->branch_address}}" placeholder="Branch Address">
									</div>

									<div class="form-group col-md-6">
										<label class="text-white">City</label>
										<input type="text" name="b_city" class="form-control" value="{{$branch->city}}" placeholder="Branch City">
									</div>
									<div class="form-group col-md-4">
										<label class="text-white">State</label>
										<input type="text" name="b_state" class="form-control" value="{{$branch->state}}" placeholder="Branch State">
									</div>
									<div class="form-group col-md-2">
										<label class="text-white">Zip</label>
										<input type="text" name="b_zip" class="form-control" value="{{$branch->zip}}" placeholder="Zip Code">
									</div>
								</div>
								<div class="form-row">
									<!-- <div class="form-group col-md-6">
										<label class="text-white">Password</label>
										<input type="password" name="password" class="form-control" placeholder="Password">
									</div>
									<div class="form-group col-md-6">
										<label class="text-white">Confirm Password</label>
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