<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Ownership Transfer Registeration</title>

@include('includes.header', ['page' => 'datamaintenance'])
	
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">	
					<br>
				<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Data Maintenance</a></li>
						<li>Ownership Transfer Registeration</li>
					</ul>
				</div>
				</div>
				
				<div style="float:right;margin-right: 10px;"  class="btn_24_blue">
					<a href="#" onclick="register()">Register</a>
						
				</div>
				<br>
        
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="proptble" class="display select">
							<thead style="text-align: left;">
								<tr>
									<th></th>
									<th class="table_sno">
										S No
									</th>
									<th>
										Register ID
									</th>
									<th>
										No Account
									</th>
									<th>
										Group
									</th>
									<th>
										Register By
									</th>
									<th>
										Register Date
									</th>	
									<th>
										Register Status
									</th>			
								</tr>
							</thead>
							<tbody>			
								@foreach ($ownregister as $rec)
								<tr>
									<td></td>
									<td>
										{{$loop->iteration}}
									</td>
									<td>
										{{$rec->otar_id}}
									</td>
									<td>
										{{$rec->otar_accno}}
									</td>
									<td>
										{{$rec->colgroup}}
									</td>
									<td>
										{{$rec->otar_createby}}
									</td>
									<td>
										{{$rec->otar_createdate}}
									</td>
									<td>
										{{$rec->colstatus}}
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
				</div>
			</div>
			
		
		<div style="display: none;" class="" id="register-modal-content">
				<h3>Register Owner Transfer</h3>
				<form action="ownerregistertrn" id="registerform" method="get" class="form_container">	
					@csrf
				
				<input type="hidden" name="al_id" id="al_id" value="true">	
						
					<div  class="grid_6 form_container left_label">
						<ul>
							<li>				
								<fieldset>
									<legend>New Registeration</legend>	
									
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">Account Number<span class="req">*</span></label>
										<div  class="form_input">
											<input onchange="validateAccount()" id="accountnumber" maxlength="12" tabindex="1" name="accountnumber"  type="text" maxlength="100" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">Group ID<span class="req">*</span></label>
										<div  class="form_input">
											<select placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="group" name="group" tabindex="2">
												<option value=""></option>
												
													@foreach ($group as $rec)
															<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									
									
								</fieldset>
							</li>
						</ul>
					</div>
					
					<div class="btn_24_blue">						
						<!--<button id="addsubmit"type="submit" class="btn_small btn_blue"><span>Submit</span></button>	-->
						<a href="#" onclick="update()" class=""><span>Register</span></a>	
					</div>
					<div class="btn_24_blue">
						<a href="#" class="simplemodal-close"><span>Close </span></a>
					</div>
				
					</form>
			</div>


		
	</div>
	</div>
	<span class="clear"></span>
	
	<script>

		function register(){
			$('#register-modal-content').modal();
		}

		function update(){
			var groupdata = {};
			$('#registerform').serializeArray().map(function(x){groupdata[x.name] = x.value;});
            var groupjson = JSON.stringify(groupdata);
            window.location.assign('ownerregistertrn?jsondata='+groupjson);	  
		}

		function validateAccount(){
			var accountnumber = $('#accountnumber').val();
			var valid = validateCall(accountnumber).done(function(data){
					       var count = data.res_arr;
							if (count == 0 ) {
								alert('Account Number Not exists');
								//$('#accnumber').focus();
								//alert('Account Number already exists');
							} else {
								//alert('Account Number Not exists');
							}
						});	
		}

		
		
		function validateCall(account){

			return $.ajax({
					        type: "GET",
					        url: "validateAccount",
					        data: {param_value:account},
					        cache: false
					    });
		    	
		}

		function changeField(val){
			if(val == 'table'){
				$('#maxrow').removeAttr('style');
			} else {
				$('#maxrow').attr('style', "display:none;");
			}
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
		}

$(document).ready(function (){

	

	var table = $('#proptble').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				 
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  	
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
   // Array holding selected row IDs
   var rows_selected = [];
   
    
   

   // Handle click on checkbox
   $('#proptble tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = $('#proptble').DataTable().row($row).data();

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
      updateDataTableSelectAllCtrl($('#proptble').DataTable());

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle click on table cells with checkboxes
   $('#proptble').on('click', 'tbody td, thead th:first-child', function(e){
      $(this).parent().find('input[type="checkbox"]').trigger('click');
   });

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', $('#proptble').DataTable().table().container()).on('click', function(e){
      if(this.checked){
         $('#proptble tbody input[type="checkbox"]:not(:checked)').trigger('click');
      } else {
         $('#proptble tbody input[type="checkbox"]:checked').trigger('click');
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle table draw event
   $('#proptble').DataTable().on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl($('#proptble').DataTable());
   });
   // Handle form submission event

});


	</script>
</div>

</body>
</html>