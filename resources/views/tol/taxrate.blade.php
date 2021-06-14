<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('toneoflist.TOL_Tax_Rate')}} </title>
@include('includes.header', ['page' => 'TOL'])
	<div id="content">
		<div class="grid_container">
		<div id="basket_table" class="grid_12">			
			<br>
			<div class="form_input">
				

				<div id="breadCrumb3" class="breadCrumb grid_3">
					<ul >
						<li><a href="#">{{__('toneoflist.Home')}} </a></li>
						<li><a href="#">{{__('toneoflist.Tone_of_List')}} </a></li>
						<li>{{__('toneoflist.Tax_Rate')}} </li>
					</ul>
				</div>
				
				@include('tol.search',['tableid'=>'taxtable', 'action' => 'tonetaxtable', 'searchid' => '30'])

				<button id="addtrans" onclick="openBasket()" style="float:right;" name="btnadduser" type="button" class="btn_small btn_blue"><span>{{__('toneoflist.Add_Tax_Rate')}} </span></button>
				<br>
			</div>
		
			<div class="widget_wrap">					
				<div class="widget_content">						
					<table id="taxtable" class="display ">

						<div class="social_activities">
							<div class="comments_s">
								<div class="block_label">
									{{__('toneoflist.Count')}} <span id="prop_count">0</span>
								</div>
							</div>



								
						</div>	



					<thead style="text-align: left;">
					<tr>
						<th><input name="select_all" value="1" type="checkbox"></th>
						<th class="table_sno">{{__('toneoflist.SNo')}}  </th>
						<th>{{__('toneoflist.ID')}}  </th>
						<th>{{__('toneoflist.Rate_Basket')}}  </th>
						<th>{{__('toneoflist.Zone')}}  </th>
						<th>{{__('toneoflist.Property_Category')}}  </th>
						<th>{{__('toneoflist.Property_Type')}}  </th>
						<th>{{__('toneoflist.Has_Building')}} </th>
						<th>{{__('toneoflist.Value')}}  </th>
						<th>{{__('toneoflist.Update_by_date')}}</th>
						<th>{{__('toneoflist.Status')}}  </th>
						<th>{{__('toneoflist.Action')}}  </th>
						
					</tr>
					</thead>
					<tbody>
					</tbody>
					</table>

					@foreach ($taxrate as $rec)	
					
					<div style="display:none">
						<input type="hidden" id="basketid_{{ $rec->trate_id }}" value="{{ $rec->trate_trlist_id }}">
						<input type="hidden" id="zone_{{ $rec->trate_id }}" value="{{ $rec->trate_zon_id }}">
						<input type="hidden" id="hasbldg_{{ $rec->trate_id }}" value="{{ $rec->trate_ishasbuilding_id }}">	
						<input type="hidden" id="proptype_{{ $rec->trate_id }}" value="{{ $rec->trate_proptype_id }}">			
						<input type="hidden" id="value_{{ $rec->trate_id }}" value="{{ $rec->trate_value }}">
						<input type="hidden" id="propcate_{{ $rec->trate_id }}" value="{{ $rec->propcategory }}">
					</div>
					@endforeach
				</div>
			</div>
		</div>
				
		
		
		<div id="addbasketform" style="display:none" class="grid_12">
			<div class="widget_wrap">
				
				<div class="widget_content">
					<h3 id="title">{{__('toneoflist.Add_Tax_Rate')}} </h3>
					<form id="basketform" autocomplete="off" method="post" action="#" >
						<div  class="grid_6 form_container left_label">
							<ul>
								<li>
									<input type="hidden" name="operation" id="operation">
									<input type="hidden" name="taxid" id="taxid">
									<input type="hidden" name="jsondata" id="jsondata">
									<fieldset>
										<legend>{{__('toneoflist.Basket_Information')}} </legend>
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">{{__('toneoflist.Basket')}} <span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="basketid" name="basketid" tabindex="20">
													<option></option>
													@foreach ($basket as $rec)
														<option value='{{ $rec->trlist_id }}'>{{ $rec->trlist_year }} - {{ $rec->trlist_desc }}</option>
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
											<label class="field_title" id="accnumberlbl" for="username">{{__('toneoflist.Has_Building')}}<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="hasbldg" name="hasbldg" tabindex="20">
													<option></option>
													@foreach ($hasbldg as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('toneoflist.Value')}} <span class="req">*</span></label>
											<div  class="form_input">
												<input id="value" name="value"  type="text"  maxlength="50" class="required"/>
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
	
</div>

<script src="js/propertyregister/tab-script.js"></script>
<script>
	function editBasket(id){
		$("#title").html("Update Building");
		$('#basketid').val($('#basketid_'+id).val());
		$('#zone').val($('#zone_'+id).val());
		$('#hasbldg').val($('#hasbldg_'+id).val());
		$('#proptype').val($('#proptype_'+id).val());
		$('#value').val($('#value_'+id).val());
		$('#bldgcate').val($('#propcate_'+id).val());
		
		var param_value = $('#propcate_'+id).val();
		var param = 'bldgtype';
	        $.ajax({
			  url: "subCategory",
			  cache: false,
			  data:{param_value:param_value,param:param},
			  success: function(data){
	    		createDropDownOptions(data.res_arr, 'proptype');
				$('#proptype').val($('#proptype_'+id).val());
			  }
			});

		$('#taxid').val(id);
		$('#operation').val(2);
		$("#basket_table").hide();
		$("#addbasketform").show();
	 	$("label.error").remove();
	}

	function openBasket(){
		$("#title").html("Add Building");
		$('#basketid').val('');
		$('#zone').val('');
		$('#hasbldg').val('');
		$('#proptype').val('');
		$('#value').val('');
		$('#bldgcate').val('');
		
		$('#taxid').val(0);
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
		$('#taxid').val(id);
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
		            window.location.assign('taxratetrn?jsondata='+tenantjson);
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
	            },
	            basketid: {
	            	required: true
	            },
	            zone: {
	            	required: true
	            },
	            proptype: {
	            	required: true
	            },
	            hasbldg: {
	            	required: true
	            },
	            bldgcate: {
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
			            //window.location.assign('taxratetrn?jsondata='+transjson)
			            //$('#tenantform').submit();
						$.ajax({
							  url: "taxratetrn",
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

	$(document).ready(function() {
		
		$('#taxtable').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				"lengthMenu":  [100, 200, 500, 1000],
				"dom": '<"top"i>rt<"bottom"flp><"clear">',
		        "ajax": {
		            "type": "GET",
		            "url": 'tonetaxtable',
		            "contentType": 'application/json; charset=utf-8',
				    "headers": {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		        },
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
			        {"data": "tland_id", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": null, "name": "sno", "title": "S No"},
			        {"data": "trate_id", "name": "fileno"},
			        {"data": "trlist_year", "name": "fileno"},
			        {"data": "zone", "name": "zone"},
			        {"data": "category", "name": "address"},
			        {"data": "bldgtype", "name": "address"},
			        {"data": "hasbldg", "name": "address"},
			        {"data": "trate_value", "name": "address"},
			        {"data": function(data){
			        		//var url = 'datasearchdetail?prop_id='+data.vd_id; formatMoneyHas
			        		return data.trate_updateby+" / "+data.trate_updatedate+"</a>";
			        	
			        }, "name": "TO_OWNNAME"},
			        {"data": "approvalstatus", "name": "address"},
			        {"data": function(data){
			        		//var url = 'datasearchdetail?prop_id='+data.vd_id; formatMoneyHas
			        		var action = "";

			        		var editaction ="<span><a style='height: 16px; width: 15px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -943px -102px !important;display: inline-block;' onclick='editBasket("+data.trate_id+")' href='#' title='Edit'></a></span> " +
							"&nbsp;&nbsp;<span><a style='height: 15px; width: 13px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -143px -23px !important;display: inline-block; '  onclick='deleteBasket("+data.trate_id+")' href='#' title='Delete'></a></span>";

							if(data.trate_approvaltratestatus_id == '1' || data.trate_approvaltratestatus_id == '6'){
								action = editaction +  '<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('+data.trate_id+',1)"  title="Submit To Approve" href="#"></a></span>';							
							} else if(data.trate_approvaltratestatus_id == '2'){
								action =   '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('+data.trate_id+',2,1)"  title="Approve" href="#"></a></span>' + 
								'<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -542px -42px !important;display: inline-block; float: left;" onclick="approve('+data.trate_id+',2,2)"  title="Reject" href="#"></a></span>';							
							} else if(data.trate_approvaltratestatus_id == '3'){
								action =  '<spane><a  class=" new-action-icons reverse" onclick="approve('+data.trate_id+',3)" title="Revise" href="#"></a></span>';
						
							} else if(data.trate_approvaltratestatus_id == '4'){
								action =  editaction +   '<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('+data.trate_id+',1)"  title="Submit To Approve" href="#"></a></span>';
															
							} else if(data.trate_approvaltratestatus_id == '5'){
								action =   '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('+data.trate_id+',5)"  title="Approve Revise" href="#"></a></span>';						
							} 
			        		
							

			        		return action;
			        		
			        	
			        }, "name": "TO_OWNNO"}
		   		],
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  					var count = $('#taxtable').DataTable().rows().count();
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
	    
	    var count = $('#taxtable').DataTable().rows().count();
		$('#prop_count').html(count);
		//$('#testSelect1_input').val('Columns');
			$('.multiselect-wrapper .multiselect-list span:first').html('');
		//$('.multiselect-wrapper .multiselect-list hr:first').html('');
 $('#taxtable tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = $('#taxtable').DataTable().row($row).data();

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
      updateDataTableSelectAllCtrl($('#taxtable').DataTable());

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

  

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', $('#taxtable').DataTable().table().container()).on('click', function(e){
      if(this.checked){
        $('#taxtable tbody input[type="checkbox"]').prop('checked', true);
         $('#taxtable tbody tr').addClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      } else {
         $('#taxtable tbody input[type="checkbox"]').prop('checked', false);
         $('#taxtable tbody tr').removeClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
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
			  }
			});
	    });
	});

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
				        data:{param_value:id,module:'taxrate',param:currstatus},
				        success:function(data){		        	
				        	
							window.location.assign("taxrate");	
							
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
				        data:{param_value:id,module:'taxrate',param:currstatus,param_str:param_str },
				        success:function(data){	        	
				        	
							window.location.assign("taxrate");	
							
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
</script>
</body>
</html>