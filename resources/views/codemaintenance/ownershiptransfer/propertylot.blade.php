<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{__('CodeMaintenance.Property_Lot_Information')}} </title>

@include('includes.header', ['page' => 'datamaintenance'])
					
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">	
					<br>
				<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
					<ul>
						<li><a href="#">{{__('CodeMaintenance.Home')}} </a></li>
						<li><a href="#">{{__('CodeMaintenance.Data_Maintenance')}} </a></li>
						<li>{{__('CodeMaintenance.Property_Lot_Transfer')}} </li>
					</ul>
				</div>
				</div>
				
				<div style="float:right;margin-right: 10px;"  class="btn_24_blue">		
					@include('codemaintenance.ownershiptransfer.newsearch')
					<a href="#" onclick="addProperty()">{{__('CodeMaintenance.Add_Property')}}</a>
				</div>
				<br>
        
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="proptble" class="display select">
							<thead style="text-align: left;">
								<tr>
									<th class="table_sno">
									{{__('CodeMaintenance.SNo')}}
									</th>
									<th>
									No Harta
									</th>
									<th>
									{{__('CodeMaintenance.Lot_Type_Number')}} 
									</th>
									<th>
									{{__('CodeMaintenance.Lot_Title_Type_Number')}} 
									</th>
									<th>
									{{__('CodeMaintenance.Alternatif_Lot_Number')}} 
									</th>
									<th>
									{{__('CodeMaintenance.Strata_Number')}} 
									</th>
									<th>
									{{__('CodeMaintenance.Tenant_Type')}} 
									</th>	
									<th>
									{{__('CodeMaintenance.Tenure_Period')}} 
									</th>	
									<th>
									{{__('CodeMaintenance.Start_Date')}} 
									</th>	
									<th>
									{{__('CodeMaintenance.End_Date')}} 
									</th>
									<th>
									{{__('CodeMaintenance.Status')}} 
									</th>		
									<th>
									{{__('CodeMaintenance.Action')}} 
									</th>		
								</tr>
							</thead>
							<tbody>			
								
							</tbody>
						</table>


				</div>
			</div>
			
		<!-- <form style="display: hidden;" id="generateform" method="GET" action="generateinspectionreport">
            @csrf
            <input type="hidden" name="accounts" id="accounts">
		</form>-->
		
		<div style="display: none;" class="grid_12" id="lot-modal-content">
				<h3>{{__('CodeMaintenance.Lot_Detail')}}</h3>
				<form action="validateValuation" id="valuationcheckform" method="post" class="form_container">	
					@csrf
				
				<input type="hidden" name="al_id" id="al_id" value="true">	
				<div class="grid_12"> 		
					<div  class="grid_3 form_container left_label">
						<ul>
							<li>				
								<fieldset>
									<legend>{{__('CodeMaintenance.Account_Information')}} </legend>				
									
									
									
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Account_No')}} <span class="req">*</span></label>
										<div  class="form_input">
											<input id="accno" tabindex="8" name="accno"  type="text" readonly="" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
									<input type="hidden" name="lot_id" id="lot_id">
									<!--<div class="form_grid_12">
										<label class="field_title" onchange="" id="lposition" for="position">{{__('CodeMaintenance.Lot_List')}} <span class="req">*</span></label>
										<div  class="form_input">
											<select placeholder="Choose a Status..." style="width:100%" class="cus-select" onchange="getLotDetail(this.value)" id="lotlist" name="lotlist" tabindex="1">
												<option value="0"></option>
											
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>-->

									
								</fieldset>
							</li>
						</ul>
					</div>

				
					<div id="lotdetail_view"  class="grid_3 form_container left_label">
						<ul>
							<li>				
								<fieldset>
									<legend>{{__('CodeMaintenance.Lot_Information')}} </legend>					
									
									<!--<div class="form_grid_12">
										<label class="field_title">Copy Previous Detail</label>
										<div class="form_input">
											<span>
											<input name="field08" id="copydetail" onchange="copyDetail()" class="checkbox" type="checkbox"  tabindex="7">
											
											</span>
										</div>
									</div>-->
									
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Lot_Code')}}<span class="req">*</span></label>
										<div  class="form_input">
											<select placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="lotype" name="lotype" tabindex="1">
												<option value=""></option>
											@foreach ($lotcode as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									
									
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Lot_No')}}<span class="req">*</span></label>
										<div  class="form_input">
											<input id="lotnum" tabindex="8" name="lotnum"  type="text" maxlength="100" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Alternate_Lot_No')}} <span class="req">*</span></label>
										<div  class="form_input">
											<input id="altlotnum"  tabindex="9" name="altlotnum"  type="text"  maxlength="100" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Title_Code')}}<span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="lttt" tabindex="4" name="lttt" tabindex="20">
												<option></option>
											@foreach ($titiletype as $rec)
													<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
											@endforeach	
										</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Title_No')}}<span class="req">*</span></label>
										<div  class="form_input">
											<input id="ltnum"  name="ltnum" tabindex="11"  type="text"  maxlength="100" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Altenate_Title_No')}} <span class="req">*</span></label>
										<div  class="form_input">
											<input id="altnum" name="altnum"  tabindex="12"  type="text"  maxlength="50" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Strata_No')}} <span class="req">*</span></label>
										<div  class="form_input">
											<input id="stratano" name="stratano"  tabindex="12"  type="text"  maxlength="50" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>
								</fieldset>
							</li>
						</ul>
					</div>

					<div id="lotdetail_view_part2" class="grid_3 form_container left_label">
						<ul>
							<li>				
								<fieldset>
									<legend>{{__('CodeMaintenance.Lease_Information')}} </legend>					
									
									<!--<div class="form_grid_12">
										<label class="field_title">Copy Previous Detail</label>
										<div class="form_input">
											<span>
											<input name="field08" id="copydetail" onchange="copyDetail()" class="checkbox" type="checkbox"  tabindex="7">
											
											</span>
										</div>
									</div>-->
									
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Tenure_Type')}} <span class="req">*</span></label>
										<div  class="form_input">
											<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="tentype" tabindex="19" name="tentype" tabindex="20">
												<option></option>
												@foreach ($tnttype as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
												@endforeach	
											</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									
									
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Tenure_Period')}}<span class="req">*</span></label>
										<div  class="form_input">
											<input id="tenduration" tabindex="8" name="tenduration"  type="text" maxlength="100" class=""/>
										</div>
										<span class=" label_intro"></span>
									</div>

									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Tenure_Start_Date')}} <span class="req">*</span></label>
										<div  class="form_input">
										<input type="text" id="tenstart" dateFormat='dd/mm/yyyy' name="tenstart" tabindex="21">
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="lposition" for="position">{{__('CodeMaintenance.Tenure_End_Date')}}<span class="req">*</span></label>
										<div  class="form_input">
										<input id="tenend"  name="tenend" class="" type="text"  maxlength="50" />
										</div>
										<span class=" label_intro"></span>
									</div>
								</fieldset>
							</li>
						</ul>
					</div>
					
					<div class="btn_24_blue">						
						<!--<button id="addsubmit"type="submit" class="btn_small btn_blue"><span>Submit</span></button>	-->
						<a href="#" onclick="submitData()" class=""><span>{{__('common.Update_Data')}}  </span></a>	
					</div>
					<div class="btn_24_blue">
						<a href="#" class="simplemodal-close"><span>{{__('common.Close')}}  </span></a>
					</div>
				</div>
				<input type="hidden" name="accno" id="lotaccount">
					</form>
			</div>
		
	</div>
	<span class="clear"></span>
	
	<script>
		function edit(id) {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "lotdetail?prop_id="+id;
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}

		function addProperty() {		
				
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "searchpropertyaddress?page=lot";
		        w.location = "lotdetail?prop_id="+id;
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}	

		function getLotDetail(id){
			if(id != 0){
				$('#lotdetail_view').show();
				$('#lotdetail_view_part2').show();
				$('#lotdetail_dy').hide();
				$('#lotdetail_dy_part2').hide();
			} else {				
				$('#lotdetail_view').hide();
				$('#lotdetail_view_part2').hide();
				$('#lotdetail_dy').show();
				$('#lotdetail_dy_part2').show();
			}
			

		}

		function submitData(){
			var noty_id = noty({
				layout : 'center',
				text: 'Are want to update Lot?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Yes', click: function($noty) {
						$noty.close();
						$("#operation").val(3);
						
						var termdata = {};
			        	$('#valuationcheckform').serializeArray().map(function(x){termdata[x.name] = x.value;});

			            var termjson = JSON.stringify(termdata);
			            //window.location.assign('lotdetailtrn?jsondata='+termjson);
			           	$.ajax({
			  				type: 'GET', 
						    url:'lotdetailtrn',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{jsondata:termjson},
					        success:function(data){
					        	alert('Update Successfully');

								//console.log(data.lotlist);
								//console.log(data.lotlist[0].al_activeind_id);			
					        	//clearTableError(4);
				        	},
					        error:function(data){
					        	alert('Error While Update Successfully');
								//$('#loader').css('display','none');
					        	
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

		function approve(id,currstatus){

	var table = $('#proptble').DataTable();
		var account = $.map(table.rows('.selected').data(), function (item) {
		// console.log(item);
    		return item['log_id']
		});
		if(account.length==0){
				account=id;
	   		} else {
	   			account=account.toString();
	   		}

	   		if(currstatus == '5'){
			var noty_id = noty({
				layout : 'center',
				text: 'Are you sure want to Transfer Data?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Submit', click: function($noty) {
						$noty.close();
						$.ajax({
			  				type: 'GET', 
						    url:'datatransfer',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{param_value:id,module:'propertylotaddress',param:currstatus,param_str:account,param_status:param_status },
					        success:function(data){						        	
								window.location.assign("propertylot");									
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
		} else {
			//alert(account);
			//alert(currstatus);
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
					        data:{param_value:id,module:'propertylotaddress',param:currstatus,param_str:account },
					        success:function(data){	        	
					        	
								window.location.assign("propertylot");	
								
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

	}



	function approve(id,currstatus,type){
		var param_status ="";
		if(type == 1){
			param_status = 'AP';
		} else {
			param_status = 'RJ';
		}

		var table = $('#bldgtable').DataTable();
		var account = $.map(table.rows('.selected').data(), function (item) {
		// console.log(item);
    		return item['log_id']
		});
		if(account.length==0){
				account=id;
	   		} else {
	   			account=account.toString();
	   		}

	   	if(currstatus == '5'){
			var noty_id = noty({
				layout : 'center',
				text: 'Are you sure want to Transfer Data?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Submit', click: function($noty) {
						$noty.close();
						$.ajax({
			  				type: 'GET', 
						    url:'datatransfer',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{param_value:id,module:'propertylotaddress',param:currstatus,param_str:account,param_status:param_status },
					        success:function(data){						        	
								window.location.assign("propertylot");									
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
		} else {
			//alert(account);
			//alert(currstatus);
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
					        data:{param_value:id,module:'propertylotaddress',param:currstatus,param_str:account,param_status:param_status },
					        success:function(data){	 	
					        	
								window.location.assign("propertylot");	
								
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

	}

		function lotDetail(id,log_id){
			$('#accno').val(id);
		$( "#tenstart").datepicker({dateFormat: 'dd/mm/yy'});
		$( "#tenend").datepicker({dateFormat: 'dd/mm/yy'});
			$('#lot-modal-content').modal();
			$('#accno').val(id);
			$('#al_id').val(log_id);
			$.ajax({
  				type: 'POST', 
			    url:'propertylotdetail',
			    headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
		        data:{prop_id:id},
		        success:function(data){
		        	//alert(data.lotlist[0].al_id);
		        	//var id = data.lotlist[0].al_id;
		        	
		        	//alert(id);
		        	$("#lotlist").append('<option value="'+data.lotlist[0].LO_LOTCODE_ID+'">'+data.lotlist[0].lotnumber+' </option>');
					$('#lotype').val(data.lotlist[0].LO_LOTCODE_ID);
					$('#lotnum').val(data.lotlist[0].LO_NO);
					$('#altlotnum').val(data.lotlist[0].LO_ALTNO);
					$('#lttt').val(data.lotlist[0].LO_TITLETYPE_ID);
					$('#ltnum').val(data.lotlist[0].LO_TITLENO);
					$('#altnum').val(data.lotlist[0].LO_ALTTITLENO);
					$('#tenstart').val(data.lotlist[0].lo_startdate1);
					$('#tenend').val(data.lotlist[0].lo_expireddate1);
					
					$('#tentype').val(data.lotlist[0].LO_TENURETYPE_ID);
					$('#tenduration').val(data.lotlist[0].LO_TENUREPERIOD);
					$('#stratano').val(data.lotlist[0].LO_STRATANO);
					$('#lot_id').val(data.lotlist[0].LOT_ID);

					//console.log(data.lotlist);
					//console.log(data.lotlist[0].al_activeind_id);			
		        	//clearTableError(4);
	        	},
		        error:function(data){
					//$('#loader').css('display','none');
		        	
	        	}
	    	});
		}

		
		function changeField(val){
			if(val == 'table'){
				$('#maxrow').removeAttr('style');
			} else {
				$('#maxrow').attr('style', "display:none;");
			}
		}


		/*function deleteProperty(){
			var table = $('#proptble').DataTable();
			var account = $.map(table.rows('.selected').data(), function (item) {
				//console.log(item);
	        	return item['vd_id']
	   		});
			var type = "delete";
			$('#accounts').val(account.toString());
			$('#addDetail').modal();
			console.log(account.toString());
			
			
		}*/
	

		


		
$(document).ready(function (){


	var table = $('#proptble').DataTable({
		        "processing": true,
		        "serverSide": true,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				 "ajax": {
		            "type": "GET",
		            "url": 'propertylotdata',
		            "contentType": 'application/json; charset=utf-8',
				    "headers": {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				},
		        //ajax: '{{ url("propertylotdata") }}',
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
			        {"data": null, "name": "sno"},
			        {"data":  function(data){
						return "<a onclick='edit("+data.log_id+")' href='#'>"+data.ma_accno+"</a>";
			        	//return "<a onclick='edit("+data.LOT_ID+")' href='#'>"+data.ma_accno+"</a>";
			        
			        }, "name": "account number"},
					{"data": "lotnumber", "name": "noacc"},
			        {"data": "titlenumber", "name": "fileno"},
			        {"data": "LO_ALTNO", "name": "zone"},
			        {"data": "LO_STRATANO", "name": "subzone"},
			        {"data": "tentype", "name": "owner"}, 
			        {"data": "LO_TENUREPERIOD", "name": "ishasbldg"},
			        {"data": "LO_STARTDATE", "name": "owntype"}, 
			        {"data": "LO_EXPIREDDATE", "name": "TO_OWNNAME"}, 
			        {"data": "tstatus", "name": "bldgcount"},
			        {"data":  function(data){

			        	var editaction ='' ;

			        	var deleteaction ="&nbsp;&nbsp;<span><a style='height: 15px; width: 13px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -143px -23px !important;display: inline-block; float: right;'  onclick='deleteProperty("+data.log_id+")' href='#' title='Delete'></a></span>";
			        		action = "";
							if(data.log_approvalstatus_id == '1'  || data.log_approvalstatus_id == '6'){
								action =  deleteaction + editaction  ;				

							} else if(data.log_approvalstatus_id == '2'){
								action= deleteaction + editaction + '<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -462px -122px !important;display: inline-block; float: left;" onclick="approve('+data.log_id+',2)"  title="Submit To Approve" href="#"></a></span>'
							
							} else if(data.log_approvalstatus_id == '4'){
								action =  editaction +  '<span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: 0px 0px !important;display: inline-block; float: left;" onclick="approve('+data.log_id+',4,1)"  title="Approve" href="#"></a></span>' + 
								'<span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -542px -42px !important;display: inline-block; float: left;" onclick="approve('+data.log_id+',4,2)"  title="Reject" href="#"></a></span>';		

							} else if(data.log_approvalstatus_id == '5'){
								action =  editaction+  '<!--<spane><a  class=" new-action-icons reverse" onclick="approve('+data.log_id+',5)" title="Revise" href="#"></a></span>--><span><a style="height: 16px; width: 16px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -822px -42px !important;display: inline-block; float: left;" onclick="approve('+data.log_id+',5)" title="Transfer" href="#"></a></span>';						
							} 
							
			        		return action;

			        }, "name": "sno"}
			        
		   		],
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  	
			        $("td:nth-child(1)", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
			        return nRow;
			    },
			    "sPaginationType": "full_numbers",
			"iDisplayLength": 100,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
		    'columnDefs': [{
         'targets': 0,
         'searchable': true,
         'orderable': false,
         'width': '1%',
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox">';
         }
      }],
      'rowCallback': function(row, data, dataIndex){
         // Get row ID
         var rowId = data[0];

         // If row ID is in the list of selected row IDs
         if($.inArray(rowId, rows_selected) !== -1){
            $(row).find('input[type="checkbox"]').prop('checked', true);
            $(row).addClass('selected');
         }
      },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			});
   // Array holding selected row IDs
   var rows_selected = [];
   
    
   

   // Handle click on checkbox
   $('#proptble tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = $('#proptble').DataTable().row($row).data();

      // Get row ID
      var rowId = data[0];

      // Determine whether row ID is in the list of selected row IDs
      var index = $.inArray(rowId, rows_selected);

      // If checkbox is checked and row ID is not in list of selected row IDs
      if(this.checked && index === -1){
         rows_selected.push(rowId);

      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
      } else if (!this.checked && index !== -1){
         rows_selected.splice(index, 1);
      }

      if(this.checked){
         $row.addClass('selected');
      } else {
         $row.removeClass('selected');
      }

      // Update state of "Select all" control
    //  updateDataTableSelectAllCtrl($('#proptble').DataTable());

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle click on table cells with checkboxes
   $('#proptble').on('click', 'tbody td, thead th:first-child', function(e){
      $(this).parent().find('input[type="checkbox"]').trigger('click');
   });

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', $('#proptble').DataTable().table().container()).on('click', function(e){
      if(this.checked){
         $('#proptble tbody input[type="checkbox"]:not(:checked)').trigger('click');
      } else {
         $('#proptble tbody input[type="checkbox"]:checked').trigger('click');
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle table draw event
   
   // Handle form submission event

});


	</script>
</div>

</body>
</html>