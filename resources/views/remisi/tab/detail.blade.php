
@foreach ($master as $master)
						<input type="hidden" name="id" value="{{$id}}">
						<input type="hidden" id="status" name="status" value="2">
						<div class="grid_12 ">
							<ul>
							<li>
								<fieldset>
									<legend>{{__('remisiLang.Registration')}} </legend>
										<div class="form_grid_12">
											<label class="field_title"  id="accnumberlbl" for="username">{{__('remisiLang.Applicant_Reff_No')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="appref" tabindex="1" name="appref" type="text" value="{{$master->rg_reff}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('remisiLang.Applicant_Later_Date')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="appltdate" tabindex="1" name="appltdate" type="text" value="{{$master->rg_applydate}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Applicant_Name')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="appname" tabindex="1" name="appname" type="text" value="{{$master->rg_applntname}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
								 		
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Applicant_Address1')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="appddr1" tabindex="1" name="appddr1" type="text" value="{{$master->rg_applntaddr_ln1}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Applicant_Address2')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="appddr2" tabindex="1" name="appddr2" type="text" value="{{$master->rg_applntaddr_ln2}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Applicant_Address3')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="appddr3" tabindex="1" name="appddr3" type="text" value="{{$master->rg_applntaddr_ln3}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
								 		
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Applicant_Address4')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="appddr4" tabindex="1" name="appddr4" type="text" value="{{$master->rg_applntaddr_ln4}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Applicant_City')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="appcity" tabindex="1" name="appcity" type="text" value="{{$master->rg_applntcity}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Applicant_Postcode')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="apppostcode" tabindex="1" name="apppostcode" type="text" value="{{$master->rg_applntpostcode}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
								 		
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Applicant_State')}} <span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="appstate" name="appstate" tabindex="14">
													<option></option>
													@foreach ($state as $rec)
															<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Vacancy_Start_Date')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="vstartdt" tabindex="1" name="vstartdt" type="text" value="{{$master->rg_applntvacancystartdate}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Vacancy_End_Date')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="venddt" tabindex="1" name="venddt" type="text" value="{{$master->rg_applntvacancyenddate}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
								 		
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Registration_Officer')}} <span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"   id="refoff" name="refoff" tabindex="14">
													<option></option>
													@foreach ($userlist as $rec)
															<option value='{{ $rec->usr_name }}'>{{ $rec->name }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Registration_Date')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="regdate" tabindex="1" name="regdate" type="text" value="{{$master->rg_regofficerdate}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
										
									</fieldset>
								</li>
							</ul>
						</div>
					
<script type="text/javascript">

	$(document).ready(function() {
		$( "#appltdate " ).datepicker({dateFormat: 'dd/mm/yy'});
		$( "#vstartdt" ).datepicker({dateFormat: 'dd/mm/yy'});
		$( "#venddt " ).datepicker({dateFormat: 'dd/mm/yy'});
		$( "#regdate" ).datepicker({dateFormat: 'dd/mm/yy'});
		$( "#insvdate" ).datepicker({dateFormat: 'dd/mm/yy'});


		$( "#appstate" ).val('{{$master->rg_applntstate_id}}');
		$( "#refoff" ).val('{{$master->rg_regofficer}}');
		

		$( "#impldate " ).datepicker({dateFormat: 'dd/mm/yy'});
		$( "#vacantedate" ).datepicker({dateFormat: 'dd/mm/yy'});
		$( "#vacantsdate" ).datepicker({dateFormat: 'dd/mm/yy'});
		$( "#resultdate" ).datepicker({dateFormat: 'dd/mm/yy'});
		if('{{$remisistatus}}' == '2'){
			$('#status').val('3');
		} else if('{{$remisistatus}}' == '3'){
			$('#status').val('3');
		}
	});
</script>
@endforeach