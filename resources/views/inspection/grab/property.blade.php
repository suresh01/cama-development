<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('inspection.New_Property')}}</title>

@include('includes.header-popup')
   
	<div id="content">
		<div class="grid_container">
         
		<div id="usertable" class="grid_12">	
			<br>
				<div style="float:right;margin-right: 0px;"  class="btn_24_blue">	
					<a href="#" id="" onclick="getSelectedProp()" class=""><span>{{__('inspection.Add_Property')}}  </span></a>	
				</div>
				<div style="float:right;margin-right: 15px;"  class="btn_24_blue">					
					@include('search.inspectionsearch')
				</div>
				<br>
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="proptble" class="display select">
							<thead style="text-align: left;">
								<tr>
									<th>
									</th>
									<th class="table_sno">
										{{__('inspection.SNo')}} 
									</th>
									<th>
										{{__('inspection.Account_Number')}}
									</th>
									<th>
										{{__('inspection.Zone')}} 
									</th>
									<th>
										{{__('inspection.Subzone')}} 
									</th>	
									<th>
										{{__('inspection.owner')}} 
									</th>
									<th>
										{__('inspection.Property_Address1')}
									</th>		
									<th>
										{{__('inspection.Is_Empty_Lot')}}
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
	<span class="clear"></span>
</div>
<script>
	//
// Updates "Select all" control in a data table
//
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
   // Array holding selected row IDs
   var rows_selected = [];
   	@foreach ($property as $rec)
		 			rows_selected.push( [ '{{ $rec->ma_accno }}','{{$loop->iteration}}', '{{ $rec->ma_accno }}', '{{ $rec->zone }}', '{{ $rec->subzone }}', '{{ $rec->to_ownname }}', '{{ $rec->ma_addr_ln1 }}', '{{ $rec->isbldg }}'] );
		 		@endforeach
    $('#proptble').DataTable({
            data:           rows_selected,
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
		$("div.table_top select").addClass('tbl_length');
		$(".tbl_length").chosen({
			disable_search_threshold: 4	
		});
   

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
	function getSelectedProp(){
		var table = $('#proptble').DataTable();
		 
		var account = $.map(table.rows('.selected').data(), function (item) {
       return item[0]
   	});
      var id="{{$id}}";
      var type = "add";
   		$.ajax({
	        type:'GET',
	        url:'grappdata',
	        data:{accounts:account,id:id,type:type},
	        success:function(data){	        	
	        	alert(data.newcount+" Property Added");
	        
	        }
		});
    	//console.log(ids)
    //alert(table.rows('.selected').data().length + ' row(s) selected');
		

		//console.log(rows);
	}
</script>
</body>
</html>