<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('objection.Meeting')}}</title>
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
						<ul >
							<li><a href="#">{{__('objection.Home')}}</a></li>
							<li><a href="#">{{__('objection.Valuation_Process')}}</a></li>
							<li><a href="meeting">{{__('objection.Meeting')}}</a></li>
							<li>{{$objectiondetail}}</li>
						</ul>
					</div>
					<div style="float:right;margin-right: 0px;"  class="btn_24_blue">   
						<a href="#" onclick="deleteProperty()">{{__('objection.Generate_Report')}}</a>		
						<a href="#" onclick="newGroup()">{{__('objection.New_Agenda')}}</a>
					</div>
					<br>
				</div>	
				<div class="grid_12">
				<div class="widget_wrap tabby">
					<div class="widget_top">
						<div id="widget_tab">
							<ul>
								<li><a href="agenda?term={{$term}}&id={{$id}}" class="active_tab">{{__('objection.Agenda')}}</a></li>
								<li><a href="notice?term={{$term}}&id={{$id}}">{{__('objection.Existing_Notice')}}</a></li>
								<li><a href="objectionreport?term={{$term}}&id={{$id}}">{{__('objection.Objection')}}</a></li>
								<li><a href="decision?term={{$term}}&id={{$id}}">{{__('objection.Decision')}}</a></li>
								<li><a href="result?term={{$term}}&id={{$id}}">{{__('objection.Report')}}</a></li>
							</ul>
						</div>

						
					</div>		

				<div class="social_activities">
					<div class="comments_s">
						<div class="block_label">
							{{__('objection.Agenda_Count')}}<span>@foreach ($agendacnt as $rec)
										{{$rec->agenda_count}}									
									@endforeach	</span>
						</div>
					</div>
					<div class="comments_s">
						<div class="block_label">
							{{__('objection.Property_Count')}}<span>@foreach ($propcnt as $rec)
										{{$rec->property_count}}
									@endforeach	</span>
						</div>
					</div>
					<div class="views_s">
						<div class="block_label">
							{{__('objection.Notice_Count')}}<span>@foreach ($notiscnt as $rec)
										{{$rec->notis_count}}
									@endforeach	</span>
						</div>
					</div>
					<div class="comments_s">
						<div class="block_label">
							{{__('objection.Objection_Count')}}<span>@foreach ($objectioncnt as $rec)
										{{$rec->objection_count}}
									@endforeach	</span>
						</div>
					</div>
				</div>
								</br>		
							<table id="agendatbl" class="display ">
							<thead style="text-align: left;">
			  					<tr>
			  						<th><input name="select_all" value="1" type="checkbox"></th>
									<th class="table_sno"> {{__('objection.SNO')}}</th>
									<th> {{__('objection.Siries')}}</th>
									<th> {{__('objection.Description')}} </th>
									<th> {{__('objection.List_Year')}} </th>
									<th> {{__('objection.Property_Count')}} </th>
									<th> {{__('objection.Notice_Count')}} </th>
									<th> {{__('objection.Objection_Count')}} </th>
									<th> {{__('objection.Action')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($agenda as $rec)
								<tr>
									<td>{{$rec->ag_id}}</td>
									<td>
										{{$loop->iteration}}
									</td>
									<td>
										<a onclick="openProperty('{{$rec->ag_id}}')" href="#" title="Open Agenda Detail">{{$rec->ag_siries}}</a>
									</td>
									<td>
										{{$rec->ag_desc}} 
									</td>
									<td>
										{{$rec->ob_listyear}} 
									</td>
									<td>
										{{$rec->propcount}} 
									</td>
									<td>
										{{$rec->notice_count}} 
									</td>
									<td>
										{{$rec->object_count}} 
									</td>
									<td>
										<span><a onclick="addProperty('{{$rec->ag_id}}')" class="action-icons c-add " href="#" title="{{__('objection.New_Property')}}">{{__('objection.New_Property')}}</a></span>
										<span><a onclick="editAgenda('{{$rec->ag_id}}')" class="action-icons c-edit " href="#" title="{{__('objection.Edit_Agenda')}}">{{__('objection.Edit_Agenda')}}</a></span>
										<span><a onclick="deleteAgenda('{{$rec->ag_id}}')" class="action-icons " href="#" title="{{__('objection.Delete_Agenda')}}">{{__('objection.Delete_Agenda')}}</a></span>
									</td>
								</tr>
								<div style="display: none;">
									<input type="text" id="siries_{{$rec->ag_id}}" value="{{$rec->ag_siries}}"> 
									<input type="text" id="desc_{{$rec->ag_id}}" value="{{$rec->ag_desc}}"> 
								</div>
								@endforeach							
							</tbody>
						</table>
				
            <div><p id="info">0 {{__('objection.Row_Selected')}}</p></div>
				</div>	
		
	
				</div>
				
			</div>

			<div id="addgroup" style="display:none" class="grid_10 full_block">
				<div class="widget_wrap">
					<div class="widget_content">
						<h3 id="title">{{__('objection.Add_Agenda')}}</h3>
						<form id="addgroupfrom"  autocomplete="off" class="" method="post" action="#" >
							@csrf
							<input type="hidden" name="id" id="id" value="0">
							<input type="hidden" name="operation" id="operation" value="0">
							<input type="hidden" name="ob_id" id="operation" value="{{$id}}">
							<div  class="grid_6 form_container left_label">
								<ul>
									<li>		
									<fieldset>
										<legend>{{__('objection.Basic_Information')}}</legend>						
										<div class="form_grid_12">									
											<label class="field_title" id="termname" for="termid">{{__('objection.Siries')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="siries" required="true"  name="siries" type="text"  value="{{ old('siries') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>								
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Description')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="desc" required="true"  name="desc" type="text"  value="{{ old('desc') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>		
										</fieldset>

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
	<form style="display: hidden;" id="generateform" method="GET" action="generateAgenda">
            @csrf
            <input type="hidden" name="accounts" id="accounts">
		</form>
	<script>

		function deleteProperty(){
			var table = $('#agendatbl').DataTable();

			var account = $.map(table.rows('.selected').data(), function (item) {
	       		return item[0]
	      	});
			// console.log(table.rows('.selected').data());
			
			var type = "delete";
			
//console.log(account.toString());
			if(account.length>0){
				
			var noty_id = noty({
				layout : 'center',
				text: 'Are want to Generate Report?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Generate', click: function($noty) {
						$noty.close();
						$('#accounts').val(account.toString());
						$('#generateform').submit();
					
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
				alert('Please select one or more account to generate report');
			}
			
		}

		function deleteAgenda(id){
			var noty_id = noty({
				layout : 'center',
				text: 'Are want to Delete Agenda?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Delete', click: function($noty) {
						$noty.close();
						$("#operation").val(3);
						$("#id").val(id);						
						var groupdata = {};
			        	$('#addgroupfrom').serializeArray().map(function(x){groupdata[x.name] = x.value;});

			            var groupjson = JSON.stringify(groupdata);
			            //console.log(groupjson);
			            $.ajax({
				  				type: 'GET', 
							    url:'agendatrn',
							    headers: {
								    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
						        data:{jsondata:groupjson},
						        success:function(data){
						        	window.location.assign('agenda?term={{$term}}&id={{$id}}');										
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
	
		function openProperty(id){
			var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "objectiondetail?term={{$term}}&id="+id;
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}
		
		function addProperty(id) {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "objectionbasket?term={{$term}}&id="+id;
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
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

		function editAgenda(id){
			$("#operation").val(2);
			$("#grouptable").hide();
			$("#addgroup").show();

			$("#id").val(id);
			$("#siries").val($("#siries_"+id).val());
			$("#desc").val($("#desc_"+id).val());
			
			$("#addsubmit").html("Update");
		 	$("label.error").remove();	
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
						    url:'agendatrn',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{jsondata:groupjson},
					        success:function(data){
					        	window.location.assign('agenda?term={{$term}}&id={{$id}}')											
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
		        "dom": '<"toolbar">frtip',
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
            //
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
//$('#info').html(selectedrow() + " Row Selected");
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