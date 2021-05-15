<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('ownershiptran.Account_Number_Search')}}</title>
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

<link href="multiselect/multiselect.css" rel="stylesheet"/>
<script src="multiselect/multiselect.min.js"></script>
@include('includes.header-popup', ['page' => 'datamaintenance'])
	<!--<div class="page_title">
		<span class="title_icon"><span class="blocks_images"></span></span>
		<h3>Users</h3>
		<div class="top_search">
			<form action="#" method="post">
				<ul id="search_box">
					<li>
					<input name="" type="text" class="search_input" id="suggest1" placeholder="Search...">
					</li>
					<li>
					<input name="" type="submit" value="" class="search_btn">
					</li>
				</ul>
			</form>
		</div>
	</div>-->
	<div style="margin-top: 0px !important" id="content">
		<div class="grid_container">


		<div class="grid_12">	
			<br>
			<div style="float:right;margin-right: 10px;"  class="btn_24_blue">					
					@include('ownershiptransfer.popup.search')
				</div>
				<br>
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table style="width: 100%;" id="propdatatable" class="display ">							
							<thead style="text-align: left;">
					  		<tr>
								<th class="table_sno"> {{__('ownershiptran.SNO')}}</th>
								<th>{{__('ownershiptran.Account_Number')}}</th>
								<th>{{__('ownershiptran.Zone')}}</th>
								<th>{{__('ownershiptran.Subzone')}}</th>
								<th>{{__('ownershiptran.Action')}}</th>
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
		
		
	<span class="clear"></span>

	<script>
	

	$(document).ready(function (){

		var table = $('#propdatatable').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				"lengthMenu":  [100, 200, 500, 1000],
				"dom": '<"top"i>rt<"bottom"flp><"clear">',
		        /*"ajax": {
		            "type": "GET",
		            "url": 'accountsearchdata',
		            "contentType": 'application/json; charset=utf-8'
		        },*/
		        "columns": [
			        {"data": null, "name": "sno", "title": "S No"},
			        {"data": "ma_accno", "name": "account number"},
			        {"data": "zone", "name": "address"},
			        {"data": "subzone", "name": "address"},
			        {"data": function(data){
			        	return '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" disabled="true" title="Select Asset Area" class="select-assetdba"  href="#"></a></span>';
			        }, "name": "address"}
		   		],
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  					var count = $('#proptble').DataTable().rows().count();
					$('#prop_count').html(count);
			        $("td:nth-child(1)", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
			        return nRow;
			    },
			    "sPaginationType": "full_numbers",
				"iDisplayLength": 100,
				"oLanguage": {
			        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Penyertaan setiap halaman:</span>",	
		        	"sSearch": "Carian",		
			    },
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

		$('#propdatatable tbody').on( 'click', '.select-assetdba', function () {
       		var table = $('#propdatatable').DataTable();
      		var row = table.row(table.row( $(this).parents('tr') ).index()),
          	data = row.data();	
          	window.opener.$('#accountnumber').val(data['ma_accno']);
			//window.opener.getAssetDetail();
	   		window.close();		
          	//newAssigment(data['co_code']);
    	});

	});
 

	

</script>
</div>
</body>
</html>