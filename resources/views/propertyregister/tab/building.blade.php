
<div id="tab4">
	<h4>{{__('propertyregister.Building')}} </h4>
	<p>
		{{__('propertyregister.Account_Number')}}  = <span id="bldglabel"></span>
	</p>

	@if($iseditable == 1)<button onclick="openbldg()" id="addbldg" name="btnadduser" type="button" class="btn_small btn_blue"><span>{{__('propertyregister.Add_Building')}} </span></button>@endif
	<div id="bldgtable" class="widget_wrap">					
		<div class="widget_content">						
			<table style="width:100%" id="bldgtble" class="display ">
			<thead style="text-align: left;">
	  		<tr>
	  		<tr>
				<th class="table_sno">{{__('propertyregister.SNO')}}</th>
				<th>{{__('propertyregister.Building_Number')}}</th>
				<th>{{__('propertyregister.Building_Number1S')}}</th>
				<th>{{__('propertyregister.Building_Category')}} / {{__('propertyregister.Building_Type')}}</th>
				<th>{{__('propertyregister.Building_Storey')}}</th>
				<th>{{__('propertyregister.Building_Structure')}}</th>
				<th>{{__('propertyregister.Roof_Type')}}</th>
				<th>{{__('propertyregister.Building_Type')}}</th>
				<th>{{__('propertyregister.Building_Storey')}}</th>
				<th>{{__('propertyregister.Building_Condition')}}</th>
				<th>{{__('propertyregister.Building_Position')}}</th>
				<th>{{__('propertyregister.Building_Structure')}}</th>
				<th>{{__('propertyregister.Roof_Type')}}</th>
				<th>{{__('propertyregister.Wall_Type')}}</th>
				<th>{{__('propertyregister.Floor_Type')}}</th>
				<th>{{__('propertyregister.Ccc_Date')}}</th>
				<th>{{__('propertyregister.Occupied_Date')}}</th>
				<th>{{__('propertyregister.Main_Building')}}</th>
				<th>{{__('propertyregister.Action')}}</th>
				<th>{{__('propertyregister.Actioncode')}}</th>
				<th>{{__('propertyregister.Blsdgid')}}</th>
				<th>{{__('propertyregister.Account')}}</th>
			</tr>
			</thead>
			<tbody></tbody>
			</table>
		</div>
	</div>

	<div id="bldgareatable1" style="display: none;" class="widget_wrap">					
		<div class="widget_content">
								
			<table  id="bldgartable1" class="display" style="width:100%">

				<div class="social_activities">
								
					<div class="comments_s">
						<div class="block_label">
							{{__('propertyregister.Building_Number')}} <span id="disbldgno">{{__('propertyregister.All')}}</span>
							<input type="hidden" id="hbldgid">
						</div>
					</div>

					<br>

				</div>

			<thead style="text-align: left;">
	  		<tr>					
				<th class="table_sno">{{__('propertyregister.SNO')}}</th>
				<th>{{__('propertyregister.Account_Number')}}</th>
				<th>{{__('propertyregister.Building_Number')}}</th>
				<th>{{__('propertyregister.Area_Level')}}</th>
				<th>{{__('propertyregister.Area_Type')}}</th>
				<th>{{__('propertyregister.Area_Category')}}</th>
				<th>{{__('propertyregister.Area_Use')}}</th>
				<th>{{__('propertyregister.Area_Count')}}</th>
				<th>{{__('propertyregister.Total_Size')}}</th>
				<th>{{__('propertyregister.Ceilling_Type')}}</th>
				<th>{{__('propertyregister.Floor_Type')}}</th>
				<th>{{__('propertyregister.Wall_Type')}}</th>
				<th>{{__('propertyregister.Area_Description')}}</th>
				<th>{{__('propertyregister.Reff_Information')}}</th>
				<th>{{__('propertyregister.Area_Type')}}</th>
				<th>{{__('propertyregister.Area_Category')}}</th>
				<th>{{__('propertyregister.Area_Level')}}</th>
				<th>{{__('propertyregister.Area_Zone')}}</th>
				<th>{{__('propertyregister.Area_Use')}}</th>
				<th>{{__('propertyregister.Area_Description')}}</th>
				<th>{{__('propertyregister.Dimention')}}</th>
				<th>{{__('propertyregister.Area_Count')}}</th>
				<th>{{__('propertyregister.Measurement')}}</th>
				<th>{{__('propertyregister.Unit_Of_Measurement')}}</th>
				<th>{{__('propertyregister.Total_Size')}}</th>
				<th>{{__('propertyregister.Floor_Type')}}</th>
				<th>{{__('propertyregister.Wall_Type')}}</th>
				<th>{{__('propertyregister.Ceilling_Type')}}</th>
				<th>{{__('propertyregister.Action')}}</th>
				<th>{{__('propertyregister.Actioncode')}}</th>
				<th>{{__('propertyregister.Detailid')}}</th>
			</tr>
			</thead>
			<tbody>
				
			</tbody>
			</table>
		</div>
	</div>



	<div style="display:none;" id="bldgdetail" >
		<div id="bldgform"  autocomplete="off" onsubmit="return false;" class=" left_label" method="post" action="#" >
			<div style="height: 48px; display: -webkit-box;text-align: -webkit-right;" class="grid_12">
				<button id="submitaddtblbldg" onclick="addbldgRow()" style="display:none" name="adduser" type="button" class="btn_small btn_blue"><span>{{__('common.Add_New')}} </span></button>	
				<button id="submitedittblbldg" onclick="editbldgRow()" style="display:none" name="adduser" type="button" class="btn_small btn_blue"><span>{{__('common.Update')}}</span></button>	
				<button id="close" onclick="closebldg()" name="close" type="button" class="btn_small btn_blue"><span>{{__('common.Close')}}</span></button>
			</div>
			<div class="grid_6 ">
				<ul>
					<li>
						<input type="hidden" value="0"  name="operation" id="bldg_operation">
						<input type="hidden" value="0" name="masterid" id="bldg_masterid">
						<input type="hidden" value="0" name="bldgaccnum" id="bldgaccnum">
						<input type="hidden" value="0" name="bldgid" id="bldgid">
						<input type="hidden" value="0" name="bldgtableindex" id="bldgtableindex">
						<input type="hidden" value="0" name="bldgareatableindex" id="bldgareatableindex">

						<div class="form_grid_12">
							<label class="field_title" id="lusername" for="username">{{__('propertyregister.Building_Number')}} <span class="req">*</span></label>
							<div  class="form_input">
								<input id="bldgnum" tabindex="1" name="bldgnum"  type="text"  maxlength="15" class=""/>
							</div>
							<span class=" label_intro"></span>
						</div>
					
						<div class="form_grid_12">
							<label class="field_title" id="lposition" for="position">{{__('propertyregister.Building_Category')}} <span class="req">*</span></label>
							<div  class="form_input">
								<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="bldgcate" name="bldgcate" tabindex="1">
									<option></option>
									@foreach ($bldgcate as $rec)
											<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
									@endforeach	
								</select>
							</div>
							<span class=" label_intro"></span>
						</div>
						
						<div class="form_grid_12">
							<label class="field_title" id="llevel" for="level">{{__('propertyregister.Building_Type')}} <span class="req">*</span></label>
							<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="bldgttype" name="bldgttype" tabindex="1">
									<option></option>
									@foreach ($bldgtype as $rec)
											<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
									@endforeach	
								</select>
							</div>
							<span class=" label_intro"></span>
						</div>
						<div class="form_grid_12">
							<label class="field_title" id="llevel" for="level">{{__('propertyregister.Building_Storey')}} <span class="req">*</span></label>
							<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="bldgstorey" name="bldgstorey" tabindex="1">
									<option></option>
									@foreach ($bldgstore as $rec)
											<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
									@endforeach	
								</select>
							</div>
							<span class=" label_intro"></span>
						</div>
						<div class="form_grid_12">
							<label class="field_title" id="llevel" for="level">{{__('propertyregister.Building_Condition')}} <span class="req">*</span></label>
							<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="bldgcond" name="bldgcond" tabindex="1">
									<option></option>
									@foreach ($bldgcond as $rec)
											<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
									@endforeach	
								</select>
							</div>
							<span class=" label_intro"></span>
						</div>
						<div class="form_grid_12">
							<label class="field_title" id="llevel" for="level">{{__('propertyregister.Building_Position')}} <span class="req">*</span></label>
							<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="bldgpos" name="bldgpos" tabindex="1">
									<option></option>
									@foreach ($bldgpos as $rec)
											<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
									@endforeach	
								</select>
							</div>
							<span class=" label_intro"></span>
						</div>

						<div class="form_grid_12">
							<label class="field_title" id="llevel" for="level">{{__('propertyregister.Building_Structure')}} <span class="req">*</span></label>
							<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="bldgstructure" name="bldgstructure" tabindex="1">
									<option></option>
									@foreach ($bldgstruct as $rec)
											<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
									@endforeach	
								</select>
							</div>
							<span class=" label_intro"></span>
						</div>
					</li>
				</ul>
			</div>
			<div  class="grid_6 ">
				<ul>
					<li >
			
						<div class="form_grid_12">
							<label class="field_title" id="lposition" for="position">{{__('propertyregister.Roof_Type')}} <span class="req">*</span></label>
							<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="rooftype" name="rooftype" tabindex="1">
									<option></option>
									@foreach ($rooftype as $rec)
											<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
									@endforeach	
								</select>
							</div>
							<span class=" label_intro"></span>
						</div>

						<div class="form_grid_12">
							<label class="field_title" id="lposition" for="position">{{__('propertyregister.Wall_Type')}}<span class="req">*</span></label>
							<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="walltype" name="walltype" tabindex="20">
									<option></option>
									@foreach ($walltype as $rec)
											<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
									@endforeach	
								</select>
							</div>
							<span class=" label_intro"></span>
						</div>
						
						<div class="form_grid_12">
							<label class="field_title" id="llevel" for="level">{{__('propertyregister.Floor_Type')}}<span class="req">*</span></label>
							<div  class="form_input">
								<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="floortype" name="floortype" tabindex="1">
									<option></option>
									@foreach ($fltype as $rec)
											<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
									@endforeach	
								</select>
							</div>
							<span class=" label_intro"></span>
						</div>
						<div class="form_grid_12">
							<label class="field_title" id="llevel" for="level">{{__('propertyregister.Ccc_Date')}}<span class="req">*</span></label>
							<div  class="form_input">
								<input id="cccdt"  name="cccdt"  type="text" tabindex="1" maxlength="50" />
							</div>
							<span class=" label_intro"></span>
						</div>
						<div class="form_grid_12">
							<label class="field_title" id="lposition" for="position">{{__('propertyregister.Occupied_Date')}}<span class="req">*</span></label>
							<div  class="form_input">
								<input id="occupieddt"  name="occupieddt" tabindex="1" type="text"  maxlength="50"/>
							</div>
							<span class=" label_intro"></span>
						</div>
						<div class="form_grid_12">
							<label class="field_title" id="lposition" for="position">{{__('propertyregister.Main_Building')}}<span class="req">*</span></label>
							<div  class="form_input">
								<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="mbldg" name="mbldg" tabindex="1">
									<option></option>			
									@foreach ($mbldg as $rec)
											<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
									@endforeach	
									
								</select>									
							</div>
							<span class=" label_intro"></span>
						</div>
					</li>

				</ul>
		
			</div>
		</div>
		<span class="clear"></span>
	</div>	

	<div style="display:none;" id="bldgardetail1" >
		<div class="social_activities">
								
			<div class="comments_s">
				<div class="block_label">
					{{__('propertyregister.Building_Number')}} <span id="dispbldgnum2"></span>
				</div>
			</div>

			<br>

		</div>
		<div id="bldgarform" autocomplete="off" onsubmit="return false;" class="form_container left_label" method="post" action="#" >
			<div style="height: 48px; display: -webkit-box;text-align: -webkit-right;" class="grid_12">
				<button id="submitaddtblbldgar" onclick="addbldgarRow()" style="display:none" name="adduser" type="button" class="btn_small btn_blue"><span>{{__('common.Add_New')}} </span></button>	
				<button id="submitedittblbldgar" onclick="editbldgarRow()" style="display:none" name="adduser" type="button" class="btn_small btn_blue"><span>{{__('common.Update')}} </span></button>	
				<button id="close" onclick="closebldgar()" name="close" type="button" class="btn_small btn_blue"><span>{{__('common.Close')}} </span></button>
			</div>
			<div class="grid_6 ">
				<ul>
					<li>
						<input type="hidden" value="0"  name="operation" id="bldgar_operation">
						<!--<input type="hidden" value="0" name="bldgnum" id="arbldgnum">-->
						<input type="hidden" value="0" name="bldgaccnum" id="bldgaccnum">
						<input type="hidden" value="0" name="bldgarid" id="bldgarid">
						<input type="hidden" value="0" name="bldgnumar" id="bldgnumar">

							<!--<div class="form_grid_12">
								<label class="field_title" id="lposition" for="position">{{__('propertyregister.Application_Type')}} Builiding Number<span class="req">*</span></label>
								<div  class="form_input">
									<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="bldgnumar" name="bldgnumar" tabindex="20">				
										
									</select>
								</div>
								<span class=" label_intro"></span>
							</div>-->
						<div class="form_grid_12">
							<label class="field_title" id="lusername" for="username">{{__('propertyregister.Reff_Information')}} <span class="req">*</span></label>
							<div  class="form_input">
								<input id="reffinfo"  name="reffinfo" tabindex="1" type="text"  maxlength="50" />
							</div>
							<span class=" label_intro"></span>
						</div>
									
						<div class="form_grid_12">
							<label class="field_title" id="lposition" for="position">{{__('propertyregister.Area_Type')}} </label>
							<div  class="form_input">
								<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="artype" name="artype" tabindex="1">
									<option></option>
									@foreach ($artype as $rec)
											<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
									@endforeach	
								</select>
							</div>
							<span class=" label_intro"></span>
						</div>
									
						<div class="form_grid_12">
							<label class="field_title" id="llevel" for="level">{{__('propertyregister.Area_Category')}} <span class="req">*</span></label>
							<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="arcate" name="arcate" tabindex="1">
									<option></option>
									@foreach ($arcaty as $rec)
											<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
									@endforeach	
								</select>
							</div>
							<span class=" label_intro"></span>
						</div>
						<div class="form_grid_12">
							<label class="field_title" id="llevel" for="level">{{__('propertyregister.Area_Level')}} <span class="req">*</span></label>
							<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="arlevel" name="arlevel" tabindex="1">
									<option></option>
									@foreach ($arlvl as $rec)
											<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
									@endforeach	
								</select>
							</div>
							<span class=" label_intro"></span>
						</div>
						<div class="form_grid_12">
							<label class="field_title" id="llevel" for="level">{{__('propertyregister.Area_Zone')}} <span class="req">*</span></label>
							<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="arzone" name="arzone" tabindex="1">
									<option></option>
									@foreach ($arzone as $rec)
											<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
									@endforeach	
								</select>
							</div>
							<span class=" label_intro"></span>
						</div>
						<div class="form_grid_12">
							<label class="field_title" id="llevel" for="level">{{__('propertyregister.Area_Use')}} <span class="req">*</span></label>
							<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="aruse" name="aruse" tabindex="1">
									<option></option>
									@foreach ($aruse as $rec)
											<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
									@endforeach	
								</select>
							</div>
							<span class=" label_intro"></span>
						</div>
						<div class="form_grid_12">
							<label class="field_title" id="lposition" for="position">{{__('propertyregister.Area_Description')}} </label>
							<div  class="form_input">
								<input id="ardesc"  name="ardesc"  type="text" tabindex="1" maxlength="50" />
							</div>
							<span class=" label_intro"></span>
						</div>

					</li>
				</ul>

			</div>
			<div  class="grid_6 ">
				<ul>
					<li >
								
						<div class="form_grid_12">
							<label class="field_title" id="llevel" for="level">{{__('propertyregister.Ceilling_Type')}} <span class="req">*</span></label>
							<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="celingtype" name="celingtype" tabindex="1">
									<option></option>
									@foreach ($ceiling as $rec)
										<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
									@endforeach	
								</select>
							</div>
							<span class=" label_intro"></span>
						</div>

						<div class="form_grid_12">
							<label class="field_title" id="lposition" for="position">{{__('propertyregister.Wall_Type')}} <span class="req">*</span></label>
							<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="dwalltype" name="walltype" tabindex="1">
									<option></option>
									@foreach ($walltype as $rec)
											<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
									@endforeach	
								</select>
							</div>
							<span class=" label_intro"></span>
						</div>
						<div class="form_grid_12">
							<label class="field_title" id="llevel" for="level">{{__('propertyregister.Floor_Type')}} <span class="req">*</span></label>
							<div  class="form_input">
								<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="fltype" name="fltype" tabindex="1">
									<option></option>
									@foreach ($fltype as $rec)
											<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
									@endforeach	
								</select>
							</div>
							<span class=" label_intro"></span>
						</div>
						<div class="form_grid_12">
							<label class="field_title" id="llevel" for="level">{{__('propertyregister.Dimention')}} <span class="req">*</span></label>
							<div  class="form_input">
								<input id="dimention"  name="dimention" value="0" type="text" tabindex="1" maxlength="50" />
							</div>
							<span class=" label_intro"></span>
						</div>
						<div class="form_grid_12">
							<label class="field_title" id="lposition" for="position">{{__('propertyregister.Area_Count')}} <span class="req">*</span></label>
							<div  class="form_input">
								<input id="arcnt" onKeyDown="if(this.value.length==6 && event.keyCode>47 && event.keyCode < 58) return false;" value="1" onchange="caltotsize()" name="arcnt" value="1" onchange="caltotsize()" tabindex="1" type="number"  maxlength="50"/>
							</div>
							<span class=" label_intro"></span>
						</div>
						<div class="form_grid_12">
							<label class="field_title" id="llevel" for="level">{{__('propertyregister.Measurement')}} <span class="req">*</span></label>
							<div  class="form_input">
								<input id="size"  name="size" onKeyDown="if(this.value.length==8 && event.keyCode>47 && event.keyCode < 58) return false;" value="0" onchange="caltotsize()" type="number" tabindex="1" maxlength="50" />
							</div>
							<span class=" label_intro"></span>
						</div>
						<div class="form_grid_12">
							<label class="field_title" id="lposition" for="position">{{__('propertyregister.Unit_Of_Measurement')}} <span class="req">*</span></label>
							<div  class="form_input">
								<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="uom" name="uom" tabindex="1">
									<option></option>
									@foreach ($unitsize as $rec)
											<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
									@endforeach	
								</select>
							</div>
							<span class=" label_intro"></span>
						</div>
						<div class="form_grid_12">
							<label class="field_title" id="lposition" for="position">{{__('propertyregister.Total_Size')}} <span class="req">*</span></label>
							<div  class="form_input">
								<input id="totsize" onKeyDown="if(this.value.length==8 && event.keyCode>47 && event.keyCode < 58) return false;" value="0" onchange="caltotsize()" name="totsize" value="0" type="number" tabindex="1" maxlength="50"/>
							</div>
							<span class=" label_intro"></span>
						</div>
						</li>
						<!--<li>
						<div class="form_grid_12">
							<div class="form_input">
								<button id="addsubmit" name="adduser" type="submit" class="btn_small btn_blue"><span>Submit</span></button>											
								<button id="close" onclick="closeAddUser()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>
							</div>
						</div>-->
						</ul>
						
			</div>
					
		</div>
		<span class="clear"></span>
	</div>					

</div>

<input type="hidden" id="parentcatgory"><input id="bldgtemp" value="0" name="temp" value="0" type="hidden" tabindex="1" maxlength="50"/>
						
							
<script type="text/javascript">
	$(document).ready(function() {

	 	$( "#cccdt" ).datepicker({dateFormat: 'dd/mm/yy'});
	 	$( "#occupieddt" ).datepicker({dateFormat: 'dd/mm/yy'});

		//alert($("#bldgtype").val());
		if ($("#bldgtype").val() === '1'){
			$("#bldgtable").show();
			$("#addbldg").show();
		} else {
			$("#bldgtable").hide();
			$("#addbldg").hide();
		}

		// let bldgarmap = new Map([
		// 	 ["0","sno"],
		// 	 ["1", "bldgaccnum"],  
		// 	 ["2", "bldgnum"], 
		// 	 ["3", "bldgnum2"], 
		// 	 ["4", "bldgnum4"], 
		// 	 ["5", "bldgnum5"], 
		// 	 ["6", "bldgnum7"], 
		// 	 ["7", "bldgnu8m"], 
		// 	 ["8", "bldgnu2m"], 
		// 	 ["9", "bldgnum7"], 
		// 	 ["10", "bldgnu8m"], 
		// 	 ["11", "bldgnu2m"],
		// 	 ["12", "reffinfo"], 
		// 	 ["13", "artype"],
		// 	 ["14", "arcate"], 
		// 	 ["15", "arlevel"],
		// 	 ["16", "arzone"], 
		// 	 ["17", "aruse"],
		// 	 ["18", "ardesc"], 
		// 	 ["19", "dimention"],
		// 	 ["20", "arcnt"],
		// 	 ["21", "size"],
		// 	 ["22", "uom"],
		// 	 ["23", "totsize"],
		// 	 ["24", "fltype"],
		// 	 ["25","dwalltype"],
		// 	 ["26", "celingtype"],
		// 	 ["27", "action"],
		// 	 ["28","actioncode"],
		// 	 ["29","bldgarid"],
		// 	 ["30","bldgnumtxt"]
		// 	]);

		 let bldgarmap = new Map([
			 ["0","sno"],
			 ["1", "bldgaccnum"],  
			 ["2", "bldgnum"], 
			 ["3", "disparlevel"], 
			 ["4", "bldgnum2"], 
			 ["5", "bldgnum4"], 
			 ["6", "bldgnum5"], 
			 ["7", "bldgnum7"], 
			 ["8", "bldgnu8m"], 
			 ["9", "bldgnu2m"], 
			 ["10", "bldgnum7"], 
			 ["11", "bldgnu8m"], 
			 ["12", "bldgnu2m"],
			 ["13", "reffinfo"], 
			 ["14", "artype"],
			 ["15", "arcate"], 
			 ["16", "arlevel"],
			 ["17", "arzone"], 
			 ["18", "aruse"],
			 ["19", "ardesc"], 
			 ["20", "dimention"],
			 ["21", "arcnt"],
			 ["22", "size"],
			 ["23", "uom"],
			 ["24", "totsize"],
			 ["25", "fltype"],
			 ["26","dwalltype"],
			 ["27", "celingtype"],
			 ["28", "action"],
			 ["29","actioncode"],
			 ["30","bldgarid"],
			 ["31","bldgnumtxt"]
			]);
			
	 	var blsgardata = [];
		@foreach ($bldgardetail as $rec)
				 
			blsgardata.push( [ '', $('#accnumber').val(), '{{$rec->BA_BL_ID}}', '{{$rec->arlvel}}','{{$rec->artype}}','{{$rec->arcate}}','{{$rec->aruse}}','{{$rec->BA_UNITCOUNT}}','{{$rec->BA_TOTSIZE}}','{{$rec->ceilingtype}}','{{$rec->floortype}}','{{$rec->arzone}}','{{$rec->BA_AREADESC}}', '{{$rec->BA_REF}}', '{{$rec->BA_AREATYPE_ID}}','{{$rec->BA_AREACATEGORY_ID}}','{{$rec->BA_AREALEVEL_ID}}', '{{$rec->BA_AREAZONE_ID}}', '{{$rec->BA_AERAUSE_ID}}', '{{$rec->BA_AREADESC}}',  '{{$rec->BA_DIMENTION}}', '{{$rec->BA_UNITCOUNT}}', '{{$rec->BA_SIZE}}','{{$rec->BA_SIZEUNIT_ID}}', '{{$rec->BA_TOTSIZE}}', '{{$rec->BA_FLOORTYPE_ID}}','{{$rec->BA_WALLTYPE_ID}}','{{$rec->BA_CEILINGTYPE_ID}}','<span><a onclick="" class="action-icons c-edit edtbldgarrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class="action-icons c-delete  deletebldgarrow" href="#" title="delete">Delete</a></span>', 'noaction','{{$rec->BA_ID}}','{{$rec->bl_bldg_no}}' ] );
			//blsgardata.push( [ '', $('#accnumber').val(), '{{$rec->BA_BL_ID}}','{{$rec->artype}}','{{$rec->arcate}}','{{$rec->aruse}}','{{$rec->BA_UNITCOUNT}}','{{$rec->BA_TOTSIZE}}','{{$rec->ceilingtype}}','{{$rec->floortype}}','{{$rec->arzone}}','{{$rec->BA_AREADESC}}', '{{$rec->BA_REF}}', '{{$rec->BA_AREATYPE_ID}}','{{$rec->BA_AREACATEGORY_ID}}','{{$rec->BA_AREALEVEL_ID}}', '{{$rec->BA_AREAZONE_ID}}', '{{$rec->BA_AERAUSE_ID}}', '{{$rec->BA_AREADESC}}',  '{{$rec->BA_DIMENTION}}', '{{$rec->BA_UNITCOUNT}}', '{{$rec->BA_SIZE}}','{{$rec->BA_SIZEUNIT_ID}}', '{{$rec->BA_TOTSIZE}}', '{{$rec->BA_FLOORTYPE_ID}}','{{$rec->BA_WALLTYPE_ID}}','{{$rec->BA_CEILINGTYPE_ID}}','<span><a onclick="" class="action-icons c-edit edtbldgarrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class="action-icons c-delete  deletebldgarrow" href="#" title="delete">Delete</a></span>', 'noaction','{{$rec->BA_ID}}','{{$rec->bl_bldg_no}}' ] );
	    @endforeach
			var groupColumn = 4;
		 $('#bldgartable1').DataTable({
        	data:           blsgardata,
            "columns":[ 
				null, 
				{ "visible": false }, 
				{ "visible": false }, 
				{ "visible": true },
				null, 
				null, 
				null, 
				null, 
				null,
				null, 
				null, 
				null, 
				null, 
				{ "visible": false }, 
				{ "visible": false }, 
				{ "visible": false}, 
				{ "visible": false}, 
				{ "visible": false }, 
				{ "visible": false}, 
				{ "visible": false }, 
				{ "visible": false }, 
				{ "visible": false}, 
				{ "visible": false }, 
				{ "visible": false}, 
				{ "visible": false }, 
				{ "visible": false }, 
				{ "visible": false }, 
				{ "visible": false }, 
				null,
				{ "visible": false },
				{ "visible": false },
				{ "visible": false }
			],
            "sPaginationType": "full_numbers",
			"iDisplayLength": 10,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
		   
		    
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>',
			"drawCallback": function ( settings ) {
	            var api = this.api();
	            var rows = api.rows( {page:'current'} ).nodes();
	            var last=null;
	            var iDisplayIndex = 0;
	 
	            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
	                if ( last !== group ) {
	                    $(rows).eq( i ).before(
	                        '<tr class="group"><td colspan="5">'+group+'</td></tr>'
	                    );

	                   
	 
	                    last = group;
	                }
	            } );
	        },
	        "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:first", nRow).html(iDisplayIndex +1);
               return nRow;
            },
			 
		});


		 $("div.table_top select").addClass('tbl_length');
		$(".tbl_length").chosen({
			disable_search_threshold: 4	
		});

       

		$('#bldgartable1 tbody').on( 'click', '.deletebldgarrow', function () {
			 var tablear = $('#bldgartable1').DataTable();
			var row = tablear.row(tablear.row( $(this).parents('tr') ).index());
			    data = row.data();
			    data[0]='Deleted';
				data[28]='delete';
				data[27]='';
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

		$('#bldgartable1 tbody').on( 'click', '.edtbldgarrow', function () {
			//var editlotdata = JSON.stringify(table.row( $(this).parents('tr') ).data());
			 var tablear = $('#bldgartable1').DataTable();
			var ldata = tablear.row($(this).parents('tr')).data();
			$('#bldgareatableindex').val(tablear.row( $(this).parents('tr') ).index());
			//console.log(tablear.row($(this).parents('tr')));g
			//console.log(tablear.row($(this).parents('tr')).data());
			var bldgardata = {};
			//console.log(ldata);
			var bldgtype_id = $('#hbldgid').val();
			var param ="tabBldgar1";
			$.ajax({
				url: "childparam",
				cache: false,
				data:{param_value:bldgtype_id,param:param},
				success: function(data){
		    		createDropDownOptions(data.res_arr, 'arlevel');
		    		createDropDownOptions(data.storey_arr, 'aruse');
					console.log(data.storey_arr);
					console.log(data.res_arr);
					
					$.each( ldata, function( key, value ) {
						bldgardata[bldgarmap.get(""+key+"")] = value;              
		            });
		    
					$.each( bldgardata, function( key, val ) {
						if(key === 'bldgnum'){
							$('#bldgarid').val(val);
						}else if(key === 'bldgnumar' ){
							
						}else if(key === 'bldgarid' ){
							
						}else if(key === 'bldgnumtxt' ){
							$('#bldgnumar').val(val);
							//alert('bldgnumar');
						}else{
							$('#'+key).val(val);
						}
		        		//masukk
						//alert('begin load edit area: ' + key + ' xxx ' + val);
		        		// if(key === 'bldgnum'){
		        		// 	//$('#bldgnumar').val(val);
						// 	$('#bldgarid').val(val);
						// 	//alert($('#bldgarid').val());
						// 	//bldgarid
						// }
						
		        		// if(key === 30){
		        		// 	$('#bldgtemp').val(val);
						// }
					});
				}
			});
			
        	$("#bldgardetail1").show();
			$("#addbldgar").hide();
			$("#bldgdetail").hide();
			$("#addbldg").hide();
			$("#bldgtable").hide();
			$("#bldgareatable1").hide();

			$('#propertyregsitration_from-back-3').hide();
			addDisableTab();
			$('#finish').hide();
            //console.log( table.row( $(this).parents('tr') ).index() );		
			//$('#lot_operation').val(2);
			 //$('#tableindex').val(table.row( $(this).parents('tr') ).index());  
			 //table.row( $(this).parents('tr') ).remove().draw();
			 $('#submitedittblbldgar').show();
			 $('#submitaddtblbldgar').hide();


		});

		 /* $('#bldgartable1').DataTable({
		  	"responsive": true,
            "columns":[ null, { "visible": false }, { "visible": false }, null, { "visible": false }, { "visible": false}, { "visible": false}, { "visible": false }, { "visible": false}, null, { "visible": false }, { "visible": false}, null, { "visible": false}, null, { "visible": false }, { "visible": false }, { "visible": false }, null,{ "visible": false },{ "visible": false }],
            "sPaginationType": "full_numbers",
			"iDisplayLength": 5,
			"paging": false,
			"searching": false,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>"
		    },
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			 
		});*/
		var account = $('#accnumber').val();
		let bldgmap = new Map([["0","sno"],["1", "url"],["2", "bldgnum"],["3", "bldgnum1"],["4", "bldgnum2"],["5", "bldgnum3"],["6", "bldgnum4"],  ["7", "bldgttype"],["8", "bldgstorey"], ["9", "bldgcond"],["10", "bldgpos"], ["11", "bldgstructure"],["12", "rooftype"], ["13", "walltype"],["14", "floortype"], ["15", "cccdt"],["16", "occupieddt"],["17", "mainbldg"],["18", "action"],["19", "actioncode"],["20", "bldgid"],["21","bldgaccnum"],["22","mbldg"]]);

	 	var blsgdata = [];
		@foreach ($building as $rec)
			blsgdata.push( [ '{{$loop->iteration}}', "<a class='shobldg' onclick='showBldgAr({{$rec->BL_ID}})' href='#' >{{ $rec->BL_BLDG_NO}}<input type='hidden' value='{{ $rec->BL_BLDGTYPE_ID}}' id='bldgtype_{{$rec->BL_ID}}'><input type='hidden' value='{{ $rec->bldgcategory_id}}' id='bldgcategory_{{$rec->BL_ID}}'><input type='hidden' value='{{ $rec->BL_BLDG_NO}}' id='{{$rec->BL_ID}}'></a>", '{{$rec->BL_BLDG_NO}}','{{$rec->bldgcategory}} / {{$rec->bldgtype}}','{{$rec->bldgstorey}}','{{$rec->bldgstr}}','{{$rec->rootype}}','{{$rec->BL_BLDGTYPE_ID}}', '{{$rec->BL_BLDGSTOREY_ID}}', '{{$rec->BL_BLDGCONDN_ID}}', '{{$rec->BL_BLDGPOSITION_ID}}', '{{$rec->BL_BLDGSTRUCTURE_ID}}', '{{$rec->BL_ROOFTYPE_ID}}', '{{$rec->BL_WALLTYPE_ID}}','{{$rec->BL_FLOORTYPE_ID}}',  '{{$rec->BL_CCCDATE}}', '{{$rec->BL_OCCUPIEDDATE}}','{{$rec->astatus}}','<span><a onclick="" class="action-icons c-edit edtbldgrow" href="#" title="Edit">Edit</a></span><span><a onclick="openbldgarea({{$rec->BL_ID}})" class="action-icons c-add  addbldgarearow" href="#" title="Add Building Detail">Add</a></span>&nbsp;&nbsp;&nbsp;<span><a onclick="" class="action-icons c-delete  deletebldgrow" href="#" title="delete">Delete</a></span>','noation', '{{$rec->BL_ID}}',account,'{{$rec->BL_ISMAINBLDG_ID}}']);

		@endforeach

				

	    $('#bldgtble').DataTable({
	        data:           blsgdata,
	        "columns":[ null, null, { "visible": false }, null, null, null, null,{ "visible": false },  { "visible": false }, { "visible": false }, { "visible": false}, { "visible": false}, { "visible": false }, { "visible": false}, { "visible": false}, null, null, null, null, { "visible": false }, { "visible": false }, { "visible": false }, { "visible": false }],
	        "sPaginationType": "full_numbers",
			"iDisplayLength": 10,
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

	    var table = $('#bldgtble').DataTable();

		$('#bldgtble tbody').on( 'click', '.deletebldgrow', function () {

			var row = table.row(table.row( $(this).parents('tr') ).index()),
			    data = row.data();
			    data[0]='Deleted';
				data[19]='delete';
				data[18]='';
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

		$('#bldgtble tbody').on( 'click', '.shobldg', function () {

			var ldata = table.row(table.row( $(this).parents('tr') ).index()).data();
			$('#bldgtableindex').val(table.row( $(this).parents('tr') ).index());
			var bldgdata = {};
			


			$.each( ldata, function( key, value ) {
				bldgdata[bldgmap.get(""+key+"")] = value;              
	        });

			
//$('#bldgtemp').val();
	        var bldgtype_id = $('#bldgcategory_'+bldgdata['bldgid']).val();
	       // alert(bldgtype_id);
	        $('#hbldgid').val(bldgtype_id);
			var param ="tabBldgar";
			$.ajax({
				url: "childparam",
				cache: false,
				data:{param_value:bldgtype_id,param:param},
				success: function(data){
		    		createDropDownOptions(data.res_arr, 'arlevel');
		    		createDropDownOptions(data.storey_arr, 'aruse');
					//console.log(data.storey_arr);
					//console.log(data.res_arr);
				}
			});
		   // table.row($(this).parents('tr') ).remove().draw();
		});

			/*$('#lottble tbody').on( 'click', '.dellotrow', function () {
			    var child = table.row( $(this).parents('tr') ).child;
			 
			    if ( child.isShown() ) {
			        child.hide();
			    }
			    else {
			        child.show();
			    }
			});*/


		$('#bldgtble tbody').on( 'click', '.edtbldgrow', function () {
			//var editlotdata = JSON.stringify(table.row( $(this).parents('tr') ).data());
			var ldata = table.row(table.row( $(this).parents('tr') ).index()).data();
			$('#bldgtableindex').val(table.row( $(this).parents('tr') ).index());
			var bldgdata = {};
			


			$.each( ldata, function( key, value ) {
				bldgdata[bldgmap.get(""+key+"")] = value;              
	        });
//alert(bldgdata['bldgid']);
			var bldgcategory = $('#bldgcategory_'+bldgdata['bldgid']).val();
		//alert(bldgcategory);
		var param_value = bldgcategory;

		$('#bldgtemp').val(bldgdata['bldgid']);

		$('#bldgcate').val(bldgcategory);
	    	var param = 'bldgtype';
	        $.ajax({
			  url: "subCategory",
			  cache: false,
			  data:{param_value:param_value,param:param},
			  success: function(data){
	    		createDropDownOptions(data.res_arr, 'bldgttype');
	    		createDropDownOptions(data.res_arr2, 'bldgstorey');
	    		 $.each( bldgdata, function( key, val ) {
	        	$('#'+key).val(val);
			});
			  }
			});

	       
//alert(bldgdata['bldgnum']);
	    	$("#bldgdetail").show();
			$("#addbldg").hide();
			$("#bldgtable").hide();


			$('#propertyregsitration_from-back-3').hide();
			$('#finish').hide();
			addDisableTab();
			$("#bldgardetail1").hide();
	        //console.log( table.row( $(this).parents('tr') ).index() );		
			//$('#lot_operation').val(2);
			 //$('#tableindex').val(table.row( $(this).parents('tr') ).index());  
			 //table.row( $(this).parents('tr') ).remove().draw();
			 $('#submitedittblbldg').show();
			 $('#submitaddtblbldg').hide();
		$("#bldgareatable1").hide();

		$("#bldgardetail1").hide();




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
	    		createDropDownOptions(data.res_arr, 'bldgttype');
	    		createDropDownOptions(data.res_arr2, 'bldgstorey');
			  }
			});
	    });

	});

	function editbldgRow(){

		if(validateBldg()){
			$('#propertyregsitration_from-back-3').show();
			$('#finish').show();
			removeDisableTab();
			$('#submitedittblbldg').show();
			$('#submitaddtblbldg').hide();
			var table = $('#bldgtble').DataTable();
			var account = $('#accnumber').val();
			var temp_id = $('#bldgtemp').val();
			//var temp_id = random();

			var row = table.row($('#bldgtableindex').val());
			var bldgdata = table.row($('#bldgtableindex').val()).data();
			var recordtype = bldgdata[0];
			//console.log(owneredata);
			var operation = "Updated";
			var operation_code = "update";
			if (recordtype==='New'){
				operation = "New";
				operation_code = "new";
			}
			
			//var row = table.row(table.row( $(this).parents('tr') ).index()),
			//data = row.data();
			var updatebldgno = $('#bldgnum').val();
			data=[operation,'<a class="shobldg" onclick="showBldgAr('+$('#bldgid').val()+')" href="#">'+updatebldgno+'</a><input type="hidden" value="'+$('#bldgcate').val()+'" id="bldgcategory_'+temp_id+'"><input type="hidden" value="'+$('#bldgttype').val()+'" id="bldgtype_'+$('#bldgid').val()+'"><input type="hidden" value="'+updatebldgno+'" id="'+$('#bldgid').val()+'">', updatebldgno, $('#bldgcate option:selected').text() +' / '+ $('#bldgttype option:selected').text(), $('#bldgstorey option:selected').text(), $('#bldgstructure option:selected').text(),$('#rooftype option:selected').text(), $('#bldgttype').val(), $('#bldgstorey').val(),  $('#bldgcond').val(), $('#bldgpos').val(), $('#bldgstructure').val(),$('#rooftype').val(), $('#walltype').val(), $('#floortype').val(),$('#cccdt').val(), $('#occupieddt').val(), $('#mbldg option:selected').text(), '<span><a onclick="" class="action-icons c-edit edtbldgrow" href="#" title="Edit">Edit</a></span><span><a onclick="openbldgarea('+$('#bldgid').val()+')" class="action-icons c-add  addbldgarearow" href="#" title="Add Building Detail">Add</a></span>&nbsp;&nbsp;&nbsp;<span><a onclick="" class="action-icons c-delete  deletebldgrow" href="#" title="delete">Delete</a></span>',operation_code, temp_id, account, $('#mbldg').val() ];


			var parenttable = $('#bldgartable1').DataTable();
		    //var landtotal = 0;
		    for (var m = 0;m < parenttable.rows().count() ;m++){
		      var parenttableldata = parenttable.row(m).data();

		      var parenttablerow = parenttable.row(m);

		      var parenttabledata = parenttablerow.data();
		      if (parenttableldata[2] == temp_id) {        
		        parenttabledata[31]=updatebldgno;
		        /*parenttabledata[4]=$('#allowancetotal').val();
		        parenttabledata[5]=$('#depvalue').val();
		        parenttabledata[6]=$('#netbldg').val();
		        parenttabledata[7]=$('#roundbldg').val();*/
		        parenttablerow.data(parenttabledata);
		      }
		//console.log(parenttabledata[4]);		   

		    }
			row.data(data);
			$('#propertystatus').val('');
			//alert('Record is successfully added');
			$("#bldgdetail").hide();
			$("#bldgtable").show();
			$("#addbldg").show();
		}
	}

	function random(){
		 var min=1000; 
	    var max=9000;  
	   // var random =Math.floor(Math.random() * (+max - +min)) + +min;
	    return Math.floor(Math.random() * (+max - +min)) + +min
	}

	function addbldgRow(){
		
		if(validateBldg()){
			var duplicate = false;
			for (var i = 0;i<$('#bldgtble').DataTable().rows().count();i++){
            var ldata = $('#bldgtble').DataTable().row(i).data();
            //var tempdata1 = {};
	            $.each(ldata, function( key, value ) {
	                if (key === 2){
	                    if ($('#bldgnum').val() === value){
	                       // alert('Building number already exsits');
	                        //return false;  
	                        duplicate = true;                      
	                    }
	                }
	            //console.log(key);            
	            });
        	}
        	
        	if(!duplicate){
				var operation = $("#lot_operation").val();
				//console.log(operation);
				var account = $('#accnumber').val();
				var updatebldgno = $('#bldgnum').val();
				var temp_id = random();

				$("#bldgardetail1").append("<input type='hidden' value='"+$('#bldgttype').val()+"' id='bldgtype_"+temp_id+"'><input type='hidden' value='"+updatebldgno+"' id='"+temp_id+"'>");
				//$('#'+temp_id).val(updatebldgno);
				//alert(temp_id);
				//alert(updatebldgno);
				//$('#bldgid').val(temp_id);
				var bldgtta = $('#bldgtble').DataTable();
				/*bldgtta.row.add(['New','<a class="shobldg" onclick="showBldgAr('+temp_id+')" href="#">'+updatebldgno+'</a><input type="hidden" value="'+$('#bldgttype').val()+'" id="bldgtype_'+$('#bldgid').val()+'"><input type="hidden" value="'+updatebldgno+'" id="'+$('#bldgid').val()+'">', updatebldgno,$('#bldgttype option:selected').text(), $('#bldgstorey option:selected').text(), $('#bldgstructure option:selected').text(),$('#rooftype option:selected').text(),  $('#bldgttype').val(), $('#bldgstorey').val(),  $('#bldgcond').val(), $('#bldgpos').val(), $('#bldgstructure').val(),$('#rooftype').val(), $('#walltype').val(), $('#floortype').val(),$('#cccdt').val(), $('#occupieddt').val(), $('#mainbldg').val(),'<span><a onclick="" class="action-icons c-edit edtbldgrow" href="#" title="Edit">Edit</a></span><span><a onclick="openbldgarea('+temp_id+')" class="action-icons c-add  addbldgarearow" href="#" title="Add Building Detail">Add</a></span>&nbsp;&nbsp;&nbsp;<span><a onclick="" class="action-icons c-delete  deletebldgrow" href="#" title="delete">Delete</a></span>', 'new', $('#bldgid').val(),account ]).draw(false);
			*/
				bldgtta.row.add(['New','<a class="shobldg" onclick="showBldgAr('+temp_id+')" href="#">'+updatebldgno+'</a><input type="hidden" value="'+$('#bldgcate').val()+'" id="bldgcategory_'+temp_id+'"><input type="hidden" value="'+$('#bldgttype').val()+'" id="bldgtype_'+$('#bldgid').val()+'"><input type="hidden" value="'+updatebldgno+'" id="'+$('#bldgid').val()+'">', updatebldgno,$('#bldgcate option:selected').text() +' / '+ $('#bldgttype option:selected').text(), $('#bldgstorey option:selected').text(), $('#bldgstructure option:selected').text(),$('#rooftype option:selected').text(),  $('#bldgttype').val(), $('#bldgstorey').val(),  $('#bldgcond').val(), $('#bldgpos').val(), $('#bldgstructure').val(),$('#rooftype').val(), $('#walltype').val(), $('#floortype').val(),$('#cccdt').val(), $('#occupieddt').val(), $('#mbldg option:selected').text(),'<span><a onclick="" class="action-icons c-edit edtbldgrow" href="#" title="Edit">Edit</a></span><span><a onclick="openbldgarea('+temp_id+')" class="action-icons c-add  addbldgarearow" href="#" title="Add Building Detail">Add</a></span>&nbsp;&nbsp;&nbsp;<span><a onclick="" class="action-icons c-delete  deletebldgrow" href="#" title="delete">Delete</a></span>', 'new', temp_id,account, $('#mbldg').val() ]).draw(false);
				
				alert('Record is successfully added');

				$('#propertystatus').val('');
				//$('#submitedittblbldg').hide();
					//$('#submitaddtblbldg').show();
				/*$('#propertyregsitration_from-back-3').show();
				$('#finish').show();
				$("#bldgardetail1").hide();
				$("#bldgdetail").hide();
				$("#bldgtable").show();
				$("#addbldg").show();*/
			} else {
				alert('Building Number already exsits in this account');
			}
		}
	}

	function openbldgarea(id){	
		$('#propertyregsitration_from-back-3').hide();
		$('#finish').hide();
		$("#bldgareatable1").hide();
		addDisableTab();
		$("#bldgardetail1").show();
		$('#addbldgar').hide();
		$('#submitedittblbldgar').hide();
		$('#submitaddtblbldgar').show();
		$('#bldgar_operation').val(1);
		//console.log($('#'+id).val());
		$('#dispbldgnum2').html($('#'+id).val());
		var bldgtype_id = $('#bldgtype_'+id).val();
		var param ="tabBldgar";
		$.ajax({
			url: "childparam",
			cache: false,
			data:{param_value:bldgtype_id,param:param},
			success: function(data){
	    		createDropDownOptions(data.res_arr, 'arlevel');
	    		createDropDownOptions(data.storey_arr, 'aruse');
				//console.log(data.storey_arr);
				//console.log(data.res_arr);
			}
		});
		//$('#'+id).val();bldgarid
		$('#bldgnumar').val($('#'+id).val());
		$('#bldgarid').val(id);
		$("#addbldg").hide();
		$("#bldgtable").hide();
		$('#artype').val('');
		$('#reffinfo').val('');
		//$('#arlevel').val('');
		$('#arcate').val('');
		$('#arzone').val('');
		//$('#aruse').val('');
		$('#ardesc').val('');
		$('#dimention').val('');
		$('#arcnt').val('1');
		$('#size').val('');
		$('#uom').val('');
		$('#totsize').val('');
		$('#fltype').val('');
		$('#dwalltype').val('');
		$('#celingtype').val('');
	}

function addbldgarRow(){
	if(validateBldgDetail()){
		var operation = $("#lot_operation").val();
		//console.log(operation);
		var t = $('#bldgartable1').DataTable();
		var account = $('#accnumber').val();
		//masukk
		//alert('Add Area Row accnumber:' + $('#accnumber').val() + ' bldgnumar:' + $('#bldgnumar').val() + ' bldgarid:' +  $('#bldgarid').val());							
		t.row.add(['New',$('#accnumber').val(), $('#bldgarid').val(), $('#arlevel option:selected').text(), $('#artype option:selected').text(), $('#arcate option:selected').text(),$('#aruse option:selected').text(), $('#arcnt').val(), $('#totsize').val(),$('#celingtype option:selected').text(), $('#fltype  option:selected').text(), $('#dwalltype option:selected').text(), $('#ardesc').val(), $('#reffinfo').val(),  $('#artype').val(), $('#arcate').val(), $('#arlevel').val(),$('#arzone').val(), $('#aruse').val(), $('#ardesc').val(),$('#dimention').val(), $('#arcnt').val(), $('#size').val(),$('#uom').val(),$('#totsize').val(), $('#fltype').val(), $('#dwalltype').val(),$('#celingtype').val(), '<span><a onclick="" class="action-icons c-edit edtbldgarrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons c-delete deletebldgarrow " href="#" title="delete">Delete</a></span>', 'new', $('#bldgid').val(), $('#bldgnumar').val()]).draw(false);
		//t.row.add(['New',$('#accnumber').val(), $('#bldgarid').val(), $('#artype option:selected').text(), $('#arcate option:selected').text(),$('#aruse option:selected').text(), $('#arcnt').val(), $('#totsize').val(),$('#celingtype option:selected').text(), $('#fltype  option:selected').text(), $('#dwalltype option:selected').text(), $('#ardesc').val(), $('#reffinfo').val(),  $('#artype').val(), $('#arcate').val(), $('#arlevel').val(),$('#arzone').val(), $('#aruse').val(), $('#ardesc').val(),$('#dimention').val(), $('#arcnt').val(), $('#size').val(),$('#uom').val(),$('#totsize').val(), $('#fltype').val(), $('#dwalltype').val(),$('#celingtype').val(), '<span><a onclick="" class="action-icons c-edit edtbldgarrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons c-delete deletebldgarrow " href="#" title="delete">Delete</a></span>', 'new', $('#bldgid').val(), $('#bldgnumar').val()]).draw(false);	
		alert('Building detail added');
	}
}

function editbldgarRow() {
	if(validateBldgDetail()){	
		// alert('masukk');
		//alert('Edit Area Row accnumber:' + $('#accnumber').val() + ' bldgnumar:' + $('#bldgnumar').val() + ' bldgarid:' +  $('#bldgarid').val());
		$('#submitedittblbldgar').hide();
		$('#submitaddtblbldgar').hide();
		var table = $('#bldgartable1').DataTable();
		var account = $('#accnumber').val();

		$('#propertyregsitration_from-back-4').show();
		$('#finish').show();
					
			var row = table.row($('#bldgareatableindex').val());
			var bldgareadata1 = table.row($('#bldgareatableindex').val()).data();
			var recordtype = bldgareadata1[0];

		var operation = "Updated";
			var operation_code = "update";
			if (recordtype==='New'){
				operation = "New";
				operation_code = "new";
			}
	 	//var row = table.row(table.row( $(this).parents('tr') ).index()),
	   // data = row.data();
	    data=[operation,$('#accnumber').val(), $('#bldgarid').val(), $('#arlevel option:selected').text(), $('#artype option:selected').text(), $('#arcate option:selected').text(),$('#aruse option:selected').text(), $('#arcnt').val(), $('#totsize').val(),$('#celingtype option:selected').text(), $('#fltype  option:selected').text(), $('#dwalltype option:selected').text(), $('#ardesc').val(), $('#reffinfo').val(),  $('#artype').val(), $('#arcate').val(), $('#arlevel').val(),$('#arzone').val(), $('#aruse').val(), $('#ardesc').val(),$('#dimention').val(), $('#arcnt').val(), $('#size').val(),$('#uom').val(), $('#totsize').val(), $('#fltype').val(), $('#dwalltype').val(), $('#celingtype').val(), '<span><a onclick="" class="action-icons c-edit edtbldgarrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons c-delete deletebldgarrow " href="#" title="delete">Delete</a></span>', operation_code, $('#bldgid').val(), $('#bldgnumar').val()];
		//data=[operation,$('#accnumber').val(), $('#bldgarid').val(), $('#artype option:selected').text(), $('#arcate option:selected').text(),$('#aruse option:selected').text(), $('#arcnt').val(), $('#totsize').val(),$('#celingtype option:selected').text(), $('#fltype  option:selected').text(), $('#dwalltype option:selected').text(), $('#ardesc').val(), $('#reffinfo').val(),  $('#artype').val(), $('#arcate').val(), $('#arlevel').val(),$('#arzone').val(), $('#aruse').val(), $('#ardesc').val(),$('#dimention').val(), $('#arcnt').val(), $('#size').val(),$('#uom').val(), $('#totsize').val(), $('#fltype').val(), $('#dwalltype').val(), $('#celingtype').val(), '<span><a onclick="" class="action-icons c-edit edtbldgarrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons c-delete deletebldgarrow " href="#" title="delete">Delete</a></span>', operation_code, $('#bldgid').val(), $('#bldgnumar').val()];

		row.data(data);
		$("#bldgardetail1").hide();
		$("#bldgareatable1").show();
		removeDisableTab();
		$("#addbldgar").show();
		$("#bldgdetail").hide();
		$("#addbldg").show();
		$("#bldgtable").show();
	 	$("label.error").remove();
	 }

}
	
	function closebldgar(){
		$('#propertyregsitration_from-back-3').show();
		$('#finish').show();
		removeDisableTab();
		$("#bldgareatable1").show();
		$("#addbldgar").show();
		$("#bldgardetail1").hide();
		$("#bldgtable").show();
		$("#addbldg").show();
		$("#bldgdetail").hide();
	 	$("label.error").remove();
	}		

	function showBldgAr(id){
		//$('#bldgartable1').DataTable().destroy();
		//alert(id);
		// let bldgarmap = new Map([
		// 	["0","sno"],["1", "bldgaccnum"],  ["2", "bldgnum"], ["3", "bldgnum2"], ["4", "bldgnum4"], ["5", "bldgnum5"], ["6", "bldgnum7"], ["7", "bldgnu8m"], ["8", "bldgnu2m"],["9", "reffinfo"], ["10", "artype"],["11", "arcate"], ["12", "arlevel"],["13", "arzone"], ["14", "aruse"],["15", "ardesc"], ["16", "dimention"],["17", "arcnt"],["18", "size"],["19", "uom"],["20", "totsize"],["21", "fltype"],["22","walltype"],["23", "celingtype"],["24", "action"],["25","actioncode"],["26","bldgarid"]]);

		let bldgarmap = new Map([
			["0","sno"],
			["1", "bldgaccnum"],  
			["2", "bldgnum"], 
			["3", "disparlevel"], 
			["4", "bldgnum2"], 
			["5", "bldgnum4"], 
			["6", "bldgnum5"], 
			["7", "bldgnum7"], 
			["8", "bldgnu8m"], 
			["9", "bldgnu2m"],
			["10", "reffinfo"], 
			["11", "artype"],
			["12", "arcate"], 
			["13", "arlevel"],
			["14", "arzone"], 
			["15", "aruse"],
			["16", "ardesc"], 
			["17", "dimention"],
			["18", "arcnt"],
			["19", "size"],
			["20", "uom"],
			["21", "totsize"],
			["22", "fltype"],
			["23","walltype"],
			["24", "celingtype"],
			["25", "action"],
			["26","actioncode"],
			["27","bldgarid"]
		]);

		//window.alert = function() {};
		var bldgno = $('#'+id).val();
		$('#disbldgno').html(bldgno);
		var tablear = $('#bldgartable1').DataTable();
		$.fn.dataTable.ext.search.pop();
    	//tablear.draw();
		//alert(id);

		
		$.fn.dataTable.ext.search.push(
			function(settings, data, dataIndex) {
				//alert('masukk');
				//alert(data[2]+ ' === ' + id);
				if (settings.nTable.id === 'bldgartable1') {
					if (data[2] == id){
				//	alert(data[2] == id);
						return true;
					}
				}
				if (settings.nTable.id !== 'bldgartable1') {
					return true;
				}

			}       
		);
	    tablear.draw();
    	
		 $('#submitedittblbldgar').show();
		 $('#submitaddtblbldgar').hide();
		$("#bldgareatable1").show();  
	}
/*
	function openbldgarea(id, bldgnum){
								
		$('#propertyregsitration_from-back-3').hide();
		$('#propertyregsitration_from-next-3').hide();
		$('#bldgar_operation').val(1);
		$('#arbldgnum').val(bldgnum);
		$("#addbldg").hide();
		$("#bldgtable").hide();
		$("#bldgareatable").hide();
		$("#bldgardetail").show();
		$('#reffinfo').val('');
		$('#artype').val('');
		$('#arlevel').val('');
		$('#arcate').val('');
		$('#arzone').val('');
		$('#aruse').val('');
		$('#ardesc').val('');
		$('#dimention').val('');
		$('#arcnt').val('');
		$('#size').val('');
		$('#uom').val('');
		$('#totsize').val('');
		$('#fltype').val('');
		$('#walltype').val('');
		$('#celingtype').val('');
	}
*/

	function closearbldg(){
		$('#propertyregsitration_from-back-3').show();
		$('#propertyregsitration_from-next-3').show();
		removeDisableTab();
		$("#addbldg").show();
		$("#bldgtable").show();
		$("#bldgareatable").hide();
		$("#bldgardetail").hide();							
	}

	function openbldg(){

		$('#masterid').val('');
		$("#bldgaccnum").val('');
		$('#bldg_masterid').val('');
		$('#bldgnum').val('');
		$('#bldgttype').val('');
		//$('#lotnum').val($('#city'+id).val());
		$('#bldgstorey').val('');
		$('#bldgcond').val('');
		$('#bldgpos').val('');
		$('#bldgstructure').val('');
		$('#rooftype').val('');
		$('#walltype').val('');
		$('#cccdt').val('');
		$('#occupieddt').val('');



		$('#bldgcate').val('');
		$('#floortype').val('');
		$('#mbldg').val('');

		$("#bldgareatable").hide();
		$('#propertyregsitration_from-back-3').hide();
		addDisableTab();
		$('#finish').hide();
		$('#submitedittblbldg').hide();
		$("#bldgareatable1").hide();
		$('#submitaddtblbldg').show();

					
		

		//$("#bldg_operation").val(1);
		$("#bldgaccnum").val($('#accnumber').val());
		$("#bldgdetail").show();
		$("#bldgtable").hide();
		$("#addbldg").hide();	
	}
			
	function editbldg(id){
		$("#bldg_operation").val(2);
		$("#bldgid").val(id);
		$("#bldgaccnum").val($('#accnumber').val());
		$('#bldg_masterid').val($('#masterid'+id).val());
		$('#bldgnum').val($('#bldgno'+id).val());
		$('#bldgttype').val($('#bldgtype'+id).val());
		//$('#lotnum').val($('#city'+id).val());
		$('#bldgstorey').val($('#bldgstorey'+id).val());
		$('#bldgcond').val($('#bldgcond'+id).val());
		$('#bldgpos').val($('#bldgpos'+id).val());
		$('#bldgstructure').val($('#bldgstructure'+id).val());
		$('#rooftype').val($('#rooftype'+id).val());
		$('#walltype').val($('#walltype'+id).val());
		$('#cccdt').val($('#ccdt'+id).val());
		$('#occupieddt').val($('#occdt'+id).val());
		//$('#landuse').val($('#active'+id).val());
		$("#bldgdetail").show();
		$("#addbldg").hide();
		$("#bldgtable").hide();
		$("#bldgareatable").hide();
		$("#bldgsubmit").html("Update");
	}

	function editbldgardetail(id){
		$('#bldgar_operation').val(2);
		$("#addbldg").hide();
		$("#bldgtable").hide();
		$("#bldgareatable").hide();
		$("#bldgardetail").show();

		$('#reffinfo').val($('#bldgref_'+id).val());
		$('#artype').val($('#baartype_'+id).val());
		$('#arlevel').val($('#arlvel_'+id).val());
		$('#arcate').val($('#arcate'+id).val());
		$('#arzone').val($('#arzone'+id).val());
		$('#aruse').val($('#aruse'+id).val());
		$('#ardesc').val($('#ardesc'+id).val());
		$('#dimention').val($('#dim'+id).val());
		$('#arcnt').val($('#unitcnt'+id).val());
		$('#size').val($('#size'+id).val());
		$('#uom').val($('#sizeunit'+id).val());
		$('#totsize').val($('#totsize'+id).val());
		$('#fltype').val($('#fltype'+id).val());
		$('#walltype').val($('#walltype'+id).val());
		$('#celingtype').val($('#ceilingtype'+id).val());
		console.log('Done!');
	}

	function closebldg(){		
		$('#propertyregsitration_from-back-3').show();
		removeDisableTab();
		$('#finish').show();					
		$('#masterid').val('');
		$("#bldgaccnum").val('');
		$('#bldg_masterid').val('');
		$('#bldgnum').val('');
		$('#bldgttype').val('');
		//$('#lotnum').val($('#city'+id).val());
		$('#bldgstorey').val('');
		$('#bldgcond').val('');
		$('#bldgpos').val('');
		$('#bldgstructure').val('');
		$('#rooftype').val('');
		$('#walltype').val('');
		$('#cccdt').val('');
		$('#occupieddt').val('');
		$("#bldgtable").show();
		$("#addbldg").show();
		$("#bldgdetail").hide();

	 	$("label.error").remove();	
	}

							
	function bldgdesubmit(){
		//alert();
		$('#bldgform').validate({
			rules: {
			   'ownnum': 'required'
			},
			messages: {
			   'ownnum': 'This field is required'
			},
			submitHandler: function(form) {
			    //form.submit();
				$('#bldgsubmit').text('Please Wait');
				    //console.log('validation true');
				    	var bldgdata = {};
				$('#bldgform').serializeArray().map(function(x){bldgdata[x.name] = x.value;});
				//alert(3);
				//console.log(masterdata);
				var bldgjson = JSON.stringify(bldgdata);
				var pb = '{{$pb}}';
				$.ajax({
			        type:'POST',
			        url:'registerproperty',
				    headers: {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
			        data:{form:'bldg',type:'tab',jsondata:bldgjson,pb:pb},
			        success:function(data){	       	
			        	$('#bldgsubmit').text('Submit');
			        	var noty_id = noty({
							layout : 'top',
							text: 'bldg detail updated successfully!',
							modal : true,
							type : 'success', 
						});
			        	
			        },
			        error:function(data){	
			        	console.log(data);
			        	$('#bldgsubmit').text('Submit');        	
			        	var noty_id = noty({
							layout : 'top',
							text: 'error while adding bldg detail!',
							modal : true,
							type : 'error', 
						});
			        }
				});
						
			}
		});		

	}

	function bldgareasubmit(){
		$('#bldgarform').validate({
		  	rules: {
		    	'ownnum': 'required'
		  	},
		  	messages: {
		    	'ownnum': 'This field is required'
		   	},
			submitHandler: function(form) {
				    //form.submit();
				$('#bldgarsubmit').text('Please Wait');
					    //console.log('validation true');
				var bldgardata = {};
				$('#bldgarform').serializeArray().map(function(x){bldgardata[x.name] = x.value;});
					
					//console.log(masterdata);
				var bldgarjson = JSON.stringify(bldgardata);
				var pb = '{{$pb}}';
				$.ajax({
			        type:'POST',
			        url:'registerproperty',
				    headers: {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
			        data:{form:'bldgar',type:'tab',jsondata:bldgarjson,pb:pb},
			        success:function(data){	       	
			        	$('#bldgarsubmit').text('Submit');
			        	var noty_id = noty({
							layout : 'top',
							text: 'bldg detail updated successfully!',
							modal : true,
							type : 'success', 
						});
			        	
			        },
			        error:function(data){
			        	console.log(data);
			        	$('#bldgarsubmit').text('Submit');        	
			        	var noty_id = noty({
							layout : 'top',
							text: 'error while adding bldg detail!',
							modal : true,
							type : 'error', 
						});
			        }
				});
						
			}
		});
	}


	function caltotsize(){
		var arcnt = $('#arcnt').val();
		var size = $('#size').val()
		
		var totalsize = arcnt * size;
		$('#totsize').val(totalsize);
	}


</script>
							