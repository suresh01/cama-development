
						
							<h4>Building</h4>
								<p>
									Account Number = <span id="bldglabel"></span>
								</p>

							<button onclick="openbldgarea()" id="addbldgar" name="btnadduser" type="button" class="btn_small btn_blue"><span>Add Building Detail</span></button>
								




								<div id="bldgareatable1" class="widget_wrap">					
									<div class="widget_content">						
										<table  id="bldgartable1" class="display" style="width:100%">
										<thead >
								  		<tr>
											<th class="table_sno">S No</th>
											<th>ACCOUNT NUMBER</th>
											<th>BUILDING NUMBER</th>
											<th>REFF INFORMATION</th>
											<th>AREA TYPE</th>
											<th>AREA CATEGORY</th>
											<th>AREA LEVEL</th>
											<th>AREA ZONE</th>
											<th>AREA USE</th>
											<th>AREA DESCRIPTION</th>
											<th>DIMENTION</th>
											<th>AREA COUNT</th>
											<th>MEASUREMENT</th>
											<th>UNIT OF MEASUREMENT</th>
											<th>TOTAL SIZE</th>
											<th>FLOOR TYPE</th>
											<th>WALL TYPE</th>
											<th>CEILLING TYPE</th>
											<th>Action</th>
											<th>actioncode</th>
											<th>detailid</th>
										</tr>
										</thead>
										<tbody>
											
										</tbody>
										</table>
									</div>
								</div>

					
							<div style="display:none;" id="bldgardetail1" >
								<div id="bldgarform" autocomplete="off" onsubmit="return false;" class="form_container left_label" method="post" action="#" >
									<div style="height: 48px; display: -webkit-box;text-align: -webkit-right;" class="grid_12">
									<button id="submitaddtblbldgar" onclick="addbldgarRow()" style="display:none" name="adduser" type="button" class="btn_small btn_blue"><span>Add</span></button>	
									<button id="submitedittblbldgar" onclick="editbldgarRow()" style="display:none" name="adduser" type="button" class="btn_small btn_blue"><span>Update</span></button>	
								<button id="close" onclick="closebldgar()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>
								</div>
								<div class="grid_6 ">
								<ul>
								<li>
									<input type="hidden" value="0"  name="operation" id="bldgar_operation">
									<!--<input type="hidden" value="0" name="bldgnum" id="arbldgnum">-->
									<input type="hidden" value="0" name="bldgaccnum" id="bldgaccnum">
									<input type="hidden" value="0" name="bldgarid" id="bldgarid">

								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">Builiding Number<span class="req">*</span></label>
									<div  class="form_input">
										<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="bldgnumar" name="bldgnumar" tabindex="20">				
											
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="lusername" for="username">REFF INFORMATION<span class="req">*</span></label>
									<div  class="form_input">
										<input id="reffinfo"  name="reffinfo"  type="text"  maxlength="50" class="large"/>
									</div>
									<span class=" label_intro"></span>
								</div>
								
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">AREA TYPE<span class="req">*</span></label>
									<div  class="form_input">
										<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="artype" name="artype" tabindex="20">
											@foreach ($artype as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
								
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">AREA CATEGORY<span class="req">*</span></label>
									<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="arcate" name="arcate" tabindex="20">
											@foreach ($arcaty as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">AREA LEVEL<span class="req">*</span></label>
									<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="arlevel" name="arlevel" tabindex="20">
											@foreach ($bldgstore as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">AREA ZONE<span class="req">*</span></label>
									<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="arzone" name="arzone" tabindex="20">
											@foreach ($arzone as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">AREA USE<span class="req">*</span></label>
									<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="aruse" name="aruse" tabindex="20">
											@foreach ($aruse as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">CELING TYPE<span class="req">*</span></label>
									<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="celingtype" name="celingtype" tabindex="20">
											@foreach ($ceiling as $rec)
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
									<label class="field_title" id="lposition" for="position">AREA DESCRIPTION<span class="req">*</span></label>
									<div  class="form_input">
										<input id="ardesc"  name="ardesc"  type="text"  maxlength="50" />
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">WALL TYPE<span class="req">*</span></label>
									<div  class="form_input"><select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="walltype" name="walltype" tabindex="20">
											@foreach ($walltype as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">FLOOR TYPE<span class="req">*</span></label>
									<div  class="form_input">
										<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="fltype" name="fltype" tabindex="20">
											@foreach ($fltype as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">DIMENTION<span class="req">*</span></label>
									<div  class="form_input">
										<input id="dimention"  name="dimention" value="0" type="text"  maxlength="50" />
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">AREA COUNT<span class="req">*</span></label>
									<div  class="form_input">
										<input id="arcnt"  name="arcnt" value="0" onchange="caltotsize()" type="text"  maxlength="50"/>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">MEASUREMENT<span class="req">*</span></label>
									<div  class="form_input">
										<input id="size"  name="size" value="0" onchange="caltotsize()" type="text"  maxlength="50" />
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">UNIT OF MEASUREMENT<span class="req">*</span></label>
									<div  class="form_input">
										<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="uom" name="uom" tabindex="20">
											@foreach ($unitsize as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">TOTAL SIZE<span class="req">*</span></label>
									<div  class="form_input">
										<input id="totsize"  name="totsize" value="0" type="text"  maxlength="50"/>
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
							
							
					<script type="text/javascript">
						function caltotsize(){
							var arcnt = $('#arcnt').val();
					var size = $('#size').val()
					
					var totalsize = arcnt * size;
					$('#totsize').val(totalsize);
						}

						$(document).ready(function() {
			var account = $('#accnumber').val();
			let bldgarmap = new Map([["0","sno"],["1", "bldgaccnum"],  ["2", "bldgnum"],["3", "reffinfo"], ["4", "artype"],["5", "arcate"], ["6", "arlevel"],["7", "arzone"], ["8", "aruse"],["9", "ardesc"], ["10", "dimention"],["11", "arcnt"],["12", "size"],["13", "uom"],["14", "totsize"],["15", "fltype"],["16","walltype"],["17", "celingtype"],["18", "action"],["19","actioncode"],["20","bldgarid"]]);
 		var blsgardata = [];
		 		@foreach ($bldgardetail as $rec)
		 			blsgardata.push( [ '{{$loop->iteration}}', '{{ $rec->ma_accno}}', '{{$rec->bl_bldg_no}}', '{{$rec->BA_REF}}', '{{$rec->BA_AREATYPE_ID}}', '{{$rec->BA_AREACATEGORY_ID}}', '{{$rec->BA_AREALEVEL_ID}}', '{{$rec->BA_AREAZONE_ID}}', '{{$rec->BA_AERAUSE_ID}}','{{$rec->BA_AREADESC}}',  '{{$rec->BA_DIMENTION}}', '{{$rec->BA_UNITCOUNT}}','{{$rec->BA_SIZE}}','{{$rec->BA_SIZEUNIT_ID}}',  '{{$rec->BA_TOTSIZE}}', '{{$rec->BA_FLOORTYPE_ID}}','{{$rec->BA_WALLTYPE_ID}}','{{$rec->BA_CEILINGTYPE_ID}}','<span><a onclick="" class="action-icons c-edit edtbldgarrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class="action-icons c-delete  deletebldgarrow" href="#" title="delete">Delete</a></span>', 'noaction','{{$rec->BA_ID}}' ] );
		 		@endforeach

        $('#bldgartable1').DataTable({
            data:           blsgardata,
            "columns":[ null, null, null, null, { "visible": false }, { "visible": false}, { "visible": false}, { "visible": false }, { "visible": false}, null, { "visible": false }, { "visible": false}, null, { "visible": false}, null, { "visible": false }, { "visible": false }, { "visible": false }, null,{ "visible": false },{ "visible": false }],
            "sPaginationType": "full_numbers",
			"iDisplayLength": 5,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			 
		});
		$("div.table_top select").addClass('tbl_length');
		$(".tbl_length").chosen({
			disable_search_threshold: 4	
		});

        var table = $('#bldgartable1').DataTable();

		$('#bldgartable1 tbody').on( 'click', '.deletebldgarrow', function () {

			var row = table.row(table.row( $(this).parents('tr') ).index()),
			    data = row.data();
			    data[0]='Deleted';
				data[19]='delete';
				data[18]='';
			row.data(data);
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


		$('#bldgartable1 tbody').on( 'click', '.edtbldgarrow', function () {
			//var editlotdata = JSON.stringify(table.row( $(this).parents('tr') ).data());
			var ldata = table.row( $(this).parents('tr') ).data();
			
			var bldgardata = {};
			
			$.each( ldata, function( key, value ) {
				bldgardata[bldgarmap.get(""+key+"")] = value;              
            });

           

            //$('#bldgnumar').html();
            $("#bldgnumar option").remove();
            for (var k = 0;k<$('#bldgtble').DataTable().rows().count();k++){
					var ldata2 = $('#bldgtble').DataTable().row(k).data();
					var tempdata3 = {};
					$.each(ldata2, function( key, value ) {
						if (key === 1) {
							$('#bldgnumar').append($("<option/>", {
						        value: value,
						        text: value
						    }));				
					    }	           
	            	});            	
				}

				$.each( bldgardata, function( key, val ) {
					
            		$('#'+key).val(val);
            		if(key === 2){
            			$('#bldgnumar').val(val);
					}
				});
        	$("#bldgardetail1").show();
			$("#addbldgar").hide();
			$("#bldgareatable1").hide();
			$('#propertyregsitration_from-back-4').hide();
							$('#finish').hide();
            //console.log( table.row( $(this).parents('tr') ).index() );		
			//$('#lot_operation').val(2);
			 //$('#tableindex').val(table.row( $(this).parents('tr') ).index());  
			 //table.row( $(this).parents('tr') ).remove().draw();
			 $('#submitedittblbldgar').show();
			 $('#submitaddtblbldgar').hide();


		});

});

						$(document).ready(function() {
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
						
						function editbldgarRow(){
							$('#submitedittblbldgar').hide();
			 				$('#submitaddtblbldgar').hide();
			 				var table = $('#bldgartable1').DataTable();
			 				var account = $('#accnumber').val();

			$('#propertyregsitration_from-back-4').show();
							$('#finish').show();

			 				var row = table.row(table.row( $(this).parents('tr') ).index()),
			    data = row.data();
			    data=['Updated',account, $('#bldgnumar').val(), $('#reffinfo').val(),  $('#artype').val(), $('#arcate').val(), $('#arlevel').val(),$('#arzone').val(), $('#aruse').val(), $('#ardesc').val(),$('#dimention').val(), $('#arcnt').val(), $('#size').val(),$('#uom').val(), $('#totsize').val(), $('#fltype').val(), $('#walltype').val(), $('#celingtype').val(), '<span><a onclick="" class="action-icons c-edit edtbldgarrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons c-delete deletebldgarrow " href="#" title="delete">Delete</a></span>', 'update', $('#bldgarid').val()];

					row.data(data);
			 				$("#bldgardetail1").hide();
							$("#bldgareatable1").show();
							$("#addbldgar").show();

						}
						function addbldgarRow(){
							//$('#submitedittblbldgar').hide();
			 				//$('#submitaddtblbldgar').show();

			//$('#propertyregsitration_from-back-4').show();
			//				$('#finish').show();
							var operation = $("#lot_operation").val();
							//console.log(operation);
							var t = $('#bldgartable1').DataTable();
							var account = $('#accnumber').val();
														
							t.row.add(['New',account, $('#bldgnumar').val(), $('#reffinfo').val(),  $('#artype').val(), $('#arcate').val(), $('#arlevel').val(),$('#arzone').val(), $('#aruse').val(), $('#ardesc').val(),$('#dimention').val(), $('#arcnt').val(), $('#size').val(),$('#uom').val(),$('#totsize').val(), $('#fltype').val(), $('#walltype').val(),$('#celingtype').val(), '<span><a onclick="" class="action-icons c-edit edtbldgarrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons c-delete deletebldgarrow " href="#" title="delete">Delete</a></span>', 'new', $('#bldgid').val()]).draw( false );
						
							alert('Building detail added');
							//$("#bldgardetail1").hide();
							//$("#bldgareatable1").show();
							//$("#addbldgarRow").show();
							
						}

						function showBldgAr(id){
							$("#bldgareatable").show();
							$.ajax({
									        type:'GET',
									        url:'bldgareadetail',
										    headers: {
											    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
											},
									        data:{bldgid:id},
									        success:function(data){	  
									        var bldgar = data.bldgdetail;     	
									        var i =1;
									        	 $('#bldgartable > tbody').html('');
									        	 bldgar.forEach(function(e) {
												    $('#bldgartable > tbody').append('<tr><td>'+i+'</td><td>'+e.BA_REF+'</td><td>'+e.artype+'</td><td>'+e.arcate+'</td><td>'+e.arlvel+'</td><td>'+e.arzone+'</td><td>'+e.BA_TOTSIZE+'</td><td>'+
													'<span><a onclick="editbldgardetail('+e.BA_ID+')" class="action-icons c-edit" href="#" title="Edit">Edit</a></span> '+
													'<span><a onclick="deletebldg('+e.BA_ID+')" class="action-icons c-delete" href="#" title="delete">Delete</a></span></td></tr>');

												    $('#bldgartable > tbody').append('<div style="display:none; "><input type="text" id="bldgref_'+e.BA_ID+'"  value="'+e.BA_REF+'"><input type="text" id="baartype_'+e.BA_ID+'" value="'+e.BA_AREATYPE_ID+'"><input type="text" id="arlvel_'+e.BA_ID+'" value="'+e.BA_AREALEVEL_ID+'"><input type="text" id="arcate'+e.BA_ID+'" value="'+e.BA_AREACATEGORY_ID+'"><input type="text" id="arzone'+e.BA_ID+'" value="'+e.BA_AREAZONE_ID+'"><input type="text" id="aruse'+e.BA_ID+'" value="'+e.BA_AREAUSE_ID+'"><input type="text" id="ardesc'+e.BA_ID+' value="'+e.BA_AREADESC+'"><input type="text" id="dim'+e.BA_ID+'"  value="'+e.BA_DIMENTION+'"><input type="text" id="unitcnt'+e.BA_ID+'" value="'+e.BA_UNITCOUNT+'"><input type="text" id="size'+e.BA_ID+' value="'+e.BA_SIZE+'"><input type="text" id="sizeunit'+e.BA_ID+'" value="'+e.BA_SIZEUNIT_ID+'"> <input type="text" id="totsize'+e.BA_ID+'" value="'+e.BA_TOTSIZE+'"><input type="text" id="fltype'+e.BA_ID+' value="'+e.BA_FLOORTYPE_ID+'"><input type="text" id="walltype'+e.BA_ID+'" value="'+e.BA_WALLTYPE_ID+'"><input type="text" id="ceilingtype'+e.BA_ID+'" value="'+e.BA_CEILINGTYPE_ID+'"></div>');
									        		i++;
											  	});
											},
									        error:function(data){	
									        	console.log(data);
									        }
									});       
							}

						function openbldgarea(id, bldgnum){
							$('#bldgnum').html();
							//console.log($('#bldgtble').DataTable().rows().count());
            for (var k = 0;k<$('#bldgtble').DataTable().rows().count();k++){
					var ldata2 = $('#bldgtble').DataTable().row(k).data();
					var tempdata3 = {};
					$.each(ldata2, function( key, value ) {
						if (key === 1) {
							//console.log(value);
						//$('#bldgnum').append($('<option>'+value+'</option>'));
						$('#bldgnumar').append($("<option/>", {
        value: value,
        text: value
    }));	
						}				           
	            	});            	
				}

			$('#propertyregsitration_from-back-4').hide();
							$('#finish').hide();
							$("#bldgareatable1").hide();
							$("#bldgardetail1").show();
							$('#addbldgar').hide();
				$('#submitedittblbldgar').hide();
			 $('#submitaddtblbldgar').show();

							
							$('#bldgar_operation').val(1)
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

						function closebldgar(){

							$('#propertyregsitration_from-back-4').show();
							$('#finish').show();
							$("#bldgareatable1").show();
							$("#addbldgar").show();
							$("#bldgardetail1").hide();
						}

						function closearbldg(){

							$('#propertyregsitration_from-back-4').show();
							$('#finish').show();
							$("#addbldg").show();
							$("#bldgtable").show();
							$("#bldgareatable").hide();
							$("#bldgardetail").hide();							
						}

						function openbldg(){
							$('#submitedittblbldg').hide();
			 				$('#submitaddtblbldg').show();
							$("#bldg_operation").val(1);
							$("#bldgaccnum").val($('#accnumber').val());
							$("#bldgdetail").show();
							$("#bldgtable").hide();
							$("#addbldg").hide();
							$("#bldgareatable").hide();
							$("bldgsubmit").html("Save");
						 	$("label.error").remove();	
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

					</script>
							