<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Ownership Transfer Process</title>

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
						<li>Ownership Transfer Process</li>
					</ul>
				</div>
				</div>
				
				<div style="float:right;margin-right: 10px;"  class="btn_24_blue">					
					<!--<a href="#" onclick="demo()">Demo</a>-->
					@include('ownershiptransfer.search')
					<a href="#" onclick="addProperty()">Add Property</a>
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
										No Account
									</th>
									<th>
										Owner Name
									</th>
									<th>
										Owner Id Type
									</th>
									<th>
										Owner Id No
									</th>
									<th>
										Address 1
									</th>		
									<th>
										Address 2
									</th>	
									<th>
										Address 2
									</th>	
									<th>
										City
									</th>
									<th>
										Action
									</th>			
								</tr>
							</thead>
							<tbody>		
									
							</tbody>
						</table>


								<div class="grid_12 invoice_details">
									<div class="widget_wrap collapsible_widget">
										<div class="widget_top active">
											<span class="h_icon"></span>
											<h6>Log Information</h6>
										</div>
										<div class="widget_content">
											<div class="invoice_tbl">
												<table id="logtable">
												<thead>
												<tr class=" gray_sai">
													<th>
														
													</th>
													<th>
														Application ID
													</th>
													<th>
														Transfer Type
													</th>
													<th>
														Transfer Status
													</th>
													<th>
														Register Date
													</th>
													<th>
														Update Date
													</th>
													<th>
														Owner Name
													</th>	
													<th>
														Owner Type ID
													</th>	
													<th>
														Owner ID No
													</th>	
													<th>
														Address
													</th>	
													<th>
														Owner Race
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
				</div>
			</div>
		</div>
	<span class="clear"></span>
	
	<script>
		function addProperty() {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "searchpropertyaddress?page=owner";
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}

		function edit(acc) {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "ownertransferprocess?account="+acc+"&page=2";
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}

		function register(){
			$('#register-modal-content').modal();
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
												
		        // ajax: '{{ url("inspectionproperty") }}',
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
			        {"data": "ma_id", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": null, "name": "sno"},
			        {"data":  function(data){

			        	return "<a onclick='edit("+data.ma_accno+")' href=#'>"+data.ma_accno+"</a>";
			        
			        }, "name": "account number"},
			        {"data": "TO_OWNNAME", "name": "fileno"},
			        {"data": "owntype", "name": "zone"},
			        {"data": "TO_OWNNO", "name": "subzone"},
			        {"data": "ma_addr_ln1", "name": "owner"}, 
			        {"data": "ma_addr_ln2", "name": "ishasbldg"},
			        {"data": "ma_addr_ln3", "name": "owntype"}, 
			        {"data": "ma_city", "name": "TO_OWNNAME"}, 
			        {"data": function(data){
			        	
			        	
			        	return ' <span><a onclick="submitForm('+data.ma_accno+')" class="action-icons c-edit edtbldgrow" href="#" title="Edit">Edit</a></span>';
			        
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




	function submitForm(account){
		//console.log($("#filterForm").serialize());



	var logtable = $('#logtable').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				 
		      //   ajax: '{{ url("inspectionproperty") }}',
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
			        {"data": "ota_id", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": "ota_id", "name": "sno"},
			        {"data": "ttype", "name": "account number"},
			        {"data": "transstauts", "name": "account number"},
			        {"data": "otar_createdate", "name": "fileno"},
			        {"data": "otar_updatedate", "name": "zone"},
			        {"data": "ota_ownname", "name": "ishasbldg"},
			        {"data": "owntype", "name": "owntype"}, 
			        {"data": "ota_ownno", "name": "TO_OWNNAME"}, 
			        {"data": "ota_addr_ln1", "name": "bldgcount"},
			        {"data": "ownrace", "name": "ownrace"}
		   		],
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  	
			       // $("td:nth-child(2)", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
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



   

   // Handle click on checkbox
   $('#logtable tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = $('#logtable').DataTable().row($row).data();

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
      updateDataTableSelectAllCtrl($('#logtable').DataTable());

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle click on table cells with checkboxes
   $('#logtable').on('click', 'tbody td, thead th:first-child', function(e){
      $(this).parent().find('input[type="checkbox"]').trigger('click');
   });

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', $('#logtable').DataTable().table().container()).on('click', function(e){
      if(this.checked){
         $('#proptble tbody input[type="checkbox"]:not(:checked)').trigger('click');
      } else {
         $('#proptble tbody input[type="checkbox"]:checked').trigger('click');
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle table draw event
   $('#logtable').DataTable().on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl($('#logtable').DataTable());
   });
   // Handle form submission event


		var table1 = $('#logtable').DataTable();




		table1.clear();

		var date = new Date();
		var timestamp = date.getTime();
		
		var table1 = $('#logtable').DataTable();
		$.ajax({
            url: 'ownertransferdetail?test=manual&ts_='+timestamp+'&account='+account,
            type: 'GET'
        }).done(function (result) {
        	if(result.recordsTotal == 0) {
        		alert('No records found');
        	}
	        table1.rows.add(result.data).draw();
        }).fail(function (jqXHR, textStatus, errorThrown) {            	 
            console.log(errorThrown);
        });
	}


	</script>
</div>

</body>
</html>