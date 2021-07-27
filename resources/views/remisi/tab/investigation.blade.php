

<div id="instable" class="widget_content">	
<div style="float:right;margin-right: 0px;"  class="btn_24_blue">	      
	<a href="#" onclick="addInvestigation()" class=""><span>{{__('remisiLang.Add_Investigation')}}  </span></a> 
</div>
</br>	</br></br>		
	<table id="invesitgatetable" class="display ">
		<thead style="text-align: left;">
			<tr>
				<th Class="table_sno">{{__('remisiLang.SNO')}} </th>
				<th>{{__('remisiLang.Investigation_Type')}}  </th>
				<th>{{__('remisiLang.Investigation_Officer')}}  </th>
				<th>{{__('remisiLang.Investigation_Date')}}  </th>
				<th>{{__('remisiLang.Action')}}   </th>	
				<th>{{__('remisiLang.Actioncode')}}  </th>
				<th>{{__('remisiLang.Id')}}   </th>	
				<th>{{__('remisiLang.Instype')}}   </th>	
				<th>{{__('remisiLang.Insofficer')}}   </th>		
				<th>{{__('remisiLang.Review')}}   </th>		
				<th>{{__('remisiLang.Finding1')}}   </th>		
				<th>{{__('remisiLang.Finding2')}}   </th>		
				<th>{{__('remisiLang.Finding3')}}   </th>		
				<th>{{__('remisiLang.Finding4')}}   </th>			
				<th>{{__('remisiLang.Finding5')}}  </th>		
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
</div>
<div id="addform" class="grid_12" style="display: none;">
	<div style="height: 48px; display: -webkit-box;text-align: -webkit-right;" class="grid_12">
		<button id="addbtn" onclick="addRow()"  name="adduser" type="button" class="btn_small btn_blue"><span>{{__('common.Add')}}</span></button>	
		<button id="updatebtn" onclick="updateRow()"  name="adduser" type="button" class="btn_small btn_blue"><span>{{__('common.Update')}}</span></button>
		<button id="close" onclick="closeIns()" name="close" type="button" class="btn_small btn_blue"><span> {{__('common.Close')}} </span></button>
	</div>
	<br><br><br>
	<input id="insid"  name="insid" type="hidden" value="0" maxlength="100" >
	<input id="instableindex"  name="instableindex" type="hidden" value="0" maxlength="100" >
	<ul>
		<li>
			<fieldset>
				<legend>{{__('remisiLang.Information')}}  </legend>				
				
				<div class="form_grid_12">
					<label class="field_title" id="llevel" for="level">{{__('remisiLang.Investigation_Type')}} <span class="req">*</span></label>
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
					<label class="field_title" id="llevel" for="level">{{__('remisiLang.Investigation_Officer')}} <span class="req">*</span></label>
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
					<label class="field_title" id="llevel" for="level">{{__('remisiLang.Investigation_Date')}}<span class="req">*</span></label>
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
				<legend>{{__('remisiLang.Investigation_Finding')}}  </legend>
				<div class="form_grid_2">
											
					<div style="width: 20%;" class="form_input ">
						<span>
						
						<input name="finreason1" id="finreason1" value="1" class="checkbox findreason" type="checkbox"  tabindex="7">
						</span>
					</div>
				</div>
				<div class="form_grid_10">
					<label style="width: 80%;" class="field_title">{{__('remisiLang.Finding1')}} </label>
					
				</div>
				
				<div class="form_grid_2">
											
					<div style="width: 20%;" class="form_input ">
						<span>
						
						<input name="finreason2" value="1"  id="finreason2" class="checkbox findreason" type="checkbox"  tabindex="7">
						</span>
					</div>
				</div>
				<div class="form_grid_10">
					<label style="width: 80%;" class="field_title">{{__('remisiLang.Finding2')}} </label>
					
				</div>
				<div class="form_grid_2">
											
					<div style="width: 20%;" class="form_input ">
						<span>
						
						<input name="finreason3" value="1"  id="finreason3" class="checkbox findreason" type="checkbox"  tabindex="7">
						</span>
					</div>
				</div>
				<div class="form_grid_10">
					<label style="width: 80%;" class="field_title">{{__('remisiLang.Finding3')}} </label>
					
				</div>
				<div class="form_grid_2">
											
					<div style="width: 20%;" class="form_input ">
						<span>
						
						<input name="finreason4" value="1"  id="finreason4" class="checkbox findreason" type="checkbox"  tabindex="7">
						</span>
					</div>
				</div>
				<div class="form_grid_10">
					<label style="width: 80%;" class="field_title">{{__('remisiLang.Finding4')}} </label>
					
				</div>
				<div class="form_grid_2">
											
					<div style="width: 20%;" class="form_input ">
						<span>
						
						<input name="finreason5" value="1"  id="finreason5" class="checkbox findreason" type="checkbox"  tabindex="7">
						</span>
					</div>
				</div>
				<div class="form_grid_10">
					<label style="width: 80%;" class="field_title">{{__('remisiLang.Finding5')}} </label>
					
				</div>
				
				<div class="form_grid_2">
					<label class="field_title" style="width: 100%;" id="lposition" for="position">{{__('remisiLang.Review')}} <span class="req">*</span></label>
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

		$("#uniform-finreason1").find('span').attr("class", "");
		$("#uniform-finreason2").find('span').attr("class", "");
		$("#uniform-finreason3").find('span').attr("class", "");
		$("#uniform-finreason4").find('span').attr("class", "");
		$("#uniform-finreason5").find('span').attr("class", "");
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
			var finreason1 = 0;
			var finreason2 = 0;
			var finreason3 = 0;
			var finreason4 = 0;
			var finreason5 = 0;



			if($('#finreason1').is(":checked")) {
				finreason1 = 1;
			}

			if($('#finreason2').is(":checked")) {
				finreason2 = 1;
			}
			if($('#finreason3').is(":checked")) {
				finreason3 = 1;
			}
			if($('#finreason4').is(":checked")) {
				finreason4 = 1;
			}
			if($('#finreason5').is(":checked")) {
				finreason5 = 1;
			}
				
			t.row.add([ 'New', $('#instype option:selected').text(), $('#insofficer option:selected').text(), $('#insvdate').val(),  '<span><a onclick="" class="action-icons c-edit editrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons  deleterow " href="#" title="delete">Delete</a></span>','new',$('#insid').val(), $('#instype').val(),$('#insofficer').val(),$('#review').val(),finreason1,finreason2,finreason3,finreason4,finreason5 ]).draw( false );			
			
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

		var table =$('#invesitgatetable').DataTable();
		$('#invesitgatetable tbody').on( 'click', '.editrow', function () {
			//var editlotdata = JSON.stringify(table.row( $(this).parents('tr') ).data());
			var ldata = table.row( table.row( $(this).parents('tr') ).index()).data();
			$('#instableindex').val(table.row( $(this).parents('tr') ).index());
			var lotdata = {};
			
			$("#uniform-finreason1").find('span').attr("class", "");
			$("#uniform-finreason2").find('span').attr("class", "");
			$("#uniform-finreason3").find('span').attr("class", "");
			$("#uniform-finreason4").find('span').attr("class", "");
			$("#uniform-finreason5").find('span').attr("class", "");
			
			$.each( ldata, function( key, value ) {

				lotdata[invesitagemap.get(""+key+"")] = value;              
            });

            $.each( lotdata, function( key, val ) {
            	if(key != 'finreason1' && key != 'finreason2' && key != 'finreason3' && key != 'finreason4' && key != 'finreason5'  ){
            		$('#'+key).val(val);
            	}
            	
            	if(key.includes("finreason") && val ==1) {
	            	var checkbox = $("#uniform-"+key).find('span');
					checkbox.attr("class", "checked");

					$("#"+key+":checkbox").attr("checked","checked");
				}
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
		var finreason1 = 0;
		var finreason2 = 0;
		var finreason3 = 0;
		var finreason4 = 0;
		var finreason5 = 0;

		if($('#finreason1').is(":checked")) {
			finreason1 = 1;
		}
		if($('#finreason2').is(":checked")) {
			finreason2 = 1;
		}
		if($('#finreason3').is(":checked")) {
			finreason3 = 1;
		}
		if($('#finreason4').is(":checked")) {
			finreason4 = 1;
		}
		if($('#finreason5').is(":checked")) {
			finreason5 = 1;
		}
		data=[operation,$('#instype option:selected').text(),  $('#insofficer option:selected').text(), $('#insvdate').val(),  '<span><a onclick="" class="action-icons c-edit editrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons  deleterow " href="#" title="delete">Delete</a></span>',operation_code,$('#insid').val(), $('#instype').val(),$('#insofficer').val(),$('#review').val(),finreason1,finreason2,finreason3,finreason4,finreason5];
		
		row.data(data);
		closeIns();
		/*$('#propertyinspectionform-back-2').show();
		$('#propertyinspectionform-next-2').show();
		$('#instable').show();
		$('#addform').hide();	*/	
		
	}
</script>
