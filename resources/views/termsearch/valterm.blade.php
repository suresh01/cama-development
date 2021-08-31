<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('Termsearch.Term')}} </title>
@include('includes.header', ['page' => 'dataenquery'])
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
							<li><a href="#">{{__('Termsearch.Home')}} </a></li>
							<li><a href="#">{{__('Termsearch.Data_Enquiry')}} </a></li>
							<li>{{__('Termsearch.Term_Search')}} </li>
						</ul>
					</div>
					<div  style="float:right;margin-right: 20px;">		
							<select data-placeholder="Choose a Status..." onchange="getdata()"  style="float: left;" class="cus-select"  id="paramterm" name="paramterm" tabindex="6">	
								<option value="0">{{__('common.Please_Select_a_Filter')}}...</option>					
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
									{{__('Termsearch.Total_Term_Count')}} <span id="term_count">0</span>
								</div>
							</div>
							<div style="width: 160px;" class="comments_s">
								<div style="width: 160px;" class="block_label">
									{{__('Termsearch.Total_Basket_Count')}} <span>@foreach ($basket_count as $rec)
												{{$rec->basket_count}}									
											@endforeach	</span>
								</div>
							</div>
							<div style="width: 180px;" class="comments_s">
								<div style="width: 180px;" class="block_label">
									{{__('Termsearch.Total_Property_Count')}} <span>@foreach ($property_count as $rec)
												{{$rec->property_count}}									
											@endforeach	</span>
								</div>
							</div>
						</div>				
						<br>					
						<table id="termtbl" class="display termtbl_details">
							<thead style="text-align: left;">
			  					<tr>
									<th class="table_sno">{{__('Termsearch.SNO')}}</th>
									<th> {{__('Termsearch.Term_Name')}}  </th>
									<th> {{__('Termsearch.Application_Type')}}  </th>
									<th> {{__('Termsearch.Basket_Count')}}  </th>
									<th> {{__('Termsearch.Property_Count')}}  </th>
									<th> {{__('Termsearch.Term_Date')}}  </th>
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
									<th> {{__('Termsearch.Enforced_by_at')}}  </th>
									<th> {{__('Termsearch.Status')}}  </th>
									<th> {{__('Termsearch.Action')}}  </th>
								</tr>
							</thead>
							<tbody>
								@foreach ($term as $rec)
								<tr>
									<td>
										{{$loop->iteration}}
									</td>
									<td>
										<a href="termbasket?id={{$rec->vt_id}}&ts=1">{{$rec->name}}</a>
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
										<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -982px  -2px !important;display: inline-block; float: left;" onclick="attachment('{{$rec->vt_id}}','{{$rec->termDate}}')"  title="Attachment" href="#"></a></span>
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
						<h3 id="title">{{__('Termsearch.Add_Term')}} </h3>
						<form id="addtermfrom"  autocomplete="off" class="" method="post" action="#" >
							@csrf
							<input type="hidden" name="id" id="id" value="0">
							<input type="hidden" name="operation" id="operation" value="0">
							<div  class="grid_6 form_container left_label">
								<ul>
									<li>								
										<div class="form_grid_12">									
											<label class="field_title" id="luserid" for="userid">{{__('Termsearch.Term_Name')}} <span class="req">*</span></label>
											<div class="form_input">
												<input id="name" required="true"  name="name" type="text"  value="{{ old('term') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>							
										<div class="form_grid_12">									
											<label class="field_title" id="luserid" for="userid">{{__('Termsearch.Term_Date')}} <span class="req">*</span></label>
											<div class="form_input">
												<input id="termdate" required="true" class="" name="termdate" type="text"  value="{{ old('term') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>	
										<div class="form_grid_12">									
											<label class="field_title" id="luserid" for="userid">{{__('Termsearch.Application_Type')}} <span class="req">*</span></label>
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
											<label class="field_title" id="luserid" for="userid">{{__('Termsearch.Term_Type')}} <span class="req">*</span></label>
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
									<button id="addsubmit" name="adduser" type="submit" onclick="validateTerm()" class="btn_small btn_blue"><span>{{__('common.Submit')}}</span></button>			
														
									<button id="close" onclick="closeTerm()" name="close" type="button" class="btn_small btn_blue"><span>{{__('common.Close')}}</span></button>
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

		function attachment(id,termdate){
			termdate = termdate.split("/").pop();
			var w = window.open('about:blank','Popup_Window','toolbar=0,resizable=0,location=no,statusbar=0,menubar=0,width=1000,height=700,left = 312,top = 50');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		       // w.location = "landval?id="+id;
		      // w.location.pathname = 'valuation/popup/land.blade.php';
		       w.location.assign("termattachment?prop_id="+id+"&year="+termdate);
		    }
		}

		function getdata(){
			//$('#paramterm').val('{{$param}}');
			var param = $('#paramterm').val();
			if (param != '0') {
				window.location.assign('valterm?param='+param);
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