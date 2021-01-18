<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Objection</title>
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
	<div id="content">
		<div class="grid_container">
		
			<div id="grouptable" class="grid_12">
	
				<br>
				<div class="form_input">
					

					<div id="breadCrumb3"  class="breadCrumb grid_3">
						<ul >
							<li><a href="#">Home</a></li>
							<li><a href="#">Valuation Process</a></li>
							<li>Basket Management</li>
						</ul>
					</div>
					<br>
				</div>		
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table class="display tbl_details">
							<thead style="text-align: left;">
			  					<tr>
									<th class="table_sno">
										S No
									</th>
									<th>
										Basket Name
									</th>
									<th>
										Term Name
									</th>
									<th>
										Status
									</th>
									<th>
										Create By /
										Create At
									</th>
									<th>
										Update By /
										Update At
									</th>
									<th>
										Action
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
										<a href="objectionproperty?id={{$rec->id}}">{{$rec->l_group}}</a>										
									</td>
									<td>
										{{$rec->termaname}}
									</td>
									<td>{{$rec->status}}										
									</td>
									<td>
										{{$rec->createby}} / 
										{{$rec->createdate}}
									</td>
									<td>
										{{$rec->updateby}} /
										{{$rec->updatedate}}
									</td>
									<td>
										
										@if($rec->va_approvalstatus_id == '12' )
										<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approveProperty('{{$rec->id}}')" disabled="true" title="Approve Valuation" href="#"></a></span>
										@endif
									</td>
								</tr>
								@endforeach						
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	<span class="clear"></span>
	
	<script>
		function startValuation(id){
		//	alert();
			//$('.basic-modal-c').click(function (e) {
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
		            window.location.assign('grouptrn?jsondata='+groupjson)		        	
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
						    url:'objectionapprove',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{param_value:id,module:'objection'},
					        success:function(data){
					        	//var count = data.propertycnt;
					        	
						        	var noty_id = noty({
										layout : 'top',
										text: 'Basket Approved!',
										modal : true,
										type : 'success', 
									});	
									window.location.assign("objection");	
									        		
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