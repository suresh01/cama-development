<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Module</title>
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
				<button id="adduser" onclick="openAddUser()" name="btnadduser" type="button" class="btn_small btn_blue"><span>Add Module</span></button>

				<div id="breadCrumb3" style="float:right;" class="breadCrumb grid_3">
					<ul >
						<li><a href="#">Home</a></li>
						<li><a href="#">Admin</a></li>
						<li><a href="#">User Management</a></li>
						<li>Module</li>
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
								Module Id
							</th>
							<th>
								Name
							</th>
							<th>
								Parent
							</th>
							<th>
								Description
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
						@foreach ($module as $rec)
						<tr >
							<td>
								{{$loop->iteration}}
							</td>
							<td>
								 {{ $rec->mod_id }}
							</td>
							<td>
								 {{ $rec->mod_name }}
							</td>
							
							<td>{{ $rec->mod_name }}
								 
							</td>
							
							<td>
								 {{ $rec->mod_description }}
							</td>
							<td class="">
								 {{ $rec->mod_iscanselect }}
							</td>
							
							<td class="">
								<span><a class="action-icons c-edit" onclick="openEditRole({{ $rec->mod_id }})" href="#" title="Edit">Edit</a></span>
							</td>
						</tr>
						<div style="display:none">
							<input type="hidden" id="ename_{{ $rec->mod_id }}" value="{{ $rec->mod_name }}">
							<input type="hidden" id="edescription_{{ $rec->mod_id }}" value="{{ $rec->mod_description }}">
							<input type="hidden" id="epermission_{{ $rec->mod_id }}" value="{{ $rec->mod_iscanselect }}">	
							<input type="hidden" id="eparent_{{ $rec->mod_id }}" value="{{ $rec->mod_parent }}">							
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
					<form id="signupform" autocomplete="off" onsubmit="return blockParent(2);" method="post" action="moduletrn" class="form_container left_label">
						<ul>
							<li>
							@csrf
							<input type="hidden" name="operation" id="operation">

							<div class="form_grid_12">
								<label class="field_title" id="lmodule_id" for="module_id">Module Id<span class="req">*</span></label>
								<div style="width:54%;" class="form_input">
									<input id="module_id" name="module_id" type="number" value="" maxlength="100" class="large required">
								</div>
								<span class=" label_intro"></span>
							</div>
							
							
							<div class="form_grid_12">
								<label class="field_title" id="lusername" for="username">Name<span class="req">*</span></label>
								<div style="width:54%;" class="form_input">
									<input id="modulename" name="modulename" type="text" value="" maxlength="100" class="large required">
								</div>
								<span class=" label_intro"></span>
							</div>
							
							<div class="form_grid_12">
								<label class="field_title" id="lposition" for="position">Description<span class="req">*</span></label>
								<div style="width:54%;" class="form_input">
									<input id="description" name="description" type="text" value="" maxlength="50" class="large required"/>
								</div>
								<span class=" label_intro"></span>
							</div>
							
							<div class="form_grid_12">
								<label class="field_title" id="llevel" for="level">Parent<span class="req">*</span></label>
								<div class="form_input">
									<select style="width:39.3%;" data-placeholder="Choose a Parent..." class="cus-select" id="moduleid" name="parent" tabindex="20">
										<option value="0">Root</option>
										@foreach ($module as $rec)
											@if($rec->mod_parent == 0 )	
														<option value="{{ $rec->mod_id }}"> {{ $rec->mod_name }}  </option>
											@endif
											@foreach ($module as $sub_rec)
												@if($rec->mod_id == $sub_rec->mod_parent && $rec->mod_parent == 0)	
														<option value="{{ $sub_rec->mod_id }}">  {{ $rec->mod_name }} ->{{ $sub_rec->mod_name }}   </option>							
												@endif
												@foreach ($module as $sub_sub_rec)
													@if($rec->mod_id == $sub_rec->mod_parent && $sub_rec->mod_id == $sub_sub_rec->mod_parent && $rec->mod_parent == 0)
														<option value="{{ $sub_sub_rec->mod_id }}">  {{ $rec->mod_name }} ->{{ $sub_rec->mod_name }}-> {{ $sub_sub_rec->mod_name }}   </option>	
													@endif
													@foreach ($module as $sub_sub_sub_rec)
														@if($rec->mod_id == $sub_rec->mod_parent && $sub_rec->mod_id == $sub_sub_rec->mod_parent && $sub_sub_rec->mod_id == $sub_sub_sub_rec->mod_parent && $rec->mod_parent == 0)	
															<option onclick="blockParent(1)" value="{{ $sub_sub_sub_rec->mod_id }}">  {{ $rec->mod_name }} ->{{ $sub_rec->mod_name }}-> {{ $sub_sub_rec->mod_name }}-> {{ $sub_sub_sub_rec->mod_name }}   </option>		
														@endif		
													@endforeach	
												@endforeach											
											@endforeach
										@endforeach
									</select>
								</div>
								<span class=" label_intro"></span>
							</div>
							
							
							<div class="form_grid_12">
								<label class="field_title" id="lstatus" for="level">Status<span class="req">*</span></label>
								<div class="form_input">
									<select style="width:39.3%;" data-placeholder="Choose a Status..." class="cus-select" id="status" name="status" tabindex="20">
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
									<button id="addsubmit" onclick="changeText()" name="adduser" type="submit" class="btn_small btn_blue"><span>Submit</span></button>												
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
		$('#module_id').removeAttr('disabled');
		$("#title").html("Add Module");
		$("#addsubmit").html("Save");	
		$("#module_id").val("");
		$("#modulename").val("");
		$("#description").val("");
		$("#moduleid").val("");
		$("#status").val("");
		$("#operation").val(1);
		 $("#usertable").hide(600);
		 $("#adduserform").show(200);
	 	$("label.error").remove();
	}
	function closeAddUser(){
		$("#module_id").val("");
		$("#modulename").val("");
		$("#description").val("");
		$("#moduleid").val("");
		$("#status").val("");
		 $("#usertable").show(200);
		 $("#adduserform").hide(600);
	 	$('#err_lbl').html('');
	 	$("label.error").remove();
	}

	function openEditRole(id){
		$("#title").html("Update Module");
		$("#addsubmit").html("Update");	
		$('#module_id').attr('disabled', "disabled");
		$("#module_id").val(id);
		$("#modulename").val($("#ename_"+id).val());
		$("#description").val($("#edescription_"+id).val());
		$("#moduleid").val($("#eparent_"+id).val());
		$("#status").val($("#epermission_"+id).val());
		$("#operation").val(2);
		 $("#usertable").hide(600);
		 $("#adduserform").show(200);	
	 	$("label.error").remove();	
	}
</script>
</body>
</html>