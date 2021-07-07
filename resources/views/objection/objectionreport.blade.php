<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('objection.Objection_List')}}</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<style type="text/css">

.numericCol {
	text-align: right;
}
</style>
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
							<li><a href="#">{{__('objection.Home')}}</a></li>
							<li><a href="#">{{__('objection.Valuation_Process')}}</a></li>
							<li><a href="meeting">{{__('objection.Meeting')}}</a></li>
							<li>{{$objectiondetail}}</li>
						</ul>
					</div>
					<div style="float:right;margin-right: 0px;"  class="btn_24_blue">   
						<!--<a href="#" onclick="deleteProperty()">Generate Report</a>		-->
						<a href="#" onclick="updateReason()" title="Set time, reason and recommendation valued" >{{__('common.Update')}}</a>	

						<a href="#" onclick="deleteProperty2()" >{{__('objection.Objection_List')}}</a>	
						<a href="#" onclick="deleteProperty()" >{{__('objection.Invitation_Letter')}}</a>	
						<a href="#" onclick="addProperty()" title="Add New Property">{{__('objection.Add_Property')}} </a>
					</div>
					<div style="float:right;margin-right: 20px;"  class="btn_24_orange">   
			            <!--<a href="#" id="" onclick="getSelectedProp()" class=""><span>Add Basket </span></a>  -->
			          	<a href="#" id="" onclick="deleteObjection()" title="Delete Selected"><span>{{__('common.Delete')}} </span></a> 
		        	</div>

		        	 <div style="float:right;margin-right: 10px;"  class="btn_24_blue">   
			          @include('objection.search.newsearch',['tableid'=>'baskettbl', 'action' => 'objectionbaskettable?', 'searchid' => '35'])
			           
			        </div>

					<br>
				</div>	
				<div class="grid_12">
				<div class="widget_wrap tabby">
					<div class="widget_top">
						<div id="widget_tab">
							<ul>
								<li><a href="agenda?term={{$term}}&id={{$id}}" >{{__('objection.Agenda')}}</a></li>
								<li><a href="notice?term={{$term}}&id={{$id}}">{{__('objection.Existing_Notice')}}</a></li>
								<li><a href="objectionreport?term={{$term}}&id={{$id}}" class="active_tab">{{__('objection.Objection')}}</a></li>
								<li><a href="decision?term={{$term}}&id={{$id}}">{{__('objection.Decision')}}</a></li>
								<li><a href="result?term={{$term}}&id={{$id}}">{{__('objection.Report')}}</a></li>
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
								</br>	
							
							<table id="agendatbl" class="display ">
							<thead style="text-align: left;">
			  					<tr>
			  						<th><input name="select_all" value="1" type="checkbox"></th>
									<th class="table_sno"> {{__('objection.SNO')}} </th>
									<th> {{__('objection.Account_number')}}  </th>
									<th> {{__('objection.Time')}}   </th>
									<th> {{__('objection.Reason')}}   </th>
									<th> {{__('objection.Zone')}}   </th>
									<th> {{__('objection.Sub_Zone')}}   </th>
									<th> {{__('objection.Proposed_NT')}}   </th>
									<th> {{__('objection.Proposed_Rate')}}   </th>
									<th> {{__('objection.Proposed_Tax')}}   </th>
									<th> {{__('objection.Valuer_Recommend')}}   </th>
									<th style="display: none;">
										Difference
									</th>
									<th style="display: none;">
										Percentage
									</th>
									<th style="display: none;">
										ID
									</th>
									<th> {{__('objection.Action')}}  </th>
								</tr>
							</thead>
							<tbody>
								

							</tbody>
						</table>
            		<div><p id="info">0 {{__('objection.Row_Selected')}} </p></div>		
				</div>	
			</div>
			@foreach ($objectionlist as $rec)
				<div style="display: none;">
					<input type="text" id="time_{{$rec->ol_id}}" value="{{$rec->ol_time}}">
					<input type="text" id="reason_{{$rec->ol_id}}" value="{{$rec->ol_reason}}">
					<input type="text" id="recommend_{{$rec->ol_id}}" value="{{$rec->ol_valuerrecommend}}">
					<input type="text" id="zone_{{$rec->ol_id}}" value="{{$rec->zone}}">
					<input type="text" id="subzone_{{$rec->ol_id}}" value="{{$rec->subzone}}">
					<input type="text" id="approvednt_{{$rec->ol_id}}" value="{{$rec->vt_approvednt}}">
					<input type="text" id="approrvedtax_{{$rec->ol_id}}" value="{{$rec->vt_approvedtax}}">
				</div>
			@endforeach	

				
			</div>

			<div id="addgroup" style="display:none" class="grid_10 full_block">
				<div class="widget_wrap">
					<div class="widget_content">
						<h3 id="title">{{__('objection.Objection')}}</h3>
						<form id="addgroupfrom"  autocomplete="off" class="" method="post" action="#" >
							@csrf
							<input type="hidden" name="id" id="id" value="0">
							<input type="hidden" name="operation" id="operation" value="0">
							<input type="hidden" name="ob_id" id="ob_id" value="{{$id}}">
							<input type="hidden" name="ol_id" id="ol_id" value="0">
							<div id="valpart" class="grid_6 form_container left_label">
								<ul>
									<li>		
									<fieldset>
										<legend>{{__('objection.Information')}}</legend>						
										<div class="form_grid_12">									
											<label class="field_title" id="termname" for="termid">{{__('objection.Zone')}} <span class="req">*</span></label>
											<div class="form_input">
												<input id="vzone" readonly="true" name="" type="text"  value="{{ old('siries') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>								
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Sub_Zone')}} <span class="req">*</span></label>
											<div class="form_input">
												<input id="vsubzone"  readonly="true" name="" type="text"  value="{{ old('desc') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>								
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Approved_NT')}} <span class="req">*</span></label>
											<div class="form_input">
												<input id="vaprovednt"  readonly="true" name="" type="text"  value="{{ old('desc') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>								
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Approved_Tax')}} <span class="req">*</span></label>
											<div class="form_input">
												<input id="vaprovedtax"  readonly="true" name="" type="text"  value="{{ old('desc') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>	
										</fieldset>

									</li>
								</ul>
							</div>

							<!--<input type="hidden" name="ol_id" id="ol_id" value="0">-->
							<div  class="grid_6 form_container left_label">
								<ul>
									<li>		
									<fieldset>
										<legend>{{__('objection.Basic_Information')}} </legend>						
										<div class="form_grid_12">									
											<label class="field_title" id="termname" for="termid">{{__('objection.Time')}} <span class="req">*</span></label>
											<div class="form_input">
												<input id="time" required="true"  name="time" type="text"  value="{{ old('siries') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>								
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Reason')}} <span class="req">*</span></label>
											<div class="form_input">
												<input id="reason" required="true"  name="reason" type="text"  value="{{ old('desc') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>								
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Valuer_Recommend')}} <span class="req">*</span></label>
											<div class="form_input">
												<input id="valuerrec" required="true"  name="valuerrec" type="text"  value="{{ old('desc') }}" />
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

		<!--<form style="display: hidden;" id="generateform" method="GET" action="generateobjection1">
            @csrf 
            <input type="hidden" name="accounts" id="accounts">
		</form>-->

		<form style="display: hidden;" id="generateform2" method="GET" action="generateobjection2">
            @csrf
            <input type="hidden" name="accounts" id="accounts2">
		</form>

		<div id="addDetail" style="display:none" class="grid_12">
					<div class="widget_wrap">
						
						<div class="widget_content">
							<h3 id="title">{{__('objection.Generate_Report')}}</h3>
							<form style="" id="generateform" method="GET" action="generateobjection1">
					            @csrf
					            <input type="hidden" name="accounts" id="accounts">
								<div  class="grid_12 form_container left_label">
									<ul>
										<li>											
											<fieldset>
												<legend>{{__('objection.Additional_Information')}} </legend>
												
												<div class="form_grid_12">
													<label class="field_title" id="lposition" for="position">{{__('objection.Meeting_Room')}} <span class="req">*</span></label>
													<div  class="form_input">
														<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="meetingroom" tabindex="7" name="meetingroom" tabindex="20">
																<option></option>
															@foreach ($meetingroom as $rec)
																	<option value='{{ $rec->tdi_value }}'>{{ $rec->tdi_value }}</option>
															@endforeach	
														</select>
													</div>
													<span class=" label_intro"></span>
												</div>
												
												<div class="form_grid_12">
													<label class="field_title" id="lposition" for="position">{{__('objection.Officer_Incharge')}} <span class="req">*</span></label>
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
	<span class="clear"></span>


		
		

	<script>


		 function submitForm(){
		    //console.log($("#filterForm").serialize());


		    var table = $('#agendatbl').DataTable();
		    table.clear();

		    var date = new Date();
		    var timestamp = date.getTime();
		    
		    var table = $('#agendatbl').DataTable();

		    $('#searchLoader').attr('style','display:block');

		    xhr = $.ajax({
		            url: 'objectionreporttable?id={{$id}}&test=manual&ts_='+timestamp,
		            type: 'GET',
		            data: $("#filterForm").serialize()
		        }).done(function (result) {
		          if(result.recordsTotal == 0) {
		            alert('No records found');
		          }
		          $('#searchLoader').attr('style','display:none');
		          table.rows.add(result.data).draw();
		      /*var count = table.rows().count();
		      
		      $('#prop_count').html(count);
		      if (count < totalcount ){
		        $('#prop_count').html(count+" ( filtered from total "+totalcount+") ");
		      }*/
		      
		      //alert();
		         // $('#searchLoader').hide();
		    
		        }).fail(function (jqXHR, textStatus, errorThrown) {              
		            console.log(errorThrown);        
		            alert(errorThrown);
		      $('#searchLoader').attr('style','display:none');
		           // $('#searchLoader').hide();
		    
		        });

		      //  $.ajax.abortAll();
		  }
		
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
			$("#valpart").show();

			$("#id").val(id);
			$("#time").val($("#time_"+id).val());
			$("#reason").val($("#reason_"+id).val());
			$("#valuerrec").val($("#recommend_"+id).val());
			$("#vzone").val($("#zone_"+id).val());
			$("#vsubzone").val($("#subzone_"+id).val());
			$("#vaprovednt").val(formatMoneyHas($("#approvednt_"+id).val()));
			$("#vaprovedtax").val(formatMoneyHas($("#approrvedtax_"+id).val()));
			
			$("#addsubmit").html("Update");
		 	$("label.error").remove();	
		}	
		
		function updateReason(){
			$("#operation").val(4);
			$("#grouptable").hide();
			$("#valpart").hide();
			$("#addgroup").show();
			var table = $('#agendatbl').DataTable();

			var account = $.map(table.rows('.selected').data(), function (item) {
		        return item['ol_id']
		    });

			$("#ol_id").val(account);

		    console.log(account);
		}

		function deleteProperty(){
			var table = $('#agendatbl').DataTable();

			 var account = $.map(table.rows('.selected').data(), function (item) {
		       return item['ol_vd_id']
		      });
			 console.log(table.rows('.selected').data());
			
			var type = "delete";
			
			$('#accounts').val(account.toString());
			
			if(account.length>0){
				$('#addDetail').modal();
			} else {
				alert('Please select one or more account to generate report');
			}
			//$('#addDetail').modal();
			//console.log(account.toString());
			console.log(account.toString());
			
			
		}

		function deleteProperty2(){
			var table = $('#agendatbl').DataTable();

			 var account = $.map(table.rows('.selected').data(), function (item) {
		       return item['ol_vd_id']
		      });
			 console.log(table.rows('.selected').data());
			
			var type = "delete";
			
console.log(account.toString());
			var noty_id = noty({
				layout : 'center',
				text: 'Are want to Generate Report?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Generate', click: function($noty) {
						$noty.close();
						$('#accounts2').val(account.toString());
						$('#generateform2').submit();
					/*	$.ajax({
					        type:'GET',
					        url:'generateinspectionreport',
					        data:{accounts:account.toString(),type:type,id:'id'},
					        success:function(data){
					        	
								//location.reload();				        		
					        	//$("#finish").attr("disabled", true);
					        	//clearTableError(4);
				        	},
					        error:function(data){
								//$('#loader').css('display','none');	
					        	   	
					        		var noty_id = noty({
									layout : 'to p',
									text: 'Report Not generated!',
									modal : true,
									type : 'error', 
								});
				        	}
						});*/
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
		            'termid1': 'required',
		            'name1': 'required'
		        },
		        messages: {
					"term1": "Please select term name",
					"name1": "Please enter basket name"
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
	            /*"dom": '<"toolbar">frtip',*/
	            "ajax": {
	                "type": "GET",
	                "url": 'objectionreporttable?id={{$id}}&term={{$term}}',
	                "contentType": 'application/json; charset=utf-8',
	            "headers": {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          }
	            },
	              
	              
	           // ajax: '{{ url("inspectionproperty") }}', 
	            /*"ajax": '/bookings/datatables',*/
	            "columns": [
	                {"data": "ol_vd_id", "name": "account number"},
	                {"data": null, "name": "sno"},
	                {"data": "ol_accno", "name": "account number"},
	                {"data": "ol_time", "name": "zone"},
	                {"data": "ol_reason", "name": "subzone"},
	                {"data": "zone", "name": "address"},
	                {"data": "subzone", "name": "account number"},
	                {"data": "vt_proposednt", "name": "zone", "sClass": "numericCol"},
	                {"data": "vt_proposedrate", "name": "subzone", "sClass": "numericCol"},
	                {"data": "vt_proposedtax", "name": "address", "sClass": "numericCol"},
	                {"data": "ol_valuerrecommend", "name": "address", "sClass": "numericCol"},
	                {"data": "diff", "name": "address", "sClass": "numericCol","visible":false},
	                {"data": "percentage", "name": "address", "sClass": "numericCol","visible":false},
	                {"data":  function(data){
			        	return '<span><a onclick="updateMeeting('+data.ol_id+')" class="action-icons c-edit  edtlotrow" href="#" title="Update Agenda">New Agenda</a></span>';
			        }, "name": "address"}
	          ],
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
function deleteObjection() {
	    var table = $('#agendatbl').DataTable();
	       
	    var account = $.map(table.rows('.selected').data(), function (item) {
	    	return item['ol_id']
	    });
	    var acc_legth = account.length;
	    if (acc_legth > 0 ){
	      var noty_id = noty({
	          layout : 'center',
	          text: 'Are want to Delete?',
	          modal : true,
	          buttons: [
	            {type: 'button pink', text: 'Delete', click: function($noty) {
	              $noty.close();	                
	                 var id= "{{$id}}";
	                  var type = "delete";
	                     $.ajax({
	                       type:'GET',
	                       url:'objectionreporttrn',
	                       data:{accounts:account,id:id,type:type},
	                       success:function(data){           
	                         // alert(data.newcount + " Property Deleted");
	                          window.location.assign('objectionreport?term={{$term}}&id={{$id}}');
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
	      alert('Please select Atleast one Property to Delete');
	    }
	    
	   }
		
	</script>

</div>
</body>
</html>