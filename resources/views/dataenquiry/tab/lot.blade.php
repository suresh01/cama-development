	            
								@if($iseditable == 1)
								<button onclick="openlot()" id="addlot" name="btnadduser" type="button" class="btn_small btn_blue"><span>Add Lot</span></button>
								@endif
								<div id="lottable" class="widget_wrap">

									<div class="widget_content">						
										<table style="width:100%" id="lottble" class="display ">
										<thead style="text-align: left;">
								  		<tr>
											<th class="table_sno">{{__('tab.S_No')}}</th>
											
											<th>{{__('tab.STATE')}}</th>
											<th>{{__('tab.DISCTRICT')}}</th>
											<th>{{__('tab.CITY')}}</th>
											<th>{{__('tab.PRESINT')}}</th>
											<th>{{__('tab.LOT_TYPE')}}</th>
											<th>{{__('tab.LOT_NUMBER')}}</th>
											<th>{{__('tab.ALTERNATIF_LOT_NUMBER')}}</th>
											<th>{{__('tab.LOT_TITLE_TYPE')}}</th>
											<th>{{__('tab.LOT_TITLE_NUMBER')}}</th>
											<th>{{__('tab.ALTERNATIF_TITLE_NUMBER')}}</th>
											<th>{{__('tab.LAND_AREA')}}</th>
											<th>{{__('tab.LAND_AREA_UNILAND_AREAT')}}</th>
											<th>{{__('tab.LAND_CONDITION')}}</th>
											<th>{{__('tab.LAND_POSISION')}}</th>
											<th>{{__('tab.ROAD_TYPE')}}</th>
											<th>{{__('tab.ROAD_CATEGORY')}}</th>
											<th>{{__('tab.LAND_USE')}}</th>
											<th>{{__('tab.Express_Condition')}}</th>
											<th>{{__('tab.Restriction_of_interest')}}</th>
											<th>{{__('tab.TENURE_TYPE')}}</th>
											<th>{{__('tab.TENURE_PERIOD')}}</th>
											<th>{{__('tab.TENURE_START_DATE')}}</th>
											<th>{{__('tab.TENURE_END_DATE')}}</th>
											<th>{{__('tab.IS_ACTIVE')}}</th>
											<th>{{__('tab.Action')}}</th>
											<th>{{__('tab.Actioncode')}}</th>
											<th>{{__('tab.lot_id')}}</th>
											<th>{{__('datasearch.lotcol1')}}</th>
											<th>{{__('datasearch.lotcol2')}}</th>
											<th>{{__('datasearch.lotcol3')}}</th>
											<th>{{__('datasearch.lotcol4')}} </th>
											<th>{{__('datasearch.lotcol5')}}</th>
											<th>{{__('datasearch.lotcol6')}}</th>
											<th>{{__('datasearch.lotcol7')}}</th>
											<th>{{__('tab.accnum')}}</th>
										</tr>
										</thead>
										<tbody>										
										</tbody>
										</table>
									</div>
								</div>
								<div style="display:none;" id="lotdetail" >
								
								<div style="height: 48px; display: -webkit-box;text-align: -webkit-right;" class="grid_12">
									
								<button id="close" onclick="closelot()" name="close" type="button" class="btn_small btn_blue"><span>{{__('datasearch.close')}}</span></button>
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
										<legend>{{__('tab.Lot_Information')}}</legend>
									<div class="form_grid_12">
										<label class="field_title" id="lusername" for="username">{{__('datasearch.lotype')}}<span class="req">*</span></label>
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
										<label class="field_title" id="lposition" for="position">{{__('datasearch.lotnum')}}<span class="req">*</span></label>
										<div  class="form_input">
											<input id="lotnum" tabindex="2" name="lotnum" type="text" value="" maxlength="15" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
									
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('datasearch.allotnum')}}</label>
										<div  class="form_input">
											<input id="altlotnum" tabindex="3" name="altlotnum" type="text" value="" maxlength="15" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('datasearch.lottitle')}}<span class="req">*</span></label>
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
										<label class="field_title" id="llevel" for="level">{{__('datasearch.lottittleno')}}</label>
										<div  class="form_input">
											<input id="ltnum" name="ltnum" tabindex="5" type="text" value="" maxlength="8" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('datasearch.altittleno')}}</label>
										<div  class="form_input">
											<input id="altnum" name="altnum" tabindex="6" type="text" value="" maxlength="8" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
								</fieldset>
									<fieldset>
										<legend>Address Information</legend>
									<div class="form_grid_12">
										<label class="field_title" id="lusername" for="username">{{__('datasearch.state')}}<span class="req">*</span></label>
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
										<label class="field_title" id="lusername" for="username">{{__('datasearch.district')}}<span class="req">*</span></label>
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
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('datasearch.city')}}<span class="req">*</span></label>
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
										<legend>{{__('datasearch.otherinfo')}}</legend>										
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('datasearch.landarea')}}<span class="req">*</span></label>
										<div  class="form_input">
											<input id="landar" name="landar" tabindex="10" onKeyDown="if(this.value.length==15 && event.keyCode>47 && event.keyCode < 58) return false;" type="number" value="" maxlength="15" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('datasearch.landunit')}}<span class="req">*</span></label>
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
										<label class="field_title" id="lposition" for="position">{{__('datasearch.cond')}}<span class="req">*</span></label>
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
										<label class="field_title" id="lposition" for="position">{{__('datasearch.pos')}}<span class="req">*</span></label>
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
										<label class="field_title" id="lposition" for="position">{{__('datasearch.road')}}<span class="req">*</span></label>
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
										<label class="field_title" id="lposition" for="position">{{__('datasearch.rcategory')}}<span class="req">*</span></label>
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
										<label class="field_title" id="llevel" for="level">{{__('datasearch.landuse')}}<span class="req">*</span></label>
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
										<label class="field_title" id="llevel" for="level">{{__('datasearch.expressioncond')}}<span class="req">*</span></label>
										<div  class="form_input">
										<input id="expcon"  name="expcon" tabindex="17" class="" type="text"  maxlength="50" />
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('datasearch.restiction')}}<span class="req">*</span></label>
										<div  class="form_input">
										<input id="interest"  name="interest" tabindex="18" class="" type="text"  maxlength="50" />
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('datasearch.tenuretype')}}<span class="req">*</span></label>
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
										<label class="field_title" id="llevel" for="level">{{__('datasearch.tenureperiod')}}<span class="req">*</span></label>
										<div  class="form_input">
											<input id="tenduration" tabindex="20" step="0" name="tenduration" class="" type="number" value="0" maxlength="3" onKeyDown="if(this.value.length==3 && event.keyCode>47 && event.keyCode < 58) return false;" class="large"/>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('datasearch.tenurestart')}}<span class="req">*</span></label>
										<div  class="form_input">
										<!--<input id="tenstart"  name="tenstart" tabindex="21" class="" type="date"  maxlength="50" />-->
										<input type="text" id="tenstart" dateFormat='dd/mm/yyyy' name="tenstart" tabindex="21">
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('datasearch.tenureend')}}<span class="req">*</span></label>
										<div  class="form_input">
										<input id="tenend"  name="tenend" class="" type="text"  maxlength="50" />
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('datasearch.lotstatus')}}<span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="status" tabindex="22" name="status" tabindex="20">	
												<option></option>										
												<option value='1'>Y</option>
												<option value='2'>N</option>											
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
			
			let lotmap = new Map([["0","sno"],["1", "lotstate"], ["2", "lotdistrict"], ["3", "lotcity"],["4", "presint"], ["5", "lotype"],["6", "lotnum"], ["7", "altlotnum"],["8", "lttt"], ["9", "ltnum"],["10", "altnum"], ["11", "landar"],["12", "landaruni"],["13", "landcon"], ["14", "lanpos"],["15", "roadtype"], ["16", "roadcate"],["17", "landuse"], ["18", "expcon"],["19", "interest"], ["20", "tentype"],["21", "tenduration"], ["22", "tenstart"],["23", "tenend"], ["24", "status"],["25", "action"],["26", "actioncode"],["27", "lot_id"],["28", "lotaccnum1"],["29", "lotaccnum2"],["30", "lotaccnum3"],["31", "lotaccnum4"],["32", "lotaccnum5"],["33", "lotaccnum6"],["34", "lotaccnum7"],["35", "lotaccnum"]]);
 		var lotdata = [];
		 		@foreach ($lotlist as $rec)
		 			lotdata.push( [ '{{$loop->iteration}}', '{{$rec->al_state}}', '{{$rec->al_district}}', '', '', '{{$rec->al_lotcode_id}}', '{{$rec->al_no}}', '{{$rec->al_altno}}', '{{$rec->al_titletype_id}}', '{{$rec->al_titleno}}', '{{$rec->al_alttitleno}}', '{{$rec->al_size}}', '{{$rec->al_sizeunit_id}}', '{{$rec->al_landcondition_id}}', '{{$rec->al_landposision_id}}', '{{$rec->al_roadtype_id}}', '{{$rec->al_roadcategory_id}}', '{{$rec->al_landuse_id}}', '{{$rec->al_excd}}', '{{$rec->al_rtit}}', '{{$rec->al_tenuretype_id}}', '{{$rec->al_tenureperiod}}', '{{$rec->al_startdate1}}', '{{$rec->al_expireddate1}}' ,'{{$rec->al_activeind_id}}','','noation', '{{$rec->al_id}}' ,'{{$rec->lotnumber}}','{{$rec->al_altno}}','{{$rec->titlenumber}}','{{$rec->al_size}}','{{$rec->landuse}}','{{$rec->tentype}}',
		 				'<span><a onclick="" class="action-icons c-edit edtlotrow" href="#" title="Edit">Edit</a></span>',account ] );
		 		@endforeach

        $('#lottble').DataTable({
            data:           lotdata,
            "columns":[ null, { "visible": false}, { "visible": false}, { "visible": false }, { "visible": false }, { "visible": false}, { "visible": false}, { "visible": false }, { "visible": false}, { "visible": false}, { "visible": false }, { "visible": false}, { "visible": false}, { "visible": false }, { "visible": false }, { "visible": false }, { "visible": false }, { "visible": false}, { "visible": false }, { "visible": false }, { "visible": false}, { "visible": false }, { "visible": false }, { "visible": false } ,{ "visible": false},{ "visible": false}, { "visible": false } , { "visible": false } ,null, null,null,null,null,null,null,{ "visible": false}],
            "sPaginationType": "full_numbers",
			"iDisplayLength": 5,
		    oLanguage: {
	            oPaginate: {
	                sFirst: "{{__('datatable.first')}}",
	                sLast: "{{__('datatable.last')}}",
	                sNext: "{{__('datatable.next')}}",
	                sPrevious: "{{__('datatable.previous')}}"
	            },
	            sEmptyTable: "{{__('datatable.emptytable')}}" ,
	            sInfoEmpty: "Showing 0 to 0 of 0 entries",
	            sThousands: ",",
	            sLoadingRecords: "{{__('datatable.loading')}}...",
	            sProcessing: "{{__('datatable.processing')}}...",
	            sSearch: "{{__('datatable.search')}}:",	            
		        sLengthMenu: "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>{{__('datatable.lengthmenu')}}:</span>",	
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

			$('#propertyinspectionform-back-4').hide();
			$('#propertyinspectionform-next-4').hide();

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
			$('#propertyinspectionform-back-4').hide();
			$('#propertyinspectionform-next-4').hide();
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
	    data=[operation,$('#lotstate').val(), $('#lotdistrict').val(), $('#lotcity').val(), '', $('#lotype').val(), $('#lotnum').val(), $('#altlotnum').val(),$('#lttt').val(), $('#ltnum').val(), $('#altnum').val(),$('#landar').val(), $('#landaruni').val(), $('#landcon').val(), $('#lanpos').val(), $('#roadtype').val(), $('#roadcate').val(),$('#landuse').val(), $('#expcon').val(), $('#interest').val(), $('#tentype').val(), $('#tenduration').val(),$('#tenstart').val(), $('#tenend').val(),$('#status').val(), '',operation_code, $('#lot_id').val(),  $('#lotype option:selected').text()+$('#lotnum').val(),$('#altlotnum').val(),$('#lttt option:selected').text()+$('#ltnum').val(),$('#landar').val(), $('#landuse option:selected').text(),  $('#tentype option:selected').text(),  '<span><a onclick="" class="action-icons c-edit edtlotrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons c-delete deletelotrow dellotrow" href="#" title="delete">Delete</a></span>',account ];



			$('#propertyinspectionform-back-4').hide();
			$('#propertyinspectionform-next-4').hide();
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
		
			$('#propertyinspectionform-back-4').hide();
			$('#propertyinspectionform-next-4').hide();
		$('#submitedittbllot').hide();
			$('#submitaddtbllot').show();
		var operation = $("#lot_operation").val();
		var account = $('#accnumber').val();
		//console.log(operation);
		var t = $('#lottble').DataTable();
									
		t.row.add([ 'New',$('#lotstate').val(), $('#lotdistrict').val(), $('#lotcity').val(), '', $('#lotype').val(), $('#lotnum').val(), $('#altlotnum').val(),$('#lttt').val(), $('#ltnum').val(), $('#altnum').val(),$('#landar').val(), $('#landaruni').val(), $('#landcon').val(), $('#lanpos').val(), $('#roadtype').val(), $('#roadcate').val(),$('#landuse').val(), $('#expcon').val(), $('#interest').val(), $('#tentype').val(), $('#tenduration').val(),$('#tenstart').val(), $('#tenend').val(),$('#status').val(), '','new', $('#lot_id').val(), $('#lotype option:selected').text()+$('#lotnum').val(),$('#altlotnum').val(),$('#lttt option:selected').text()+$('#ltnum').val(),$('#landar').val(), $('#landuse option:selected').text(),  $('#tentype option:selected').text(), '<span><a onclick="" class="action-icons c-edit edtlotrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons c-delete deletelotrow dellotrow" href="#" title="delete">Delete</a></span>',account  ]).draw( false );

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
			$('#propertyinspectionform-back-4').hide();
			$('#propertyinspectionform-next-4').hide();					
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