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
						<h4 class="card-title"><a onclick="history.back()" class="fa fa-arrow-left text-primary mr-4"></a>Create New Services</h4>
					</div>
					<div class="card-body">
						<div class="basic-form">
							<form method="post" action="{{route('service.update',["id"=>$service->id])}}">
								@csrf
								<div class="form-row">
									<div class="form-group col-md-12">
										{{-- <label class="text-white">Service Name</label> --}}
										<label >Service Name</label>
										<input type="text" name="name" class="form-control" placeholder="Service Name" value="{{$service->name}}">
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