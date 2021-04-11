<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Remisi</title>

@include('includes.header', ['page' => 'datamaintenance'])
					
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">	
					<br>
				<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
					<ul>
						<li><a href="#">Home</a></li>
					</ul>
				</div>
				</div>			
				
				<div style="float:right;margin-right: 10px;"  class="btn_24_blue">
					
					<a href="#" onclick="addApplication()" >Add Application</a>
					<a href="#"  >Add Filter</a>
				</div>

				<br>
        
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="proptble" class="display select">
							<thead style="text-align: left;">
								<tr>
									<th><input name="select_all" value="1" type="checkbox"></th>
									<th class="table_sno">
										S No
									</th>
									<th>
										Account Number
									</th>
									<th>
										Zone 
									</th>
									<th>
										Sub Zone 
									</th>
									<th>
										Property Building Status
									</th>	
									<th>
										Property Category
									</th>			
									<th>
										Property Type
									</th>		
									<th>
										Property Storey
									</th>	
									<th>
										Term Date
									</th>	
									<th>
										Register By
									</th>	
									<th>
										Register Date
									</th>
									<th>
										Status
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
		
	<span class="clear"></span>
	
	<script>
		

		function addApplication() {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "addremisi";
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}
		
		function remisiDetail(id) {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "remisidetail?id="+id;
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
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
					        data:{param_value:id,module:'remisi',param:currstatus},
					        success:function(data){
								window.location.assign("remisi");									
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

$(document).ready(function (){

	var table = $('#proptble').DataTable({
		       "processing": false,
		        "serverSide": false,
		        /*"dom": '<"toolbar">frtip',*/
		        "ajax": {
		            "type": "GET",
		            "url": 'remisisearchdata',
		            "contentType": 'application/json; charset=utf-8',
				    "headers": {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		        },
					"lengthMenu":  [100, 200, 500, 1000],		
				 	
		       // ajax: '{{ url("inspectionproperty") }}',
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
			        {"data": "ma_accno", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": null, "name": "sno"},
			        {"data": function(data){

			        	return "<a onclick='remisiDetail("+data.rg_id+")' href='#'>"+data.ma_accno+"</a>";

			        }, "name": "account number"},
			        {"data": "zone", "name": "zone"},
			        {"data": "subzone", "name": "subzone"},
			        {"data": "propertstatus", "name": "address"},
			        {"data": "bldgcategory", "name": "owner", }, 
			        {"data": "bldgtype", "name": "ishasbldg", }, 
			        {"data": "bldgsotery", "name": "ishasbldg", }, 
			        {"data": function(data){
			        	return "";
			        }, "name": "propertstatus"}, 
			        {"data": "rg_createby", "name": "ishasbldg"}, 
			        {"data": "rg_createat_frmt", "name": "propertstatus"}, 
			        {"data": "approvalstatus", "name": "ishasbldg"}, 
			        {"data":  function(data){
			        	
			        	var action = "";
			        		
							var editaction =
							"&nbsp;&nbsp;<span><a style='height: 15px; width: 13px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -143px -23px !important;display: inline-block; '  onclick='deleteBasket("+data.rg_id+")' href='#' title='Delete'></a></span>";

							if(data.rg_remisistatus_id == '0'  ){
								action = editaction +  '<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('+data.rg_id+',0)"  title="Submit For Investigation" href="#"></a></span>';							
							} else if(data.rg_remisistatus_id == '2'){
								action = editaction +  '<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('+data.rg_id+',2)"  title="Submit For Proposed" href="#"></a></span>';
						
							} else if(data.rg_remisistatus_id == '3'){
								action = editaction +  '<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('+data.rg_id+',3)"  title="Submit For Decision" href="#"></a></span>';
						
							} else if(data.rg_remisistatus_id == '4'){
								action =   '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('+data.rg_id+',5)"  title="Approve" href="#"></a></span>' + 
								'<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -542px -42px !important;display: inline-block; float: left;" onclick="approve('+data.rg_id+',6)"  title="Reject" href="#"></a></span>';							
							}
							

			        		return action;

			        	return '';
			        }, "name": "propertstatus"}
		   		],
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
			        $("td:nth-child(2)", nRow).html(iDisplayIndex + 1);
			        var count = $('#proptble').DataTable().rows().count();
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