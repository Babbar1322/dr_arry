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
						<h4 class="card-title"><a onclick="history.back()" class="fa fa-arrow-left text-primary mr-4"></a>Create New Provider</h4>
					</div>
					<div class="card-body">
						@if (session('success'))
						<div class="alert alert-success">{{session('success')}}</div>
						@endif
						@if (session('error'))
						<div class="alert alert-danger">{{session('error')}}</div>
						@endif
						<div class="basic-form">
							<form method="POST" action="{{route('provider.store')}}" enctype="multipart/form-data">
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
								{{-- <div class="form-group">
									<label>Type</label>
									<div class="dropdown bootstrap-select show-tick form-control default-select">
										<select  name="type" class="form-control default-select" id="sel2" tabindex="-98">
											<option value="provider">Provider</option>
											<option value="technician">Technician</option>
										</select>
									</div>
								</div> --}}
								<div class="form-group">
									{{-- <label class="text-white">Services</label> --}}
									<label >Services</label>
									<div class="dropdown bootstrap-select show-tick form-control default-select">
										<select multiple="" name="service[]" class="form-control default-select" id="sel2" tabindex="-98">
											@if (!empty($services))
												@foreach ($services as $service)
												<option value="{{$service->id}}">{{$service->name}}</option>
												@endforeach
											@endif
										</select>
										@error('service')
											<div class="text-danger f-9 mt-2">{{$message}}</div>
										@enderror
										<!-- <button type="button" class="btn dropdown-toggle btn-light" data-toggle="dropdown" role="button" data-id="sel2" title="1, 2, 3, 4" aria-expanded="false">
											<div class="filter-option">
												<div class="filter-option-inner">
													<div class="filter-option-inner-inner">1, 2, 3, 4</div>
												</div>
											</div>
										</button>
										<div class="dropdown-menu" role="combobox" x-placement="bottom-start" style="max-height: 248px; overflow: hidden; min-height: 103px; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 42px, 0px);">
											<div class="inner show" role="listbox" aria-expanded="false" tabindex="-1" style="max-height: 232px; overflow-y: auto; min-height: 87px;">
												<ul class="dropdown-menu inner show">
													<li class="selected">
														<a role="option" class="dropdown-item selected" aria-disabled="false" tabindex="0" aria-selected="true">
															<span class=" bs-ok-default check-mark"></span>
															<span class="text">1</span>
														</a>
													</li>
													<li class="selected">
														<a role="option" class="dropdown-item selected" aria-disabled="false" tabindex="0" aria-selected="true">
															<span class=" bs-ok-default check-mark"></span>
															<span class="text">2</span>
														</a>
													</li>
													<li class="selected">
														<a role="option" class="dropdown-item selected" aria-disabled="false" tabindex="0" aria-selected="true">
															<span class=" bs-ok-default check-mark"></span>
															<span class="text">3</span>
														</a>
													</li>
													<li class="selected">
														<a role="option" class="dropdown-item selected" aria-disabled="false" tabindex="0" aria-selected="true">
															<span class=" bs-ok-default check-mark"></span>
															<span class="text">4</span>
														</a>
													</li>
													<li>
														<a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false">
															<span class=" bs-ok-default check-mark"></span>
															<span class="text">5</span>
														</a>
													</li>
												</ul>
											</div>
										</div> -->
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