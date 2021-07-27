<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Ownership Transfer Log</title>

@include('includes.header', ['page' => 'datamaintenance'])
	
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">	
					<br>
				<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_4">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Data Maintenance</a></li>
						<li><a href="#">Ownership Transfer</a> </li>
						<li>Ownership Process Log</li>
					</ul>
				</div>
				</div>
				
				<div style="float:right;margin-right: 10px;"  class="btn_24_blue">
					
					<!--<a href="#" onclick="demo()">Demo</a>-->
					@include('ownershiptransfer.logsearch')
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
										Application ID
									</th>
									<th>
										No Account
									</th>
									<th>
										Application Type
									</th>
									<th>
										Transfer Status 
									</th>
									<th>
										Register Date
									</th>		
									<th>
										Transfer by /Date
									</th>
									<th>
										Updated by / Date
									</th>	
									<th>
										Applicator Name
									</th>
									<th>
										Id Type
									</th>	
									<th>
										Id No
									</th>	
									<th>
										Race
									</th>
									<th>
										Address 1
									</th>	
									<th>
										Address 2
									</th>	
									<th>
										Action
									</th>				
								</tr>
							</thead>
							<tbody>			
								
							</tbody>
						</table>
				</div>
			</div>
			
		
		
	</div>


	<div id="addDetail" style="display:none" class="grid_12">
					<div class="widget_wrap">
						
						<div class="widget_content">
							<h3 id="title">Generate Report</h3>
							<form style="" id="generateform" method="GET" action="generateOwnershipreport">
					            @csrf
					            <input type="hidden" name="type" id="type">
					            <input type="hidden" name="accountnumber" id="accountnumber">
								<div  class="grid_12 form_container left_label">
									<ul>
										<li>
											
											<fieldset>
												<legend>Additional Information</legend>
												
												<div class="form_grid_12">
													<label class="field_title" id="lposition" for="position">VALUER TITTLE<span class="req">*</span></label>
													<div  class="form_input">
														<select data-placeholder="Choose a Status..." onchange="getposition()"  style="width:100%" class="cus-select"  id="tittle" tabindex="7" name="tittle" tabindex="20">
																<option></option>
															@foreach ($userlist as $rec)
																	<option value='{{ $rec->usr_position }}'>{{ $rec->tbuser }}</option>
															@endforeach	
														</select>
													</div>
													<span class=" label_intro"></span>
												</div>
												
												<div class="form_grid_12">
													<label class="field_title" id="llevel" for="level">VALUER NAME<span class="req">*</span></label>
													<div  class="form_input">
														<input id="name" name="name"  type="text"  maxlength="50" class="required"/>
													</div>
													<span class=" label_intro"></span>
												</div>
											
											</fieldset>

					
										</li>
									</ul>
								</div>
								
								<div class="grid_12">							
									<div class="form_input">
										<button id="addsubmit" name="adduser" class="btn_small btn_blue"><span>Submit</span></button>									
										
										<button id="close" name="close" type="button" class="btn_small btn_blue simplemodal-close"><span>Close</span></button>
										<span class=" label_intro"></span>
									</div>								
									<span class="clear"></span>
								</div>
							</form>
						</div>
					</div>
				</div>
	<span class="clear"></span>
	
	<script>
		function reportSuccess(accno){
			$('#type').val('Successs');
			$('#accountnumber').val(accno);
			$('#addDetail').modal();
		}

		function reportFailure(accno){
			$('#type').val('Fail');
			$('#accountnumber').val(accno);
			$('#addDetail').modal();
		}

		function getposition(){
			var userid = $('#tittle').val();
			$('#username').val($("#tittle option:selected").text());
			$.ajax({
		        type:'GET',
		        url:'/getuserdetail',
		        data:{id:userid},
		        success:function(data){	        	
		        	console.log(data);
		        	$('#name').val(data.userposition);
		        }
		    });
		}

		function Resend(id){
			$.ajax({ 
  				type: 'GET', 
			    url:'ownertransferretrytrn',
			    headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
		        data:{otaid:id},
		        success:function(data){
		        	//$('#propertystatus').val('Registered');
					$('#finishloader').html('');
					var msg = 'Transferred successfully';
					
		        	var noty_id = noty({
						layout : 'top',
						text: msg,
						modal : true,
						type : 'success', 
					});			
		        	
					
				
	        	},
		        error:function(data){
						
		        	$('#finishloader').html('');     	
		        		var noty_id = noty({
						layout : 'top',
						text: 'Problem while update!',
						modal : true,
						type : 'error', 
					});
	        	}
	    	});
		}

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
				 "ajax": 'ownerlogdata',
		        "columns": [
			        {"data": "otar_id", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": null, "name": "sno"},
			        {"data": "ota_id", "name": "account number"},
			        {"data": "otar_accno", "name": "fileno"},
			        {"data": "ttype", "name": "zone"},
			        {"data": "logstatus", "name": "zone"},
			        {"data": "otar_createdate", "name": "subzone"},
			        {"data": "ota_transtocenterdate1", "name": "owner"}, 
			        {"data": function(data){
			        	var update = data.otar_updatedate;
			        		if(data.otar_updatedate == null){
			        			update = 'NA';
			        		}
			        	return data.ota_updateby +" / "+update;
			        }, "name": "owner"}, 
			        {"data": "ota_agentname", "name": "ishasbldg"},
			        {"data": "owntype", "name": "owntype"}, 
			        {"data": "TO_OWNNO", "name": "TO_OWNNAME"}, 
			        {"data": "ownrace", "name": "TO_OWNNAME"},
			        {"data": "ota_addr_ln1", "name": "TO_OWNNAME"},
			        {"data": "ota_addr_ln2", "name": "TO_OWNNAME"},
			        {"data": function(data) {
			        	var abdstr='';
			        	if(data.ttypekey == 4) {
							abdstr="<a href='#' style='	width: 14px;	height: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position:  -963px -2px;!important;display: inline-block; float: left;' title='Retry Transfer' onclick='Resend("+data.ota_id+")'></a>";
								//return abdstr;
						} else {
							if(data.otar_ownertranstype_id == 1 || data.otar_ownertranstype_id == 2) {
					        	if(data.otar_ownertransstatus_id == 5 || data.otar_ownertransstatus_id == 7 || data.otar_ownertransstatus_id == 8 || data.otar_ownertransstatus_id == 9) {
									return "<a href='#'  style='	width: 14px;	height: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position:  -843px -102px!important;display: inline-block; float: left;' title='Success Report' onclick='reportSuccess("+data.otar_accno+")'></a>"+abdstr;
								} else if(data.otar_ownertransstatus_id == 3 || data.otar_ownertransstatus_id == 6) {
									return "<a href='#' style='	width: 16px;	height: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position:  -983px -102px;!important;display: inline-block; float: left;'  title='Rejected Report' onclick='reportFailure("+data.otar_accno+")'></a>"+abdstr;
								}
							}
						}
			        	return '';
			        }, "name": "bldgcount"}
		   		],
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