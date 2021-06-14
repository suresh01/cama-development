<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('toneoflist.TOL_Basket_Management')}}</title>
@include('includes.header', ['page' => 'TOL'])
	
	<div id="content">
		<div class="grid_container">
		<div id="basket_table" class="grid_12">
	
			<br>
			<div class="form_input">
				
				<div id="breadCrumb3"  class="breadCrumb grid_3">
					<ul >
						<li><a href="#">{{__('toneoflist.home')}}</a></li>
						<li><a href="#">{{__('toneoflist.tol')}}</a></li>
						<li>{{__('toneoflist.tbasket')}}</li>
					</ul>
				</div>
				<button id="addtrans" onclick="openBasket()" style="float:right;" name="btnadduser" type="button" class="btn_small btn_blue"><span>{{__('toneoflist.addbasket')}}</span></button>
				<br>
			</div>
		
			<div class="widget_wrap">					
				<div class="widget_content">						
					<table class="display data_tbl">
					<thead style="text-align: left;">
					<tr>
						<th class="table_sno">
							{{__('toneoflist.sno')}}
						</th>
						<th>
							{{__('toneoflist.id')}}
						</th>
						<th>
							{{__('toneoflist.tolyear')}}
						</th>
						<th>
							{{__('toneoflist.enforcementyear')}}
						</th>
						<th>
							{{__('toneoflist.description')}}
						</th>
						<th>
							{{__('toneoflist.status')}}
						</th>
						<th>
							{{__('toneoflist.updateby')}} / {{__('toneoflist.updatedate')}}
						</th>
						<th>
							{{__('toneoflist.action')}}
						</th>
						
					</tr>
					</thead>
					<tbody>
					@foreach ($basket as $rec)	
					<tr>
						<td>
							{{$loop->iteration}}
						</td>
						<td>
							 {{ $rec->tollist_id }}
						</td>
						<td>
							 {{ $rec->tollis_year }}
						</td>
						<td>
							 {{ $rec->tollis_enforceyear }}
						</td>
						<td>
							 {{ $rec->tollis_desc }}
						</td>
						<td>
							{{ $rec->actstatus }}
						</td>						
						<td>
							{{ $rec->tollis_updateby }} / {{$rec->tollis_updatedate}}
						</td>	
						<td class="">
								
							
							@if($rec->tollis_activeind_id == '1')
								
								<spane><a  class=" new-action-icons reverse" onclick="approve('{{$rec->tollist_id}}',1)" title="In Active" href="#"></a></span>;
													
							@elseif($rec->tollis_activeind_id == '2')
							 <span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('{{$rec->tollist_id}}',2)"  title=" Active" href="#"></a></span>'	
								<span><a class="action-icons c-edit" onclick="editBasket('{{ $rec->tollist_id }}')" href="#" title="{{__('common.Edit')}}">{{__('common.Edit')}}</a></span>
								<span><a class="action-icons c-Delete delete_tenant" onclick="deleteBasket('{{ $rec->tollist_id }}')" href="#" title="{{__('common.Delete')}}">{{__('common.Delete')}}</a></span>
							@endif
						</td>
					</tr>
					<div style="display:none">
						<input type="hidden" id="year_{{ $rec->tollist_id }}" value="{{ $rec->tollis_year }}">
						<input type="hidden" id="eyear_{{ $rec->tollist_id }}" value="{{ $rec->tollis_enforceyear }}">
						<input type="hidden" id="desc_{{ $rec->tollist_id }}" value="{{ $rec->tollis_desc }}">	
						<input type="hidden" id="status_{{ $rec->tollist_id }}" value="{{ $rec->tollis_activeind_id }}">			
					</div>
					@endforeach
					</table>
				</div>
			</div>
		</div>
				
		
		
		<div id="addbasketform" style="display:none" class="grid_12">
			<div class="widget_wrap">
				
				<div class="widget_content">
					<h3 id="title">{{__('toneoflist.addbasket')}}</h3>
					<form id="basketform" autocomplete="off" method="post" action="#" >
						<div  class="grid_6 form_container left_label">
							<ul>
								<li>
									<input type="hidden" name="operation" id="operation">
									<input type="hidden" name="basketid" id="basketid">
									<input type="hidden" name="jsondata" id="jsondata">
									<fieldset>
										<legend>{{__('toneoflist.basketinfo')}}</legend>
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">{{__('toneoflist.year')}}<span class="req">*</span></label>
											<div  class="form_input">
												<input id="year" name="year"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">{{__('toneoflist.enforcementyear')}}<span class="req">*</span></label>
											<div  class="form_input">
												<input id="eyear" name="eyear"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">{{__('toneoflist.description')}}<span class="req">*</span></label>
											<div  class="form_input">
												<input id="desc" name="desc"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">{{__('toneoflist.status')}}<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="status" name="status" tabindex="20">
													<option></option>
													@foreach ($status as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>

									</fieldset>

			
								</li>
							</ul>
						</div>
						
						<div style="height: 48px; float: none; display: -webkit-box;text-align: -webkit-center;" class="grid_12">							
							<div class="form_input">
								<button id="addsubmit" name="adduser" onclick="validateBasket()" class="btn_small btn_blue"><span>{{__('toneoflist.submit')}}</span></button>									
								
								<button id="close" onclick="closeBasket()" name="close" type="button" class="btn_small btn_blue"><span>{{__('toneoflist.close')}}</span></button>
								<span class=" label_intro"></span>
							</div>								
							<span class="clear"></span>
						</div>
					</form>
				</div>
			</div>
		</div>
	<span class="clear"></span>
	
</div>

<script>

	function approve(id,currstatus){
			
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
				        data:{param_value:id,module:'tonebasket',param:currstatus},
				        success:function(data){		        	
				        	
							window.location.assign("tonebasket");	
							
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

	function editBasket(id){
		$("#title").html("Update Basket");
		$('#year').val($('#year_'+id).val());
		$('#eyear').val($('#eyear_'+id).val());
		$('#desc').val($('#desc_'+id).val());
		$('#status').val($('#status_'+id).val());
		

		$('#basketid').val(id);
		$('#operation').val(2);
		$("#basket_table").hide();
		$("#addbasketform").show();
	 	$("label.error").remove();
	}

	function openBasket(){
		$("#title").html("Add Basket");
		$('#year').val('');
		$('#eyear').val('');
		$('#desc').val('');
		$('#status').val('');

		
		$('#basketid').val(0);
		$('#operation').val(1);
		$("#basket_table").hide();
		$("#addbasketform").show();
	 	$("label.error").remove();
	}
	
	function closeBasket(){
		$("#basket_table").show();
		$("#addbasketform").hide();
	 	$("label.error").remove();
		
	}

	function deleteBasket(id) {
		$('#operation').val(3);
		$('#basketid').val(id);

		
		var noty_id = noty({
			layout : 'center',
			text: 'Do you want Delete?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Delete', click: function($noty) {
		  
					// this = button element
					// $noty = $noty element
		  			var tenantdata = {};
		        	$('#basketform').serializeArray().map(function(x){tenantdata[x.name] = x.value;});

		            //console.log(tenantdata);
		            var tenantjson = JSON.stringify(tenantdata);
		            //$('#jsondata').val(tenantjson);
		            //console.log(tenantjson);
		            window.location.assign('tonebaskettrn?jsondata='+tenantjson);
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

	function validateBasket(){
		$('#basketform').validate({
	        rules: {
	            postcode: {
	                required: true,
	                minlength: 5,
	                maxlength: 6,
	            },
	            status: {
	            	required: true
	            },
	            year: {
				     required: true,
				     digits: true,
				     minlength: 4,
				     maxlength: 4
				  },
	            eyear: {
				     required: true,
				     digits: true,
				     minlength: 4,
				     maxlength: 4
				  }
	        },
	        messages: {
				firstname: "Enter your firstname"
	        },
	        submitHandler: function(form) {
	        	if($('#operation').val() ==1 ) {
	        		msg ="Do you want Add?";
	        	} else {
	        		msg ="Do you want update?";
	        	}
	        	var noty_id = noty({
			layout : 'center',
			text: msg,
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Update', click: function($noty) {
		  
					var d=new Date();
	        	

				
					
					var transdata = {};
			        	$('#basketform').serializeArray().map(function(x){transdata[x.name] = x.value;});

			            //console.log(transdata);
			            var transjson = JSON.stringify(transdata);
			            //$('#jsondata').val(transjson);
			            //console.log(tenantjson);
			            window.location.assign('tonebaskettrn?jsondata='+transjson)
			            //$('#tenantform').submit();
				
					
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
	    });
	}
</script>
</body>
</html>