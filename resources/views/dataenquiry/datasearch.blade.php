<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Data Search</title>
<style type="text/css">
  td.numericCol {
    text-align: right;
  } 
</style>
<link href="multiselect/multiselect.css" rel="stylesheet"/>
<script src="multiselect/multiselect.min.js"></script>
@include('includes.header', ['page' => 'dataenquery'])
					
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">	
					<br>
				<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Data Enquiry</a></li>
						<li>Data Search</li>
					</ul>
				</div>
				</div>
				
				<div style="float:right;margin-right: 10px;"  class="btn_24_blue">					
					@include('dataenquiry.search')
				</div>
				<br>
        
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table style="width: 100%;" id="proptble" class="display select">

							<div class="social_activities">
								<div class="comments_s">
									<div class="block_label">
										Property Count<span id="prop_count">0</span>
									</div>
								</div>



								<select id='testSelect1' style="float: right;" multiple>
									<option value='2'>ACCOUNT NUMBER</option>
									<option value='3'>FILE NUMBER</option>
									<option value='4'>ZONE</option>
									<option value='5'>SUB ZONE</option>
									<option value='6'>PROPERTY STATUS</option>
									<option value='7'>PROPERTY TYPE</option>
									<option value='8'>PROPERTY CATEGORY</option>
									<option value='9'>PROPERTY STOREY</option>
									<option value='10'>OWNER NAME</option>
									<option value='11'>OWNER ID</option>
									<option value='12'>LOT CODE</option>
									<option value='13'>LOT NUMBER</option>
									<option value='14'>ADDRESS 1</option>
									<option value='15'>ADDRESS 2</option>
									<option value='16'>ADDRESS 3</option>
									<option value='17'>ADDRESS 4</option>
									<option value='18'>POST CODE</option>
									<option value='19'>CITY</option>
									<option value='20'>STATE</option>
									<option value='21'>TERM DATE</option>
									<option value='22'>NT</option>
									<option value='23'>RATE</option>
									<option value='24'>ADJUSTMENT</option>
									<option value='25'>TAX RATE</option>
								</select>
							</div>	

							<thead style="text-align: left;">
								<tr>
									<th></th>
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
										PROPERTY STATUS
									</th>
									<th>
										PROPERTY TYPE
									</th>	
									<th>
										PROPERTY CATEGORY
									</th>
									<th>
										PROPERTY STOREY
									</th>
									<th>
										OWNER NAME
									</th>
									<th>
										OWNER ID
									</th>
									<th>
										LOT CODE
									</th>
									<th>
										LOT NUMBER
									</th>
									<th>
										ADDRESS 1
									</th>
									<th>
										ADDRESS 2
									</th>
									<th>
										ADDRESS 3
									</th>
									<th>
										ADDRESS 4
									</th>
									<th>
										CITY
									</th>
									<th>
										STATE
									</th>
									<th>
										POSTCODE
									</th>
									<th>
										TERM DATE
									</th>
									<th>
										NT
									</th>		
									<th>
										RATE
									</th>	
									<th>
										ADJUSTMENT
									</th>
									<th>
										TAX RATE
									</th>	
								</tr>
							</thead>
							<tbody>			
								
							</tbody>
						</table>
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

		function check_usaccess(module,id){
			$.ajax({
		        type:'GET',
		        url:'/getaccess',
		        data:{module:module},
		        success:function(data){	        	
		        	if(data.msg === "false"){
		        		alert("You Don't have permission");
		        		return;
		        	} else {
		        		window.open("datasearchdetail?prop_id="+id, '_blank');
						//window.location.href = "datasearchdetail?prop_id="+id;
		        	}
		        }
		    });
		}


		
$(document).ready(function (){

document.multiselect('#testSelect1');

	$('.multiselect-checkbox').click(function() {
  // alert($(this).attr('data-val'););
var id  = $(this).attr('data-val');
    var table = $('#proptble').DataTable();
	var column = table.column( id);
	 //alert($('#'+id).prop("checked"));
	if (id != '-1'){
		column.visible( $(this).prop("checked"));
	}

	if (id == '-1'){
		for(i=1;i<=25;i++){
			var column = table.column( i);
			column.visible( $(this).prop("checked"));
		}
		//console.log(table.columns().length );
		//column.visible( $(this).prop("checked"));
	}


});

	//var visiblecolumn = ["1","2","3","4","5","6","7","21","22","23","24"];
	defaultDatatableColumn(["1","2","3","4","5","6","7","22","23","24","25"]);

	var table = $('#proptble').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				"lengthMenu":  [100, 200, 500, 1000],
				"dom": '<"top"i>rt<"bottom"flp><"clear">',
		        // ajax: '{{ url("inspectionproperty") }}',
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
			        {"data": "vd_id", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": null, "name": "sno", "title": "S No"},
			        {"data": function(data){
			        		//var url = 'datasearchdetail?prop_id='+data.vd_id; formatMoneyHas
			        		return "<a onclick='check_usaccess(212,"+data.vd_id+")'  href='#'>"+data.vd_accno+"</a>";
			        	
			        }, "name": "account number"},
			        {"data": "ma_fileno", "name": "fileno"},
			        {"data": "zone", "name": "zone"},
			        {"data": "subzone", "name": "subzone"},
			        {"data": "isbldg", "name": "address"},
			        {"data": "bldgtype", "name": "address"},
			        {"data": "bldgcategory", "name": "address", "visible": false},
			        {"data": "bldgsotery", "name": "address", "visible": false},
			        {"data": "TO_OWNNAME", "name": "TO_OWNNAME", "visible": false},
			        {"data": "TO_OWNNO", "name": "TO_OWNNO", "visible": false},
			        {"data": "TO_OWNNAME", "name": "TO_OWNNAME", "visible": false},
			        {"data": "TO_OWNNO", "name": "TO_OWNNO", "visible": false},
			        {"data": "ma_address1", "name": "address", "visible": false},
			        {"data": "ma_address2", "name": "address", "visible": false},
			        {"data": "ma_address3", "name": "address", "visible": false},
			        {"data": "ma_address4", "name": "address", "visible": false},
			        {"data": "ma_address1", "name": "address", "visible": false},
			        {"data": "ma_address1", "name": "address", "visible": false},
			        {"data": "ma_address1", "name": "address", "visible": false},
			        {"data": "ma_address1", "name": "address", "visible": false},
			        {"data": function(data){
			        		//var url = 'datasearchdetail?prop_id='+data.vd_id; formatMoneyHas
			        		return formatMoneyHas(data.vt_approvednt);
			        	
			        }, "name": "owner", "className": "numericCol"}, 
			        {"data":  function(data){
			        		//var url = 'datasearchdetail?prop_id='+data.vd_id; formatMoneyHas
			        		return formatMoneyHas(data.vt_proposedrate);
			        	
			        }, "name": "ishasbldg", "className": "numericCol"}, 
			        {"data":  function(data){
			        		//var url = 'datasearchdetail?prop_id='+data.vd_id; formatMoneyHas
			        		return formatMoneyHas(data.vt_adjustment);
			        	
			        }, "name": "ishasbldg", "className": "numericCol"}, 
			        {"data":  function(data){
			        		//var url = 'datasearchdetail?prop_id='+data.vd_id; formatMoneyHas
			        		return formatMoneyHas(data.vt_approvedtax);
			        	
			        }, "name": "ishasbldg", "className": "numericCol"}
		   		],
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  					var count = $('#proptble').DataTable().rows().count();
					$('#prop_count').html(count);
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