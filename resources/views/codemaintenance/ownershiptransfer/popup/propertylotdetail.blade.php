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
			
			<br>
			@foreach ($master as $master)
			<script type="text/javascript">
						$(document).ready(function(){
							$("#lotype").val('{{$master->LO_LOTCODE_ID}}');
							$("#lttt").val('{{$master->LO_TITLETYPE_ID}}');
							$("#tentype").val('{{$master->LO_TENURETYPE_ID}}');

							$( "#ntenstart" ).datepicker({dateFormat: 'dd/mm/yy'});
							$( "#ntenend" ).datepicker({dateFormat: 'dd/mm/yy'});


							$("#lot_id").val('{{$master->LOT_ID}}');
							$("#nlog_id").val('{{$master->log_id}}');

							$("#nlotype").val('{{$master->log_lotcode_id}}');
							$("#nlotnum").val('{{$master->log_no}}');
							$("#naltlotnum").val('{{$master->log_altno}}');
							$("#nlttt").val('{{$master->log_titletype_id}}');
							$("#nltnum").val('{{$master->log_titleno}}');
							$("#naltnum").val('{{$master->log_alttitleno}}');
							$("#nstratano").val('{{$master->log_stratano}}');
							$("#ntentype").val('{{$master->log_tenuretype_id}}');
							$("#ntenduration").val('{{$master->log_tenureperiod}}');
							$("#ntenstart").val('{{$master->log_startdate}}');
							$("#ntenend").val('{{$master->log_expireddate}}');
						});
			</script>
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<!--<span class="h_icon list"></span>-->
						<h6>{{__('CodeMaintenance.Lot_Information')}} </h6>
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
									<legend>{{__('CodeMaintenance.Lot_Information')}} </legend>					
									<br><br><br>
									
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Lot_Code')}}<span class="req">*</span></label>
										<div  class="form_input">
											<select placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="lotype" name="lotype" tabindex="1">
												<option value=""></option>
											@foreach ($lotcode as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									
									
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Lot_No')}}<span class="req">*</span></label>
										<div  class="form_input">
											<input id="lotnum" tabindex="8" readonly="" name="lotnum" value="{{$master->LO_NO}}" type="text" maxlength="100" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Alternate_Lot_No')}} <span class="req">*</span></label>
										<div  class="form_input">
											<input id="altlotnum" readonly=""  tabindex="9" name="altlotnum" value="{{$master->LO_ALTNO}}"  type="text"  maxlength="100" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Title_Code')}}<span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="lttt" tabindex="4" name="lttt" tabindex="20">
												<option></option>
											@foreach ($titiletype as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Title_No')}}<span class="req">*</span></label>
										<div  class="form_input">
											<input id="ltnum"  name="ltnum" readonly="" tabindex="11" value="{{$master->LO_TITLENO}}"  type="text"  maxlength="100" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Altenate_Title_No')}} <span class="req">*</span></label>
										<div  class="form_input">
											<input id="altnum" name="altnum"  readonly="" tabindex="12" value="{{$master->LO_ALTTITLENO}}"  type="text"  maxlength="50" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Strata_No')}} <span class="req">*</span></label>
										<div  class="form_input">
											<input id="stratano" name="stratano"  readonly="" tabindex="12" value="{{$master->LO_STRATANO}}"  type="text"  maxlength="50" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
								</fieldset>

								<fieldset>
									<legend>{{__('CodeMaintenance.Lease_Information')}} </legend>					
									
									
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Tenure_Type')}} <span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="tentype" tabindex="19" name="tentype" tabindex="20">
												<option></option>
												@foreach ($tnttype as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
												@endforeach	
											</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									
									
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Tenure_Period')}}<span class="req">*</span></label>
										<div  class="form_input">
											<input id="tenduration" tabindex="8" readonly="" name="tenduration" value="{{$master->LO_TENUREPERIOD}}"  type="text" maxlength="100" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Tenure_Start_Date')}} <span class="req">*</span></label>
										<div  class="form_input">
										<input type="text" id="tenstart" readonly="" value="{{$master->LO_STARTDATE}}"  dateFormat='dd/mm/yyyy' name="tenstart" tabindex="21">
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Tenure_End_Date')}}<span class="req">*</span></label>
										<div  class="form_input">
										<input id="tenend"  name="tenend" readonly="" value="{{$master->LO_EXPIREDDATE}}" dateFormat='dd/mm/yyyy'  class="" type="text"  maxlength="50" />
										</div>
										<span class=" label_intro"></span>
									</div>
								</fieldset>
								</li>
							</ul>
						</div>
						
						<form id="addressform" autocomplete="off" method="post" action="#" >
							<input type="hidden"  name="nlog_id" id="nlog_id" >
							<input type="hidden"  name="lot_id" id="lot_id" >
							<div  class="grid_6 form_container left_label">
								<ul>
									<li>
										<fieldset>
										<legend>{{__('CodeMaintenance.Lot_Information')}} </legend>					
										
										<div class="form_grid_12">
											<label class="field_title">Copy Previous Detail</label>
											<div class="form_input">
												<span>
												<input name="field08" id="copydetail" onchange="copyDetail()" class="checkbox" type="checkbox"  tabindex="7">
												
												</span>
											</div>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Lot_Code')}}<span class="req">*</span></label>
											<div  class="form_input">
												<select placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="nlotype" name="nlotype" tabindex="1">
													<option value=""></option>
												@foreach ($lotcode as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
												@endforeach	
											</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Lot_No')}}<span class="req">*</span></label>
											<div  class="form_input">
												<input id="nlotnum" tabindex="8" name="nlotnum" type="text" maxlength="100" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Alternate_Lot_No')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="naltlotnum"  tabindex="9" name="naltlotnum"  type="text"  maxlength="100" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Title_Code')}}<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="nlttt" tabindex="4" name="nlttt" tabindex="20">
													<option></option>
												@foreach ($titiletype as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
												@endforeach	
											</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Title_No')}}<span class="req">*</span></label>
											<div  class="form_input">
												<input id="nltnum"  name="nltnum" tabindex="11" type="text"  maxlength="100" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Altenate_Title_No')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="naltnum" name="naltnum"  tabindex="12"  type="text"  maxlength="50" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Strata_No')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="nstratano" name="nstratano"  tabindex="12" type="text"  maxlength="50" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>
									</fieldset>

									<fieldset>
										<legend>{{__('CodeMaintenance.Lease_Information')}} </legend>					
										
										
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Tenure_Type')}} <span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="ntentype" tabindex="19" name="ntentype" tabindex="20">
													<option></option>
													@foreach ($tnttype as $rec)
															<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Tenure_Period')}}<span class="req">*</span></label>
											<div  class="form_input">
												<input id="ntenduration" tabindex="8" name="ntenduration"  type="text" maxlength="100" class=""/>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Tenure_Start_Date')}} <span class="req">*</span></label>
											<div  class="form_input">
											<input type="text" id="ntenstart" dateFormat='dd/mm/yyyy' name="ntenstart" tabindex="21">
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Tenure_End_Date')}}<span class="req">*</span></label>
											<div  class="form_input">
											<input id="ntenend"  name="ntenend"  class="" type="text"  maxlength="50" />
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


			@endforeach
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
            $("#nlotype").val($("#lotype").val());
			$("#nlotnum").val($("#lotnum").val());
			$("#naltlotnum").val($("#altlotnum").val());
			$("#nlttt").val($("#lttt").val());
			$("#nltnum").val($("#ltnum").val());
			$("#naltnum").val($("#altnum").val());
			$("#nstratano").val($("#stratano").val());
			$("#ntentype").val($("#tentype").val());
			$("#ntenduration").val($("#tenduration").val());
			$("#ntenstart").val($("#tenstart").val());
			$("#ntenend").val($("#tenend").val());
        }
        else if($('#copydetail').prop("checked") == false){
            $("#nlotype").val('');
			$("#nlotnum").val('');
			$("#naltlotnum").val('');
			$("#nlttt").val('');
			$("#efilenumber").val('');
			$("#nltnum").val('');
			$("#naltnum").val('');
			$("#ntentype").val('');
			$("#ntenduration").val('');
			$("#ntenstart").val('');
			$("#ntenend").val('');
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
				text: 'Are want to update lot information?',
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
						        data:{jsondata:groupjson,module:'lottrn'},
						        success:function(data){
						        	//$('#propertystatus').val('Registered');
									$('#finishloader').html('');
						        	var noty_id = noty({
										layout : 'top',
										text: 'Lot updated successfully!',
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