<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Deactive Report</title>
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
							<li><a href="#">{{__('group.Home')}} </a></li>
							<li><a href="#">Report </a></li>
							<li>{{__('group.Deactivate_Property')}}</li>
						</ul>
					</div>
					<button id="adduser" style="float:right;margin-right: 10px;" onclick="generateReport()" name="btnadduser" type="button" class="btn_small btn_blue"><span>Generate Report</span></button>
					<div  style="float:right;margin-right: 20px;">		
							<select onchange="getdata()" data-placeholder="Choose a Status..."  style="float: left;" class="cus-select"  id="paramterm" name="paramterm" tabindex="6">
								<option value="0">{{__('group.Please_Select_a_Filter')}}...</option>
								<option value="All">{{__('group.All_Basket')}}</option>
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
										
						<table id="proptable" class="display data_tbl">
							<thead style="text-align: left;">
			  					<tr>
									<th class="table_sno"> {{__('group.SNo')}}  </th>
									<th>{{__('group.Basket_Name')}} </th>
									<th>{{__('group.Term_Type')}} </th>
									<th>{{__('group.Term_Name')}} </th>
									<th>{{__('group.Update_By')}} </th>
									<th>{{__('group.Update_At')}}</th>
									<th>{{__('group.Create_By')}}</th>
									<th>{{__('group.Create_At')}}</th>
									<th>{{__('group.Property_Count')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($group as $rec)
								<tr>
									<td>
										{{$loop->iteration}}
									</td>
									<td>
										{{$rec->da_name}}
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

		</div>


	<span class="clear"></span>
	
	<script>

		function generateReport(){
			

			var noty_id = noty({
				layout : 'center',
				text: 'Are want to Generate Report?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Generate', click: function($noty) {
						$noty.close();
						var tilte = prompt("Report Title", "SENARAI BATAL HARTA MAJLIS PERBANDARAN HANG TUAH JAYA SEHINGGA PENGGAL");
						//var table = $('#proptble').DataTable();
						var paramterm = $('#paramterm').val();

						
						
						if (tilte == null || tilte == "") {
							return;
						} else {
							//var id = $('#value_Term').val();
							window.location = "generatedeactive?title="+tilte+"&termid="+paramterm;
						}
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
				window.location.assign('defunctreport?param='+param+'&ts=1');
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
			var count = $('#proptable').DataTable().rows().count();
			$('#bst_count').html(count);

});
	</script>

</div>
</body>
</html>