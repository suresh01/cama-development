<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('existspropertyregisyter.Property_Registration')}}</title>
<style type="text/css">

#proptble td.numericCol {
	text-align: right;
}

.multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}

</style>
@include('includes.header', ['page' => 'datamaintenance'])
	
	<div id="content">
		<div class="grid_container">

	<div id="usertable" class="grid_12">
		<br>
		<div class="form_input">
			<div  id="basic-modal-content">
				<h3>{{__('existspropertyregisyter.Property_Registration')}}</h3>
				<form onsubmit="target_popup(this)" action="tableview" id="filterForm" method="get" class="form_container">
					@csrf
					<input type="hidden" name="pb_id" value="{{$pb}}">
					<input type="hidden" name="pb" value="{{$pb}}">
					<input type="hidden" name="filter" value="true">
					<ul id="filterrow">
						<li>
							<div class="form_grid_12">
								<label class="field_title" id="llevel" for="level">{{__('existspropertyregisyter.Page_Type')}} <span class="req">*</span></label>
								<div class="form_input ">
									<select style="width: 50%;" onchange="changeField(this.value)" data-placeholder="Choose a Role..." class="cus-select" id="pagetype" name="type" tabindex="20">
										<option value='tab'>Tab View</option>
										<option value='table'>Table View</option>
									</select>
								</div>
								<span class=" label_intro"></span>
							</div>
							<div id="maxrow" style="display:none;" class="form_grid_12">
								<label class="field_title" id="llevel" for="level">{{__('existspropertyregisyter.Max_Row')}}<span class="req">*</span></label>
								<div class="form_input ">
									<input id="username" style="width: 50%;" required="true" name="maxrow" type="text"  value="" />
								</div>
								<span class=" label_intro"></span>
							</div>
						</li>
					</ul>
					
					<div class="btn_24_blue">
						<!--<button id="addsubmit"type="submit" class="btn_small btn_blue"><span>Submit</span></button>-->
						<a href="#" onclick="submitForm()" class=""><span>{{__('common.Submit')}}  </span></a>
					</div>
					<div class="btn_24_blue">
						<a href="#" class="simplemodal-close"><span>{{__('common.Close')}}  </span></a>
					</div>
				</form>
			</div>
		</div>
		<div class="breadCrumbHolder module">
			<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_6">
				<ul>
					<li><a href="#">{{__('existspropertyregisyter.Home')}} </a></li>
					<li><a href="#">{{__('existspropertyregisyter.Data_Maintenance')}} </a></li>
					<li><a href="existspropertybasket">{{__('existspropertyregisyter.Property_Maintenance')}} </a></li>
					<li>{{$basket_name}} </li>
				</ul>
			</div>
		</div>
		@if($basket_status != '03')
		<div style="float:right;margin-right: 10px;"  class="btn_24_blue">
			<!--<a href="#" class="basic-modal"><span>Add Property</span></a>-->
			<a href="#" onclick="addExisitingProperty()">{{__('existspropertyregisyter.Add_Exsisting_Property')}} </a>
		</div>
		@endif
		<br>
		<div class="widget_wrap">
			<div class="widget_content">
				@php
				$bldgcount = '0';
				$approvecount = 0;
				$pending_count = 0;
				@endphp
				@foreach($propertydetail as $rec)
				@php
				$bldgcount = $rec->bldgcount;
				$approvecount = $rec->approvecount;
				$pending_count = $rec->pending_count;
				@endphp
				@endforeach
				<div class="social_activities">
					<div style="width: 200px;" class="comments_s">
						<div style="width: 200px;" class="block_label">
							{{__('existspropertyregisyter.Total_Building_Count')}} <span id="">{{$bldgcount}}</span>
						</div>
					</div>
					<div class="comments_s">
						<div class="block_label">
							{{__('existspropertyregisyter.Total_Property')}} <span id="prop_count">0</span>
						</div>
					</div>
					<div class="comments_s">
						<div class="block_label">
							{{__('existspropertyregisyter.Approved')}} <span>{{$approvecount}}</span>
						</div>
					</div>
					<div class="comments_s">
						<div class="block_label">
							{{__('existspropertyregisyter.Pending')}}  <span>{{$pending_count}}</span>
						</div>
					</div>
				</div>
				
				<br>
				
				<div><p id="info">0 {{__('existspropertyregisyter.Row_Selected')}} </p></div>
				<table id="propertytable" class="display select">
					<thead style="text-align: left;">
						<tr>
							<th><input name="select_all" value="1" type="checkbox"></th>
							<th class="table_sno">
								{{__('existspropertyregisyter.SNo')}}
							</th>
							<th>
								{{__('existspropertyregisyter.Account_Number')}} 
							</th>
							<th>
								{{__('existspropertyregisyter.Application_Type')}} 
							</th>
							<th>
								{{__('existspropertyregisyter.Zone')}} 
							</th>
							<th>
								{{__('existspropertyregisyter.SubZone')}}
							</th>
							<th>
								{{__('existspropertyregisyter.Is_Empty_Lot')}}
							</th>
							<th>
								{{__('existspropertyregisyter.Address1')}} 
							</th>
							<th>
								{{__('existspropertyregisyter.Address2')}} 
							</th>
							<th>
								{{__('existspropertyregisyter.Owner_Count')}}
							</th>
							<th>
								{{__('existspropertyregisyter.Status')}} 
							</th>
							<th>
								{{__('existspropertyregisyter.Action')}} 
							</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
				
		
		
	</div>
	<span class="clear"></span>
	<!--<div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Tutorials
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a tabindex="-1" href="#">HTML</a></li>
      <li><a tabindex="-1" href="#">CSS</a></li>
      <li class="dropdown-submenu">
        <a class="test" tabindex="-1" href="#">New dropdown <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
          <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
          <li class="dropdown-submenu">
            <a class="test" href="#">Another dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">3rd level dropdown</a></li>
              <li><a href="#">3rd level dropdown</a></li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </div>-->
<script>
	function addExisitingProperty() {		
	    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
	    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
	        w.location = "existspropertymaintanance?type=2&id={{$pb}}&aptype=KAD";
	    }	    
	    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
		{
			w.moveTo(0,0);
			w.resizeTo(screen.availWidth, screen.availHeight);
		}
	}


	function submitForm(){
		$('#filterForm').submit();
	}

	function selectedrow(){
		  var table = $('#propertytable').DataTable();
		  var count = 0;
		  $.map(table.rows('.selected').data(), function (item) {
		       count++;
		    });
		  return count;
		}

	function showCheckboxes() {
	  	var checkboxes = document.getElementById("checkboxes");
	  	if (!expanded) {
		    checkboxes.style.display = "block";
		    expanded = true;
	  	} else {
		    checkboxes.style.display = "none";
		    expanded = false;
	  	}
	}

function hidecl(id){
var table = $('#proptble').DataTable();
	var column = table.column( id);
	 //alert($('#'+id).prop("checked"));
	  column.visible( $('#'+id).prop("checked"));
 		
}

		function updateDataTableSelectAllCtrl(table){
		   var $table             = table.table().node();
		   var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
		   var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
		   var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

			   // If none of the checkboxes are checked
		   if($chkbox_checked.length === 0){
		      chkbox_select_all.checked = false;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = false;
		      }

		   // If all of the checkboxes are checked
		   } else if ($chkbox_checked.length === $chkbox_all.length){
		      chkbox_select_all.checked = true;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = false;
		      }

		   // If some of the checkboxes are checked
		   } else {
		      chkbox_select_all.checked = true;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = true;
		      }
		   }
			$('#info').html(selectedrow() + " Row Selected");
		}

		function changeField(val){
			if(val == 'table'){
				$('#maxrow').removeAttr('style');
			} else {
				$('#maxrow').attr('style', "display:none;");
			}
		}

		function target_popup(form) {
			var pagetype = $('#pagetype').val();
			if(pagetype === 'table'){
			    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');

			    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
			        w.location = form.url;
			    }	    
			    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
				{
					w.moveTo(0,0);
					w.resizeTo(screen.availWidth, screen.availHeight);
				}
			    //w.focus();
			    form.target = 'Popup_Window';
			    	  
			}
		}
 
		function check_access_local(id){
			$.ajax({
		        type:'GET',
		        url:'/getaccess',
		        data:{module:323},
		        success:function(data){	        	
		        	if(data.msg === "false"){
		        		//alert("You Don't have permission");
		        		window.location.href = "accessdenied?id="+323;

		        		/*alert(module+" - "
		        			+"We are sorry "
							+" The page you are trying to reach dose not have permission :(");*/
		        		return;
		        	} else {
						window.location.href = "maintenancepropertydetail?type=tab&pb_id={{$pb}}&prop_id="+id;
		        	}
		        }
		    });
		}
		$(document).ready(function(){
			
			var table = $('#propertytable').DataTable({
		        "processing": false,
		        "serverSide": false,
		      
		        "ajax": {
		            "type": "GET",
		            "url": 'propertytables?pb={{$pb}}',
		            "contentType": 'application/json; charset=utf-8',
				    "headers": {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		        },
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [

			        {"data": "ma_id", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": null, "name": "sno"},
			        {"data": function(data){
			        	//var openurl = "tableview?type=tab&pb_id={{$pb}}&prop_id="+data.ma_id+"";
			            return "<a onclick='check_access_local("+data.ma_id+")' href='#'>"+data.ma_accno+"</a>";
			         //   return "<a onclick='check_access("+openurl+")' href='tableview?type=tab&pb_id={{$pb}}&prop_id="+data.ma_id+"'>"+data.ma_accno+"</a>";
			        },  "name": "account number"},
			        {"data": "applntype", "name": "applntype"},
			        {"data": "zone", "name": "zone"},
			        {"data": "subzone", "name": "subzone"},
			        {"data": "isbldg", "name": "ishasbldg"},
			        {"data": "ma_addr_ln1", "name": "address"},
			        {"data": "ma_addr_ln1", "name": "address"},
			        {"data": "owncount", "name": "ownername"},
			        {"data":  "propstatus", "name": "status"},
			        {"data": function(data){
			        	if ('{{$basket_status}}' == '01' || '{{$basket_status}}' == '02' ){
				        	if(data.ma_approvalstatus_id == '02'){
				        		return '<span><a onclick="deleteProperty('+data.ma_id+')" class="action-icons c-delete dellotrow deletelotrow" href="#" title="Delete Property">Delete</a></span><span><a class="action-icons c-approve" onclick="approveProperty('+data.ma_id+')" title="Approve Property Registration" href="#">Approve</a></span>';
				        	} else if(data.ma_approvalstatus_id == '03'){
				        		return '<span><a onclick="enableProperty('+data.ma_id+')" class="action-icons c-cancel dellotrow deletelotrow" href="#" title="Enable Edit">Cancel</a></span>';
				        	} 

				        	
			        	}

			        	return '';
			            
			        }, "name": "action"}
		   		],
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
			        $("td:nth-child(2)", nRow).html(iDisplayIndex + 1);
			        var count = $('#propertytable').DataTable().rows().count();
					$('#prop_count').html(count);
			        return nRow;
			    },
			    "sPaginationType": "full_numbers",
			"iDisplayLength": 100,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
		    'columnDefs': [{
         'targets': 0,
         'searchable': false,
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
			$("div.table_top select").addClass('tbl_length');
		$(".tbl_length").chosen({
			disable_search_threshold: 4	
		});

			 var rows_selected = [];
   
    
   

   // Handle click on checkbox
   $('#propertytable tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = $('#propertytable').DataTable().row($row).data();

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
      updateDataTableSelectAllCtrl($('#propertytable').DataTable());

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', $('#propertytable').DataTable().table().container()).on('click', function(e){
      if(this.checked){
        $('#propertytable tbody input[type="checkbox"]').prop('checked', true);
         $('#propertytable tbody tr').addClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      } else {
         $('#propertytable tbody input[type="checkbox"]').prop('checked', false);
         $('#propertytable tbody tr').removeClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle table draw event
   $('#propertytable').DataTable().on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl($('#propertytable').DataTable());
   });

		  
		});


		function deleteProperty(id){
			var table = $('#propertytable').DataTable();
			//console.log(table.rows('.selected').data());
			var account = $.map(table.rows('.selected').data(), function (item) {
				//console.log(item);
		    	return item['ma_id']
			});
			
			//console.log(account.length);
			//console.log(account.toString());
			if (account.length > 0){
				id = account.toString();
			}
			$.ajax({
		        type:'GET',
		        url:'/getaccess',
		        data:{module:3233},
		        success:function(data){	        	
		        	if(data.msg === "false"){
		        		
		        		alert(3233 + access_denied_function);
		        		return status;
		        	} else {
		        		//return "true";
		        		var noty_id = noty({
							layout : 'center',
							text: 'Are want to delete property?',
							modal : true,
							buttons: [
								{type: 'button pink', text: 'Delete', click: function($noty) {
									$noty.close();
									$.ajax({
						  				type: 'GET', 
									    url:'approve',
									    headers: {
										    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
										},
								        //data:{param_value:id,module:'DELP'},
								         data:{param_value:0,module:'DELP',param:id},
								        success:function(data){		
											
											window.location.assign('propertyregister?pb={{$pb}}');		        		
								        	//$("#finish").attr("disabled", true);
								        	//clearTableError(4); 
							        	},
								        error:function(data){
											//$('#loader').css('display','none');	
								        	$('#finishloader').html('');     	
								        		var noty_id = noty({
												layout : 'top',
												text: 'Something went wrong!',
												modal : true,
												type : 'error', 
											});
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
		        }
		    });
			
			
		}


		function enableProperty(id){
			var noty_id = noty({
					layout : 'center',
					text: 'Are want to cancel approval?',
					modal : true,
					buttons: [
						{type: 'button pink', text: 'Enable Edit', click: function($noty) {
							$noty.close();
							$.ajax({
				  				type: 'GET', 
							    url:'approve',
							    headers: {
								    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
						        data:{param_value:id,module:'IPCA'},
						        success:function(data){		
									
									window.location.assign('propertyregister?pb={{$pb}}');		        		
						        	//$("#finish").attr("disabled", true);
						        	//clearTableError(4); 
					        	},
						        error:function(data){
									//$('#loader').css('display','none');	
						        	$('#finishloader').html('');     	
						        		var noty_id = noty({
										layout : 'top',
										text: 'Something went wrong!',
										modal : true,
										type : 'error', 
									});
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

		function approveProperty(id){
			var table = $('#propertytable').DataTable();
			//console.log(table.rows('.selected').data());
			var account = $.map(table.rows('.selected').data(), function (item) {
				//console.log(item);
		    	return item['ma_id']
			});
			
			//console.log(account.length);
			//console.log(account.toString());
			if (account.length > 0){
				id = account.toString();
			}

			$.ajax({
		        type:'GET',
		        url:'/getaccess',
		        data:{module:3234},
		        success:function(data){	        	
		        	if(data.msg === "false"){
		        		
		        		alert(3234 + access_denied_function);
		        		return status;
		        	} else {
		        		//return "true";
		        		var noty_id = noty({
							layout : 'center',
							text: 'Are want to approve property?',
							modal : true,
							buttons: [
								{type: 'button pink', text: 'Approve', click: function($noty) {
									$noty.close();
									$.ajax({
						  				type: 'GET', 
									    url:'approve',
									    headers: {
										    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
										},
								        data:{param_value:0,module:'IPA',param:id},
								        success:function(data){
								        	var noty_id = noty({
												layout : 'top',
												text: 'Property Approved!',
												modal : true,
												type : 'success', 
											});			
											
											window.location.assign('propertyregister?pb={{$pb}}');		        		
								        	//$("#finish").attr("disabled", true);
								        	//clearTableError(4); 
							        	},
								        error:function(data){
											//$('#loader').css('display','none');	
								        	$('#finishloader').html('');     	
								        		var noty_id = noty({
												layout : 'top',
												text: 'Problem while approve property!',
												modal : true,
												type : 'error', 
											});
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
		        }
		    });
			
		}
	</script>
</div>
</body>
</html>