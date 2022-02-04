@extends('layouts.user_app')
@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" />

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<style>
	* {
		margin: 0;
		padding: 0
	}

	html {
		height: 100%
	}

	#grad1 {
		background-color: : #9C27B0;
		background-image: linear-gradient(120deg, #FF4081, #81D4FA)
	}

	#msform {
		text-align: center;
		position: relative;
		margin-top: 20px
	}

	#msform fieldset .form-card {
		background: white;
		border: 0 none;
		border-radius: 0px;
		box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
		padding: 20px 40px 30px 40px;
		box-sizing: border-box;
		width: 94%;
		margin: 0 3% 20px 3%;
		position: relative
	}

	#msform fieldset {
		background: white;
		border: 0 none;
		border-radius: 0.5rem;
		box-sizing: border-box;
		width: 100%;
		margin: 0;
		padding-bottom: 20px;
		position: relative
	}

	#msform fieldset:not(:first-of-type) {
		display: none
	}

	#msform fieldset .form-card {
		text-align: left;
		color: #9E9E9E
	}

	#msform input,
	#msform textarea {
		padding: 0px 8px 4px 8px;
		border: none;
		border-bottom: 1px solid #ccc;
		border-radius: 0px;
		margin: 10px 5px;
		width: 100%;
		box-sizing: border-box;
		font-family: montserrat;
		color: #2C3E50;
		font-size: 16px;
		letter-spacing: 1px
	}

	#msform input:focus,
	#msform textarea:focus {
		-moz-box-shadow: none !important;
		-webkit-box-shadow: none !important;
		box-shadow: none !important;
		border: none;
		font-weight: bold;
		border-bottom: 2px solid skyblue;
		outline-width: 0
	}

	#msform .action-button {
		width: 100px;
		background: skyblue;
		font-weight: bold;
		color: white;
		border: 0 none;
		border-radius: 0px;
		cursor: pointer;
		padding: 10px 5px;
		margin: 10px 5px
	}

	#msform .action-button:hover,
	#msform .action-button:focus {
		box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue
	}

	#msform .action-button-previous {
		width: 100px;
		background: #616161;
		font-weight: bold;
		color: white;
		border: 0 none;
		border-radius: 0px;
		cursor: pointer;
		padding: 10px 5px;
		margin: 10px 5px
	}

	#msform .action-button-previous:hover,
	#msform .action-button-previous:focus {
		box-shadow: 0 0 0 2px white, 0 0 0 3px #616161
	}

	select.list-dt {
		border: none;
		outline: 0;
		border-bottom: 1px solid #ccc;
		padding: 2px 5px 3px 5px;
		margin: 10px 5px;
		width: 100%;
	}

	select.list-dt:focus {
		border-bottom: 2px solid skyblue
	}

	.card {
		z-index: 0;
		border: none;
		border-radius: 0.5rem;
		position: relative
	}

	.fs-title {
		font-size: 25px;
		color: #2C3E50;
		margin-bottom: 10px;
		font-weight: bold;
		text-align: left
	}

	#progressbar {
		margin-bottom: 30px;
		overflow: hidden;
		color: lightgrey
	}

	#progressbar .active {
		color: #000000
	}

	#progressbar li {
		list-style-type: none;
		font-size: 12px;
		width: 25%;
		float: left;
		position: relative
	}

	#progressbar #account:before {
		font-family: FontAwesome;
		content: "\f023"
	}

	#progressbar #personal:before {
		font-family: FontAwesome;
		content: "\f007"
	}

	#progressbar #payment:before {
		font-family: FontAwesome;
		content: "\f09d"
	}

	#progressbar #confirm:before {
		font-family: FontAwesome;
		content: "\f00c"
	}

	#progressbar li:before {
		width: 50px;
		height: 50px;
		line-height: 45px;
		display: block;
		font-size: 18px;
		color: #ffffff;
		background: lightgray;
		border-radius: 50%;
		margin: 0 auto 10px auto;
		padding: 2px
	}

	#progressbar li:after {
		content: '';
		width: 100%;
		height: 2px;
		background: lightgray;
		position: absolute;
		left: 0;
		top: 25px;
		z-index: -1
	}

	#progressbar li.active:before,
	#progressbar li.active:after {
		background: skyblue
	}

	.radio-group {
		position: relative;
		margin-bottom: 25px
	}

	.radio {
		display: inline-block;
		width: 204;
		height: 104;
		border-radius: 0;
		background: lightblue;
		box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
		box-sizing: border-box;
		cursor: pointer;
		margin: 8px 2px
	}

	.radio:hover {
		box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3)
	}

	.radio.selected {
		box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
	}

	.fit-image {
		width: 100%;
		object-fit: cover
	}

	.rad1 {
		width: auto !important;
		padding: 0px !important;
		margin: 0px !important;
		position: relative;
	}
</style>

<script>
	$(document).ready(function() {
		var current_fs, next_fs, previous_fs; //fieldsets
		var opacity;
		$(".next").click(function() {
			current_fs = $(this).parent();
			next_fs = $(this).parent().next();
			//Add Class Active
			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

			//show the next fieldset
			next_fs.show();
			//hide the current fieldset with style
			current_fs.animate({
				opacity: 0
			}, {
				step: function(now) {
					// for making fielset appear animation
					opacity = 1 - now;

					current_fs.css({
						'display': 'none',
						'position': 'relative'
					});
					next_fs.css({
						'opacity': opacity
					});
				},
				duration: 600
			});
		});

		$(".previous").click(function() {
			current_fs = $(this).parent();
			previous_fs = $(this).parent().prev();

			//Remove class active
			$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
			//show the previous fieldset
			previous_fs.show();

			//hide the current fieldset with style
			current_fs.animate({
				opacity: 0
			}, {
				step: function(now) {
					// for making fielset appear animation
					opacity = 1 - now;

					current_fs.css({
						'display': 'none',
						'position': 'relative'
					});
					previous_fs.css({
						'opacity': opacity
					});
				},
				duration: 600
			});
		});

		$('.radio-group .radio').click(function() {
			$(this).parent().find('.radio').removeClass('selected');
			$(this).addClass('selected');
		});

		$(".submit").click(function() {
			return false;
		})

	});
</script>
<div class="content-body">
	<!-- MultiStep Form -->
	<div class="container-fluid" id="grad1">
		<div class="row justify-content-center mt-0">
			<div class="col-11 col-sm-9 col-md-10 col-lg-10 text-center p-0 mt-3 mb-2">
				<div class="card px-0 pt-4 pb-0 mt-3 mb-3">
					<h2><strong>Enter Paitent Detail</strong></h2>
					<p>Fill all form field to go to next step</p>
					<div class="row">
						<div class="col-md-12 mx-0">
							<form id="msform" action="#">
								<!-- progressbar -->
								<ul id="progressbar">
									<li class="active" id="account"><strong>Account</strong></li>
									<li id="personal"><strong>Personal Detail</strong></li>
									<li id="payment"><strong>Patient</strong></li>
									<li id="confirm"><strong>Payment</strong></li>
								</ul> <!-- fieldsets -->

								<!-- first step -->
								<fieldset>
									<div class="form-card">
										<h3 class="fs-title">New Registration</h3>
										<div class="row">
											<div class="col-md-6 col-sm-12 col-xs-12">
												<select class="list-dt" id="month" name="centre">
													<option selected>Centre</option>
													<option>Abc</option>
												</select>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12">
												<select class="list-dt" name="patient_type">
													<option selected>Patient Type</option>
													<option>xyz</option>
												</select>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12">
												<input type="text" name="prebooking" placeholder="Pre Booking No" />
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12">
												<select class="list-dt" name="patient_type">
													<option selected>Rate Type</option>
													<option>xyz</option>
												</select>
											</div>
										</div>

										<h3 class="fs-title">Search Option</h3>
										<div class="row">
											<div class="col-md-6 col-sm-12 col-xs-12">
												<input type="text" name="mobile" placeholder="Mobile No" />
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12">
												<input type="text" name="maxid" placeholder="MAXID/MLID" />
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12">
												<input type="text" name="membershipID" placeholder="Membership ID" />
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12">
												<input type="text" name="familyUHID" placeholder="Family UHID" />
											</div>
										</div>

									</div>
									<input type="button" name="next" class="next action-button" value="Next Step" />
								</fieldset>
								<!-- end first step -->

								<!-- Second step start -->
								<fieldset>
									<div class="form-card">
										<h3 class="fs-title">Demographic Detail</h3>
										<div class="row">
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="fname" placeholder="First Name" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="mname" placeholder="Mid Name" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="lname" placeholder="Last Name" />
											</div>

											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="age" placeholder="Age" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="dob" placeholder="Date of Birth" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<select class="list-dt" name="patient_type">
													<option selected>Gender</option>
													<option>Male</option>
													<option>FeMale</option>
												</select>
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="refterDoctor" placeholder="Refer Doctor" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="otherDoctor" placeholder="Other Doctor" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="pincode" placeholder="Pin Code" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="email" name="email" placeholder="Email ID" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="address" placeholder="House Address" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="area" placeholder="Area" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="city" placeholder="City" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="state" placeholder="State" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="country" placeholder="Nationality" />
											</div>

										</div>

									</div>
									<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
									<input type="button" name="next" class="next action-button" value="Next Step" />
								</fieldset>
								<!-- end Second step -->

								<!-- Third step start -->
								<fieldset>
									<div class="form-card">
										<h3 class="fs-title">Patient Type</h3>
										<div class="row">
											<div class="col-md-4 col-sm-6 col-xs-6">
												<select class="list-dt" name="patient_type">
													<option selected>Visit Type</option>
													<option>xyz</option>
												</select>
											</div>

											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="Aadhaar" placeholder="Aadhaar Card" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<select class="list-dt" name="source">
													<option selected>Source</option>
													<option>xyz</option>
												</select>
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<select class="list-dt" name="dispatch">
													<option selected>Dispatch Mode</option>
													<option>xyz</option>
												</select>
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="barcode" placeholder="Barcode" />
											</div>

											<div class="col-md-4 col-sm-6 col-xs-6">
												<select class="list-dt" name="phlebotomist">
													<option selected>Phlebotomist</option>
													<option>xyz</option>
												</select>
											</div>

											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="remarks" placeholder="Remarks" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="sampletime" placeholder="SampleColTime" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="sampletime" placeholder="SRF NO" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6 mt-1">
												<label><b>Upload Attachment</b></label>
												<input type="file" name="image" placeholder="Document" />
											</div>
										</div>

										<h3 class="fs-title">Test</h3>

										<div class="row">
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="radio" class="form-check-input rad1" name="optradio" checked />
												By Test Name
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="radio" class="form-check-input rad1" name="optradio" />
												By Test Code
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="radio" class="form-check-input rad1" name="optradio" />
												In Between
											</div>

											<div class="col-md-6 mt-3">
												<input type="text" name="search" placeholder="Search" />
											</div>
											<div class="col-md-3 mt-3">
												<p>Total Test: 0</p>
											</div>
											<div class="col-md-3 mt-3">
												<p>Total Amt: 0</p>
											</div>

											<div class="table-responsive mt-2">
												<table class="table table-striped">
													<thead style="background-color: #87ceeb!important; color:white;">
														<tr>
															<th>#</th>
															<th>Code</th>
															<th>Item</th>
															<th>View</th>
															<th>Rate</th>
															<th>Disc.</th>
															<th>Amt.</th>
															<th>Delivery</th>
															<th>S.Coll.</th>
															<th>Urgent</th>
														</tr>
													</thead>
													<tbody>
														<!-- <tr>
															<td>John</td>
															<td>Doe</td>
															<td>john@example.com</td>
														</tr> -->

													</tbody>
												</table>
											</div>
										</div>
										<!-- </div> -->

									</div>
									<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
									<input type="button" name="next" class="next action-button" value="Next Step" />
								</fieldset>
								<!-- End Third step  -->

								<!-- Start Four step  -->
								<fieldset>
									<div class="form-card">
										<h3 class="fs-title">Payment</h3>
										<div class="row">
											<div class="col-md-4 col-sm-6 col-xs-6">
												<select class="list-dt" name="patient_type">
													<option selected>Payment Mode</option>
													<option>Credit</option>
													<option>Debit</option>
												</select>
											</div>

											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="totalAmt" placeholder="Total Amount" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="paidAmt" placeholder="Paid Amount" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="dueAmt" placeholder="Due Amount" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="cash" placeholder="Cash Rendering" />
											</div>
										</div>

										<h3 class="fs-title mt-3">Discount</h3>
										<div class="row">
											<div class="col-md-4 col-sm-6 col-xs-6">
											   <input type="text" name="discount" placeholder="Discount" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
											   <input type="text" name="commission" placeholder="Commission / Overtime" />
											</div>
											<div class="col-md-4 col-sm-6 col-xs-6">
											   <input type="text" name="drAmt" placeholder="Doctor Amount" />
											</div>

											<div class="col-md-6 col-sm-6 col-xs-6">
												<select class="list-dt" name="patient_type">
													<option selected>Select Reason</option>
													<!-- <option>Credit</option>
													<option>Debit</option> -->
												</select>
											</div>

											<div class="col-md-4 col-sm-6 col-xs-6">
												<input type="text" name="coupon" placeholder="Coupon" />
											</div>
										</div>
										</div>
										<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
									    <input type="submit" name="submit" class="action-button" value="Save" />

								</fieldset>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection