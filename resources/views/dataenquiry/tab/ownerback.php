
						<div id="tab3">
							<h4>Owner</h4>
								<p>
									Account Number = <span id="ownerlabel"></span>
								</p>


								<div id="ownertable" class="widget_wrap">					
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
		 		@foreach ($owner as $rec)

		 			if ('{{$rec->TO_FAXNO}}' != ''){

		 			}
		 			ownerdata.push( [ '{{$loop->iteration}}', '{{$rec->TO_OWNERAPPLNTYPE_ID}}', '{{$rec->TO_OWNTYPE_ID}}', '{{$rec->TO_OWNNO}}', '{{$rec->TO_OWNNAME}}', '{{$rec->TO_ADDR_LN1}}', '{{$rec->TO_ADDR_LN2}}', '{{$rec->TO_ADDR_LN3}}', '{{$rec->TO_ADDR_LN4}}', '{{$rec->TO_POSTCODE}}', '{{$rec->TO_STATE_ID}}', '{{$rec->TO_TELNO}}', '{{$rec->TO_FAXNO}}', '{{$rec->TO_CITIZEN_ID}}', '{{$rec->TO_RACE_ID}}', '{{$rec->TO_NUMETR}}', '{{$rec->TO_DENOMTR}}','<span><a onclick="" class="action-icons c-edit edtownerrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class="action-icons c-delete dellotrow deleteownerrow" href="#" title="delete">Delete</a></span>','noation', '{{$rec->TO_ID}}' ,'newacc',			'{{$rec->TO_OWNERAPPLNTYPE_ID}} / {{$rec->owntype}}'	,'{{$rec->TO_OWNNO}}'	,'{{$rec->TO_ADDR_LN1}},  {{$rec->TO_ADDR_LN2}},   {{$rec->TO_ADDR_LN3}}  {{$rec->state}} - {{$rec->TO_POSTCODE}} '	,'{{$rec->TO_TELNO}} / {{$rec->TO_FAXNO}}'	,'<span><a onclick="" class="action-icons c-edit edtownerrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class="action-icons c-delete dellotrow deleteownerrow" href="#" title="delete">Delete</a></span>' ] );
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

        	$("#ownerdetail").show();
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

		$("#ownerdetail").hide();
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
							$("#ownerdetail").show();
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
							$("#ownerdetail").show();
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
							$("#ownerdetail").hide();
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
							