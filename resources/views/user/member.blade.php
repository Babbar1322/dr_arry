@extends('layouts.user_app')
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
						<h4 class="card-title">Memebership Registration</h4>
					</div>
					<div class="card-body">
						<div class="basic-form">
							<form>

								<div class="form-row">
									<div class="form-group col-md-6">
										<label>Name</label>
										<input type="text" name="name" class="form-control" placeholder="Enter Name">
									</div>
									<div class="form-group col-md-6">
										<label>Email</label>
										<input type="email" name="email" class="form-control" placeholder="Email">
									</div>

									<div class="form-group col-md-6">
										<label>City</label>
										<input type="text" name="city" class="form-control">
									</div>
									<div class="form-group col-md-4">
										<label>State</label>
										<select id="inputState" name="state" class="form-control default-select">
											<option selected>Choose...</option>
											<option>Option 1</option>
											<option>Option 2</option>
											<option>Option 3</option>
										</select>
									</div>
									<div class="form-group col-md-2">
										<label>Zip</label>
										<input type="text" name="zip" class="form-control">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label>Password</label>
										<input type="password" name="password" class="form-control" placeholder="Password">
									</div>
									<div class="form-group col-md-6">
										<label>Confirm Password</label>
										<input type="cnfpassword" name="cnfpassword" class="form-control" placeholder="Confirm Password">
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