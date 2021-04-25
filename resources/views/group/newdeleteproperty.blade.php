<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('group.New_Property')}}</title>


@include('includes.header-popup')
	<div id="content">
		<div class="grid_container">

		<div id="usertable" class="grid_12">	
			<br>
        <div style="float:right;margin-right: 10px;"  class="btn_24_blue">          
          @include('group.deactivate.search')
        </div>
				<div style="float:right;margin-right: 0px;"  class="btn_24_blue">	      
         
					<a href="#" id="" onclick="getSelectedProp1()" class=""><span>{{__('group.Add_Property')}}  </span></a>	
          <a href="#" id="" onclick="back()" class=""><span>{{__('common.Back')}}  </span></a> 
          <a href="#" id="" onclick="closeWindow()" class=""><span>{{__('common.Close')}}  </span></a> 
				</div>
				<div style="float:right;margin-right: 15px;"  class="btn_24_blue">					
				
         
				</div>
				<br>
        
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="proptble" class="display select">
							<thead style="text-align: left;">
								<tr>
									<th><input name="select_all" value="1" type="checkbox">
									</th>
									<th class="table_sno">
										{{__('group.SNo')}} 
									</th>
									<th>
										{{__('group.Account_Number')}}
									</th>
									<th>
										{{__('group.Zone')}} ZONE
									</th>
									<th>
										{{__('group.Subzone')}}
									</th>	
									<th>
										{{__('group.Property_Address1')}} 
									</th>		
									<th>
										{{__('group.Is_Empty_Lot')}}
									</th>					
								</tr>
							</thead>
							<tbody>			
							
							</tbody>
						</table>
            <div><p id="info">0 {{__('group.Row_Selected')}}</p></div>
					</div>
				</div>
			</div>
	</div>
	<span class="clear"></span>
</div>
<div style="display: none;"  id="revice-modal-content2">
        <h3>{{__('group.General_Information')}}</h3>
        <form action="#" id="valuationcheckform" method="post" class="form_container">  
          @csrf
         
          <ul >   
            <li>
              <div class="form_grid_12 multiline">
                <div class="form_input">
                  <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('group.Reason_Name')}}<span class="req">*</span></label>
                      <div class="form_input">
                       <select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="termid" name="termid" tabindex="20">
                          <option></option>
                          @foreach ($reason as $rec)
                            <option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
                          @endforeach 
                        </select>
                      </div>
                      <span class=" label_intro"></span>
                    </div>  
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('group.Description')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="desc" required="true"  name="name" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>  
                  <span class="clear"></span>
                </div>
              </div>
            </li>
          </ul>
          
          <div class="btn_24_blue">           
            <!--<button id="addsubmit"type="submit" class="btn_small btn_blue"><span>Submit</span></button> -->
            <a href="#" onclick="submitRevise()" class=""><span>{{__('common.Submit')}}  </span></a>  
          </div>
          <div class="btn_24_blue">
            <a href="#" class="simplemodal-close"><span>{{__('common.Close')}}  </span></a>
          </div>
          </form>
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
            "retrieve": true,
            "sPaginationType": "full_numbers",
			"iDisplayLength": 100,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
        "columns": [
              {"data": "vd_accno", "orderable": false, "searchable": false, "name":"_id" },
              {"data": null, "name": "sno"},              
              {"data": "vd_accno", "name": "zone"},
              {"data": "zone", "name": "subzone"},
              {"data": "subzone", "name": "owner"}, 
              {"data": "ma_addr_ln1", "name": "ishasbldg"}, 
              {"data": "isbldg", "name": "ishasbldg"}              
          ],
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
      "fnRowCallback": function (nRow, aData, iDisplayIndex) {
              $("td:nth-child(2)", nRow).html(iDisplayIndex + 1);
              var count = $('#proptble').DataTable().rows().count();
          $('#prop_count').html(count);
              return nRow;
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
	function getSelectedProp1(){
   // alert();
    $('#revice-modal-content2').modal();
		/*var table = $('#proptble').DataTable();
		  console.log(table.rows('.selected').data());
		var account = $.map(table.rows('.selected').data(), function (item) {
       return item['vd_id']
   	});
      console.log(account);
      var id="{{$id}}";
      var type = "deactivateproperty";

   		$.ajax({
	        type:'GET',
	        url:'grappdata',
	        data:{accounts:account,id:id,type:type},
	        success:function(data){	        	
	        	
            alert(data.newcount+" Property Added");
	        
	        }
		});*/
    	//console.log(accounts);
    //alert(table.rows('.selected').data().length + ' row(s) selected');
		

		//console.log(rows);
	

  }
  function submitRevise(){

                var reason = $('#termid').val();
                var desc = $('#desc').val();

                var table = $('#proptble').DataTable();
                console.log(table.rows('.selected').data());
                var account = $.map(table.rows('.selected').data(), function (item) {
                   return item['vd_id']
                });
                if(account.length>0){
        account=account.toString();
        } 
                  console.log(account);
                  var id="{{$id}}";
                  var type = "deactivateproperty";

                  $.ajax({
                      type:'GET',
                      url:'grapnewdata',
                      data:{accounts:account,id:id,type:type,reason:reason,desc:desc},
                      success:function(data){           
                        
                        alert(data.newcount+" Property Added");
                      
                      }
                });         
            
}

  function back(){
    var url = "grabbasket?insbasket_id={{$id}}";
    window.location = url;
  }
  
  function closeWindow(){
    window.opener.location.reload();
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