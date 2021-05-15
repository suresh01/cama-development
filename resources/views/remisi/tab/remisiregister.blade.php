
								@foreach ($master as $master)
							<div class="grid_12">
									<ul>
							<li>
								
										<div class="form_grid_12">
											<label class="field_title"  id="accnumberlbl" for="username">{{__('remisiLang.Acc_No')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->ma_accno}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('remisiLang.File_No')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->ma_fileno}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
									</li>
								</ul>
							</div>
						<div class="grid_6">
							<ul>
							<li>
								
									<fieldset>
										<legend>{{__('remisiLang.Owner_Information')}} </legend>
								 		
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Owner_Name')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->to_ownname}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Owner_Identity_No')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->to_ownno}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Owner_Tel_No')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->to_telno}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
								 		
										
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Address1')}}<span class="req">*</span></label>
											<div  class="form_input">
												<input id="ownaddr1" tabindex="1" readonly="true" name="ownaddr1" type="text" value="{{$master->TO_ADDR_LN1}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Address2')}}<span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->TO_ADDR_LN2}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Address3')}}<span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->TO_ADDR_LN3}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Address4')}}<span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->TO_ADDR_LN4}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Postcode')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->TO_POSTCODE}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.City')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->TO_CITY}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.State')}} <span class="req">*</span></label>
											<div  class="form_input">

												<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="ownstate"  disabled="true" name="propstate" tabindex="14">
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
						<div class="grid_6">
							<ul>
								<li>
									<fieldset>
										<legend>{{__('remisiLang.Property_Information')}}</legend>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Address1')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->ma_addr_ln1}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Address2')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->ma_addr_ln2}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Address3')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->ma_addr_ln3}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Address4')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->ma_addr_ln4}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.Postcode')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->ma_postcode}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.City')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->ma_city}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('remisiLang.State')}} <span class="req">*</span></label>
											<div  class="form_input">

												<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  disabled="true" id="propstate" name="propstate" tabindex="14">
													<option></option>
													@foreach ($state as $rec)
															<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">Land Value<span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->landvalue}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">Building Value<span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->bldgvalue}}" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

									</fieldset>
								</li>
							</ul>
						</div>

						<script type="text/javascript">
						$(document).ready(function(){
							$("#propstate").val('{{$master->ma_state_id}}');
							$("#ownstate").val('{{$master->TO_STATE_ID}}');

						});
					</script>
					
					@endforeach
				
	
	