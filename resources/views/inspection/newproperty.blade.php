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
          
					<a href="#" id="" onclick="getSelectedProp()" class=""><span>{{__('inspection.Add_Property')}} </span></a>	
          <a href="#" id="" onclick="back()" class=""><span>{{__('common.Back')}}  </span></a> 
          <a href="#" id="" onclick="closeWindow()" class=""><span>{{__('common.Close')}}  </span></a> 
				</div>
				<div style="float:right;margin-right: 15px;"  class="btn_24_blue">					
					@include('inspection.grab.propertysearch')
				</div>
				<br>
        
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="proptble" class="display select">
							<thead style="text-align: left;">
								<tr>
									<th><input name="select_all" value="1" type="checkbox">
									</th>
									<th class="table_sno">{{__('inspection.SNO')}}</th>
									<th>{{__('inspection.Account_Number')}} </th>
									<th>{{__('inspection.Zone')}} </th>
									<th>{{__('inspection.Subzone')}} </th>	
									<th>{{__('inspection.owner')}} </th>
									<th>{{__('inspection.Property_Address1')}}</th>		
									<th>{{__('inspection.Is_Empty_Lot')}} </th>					
								</tr>
							</thead>
							<tbody>			
							
							</tbody>
						</table>
            <div><p id="info">0 {{__('inspection.Row_Selected')}}</p></div>
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
   $('#info').html(selectedrow() + " Row Selected");
   //alert(selectedrow());
}
function selectedrow(){
  var table = $('#proptble').DataTable();
  var count = 0;
  $.map(table.rows('.selected').data(), function (item) {
       count++;
    });
  return count;
}

$(document).ready(function (){
   // Array holding selected row IDs
   var rows_selected = [];
   
    var tbl = $('#proptble').DataTable({
           "processing": false,
            "serverSide": false,
            /*"dom": '<"toolbar">frtip',*/
            "ajax": {
                "type": "GET",
                "url": 'newpropertydata?id={{$basket_id}}',
                "contentType": 'application/json; charset=utf-8',
            "headers": {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
            },
              "columns": [
                {"data": "ma_accno", "orderable": false, "searchable": false, "name":"_id" },
                {"data": null, "name": "sno"},
                {"data": "ma_accno", "name": "zone"},
                {"data": "zone", "name": "subzone"},
                {"data": "subzone", "name": "address"},
                {"data": "to_ownname", "name": "owner"}, 
                {"data": "ma_addr_ln1", "name": "ishasbldg"}, 
                {"data": "isbldg", "name": "ishasbldg"}
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
		$("div.table_top select").addClass('tbl_length');
		$(".tbl_length").chosen({
			disable_search_threshold: 4	
		});
   

   // Handle click on checkbox
   $('#proptble tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = tbl.row($row).data();

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
      updateDataTableSelectAllCtrl(tbl);

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle click on table cells with checkboxes
   $('#proptble').on('click', 'tbody td, thead th:first-child', function(e){
      $(this).parent().find('input[type="checkbox"]').trigger('click');
   });

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', tbl.table().container()).on('click', function(e){
      if(this.checked){
         //$('#proptble tbody input[type="checkbox"]:not(:checked)').trigger('click');
        // $('#proptble tbody input[type="checkbox"]').trigger('click');
         $('#proptble tbody input[type="checkbox"]').prop('checked', true);
         $('#proptble tbody tr').addClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      } else {
         //$('#proptble tbody input[type="checkbox"]:checked').trigger('click');
        // $('#proptble tbody input[type="checkbox"]').trigger('click');
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
      updateDataTableSelectAllCtrl(tbl);
   });
   //alert(selectedrow());

   // Handle form submission event

});
	function getSelectedProp(){
		var table = $('#proptble').DataTable();
		
		var account = $.map(table.rows('.selected').data(), function (item) {
       return item['ma_accno']
   	});
    if(account.length>0){
        account=account.toString();
        } 
      var id="{{$id}}";
      var type = "add";
   		$.ajax({
	        type:'GET',
	        url:'grapnewdata',
	        data:{accounts:account,id:id,type:type},
	        success:function(data){	        	
	        	
            alert(data.newcount+" Property Added");
	        
	        }
		});
    	//console.log(ids)
    //alert(table.rows('.selected').data().length + ' row(s) selected');
		

		//console.log(rows);
	}

  function back(){
    var url = "grabbasket?insbasket_id={{$id}}";
    window.location = url;
  }
  
  function closeWindow(){
    try {
        window.opener.HandlePopupResult(sender.getAttribute("result"));
    }
    catch (err) {}
    window.close();
    return false;
  }

</script>
</body>
</html>