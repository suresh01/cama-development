<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('CodeMaintenance.Property_Address_Log')}}</title>

@include('includes.header', ['page' => 'datamaintenance'])
					
	<div id="content">
<div class="grid_container">
	<div class="grid_12">
		<br>
		<div class="breadCrumbHolder module">
			<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
				<ul>
					<li><a href="#">{{__('CodeMaintenance.Home')}} </a></li>
					<li><a href="#">{{__('CodeMaintenance.Data_Maintenance')}}</a></li>
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
								{{__('CodeMaintenance.Log_Id')}}
							</th>
							<th>
								{{__('CodeMaintenance.Account_Number')}}
							</th>
							<th>
								{{__('CodeMaintenance.File_Number')}}
							</th>
							<th>
								{{__('CodeMaintenance.Zone')}}
							</th>
							<th>
								{{__('CodeMaintenance.SubZone')}}
							</th>
							<th>
								{{__('CodeMaintenance.Address1')}} 
							</th>
							<th>
								{{__('CodeMaintenance.Address2')}} 
							</th>
							<th>
								{{__('CodeMaintenance.Address3')}} 
							</th>
							<th>
								{{__('CodeMaintenance.Post_Code')}} 
							</th>
							<th>
								{{__('CodeMaintenance.City')}}
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
		"url": 'propaddresslogtables?page=1',
		"contentType": 'application/json; charset=utf-8',
				"headers": {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		},
		// ajax: '{{ url("inspectionproperty") }}',
		/*"ajax": '/bookings/datatables',*/
		"columns": [
			{"data": null, "orderable": false, "searchable": false, "name":"_id" },
			{"data": "mal_id", "orderable": false, "searchable": false, "name":"_id" },
			{"data": "mal_accno", "name": "sno"},
			{"data": "mal_fileno", "name": "account number"},
			{"data": "zone", "name": "account number"},
			{"data": "subzone", "name": "fileno"},
			{"data": "mal_addr_ln1", "name": "zone"},
			{"data": "mal_addr_ln2", "name": "ishasbldg"},
			{"data": "mal_addr_ln3", "name": "owntype"},
			{"data": "mal_postcode", "name": "TO_OWNNAME"},
			{"data": "mal_city", "name": "bldgcount"},
			{"data": "tstatus", "name": "bldgcount"}
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