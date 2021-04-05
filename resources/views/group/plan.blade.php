<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Plan</title>
@include('includes.header', ['page' => 'datamaintenance'])
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
		
			<div id="termtable" class="grid_12">
	
				<br>
				<div class="form_input">
					
					<div id="breadCrumb3"  class="breadCrumb grid_3">
						<ul >
							<li><a href="#">Home</a></li>
							<li>Plan Registeration</li>
						</ul>
					</div>


					@include('search.searchcustom',['tableid'=>'termtbl', 'action' => 'tenanttable', 'searchid' => '25'])

					<button id="adduser" style="float:right;margin-right: 10px;" onclick="newTerm()" name="btnadduser" type="button" class="btn_small btn_blue"><span>Add Plan</span></button>
					<br>
				</div>		
				<div class="widget_wrap">					
					<div class="widget_content">	

										
										
						<table id="termtbl" class="display plantbl_details">
							<thead style="text-align: left;">
			  					<tr>
									<th class="table_sno">
										S No
									</th>
									<th>
										File Number
									</th>
									<th>
										Development Title
									</th>
									<th>
										Plan Application Type
									</th>
									<th>
										Zone
									</th>
									<th>
										No Lot
									</th>
									<th style="display: none;">
										Create By -
										Create At
									</th>
									<th style="display: none;">
										Create By -
										Create At
									</th>
									<th style="display: none;">
										Update By -
										Update At
									</th>
									<th style="display: none;">
										Update By -
										Update At
									</th>
									<th>
										Plan Date
									</th>
									<th>
										CCC Date
									</th>
									<th>
										Valuation Date
									</th>
									<th>
										Plan Status
									</th>
									<th>
										Action
									</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($plan as $rec)
								<tr>
									<td>
										{{$loop->iteration}}
									</td>
									<td>
										{{$rec->plan_fileno}}
									</td>
									<td>
										{{$rec->plan_desc}}
									</td>
									<td>
										{{$rec->appln}}
									</td>
									<td>
										{{$rec->zone}}
									</td>
									<td>
										{{$rec->plan_lotno}}
									</td>
									<td style="display: none;">
										{{$rec->plan_createby}}
									</td>
									<td style="display: none;">
										{{$rec->plan_createdate1}}
									</td>
									<td style="display: none;">
										{{$rec->plan_updateby}}
									</td>
									<td style="display: none;">
										{{$rec->plan_updatedate1}}
									</td>
									<td>
										{{$rec->plan_plandate1}}
									</td>
									<td>
										{{$rec->plan_cccdate1}}
									</td>
									<td>
										{{$rec->plan_valuationdate1}}
									</td>
									<td>
										{{$rec->status}}
									</td>
									<td>
										
										@if($rec->plan_planstatus_id == 1)	
										    <span><a class="action-icons c-delete delete_term" onclick="deleteTerm('{{$rec->plan_id}}')" href="#" title="Delete Term">Delete</a></span>
										@endif

										@if($rec->plan_planstatus_id == 9)
										<spane><a  class=" new-action-icons reverse" onclick="approveProperty('{{$rec->plan_id}}')" title="Revise" href="#"></a></span>
										@endif

										@if($rec->plan_planstatus_id != 9)
										<span><a class="action-icons c-edit" onclick="editTerm('{{$rec->plan_id}}')" title="Edit plan" href="#">Edit</a></span>
										@endif
									</td>
								</tr>
								<div style="display: none;">
									<input type="text" id="fileno_{{$rec->plan_id}}" value="{{$rec->plan_fileno}}">
									<input type="text" id="desc_{{$rec->plan_id}}" value="{{$rec->plan_desc}}">
									<input type="text" id="applntype_{{$rec->plan_id}}" value="{{$rec->plan_planapplicationtype}}">
									<input type="text" id="zone_{{$rec->plan_id}}" value="{{$rec->plan_zon_id}}">
									<input type="text" id="lotid_{{$rec->plan_id}}" value="{{$rec->plan_lotno}}">
									<input type="text" id="plandate_{{$rec->plan_id}}" value="{{$rec->plan_plandate1}}">
									<input type="text" id="cccdate_{{$rec->plan_id}}" value="{{$rec->plan_cccdate1}}">
									<input type="text" id="valdate_{{$rec->plan_id}}" value="{{$rec->plan_valuationdate1}}">
									<input type="text" id="note_{{$rec->plan_id}}" value="{{$rec->plan_note}}">
									<input type="text" id="status_{{$rec->plan_id}}" value="{{$rec->plan_planstatus_id}}">
								</div>
								@endforeach				
							</tbody>
						</table>
					</div>
				</div>
			</div>
		
			<div id="addterm" style="display:none" class="grid_10 full_block">
				<div class="widget_wrap">
					<div class="widget_content">
						<h3 id="title">Add Plan</h3>
						<form id="addtermfrom"  autocomplete="off" class="" method="post" action="#" >
							@csrf
							<input type="hidden" name="id" id="id" value="0">
							<input type="hidden" name="operation" id="operation" value="0">
							<div  class="grid_6 form_container left_label">
								<ul>
									<li>								
										<div class="form_grid_12">									
											<label class="field_title" id="luserid" for="userid">File Number<span class="req">*</span></label>
											<div class="form_input">
												<input id="fileno" required="true"  name="fileno" type="text"  />
											</div>
											<span class=" label_intro"></span>
										</div>							
										<div class="form_grid_12">									
											<label class="field_title" id="luserid" for="userid">Plan Desc<span class="req">*</span></label>
											<div class="form_input">
												<textarea id="plandesc" required="true" class="" name="plandesc" ></textarea>
											</div>
											<span class=" label_intro"></span>
										</div>	
										<div class="form_grid_12">									
											<label class="field_title" id="luserid" for="userid">Application Type<span class="req">*</span></label>
											<div class="form_input">
												<select data-placeholder="Choose a Custom..." style="width:100%" class="cus-select field" id="applicationtype" name="applicationtype" tabindex="20">
													<option></option>
													@foreach ($applntype as $rec)
													<option value="{{ $rec->tdi_key }}">{{ $rec->tdi_value }}</option>
													@endforeach
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>		
										<div class="form_grid_12">									
											<label class="field_title" id="luserid" for="userid">Zone<span class="req">*</span></label>
											<div class="form_input">
												<select data-placeholder="Choose a Custom..." style="width:100%" class="cus-select field" id="zone" name="zone" tabindex="20">
													<option></option>
													@foreach ($zone as $rec)
													<option value="{{ $rec->tdi_key }}">{{ $rec->tdi_value }}</option>
													@endforeach
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>							
										<div class="form_grid_12">									
											<label class="field_title" id="luserid" for="userid">No Lot<span class="req">*</span></label>
											<div class="form_input">
												<input id="nolot" required="true" class="" name="nolot" type="text"  value="{{ old('term') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>							
										<div class="form_grid_12">									
											<label class="field_title" id="luserid" for="userid">Plan Date</label>
											<div class="form_input">
												<input id="plandate" class="" name="plandate" type="text"  value="{{ old('term') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>							
										<div class="form_grid_12">									
											<label class="field_title" id="luserid" for="userid">CCC Date</label>
											<div class="form_input">
												<input id="cccdate" class="" name="cccdate" type="text"  value="{{ old('term') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>									
										<div class="form_grid_12">									
											<label class="field_title" id="luserid" for="userid">Valuation Date</label>
											<div class="form_input">
												<input id="valdate" class="" name="valdate" type="text"  value="{{ old('term') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>									
										<div class="form_grid_12">									
											<label class="field_title" id="luserid" for="userid">Note<span class="req">*</span></label>
											<div class="form_input">
												<textarea id="note" required="true" class="" name="note" ></textarea>
											</div>
											<span class=" label_intro"></span>
										</div>										
										<div class="form_grid_12">									
											<label class="field_title" id="luserid" for="userid">Status<span class="req">*</span></label>
											<div class="form_input">

												<select data-placeholder="Choose a Custom..." style="width:100%" class="cus-select field" id="status" name="status" tabindex="20">
													<option></option>		
													<option value="2">SUBMITED TO VALUATION</option>
													<option value="4">VALUATION ACCEPT</option>
													<option value="9">COMPLETED</option>
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>				
									</li>
								</ul>
							</div>
							
							<div style="height: 48px; float: none; display: -webkit-box;text-align: -webkit-center;" class="grid_12">
							
								<div class="form_input">
									<button id="addsubmit" name="adduser" type="submit" onclick="validateTerm()" class="btn_small btn_blue"><span>Submit</span></button>			
														
									<button id="close" onclick="closeTerm()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>
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
		function approveProperty(id){
			/*var pland = $('#plandate_'+id).val();
			var cccd = $('#cccdate_'+id).val()
			var vald = $('#valdate_'+id).val();
			var status = false;
			if (type == 3 && pland != '00/00/0000' && cccd != '00/00/0000' && vald != '00/00/0000') {
				status = true;
			} else if(type != 3) {
				status = true;
			}
			if (status){*/			
				var noty_id = noty({
					layout : 'center',
					text: 'Are want to revise?',
					modal : true,
					buttons: [
						{type: 'button pink', text: 'Send', click: function($noty) {
							$noty.close();
							$.ajax({
				  				type: 'GET', 
							    url:'approve',
							    headers: {
								    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
						        data:{param_value:id,module:'planapprove'},
						        success:function(data){
						        	window.location.assign("plan");		        		
						        	//$("#finish").attr("disabled", true);
						        	//clearTableError(4);
					        	},
						        error:function(data){
									//$('#loader').css('display','none');	
						        	$('#finishloader').html('');     	
						        		var noty_id = noty({
										layout : 'top',
										text: 'Problem while approve!',
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
			/*} else {
				alert('Please update all date before Complete.');
			}*/

		}	


		function newTerm(){
			$("#operation").val(1);
			$("#termtable").hide();
			$("#addterm").show();
			$("#title").html("Add Plan");
			$("#addsubmit").html("Save");
		 	$("label.error").remove();	
		}

		function editTerm(id){
			$('#id').val(id);
			$("#operation").val(2);
			$("#termtable").hide();
			$("#addterm").show();
			
			$('#fileno').val($('#fileno_'+id).val());
			$('#plandesc').val($('#desc_'+id).val());
			$('#applicationtype').val($('#applntype_'+id).val());
			$('#zone').val($('#zone_'+id).val());
			$('#nolot').val($('#lotid_'+id).val());
			$('#plandate').val($('#plandate_'+id).val());
			$('#cccdate').val($('#cccdate_'+id).val());
			$('#note').val($('#note_'+id).val());
			$('#valdate').val($('#valdate_'+id).val());
			$('#status').val($('#status_'+id).val());

			$("#addsubmit").html("Save");
			$("#title").html("Edit Plan");
		 	$("label.error").remove();	
		}
		function closeTerm(){
			//$('#addsubmit').removeAttr('disabled');
			$('#fileno').val('');
			$('#plandesc').val('');
			$('#applicationtype').val('');
			$('#zone').val('');
			$('#nolot').val('');
			$('#plandate').val('');
			$('#cccdate').val('');
			$('#note').val('');
			$('#valdate').val('');
			$("#operation").val(0);
			$("#termtable").show();
			$("#addterm").hide();
		 	$('#err_lbl').html('');
		 	$("label.error").remove();
		}
		function validateTerm(){
			$('#addtermfrom').validate({
		        rules: {
		            'term': 'required'
		        },
		        messages: {
					"term": "Please enter term name"
		        },
		        submitHandler: function(form) {
					var d=new Date();		        	
					var operation = $('#operation').val();
					var page = "ratepayer";
					var termdata = {};
		        	$('#addtermfrom').serializeArray().map(function(x){termdata[x.name] = x.value;});

		            var termjson = JSON.stringify(termdata);
		            window.location.assign('plantrn?jsondata='+termjson)		        	
		        }
		    });
		}


		function deleteTerm(id){
			
			var noty_id = noty({
				layout : 'center',
				text: 'Are want to delete term?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Delete', click: function($noty) {
						$noty.close();
						$("#operation").val(3);
						$("#id").val(id);
						var termdata = {};
			        	$('#addtermfrom').serializeArray().map(function(x){termdata[x.name] = x.value;});

			            var termjson = JSON.stringify(termdata);
			            window.location.assign('plantrn?jsondata='+termjson);
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

		$(document).ready(function(){
			$( "#plandate" ).datepicker({dateFormat: 'dd/mm/yy'});
			$( "#cccdate" ).datepicker({dateFormat: 'dd/mm/yy'});
			$( "#valdate" ).datepicker({dateFormat: 'dd/mm/yy'});
			
		});


	</script>

</div>
</body>
</html>