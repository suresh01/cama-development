<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Remisi</title>

@include('includes.header', ['page' => 'datamaintenance'])
					
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">	
					<br>
				<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
					<ul>
						<li><a href="#">{{__('menu.home')}}</a></li>
						<li><a href="#">{{__('menu.datamaintenance')}}</a></li>
						<li>{{__('menu.remisi')}}</li>
					</ul>
				</div>
				</div>			
				
				<div style="float:right;margin-right: 10px;"  class="btn_24_blue">
					
					<a href="#" onclick="addApplication()" >{{__('remisi.addapplication')}}</a>
					
				</div>

				<br>
        
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="proptble" class="display select">
							<thead style="text-align: left;">
								<tr>
									<th><input name="select_all" value="1" type="checkbox"></th>
									<th class="table_sno">
										{{__('remisi.col1')}}
									</th>
									<th>
										{{__('remisi.col2')}}
									</th>
									<th>
										{{__('remisi.col3')}}
									</th>
									<th>
										{{__('remisi.col4')}}
									</th>
									<th>
										{{__('remisi.col5')}}
									</th>		
									<th>
										{{__('remisi.col6')}}
									</th>
									<th>
										{{__('remisi.col7')}}
									</th>	
									<th>
										{{__('remisi.col8')}}
									</th>
									<th>
										{{__('remisi.col9')}}
									</th>
									<th>
										{{__('remisi.col10')}}
									</th>
									<th>
										{{__('remisi.col11')}}
									</th>
									<th>
										Decision Officer
									</th>
									<th>
										Decision Date
									</th>	
									<th>
										{{__('remisi.col12')}}
									</th>
									<th>
										{{__('remisi.col13')}}
									</th>		
								</tr>
							</thead>
							<tbody>		
									
									
								
								
							</tbody>
						</table>


								
				</div>
			</div>
		</div>
	<div id="addDetail" style="display:none" class="grid_12">
			<div class="widget_wrap">
				
				<div class="widget_content">
					<h3 id="generatereport">Generate Report</h3>
					<form style="" id="generateform" method="GET" action="generateRemisireport">
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

		function reportRemisi(accno){
			$('#type').val('type1');
			$('#accountnumber').val(accno);
			$('#addDetail').modal();
		}
		function reportRemisiLawat(accno){
			$('#type').val('type2');
			$('#accountnumber').val(accno);
			$('#addDetail').modal();
		}
		
		function addApplication() {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "addremisi";
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}
		
		function remisiDetail(id) {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "remisidetail?id="+id;
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}

		function approve(id,currstatus){
			
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
					        data:{param_value:id,module:'remisi',param:currstatus},
					        success:function(data){
								window.location.assign("remisi");									
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

$(document).ready(function (){

	var table = $('#proptble').DataTable({
		       "processing": false,
		        "serverSide": false,
		        /*"dom": '<"toolbar">frtip',*/
		        "ajax": {
		            "type": "GET",
		            "url": 'remisisearchdata',
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

			        	return "<a onclick='remisiDetail("+data.rg_id+")' href='#'>"+data.ma_accno+"</a>";

			        }, "name": "account number"},
			        {"data": "zone", "name": "zone"},
			        {"data": "subzone", "name": "subzone"},
			        {"data": "propertstatus", "name": "address"},
			        {"data": "bldgcategory", "name": "owner", }, 
			        {"data": "bldgtype", "name": "ishasbldg", }, 
			        {"data": "bldgsotery", "name": "ishasbldg", }, 
			        {"data": "rg_createby", "name": "ishasbldg"}, 
			        {"data": "rg_createat_frmt", "name": "propertstatus"}, 
			        {"data": function(data){
			        	if(data.rg_redecision_id == 1 ){
			        		return 'Approved';
			        	} else if(data.rg_redecision_id == 2 ){
			        		return 'Rejected';
			        	} else {
			        		return '';
			        	}
			        }, "name": "ishasbldg"}, 
			        {"data": "rg_desiofficer", "name": "ishasbldg"}, 
			        {"data": "rg_desiofficerdate_frmt", "name": "ishasbldg"}, 
			        {"data": "approvalstatus", "name": "ishasbldg"}, 
			        {"data":  function(data){
			        	
			        	var action = "";
			        		
							var editaction =
							"&nbsp;&nbsp;<span><a style='height: 15px; width: 13px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -143px -23px !important;display: inline-block; '  onclick='deleteBasket("+data.rg_id+")' href='#' title='Delete'></a></span>";

							if(data.rg_remisistatus_id == '0'  ){
								action = editaction +  '<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('+data.rg_id+',0)"  title="Submit For Investigation" href="#"></a></span>';							
							} else if(data.rg_remisistatus_id == '2'){
								action = editaction +  '<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('+data.rg_id+',2)"  title="Submit For Proposed" href="#"></a></span>';
						
							} else if(data.rg_remisistatus_id == '3'){
								action = editaction +  '<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('+data.rg_id+',3)"  title="Submit For Decision" href="#"></a></span>';
						
							} else if(data.rg_remisistatus_id == '4'){
								action =     '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('+data.rg_id+',5)"  title="Approve" href="#"></a></span>' + 
								'<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -542px -42px !important;display: inline-block; float: left;" onclick="approve('+data.rg_id+',6)"  title="Reject" href="#"></a></span>' + editaction;							
							} else if(data.rg_remisistatus_id == '5'){
								action =   '<spane><a style="width: 14px;	height: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat -843px -102px !important;display: inline-block; float: left;" onclick="reportRemisi('+data.rg_id+')" title="Report Remisi" href="#"></a></span>' + 							
								'<spane><a style="width: 14px;	height: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat -843px -102px !important;display: inline-block; float: left;"  onclick="reportRemisiLawat('+data.rg_id+')" title="Report Remisi" title="Report Lawat Periksa Remisi" href="#"></a></span>'
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