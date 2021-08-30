<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('menu.dataenquiry')}}</title>
<style type="text/css">
  td.numericCol {
    text-align: right;
  } 
</style>
{{-- <link href="multiselect/multiselect.css" rel="stylesheet"/>
<script src="multiselect/multiselect.min.js"></script> --}}
@include('includes.header', ['page' => 'dataenquery'])
					
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">	
					<br>
				<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
					<ul>
						<li><a href="#">{{__('menu.home')}}</a></li>
						<li><a href="#">{{__('menu.dataenquiry')}}</a></li>
						<li>{{__('menu.propertysearch')}}</li>
					</ul>
				</div>
				</div>
				
				<div style="float:right;margin-right: 10px;"  class="btn_24_blue">		
					<a href="#" onclick="ExportSCV()">Export CSV</a>			
					@include('dataenquiry.search')
				</div>
				<br>
        		
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table style="width: 100%;" id="proptble" class="display select">

							<div class="social_activities">
								<div class="comments_s">
									<div class="block_label">
										{{__('datasearch.propertycnt')}}<span id="prop_count">0</span>
									</div>
								</div>



								<select id='testSelect1' style="float: right;" multiple>
									<option value='2'>{{__('datasearch.col2')}}</option>
									<option value='3'>{{__('datasearch.col3')}}</option>
									<option value='4'>{{__('datasearch.col4')}}</option>
									<option value='5'>{{__('datasearch.col5')}}</option>
									<option value='6'>{{__('datasearch.col6')}}</option>
									<option value='7'>{{__('datasearch.col7')}}</option>
									<option value='8'>{{__('datasearch.col8')}}</option>
									<option value='9'>{{__('datasearch.col9')}}</option>
									<option value='10'>{{__('datasearch.col10')}}</option>
									<option value='11'>{{__('datasearch.col11')}}</option>
									<option value='12'>{{__('datasearch.col12')}}</option>
									<option value='13'>{{__('datasearch.col13')}}</option>
									<option value='14'>{{__('datasearch.col14')}}</option>
									<option value='15'>{{__('datasearch.col15')}}</option>
									<option value='16'>{{__('datasearch.col16')}}</option>
									<option value='17'>{{__('datasearch.col17')}}</option>
									<option value='18'>{{__('datasearch.col18')}}</option>
									<option value='19'>{{__('datasearch.col19')}}</option>
									<option value='20'>{{__('datasearch.col20')}}</option>
									<option value='21'>{{__('datasearch.col21')}}</option>
									<option value='22'>{{__('datasearch.col22')}}</option>
									<option value='23'>{{__('datasearch.col23')}}</option>
									<option value='24'>{{__('datasearch.col24')}}</option>
									<option value='25'>{{__('datasearch.col25')}}</option>
								</select>
							</div>	

							<thead style="text-align: left;">
								<tr>
									<th></th>
									<th class="table_sno">
										{{__('datasearch.col1')}}
									</th>
									<th>
										{{__('datasearch.col2')}}
									</th>
									<th>
										{{__('datasearch.col3')}}
									</th>
									<th>
										{{__('datasearch.col4')}}
									</th>
									<th>
										{{__('datasearch.col5')}}
									</th>		
									<th>
										{{__('datasearch.col6')}}
									</th>
									<th>
										{{__('datasearch.col7')}}
									</th>	
									<th>
										{{__('datasearch.col8')}}
									</th>
									<th>
										{{__('datasearch.col9')}}
									</th>
									<th>
										{{__('datasearch.col10')}}
									</th>
									<th>
										{{__('datasearch.col11')}}
									</th>
									<th>
										{{__('datasearch.col12')}}
									</th>
									<th>
										{{__('datasearch.col13')}}
									</th>
									<th>
										{{__('datasearch.col14')}}
									</th>
									<th>
										{{__('datasearch.col15')}}
									</th>
									<th>
										{{__('datasearch.col16')}}
									</th>
									<th>
										{{__('datasearch.col17')}}
									</th>
									<th>
										{{__('datasearch.col18')}}
									</th>
									<th>
										{{__('datasearch.col19')}}
									</th>
									<th>
										{{__('datasearch.col20')}}
									</th>
									<th>
										{{__('datasearch.col21')}}
									</th>
									<th>
										{{__('datasearch.col22')}}
									</th>		
									<th>
										{{__('datasearch.col23')}}
									</th>	
									<th>
										{{__('datasearch.col24')}}
									</th>
									<th>
										{{__('datasearch.col25')}}
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
	

		
		function ExportSCV(){
			//alert(1);
			location.href ="exportcsv?" + $("#filterForm").serialize();
			//console.log($("#filterForm").serialize());
		
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
		        		window.open("datasearchdetail?ts=1&prop_id="+id, '_blank');
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
			        {"data": "bldgcategory", "name": "address"},
			        {"data": "bldgtype", "name": "address"},
			        {"data": "bldgsotery", "name": "address", "visible": false},
			        {"data": "TO_OWNNAME", "name": "TO_OWNNAME", "visible": false},
			        {"data": "TO_OWNNO", "name": "TO_OWNNO", "visible": false},
			        {"data": "lotcode", "name": "TO_OWNNAME", "visible": false},
			        {"data": "al_no", "name": "TO_OWNNO", "visible": false},
			        {"data": "ma_addr_ln1", "name": "address", "visible": false},
			        {"data": "ma_addr_ln2", "name": "address", "visible": false},
			        {"data": "ma_addr_ln3", "name": "address", "visible": false},
			        {"data": "ma_addr_ln4", "name": "address", "visible": false},
			        {"data": "ma_city", "name": "address", "visible": false},
			        {"data": "state", "name": "address", "visible": false},
			        {"data": "ma_postcode", "name": "address", "visible": false},
			        {"data": "vt_termDate", "name": "address", "visible": false},
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
			/*"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },*/
		    oLanguage: {
	            oPaginate: {
	                sFirst: "{{__('datatable.first')}}",
	                sLast: "{{__('datatable.last')}}",
	                sNext: "{{__('datatable.next')}}",
	                sPrevious: "{{__('datatable.previous')}}"
	            },
	            sEmptyTable: "{{__('datatable.emptytable')}}" ,
	            sInfoEmpty: "Showing 0 to 0 of 0 entries",
	            sThousands: ",",
	            sLoadingRecords: "{{__('datatable.loading')}}...",
	            sProcessing: "{{__('datatable.processing')}}...",
	            sSearch: "{{__('datatable.search')}}:",	            
		        sLengthMenu: "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>{{__('datatable.lengthmenu')}}:</span>",	
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