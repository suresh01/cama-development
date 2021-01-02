<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Ratepayer</title>

<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/layout.css" rel="stylesheet" type="text/css">
<link href="css/themes.css" rel="stylesheet" type="text/css">
<link href="css/typography.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/shCore.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/jquery.jqplot.css" rel="stylesheet" type="text/css">
<link href="css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css">
<link href="css/data-table.css" rel="stylesheet" type="text/css">
<link href="css/form.css" rel="stylesheet" type="text/css">
<link href="css/ui-elements.css" rel="stylesheet" type="text/css">
<link href="css/wizard.css" rel="stylesheet" type="text/css">
<link href="css/sprite.css" rel="stylesheet" type="text/css">
<link href="css/gradient.css" rel="stylesheet" type="text/css">
<link href="css/tree.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="js/jquery.ui.touch-punch.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="js/uniform.jquery.js"></script>
<script src="js/bootstrap-dropdown.js"></script>
<script src="js/bootstrap-colorpicker.js"></script>
<script src="js/sticky.full.js"></script>
<script src="js/jquery.noty.js"></script>
<script src="js/selectToUISlider.jQuery.js"></script>
<script src="js/fg.menu.js"></script>
<script src="js/jquery.tagsinput.js"></script>
<script src="js/jquery.cleditor.js"></script>
<script src="js/jquery.tipsy.js"></script>
<script src="js/jquery.peity.js"></script>
<script src="js/jquery.simplemodal.js"></script>
<script src="js/jquery.jBreadCrumb.1.1.js"></script>
<script src="js/jquery.colorbox-min.js"></script>
<script src="js/jquery.idTabs.min.js"></script>
<script src="js/jquery.multiFieldExtender.min.js"></script>
<script src="js/jquery.confirm.js"></script>
<script src="js/elfinder.min.js"></script>
<script src="js/accordion.jquery.js"></script>
<script src="js/autogrow.jquery.js"></script>
<script src="js/check-all.jquery.js"></script>
<!--<script src="js/data-table.jquery.js"></script>-->
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script src="js/ZeroClipboard.js"></script>
<script src="js/TableTools.min.js"></script>
<script src="js/jeditable.jquery.js"></script>
<script src="js/ColVis.min.js"></script>
<script src="js/duallist.jquery.js"></script>
<script src="js/easing.jquery.js"></script>
<script src="js/full-calendar.jquery.js"></script>
<script src="js/input-limiter.jquery.js"></script>
<script src="js/inputmask.jquery.js"></script>
<script src="js/iphone-style-checkbox.jquery.js"></script>
<script src="js/meta-data.jquery.js"></script>
<script src="js/quicksand.jquery.js"></script>
<script src="js/raty.jquery.js"></script>
<script src="js/smart-wizard.jquery.js"></script>
<script src="js/stepy.jquery.js"></script>
<script src="js/treeview.jquery.js"></script>
<script src="js/ui-accordion.jquery.js"></script>
<script src="js/vaidation.jquery.js"></script>
<script src="js/mosaic.1.0.1.min.js"></script>
<script src="js/jquery.collapse.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/jquery.autocomplete.min.js"></script>
<script src="js/localdata.js"></script>
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.jqplot.min.js"></script>
<script src="js/custom-scripts.js"></script>
<script src="js/common/common-script.js"></script>
<script src="js/common/validation/validation.js"></script>
</head>
<body id="theme-default" class="full_block">
<script type = "text/javascript">  
    window.onload = function () {  
        document.onkeydown = function (e) {  
            return (e.which || e.keyCode) != 116 || (e.keyCode == 65 && e.ctrlKey);  
        };  
        $(function() {
            $(this).bind("contextmenu", function(e) {
                e.preventDefault();
            });
        }); 
    }  
</script> 
<div style="margin-top: 0px;" id="container">

	<div id="content">
		<div class="grid_container">

		<div id="ratepayer_table" class="grid_12">	
			<br>
				<div style="float:right;margin-right: 0px;"  class="btn_24_blue">	
					<a href="#" id="" onclick="openTenantUser()" class=""><span>Add New Ratepayer </span></a>
          
				</div>

				<div style="float:right;margin-right: 15px;"  class="btn_24_blue">				
					@include('search.rateperysearch')
				</div>
        <div style="float:right;margin-right: 15px;"  class="btn_24_blue"> 
          <a href="#" id="close" onclick="return CloseMySelf(this);" class=""><span>Add</span></a>   
        </div>
				<br>
        
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="proptble" class="display select">
							<thead style="text-align: left;">
                <tr>
                  <th class="center">
                    
                  </th>
                  <th class="table_sno">
                    S No
                  </th>
                  <th>
                    APPLICATION TYPE
                  </th>
                  <th>
                    RATEPAYER TYPE
                  </th>
                  <th>
                    RATEPAYER NUMBER 
                  </th>
                  <th>
                    NAME
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
                    STATE
                  </th> 
                  <th>
                    POSTCODE
                  </th>   
                 <th>
                    ACTION
                  </th>  
                </tr>
              </thead>
							<tbody>			
							   <div id="hiddenvalues" style="display: none;"></div>
							</tbody>
						</table>
					</div>
				</div>
			</div>

  <div id="addratepayerform" style="display:none" class="grid_12">
      <div class="widget_wrap">
        
        <div class="widget_content">
          <h3 id="title">Add Ratepayer</h3>
          <form id="tenantform" autocomplete="off" method="post" action="#" >
            <div  class="grid_6 form_container left_label">
              <ul>
                <li>
                  <input type="hidden" name="operation" id="operation">
                  <input type="hidden" name="ratepayerid" id="ratepayerid">
                  <input type="hidden" name="jsondata" id="jsondata">
                  <input type="hidden" name="type" value="insadd" id="type">

                  <fieldset>
                    <legend>Ratepayer Information</legend>
                    <div class="form_grid_12">
                      <label class="field_title" id="accnumberlbl" for="username">APPLICATION TYPE<span class="req">*</span></label>
                      <div  class="form_input">
                        <select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="applntypeid" name="applntypeid" tabindex="20">
                          @foreach ($applntype as $rec)
                              <option value='{{ $rec->applntype_id }}'>{{ $rec->applntype }}</option>
                          @endforeach 
                        </select>
                      </div>
                      <span class=" label_intro"></span>
                    </div>
                    
                    <div class="form_grid_12">
                      <label class="field_title" id="lposition" for="position">RATEPAYER TYPE<span class="req">*</span></label>
                      <div  class="form_input">
                        <select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="typeid" name="typeid" tabindex="20">
                          @foreach ($ratepayertype as $rec)
                              <option value='{{ $rec->ratepayertype_id }}'>{{ $rec->ratepayertype }}</option>
                          @endforeach 
                        </select>
                      </div>
                      <span class=" label_intro"></span>
                    </div>
                    
                    
                    <div class="form_grid_12">
                      <label class="field_title" id="llevel" for="level">RATEPAYER NUMBER<span class="req">*</span></label>
                      <div  class="form_input">
                        <input id="number" name="number"  type="text"  maxlength="50" class="required"/>
                      </div>
                      <span class=" label_intro"></span>
                    </div>
                 
                    <div class="form_grid_12">
                      <label class="field_title" id="llevel" for="level">NAME<span class="req">*</span></label>
                      <div  class="form_input">
                        <input id="name" name="name"  type="text"  maxlength="50" class=" required "/>
                      </div>
                      <span class=" label_intro"></span>
                    </div>

                    <div class="form_grid_12">
                      <label class="field_title" id="llevel" for="level">PHONE NUMBER<span class="req">*</span></label>
                      <div  class="form_input">
                        <input id="phoneno" name="phoneno"  type="text"  maxlength="12" class="required"/>
                      </div>
                      <span class=" label_intro"></span>
                    </div>
                 
                    <div class="form_grid_12">
                      <label class="field_title" id="llevel" for="level">EMAIL ID<span class="req">*</span></label>
                      <div  class="form_input">
                        <input id="emailid" name="emailid"  type="text"  maxlength="50" class=" required "/>
                      </div>
                      <span class=" label_intro"></span>
                    </div>

                  </fieldset>

                  <fieldset>
                    <legend>Other Information</legend>
                    <div class="form_grid_12">
                      <label class="field_title" id="accnumberlbl" for="username">CITIZEN<span class="req">*</span></label>
                      <div  class="form_input">
                        <select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="citizenid" name="citizenid" tabindex="20">
                          @foreach ($citizen as $rec)
                              <option value='{{ $rec->citizen_id }}'>{{ $rec->citizen }}</option>
                          @endforeach 
                        </select>
                      </div>
                      <span class=" label_intro"></span>
                    </div>
                    
                    <div class="form_grid_12">
                      <label class="field_title" id="lposition" for="position">RACE<span class="req">*</span></label>
                      <div  class="form_input">
                        <select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="raceid" name="raceid" tabindex="20">
                          @foreach ($race as $rec)
                              <option value='{{ $rec->race_id }}'>{{ $rec->race }}</option>
                          @endforeach 
                        </select>
                      </div>
                      <span class=" label_intro"></span>
                    </div>
                    
                    
                    <div class="form_grid_12">
                      <label class="field_title" id="llevel" for="level">STATUS<span class="req">*</span></label>
                      <div  class="form_input">
                        <select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="activeindid" name="activeindid" tabindex="20">
                          @foreach ($activeind as $rec)
                              <option value='{{ $rec->activeind_id }}'>{{ $rec->activeind }}</option>
                          @endforeach 
                        </select>
                      </div>
                      <span class=" label_intro"></span>
                    </div>

                  </fieldset>
      
                </li>
              </ul>
            </div>
            <div  class="grid_6 form_container left_label">
              <ul>
                <li>        
                  <fieldset>
                    <legend>Address Information</legend>          
                    <div class="form_grid_12">
                      <label class="field_title" id="lposition" for="position">ADDRESS 1<span class="req">*</span></label>
                      <div  class="form_input">
                        <input id="addr1" name="addr1"  type="text"  maxlength="50" class="required"/>
                      </div>
                      <span class=" label_intro"></span>
                    </div>

                    <div class="form_grid_12">
                      <label class="field_title" id="lposition" for="position">ADDRESS 2</label>
                      <div  class="form_input">
                        <input id="addr2"  name="addr2"  type="text"  maxlength="50" class=""/>
                      </div>
                      <span class=" label_intro"></span>
                    </div>
                    <div class="form_grid_12">
                      <label class="field_title" id="lposition" for="position">ADDRESS 3</label>
                      <div  class="form_input">
                        <input id="addr3"  name="addr3"  type="text"  maxlength="50" class=""/>
                      </div>
                      <span class=" label_intro"></span>
                    </div>
                    <div class="form_grid_12">
                      <label class="field_title" id="lposition" for="position">ADDRESS 4</label>
                      <div  class="form_input">
                        <input id="addr4"  name="addr4"  type="text"  maxlength="50" class=""/>
                      </div>
                      <span class=" label_intro"></span>
                    </div>
                    <div class="form_grid_12">
                      <label class="field_title" id="lposition" for="position">POST CODE<span class="req">*</span></label>
                      <div  class="form_input">
                        <input id="postcode" name="postcode"  type="text"  maxlength="50" class="required"/>
                      </div>
                      <span class=" label_intro"></span>
                    </div>
                    <div class="form_grid_12">
                      <label class="field_title" id="llevel" for="level">STATE<span class="req">*</span></label>
                      <div  class="form_input">
                        <select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="stateid" name="stateid" tabindex="20">
                          @foreach ($state as $rec)
                              <option value='{{ $rec->state_id }}'>{{ $rec->state }}</option>
                          @endforeach 
                        </select>
                      </div>
                      <span class=" label_intro"></span>
                    </div>
                  </fieldset>
                  
                </li>
              </ul>
            </div>
            <div style="height: 48px; float: none; display: -webkit-box;text-align: -webkit-center;" class="grid_12">             
              <div class="form_input">
                <button id="addsubmit" name="adduser" onclick="validateTenant()" class="btn_small btn_blue"><span>Submit</span></button>                  
                
                <button id="close" onclick="closeTenant()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>
                <span class=" label_intro"></span>
              </div>                
              <span class="clear"></span>
            </div>
          </form>
        </div>
      </div>
    </div>
	<span class="clear"></span>
</div>
<script>

  function editTenantUser(id){
    $("#title").html("Update Ratepayer");
    $('#number').attr('readonly', "readonly");
    $('#applntypeid').val($('#applntype_'+id).val());
    $('#typeid').val($('#typeid_'+id).val());
    $('#number').val($('#number_'+id).val());
    $('#name').val($('#name_'+id).val());
    $('#addr1').val($('#addr1_'+id).val());
    $('#addr2').val($('#addr2_'+id).val());
    $('#addr3').val($('#addr3_'+id).val());
    $('#addr4').val($('#addr4_'+id).val());
    $('#postcode').val($('#postcode_'+id).val());
    $('#stateid').val($('#stateid_'+id).val());
    $('#citizenid').val($('#citizenid_'+id).val());
    $('#raceid').val($('#raceid_'+id).val());
    $('#activeindid').val($('#activeind_'+id).val());
    $('#phoneno').val($('#phone_'+id).val());
    $('#emailid').val($('#email_'+id).val());
    

    $('#ratepayerid').val(id);
    $('#operation').val(2);
    $("#ratepayer_table").hide();
    $("#addratepayerform").show();
    $("label.error").remove();
  }

  function openTenantUser(){
    $("#title").html("Add Ratepayer");
    $('#number').removeAttr('readonly');
    $('#applntypeid').val('');
    $('#typeid').val('');
    $('#number').val('');
    $('#name').val('');
    $('#addr1').val('');
    $('#addr2').val('');
    $('#addr3').val('');
    $('#addr4').val('');
    $('#postcode').val('');
    $('#stateid').val('');
    $('#citizenid').val('');
    $('#raceid').val('');
    $('#activeindid').val('');
    $('#phoneno').val('');
    $('#emailid').val('');
    
    $('#ratepayerid').val(0);
    $('#operation').val(1);
    $("#ratepayer_table").hide();
    $("#addratepayerform").show();
    $("label.error").remove();
  }
  
  function closeTenant(){
    $("#ratepayer_table").show();
    $("#addratepayerform").hide();
    $("label.error").remove();
    
  }

  function deleteTenant(id) {
    $('#operation').val(3);
    $('#ratepayerid').val(id);

    
    var noty_id = noty({
      layout : 'center',
      text: 'Do you want Delete?',
      modal : true,
      buttons: [
        {type: 'button pink', text: 'Delete', click: function($noty) {
      
          // this = button element
          // $noty = $noty element
            var tenantdata = {};
              $('#tenantform').serializeArray().map(function(x){tenantdata[x.name] = x.value;});

                //console.log(tenantdata);
                var tenantjson = JSON.stringify(tenantdata);
                //$('#jsondata').val(tenantjson);
                //console.log(tenantjson);
                window.location.assign('ratepayertrn?type=insadd&jsondata='+tenantjson);
          $noty.close();
          //noty({force: true, text: 'You clicked "Ok" button', type: 'success',layout : 'center',modal : true,});
          }
        },
        {type: 'button green', text: 'Cancel', click: function($noty) {
          $noty.close();
          //noty({force: true, text: 'You clicked "Cancel" button', type: 'error',layout : 'center',modal : true,});
          }
        }
        ],
      type : 'success', 
    });
  }

  function validateTenant(){
    $('#tenantform').validate({
          rules: {
              postcode: {
                  required: true,
                  minlength: 5,
                  maxlength: 6,
              },
              'phoneno':{
                required: true,
                  maxlength: 15
              },
              'emailid' : "email"
          },
          messages: {
        firstname: "Enter your firstname"
          },
          submitHandler: function(form) {

            var noty_id = noty({
      layout : 'center',
      text: 'Do you want update?',
      modal : true,
      buttons: [
        {type: 'button pink', text: 'Update', click: function($noty) {
      
          var d=new Date();
            var applnid = $('#applntypeid').val();
        var typeid = $('#typeid').val();
        var number = $('#number').val();
        var operation = $('#operation').val();
        var page = "ratepayer";

        if (operation == '1'){
          
          $.ajax({
            type:'GET',
            url:'getValidRatepayer?date='+ d.getTime(),
            data:{applnid:applnid,typeid:typeid,number:number,page:page},
            success:function(data){           
              if(data.msg === "false" ){
                alert("Ratepayer Information Already Exsist.");
                $("#number").focus();
              } else {
                var tenantdata = {};
                $('#tenantform').serializeArray().map(function(x){tenantdata[x.name] = x.value;});

                  //console.log(tenantdata);
                  var tenantjson = JSON.stringify(tenantdata);
                  //$('#jsondata').val(tenantjson);
                  //console.log(tenantjson);
                  window.location.assign('ratepayertrn?type=insadd&jsondata='+tenantjson)
                  //$('#tenantform').submit();
              }
          }
        });
        } else {
          
          var tenantdata = {};
                $('#tenantform').serializeArray().map(function(x){tenantdata[x.name] = x.value;});

                  //console.log(tenantdata);
                  var tenantjson = JSON.stringify(tenantdata);
                  //$('#jsondata').val(tenantjson);
                  //console.log(tenantjson);
                  window.location.assign('ratepayertrn?type=insadd&jsondata='+tenantjson)
                  //$('#tenantform').submit();
        }
          
          $noty.close();
          //noty({force: true, text: 'You clicked "Ok" button', type: 'success',layout : 'center',modal : true,});
          }
        },
        {type: 'button green', text: 'Cancel', click: function($noty) {
          $noty.close();
          //noty({force: true, text: 'You clicked "Cancel" button', type: 'error',layout : 'center',modal : true,});
          }
        }
        ],
      type : 'success', 
    });

            
            
            
          }
      });
  }

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
		 			rows_selected.push( [ '{{ $rec->rp_id }}','{{$loop->iteration}}', '{{ $rec->applntype }}', '{{ $rec->ratepayertype }}', '{{ $rec->rp_no }}','{{ $rec->rp_name}}', '{{ $rec->rp_addr_ln1 }}', '{{ $rec->rp_addr_ln2 }}', '{{ $rec->rp_addr_ln3 }}','{{ $rec->state }}', '{{ $rec->rp_postcode }}','<span><a class="action-icons c-edit" onclick="editTenantUser({{ $rec->rp_id }})" href="#" title="Edit">Edit</a></span> '] );
         $('#hiddenvalues').append(' <input type="hidden" id="applntype_{{ $rec->rp_id }}" value="{{ $rec->rp_applntype_id }}"> '+
          '  <input type="hidden" id="typeid_{{ $rec->rp_id }}" value="{{ $rec->rp_type_id }}">'+
         '   <input type="hidden" id="number_{{ $rec->rp_id }}" value="{{ $rec->rp_no }}"> '+
          '  <input type="hidden" id="name_{{ $rec->rp_id }}" value="{{ $rec->rp_name }}"> '+
          '  <input type="hidden" id="addr1_{{ $rec->rp_id }}" value="{{ $rec->rp_addr_ln1 }}">'+
          '  <input type="hidden" id="addr2_{{ $rec->rp_id }}" value="{{ $rec->rp_addr_ln2 }}">'+
          '  <input type="hidden" id="addr3_{{ $rec->rp_id }}" value="{{ $rec->rp_addr_ln3 }}">  '+
          '  <input type="hidden" id="addr4_{{ $rec->rp_id }}" value="{{ $rec->rp_addr_ln4 }}">  '+
          '  <input type="hidden" id="postcode_{{ $rec->rp_id }}" value="{{ $rec->rp_postcode }}">'+
          '  <input type="hidden" id="stateid_{{ $rec->rp_id }}" value="{{ $rec->rp_state_id }}">'+
          '  <input type="hidden" id="citizenid_{{ $rec->rp_id }}" value="{{ $rec->rp_citizen_id }}">  '+
          '  <input type="hidden" id="raceid_{{ $rec->rp_id }}" value="{{ $rec->rp_race_id }}">  '+
          '  <input type="hidden" id="activeind_{{ $rec->rp_id }}" value="{{ $rec->rp_activeind_id }}">'+
          '  <input type="hidden" id="phone_{{ $rec->rp_id }}" value="{{ $rec->rp_phone_no }}">  '+
            '<input type="hidden" id="email_{{ $rec->rp_id }}" value="{{ $rec->rp_email_addr }}">');
		 		@endforeach
    $('#proptble').DataTable({
            data:           rows_selected,
            "sPaginationType": "full_numbers",
			"iDisplayLength": 5,
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
	

  function CloseMySelf(sender) {
   
    try {
        window.opener.HandlePopupResult(sender.getAttribute("result"));
    }
    catch (err) {}
   
    //var ratepayer = $("#ratepayertble",parent.document).DataTable();
    //var t = $('#lottble1').DataTable();
    var table = $("#proptble").DataTable()
    var count = table.data().count();
    var id = $.map(table.rows('.selected').data(), function (item) {
        return item[0]
    });
    var data = table.data();
    var duplicate = 0;
    for (var i=0; i < data.length ;i++){
     //  console.log(data[i][0]);
       if(data[i][0] == id) {
          duplicate++;
       }
    }
    if (duplicate === 1 || duplicate === 0){
      window.opener.CallParent(table);
     //console.log(ratepayer);
      window.close();
    } else {
      alert("Please select one ratepayer only");
    }
    return false;
  }


</script>
</body>
</html>