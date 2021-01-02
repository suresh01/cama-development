<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Roles</title>
@include('includes.header', ['page' => 'admin'])
	
	<div id="content">
		<div class="grid_container">
		@if ($errors->any())
			<script>
				$(document).ready(function(){
				    $("#usertable").hide();
				 	$("#adduserform").show();
				});
			</script>
			<div id="err_lbl">
				<label for="confirm_password"  generated="true" class="error">Please Enter all mandantory fileds</label>
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
				<button id="adduser" onclick="openAddUser()" name="btnadduser" type="button" class="btn_small btn_blue"><span>Add Role</span></button>

				<div id="breadCrumb3" style="float:right;" class="breadCrumb grid_3">
					<ul >
						<li><a href="#">Home</a></li>
						<li><a href="#">Admin</a></li>
						<li><a href="#">User Management</a></li>
						<li>Role</li>
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
								Role
							</th>
							<th>
								Description
							</th>
							<th>
								Access
							</th>
							<th>
								Action
							</th>
							
						</tr>
						</thead>
						<tbody>
							@foreach ($role as $rec)
						<tr>
							<td>
								{{$loop->iteration}}
							</td>
							<td>
								 {{ $rec->rol_name }}
							</td>
							<td>
								 {{ $rec->rol_description }}
							</td>
							<td class="">
								 {{ $rec->rol_access }}
							</td>
							
							<td class="">
								<span><a class="action-icons c-edit" href="#" onclick="openEditRole({{ $rec->rol_id }})" title="Edit">Edit</a></span>
							</td>
						</tr>
						<div style="display:none">
							<input type="hidden" id="ename_{{ $rec->rol_id }}" value="{{ $rec->rol_name }}">
							<input type="hidden" id="edescription_{{ $rec->rol_id }}" value="{{ $rec->rol_description }}">
							<input type="hidden" id="eaccess_{{ $rec->rol_id }}" value="{{ $rec->rol_access }}">
							
						</div>
						@endforeach
						</table>
					</div>
				</div>
			</div>
				
		
		
		<div id="adduserform" style="display:none" class="grid_12">
			<div class="widget_wrap">
				
				<div class="widget_content">
					<h3 id="title">Add User</h3>
					<form id="signupform" onsubmit="changeText()" autocomplete="off" method="post" action="roletrn" class="form_container left_label">
						<ul>
							<li>
							
							@csrf
								<input type="hidden" name="operation" id="operation">
								<input type="hidden" value="0" name="role_id" id="roleid">
							<div class="form_grid_12">
								<label class="field_title" id="lusername" for="username">Role Name<span class="req">*</span></label>
								<div  class="form_input">
									<input id="rolename" style="width:28.5%"  name="rolename" class="required" type="text" value="" maxlength="100" class="large">
								</div>
								<span class=" label_intro"></span>
							</div>
							
							<div class="form_grid_12">
								<label class="field_title" id="lposition" for="position">Description<span class="req">*</span></label>
								<div  class="form_input">
									<input id="description" style="width:28.5%"  name="description" class="required" type="text" value="" maxlength="50" class="large"/>
								</div>
								<span class=" label_intro"></span>
							</div>
							
							<div class="form_grid_12">
								<label class="field_title" id="llevel" for="level">Status<span class="req">*</span></label>
								<div  class="form_input">
									<select data-placeholder="Choose a Status..." style="width:28.5%" class="cus-select" id="status" name="access" tabindex="20">
										<option value="0">Active</option>
										<option value="1">InActive</option>
									</select>
								</div>
								<span class=" label_intro"></span>
							</div>
							
							</li>
							<li>
							<div class="form_grid_12">
								<div class="form_input">
									<button id="addsubmit" name="adduser" type="submit" class="btn_small btn_blue"><span>Submit</span></button>											
									<button id="close" onclick="closeAddUser()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>
								</div>
							</div>
							</li>
						</ul>
					</form>
				</div>
			</div>
		</div>
	
	</div>
	<span class="clear"></span>
	
	
</div>
<script>
	function changeText(){
		$("#addsubmit").text("Submitting...");

	}
	function openAddUser(){
		$("#title").html("Add Role");
		$("#addsubmit").html("Save");	
		$("#rolename").val("");
		$("#description").val("");
		$("#access").val("");
		$("#operation").val(1);
		 $("#usertable").hide(600);
		 $("#adduserform").show(200);
	 	$("label.error").remove();
	}

	function closeAddUser(){
		$("#rolename").val("");
		$("#description").val("");
		$("#access").val("");
	 	$("#usertable").show(200);
	 	$("#adduserform").hide(600);
	 	$('#err_lbl').html('');
	 	$("label.error").remove();
	}

	function openEditRole(id){

		$("#title").html("Update Role");
		$("#addsubmit").html("Update");	
		$("#roleid").val(id);
		$("#rolename").val($("#ename_"+id).val());
		$("#description").val($("#edescription_"+id).val());
		$("#status").val($("#eaccess_"+id).val());
		$("#operation").val(2);
		$("#usertable").hide(600);
		$("#adduserform").show(200);
	 	$("label.error").remove();
		//$(".chzn-single").find('span').append($("#ename_"+id).val());
		//$( "#status_chzn_o_1" ).last().addClass("result-selected" );
	}

	function validationerr(){		
		 $("#usertable").hide(600);
		 $("#adduserform").show(200);
	}
</script>

</body>
</html>