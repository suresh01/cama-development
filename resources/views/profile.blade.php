<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Profile</title>
@include('includes.header', ['page' => ''])
	<div id="content">
		<div class="grid_container">
				<br>
				<div id="breadCrumb3" style="float:right;" class="breadCrumb grid_1">
					<ul >
						<li><a href="#">Home</a></li>
						<li>Profile</li>
					</ul>
				</div>
				<br><br><br>
			<div class="grid_8 full_block">
				<div class="widget_wrap">
					
					<div class="widget_content">
						<h3>Profile</h3>
						
						<form action="#" method="post">
							<div  class="grid_6 form_container left_label">
								@foreach ($profile as $rec)
							<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Username</label>
									<div class="form_input">
										<input readonly="readonly" required="required" id="username" value="{{ $rec -> usr_name}}" name="username" type="text" tabindex="1" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Last Name</label>
									<div class="form_input">
										<input readonly="readonly" required="required" id="lastname" value="{{ $rec -> usr_lastname}}" name="lastname" type="text" tabindex="3"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Position</label>
									<div class="form_input">
										<input readonly="readonly" required="required"  id="position" value="{{ $rec -> usr_position}}" name="position" type="text" tabindex="5" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Address</label>
									<div class="form_input">
										<input readonly="readonly" id="address" value="{{ $rec -> usr_address}}" name="address" type="text" tabindex="7"/>
									</div>
								</div>
								</li>
							</ul>
						</div>
						<div class="grid_6 form_container left_label">
							<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title">First Name</label>
									<div class="form_input">
										<input readonly="readonly" required="required"  id="firstname" value="{{ $rec -> usr_firstname}}" name="firstname" type="text" tabindex="2" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Position 2</label>
									<div class="form_input">
										<input readonly="readonly" value="{{ $rec -> usr_position2}}" name="position2" id="position2" type="text" tabindex="4"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Email Id</label>
									<div class="form_input">
										<input readonly="readonly" required="required" value="{{ $rec -> usr_email}}" id="emailid" name="email" type="email" tabindex="6"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Phone Number</label>
									<div class="form_input">
										<input readonly="readonly" required="required" value="{{ $rec -> usr_nophone}}" name="phoneno" id="phoneno" type="text" tabindex="8"/>
									</div>
								</div>
								</li>
							</ul>
							@endforeach
						</div>
						
						<div style="  float: none; " class="grid_12">
							<ul style="display:none;text-align: -webkit-center;">
								<li>
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue"><span>Update</span></button>
										<button type="button" onclick="editProfile()" class="btn_small btn_gray"><span>Edit</span></button>
									</div>
								</li>
							</ul>
							<span class="clear"></span>					
						</div>
					</form>
					
					</div>
				</div>
			</div>

			<div class="grid_4 full_block">
				<div class="widget_wrap">
					<div id="err_lbl">     
						@if (session('error'))
					
	                        <div>
	                        	<label for="confirm_password"  generated="true" class="error">
	                            {{ session('error') }}</label>
	                        </div>
	                    @endif

		@if(Session::has('message'))
			@if(Session::get('message') != '')
			<script>
				var message = "{{ Session::get('message')}}";
				$( document ).ready(function() {
        
					var noty_id = noty({
						layout : 'top',
						text: message,
						modal : true,
						type : 'success', 
					});
					{{session(['message' => ''])}}
	        		
   				 });
			</script>
			@endif

		@endif
                       
                    </div>

					<div class="widget_content">
						<h3>Change Password</h3>
						<form action="{{ route('changePassword') }}" method="post">
							{{ csrf_field() }}
							<div style="float: none;" class="grid_12 form_container left_label">								
								<ul>
									<li>
										<div class="form_grid_12">
											<label class="field_title">Currsnt Password<span class="req">*</span></label>
											<div class="form_input">
												<input required="ture" class="required" value="" name="current-password" type="password" tabindex="11" />
											</div>
										</div>
									</li>
									<li>
										<div class="form_grid_12">
											<label class="field_title">New Password<span class="req">*</span></label>
											<div class="form_input">
												<input required="ture" value="" id="password" name="password" type="password" tabindex="12"/>
											</div>
										</div>
									</li>
									<li>
										<div class="form_grid_12">
											<label class="field_title">Confirm Password<span class="req">*</span></label>
											<div class="form_input">
												<input required="ture" value="" id="confirm_password" name="confirm_password" type="password" tabindex="13"/>
											</div>
										</div>
									</li>
									<li>
										<div style="float:none;" class="form_grid_12">
											<div class="form_input">
												<button type="submit" class="btn_small btn_blue"><span>Change Password</span></button>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
	<script>
		function editProfile() {
			removeAttrbute("firstname,lastname,emailid,phoneno,address");
		}
	</script>
</body>
</html>