<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('group.Deactivate_Delete_Property')}}</title>
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
						<li><a href="#">{{__('group.Home')}} </a></li>
						<li><a href="deactive?param={{$param}}">{{__('group.Valuation_Process')}} </a></li>
						<li>{{__('group.Deactivate_Property')}}</li>
					</ul>
				</div>
				</div>
				
				<div style="float:right;margin-right: 10px;"  class="btn_24_blue">
						
					<a href="#" onclick="addExisitingProperty()">{{__('group.Add_Property')}}</a>

					 @include('objection.search.newsearch',['tableid'=>'proptble', 'action' => 'deletepropertytables', 'searchid' => '32'])
					
				</div>
				<br>

				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="proptble" class="display select ">

							<div class="social_activities">
								<div class="comments_s">
									<div class="block_label">
										{{__('group.Property_Count')}}<span id="prop_count">0</span>
									</div>
								</div>

								<div style="width: 520px;" class="comments_s">
									<div style="width: 520px;" class="block_label">
										{{__('group.Basket')}}<span>{{$viewparambasket}} </span>
									</div>
								</div>
								

							</div>	

							

							<br>
							<thead style="text-align: left;">
								<tr>
									<th><input name="select_all" value="1" type="checkbox"></th>
									<th class="table_sno">
										{{__('group.SNo')}} 
									</th>
									<th>
										{{__('group.Account_Number')}}
									</th>
									<th>
										{{__('group.File_Number')}}
									</th>
									<th>
										{{__('group.Zone')}} 
									</th>
									<th>
										{{__('group.Status_Harta')}}
									</th>	
									<th>
										{{__('group.Property')}} 
									</th>		
									<!--<th>
										OWNER NAME
									</th>	
										
									<th>
										OWNER TYPE / OWNER NUMBER
									</th>-->	
									<th>
										{{__('group.NT')}}
									</th>		
									<th>
										{{__('group.Rate')}} 
									</th>	
									<th>
										{{__('group.Tax_Rate')}}
									</th>	
									<th>
										{{__('group.Reason')}} 
									</th>
									<th>
										{{__('group.Description')}}
									</th>	
									<th>
										{{__('group.Action')}} 
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
				
		<div id="addgroup" style="display:none" class="grid_10 full_block">
				<div class="widget_wrap">
					<div class="widget_content">
						<h3 id="title">{{__('group.Edit_Detail')}}</h3>
						<form id="addgroupfrom"  autocomplete="off" class="" method="post" action="#" >
							@csrf
							<input type="hidden" name="id" id="id" value="0">
							<input type="hidden" name="operation" id="operation" value="0">
							<div  class="grid_12 form_container left_label">
								<ul>
									<li>								
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
											<span class=" label_intro"></span>
										</div>										
									</li>
								</ul>
							</div>
							
							<div style="height: 48px; float: none; display: -webkit-box;text-align: -webkit-center;" class="grid_12">
								
								<div class="form_input">
									<button id="addsubmit" name="adduser" type="submit" onclick="validateGroup()" class="btn_small btn_blue"><span>{{__('common.Submit')}}</span></button>			
														
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
	
	<script>

		function validateGroup(){

			$('#addgroupfrom').validate({
		        rules: {
		            'termid': 'required',
		            'name': 'required'
		        },
		        messages: {
					"term": "Please select term name",
					"name": "Please enter basket name"
		        },
		        submitHandler: function(form) {
					var reason = $('#termid').val();
	                var desc = $('#desc').val();

	                var table = $('#proptble').DataTable();
	                console.log(table.rows('.selected').data());
	                var account = $.map(table.rows('.selected').data(), function (item) {
	                   return item['dad_id']
	                });
	                if(account.length>0){
				
			   			account=account.toString();
			   		}
	                  console.log(account);
	                  var id="{{$id}}";
	                  var type = "editdeactivateproperty";

	                  $.ajax({
	                      type:'GET',
	                      url:'grapnewdata',
	                      data:{accounts:account,id:id,type:type,reason:reason,desc:desc},
	                      success:function(data){           
	                        
	                        alert(" Property Updated");
	                      
	                      }
	                });   	        	
		        }
		    });

                     
            
			}


		function newGroup(id){
			//$("#operation").val(1);
			$("#usertable").hide();
			$("#addgroup").show();
			$("#addsubmit").html("Save");
		 	$("label.error").remove();	
		}

		function closeGroup(){
			//$('#addsubmit').removeAttr('disabled');
			
			$("#usertable").show();
			$("#addgroup").hide();
		 	$('#err_lbl').html('');
		 	$("label.error").remove();
		}


		function regirect(){
			var url = $('#stage').val();
			var basket = $('#basket').val();
			var property = $('#property').val();
			//alwet(basket+" "+property)
			if (property != "0") {
				window.location.assign(url+"?prop_id="+property+"&pb="+basket);
			}
			
		}

		function stageOption(property, Basket){
			$('#basket').val(Basket);
			$('#property').val(property);
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
		        w.location = "adddeactiveproperty?type=2&id={{$id}}&aptype={{$applicationtype}}";
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}

		

		function deleteProperty(vdad_id){
			var table = $('#proptble').DataTable();
			var account = $.map(table.rows('.selected').data(), function (item) {
	        	return item['dad_id']
	   		});
			var type = "deletedeactivateproperty";
			var id="{{$id}}";
	                if(account.length==0){
				account=vdad_id;
	   		} else {
	   			account=account.toString();
	   		}
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

	
var table = $('#proptble').DataTable({
		        "processing": false,
		        "serverSide": false,
		        /*"dom": '<"toolbar">frtip',*/
		        "ajax": {
		            "type": "GET",
		            "url": 'deletepropertytables?id={{$id}}',
		            "contentType": 'application/json; charset=utf-8',
				    "headers": {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		        },
								 	
		       // ajax: '{{ url("inspectionproperty") }}',
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
			        {"data": "dad_id", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": null, "name": "sno"},
			        {"data": "ma_accno", "name": "account number"},
			        {"data": "ma_fileno", "name": "zone"},
			        {"data": "zone", "name": "subzone"},
			        {"data": "isbldg", "name": "address"},
			        {"data": function(data){
			            return data.bldgcategory+" || "+data.bldgtype+" || "+data.bldgsotery;
			        }, "name": "owner"}, 
			        {"data": "vt_approvednt", "name": "owner"}, 
			        {"data": "vt_proposedrate", "name": "ishasbldg"}, 
			        {"data": "vt_approvedtax", "name": "ishasbldg"}, 
			        {"data": "reason", "name": "ishasbldg"}, 
			        {"data": "dad_desc", "name": "ishasbldg"},
			        {"data":  function(data){
			        	if(data.da_approved=='01'){
			        		var deleteuri = '&nbsp;&nbsp;&nbsp;<span><a class="action-icons  "  onclick="deleteProperty('+data.dad_id+')" disabled="true" title="Delete Property" href="#"></a></span>';
			        	} else {
			        		var deleteuri = '';
			        	}
			        	
						return '<spane><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -822px -121px !important;display: inline-block; float: left;" onclick="newGroup('+data.dad_id+')" disabled="true" title="Edit Basket" href="#"></a></span>' +deleteuri;

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



   // Handle form submission event

});


function reviseProperty(id){
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
				        data:{param_value:id,module:'REVINS'},
				        success:function(data){		
							
							window.location.assign('property?id={{$id}}');		        		
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
				        data:{param_value:id,module:'APINS'},
				        success:function(data){		
							
							window.location.assign('property?id={{$id}}');		        		
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
				        data:{param_value:id,module:'APVAL'},
				        success:function(data){		
							
							window.location.assign('property?id={{$id}}');		        		
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
				        data:{param_value:$('#val_id').val(),module:'REVVAL',param:$('#revisestage').val()},
				        success:function(data){		
							
							window.location.assign('property?id={{$id}}');		        		
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