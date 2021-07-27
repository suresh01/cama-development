
<div id="">
	
	@if($iseditable == 1)

	<button onclick="openbldg()" id="addbldg" name="btnadduser" type="button" class="btn_small btn_blue"><span>{{__('inspection.Add_Building')}}</span></button>

	@endif
	<div id="bldgtable" class="widget_wrap">					
		<div class="widget_content">						
			<table style="width:100%" id="bldgtble" class="display ">
			<thead style="text-align: left;">
	  		<tr>
				<th class="table_sno">{{__('inspection.SNo')}}</th>
				<th>{{__('inspection.Building_Number')}} </th>
				<th>{{__('inspection.Building_Number1S')}} </th>
				<th>{{__('inspection.Building_Category_Type')}} </th>
				<th>{{__('inspection.Building_Storey')}} </th>
				<th>{{__('inspection.Building_Structure')}} </th>
				<th>{{__('inspection.Roof_Type')}} </th>
				<th>{{__('inspection.Building_Type')}} </th>
				<th>{{__('inspection.Building_Storey')}} </th>
				<th>{{__('inspection.Building_Condition')}} </th>
				<th>{{__('inspection.Building_Position')}} </th>
				<th>{{__('inspection.Building_Structure')}} </th>
				<th>{{__('inspection.Roof_Type')}} </th>
				<th>{{__('inspection.Wall_Type')}} </th>
				<th>{{__('inspection.Floor_Type')}} </th>
				<th>{{__('inspection.Ccc_Date')}} </th>
				<th>{{__('inspection.Occupied_Date')}} </th>
				<th>{{__('inspection.Main_Building')}} </th>
				<th>{{__('inspection.Action')}} </th>
				<th>{{__('inspection.Actioncode')}} </th>
				<th>{{__('inspection.Blsdgid')}} </th>
				<th>{{__('inspection.Account')}} </th>
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
							{{__('inspection.Building_Number')}}<span id="disbldgno"></span>
						</div>
					</div>

					<br>

				</div>	

			<thead style="text-align: left;">
	  		<tr>					
				<th  class="table_sno">{{__('inspection.SNo')}}</th>
				<th>{{__('inspection.Account_Number')}}</th>
				<th>{{__('inspection.Building_Number')}}</th>
				<th>{{__('inspection.Area_Type')}}</th>
				<th>{{__('inspection.Area_Category')}}</th>
				<th>{{__('inspection.Area_Use')}}</th>
				<th>{{__('inspection.Area_Level')}}</th>
				<th>{{__('inspection.Area_Count')}}</th>
				<th>{{__('inspection.Total_Size')}}</th>
				<th>{{__('inspection.Ceiling_Type')}}</th>
				<th>{{__('inspection.Floor_Type')}}</th>
				<th>{{__('inspection.Wall_Type')}}</th>
				<th>{{__('inspection.Area_Description')}}</th>
				<th>{{__('inspection.Reff_Information')}}</th>
				<th>{{__('inspection.Area_Type')}}</th>
				<th>{{__('inspection.Area_Category')}}</th>
				<th>{{__('inspection.Area_Level')}}</th>
				<th>{{__('inspection.Area_Zone')}}</th>
				<th>{{__('inspection.Area_Use')}}</th>
				<th>{{__('inspection.Area_Description')}}</th>
				<th>{{__('inspection.Dimention')}}</th>
				<th>{{__('inspection.Area_Count')}}</th>
				<th>{{__('inspection.Measurement')}}</th>
				<th>{{__('inspection.Unit_Of_Measurement')}}</th>
				<th>{{__('inspection.Total_Size')}}</th>
				<th>{{__('inspection.Floor_Type')}}</th>
				<th>{{__('inspection.Wall_Type')}}</th>
				<th>{{__('inspection.Ceilling_Type')}}</th>
				<th>{{__('inspection.Action')}}</th>
				<th>{{__('inspection.Actioncode')}}</th>
				<th>{{__('inspection.Detailid')}}</th>
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
				<button id="submitaddtblbldg" onclick="addbldgRow()" style="display:none" name="adduser" type="button" class="btn_small btn_blue"><span>{{__('common.Add_New')}}</span></button>	
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
							<label class="field_title" id="lusername" for="username">{{__('inspection.Building_Number')}} <span class="req">*</span></label>
							<div  class="form_input">
								<input id="bldgnum" tabindex="1" name="bldgnum"  type="text"  maxlength="15" class=""/>
							</div>
							<span class=" label_intro"></span>
						</div>
					
						<div class="form_grid_12">
							<label class="field_title" id="lposition" for="position">{{__('inspection.Building_Category')}} <span class="req">*</span></label>
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
							<label class="field_title" id="llevel" for="level">{{__('inspection.Building_Type')}} <span class="req">*</span></label>
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
							<label class="field_title" id="llevel" for="level">{{__('inspection.Building_Storey')}} <span class="req">*</span></label>
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
							<label class="field_title" id="llevel" for="level">{{__('inspection.Building_Condition')}} <span class="req">*</span></label>
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
							<label class="field_title" id="llevel" for="level">{{__('inspection.Building_Position')}} <span class="req">*</span></label>
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
							<label class="field_title" id="llevel" for="level">{{__('inspection.Building_Structure')}} <span class="req">*</span></label>
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
							<label class="field_title" id="lposition" for="position">{{__('inspection.Roof_Type')}} <span class="req">*</span></label>
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
							<label class="field_title" id="lposition" for="position">{{__('inspection.Wall_Type')}} <span class="req">*</span></label>
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
							<label class="field_title" id="llevel" for="level">{{__('inspection.Floor_Type')}}<span class="req">*</span></label>
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
							<label class="field_title" id="llevel" for="level">{{__('inspection.Ccc_Date')}} <span class="req">*</span></label>
							<div  class="form_input">
								<input id="cccdt"  name="cccdt" class="datepicker" type="text" tabindex="1" maxlength="50" />
							</div>
							<span class=" label_intro"></span>
						</div>
						<div class="form_grid_12">
							<label class="field_title" id="lposition" for="position">{{__('inspection.Occupied_Date')}} <span class="req">*</span></label>
							<div  class="form_input">
								<input id="occupieddt"  name="occupieddt" class="datepicker" tabindex="1" type="text"  maxlength="50"/>
							</div>
							<span class=" label_intro"></span>
						</div>
						<input type="hidden" id="mainbldg">
						<div class="form_grid_12">
							<label class="field_title" id="lposition" for="position">{{__('inspection.Main_Building')}} <span class="req">*</span></label>
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
								<div id="bldgarform" autocomplete="off" onsubmit="return false;" class="form_container left_label" method="post" action="#" >
									<div style="height: 48px; display: -webkit-box;text-align: -webkit-right;" class="grid_12">
									<button id="submitaddtblbldgar" onclick="addbldgarRow()" style="display:none" name="adduser" type="button" class="btn_small btn_blue"><span>{{__('common.Add_New')}}</span></button>	
									<button id="submitedittblbldgar" onclick="editbldgarRow()" style="display:none" name="adduser" type="button" class="btn_small btn_blue"><span>{{__('common.Update')}}</span></button>	
								<button id="close" onclick="closebldgar()" name="close" type="button" class="btn_small btn_blue"><span>{{__('common.Close')}}</span></button>
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
									<label class="field_title" id="lposition" for="position">{{__('inspection.Close')}} Builiding Number<span class="req">*</span></label>
									<div  class="form_input">
										<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="bldgnumar" name="bldgnumar" tabindex="20">				
											
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>-->
								<div class="form_grid_12">
									<label class="field_title" id="lusername" for="username">{{__('inspection.Reff_Information')}} <span class="req">*</span></label>
									<div  class="form_input">
										<input id="reffinfo"  name="reffinfo" tabindex="1" type="text"  maxlength="50" class="large"/>
									</div>
									<span class=" label_intro"></span>
								</div>
								
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">{{__('inspection.Area_Type')}} </label>
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
									<label class="field_title" id="llevel" for="level">{{__('inspection.Area_Category')}} <span class="req">*</span></label>
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
									<label class="field_title" id="llevel" for="level">{{__('inspection.Area_Level')}} <span class="req">*</span></label>
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
									<label class="field_title" id="llevel" for="level">{{__('inspection.Area_Zone')}} <span class="req">*</span></label>
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
									<label class="field_title" id="llevel" for="level">{{__('inspection.Area_Use')}} <span class="req">*</span></label>
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
									<label class="field_title" id="lposition" for="position">{{__('inspection.Area_Description')}} </label>
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
									<label class="field_title" id="llevel" for="level">{{__('inspection.Ceilling_Type')}} <span class="req">*</span></label>
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
									<label class="field_title" id="lposition" for="position">{{__('inspection.Wall_Type')}} <span class="req">*</span></label>
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
									<label class="field_title" id="llevel" for="level">{{__('inspection.Floor_Type')}}<span class="req">*</span></label>
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
									<label class="field_title" id="llevel" for="level">{{__('inspection.Dimention')}} <span class="req">*</span></label>
									<div  class="form_input">
										<input id="dimention"  name="dimention" value="0" type="text" tabindex="1" maxlength="50" />
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">{{__('inspection.Area_Count')}} <span class="req">*</span></label>
									<div  class="form_input">
										<input id="arcnt" onKeyDown="if(this.value.length==6 && event.keyCode>47 && event.keyCode < 58) return false;" value="0" onchange="caltotsize()" name="arcnt" value="1" onchange="caltotsize()" tabindex="1" type="number"  maxlength="50"/>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">{{__('inspection.Measurement')}} <span class="req">*</span></label>
									<div  class="form_input">
										<input id="size"  name="size" onKeyDown="if(this.value.length==8 && event.keyCode>47 && event.keyCode < 58) return false;" value="0" onchange="caltotsize()" type="number" tabindex="1" maxlength="50" />
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">{{__('inspection.Unit_Of_Measurement')}} <span class="req">*</span></label>
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
									<label class="field_title" id="lposition" for="position">{{__('inspection.Total_Size')}} <span class="req">*</span></label>
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
							
							
<script type="text/javascript">
	var bldgcategotyid = '0';
	$(document).ready(function() {		
		
		let bldgarmap = new Map([["0","sno"],["1", "bldgaccnum"],  ["2", "bldgnum"], ["3", "bldgnum2"], ["4", "bldgnum4"], ["5", "bldgnum5"], ["6", "bldgnum7"], ["7", "bldgnu8m"], ["8", "bldgnu2m"], ["9", "bldgnum7"], ["10", "bldgnu8m"], ["11", "bldgnu2m"], ["12", "bldgnu80m"],["13", "reffinfo"], ["14", "artype"],["15", "arcate"], ["16", "arlevel"],["17", "arzone"], ["18", "aruse"],["19", "ardesc"], ["20", "dimention"],["21", "arcnt"],["22", "size"],["23", "uom"],["24", "totsize"],["25", "fltype"],["26","dwalltype"],["27", "celingtype"],["28", "action"],["29","actioncode"],["30","bldgarid"]]);
			
	 	var blsgardata = [];
		@foreach ($bldgardetail as $rec)				
					blsgardata.push( [ '{{$loop->iteration}}', $('#accnumber').val(), '{{$rec->ab_bldg_no}}', '{{$rec->artype}}','{{$rec->arcate}}','{{$rec->aruse}}','{{$rec->arlvel}}','{{$rec->aba_unitcount}}','{{$rec->aba_totsize}}','{{$rec->ceilingtype}}','{{$rec->floortype}}','{{$rec->walltype}}','{{$rec->aba_areadesc}}', '{{$rec->aba_ref}}', '{{$rec->aba_areatype_id}}','{{$rec->aba_areacategory_id}}','{{$rec->aba_arealevel_id}}', '{{$rec->aba_areazone_id}}', '{{$rec->aba_areause_id}}', '{{$rec->aba_areadesc}}',  '{{$rec->aba_dimention}}', '{{$rec->aba_unitcount}}', '{{$rec->aba_size}}','{{$rec->aba_sizeunit_id}}', '{{$rec->aba_totsize}}', '{{$rec->aba_floortype_id}}','{{$rec->aba_walltype_id}}','{{$rec->aba_ceilingtype_id}}','<span><a onclick="" class="action-icons c-edit edtbldgarrow" href="#" title="Edit">Edit</a></span>@if($iseditable == 1)<span><a onclick="" class="action-icons    deletebldgarrow" href="#" title="delete">Delete</a></span>@endif', 'noaction','{{$rec->aba_id}}' ] );
	    @endforeach
			var groupColumn = 4;
		 $('#bldgartable1').DataTable({
        	data:           blsgardata,
            "columns":[ null, { "visible": false }, { "visible": false }, null, null, null, null, null, null,null, null, null, null, { "visible": false }, { "visible": false }, { "visible": false}, { "visible": false}, { "visible": false }, { "visible": false}, { "visible": false }, { "visible": false }, { "visible": false}, { "visible": false }, { "visible": false}, { "visible": false }, { "visible": false }, { "visible": false }, { "visible": false }, null,{ "visible": false },{ "visible": false }],
            "sPaginationType": "full_numbers",
			"iDisplayLength": 100,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
        	"bAutoWidth": false,
        	"order": [[ groupColumn, 'asc' ]],
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>',
			"drawCallback": function ( settings ) {
	            var api = this.api();
	            var rows = api.rows( {page:'current'} ).nodes();
	            var last=null;
	 
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
				data[29]='delete';
				data[28]='';
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
			//console.log(tablear.row($(this).parents('tr')));
			//console.log(tablear.row($(this).parents('tr')).data());
			var bldgardata = {};
			//console.log(ldata);
			
			console.log(bldgcategotyid);
			var param ="tabBldgar";
			$.ajax({
				url: "childparam",
				cache: false,
				data:{param_value:bldgcategotyid,param:param},
				success: function(data){
		    		createDropDownOptions(data.res_arr, 'arlevel');
		    		createDropDownOptions(data.storey_arr, 'aruse');
					//console.log(data.storey_arr);
					//console.log(data.res_arr);
					$.each( ldata, function( key, value ) {
						bldgardata[bldgarmap.get(""+key+"")] = value;  
						           
		            });
		    
					$.each( bldgardata, function( key, val ) {				
		        		$('#'+key).val(val);
		        		if(key === 'bldgnum'){
		        			$('#bldgnumar').val(val);
		        			//alert(val);
						}

						//alert(key+" : "+val);
						console.log(key+" : "+val);
						
					});

				}
			});
			
        	$("#bldgardetail1").show();
			$("#addbldgar").hide();
			$("#bldgdetail").hide();
			$("#addbldg").hide();
			$("#bldgtable").hide();
			$("#bldgareatable1").hide();

			$('#propertyinspectionform-back-4').hide();
			$('#propertyinspectionform-next-4').hide();
			//addDisableTab();
							//$('#finish').hide();
            //console.log( table.row( $(this).parents('tr') ).index() );		
			//$('#lot_operation').val(2);
			 //$('#tableindex').val(table.row( $(this).parents('tr') ).index());  
			 //table.row( $(this).parents('tr') ).remove().draw();
			 $('#submitedittblbldgar').show();
			 $('#submitaddtblbldgar').hide();


		});
		var bldgartable1 = $('#bldgartable1').DataTable();
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
			blsgdata.push( [ '{{$loop->iteration}}', "<a class='shobldg' onclick='showBldgAr({{$rec->ab_id}})' href='#' >{{ $rec->ab_bldg_no}}<input type='hidden' value='{{ $rec->ab_bldgtype_id}}' id='bldgtype_{{$rec->ab_id}}'><input type='hidden' value='{{ $rec->bldgcategory_id}}' id='bldgcate_{{$rec->ab_id}}'><input type='hidden' value='{{ $rec->ab_bldg_no}}' id='{{$rec->ab_id}}'></a>", '{{$rec->ab_bldg_no}}','{{$rec->bldgcategory}} / {{$rec->bldgtype}}','{{$rec->bldgstorey}}','{{$rec->bldgstr}}','{{$rec->rootype}}','{{$rec->ab_bldgtype_id}}', '{{$rec->ab_bldgstorey_id}}', '{{$rec->ab_bldgcondn_id}}', '{{$rec->ab_bldgposition_id}}', '{{$rec->ab_bldgstructure_id}}', '{{$rec->ab_rooftype_id}}', '{{$rec->ab_walltype_id}}','{{$rec->ab_floortype_id}}',  '{{$rec->ab_cccdate1}}', '{{$rec->ab_occupieddate1}}','{{$rec->astatus}}','<span><a onclick="edit({{$rec->ab_id}})" class="action-icons c-edit edtbldgrow" href="#" title="Edit">Edit</a></span>@if($iseditable == 1)<span><a onclick="openbldgarea({{$rec->ab_id}})" class="action-icons c-add  addbldgarearow" href="#" title="Add Building Detail">Add</a></span><span><a class="action-icons1 c-copy  copybldgar" href="#" title="Copy Building Detail">Copy</a></span><span><a  class="action-icons1 c-paste  pastebldgar" href="#" title="Paste Building Detail">Paste</a></span><span><a onclick="" class="action-icons    deletebldgrow" href="#" title="delete">Delete</a></span>@endif','noation', '{{$rec->ab_id}}',account, '{{$rec->ab_ismainbldg_id}}']);
		@endforeach

	    $('#bldgtble').DataTable({
	        data:           blsgdata,
	        "columns":[ null, null, { "visible": false }, null, null, null, null,{ "visible": false },  { "visible": false }, { "visible": false }, { "visible": false}, { "visible": false}, { "visible": false }, { "visible": false}, { "visible": false}, null, null, null, null, { "visible": false }, { "visible": false }, { "visible": false }, { "visible": false }],
	        "sPaginationType": "full_numbers",
			"iDisplayLength": 100,
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
		var copybldgnumber = 0;
		$('#bldgtble tbody').on( 'click', '.copybldgar', function () {
				
			var ldata = table.row(table.row( $(this).parents('tr') ).index()).data();

			$.each( ldata, function( key, value ) {
				if(key == 2){
					copybldgnumber= value;
				}
	        });
	        if 	(copybldgnumber !== 0){
	        	alert('Building Area copied');
	        }
		});

		$('#bldgtble tbody').on( 'click', '.pastebldgar', function () {
			var pastebldgnumber = 0;
			var pastebldgid = 0;
			var actioncode = 0;
			var table = $('#bldgtble').DataTable();
			var index = table.row( $(this).parents('tr') ).index();
			var ldata = table.row(index).data();
			$.each( ldata, function( key, value ) {
				if(key == 2){
					pastebldgnumber= value;
				}	
						
				          
	        });
			if 	(copybldgnumber == 0){
				alert('Please copy building area.');
			} else if( copybldgnumber === pastebldgnumber){
				alert('Please paste in difference building.');
			} else {
				var noty_id = noty({
					layout : 'center',
					text: 'Are you want to paste building area?',
					modal : true,
					buttons: [
						{type: 'button pink', text: 'Paste', click: function($noty) {					  		
				        	console.log('copybldgnumber : '+copybldgnumber);
				        	console.log('pastebldgnumber : '+pastebldgnumber);
			       		 	var pastecount = bldgartable1.rows().count();
			        		console.log('pastecount : '+pastecount);
			        		for(var i=0;i<=pastecount;i++){
								var tempdata = $('#bldgartable1').DataTable().row(i).data();	
								if(tempdata[2]==copybldgnumber){
									var cpdata = $('#bldgartable1').DataTable().row(i).data();	
									if(cpdata[29] != 'delete') {
										cpdata[0]='New';
										cpdata[2]=pastebldgnumber;
										cpdata[29]='new';
										cpdata[30]='0';
										$('#bldgartable1').DataTable().row.add(cpdata).draw(false);
										console.log('i : '+i);
										cpdata = null; 
									}
								}
							}
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
			}
			
		});


		$('#bldgtble tbody').on( 'click', '.edtbldgrow', function () {
			//var editlotdata = JSON.stringify(table.row( $(this).parents('tr') ).data());
			var ldata = table.row(table.row( $(this).parents('tr') ).index()).data();
			$('#bldgtableindex').val(table.row( $(this).parents('tr') ).index());
			var bldgdata = {};
			


			$.each( ldata, function( key, value ) {
				bldgdata[bldgmap.get(""+key+"")] = value;              
	        });

	        $.each( bldgdata, function( key, val ) {
	        	$('#'+key).val(val);
			});

			var param_value = $('#bldgcate').val();
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

	    	$("#bldgdetail").show();
			$("#addbldg").hide();
			$("#bldgtable").hide();


			$('#propertyinspectionform-back-4').hide();
			$('#propertyinspectionform-next-4').hide();

			$('#finish').hide();
			//addDisableTab();
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

	function edit(id){
		$('#bldgcate').val($('#bldgcate_'+id).val());
	}

	function editbldgRow(){

		if(validateBldg()){

			$('#propertyinspectionform-back-4').show();
			$('#propertyinspectionform-next-4').show();
			$('#finish').show();
			//removeDisableTab();
			$('#submitedittblbldg').show();
			$('#submitaddtblbldg').hide();
			var table = $('#bldgtble').DataTable();
			var account = $('#accnumber').val();
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
			data=[operation,'<a class="shobldg" onclick="showBldgAr('+$('#bldgid').val()+')" href="#">'+updatebldgno+'</a><input type="hidden" value="'+$('#bldgttype').val()+'" id="bldgtype_'+$('#bldgid').val()+'"><input type="hidden" value="'+updatebldgno+'" id="'+$('#bldgid').val()+'">', updatebldgno, $('#bldgcate option:selected').text() +' / '+ $('#bldgttype option:selected').text(), $('#bldgstorey option:selected').text(), $('#bldgstructure option:selected').text(),$('#rooftype option:selected').text(), $('#bldgttype').val(), $('#bldgstorey').val(),  $('#bldgcond').val(), $('#bldgpos').val(), $('#bldgstructure').val(),$('#rooftype').val(), $('#walltype').val(), $('#floortype').val(),$('#cccdt').val(), $('#occupieddt').val(), $('#mbldg option:selected').text(), '<span><a onclick="" class="action-icons c-edit edtbldgrow" href="#" title="Edit">Edit</a></span><span><a onclick="openbldgarea('+$('#bldgid').val()+')" class="action-icons c-add  addbldgarearow" href="#" title="Add Building Detail">Add</a></span><span><a class="action-icons1 c-copy  copybldgar" href="#" title="Copy Building Detail">Copy</a></span><span><a  class="action-icons1 c-paste  pastebldgar" href="#" title="Paste Building Detail">Paste</a></span><span><a onclick="" class="action-icons    deletebldgrow" href="#" title="delete">Delete</a></span>',operation_code, $('#bldgid').val(), account, $('#mbldg').val() ];

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
				/*bldgtta.row.add(['New','<a class="shobldg" onclick="showBldgAr('+temp_id+')" href="#">'+updatebldgno+'</a><input type="hidden" value="'+$('#bldgttype').val()+'" id="bldgtype_'+$('#bldgid').val()+'"><input type="hidden" value="'+updatebldgno+'" id="'+$('#bldgid').val()+'">', updatebldgno,$('#bldgttype option:selected').text(), $('#bldgstorey option:selected').text(), $('#bldgstructure option:selected').text(),$('#rooftype option:selected').text(),  $('#bldgttype').val(), $('#bldgstorey').val(),  $('#bldgcond').val(), $('#bldgpos').val(), $('#bldgstructure').val(),$('#rooftype').val(), $('#walltype').val(), $('#floortype').val(),$('#cccdt').val(), $('#occupieddt').val(), $('#mainbldg').val(),'<span><a onclick="" class="action-icons c-edit edtbldgrow" href="#" title="Edit">Edit</a></span><span><a onclick="openbldgarea('+temp_id+')" class="action-icons c-add  addbldgarearow" href="#" title="Add Building Detail">Add</a></span>&nbsp;&nbsp;&nbsp;<span><a onclick="" class="action-icons    deletebldgrow" href="#" title="delete">Delete</a></span>', 'new', $('#bldgid').val(),account ]).draw(false);
			*/
				bldgtta.row.add(['New','<a class="shobldg" onclick="showBldgAr('+temp_id+')" href="#">'+updatebldgno+'</a><input type="hidden" value="'+$('#bldgttype').val()+'" id="bldgtype_'+$('#bldgid').val()+'"><input type="hidden" value="'+updatebldgno+'" id="'+$('#bldgid').val()+'">', updatebldgno,$('#bldgcate option:selected').text() +' / '+ $('#bldgttype option:selected').text(), $('#bldgstorey option:selected').text(), $('#bldgstructure option:selected').text(),$('#rooftype option:selected').text(),  $('#bldgttype').val(), $('#bldgstorey').val(),  $('#bldgcond').val(), $('#bldgpos').val(), $('#bldgstructure').val(),$('#rooftype').val(), $('#walltype').val(), $('#floortype').val(),$('#cccdt').val(), $('#occupieddt').val(), $('#mbldg option:selected').text(),'<span><a onclick="" class="action-icons c-edit edtbldgrow" href="#" title="Edit">Edit</a></span><span><a onclick="openbldgarea('+temp_id+')" class="action-icons c-add  addbldgarearow" href="#" title="Add Building Detail">Add</a></span><span><a class="action-icons1 c-copy  copybldgar" href="#" title="Copy Building Detail">Copy</a></span><span><a  class="action-icons1 c-paste  pastebldgar" href="#" title="Paste Building Detail">Paste</a></span><span><a onclick="" class="action-icons    deletebldgrow" href="#" title="delete">Delete</a></span>', 'new', $('#bldgid').val(),account, $('#mbldg').val()]).draw(false);
				
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
		
			$('#propertyinspectionform-back-4').hide();
			$('#propertyinspectionform-next-4').hide();
		$('#finish').hide();
		$("#bldgareatable1").hide();
		//addDisableTab();
		$("#bldgardetail1").show();
		$('#addbldgar').hide();
		$('#submitedittblbldgar').hide();
		$('#submitaddtblbldgar').show();
		$('#bldgar_operation').val(1);
		bldgcategotyid = $('#bldgtype_'+id).val();
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
		//$('#'+id).val();
		$('#bldgnumar').val($('#'+id).val());
		$("#addbldg").hide();
		$("#bldgtable").hide();
		$('#artype').val('');
		//$('#arlevel').val('');
		$('#arcate').val('');
		$('#arzone').val('');
		//$('#aruse').val('');
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

function addbldgarRow(){
	if(validateBldgDetail()){
		var operation = $("#lot_operation").val();
		//console.log(operation);
		var t = $('#bldgartable1').DataTable();
		var account = $('#accnumber').val();

									
		t.row.add(['New',$('#accnumber').val(), $('#bldgnumar').val(), $('#artype option:selected').text(), $('#arcate option:selected').text(),$('#aruse option:selected').text(),$('#arlevel  option:selected').text(), $('#arcnt').val(), $('#totsize').val(),$('#celingtype option:selected').text(), $('#fltype option:selected').text(), $('#dwalltype option:selected').text(), $('#ardesc').val(), $('#reffinfo').val(),  $('#artype').val(), $('#arcate').val(), $('#arlevel').val(),$('#arzone').val(), $('#aruse').val(), $('#ardesc').val(),$('#dimention').val(), $('#arcnt').val(), $('#size').val(),$('#uom').val(),$('#totsize').val(), $('#fltype').val(), $('#dwalltype').val(),$('#celingtype').val(), '<span><a onclick="" class="action-icons c-edit edtbldgarrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons   deletebldgarrow " href="#" title="delete">Delete</a></span>', 'new', $('#bldgid').val()]).draw(false);
			
		alert('Building detail added');
	}
}

function editbldgarRow() {
	if(validateBldgDetail()){	
		$('#submitedittblbldgar').hide();
		$('#submitaddtblbldgar').hide();
		var table = $('#bldgartable1').DataTable();
		var account = $('#accnumber').val();


			$('#propertyinspectionform-back-4').show();
			$('#propertyinspectionform-next-4').show();
					
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
	 
	    data=[operation,$('#accnumber').val(), $('#bldgnumar').val(), $('#artype option:selected').text(), $('#arcate option:selected').text(),$('#aruse option:selected').text(), $('#arlevel  option:selected').text(), $('#arcnt').val(), $('#totsize').val(),$('#celingtype option:selected').text(), $('#fltype option:selected').text(), $('#dwalltype option:selected').text(), $('#ardesc').val(), $('#reffinfo').val(),  $('#artype').val(), $('#arcate').val(), $('#arlevel').val(),$('#arzone').val(), $('#aruse').val(), $('#ardesc').val(),$('#dimention').val(), $('#arcnt').val(), $('#size').val(),$('#uom').val(), $('#totsize').val(), $('#fltype').val(), $('#dwalltype').val(), $('#celingtype').val(), '<span><a onclick="" class="action-icons c-edit edtbldgarrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons   deletebldgarrow " href="#" title="delete">Delete</a></span>', operation_code, $('#bldgarid').val()];

		row.data(data);
		$("#bldgardetail1").hide();
		$("#bldgareatable1").show();
		//removeDisableTab();
		$("#addbldgar").show();
		$("#bldgdetail").hide();
		$("#addbldg").show();
		$("#bldgtable").show();
	 	$("label.error").remove();
	 }

}
	
	function closebldgar(){

			$('#propertyinspectionform-back-4').show();
			$('#propertyinspectionform-next-4').show();
		$('#finish').show();
		//removeDisableTab();
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
		//alert($('#bldgtype_'+id).val());
		bldgcategotyid = $('#bldgtype_'+id).val();

		var param ="tabBldgar";
		$.ajax({
			url: "childparam",
			cache: false,
			data:{param_value:bldgcategotyid,param:param},
			success: function(data){
	    		createDropDownOptions(data.res_arr, 'arlevel');
	    		createDropDownOptions(data.storey_arr, 'aruse');
				//console.log(data.storey_arr);
				//console.log(data.res_arr);
			}
		});
		
		let bldgarmap = new Map([["0","sno"],["1", "bldgaccnum"],  ["2", "bldgnum"], ["3", "bldgnum2"], ["4", "bldgnum4"], ["5", "bldgnum5"], ["6", "bldgnum7"], ["7", "bldgnu8m"], ["8", "bldgnu2m"], ["9", "bldgnum7"], ["10", "bldgnu8m"], ["11", "bldgnu2m"], ["12", "bldgnu80m"],["13", "reffinfo"], ["14", "artype"],["15", "arcate"], ["16", "arlevel"],["17", "arzone"], ["18", "aruse"],["19", "ardesc"], ["20", "dimention"],["21", "arcnt"],["22", "size"],["23", "uom"],["24", "totsize"],["25", "fltype"],["26","dwalltype"],["27", "celingtype"],["28", "action"],["29","actioncode"],["30","bldgarid"]]);

		//window.alert = function() {};
		var bldgno = $('#'+id).val();
		$('#disbldgno').html(bldgno);
		var tablear = $('#bldgartable1').DataTable();
		$.fn.dataTable.ext.search.pop();
    	//tablear.draw();
		//alert(bldgno);

		
	$.fn.dataTable.ext.search.push(
	     function(settings, data, dataIndex) {
	     	//alert(settings.nTable.id);
			if (settings.nTable.id === 'bldgartable1') {
			    if (data[2] === bldgno){

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

			$('#propertyinspectionform-back-4').show();
			$('#propertyinspectionform-next-4').show();
		//removeDisableTab();
		$("#addbldg").show();
		$("#bldgtable").show();
		$("#bldgareatable").hide();
		$("#bldgardetail").hide();							
	}

	function openbldg(){
		$("#bldgareatable").hide();

			$('#propertyinspectionform-back-4').hide();
			$('#propertyinspectionform-next-4').hide();


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

		//addDisableTab();
		$('#finish').hide();
		$('#submitedittblbldg').hide();
		$("#bldgareatable1").hide();
		$('#submitaddtblbldg').show();
		//$("#bldg_operation").val(1);
		$('#floortype').val('');
		$('#bldgcate').val('');
		$('#mainbldg').val('');
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

			$('#propertyinspectionform-back-4').show();
			$('#propertyinspectionform-next-4').show();
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
							