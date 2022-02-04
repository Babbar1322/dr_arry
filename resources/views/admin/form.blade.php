@extends('layouts.admin_app')
@section('content')

<style>
    .subclass {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    [data-theme-version="dark"] .custom-control-label::before {
        background-color: transparent;
        border-color: white !important;
    }

    .f-9 {
        font-size: 9px;
    }
    .custom-lbl::after , .custom-lbl::before{
        display: none;
    }
    .apnd_tech{
        border: 1px solid lightgrey;
        padding: 10px;
        margin-bottom: 10px;
        padding-bottom: 0px
    }
    .label{
        font-size: 11px;
        margin-bottom:0.1px;
    }
</style>

<div class="content-body">
    <!-- <div class="container-fluid" id="grad1"> -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><a onclick="history.back()" class="fa fa-arrow-left text-primary mr-4"></a>New Registration</h4>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
                        <div class="basic-form">
                            <form id="msform" >
                                @csrf
                                <input type="hidden" name="main_service[]" class="mainserv" value="" />

                                {{-- <div class="form-row">
									<div class="form-group col-md-2">
										<select class="form-control" id="month" name="centre">
											<option value="">Centre</option>
											<option>Abc</option>
										</select>
									</div>
									<div class="form-group col-md-2">
										<select class="form-control" name="patient_type">
											<option value="">Patient Type</option>
											<option>xyz</option>
										</select>
									</div>
									<div class="form-group col-md-2">
										<input type="text" name="prebooking" class="form-control" placeholder="Pre Booking No" />
									</div>
									<div class="form-group col-md-2">
										<select class="form-control" name="rate_type">
											<option value="">Rate Type</option>
											<option>xyz</option>
										</select>
									</div>
								</div> --}}


                                <h5 class="fs-title">Search Option</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label class="label">Mobile*</label>
                                        <input type="text" name="mobile" class="form-control cust_phn" placeholder="Mobile No" minlength="10" maxlength="10" required />
                                        <div class="text-danger phone f-9"></div>
                                        @error('mobile')
                                        <div class="text-danger f-9">{{$message}}</div>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group col-md-2">
										<input type="text" name="maxid" class="form-control" placeholder="MAXID/MLID" />
									</div> --}}
                                    <div class="form-group col-md-2">
                                        <label class="label">Membership ID</label>
                                        <input type="text" name="MembershipID " class="form-control mem_id" id="mem_id" placeholder="Membership ID" maxlength="7" />
                                        
                                    </div>
                                    {{-- <div class="form-group col-md-2">
										<input type="text" name="familyUHID" class="form-control" placeholder="Family UHID" />
									</div> --}}
                                    <div class="form-group col-md-2">
                                        <label class="label">Barcode</label>
                                        <input type="text" name="barcode" class="form-control" placeholder="Barcode" />
                                    </div>
                                </div>

                                <h5 class="fs-title mt-4">Demographic Detail</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label class="label">First Name*</label>
                                        <input type="text" name="fname" class="form-control" placeholder="First Name" require id="fname" required />
                                        @error('fname')
                                        <div class="text-danger f-9">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="label">Mid Name</label>
                                        <input type="text" name="mname" class="form-control" placeholder="Mid Name" id="mname" />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="label">Last Name*</label>
                                        <input type="text" name="lname" class="form-control" placeholder="Last Name" id="lname" required />
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label class="label">Age*</label>
                                        <input type="text" name="age" class="form-control" placeholder="Age" id="age" required />
                                        @error('age')
                                        <div class="text-danger f-9">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="label">Date of Birth*</label>
                                        <input type="date" name="dob" class="form-control" placeholder="Date of Birth" id="dob" required />
                                        @error('dob')
                                        <div class="text-danger f-9">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="label">Gender*</label>
                                        <select class="form-control" name="gender" id="gender" required>
                                            <option value="">Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">FeMale</option>
                                            <option value="transgender">TransGender</option>
                                        </select>
                                        @error('gender')
                                        <div class="text-danger f-9">{{$message}}</div>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group col-md-2">
										<input type="text" name="refdoct" class="form-control" placeholder="Refer Doctor" />
									</div>
									<div class="form-group col-md-2">
										<input type="text" name="otherdoct" class="form-control" placeholder="Other Doctor" />
									</div> --}}
                                    <div class="form-group col-md-2">
                                        <label class="label">Pincode*</label>
                                        <input type="text" name="pincode" class="form-control" placeholder="Pin Code" id="pin" required />
                                        @error('pincode')
                                        <div class="text-danger f-9">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="label">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email ID" id="email"  />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="label">House Address*</label>
                                        <input type="text" name="address" class="form-control" placeholder="House Address" id="haddr" required />
                                        @error('email')
                                        <div class="text-danger f-9">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="label">Area</label>
                                        <input type="text" name="area" class="form-control" placeholder="Area" id="area" />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="label">State*</label>
                                        {{-- <input type="text" name="state" class="form-control" placeholder="State" id="state" required /> --}}
                                        <select  id="stat" name="state" class="form-control" required >
                                            <option value="">Select State</option>
                                            @if(!empty($states))
                                            @foreach ($states as $state)
                                                <option value="{{$state->name}}">{{$state->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="label">City*</label>
                                        {{-- <input type="text" name="city" class="form-control" placeholder="City" id="city" required /> --}}
                                        <select id="city" name="city" class="form-control city" required></select>
                                        @error('city')
                                        <div class="text-danger f-9">{{$message}}</div>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group col-md-2">
                                        <input type="text" name="nationality" class="form-control" placeholder="Nationality" id="nation" require />
                                    </div> --}}
                                </div>


                                {{-- <h5 class="fs-title">Patient Type</h5>
								<div class="form-row">
									<div class="form-group col-md-2">
										<select class="form-control" name="patient_type">
											<option value="">Visit Type</option>
											<option>xyz</option>
										</select>
									</div>

									<div class="form-group col-md-2">
										<input type="text" name="adhaar" class="form-control" placeholder="Aadhaar Card" />
									</div>
									<div class="form-group col-md-2">
										<select class="form-control" name="source">
											<option value="">Source</option>
											<option>xyz</option>
										</select>
									</div>
									<div class="form-group col-md-2">
										<select class="form-control" name="dispatch">
											<option value="">Dispatch Mode</option>
											<option>xyz</option>
										</select>
									</div>
									<div class="form-group col-md-2">
										<input type="text" name="barcode" class="form-control" placeholder="Barcode" />
									</div>

									<div class="form-group col-md-2">
										<select class="form-control" name="phlebotomist">
											<option value="">Phlebotomist</option>
											<option>xyz</option>
										</select>
									</div>

									<div class="form-group col-md-2">
										<input type="text" name="remarks" class="form-control" placeholder="Remarks" />
									</div>
									<div class="form-group col-md-2">
										<input type="text" name="sampletime" class="form-control" placeholder="SampleColTime" />
									</div>
									<div class="form-group col-md-2">
										<input type="text" name="sampletime" class="form-control" placeholder="SRF NO" />
									</div>

									<div class="form-group col-md-3">
										<label class="text-white"><b>Upload Attachment</b></label>
										<input type="file" name="image" class="form-control" placeholder="Document" />
									</div>
								</div> --}}



                                <h5 class="fs-title mt-4">Book Service</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        {{-- <div class="dropdown bootstrap-select show-tick form-control default-select">
											<select multiple name="service[]" class="form-control default-select services" id="sel2" tabindex="-98" require>
												<option>Choose Service</option>
												@if(!empty($service))
													@foreach($service as $s)
														<option value="{{$s->id}}" class="addform">{{$s->name}}</option>
                                        @endforeach
                                        @endif
                                        </select>
                                    </div> --}}
                                    <label class="label">Services*</label>
                                    <select class="form-control services" required>
                                        <option>Choose Service</option>
                                        @if(!empty($service))
                                        @foreach($service as $s)
                                        <option value="{{$s->id}}" class="addform">{{$s->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    {{-- @error('main_service')
											<div class="text-danger f-9">{{$message}}
                                </div>
                                @enderror --}}
                        </div>
                    </div>

                    <div class="append_data form-row">

                    </div>
                    {{-- @error('subservice')
											<div class="text-danger f-9">{{$message}}
                </div>
                @enderror --}}

                <div class="form-row final_sum mt-5 d-none">
                    <div class="col-md-12"> <h4 class="pb-3">All Services Amount</h4></div>
                    <div class="form-group col-md-3">
                        <label >Total</label>
                        <input type="text" name="total_amount" class="form-control total_amt" value="0" />
                    </div>
                    <div class="form-group col-md-3">
                        <label>Discount (%)</label>
                        <input type="text" name="discount_amount" class="form-control disc" value="0" />
                    </div>
                    <div class="form-group col-md-3">
                        <label>Final Amount</label>
                        <input type="text" name="final_amount" class="form-control final_amt" value="0" />
                    </div>
                    <div class="form-group col-md-3">
                        <p class="btn btn-dark btn-sm calsum mt-4">Calculate</p>
                    </div>
                </div>
                {{-- <h5 class="fs-title">Test</h5>
								<div class="form-row">
									<div class="form-group col-md-2">
										<input type="radio" class="form-check-input rad1" value="By Test Name" name="optradio" checked />
										By Test Name
									</div>
									<div class="form-group col-md-2">
										<input type="radio" class="form-check-input rad1" value="By Test Code" name="optradio" />
										By Test Code
									</div>
									<div class="form-group col-md-2">
										<input type="radio" class="form-check-input rad1" value="In Between" name="optradio" />
										In Between
									</div>

									<div class="form-group col-md-2">
										<input type="text" name="search" class="form-control" placeholder="Search" />
									</div>
									<div class="form-group col-md-2">
										<p>Total Test: 0</p>
									</div>
									<div class="form-group col-md-2">
										<p>Total Amt: 0</p>
									</div>

									<div class="table-responsive mt-2">
										<table class="table table-striped">
											<thead style="background-color: #711685!important; color:white;">
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


								<h5 class="fs-title">Payment</h5>
								<div class="form-row">
									<div class="form-group col-md-2">
										<select class="form-control" name="patient_type">
											<option selected>Payment Mode</option>
											<option>Credit</option>
											<option>Debit</option>
										</select>
									</div>

									<div class="form-group col-md-2">
										<input type="text" name="totalAmt" class="form-control" placeholder="Total Amount" />
									</div>
									<div class="form-group col-md-2">
										<input type="text" name="paidAmt" class="form-control" placeholder="Paid Amount" />
									</div>
									<div class="form-group col-md-2">
										<input type="text" name="dueAmt" class="form-control" placeholder="Due Amount" />
									</div>
									<div class="form-group col-md-2">
										<input type="text" name="cash" class="form-control" placeholder="Cash Rendering" />
									</div>
								</div>


								<h5 class="fs-title mt-3">Discount</h5>
								<div class="form-row">
									<div class="form-group col-md-2">
										<input type="text" name="discount" class="form-control" placeholder="Discount" />
									</div>
									<div class="form-group col-md-2">
										<input type="text" name="commission" class="form-control" placeholder="Commission / Overtime" />
									</div>
									<div class="form-group col-md-2">
										<input type="text" name="drAmt" class="form-control" placeholder="Doctor Amount" />
									</div>

									<div class="form-group col-md-2">
										<select class="list-dt" name="patient_type">
											<option selected>Select Reason</option>
											<!-- <option>Credit</option>
													<option>Debit</option> -->
										</select>
									</div>

									<div class="form-group col-md-2">
										<input type="text" name="coupon" class="form-control" placeholder="Coupon" />
									</div>
								</div> --}}

                <h5 class="fs-title mt-4">Credits</h5>
                
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="label">Providers (optional)</label>
                        <select name="pro_id" class="form-control pros">
                            <option value="">Choose Provider</option>
                            <option value="" class="np">No Provider</option>
                            @if (!empty($providers))
                            @foreach($providers as $prov)
                            <option value="{{$prov->id}}">{{$prov->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="label"> Name (optional)</label>
                        <input type="text" name="pro_name" class="form-control pro_name" placeholder="Provider Name"  />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="label"> Phone No. (optional)</label>
                        <input type="text" name="pro_phn" class="form-control pro_phn" placeholder="Provider Phone No." minlength="10" maxlength="10"  />
                        @error('ref_phn')
                        <div class="text-danger f-9">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="label"> Cash Amount (optional)</label>
                        <input type="text" name="cash" class="form-control cash" value="0" >
                    </div>
                    <div class="form-group col-md-4">
                        <label class="label"> Credit Amount (optional)</label>
                        <input type="text" name="credit" class="form-control camnt" value="0" >
                    </div>
                    <div class="form-group col-md-4">
                        <label class="label"> Remarks (optional)</label>
                        <textarea name="cre_remark" rows="2" class="form-control " placeholder=" Remarks"></textarea>
                    </div>
                </div>


                <h5 class="fs-title mt-4">Refer Provider</h5>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label class="label">Providers*</label>
                        <select name="refer_by" class="form-control refr">
                            <option value="">Choose Provider</option>
                            <option value="" class="np">No Provider</option>
                            @if (!empty($providers))
                            @foreach($providers as $prov)
                            <option value="{{$prov->id}}">{{$prov->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="label"> Name*</label>
                        <input type="text" name="ref_name" class="form-control refr_name" placeholder="Refer Name" required />
                    </div>
                    <div class="form-group col-md-2">
                        <label class="label"> Phone No.*</label>
                        <input type="text" name="ref_phn" class="form-control refr_phn" placeholder="Refer Phone No." minlength="10" maxlength="10" required />
                        @error('ref_phn')
                        <div class="text-danger f-9">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label class="label"> Remarks</label>
                        <textarea name="ref_remark" rows="2" class="form-control" placeholder="Refer Remarks"></textarea>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="label"> Commission*</label>
                        <input type="number" name="ref_com" class="form-control" placeholder="Refer Commission" required />
                    </div>
                </div>

                 <button type="button" class="btn btn-info btn-xxs tech_btn" id="show_tech" onclick='showTech()'>Add Technician Commission</button>
                 <button type="button" class="btn btn-danger btn-xxs d-none" id="remv_tech" onclick='hideTech()'>Remove Technician Commission</button>
                <div class="d-none" id="techshow">
                <h5 class="fs-title mt-4">Technician</h5>
                <div id="apnd_tech">
                    <div class="form-row apnd_tech" >
                    <div class="col-md-12 mb-2" style="font-size: 13px;">Fill technician details</div>
                    <div class="form-group col-md-3 tech">
                        <label class="label">Technicians*</label>
                        <select name="tech_id[]" class="form-control tech_refr">
                            <option value="">Choose Techincian</option>
                            <option value="">No Technician</option>
                            @if (!empty($technician))
                            @foreach($technician as $tech)
                            <option value="{{$tech->id}}">{{$tech->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="label"> Name</label>
                        <input type="text" name="tech_name[]" class="form-control " placeholder="Technician Name"   />
                    </div>
                    <div class="form-group col-md-2">
                        <label class="label"> Phone</label>
                        <input type="text" name="tech_phn[]" class="form-control phn tech_phn_0" placeholder="Technician Phone No."  minlength="10" maxlength="10"  />
                    </div>
                    <div class="form-group col-md-3">
                        <label class="label"> Remarks</label>
                        <textarea name="tech_remark[]" rows="2" class="form-control" placeholder="Technician Remarks"></textarea>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="label">Commission</label>
                        <input type="number" name="tech_com[]" class="form-control" placeholder="Technician Commission"  />
                    </div>
                    <div class="form-group col-md-4 servc">
                        {{-- <label class="text-white">Services</label> --}}
                        {{-- <div class="dropdown bootstrap-select show-tick form-control default-select">
                            <select multiple name="service[]" class="form-control default-select" id="sel2" tabindex="-98">
                                @if (!empty($service))
                                    @foreach ($service as $ser)
                                    <option value="{{$ser->id}}">{{$ser->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div> --}}
                        <label style="font-size:13px;"> Technician Services</label>
                        <div class="mb-4 p-2 "  style="border:1px solid #711685; border-radius:5px; max-height:100px; overflow: scroll;">
                            @if (!empty($service))
                            @foreach ($service as $ser)
                            <div class="custom-control custom-checkbox checks" >
                                <input type="checkbox" class="" name="tech_service[]"  value="{{$ser->id}}" >
                                <label class="custom-control-label custom-lbl" >{{$ser->name}}</label>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                </div>
                <div>
                    <button type="button" class="btn btn-info add_tech">Add Row</button>
                </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3"></div>
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary btn-block" id="submit">Submit</button>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
    function getData(val, index, name, serviceId, amt) {
        // var amtpre = parseInt($('#amt_' + serviceId).val());
        $('.final_sum').removeClass('d-none');
        var flag = 0;
        if ($('.tabindex_' + index + '_' + serviceId).attr('checked')) {
            // alert("fidfja");
            $('.h_amt_' + val).addClass('d-none');
            $('.provide_' + val).addClass('d-none');

            flag = 1;
            $('.tabindex_' + index + '_' + serviceId).removeAttr("checked");
            // amtpre -= parseInt(amt);
            $('.INHome_' + val).addClass('d-none');
        } else {
            flag = 2;
            $('.tabindex_' + index + '_' + serviceId).attr("checked", "true");
            // amtpre += parseInt(amt);
            $('.INHome_' + val).removeClass('d-none');
        }
        // $('#amt_' + serviceId).val(amtpre);

        var ar_value = [];
        if ($('#sev_' + serviceId).val() != '') {

            var ar_value1 = JSON.parse($('#sev_' + serviceId).val());
            var index = ar_value1.indexOf(val);
            if (index >= 0 || flag == 1) {
                ar_value1 = jQuery.grep(ar_value1, function(value1) {
                    return value1 != val;
                });
                ar_value = ar_value1;
            } else {
                ar_value = ar_value1;
                ar_value.push(val);
            }
        } else {
            ar_value.push(val);
        }
        var jsondata = JSON.stringify(ar_value);
        $('#sev_' + serviceId).val(jsondata);
        $('#priceamt_' + val).val(amt);

    }
    // add row
    $(document).ready(function() {
        $('.append_data').on("keyup", '#myInput', function() {
            var value = $(this).val().toLowerCase();
            var id = $(this).attr('data-id');
            $("#myTable_" + id + " label").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        // mainservice add in hidden filed
        $('.services').on('change', function() {
            var val = $(this).val();
            var ar_value = [];
            if ($('.mainserv').val() != '') {
                var ar_value1 = JSON.parse($('.mainserv').val());
                var index = ar_value1.indexOf(val);
                if (index >= 0) {
                    ar_value1 = jQuery.grep(ar_value1, function(value1) {
                        return value1 != val;
                    });
                    ar_value = ar_value1;
                } else {
                    ar_value = ar_value1;
                    ar_value.push(val);
                }
            } else {
                ar_value.push(val);
            }
            var jsondata = JSON.stringify(ar_value);
            $('.mainserv').val(jsondata);
        });

        $('.services').change(function(e) {
            var value = JSON.parse($(".mainserv").val());
            $(".checks input").each(function(index) {
                var val = $(this).val();
                if (value.includes(val)) {
                $(this).prop('checked', true);
                }
            });
                        
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            var value = $(this).val();
            var id = "rowid_" + value;
            var i = $(".append_data").find("#" + id).html();
            if (i == undefined) {
                $.ajax({
                    url: "{{route('service.getsub')}}",
                    type: "GET",
                    data: {
                        service: value,
                    },
                    success: function(data) {
                        var ms1 = [];
                        var ms = $('.mainserv').val();
                        var ms = JSON.parse(ms);
                        var ser = $('.services option:selected').text();
                        if (data.data.length == 0) {
                            ms = $.grep(ms, function(value) {
                                return value != data.mainservice;
                            });
                            var jsondata = JSON.stringify(ms);
                            $('.mainserv').val(jsondata);
                        }
                        if (data.data.length > 0) {
                            var html = '';

                            html += '<input type="hidden" name="subservice[' + data.mainservice + '][]" id="sev_' + data.mainservice + '" class="sub_service" value="" />';
                            // html+= '<div class="col-md-6">';
                            // html += '<div class="mt-2  p-2  serv" id="rowid_' + data.mainservice + '" style="border:1px solid #711685; border-radius:5px; max-height: 200px; overflow: scroll;">';
                            html+= '<div class="col-md-6" id="rowid_' + data.mainservice + '" data-service="'+ data.mainservice +'">';
                            html += '<div class="mt-2  p-2  serv"  style="border:1px solid #711685; border-radius:5px; max-height: 200px; overflow: scroll;">';
                            html += '<div class="col-md-12">';
                            html +='<div class="row mb-2"><div class="col-md-6"><div class="text-primary">'+ser+'</div></div><div class="col-md-6">';
                            // close button
                            html += '<button type="button" class="close closebox bg-danger mb-1" aria-label="Close" data-id="' + data.mainservice + '">';
                            html += '<span aria-hidden="true" class="p-1 text-white">&times;</span>';
                            html += '</button>';
                            html += '</div></div>';

                            html += '<input id="myInput" class="form-control mb-3" data-id="' + data.mainservice + '" type="text" placeholder="Search..">';

                            if (data.data != '') {
                                var j = 1;
                                $.each(data.data, function(key, val) {
                                    // html += '<input type="hidden" name="subservice[' + data.mainservice + ']['+val.id+'][1]" id="sev_' + data.mainservice + '" class="sub_service" value="" />';

                                    html += '<div class="custom-control custom-checkbox mb-2" id="myTable_' + val.service_id + '">';
                                    html += '<input type="checkbox" class="custom-control-input subservice tabindex_' + j + '_' + val.service_id + ' " name="check_service[]" id="' + val.id + '" value="' + val.name + '" onClick="getData(\'' + val.id + '\', \'' + j + '\', \'' + val.name + '\',  \'' + val.service_id + '\' ,  \'' + val.home_amt + '\')" data-amt="' + val.home_amt + '">';
                                    html += '<label class="custom-control-label" for="' + val.id + '">' + val.name + '</label>';
                                    html += '</div>';
                                    // Home outsource checkbox btn
                                    html += '<div class="row d-none INHome_' + val.id + '">';
                                    html += '<div class="col-md-6 form-group ml-4">';
                                        html += '<div class="row ">';
                                            html += '<div class="col-md-6 form-group text-center ">';
											if(val.in_home != null){
                                            html += '<input type="radio" class="form-check-input rad1 inhome" name="subservice[' + data.mainservice + '][' + val.id + '][2]" data-id="' + val.id + '" data-amt="' + val.home_amt + '" value="In Home " '+val.in_home+' checked /> IN Home';
                                            }
											html += '</div>';
                                            html += '<div class="col-md-6 form-group text-center ">';
											if(val.out_source != null && data.provider != ''){
                                            html += '<input type="radio" class="form-check-input rad2 outsource" data-id="' + val.id + '" name="subservice[' + data.mainservice + '][' + val.id + '][2]" data-id="' + val.id + '" value="OutSource"/> Out Source';
                                            }
                                            html += '</div>';
                                            // amount box
                                            html += '<div class="form-group col-md-12  h_amt_' + val.id + '">';
                                            html += '<label>Amount </label>';
                                            html += '<input type="text" name="subservice[' + data.mainservice + '][' + val.id + '][3]" class="form-control singleamt_'+data.mainservice+'" id="priceamt_' + val.id + '" value="0" placeholder="Enter Amount" />';
                                            html += '</div>';
                                              // provider
                                            html += '<div class="provide d-none col-md-12 provide_' + val.id + ' ">';
                                            html += '<div class="form-group ">';
                                            if (data.provider != '') {
                                            html += '<select class="form-control" name="subservice[' + data.mainservice + '][' + val.id + '][4]">';
                                            html += '<option value=""> Choose Provider </option>';
                                                $.each(data.provider, function(key, val) {
                                                    if (val.name !== undefined) {
                                                        html += '<option value="' + val.provideid + '">' + val.name + '</option>';
                                                    }
                                                });
                                            html += '</select>';
                                            }
                                            html += '</div>';
                                            html += '</div>';

                                            html += '<div class="col-md-6 form-group text-center ">';
											if(val.home != null){
                                            html += '<input type="radio" class="form-check-input rad1" name="subservice[' + data.mainservice + '][' + val.id + '][5]" checked  value="home" />  Home';
                                            }
                                            html += '</div>';
                                            html += '<div class="col-md-6 form-group text-center ">';
											if(val.clinic != null){
                                            html += '<input type="radio" class="form-check-input rad2" name="subservice[' + data.mainservice + '][' + val.id + '][5]" value="clinic" /> Clinic';
                                            }
                                            html += '</div>';
                                            

                                        html += '</div>';
                                    html += '</div>';

                                    html += '<div class="col-md-5 form-group ">';
                                    html += '<label class="text-primary">Remarks</label>';
                                    html += '<textarea class="form-control" data-id="' + val.id + '"  data-id="' + val.id + '" value="" placeholder="Enter Remarks" style="border: 1px solid #711685;" name="subservice[' + data.mainservice + '][' + val.id + '][9]" > </textarea>';
                                    var url = '{{ route("subservice.create", ":sid") }}';
                                    url = url.replace(':sid', "sid=" +val.service_id);
                                    html += '<a href="'+url+'" target="_blank" class="text-primary" > Add More Services</a>';
                                    html += '</div>';

                                            // html+= '<div class="row d-none amt_' + val.id + '">'
                                            // html += '<div class="col-md-3 form-group">';
                                            // html+='<label>Amount</label>';
                                            // html += '<input type="text" class="form-control amnt_'+val.id+'" name="subservice[' + data.mainservice + '][' + val.id + '][6]" value="0"/> ';
                                            // html += '</div>';
                                            // html += '<div class="col-md-3 form-group">';
                                            // html+='<label>Discount</label>';
                                            // html += '<input type="text" class="form-control damnt'+val.id+'" name="subservice[' + data.mainservice + '][' + val.id + '][7]" value="0"/> ';
                                            // html += '</div>';
                                            // html += '<div class="col-md-3 form-group">';
                                            // html+='<label>Total</label>';
                                            // html += '<input type="text" class="form-control singlamt tamnt'+val.id+'" name="subservice[' + data.mainservice + '][' + val.id + '][8]" value="0"/> ';
                                            // html += '</div>';
                                            // html += '<div class="col-md-3">';
                                            // html += '<button type="button" class="btn btn-info mt-4" onclick="cal('+val.id+')">Calculate</button>';
                                            // html += '</div>';
                                            // html+= '</div>';

                                    html += '</div>';
                                    html+= '<input type="hidden" class="subttl_'+data.mainservice+'">';

                                    // home clinic
                                    // html += '<div class="row d-none INHome_' + val.id + '">';
                                    // html += '<div class="col-md-3 form-group text-center ">';
                                    // html += '<input type="radio" class="form-check-input rad1" name="subservice[' + data.mainservice + '][' + val.id + '][5]" checked  value="home" />  Home';
                                    // html += '</div>';
                                    // html += '<div class="col-md-3 form-group text-center ">';
                                    // html += '<input type="radio" class="form-check-input rad2" name="subservice[' + data.mainservice + '][' + val.id + '][5]" value="clinic" /> Clinic';
                                    // html += '</div>';

                                    // html += '</div>';

                                    j++;
                                });
                            }
                            html += '</div>';
                            html += '</div>';

                            html += '<div class="border border-1 p-3 mb-3">';
                            html+= '<div class="row">';
                            html += '<div class="col-md-3 form-group">';
                            html+='<label>Amount</label>';
                            html += '<input type="text" class="form-control amnt_'+data.mainservice+'" name="servamnt['+data.mainservice+']" value="0"/> ';
                            html += '</div>';
                            html += '<div class="col-md-3 form-group">';
                            html+='<label>Discount(%)</label>';
                            html += '<input type="text" class="form-control damnt_'+data.mainservice+'" name="servdamnt['+data.mainservice+']" value="0"/> ';
                            html += '</div>';
                            html += '<div class="col-md-3 form-group">';
                            html+='<label>Total</label>';
                            html += '<input type="text" class="form-control tamnt_'+data.mainservice+' singlamt" name="servtamnt['+data.mainservice+']" value="0"/> ';
                            html += '</div>';
                            html += '<div class="col-md-3">';
                            html += '<button type="button" class="btn btn-info mt-4" onclick="cal('+data.mainservice+')">Calculate</button>';
                            html += '</div>';
                            html+= '</div>';
                            html+= '</div>';
                            
                            // html += '<div class="form-group col-md-12">';
                            // html += '<label>Amount </label>';
                            // html += '<input type="text" name="total_amount" class="form-control dramt" value="0" placeholder="Enter Amount" />';
                            // html += '</div>';

                        }
                        $('.append_data').append(html);
                    },

                });
            }

        });


        // close subservices box
        $('.append_data').on("click", '.closebox', function() {
        // $('.closebox').click(function() {
            var id = $(this).attr('data-id');
            
            var array = [];
            var arr = JSON.parse($(".mainserv").val());
            var val = $('#rowid_' + id).data("service");
             arr= jQuery.grep(arr, function(value) {
                return value != val;
                });
            array.push(JSON.stringify(arr));

            $(".mainserv").val(array);
            $('#rowid_' + id).remove();
            $('#sev_' + id).remove();
            
            //    alert(id);

        });



        $('.append_data').on("click", '.outsource', function() {
            var id = $(this).attr('data-id');
            $('.h_amt_' + id).removeClass('d-none');
            $('.provide_' + id).removeClass('d-none');
            $('.amt_' + id).removeClass('d-none');
            $('#priceamt_' + id).val(0);
           
        });
        $('.append_data').on("click", '.inhome', function() {
            var id = $(this).attr('data-id');
            var amt = $(this).attr('data-amt');
            $('.h_amt_' + id).removeClass('d-none');
            $('.amt_' + id).removeClass('d-none');
            $('.provide_' + id).addClass('d-none');
            $('#priceamt_' + id).val(amt);
        });

        $('.calsum').click(function() {
            var sum = 0;
            $(".singlamt").each(function() {
                sum += +$(this).val();
            });

            var tamt = $('.total_amt').val(sum);
            var dis = $('.disc').val();
            var damnt = (dis*sum)/100;
            var famt = sum - damnt ;
            // var famt = sum - dis;
            $('.final_amt').val(famt);
            // alert(sum);
        });

        $('.refr').change(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            var pid = $(this).val();

            $.ajax({
                url: "",
                type: "GET",
                data: {
                    pid: pid,
                },
                success: function(data) {
                    console.log(data);
                    var phone = data.phone;
                    var name = data.name;
                    if (!phone) {
                        var phone = "";
                    }
                    if (!name) {
                        var name = "";
                    }
                    $(".refr_phn").val(phone);
                    $(".refr_name").val(name);

                }
            });
        });

        $('.pros').change(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            var pid = $(this).val();

            $.ajax({
                url: "",
                type: "GET",
                data: {
                    pid: pid,
                },
                success: function(data) {
                    console.log(data);
                    var phone = data.phone;
                    var name = data.name;
                    if (!phone) {
                        var phone = "";
                    }
                    if (!name) {
                        var name = "";
                    }
                    $(".pro_phn").val(phone);
                    $(".pro_name").val(name);

                }
            });
        });

        var k=0;
        $('.tech_refr').change(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            var tid = $(this).val();

            $.ajax({
                url: "",
                type: "GET",
                data: {
                    tid: tid,
                },
                success: function(data) {
                    console.log(data);
                    var phone = data.phone;
                    if (!phone) {
                        var phone = "";
                    }
                    // $(".tech_phn_"+k).val(phone);
                }
            });
        });

        $(".cust_phn").blur(function() {
            var phone = $(this).val();
            if(phone.length != 10){
                $(".phone").text("please enter 10 digit");
                return false;
            }
            $(".phone").text("");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });
            $.ajax({
                url: "",
                type: "GET",
                data: {
                    phone: phone,
                },
                success: function(data) {
                    console.log(data);
                    if(data != ""){
                        $("#fname").val(data.fname);
                        $("#mname").val(data.mname);
                        $("#lname").val(data.lname);
                        $("#email").val(data.email);
                        $("#dob").val(data.dob);
                        $("#nation").val(data.nationality);
                        $("#city").val(data.city);
                        $("#state").val(data.state);
                        $("#area").val(data.area);
                        $("#haddr").val(data.address);
                        $("#age").val(data.age);
                        $("#pin").val(data.pincode);
                        $("#gender").val(data.gender);
                        $("#mem_id").val(data.mem_id);
                    }
                }
            });

        });
        $(".mem_id").blur(function() {
            var mem_id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });
            $.ajax({
                url: "",
                type: "GET",
                data: {
                    mem_id: mem_id,
                },
                success: function(data) {
                    console.log(data);
                    if(data != ""){
                    $("#fname").val(data.fname);
                    $("#mname").val(data.mname);
                    $("#lname").val(data.lname);
                    $("#email").val(data.email);
                    $("#dob").val(data.dob);
                    $("#nation").val(data.nationality);
                    $("#city").val(data.city);
                    $("#state").val(data.state);
                    $("#area").val(data.area);
                    $("#haddr").val(data.address);
                    $("#age").val(data.age);
                    $("#pin").val(data.pincode);
                    $("#gender").val(data.gender);
                    }
                }
            });
        });

        var i=1;
        $(".add_tech").click(function(){
            // var tech_rows = $(".apnd_tech").html();
            //  $("#apnd_tech").append('<div class="form-row apnd_tech" >'+tech_rows+'</div>');
            var tech_row = $(".tech").html();
            var servc_row = $(".servc").html();
            
             $("#apnd_tech").append('<div class="form-row apnd_tech " id="tech"><div class="col-md-12 mb-2" style="font-size: 13px;">Fill technician details</div><div class="form-group col-md-3 tech">'+tech_row+'</div><div class="form-group col-md-2"><label class="label"> Name*</label><input type="text" name="tech_name[]" class="form-control " placeholder="Technician Name"   /></div><div class="form-group col-md-2"><label class="label"> Phone*</label><input type="text" name="tech_phn[]" class="form-control phn tech_phn_'+i+'" placeholder="Technician Phone No." minlength="10" maxlength="10" /></div> <div class="form-group col-md-3"><label class="label"> Remarks</label><textarea name="tech_remark[]" rows="2" class="form-control" placeholder="Technician Remarks"></textarea></div><div class="form-group col-md-2"><label class="label">Commission*</label><input type="number" name="tech_com[]" class="form-control" placeholder="Technician Commission" /></div>  <div class="form-group col-md-4 servc">'+servc_row+'</div><div class="form-group col-md-9"><button type="button" class="btn btn-danger remv" id="remv">Remove</button></div></div>');
             i++;
             k++;
        });

        
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                }
            });

            $("#msform").submit(function(e){
                var form_data = $(this).serialize();
                e.preventDefault();
                e.stopPropagation();
                $(this).find("button[type='submit']").prop('disabled',true);
                $.ajax({
                    url:"{{route('admin.submitform')}}",
                    method:"post",
                    data:form_data,
                    success:function(data){
                        $("button[type='submit']").removeAttr('disabled');
                        console.log(data.success);
                        if(data.success){
                            toastr.success(data.success);
                            $("#msform").closest('form').find("input[type=text], textarea").val("");
                                $.each($("select option:selected"), function () {
                                        $("#msform").prop('selected', false); // <-- HERE
                                    });
                                $('input[type="checkbox"]').prop('checked', false);
                                $(".tech_ext").children().not(".apnd_tech").remove();
                                $(".append_data").remove();

                            location.reload();
                        }
                        if(data.error){
                            toastr.error(data.error);
                            $("button[type='submit']").removeAttr('disabled');
                        }
                    },
                    error:function(err)
                    {
                        $("button[type='submit']").removeAttr('disabled');
                        console.log(err);
                        toastr.error(err.responseText);
                        // $("#msform").closest('form').find("input[type=text], textarea,select").val("");
                        // $.each($("select option:selected"), function () {
                        //         $(this).prop('selected', false); // <-- HERE
                        // });
                        // $(".append_data").remove();
                        // $('input[type="checkbox"]').prop('checked', false);
                        // $(".tech_ext").children().not(".apnd_tech").remove();
                    }
                });
            });

             
        $.ajax({
                url:"{{route('admin.state')}}",
                method:"post",
                success:function(data){
                    console.log(data);
                }
        });
        
        $("#stat").change(function(){ 
            var data = $(this).val(); 
            $(".city").html("");
            
                $.ajax({
                        url:"{{route('admin.city')}}",
                        method:"post",
                        data:{
                            name:data,
                        },
                        success:function(data){
                            console.log(data);
                        }
                });

                $.ajax({
                        url:"",
                        method:"get",
                        data:{
                            name:data,
                        },
                        success:function(data){
                            console.log(data);
                            for(var i=0;i<data.length;i++){
                                $(".city").append("<option value="+data[i].name+">"+data[i].name+"</option>");
                            }
                            $(".city").append("<option value='cstm'>Other</option>");
                        }
                });
           
                $(".city").change(function(){
                    var city = $(this).val();
                    if(city=="cstm"){  
                        $(".city").replaceWith('<input type="text" class="form-control city" name="city" placeholder="Enter City">');
                    } 
                
                });
                if($(".city").attr("type") == "text"){
                    $(".city").replaceWith('<select id="city" name="city" class="form-control city" required></select>');
                }

            });
            $(".cash").blur(function(){ 
                var fm = $(".final_amt").val();
                    var camnt = $(this).val(); 
                    var tamnt = fm-camnt;
                    if(tamnt < 0){
                        var tamnt = 0;
                    }
                    $(".camnt").val(tamnt);
            });
            

            $(document).on("click","#remv",function(){
                $(this).closest('#tech').remove();
            });


    });
            

    function cal(id){   
        $(document).ready(function(){
            var amnt = 0;
            $(".singleamt_"+id).each(function(){
                amnt += +$(this).val();
            });
            $(".amnt_"+id).val(amnt);
            var dis = $(".damnt_"+id).val();

            var damnt = (dis*amnt)/100;
            var total = amnt - damnt ;
            // var total = amnt - dis ;
             $(".tamnt_"+id).val(total);
        });
    }

function showTech(){
    document.getElementById("techshow").classList.remove("d-none"); 
    $("#show_tech").attr("class","btn btn-info btn-xxs d-none");
    document.getElementById("remv_tech").classList.remove("d-none"); 
//     var value = JSON.parse($(".mainserv").val());
//     $(".checks input").each(function(index) {
//         var val = $(this).val();
//         if (value.includes(val)) {
//         $(this).prop('checked', true);
//         }
//   });

}

function hideTech(){
    $("#techshow").attr("class","d-none");
    document.getElementById("show_tech").classList.remove("d-none"); 
    $("#remv_tech").attr("class","btn btn-danger btn-xxs d-none");
}

 



</script>


@endsection