<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('officialsearch.New_Property')}}</title>


@include('includes.header-popup')
	<div id="content">
		<div class="grid_container">

		<div id="usertable" class="grid_12">	
			<br>
        
				<div style="float:right;margin-right: 0px;"  class="btn_24_blue">	      
          
          <a href="#" id="" onclick="closeWindow()" class=""><span>{{__('common.Close')}} </span></a> 
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
									<th class="table_sno"> {{__('officialsearch.SNO')}} </th>
									<th> {{__('officialsearch.Account_Number')}} </th>
                  <th> {{__('officialsearch.Zone')}} </th>
                  <th> {{__('officialsearch.Subzone')}} </th> 
                  <th> {{__('officialsearch.Property_Address1')}}  </th>    
                  <th> {{__('officialsearch.Is_Empty_Lot')}} </th>    
                  <th> {{__('officialsearch.Action')}} </th>      
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
            <h3 id="title">{{__('officialsearch.Application')}} </h3>
            <form id="addgroupfrom" autocomplete="off" class="" method="get" action="#" >
              @csrf
              <input type="hidden" name="id" id="id" value="0">
              <input type="hidden" name="operation" id="operation" value="1">
              <div  class="grid_12 form_container left_label">
                <ul>
                  <li>                
                    <div class="form_grid_12">                  
                      <label class="field_title" id="termname" for="termid">{{__('officialsearch.Applicant_Name')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="name"  name="name" autocomplete="off" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>                
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Address1')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="addrln1"  name="addrln1" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>                
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Address2')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="addrln2"  name="addrln2" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>             
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Address3')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="addrln3"  name="addrln3" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>             
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Address4')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="addrln4"  name="addrln4" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>             
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.City')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="city"  name="city" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>              
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Postcode')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="postcode"  name="postcode" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>               
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.State')}} <span class="req">*</span></label>
                      <div class="form_input">
                         <select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="state" name="state" tabindex="20">
                          @foreach ($state as $rec)
                              <option value='{{ $rec->state_id }}'>{{ $rec->state }}</option>
                          @endforeach 
                        </select>
                      </div>
                      <span class=" label_intro"></span>
                    </div>           
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Applicant_Ref')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="appref"  name="appref" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>                   
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Our_Ref')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="ref" name="ref" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>                  
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Date')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="date" name="date" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>                  
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Hijri_Date')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="hdate"  name="hdate" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>                   
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Letter_Date')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="letterdate"  name="letterdate" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>                  
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">Group Id<span class="req">*</span></label>
                      <div class="form_input">
                        
                        <select placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="group" name="group" tabindex="2">
                          <option value=""></option>                          
                            @foreach ($group as $rec)
                                <option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
                            @endforeach 
                        </select>
                      </div>
                      <span class=" label_intro"></span>
                    </div>        
                  </li>
                </ul>
              </div>
              
              <div style="height: 48px; float: none; display: -webkit-box;text-align: -webkit-center;" class="grid_12">
                
                <div class="form_input">
                  <button id="addsubmit" name="adduser" onclick="validateGroup()" class="btn_small btn_blue"><span>{{__('common.Submit')}}</span></button>     
                            
                  <button id="close" onclick="closeGroup()" name="close" type="button" class="btn_small btn_blue"><span>{{__('common.Close')}}</span></button>
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
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
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
		$('#id').val(id);
    $("#usertable").hide();
          $("#addgroup").show();
      var type = "addapplication";
   		/*$.ajax({
	        type:'GET',
	        url:'grapnewdata',
	        data:{accounts:"",id:id,type:type},
	        success:function(data){	        	
	        	
            alert(" Application Added");
	          closeWindow();
	        }
		});*/
	}

  function validateGroup(){
     /* $('#addgroupfrom').validate({
            submitHandler: function(form) {*/
              var transdata = {};
              $('#addgroupfrom').serializeArray().map(function(x){transdata[x.name] = x.value;});

              //console.log(transdata);
              var transjson = JSON.stringify(transdata);

              var id =$('#id').val();
              var type = "addapplication";
              $.ajax({
                  type:'GET',
                  url:'addapplicationdata',
                  data:{jsondata:transjson,id:id},
                  success:function(data){   
                    alert("Application Added");
                    closeWindow();
                  }
              });
          //  }
      //  });
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