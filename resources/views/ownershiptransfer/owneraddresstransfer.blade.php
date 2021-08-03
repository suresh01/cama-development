<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('ownershiptran.Ownership_Transfer_Process')}}</title>

@include('includes.header', ['page' => 'datamaintenance'])
					
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">	
					<br>
				<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
					<ul>
						<li><a href="#">{{__('ownershiptran.Home')}}</a></li>
						<li><a href="#">{{__('ownershiptran.Data_Maintenance')}}</a></li>
						<li>{{__('ownershiptran.Ownership_Transfer_Process')}}</li>
					</ul>
				</div>
				</div>
				
				
				<div style="float:right;margin-right: 10px;"  class="btn_24_blue">					
					<a href="#" onclick="addProperty()">{{__('ownershiptran.Add_Property')}}</a>
				</div>
				<div  style="float:right;margin-right: 20px;">
						
										
										
										
										
										<span class="clear"></span>
					
					
				</div>
				<br>
        
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="proptble" class="display select">
							<thead style="text-align: left;">
								<tr>
									<th class="table_sno"> {{__('ownershiptran.SNO')}}</th>
									<th>{{__('ownershiptran.No_Account')}} </th>
									<th>{{__('ownershiptran.Owner_Name')}} </th>
									<th>{{__('ownershiptran.Owner_Id_Type')}} </th>
									<th>{{__('ownershiptran.Owner_Id_No')}} </th>
									<th>{{__('ownershiptran.Address')}} </th>		
									<th>{{__('ownershiptran.Group')}} </th>		
									<th>{{__('ownershiptran.Transfer_Type')}} </th>	
									<th>{{__('ownershiptran.Register_By')}} / {{__('ownershiptran.Register_Date')}} </th>	
									<th>{{__('ownershiptran.Register_Status')}} </th>	
									<th>{{__('ownershiptran.Action')}} </th>			
								</tr>
							</thead>
							<tbody>		
									@foreach ($ownertransfer as $rec)
									<tr>
										<td>
											{{$loop->iteration}}
										</td>
										<td>
											<a class='shobldg' onclick="edit('{{$rec->otar_id}}')" href='#' >{{$rec->otar_accno}}</a>
										</td>
										<td>
											{{$rec->TO_OWNNAME}}
										</td>
										<td>
											{{$rec->owntype}}
										</td>
										<td>
											{{$rec->TO_OWNNO}}
										</td>
										<td>
											{{$rec->TO_ADDR_LN1}}
										</td>
										<td>
											{{$rec->colgroup}}
										</td>
										<td>
											{{$rec->transtype}}
										</td>
										<td>
											{{$rec->otar_createby}} / {{$rec->otar_createdate1}}
										</td>
										<td>
											{{$rec->colstatus}}
										</td>
										<td>
											<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -362px -62px !important;display: inline-block; float: left;" onclick="submitForm('{{$rec->ma_accno}}')"  title="View Log" href="#"></a></span>&nbsp;&nbsp;

											
											@if($rec->otar_ownertransstatus_id == '2')
												<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('{{$rec->otar_id}}',2)"  title="Submit To Approve" href="#"></a></span>
												<span><a class="action-icons c-Delete delete_tenant" onclick="deleteT('{$rec->otar_accno}}','{{$rec->otar_ownertransgroup_id}}')" href='#' title="{{__('common.Delete')}}">{{__('common.Delete')}}</a></span>
											@endif

											@if($rec->otar_ownertransstatus_id == '5')
												<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -822px -42px !important;display: inline-block; float: left;" onclick="approve('{{$rec->otar_id}}',5)" title="Transfer" href="#"></a></span>
											@endif
										</td>
									</tr>
									@endforeach	
								
							</tbody>
						</table>


								<div class="grid_12 invoice_details">
									<div style="display: none;" id="searchLoader">
										<!--<img src="images/ajax-loader/ajax-loader(8).gif" alt="Loader">-->
									</div>
									<div class="widget_wrap collapsible_widget">
										<div class="widget_top active">
											<span class="h_icon"></span>
											<h6>{{__('ownershiptran.Log_Information')}}</h6>
										</div>
										<div class="widget_content">
											<div class="invoice_tbl">
												<table id="logtable">
												<thead>
												<tr class=" gray_sai">
													<th></th>
													<th>{{__('ownershiptran.Application_ID')}} </th>	
													<th>{{__('ownershiptran.Application_Type')}} </th>	
													<th>{{__('ownershiptran.Application_Status')}} </th>	
													<th>{{__('ownershiptran.Register_Date')}} </th>	
													<th>{{__('ownershiptran.Update_Date')}} </th>	
													<th>{{__('ownershiptran.Owner_Name')}} </th>	
													<th>{{__('ownershiptran.Owner_Type_ID')}} </th>	
													<th>{{__('ownershiptran.Owner_ID_No')}} </th>	
													<th>{{__('ownershiptran.Address')}} </th>	
													<th>{{__('ownershiptran.Owner_Race')}} </th>	
													<!--<th>
														Action
													</th>-->
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
		</div>
		
	<span class="clear"></span>
	
	<script>
		function getdata(){
			var zone = $('#filterzone').val();
			//alert();
			window.location.assign('ownertransfer?page=2&param='+zone);
			//return;
		}

		function addProperty() {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "searchpropertyaddress?page=ownaddress";
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}

		function edit(acc) {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "ownertransferprocess?account="+acc+"&page=2";
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}

		function approve(id,currstatus){
			if(currstatus == 5){
				var noty_id = noty({
					layout : 'center',
					text: 'Are you sure want to Transfer?',
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
						        data:{param_value:id,module:'ownershiptrans',param:currstatus},
						        success:function(data){

									window.location.assign("ownertransfer?page=2");									
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
						        data:{param_value:id,module:'ownershiptrans',param:currstatus},
						        success:function(data){
									window.location.assign("ownertransfer?page=2");									
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

		function deleteT(acc, groupid) {		
		    var noty_id = noty({
				layout : 'center',
				text: 'Do you want Delete?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Delete', click: function($noty) {
			  
						// this = button element
						// $noty = $noty element
			  			
			            //$('#jsondata').val(tenantjson);
			            //console.log(tenantjson);
			           // window.location.assign('tenanttrn?account='+acc+'&groupid='+groupid);
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

		function register(){
			$('#register-modal-content').modal();
		}
		
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

$(document).ready(function (){

	$('#filterzone').val('{{$param}}');
	waitingIndicator('searchLoader');
	var table = $('#proptble').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				 
		        // ajax: '{{ url("inspectionproperty") }}',
		        /*"ajax": '/bookings/datatables',*/
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




	function submitForm(account){
		//console.log($("#filterForm").serialize());


	$('#searchLoader').attr('style','display:block');
	var logtable = $('#logtable').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				 
		      //   ajax: '{{ url("inspectionproperty") }}',
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
			        {"data": "ota_id", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": "ota_id", "name": "sno"},
			        {"data": "ttype", "name": "account number"},
			        {"data": "ownstatus", "name": "account number"},
			        {"data": "otar_createdate", "name": "fileno"},
			        {"data": "otar_updatedate", "name": "zone"},
			        {"data": "ota_ownname", "name": "ishasbldg"},
			        {"data": "owntype", "name": "owntype"}, 
			        {"data": "ota_ownno", "name": "TO_OWNNAME"}, 
			        {"data": "ota_addr_ln1", "name": "bldgcount"},
			        {"data": "ownrace", "name": "ownrace"}/*,
			        {"data": function(data){
			        	//console.log("LOG :    "+data.ota_transferapplntypestatus_id);
			        	if(data.ota_transtocenterstatus_id == 4){

			        		return "<a href=#' onclick='retry("+data.ota_id+")'>Retry</a>";
			        	} else {
			        		return "";
			        	}
			        	
			        
			        }, "name": "ownrace"}*/
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
            url: 'ownertransferdetail?test=manual&ts_='+timestamp+'&account='+account,
            type: 'GET'
        }).done(function (result) {
        	if(result.recordsTotal == 0) {
        		$('#searchLoader').attr('style','display:none');
        		alert('No records found');

        	}
	        table1.rows.add(result.data).draw();

	        //$('#searchLoader').attr('style','display:none');

        }).fail(function (jqXHR, textStatus, errorThrown) {            	 
            console.log(errorThrown);
        });
	}

	function retry(id){
		var noty_id = noty({
				layout : 'center',
				text: 'Are want to transfer again?',
				modal : true,
				buttons: [
					{type: 'button blue', text: 'Submit', click: function($noty) {
			  
						$noty.close();

			        	var noty_id = noty({
							layout : 'top',
							text: ' Transferred successfully!',
							modal : true,
							type : 'success', 
						});			

					}},
					{type: 'button pink', text: 'Cancel', click: function($noty) {
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