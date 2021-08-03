<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('CodeMaintenance.Property_Information')}}</title>

@include('includes.header', ['page' => 'datamaintenance'])
					
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">	
					<br>
				<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
					<ul>
						<li><a href="#">{{__('CodeMaintenance.Home')}} </a></li>
						<li><a href="#">{{__('CodeMaintenance.Data_Maintenance')}} </a></li>
						<li>{{__('CodeMaintenance.Property_Address')}} </li>
					</ul>
				</div>
				</div>
				
				<div style="float:right;margin-right: 10px;"  class="btn_24_blue">
							
					@include('codemaintenance.ownershiptransfer.newsearch')
					<a href="#" onclick="addProperty()">{{__('CodeMaintenance.Add_Property')}}</a>
				</div>
				<br>
        
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="proptble" class="display select">
							<thead style="text-align: left;">
								<tr>
									<th class="table_sno">
										{{__('CodeMaintenance.SNo')}}
									</th>
									<th>
										{{__('CodeMaintenance.Account_Number')}}
									</th>
									<th>
										{{__('CodeMaintenance.File_Number')}}
									</th>
									<th>
										{{__('CodeMaintenance.Zone')}}
									</th>
									<th>
										{{__('CodeMaintenance.SubZone')}}
									</th>
									<th>
										{{__('CodeMaintenance.Address1')}}
									</th>	
									<th>
										{{__('CodeMaintenance.Address2')}}
									</th>	
									<th>
										{{__('CodeMaintenance.Address3')}}
									</th>	
									<th>
										{{__('CodeMaintenance.City')}}
									</th>
									<th>
										{{__('CodeMaintenance.Post_Code')}}
									</th>		
									<th>
										{{__('CodeMaintenance.Status')}}
									</th>	
									<th>
										{{__('CodeMaintenance.Action')}}
									</th>		
								</tr>
							</thead>
							<tbody>			
								
							</tbody>
						</table>


								<div class="grid_12 invoice_details">
									<div class="widget_wrap collapsible_widget">
										<div class="widget_top active">
											<span class="h_icon"></span>
											<h6>{{__('CodeMaintenance.Log_Information')}}</h6>
										</div>
										<div class="widget_content">
											<div class="invoice_tbl">
												<table id="logtable">
												<thead>
												<tr class=" gray_sai">
													<th>
														{{__('CodeMaintenance.Log_Id')}} 
													</th>
													<th>
														{{__('CodeMaintenance.Account_Number')}} 
													</th>
													<th>
														{{__('CodeMaintenance.Property_Address')}} File_Number
													</th>
													<th>
														{{__('CodeMaintenance.Zone')}} 
													</th>
													<th>
														{{__('CodeMaintenance.SubZone')}} 
													</th>
													<th>
														{{__('CodeMaintenance.Address1')}}
													</th>	
													<th>
														{{__('CodeMaintenance.Address2')}}
													</th>	
													<th>
														{{__('CodeMaintenance.Address3')}}
													</th>	
													<th>
														{{__('CodeMaintenance.City')}}
													</th>
													<th>
														{{__('CodeMaintenance.Post_Code')}}
													</th>		
													<th>
														{{__('CodeMaintenance.Status')}}
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
				</div>
			</div>
			
		<!-- <form style="display: hidden;" id="generateform" method="GET" action="generateinspectionreport">
            @csrf
            <input type="hidden" name="accounts" id="accounts">
		</form>-->
		
		
	</div>
	<span class="clear"></span>
	
	<script>
		
		function changeField(val){
			if(val == 'table'){
				$('#maxrow').removeAttr('style');
			} else {
				$('#maxrow').attr('style', "display:none;");
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
				        data:{param_value:id,module:'propertyaddress',param:currstatus,param_str:account },
				        success:function(data){	        	
				        	
							window.location.assign("propertyaddress");	
							
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
	   	if(currstatus == 5){
			var noty_id = noty({
				layout : 'center',
				text: 'Are you sure want to Transfer Data?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Submit', click: function($noty) {
						$noty.close();
						$.ajax({
			  				type: 'GET', 
						    url:'datatransfer',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{param_value:id,module:'propertyaddress',param:currstatus,param_str:account,param_status:param_status },
					        success:function(data){						        	
								window.location.assign("propertyaddress");									
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
		} else {
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
					        data:{param_value:id,module:'propertyaddress',param:currstatus,param_str:account,param_status:param_status },
					        success:function(data){	 	
					        	
								window.location.assign("propertyaddress");	
								
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
	}

$(document).ready(function (){

	

	var table = $('#proptble').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				 
		        // ajax: '{{ url("inspectionproperty") }}',
		        /*"ajax": '/bookings/datatables',*/
		         "ajax": {
		            "type": "GET",
		            "url": 'searchpropertyaddressdata',
		            "contentType": 'application/json; charset=utf-8',
				    "headers": {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		        },
		        "columns": [
			        {"data": null, "name": "sno"},
			        {"data":  function(data){

			        	return "<a href=#' onclick='edit("+data.mal_id+")'>"+data.mal_accno+"</a>";
			        
			        }, "name": "account number"},
			        {"data": "mal_fileno", "name": "fileno"},
			        {"data": "zone", "name": "zone"},
			        {"data": "subzone", "name": "subzone"},
			        {"data": "mal_addr_ln1", "name": "owner"}, 
			        {"data": "mal_addr_ln2", "name": "ishasbldg"},
			        {"data": "mal_addr_ln3", "name": "owntype"}, 
			        {"data": "mal_city", "name": "TO_OWNNAME"}, 
			        {"data": "mal_postcode", "name": "bldgcount"}, 
			        {"data": "tstatus", "name": "bldgcount"}, 
			        {"data":  function(data){

			        	var editaction ='<a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -362px -62px !important;display: inline-block; float: right;" title="View Log" 			        	onclick="submitLogForm('+data.mal_id+')"></a></span>&nbsp;&nbsp;&nbsp;&nbsp;' ;

			        	var deleteaction ="&nbsp;&nbsp;<span><a style='height: 15px; width: 13px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -143px -23px !important;display: inline-block; float: right;'  onclick='deleteProperty("+data.mal_id+")' href='#' title='Delete'></a></span>";

							if(data.mal_approvalstatus_id == '1'  || data.mal_approvalstatus_id == '6'){
								action =  deleteaction + editaction  ;				

							} else if(data.mal_approvalstatus_id == '2'){
								action= deleteaction + editaction + '<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('+data.mal_id+',2)"  title="Submit To Approve" href="#"></a></span>'
							
							} else if(data.mal_approvalstatus_id == '4'){
								action =  editaction +  '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('+data.mal_id+',4,1)"  title="Approve" href="#"></a></span>' + 
								'<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -542px -42px !important;display: inline-block; float: left;" onclick="approve('+data.mal_id+',4,2)"  title="Reject" href="#"></a></span>';		

							} else if(data.mal_approvalstatus_id == '5'){
								action =  editaction+  '<!--<spane><a  class=" new-action-icons reverse" onclick="approve('+data.mal_id+',5)" title="Revise" href="#"></a></span>-->								<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -822px -42px !important;display: inline-block; float: left;" onclick="approve('+data.mal_id+',5)" title="Transfer" href="#"></a></span>';						
							} 
							
			        		return action;

			        }, "name": "bldgcount"}
		   		],
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  	
			        $("td:nth-child(1)", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
			        return nRow;
			    },
			    "sPaginationType": "full_numbers",
			"iDisplayLength": 100,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
		    'columnDefs': [{
         'targets': 0,
         'searchable': true,
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
	


		function edit(acc) {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "ownerdetail?prop_id="+acc;
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}


		function submitLogForm(account){
		//console.log($("#filterForm").serialize());



	var logtable = $('#logtable').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				 
		      //   ajax: '{{ url("inspectionproperty") }}',
		        /*"ajax": '/bookings/datatables',*/

		        "columns": [
			        {"data": "mal_id", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": "mal_accno", "name": "sno"},
			        {"data": "mal_fileno", "name": "account number"},
			        {"data": "zone", "name": "account number"},
			        {"data": "subzone", "name": "fileno"},
			        {"data": "mal_address1", "name": "zone"},
			        {"data": "mal_address2", "name": "ishasbldg"},
			        {"data": "mal_address3", "name": "owntype"}, 
			        {"data": "mal_postcode", "name": "TO_OWNNAME"}, 
			        {"data": "mal_city", "name": "bldgcount"}, 
			        {"data": "tdi_value", "name": "bldgcount"}
		   		],
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  	
			       // $("td:nth-child(2)", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
			        return nRow;
			    },
			    "sPaginationType": "full_numbers",
			"iDisplayLength": 100,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
		    'columnDefs': [{
         'targets': 0,
         'searchable': true,
         'orderable': false,
         'width': '1%',
         'className': 'dt-body-center'
      }],


      'rowCallback': function(row, data, dataIndex){
         // Get row ID
         var rowId = data[0];

         // If row ID is in the list of selected row IDs
         
      },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			});



   

   // Handle click on checkbox
   $('#logtable tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = $('#logtable').DataTable().row($row).data();

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
      updateDataTableSelectAllCtrl($('#logtable').DataTable());

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle click on table cells with checkboxes
   $('#logtable').on('click', 'tbody td, thead th:first-child', function(e){
      $(this).parent().find('input[type="checkbox"]').trigger('click');
   });

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', $('#logtable').DataTable().table().container()).on('click', function(e){
      if(this.checked){
         $('#proptble tbody input[type="checkbox"]:not(:checked)').trigger('click');
      } else {
         $('#proptble tbody input[type="checkbox"]:checked').trigger('click');
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle table draw event
   $('#logtable').DataTable().on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl($('#logtable').DataTable());
   });
   // Handle form submission event


		var table1 = $('#logtable').DataTable();




		table1.clear();

		var date = new Date();
		var timestamp = date.getTime();
		
		var table1 = $('#logtable').DataTable();
		$.ajax({
            url: 'addresslogtables?test=manual&ts_='+timestamp+'&account='+account,
            type: 'GET'
        }).done(function (result) {
        	if(result.recordsTotal == 0) {
        		alert('No records found');
        	}
	        table1.rows.add(result.data).draw();
        }).fail(function (jqXHR, textStatus, errorThrown) {            	 
            console.log(errorThrown);
        });
	}

	function addProperty() {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "searchpropertyaddress";
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}


		function deleteProperty(id) {

            	var type = "propertyaddressmaintenance";
				
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
				                  
				                  window.location.assign('propertyaddress');
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