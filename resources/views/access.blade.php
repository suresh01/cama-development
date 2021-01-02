<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Access</title>
@include('includes.header', ['page' => 'admin'])
	
	<div id="content">
		<div class="grid_container">

			<br>
			
					<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
					<ul >
						<li><a href="#">Home</a></li>
						<li><a href="#">Admin</a></li>
						<li><a href="#">User Management</a></li>
						<li>Access</li>
					</ul>
				</div>
			</div>
			<br><br>
				<div class="widget_wrap">					
					<div class="widget_content">
			<div id="sidetree" class="grid_6 widget_wrap">
			<div class="treeheader widget_top">
				<h6>Module</h6>
			</div>
			<div id="sidetreecontrol" class="white_gel">
				<a href="?#">Collapse All</a> | <a href="?#">Expand All</a>
			</div>
			<ul class="treeview" id="tree">
				@foreach ($accessv as $rec)

				@if($rec->mod_parent == 0 )		
					@if($rec->childcount == 0)						
						<li class="{{ $loop->iteration >= $rec->sibilingcount ? 'last' : '' }}"><a onclick="openEditRole({{ $rec->mod_id }})" href="#">({{ $rec->mod_id }}) {{ $rec->mod_name }}   </a></li>		
						<input type="hidden" id="ename_{{ $rec->mod_id }}" value="{{ $rec->mod_name }}">
							<input type="hidden" id="eparent_{{ $rec->mod_id }}" value="{{ $rec->mod_parent }}">
							<input type="hidden" id="eroleid_{{ $rec->mod_id }}" value="{{ $rec->rol_id }}">

					@else
					<li class="expandable">
					<div class="hitarea expandable-hitarea">
					</div>
					<a onclick="openEditRole({{ $rec->mod_id }})" href="#">({{ $rec->mod_id }}) {{ $rec->mod_name }}</a>	
					<input type="hidden" id="ename_{{ $rec->mod_id }}" value="{{ $rec->mod_name }}">
							<input type="hidden" id="eparent_{{ $rec->mod_id }}" value="{{ $rec->mod_parent }}">
							<input type="hidden" id="eroleid_{{ $rec->mod_id }}" value="{{ $rec->rol_id }}">
					@foreach ($accessv as $subrec)	
						@if($rec->mod_id == $subrec->mod_parent )							
							<ul style="display:none;">
								@if($subrec->childcount == 0)	
									<li class="{{ $loop->iteration >= $rec->sibilingcount ? 'last' : '' }}"><a onclick="openEditRole({{ $subrec->mod_id }})" href="#">({{ $subrec->mod_id }}) {{ $subrec->mod_name }}   </a></li>		
									<input type="hidden" id="ename_{{ $subrec->mod_id }}" value="{{ $subrec->mod_name }}">
										<input type="hidden" id="eparent_{{ $subrec->mod_id }}" value="{{ $subrec->mod_parent }}">
										<input type="hidden" id="eroleid_{{ $subrec->mod_id }}" value="{{ $subrec->rol_id }}">
								@else
								<li class="expandable">
								<div class="hitarea expandable-hitarea">
								</div>
								<a onclick="openEditRole({{ $subrec->mod_id }})" href="#">({{ $subrec->mod_id }}) {{ $subrec->mod_name }}   </a>
								<ul style="display: none;">	
									<?php $count = 0; ?>
								@foreach ($accessv as $sub_subrec)	
								
								@if($subrec->mod_id == $sub_subrec->mod_parent )	
								<?php $count++; ?>
									@if($sub_subrec->childcount == 0)							
										<li class="{{ $count == $sub_subrec->sibilingcount ? 'last' : '' }}"><a onclick="openEditRole({{ $sub_subrec->mod_id }})" href="#">({{ $sub_subrec->mod_id }}) {{ $sub_subrec->mod_name }} </a></li>		
									<input type="hidden" id="ename_{{ $sub_subrec->mod_id }}" value="{{ $sub_subrec->mod_name }}">
										<input type="hidden" id="eparent_{{ $sub_subrec->mod_id }}" value="{{ $sub_subrec->mod_parent }}">
										<input type="hidden" id="eroleid_{{ $sub_subrec->mod_id }}" value="{{ $sub_subrec->rol_id }}">
										
									@else 
									<li class="expandable">
								<div class="hitarea expandable-hitarea">
								</div><a onclick="openEditRole({{ $sub_subrec->mod_id }})"  href="#">({{ $sub_subrec->mod_id }}) {{ $sub_subrec->mod_name }}</a>
									<input type="hidden" id="ename_{{ $sub_subrec->mod_id }}" value="{{ $sub_subrec->mod_name }}">
							<input type="hidden" id="eparent_{{ $sub_subrec->mod_id }}" value="{{ $sub_subrec->mod_parent }}">
							<input type="hidden" id="eroleid_{{ $sub_subrec->mod_id }}" value="{{ $sub_subrec->rol_id }}">
							
								<ul style="display: none;">
								@foreach ($accessv as $sub_sub_subrec)	
								@if($sub_subrec->mod_id == $sub_sub_subrec->mod_parent )	
															
										<li class="last"><a onclick="openEditRole({{ $sub_sub_subrec->mod_id }})" href="#">({{ $sub_sub_subrec->mod_id }}) {{ $sub_sub_subrec->mod_name }}</a></li>		
									<input type="hidden" id="ename_{{ $sub_sub_subrec->mod_id }}" value="{{ $sub_sub_subrec->mod_name }}">
										<input type="hidden" id="eparent_{{ $sub_sub_subrec->mod_id }}" value="{{ $sub_sub_subrec->mod_parent }}">
										<input type="hidden" id="eroleid_{{ $sub_sub_subrec->mod_id }}" value="{{ $sub_sub_subrec->rol_id }}">
										@endif
										@endforeach
									</ul>
								</li>

									@endif
									@endif
								@endforeach	
								</ul>
								</li>
								<input type="hidden" id="ename_{{ $subrec->mod_id }}" value="{{ $subrec->mod_name }}">
							<input type="hidden" id="eparent_{{ $subrec->mod_id }}" value="{{ $subrec->mod_parent }}">
							<input type="hidden" id="eroleid_{{ $subrec->mod_id }}" value="{{ $subrec->rol_id }}">
							@endif
							</ul>	

						@endif
					@endforeach	
					</li>
					@endif
				@endif	
				
				@endforeach				
			</ul>
		</div>
		
		
		<div id="adduserform" class="grid_6">
			<div class="widget_wrap">
				<div class="widget_top">
					<h6 id="lblmodulename"></h6>
				</div>
				<div class="widget_content">
					<!--<form id="signupform" onsubmit="return setRole()" autocomplete="off" method="post" action="accesstrn" class="form_container left_label">-->
					<div class="form_container left_label">
						<ul>
							<li>
							@csrf
							<input type="hidden" name="operation" id="operation">
							<input type="hidden"  name="module_id" id="module_id">
							<input type="hidden" name="s_role_id" id="s_role_id">
							<fieldset style="width: 30%;">
										<legend>Roles</legend>
										<ul>
											<li>
											<div >
												@foreach ($role as $rec)
												<span class="grid_12">
												<input name="role_id" id="role_id_{{ $rec->rol_id }}" class="checkbox role_id"  type="checkbox" value="{{ $rec->rol_id }}" tabindex="7">
												<label class="choice">{{ $rec->rol_name }}</label>
												</span>
												<br /><br /><br />
												@endforeach
												
											</div>
											</li>
										</ul>
									</fieldset>
							</li>
							<li>
							<div class="form_grid_12">
								<div class="form_input">
									<button id="addsubmit" name="adduser" data-loading-text="Updating..." onclick="updateRoleAccess()" class="btn_small btn_blue"><span>Submit</span></button>									
									<!--<button id="reset" name="reset" onclick="clear()" type="button" class="btn_small btn_blue"><span>Reset</span></button>										
									<button id="close" onclick="closeAddUser()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>-->
								</div>
							</div>
							</li>
						</ul>
					</div>
					<!--</form>-->
				</div>
			</div>
		</div>
	</div></div>
	
	</div>
	<span class="clear"></span>
</div>

<script>

	function updateRoleAccess(){
		$("#addsubmit").prop('disabled', true);
		$("#addsubmit").text("Updating...");

		var role_arr = []; 
		var operation = $('#operation').val();
		var module_id = $('#module_id').val();

		@foreach ($role as $pop_rec)

		  var value = $('#uniform-role_id_'+{{ $pop_rec->rol_id }} ).find('.checked').find('#role_id_'+{{ $pop_rec->rol_id }}).val();
		  if (value != undefined) {
		  	role_arr.push(value);
		  }
		@endforeach	

		$("#s_role_id").val(role_arr);

		var role_id = $("#s_role_id").val();

		$.ajax({
	        type:'POST',
	        url:'accesstrn',
	        data:{s_role_id:role_id,operation:operation,module_id:module_id,_token: '{{csrf_token()}}'},
	        success:function(data){	 
	        	$("#addsubmit").text("submit");
	        	var noty_id = noty({
						layout : 'top',
						text: 'Roles updated successfully!',
						modal : true,
						type : 'success', 
						 });    	
	        }
		});
	}

	function openAddUser(){
		$("#module_id").val("");
		$("#operation").val(1);
		 $("#usertable").hide(0);
		 $("#adduserform").show(0);
	}
	
	function clear(){
		@foreach ($role as $clear_rec)
			$('#uniform-role_id_'+{{ $clear_rec->rol_id }}).find('span').attr("class", "");
		@endforeach
	}

	function openEditRole(id){
		//alert($('#proleid_1').val();
		$("#adduserform").show(0);
		var roleid = $("#eroleid_"+id).val();
		var parentid = $("#eparent_"+id).val();
		$("#module_id").val(id);
		$("#operation").val(1);
		$("#lblmodulename").html('');
		$("#lblmodulename").append("Module - "+$("#ename_"+id).val());		
		
		$("#s_role_id").val('');
		//$('.role_id').find('input:checkbox').attr('checked', false);
		@foreach ($role as $pop_rec)
		$('#uniform-role_id_'+{{ $pop_rec->rol_id }}).find('span').attr("class", "");
		@endforeach
		var role_list = "";
		$.ajax({
	        type:'GET',
	        url:'getaccessajax',
	        data:{module_id:id,_token: '{{csrf_token()}}'},
	        success:function(data){	 
	        	var char = data.roles.toString().split(",");  
	        	for (var i in char) {   
					var to_replace = $("#uniform-role_id_"+char[i]).find('span');
					to_replace.attr("class", "checked");
				}
	        }
		});
		
		
		
				
	}

	function setRole(){
		var role_arr = []; 
		/*var role_arr = $('input:checkbox:checked.role_id').map(function () {
			return this.value; // $(this).val()
		}).get();*/

		@foreach ($role as $pop_rec)
		  //$('#uniform-role_id_'+{{ $pop_rec->rol_id }}).find('span').attr("class", "");
		  var value = $('#uniform-role_id_'+{{ $pop_rec->rol_id }}).find('.checked').find('#role_id_'+{{ $pop_rec->rol_id }}).val();
		  if (value != undefined) {
		  	role_arr.push(value);
		  }
		@endforeach

		//alert(role_arr);
		$("#s_role_id").val(role_arr);
		//alert(role_arr);
		return true;
	}  


//to_replace.text("The new text");

	
		//alert(1);
            /*$.ajax({
               type:'POST',
               url:'getmsg',
               data:'_token = @csrf',
               success:function(data){
                  alert(data.msg);//$("#msg").html(data.msg);
               }
            });*/
        
	
</script>
</body>
</html>