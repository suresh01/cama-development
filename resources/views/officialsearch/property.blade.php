<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('officialsearch.Official_Search')}}</title>
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
@include('includes.header', ['page' => 'dataenquery'])
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
						<li><a href="#">{{__('officialsearch.Home')}} </a></li>
						<li>{{__('officialsearch.Official_Search')}}</li>
					</ul>
				</div>
				</div>
				
				<div style="float:right;margin-right: 30px;"  class="btn_24_blue">

					@include('officialsearch.search')
					<a href="#" onclick="addApplication()">{{__('officialsearch.addapplication')}}</a>
					
				</div>
				<br>


				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="proptble" class="display select ">

							<div class="social_activities">

								<div class="comments_s">
									<div class="block_label">
										{{__('officialsearch.Property_Count')}} <span id="prop_count">0</span>
									</div>
								</div>
							</div>	


							

							<br>
							<thead style="text-align: left;">
								<tr>
									<th><input name="select_all" value="1" type="checkbox"></th>
									<th class="table_sno">{{__('officialsearch.SNO')}} </th>
									<th> {{__('officialsearch.Group')}}  </th>
									<th> {{__('officialsearch.Account_Number')}}  </th>
									<th> {{__('officialsearch.Zone')}}   </th>
									<th> {{__('officialsearch.Subzone')}}   </th>
									<th> {{__('officialsearch.Property_Building_Status')}}  </th>	
									<th> {{__('officialsearch.Property_Category')}}  </th>			
									<th> {{__('officialsearch.Property_Type')}}  </th>		
									<th> {{__('officialsearch.Property_Storey')}}  </th>
									<th> {{__('officialsearch.Register_By')}}  </th>	
									<th> {{__('officialsearch.Register_Date')}}  </th>
									<th> {{__('officialsearch.Status')}}  </th>	
									<th> {{__('officialsearch.Action')}}  </th>			
								</tr>
							</thead>
							<tbody>			
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
				
		
		
	</div>
<div id="addDetail" style="display:none" class="grid_12">
		<div class="widget_wrap">
			
			<div class="widget_content">
				<h3 id="generatereport">Generate Report</h3>
				<form style="" id="generateform" method="GET" action="generateoffsReport">
					@csrf
					<input type="hidden" name="type" id="type">
					<input type="hidden" name="accountnumber" id="accountnumber">
					<div  class="grid_12 form_container left_label">
						<ul>
							<li>
								
								<fieldset>
									<legend>Additional Information</legend>
									
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">VALUER NAME<span class="req">*</span></label>
										<div  class="form_input">
											<select onchange="getposition()" data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="name" tabindex="7" name="name" tabindex="20">
											<option></option>
												@foreach ($userlist as $rec)
														<option value='{{ $rec->usr_id }}'>{{ $rec->usr_name }}</option>
												@endforeach	
											</select>
										</div>
										<span class=" label_intro"></span>
										<input type="hidden" id="username" name="username">
									</div>
									
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">VALUER TITLE<span class="req">*</span></label>
										<div  class="form_input">
											<input id="title" name="title"  type="text"  maxlength="50" class="required"/>
										</div>
										<span class=" label_intro"></span>
									</div>
								
								</fieldset>

		
							</li>
						</ul>
					</div>
					
					<div class="grid_12">							
						<div class="form_input">
							<button id="addsubmit" name="adduser" class="btn_small btn_blue"><span>Submit</span></button>									
							
							<button id="close" name="close" type="button" class="btn_small btn_blue simplemodal-close"><span>Close</span></button>
							<span class=" label_intro"></span>
						</div>								
						<span class="clear"></span>
					</div>
				</form>
			</div>
		</div>
	</div>

	<span class="clear"></span>
	
	<script>


		function generateReport(accno){
			$('#type').val('Successs');
			$('#accountnumber').val(accno);
			$('#addDetail').modal();
		}
		function getposition(){
			var userid = $('#name').val();
			
			$('#username').val($("#name option:selected").text());
			$.ajax({
		        type:'GET',
		        url:'/getuserdetail',
		        data:{id:userid},
		        success:function(data){	        	
		        	$('#title').val(data.userposition);
		        }
		    });
		}
		
		function approve(id,currstatus){

	var table = $('#proptble').DataTable();
		var account = $.map(table.rows('.selected').data(), function (item) {
		// console.log(item);
    		return item['os_id']
		});
		if(account.length==0){
				account=id;
	   		} else {
	   			account=account.toString();
	   		}
		//alert(account);
		//alert(currstatus);
		var noty_id = noty({
			layout : 'center',
			text: 'Are you sure want to Submit?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Submit', click: function($noty) {
					$noty.close();
					$.ajax({
		  				type: 'GET', 
					    url:'approve',
					    headers: {
						    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
				        data:{param_value:id,module:'officialsearch',param:currstatus,param_str:account },
				        success:function(data){	        	
				        	
							window.location.assign("officialsearch");	
							
			        	},
				        error:function(data){
							//$('#loader').css('display','none');	
				        	alert('error');
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



	function approve(id,currstatus,type){
		var param_status ="";
		if(type == 1){
			param_status = 'AP';
		} else {
			param_status = 'RJ';
		}

		var table = $('#bldgtable').DataTable();
		var account = $.map(table.rows('.selected').data(), function (item) {
		// console.log(item);
    		return item['os_id']
		});
		if(account.length==0){
				account=id;
	   		} else {
	   			account=account.toString();
	   		}

		//alert(account);
		//alert(currstatus);
		var noty_id = noty({
			layout : 'center',
			text: 'Are you sure want to Submit?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Submit', click: function($noty) {
					$noty.close();
					$.ajax({
		  				type: 'GET', 
					    url:'approve',
					    headers: {
						    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
				        data:{param_value:id,module:'officialsearch',param:currstatus,param_str:account,param_status:param_status },
				        success:function(data){	 	
				        	
							window.location.assign("officialsearch");	
							
			        	},
				        error:function(data){
							//$('#loader').css('display','none');	
				        	alert('error');
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

	
		function changeField(val){
			if(val == 'table'){
				$('#maxrow').removeAttr('style');
			} else {
				$('#maxrow').attr('style', "display:none;");
			}
		}

		function addApplication() {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "addapplication";
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}


		function updateApplication(id) {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "updateapplication?id="+id;
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
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
		            "url": 'officialsearchdata',
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
			        {"data": "ugroup", "name": "ugroup"},
			        {"data": function(data){

			        	return "<a onclick='updateApplication("+data.os_id+")' href='#'>"+data.ma_accno+"</a>";

			        }, "name": "account number"},
			        {"data": "zone", "name": "zone"},
			        {"data": "subzone", "name": "subzone"},
			        {"data": "propertstatus", "name": "address"},
			        {"data": "bldgcategory", "name": "owner"}, 
			        {"data": "bldgtype", "name": "ishasbldg"}, 
			        {"data": "bldgsotery", "name": "ishasbldg"}, 
			        {"data": "os_createby", "name": "ishasbldg"}, 
			        {"data": "os_createdate_frmt", "name": "propertstatus"}, 
			        {"data": "approvalstatus", "name": "ishasbldg"}, 
			        {"data":  function(data){
			        	
			        	var action = "";
			        		
							var editaction =
							"&nbsp;&nbsp;<span><a style='height: 15px; width: 13px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -143px -23px !important;display: inline-block; '  onclick='deleteBasket("+data.os_id+")' href='#' title='Delete'></a></span>";

							if(data.os_officialsearchstatus_id == '1'  || data.os_officialsearchstatus_id == '6'){
								action = editaction +  '<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('+data.os_id+',1)"  title="Submit To Approve" href="#"></a></span>';							
							} else if(data.os_officialsearchstatus_id == '2'){
								action =   '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('+data.os_id+',2,1)"  title="Approve" href="#"></a></span>' + 
								'<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -542px -42px !important;display: inline-block; float: left;" onclick="approve('+data.os_id+',2,2)"  title="Reject" href="#"></a></span>';							
							} else if(data.os_officialsearchstatus_id == '3'){
								action =  '<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -362px -142px !important;display: inline-block; float: left;" onclick="generateReport('+data.os_id+')"  title="Print" href="#"></a></span>';
						
							} else if(data.os_officialsearchstatus_id == '4'){
								action =  editaction +   '<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('+data.os_id+',1)"  title="Submit To Approve" href="#"></a></span>';

							} else if(data.os_officialsearchstatus_id == '5'){
								action =   '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('+data.os_id+',5)"  title="Approve Revise" href="#"></a></span>';						
							} 
							

			        		return action;

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
			"drawCallback": function ( settings ) {
	            var api = this.api();
	            var rows = api.rows( {page:'current'} ).nodes();
	            var last="";
	 
	            api.column(2, {page:'current'} ).data().each( function (group, i ) {
	            	
	                if ( last !== group ) {

	                    $(rows).eq( i ).before(
	                        '<tr class="group"><td colspan="5">'+group+'</td></tr>'
	                    );
	 
	                    last = group;
	                }
	            } );
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
   // Array holding selected row IDs
   var rows_selected = [];
   
   
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

		function deleteBasket(id) {
				//$('#operation').val(3);
				//$('#bldgid').val(id);

            	var type = "addapplication";
				
				var noty_id = noty({
					layout : 'center',
					text: 'Do you want Delete?',
					modal : true,
					buttons: [
						{type: 'button pink', text: 'Delete', click: function($noty) {
				  
							$.ajax({
				                type:'GET',
				                url:'grapnewdata',
				                data:{accounts:"delete",id:id,type:type},
				                success:function(data){           
				                  
				                  window.location.assign('officialsearch');
				                }
				            });
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

	</script>
</div>

</body>
</html>