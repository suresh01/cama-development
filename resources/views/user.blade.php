<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Users</title>
@include('includes.header', ['page' => 'admin'])
	<!--<div class="page_title">
		<span class="title_icon"><span class="blocks_images"></span></span>
		<h3>Users</h3>
		<div class="top_search">
			<form action="#" method="post">
				<ul id="search_box">
					<li>
					<input name="" type="text" class="search_input" id="suggest1" placeholder="Search...">
					</li>
					<li>
					<input name="" type="submit" value="" class="search_btn">
					</li>
				</ul>
			</form>
		</div>
	</div>-->
	<div id="content">
		<div class="grid_container">
			
		@if ($errors->any())
			<script>
				$(document).ready(function(){
				    $("#usertable").hide();
				 	$("#adduserform").show();
		 			$("#resetpwd").hide();
				});
			</script>
			<div id="err_lbl">
       
            @foreach ($errors->all() as $error)
            	<div>
            		<label for="confirm_password"  generated="true" class="error">{{ $error }}</label>
            	</div>
              
            @endforeach
      
    		</div>
			
		@endif

			
		@if(Session::has('not_msg'))
			@if(Session::get('not_msg') != '')
			<script>
				var message = "{{ Session::get('not_msg')}}";
				$( document ).ready(function() {
        
					var noty_id = noty({
						layout : 'top',
						text: message,
						modal : true,
						type : 'success', 
					});
					{{session(['not_msg' => ''])}}
	        		
   				 });
			</script>
			@endif

		@endif
		
		
		<div id="usertable" class="grid_12">
	
			<br>
			<div class="form_input">
				<button id="adduser" onclick="openAddUser()" name="btnadduser" type="button" class="btn_small btn_blue"><span>Add User</span></button>

				<div id="breadCrumb3" style="float:right;" class="breadCrumb grid_3">
					<ul >
						<li><a href="#">Home</a></li>
						<li><a href="#">Admin</a></li>
						<li><a href="#">User Management</a></li>
						<li>Users</li>
					</ul>
				</div>
			</div>
		
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table class="display data_tbl">
					<thead style="text-align: left;">
			  		<tr>
							<th class="table_sno">
								 S No
							</th>
							<th>
								 User Name
							</th>
							<th>
								 Position
							</th>
							<th>
								 Position2
							</th>
							<th>
								 Reserved
							</th>
							<th>
								 Role
							</th>
							<th>
								 Status
							</th>
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
							@foreach ($user as $rec)
							<tr>
								<td>
									{{$loop->iteration}}
								</td>
								<td>
									 {{ $rec->usr_name }}
								</td>
								<td>
									 {{ $rec->usr_position }}
								</td>
								<td>
									 {{ $rec->usr_position2 }}
								</td>
								<td >
									 {{ $rec->usr_isreserved }}
								</td>
								<td >
									 {{ $rec->rol_name }}
								</td>
								<td>
									@if( $rec->usr_islock == 0)
										Active
									@else
										In Active
									@endif
								</td>
								<td class="">
									<span><a class="action-icons c-edit" href="#" onclick="openEditUser({{ $rec->usr_id }})" title="Edit">Edit</a></span>
									<span><a class="action-icons c-Delete delete_usr" onclick="deleteUser({{ $rec->usr_id }})" href="#" title="Delete">Delete</a></span>
								</td>
							</tr>
						<div style="display:none">
							<input type="hidden" id="eusername_{{ $rec->usr_id }}" value="{{ $rec->usr_name }}">
							<input type="hidden" id="eposition_{{ $rec->usr_id }}" value="{{ $rec->usr_position }}">
							<input type="hidden" id="eposition2_{{ $rec->usr_id }}" value="{{ $rec->usr_position2 }}">
							<input type="hidden" id="eisreserved_{{ $rec->usr_id }}" value="{{ $rec->usr_isreserved }}">
							<input type="hidden" id="eaddress_{{ $rec->usr_id }}" value="{{ $rec->usr_address }}">
							<input type="hidden" id="eiphoneno_{{ $rec->usr_id }}" value="{{ $rec->usr_nophone }}">
							<input type="hidden" id="erole_{{ $rec->usr_id }}" value="{{ $rec->usr_role_id }}">
							<input type="hidden" id="erolename_{{ $rec->usr_id }}" value="{{ $rec->rol_name }}">
							<input type="hidden" id="email_{{ $rec->usr_id }}" value="{{ $rec->usr_email }}">
							<input type="hidden" id="efname_{{ $rec->usr_id }}" value="{{ $rec->usr_firstname }}">
							<input type="hidden" id="elname_{{ $rec->usr_id }}" value="{{ $rec->usr_lastname }}">
							<input type="hidden" id="estatus_{{ $rec->usr_islock }}" value="{{ $rec->usr_islock }}">	
						</div>
						@endforeach
						</tbody>
						</table>
					</div>
				</div>
			</div>
				
		
		
		<div id="adduserform" style="display:none" class="grid_10 full_block">
			<div class="widget_wrap">
				<div class="widget_content">
					<h3 id="title">Add User</h3>
					<form id="usertransform" onsubmit="changeText()" autocomplete="off" class="" method="post" action="usertrn" >
						@csrf
						<input type="hidden" value="{{ old('operation') }}" name="operation" id="operation">
						<input type="hidden" value="{{ old('userid') }}" name="userid" id="userid">
						<input type="hidden" name="delusername" id="delusername">
						<input type="hidden" value="{{ old('password') }}" name="password" id="password">
						<input type="hidden" value="{{ old('randomid') }}" name="randomid" id="randomid">
						<input type="hidden" value="{{ old('role_id') }}" name="role_id" id="role_id">
						<div  class="grid_6 form_container left_label">
							<ul>
								<li>								
									<div class="form_grid_12">									
										<label class="field_title" id="luserid" for="userid">User Name<span class="req">*</span></label>
										<div class="form_input">
											<input id="username" required="true" onchange="checkusername()" name="username" type="text"  value="{{ old('username') }}" />
										</div>
										<span class=" label_intro"></span>
									</div>
								
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">Role<span class="req">*</span></label>
										<div class="form_input ">
											<select style="width: 100%;" data-placeholder="Choose a Role..." class="cus-select" id="role" name="role" tabindex="20">
												@foreach ($role as $rec)
													<option value='{{ $rec->rol_id }}'>{{ $rec->rol_name }}</option>
												@endforeach											
											</select>
										</div>
										<span class=" label_intro"></span>
									</div>
								
									<div class="form_grid_12">
										<label class="field_title" id="lfname" for="fname">First Name<span class="req">*</span></label>
										<div class="form_input">
											<input id="fname" name="fname" required="true" type="text" value="{{ old('fname') }}" />
										</div>
										<span class=" label_intro"></span>
									</div>
								
									<div class="form_grid_12">
										<label class="field_title" id="llname" for="lname">Last Name<span class="req">*</span></label>
										<div class="form_input">
											<input id="lname" name="lname" required="true" type="text" value="{{ old('lname') }}" />
										</div>
										<span class=" label_intro"></span>
									</div>
								
								
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">Position<span class="req">*</span></label>
										<div class="form_input">
											<input id="position" name="position" required="true" type="text" value="{{ old('position') }}" />
										</div>
										<span class=" label_intro"></span>
									</div>
								
								
									<div class="form_grid_12">
										<label class="field_title" id="lposition2" for="position2">Position 2</label>
										<div class="form_input">
											<input id="position2" name="position2" type="text" value="{{ old('position2') }}" />
										</div>
										<span class=" label_intro"></span>
									</div>
								</li>
							</ul>
						</div>
						<div  class="grid_6 form_container left_label">
						<ul>

								<li>
								
									<div class="form_grid_12">
										<label class="field_title" id="lphoneno" for="phoneno">Tel No.<span class="req">*</span></label>
										<div class="form_input">
											<input id="phoneno" name="phoneno" type="text"required="true"  value="{{ old('phoneno') }}" />
										</div>
										<span class=" label_intro"></span>
									</div>
								
								
									<div class="form_grid_12">
										<label class="field_title" id="laddress" for="address">Address<span class="req">*</span></label>
										<div class="form_input">
											<input id="address" name="address" type="text" required="true" value="{{ old('address') }}" />
										</div>
										<span class=" label_intro"></span>
									</div>
								

									<div class="form_grid_12">
										<label class="field_title" id="lmail" for="mail">Email<span class="req">*</span></label>
										<div class="form_input">
											<input id="mail" name="mail" type="email" required="true" value="{{ old('mail') }}" />
										</div>
										<span class=" label_intro"></span>
									</div>
								

									<div class="form_grid_12">
										<label class="field_title" id="lnokp" for="nokp">nokp</label>
										<div class="form_input">
											<input id="nokp" name="nokp" type="text"  value="{{ old('nokp') }}" />
										</div>
										<span class=" label_intro"></span>
									</div>						
							
									<div class="form_grid_12">
										<label class="field_title" id="status" for="status">Status<span class="req">*</span></label>
										<div class="form_input">
											<select style="width: 100%;" data-placeholder="Choose a Status..." class="cus-select" id="status" name="status"  tabindex="20">
												<option value='0'>Active</option>			
												<option value='1'>In Active</option>
											</select>
										</div>
										<span class=" label_intro"></span>
									</div>	
								
									<div class="form_grid_12">
										<label class="field_title" id="lreserved" for="reserved">Reserved<span class="req">*</span></label>
										<div class="form_input">
											<select style="width: 100%;" data-placeholder="Choose a Status..." class="cus-select" id="reserved" name="reserved" tabindex="20">
												<option value='0'>False</option>			
												<option value='1'>True</option>
											</select>
										</div>
										<!--<input type="hidden" name="reserved" id="hreserved" value="0">-->
										<span class=" label_intro"></span>
									</div>
								</li>
								
							</ul>
						</div>
						<div style="height: 48px; float: none; display: -webkit-box;text-align: -webkit-center;" class="grid_12">
							
									<div class="form_input">
										<button id="addsubmit" name="adduser" type="submit" class="btn_small btn_blue"><span>Submit</span></button>									
										<button id="resetpwd" name="reset" type="button" class="confirm btn_small btn_blue"><span>Reset Password</span></button>
																
										<button id="close" onclick="closeAddUser()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>
										<span class=" label_intro"></span>
									</div>
								
									<span class="clear"></span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<span class="clear"></span>
	<!--<div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Tutorials
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a tabindex="-1" href="#">HTML</a></li>
      <li><a tabindex="-1" href="#">CSS</a></li>
      <li class="dropdown-submenu">
        <a class="test" tabindex="-1" href="#">New dropdown <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
          <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
          <li class="dropdown-submenu">
            <a class="test" href="#">Another dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">3rd level dropdown</a></li>
              <li><a href="#">3rd level dropdown</a></li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </div>-->
	<script>
	function changeText(){
			$("#addsubmit").text("Submitting...");

	}
	function deleteUser(id){
		$("#userid").val(id);
		$("#operation").val(3);
		$("#delusername").val($("#eusername_"+id).val());
	}

	function openAddUser(){
		$('#username').removeAttr('readonly');
		$('#addsubmit').removeAttr('disabled');
		$("#title").html("Add User");
		$("#userid").val("0");
		$("#username").val("");
		$("#fname").val("");
		$("#lname").val("");
		$("#position").val("");
		$("#position2").val("");
		//$("#adduserform").val($("#eisreserved_"+id).val());
		$("#address").val("");
		$("#phoneno").val("");		
		$("#role").val("");	
		$("#mail").val("");	
		$("#operation").val(1);
		$("#usertable").hide();
		$("#adduserform").show();
		$("#resetpwd").hide();
		$("#addsubmit").html("Save");
	 	$("label.error").remove();	

	}
	function closeAddUser(){
		$('#addsubmit').removeAttr('disabled');		
		$("#userid").val("");
		$("#username").val("");
		$("#position").val("");
		$("#position2").val("");
		//$("#adduserform").val($("#eisreserved_"+id).val());
		$("#address").val("");
		$("#phoneno").val("");
		$("#role").val("");
		$("#operation").val(1);
		$("#usertable").show();
		$("#adduserform").hide();
	 	$('#err_lbl').html('');
	 	$("label.error").remove();
	}

	function openEditUser(id) {
		$("#addsubmit").html("Update");	
		$("#title").html("Update User");	

		$('#username').attr('readonly', "readonly");
		$("#userid").val(id);
		$("#fname").val($("#efname_"+id).val());
		$("#lname").val($("#elname_"+id).val());
		$("#username").val($("#eusername_"+id).val());
		$("#position").val($("#eposition_"+id).val());
		$("#position2").val($("#eposition2_"+id).val());
		//$("#adduserform").val($("#eisreserved_"+id).val());
		$("#address").val($("#eaddress_"+id).val());
		$("#phoneno").val($("#eiphoneno_"+id).val());
		$("#role").val($("#erole_"+id).val());		
		$('#reserved').val($("#eisreserved_"+id).val() );
		$('#status').val($("#estatus_"+id).val() );

		if($("#eisreserved_"+id).val() == 1){
			
			$('#addsubmit').attr('disabled', "disabled");
		} 

		$("#reserved").val($("#eisreserved_"+id).val());
		
		$("#role_id").val($("#erole_"+id).val());		
		$("#mail").val($("#email_"+id).val());

		$("#operation").val(2);
		$("#usertable").hide();
		$("#adduserform").show();		
		$("#resetpwd").show();
	 	$("label.error").remove();
	}

	function resetPwd(){
	    var r = confirm("Do you want to reset password?");
	    if (r == true) {
	        //txt = "You pressed OK!";
	        $("#resetpwd").prop('disabled', true);
			$("#resetpwd").text("Resetting...");
	        var username = $("#username").val();
	        var mail = $("#mail").val();
	        var haspwd = "password";
	        $.ajax({
		        type:'GET',
		        url:'resetpassword',
		        data:{password:haspwd,username:username,mail:mail},
		        success:function(data){	        	
		        	if(data.msg === "true"){
		        		var noty_id = noty({
						layout : 'top',
						text: 'Password reset successfully!',
						modal : true,
						type : 'success', 
						 });
		        		//return;
						$("#resetpwd").text("Reset Password");
	        			$("#resetpwd").prop('disabled', false);
		        	} 
	        }
	    	});
	    }    
	}

	function checkusername(){
		var d=new Date();
		$("#resetpwd").prop('disabled', true);
	        var username = $("#username").val();
	        $.ajax({
		        type:'GET',
		        url:'getValidUser?date='+ d.getTime(),
		        data:{username:username},
		        success:function(data){	        	
		        	if(data.msg === "false"){
		        		alert("user name already exsist.");
		        		$("#username").focus();
		        		return false;
		        	} 
	        }
	    	});
	    	return true;
	}
</script>

</div>
</body>
</html>