<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Ratepayer Registration</title>
@include('includes.header', ['page' => 'datamaintenance'])
	
	<div id="content">
		<div class="grid_container">
		<div id="tenant_table" class="grid_12">
	
			<br>
			<div class="form_input">
				<button id="addtenant" style="float:right;" onclick="openTenantUser()" name="btnadduser" type="button" class="btn_small btn_blue"><span>Add Ratepayer</span></button>

				<div id="breadCrumb3"  class="breadCrumb grid_3">
					<ul >
						<li><a href="#">Home</a></li>
						<li><a href="#">Data Maintenance</a></li>
						<li>Ratepayer Registration</li>
					</ul>
				</div>
				<br>
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
							Application Type
						</th>
						<th>
							Ratepayer Type
						</th>
						<th>
							Number
						</th>
						<th>
							Name
						</th>
						<th>
							Address 1
						</th>
						<th>
							State
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
					@foreach ($ratepayer as $rec)
					<tr >
						<td>
							{{$loop->iteration}}
						</td>
						<td>
							 {{ $rec->applntype }}
						</td>
						<td>
							 {{ $rec->ratepayertype }}
						</td>
						<td>
							 {{ $rec->rp_no }}
						</td>
						<td>
							{{ $rec->rp_name }}
						</td>						
						<td>
							{{ $rec->rp_addr_ln1 }}
						</td>	
						<td>
							{{ $rec->state}}
						</td>
						<td>
							{{ $rec->approvalstatus}}
						</td>
						<td class="">
							
							@if($rec->rp_approvalrpstatus_id == '1')
								<span><a class="action-icons c-edit" onclick="editTenantUser('{{ $rec->rp_id }}')" href="#" title="Edit">Edit</a></span>
								<span><a class="action-icons c-Delete delete_tenant" onclick="deleteTenant('{{ $rec->rp_id }}')" href="#" title="Delete">Delete</a></span>
								 <span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('{{$rec->rp_id}}',1)"  title="Ready To Approve" href="#"></a></span>'						
							@elseif($rec->rp_approvalrpstatus_id == '2')
								<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('{{$rec->rp_id}}',2)"  title="Approve" href="#"></a></span>;							
							@elseif($rec->rp_approvalrpstatus_id == '3')
								<spane><a  class=" new-action-icons reverse" onclick="approve('{{$rec->rp_id}}',3)" title="Revise" href="#"></a></span>;
						
							@elseif($rec->rp_approvalrpstatus_id == '4')
								<span><a class="action-icons c-edit" onclick="editTenantUser('{{ $rec->rp_id }}')" href="#" title="Edit">Edit</a></span>
								<span><a class="action-icons c-Delete delete_tenant" onclick="deleteTenant('{{ $rec->rp_id }}')" href="#" title="Delete">Delete</a></span>
								<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('{{$rec->rp_id}}',4)"  title="Revise Ready To Approve" href="#"></a></span>;					
							@elseif($rec->rp_approvalrpstatus_id == '5')
								<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('{{$rec->rp_id}}',5)"  title="Approve Revision" href="#"></a></span>;						
							@endif
						</td>
					</tr>
					<div style="display:none">
						<input type="hidden" id="applntype_{{ $rec->rp_id }}" value="{{ $rec->rp_applntype_id }}">
						<input type="hidden" id="typeid_{{ $rec->rp_id }}" value="{{ $rec->rp_type_id }}">
						<input type="hidden" id="number_{{ $rec->rp_id }}" value="{{ $rec->rp_no }}">	
						<input type="hidden" id="name_{{ $rec->rp_id }}" value="{{ $rec->rp_name }}">	
						<input type="hidden" id="addr1_{{ $rec->rp_id }}" value="{{ $rec->rp_addr_ln1 }}">
						<input type="hidden" id="addr2_{{ $rec->rp_id }}" value="{{ $rec->rp_addr_ln2 }}">
						<input type="hidden" id="addr3_{{ $rec->rp_id }}" value="{{ $rec->rp_addr_ln3 }}">	
						<input type="hidden" id="addr4_{{ $rec->rp_id }}" value="{{ $rec->rp_addr_ln4 }}">	
						<input type="hidden" id="postcode_{{ $rec->rp_id }}" value="{{ $rec->rp_postcode }}">
						<input type="hidden" id="stateid_{{ $rec->rp_id }}" value="{{ $rec->rp_state_id }}">
						<input type="hidden" id="citizenid_{{ $rec->rp_id }}" value="{{ $rec->rp_citizen_id }}">	
						<input type="hidden" id="raceid_{{ $rec->rp_id }}" value="{{ $rec->rp_race_id }}">	
						<input type="hidden" id="activeind_{{ $rec->rp_id }}" value="{{ $rec->rp_activeind_id }}">
						<input type="hidden" id="phone_{{ $rec->rp_id }}" value="{{ $rec->rp_phone_no }}">	
						<input type="hidden" id="email_{{ $rec->rp_id }}" value="{{ $rec->rp_email_addr }}">		
					</div> 
					@endforeach
					</table>
				</div>
			</div>
		</div>
				
		
		
		<div id="addtenantform" style="display:none" class="grid_12">
			<div class="widget_wrap">
				
				<div class="widget_content">
					<h3 id="title">Add Ratepayer</h3>
					<form id="tenantform" autocomplete="off" method="post" action="#" >
						<div  class="grid_6 form_container left_label">
							<ul>
								<li>
									<input type="hidden" name="operation" id="operation">
									<input type="hidden" name="ratepayerid" id="ratepayerid">
									<input type="hidden" name="jsondata" id="jsondata">
									<fieldset>
										<legend>Ratepayer Information</legend>
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">APPLICATION TYPE<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="applntypeid" name="applntypeid" tabindex="20">
													@foreach ($applntype as $rec)
															<option value='{{ $rec->applntype_id }}'>{{ $rec->applntype }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">RATEPAYER TYPE<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="typeid" name="typeid" tabindex="20">
													@foreach ($ratepayertype as $rec)
															<option value='{{ $rec->ratepayertype_id }}'>{{ $rec->ratepayertype }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">RATEPAYER NUMBER<span class="req">*</span></label>
											<div  class="form_input">
												<input id="number" name="number"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>
								 
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">NAME<span class="req">*</span></label>
											<div  class="form_input">
												<input id="name" name="name"  type="text"  maxlength="50" class=" required "/>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">PHONE NUMBER<span class="req">*</span></label>
											<div  class="form_input">
												<input id="phoneno" name="phoneno"  type="text"  maxlength="12" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>
								 
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">EMAIL ID<span class="req">*</span></label>
											<div  class="form_input">
												<input id="emailid" name="emailid"  type="text"  maxlength="50" class=" required "/>
											</div>
											<span class=" label_intro"></span>
										</div>

									</fieldset>

									<fieldset>
										<legend>Other Information</legend>
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">CITIZEN<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="citizenid" name="citizenid" tabindex="20">
													@foreach ($citizen as $rec)
															<option value='{{ $rec->citizen_id }}'>{{ $rec->citizen }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">RACE<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="raceid" name="raceid" tabindex="20">
													@foreach ($race as $rec)
															<option value='{{ $rec->race_id }}'>{{ $rec->race }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">STATUS<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="activeindid" name="activeindid" tabindex="20">
													@foreach ($activeind as $rec)
															<option value='{{ $rec->activeind_id }}'>{{ $rec->activeind }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>

									</fieldset>
			
								</li>
							</ul>
						</div>
						<div  class="grid_6 form_container left_label">
							<ul>
								<li>				
									<fieldset>
										<legend>Address Information</legend>					
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">ADDRESS 1<span class="req">*</span></label>
											<div  class="form_input">
												<input id="addr1" name="addr1"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">ADDRESS 2</label>
											<div  class="form_input">
												<input id="addr2"  name="addr2"  type="text"  maxlength="50" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">ADDRESS 3</label>
											<div  class="form_input">
												<input id="addr3"  name="addr3"  type="text"  maxlength="50" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">ADDRESS 4</label>
											<div  class="form_input">
												<input id="addr4"  name="addr4"  type="text"  maxlength="50" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">POST CODE<span class="req">*</span></label>
											<div  class="form_input">
												<input id="postcode" name="postcode"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">STATE<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="stateid" name="stateid" tabindex="20">
													@foreach ($state as $rec)
															<option value='{{ $rec->state_id }}'>{{ $rec->state }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
									</fieldset>
									
								</li>
							</ul>
						</div>
						<div style="height: 48px; float: none; display: -webkit-box;text-align: -webkit-center;" class="grid_12">							
							<div class="form_input">
								<button id="addsubmit" name="adduser" onclick="validateTenant()" class="btn_small btn_blue"><span>Submit</span></button>									
								
								<button id="close" onclick="closeTenant()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>
								<span class=" label_intro"></span>
							</div>								
							<span class="clear"></span>
						</div>
					</form>
				</div>
			</div>
		</div>
	<span class="clear"></span>
	
</div>

<script>

	function approve(id,currstatus){
			
		var noty_id = noty({
			layout : 'center',
			text: 'Are you sure want to Submit?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Submit', click: function($noty) {
					$noty.close();
					$.ajax({
		  				type: 'GET', 
					    url:'approve',
					    headers: {
						    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
				        data:{param_value:id,module:'ratepayer',param:currstatus},
				        success:function(data){		        	
				        	
							window.location.assign("ratepayer");	
							
			        	},
				        error:function(data){
							//$('#loader').css('display','none');	
				        	alert('error');
			        	}
			    	});
				  }
				},
				{type: 'button blue', text: 'Cancel', click: function($noty) {
					$noty.close();
				  }
				}
				],
			 type : 'success', 
		 });
					
				

	}	
	function editTenantUser(id){
		$("#title").html("Update Ratepayer");
		$('#number').attr('readonly', "readonly");
		$('#applntypeid').val($('#applntype_'+id).val());
		$('#typeid').val($('#typeid_'+id).val());
		$('#number').val($('#number_'+id).val());
		$('#name').val($('#name_'+id).val());
		$('#addr1').val($('#addr1_'+id).val());
		$('#addr2').val($('#addr2_'+id).val());
		$('#addr3').val($('#addr3_'+id).val());
		$('#addr4').val($('#addr4_'+id).val());
		$('#postcode').val($('#postcode_'+id).val());
		$('#stateid').val($('#stateid_'+id).val());
		$('#citizenid').val($('#citizenid_'+id).val());
		$('#raceid').val($('#raceid_'+id).val());
		$('#activeindid').val($('#activeind_'+id).val());
		$('#phoneno').val($('#phone_'+id).val());
		$('#emailid').val($('#email_'+id).val());
		

		$('#ratepayerid').val(id);
		$('#operation').val(2);
		$("#tenant_table").hide();
		$("#addtenantform").show();
	 	$("label.error").remove();
	}

	function openTenantUser(){
		$("#title").html("Add Ratepayer");
		$('#number').removeAttr('readonly');
		$('#applntypeid').val('');
		$('#typeid').val('');
		$('#number').val('');
		$('#name').val('');
		$('#addr1').val('');
		$('#addr2').val('');
		$('#addr3').val('');
		$('#addr4').val('');
		$('#postcode').val('');
		$('#stateid').val('');
		$('#citizenid').val('');
		$('#raceid').val('');
		$('#activeindid').val('');
		$('#phoneno').val('');
		$('#emailid').val('');
		
		$('#ratepayerid').val(0);
		$('#operation').val(1);
		$("#tenant_table").hide();
		$("#addtenantform").show();
	 	$("label.error").remove();
	}
	
	function closeTenant(){
		$("#tenant_table").show();
		$("#addtenantform").hide();
	 	$("label.error").remove();
		
	}

	function deleteTenant(id) {
		$('#operation').val(3);
		$('#ratepayerid').val(id);

		
		var noty_id = noty({
			layout : 'center',
			text: 'Do you want Delete?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Delete', click: function($noty) {
		  
					// this = button element
					// $noty = $noty element
		  			var tenantdata = {};
		        	$('#tenantform').serializeArray().map(function(x){tenantdata[x.name] = x.value;});

		            //console.log(tenantdata);
		            var tenantjson = JSON.stringify(tenantdata);
		            //$('#jsondata').val(tenantjson);
		            //console.log(tenantjson);
		            window.location.assign('ratepayertrn?jsondata='+tenantjson);
					$noty.close();
					//noty({force: true, text: 'You clicked "Ok" button', type: 'success',layout : 'center',modal : true,});
				  }
				},
				{type: 'button green', text: 'Cancel', click: function($noty) {
					$noty.close();
					//noty({force: true, text: 'You clicked "Cancel" button', type: 'error',layout : 'center',modal : true,});
				  }
				}
				],
			type : 'success', 
		});
	}

	function validateTenant(){
		$('#tenantform').validate({
	        rules: {
	            postcode: {
	                required: true,
	                minlength: 5,
	                maxlength: 6,
	            },
	            'phoneno':{
	            	required: true,
	                maxlength: 15
	            },
	            'emailid' : "email"
	        },
	        messages: {
				firstname: "Enter your firstname"
	        },
	        submitHandler: function(form) {

	        	var noty_id = noty({
			layout : 'center',
			text: 'Do you want update?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Update', click: function($noty) {
		  
					var d=new Date();
	        	var applnid = $('#applntypeid').val();
				var typeid = $('#typeid').val();
				var number = $('#number').val();
				var operation = $('#operation').val();
				var page = "ratepayer";

				if (operation == '1'){
					
					$.ajax({
		        type:'GET',
		        url:'getValidRatepayer?date='+ d.getTime(),
		        data:{applnid:applnid,typeid:typeid,number:number,page:page},
		        success:function(data){	        	
		        	if(data.msg === "false" ){
		        		alert("Ratepayer Information Already Exsist.");
		        		$("#number").focus();
		        	} else {
		        		var tenantdata = {};
			        	$('#tenantform').serializeArray().map(function(x){tenantdata[x.name] = x.value;});

			            //console.log(tenantdata);
			            var tenantjson = JSON.stringify(tenantdata);
			            //$('#jsondata').val(tenantjson);
			            //console.log(tenantjson);
			            window.location.assign('ratepayertrn?jsondata='+tenantjson)
			            //$('#tenantform').submit();
		        	}
	        }
	    	});
				} else {
					
					var tenantdata = {};
			        	$('#tenantform').serializeArray().map(function(x){tenantdata[x.name] = x.value;});

			            //console.log(tenantdata);
			            var tenantjson = JSON.stringify(tenantdata);
			            //$('#jsondata').val(tenantjson);
			            //console.log(tenantjson);
			            window.location.assign('ratepayertrn?jsondata='+tenantjson)
			            //$('#tenantform').submit();
				}
					
					$noty.close();
					//noty({force: true, text: 'You clicked "Ok" button', type: 'success',layout : 'center',modal : true,});
				  }
				},
				{type: 'button green', text: 'Cancel', click: function($noty) {
					$noty.close();
					//noty({force: true, text: 'You clicked "Cancel" button', type: 'error',layout : 'center',modal : true,});
				  }
				}
				],
			type : 'success', 
		});

	        	
	        	
	        	
	        }
	    });
	}
</script>
</body>
</html>