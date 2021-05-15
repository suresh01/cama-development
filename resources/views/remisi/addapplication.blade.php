<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('remisiLang.New_Property')}} </title>


@include('includes.header-popup')
	<div id="content">
		<div class="grid_container">

		<div id="usertable" class="grid_12">	
			<br>
        
				<div style="float:right;margin-right: 0px;"  class="btn_24_blue">	      
          
          <a href="#" id="" onclick="closeWindow()" class=""><span>{{__('common.Close')}}  </span></a> 
				</div>
        <div style="float:right;margin-right: 15px;"  class="btn_24_blue">          
          @include('inspection.grab.search')
        </div>
				<br>
        
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="proptble" class="display select">
							<thead style="text-align: left;">
								<tr>
									<th class="table_sno">{{__('remisiLang.SNO')}}</th>
                  <th>{{__('remisiLang.New_Property')}}</th>
                  <th>{{__('remisiLang.Account_Number')}}</th>
                  <th>{{__('remisiLang.Zone')}}</th>
                  <th>{{__('remisiLang.Subzone')}}</th>
                  <th>{{__('remisiLang.Property_Building_Status')}}</th>
                  <th>{{__('remisiLang.Property_Category')}}</th>
                  <th>{{__('remisiLang.Action')}}</th>		
								</tr>
							</thead>
							<tbody>			
							
							</tbody>
						</table>
					</div>
				</div>
			</div>
      <div id="addgroup" style="display:none" class="grid_10 full_block">
        <div class="widget_wrap">
          <div class="widget_content">
            <h3 id="title">{{__('remisiLang.Add_Basket')}} </h3>
            <form id="addgroupfrom" autocomplete="off" class="" method="get" action="#" >
              @csrf
              <input type="hidden" name="id" id="id" value="0">
              <input type="hidden" name="operation" id="operation" value="0">
              <div  class="grid_12 form_container left_label">
                <ul>
                  <li>                
                    <div class="form_grid_12">                  
                      <label class="field_title" id="termname" for="termid">{{__('remisiLang.Applicant_Name')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="name"  name="name" autocomplete="off" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>       
                  </li>
                </ul>
              </div>
              
              <div style="height: 48px; float: none; display: -webkit-box;text-align: -webkit-center;" class="grid_12">
                
                <div class="form_input">
                  <button id="addsubmit" name="adduser" onclick="validateGroup()" class="btn_small btn_blue"><span>{{__('common.Submit')}} </span></button>     
                            
                  <button id="close" onclick="closeGroup()" name="close" type="button" class="btn_small btn_blue"><span>{{__('common.Close')}} </span></button>
                  <span class=" label_intro"></span>
                </div>
                
                <span class="clear"></span>
              </div>
            </form>
          </div>
        </div>
      </div>
	</div>

  
        
	<span class="clear"></span>
</div>
<script>


$(document).ready(function (){

      $( "#letterdate" ).datepicker({dateFormat: 'dd/mm/yy'});
      $( "#date" ).datepicker({dateFormat: 'dd/mm/yy'});
   // Array holding selected row IDs
   var rows_selected = [];
   	
    var tbl = $('#proptble').DataTable({
      "processing": false,
            "serverSide": false,
            "retrieve": true,
            "sPaginationType": "full_numbers",
			"iDisplayLength": 100,
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
        "columns": [
              {"data": "vd_id", "name": "sno"},              
              {"data": "ma_accno", "name": "zone"},
              {"data": "zone", "name": "subzone"},
              {"data": "subzone", "name": "owner"}, 
              {"data": "ma_addr_ln1", "name": "ishasbldg"}, 
              {"data": "isbldg", "name": "ishasbldg"},
              {"data": function(data){
                return '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" disabled="true" title="Select Asset Area" class="select-assetdba "  onclick="addApplication('+data.vd_id+')"  href="#"></a></span>'; 
               }, "name": "address"}            
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
              $("td:nth-child(1)", nRow).html(iDisplayIndex + 1);
              var count = $('#proptble').DataTable().rows().count();
          $('#prop_count').html(count);
              return nRow;
          },
      'rowCallback': function(row, data, dataIndex){
         // Get row ID
         var rowId = data[0];

         
      },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			 
		});
		$("div.table_top select").addClass('tbl_length');
		$(".tbl_length").chosen({
			disable_search_threshold: 4	
		});
   

   //alert(selectedrow());

   // Handle form submission event

});

function addApplication(id){
  //  $('#id').val(id);
   // $("#usertable").hide();
      //    $("#addgroup").show();
    var type = "addremisi";
      //var type = "addproperty";
      $.ajax({
          type:'GET',
          url:'grapnewdata',
          data:{accounts:"add",id:id,type:type},
          success:function(data){           
            var count = data.newcount;
            if(count==0){
               alert("Account Number already exists in Remisi");
            } else {
              alert("Account Number Added");
              closeWindow();
            }
            
          }
    });
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