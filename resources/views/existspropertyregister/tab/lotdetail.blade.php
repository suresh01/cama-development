
								<div style="height: 48px; display: -webkit-box;text-align: -webkit-right;" class="grid_12">
									<button id="submitaddtbllot" onclick="addlotRow()" style="display:none" name="adduser" type="button" class="btn_small btn_blue"><span>Add New</span></button>	
									<button id="submitedittbllot" onclick="editlotRow()" style="display:none" name="adduser" type="button" class="btn_small btn_blue"><span>Update</span></button>	
								<button id="close" onclick="closelot()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>
								</div>
									<div  class="grid_6">
									<ul>
									<li>
										<input type="hidden" value="0" name="operation" id="lot_operation">
										<input type="hidden" value="0" name="master_id" id="lot_master_id">
										<input type="hidden" value="0" name="lot_id" id="lot_id">
										<input type="hidden" value="0" name="lotaccnum" id="lotaccnum">
										<input type="hidden" id="tableindex">
										<fieldset>
										<legend>Lot Information</legend>
									<div class="form_grid_12">
										<label class="field_title" id="lusername" for="username">LOT TYPE<span class="req">*</span></label>
										<div  class="form_input">
											<select placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="lotype" name="lotype" tabindex="20">
												<option value=""></option>
											@foreach ($lotcode as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">LOT NUMBER<span class="req">*</span></label>
										<div  class="form_input">
											<input id="lotnum" name="lotnum" type="text" value="" maxlength="50" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
									
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">ALTERNATIVE LOT NUMBER</label>
										<div  class="form_input">
											<input id="altno" name="altlotnum" type="text" value="" maxlength="50" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">LOT TITLE TYPE<span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="lttt" name="lttt" tabindex="20">
												<option></option>
											@foreach ($titiletype as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">LOT TITLE NUMBER</label>
										<div  class="form_input">
											<input id="ltnum" name="ltnum" type="text" value="" maxlength="50" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">ALTERNATIVE TITLE NUMBER</label>
										<div  class="form_input">
											<input id="altnum" name="altnum" type="text" value="" maxlength="50" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
								</fieldset>
									<fieldset>
										<legend>Address Information</legend>
									<div class="form_grid_12">
										<label class="field_title" id="lusername" for="username">STATE<span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="lotstate" name="lotstate" tabindex="20">
												<option></option>
											@foreach ($state as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lusername" for="username">DISCTRICT<span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="lotdistrict" name="lotdistrict" tabindex="20">
												<option></option>
											@foreach ($district as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">CITY<span class="req">*</span></label>
										<div  class="form_input">
											<input id="lotcity" name="lotcity"  type="text" value="" maxlength="50" class="large"/>
										</div>
										<span class=" label_intro"></span>
									</div>
									</fieldset>
								</div>
								<div class="grid_6">
									
									<ul>
									<li>
									<fieldset>
										<legend>Other Information</legend>										
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">LAND AREA<span class="req">*</span></label>
										<div  class="form_input">
											<input id="landar" name="landar" type="text" value="" maxlength="50" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">LAND AREA UNIT<span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="landaruni" name="landaruni" tabindex="20">
												<option></option>
											@foreach ($unitsize as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">LAND CONDITION<span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="landcon" name="landcon" tabindex="20">
												<option></option>
											@foreach ($landcond as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">LAND POSITION<span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="lanpos" name="lanpos" tabindex="20">
												<option></option>
											@foreach ($landpos as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">ROAD TYPE<span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="roadtype" name="roadtype" tabindex="20">
												<option></option>
											@foreach ($roadtype as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">ROAD CATEGOORY<span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="roadcate" name="roadcate" tabindex="20">
												<option></option>
											@foreach ($roadcaty as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">LAND USE<span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="landuse" name="landuse" tabindex="20">
												<option></option>
											@foreach ($landuse as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">Express Condition<span class="req">*</span></label>
										<div  class="form_input">
										<input id="expcon"  name="expcon" class="" type="text"  maxlength="50" />
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">Restriction of interest<span class="req">*</span></label>
										<div  class="form_input">
										<input id="interest"  name="interest" class="" type="text"  maxlength="50" />
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">TENURE TYPE<span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="tentype" name="tentype" tabindex="20">
												<option></option>
											@foreach ($tnttype as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">TENURE PERIOD<span class="req">*</span></label>
										<div  class="form_input">
											<input id="tenduration" step="0" name="tenduration" class="" type="number" value="0" maxlength="50" class="large"/>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">TENDURE START DATE<span class="req">*</span></label>
										<div  class="form_input">
										<input id="tenstart"  name="tenstart" class="" type="date"  maxlength="50" />
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">TENDURE END DATE<span class="req">*</span></label>
										<div  class="form_input">
										<input id="tenend"  name="tenend" class="" type="date"  maxlength="50" />
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">INDICATOR FOR LAND IS ACTIVE<span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="status" name="status" tabindex="20">	
												<option></option>										
												<option value='Y'>Y</option>
												<option value='N'>N</option>											
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									</fieldset>		
									</li>
									<!--<li>
									<div class="form_grid_12">
										<div class="form_input">
											<button id="addsubmit" name="adduser" type="submit" class="btn_small btn_blue"><span>Submit</span></button>											
											<button id="close" onclick="closeAddUser()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>
										</div>
									</div>
									</li>-->
									</ul>	
									