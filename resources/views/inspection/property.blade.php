<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('inspection.Inspection_Property')}}</title>
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
@include('includes.header', ['page' => 'VP'])
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
	<div id="content">
		<div class="grid_container">

		<div id="usertable" class="grid_12">	
			<br>
				<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
					<ul>
						<li><a href="#">{{__('inspection.Home')}} </a></li>
						<li><a href="valterm">{{__('inspection.Valuation_Data_Management')}} </a></li>
						<li><a href="valbasket?id={{$termid}}&ts=1"> {{__('inspection.Basket')}}</a></li>
						<li>{{__('inspection.Property')}}</li>
					</ul>
				</div>
				</div>
				
				<div style="float:right;margin-right: 30px;"  class="btn_24_blue">

					@include('inspection.propertysearch')

					@include('inspection.bldgarea')
					@if($approvestatus == '04' )	
					<a href="#" onclick="addProperty()">{{__('inspection.New_Property')}} </a>
					<a href="#" onclick="addExisitingProperty()">{{__('inspection.Add_Exsisting_Property')}} </a>
					<!--<a href="#" onclick="deleteProperty()">Delete Property</a>-->


					@endif


				</div>
				<br>
  

				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="proptble" class="display select ">

							<div class="social_activities">

								<div style="width: 420px;" class="comments_s">
									<div style="width: 420px;" class="block_label">
										{{__('inspection.Term')}} <span>{{$viewparamterm}}</span>
									</div>
								</div>

								<div style="width: 520px;" class="comments_s">
									<div style="width: 520px;" class="block_label">
										{{__('inspection.Basket')}} <span>{{$viewparambasket}} - {{$viewparambasketstatus}}</span>
									</div>
								</div>

								<div class="comments_s">
									<div class="block_label">
										{{__('inspection.Property_Count')}} <span id="prop_count">0</span>
									</div>
								</div>

								<select id='testSelect1' style="float: right;" multiple>
									<option value='3'>{{__('inspection.File_Number')}}</option> 
									<option value='4'>{{__('inspection.Zone')}}</option> 
									<option value='5'>{{__('inspection.Subzone')}}</option> 
									<option value='6'>{{__('inspection.Status_Harta')}}</option> 
									<option value='7'>{{__('inspection.Property_Category')}}</option> 
									<option value='8'>Land Value</option> 
									<option value='9'>Building Value</option> 
									<option value='10'>{{__('inspection.Nt')}}</option> 
									<option value='11'>{{__('inspection.Rate')}}</option> 
									<option value='12'>{{__('inspection.Tax_Rate')}}</option> 
									<option value='13'>{{__('inspection.Status')}}</option> 
									<option value='14'>{{__('inspection.Address1')}}</option> 
									<option value='15'>{{__('inspection.Address2')}}</option> 
									<option value='16'>{{__('inspection.Address3')}}</option> 
									<option value='17'>{{__('inspection.Address4')}}</option> 
									<option value='18'>{{__('inspection.Post_Code')}}</option> 
									<option value='19'>{{__('inspection.City')}}</option> 
									<option value='20'>{{__('inspection.State')}}</option> 
								</select>
							</div>	


							

							<br>
							<thead style="text-align: left;">
								<tr>
									<th><input name="select_all" value="1" type="checkbox"></th>
									<th class="table_sno">{{__('inspection.SNo')}}</th>
									<th>{{__('inspection.Account_Number')}}</th>
									<th>{{__('inspection.File_Number')}}</th>
									<th>{{__('inspection.Zone')}} </th>
									<th>{{__('inspection.Subzone')}} </th>
									<th>{{__('inspection.Status_Harta')}}</th>	
									<th>{{__('inspection.Property_Category')}}</th>	
									<!--<th>{{__('inspection.owner')}}Owner Name</th>											
									<th>{{__('inspection.owner')}}Owner Type / Owner Number</th>-->	
									<th>Land Value</th>
									<th>Building Value</th>	
									<th>{{__('inspection.Nt')}}</th>		
									<th>{{__('inspection.Rate')}}</th>	
									<th>{{__('inspection.Tax_Rate')}}</th>	
									<th>{{__('inspection.Status')}}</th>	
									<th>{{__('inspection.Address1')}}</th>
									<th>{{__('inspection.Address2')}}</th>
									<th>{{__('inspection.Address3')}}</th>
									<th>{{__('inspection.Address4')}}</th>	
									<th>{{__('inspection.Post_Code')}}</th>
									<th>{{__('inspection.City')}}</th>
									<th>{{__('inspection.State')}}</th>	
									<th>{{__('inspection.Action')}}</th>
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


		<div style="display: none;"  id="revice-modal-content">
				<h3>{{__('inspection.Revise_Information')}}</h3>
				<form action="validateValuation" id="valuationcheckform" method="post" class="form_container">	
					@csrf
				<input type="hidden" id="val_id" name="val_id" >			
					<ul id="filterrow">		
						<li class="li">
							<div class="form_grid_12 multiline">
								<div class="form_input">
									<div class="form_grid_6">
										<select data-placeholder="{{__('common.Choose_a_Custom')}}..." style="width:100%" class="cus-select field" id="revisestage" name="revisestage" tabindex="20">
											<option value="0">{{__('inspection.Please_select_Stage')}} </option>
											<option value="INS">{{__('inspection.Inspection')}} </option>				
											<option value="VAL">{{__('inspection.Valuation')}} </option>								
										</select>
										<input type="hidden" value="" name="valuatuion_id" id="valuatuion_id">
									</div>
									<span class="clear"></span>
								</div>
							</div>
						</li>
					</ul>
					
					<div class="btn_24_blue">						
						<!--<button id="addsubmit"type="submit" class="btn_small btn_blue"><span>Submit</span></button>	-->
						<a href="#" onclick="submitRevise()" class=""><span>{{__('common.Revise')}}  </span></a>	
					</div>
					<div class="btn_24_blue">
						<a href="#" class="simplemodal-close"><span>{{__('common.Close')}}  </span></a>
					</div>
					</form>
			</div>

			<div style="display: none;height: 160px;"  id="open-modal-content">
				<h3>{{__('inspection.Stage_Information')}} </h3>
				<form action="validateValuation" id="valuationcheckform" method="post" class="form_container">	
					@csrf
				<input type="hidden" id="val_id" name="val_id" >			
					<ul id="filterrow">		
						<li class="li">
							<div class="form_grid_12 multiline">
								<div class="form_input">
									<div class="form_grid_6">
										<select onchange="regirect(this.value)" data-placeholder="{{__('common.Choose_a_Custom')}}..." style="width:100%" class="cus-select field" id="stage" name="stage" tabindex="20">
											<option value="#">{{__('inspection.Please_select_Stage')}} </option>
											<option value="inspection">{{__('inspection.Inspection')}}</option>				
											<option value="valuationdetail">{{__('inspection.Valuation')}} </option>						
										</select>
									</div>
									<span class="clear"></span>
									<input type="hidden" id="basket">
									<input type="hidden" value="0" id="property">
									<input type="hidden" value="0" id="tableindex">
									<input type="hidden" value="0" id="propstatus">
								</div>
							</div>
						</li>
					</ul>
					
					
					<div class="btn_24_blue">
						<a href="#" class="simplemodal-close"><span>{{__('common.Close')}}  </span></a>
					</div>
					</form>
			</div>

	<span class="clear"></span>
	
	<script>
var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

		function hidecl(id){
			var table = $('#proptble').DataTable();
			var column = table.column( id);
			 //alert($('#'+id).prop("checked"));
			  column.visible( $('#'+id).prop("checked"));
		 		

		}

		function regirect(url){
			//var url = $('#stage').val();
			var basket = $('#basket').val();
			var property = $('#property').val();
			var propstatus = $('#propstatus').val();
			//alert(propstatus);
			if(propstatus == "7" || propstatus == "9"){
				url="manualvaluation";
			}
			//alwet(basket+" "+property)
			if (property != "0") {
				window.location.assign(url+"?prop_id="+property+"&pb="+basket);
			}
			
		}

		function stageOption(property, Basket, status){
			$('#basket').val(Basket);
			$('#property').val(property);
			$('#propstatus').val(status);
			$('#open-modal-content').modal();
		}
		

	
		function changeField(val){
			if(val == 'table'){
				$('#maxrow').removeAttr('style');
			} else {
				$('#maxrow').attr('style', "display:none;");
			}
		}

		function addProperty() {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "grabbasket?type=1&insbasket_id={{$id}}&aptype={{$applicationtype}}";
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}

		function addExisitingProperty() {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "existsproperty?type=2&id={{$id}}&aptype={{$applicationtype}}";
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}

		function updateProperty(id) {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "inspectiondetail?prop_id="+id+"&id={{$id}}";
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}
		

		function deleteProperty(vd_id){
			var table = $('#proptble').DataTable();
			var account = $.map(table.rows('.selected').data(), function (item) {
	        	return item['vd_id']
	   		});

	   		if(account.length==0){
				account=vd_id;
	   		} else {
	   			account=account.toString();
	   		}
//alert(account);
			var type = "delete";
			var id="{{$id}}";
			console.log(account);
			var noty_id = noty({
				layout : 'center',
				text: 'Are want to delete properties?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Delete', click: function($noty) {
						$noty.close();

						$.ajax({
					        type:'GET',
					        url:'grapnewdata',
					        data:{accounts:account,type:type,id:id},
					        success:function(data){
					        	var noty_id = noty({
									layout : 'top',
									text: 'Property deleted!',
									modal : true,
									type : 'success', 
								});	
								location.reload();				        		
					        	//$("#finish").attr("disabled", true);
					        	//clearTableError(4);
				        	},
					        error:function(data){
								//$('#loader').css('display','none');	
					        	   	
					        		var noty_id = noty({
									layout : 'top',
									text: 'Problem while delete property!',
									modal : true,
									type : 'error', 
								});
				        	}
						});
					  }
					},
					{type: 'button blue', text: 'Cancel', click: function($noty) {
						$noty.close();
					  }
					}
					],
				 type : 'success', 
			 });
			
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
		  var table = $('#proptble').DataTable();
		  var count = 0;
		  $.map(table.rows('.selected').data(), function (item) {
		       count++;
		    });
		  return count;
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

	

		//var hidecol = [4,5,6];
		// table hide colmn
		

});


var table = $('#proptble').DataTable({
		        "processing": false,
		        "serverSide": false,
		        /*"dom": '<"toolbar">frtip',*/
		        "ajax": {
		            "type": "GET",
		            "url": 'insproperty?id={{$id}}&ts=1',
		            "contentType": 'application/json; charset=utf-8',
				    "headers": {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		        },
					"lengthMenu":  [100, 200, 500, 1000],		
				 	
		       // ajax: '{{ url("inspectionproperty") }}',
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
			        {"data": "ma_accno", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": null, "name": "sno"},
			        {"data": function(data){
			        	if(data.vd_approvalstatus_id == '04' || data.vd_approvalstatus_id == '05' || data.vd_approvalstatus_id == '06'){
			        		return "<a href='inspection?prop_id="+data.vd_id+"&pb="+data.vd_va_id+"'>"+data.ma_accno+"</a>";
			        	} else {
			        		return "<a onclick='stageOption("+data.vd_id+","+data.vd_va_id+","+data.vd_approvalstatus_id+")' href='#'>"+data.ma_accno+"</a>";
			        	}
			        	return '';
			        }, "name": "account number"},
			        {"data": "ma_fileno", "name": "zone"},
			        {"data": "zone", "name": "subzone"},
			        {"data": "subzone", "name": "subzone"},
			        {"data": "isbldg", "name": "address"},
			        {"data": function(data){
			            return data.bldgcategory+" || "+data.bldgtype+" || "+data.bldgsotery;
			        }, "name": "owner"}, 
			        {"data": "landvalue", "name": "ishasbldg"}, 
			        {"data": "bldgvalue", "name": "propertstatus"}, 
			        {"data": "vt_approvednt", "name": "owner", "sClass": "numericCol"}, 
			        {"data": "vt_proposedrate", "name": "ishasbldg", "sClass": "numericCol"}, 
			        {"data": "vt_approvedtax", "name": "ishasbldg", "sClass": "numericCol"}, 
			        {"data": "propertstatus", "name": "propertstatus"}, 
			        {"data": "ma_addr_ln1", "name": "propertstatus","visible":false}, 
			        {"data": "ma_addr_ln2", "name": "ishasbldg","visible":false}, 
			        {"data": "ma_addr_ln3", "name": "propertstatus","visible":false}, 
			        {"data": "ma_addr_ln4", "name": "ishasbldg","visible":false}, 
			        {"data": "ma_postcode", "name": "propertstatus","visible":false}, 
			        {"data": "ma_city", "name": "ishasbldg","visible":false}, 
			        {"data": "state", "name": "propertstatus","visible":false},  
			        {"data":  function(data){
			        	
			        	var deleteuri = '&nbsp;&nbsp;&nbsp;<span><a class="action-icons  "  onclick="deleteProperty('+data.vd_id+')" disabled="true" title="Delete Property" href="#"></a></span>';
			        	var approveuri = '<span><a class="action-icons c-approve "  onclick="approveProperty('+data.vd_id+')"  title="Approve Property" href="#"></a></span>';
			        	var edituri = ''//'<span><a class="action-icons c-edit editbldg"  onclick="updateProperty('+data.vd_id+')"  title="Update Property" href="#"></a></span>';

			        	if('{{$approvestatus}}' == '04'  ){
				        	if(data.vd_approvalstatus_id == '05' ){
				        		return approveuri+deleteuri+edituri;
				        	} else if(data.vd_approvalstatus_id == '06'){
				        		return '<span><a onclick="reviseProperty('+data.vd_id+')" class="new-action-icons reverse" href="#" title="Revise Inspection">Cancel</a></span>'+edituri;
				        	}  else if(data.vd_approvalstatus_id == '04'){
				        		return approveuri+deleteuri+edituri;
				        	} 
			        	}

			        	if('{{$approvestatus}}' == '06' || '{{$approvestatus}}' == '07' || '{{$approvestatus}}' == '08' ){
				        	if(data.vd_approvalstatus_id == '08' || data.vd_approvalstatus_id == '09'){
				        		return '<span><a class="action-icons c-approve" onclick="approveValuation('+data.vd_id+')" title="Approve Valuation" href="#">Approve</a></span><span><a onclick="reviseOption('+data.vd_id+')" class="new-action-icons reverse" href="#" title="Revise Property">Cancel</a></span>'+edituri;
				        	} else if(data.vd_approvalstatus_id == '10' ){
				        		return '<span><a onclick="reviseOption('+data.vd_id+')" class="new-action-icons reverse" href="#" title="Revise Property">Cancel</a></span>'+edituri;
				        	} else if(data.vd_approvalstatus_id == '06' || data.vd_approvalstatus_id == '07'){
				        		return '<span><a onclick="reviseProperty('+data.vd_id+')" class="new-action-icons reverse" href="#" title="Revise Inspection">Cancel</a></span>'+edituri;
				        	} else if(data.vd_approvalstatus_id == '05' ){
				        		return approveuri+deleteuri+edituri;
				        	} else if(data.vd_approvalstatus_id == '11' ){
			        			return '<span><a onclick="reviseOption('+data.vd_id+')" class="new-action-icons reverse" href="#" title="Revise Property">Cancel</a></span>'+edituri;
			        		}
			        	}
			        	return '';
			        }, "name": "propertstatus"}
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
	    // Array holding selected row IDs
	    var rows_selected = [];
	   
	    
	    hideCol('proptble', [11,12,13,14,15,16,17]);
		
		defaultDatatableColumn(["2","3","4","5","6","7","8","9","10"]);

		$('.multiselect-wrapper .multiselect-list span:first').html('');
		//$('.multiselect-wrapper .multiselect-list hr:first').html('');

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

   $('#proptble tbody').on('click', '.editbldg', function () {
        $('#tableindex').val(table.row( $(this).parents('tr') ).index());      
        console.log($('#tableindex').val());  
    });

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', $('#proptble').DataTable().table().container()).on('click', function(e){
      if(this.checked){
        $('#proptble tbody input[type="checkbox"]').prop('checked', true);
         $('#proptble tbody tr').addClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      } else {
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
      updateDataTableSelectAllCtrl($('#proptble').DataTable());
   });

 		//var column = table.column( 2);
 
        // Toggle the visibility
       // column.visible( false);


   // Handle form submission event

});


function reviseProperty(id){
	var table = $('#proptble').DataTable();
//console.log(table.rows('.selected').data());
	var account = $.map(table.rows('.selected').data(), function (item) {
		//console.log(item);
    	return item['vd_id']
		});
	
	//console.log(account.length);
	//console.log(account.toString());
	if (account.length > 0){
		id = account.toString();
	}

	var noty_id = noty({
			layout : 'center',
			text: 'Are want to cancel inpsection approve?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Revise Inspection', click: function($noty) {
					$noty.close();
					$.ajax({
		  				type: 'GET', 
					    url:'approve',
					    headers: {
						    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
				        data:{param_value:0,module:'REVINS',param:id},
				        success:function(data){		
							
							window.location.assign('property?id={{$id}}&ts=1');		        		
				        	//$("#finish").attr("disabled", true);
				        	//clearTableError(4); 
			        	},
				        error:function(data){
							//$('#loader').css('display','none');	
				        	$('#finishloader').html('');     	
				        		var noty_id = noty({
								layout : 'top',
								text: 'Something went wrong!',
								modal : true,
								type : 'error', 
							});
			        	}
			    	});
				  }
				},
				{type: 'button blue', text: 'Cancel', click: function($noty) {
					$noty.close();
				  }
				}
				],
			 type : 'success', 
		 });
	
}

function approveProperty(id){

	var table = $('#proptble').DataTable();
//console.log(table.rows('.selected').data());
	var account = $.map(table.rows('.selected').data(), function (item) {
		//console.log(item);
    	return item['vd_id']
		});
	
	//console.log(account.length);
	//console.log(account.toString());
	if (account.length > 0){
		id = account.toString();
	}

	var noty_id = noty({
			layout : 'center',
			text: 'Are want to approve inpsection?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Approve Inspection', click: function($noty) {
					$noty.close();
					$.ajax({
		  				type: 'GET', 
					    url:'approve',
					    headers: {
						    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
				       // data:{param_value:id,module:'APINS'},
				        data:{param_value:0,module:'APINS',param:id},
				        success:function(data){		
							
							window.location.assign('property?id={{$id}}&ts=1');		        		
				        	//$("#finish").attr("disabled", true);
				        	//clearTableError(4); 
			        	},
				        error:function(data){
							//$('#loader').css('display','none');	
				        	$('#finishloader').html('');     	
				        		var noty_id = noty({
								layout : 'top',
								text: 'Something went wrong!',
								modal : true,
								type : 'error', 
							});
			        	}
			    	});
				  }
				},
				{type: 'button blue', text: 'Cancel', click: function($noty) {
					$noty.close();
				  }
				}
				],
			 type : 'success', 
		 });
	
}

function approveValuation(id){

	var table = $('#proptble').DataTable();
//console.log(table.rows('.selected').data());
	var account = $.map(table.rows('.selected').data(), function (item) {
		//console.log(item);
    	return item['vd_id']
		});
	
	//console.log(account.length);
	//console.log(account.toString());
	if (account.length > 0){
		id = account.toString();
	}

	var noty_id = noty({
			layout : 'center',
			text: 'Are want to approve valuation?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Approve Valuation', click: function($noty) {
					$noty.close();
					$.ajax({
		  				type: 'GET', 
					    url:'approve',
					    headers: {
						    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
				        data:{param_value:0,module:'APVAL',param:id},
				        success:function(data){
							
							window.location.assign('property?id={{$id}}&ts=1');		        		
				        	//$("#finish").attr("disabled", true);
				        	//clearTableError(4); 
			        	},
				        error:function(data){
							//$('#loader').css('display','none');	
				        	$('#finishloader').html('');     	
				        		var noty_id = noty({
								layout : 'top',
								text: 'Something went wrong!',
								modal : true,
								type : 'error', 
							});
			        	}
			    	});
				  }
				},
				{type: 'button blue', text: 'Cancel', click: function($noty) {
					$noty.close();
				  }
				}
				],
			 type : 'success', 
		 });
	
}

	function reviseOption(id){
		$('#revice-modal-content').modal();
		$('#val_id').val(id);
	}

	function submitRevise(){
		var table = $('#proptble').DataTable();
	//console.log(table.rows('.selected').data());
		var account = $.map(table.rows('.selected').data(), function (item) {
			//console.log(item);
	    	return item['vd_id']
			});
		var id =  "";
		//console.log(account.length);
		//console.log(account.toString());
		if (account.length > 0){
			id = account.toString();
		}
		var noty_id = noty({
			layout : 'center',
			text: 'Are want to revise?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Revise', click: function($noty) {
					$noty.close();
					$.ajax({
		  				type: 'GET', 
					    url:'approve',
					    headers: {
						    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
				        data:{param_value:$('#val_id').val(),module:'REVVAL',param:$('#revisestage').val(),param_str:id},
				        success:function(data){		
							
							window.location.assign('property?id={{$id}}&ts=1');		        		
				        	//$("#finish").attr("disabled", true);
				        	//clearTableError(4); 
			        	},
				        error:function(data){
							//$('#loader').css('display','none');	
				        	$('#finishloader').html('');     	
				        		var noty_id = noty({
								layout : 'top',
								text: 'Something went wrong!',
								modal : true,
								type : 'error', 
							});
			        	}
			    	});
				  }
				},
				{type: 'button blue', text: 'Cancel', click: function($noty) {
					$noty.close();
				  }
				}
				],
			 type : 'success', 
		 });
	}


	</script>
</div>

</body>
</html>