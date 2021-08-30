<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('objection.Result')}} </title>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
			<div id="grouptable" class="grid_12">
				<br>
				<div class="form_input">
					<div id="breadCrumb3"  class="breadCrumb grid_4">
						<ul>
							<li><a href="#">{{__('objection.Home')}} </a></li>
							<li><a href="#">{{__('objection.Valuation_Process')}} </a></li>
							<li><a href="meeting">{{__('objection.Meeting')}} </a></li>
							<li>{{$objectiondetail}}</li>
						</ul>
					</div>
					<div style="float:right;margin-right: 0px;"  class="btn_24_blue">   
						<a href="#" onclick="deleteProperty()">{{__('objection.Decision_Report')}} </a>		 
						<a href="#" onclick="valuationDetail()">{{__('objection.R5_Report')}} </a>		
						<!--<a href="#" onclick="addProperty()">Add Objection Property</a>-->
					</div>
					<br>
				</div>	
				<div class="grid_12">
				<div class="widget_wrap tabby">
					<div class="widget_top">
						<div id="widget_tab">
							<ul>
								<li><a href="agenda?term={{$term}}&id={{$id}}" >{{__('objection.Agenda')}} </a></li>
								<li><a href="notice?term={{$term}}&id={{$id}}">{{__('objection.Existing_Notice')}} </a></li>
								<li><a href="objectionreport?term={{$term}}&id={{$id}}" >{{__('objection.Objection')}} </a></li>
								<li><a href="decision?term={{$term}}&id={{$id}}">{{__('objection.Decision')}} </a></li>
								<li><a href="result?term={{$term}}&id={{$id}}"  class="active_tab">{{__('objection.Report')}} </a></li>
							</ul>
						</div>
					</div>

					
							<div class="social_activities">
					<div class="comments_s">
						<div class="block_label">
							{{__('objection.Agenda_Count')}} <span>@foreach ($agendacnt as $rec)
										{{$rec->agenda_count}}									
									@endforeach	</span>
						</div>
					</div>
					<div class="comments_s">
						<div class="block_label">
							{{__('objection.Property_Count')}} <span>@foreach ($propcnt as $rec)
										{{$rec->property_count}}
									@endforeach	</span>
						</div>
					</div>
					<div class="views_s">
						<div class="block_label">
							{{__('objection.Notice_Count')}} <span>@foreach ($notiscnt as $rec)
										{{$rec->notis_count}}
									@endforeach	</span>
						</div>
					</div>
					<div class="comments_s">
						<div class="block_label">
							{{__('objection.Objection_Count')}} <span>@foreach ($objectioncnt as $rec)
										{{$rec->objection_count}}
									@endforeach	</span>
						</div>
					</div>
				</div>
								<br>	
							<table id="agendatbl" class="display ">
							<thead style="text-align: left;">
			  					<tr>
			  						<th><input name="select_all" value="1" type="checkbox"></th>
									<th class="table_sno"> {{__('objection.SNO')}} </th>
									<th style="display: none;">
										id
									</th>
									<th style="display: none;">
										vdid
									</th>
									<th> {{__('objection.Account_number')}} </th>
									<th> {{__('objection.Basket_Name')}} </th>
									<th> {{__('objection.Proposed_NT')}} </th>
									<th> {{__('objection.Proposed_Rate')}} </th>
									<th> {{__('objection.Proposed_Tax')}} </th>
									<th> {{__('objection.Valuer_Recommend')}}  </th>
									<th> {{__('objection.Approved_NT')}}  </th>
									<th> {{__('objection.Approved_Tax')}} </th>
									<th> {{__('objection.Status')}} </th>
									<th> {{__('objection.Action')}} </th>
								</tr>
							</thead>
							<tbody>
								@foreach ($objectionlist as $rec)
								<tr>
									<td>{{$rec->de_vd_id}}</td>
									<td>
										{{$loop->iteration}}
									</td>
									<td style="display: none;">
										{{$rec->de_id}}
									</td>
									<td style="display: none;">
										{{$rec->de_vd_id}}
									</td>
									<td>
										{{$rec->de_accno}}
									</td>
									<td>
										{{$rec->va_name}} 
									</td>
									<td>
										{{$rec->vt_proposednt}}
									</td>
									<td>
										{{$rec->vt_proposedrate}} 
									</td>
									<td>
										{{$rec->vt_proposedtax}} 
									</td>
									<td>
										{{$rec->ol_valuerrecommend}}
									</td>
									<td>
										{{$rec->vt_approvednt}}
									</td>
									<td>
										{{$rec->vt_approvedtax}} 
									</td>
									<td>
										{{$rec->propertstatus}} 
									</td>
									<td>
										@if($rec->vd_approvalstatus_id == '11')
										<span><a onclick="approveProperty('{{$rec->de_vd_id}}')" class="action-icons c-approve  edtlotrow" href="#" title="Approve Decision">New Agenda</a></span>
										@endif
									</td>
								</tr>
								<div style="display: none;">
									
								</div>
								@endforeach							
							</tbody>
						</table>
				
            <div><p id="info">0 {{__('objection.Row_Selected')}}</p></div>		
				</div>	
			</div>
				
			</div>

			
			
		</div>
	<span class="clear"></span>
	<!--<form style="display: hidden;" id="generateform" method="GET" action="generateResult">
            @csrf
            <input type="hidden" name="accounts" id="accounts">
		</form>-->

		<div id="addDetail" style="display:none" class="grid_12">
					<div class="widget_wrap">
						
						<div class="widget_content">
							<h3 id="title">{{__('objection.Generate_Report')}}</h3>
							<form style="" id="generateform" method="GET" action="generateResult">
					            @csrf
					            <input type="hidden" name="accounts" id="accounts">
								<div  class="grid_12 form_container left_label">
									<ul>
										<li>											
											<fieldset>
												<legend>{{__('objection.Additional_Information')}}</legend>												
											
												<div class="form_grid_12">
													<label class="field_title" id="lposition" for="position">{{__('objection.Officer_Incharge')}}<span class="req">*</span></label>
													<div  class="form_input">
														<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="user" tabindex="7" name="user" tabindex="20">
																<option></option>
															@foreach ($userlist as $rec)
																	<option value='{{ $rec->tbuser }}'>{{ $rec->tbuser }}</option>
															@endforeach	
														</select>
													</div>
													<span class=" label_intro"></span>
												</div>
											
											</fieldset>

					
										</li>
									</ul>
								</div>
								
								<div class="grid_12">							
									<div class="form_input">
										<button id="addsubmit" name="adduser" class="btn_small btn_blue"><span>{{__('common.Submit')}} </span></button>									
										
										<button id="close" name="close" type="button" class="btn_small btn_blue simplemodal-close"><span>{{__('common.Close')}} </span></button>
										<span class=" label_intro"></span>
									</div>								
									<span class="clear"></span>
								</div>
							</form>
						</div>
					</div>
				</div>

<div id="valuationDetail" style="display:none" class="grid_12">
					<div class="widget_wrap">
						
						<div class="widget_content">
							<h3 id="title">{{__('objection.Generate_Report')}} </h3>
							<form style="" id="generateValform" method="GET" action="generatevaluation">
					            @csrf
					            <input type="hidden" name="accounts" id="accounts1">
								<div  class="grid_12 form_container left_label">
									<ul>
										<li>
											
											<fieldset>
												<legend>{{__('objection.Additional_Information')}} </legend>
												
												<div class="form_grid_12">
													<label class="field_title" id="lposition" for="position">{{__('objection.Valuer_Name')}} <span class="req">*</span></label>
													<div  class="form_input">
														<select onchange="getposition()" data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="tittle" tabindex="7" name="tittle1" tabindex="20">
																<option></option>
															@foreach ($userlist as $rec)
																	<option value='{{ $rec->usr_id }}'>{{ $rec->tbuser }}</option>
															@endforeach	
														</select>
													</div>
													<span class=" label_intro"></span>
													<input type="hidden" id="username" name="tittle">
												</div>
												
												<div class="form_grid_12">
													<label class="field_title" id="llevel" for="level">{{__('objection.Valuer_Tittle')}} <span class="req">*</span></label>
													<div  class="form_input">
														<input id="name" name="name"   type="text"  maxlength="50" class="required"/>
													</div>
													<span class=" label_intro"></span>
												</div>
											
											</fieldset>

					
										</li>
									</ul>
								</div>
								
								<div class="grid_12">							
									<div class="form_input">
										<button id="addsubmit" name="adduser" class="btn_small btn_blue"><span>{{__('common.Submit')}}</span></button>									
										
										<button id="close" name="close" type="button" class="btn_small btn_blue simplemodal-close"><span>{{__('common.Close')}}</span></button>
										<span class=" label_intro"></span>
									</div>								
									<span class="clear"></span>
								</div>
							</form>
						</div>
					</div>
				</div>
	<script>
		
		function addProperty() {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "objectionreportsearch?term={{$term}}&id={{$id}}";
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}
		function getposition(){
			var userid = $('#tittle').val();
			$('#username').val($("#tittle option:selected").text());
			$.ajax({
		        type:'GET',
		        url:'/getuserdetail',
		        data:{id:userid},
		        success:function(data){	        	
		        	console.log(data);
		        	$('#name').val(data.userposition);
		        }
		    });
		}
		function newGroup(){
			$("#operation").val(1);
			$("#grouptable").hide();
			$("#addgroup").show();

			$("#siries").val('');
			$("#desc").val('');
			$("#addsubmit").html("Save");
		 	$("label.error").remove();	
		}

		function updateMeeting(id){


			$("#operation").val(2);
			$("#grouptable").hide();
			$("#addgroup").show();

			$("#id").val(id);
			$("#time").val($("#time_"+id).val());
			$("#reason").val($("#reason_"+id).val());
			$("#valuerrec").val($("#recommend_"+id).val());
			
			$("#addsubmit").html("Update");
		 	$("label.error").remove();	
		}

		function deleteProperty(){
			var table = $('#agendatbl').DataTable();
//console.log(table.rows('.selected').data());
			var account = $.map(table.rows('.selected').data(), function (item) {
				//console.log(item);
	        	return item[0]
	   		});
			var type = "delete";
			$('#accounts').val(account.toString());
			$('#addDetail').modal();
			console.log(account.toString());

			
			
		}

		function valuationDetail(){
			var table = $('#agendatbl').DataTable();
//console.log(table.rows('.selected').data());
			var account = $.map(table.rows('.selected').data(), function (item) {
				//console.log(item);
	        	return item[0]
	   		});
			var type = "delete";
			$('#accounts1').val(account.toString());
			$('#valuationDetail').modal();
			console.log(account.toString());

			
			
		}

		function approveProperty(id){
			var noty_id = noty({
				layout : 'center',
				text: 'Are want to approve properties?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Approved', click: function($noty) {
						$noty.close();
						$.ajax({
			  				type: 'GET', 
						    url:'decisionapprove',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{id:id,module:'objection'},
					        success:function(data){
					        	//var count = data.propertycnt;
					        	
						        	var noty_id = noty({
										layout : 'top',
										text: 'Objection Approved!',
										modal : true,
										type : 'success', 
									});	
									window.location.assign("result?term={{$term}}&id={{$id}}");	
									        		
					        	//$("#finish").attr("disabled", true);
					        	//clearTableError(4);
				        	},
					        error:function(data){
								//$('#loader').css('display','none');	
					        	$('#finishloader').html('');     	
					        		var noty_id = noty({
									layout : 'top',
									text: 'Problem while approve property!',
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

		function deleteMeeting(id){
			
			var noty_id = noty({
					layout : 'center',
					text: 'Are you want to delete?',
					modal : true,
					buttons: [
						{type: 'button pink', text: 'Delete', click: function($noty) {
					  			$("#operation").val(3);
					  			$("#id").val(id);
					  			
								$("#termid").val($("#termid_"+id).val());
					  			var groupdata = {};
		        				$('#addgroupfrom').serializeArray().map(function(x){groupdata[x.name] = x.value;});

		            			var groupjson = JSON.stringify(groupdata);
		           				window.location.assign('meetingtrn?jsondata='+groupjson)	
								$noty.close();
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

		function closeGroup(){
			//$('#addsubmit').removeAttr('disabled');
			$("#operation").val(1);
			$("#termid").val('');
			$("#name").val('');
			$("#grouptable").show();
			$("#addgroup").hide();
		 	$('#err_lbl').html('');
		 	$("label.error").remove();
		}

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
					var d=new Date();		        	
					var operation = $('#operation').val();
					var page = "ratepayer";
					var groupdata = {};
		        	$('#addgroupfrom').serializeArray().map(function(x){groupdata[x.name] = x.value;});

		            var groupjson = JSON.stringify(groupdata);
		            //console.log(groupjson);
		            $.ajax({
			  				type: 'GET', 
						    url:'objectionreportrn',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{jsondata:groupjson},
					        success:function(data){
					        	window.location.assign('objectionreport?term={{$term}}&id={{$id}}')											
				        	}
				    	});
		                  	
		        }
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
  var table = $('#agendatbl').DataTable();
  var count = 0;
  $.map(table.rows('.selected').data(), function (item) {
       count++;
    });
  return count;
}

$(document).ready(function (){
	var table = $('#agendatbl').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				 
		        
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  	
			        $("td:nth-child(2)", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
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
   $('#agendatbl tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = $('#agendatbl').DataTable().row($row).data();

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
      updateDataTableSelectAllCtrl($('#agendatbl').DataTable());

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

  

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', $('#agendatbl').DataTable().table().container()).on('click', function(e){
      if(this.checked){
        $('#agendatbl tbody input[type="checkbox"]').prop('checked', true);
         $('#agendatbl tbody tr').addClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      } else {
         $('#agendatbl tbody input[type="checkbox"]').prop('checked', false);
         $('#agendatbl tbody tr').removeClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle table draw event
   $('#agendatbl').DataTable().on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl($('#agendatbl').DataTable());
   });
   // Handle form submission event

});

function generateRepro(){
		var table = $('#agendatbl').DataTable();
	var account = $.map(table.rows('.selected').data(), function (item) {
				//console.log(item);
	        	return item['id']
	   		});
}

		
	</script>

</div>
</body>
</html>