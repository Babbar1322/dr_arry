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
						<h4 class="card-title">Create New Test</h4>
						<a href="{{route('test.index')}}" class="btn btn-primary" /> Test List</a>
					</div>
					<div class="card-body">
						<div class="basic-form">
							<form method="post" action="{{route('test.store')}}">
								@csrf
								<div class="form-row">
								<div class="form-group col-md-12">
									<label class="text-white">Select Service</label>
									<select id="inputState" name="service_id" class="form-control default-select">
										<option selected>Choose Service...</option>
										@if(!empty($services))
										@foreach($services as $service)
										<option value="{{$service->id}}"> {{$service->name}} </option>
										@endforeach
										@endif
									</select>
								</div>
									<div class="form-group col-md-12">
										<label class="text-white">Test Name</label>
										<input type="text" name="test_name" class="form-control" placeholder="Test Name">
									</div>
									<div class="form-group col-md-12">
										<label class="text-white">Test Code</label>
										<input type="text" name="test_code" class="form-control" placeholder="Test Code">
									</div>
									<div class="form-group col-md-12">
										<label class="text-white">Test Amount</label>
										<input type="text" name="test_rate" class="form-control" placeholder="Test Amount">
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