<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('Termsearch.Application_Type')}} Basket</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
	<div onload="setFilter()" id="content">
		<div class="grid_container">
			
			<div id="grouptable" class="grid_12">
	
				<br>
				<div class="form_input">
					

					<div id="breadCrumb3"  class="breadCrumb grid_3">
						<ul >
							<li><a href="#">{{__('Termsearch.Home')}} </a></li>
							<li><a href="termsearch">{{__('Termsearch.Data_Enquiry')}} </a></li>
							<li>{{__('Termsearch.Term_Search')}} </li>
						</ul>
					</div>
					<br>
				</div>		
				<div class="widget_wrap">					
					<div class="widget_content">	
						@php 
							$l_bldgcount = 0;
							$l_inscount = 0;
							$l_valcount = 0;
							$l_propcount = 0;
						@endphp		
						@foreach($bldgcount as $rec)
							@php 
								$l_bldgcount = $rec->bldgcount;
							@endphp
						@endforeach
						@foreach($inspropcount as $rec)
							@php 
								$l_inscount = $rec->inscount;
							@endphp
						@endforeach
						@foreach($propcount as $rec)
							@php 
								$l_propcount = $rec->totproperty_count;
							@endphp
						@endforeach
						@foreach($valpropcount as $rec)
							@php 
								$l_valcount = $rec->valcount;
							@endphp
						@endforeach
						<div class="social_activities">
							<div class="comments_s">
								<div class="block_label">
									{{__('Termsearch.Basket_Count')}}<span id="bst_count">0</span>
								</div>
							</div>
							<div class="comments_s">
								<div class="block_label">
									{{__('Termsearch.Property_Count')}}<span>{{$l_propcount}}</span>
								</div>
							</div>
							<div class="comments_s">
								<div class="block_label">
									{{__('Termsearch.Buliding_Count')}}<span>{{$l_bldgcount}}</span>
								</div>
							</div>
							<div style="width: 220px;" class="comments_s">
								<div style="width: 220px;" class="block_label">
									{{__('Termsearch.Inspection_Property_Count')}}<span>{{$l_inscount}}</span>
								</div>
							</div>
							<div style="width: 200px;" class="comments_s">
								<div style="width: 200px;" class="block_label">
									{{__('Termsearch.Valuation_Property_Count')}}<span>{{$l_valcount}}</span>
								</div>
							</div>
						</div>				
						<br>					
						<table id="baskttable" class="display tbl_details">
							<thead style="text-align: left;">
			  					<tr>
									<th class="table_sno">{{__('Termsearch.Application_Type')}}</th>
									<th> {{__('Termsearch.Basket_Name')}} </th>
									<th> {{__('Termsearch.Application_Type')}} </th>
									<th> {{__('Termsearch.Term_Name')}} </th>
									<th> {{__('Termsearch.Property_Count')}} </th>
									<th> {{__('Termsearch.Inspection_Submitted')}} </th>
									<th> {{__('Termsearch.Valuation_Submitted')}} </th>
									<th> {{__('Termsearch.Agenda_Name')}} </th>
									<th> {{__('Termsearch.Status')}} </th>
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
								</tr>
							</thead>
							<tbody>
								@foreach ($group as $rec)
								<tr>
									<td>
										{{$loop->iteration}}
									</td>
									<td>{{$rec->l_group}}
									</td>
									<td>
										{{$rec->applntype}}
									</td>
									<td>
										{{$rec->termaname}}
									</td>
									<td>
										{{$rec->propertycount}}
									</td>
									<td>
										{{$rec->inspropertyccount}}
									</td>
									<td>
										{{$rec->valcount}}
									</td>
									<td>
										{{$rec->ob_desc}}
									</td>
									<td>{{$rec->approval}}										
									</td>
									<td style="display: none;">
										{{$rec->updateby}} /
										{{$rec->updatedate}}
									</td>
									<td style="display: none;">
										{{$rec->createby}} / 
										{{$rec->createdate}}
									</td>
									<td style="display: none;">{{$rec->notiscount}}										
									</td>
									<td style="display: none;">{{$rec->objectioincount}}										
									</td>
									<td style="display: none;">{{$rec->decisioncount}}										
									</td>
									
								</tr>
								<div style="display: none;">
									<input type="text" id="name_{{ $rec->id }}" value="{{ $rec->l_group }}">
									<input type="text" id="term_{{ $rec->id }}" value="{{ $rec->termid }}">
								</div>
								@endforeach						
							</tbody>
						</table>
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