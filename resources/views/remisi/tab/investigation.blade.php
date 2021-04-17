

<div id="instable" class="widget_content">	
<div style="float:right;margin-right: 0px;"  class="btn_24_blue">	      
	<a href="#" onclick="addInvestigation()" class=""><span>Add Investigation </span></a> 
</div>
</br>	</br></br>		
	<table id="invesitgatetable" class="display ">
		<thead style="text-align: left;">
			<tr>
				<th class="table_sno">
					S No
				</th>
				<th>
					Investigation Type
				</th>
				<th>
					Investigation Officer
				</th>
				<th>
					Investigation Date
				</th>
				<th>
					Action 
				</th>	
				<th>
					actioncode
				</th>
				<th>
					id 
				</th>	
				<th>
					instype 
				</th>	
				<th>
					insofficer 
				</th>		
				<th>
					review 
				</th>		
				<th>
					finding1 
				</th>		
				<th>
					finding2 
				</th>		
				<th>
					finding3 
				</th>		
				<th>
					finding4 
				</th>			
				<th>
					finding5
				</th>		
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
</div>
<div id="addform" class="grid_12" style="display: none;">
	<div style="height: 48px; display: -webkit-box;text-align: -webkit-right;" class="grid_12">
		<button id="addbtn" onclick="addRow()"  name="adduser" type="button" class="btn_small btn_blue"><span>Add</span></button>	
		<button id="updatebtn" onclick="updateRow()"  name="adduser" type="button" class="btn_small btn_blue"><span>Update</span></button>
		<button id="close" onclick="closeIns()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>
	</div>
	<br><br><br>
	<input id="insid"  name="insid" type="hidden" value="0" maxlength="100" >
	<input id="instableindex"  name="instableindex" type="hidden" value="0" maxlength="100" >
	<ul>
		<li>
			<fieldset>
				<legend>Information </legend>				
				
				<div class="form_grid_12">
					<label class="field_title" id="llevel" for="level">Investigation Type<span class="req">*</span></label>
					<div  class="form_input">

						<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"   id="instype" name="instype" tabindex="14">
							<option></option>
							@foreach ($instype as $rec)
									<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
							@endforeach	
						</select>
					</div>
					<span class=" label_intro"></span>
				</div>

				<div class="form_grid_12">
					<label class="field_title" id="llevel" for="level">Investigation Officer<span class="req">*</span></label>
					<div  class="form_input">
						<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"   id="insofficer" name="insofficer" tabindex="14">
							<option></option>
							@foreach ($userlist as $rec)
									<option value='{{ $rec->usr_name }}'>{{ $rec->name }}</option>
							@endforeach	
						</select>
					</div>
					<span class=" label_intro"></span>
				</div>

				<div class="form_grid_12">
					<label class="field_title" id="llevel" for="level">Investigation Date<span class="req">*</span></label>
					<div  class="form_input">
						<input id="insvdate" tabindex="1" name="insvdate" type="text" value="" maxlength="100" >
					</div>
					<span class=" label_intro"></span>
				</div>

				
			</fieldset>
		</li>
	</ul>
	<ul>
		<li>
			<fieldset>
				<legend>Investigation Finding </legend>
				<div class="form_grid_2">
											
					<div style="width: 20%;" class="form_input ">
						<span>
						
						<input name="finreason1" id="finreason1" value="1" class="checkbox findreason" type="checkbox"  tabindex="7">
						</span>
					</div>
				</div>
				<div class="form_grid_10">
					<label style="width: 80%;" class="field_title">Finding 1</label>
					
				</div>
				
				<div class="form_grid_2">
											
					<div style="width: 20%;" class="form_input ">
						<span>
						
						<input name="finreason2" value="1"  id="finreason2" class="checkbox findreason" type="checkbox"  tabindex="7">
						</span>
					</div>
				</div>
				<div class="form_grid_10">
					<label style="width: 80%;" class="field_title">Finding 2</label>
					
				</div>
				<div class="form_grid_2">
											
					<div style="width: 20%;" class="form_input ">
						<span>
						
						<input name="finreason3" value="1"  id="finreason3" class="checkbox findreason" type="checkbox"  tabindex="7">
						</span>
					</div>
				</div>
				<div class="form_grid_10">
					<label style="width: 80%;" class="field_title">Finding 3</label>
					
				</div>
				<div class="form_grid_2">
											
					<div style="width: 20%;" class="form_input ">
						<span>
						
						<input name="finreason4" value="1"  id="finreason4" class="checkbox findreason" type="checkbox"  tabindex="7">
						</span>
					</div>
				</div>
				<div class="form_grid_10">
					<label style="width: 80%;" class="field_title">Finding 4</label>
					
				</div>
				<div class="form_grid_2">
											
					<div style="width: 20%;" class="form_input ">
						<span>
						
						<input name="finreason5" value="1"  id="finreason5" class="checkbox findreason" type="checkbox"  tabindex="7">
						</span>
					</div>
				</div>
				<div class="form_grid_10">
					<label style="width: 80%;" class="field_title">Finding 5</label>
					
				</div>
				
				<div class="form_grid_2">
					<label class="field_title" style="width: 100%;" id="lposition" for="position">Review<span class="req">*</span></label>
				</div>
				<div class="form_grid_10">
					<div style="margin-left: 0px"  class="form_input"> 
						<textarea rows="4" id="review" name="review" cols="50"></textarea>
						<span class=" label_intro"></span>
					</div>

				</div>
			</fieldset>
		</li>
	</ul>
</div>				
<script>
	function addInvestigation(){
		//alert();
		$('#instype').val('');
		$('#instableindex').val(0);
		$('#insofficer').val('');
		$('#insvdate').val('');
		$('#finreason1').val('');
		$('#finreason2').val('');
		$('#finreason3').val('');
		$('#finreason4').val('');
		$('#review').val('');
		$('#propertyinspectionform-back-2').hide();
		$('#propertyinspectionform-next-2').hide();
		$('#instable').hide();
		$('#addform').show();
		$('#addbtn').show();
		$('#updatebtn').hide();
	}
	function closeIns(){
		//alert();
		$('#propertyinspectionform-back-2').show();
		$('#propertyinspectionform-next-2').show();
		$('#instable').show();
		$('#addform').hide();
	}


	function addRow(){
		var index = instableindex;
		//alert(index);
	//	if(index < 0){
			var t = $('#invesitgatetable').DataTable();
				
			t.row.add([ 'New', $('#instype option:selected').text(), $('#insofficer option:selected').text(), $('#insvdate').val(),  '<span><a onclick="" class="action-icons c-edit editrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons  deleterow " href="#" title="delete">Delete</a></span>','new',$('#insid').val(), $('#instype').val(),$('#insofficer').val(),$('#review').val(),$('#finreason1').val(),$('#finreason2').val(),$('#finreason3').val(),$('#finreason4').val(),$('#finreason5').val() ]).draw( false );			
			
		//} else {
		//	editINSRow();
		//}

		closeIns();
		
	}

	$(document).ready(function() {
		

		var insdata = [];
	 		@foreach ($insdata as $rec)
	 			insdata.push( [ '{{$loop->iteration}}', '{{$rec->tdi_value}}','{{$rec->officername}}', '{{$rec->ri_insofficerdate}}', '<span><a onclick="" class="action-icons c-edit editrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons  deleterow " href="#" title="delete">Delete</a></span>', 'noaction', '{{$rec->ri_id}}',  '{{$rec->ri_instype_id}}', '{{$rec->ri_insofficer}}','{{$rec->ri_review}}', '{{$rec->ri_insfind1}}', '{{$rec->ri_insfind2}}', '{{$rec->ri_insfind3}}', '{{$rec->ri_insfind4}}', '{{$rec->ri_insfind5}}' ] );
	 		@endforeach
		$('#invesitgatetable').DataTable({
            data:           insdata,
            "columns": [ null, null, null,null,null,{ "visible": false}, { "visible": false},{ "visible": false},{ "visible": false},{ "visible": false},{ "visible": false},{ "visible": false},{ "visible": false},{ "visible": false},{ "visible": false}],
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

		var table =$('#invesitgatetable').DataTable();
		$('#invesitgatetable tbody').on( 'click', '.editrow', function () {
			//var editlotdata = JSON.stringify(table.row( $(this).parents('tr') ).data());
			var ldata = table.row( table.row( $(this).parents('tr') ).index()).data();
			$('#instableindex').val(table.row( $(this).parents('tr') ).index());
			var lotdata = {};
			
			$.each( ldata, function( key, value ) {
				lotdata[invesitagemap.get(""+key+"")] = value;              
            });

            $.each( lotdata, function( key, val ) {
            	$('#'+key).val(val);
			});

			
			//$('#addform').val('Update');
			$('#propertyinspectionform-back-2').hide();
			$('#propertyinspectionform-next-2').hide();
			$('#instable').hide();
			$('#addform').show();
			$('#addbtn').hide();
			$('#updatebtn').show();
		});

		$('#invesitgatetable tbody').on( 'click', '.deleterow', function () {

			var row = table.row(table.row( $(this).parents('tr') ).index()),
			    data = row.data();
			    data[0]='Deleted';
				data[5]='delete';
				data[4]='';
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
	});

	function updateRow(){	
			
			
		var table = $('#invesitgatetable').DataTable();
		
		var row = table.row($('#instableindex').val());
		var data = table.row($('#instableindex').val()).data();
		var recordtype = data[0];
		var operation = "Updated";
		var operation_code = "update";
		if (recordtype==='New'){
			operation = "New";
			operation_code = "new";
		}


		data=[operation,$('#instype option:selected').text(),  $('#insofficer option:selected').text(), $('#insvdate').val(),  '<span><a onclick="" class="action-icons c-edit editrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons  deleterow " href="#" title="delete">Delete</a></span>',operation_code,$('#insid').val(), $('#instype').val(),$('#insofficer').val(),$('#review').val(),$('#finreason1').val(),$('#finreason2').val(),$('#finreason3').val(),$('#finreason4').val(),$('#finreason5').val() ];
		
		row.data(data);
		closeIns();
		/*$('#propertyinspectionform-back-2').show();
		$('#propertyinspectionform-next-2').show();
		$('#instable').show();
		$('#addform').hide();	*/	
		
	}
</script>
