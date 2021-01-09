<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>TOL Building</title>
@include('includes.header', ['page' => 'TOL'])
	<style>
		
		div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
	</style>
	<div id="content">
		<div class="grid_container">
		<div id="basket_table" class="grid_12">
	
			<br>
			<div class="form_input">

				<div id="breadCrumb3" class="breadCrumb grid_3">
					<ul >
						<li><a href="#">Home</a></li>
						<li><a href="#">Tone of List</a></li>
						<li>Building</li>
					</ul>
				</div>
							
				@include('tol.search',['tableid'=>'bldgtable', 'action' => 'tonebldgtable', 'searchid' => '24'])
				
				<button id="addtrans" onclick="openBasket()" style="float:right;" name="btnadduser" type="button" class="btn_small btn_blue"><span>Add Building</span></button>
				<br>
			</div>
		
			<div class="widget_wrap">					
				<div class="widget_content">						
					<table style="width: 100%;" id="bldgtable" class="display ">


						<div class="social_activities">
							<div style="width: 220px;" class="comments_s">
								<div class="block_label">
									Count<span id="prop_count">0</span>
								</div>
							</div>
							
							<select id='testSelect1' style="float: right;" multiple>
								<option value='1'>Rate Basket</option>
								<option value='2'>Transaction Type</option>
								<option value='3'>ZONE</option>
								<option value='4'>Subzone</option>
								<option value='5'>Property Category</option>
								<option value='6'>Property Type</option>
								<option value='7'>Property Storey</option>
								<option value='8'>Area Type</option>
								<option value='9'>Area Level</option>
								<option value='10'>Area Category</option>
								<option value='11'>Area Use</option>
								<option value='12'>Value</option>
								<option value='13'>Update by / Update date</option>
								<option value='14'>Update by / Update date</option>
							</select>
								
						</div>	

					<thead style="text-align: left;"> 
					<tr>
						<th><input name="select_all" value="1" type="checkbox"></th>
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
							Transaction Type
						</th>
						<th>
							Zone
						</th>
						<th>
							Subzone
						</th>
						<th>
							Property Category 
						</th>
						<th>
							Property Type
						</th>
						<th>
							Property Storey 
						</th>
						<th>
							Area Type
						</th>
						<th>
							Area Level
						</th>
						<th>
							Area Category
						</th>
						<th>
							Area Use
						</th>
						<th>
							Value
						</th>
						<th>
							Update by / Update date
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
					
					</table>
					@foreach ($bldg as $rec)
					<div style="display:none">
						<input type="hidden" id="basketid_{{ $rec->tbldg_id }}" value="{{ $rec->tbldg_tone_id }}">
						<input type="hidden" id="suzone_{{ $rec->tbldg_id }}" value="{{ $rec->tbldg_subzon_id }}">
						<input type="hidden" id="proptype_{{ $rec->tbldg_id }}" value="{{ $rec->tbldg_proptype_id }}">	
						<input type="hidden" id="propstoery_{{ $rec->tbldg_id }}" value="{{ $rec->tbldg_propstorey_id }}">		
						<input type="hidden" id="artype_{{ $rec->tbldg_id }}" value="{{ $rec->tbldg_areatype_id }}">
						<input type="hidden" id="arlvl_{{ $rec->tbldg_id }}" value="{{ $rec->tbldg_arealevel_id }}">
						<input type="hidden" id="arcate_{{ $rec->tbldg_id }}" value="{{ $rec->tbldg_areacategory_id }}">	
						<input type="hidden" id="aruse_{{ $rec->tbldg_id }}" value="{{ $rec->tbldg_areause_id }}">		
						<input type="hidden" id="value_{{ $rec->tbldg_id }}" value="{{ $rec->tbldg_value }}">
						<input type="hidden" id="zone_{{ $rec->tbldg_id }}" value="{{ $rec->zoneid }}">		
						<input type="hidden" id="propcate_{{ $rec->tbldg_id }}" value="{{ $rec->propcategory }}">	
						<input type="hidden" id="transtype_{{ $rec->tbldg_id }}" value="{{ $rec->tbldg_transtype_id }}">
					</div>
						@endforeach
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
									<input type="hidden" name="bldgid" id="bldgid">
									<input type="hidden" name="jsondata" id="jsondata">
									<fieldset>
										<legend>Basket Information</legend>
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">Tone Basket<span class="req">*</span></label>
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
											<label class="field_title" id="lposition" for="position">TRANSACTION TYPE<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="trnstype" name="trnstype" tabindex="20">
													<option></option>
													@foreach ($trnstype as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">ZONE<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="zone" name="zone" tabindex="20">
													<option></option>
													@foreach ($zone as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">SUBZONE<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="subzone" name="subzone" tabindex="20">
													<option></option>
													@foreach ($subzone as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">PROPERTY CATEGORY<span class="req">*</span></label>
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
											<label class="field_title" id="llevel" for="level">PROPERTY TYPE<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="proptype" name="proptype" tabindex="20">
													<option></option>
													@foreach ($bldgtype as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">PROPERTY STOREY<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="propstoery" name="propstoery" tabindex="20">
													<option></option>
													@foreach ($bldgstore as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">AREA TYPE<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="artype" name="artype" tabindex="20">
													<option></option>
													@foreach ($artype as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">AREA LEVEL<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="arlvl" name="arlvl" tabindex="20">
													<option></option>
													@foreach ($arlvl as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">AREA CATEGORY<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="arcate" name="arcate" tabindex="20">
													<option></option>
													@foreach ($arcaty as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">AREA USE<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="aruse" name="aruse" tabindex="20">
													<option></option>
													@foreach ($aruse as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">VALUE<span class="req">*</span></label>
											<div  class="form_input">
												<input id="value" name="value" pattern="^\d*(\.\d{0,2})?$" type="text"  maxlength="50" class="required"/>
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
	
<script src="js/propertyregister/tab-script.js"></script>
</div>

<script>
	function approve(id,currstatus){

	var table = $('#bldgtable').DataTable();
		var account = $.map(table.rows('.selected').data(), function (item) {
		// console.log(item);
    		return item['tbldg_id']
		});
		if(account.length==0){
				account=id;
	   		} else {
	   			account=account.toString();
	   		}
	//	alert(account);
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
				        data:{param_value:id,module:'tonebldg',param:currstatus },
				        success:function(data){	        	
				        	
							window.location.assign("tonebldg");	
							
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
				        data:{param_value:id,module:'tonebldg',param:currstatus,param_str:param_str },
				        success:function(data){	 	
				        	
							window.location.assign("tonebldg");	
							
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
		$('#subzone').val($('#suzone_'+id).val());
		$('#propstoery').val($('#propstoery_'+id).val());
		$('#proptype').val($('#proptype_'+id).val());
		$('#artype').val($('#artype_'+id).val());
		$('#arlvl').val($('#arlvl_'+id).val());
		$('#arcate').val($('#arcate_'+id).val());
		$('#aruse').val($('#aruse_'+id).val());
		$('#value').val($('#value_'+id).val());
		$('#zone').val($('#zone_'+id).val());
		$('#trnstype').val($('#transtype_'+id).val());
		
		$('#bldgcate').val($('#propcate_'+id).val());
		var param_value = $('#propcate_'+id).val();
	    	var param = 'bldgtype';
	        $.ajax({
			  url: "subCategory",
			  cache: false,
			  data:{param_value:param_value,param:param},
			  success: function(data){
	    		createDropDownOptions(data.res_arr, 'proptype');
	    		createDropDownOptions(data.res_arr2, 'propstoery');
	    		createDropDownOptions(data.res_arr3, 'arlvl');
	    		createDropDownOptions(data.res_arr4, 'aruse');
				$('#aruse').val($('#aruse_'+id).val());
				$('#propstoery').val($('#propstoery_'+id).val());
				$('#proptype').val($('#proptype_'+id).val());
				$('#arlvl').val($('#arlvl_'+id).val());
			  }
			});

			var param_value = $('#zone_'+id).val();
	    	var param = 'subzone';
	        $.ajax({
			  url: "subCategory",
			  cache: false,
			  data:{param_value:param_value,param:param},
			  success: function(data){
	    		createDropDownOptions(data.res_arr, 'subzone');

				$('#subzone').val($('#suzone_'+id).val());
			  }
			});

		$('#bldgid').val(id);
		$('#operation').val(2);
		$("#basket_table").hide();
		$("#addbasketform").show();
	 	$("label.error").remove();
	}

	function openBasket(){
		$("#title").html("Add Building");
		$('#basketid').val('');
		$('#subzone').val('');
		$('#propstoery').val('');
		$('#proptype').val('');
		$('#artype').val('');
		$('#arlvl').val('');
		$('#arcate').val('');
		$('#aruse').val('');
		$('#value').val('');
		$('#zone').val('');
		$('#bldgcate').val('');

		
		$('#bldgid').val(0);
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
		$('#bldgid').val(id);
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
		            window.location.assign('tonebldgtrn?jsondata='+tenantjson);
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
	            zone: {
	                required: true
	            },
	            subzone: {
	                required: true
	            },
	            bldgcate: {
	                required: true
	            },
	            proptype: {
	                required: true
	            },
	            propstoery: {
	                required: true
	            },
	            artype: {
	                required: true
	            },
	            arlvl: {
	                required: true
	            },
	            arcate: {
	                required: true
	            },
	            aruse: {
	                required: true
	            },
	            trnstype: {
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
			           // window.location.assign('tonebldgtrn?jsondata='+transjson)
			            //$('#tenantform').submit();
						$.ajax({
							  url: "tonebldgtrn",
							  cache: false,
							  data:{jsondata:transjson},
							  success: function(data){
							    //$("#results").append(html);
							    alert('Record added success');
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

		$('#bldgtable').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				"lengthMenu":  [100, 200, 500, 1000],
				"dom": '<"top"i>rt<"bottom"flp><"clear">',
		        "ajax": {
		            "type": "GET",
		            "url": 'tonebldgtable',
		            "contentType": 'application/json; charset=utf-8',
				    "headers": {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		        },
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [		        
			        {"data": "tbldg_id", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": null, "name": "sno", "title": "S No"},
			        {"data": "tbldg_id", "name": "fileno"},
			        {"data": "tollis_year", "name": "fileno"},
			        {"data": "trnstype", "name": "zone"},
			        {"data": "zone", "name": "zone"},
			        {"data": "subzone", "name": "subzone"},
			        {"data": "category", "name": "address"},
			        {"data": "bldgtype", "name": "address"},
			        {"data": "bldgstorey", "name": "address"},
			        {"data": "artype", "name": "address"},
			        {"data": "arlvl", "name": "address"},
			        {"data": "arcategory", "name": "address"},
			        {"data": "aruse", "name": "TO_OWNNAME"},
			        {"data": "tbldg_value", "name": "TO_OWNNO"},
			        {"data": function(data){
			        		//var url = 'datasearchdetail?prop_id='+data.vd_id; formatMoneyHas
			        		return data.tbldg_udpateby+" / "+data.tbldg_updatedate+"</a>";
			        	
			        }, "name": "TO_OWNNAME"},
			        {"data": "approvalstatus", "name": "TO_OWNNO"},
			        {"data": function(data){
			        	
			        	var action = "";
			        		
							var editaction ="<span><a style='height: 16px; width: 15px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -943px -102px !important;display: inline-block;' onclick='editBasket("+data.tbldg_id+")' href='#' title='Edit'></a></span> " +
							"&nbsp;&nbsp;<span><a style='height: 15px; width: 13px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -143px -23px !important;display: inline-block; '  onclick='deleteBasket("+data.tbldg_id+")' href='#' title='Delete'></a></span>";

							if(data.tbldg_approvalbldgstatus_id == '1'  || data.tbldg_approvalbldgstatus_id == '6'){
								action = editaction +  '<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('+data.tbldg_id+',1)"  title="Submit To Approve" href="#"></a></span>';							
							} else if(data.tbldg_approvalbldgstatus_id == '2'){
								action =   '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('+data.tbldg_id+',2,1)"  title="Approve" href="#"></a></span>' + 
								'<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -542px -42px !important;display: inline-block; float: left;" onclick="approve('+data.tbldg_id+',2,2)"  title="Reject" href="#"></a></span>';							
							} else if(data.tbldg_approvalbldgstatus_id == '3'){
								action =  '<spane><a  class=" new-action-icons reverse" onclick="approve('+data.tbldg_id+',3)" title="Revise" href="#"></a></span>';
						
							} else if(data.tbldg_approvalbldgstatus_id == '4'){
								action =  editaction +   '<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('+data.tbldg_id+',1)"  title="Submit To Approve" href="#"></a></span>';

							} else if(data.tbldg_approvalbldgstatus_id == '5'){
								action =   '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('+data.tbldg_id+',5)"  title="Approve Revise" href="#"></a></span>';						
							} 
							

			        		return action;

			        		
			        }, "name": "TO_OWNNO"}
		   		],
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  					var count = $('#bldgtable').DataTable().rows().count();
					$('#prop_count').html(count);
			        $("td:nth-child(2)", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
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

		document.multiselect('#testSelect1');
		//var table = $('#bldgtable').DataTable();
		//var column = table.column( 3);
		$('.multiselect-checkbox').click(function() {
			  // alert($(this).attr('data-val'););
			var id  = $(this).attr('data-val');
		    var table = $('#bldgtable').DataTable();
			var column = table.column( id);
			 //alert($('#'+id).prop("checked"));
			if (id != '-1') {
				column.visible( $(this).prop("checked"));
			}

			/*if(id == '-1'){
				if($(this).prop("checked")) {
					defaultDatatableColumn(["1","2","3","4","5","6","7","8","9","10","11","12","13"]);
				} 

			}*/
		});

		$('#testSelect1_input').val('Columns');
		//console.log($('.multiselect-wrapper .multiselect-list span:first').hide());
		//$('.multiselect-wrapper .multiselect-list hr:first').hide();
var rows_selected = [];
		//var hidecol = [4,5,6];
		// table hide colmn
		hideCol('bldgtable', [5,6,7]);
		
		defaultDatatableColumn(["1","2","3","4","8","9","10","11","12","13","14"]);

		$('.multiselect-wrapper .multiselect-list span:first').html('');
		//$('.multiselect-wrapper .multiselect-list hr:first').html('');
 $('#bldgtable tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = $('#bldgtable').DataTable().row($row).data();

      // Get row ID
      var rowId = data[0];

      // Determine whether row ID is in the list of selected row IDs
      var index = $.inArray(rowId, rows_selected);

      // If checkbox is checked and row ID is not in list of selected row IDs
      if(this.checked && index === -1){
         rows_selected.push(rowId);

      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
      } else if (!this.checked && index !== -1){
         rows_selected.splice(index, 1);
      }

      if(this.checked){
         $row.addClass('selected');
      } else {
         $row.removeClass('selected');
      }

      // Update state of "Select all" control
      updateDataTableSelectAllCtrl($('#bldgtable').DataTable());

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

  

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', $('#bldgtable').DataTable().table().container()).on('click', function(e){
      if(this.checked){
        $('#bldgtable tbody input[type="checkbox"]').prop('checked', true);
         $('#bldgtable tbody tr').addClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      } else {
         $('#bldgtable tbody input[type="checkbox"]').prop('checked', false);
         $('#bldgtable tbody tr').removeClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });
		//column.visible(false);
		var count = $('#bldgtable').DataTable().rows().count();
		$('#prop_count').html(count);

		$("div.table_top select").addClass('tbl_length');
		$(".tbl_length").chosen({
			disable_search_threshold: 4	
		});

		$("#zone").change(function() {
	    	//console.log(this.value);
	    	var param_value = this.value;
	    	var param = 'subzone';
	        $.ajax({
			  url: "subCategory",
			  cache: false,
			  data:{param_value:param_value,param:param},
			  success: function(data){
			    //$("#results").append(html);
			    var d = jQuery.parseJSON(data.res_arr);
			    //console.log(d);
			    console.log(data.res_arr.length);
			    console.log(data.res_arr[0].tdi_value);
			     //$('#zone').append('<option value=""></option>');
	    		createDropDownOptions(data.res_arr, 'subzone')
			  }
			});
	    });
	    
	    $("#bldgcate").change(function() {
	    	//console.log(this.value);
	    	var param_value = this.value;
	    	var param = 'bldgtype';
	        $.ajax({
			  url: "subCategory",
			  cache: false,
			  data:{param_value:param_value,param:param},
			  success: function(data){
	    		createDropDownOptions(data.res_arr, 'proptype');
	    		createDropDownOptions(data.res_arr2, 'propstoery');
	    		createDropDownOptions(data.res_arr3, 'arlvl');
	    		createDropDownOptions(data.res_arr4, 'aruse');
			  }
			});
	    });
	});


		function updateDataTableSelectAllCtrl(table){
		   var $table             = table.table().node();
		   var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
		   var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
		   var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

			   // If none of the checkboxes are checked
		   if($chkbox_checked.length === 0){
		      chkbox_select_all.checked = false;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = false;
		      }

		   // If all of the checkboxes are checked
		   } else if ($chkbox_checked.length === $chkbox_all.length){
		      chkbox_select_all.checked = true;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = false;
		      }

		   // If some of the checkboxes are checked
		   } else {
		      chkbox_select_all.checked = true;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = true;
		      }
		   }
			$('#info').html(selectedrow() + " Row Selected");
		}

		function selectedrow(){
		  var table = $('#bldgtable').DataTable();
		  var count = 0;
		  $.map(table.rows('.selected').data(), function (item) {
		       count++;
		    });
		  return count;
		}
</script>
</body>
</html>