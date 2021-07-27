<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('objection.Meeting')}} </title>
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
							<li><a href="#">{{__('objection.Home')}} </a></li>
							<li><a href="#">{{__('objection.Valuation_Process')}} </a></li>
							<li>{{__('objection.Meeting')}} </li>
						</ul>
					</div>
					<!--<button id="adduser" style="float:right;margin-right: 10px;" onclick="newGroup()" name="btnadduser" type="button" class="btn_small btn_blue"><span>Add Meeting</span></button>-->
					<br>
				</div>		
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table class="display tbl_details">
							<thead style="text-align: left;">
			  					<tr>
									<th class="table_sno">{{__('objection.SNO')}}</th>
									<th> {{__('objection.Term_Name')}}  </th>
									<th> {{__('objection.Description')}}  </th>
									<th> {{__('objection.List_Year')}}  </th>
									<th> {{__('objection.Meeting_Date')}}  </th>
									<th> {{__('objection.Notice')}} 8 {{__('objection.Date')}} </th>
									<th> {{__('objection.Notice')}} 9 {{__('objection.Date')}} </th>
									<th> {{__('objection.Notice')}} 10 {{__('objection.Date')}} </th>
									<th> {{__('objection.Enforce_Date')}}  </th>
									<th> {{__('objection.Action')}}  </th>
								</tr>
							</thead>
							<tbody>
								@foreach ($agenda as $rec)
								<tr>
									<td>
										{{$loop->iteration}}
									</td>
									<td>
										<a href="agenda?term={{$rec->vt_id}}&id={{$rec->ob_id}}">{{$rec->vt_name}}</a>
									</td>
									<td>
										{{$rec->ob_desc}}
									</td>
									<td>
										{{$rec->ob_listyear}}
									</td>
									<td>
										{{$rec->ob_meetingdate}}
									</td>
									<td>
										{{$rec->ob_notis8date}}
									</td>
									<td>{{$rec->ob_notis9date}}										
									</td>
									<td>
										{{$rec->ob_notis10date}}
									</td>
									<td>
										{{$rec->vt_termdate}}
									</td>
									<td>
										<span><a onclick="updateMeeting('{{$rec->ob_id}}')" class="action-icons c-edit edtlotrow" href="#" title="Edit">Edit</a></span><span><a onclick="deleteMeeting('{{$rec->ob_id}}')" class=" action-icons c-delete deletelotrow dellotrow" href="#" title="delete">Delete</a></span>
									</td>
								</tr>
								<div style="display: none;">
									<input type="text" id="termid_{{$rec->ob_id}}" value="{{$rec->vt_id}}"> 
									<input type="text" id="desc_{{$rec->ob_id}}" value="{{$rec->ob_desc}}"> 
									<input type="text" id="listyear_{{$rec->ob_id}}" value="{{$rec->ob_listyear}}"> 
									<input type="text" id="meetingdate_{{$rec->ob_id}}" value="{{$rec->ob_meetingdate}}"> 
									<input type="text" id="notis8date_{{$rec->ob_id}}" value="{{$rec->ob_notis8date}}"> 
									<input type="text" id="notis8hijridate_{{$rec->ob_id}}" value="{{$rec->ob_notis8hijridate}}"> 
									<input type="text" id="notis9date_{{$rec->ob_id}}" value="{{$rec->ob_notis9date}}"> 
									<input type="text" id="notis9hijridate_{{$rec->ob_id}}" value="{{$rec->ob_notis9hijridate}}"> 
									<input type="text" id="notis10date_{{$rec->ob_id}}" value="{{$rec->ob_notis10date}}"> 
									<input type="text" id="notis10hijridate_{{$rec->ob_id}}" value="{{$rec->ob_notis10hijridate}}"> 
									<input type="text" id="notis8printdate_{{$rec->ob_id}}" value="{{$rec->ob_notis8printdate}}"> 
									<input type="text" id="enforcedate_{{$rec->ob_id}}" value="{{$rec->vt_termdate}}"> 
									<input type="text" id="ob_noticeobjdate_{{$rec->ob_id}}" value="{{$rec->ob_noticeobjdate}}"> 
									<input type="text" id="ob_vallistrevdate_{{$rec->ob_id}}" value="{{$rec->ob_vallistrevdate}}"> 
								</div>
								@endforeach						
							</tbody>
						</table>
					</div>
				</div>
			</div>

		
				
		
			<div id="addgroup" style="display:none" class="grid_10 full_block">
				<div class="widget_wrap">
					<div class="widget_content">
						<h3 id="title">{{__('objection.Add_Meeting')}}</h3>
						<form id="addgroupfrom"  autocomplete="off" class="" method="post" action="#" >
							@csrf
							<input type="hidden" name="id" id="id" value="0">
							<input type="hidden" name="operation" id="operation" value="0">
							<div  class="grid_6 form_container left_label">
								<ul>
									<li>		
									<fieldset>
										<legend>{{__('objection.Basic_Information')}}</legend>						
										<div class="form_grid_12">									
											<label class="field_title" id="termname" for="termid">{{__('objection.Term_Name')}}<span class="req">*</span></label>
											<div class="form_input">
												<select disabled="disabled" data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="termid" name="termid" tabindex="20">
													<option></option>
													@foreach ($term as $rec)
														<option value='{{ $rec->termid }}'>{{ $rec->term }}</option>
													@endforeach	
												</select>
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
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.List_Year')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="listyear" required="true"  name="listyear" type="text"  value="{{ old('listyear') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>							
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Enforce_Date')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="enforcedate" required="true"  name="enforcedate" type="text"  value="{{ old('enforcedate') }}" />
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
										<legend>{{__('objection.Meeting_Information')}}</legend>							
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Meeting_Date')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="meetingdate" required="true"  name="meetingdate" type="text"  value="{{ old('meetingdate') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>								
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Notice')}} 8 {{__('objection.Date')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="notis8date" required="true"  name="notis8date" type="text"  value="{{ old('notis8date') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>								
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Notice')}} 8 {{__('objection. hijridate')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="notis8hijridate" required="true"  name="notis8hijridate" type="text"  value="{{ old('notis8hijridate') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>								
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Notice')}} 9 {{__('objection.Date')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="notis9date" required="true"  name="notis9date" type="text"  value="{{ old('notis9date') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>								
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Notice')}} 9 {{__('objection.hijridate')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="notis9hijridate" required="true"  name="notis9hijridate" type="text"  value="{{ old('notis9hijridate') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>								
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Notice')}} 10 {{__('objection.Date')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="notis10date" required="true"  name="notis10date" type="text"  value="{{ old('notis10date') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>								
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Notice')}} 10 {{__('objection.hijridate')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="notis10hijridate" required="true"  name="notis10hijridate" type="text"  value="{{ old('notis10hijridate') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>							
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Notice')}} 8 {{__('objection.printdate')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="notis8printdate" required="true"  name="notis8printdate" type="text"  value="{{ old('notis8printdate') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>								
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">Objection Notice Date<span class="req">*</span></label>
											<div class="form_input">
												<input id="objnotisdate" required="true"  name="objnotisdate" type="text"  value="{{ old('notis10hijridate') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>							
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">valuationlist date<span class="req">*</span></label>
											<div class="form_input">
												<input id="vallistdate" required="true"  name="vallistdate" type="text"  value="{{ old('notis8printdate') }}" />
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
	
	<script>
		

		function newGroup(){
			$("#operation").val(1);
			$("#grouptable").hide();
			$("#addgroup").show();

			$("#termid").val('');
			$("#desc").val('');
			$("#listyear").val('');
			$("#meetingdate").val('');
			$("#notis8date").val('');
			$("#notis8hijridate").val('');
			$("#notis9date").val('');
			$("#notis9hijridate").val('');
			$("#notis10date").val('');
			$("#notis10hijridate").val('');
			$("#notis8printdate").val('');
			$("#enforcedate").val('');
			$("#addsubmit").html("Save");
		 	$("label.error").remove();	
		}

		function updateMeeting(id){
			$("#operation").val(2);
			$("#grouptable").hide();
			$("#addgroup").show();
			$( "select" ).attr( "disabled" );
			$("#id").val(id);
			$("#termid").val($("#termid_"+id).val());
			$("#desc").val($("#desc_"+id).val());
			$("#listyear").val($("#listyear_"+id).val());
			$("#meetingdate").val($("#meetingdate_"+id).val());
			$("#notis8date").val($("#notis8date_"+id).val());
			$("#notis8hijridate").val($("#notis8hijridate_"+id).val());
			$("#notis9date").val($("#notis9date_"+id).val());
			$("#notis9hijridate").val($("#notis9hijridate_"+id).val());
			$("#notis10date").val($("#notis10date_"+id).val());
			$("#notis10hijridate").val($("#notis10hijridate_"+id).val());
			$("#notis8printdate").val($("#notis8printdate_"+id).val());
			$("#enforcedate").val($("#enforcedate_"+id).val());
			$("#objnotisdate").val($("#ob_noticeobjdate_"+id).val());
			$("#vallistdate").val($("#ob_vallistrevdate_"+id).val());
			
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
			$( "select" ).removeAttr( "disabled" );
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
		            window.location.assign('meetingtrn?jsondata='+groupjson)		        	
		        }
		    });
		}

		$(document).ready(function() {
		 	$( "#enforcedate" ).datepicker({dateFormat: 'dd/mm/yy'});
		 	$( "#meetingdate" ).datepicker({dateFormat: 'dd/mm/yy'});
		 	$( "#notis8date" ).datepicker({dateFormat: 'dd/mm/yy'});
		 	//$( "#notis8hijridate" ).datepicker({dateFormat: 'dd/mm/yy'});
		 	$( "#notis9date" ).datepicker({dateFormat: 'dd/mm/yy'});
		 	$( "#objnotisdate" ).datepicker({dateFormat: 'dd/mm/yy'});
		 	$( "#notis10date" ).datepicker({dateFormat: 'dd/mm/yy'});
		 	$( "#vallistdate" ).datepicker({dateFormat: 'dd/mm/yy'});
		 	$( "#notis8printdate" ).datepicker({dateFormat: 'dd/mm/yy'});
		});
	</script>

</div>
</body>
</html>