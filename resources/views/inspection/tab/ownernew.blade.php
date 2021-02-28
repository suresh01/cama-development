
						<div id="tab3">
							
							<h4>Owner</h4>
								<p>
									Account Number = <span id="ownerlabel"></span>
								</p>


								<div style="display: black;" id="ownertable" class="widget_wrap">					
									<div class="widget_content">						
										<table style="width: 100%" id="ownertble" class="display ">
										<thead style="text-align: left;">
								  		<tr>
											<th class="table_sno">S No</th>
											<th>OWNER APPLICATION TYPE</th>
											<th>TYPE OF OWNER</th>
											<th>OWNER NO</th>
											<th>OWNER NAME</th>
											<th>OWNER ADDRES 1</th>
											<th>OWNER ADDRES 2</th>
											<th>OWNER ADDRES 3</th>
											<th>OWNER ADDRES 4</th>
											<th>POSTCODE</th>
											<th>STATE</th>
											<th>TEL NUMBER</th>
											<th>FAX NUMBER</th>
											<th>Citizenship</th>
											<th>RACE</th>
											<th>Numerator</th>
											<th>Denominator</th>
											<th>Action</th>
											<th>ACTIONCODE</th>
											<th>TO ID</th>
											<th>accoumnum</th>
											<th>APP TYPE / ID TYPE</th>
											<th>ID NUMBER</th>
											<th>ADDRESS </th>
											<th>TEL NUMBER / FAXNUMBER</th>
											<th>ACTION</th>
										</tr>
										</thead>
										</table>
									</div>
								</div>

								
	<div class="grid_12" id="ownerdetailview" style="display: none">
	@foreach ($ownerd as $owner)

								<div class="grid_6 ">
								<ul>
								<li>
									<input type="hidden"  name="operation" id="owner_operation2">
									<input type="hidden" name="masterid" id="owner_masterid">
									<input type="hidden" name="owneraccnum" id="owneraccnum">
									<input type="hidden" value="0" name="ownerid" id="ownerid">
									<input type="hidden" value="0" name="tableindex" id="tableindex">
								
								<fieldset>
										<legend>Owner Information</legend>
<div class="form_grid_12">
											<br><br><br>
										</div>
										<div class="form_grid_12">
									<label class="field_title" id="lusername" for="username">OWNER APPLICATION TYPE<span class="req">*</span></label>
									<div  class="form_input">
										<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="ownaplntype" name="ownaplntype" tabindex="1">
											<option></option>
											<option value='C'>CMK</option>
											<option value='K'>KAD</option>
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
								
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">TYPE OF OWNER<span class="req">*</span></label>
									<div  class="form_input">
										<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="typeofown" name="typeofown" tabindex="1">
											<option></option>
											@foreach ($owntype as $rec)
												<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER NUMBER<span class="req">*</span></label>
									<div  class="form_input">
										<input id="ownnum" readonly="true" value="{{$owner->TO_OWNNO}}" name="ownnum"  type="text" tabindex="1"  maxlength="15" />
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER NAME<span class="req">*</span></label>
									<div  class="form_input">
										<input id="ownname" readonly="true" value="{{$owner->TO_OWNNAME}}" name="ownname" tabindex="1" type="text"  maxlength="80" />
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">TEL NO<span class="req">*</span></label>
										<div  class="form_input">
											<input id="telno" readonly="true" value="{{$owner->TO_TELNO}}" name="telno" tabindex="1" type="text" value="" maxlength="15" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">FAX NO<span class="req">*</span></label>
										<div  class="form_input">
											<input id="faxno" readonly="true" name="faxno" value="{{$owner->TO_FAXNO}}" tabindex="1" type="text" value="" maxlength="15" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
								
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">CITIZENSHIP<span class="req">*</span></label>
									<div  class="form_input">
										<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="citizen" name="citizen" tabindex="1">
											<option></option>
											@foreach ($citizen as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">RACE<span class="req">*</span></label>
									<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="race" name="race" tabindex="1">
											<option></option>
											@foreach ($race as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">NUMERATOR</label>
									<div  class="form_input">
										<input id="numerator" readonly="true" tabindex="1"value="{{$owner->TO_NUMETR}}"  name="numerator" value="0" maxlength="5"  type="number" onKeyDown="if(this.value.length==5 && event.keyCode>47 && event.keyCode < 58) return false;" />
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">DENOMINATOR</label>
									<div  class="form_input">
										<input id="demominator" onKeyDown="if(this.value.length==5 && event.keyCode>47 && event.keyCode < 58) return false;" value="{{$owner->TO_DENOMTR}}" name="demominator" value="0" readonly="true"  type="number" tabindex="1"  maxlength="5" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER ADDRES 1<span class="req">*</span></label>
									<div  class="form_input">
										<input id="ownaddr1" readonly="true" name="ownaddr1" value="{{$owner->TO_ADDR_LN1}}" tabindex="1"  type="text"  maxlength="50" />
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER ADDRES 2</label>
									<div  class="form_input">
										<input id="ownaddr2" readonly="true" name="ownaddr2" value="{{$owner->TO_ADDR_LN2}}" tabindex="1" type="text"  maxlength="50" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER ADDRES 3</label>
									<div  class="form_input">
										<input id="ownaddr3" readonly="true" name="ownaddr3" value="{{$owner->TO_ADDR_LN3}}" tabindex="1"  type="text"  maxlength="50" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">OWNER ADDRES 4</label>
									<div  class="form_input">
										<input id="ownaddr4" readonly="true" name="ownaddr4" value="{{$owner->TO_ADDR_LN4}}" tabindex="1" type="text"  maxlength="50" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">POSTCODE<span class="req">*</span></label>
									<div  class="form_input">
										<input id="ownpostcode"  readonly="true" name="ownpostcode" value="{{$owner->TO_POSTCODE}}" tabindex="1" type="number"  maxlength="50" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">STATE<span class="req">*</span></label>
									<div  class="form_input">
										<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="ownstate" name="ownstate" tabindex="1">
											<option></option>
											@foreach ($state as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
							</fieldset>
								</li></ul>
							</div>

								<div class="grid_6 ">
								<ul>
								<li>
									<input type="hidden"  name="operation" id="owner_operation2">
									<input type="hidden" name="masterid" id="owner_masterid">
									<input type="hidden" name="owneraccnum" id="owneraccnum">
									<input type="hidden" value="0" name="ownerid" id="ownerid">
									<input type="hidden" value="0" name="tableindex" id="tableindex">
								
								<fieldset>
										<legend>New Owner Information</legend>

										<div class="form_grid_12">
											<label class="field_title">Copy Previous Owner Detail</label>
											<div class="form_input">
												<span>
												<input name="field08" id="copydetail" onchange="copyDetail()" class="checkbox" type="checkbox"  tabindex="7">
												
												</span>
											</div>
										</div>
										<div class="form_grid_12">
									<label class="field_title" id="lusername" for="username">OWNER APPLICATION TYPE<span class="req">*</span></label>
									<div  class="form_input">
										<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="nownaplntype" name="nownaplntype" tabindex="1">
											<option></option>
											<option value='C'>CMK</option>
											<option value='K'>KAD</option>
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
								
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">TYPE OF OWNER<span class="req">*</span></label>
									<div  class="form_input">
										<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="ntypeofown" name="ntypeofown" tabindex="1">
											<option></option>
											@foreach ($owntype as $rec)
												<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER NUMBER<span class="req">*</span></label>
									<div  class="form_input">
										<input id="nownnum" name="nownnum"  type="text" tabindex="1"  maxlength="15" />
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER NAME<span class="req">*</span></label>
									<div  class="form_input">
										<input id="nownname" name="nownname" tabindex="1" type="text"  maxlength="80" />
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">TEL NO<span class="req">*</span></label>
										<div  class="form_input">
											<input id="ntelno" name="ntelno" tabindex="1" type="text" value="" maxlength="15" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">FAX NO<span class="req">*</span></label>
										<div  class="form_input">
											<input id="nfaxno" name="nfaxno" tabindex="1" type="text" value="" maxlength="15" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
								
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">CITIZENSHIP<span class="req">*</span></label>
									<div  class="form_input">
										<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="ncitizen" name="ncitizen" tabindex="1">
											<option></option>
											@foreach ($citizen as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">RACE<span class="req">*</span></label>
									<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="nrace" name="nrace" tabindex="1">
											<option></option>
											@foreach ($race as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">NUMERATOR</label>
									<div  class="form_input">
										<input id="nnumerator" tabindex="1" name="nnumerator" value="0" maxlength="5"  type="number" onKeyDown="if(this.value.length==5 && event.keyCode>47 && event.keyCode < 58) return false;" />
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">DENOMINATOR</label>
									<div  class="form_input">
										<input id="demominator" onKeyDown="if(this.value.length==5 && event.keyCode>47 && event.keyCode < 58) return false;" name="demominator" value="0"  type="number" tabindex="1"  maxlength="5" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER ADDRES 1<span class="req">*</span></label>
									<div  class="form_input">
										<input id="nownaddr1" name="nownaddr1" tabindex="1"  type="text"  maxlength="50" />
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER ADDRES 2</label>
									<div  class="form_input">
										<input id="nownaddr2" name="nownaddr2" tabindex="1" type="text"  maxlength="50" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER ADDRES 3</label>
									<div  class="form_input">
										<input id="nownaddr3" name="nownaddr3" tabindex="1"  type="text"  maxlength="50" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">OWNER ADDRES 4</label>
									<div  class="form_input">
										<input id="nownaddr4" name="nownaddr4" tabindex="1" type="text"  maxlength="50" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">POSTCODE<span class="req">*</span></label>
									<div  class="form_input">
										<input id="nownpostcode"  name="nownpostcode" tabindex="1" type="number"  maxlength="50" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">STATE<span class="req">*</span></label>
									<div  class="form_input">
										<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="nownstate" name="nownstate" tabindex="1">
											<option></option>
											@foreach ($state as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
							</fieldset>
								</li></ul>
							</div>


							<div class="grid_12 ">
								<ul>
								<li>
									<input type="hidden"  name="operation" id="owner_operation2">
									<input type="hidden" name="masterid" id="owner_masterid">
									<input type="hidden" name="owneraccnum" id="owneraccnum">
									<input type="hidden" value="0" name="ownerid" id="ownerid">
									<input type="hidden" value="0" name="tableindex" id="tableindex">
								
								<fieldset>
										<legend>Applicant Information</legend>

										<div class="form_grid_6">
											<label class="field_title">is Applicant</label>
											<div class="form_input">
												<span>
												<input name="field08" id="copyadddetail" onchange="copyAddDetail()" class="checkbox" type="checkbox"  tabindex="7">
												
												</span>
											</div>
										</div>
								
								
								<div class="form_grid_6">
									<label class="field_title" id="llevel" for="level">NAME<span class="req">*</span></label>
									<div  class="form_input">
										<input id="addname" name="addname" tabindex="1" type="text"  maxlength="80" />
									</div>
									<span class=" label_intro"></span>
								</div>
								

								<div class="form_grid_6">
									<label class="field_title" id="llevel" for="level">ADDRES 1<span class="req">*</span></label>
									<div  class="form_input">
										<input id="addaddr1" name="addaddr1" tabindex="1"  type="text"  maxlength="50" />
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_6">
									<label class="field_title" id="llevel" for="level">ADDRES 2</label>
									<div  class="form_input">
										<input id="addaddr2" name="addaddr2" tabindex="1" type="text"  maxlength="50" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_6">
									<label class="field_title" id="llevel" for="level">ADDRES 3</label>
									<div  class="form_input">
										<input id="addaddr3" name="addaddr3" tabindex="1"  type="text"  maxlength="50" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_6">
									<label class="field_title" id="lposition" for="position">ADDRES 4</label>
									<div  class="form_input">
										<input id="addaddr4" name="addaddr4" tabindex="1" type="text"  maxlength="50" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_6">
									<label class="field_title" id="lposition" for="position">POSTCODE<span class="req">*</span></label>
									<div  class="form_input">
										<input id="addpostcode"  name="addpostcode" tabindex="1" type="number"  maxlength="50" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_6">
									<label class="field_title" id="llevel" for="level">STATE<span class="req">*</span></label>
									<div  class="form_input">
										<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="addstate" name="addstate" tabindex="1">
											<option></option>
											@foreach ($state as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_6">
										<label class="field_title" id="llevel" for="level">REQUEST DATE<span class="req">*</span></label>
										<div  class="form_input">
										<input id="reqdate"  name="reqdate" class="" type="text"  maxlength="50" />
										</div>
										<span class=" label_intro"></span>
								</div>

								<div class="form_grid_6">
										<label class="field_title" id="llevel" for="level">ACCEPT DATE<span class="req">*</span></label>
										<div  class="form_input">
										<input id="addacceptdt"  name="addacceptdt" class="" type="text"  maxlength="50" />
										</div>
										<span class=" label_intro"></span>
								</div>

								<div class="form_grid_6">
										<label class="field_title" id="llevel" for="level">TRANSACTION DATE<span class="req">*</span></label>
										<div  class="form_input">
										<input id="addtrndate"  name="addtrndate" class="" type="text"  maxlength="50" />
										</div>
										<span class=" label_intro"></span>
								</div>

								<div class="form_grid_6">
									<label class="field_title" id="lposition" for="position">TRANACTION VALUE<span class="req">*</span></label>
									<div  class="form_input">
										<input id="addtrnvalue" value="0" name="addtrnvalue" tabindex="1" type="number"  maxlength="50" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_6">
									<label class="field_title" id="lposition" for="position">REFERENCE NO<span class="req">*</span></label>
									<div  class="form_input">
										<input id="addref"  name="addref" tabindex="1" type="text"  maxlength="50" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_6">
									<label class="field_title" id="lposition" for="position">APPLICANT REFERENCE NO<span class="req">*</span></label>
									<div  class="form_input">
										<input id="addapplicatref"  name="addapplicatref" tabindex="1" type="text"  maxlength="50" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>
							</fieldset>
								</li></ul>
							</div>


							<div style="display:none;" class="grid_6 ">
								<ul>
								<li>
									<input type="hidden"  name="operation" id="owner_operation2">
									<input type="hidden" name="masterid" id="owner_masterid">
									<input type="hidden" name="owneraccnum" id="owneraccnum">
									<input type="hidden" value="0" name="ownerid" id="ownerid">
									<input type="hidden" value="0" name="tableindex" id="tableindex">
								
								<fieldset>
										<legend>Reason </legend>

										<div class="form_grid_2">
											
											<div style="width: 20%;" class="form_input ">
												<span>
												<input name="field08" id="" class="checkbox" type="checkbox"  tabindex="7">
												
												</span>
											</div>
										</div>
										<div class="form_grid_10">
											<label style="width: 80%;" class="field_title">the registered owner's name differs from our records</label>
											
										</div>
										<div class="form_grid_2">
											
											<div style="width: 20%;" class="form_input ">
												<span>
												<input name="field08" id="" class="checkbox" type="checkbox"  tabindex="7">
												
												</span>
											</div>
										</div>
										<div class="form_grid_10">
											<label style="width: 80%;" class="field_title">the premises have not been rated yet
											</label>
										</div>

								
								
							</fieldset>
								</li></ul>
							</div>

							<script type="text/javascript">
								$(document).ready(function(){
									$("#ownstate").val('{{$owner->TO_STATE_ID}}');
									$("#race").val('{{$owner->TO_RACE_ID}}');
									$("#citizen").val('{{$owner->TO_CITIZEN_ID}}');
									$("#typeofown").val('{{$owner->TO_OWNTYPE_ID}}');
									$("#ownaplntype").val('{{$owner->TO_OWNERAPPLNTYPE_ID}}');

									$( "#addtrndate" ).datepicker({dateFormat: 'dd/mm/yy'});
						 			$( "#addacceptdt" ).datepicker({dateFormat: 'dd/mm/yy'});
						 			$( "#reqdate" ).datepicker({dateFormat: 'dd/mm/yy'});

								});

								function copyAddDetail(){
									if($('#copyadddetail').prop("checked") == true){

										$('#addname').val($("#ownname").val());
										$('#addaddr1').val($("#ownaddr1").val());
										$('#addaddr2').val($("#ownaddr2").val());
										$('#addaddr3').val($("#ownaddr3").val());
										$('#addaddr4').val($("#ownaddr4").val());
										$('#addpostcode').val($("#ownpostcode").val());
										$('#addstate').val($("#ownstate").val());
										
							        }
							        else if($('#copydetail').prop("checked") == false){
							           
										$('#addname').val('');
										$('#addaddr1').val('');
										$('#addaddr2').val('');
										$('#addaddr3').val('');
										$('#addaddr4').val('');
										$('#addpostcode').val('');
										$('#addstate').val('');
										
							        }
									
									
								}
								function copyDetail(){
									if($('#copydetail').prop("checked") == true){
							            


							            $('#nownaplntype').val($("#ownaplntype").val());
										$('#ntypeofown').val($("#typeofown").val());
										//$('#lotnum').val($('#city'+id).val());
										$('#nownnum').val($("#ownnum").val());
										$('#nownname').val($("#ownname").val());
										$('#nownaddr1').val($("#ownaddr1").val());
										$('#nownaddr2').val($("#ownaddr2").val());
										$('#nownaddr3').val($("#ownaddr3").val());
										$('#nownaddr4').val($("#ownaddr4").val());
										$('#nownpostcode').val($("#ownpostcode").val());
										$('#nownstate').val($("#ownstate").val());
										$('#ncitizen').val($("#citizen").val());
										$('#nrace').val($("#race").val());
										$('#nnumerator').val($("#numerator").val());
										$('#ndemominator').val($("#demominator").val());
										$('#nfaxno').val($("#faxno").val());
										$('#ntelno').val($("#telno").val());

										$("#nownstate").val($("#ownstate").val());
										$("#nrace").val($("#race").val());
										$("#ncitizen").val($("#citizen").val());
										$("#ntypeofown").val($("#typeofown").val());
										$("#nownaplntype").val($("#ownaplntype").val());
							        }
							        else if($('#copydetail').prop("checked") == false){
							            $('#nownaplntype').val('');
										$('#ntypeofown').val('');
										//$('#lotnum').val($('#city'+id).val());
										$('#nownnum').val('');
										$('#nownname').val('');
										$('#nownaddr1').val('');
										$('#nownaddr2').val('');
										$('#nownaddr3').val('');
										$('#nownaddr4').val('');
										$('#nownpostcode').val('');
										$('#nownstate').val('');
										$('#ncitizen').val('');
										$('#nrace').val('');
										$('#nnumerator').val('');
										$('#ndemominator').val('');

										$("#nownstate").val('');
										$("#nrace").val('');
										$("#ncitizen").val('');
										$("#ntypeofown").val('');
										$("#nownaplntype").val('');
										$('#nfaxno').val('');
										$('#ntelno').val('');
							        }
									
									
								}
							</script>
@endforeach
							</div>

								<div style="display:none;" id="ownerdetail" >
								<div id="owner_form"  autocomplete="off" onsubmit="return false;" class=" left_label" method="post" action="#" >
										<div style="height: 48px; display: -webkit-box;text-align: -webkit-right;" class="grid_12">
									<button id="submitaddtblowner" onclick="addownerRow()" style="display:none" name="adduser" type="button" class="btn_small btn_blue"><span>Add New</span></button>	
									<button id="submitedittblowner" onclick="editownerRow()" style="display:none" name="adduser" type="button" class="btn_small btn_blue"><span>Update</span></button>	
								<button id="close" onclick="closeowner()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>
								</div>

								

								<div class="grid_6 ">
								<ul>
								<li>
									<input type="hidden"  name="operation" id="owner_operation2">
									<input type="hidden" name="masterid" id="owner_masterid">
									<input type="hidden" name="owneraccnum" id="owneraccnum">
									<input type="hidden" value="0" name="ownerid" id="ownerid">
									<input type="hidden" value="0" name="tableindex" id="tableindex">
								
								<fieldset>
										<legend>Owner Information</legend>

										<div class="form_grid_12">
									<label class="field_title" id="lusername" for="username">OWNER APPLICATION TYPE<span class="req">*</span></label>
									<div  class="form_input">
										<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="ownaplntype" name="ownaplntype" tabindex="1">
											<option></option>
											<option value='C'>CMK</option>
											<option value='K'>KAD</option>
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
								
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">TYPE OF OWNER<span class="req">*</span></label>
									<div  class="form_input">
										<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="typeofown" name="typeofown" tabindex="1">
											<option></option>
											@foreach ($owntype as $rec)
												<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER NUMBER<span class="req">*</span></label>
									<div  class="form_input">
										<input id="ownnum" name="ownnum"  type="text" tabindex="1"  maxlength="15" />
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER NAME<span class="req">*</span></label>
									<div  class="form_input">
										<input id="ownname" name="ownname" tabindex="1" type="text"  maxlength="80" />
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">TEL NO<span class="req">*</span></label>
										<div  class="form_input">
											<input id="telno" name="telno" tabindex="1" type="text" value="" maxlength="15" class="large"/>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">FAX NO<span class="req">*</span></label>
										<div  class="form_input">
											<input id="faxno" name="faxno" tabindex="1" type="text" value="" maxlength="15" class="large"/>
										</div>
										<span class=" label_intro"></span>
									</div>
								</fieldset>


									<fieldset>
										<legend>Other Information</legend>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">CITIZENSHIP<span class="req">*</span></label>
									<div  class="form_input">
										<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="citizen" name="citizen" tabindex="1">
											<option></option>
											@foreach ($citizen as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">RACE<span class="req">*</span></label>
									<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="race" name="race" tabindex="1">
											<option></option>
											@foreach ($race as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">NUMERATOR</label>
									<div  class="form_input">
										<input id="numerator" tabindex="1" name="numerator" value="0" maxlength="5"  type="number" onKeyDown="if(this.value.length==5 && event.keyCode>47 && event.keyCode < 58) return false;" />
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">DENOMINATOR</label>
									<div  class="form_input">
										<input id="demominator" onKeyDown="if(this.value.length==5 && event.keyCode>47 && event.keyCode < 58) return false;" name="demominator" value="0"  type="number" tabindex="1"  maxlength="5" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>
							</fieldset>
								
							</div>

								<div  class="grid_6 ">
								<ul>
								<li >
									<fieldset>
										<legend>Address Information</legend>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER ADDRES 1<span class="req">*</span></label>
									<div  class="form_input">
										<input id="ownaddr1" name="ownaddr1" tabindex="1"  type="text"  maxlength="50" />
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER ADDRES 2</label>
									<div  class="form_input">
										<input id="ownaddr2" name="ownaddr2" tabindex="1" type="text"  maxlength="50" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER ADDRES 3</label>
									<div  class="form_input">
										<input id="ownaddr3" name="ownaddr3" tabindex="1"  type="text"  maxlength="50" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">OWNER ADDRES 4</label>
									<div  class="form_input">
										<input id="ownaddr4" name="ownaddr4" tabindex="1" type="text"  maxlength="50" class=""/>
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">POSTCODE<span class="req">*</span></label>
									<div  class="form_input">
										<input id="ownpostcode"  name="ownpostcode" tabindex="1" type="number"  maxlength="50" class="large"/>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">STATE<span class="req">*</span></label>
									<div  class="form_input">
										<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="ownstate" name="ownstate" tabindex="1">
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
								<!--<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button id="addsubmit" name="adduser" type="submit" class="btn_small btn_blue"><span>Submit</span></button>											
										<button id="close" onclick="closeAddUser()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>
									</div>
								</div>
								</li>-->
								</ul>
								
								</div>
								
								</div>
							<span class="clear"></span>
						</div>						
					</div>

					<script type="text/javascript">
						 $(document).ready(function() {
			
			let ownermap = new Map([["0","sno"],["1", "ownaplntype"], ["2", "typeofown"], ["3", "ownnum"],["4", "ownname"], ["5", "ownaddr1"],["6", "ownaddr2"], ["7", "ownaddr3"],["8", "ownaddr4"], ["9", "ownpostcode"],["10", "ownstate"], ["11", "telno"],["12", "faxno"],["13", "citizen"], ["14", "race"],["15", "numerator"], ["16", "demominator"],["17", "action"], ["18", "actioncode"],["19", "ownerid"],["20","owneraccnum"]]);
 		var ownerdata = [];
@foreach ($ownerd as $rec)
			 ownerdata.push( [ '{{$loop->iteration}}', '{{$rec->TO_OWNERAPPLNTYPE_ID}}', '{{$rec->TO_OWNTYPE_ID}}', '{{$rec->TO_OWNNO}}', '{{$rec->TO_OWNNAME}}', '{{$rec->TO_ADDR_LN1}}', '{{$rec->TO_ADDR_LN2}}', '{{$rec->TO_ADDR_LN3}}', '{{$rec->TO_ADDR_LN4}}', '{{$rec->TO_POSTCODE}}', '{{$rec->TO_STATE_ID}}', '{{$rec->TO_TELNO}}', '', '{{$rec->TO_CITIZEN_ID}}', '{{$rec->TO_RACE_ID}}', '{{$rec->TO_NUMETR}}', '{{$rec->TO_DENOMTR}}','<span><a onclick="" class="action-icons c-edit edtownerrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class="action-icons  dellotrow deleteownerrow" href="#" title="delete">Delete</a></span>','noation', '{{$rec->TO_ID}}' ,'newacc',			'{{$rec->TO_OWNERAPPLNTYPE_ID}} / {{$rec->owntype}}'	,'{{$rec->TO_OWNNO}}'	,'{{$rec->TO_ADDR_LN1}},  {{$rec->TO_ADDR_LN2}},   {{$rec->TO_ADDR_LN3}}  {{$rec->state}} - {{$rec->TO_POSTCODE}} '	,'{{$rec->TO_TELNO}} '	,'<span><a onclick="" class="action-icons c-edit edtownerrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class="action-icons  dellotrow deleteownerrow" href="#" title="delete">Delete</a></span>' ] );
			@endforeach
        $('#ownertble').DataTable({
            data:           ownerdata,
            "columns":[ null, { "visible": false}, { "visible": false}, { "visible": false}, { "visible": false}, { "visible": false}, { "visible": false}, { "visible": false }, { "visible": false}, { "visible": false}, { "visible": false }, { "visible": false}, { "visible": false}, { "visible": false }, { "visible": false }, { "visible": false }, { "visible": false }, { "visible": false}, { "visible": false }, { "visible": false}, { "visible": false },null,null,null,null,null],
            "sPaginationType": "full_numbers",
			"iDisplayLength": 5,
        	"bAutoWidth": false,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			 
		});
		$("div.table_top select").addClass('tbl_length');
		$(".tbl_length").chosen({
			disable_search_threshold: 4	
		});

        var table = $('#ownertble').DataTable();

		$('#ownertble tbody').on( 'click', '.deleteownerrow', function () {
			var row = table.row(table.row( $(this).parents('tr') ).index()),
			    data = row.data();
			    data[0]='Deleted';
				data[18]='delete';
				data[17]='';
				data[25]='';
				var noty_id = noty({
					layout : 'center',
					text: 'Are you want to delete?',
					modal : true,
					buttons: [
						{type: 'button pink', text: 'Delete', click: function($noty) {
					  			row.data(data);
								$noty.close();
						  	}
						},
						{type: 'button blue', text: 'Cancel', click: function($noty) {
								$noty.close();
						  	}
						}
						],
					type : 'success', 
			 	});
		   // table.row($(this).parents('tr') ).remove().draw();
		});

		$('#ownertble tbody').on( 'click', '.edtownerrow', function () {
			//var editlotdata = JSON.stringify(table.row( $(this).parents('tr') ).data());
			var ldata = table.row(table.row( $(this).parents('tr') ).index()).data();
			$('#tableindex').val(table.row( $(this).parents('tr') ).index());
			var ownerdata = {};
			
			$.each( ldata, function( key, value ) {
				ownerdata[ownermap.get(""+key+"")] = value;              
            });

            $.each( ownerdata, function( key, val ) {
            	$('#'+key).val(val);
			});

            $('#propertyinspectionform-back-1').hide();
			$('#propertyinspectionform-next-1').hide();	
			addDisableTab();

        	$("#ownerdetailview").show();
			$("#addowner").hide();
			$("#ownertable").hide();

			$('#submitedittblowner').show();
			$('#submitaddtblowner').hide();
		});

});


function editownerRow(){
	if(validateOwner()) {
		$('#propertyinspectionform-back-1').show();
		$('#propertyinspectionform-next-1').show();	
		$('#submitedittblowner').show();
		$('#submitaddtblowner').hide();
		var table = $('#ownertble').DataTable();
		var account = $('#accnumber').val();

		var row = table.row($('#tableindex').val());
		var owneredata = table.row($('#tableindex').val()).data();
		var recordtype = owneredata[0];
		//console.log(owneredata);
		var operation = "Updated";
			var operation_code = "update";
			if (recordtype==='New'){
				operation = "New";
				operation_code = "new";
			}

		data=[operation,$('#ownaplntype').val(),$('#typeofown').val(), $('#ownnum').val(), $('#ownname').val(),  $('#ownaddr1').val(), $('#ownaddr2').val(), $('#ownaddr3').val(),$('#ownaddr4').val(), $('#ownpostcode').val(), $('#ownstate').val(),$('#telno').val(), $('#faxno').val(), $('#citizen').val(), $('#race').val(), $('#numerator').val(), $('#demominator').val(),'<span><a onclick="" class="action-icons c-edit edtownerrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons c-delete  deleteownerrow" href="#" title="delete">Delete</a></span>',operation_code, $('#ownerid').val(),account, $('#ownaplntype').val()+' / '+$('#typeofown option:selected').text(),$('#ownnum').val(),$('#ownaddr1').val()+'<br>'+$('#ownaddr2').val()+'<br>'+$('#ownpostcode').val()+'<br>'+$('#ownstate option:selected').text(),$('#telno').val()+' / '+$('#faxno').val(),'<span><a onclick="" class="action-icons c-edit edtownerrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons c-delete  deleteownerrow" href="#" title="delete">Delete</a></span>'];

		row.data(data);

		$("#ownerdetailview").hide();
		$("#ownertable").show();
		$("#addowner").show();
		$('#propertystatus').val('');
		removeDisableTab();
	}
}
function addownerRow(){

	if(validateOwner()){

		$('#submitedittblowner').hide();
			$('#submitaddtblowner').show();

			//$('#propertyinspectionform-back-1').show();
		//$('#propertyinspectionform-next-1').show();	
		//var operation = $("#lot_operation").val();
		//console.log(operation);
		var t = $('#ownertble').DataTable();

		var account = $('#accnumber').val();
									
		t.row.add([ 'New',$('#ownaplntype').val(),$('#typeofown').val(), $('#ownnum').val(), $('#ownname').val(),  $('#ownaddr1').val(), $('#ownaddr2').val(), $('#ownaddr3').val(),$('#ownaddr4').val(), $('#ownpostcode').val(), $('#ownstate').val(),$('#telno').val(), $('#faxno').val(), $('#citizen').val(), $('#race').val(), $('#numerator').val(), $('#demominator').val(),'<span><a onclick="" class="action-icons c-edit edtownerrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons c-delete  deleteownerrow" href="#" title="delete">Delete</a></span>','new', $('#ownerid').val(),account  , $('#ownaplntype').val()+' / '+$('#typeofown option:selected').text(),$('#ownnum').val(),$('#ownaddr1').val()+'<br>'+$('#ownaddr2').val()+'<br>'+$('#ownpostcode').val()+'<br>'+$('#ownstate option:selected').text(),$('#telno').val()+' / '+$('#faxno').val(),'<span><a onclick="" class="action-icons c-edit edtownerrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons c-delete  deleteownerrow" href="#" title="delete">Delete</a></span>']).draw( false );
		$('#propertystatus').val('');
		alert('Record is successfully added');
		/*$("#ownerdetail").hide();
		$("#ownertable").show();
		$("#addowner").show();*/
	}

}


						function openowner(){
							$('#propertyinspectionform-back-1').hide();
							$('#propertyinspectionform-next-1').hide();	
							addDisableTab();
							$('#submitedittblowner').hide();
			 				$('#submitaddtblowner').show();
							$("#owner_operation2").val(1);
							$("#owneraccnum").val($('#accnumber').val());
							$("#ownerdetailview").show();
							$("#ownertable").hide();
							$("#addowner").hide();
							$("#ownersubmit").html("Save");
						 	$("label.error").remove();	
						}

						function editowner(id){
							$("#owner_operation2").val(2);
							$("#ownerid").val(id);
							$("#owneraccnum").val($('#accnumber').val());
							$('#owner_masterid').val($('#masterid'+id).val());
							$('#ownaplntype').val($('#ownapln'+id).val());
							$('#typeofown').val($('#owntype'+id).val());
							//$('#lotnum').val($('#city'+id).val());
							$('#ownnum').val($('#ownno'+id).val());
							$('#ownname').val($('#ownname'+id).val());
							$('#ownaddr1').val($('#addr1'+id).val());
							$('#ownaddr2').val($('#addr2'+id).val());
							$('#ownaddr3').val($('#addr3'+id).val());
							$('#ownaddr4').val($('#addr4'+id).val());
							$('#ownpostcode').val($('#post'+id).val());
							$('#ownstate').val($('#state'+id).val());
							$('#citizen').val($('#citizen'+id).val());
							$('#race').val($('#race'+id).val());
							$('#numerator').val($('#numetr'+id).val());
							$('#demominator').val($('#denomtr'+id).val());
							$('#telno').val($('#telno'+id).val());
							$('#faxno').val($('#faxno'+id).val());
							//$('#landuse').val($('#active'+id).val());
							$("#ownerdetailview").show();
							$("#addowner").hide();
							$("#ownertable").hide();
							$("#ownersubmit").html("Update");
						}
						function closeowner(){			
							$('#propertyinspectionform-back-1').show();
							$('#propertyinspectionform-next-1').show();		
							removeDisableTab();			
							$('#masterid').val('');
							$('#ownaplntype').val('');
							$('#typeofown').val('');
							//$('#lotnum').val($('#city'+id).val());
							$('#ownnum').val('');
							$('#ownname').val('');
							$('#ownaddr1').val('');
							$('#ownaddr2').val('');
							$('#ownaddr3').val('');
							$('#ownaddr4').val('');
							$('#ownpostcode').val('');
							$('#ownstate').val('');
							$('#citizen').val('');
							$('#race').val('');
							$('#numerator').val('');
							$('#demominator').val('');
							$("#ownertable").show();
							$("#addowner").show();
							$("#ownerdetailview").hide();
						 	$("label.error").remove();	
						}
						function ownersubmit(){						
							$('#owner_form').validate({
									  rules: {
									    'ownnum': 'required'
									  },
									  messages: {
									    'ownnum': 'This field is required'
									   },
									  submitHandler: function(form) {
									    //form.submit();
									    $('#submitowner').text('Please Wait');
									    console.log('validation true');

											    	var ownerdata = {};
											$('#owner_form').serializeArray().map(function(x){ownerdata[x.name] = x.value;});
											
											//console.log(masterdata);
											var ownerjson = JSON.stringify(ownerdata);
											var pb = '{{$pb}}';
											$.ajax({
											        type:'POST',
											        url:'registerproperty',
												    headers: {
													    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
													},
											        data:{form:'owner',type:'tab',jsondata:ownerjson,pb:pb},
											        success:function(data){	       	
											        	$('#submitowner').text('Submit');
											        	var noty_id = noty({
															layout : 'top',
															text: 'Owner detail updated successfully!',
															modal : true,
															type : 'success', 
														});
											        	
											        },
											        error:function(data){	
											        	$('#submitowner').text('Submit');        	
											        	var noty_id = noty({
															layout : 'top',
															text: 'Owner while addinglot detail!',
															modal : true,
															type : 'error', 
														});
											        }
											});
									  	}
									});

									
									
						}
					</script>
							