<?php if(is_user_logged_in()) {	?>
        <?php echo do_shortcode('[logout_to_home]'); ?>
        <?php } else { ?>
    <ul class="list-unstyled list-inline">
            <li>
              <button type="button" class="btn btn-primary btn-lg btn-lg log_in" data-toggle="modal" data-target="#myModal"><i class="fa fa-sign-out" aria-hidden="true"></i>
              Log in
              </button>
              <!--------/************* Login Form Code ************/--------->
              <!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog modal-full" role="document">
						<div class="modal-content model-cont modelcont-2">
							<div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <h4 class="modal-title" id="myModalLabel">Log in</h4>
							</div>

							<div class="modal-body">
								<div class="error-left">
								  <div class="alert alert-warning error-login" style="display:none;">
								   <strong>Error!</strong> Enter user and  password.</div>
                        <!--  <div class="error-login" style="display:none;"> <span>Error : </span>  Enter user and  password </div> -->
								<div class="error-login1" style="display:none;"> <span>Error : </span> Invalid user and password </div>
								</div>
								<?php echo do_shortcode('[pie_register_login]');?>
								
							</div>
                        <button type="button" class="btn_forget" data-dismiss="modal" data-toggle="modal" data-target="#myModal12">Forget Password?</button>
							<div class="facebook-login google-login">
								<h4>Or</h4>
								<p> Log In using your social media account : </p> 
								<?php echo do_shortcode('[miniorange_social_login]');?>
							</div>
                             <div class="modal-footer">
							  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>

						</div>
					</div>
				</div>
				 <!--------/************* Login Form Code Ends Here ************/--------->
            </li>

				<!--------/************* Forget Form Code Start Here ************/--------->
				 
				<div class="modal fade" id="myModal12" role="dialog">
				
					<div class="modal-dialog model-check">
					
					                   <!-- Modal content-->
						<div class="modal-content model-cont modelcont-2">
						
							<div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <h4 class="modal-title" id="myModalLabel">Forget Password?</h4>
							</div>

							<div class="modal-body">
							    <div class="success_msg"></div>
                                <div class="error-login-sin1 alert alert-warning" style="display:none;"> 
                                <span>Error : </span> All fields are required. </div>
						    <?php echo do_shortcode('[pie_register_forgot_password]');?>
							</div>

							 <div class="modal-footer forget-footer">
							  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
							
						</div><!---Div Class model-body ends here--->
						
					</div>
				</div>
				
				<!--------/************* Forget Form Code Ends Here ************/--------->
			
			
            <li>

              <button type="button" class="btn btn-primary btn-lg btn-lg log_in" data-toggle="modal" data-target="#myModal2">
			    <i class="fa fa-user-plus" aria-hidden="true"></i>
               Sign up
              </button> 

                <!------***************/ Registration Form  Code **************/ -->

                <div class="modal fade" id="myModal2" role="dialog">
				
				    <div class="modal-dialog">

						   <!-- Modal content-->
						<div class="modal-content">
								<div class="modal-header">
								  <button type="button" class="close" data-dismiss="modal">&times;</button>
								  <h4 class="modal-title">RaiseIt Registration</h4>
								</div>
							<div class="modal-body">
						
				            <!-- multi step Form  -->
							  
								<form id="msform" action="#" method="post" enctype="multipart/form-data">
										<!-- progressbar -->
										<ul id="progressbar">
											<li class="active">Account Setup</li>
											<li>Buisness Information</li>
											<li>Personal Details</li>
										</ul>
										<!-- fieldsets -->
										<fieldset>
											<h2 class="fs-title">Choose your account type</h2>
											<h3 class="fs-subtitle">This is step 1</h3>
											<div class="fs-error"></div>
											
											<p>Please select an options below whether you are a Retailer or Fundraiser :</p>
											
											<label class="radio-inline">
											<input type="radio" name="acc_type" value="retailer" checked="checked">Retailer</label>
											
											<label class="radio-inline">
											<input type="radio" name="acc_type" value="fundraiser">Fundraiser</label>
											
											<input type="button" name="next" class="next action-button" value="Next" />
										</fieldset>
										
										<!------/******************* Fundraiser Form Code *********************/ -->
										
										<fieldset class="fundraiser">					
											  <h2 class="fs-title">Fundraiser Details</h2>
											  <h3 class="fs-subtitle">Your event details</h3>
											  <div class="alert alert-warning fs-error-fund" style="display: none;"></div>
                                              <label>Event Name</label>
											  <input type="text" class="form-control"  name="fund_name" placeholder="Buisness Name" id="fund_name" />
											  <label>Address</label>
											  <input type="text" class="form-control"  name="fund_address" placeholder="Address" id="fund_address">
											  <label>Usual Other Address Fields</label>
											  <input type="text" class="form-control"  name="fund_correspondence_address" placeholder="" id="fund_other_addres">
											  <label>Choose Your Event Category:</label>
											  <?php wp_dropdown_categories($args); ?>
											  <br>
											  <label style="margin-top: 4%;">Tell us About Your Business</label>
                                              <textarea type=textarea" class="form-control" name="description" rows="3" placeholder="Tell Us About your Business" id="fund_description">
											  </textarea>
											   <!--<label>Start Event</label>
											  <input type="text" class="form-control"  name="rel_start_date" class="form-control" id="datepicker" placeholder="Start Event" />
											  <label>End Event</label>
											  <input type="text" class="form-control"  name="rel_end_date" class="form-control" id="datepicker1" placeholder="End Event" />-->
											  <label>Please Select Date to Start Your Event</label>
											  <input  class="form-control" type="text" placeholder="Select Event Date"  id="event_date" value="">
											  <label>Please Select Event Start Time</label>
											  <input id="fund_s_time" class="flatpickr flatpickr-input active" type="text" placeholder="Event Start Time" readonly="readonly" value="">
											  <label>Please Select Event End Time</label>
											  <input id="fund_e_time" class="flatpickr-2 flatpickr-input active" type="text" placeholder="Event End Time" readonly="readonly" value="">
											  <input type="button" name="previous" class="previous action-button" value="Previous" />
											  <input type="button" name="next" class=" action-button new_next_fund" value="Next" />
										</fieldset>
										
										<!------/******************* Retailer Form Code *********************/ -->
										
										<fieldset class="retailer">					
											  <h2 class="fs-title">Retailer Details</h2>
											  <h3 class="fs-subtitle">Your personal business details</h3>
											  <div class="alert alert-warning fs-error-buis" style="display: none;"></div>
											  <label>Business Name</label>
											  <input type="text" class="form-control"  name="buis_name" placeholder="Buisness Name"  id="buis_name"/>
											  <label>Address</label>
											  <input type="text" class="form-control"  name="address" placeholder="Address" id="buis_address">
											  <label>Usual Other Address Fields</label>
											  <input type="text" class="form-control"  name="buis_address_other" placeholder="" id="buis_address_other">
											  <label>Tell Us About your Business</label>
											  <textarea type=textarea" class="form-control" name="buis_description" id="buis_description" 
											  rows="3" placeholder  ="Tell Us About your Business">
											  </textarea>
											  <label> Upload an image :</label>
											  <input type="file" name="buis_img" id="buis_img" placeholder="Upload Image" accept="image/*">
											  <input type="button" name="previous" class="previous-ret action-button" value="Previous" />
											  <input type="button" name="next" class=" action-button new_next_ret" value="Next" />
										</fieldset>
										
										<!------/******************* Personal Detail Form Code *********************/ -->
										
										<fieldset class="final">
											<h2 class="fs-title">Personal Details</h2>
											<h3 class="fs-subtitle">We will never sell it</h3>
											<div class="alert alert-warning fs-error" style="display: none;"></div>
											<div class="alert alert-success fs-success" style="display: none;"></div>
											<input type="text" class="form-control"  name="fname" id="fname" placeholder="Your Name" />
											<!--<input type="text" name="lname" id="lname" placeholder="Last Name" />-->
											<input type="text" class="form-control" name="uemail" id="uemail" placeholder="Email" />
											<input type="password" class="form-control" name="pass" id="pass" placeholder="Password" />
											<input type="password" class="form-control" name="cpass" id="cpass" placeholder="Confirm Password" />
											<input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Zipcode" />											
											<input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" />
											<textarea name="address" class="form-control" id="address" placeholder="Address"></textarea>
											<input type="button" name="previous" class="previous-final action-button" value="Previous" />
											<input type="submit" name="submit" class="submit action-button" value="Submit" />							
										</fieldset>
										
								</form>
									
								  <div class="facebook-login">
								  
								  <h4>Or</h4>
								  
								  <p> Sign Up using your social media account : </p> 
								  
								  <?php echo do_shortcode('[miniorange_social_login]');?>
								  </div>
							</div> <!---Div Class model-body ends here--->
							
							<div class="modal-footer forget-footer">
							  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
				  
				    </div> <!-- Div with classes model-dialog ends here -->
				</div> <!--- Div with classes model fade ends here -->

            </li>
    </ul>
<?php } ?>