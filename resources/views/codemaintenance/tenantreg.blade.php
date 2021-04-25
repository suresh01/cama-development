<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('CodeMaintenance.Tenant_Registration')}}</title>
@include('includes.header', ['page' => 'datamaintenance'])
	
	<div id="content">
		<div class="grid_container">


		<div id="tenant_table" class="grid_12">


	
			<br>
			<div class="form_input">
				

				<div id="breadCrumb3"  class="breadCrumb grid_3">
					<ul >
						<li><a href="#">{{__('CodeMaintenance.Home')}}</a></li>
						<li><a href="#">{{__('CodeMaintenance.Data_Maintenance')}} </a></li>
						<li>{{__('CodeMaintenance.Tenant_Registration')}}</li>
					</ul>
				</div>

				@include('search.searchcustom',['tableid'=>'tenanttable', 'action' => 'tenanttable', 'searchid' => '25'])

				<button id="addtenant" onclick="openTenantUser()" style="float:right;"  name="btnadduser" type="button" class="btn_small btn_blue"><span>{{__('CodeMaintenance.Add_Tenant')}}</span></button>
				<br>
			</div>
		
			<div class="widget_wrap">					
				<div class="widget_content">						
					<table id="tenanttable" class="display ">

						<div class="social_activities">
							<div class="comments_s">
								<div class="block_label">
									{{__('CodeMaintenance.Count')}}<span id="prop_count">0</span>
								</div>
							</div>

								
						</div>	

					<thead style="text-align: left;">
					<tr>
						<th class="table_sno">
							{{__('CodeMaintenance.SNo')}}
						</th>
						<th>
							{{__('CodeMaintenance.Application_Type')}} 
						</th>
						<th>
							{{__('CodeMaintenance.Tenant_Type')}} 
						</th>
						<th>
							{{__('CodeMaintenance.Tenant_Number')}}
						</th>
						<th>
							{{__('CodeMaintenance.Name')}} 
						</th>
						<th>
							{{__('CodeMaintenance.Address1')}}  
						</th>
						<th>
							{{__('CodeMaintenance.State')}} 
						</th>
						<th>
							{{__('CodeMaintenance.Status')}} 
						</th>
						<th>
							{{__('CodeMaintenance.Action')}} 
						</th>
						
					</tr>
					</thead>
					<tbody>
					@foreach ($tenant as $rec)
					
					<div style="display:none">
						<input type="hidden" id="applntype_{{ $rec->te_id }}" value="{{ $rec->te_applntype_id }}">
						<input type="hidden" id="typeid_{{ $rec->te_id }}" value="{{ $rec->te_type_id }}">
						<input type="hidden" id="number_{{ $rec->te_id }}" value="{{ $rec->te_no }}">	
						<input type="hidden" id="name_{{ $rec->te_id }}" value="{{ $rec->te_name }}">	
						<input type="hidden" id="addr1_{{ $rec->te_id }}" value="{{ $rec->te_addr_ln1 }}">
						<input type="hidden" id="addr2_{{ $rec->te_id }}" value="{{ $rec->te_addr_ln2 }}">
						<input type="hidden" id="addr3_{{ $rec->te_id }}" value="{{ $rec->te_addr_ln3 }}">	
						<input type="hidden" id="addr4_{{ $rec->te_id }}" value="{{ $rec->te_addr_ln4 }}">	
						<input type="hidden" id="postcode_{{ $rec->te_id }}" value="{{ $rec->te_postcode }}">
						<input type="hidden" id="stateid_{{ $rec->te_id }}" value="{{ $rec->te_state_id }}">
						<input type="hidden" id="citizenid_{{ $rec->te_id }}" value="{{ $rec->te_citizen_id }}">	
						<input type="hidden" id="raceid_{{ $rec->te_id }}" value="{{ $rec->te_race_id }}">	
						<input type="hidden" id="activeind_{{ $rec->te_id }}" value="{{ $rec->te_activeind_id }}">	
						<input type="hidden" id="phone_{{ $rec->te_id }}" value="{{ $rec->te_phone_no }}">	
						<input type="hidden" id="email_{{ $rec->te_id }}" value="{{ $rec->te_email_addr }}">		
					</div>
					@endforeach
					</table>
				</div>
			</div>
		</div>
				
		
		
		<div id="addtenantform" style="display:none" class="grid_12">
			<div class="widget_wrap">
				
				<div class="widget_content">
					<h3 id="title">{{__('CodeMaintenance.Add_Tenant')}}  </h3>
					<form id="tenantform" autocomplete="off" method="post" action="tenanttrn" >
						<div  class="grid_6 form_container left_label">
							<ul>
								<li>
									<input type="hidden" name="operation" id="operation">
									<input type="hidden" name="tenantid" id="tenantid">
									<input type="hidden" name="jsondata" id="jsondata">
									<fieldset>
										<legend>{{__('CodeMaintenance.Tenant_Information')}}</legend>
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">{{__('CodeMaintenance.Application_Type')}}  <span class="req">*</span></label>
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
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Tenant_Type')}}  <span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="typeid" name="typeid" tabindex="20">
													@foreach ($tenanttype as $rec)
															<option value='{{ $rec->tenanttype_id }}'>{{ $rec->tenanttype }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('CodeMaintenance.Tenant_Number')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="number" name="number"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>
								 
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('CodeMaintenance.Name')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="name" name="name"  type="text"  maxlength="50" class=" required "/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('CodeMaintenance.Phone_Number')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="phoneno" name="phoneno"  type="text"  maxlength="12" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>
								 
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('CodeMaintenance.EmailID')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="emailid" name="emailid"  type="text"  maxlength="50" class=" required "/>
											</div>
											<span class=" label_intro"></span>
										</div>

									</fieldset>

									<fieldset>
										<legend>{{__('CodeMaintenance.Other_Information')}}</legend>
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">{{__('CodeMaintenance.Citizen')}} <span class="req">*</span></label>
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
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Race')}} <span class="req">*</span></label>
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
											<label class="field_title" id="llevel" for="level">{{__('CodeMaintenance.Status')}} <span class="req">*</span></label>
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
										<legend>{{__('CodeMaintenance.Address_Information')}}</legend>					
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Address1')}}  <span class="req">*</span></label>
											<div  class="form_input">
												<input id="addr1" name="addr1"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Address2')}}  </label>
											<div  class="form_input">
												<input id="addr2"  name="addr2"  type="text"  maxlength="50" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Address3')}}  </label>
											<div  class="form_input">
												<input id="addr3"  name="addr3"  type="text"  maxlength="50" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Address4')}}  </label>
											<div  class="form_input">
												<input id="addr4"  name="addr4"  type="text"  maxlength="50" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Post_Code')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="postcode" name="postcode"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('CodeMaintenance.State')}} <span class="req">*</span></label>
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
								<button id="addsubmit" name="adduser" onclick="validateTenant()" class="btn_small btn_blue"><span>{{__('common.Submit')}}</span></button>									
								
								<button id="close" onclick="closeTenant()" name="close" type="button" class="btn_small btn_blue"><span>{{__('common.Close')}}</span></button>
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
	function editTenantUser(id){
		$("#title").html("Update Tenant");
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
		$('#tenantid').val(id);
		$('#operation').val(2);
		$("#tenant_table").hide();
		$("#addtenantform").show();
	 	$("label.error").remove();
	}

	function openTenantUser(){
		$("#title").html("Add Tenant");
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
		$('#tenantid').val(0);
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
		$('#tenantid').val(id);

		
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
		            window.location.assign('tenanttrn?jsondata='+tenantjson);
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
	            number:{
	            	required: true,
	                maxlength: 15
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
				var page = "tenant";
	        	if (operation == '1'){
					
					$.ajax({
		        type:'GET',
		        url:'getValidRatepayer?date='+ d.getTime(),
		        data:{applnid:applnid,typeid:typeid,number:number,page:page},
		        success:function(data){	        	
		        	if(data.msg === "false" ){
		        		alert("Tenant Information Already Exsist.");
		        		$("#number").focus();
		        	} else {
		        		var tenantdata = {};
	        	$('#tenantform').serializeArray().map(function(x){tenantdata[x.name] = x.value;});

	            //console.log(tenantdata);
	            var tenantjson = JSON.stringify(tenantdata);
	            //$('#jsondata').val(tenantjson);
	            //console.log(tenantjson);
	            window.location.assign('tenanttrn?jsondata='+tenantjson);
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
	            window.location.assign('tenanttrn?jsondata='+tenantjson);
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
				        data:{param_value:id,module:'tenant',param:currstatus},
				        success:function(data){		        	
				        	
							window.location.assign("tenant");	
							
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


	function approve(id,currstatus,type){
		var param_str ="";
		if(type == 1){
			param_str = 'AP';
		} else {
			param_str = 'RJ';
		}
	
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
				        data:{param_value:id,module:'tenant',param:currstatus,param_str:param_str },
				        success:function(data){	        	
				        	
							window.location.assign("tenant");	
							
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

	$(document).ready(function() {
	
	
		$('#tenanttable').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				"lengthMenu":  [100, 200, 500, 1000],
				"dom": '<"top"i>rt<"bottom"flp><"clear">',
		        "ajax": {
		            "type": "GET",
		            "url": 'tenanttable',
		            "contentType": 'application/json; charset=utf-8',
				    "headers": {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		        },
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
			        {"data": null, "name": "sno", "title": "S No"},
			        {"data": "applntype", "name": "fileno"},
			        {"data": "tenanttype", "name": "zone"},
			        {"data": "te_no", "name": "zone"},
			        {"data": "te_name", "name": "subzone"},
			        {"data": "te_addr_ln1", "name": "address"},
			        {"data": "state", "name": "address"},
			        {"data": "approvalstatus", "name": "status"},
			        {"data": function(data){
			        		var action = "";
			        		
			        		var editaction ="<span><a style='height: 16px; width: 15px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -943px -102px !important;display: inline-block;' onclick='editTenantUser("+data.te_id+")' href='#' title='Edit'></a></span> " +
							"&nbsp;&nbsp;<span><a style='height: 15px; width: 13px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -143px -23px !important;display: inline-block; '  onclick='deleteTenant("+data.te_id+")' href='#' title='Delete'></a></span>";

							if(data.te_approvaltestatus_id == '1' || data.te_approvaltestatus_id == '6'){
								action = editaction +  '<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('+data.te_id+',1)"  title="Submit To Approve" href="#"></a></span>';							
							} else if(data.te_approvaltestatus_id == '2'){
								action =   '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('+data.te_id+',2,1)"  title="Approve" href="#"></a></span>' + 
								'<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -542px -42px !important;display: inline-block; float: left;" onclick="approve('+data.te_id+',2,2)"  title="Reject" href="#"></a></span>';							
							} else if(data.te_approvaltestatus_id == '3'){
								action =  '<spane><a  class=" new-action-icons reverse" onclick="approve('+data.te_id+',3)" title="Revise" href="#"></a></span>';
						
							} else if(data.te_approvaltestatus_id == '4'){
								action =  editaction +   '<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('+data.te_id+',1)"  title="Submit To Approve" href="#"></a></span>';
															
							} else if(data.te_approvaltestatus_id == '5'){
								action =   '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('+data.te_id+',5)"  title="Approve Revise" href="#"></a></span>';						
							} 

							/*var editaction ="<span><a class='action-icons c-edit' onclick='editTenantUser("+data.te_id+")' href='#' title='Edit'>Edit</a></span> " +
								"<span><a class='action-icons c-Delete delete_tenant' onclick='deleteTenant("+data.te_id+")' href='#' title='Delete'>Delete</a></span>";

							if(data.te_approvaltestatus_id == '1'){
								action = editaction +  '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('+data.te_id+',1)"  title="Ready To Approve" href="#"></a></span>';							
							} else if(data.te_approvaltestatus_id == '2'){
								action =   '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('+data.te_id+',2)"  title="Approve" href="#"></a></span>';							
							} else if(data.te_approvaltestatus_id == '3'){
								action =  '<spane><a  class=" new-action-icons reverse" onclick="approve('+data.te_id+',3)" title="Revise" href="#"></a></span>';
						
							} else if(data.te_approvaltestatus_id == '4'){
								action =  editaction +  '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('+data.te_id+',4)"  title="Revise Ready To Approve" href="#"></a></span>';							
							} else if(data.te_approvaltestatus_id == '5'){
								action =    '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('+data.te_id+',5)"  title="Approve Revision" href="#"></a></span>';							
							} 
							*/
							

			        		return action;
			        	
			        }, "name": "TO_OWNNO"}
		   		],
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  					var count = $('#bldgtable').DataTable().rows().count();
					$('#prop_count').html(count);
			        $("td:nth-child(1)", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
			        return nRow;
			    },
			    "sPaginationType": "full_numbers",
			"iDisplayLength": 100,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
		    'columnDefs': [{
         'targets': 0,
         'searchable': true,
         'orderable': false,
         'width': '1%',
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox">';
         }
      }],
      'rowCallback': function(row, data, dataIndex){
         // Get row ID
         var rowId = data[0];

         // If row ID is in the list of selected row IDs
         if($.inArray(rowId, rows_selected) !== -1){
            $(row).find('input[type="checkbox"]').prop('checked', true);
            $(row).addClass('selected');
         }
      },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			});
});
</script>
</body>
</html>