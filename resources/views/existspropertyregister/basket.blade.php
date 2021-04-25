<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{__('existspropertyregisyter.Basket')}} </title>
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

		@if ($errors->any())
			<script>
				$(document).ready(function(){
				    $("#usertable").hide();
				 	$("#adduserform").show();
		 			$("#resetpwd").hide();
				});
			</script>
			<div id="err_lbl">
       
            @foreach ($errors->all() as $error)
            	<div>
            		<label for="confirm_password"  generated="true" class="error">{{ $error }}</label>
            	</div>              
            @endforeach
      
    		</div>
			
		@endif

		<!--	
		@if(Session::has('not_msg'))
			@if(Session::get('not_msg') != '')
			<script>
				var message = "{{ Session::get('not_msg')}}";
				$( document ).ready(function() {
        
					var noty_id = noty({
						layout : 'top',
						text: message,
						modal : true,
						type : 'success', 
					});
					{{session(['not_msg' => ''])}}
	        		
   				 });
			</script>
			@endif

		@endif
		-->
		
	<div id="usertable" class="grid_12">
		
		<br>
		<div class="form_input">
			<div id="breadCrumb3"  class="breadCrumb grid_3">
				<ul >
					<li><a href="#">{{__('existspropertyregisyter.Home')}} </a></li>
					<li><a href="#">{{__('existspropertyregisyter.Data_Maintenance')}} </a></li>
					<li>{{__('existspropertyregisyter.Existing_Masterlist_Maintenance')}} </li>
				</ul>
			</div>
			@if(userpermission::checkaccess(321)=="true")
			
			<div style="float:right;margin-right: 10px;">
				<button id="adduser"   onclick="openAddUser()" name="btnadduser" type="button" class="btn_small btn_blue"><span>{{__('existspropertyregisyter.Add_Basket')}}</span></button>
			</div>
			@endif
			<div  style="float:right;margin-right: 20px;">
				<select onchange="getdata()" data-placeholder="Choose a Status..."  style="float: left;" class="cus-select"  id="parambldgcategory" name="parambldgcategory" tabindex="6">
					<option value="0">{{__('existspropertyregisyter.Please_Select_a_Filter')}}...</option>
					<option value="01">{{__('existspropertyregisyter.Property_Registration_Basket')}} </option>
					<option value="03">{{__('existspropertyregisyter.Inspection_Stage_Basket')}} </option>
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
							{{__('existspropertyregisyter.File_Name')}} Basket_Count<span id="bst_count">0</span>
						</div>
					</div>
					<div class="comments_s">
						<div class="block_label">
							Property Count<span>@foreach ($propertycount as $rec)
								{{$rec->propcount}}
							@endforeach	</span>
						</div>
					</div>
					<div style="width: 200px;" class="comments_s">
						<div style="width: 200px;" class="block_label">
							Valuation Property Count<span>@foreach ($valproperty as $rec)
								{{$rec->propcount}}
							@endforeach	</span>
						</div>
					</div>
				</div>
				<br>
				<table id="baskettbl" class="display data_tbl">
					<thead style="text-align: left;">
						<tr>
							<th class="table_sno">{{__('existspropertyregisyter.SNo')}}</th>
							<th>{{__('existspropertyregisyter.Basket_Name')}}</th>
							<th>{{__('existspropertyregisyter.Application_Type')}}</th>
							<th>{{__('existspropertyregisyter.Property_Count')}}</th>
							<th>{{__('existspropertyregisyter.Property_Count_in_Valuation')}}</th>
							<th>{{__('existspropertyregisyter.Pending_Count')}}</th>
							<th>{{__('existspropertyregisyter.Approved_Count')}}</th>
							<th>{{__('existspropertyregisyter.Create_By_At')}}</th>
							<th>{{__('existspropertyregisyter.Update_By_At')}}</th>
							<th>{{__('existspropertyregisyter.Status')}}</th>
							<th>{{__('existspropertyregisyter.Action')}}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($basket as $rec)
						<tr>
							<td>
								{{$loop->iteration}}
							</td>
							<td>
								@if(userpermission::checkaccess(323)=="true")
								<a href="existspropertyregister?pb={{ $rec->basket_id }}">{{ $rec->basketname }}</a>
								@else
								<a href="#">{{ $rec->basketname }}</a>
								@endif
							</td>
							<td>
								{{ $rec->applntype }}
							</td>
							<td>
								{{ $rec->propcount }}
							</td>
							<td>
								{{ $rec->valpropcount }}
							</td>
							<td>
								{{ $rec->pending_count }}
							</td>
							<td>
								{{ $rec->approved_count }}
							</td>
							<td>
								{{ $rec->pb_createby }} -
								{{ $rec->createdate }}
							</td>
							<td>
								{{ $rec->pb_updateby }} -
								{{ $rec->updatedate }}
							</td>
							<td>{{ $rec->tdi_status }}
							</td>
							<td>
								@if($rec->propcount == 0)
								@if(userpermission::checkaccess(321)=="true")
								<span><a class="action-icons c-delete delete_BASKET" onclick="deleteBasket('{{ $rec->basket_id }}')" href="#" title="Delete">{{__('common.Delete')}} </a></span>
								@endif
								@elseif($rec->propcount == $rec->approved_count && $rec->PB_APPROVALSTATUS_ID == '02')
								@if(userpermission::checkaccess(324)=="true")
								<span><a class="action-icons c-approve" onclick="approveProperty('{{ $rec->basket_id }}')" title="Approve For Inspection" href="#">{{__('existspropertyregisyter.Approve')}} </a></span>
								@endif
								@endif
								@if(userpermission::checkaccess(322)=="true")
								<span><a class="action-icons c-edit edtlotrow" onclick="openEdit('{{ $rec->basket_id }}')" href="#" title="Edit">{{__('common.Edit')}} </a></span>
								@endif
							</td>
						</tr>
						<div style="display: none;">
							<input type="text" id="name_{{ $rec->basket_id }}" value="{{ $rec->basketname }}">
							<input type="text" id="type_{{ $rec->basket_id }}" value="{{ $rec->pb_applicationtype_id }}">
						</div>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
		
		<div id="adduserform" style="display:none" class="grid_10 full_block">
			<div class="widget_wrap">
				<div class="widget_content">
					<h3 id="title">{{__('existspropertyregisyter.Add_Basket')}} Add Basket</h3>
					<form id="usertransform"  autocomplete="off" class="" method="post" action="exsitspropertybaskettrn" >
						@csrf
						<input type="hidden" name="basket_id" id="basket_id" value="0">
						<input type="hidden" name="operation" id="operation" value="0">
						<input type="hidden" name="basket_type" id="basket_type" value="2">
						<div  class="grid_6 form_container left_label">
							<ul>
								<li>								
									<div class="form_grid_12">									
										<label class="field_title" id="luserid" for="userid">{{__('existspropertyregisyter.Basket_Name')}} <span class="req">*</span></label>
										<div class="form_input">
											<input id="basket" name="basket" type="text"  value="{{ old('basket') }}" />
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">									
										<label class="field_title" id="luserid" for="userid">{{__('existspropertyregisyter.Application_Type')}} <span class="req">*</span></label>
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
								
								</li>
							</ul>
						</div>
						
						<div style="height: 48px; float: none; display: -webkit-box;text-align: -webkit-center;" class="grid_12">
							
							<div class="form_input">
								<button id="addsubmit" name="adduser" type="submit" class="btn_small btn_blue"><span>{{__('common.Submit')}} </span></button>			
														
								<button id="close" onclick="closeAddUser()" name="close" type="button" class="btn_small btn_blue"><span>{{__('common.Close')}}</span></button>
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
		var param = $('#parambldgcategory').val();
		if (param != '0') {
			window.location.assign('propertybasket?param='+param);
		}
		//window.location.assign('propertybasket?param='+zone);
		//return;
	}
	function openAddUser(){
		//$('#addsubmit').removeAttr('disabled');
		$("#operation").val(1);
		$("#usertable").hide();
		$("#adduserform").show();
		$("#addsubmit").html("Save");
	 	$("label.error").remove();	
	}
	function closeAddUser(){
		//$('#addsubmit').removeAttr('disabled');
		$("#operation").val(1);
		$("#usertable").show();
		$("#adduserform").hide();
	 	$('#err_lbl').html('');
	 	$("label.error").remove();
	}

	function openEdit(id) {
		$("#addsubmit").html("Update");	
		$("#title").html("Update Baskets");	
		$("#basket").val($("#name_"+id).val());
		$("#applicationtype").val($("#type_"+id).val());
		$("#basket_id").val(id);

		$("#operation").val(2);
		$("#usertable").hide();
		$("#adduserform").show();	
	 	$("label.error").remove();
	}

	function approveProperty(id){
		var noty_id = noty({
				layout : 'center',
				text: 'Are want to approve properties?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Approve', click: function($noty) {
						$noty.close();
						$.ajax({
			  				type: 'GET', 
						    url:'approve',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{param_value:id,module:'BASKETAP'},
					        success:function(data){
					        	window.location.assign('propertybasket');					        		
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

	function deleteBasket(id){
		var noty_id = noty({
				layout : 'center',
				text: 'Are want to Delete Basket?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Delete', click: function($noty) {
						$noty.close();
						$('#basket_id').val(id);
						$('#operation').val(3);
						$('#usertransform').submit();
						/*$.ajax({
			  				type: 'GET', 
						    url:'approve',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{param_value:id},
					        success:function(data){
					        				        		
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

	$(document).ready(function(){
		var count = $('#baskettbl').DataTable().rows().count();
		$('#bst_count').html(count);
		$('#parambldgcategory').val('{{$stage}}');
	});
</script>

</div>
</body>
</html>