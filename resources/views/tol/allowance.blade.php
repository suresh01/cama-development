<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('toneoflist.TOL_Allowance')}} </title>
@include('includes.header', ['page' => 'TOL'])
	
	<div id="content">
		<div class="grid_container">
		<div id="basket_table" class="grid_12">
	
			<br>
			<div class="form_input">

				<div id="breadCrumb3"  class="breadCrumb grid_3">
					<ul >
						<li><a href="#">{{__('toneoflist.Home')}} </a></li>
						<li><a href="#">{{__('toneoflist.Tone_of_List')}} Tone of List</a></li>
						<li>{{__('toneoflist.Allowance')}} </li>
					</ul>
				</div>
				<button id="addtrans" onclick="openBasket()" style="float:right;margin-right: 10px;" name="btnadduser" type="button" class="btn_small btn_blue"><span>{{__('toneoflist.Add_Allowance')}} </span></button>
				<br>
			</div>
		
			<div class="widget_wrap">					
				<div class="widget_content">						
					<table class="display data_tbl">
					<thead style="text-align: left;">
					<tr>
						<th class="table_sno"> {{__('toneoflist.SNo')}}</th>
						<th>{{__('toneoflist.ID')}} </th>
						<th>{{__('toneoflist.Tone_Basket')}} </th>
						<th>{{__('toneoflist.Allowance_Category')}} </th>
						<th>{{__('toneoflist.Allowance_Type')}} </th>
						<th>{{__('toneoflist.Building_Category')}} </th>
						<th>{{__('toneoflist.Value')}} </th>
						<th>{{__('toneoflist.Factor')}} </th>
						<th>{{__('toneoflist.Update_by_date')}}</th>
						<th>{{__('toneoflist.Status')}} </th>	
						<th>{{__('toneoflist.Action')}} </th>						
					</tr>
					</thead>
					<tbody>
					@foreach ($allowance as $rec)	
					<tr>
						<td>
							{{$loop->iteration}}
						</td>
						<td>
							 {{ $rec->tallo_id }}
						</td>
						<td>
							 {{ $rec->tollis_year }}
						</td>
						<td>
							 {{ $rec->allcategoryname }}
						</td>
						<td>
							 {{ $rec->alltype }}
						</td>
						<td>
							 {{ $rec->bldgate }}
						</td>
						<td>
							 {{ $rec->tallo_value }}
						</td>
						<td>
							{{ $rec->tallo_factor }}
						</td>						
						<td>
							{{ $rec->tallo_updateby }} / {{$rec->tallo_updatedate}}
						</td>	
						<td>
							{{ $rec->approvalstatus }}
						</td>	
						<td class="">
							@if($rec->tallo_approvaltallostatus_id == '1' || $rec->tallo_approvaltallostatus_id == '6')
							<span><a style='height: 16px; width: 15px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -943px -102px !important;display: inline-block;' onclick="editBasket('{{ $rec->tallo_id }}')" href='#' title="{{__('common.Edit')}}"></a></span>&nbsp;&nbsp;
								<span><a style='height: 15px; width: 13px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -143px -23px !important;display: inline-block; '  onclick="deleteBasket('{{ $rec->tallo_id }}')" href='#' title="{{__('common.Delete')}}"></a></span>
								
								 <span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('{{$rec->tallo_id}}',1)"  title="{{__('common.Submit_To_Approve')}} " href="#"></a></span>					
							@elseif($rec->tallo_approvaltallostatus_id == '2')
								<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('{{$rec->tallo_id}}',2,1)"  title="{{__('common.Approve')}}" href="#"></a></span>
								<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -542px -42px !important;display: inline-block; float: left;" onclick="approve('{{$rec->tallo_id}}',2,2)"  title="{{__('common.Reject')}}" href="#"></a></span>
							@elseif($rec->tallo_approvaltallostatus_id == '3')
								<spane><a class=" new-action-icons reverse" onclick="approve('{{$rec->tallo_id}}',3)" title="{{__('common.Revise')}}" href="#"></a></span>	
									
							@elseif($rec->tallo_approvaltallostatus_id == '4')
								<span><a style='height: 16px; width: 15px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -943px -102px !important;display: inline-block;' onclick="editBasket('{{ $rec->tallo_id }}')" href='#' title="{{__('common.Edit')}}"></a></span>&nbsp;&nbsp;
								<span><a style='height: 15px; width: 13px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -143px -23px !important;display: inline-block; '  onclick="deleteBasket('{{ $rec->tallo_id }}')" href='#' title="{{__('common.Delete')}}"></a></span>
								
								<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('{{$rec->tallo_id}}',1)"  title="{{__('common.Submit_To_Approve')}}" href="#"></a></span>				
							@elseif($rec->tallo_approvaltallostatus_id == '5')
								<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('{{$rec->tallo_id}}',5)"  title="{{__('common.Approve_Revision')}}" href="#"></a></span>						
							@endif
							
						</td>
					</tr>
					<div style="display:none">
						<input type="hidden" id="basketid_{{ $rec->tallo_id }}" value="{{ $rec->tallo_tone_id }}">
						<input type="hidden" id="allowancetype_{{ $rec->tallo_id }}" value="{{ $rec->tallo_allowancetype_id }}">
						<input type="hidden" id="bldgcate_{{ $rec->tallo_id }}" value="{{ $rec->tallo_buldingcategory_id }}">	
						<input type="hidden" id="value_{{ $rec->tallo_id }}" value="{{ $rec->tallo_value }}">			
						<input type="hidden" id="factor_{{ $rec->tallo_id }}" value="{{ $rec->tallo_factor }}">
						<input type="hidden" id="allcategory_{{ $rec->tallo_id }}" value="{{ $rec->allcategory }}">
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
									<input type="hidden" name="allowanceid" id="allowanceid">
									<input type="hidden" name="jsondata" id="jsondata">
									<fieldset>
										<legend>{{__('common.Approve_Revision')}} Basket Information</legend>
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">{{__('toneoflist.Basket')}} <span class="req">*</span></label>
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
											<label class="field_title" id="lposition" for="position">{{__('toneoflist.Allowance_Category')}} <span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="allowancecate" name="allowancecate" tabindex="20">
													<option></option>
													@foreach ($allowancecate as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('toneoflist.Allowance_Type')}} <span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="allowancetype" name="allowancetype" tabindex="20">
													<option></option>
													@foreach ($allowancetype as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>

										
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">{{__('toneoflist.Buliding_Category')}} <span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="bldgcate" name="bldgcate" tabindex="20">
													<option></option>
													@foreach ($bldgcate as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('toneoflist.Value')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="value" name="value"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('toneoflist.Factor')}} <span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="factor" name="factor" tabindex="20">
													<option></option>
													<option value='+'>+</option>
													<option value='-'>-</option>													
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
								<button id="addsubmit" name="adduser" onclick="validateBasket()" class="btn_small btn_blue"><span>{{__('common.Submit')}}</span></button>									
								
								<button id="close" onclick="closeBasket()" name="close" type="button" class="btn_small btn_blue"><span>{{__('common.Close')}}</span></button>
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

<script src="js/propertyregister/tab-script.js"></script>
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
				        data:{param_value:id,module:'toneallowance',param:currstatus},
				        success:function(data){	        	
				        	
							window.location.assign("toneallowance");	
							
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
				        data:{param_value:id,module:'toneallowance',param:currstatus,param_str:param_str },
				        success:function(data){	        	
				        	
							window.location.assign("toneallowance");	
							
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

	function editBasket(id){
		$("#title").html("Update Building");
		$('#basketid').val($('#basketid_'+id).val());
		$('#allowancetype').val($('#allowancetype_'+id).val());
		$('#bldgcate').val($('#bldgcate_'+id).val());
		$('#value').val($('#value_'+id).val());
		$('#factor').val($('#factor_'+id).val());
		$('#allowancecate').val($('#allcategory_'+id).val());
		
	    	//console.log(this.value);
	    	var param_value = $('#allcategory_'+id).val();
	    	var param = 'allowance';
	        $.ajax({
			  url: "subCategory",
			  cache: false,
			  data:{param_value:param_value,param:param},
			  success: function(data){
			  	console.log(data.res_arr);
	    		createDropDownOptions(data.res_arr, 'allowancetype');
				$('#allowancetype').val($('#allowancetype_'+id).val());
			  }
			});
	   

		$('#allowanceid').val(id);
		$('#operation').val(2);
		$("#basket_table").hide();
		$("#addbasketform").show();
	 	$("label.error").remove();
	}

	function openBasket(){
		$("#title").html("Add Building");
		$('#basketid').val('');
		$('#allowancetype').val('');
		$('#bldgcate').val('');
		$('#value').val('');
		$('#factor').val('');
		$('#allowancecate').val('');

		
		$('#allowanceid').val(0);
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
		$('#allowanceid').val(id);
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
		            window.location.assign('toneallowancetrn?jsondata='+tenantjson);
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
	            },
	            basketid: {
	            	required: true
	            },
	            bldgcate: {
	            	required: true
	            },
	            allowancetype: {
	            	required: true
	            },
	            allowancecate: {
	            	required: true
	            }
	        },
	        messages: {
				firstname: "Enter your firstname"
	        },
	        submitHandler: function(form) {
	        	var msg ="";
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
			           // window.location.assign('toneallowancetrn?jsondata='+transjson)
			            //$('#tenantform').submit();
						$.ajax({
							  url: "toneallowancetrn",
							  cache: false,
							  data:{jsondata:transjson},
							  success: function(data){
							    //$("#results").append(html);
							    alert('Record added/updated success');
							  }
						});
					
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
		
	    $("#allowancecate").change(function() {
	    	//console.log(this.value);
	    	var param_value = this.value;
	    	var param = 'allowance';
	        $.ajax({
			  url: "subCategory",
			  cache: false,
			  data:{param_value:param_value,param:param},
			  success: function(data){
			  	console.log(data.res_arr);
	    		createDropDownOptions(data.res_arr, 'allowancetype');
			  }
			});
	    });
	});
</script>
</body>
</html>