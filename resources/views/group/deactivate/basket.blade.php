<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Basket</title>
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
	<div onload="setFilter()" id="content">
		<div class="grid_container">
			<script>

				$(document).ready(function(){
					$('#paramterm').val('{{$param}}');
				});
					

			</script>
			<div id="grouptable" class="grid_12">
	
				<br>
				<div class="form_input">
					

					<div id="breadCrumb3"  class="breadCrumb grid_3">
						<ul >
							<li><a href="#">Home</a></li>
							<li><a href="#">Valuation Process</a></li>
							<li>Deactivate Property</li>
						</ul>
					</div>
					<button id="adduser" style="float:right;margin-right: 10px;" onclick="newGroup()" name="btnadduser" type="button" class="btn_small btn_blue"><span>Add Basket</span></button>
					
					<div  style="float:right;margin-right: 20px;">		
							<select onchange="getdata()" data-placeholder="Choose a Status..."  style="float: left;" class="cus-select"  id="paramterm" name="paramterm" tabindex="6">
								<option value="0">Please Select a Filter...</option>
								<option value="All">All Basket</option>
								@foreach ($termfilter as $rec)
									<option value='{{ $rec->termid }}'>( {{ $rec->applntype }} ) {{ $rec->term }} - {{ $rec->termstage }}</option>
								@endforeach	
							</select>	
						<span class="clear"></span>
					</div>
					<br>
				</div>		
				<div class="widget_wrap">					
					<div class="widget_content">	
										
						<table id="baskttable" class="display tbl_details">
							<thead style="text-align: left;">
			  					<tr>
									<th class="table_sno">
										S No
									</th>
									<th>
										Basket Name
									</th>
									<th>
										Term Type
									</th>
									<th>
										Term Name
									</th>
									<th>
										Update By 
									</th>
									<th>
										Update At
									</th>
									<th>
										Create By
									</th>
									<th>
										Create At
									</th>
									<th>
										Property Count
									</th>
									<th>
										Action
									</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($group as $rec)
								<tr>
									<td>
										{{$loop->iteration}}
									</td>
									<td>
										<a href="deactiveproperty?id={{$rec->da_id}}&param={{$param}}">{{$rec->da_name}}</a>
									</td>
									<td>
										{{$rec->tdi_value}}
									</td>
									<td>
										{{$rec->vt_name}}
									</td>
									<td>
										{{$rec->da_updateby}}
									</td>
									<td>
										{{$rec->da_updateddate}}
									</td>
									<td>
										{{$rec->da_createdby}}
									</td>
									<td>
										{{$rec->da_createddate}}
									</td>
									<td>{{$rec->porpcount}}										
									</td>
									<td>
										@if($rec->porpcount == 0)
											<span><a class="action-icons c-delete delete_term"  onclick="delProperty('{{$rec->da_id}}')" disabled="true" title="Delete Basket" href="#"></a></span>										
										@endif
										@if($rec->da_approved == '01')
										<spane><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approveValuation('{{$rec->da_id}}')" disabled="true" title="Approve Deletion" href="#"></a></span>									
										@endif
										<spane><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -822px -121px !important;display: inline-block; float: left;" onclick="editGroup('{{ $rec->da_id }}')" disabled="true" title="Edit Basket" href="#"></a></span>
										<!--<span><a class="action-icons c-edit " onclick="editGroup('{{ $rec->da_id }}')" href="#" title="Edit">Edit</a></span>-->
										
									</td>
								</tr>
								<div style="display: none;">
									<input type="text" id="name_{{ $rec->da_id }}" value="{{ $rec->da_name }}">
									<input type="text" id="term_{{ $rec->da_id }}" value="{{ $rec->da_vt_id }}">
								</div>
								@endforeach						
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div id="basic-modal-content">
				<h3>Valuation Detail</h3>
				<form action="validateValuation" id="valuationcheckform" method="post" class="form_container">	
					@csrf
				<input type="hidden" name="filter" value="true">			
					<ul id="filterrow">		
						<li class="li">
							<div class="form_grid_12 multiline">
								<div class="form_input">
									<div class="form_grid_6">
										<select data-placeholder="Choose a Custom..." style="width:100%" class="cus-select field" id="tonebasket_id" name="tonebasket_id" tabindex="20">
											<option value="0">Please select TOL</option>
											@foreach ($tonebasket as $rec)
											<option value="{{ $rec->tollist_id }}">{{ $rec->tonebasket }}</option>
											@endforeach
										</select>
										<input type="hidden" value="" name="valuatuion_id" id="valuatuion_id">
									</div>
									<span class="clear"></span>
								</div>
							</div>
						</li>		
						<li class="li">
							<div class="form_grid_12 multiline">
								<div class="form_input">
									<div class="form_grid_6">
										<select data-placeholder="Choose a Custom..." style="width:100%" class="cus-select field" id="tonetaxbasket_id" name="tonetaxbasket_id" tabindex="20">
											<option value="0">Please select TOL Tax Basket</option>
											@foreach ($tonetaxbasket as $rec)
											<option value="{{ $rec->trlist_id }}">{{ $rec->tonetaxbasket }}</option>
											@endforeach
										</select>
									</div>
									<span class="clear"></span>
								</div>
							</div>
						</li>
					</ul>
					
					<div class="btn_24_blue">						
						<!--<button id="addsubmit"type="submit" class="btn_small btn_blue"><span>Submit</span></button>	-->
						<a href="#" onclick="submitValuationCheck()" class=""><span>Validate Data </span></a>	
					</div>
					<div class="btn_24_blue">
						<a href="#" class="simplemodal-close"><span>Close </span></a>
					</div>
					</form>
			</div>
				
		
			<div id="addgroup" style="display:none" class="grid_10 full_block">
				<div class="widget_wrap">
					<div class="widget_content">
						<h3 id="title">Add Basket</h3>
						<form id="addgroupfrom"  autocomplete="off" class="" method="post" action="#" >
							@csrf
							<input type="hidden" name="id" id="id" value="0">
							<input type="hidden" name="operation" id="operation" value="0">
							<div  class="grid_12 form_container left_label">
								<ul>
									<li>								
										<div class="form_grid_12">									
											<label class="field_title" id="termname" for="termid">Term Name<span class="req">*</span></label>
											<div class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="termid" name="termid" tabindex="20">
													<option></option>
													@foreach ($term as $rec)
														<option value='{{ $rec->termid }}'>( {{ $rec->applntype }} ) {{ $rec->term }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>								
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">Basket Name<span class="req">*</span></label>
											<div class="form_input">
												<input id="name" required="true"  name="name" type="text"  value="{{ old('term') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>										
									</li>
								</ul>
							</div>
							
							<div style="height: 48px; float: none; display: -webkit-box;text-align: -webkit-center;" class="grid_12">
								
								<div class="form_input">
									<button id="addsubmit" name="adduser" type="submit" onclick="validateGroup()" class="btn_small btn_blue"><span>Submit</span></button>			
														
									<button id="close" onclick="closeGroup()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>
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

		function approveValuation(id){
			var noty_id = noty({
				layout : 'center',
				text: 'Are want to approve ?',
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
					        data:{param_value:id,module:'APDB'},
					        success:function(data){
					        	
						        	var noty_id = noty({
										layout : 'top',
										text: 'Basket Approved!',
										modal : true,
										type : 'success', 
									});	
									//window.location.assign("group");	
									        		
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

		function getdata(){
			//$('#paramterm').val('{{$param}}');
			var param = $('#paramterm').val();
			if (param != '0') {
				window.location.assign('deactive?param='+param+'&ts=1');
			}
			//window.location.assign('propertybasket?param='+zone);
			//return;
		}


		function startValuation(id){
		//	alert();
			//$('.basic-modal-c').click(function (e) {v
		$('#basic-modal-content').modal();

	//	return false;
	//});
			$('#valuatuion_id').val(id);
		}

		function newGroup(){
			$("#operation").val(1);
			$("#grouptable").hide();
			$("#addgroup").show();
			$("#addsubmit").html("Save");
		 	$("label.error").remove();	
		}

		function editGroup(id){
			$("#id").val(id);
			$("#termid").val($("#term_"+id).val());
			$("#name").val($("#name_"+id).val());
			$("#operation").val(2);
			$("#grouptable").hide();
			$("#addgroup").show();

			$("#addsubmit").html("Save");
		 	$("label.error").remove();	
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

		function submitValuationCheck(){
			if($('#tonebasket_id').val() === 0 || $('#tonetaxbasket_id').val() === 0){
				
				alert('Please select Basket');
			} else {
				$('#valuationcheckform').submit();
			}
			
		}

		function delProperty(id){
			
			var noty_id = noty({
				layout : 'center',
				text: 'Are want to delete Basket?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Delete', click: function($noty) {
						$noty.close();
						$("#operation").val(3);
						$("#termid").val(0);
						$("#id").val(id);
						var groupdata = {};
						$('#addgroupfrom').serializeArray().map(function(x){groupdata[x.name] = x.value;});

		            	var groupjson = JSON.stringify(groupdata);
						window.location.assign('groupdeactivetrn?jsondata='+groupjson+'&param={{$param}}');	      
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
		            window.location.assign('groupdeactivetrn?jsondata='+groupjson+'&param={{$param}}');	        	
		        }
		    });
		}

		function approveProperty(id){
			var noty_id = noty({
				layout : 'center',
				text: 'Are want to approve properties?',
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
					        data:{param_value:id,module:'valuation'},
					        success:function(data){
					        	var count = data.propertycnt;
					        	if (count === 0 ) {
						        	var noty_id = noty({
										layout : 'top',
										text: 'Basket Approved!',
										modal : true,
										type : 'success', 
									});	
									window.location.assign("group?param={{$param}}");	
								} else {
									alert('Please submit inspection for all the property!');
								}		        		
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

		
		function resetValuation(id){
			var noty_id = noty({
				layout : 'center',
				text: 'Are want to Clear Valution?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Yes', click: function($noty) {
						$noty.close();
						$.ajax({
			  				type: 'GET', 
						    url:'clearValuation',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{id:id},
					        success:function(data){
					        	
						        	var noty_id = noty({
										layout : 'top',
										text: 'Valuation cleared!',
										modal : true,
										type : 'success', 
									});	
									 window.location.assign("group");	
									        		
					        	//$("#finish").attr("disabled", true);
					        	//clearTableError(4);
				        	},
					        error:function(data){
								//$('#loader').css('display','none');	
					        	$('#finishloader').html('');     	
					        		var noty_id = noty({
									layout : 'top',
									text: 'Problem while clear property!',
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

	
		

		$(document).ready(function(){
			//$('#paramterm').val('{{$param}}');
			var count = $('#baskttable').DataTable().rows().count();
			$('#bst_count').html(count);
		});
	</script>

</div>
</body>
</html>