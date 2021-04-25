<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('CodeMaintenance.Property_Information')}}</title>

@include('includes.header', ['page' => 'datamaintenance'])
					
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">	
					<br>
				<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
					<ul>
						<li><a href="#">{{__('CodeMaintenance.Home')}} </a></li>
						<li><a href="#">{{__('CodeMaintenance.Data_Maintenance')}} </a></li>
						<li>{{__('CodeMaintenance.Property_Address_Log')}} </li>
					</ul>
				</div>
				</div>
				
				<div style="float:right;margin-right: 10px;"  class="btn_24_blue">
							
					@include('codemaintenance.ownershiptransfer.search')
				</div>
				<br>
        
<div class="widget_wrap">
	<div class="widget_content">
		<table id="proptble" class="display select">
			<thead style="text-align: left;">
				<tr>
					<th>
						
					</th>
					<th>
						{{__('CodeMaintenance.SNo')}}
					</th>
					<th>
						{{__('CodeMaintenance.Account_Number')}}
					</th>
					<th>
						{{__('CodeMaintenance.Lot_Number')}}
					</th>
					<th>
						{{__('CodeMaintenance.Title_Number')}}
					</th>
					<th>
						{{__('CodeMaintenance.Tenant_Type')}}
					</th>
					<th>
						{{__('CodeMaintenance.Stata_Number')}}
					</th>
					<th>
						{{__('CodeMaintenance.Status')}}
					</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
		
	</div>
</div>
			
		<!-- <form style="display: hidden;" id="generateform" method="GET" action="generateinspectionreport">
            @csrf
            <input type="hidden" name="accounts" id="accounts">
		</form>-->
		
		
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
			$('#accounts').val(account.toString());
			$('#addDetail').modal();
			console.log(account.toString());
			
			
		}
	

		


$(document).ready(function (){

	

	var table = $('#proptble').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				  "ajax": {
		            "type": "GET",
		            "url": 'propaddresslogtables?page=2',
		            "contentType": 'application/json; charset=utf-8',
				    "headers": {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		        },
		        // ajax: '{{ url("inspectionproperty") }}',
		        /*"ajax": '/bookings/datatables',*/
		         "columns": [
			        {"data": null, "orderable": false, "searchable": false, "name":"_id" },
			        {"data": "log_id", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": "ma_accno", "name": "sno"},
			        {"data": "lotnumber", "name": "account number"},
			        {"data": "titlenumber", "name": "account number"},
			        {"data": "tentype", "name": "fileno"},
			        {"data": "log_stratano", "name": "zone"},
			        {"data": "tstatus", "name": "ishasbldg"}
		   		],
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  	
			      //  $("td:nth-child(2)", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
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
        
      },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			});
   
    
   

});
	





	</script>
</div>

</body>
</html>