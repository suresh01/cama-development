<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Valuation Form</title>
<style type="text/css">
  #proptble td.numericCol {
    text-align: right;
  }
</style>
@include('includes.header', ['page' => 'report'])
					
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">	
					<br>
				<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Report</a></li>
						<li>Valuation Form</li>
					</ul>
				</div>
				</div>

				<div style="float:right;margin-right: 10px;"  class="btn_24_blue">	
					<a href="#" onclick="deleteProperty()" >Generate Report</a>				
					@include('report.search.search',['tableid'=>'proptble', 'action' => 'valuationformtable', 'searchid' => '15'])
					
				</div>
				<br>

				<div id="addDetail" style="display:none" class="grid_12">
					<div class="widget_wrap">
						
						<div class="widget_content">
							<h3 id="title">Generate Report</h3>
							<form style="" id="generateform" method="GET" action="generatevaluation">
					            @csrf
					            <input type="hidden" name="accounts" id="accounts">
								<div  class="grid_12 form_container left_label">
									<ul>
										<li>
											
											<fieldset>
												<legend>Additional Information</legend>
												
												<div class="form_grid_12">
													<label class="field_title" id="lposition" for="position">VALUER NAME<span class="req">*</span></label>
													<div  class="form_input">
														<select onchange="getposition()" data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="tittle" tabindex="7" name="tittle1" tabindex="20">
																<option></option>
															@foreach ($userlist as $rec)
																	<option value='{{ $rec->usr_id }}'>{{ $rec->tbuser }}</option>
															@endforeach	
														</select>
													</div>
													<span class=" label_intro"></span>
													<input type="hidden" id="username" name="tittle">
												</div>
												
												<div class="form_grid_12">
													<label class="field_title" id="llevel" for="level">VALUER TITTLE<span class="req">*</span></label>
													<div  class="form_input">
														<input id="name" name="name"   type="text"  maxlength="50" class="required"/>
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
        
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="proptble" class="display select">
							<thead style="text-align: left;">
								
								<!--	<th></th>
									<th class="table_sno">
										S No
									</th>
									<th>
										ACCOUNT NUMBER
									</th>
									<th>
										FILE NUMBER
									</th>
									<th>
										ZONE
									</th>
									<th>
										SUBZONE
									</th>
									<th>
										ADDRESS 1
									</th>	
									<th>
										ADDRESS 2
									</th>	
									<th>
										OWNER TYPE
									</th>	
									<th>
										OWNER NAME
									</th>	
									<th>
										BULIDING COUNT
									</th>	-->	
									<tr>
									<th><input name="select_all" value="1" type="checkbox"></th>
									<th class="table_sno">
										{{__('inspection.SNo')}}
									</th>
									<th>
										{{__('inspection.Account_Number')}}
									</th>
									<th>
										{{__('inspection.File_Number')}}
									</th>
									<th> {{__('group.Term_Name')}} </th>
									<th>{{__('group.Basket_Name')}} </th>
									<th>{{__('inspection.Nt')}}</th>		
									<th>{{__('inspection.Rate')}}</th>	
									<th>{{__('inspection.Tax_Rate')}}</th>			
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
	
	<script>
		
		function changeField(val){
			if(val == 'table'){
				$('#maxrow').removeAttr('style');
			} else {
				$('#maxrow').attr('style', "display:none;");
			}
		}

		function deleteProperty(){
			var table = $('#proptble').DataTable();
//console.log(table.rows('.selected').data());
			var account = $.map(table.rows('.selected').data(), function (item) {
				//console.log(item);
	        	return item['vd_id']
	   		});
			var type = "delete";
			if(account.length > 0) {
				$('#accounts').val(account.toString());
				$('#addDetail').modal();
				console.log(account.toString());
			} else {
				alert('Please atleast one property to generate report');
			}
			
			
		}

		function deleteProperty(){
			var table = $('#proptble').DataTable();
//console.log(table.rows('.selected').data());
			var account = $.map(table.rows('.selected').data(), function (item) {
				//console.log(item);
	        	return item['vd_id']
	   		});
			var type = "delete";
			$('#accounts').val(account.toString());
			$('#addDetail').modal();
			console.log(account.toString());
			
			
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
				
		        // ajax: '{{ url("inspectionproperty") }}',
		        /*"ajax": '/bookings/datatables',*/
		       /* "columns": [
			        {"data": "vd_id", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": null, "name": "sno"},
			        {"data": "vd_accno", "name": "account number"},
			        {"data": "ma_fileno", "name": "fileno"},
			        {"data": "zone", "name": "zone"},
			        {"data": "subzone", "name": "subzone"},
			        {"data": "ma_addr_ln1", "name": "owner"}, 
			        {"data": "ma_addr_ln2", "name": "ishasbldg"},
			        {"data": "owntype", "name": "owntype"}, 
			        {"data": "TO_OWNNAME", "name": "TO_OWNNAME"}, 
			        {"data": "bldgcount", "name": "bldgcount"}
		   		],*/
		   		"columns": [
			        {"data": "vd_id", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": null, "name": "sno"},
			        {"data": "vd_accno", "name": "account number"},
			        {"data": "ma_fileno", "name": "file number"},
			        {"data": "vt_name", "name": "TERM"},
			        {"data": "va_name", "name": "BASKET"},
			        {"data": "vt_approvednt", "name": "nt", "sClass": "numericCol"}, 
			        {"data": "vt_approvedrate", "name": "rate", "sClass": "numericCol" }, 
			        {"data": "vt_approvedtax", "name": "tax", "sClass": "numericCol"}
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

 

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', $('#proptble').DataTable().table().container()).on('click', function(e){
      if(this.checked){
        $('#proptble tbody input[type="checkbox"]').prop('checked', true);
         $('#proptble tbody tr').addClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      } else {
         $('#proptble tbody input[type="checkbox"]').prop('checked', false);
         $('#proptble tbody tr').removeClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
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