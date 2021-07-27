	            
								@if($iseditable == 1)
								<button onclick="openlot()" id="addlot" name="btnadduser" type="button" class="btn_small btn_blue"><span>{{__('inspection.Add_Lot')}}</span></button>
								@endif
								<div id="lottable" class="widget_wrap">

									<div class="widget_content">						
										<table style="width:100%" id="lottble" class="display ">
										<thead style="text-align: left;">
								  		<tr>
											<th class="table_sno">{{__('inspection.SNo')}}</th>
											<th>{{__('inspection.State')}} </th>
											<th>{{__('inspection.District')}} </th>
											<th>{{__('inspection.City')}} </th>
											<th>{{__('inspection.Presint')}} </th>
											<th>{{__('inspection.Lot_Type')}} </th>
											<th>{{__('inspection.Lot_Number')}} </th>
											<th>{{__('inspection.Alternative_Lot_Number')}} </th>
											<th>{{__('inspection.Lot_Title_Type')}} </th>
											<th>{{__('inspection.Lot_Title_Number')}} </th>
											<th>{{__('inspection.Alternative_Title_Number')}} </th>
											<th>{{__('inspection.Land_Area')}} </th>
											<th>{{__('inspection.Land_Area_Unit')}} </th>
											<th>{{__('inspection.Land_Condition')}} </th>
											<th>{{__('inspection.Land_Posision')}} </th>
											<th>{{__('inspection.Road_Type')}} </th>
											<th>{{__('inspection.Road_Category')}} </th>
											<th>{{__('inspection.Land_Use')}} </th>
											<th>{{__('inspection.Express_Condition')}} </th>
											<th>{{__('inspection.Restriction_Of_Interest')}} </th>
											<th>{{__('inspection.Tenure_Type')}} </th>
											<th>{{__('inspection.Tenure_Period')}} </th>
											<th>{{__('inspection.Tenure_Start_Date')}} </th>
											<th>{{__('inspection.Tenure_End_Date')}} </th>
											<th>{{__('inspection.Is_Active')}} </th>
											<th>{{__('inspection.Action')}} </th>
											<th>{{__('inspection.Actioncode')}} </th>
											<th>{{__('inspection.Lot_Id')}} </th>
											<th>{{__('inspection.Lot_Number')}} </th>
											<th>{{__('inspection.Alt_Lot_Number')}} </th>
											<th>{{__('inspection.Title_Number')}} </th>
											<th>{{__('inspection.Land_Area')}} </th>
											<th>{{__('inspection.Land_Used')}} </th>
											<th>{{__('inspection.Tenure_Type')}} </th>
											<th>{{__('inspection.Action')}} </th>
											<th>{{__('inspection.Accnum')}} </th>
										</tr>
										</thead>
										<tbody>										
										</tbody>
										</table>
									</div>
								</div>
								<div style="display:none;" id="lotdetail" >
								
								<div style="height: 48px; display: -webkit-box;text-align: -webkit-right;" class="grid_12">
									<button id="submitaddtbllot" onclick="addlotRow()" style="display:none" name="adduser" type="button" class="btn_small btn_blue"><span>{{__('common.Add_New')}} Add New</span></button>	
									<button id="submitedittbllot" onclick="editlotRow()" style="display:none" name="adduser" type="button" class="btn_small btn_blue"><span>{{__('common.Update')}} </span></button>	
								<button id="close" onclick="closelot()" name="close" type="button" class="btn_small btn_blue"><span>{{__('common.Close')}} </span></button>
								</div>
									<div  class="grid_6">
									<ul>
									<li>
										<input type="hidden" value="0" name="operation" id="lot_operation">
										<input type="hidden" value="0" name="master_id" id="lot_master_id">
										<input type="hidden" value="0" name="lot_id" id="lot_id">
										<input type="hidden" value="0" name="lotaccnum" id="lotaccnum">
										
									<input type="hidden" value="0" name="lottableindex" id="lottableindex">
										<fieldset>
										<legend>{{__('inspection.Lot_Information')}} </legend>
									<div class="form_grid_12">
										<label class="field_title" id="lusername" for="username">{{__('inspection.Lot_Type')}}<span class="req">*</span></label>
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
										<label class="field_title" id="lposition" for="position">{{__('inspection.Lot_Number')}} <span class="req">*</span></label>
										<div  class="form_input">
											<input id="lotnum" tabindex="2" name="lotnum" type="text" value=""  class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
									
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('inspection.Alternative_Lot_Number')}} </label>
										<div  class="form_input">
											<input id="altlotnum" tabindex="3" name="altlotnum" type="text" value=""  class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('inspection.Lot_Title_Type')}} <span class="req">*</span></label>
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
										<label class="field_title" id="llevel" for="level">{{__('inspection.Lot_Title_Number')}} </label>
										<div  class="form_input">
											<input id="ltnum" name="ltnum" tabindex="5" type="text" value=""  class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('inspection.Alternative_Title_Number')}} </label>
										<div  class="form_input">
											<input id="altnum" name="altnum" tabindex="6" type="text" value=""  class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('inspection.Strata_Number')}} </label>
										<div  class="form_input">
											<input id="lostratano" name="lostratano" tabindex="6" type="text"  class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
								</fieldset>
									<fieldset>
										<legend>{{__('inspection.Address_Information')}} </legend>
									<div class="form_grid_12">
										<label class="field_title" id="lusername" for="username">{{__('inspection.State')}} <span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="lotstate" tabindex="7" name="lotstate" tabindex="20">
												<option></option>
											@foreach ($state as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lusername" for="username">{{__('inspection.District')}} <span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="lotdistrict" tabindex="8" name="lotdistrict" tabindex="20">
												<option></option>
											@foreach ($district as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div style="display: none;" class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('inspection.City')}} <span class="req">*</span></label>
										<div  class="form_input">
											<input id="lotcity" name="lotcity" tabindex="9" type="text" value="" maxlength="50" class="large"/>
										</div>
										<span class=" label_intro"></span>
									</div>
									</fieldset>
								</div>
								<div class="grid_6">
									
									<ul>
									<li>
									<fieldset>
										<legend>{{__('inspection.SNo')}} Other Information</legend>										
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('inspection.Land_Area')}} <span class="req">*</span></label>
										<div  class="form_input">
											<input id="landar" name="landar" tabindex="10" onKeyDown="if(this.value.length==15 && event.keyCode>47 && event.keyCode < 58) return false;" type="number" value="" maxlength="15" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('inspection.Land_Area_Unit')}} <span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="landaruni" tabindex="11" name="landaruni" tabindex="20">
												<option></option>
											@foreach ($unitsize as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('inspection.Land_Condition')}} <span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="landcon" tabindex="12" name="landcon" tabindex="20">
												<option></option>
											@foreach ($landcond as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('inspection.Land_Position')}} <span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="lanpos" tabindex="13" name="lanpos" tabindex="20">
												<option></option>
											@foreach ($landpos as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('inspection.Road_Type')}} <span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="roadtype" tabindex="14" name="roadtype" tabindex="20">
												<option></option>
											@foreach ($roadtype as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('inspection.Road_Category')}} <span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="roadcate" tabindex="15" name="roadcate" tabindex="20">
												<option></option>
											@foreach ($roadcaty as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('inspection.Land_Use')}} <span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="landuse" tabindex="16" name="landuse" tabindex="20">
												<option></option>
											@foreach ($landuse as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('inspection.Express_Condition')}} </label>
										<div  class="form_iput">
										<input id="expcon"  name="expcon" tabindex="17" class="" type="text"  maxlength="50" />
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('inspection.Restriction_Of_Interest')}} </label>
										<div  class="form_input">
										<input id="interest"  name="interest" tabindex="18" class="" type="text"  maxlength="50" />
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('inspection.Tenure_Type')}} <span class="req">*</span></label>
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
										<label class="field_title" id="llevel" for="level">{{__('inspection.Tenure_Period')}} <span class="req">*</span></label>
										<div  class="form_input">
											<input id="tenduration" tabindex="20" step="0" name="tenduration" class="" type="number" value="0" maxlength="3" onKeyDown="if(this.value.length==3 && event.keyCode>47 && event.keyCode < 58) return false;" class="large"/>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('inspection.Tenure_Start_Date')}} <span class="req">*</span></label>
										<div  class="form_input">
										<!--<input id="tenstart"  name="tenstart" tabindex="21" class="" type="date"  maxlength="50" />-->
										<input type="text" id="tenstart" dateFormat='dd/mm/yyyy' name="tenstart" tabindex="21">
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('inspection.Tenure_End_Date')}} <span class="req">*</span></label>
										<div  class="form_input">
										<input id="tenend"  name="tenend" class="" type="text"  maxlength="50" />
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('inspection.Indicator_For_Land_Is_Active')}} <span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="status" tabindex="22" name="status" tabindex="20">	
												<option></option>								
											@foreach ($status as $rec)
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
											

					<script type="text/javascript">

						 $(document).ready(function() {
						 	$( "#tenstart" ).datepicker({dateFormat: 'dd/mm/yy'});
						 	$( "#tenend" ).datepicker({dateFormat: 'dd/mm/yy'});
						 	var account = $('#accnumber').val();
			
			let lotmap = new Map([["0","sno"],["1", "lotstate"], ["2", "lotdistrict"], ["3", "lotcity"],["4", "presint"], ["5", "lotype"],["6", "lotnum"], ["7", "altlotnum"],["8", "lttt"], ["9", "ltnum"],["10", "altnum"], ["11", "landar"],["12", "landaruni"],["13", "landcon"], ["14", "lanpos"],["15", "roadtype"], ["16", "roadcate"],["17", "landuse"], ["18", "expcon"],["19", "interest"], ["20", "tentype"],["21", "tenduration"], ["22", "tenstart"],["23", "tenend"], ["24", "status"],["25", "action"],["26", "actioncode"],["27", "lot_id"],["28", "lotaccnum1"],["29", "lotaccnum2"],["30", "lotaccnum3"],["31", "lotaccnum4"],["32", "lotaccnum5"],["33", "lotaccnum6"],["34", "lotaccnum7"],["35", "lotaccnum"],["36", "lostratano"]]);
 		var lotdata = [];
		 		@foreach ($lotlist as $rec)
		 			lotdata.push( [ '{{$loop->iteration}}', '{{$rec->al_state}}', '{{$rec->al_district}}', '', '', '{{$rec->al_lotcode_id}}', '{{$rec->al_no}}', '{{$rec->al_altno}}', '{{$rec->al_titletype_id}}', '{{$rec->al_titleno}}', '{{$rec->al_alttitleno}}', '{{$rec->al_size}}', '{{$rec->al_sizeunit_id}}', '{{$rec->al_landcondition_id}}', '{{$rec->al_landposision_id}}', '{{$rec->al_roadtype_id}}', '{{$rec->al_roadcategory_id}}', '{{$rec->al_landuse_id}}', '{{$rec->al_excd}}', '{{$rec->al_rtit}}', '{{$rec->al_tenuretype_id}}', '{{$rec->al_tenureperiod}}', '{{$rec->al_startdate1}}', '{{$rec->al_expireddate1}}' ,'{{$rec->al_activeind_id}}','','noation', '{{$rec->al_id}}' ,'{{$rec->lotnumber}}','{{$rec->al_altno}}','{{$rec->titlenumber}}','{{$rec->al_size}}','{{$rec->landuse}}','{{$rec->tentype}}',
		 				'<span><a onclick="" class="action-icons c-edit edtlotrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class="action-icons  dellotrow deletelotrow" href="#" title="delete">Delete</a></span>',account, '{{$rec->al_stratano}}' ] );
		 		@endforeach

        $('#lottble').DataTable({
            data:           lotdata,
            "columns":[ null, { "visible": false}, { "visible": false}, { "visible": false }, { "visible": false }, { "visible": false}, { "visible": false}, { "visible": false }, { "visible": false}, { "visible": false}, { "visible": false }, { "visible": false}, { "visible": false}, { "visible": false }, { "visible": false }, { "visible": false }, { "visible": false }, { "visible": false}, { "visible": false }, { "visible": false }, { "visible": false}, { "visible": false }, { "visible": false }, { "visible": false } ,{ "visible": false},{ "visible": false}, { "visible": false } , { "visible": false } ,null, null,null,null,null,null,null,{ "visible": false},{ "visible": false}],
            "sPaginationType": "full_numbers",
			"iDisplayLength": 5,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			 
		});
		$("div.table_top select").addClass('tbl_length');
		$(".tbl_length").chosen({
			disable_search_threshold: 4	
		});

        var table = $('#lottble').DataTable();

		$('#lottble tbody').on( 'click', '.deletelotrow', function () {

			var row = table.row(table.row( $(this).parents('tr') ).index()),
			    data = row.data();
			    data[0]='Deleted';
				data[26]='delete';
				data[34]='';
				data[34]='0';
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

		/*$('#lottble tbody').on( 'click', '.dellotrow', function () {
		    var child = table.row( $(this).parents('tr') ).child;
		 
		    if ( child.isShown() ) {
		        child.hide();
		    }
		    else {
		        child.show();
		    }
		});*/


		$('#lottble tbody').on( 'click', '.edtlotrow', function () {
			//var editlotdata = JSON.stringify(table.row( $(this).parents('tr') ).data());
			var ldata = table.row( table.row( $(this).parents('tr') ).index()).data();
			$('#lottableindex').val(table.row( $(this).parents('tr') ).index());
			var lotdata = {};
			
			$.each( ldata, function( key, value ) {
				lotdata[lotmap.get(""+key+"")] = value;              
            });

            $.each( lotdata, function( key, val ) {
            	$('#'+key).val(val);
			});

			$('#propertyinspectionform-back-2').hide();
			$('#propertyinspectionform-next-2').hide();

        	$("#lotdetail").show();
			$("#addlot").hide();
			$("#lottable").hide();
			$('#submitedittbllot').show();
			$('#submitaddtbllot').hide();
		});

});

function openlot() {
	$('#submitedittbllot').hide();
	$('#submitaddtbllot').show();
	//addDisableTab();
			$('#propertyinspectionform-back-2').hide();
			$('#propertyinspectionform-next-2').hide();
	$("#lot_operation").val(1);
	$("#lotaccnum").val($('#accnumber').val());
	$("#lotdetail").val();
	$("#lotdetail").show();
	$("#lottable").hide();
	$("#addlot").hide();
	$("#lotsubmit").html("Save");
 	$("label.error").remove();	
}

function editlotRow(){

	if (validateLot()){
		var account = $('#accnumber').val();
		$('#submitedittbllot').show();
			$('#submitaddtbllot').hide();
			var table = $('#lottble').DataTable();
			
			var row = table.row($('#lottableindex').val());
			var lotdata = table.row($('#lottableindex').val()).data();
			var recordtype = lotdata[0];
			var operation = "Updated";
			var operation_code = "update";
			if (recordtype==='New'){
				operation = "New";
				operation_code = "new";
			}
	    data=[operation,$('#lotstate').val(), $('#lotdistrict').val(), $('#lotcity').val(), '', $('#lotype').val(), $('#lotnum').val(), $('#altlotnum').val(),$('#lttt').val(), $('#ltnum').val(), $('#altnum').val(),$('#landar').val(), $('#landaruni').val(), $('#landcon').val(), $('#lanpos').val(), $('#roadtype').val(), $('#roadcate').val(),$('#landuse').val(), $('#expcon').val(), $('#interest').val(), $('#tentype').val(), $('#tenduration').val(),$('#tenstart').val(), $('#tenend').val(),$('#status').val(), '',operation_code, $('#lot_id').val(),  $('#lotype option:selected').text()+$('#lotnum').val(),$('#altlotnum').val(),$('#lttt option:selected').text()+$('#ltnum').val(),$('#landar').val(), $('#landuse option:selected').text(),  $('#tentype option:selected').text(),  '<span><a onclick="" class="action-icons c-edit edtlotrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons  deletelotrow dellotrow" href="#" title="delete">Delete</a></span>',account, $('#lostratano').val() ];



			$('#propertyinspectionform-back-2').show();
			$('#propertyinspectionform-next-2').show();
		row.data(data);
			$("#lotdetail").hide();
		$("#lottable").show();
		$("#addlot").show();
		$('#propertystatus').val('');
		//emoveDisableTab();
	}
}


function addlotRow(){

	if (validateLot()){
		
			//$('#propertyinspectionform-back-2').show();
			//$('#propertyinspectionform-next-2').show();
	//	$('#submitedittbllot').hide();
	//		$('#submitaddtbllot').show();
		var operation = $("#lot_operation").val();
		var account = $('#accnumber').val();
		//console.log(operation);
		var t = $('#lottble').DataTable();
									
		t.row.add([ 'New',$('#lotstate').val(), $('#lotdistrict').val(), $('#lotcity').val(), '', $('#lotype').val(), $('#lotnum').val(), $('#altlotnum').val(),$('#lttt').val(), $('#ltnum').val(), $('#altnum').val(),$('#landar').val(), $('#landaruni').val(), $('#landcon').val(), $('#lanpos').val(), $('#roadtype').val(), $('#roadcate').val(),$('#landuse').val(), $('#expcon').val(), $('#interest').val(), $('#tentype').val(), $('#tenduration').val(),$('#tenstart').val(), $('#tenend').val(),$('#status').val(), '','new', $('#lot_id').val(), $('#lotype option:selected').text()+$('#lotnum').val(),$('#altlotnum').val(),$('#lttt option:selected').text()+$('#ltnum').val(),$('#landar').val(), $('#landuse option:selected').text(),  $('#tentype option:selected').text(), '<span><a onclick="" class="action-icons c-edit edtlotrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons  deletelotrow dellotrow" href="#" title="delete">Delete</a></span>',account, $('#lostratano').val()  ]).draw( false );

		/*$("#lotdetail").hide();
		$("#lottable").show();
		$("#addlot").show();*/
		alert('Record is successfully added');
		$('#propertystatus').val('');
	}

}

						function editlot(id){
							$("#lot_operation").val(2);				
							$('#lot_id').val(id);		
							$("#lotaccnum").val($('#accnumber').val());
							$('#lot_masterid').val($('#masterid'+id).val());
							$('#lotstate').val($('#state'+id).val());
							$('#lotdistrict').val($('#dirtict'+id).val());
							$('#lotcity').val($('#city'+id).val());
							$('#lotype').val($('#loid'+id).val());
							$('#lotnum').val($('#lono'+id).val());
							$('#altlotnum').val($('#loalno'+id).val());
							$('#lttt').val($('#titletypeid'+id).val());
							$('#ltnum').val($('#titleno'+id).val());
							$('#altnum').val($('#altitleno'+id).val());
							$('#landar').val($('#size'+id).val());
							$('#landaruni').val($('#sizeunit'+id).val());
							$('#landcon').val($('#landcondition'+id).val());
							$('#lanpos').val($('#landpos'+id).val());
							$('#roadtype').val($('#landrd'+id).val());
							$('#roadcate').val($('#landcaty'+id).val());
							$('#landuse').val($('#landuse'+id).val());
							//$('#').val($('#lanex'+id).val());
							//$('#').val($('#landrt'+id).val());
							$('#tentype').val($('#tnttype'+id).val());
							$('#tenduration').val($('#tnttime'+id).val());
							//$('#').val($('#sdate'+id).val());
							//$('#').val($('#edate'+id).val());
							$('#status').val($('#status'+id).val());	
							$("#lotdetail").show();
							$("#addlot").hide();
							$("#lottable").hide();
							$("#lotsubmit").html("update");
						}

						function closelot(){	

							//removeDisableTab();
			$('#propertyinspectionform-back-2').show();
			$('#propertyinspectionform-next-2').show();					
							$('#lotstate').val('');
							$('#lotdistrict').val('');
							$('#lotype').val('');
							//$('#lotnum').val($('#city'+id).val());
							$('#lotype').val('');
							$('#lotnum').val('');
							$('#altlotnum').val('');
							$('#lttt').val('');
							$('#ltnum').val('');
							$('#altnum').val('');
							$('#landar').val('');
							$('#landaruni').val('');
							$('#landcon').val('');
							$('#lanpos').val('');
							$('#roadtype').val('');
							$('#roadcate').val('');
							$('#landuse').val('');
							//$('#').val($('#lanex'+id).val());
							//$('#').val($('#landrt'+id).val());
							$('#tentype').val('');
							$('#tenduration').val('');
							//$('#').val($('#sdate'+id).val());
							//$('#').val($('#edate'+id).val());
							$('#status').val('');
							$("#lottable").show();
							$("#addlot").show();
							$("#lotdetail").hide();
						 	$("label.error").remove();	


						}

						function lotsubmit(){
							
							$('#lotform').validate({
									  rules: {
									    'lotnum': 'required'
									  },
									  messages: {
									    'lotnum': 'This field is required'
									   },
									  submitHandler: function(form) {
									    //form.submit();
									    	var lotdata = {};
											$('#lotform').serializeArray().map(function(x){lotdata[x.name] = x.value;});
											//console.log(masterdata);
											var lotjson = JSON.stringify(lotdata);
											var pb = '{{$pb}}';
											var tentype = $('#tentype').val();
											var tenduration = $('#tenduration').val();
											var tenstart = $('#tenstart').val();
											var tenend = $('#tenend').val();
											var valid = false;
											//console.log(tentype);
											if (tentype === '1') {
												if(tenduration !== '' && tenstart !== '' && tenend !== '' ){
													valid = true;
												}
											} else {
												valid = true;
											}
											if (valid){
												 $('#submitlot').text('Please Wait');
											$.ajax({
										        type:'POST',
										        url:'registerproperty',
											    headers: {
												    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
												},
										        data:{form:'lot',type:'tab',jsondata:lotjson,pb:pb},
										        success:function(data){	  
				        							$('#submitlot').text('Submit');      
										        	var noty_id = noty({
														layout : 'top',
														text: 'Lot detail added successfully!',
														modal : true,
														type : 'success', 
													});
										        	
										        },
										        error:function(data){	 
				        							$('#submitlot').text('Submit');         	
										        	var noty_id = noty({
														layout : 'top',
														text: 'Problem while adding lot detail!',
														modal : true,
														type : 'error', 
													});
										        }
											});
											} else {
												alert('Please select tenent startdate');
											}

									  	}
									});
    		
						}
					</script>