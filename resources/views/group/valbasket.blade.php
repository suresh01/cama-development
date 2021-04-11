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
			
			<div id="grouptable" class="grid_12">
	
				<br>
				<div class="form_input">
					

					<div id="breadCrumb3"  class="breadCrumb grid_3">
						<ul >
							<li><a href="#">Home</a></li>
							<li><a href="valterm">Valuation Data Management</a></li>
							<li>Basket Management</li>
						</ul>
					</div>
					<button id="adduser" style="float:right;margin-right: 10px;" onclick="newGroup()" name="btnadduser" type="button" class="btn_small btn_blue"><span>Add Basket</span></button>
					
					<br>
				</div>		
				<div class="widget_wrap">					
					<div class="widget_content">	
						
									
						<br>					
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
										Application Type
									</th>
									<th>
										Term Name
									</th>
									<th>
										Property Count
									</th>
									<th>
										Inspection Submitted
									</th>
									<th>
										Valuation Submitted
									</th>
									<th>
										Agenda Name
									</th>
									<th>
										Status
									</th>
									<th style="display: none;">
										Update By /
										Update At
									</th>
									<th style="display: none;">
										Create By /
										Create At
									</th>
									<th style="display: none;">
										Notice Count
									</th>
									<th style="display: none;">
										Objection Count
									</th>
									<th style="display: none;">
										Decision Count
									</th>
									<th>
										Action
									</th>
								</tr>
							</thead>
							<tbody>
												
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
						<input id="drivedrate" placeholder="Drived Rate" value="0" name="drivedrate" type="hidden"  value="{{ old('term') }}" />
						@foreach ($termtype as $rec)
						<li class="li">
							<div class="form_grid_12 multiline">
								<div class="form_input">
									<div class="form_grid_3">
										<input id="drivedrate" placeholder="Drived Rate" value="0" name="drivedrate" type="text"  value="{{ old('term') }}" />
									</div>
									<span class="clear"></span>
								</div>
							</div>
						</li>
						@endforeach
						<li class="li">
							
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


		function generateReport(id){
			;
			
			window.location.assign('generatenewowner?basketid='+id+'&s_date=22-01-2020');
			
			//window.location.assign('propertybasket?param='+zone);
			//return;
		}

		

function check_usaccess(module,id){
			$.ajax({
		        type:'GET',
		        url:'/getaccess',
		        data:{module:module},
		        success:function(data){	        	
		        	if(data.msg === "false"){
		        		alert(module+" - "
		        			+"We are sorry "
							+" The function you are trying to access dose not have permission :(");
		        		return;
		        	} else {
		        		window.location.assign("property?id="+id );
						//window.location.href = "datasearchdetail?prop_id="+id;
		        	}
		        }
		    });
		}
		function startValuation(id){
		if(isAccessAllowed(519)){
		$('#basic-modal-content').modal();

				//	return false;;
				//});
						$('#valuatuion_id').val(id);
				}
			
		}

		function newGroup(){
				if(isAccessAllowed(511)){
			
						$("#operation").val(1);
						$("#grouptable").hide();
						$("#addgroup").show();
						$("#addsubmit").html("Save");
					 	$("label.error").remove();	
					 	//var param = $('#paramterm').val();
						$("#termid").val('{{$id}}');
					}
				
				
		}

		function editGroup(id){
		if(isAccessAllowed(512)){
	
				$("#id").val(id);
				$("#termid").val($("#term_"+id).val());
				$("#name").val($("#name_"+id).val());
				$("#operation").val(2);
				$("#grouptable").hide();
				$("#addgroup").show();

				$("#addsubmit").html("Save");
			 	$("label.error").remove();	
		 	}
				
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
			//console.log();
		if(isAccessAllowed(513)){
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
								window.location.assign('grouptrn?jsondata='+groupjson+'&id={{$id}}');
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
		            window.location.assign('grouptrn?jsondata='+groupjson+'&id={{$id}}');	        	
		        }
		    });
		}

		function approveProperty(id){
			if(isAccessAllowed(517)){
			
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
												window.location.assign("valbasket?id={{$id}}");	
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
				

		}	

		
		function resetValuation(id){
if(isAccessAllowed(5110)){

			
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
												 window.location.assign("valbasket?id={{$id}}");	
												        		
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
				
		}	

		function approveValuation(id){
if(isAccessAllowed(518)){
			
			var noty_id = noty({
				layout : 'center',
				text: 'Are want to approve objection?',
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
					        data:{param_value:id,module:'APOBJ'},
					        success:function(data){
					        	
						        	var noty_id = noty({
										layout : 'top',
										text: 'Property Approved!',
										modal : true,
										type : 'success', 
									});	
									window.location.assign("valbasket?id={{$id}}");	
									        		
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
				
		}


		$(document).ready(function(){
			var count = $('#baskttable').DataTable().rows().count();
			$('#bst_count').html(count);
		});
	</script>

</div>
</body>
</html>