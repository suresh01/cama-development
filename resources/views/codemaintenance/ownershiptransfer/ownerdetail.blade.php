<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{__('CodeMaintenance.Property_Address')}}</title>
<style>
.disabled-btn{
    pointer-events:none;
    opacity:0.7;
}
</style>
@include('includes.header-popup', ['page' => 'VP'])
	
<div id="content">
	<div class="grid_container">
		<div id="usertable" class="grid_12">
			<div id="breadCrumb3" class="breadCrumb grid_12">
				<ul>
					<li><a href="#">{{__('CodeMaintenance.Home')}} </a></li>
					<li><a href="#">{{__('CodeMaintenance.Data_Maintenance')}}</a></li>
				</ul>
			</div>
			<br>
			@foreach ($master as $master)
			<script type="text/javascript">
						$(document).ready(function(){
							$("#subzone").val('{{$master->mal_subzone_id}}');
							$("#zone").val('{{$master->zone_id}}');
							$("#state").val('{{$master->ma_state_id}}');
							$("#estate").val('{{$master->mal_state_id}}');
							$("#district").val('{{$master->mal_district_id}}');
							$("#eaccountnumber").val('{{$master->mal_accno}}');
							$("#emalid").val('{{$master->mal_id}}');
							
						});
			</script>
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<!--<span class="h_icon list"></span>-->
						<h6>{{__('CodeMaintenance.Property_Address_Information')}} </h6>
						<div id="top_tabby">
						</div>
					</div>
					<input type="hidden" value="" id="propertystatus" >
					<div class="widget_content">
						<!--<h3>Property Registration</h3>-->
						<div  class="grid_6 form_container left_label">
							<ul>
								<li>
									<fieldset>
										<legend>{{__('CodeMaintenance.Old_Address_Information')}}</legend>
										<div class="form_grid_12">
											<label class="field_title"  id="accnumberlbl" for="username">{{__('CodeMaintenance.Account_Number')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->mal_accno}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.File_Number')}}<span class="req">*</span></label>
											<div  class="form_input">
												<input id="filenumber" tabindex="2"name="ofilenumber" readonly="true" type="text" value="{{$master->ma_fileno}}" maxlength="50" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('CodeMaintenance.District')}} <span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a Status..." disabled=""  style="width:100%" class="cus-select" id="district" name="odistrict" tabindex="3">
													<option></option>
													@foreach ($district as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('CodeMaintenance.Zone')}} <span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a Status..." disabled=""  style="width:100%" class="cus-select" id="zone" name="ozone" tabindex="4">
													<option></option>
													@foreach ($zone as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('CodeMaintenance.SubZone')}} <span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a Status..." disabled=""  style="width:100%" class="cus-select"  id="subzone" name="osubzone" tabindex="5">
													<option></option>
													@foreach ($subzone as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Address1')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="address1" tabindex="8" readonly="true" name="oaddress1"  type="text" value="{{$master->ma_addr_ln1}}" maxlength="100" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Address2')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="address2"  tabindex="9" readonly="true" name="oaddress2"  type="text" value="{{$master->ma_addr_ln2}}" maxlength="100" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Address3')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="address3"  name="oaddress3" readonly="true" tabindex="10"  type="text" value="{{$master->ma_addr_ln3}}" maxlength="100" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Address4')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="address4"  name="oaddress4" readonly="true" tabindex="11"  type="text" value="{{$master->ma_addr_ln4}}" maxlength="100" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Post_Code')}}<span class="req">*</span></label>
											<div  class="form_input">
												<input id="postcode" name="opostcode" readonly="true" tabindex="12"  type="text" value="{{$master->ma_postcode}}" maxlength="50" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.City')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="city"  name="ocity" tabindex="13" readonly="true" type="text" value="{{$master->ma_city}}" maxlength="50" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('CodeMaintenance.State')}}<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a Status..." disabled=""  style="width:100%" class="cus-select"  id="state" name="ostate" tabindex="14">
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
						@endforeach
						<form id="addressform" autocomplete="off" method="post" action="#" >
							<div  class="grid_6 form_container left_label">
								<ul>
									<li>
										<fieldset>
											<legend>{{__('CodeMaintenance.New_Address_Information')}} </legend>
											<input type="hidden" id="eaccountnumber" name="accountnumber">
											<input type="hidden" id="emalid" name="malid">
											<div class="form_grid_12">
												<label class="field_title">{{__('CodeMaintenance.Copy_Previous_Detail')}} </label>
												<div class="form_input">
													<span>
														<input name="field08" id="copydetail" onchange="copyDetail()" class="checkbox" type="checkbox"  tabindex="7">
														
													</span>
												</div>
											</div>
											<input id="esubzone" tabindex="2" name="subzone" type="hidden"  maxlength="50" class=""/>
											<input id="accountnumber" tabindex="2" name="accountnumber" type="hidden"  maxlength="50" class=""/>
											<div class="form_grid_12">
												<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.File_Number')}} <span class="req">*</span></label>
												<div  class="form_input">
													<input id="efilenumber" tabindex="2" name="filenumber" type="text"  value="{{$master->mal_fileno}}" maxlength="50" class=""/>
												</div>
												<span class=" label_intro"></span>
											</div>
											<div class="form_grid_12">
												<label class="field_title" id="llevel" for="level">{{__('CodeMaintenance.District')}} <span class="req">*</span></label>
												<div  class="form_input">
													
													<input id="edistrict" tabindex="8" name="edistrict" readonly="" type="text" value="{{$master->district}}" maxlength="100" class=""/>
												</div>
												<span class=" label_intro"></span>
											</div>
											
											<div class="form_grid_12">
												<label class="field_title" id="llevel" for="level">{{__('CodeMaintenance.Zone')}} <span class="req">*</span></label>
												<div  class="form_input">
													<input id="ezone" tabindex="8" name="ezone" readonly="" type="text" value="{{$master->zone}}" maxlength="100" class=""/>
												</div>
												<span class=" label_intro"></span>
											</div>
											<div class="form_grid_12">
												<label class="field_title" id="llevel" for="level">{{__('CodeMaintenance.SubZone')}} <span class="req">*</span></label>
												<div  class="form_input">
													<input id="rsubzone" tabindex="8" name="rsubzone" readonly="" type="text" value="{{$master->subzone}}" maxlength="100" class=""/>
												</div>
												<span class=" label_intro"></span>
											</div>
											
											<div class="form_grid_12">
												<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Address1')}} <span class="req">*</span></label>
												<div  class="form_input">
													<input id="eaddress1" tabindex="8" name="address1"  type="text" value="{{$master->mal_addr_ln1}}" maxlength="100" class=""/>
												</div>
												<span class=" label_intro"></span>
											</div>
											<div class="form_grid_12">
												<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Address2')}} <span class="req">*</span></label>
												<div  class="form_input">
													<input id="eaddress2"  tabindex="9" name="address2"  type="text" value="{{$master->mal_addr_ln2}}" maxlength="100" class=""/>
												</div>
												<span class=" label_intro"></span>
											</div>
											<div class="form_grid_12">
												<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Address3')}} <span class="req">*</span></label>
												<div  class="form_input">
													<input id="eaddress3"  name="address3" tabindex="10"  type="text" value="{{$master->mal_addr_ln3}}" maxlength="100" class=""/>
												</div>
												<span class=" label_intro"></span>
											</div>
											<div class="form_grid_12">
												<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Address4')}} <span class="req">*</span></label>
												<div  class="form_input">
													<input id="eaddress4"  name="address4" tabindex="11"  type="text" value="{{$master->mal_addr_ln4}}" maxlength="100" class=""/>
												</div>
												<span class=" label_intro"></span>
											</div>
											<div class="form_grid_12">
												<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Post_Code')}}<span class="req">*</span></label>
												<div  class="form_input">
													<input id="epostcode" name="postcode"  tabindex="12"  type="text" value="{{$master->mal_postcode}}" maxlength="50" class=""/>
												</div>
												<span class=" label_intro"></span>
											</div>
											<div class="form_grid_12">
												<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.City')}} <span class="req">*</span></label>
												<div  class="form_input">
													<input id="ecity"  name="city" tabindex="13" type="text" value="{{$master->mal_city}}" maxlength="50" class=""/>
												</div>
												<span class=" label_intro"></span>
											</div>
											<div class="form_grid_12">
												<label class="field_title" id="llevel" for="level">{{__('CodeMaintenance.State')}}<span class="req">*</span></label>
												<div  class="form_input">
													<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="estate" name="state" tabindex="14">
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
									<button id="addsubmit" name="adduser" onclick="validateDetail()" class="btn_small btn_blue"><span>{{__('common.Submit')}} </span></button>
									
									<button id="close" onclick="closeTenant()" name="close" type="button" class="btn_small btn_blue"><span>{{__('common.Close')}} 	</span></button>
									<span class=" label_intro"></span>
								</div>
								<span class="clear"></span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="" id="finishloader"></div>
	<span class="clear"></span>
	<script src="js/propertyregister/tab-script.js"></script>
</div>

<script type="text/javascript">


	function closeTenant(){
	    try {
	        window.opener.HandlePopupResult(sender.getAttribute("result"));
	    }
	    catch (err) {}
	    window.close();
	    return false;
  	}

	function copyDetail(){
		//alert($("#subzone option:selected").text());
		if($('#copydetail').prop("checked") == true){
            $("#estate").val($("#state").val());
			$("#efilenumber").val($("#filenumber").val());
			$("#edistrict").val($("#district option:selected").text());
			$("#ezone").val($("#zone option:selected").text());
			$("#rsubzone").val($("#subzone option:selected").text());
			$("#eaddress1").val($("#address1").val());
			$("#eaddress2").val($("#address2").val());
			$("#eaddress3").val($("#address3").val());
			$("#eaddress4").val($("#address4").val());
			$("#epostcode").val($("#postcode").val());
			$("#ecity").val($("#city").val());

			$("#accountnumber").val($("#accnumber").val());
			//$("#esubzone").val($("#subzone").val());
        }
        else if($('#copydetail').prop("checked") == false){
            $("#estate").val('');
			$("#edistrict").val('');
			$("#ezone").val('');
			$("#esubzone").val('');
			$("#efilenumber").val('');
			$("#eaddress1").val('');
			$("#eaddress2").val('');
			$("#eaddress3").val('');
			$("#eaddress4").val('');
			$("#epostcode").val('');
			$("#ecity").val('');
        }
		
		
	}

	function validateDetail(){
			$('#addressform').validate({
		        rules: {
		            'termid': 'required',
		            'name': 'required'
		        },
		        messages: {
					"term": "Please select term name",
					"name": "Please enter basket name"
		        },
		        submitHandler: function(form) {
					var d=new Date();		        	
					var operation = $('#operation').val();
					var page = "ratepayer";
					var groupdata = {};
		        	$('#addressform').serializeArray().map(function(x){groupdata[x.name] = x.value;});

		            var groupjson = JSON.stringify(groupdata);


		            var noty_id = noty({
				layout : 'center',
				text: 'Are want to update address Information?',
				modal : true,
				buttons: [
					{type: 'button blue', text: 'Submit', click: function($noty) {
			  
						$noty.close();

						var d=new Date();
						$.ajax({
				  				type: 'GET', 
							    url:'propertyinfotrn',
							    headers: {
								    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
						        data:{jsondata:groupjson},
						        success:function(data){
						        	//$('#propertystatus').val('Registered');
									$('#finishloader').html('');
						        	var noty_id = noty({
										layout : 'top',
										text: 'Address updated successfully!',
										modal : true,
										type : 'success', 
									});			
						        	 //window.location.assign('propertyinfotrn?jsondata='+groupjson);	  
									 window.opener.HandlePopupResult(sender.getAttribute("result"));
								
					        	},
						        error:function(data){
										
						        	$('#finishloader').html('');     	
						        		var noty_id = noty({
										layout : 'top',
										text: 'Problem while update!',
										modal : true,
										type : 'error', 
									});
					        	}
					    	});

						  }
									},
									{type: 'button pink', text: 'Cancel', click: function($noty) {
										$noty.close();
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