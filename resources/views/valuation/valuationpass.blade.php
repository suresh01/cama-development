<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>

<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{__('valuation.Valuation_Details')}}</title>
<style>
	.left-text {
		text-align:right;
	}
</style>
@include('includes.header', ['page' => 'VP'])
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<h6>{{__('valuation.Comfirmation')}}</h6>
					</div>
					<div class="widget_content">
						<div class=" page_content">
							<div class="invoice_container">	
								
								<div class="grid_3">
									<fieldset>
										<legend>{{__('valuation.Valuation_Basket_Information')}}</legend>	
										@foreach ($valuationbasket as $rec)		
										<input type="hidden" name="valuationbasket_id" id="valuationbasket_id" value="{{$rec->va_id}}">				
										<div style="line-height: 2;" class=" invoice_to">	
											<strong><span>{{__('valuation.Name')}} : </span></strong>
											<span>{{$rec->va_name}}</span>	
										</div>		 		
										<div style="line-height: 2;" class=" invoice_to">	
											<strong><span>{{__('valuation.Application_Type')}} : </span></strong>
											<span>{{$rec->applntype}}</span>	
										</div>	 		
										<div style="line-height: 2;" class=" invoice_to">	
											<strong><span>{{__('valuation.Total_Property_Count')}} : </span></strong>
											<span>{{$rec->propertycount}}</span>	
										</div> 		
										<div style="line-height: 2;" class=" invoice_to">	
											<strong><span>{{__('valuation.Valuation_Property_Count')}} : </span></strong>
											<span>{{$valpropcount}}</span>	
										</div>
										@endforeach
									</fieldset>
								</div>
								<div class="grid_3">
									<fieldset>
										<legend>{{__('valuation.Tone_Basket_Information')}}</legend>	
										@foreach ($tonebasket as $rec)			
										<input type="hidden" name="tonebasket_id" id="tonebasket_id" value="{{$rec->tollist_id}}">								
										<div style="line-height: 2;" class=" invoice_to">	
											<strong><span>{{__('valuation.Name')}}  : </span></strong>
											<span>{{$rec->tollis_desc}}</span>	
										</div>
										<div style="line-height: 2;" class=" invoice_to">		
											<strong><span>{{__('valuation.Year')}}  : </span></strong>
											<span>{{$rec->tollis_year}}</span>
										</div>
										<div style="line-height: 2;" class=" invoice_to">	
											<strong><span>{{__('valuation.Enforcement_Year')}}  : </span></strong>
											<span>{{$rec->tollis_enforceyear}}</span>
										</div>
										@endforeach
									</fieldset>
								</div>
								<div class="grid_3">
									<fieldset>
										<legend>Tone Tax Basket Information</legend>	
										@foreach ($tonetaxbasket as $rec)			
										<input type="hidden" name="tonetaxbasket_id" id="tonetaxbasket_id" value="{{$rec->trlist_id}}">								
										<div style="line-height: 2;" class=" invoice_to">	
											<strong><span>{{__('valuation.Name')}}  : </span></strong>
											<span>{{$rec->trlist_desc}}</span>	
										</div>
										<div style="line-height: 2;" class=" invoice_to">	
											<strong><span>{{__('valuation.Year')}}  : </span></strong>
											<span>{{$rec->trlist_year}}</span>
										</div>
										<div style="line-height: 2;" class=" invoice_to">	
											<strong><span>{{__('valuation.Enforcement_Year')}}  : </span></strong>
											<span>{{$rec->trlist_enforceyear}}</span>
										</div>
										@endforeach
									</fieldset>
								</div>
								<div class="grid_3">
									<fieldset>
										<legend>{{__('valuation.Valuation_Information')}}</legend>	
										<input type="hidden" name="drivedrate" id="drivedrate" value="{{$drivedrate}}">						
									
										<div style="line-height: 2;" class=" invoice_to">	
											<strong><span>{{__('valuation.Drivered_Rate')}} : </span></strong>
											<span>{{$drivedrate}}</span>	
										</div>
										<div style="display: none;" >		
											<strong><span>{{__('valuation.Drivered_Value')}} : </span></strong>
											
										</div>
										
									</fieldset>
								</div>
								<div style="height: 48px; float: none; display: -webkit-box;text-align: -webkit-center;" class="grid_12">
								
									<div class="form_input">
										<button id="addsubmit" name="adduser" onclick="startValuation()" type="button" class="btn_small btn_blue"><span>{{__('common.Submit')}}</span></button>			
															
										<button id="close" onclick="back()" name="close" type="button" class="btn_small btn_blue"><span>{{__('common.Back')}}</span></button>
										<span class=" label_intro"></span>
									</div>
									
									<span class="clear"></span>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="loader">
		
		</div>
		<span class="clear"></span>
	</div>
</div>
<script>
	function back(){
		 window.location.assign("group");
	}
	function startValuation(id){

		var valuationbasket_id = $("#valuationbasket_id").val();
		var tonebasket_id = $("#tonebasket_id").val();
		var tonetaxbasket_id = $("#tonetaxbasket_id").val();
		//var drivedvalue = $("#drivedvalue").val();
		var drivedrate = $("#drivedrate").val();

		var noty_id = noty({
			layout : 'center',
			text: 'Are want to start mass valuation?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Yes', click: function($noty) {
					$noty.close();
					$('#loader').html('<div class="simplemodal-overlay" style="background: none repeat scroll 0 0 black;opacity: 0.5; height: 100%; width: 100%; position: fixed; left: 0px; top: 0px; z-index: 1001;"><span><img style="    display: block; '+
				' margin-left: auto; '+
				' margin-right: auto; '+
				' text-align: center; '+
				' vertical-align: middle;'+
				' margin-top: 300px;" src="images/ajax-loader/ajax-loader(6).gif" alt="Loader"></span></div>');
					//$('#loader').html('');
					$.ajax({
		  				type: 'POST', 
					    url:'massvaluation',
					    headers: {
						    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
				        data:{valuationbasket_id:valuationbasket_id,tonebasket_id:tonebasket_id,tonetaxbasket_id:tonetaxbasket_id,drivedrate:drivedrate},
				        success:function(data){
				        	/*var noty_id = noty({
								layout : 'top',
								text: data.response,
								modal : true,
								type : 'success', 
							});	*/
							alert(data.response);		
							$('#loader').html('');		        		
				        	//$("#finish").attr("disabled", true);
				        	//clearTableError(4);
				        	 window.location.assign("property?id="+valuationbasket_id);
			        	},
				        error:function(data){
							//$('#loader').css('display','none');	
				        	$('#finishloader').html('');     	
				        		var noty_id = noty({
								layout : 'top',
								text: 'Something went wrong!',
								modal : true,
								type : 'error', 
							});
							$('#loader').html('');	
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
</body>
</html>