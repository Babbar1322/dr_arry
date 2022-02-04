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
						<h4 class="card-title"><a onclick="history.back()" class="fa fa-arrow-left text-primary mr-4"></a>Send Technician Commission</h4>
					</div>
					<div class="card-body">
						@if (session('success'))
							<div class="alert alert-success">{{session('success')}}</div>
						@endif
						@if (session('error'))
							<div class="alert alert-danger">{{session('error')}}</div>
						@endif
						<div class="basic-form">
							<form method="POST" action="{{route('admin.sendTechComm')}}">
							@csrf
							<input type="hidden"  name="tech_id" value="{{$tech!=""?$tech->tech_id:""}}">
							<input type="hidden"  name="phone" value="{{$tech!=""?$tech->phone:Request()->phone}}">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class=""> Amount</label>
										<input type="text" name="amount" class="form-control"  placeholder="Enter Amount">
									</div>
								</div>
								<div class="form-row">
									<button type="submit" class="btn btn-primary btn-block">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
