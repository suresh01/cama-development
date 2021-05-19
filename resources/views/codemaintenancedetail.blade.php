<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('outer.Code_Maintenance')}} </title>
@include('includes.header', ['page' => 'datamaintenance'])
	
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

		<div id="usertable" class="grid_12">
			
			<br>
			<div class="form_input">
				

				<div id="breadCrumb3" class="breadCrumb grid_4">
					<ul >
						<li><a href="#">{{__('outer.Home')}} </a></li>
						<li><a href="#">{{__('outer.Data_Maintenance')}} </a></li>
						<li><a href="codemaintenance">{{__('outer.Code_Maintenance')}} </a></li>
						@foreach ($isparent as $rec)
							@if($rec->pd_parent != 'Root' )	
								<li><a href="codemaintenancedetail?name={{$rec->pd_parent}}">{{$rec->pd_parent}} - 
								@if($id != '')
									{{$id}} 
								@else
									All
								@endif</a></li>
							@endif
						@endforeach
						<li>{{$name}}</li>
					</ul>
				</div>

				<button id="adduser" style="float:right;" onclick="openAddUser()" name="btnadduser" type="button" class="btn_small btn_blue"><span>{{__('outer.Add_Parameter_Detail')}}</span></button>

				@include('search.sample')
				<br>
			</div>
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table class="display data_tbl">
						<thead style="text-align: left;">
						<tr>
							<th class="table_sno">
								{{__('outer.SNO')}} 
							</th>
							@foreach ($isparent as $rec)
							@if($rec->pd_parent != 'Root' )	
							<th>
								{{__('outer.Parent_Parameter_Key')}} 
							</th>
							<th>
								{{__('outer.Parent_Parameter_Velue')}} 
							</th>
							@endif
							@endforeach
							<th>
								{{__('outer.Parameter_Key')}} 
							</th>
							<th>
								{{__('outer.Parameter_Value')}} 	
							</th>
							<th>
								{{__('outer.Parameter_Description')}} 	
							</th>
							<th>
								{{__('outer.Sort')}} 	
							</th>
							<th>
								{{__('outer.Update_by')}} 
							</th>
							<!--<th>
								Update at
							</th>-->	
							<th>
								{{__('outer.Action')}} 
							</th>
						</tr> 
						</thead>
						<tbody>
							@foreach ($codedetail as $rec)
							<tr>
								<td>
									{{$loop->iteration}}
								</td>
								@foreach ($isparent as $rec1)
								@if($rec1->pd_parent != 'Root' )	
								<td>
									{{ $rec->tdi_parent_key }}
								</td>
								<td>
									{{ $rec->tdi_parent_name }}
								</td>
								@endif
								
								@endforeach
								<td>
									{{ $rec->tdi_key }}
								</td>
								<td>
									@if($rec->childcount != 0 )
										@if($rec->tdi_td_name == 'BULDINGCATEGORY' )
											<a onclick="multilevel('{{$name}}','{{ $rec->tdi_key }}')" href='#'>{{ $rec->tdi_value }}</a>
										@else
											<a href='codemaintenancedetail?name={{$name}}&id={{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</a>
										@endif
									@else
										{{ $rec->tdi_value }}
									@endif
								</td>
								<td>
									{{ $rec->tdi_desc }}
								</td>
								<td>
									{{ $rec->tdi_sort }}
								</td>
								<td>
									{{ $rec->tdi_updateby }}
								</td>
								<!--<td>
									{{ $rec->tdi_updateat }}
								</td>	-->
								<td>
									<span><a class="action-icons c-edit" onclick="openEditDetail('{{ $rec->tdi_key }}')" href="#" title="{{__('common.Edit')}}">{{__('common.Edit')}}</a></span>
									<span><a class="action-icons c-Delete " onclick="deleteSdt('{{ $rec->tdi_key }}')" href="#" title="{{__('common.Delete')}}">{{__('common.Delete')}}</a></span>
								</td>
							</tr>
							<div style="display:none;">
							<input type="hidden" id="evalue_{{ $rec->tdi_key }}" value="{{ $rec->tdi_value }}">
							<input type="hidden" id="edesc_{{ $rec->tdi_key }}" value="{{ $rec->tdi_desc }}">
							<input type="hidden" id="esort_{{ $rec->tdi_key }}" value="{{ $rec->tdi_sort }}">	
							<input type="hidden" id="eparent_{{ $rec->tdi_key }}" value="{{ $rec->tdi_parent_key }}">								
							</div>
							@endforeach
						</tbody>
						</table>
					</div>
				</div>
			</div>		
		
		<div id="adduserform" style="display:none;" class="grid_10">
			<div class="widget_wrap">
				<div class="widget_content">
					<h3 id="title">{{__('outer.Add_Parameter')}}</h3>
					<form id="usertransform" autocomplete="off" method="post" action="codemaintenancedetail?name={{ $name }}&id={{ $id }}" class="">
						<div  class="grid_6 form_container left_label">
						<ul>
							<li>
								@csrf
								<input type="hidden" value="1" name="operation" id="operation">
								<input type="hidden" name="name" id="name" value="{{ $name }}">
								<input type="hidden" name="transaction" id="transaction" value="proc">


								<div class="form_grid_12">
									<label class="field_title" id="lkey_name" for="key_name">{{__('outer.Parameter_Key')}}<!--<span class="req">*</span>--></label>
									<div class="form_input">
										<input id="parameterkey" placeholder="Last Used Code : {{$lastcode}}" name="parameterkey" type="text" value="" maxlength="100" >
									</div>
									<span class=" label_intro"></span>
								</div>							
								
								<div class="form_grid_12">
									<label class="field_title" id="lkey_type" for="key_type">{{__('outer.Parameter_Value')}}</label>
									<div class="form_input">
										<input id="parametervalue" name="parametervalue" type="text" value="" maxlength="50" />
									</div>
									<span class=" label_intro"></span>
								</div>	
								@foreach ($isparent as $rec)
								@if($rec->pd_parent != 'Root' )	
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('outer.Parameter_Parent')}} <span class="req">*</span></label>
										<div class="form_input ">
											<select style="width: 100%;" onchange="getLastCode(this.value)" data-placeholder="Choose a Parent..." disabled="" class="cus-select" id="parent" name="parent" tabindex="20">
											@foreach ($childparent as $rec)
												<option value="{{ $rec->tdi_key }}">{{ $rec->tdi_key }}-{{ $rec->tdi_value }}</option>	
											@endforeach									
											</select>
										</div>
										<span class=" label_intro"></span>
									</div>
								@endif
								@endforeach								
								<div class="form_grid_12">
									<label class="field_title" id="ltable_name" for="table_name">{{__('outer.Parameter_Description')}} </label>
									<div class="form_input">
										<input id="desc" name="desc" type="text" value="" maxlength="50" />
									</div>
									<span class=" label_intro"></span>
								</div>
								
								<div class="form_grid_12">
									<label class="field_title" id="lbltable_field_name" for="table_field_name">{{__('outer.Sort_Order')}} </label>
									<div class="form_input">
										<input id="sort" name="sort" type="text" value="0" maxlength="50" />
									</div>
									<span class=" label_intro"></span>
								</div>
							</li>
						</ul>
					</div>
					<div style="height: 48px; float: none; display: -webkit-box;text-align: -webkit-center;" class="grid_12">
					
						<div class="form_input">
							<input type="button" id="addsubmit" onclick="checkSubmission();" class="btn_small btn_blue" value="Submit">				
																							
							<button id="close" onclick="closeAddUser()" name="close" type="button" class="btn_small btn_blue"><span>{{__('common.Close')}} </span></button>
						</div>
					</div>
							
					</form>
				</div>
			</div>
		</div>
	
	</div>


	<div style="display: none;height: 160px;"  id="open-modal-content-child">
		<h3>{{__('outer.Select_Child')}}</h3>
		<form action="#" id="codemaintenancedetail" method="get" class="form_container">	
			@csrf		
			<ul id="filterrow">		
				<li class="li">
					<div class="form_grid_12 multiline">
						<div class="form_input">
							<div class="form_grid_6">
								<select data-placeholder="Choose a Custom..." style="width:100%" class="cus-select field" id="child" name="child" tabindex="20">
									<option value="#">{{__('outer.Please_select_Child')}}</option>
									<option value="AREALEVEL">{{__('outer.Arealevel')}}</option>				
									<option value="AREAUSE">{{__('outer.Areause')}}</option>	
									<option value="BUILDINGSTOREY">{{__('outer.Buildingstorey')}}</option>				
									<option value="BULDINGTYPE">{{__('outer.Buldingtype')}}</option>						
								</select>
							</div>
							<span class="clear"></span>
							<input type="hidden" name="child_id"  id="child_id">
						</div>
					</div>
				</li>
			</ul>
			
			<div class="btn_24_blue">
				<a href="#" onclick="childSelect()" ><span>{{__('common.Submit')}}</span></a>
				<a href="#" class="simplemodal-close"><span>{{__('common.Close')}} </span></a>
			</div>
			</form>
	</div>
	<span class="clear"></span>	
	
</div>

<script>
	function checkKey(){
		return true;
	}

	function getLastCode(val){
		$.ajax({
	        type:'GET',
	        url:'getLastCode',
	        data:{param:val,name:'{{$name}}'},
	        success:function(data){	  
	       // alert(data.lastcode); 
	        	$('#parameterkey').attr('placeholder',"Last Used Code : "+data.lastcode);
	        
	        	
	        	
        	}
    	});
	}

	function openAddUser(){
		if(isAccessAllowed(31121)){
			$('#parent').val('{{$id}}');
			$('#parameterkey').removeAttr('readonly');
			$("#parameterkey").val("");
			$("#parametervalue").val("");
			$("#title").html("Add Parameter");
			$("#desc").val("");
			$("#sort").val("");
			$("#title").html("Add");
			$("#addsubmit").html("Save");
		 	$("label.error").remove();	
			$("#operation").val(1);
			$("#usertable").hide();
			$("#adduserform").show();
			if('{{$id}}' == ''){
				$('#parent').removeAttr('disabled');
			}
		}

	}



	function childSelect(){
		//var url = $('#stage').val();
		var name = $('#child').val();
		var id = $('#child_id').val();
		
		window.location.assign("codemaintenancedetail?name="+name+"&id="+id);
		
		
	}

	function multilevel(name, id){
		$('#child').val(name);
		$('#child_id').val(id);
		$('#open-modal-content-child').modal();
	}

	function closeAddUser(){
		$("#parametervalue").val("");
		$("#parent").val("");
		$("#desc").val("");
		$("#sort").val("");
	 	$("#usertable").show();
	 	$("#adduserform").hide();
	}

	function openEditDetail(id){
		if(isAccessAllowed(31123)){
			$('#parameterkey').attr('readonly', "readonly");
			$("#title").html("Update Parameter");
			$("#parameterkey").val(id);
			$("#parametervalue").val($("#evalue_"+id).val());
			$("#parent").val($("#eparent_"+id).val());
			$("#desc").val($("#edesc_"+id).val());
			$("#sort").val($("#esort_"+id).val());
			$("#title").html("Update");
			$("#addsubmit").html("Update");
		 	$("label.error").remove();	
			$("#operation").val(2);
			$("#usertable").hide();
			$("#adduserform").show();	
		}	
	}

	function deleteSdt(id){
		if(isAccessAllowed(31124)){
			$("#operation").val(3);
			$("#parameterkey").val(id);

			var noty_id = noty({
				layout : 'center',
				text: 'Do you want Delete?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Delete', click: function($noty) {
			  
						// this = button element
						// $noty = $noty element
			  			
			  			$("#usertransform").submit();
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
	}

	function lastusedkey(){

    	//console.log(this.value);
    	var param_value = this.value;
    	var param = 'bldgtype';
        $.ajax({
		  url: "subCategory",
		  cache: false,
		  data:{param_value:param_value,param:param},
		  success: function(data){
    		createDropDownOptions(data.res_arr, 'bldgttype');
    		createDropDownOptions(data.res_arr2, 'bldgstorey');
		  }
		});
	   
	}

	function checkSubmission(){

		var length = 0;
		var d=new Date();
		var paramkey = $("#parameterkey").val();
		var paramkeylength = paramkey.length;
		var param = "{{ $name }}";
		var operation = $("#operation").val();
		if(operation == 2) {
			$("#parent").removeAttr( "disabled");   
			$("#usertransform").submit();
		} else {
			@foreach ($isparent as $rec)
				length = "{{$rec -> length }}"; 
			@endforeach
			//alert(parent);
			if(paramkeylength != length){
				alert("Please enter "+length+" digit parameter key ");
			    $("#parameterkey").focus();
			} else {
				$.ajax({
			        type:'GET',
			        url:'getChildParameter?date='+ d.getTime(),
			        data:{paramkey:paramkey,param:param},
			        success:function(data){	        	
			        	if(data.msg === "false"){
			        		alert("Parameter Key already exsist.");
			        		$("#parameterkey").focus();
			        		return false;
			        	} else {			        		
      						$("#parent").removeAttr( "disabled");   
			        		$("#usertransform").submit();
			        		return true;
			        	}
			        	
		        	}
		    	});
			}
		}
	}

	function disableF5(e) { if ((e.which || e.keyCode) == 116 ) e.preventDefault(); };

	$(document).ready(function(){
		$(document).on("keydown", disableF5);
		$('#parent').val('{{$id}}');
		//$('#parent').readonly();

	});
</script>
</body>
</html>