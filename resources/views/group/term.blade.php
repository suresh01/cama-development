<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Term</title>
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
		<script>

				$(document).ready(function(){
					$('#paramterm').val('{{$param}}');
				});
					

			</script>
			<div id="termtable" class="grid_12">
	
				<br>
				<div class="form_input">
					

					<div id="breadCrumb3"  class="breadCrumb grid_3">
						<ul >
							<li><a href="#">Home</a></li>
							<li><a href="#">Valuation Process</a></li>
							<li>Term Management</li>
						</ul>
					</div>
					<button id="adduser" style="float:right;margin-right: 10px;" onclick="newTerm()" name="btnadduser" type="button" class="btn_small btn_blue"><span>Add Term</span></button>
					<div  style="float:right;margin-right: 20px;">		
							<select data-placeholder="Choose a Status..." onclick="getdata()"  style="float: left;" class="cus-select"  id="paramterm" name="paramterm" tabindex="6">						
								<option value='A'>All</option>							
								<option value='C'>CMK</option>							
								<option value='K'>KAD</option>								
							</select>	
						<span class="clear"></span>
					</div>
					<br>
				</div>		
				<div class="widget_wrap">					
					<div class="widget_content">	

						<div class="social_activities">
							<div class="comments_s">
								<div class="block_label">
									Total Term Count<span id="term_count">0</span>
								</div>
							</div>
							<div style="width: 160px;" class="comments_s">
								<div style="width: 160px;" class="block_label">
									Total Basket Count<span>@foreach ($basket_count as $rec)
												{{$rec->basket_count}}									
											@endforeach	</span>
								</div>
							</div>
							<div style="width: 180px;" class="comments_s">
								<div style="width: 180px;" class="block_label">
									Total Property Count<span>@foreach ($property_count as $rec)
												{{$rec->property_count}}									
											@endforeach	</span>
								</div>
							</div>
						</div>				
						<br>					
						<table id="termtbl" class="display termtbl_details">
							<thead style="text-align: left;">
			  					<tr>
									<th class="table_sno">
										S No
									</th>
									<th>
										Term Name
									</th>
									<th>
										Application Type
									</th>
									<th>
										Basket Count
									</th>
									<th>
										Property Count
									</th>
									<th>
										Term Date
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
									<th style="display: none;">
										Transfer by - Transfer at
									</th>
									<th style="display: none;">
										id
									</th>
									<th style="display: none;">
										base
									</th>
									<th style="display: none;">
										base
									</th>
									<th>
										Enforced by - Enforced at
									</th>
									<th>
										Status
									</th>
									<th>
										Action
									</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($term as $rec)
								<tr>
									<td>
										{{$loop->iteration}}
									</td>
									<td>
										{{$rec->name}}
									</td>
									<td>
										{{$rec->applntype}}
									</td>
									<td>
										{{$rec->basket_count}}
									</td>
									<td>
										{{$rec->property_count}}
									</td>
									<td>
										{{$rec->termDate}}
									</td>
									<td style="display: none;">
										{{$rec->createby}} 
									</td>
									<td style="display: none;">
										{{$rec->createdate}}
									</td>
									<td style="display: none;">
										{{$rec->updateby}} 
									</td>
									<td style="display: none;">
										{{$rec->updatedate}}
									</td>
									<td style="display: none;">
										{{$rec->vt_transferDate}}
									</td>
									<td style="display: none;">
										{{$rec->vt_id}}
									</td>
									<td style="display: none;">
										{{$rec->valbase}}
									</td>
									<td style="display: none;">
										{{$rec->vt_transferby}}
									</td>
									<td>
										@if($rec->vt_approvalstatus_id == '05')
										{{$rec->enforceDate}} - {{$rec->updateby}}
										@endif
									</td>
									<td>
										{{$rec->termstage}}
									</td>
									<td>
										
										@if($rec->basket_count == 0)	
										@if($rec->vt_approvalstatus_id == '01')
										<!--<span><a class="action-icons c-edit" onclick="editTerm('{{$rec->vt_id}}')" title="Edit Term" href="#">Edit</a></span>-->
										
										    <span><a class="action-icons c-delete delete_term" onclick="deleteTerm('{{$rec->vt_id}}')" href="#" title="Delete Term">Delete</a></span>

										<span><a class="action-icons c-edit" onclick="editTerm('{{$rec->vt_id}}')" title="Edit Term" href="#">Edit</a></span>
										@endif
										@endif
										@if($rec->vt_approvalstatus_id == '03' )
										<spane><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="enforceTerm('{{$rec->vt_id}}')" disabled="true" title="Enforce Term" href="#"></a></span>
											@endif
										@if($rec->ap_basket_count == $rec->basket_count && $rec->basket_count > 0 && $rec->vt_approvalstatus_id == '01' )
										<spane><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approveValuation('{{$rec->vt_id}}')" disabled="true" title="Approve Transfer" href="#"></a></span>
										@endif
									</td>
								</tr>
								<div style="display: none;">
									<input type="text" id="name_{{$rec->vt_id}}" value="{{$rec->name}}">
									<input type="text" id="termdate_{{$rec->vt_id}}" value="{{$rec->termDate}}">
									<input type="text" id="appln_{{$rec->vt_id}}" value="{{$rec->vt_applicationtype_id}}">
									<input type="text" id="valbase_{{$rec->vt_id}}" value="{{$rec->vt_valbase_id}}">
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
						<h3 id="title">Add Term</h3>
						<form id="addtermfrom"  autocomplete="off" class="" method="post" action="#" >
							@csrf
							<input type="hidden" name="id" id="id" value="0">
							<input type="hidden" name="operation" id="operation" value="0">
							<div  class="grid_6 form_container left_label">
								<ul>
									<li>								
										<div class="form_grid_12">									
											<label class="field_title" id="luserid" for="userid">Term Name<span class="req">*</span></label>
											<div class="form_input">
												<input id="name" required="true"  name="name" type="text"  value="{{ old('term') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>							
										<div class="form_grid_12">									
											<label class="field_title" id="luserid" for="userid">Term Date<span class="req">*</span></label>
											<div class="form_input">
												<input id="termdate" required="true" class="" name="termdate" type="text"  value="{{ old('term') }}" />
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
											<label class="field_title" id="luserid" for="userid">Term Type<span class="req">*</span></label>
											<div class="form_input">
												<select data-placeholder="Choose a Custom..." style="width:100%" class="cus-select field" id="termbase" name="termbase" tabindex="20">
													<option></option>
													@foreach ($valbase as $rec)
													<option value="{{ $rec->tdi_key }}">{{ $rec->tdi_value }}</option>
													@endforeach
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
		function getdata(){
			//$('#paramterm').val('{{$param}}');
			var param = $('#paramterm').val();
			if (param != '0') {
				window.location.assign('term?param='+param);
			}
			//window.location.assign('propertybasket?param='+zone);
			//return;
		}

		function newTerm(){
			$("#operation").val(1);
			$("#termtable").hide();
			$("#addterm").show();
			$("#title").html("Add Term");
			$("#addsubmit").html("Save");
		 	$("label.error").remove();	
		}

		function editTerm(id){
			$("#operation").val(2);
			$("#termtable").hide();
			$("#addterm").show();
			$('#id').val(id);
			$('#name').val($('#name_'+id).val());
			$('#termdate').val($('#termdate_'+id).val());
			$('#termbase').val($('#valbase_'+id).val());
			$('#applicationtype').val($('#appln_'+id).val());
			$("#addsubmit").html("Save");
			$("#title").html("Edit Term");
		 	$("label.error").remove();	
		}
		function closeTerm(){
			//$('#addsubmit').removeAttr('disabled');
			$("#operation").val(1);
			$("#termtable").show();
			$("#addterm").hide();
		 	$('#err_lbl').html('');
		 	$("label.error").remove();
		}
		function validateTerm(){
			$('#addtermfrom').validate({
		        rules: {
		            'term': 'required',
		            'applicationtype': 'required',
		            'termbase': 'required'
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
		            window.location.assign('termtrn?jsondata='+termjson)		        	
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
						$("#id").val(id);
						var termdata = {};
			        	$('#addtermfrom').serializeArray().map(function(x){termdata[x.name] = x.value;});

			            var termjson = JSON.stringify(termdata);
			            window.location.assign('termtrn?jsondata='+termjson)
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
			$( "#termdate" ).datepicker({dateFormat: 'dd/mm/yy'});
			var count = $('#termtbl').DataTable().rows().count();
			$('#term_count').html(count);
		});


		function approveValuation(id){
			var noty_id = noty({
				layout : 'center',
				text: 'Are want to approve Transfer?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Approved', click: function($noty) {
						$noty.close();
						$.ajax({
			  				type: 'GET', 
						    url:'approve',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{param_value:id,module:'APTERM'},
					        success:function(data){
					        	
						        	var noty_id = noty({
										layout : 'top',
										text: 'Property Approved!',
										modal : true,
										type : 'success', 
									});	
									window.location.assign("term");	
									        		
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

		function enforceTerm(id){
			var noty_id = noty({
				layout : 'center',
				text: 'Are want to Enforce Term?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Enforce', click: function($noty) {
						$noty.close();
						$.ajax({
			  				type: 'GET', 
						    url:'approve',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{param_value:id,module:'ENFORCE'},
					        success:function(data){
					        	
						        	var noty_id = noty({
										layout : 'top',
										text: 'Term Enforced!',
										modal : true,
										type : 'success', 
									});	
									window.location.assign("term");	
									        		
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
	</script>

</div>
</body>
</html>