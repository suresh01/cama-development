<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('outer.Code_Maintenance')}}</title>
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
		
		<div id="usertable" class="grid_12">	
			<br>
			
			<div class="form_input">
				<button id="adduser"  style="float:right;" onclick="openAddUser()" name="btnadduser" type="button" class="btn_small btn_blue"><span>{{__('outer.Add_Parameter')}}</span></button>
					

				<div id="breadCrumb3" class="breadCrumb grid_3">
					<ul >
						<li><a href="#">{{__('outer.Home')}}</a></li>
						<li><a href="#">{{__('outer.Data_Maintenance')}}</a></li>
						<li>{{__('outer.Code_Maintenance')}} </li>
					</ul>
				</div>
				<br>
			</div>

		
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table class="display data_tbl">
					<thead style="text-align: left;">
			  		<tr>
							<th class="table_sno">{{__('outer.SNO')}}  </th>
							<th> {{__('outer.Parameter_Name')}} </th>
							<th> {{__('outer.Parameter_Parent')}} </th>
							<th> {{__('outer.Parameter_Description')}} </th>
							<th> {{__('outer.Parameter_Child')}} </th>
							<th> {{__('outer.Parameter_Items')}} </th>
							<th> {{__('outer.Action')}} </th>
						</tr>
						</thead>
						<tbody>
							@foreach ($codemaintenance as $rec)
						<tr >
							<td>
								{{$loop->iteration}}
							</td>
							<td>
								<a onclick="isUrlAllowed(3112,'codemaintenancedetail?name={{ $rec->pd_name }}')" href="#">{{ $rec->pd_name }}</a>
							</td>
							<td>
								 {{ $rec->pd_parent }}
							</td>
							<td>
								 {{ $rec->pd_desc }}
							</td>
							<td >
								 {{ $rec->childcount }}
							</td>
							<td >
								 {{ $rec->itemcount }}
							</td>
							<td class="">
								<span><a class="action-icons c-edit" href="#" onclick="openEdit('{{ $rec->pd_name }}')" title="{{__('common.Edit')}}">{{__('common.Edit')}}</a></span>
								<span><a class="action-icons c-Delete " onclick="deletecode('{{ $rec->pd_name }}')" href="#" title="{{__('common.Delete')}}">{{__('common.Delete')}}</a></span>
							</td>
						</tr>
						<div style="display:none">
							<input type="hidden" id="eparent_{{ $rec->pd_name }}" value="{{ $rec->pd_parent }}">
							<input type="hidden" id="edesc_{{ $rec->pd_name }}" value="{{ $rec->pd_desc }}">
							<input type="hidden" id="elenght_{{ $rec->pd_name }}" value="{{ $rec->pd_tdi_value_lenght }}">
							<input type="hidden" id="esearchmod_{{ $rec->pd_name }}" value="{{ $rec->pd_search_mod }}">
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
					<h3 id="title">{{__('outer.Add_Parameter')}} </h3>
					<form id="usertransform" autocomplete="off" method="post" action="codeMaintenancetrn" >
						@csrf
							<input type="hidden" name="operation" id="operation">
						<div  class="grid_6 form_container left_label">
							<ul>
								<li>								
									<div class="form_grid_12">									
										<label class="field_title" id="luserid" for="userid">{{__('outer.Parameter_Name')}} <span class="req">*</span></label>
										<div class="form_input">
											<input id="parametername" onchange="checkusername()" name="pd_name" type="text"  value="{{ old('pd_name') }}" />
										</div>
										<span class=" label_intro"></span>
									</div>
									
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('outer.Parameter_Parent')}} <span class="req">*</span></label>
										<div class="form_input ">
											<select style="width: 100%;" data-placeholder="Choose a Role..." class="cus-select" id="parent" name="pd_parent" tabindex="20">
											<option value="Root">Root</option>
											@foreach ($codemaintenance as $rec)
											@if($rec->pd_parent == 'Root' )	
												<option value="{{ $rec->pd_name }}"> {{ $rec->pd_name }}  </option>
											@endif
											@foreach ($codemaintenance as $sub_rec)
												@if($rec->pd_name == $sub_rec->pd_parent && $rec->pd_parent == 'Root')	
														<option value="{{ $sub_rec->pd_name }}">  {{ $rec->pd_name }} ->{{ $sub_rec->pd_name }}   </option>							
												@endif
												@foreach ($codemaintenance as $sub_sub_rec)
													@if($rec->pd_name == $sub_rec->pd_parent && $sub_rec->pd_name == $sub_sub_rec->pd_parent && $rec->pd_parent == 'Root')
														<option value="{{ $sub_sub_rec->pd_name }}">  {{ $rec->pd_name }} ->{{ $sub_rec->pd_name }}-> {{ $sub_sub_rec->pd_name }}   </option>	
													@endif
														
												@endforeach											
											@endforeach
										@endforeach									
											</select>
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('outer.Search_Module')}} <span class="req">*</span></label>
										<div class="form_input ">
											<select style="width: 100%;" data-placeholder="Choose a Role..." class="cus-select" id="searchmodule" name="search_module" tabindex="20">
												@foreach ($searchmodule as $rec)
													<option value="{{ $rec->se_id }}"> {{ $rec->se_name }}  </option>
												@endforeach									
											</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									
									<div class="form_grid_12">
										<label class="field_title" id="lfname" for="fname">{{__('outer.Parameter_Description')}} <span class="req">*</span></label>
										<div class="form_input">
											<input id="desc" name="pd_desc" type="text" value="{{ old('pd_desc') }}" />
										</div>
										<span class=" label_intro"></span>
									</div>
									
									<div class="form_grid_12">
										<label class="field_title" id="llname" for="lname">{{__('outer.Parameter_value_lenght')}} <span class="req">*</span></label>
										<div class="form_input">
											<input id="lenght" name="pd_lenght" type="text" value="{{ old('pd_lenght') }}" />
										</div>
										<span class=" label_intro"></span>
									</div>
									
								</li>
							</ul>
						</div>
						
						<div style="height: 48px; float: none; display: -webkit-box;text-align: -webkit-center;" class="grid_12">
							
									<div class="form_input">
										<input type="button" id="addsubmit" onclick="checkParameter();" class="btn_small btn_blue" value="Submit">				
																
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
	<!--<div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Tutorials
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a tabindex="-1" href="#">HTML</a></li>
      <li><a tabindex="-1" href="#">CSS</a></li>
      <li class="dropdown-submenu">
        <a class="test" tabindex="-1" href="#">New dropdown <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
          <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
          <li class="dropdown-submenu">
            <a class="test" href="#">Another dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">3rd level dropdown</a></li>
              <li><a href="#">3rd level dropdown</a></li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </div>-->
	<script>
	function changeText(){
		//sss$("#addsubmit").text("Submitting...");
	}

	function deletecode(id){
		if(isAccessAllowed(3114)){
			$("#parametername").val(id);
			$("#operation").val(3);
			$("#lenght").val(0);
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

	function openAddUser(){
		if(isAccessAllowed(3111)){
			$("#title").html("Add Parameter");
			$('#addsubmit').removeAttr('disabled');		
			$('#parametername').removeAttr('readonly');
			$("#parametername").val("");
			$("#parent").val("");
			$("#desc").val("");
			$("#lenght").val("");
			$("#operation").val(1);
			$("#usertable").hide();
			$("#adduserform").show();
			$("#resetpwd").hide();
			$("#addsubmit").html("Save");
		 	$("label.error").remove();	
		}

	}
	function closeAddUser(){
		$('#addsubmit').removeAttr('disabled');		
		$('#parametername').removeAttr('readonly');
		$("#parametername").val("");
		$("#parent").val("");
		$("#searchmodule").val("");
		$("#desc").val("");
		$("#lenght").val("");
		$("#operation").val(1);
		$("#usertable").show();
		$("#adduserform").hide();
	 	$('#err_lbl').html('');
	 	$("label.error").remove();
	}

	function openEdit(id) {
		if(isAccessAllowed(3113)){
			$("#addsubmit").html("Update");	
			$("#title").html("Update Parameter");	

			$('#parametername').attr('readonly', "readonly");
			$("#parametername").val(id);
			$("#parent").val($("#eparent_"+id).val());
			$("#desc").val($("#edesc_"+id).val());
			$("#lenght").val($("#elenght_"+id).val());
			$("#searchmodule").val($("#esearchmod_"+id).val());



			
			$("#operation").val(2);
			$("#usertable").hide();
			$("#adduserform").show();	
		 	$('#err_lbl').html('');
		 	$("label.error").remove();	
		}
	}

	function checkParameter(){
		var operation = $("#operation").val();
		if(operation == 2) {
			$("#usertransform").submit();
		} else {
			var d=new Date();		
			var parameter = $("#parametername").val();
	        $.ajax({
		        type:'GET',
		        url:'getParameter?date='+ d.getTime(),
		        data:{parameter:parameter},
		        success:function(data){	        	
		        	if(data.msg === "false"){
		        		alert("Parameter already exsist.");
		        		$("#parametername").focus();
		        		return false;
		        	} else {
		        		$("#usertransform").submit();
		        		return true;
		        	}		        	
	        	}
		    });
		    return true;
	    }	    
	}
	/*$(document).ready(function() {
            //option A
            $("#usertransform").submit(function(e){
               e.preventDefault(e);
               var d=new Date();		
				var parameter = $("#parametername").val();
		        $.ajax({
			        type:'GET',
			        url:'getParameter?date='+ d.getTime(),
			        data:{parameter:parameter},
			        success:function(data){	        	
			        	if(data.msg === "false"){
			        		alert("Parameter already exsist.");
			        		$("#parametername").focus();
			        		 
			        		return false;
			        	} 
			        	$("#usertransform").submit();
			        	return true;
		        	}
			    });
               
            });
        });*/
</script>
</div>
</body>
</html>