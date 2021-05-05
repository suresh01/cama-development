<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('objection.Add_Property')}}</title>
@include('includes.header-popup')

	<div id="content">
		<div class="grid_container">		
		  <div id="usertable" class="grid_12">
		  		<br>
				<div style="float:right;margin-right: 0px;"  class="btn_24_blue">   
               <a href="#" id="" onclick="getSelectedProp()" class=""><span>{{__('objection.Add_Property')}} </span></a>  
					<a href="#" id="" onclick="closeWindow()" class=""><span>{{__('common.Close')}} </span></a> 
				</div>
				<br>
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="baskettbl" class="display ">
					<thead style="text-align: left;">
			  		<tr>
									<th><input name="select_all" value="1" type="checkbox">
									</th>
							<th class="table_sno">
								 {{__('objection.SNO')}}
							</th>
							<th>
								 {{__('objection.Account_number')}}
							</th>
							<th>
								{{__('objection.Term_Name')}} 
							</th>
              <th>
                 {{__('objection.Basket_Name')}} 
              </th>
              <th>
                {{__('objection.Status')}} 
              </th>
						</tr>
						</thead>
						<tbody>
						
						</tbody>
						</table>
            <div><p id="info">0 {{__('objection.Row_Selected')}}></div>
					</div>
				</div>
			</div>
	
	</div>
	<span class="clear"></span>


</div>
<script type="text/javascript">
	function closeWindow(){
    window.opener.location.reload();
	    try {
	        window.opener.HandlePopupResult(sender.getAttribute("result"));
	    }
	    catch (err) {}
	    window.close();
	    return false;
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

    $('#info').html(selectedrow() + " Row Selected");
}

function selectedrow(){
  var table = $('#baskettbl').DataTable();
  var count = 0;
  $.map(table.rows('.selected').data(), function (item) {
       count++;
    });
  return count;
}

$(document).ready(function (){
   // Array holding selected row IDs
    var rows_selected = [];
      @foreach ($property as $rec)
               rows_selected.push( [ '{{ $rec->vd_id }}','{{$loop->iteration}}', '{{ $rec->vd_accno }}', '{{ $rec->vt_name }}', '{{ $rec->va_name }}', '{{ $rec->ob_desc }}'] );
            @endforeach
    $('#baskettbl').DataTable({
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
   $('#baskettbl tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = $('#baskettbl').DataTable().row($row).data();

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
      updateDataTableSelectAllCtrl($('#baskettbl').DataTable());

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });
  

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', $('#baskettbl').DataTable().table().container()).on('click', function(e){
      if(this.checked){
         //$('#baskettbl tbody input[type="checkbox"]:not(:checked)').trigger('click');
        $('#baskettbl tbody input[type="checkbox"]').prop('checked', true);
         $('#baskettbl tbody tr').addClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      } else {
         //$('#baskettbl tbody input[type="checkbox"]:checked').trigger('click');
         $('#baskettbl tbody input[type="checkbox"]').prop('checked', false);
         $('#baskettbl tbody tr').removeClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle table draw event
   $('#baskettbl').DataTable().on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl($('#baskettbl').DataTable());
   });

   // Handle form submission event

});
function getSelectedProp(){
      var table = $('#baskettbl').DataTable();
       
      var account = $.map(table.rows('.selected').data(), function (item) {
       return item[0]
      });
     var id= "{{$id}}";
     var noticetype= "{{$type}}";
      var type = "add";
         $.ajax({
           type:'GET',
           url:'noticedetailtrn',
           data:{accounts:account,id:id,type:type,noticetype:noticetype},
           success:function(data){           
               alert(data.newcount+" Record Added");
           
           }
      });
      //console.log(ids)
    //alert(table.rows('.selected').data().length + ' row(s) selected');
      

      console.log(account);
   }
</script>
</body>
</html>