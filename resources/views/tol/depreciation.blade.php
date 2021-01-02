<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>TOL Depreciation</title>
@include('includes.header', ['page' => 'TOL'])
	<div id="content">
		<div class="grid_container">
		<div id="basket_table" class="grid_12">			
			<br>
			<div class="form_input">

				<div id="breadCrumb3" class="breadCrumb grid_3">
					<ul >
						<li><a href="#">Home</a></li>
						<li><a href="#">Tone of List</a></li>
						<li>Depreciation</li>
					</ul>
				</div>


				<button id="addtrans" onclick="openBasket()" style="float:right;" name="btnadduser" type="button" class="btn_small btn_blue"><span>Add  Land Standard</span></button>
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
							ID
						</th>
						<th>
							Tone Basket
						</th>
						<th>
							Building Condition
						</th>
						<th>
							Value
						</th>
						<th>
							Update by / Update date
						</th>
						<th>
							Action
						</th>
						
					</tr>
					</thead>
					<tbody>
					@foreach ($result as $rec)	
					<tr>
						<td>
							{{$loop->iteration}}
						</td>
						<td>
							 {{ $rec->tdepre_id }}
						</td>
						<td>
							 {{ $rec->tollis_year }}
						</td>
						<td>
							 {{ $rec->bldgcond }}
						</td>
						<td>
							 {{ $rec->tdepre_value }}
						</td>					
						<td>
							{{ $rec->tdepre_updateby }} / {{$rec->tdepre_updatedate}}
						</td>	
						<td class="">
							<span><a class="action-icons c-edit" onclick="editBasket('{{ $rec->tdepre_id }}')" href="#" title="Edit">Edit</a></span>
							<span><a class="action-icons c-Delete delete_tenant" onclick="deleteBasket('{{ $rec->tdepre_id }}')" href="#" title="Delete">Delete</a></span>
						</td>
					</tr>
					<div style="display:none">
						<input type="hidden" id="basketid_{{ $rec->tdepre_id }}" value="{{ $rec->tdepre_tone_id }}">
						<input type="hidden" id="bldgcond_{{ $rec->tdepre_id }}" value="{{ $rec->tdepre_bldgcondn_id }}">
						<input type="hidden" id="value_{{ $rec->tdepre_id }}" value="{{ $rec->tdepre_value }}">
					</div>
					@endforeach
					</table>
				</div>
			</div>
		</div>
				
		<div id="addbasketform" style="display:none" class="grid_12">
			<div class="widget_wrap">
				
				<div class="widget_content">
					<h3 id="title">Add Basket</h3>
					<form id="basketform" autocomplete="off" method="post" action="#" >
						<div  class="grid_6 form_container left_label">
							<ul>
								<li>
									<input type="hidden" name="operation" id="operation">
									<input type="hidden" name="depreciationid" id="depreciationid">
									<input type="hidden" name="jsondata" id="jsondata">
									<fieldset>
										<legend>Basket Information</legend>
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">BASKET<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="basketid" name="basketid" tabindex="20">
													<option></option>
													@foreach ($basket as $rec)
														<option value='{{ $rec->tollist_id }}'>{{ $rec->tollis_year }} - {{ $rec->tollis_desc }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">BUILDING CONDITION<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="bldgcond" name="bldgcond" tabindex="20">
													<option></option>
													@foreach ($bldgcond as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">VALUE<span class="req">*</span></label>
											<div  class="form_input">
												<input id="value" name="value"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>
									
									</fieldset>

			
								</li>
							</ul>
						</div>
						
						<div style="height: 48px; float: none; display: -webkit-box;text-align: -webkit-center;" class="grid_12">							
							<div class="form_input">
								<button id="addsubmit" name="adduser" onclick="validateBasket()" class="btn_small btn_blue"><span>Submit</span></button>									
								
								<button id="close" onclick="closeBasket()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>
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
	function editBasket(id){
		$("#title").html("Update Depreciation");
		$('#basketid').val($('#basketid_'+id).val());
		$('#bldgcond').val($('#bldgcond_'+id).val());
		$('#value').val($('#value_'+id).val());

		$('#depreciationid').val(id);
		$('#operation').val(2);
		$("#basket_table").hide();
		$("#addbasketform").show();
	 	$("label.error").remove();
	}

	function openBasket(){
		$("#title").html("Add Depreciation");
		$('#basketid').val('');
		$('#bldgcond').val('');
		$('#value').val('');
		
		$('#depreciationid').val(0);
		$('#operation').val(1);
		$("#basket_table").hide();
		$("#addbasketform").show();
	 	$("label.error").remove();
	}
	
	function closeBasket(){
		$("#basket_table").show();
		$("#addbasketform").hide();
	 	$("label.error").remove();
		
	}
	
	function deleteBasket(id) {
		$('#operation').val(3);
		$('#depreciationid').val(id);
		$('#basketid').val(0);
		$('#value').val(0);
		
		var noty_id = noty({
			layout : 'center',
			text: 'Do you want Delete?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Delete', click: function($noty) {
		  
					// this = button element
					// $noty = $noty element
		  			var tenantdata = {};
		        	$('#basketform').serializeArray().map(function(x){tenantdata[x.name] = x.value;});

		            //console.log(tenantdata);
		            var tenantjson = JSON.stringify(tenantdata);
		            //$('#jsondata').val(tenantjson);
		            //console.log(tenantjson);
		            window.location.assign('tonedepreciationtrn?jsondata='+tenantjson);
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

	function validateBasket(){
		$('#basketform').validate({
	        rules: {
	            postcode: {
	                required: true,
	                minlength: 5,
	                maxlength: 6,
	            },basketid: {
	                required: true
	            },bldgcond: {
	                required: true
	            },
	            value: {
				     required: true
				  }
	        },
	        messages: {
				firstname: "Enter your firstname"
	        },
	        submitHandler: function(form) {
	        	if($('#operation').val() ==1 ) {
	        		msg ="Do you want Add?";
	        	} else {
	        		msg ="Do you want update?";
	        	}
	        	var noty_id = noty({
			layout : 'center',
			text: msg,
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Update', click: function($noty) {
		  
					var d=new Date();
	        	

				
					
					var transdata = {};
			        	$('#basketform').serializeArray().map(function(x){transdata[x.name] = x.value;});

			            //console.log(transdata);
			            var transjson = JSON.stringify(transdata);
			            //$('#jsondata').val(transjson);
			            //console.log(tenantjson);
			            window.location.assign('tonedepreciationtrn?jsondata='+transjson)
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
</script>
</body>
</html>