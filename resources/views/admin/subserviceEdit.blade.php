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
						<h4 class="card-title"><a onclick="history.back()" class="fa fa-arrow-left text-primary mr-4"></a>Edit Sub Services</h4>
					</div>
					<div class="card-body">
						<div class="basic-form">
							<form method="post" action="{{route('subservice.update',["id"=>$service->id])}}">
								@csrf
								<div class="row">
								<div class="form-group col-md-12">
									<label class="">Main Service</label>
									<select id="inputState" name="sid" class="form-control default-select">
										<option selected>Choose...</option>
										@if(!empty($allservice))
										@foreach($allservice as $s)
										 <option value="{{$s->id}}" {{$service->service_id == $s->id ? "selected" : ''}}> {{$s->name}} </option>
										@endforeach
										@endif
									</select>
								</div>

								<div class="form-group col-md-6">
									<label class="">Service Name</label>
									<input type="text" name="name" class="form-control" value="{{$service->name}}" placeholder="Service Name">
								</div>
								<div class="form-group col-md-6">
									<label class="">Service Code</label>
									<input type="text" name="service_code" class="form-control" value="{{$service->service_code}}" placeholder="Service Code">
								</div>
								<div class="form-group col-md-6">
										<label class="">Home Amount</label>
										<input type="text" name="home_amt" class="form-control" placeholder="Home Amount" value="{{$service->home_amt}}">
								</div>
								<div class="form-group col-md-6">
									<label class="">Clinic Amount</label>
									<input type="text" name="clinic_amt" class="form-control" placeholder="Clinic Amount" value="{{$service->clinic_amt}}">
								</div>
								<div class="form-group col-md-3">
									<input type="checkbox" name="in_home"  value="In Home" checked>
									<label>In Home</label>
								</div>
								<div class="form-group col-md-3">
									<input type="checkbox" name="out_source"  value="Out Source" checked> 
									<label>Out Source</label> 
								</div>
								<div class="form-group col-md-3">
									<input type="checkbox" name="home"  value="Home" checked>
									<label>Home</label>
								</div>
								<div class="form-group col-md-3">
									<input type="checkbox" name="clinic" value="Clinic" checked>
									<label>Clinic</label>
								</div>
								</div>
								<div class="form-row">
									<button type="submit" class="btn btn-primary btn-block">Save</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection