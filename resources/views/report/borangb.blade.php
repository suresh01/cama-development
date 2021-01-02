<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Borang B</title>

@include('includes.header', ['page' => 'report'])
					
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">	
					<br>
				<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_6">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Report</a></li>
						<li>Borang B</li>
					</ul>
				</div>
				</div>
				
				<br>
			
        
        
				<div class="widget_wrap">					
					<div class="widget_content">
						<h3 id="title">Generate Report</h3>
						<form id="addgroupfrom"  autocomplete="off" class="" method="post" action="generateborangb" >
							@csrf
							<input type="hidden" name="id" id="id" value="0">
							<input type="hidden" name="operation" id="operation" value="0">
							<div  class="grid_12 form_container left_label">
								<ul>
									<li>
										<div class="form_grid_12">									
											<label class="field_title" id="termname" for="termid">Term Name<span class="req">*</span></label>
											<div class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="termid" name="termid" tabindex="20">
													<option></option>
													@foreach ($term as $rec)
														<option value='{{ $rec->termid }}'>( {{ $rec->applntype }} ) {{ $rec->term }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>	

										<div class="form_grid_12">									
											<label class="field_title" id="termname" for="termid">Ratepayer Type<span class="req">*</span></label>
											<div class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="ratepayertypeid" name="ratepayertypeid" tabindex="20">
													<option></option>
													@foreach ($ratepayertype as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>		


										<div  class="form_grid_12">									
											<label class="field_title" id="termname" for="termid">Tenant Name<span class="req">*</span></label>
											<div class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="ratepayername" name="ratepayername" tabindex="20">
													<option></option>
													@foreach ($ratepayer as $rec)
														<option value='{{ $rec->te_id }}'>{{ $rec->te_name }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>									
									</li>
								</ul>
							</div>
							
							<div style="height: 48px; float: none; display: -webkit-box;text-align: -webkit-center;" class="grid_12">
								
								<div class="form_input">
									<button id="addsubmit" name="adduser" type="submit" onclick="validateGroup()" class="btn_small btn_blue"><span>Genrate Report</span></button>			
														
									
								</div>
								
								<span class="clear"></span>
							</div>
						</form>
					</div>
				</div>
			</div>
			
		<!-- <form style="display: hidden;" id="generateform" method="GET" action="generateinspectionreport">
            @csrf
            <input type="hidden" name="accounts" id="accounts">
		</form>-->
		
		
	</div>
	<span class="clear"></span>
	
	<script>
		function ratepayer(val){
			//	console.log(val);
			if (val =='07'){
				$('#ratepayername').show();
			} else {
				$('#ratepayername').hide();
			}
			
		}
		function changeField(val){
			if(val == 'table'){
				$('#maxrow').removeAttr('style');
			} else {
				$('#maxrow').attr('style', "display:none;");
			}
		}


		function deleteProperty(){
			var table = $('#proptble').DataTable();
//console.log(table.rows('.selected').data()); href="generatecollectionbldg" 
		
			var tilte = prompt("Report Title", "STATISTIK KUTIPAN MENGIKUT KAWASAN SEHINGGA PENGGAL");

			if (tilte == null || tilte == "") {
				return;
			} else {
				var id = $('#value_Term').val();
				window.location = "generatecollectionzone?title="+tilte+"&termid="+id;
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
				 
		        // ajax: '{{ url("inspectionproperty") }}',
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
			        {"data": null, "orderable": false, "searchable": false, "name":"_id" },
			        {"data": null, "name": "sno"},
			        {"data": "ma_subzone_id", "name": "account number"},
			        {"data": "subzone", "name": "fileno"},
			        {"data": "propcount", "name": "zone", "className": "number_algin" },
			        {"data": "vt_approvednt", "name": "subzone","render": $.fn.dataTable.render.number( ',', '.', 2 ), "className": "number_algin" },
			        {"data": "vt_approvedtax", "name": "owner","render": $.fn.dataTable.render.number( ',', '.', 2 ), "className": "number_algin" }
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
   $("#termid").change(function() {
	    	//console.log(this.value);
	    	var param_value = this.value;
	    	var param = 'borangb';
	        $.ajax({
			  url: "subCategory",
			  cache: false,
			  data:{param_value:param_value,param:param},
			  success: function(data){
	    		createDropDownOptions(data.res_arr, 'ratepayertypeid');
			  }
			});
		});
		$("#ratepayertypeid").change(function() {
	    	//console.log(this.value);
			var param_value2 = this.value;
	    	var param_value = $("#termid").val();
	    	var param = 'borangb2';
	        $.ajax({
			  url: "subCategory",
			  cache: false,
			  data:{param_value2:param_value2,param_value:param_value,param:param},
			  success: function(data){
	    		createDropDownOptions(data.res_arr, 'ratepayername');
			  }
			});
	    });
});
var createDropDownOptions = function(data, field) {
    var options = "<option></option>";
    // Create the list of HTML Options

    for (i = 0; i < data.length; i++)
    {
        options += "<option value='" + data[i].tdi_key + "'>" + data[i].tdi_value + "</option>\r\n";
    }

    // Assign the options to the HTML Select container
    $('select#' + field)[0].innerHTML = options;
 
    // Set the option to be Selected
    //$('#' + field).val(data[0].tdi_key);

    // Refresh the HTML Select so it displays the Selected option
    //$('#' + field).selectmenu('refresh');
};

	</script>
</div>

</body>
</html>