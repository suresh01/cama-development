<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('toneoflist.TOL_Land_Standard')}}</title>
@include('includes.header', ['page' => 'TOL'])
	<div id="content">
		<div class="grid_container">
		<div id="basket_table" class="grid_12">			
			<br>
			<div class="form_input">
				

				<div id="breadCrumb3"  class="breadCrumb grid_3">
					<ul >
						<li><a href="#">{{__('toneoflist.Home')}} </a></li>
						<li><a href="#">{{__('toneoflist.Tone_of_List')}} </a></li>
						<li>{{__('toneoflist.Land_Standard')}}</li>
					</ul>
				</div>

				@include('tol.search',['tableid'=>'landtable', 'action' => 'tonelandsdtable', 'searchid' => '29'])

				<button id="addtrans" style="float:right;" onclick="openBasket()" name="btnadduser" type="button" class="btn_small btn_blue"><span>{{__('toneoflist.Add_Land_Standard')}}</span></button>
				<br>
			</div>
		
			<div class="widget_wrap">					
				<div class="widget_content">						
					<table style="width: 100%" id="landtable" class="display">


						<div class="social_activities">
							<div class="comments_s">
								<div class="block_label">
									{{__('toneoflist.Count')}}<span id="prop_count">0</span>
								</div>
							</div>



							<select id='testSelect1' style="float: right;" multiple>
								<option value='1'>{{__('toneoflist.Basket')}}</option>
								<option value='2'>{{__('toneoflist.Zone')}}</option>
								<option value='3'>{{__('toneoflist.Subzone')}}</option>
								<option value='4'>{{__('toneoflist.Property_Category')}}</option>
								<option value='5'>{{__('toneoflist.Property_Type')}}</option>
								<option value='6'>{{__('toneoflist.Property_Storey')}}</option>
								<option value='7'>{{__('toneoflist.Standard_Area')}}</option>
								<option value='8'>{{__('toneoflist.Next_Area')}}</option>
								<option value='9'>{{__('toneoflist.Max_Level')}}</option>
								<option value='10'>{{__('toneoflist.Update_by_date')}}</option>
							</select>
								
						</div>	
					<thead style="text-align: left;">
					<tr>
						<th><input name="select_all" value="1" type="checkbox"></th>
						<th class="table_sno">{{__('toneoflist.SNo')}}</th>
						<th> {{__('toneoflist.ID')}} </th>
						<th> {{__('toneoflist.Tone_Basket')}} </th>
						<th> {{__('toneoflist.Zone')}} </th>
						<th> {{__('toneoflist.Subzone')}} </th>
						<th> {{__('toneoflist.Property_Category')}}  </th>
						<th> {{__('toneoflist.Property_Type')}}  </th>
						<th> {{__('toneoflist.Property_Storey')}}  </th>
						<th> {{__('toneoflist.Standard_Area')}} </th>
						<th> {{__('toneoflist.Next_Area')}} </th>
						<th> {{__('toneoflist.Max_Level')}} </th>
						<th> {{__('toneoflist.Update_by_date')}}</th>
						<th> {{__('toneoflist.Status')}} </th>
						<th> {{__('toneoflist.Action')}} </th>

					</tr>
					</thead>
					<tbody>
					</tbody>
					</table>

					@foreach ($result as $rec)	
					
					<div style="display:none">
						<input type="hidden" id="basketid_{{ $rec->tstand_id }}" value="{{ $rec->tstand_tone_id }}">
						<input type="hidden" id="subzone_{{ $rec->tstand_id }}" value="{{ $rec->tstand_subzon_id }}">
						<input type="hidden" id="proptype_{{ $rec->tstand_id }}" value="{{ $rec->tstand_proptype_id }}">
						<input type="hidden" id="propstoery_{{ $rec->tstand_id }}" value="{{ $rec->tstand_propstorey_id }}">			
						<input type="hidden" id="standartarea_{{ $rec->tstand_id }}" value="{{ $rec->tstand_standartarea }}">	
						<input type="hidden" id="maxlevel_{{ $rec->tstand_id }}" value="{{ $rec->tstand_maxlevel }}">	
						<input type="hidden" id="nexarea_{{ $rec->tstand_id }}" value="{{ $rec->tstand_nextarea }}">
						<input type="hidden" id="zone_{{ $rec->tstand_id }}" value="{{ $rec->zoneid }}">		
						<input type="hidden" id="propcate_{{ $rec->tstand_id }}" value="{{ $rec->propcategory }}">
					</div>
					@endforeach
				</div>
			</div>
		</div>
				
		<div id="addbasketform" style="display:none" class="grid_12">
			<div class="widget_wrap">
				
				<div class="widget_content">
					<h3 id="title">{{__('toneoflist.Add_Basket')}}</h3>
					<form id="basketform" autocomplete="off" method="post" action="#" >
						<div  class="grid_6 form_container left_label">
							<ul>
								<li>
									<input type="hidden" name="operation" id="operation">
									<input type="hidden" name="landid" id="landid">
									<input type="hidden" name="jsondata" id="jsondata">
									<fieldset>
										<legend>{{__('toneoflist.Basket_Information')}}</legend>
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">{{__('toneoflist.Basket')}} <span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="basketid" name="basketid" tabindex="20">
													<option></option>
													@foreach ($basket as $rec)
														<option value='{{ $rec->tollist_id }}'>{{ $rec->tollis_year }} - {{ $rec->tollis_desc }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('toneoflist.Zone')}} <span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="zone" name="zone" tabindex="20">
													<option></option>
													@foreach ($zone as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">{{__('toneoflist.Subzone')}} <span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="subzone" name="subzone" tabindex="20">
													<option></option>
													@foreach ($subzone as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('toneoflist.Property_Category')}} <span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="bldgcate" name="bldgcate" tabindex="20">
													<option></option>
													@foreach ($bldgcate as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">{{__('toneoflist.Property_Type')}} <span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="proptype" name="proptype" tabindex="20">
													<option></option>
													@foreach ($bldgtype as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">{{__('toneoflist.Property_Storey')}}<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="propstoery" name="propstoery" tabindex="20">
													<option></option>
													@foreach ($bldgstore as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('toneoflist.Standard_Area')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="standardarea" name="standardarea"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('toneoflist.Next_Area')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="nextarea" name="nextarea"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('toneoflist.Max_Level')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="maxarea" name="maxarea"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>
									
									</fieldset>

			
								</li>
							</ul>
						</div>
						
						<div style="height: 48px; float: none; display: -webkit-box;text-align: -webkit-center;" class="grid_12">							
							<div class="form_input">
								<button id="addsubmit" name="adduser" onclick="validateBasket()" class="btn_small btn_blue"><span>{{__('common.Submit')}}</span></button>									
								
								<button id="close" onclick="closeBasket()" name="close" type="button" class="btn_small btn_blue"><span>{{__('common.Close')}}</span></button>
								<span class=" label_intro"></span>
							</div>								
							<span class="clear"></span>
						</div>
					</form>
				</div>
			</div>
		</div>
	<span class="clear"></span>
	
<script src="js/propertyregister/tab-script.js"></script>
</div>

<script>
	function editBasket(id){
		$("#title").html("Update Land Standard");
		$('#basketid').val($('#basketid_'+id).val());
		$('#subzone').val($('#subzone_'+id).val());
		$('#proptype').val($('#proptype_'+id).val());
		$('#propstoery').val($('#propstoery_'+id).val());
		$('#standardarea').val($('#standartarea_'+id).val());
		$('#maxarea').val($('#maxlevel_'+id).val());
		$('#nextarea').val($('#nexarea_'+id).val());
		$('#zone').val($('#zone_'+id).val());
		$('#bldgcate').val($('#propcate_'+id).val());
		

	    	var param_value = $('#zone_'+id).val();
	    	var param = 'subzone';
	        $.ajax({
			  url: "subCategory",
			  cache: false,
			  data:{param_value:param_value,param:param},
			  success: function(data){
	    		createDropDownOptions(data.res_arr, 'subzone');
				$('#subzone').val($('#subzone_'+id).val());
			  }
			});
	   

	   
	    	param_value = $('#propcate_'+id).val();
	    	param = 'bldgtype';
	        $.ajax({
			  url: "subCategory",
			  cache: false,
			  data:{param_value:param_value,param:param},
			  success: function(data){
	    		createDropDownOptions(data.res_arr, 'proptype');
	    		createDropDownOptions(data.res_arr2, 'propstoery');
				$('#proptype').val($('#proptype_'+id).val());
				$('#propstoery').val($('#propstoery_'+id).val());
			  }
			});
	    
		$('#landid').val(id);
		$('#operation').val(2);
		$("#basket_table").hide();
		$("#addbasketform").show();
	 	$("label.error").remove();
	}

	function openBasket(){
		$("#title").html("Add Land Standard");
		$('#basketid').val('');
		$('#subzone').val('');
		$('#proptype').val('');
		$('#propstoery').val('');
		$('#standardarea').val('');
		$('#maxarea').val('');
		$('#nextarea').val('');
		$('#zone').val('');
		$('#bldgcate').val('');
		
		$('#landid').val(0);
		$('#operation').val(1);
		$("#basket_table").hide();
		$("#addbasketform").show();
	 	$("label.error").remove();
	}
	
	function closeBasket(){
		$("#basket_table").show();
		$("#addbasketform").hide();
	 	$("label.error").remove();
		
	}
	
	function deleteBasket(id) {
		$('#operation').val(3);
		$('#landid').val(id);
		$('#basketid').val(0);
		$('#value').val(0);
		
		var noty_id = noty({
			layout : 'center',
			text: 'Do you want Delete?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Delete', click: function($noty) {
		  
					// this = button element
					// $noty = $noty element
		  			var tenantdata = {};
		        	$('#basketform').serializeArray().map(function(x){tenantdata[x.name] = x.value;});

		            //console.log(tenantdata);
		            var tenantjson = JSON.stringify(tenantdata);
		            //$('#jsondata').val(tenantjson);
		            //console.log(tenantjson);
		            window.location.assign('tonelandstandarttrn?jsondata='+tenantjson);
					$noty.close();
					//noty({force: true, text: 'You clicked "Ok" button', type: 'success',layout : 'center',modal : true,});
				  }
				},
				{type: 'button green', text: 'Cancel', click: function($noty) {
					$noty.close();
					//noty({force: true, text: 'You clicked "Cancel" button', type: 'error',layout : 'center',modal : true,});
				  }
				}
				],
			type : 'success', 
		});
	}

	function validateBasket(){
		$('#basketform').validate({
	        rules: {
	            postcode: {
	                required: true,
	                minlength: 5,
	                maxlength: 6,
	            },basketid: {
	                required: true
	            },zone: {
	                required: true
	            },subzone: {
	                required: true
	            },proptype: {
	                required: true
	            },propstoery: {
	                required: true
	            },bldgcate: {
	                required: true
	            },
	            value: {
				     required: true
				  }
	        },
	        messages: {
				firstname: "Enter your firstname"
	        },
	        submitHandler: function(form) {
	        	if($('#operation').val() ==1 ) {
	        		msg ="Do you want Add?";
	        	} else {
	        		msg ="Do you want update?";
	        	}
	        	var noty_id = noty({
			layout : 'center',
			text: msg,
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Update', click: function($noty) {
		  
					var d=new Date();
	        	

				
					
					var transdata = {};
			        	$('#basketform').serializeArray().map(function(x){transdata[x.name] = x.value;});

			            //console.log(transdata);
			            var transjson = JSON.stringify(transdata);
			            //$('#jsondata').val(transjson);
			            //console.log(tenantjson);
			            //window.location.assign('tonelandstandarttrn?jsondata='+transjson)
			            //$('#tenantform').submit();
						$.ajax({
							  url: "tonelandstandarttrn",
							  cache: false,
							  data:{jsondata:transjson},
							  success: function(data){
							    //$("#results").append(html);
							    alert('Record added/updated success');
							  }
						});				
					
					$noty.close();
					//noty({force: true, text: 'You clicked "Ok" button', type: 'success',layout : 'center',modal : true,});
				  }
				},
				{type: 'button green', text: 'Cancel', click: function($noty) {
					$noty.close();
					//noty({force: true, text: 'You clicked "Cancel" button', type: 'error',layout : 'center',modal : true,});
				  }
				}
				],
			type : 'success', 
		});
	        }
	    });
	}

	function approve(id,currstatus){
		
		var noty_id = noty({
			layout : 'center',
			text: 'Are you sure want to Submit?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Submit', click: function($noty) {
					$noty.close();
					$.ajax({
		  				type: 'GET', 
					    url:'approve',
					    headers: {
						    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
				        data:{param_value:id,module:'tonelandstandart',param:currstatus},
				        success:function(data){	        	
				        	
							window.location.assign("tonelandstandart");	
							
			        	},
				        error:function(data){
							//$('#loader').css('display','none');	
				        	alert('error');
			        	}
			    	});
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

	function approve(id,currstatus,type){
		var param_str ="";
		if(type == 1){
			param_str = 'AP';
		} else {
			param_str = 'RJ';
		}
	
		var noty_id = noty({
			layout : 'center',
			text: 'Are you sure want to Submit?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Submit', click: function($noty) {
					$noty.close();
					$.ajax({
		  				type: 'GET', 
					    url:'approve',
					    headers: {
						    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
				        data:{param_value:id,module:'tonelandstandart',param:currstatus,param_str:param_str },
				        success:function(data){	        	
				        	
							window.location.assign("tonelandstandart");	
							
			        	},
				        error:function(data){
							//$('#loader').css('display','none');	
				        	alert('error');
			        	}
			    	});
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

	$(document).ready(function() {


		$('#landtable').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				"lengthMenu":  [100, 200, 500, 1000],
				"dom": '<"top"i>rt<"bottom"flp><"clear">',
		        "ajax": {
		            "type": "GET",
		            "url": 'tonelandsdtable',
		            "contentType": 'application/json; charset=utf-8',
				    "headers": {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		        },
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
			        {"data": "tland_id", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": null, "name": "sno", "title": "S No"},
			        {"data": "tstand_id", "name": "fileno"},
			        {"data": "tollis_year", "name": "fileno"},
			        {"data": "zone", "name": "zone"},
			        {"data": "subzone", "name": "subzone"},
			        {"data": "category", "name": "address"},
			        {"data": "bldgtype", "name": "address"},
			        {"data": "bldgstorey", "name": "address"},
			        {"data": "tstand_standartarea", "name": "address"},
			        {"data": "tstand_nextarea", "name": "address"},
			        {"data": "tstand_maxlevel", "name": "address"},
			        {"data": function(data){
			        		//var url = 'datasearchdetail?prop_id='+data.vd_id; formatMoneyHas
			        		return data.tstand_updateby+" / "+data.tstand_updatedate+"</a>";
			        	
			        }, "name": "TO_OWNNAME"},
			        {"data": "approvalstatus", "name": "TO_OWNNO"},
			        {"data": function(data){
			        	
			        	var action = "";

			        		var editaction ="<span><a style='height: 16px; width: 15px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -943px -102px !important;display: inline-block;' onclick='editBasket("+data.tstand_id+")' href='#' title='Edit'></a></span> " +
							"&nbsp;&nbsp;<span><a style='height: 15px; width: 13px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -143px -23px !important;display: inline-block; '  onclick='deleteBasket("+data.tstand_id+")' href='#' title='Delete'></a></span>";

							if(data.tstand_approvaltstandstatus_id == '1' || data.tstand_approvaltstandstatus_id == '6'){
								action = editaction +  '<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('+data.tstand_id+',1)"  title="Submit To Approve" href="#"></a></span>';							
							} else if(data.tstand_approvaltstandstatus_id == '2'){
								action =   '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('+data.tstand_id+',2,1)"  title="Approve" href="#"></a></span>' + 
								'<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -542px -42px !important;display: inline-block; float: left;" onclick="approve('+data.tstand_id+',2,2)"  title="Reject" href="#"></a></span>';							
							} else if(data.tstand_approvaltstandstatus_id == '3'){
								action =  '<spane><a  class=" new-action-icons reverse" onclick="approve('+data.tstand_id+',3)" title="Revise" href="#"></a></span>';
						
							} else if(data.tstand_approvaltstandstatus_id == '4'){
								action =  editaction +   '<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('+data.tstand_id+',1)"  title="Submit To Approve" href="#"></a></span>';

							} else if(data.tstand_approvaltstandstatus_id == '5'){
								action =   '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('+data.tstand_id+',5)"  title="Approve Revise" href="#"></a></span>';						
							} 
							
			        									

			        		return action;

			        		
			        }, "name": "TO_OWNNO"}
		   		],
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  					var count = $('#landtable').DataTable().rows().count();
					$('#prop_count').html(count);
			        $("td:nth-child(2)", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
			        return nRow;
			    },
			    "sPaginationType": "full_numbers",
			"iDisplayLength": 100,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
		    'columnDefs': [{
         'targets': 0,
         'searchable': true,
         'orderable': false,
         'width': '1%',
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox">';
         }
      }],
      'rowCallback': function(row, data, dataIndex){
         // Get row ID
         var rowId = data[0];

         // If row ID is in the list of selected row IDs
         if($.inArray(rowId, rows_selected) !== -1){
            $(row).find('input[type="checkbox"]').prop('checked', true);
            $(row).addClass('selected');
         }
      },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			});

		document.multiselect('#testSelect1');
		//var table = $('#bldgtable').DataTable();
		//var column = table.column( 3);
		$('.multiselect-checkbox').click(function() {
			  // alert($(this).attr('data-val'););
			var id  = $(this).attr('data-val');
		    var table = $('#landtable').DataTable();
			var column = table.column( id);
			 //alert($('#'+id).prop("checked"));
			if (id != '-1') {
				column.visible( $(this).prop("checked"));
			}


		});
		//var hidecol = [4,5,6];
		// table hide colmn
		hideCol('landtable', [4,5,6]);
		
		defaultDatatableColumn(["1","2","3","7","8","9","10"]);

		$('.multiselect-wrapper .multiselect-list span:first').html('');
		$('#testSelect1_input').val('Columns');
		


			$('.multiselect-wrapper .multiselect-list span:first').html('');
		//$('.multiselect-wrapper .multiselect-list hr:first').html('');
 $('#landtable tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = $('#landtable').DataTable().row($row).data();

      // Get row ID
      var rowId = data[0];

      // Determine whether row ID is in the list of selected row IDs
      var index = $.inArray(rowId, rows_selected);

      // If checkbox is checked and row ID is not in list of selected row IDs
      if(this.checked && index === -1){
         rows_selected.push(rowId);

      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
      } else if (!this.checked && index !== -1){
         rows_selected.splice(index, 1);
      }

      if(this.checked){
         $row.addClass('selected');
      } else {
         $row.removeClass('selected');
      }

      // Update state of "Select all" control
      updateDataTableSelectAllCtrl($('#landtable').DataTable());

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

  

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', $('#landtable').DataTable().table().container()).on('click', function(e){
      if(this.checked){
        $('#landtable tbody input[type="checkbox"]').prop('checked', true);
         $('#landtable tbody tr').addClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      } else {
         $('#landtable tbody input[type="checkbox"]').prop('checked', false);
         $('#landtable tbody tr').removeClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });
		var count = $('#landtable').DataTable().rows().count();
		$('#prop_count').html(count);




		$("#zone").change(function() {
	    	//console.log(this.value);
	    	var param_value = this.value;
	    	var param = 'subzone';
	        $.ajax({
			  url: "subCategory",
			  cache: false,
			  data:{param_value:param_value,param:param},
			  success: function(data){
			    //$("#results").append(html);
			    var d = jQuery.parseJSON(data.res_arr);
			    //console.log(d);
			    console.log(data.res_arr.length);
			    console.log(data.res_arr[0].tdi_value);
			     //$('#zone').append('<option value=""></option>');
	    		createDropDownOptions(data.res_arr, 'subzone')
			  }
			});
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
	    		createDropDownOptions(data.res_arr, 'proptype');
	    		createDropDownOptions(data.res_arr2, 'propstoery');
			  }
			});
	    });
	});
</script>
</body>
</html>