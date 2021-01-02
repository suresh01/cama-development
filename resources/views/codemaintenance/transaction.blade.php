<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Evident Management</title>
@include('includes.header', ['page' => 'datamaintenance'])
	
	<div id="content">
		<div class="grid_container">
		<div id="trans_table" class="grid_12">
	
			<br>
			<div class="form_input">
				
 
				<div id="breadCrumb3"class="breadCrumb grid_3">
					<ul >
						<li><a href="#">Home</a></li>
						<li><a href="#">Data Maintenance</a></li>
						<li>Evident Management</li>
					</ul>
				</div>

				@include('search.searchcustom',['tableid'=>'tenanttable', 'action' => 'tenanttable', 'searchid' => '26'])

				<button id="addtrans" onclick="openTrans()" style="float:right;"  name="btnadduser" type="button" class="btn_small btn_blue"><span>Add Transaction</span></button>

				<br>
			</div>
		
			<div class="widget_wrap">					
				<div class="widget_content">						
					<table class="display data_tbl">
						<div class="social_activities">
								<div class="comments_s">
									<div class="block_label">
										Property Count<span id="prop_count">0</span>
									</div>
								</div>



								
							</div>	


					<thead style="text-align: left;">
					<tr>
						<th class="table_sno">
							S No
						</th>
						<th>
							Transaction Type
						</th>
						<th>
							Lot Number
						</th>
						<th>
							Title Number
						</th>
						<th>
							Transaction Date
						</th>
						<th>
							Price
						</th>
						<th>
							Duration
						</th>
						<th>
							Address
						</th>
						<th>
							Postcode
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
					@foreach ($transaction as $rec)
					<tr >
						<td>
							{{$loop->iteration}}
						</td>
						<td>
							 {{ $rec->transtype }}
						</td>
						<td>
							 {{ $rec->lotcode }}{{ $rec->trans_lotno }}
						</td>
						<td>
							 {{ $rec->titletype }}{{ $rec->trans_titleno }}
						</td>
						<td>
							{{ $rec->trans_transdate }}
						</td>						
						<td>
							{{ $rec->trans_price }}
						</td>					
						<td>
							{{ $rec->trans_duration }}
						</td>
						<td>
							{{ $rec->trans_addr_ln1}}<br>{{ $rec->trans_addr_ln2}}<br>{{ $rec->trans_city}}<br>{{ $rec->state}}
						</td>
						<td>
							{{ $rec->trans_postcode}}
						</td>
						<td>
							{{ $rec->approvalstatus}}
						</td>
						<td class="">
							
							@if($rec->trans_approvaltransstatus_id == '1')
								<span><a class="action-icons c-edit" onclick="editTrans('{{ $rec->trans_id }}')" href="#" title="Edit">Edit</a></span>
							<span><a class="action-icons c-Delete delete_tenant" onclick="deleteTrans('{{ $rec->trans_id }}')" href="#" title="Delete">Delete</a></span>
								 <span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('{{$rec->trans_id}}',1)"  title="Ready To Approve" href="#"></a></span>'						
							@elseif($rec->trans_approvaltransstatus_id == '2')
								<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('{{$rec->trans_id}}',2)"  title="Approve" href="#"></a></span>;							
							@elseif($rec->trans_approvaltransstatus_id == '3')
								<spane><a  class=" new-action-icons reverse" onclick="approve('{{$rec->trans_id}}',3)" title="Revise" href="#"></a></span>;
						
							@elseif($rec->trans_approvaltransstatus_id == '4')
								<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('{{$rec->trans_id}}',4)"  title="Revise Ready To Approve" href="#"></a></span>;							
							@endif
						</td>
					</tr>
					<div style="display:none">
						<input type="hidden" id="transtype_{{ $rec->trans_id }}" value="{{ $rec->trans_transtype_id }}">
						<input type="hidden" id="linkid_{{ $rec->trans_id }}" value="{{ $rec->trans_linkid }}">
						<input type="hidden" id="lotcode_{{ $rec->trans_id }}" value="{{ $rec->trans_lotcode_id }}">	
						<input type="hidden" id="lotno_{{ $rec->trans_id }}" value="{{ $rec->trans_lotno }}">	
						<input type="hidden" id="titletype_{{ $rec->trans_id }}" value="{{ $rec->trans_titletype_id }}">
						<input type="hidden" id="titltno_{{ $rec->trans_id }}" value="{{ $rec->trans_titleno }}">
						<input type="hidden" id="transdate_{{ $rec->trans_id }}" value="{{ $rec->trans_transdate }}">	
						<input type="hidden" id="price_{{ $rec->trans_id }}" value="{{ $rec->trans_price }}">	
						<input type="hidden" id="duration_{{ $rec->trans_id }}" value="{{ $rec->trans_duration }}">
						<input type="hidden" id="address1_{{ $rec->trans_id }}" value="{{ $rec->trans_addr_ln1 }}">
						<input type="hidden" id="address2_{{ $rec->trans_id }}" value="{{ $rec->trans_addr_ln2 }}">	
						<input type="hidden" id="address3_{{ $rec->trans_id }}" value="{{ $rec->trans_addr_ln3 }}">	
						<input type="hidden" id="address4_{{ $rec->trans_id }}" value="{{ $rec->trans_addr_ln4 }}">
						<input type="hidden" id="postcode_{{ $rec->trans_id }}" value="{{ $rec->trans_postcode }}">	
						<input type="hidden" id="city_{{ $rec->trans_id }}" value="{{ $rec->trans_city }}">
						<input type="hidden" id="state_{{ $rec->trans_id }}" value="{{ $rec->trans_state_id }}">		
					</div>
					@endforeach
					</table>
				</div>
			</div>
		</div>
				
		
		
		<div id="addtransform" style="display:none" class="grid_12">
			<div class="widget_wrap">
				
				<div class="widget_content">
					<h3 id="title">Add Ratepayer</h3>
					<form id="tenantform" autocomplete="off" method="post" action="#" >
						<div  class="grid_6 form_container left_label">
							<ul>
								<li>
									<input type="hidden" name="operation" id="operation">
									<input type="hidden" name="transactionid" id="transactionid">
									<input type="hidden" name="jsondata" id="jsondata">
									<fieldset>
										<legend>Transaction Information</legend>
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">TRANSACTION TYPE<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="transtype" name="transtype" tabindex="20">
													<option></option>
													@foreach ($transtype as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">TRANSACTION LINKID<span class="req">*</span></label>
											<div  class="form_input">
												<input id="linkid" name="linkid"  type="text"  maxlength="12" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">LOT CODE<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="lotcode" name="lotcode" tabindex="20">
													<option></option>
													@foreach ($lotcode as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">LOT NUMBER<span class="req">*</span></label>
											<div  class="form_input">
												<input id="lotno" name="lotno"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">TITLE TYPE<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="titletype" name="titletype" tabindex="20">
													<option></option>
													@foreach ($titletype as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">TITLE NUMBER<span class="req">*</span></label>
											<div  class="form_input">
												<input id="titltno" name="titltno"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>
									</fieldset>

									<fieldset>
										<legend>Other Information</legend>
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">TRANSACTION DATE<span class="req">*</span></label>
											<div  class="form_input">
												<input id="transdate" name="transdate" type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">PRICE<span class="req">*</span></label>
											<div  class="form_input">
												<input id="price" name="price"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">DURATION<span class="req">*</span></label>
											<div  class="form_input">
												<input id="duration" name="duration"  type="text"  maxlength="50" class="required"/>
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
												<input id="address1" name="address1"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">ADDRESS 2</label>
											<div  class="form_input">
												<input id="address2"  name="address2"  type="text"  maxlength="50" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">ADDRESS 3</label>
											<div  class="form_input">
												<input id="address3"  name="address3"  type="text"  maxlength="50" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">ADDRESS 4</label>
											<div  class="form_input">
												<input id="address4"  name="address4"  type="text"  maxlength="50" class=""/>
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
											<label class="field_title" id="lposition" for="position">CITY<span class="req">*</span></label>
											<div  class="form_input">
												<input id="city" name="city"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">STATE<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="state" name="state" tabindex="20">
													<option></option>
													@foreach ($state as $rec)
															<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
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
								<button id="addsubmit" name="adduser" onclick="validateTrans()" class="btn_small btn_blue"><span>Submit</span></button>									
								
								<button id="close" onclick="closeTrans()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>
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
				        data:{param_value:id,module:'evidentmgmt',param:currstatus},
				        success:function(data){		        	
				        	
							window.location.assign("evidentmgmt");	
							
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
	function editTrans(id){
		$("#title").html("Update Transaction");
		$('#transtype').val($('#transtype_'+id).val());
		$('#linkid').val($('#linkid_'+id).val());
		$('#lotcode').val($('#lotcode_'+id).val());
		$('#lotno').val($('#lotno_'+id).val());
		$('#titletype').val($('#titletype_'+id).val());
		$('#titltno').val($('#titltno_'+id).val());
		$('#transdate').val($('#transdate_'+id).val());
		$('#price').val($('#price_'+id).val());
		$('#duration').val($('#duration_'+id).val());
		$('#address1').val($('#address1_'+id).val());
		$('#address2').val($('#address2_'+id).val());
		$('#address3').val($('#address3_'+id).val());
		$('#address4').val($('#address4_'+id).val());
		$('#postcode').val($('#postcode_'+id).val());
		$('#state').val($('#state_'+id).val());
		$('#city').val($('#city_'+id).val());
		

		$('#transactionid').val(id);
		$('#operation').val(2);
		$("#trans_table").hide();
		$("#addtransform").show();
	 	$("label.error").remove();
	}

	function openTrans(){
		$("#title").html("Add Transaction");
		$('#transtype').val('');
		$('#linkid').val('');
		$('#lotcode').val('');
		$('#lotno').val('');
		$('#titletype').val('');
		$('#titltno').val('');
		$('#transdate').val('');
		$('#price').val('');
		$('#duration').val('');
		$('#address1').val('');
		$('#address2').val('');
		$('#address3').val('');
		$('#address4').val('');
		$('#postcode').val('');
		$('#state').val('');
		$('#city').val('');

		
		$('#transactionid').val(0);
		$('#operation').val(1);
		$("#trans_table").hide();
		$("#addtransform").show();
	 	$("label.error").remove();
	}
	
	function closeTrans(){
		$("#trans_table").show();
		$("#addtransform").hide();
	 	$("label.error").remove();
		
	}

	function deleteTrans(id) {
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
		            window.location.assign('evidentmgmttrn?jsondata='+tenantjson);
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

	function validateTrans(){
		$('#tenantform').validate({
	        rules: {
	            postcode: {
	                required: true,
	                minlength: 5,
	                maxlength: 6,
	            },
	            linkid: {
	                minlength: 12,
	            	maxlength: 12
	            },
	            transtype: {
	            	required: true
	            },
	            lotcode: {
	            	required: true
	            },
	            titletype: {
	            	required: true
	            },
	            state: {
	            	required: true
	            }
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

				
					
					var transdata = {};
			        	$('#tenantform').serializeArray().map(function(x){transdata[x.name] = x.value;});

			            //console.log(transdata);
			            var transjson = JSON.stringify(transdata);
			            //$('#jsondata').val(transjson);
			            //console.log(tenantjson);
			            window.location.assign('evidentmgmttrn?jsondata='+transjson)
			            //$('#tenantform').submit();
				
					
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

	$(document).ready(function() {
		$( "#transdate" ).datepicker({dateFormat: 'dd/mm/yy'});

		$("#linkid").change(function() {
			var accno = this.value;
			$.ajax({
			 	url: "evidentDetail",
  				cache: false,
			    headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
			  data:{accno:accno},
			  success: function(data){
			  if(data[1][0]==null){
			  	 alert("Not Found "  ); 
			  } else{

			
					
					  //   alert(data ); 
					  //   alert(data.length ); 
					     $('#lotcode').val(data[1][0].lo_lotcode_id);
				$('#lotno').val(data[1][0].lo_no);
				$('#titletype').val(data[1][0].lo_titletype_id);
				$('#titltno').val(data[1][0].lo_titleno);
				$('#address1').val(data[1][0].ma_address1);
				$('#address2').val(data[1][0].ma_address2);
				$('#address3').val(data[1][0].ma_address3);
				$('#address4').val(data[1][0].ma_address4);
				$('#postcode').val(data[1][0].ma_postcode);
				$('#state').val(data[1][0].ma_state_id);
				$('#city').val(data[1][0].ma_city);
				}
			  },
			  error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Not Found "  ); 
    }   
			});
		});
	});
	
</script>
</body>
</html>