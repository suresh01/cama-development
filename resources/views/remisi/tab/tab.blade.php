<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{__('remisiLang.Property_Inspection')}} </title>
<style>
.disabled-btn{
    pointer-events:none;
    opacity:0.7;
}
</style>
@include('includes.header-popup')
	
	<div id="content">
		<div class="grid_container">	
			
		<div id="usertable" class="grid_12">	
				<div style="float:right;margin-right: 0px;"  class="btn_24_blue">	      
          
          			<a href="#" id="" onclick="closeWindow()" class=""><span>{{__('common.Close')}}  </span></a> 
				</div>
		

			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<!--<span class="h_icon list"></span>-->
						<h6>{{__('remisiLang.Remisi')}} </h6>
						<div id="top_tabby">
						</div>
					</div>
					<input type="hidden" value="" id="propertystatus" >
					<div class="widget_content">
						<!--<h3>Property Registration</h3>-->
						<form action="" id="propertyinspectionform" class="form_container left_label">
							<fieldset title="Step 1">		
								<legend>{{__('remisiLang.Property_Information')}}  </legend>	
								@include('remisi.tab.remisiregister')	
							</fieldset>
							<fieldset title="Step 2">
								<legend>{{__('remisiLang.Registration')}} </legend>
								@include('remisi.tab.detail')	
							</fieldset>
							@if($remisistatus==1 || $remisistatus==2 || $remisistatus==3 || $remisistatus==4 || $remisistatus==5 )
							<fieldset title="Step 3">
								<legend>{{__('remisiLang.Investigation')}} </legend>
								@include('remisi.tab.investigation')	
							</fieldset>
							@endif
							@if( $remisistatus==3 || $remisistatus==4 || $remisistatus==5 )
							<fieldset title="Step 4">
								<legend>{{__('remisiLang.Investigation_Result')}}  </legend>									
								@include('remisi.tab.investigationresult')							
							</fieldset>
							@endif
							
							<input type="submit" onclick="transfer()" class="finish" id="finish" value="Finish!"/>
						</form>
					</div>
				</div>
			</div>
			</div>	
	</div>
	<div class="" id="finishloader"></div>
	<span class="clear"></span>
<script src="js/propertyregister/tab-script.js"></script>
</div>
<script>

	let invesitagemap = new Map([["0","sno"],["1", "typetxt"],["2", "officertxt"],["3", "insvdate"],["4", "action"],["5", "actioncode"],["6", "insid"],["7", "instype"], ["8", "insofficer"],  ["9", "review"],["10", "finreason1"], ["11", "finreason2"],["12", "finreason3"], ["13", "finreason4"],["14", "finreason5"]]);
	function closeWindow(){
	    
	    window.close();
    }


    function transfer(){
		//alert($('.reason:checked').length);

		$("#propertyinspectionform").submit(function(e){
                //alert('submit intercepted');

                e.preventDefault(e);
		var formdata = {};
		$('#propertyinspectionform').serializeArray().map(function(x){formdata[x.name] = x.value;});

			var instabledata = [];

			for (var i = 0;i<$('#invesitgatetable').DataTable().rows().count();i++){
				var ldata = $('#invesitgatetable').DataTable().row(i).data();
				var tempdata1 = {};
				$.each(ldata, function( key, value ) {
					if (key !== 4) {
						tempdata1[invesitagemap.get(""+key+"")] = value; 
					} 
				//console.log(key);            
	        	});
	        	//console.log(templotdata);
	        	instabledata.push(tempdata1);            	
			}
//alert($('#invesitgatetable').DataTable().rows().count());
			if ($('#invesitgatetable').DataTable().rows().count() > 1)
					instabledata = "["+ JSON.stringify(instabledata).replace(/]|[[]/g, '') +"]";
				else
					instabledata = JSON.stringify(instabledata).replace(/]|[[]/g, '');
		
           

            if(instabledata === ''){
				instabledata = "{}";
			}
		//console.log(formdata);
			var noty_id1 = noty({
				layout : 'center',
				text: 'Are want to Update?',
				modal : true,
				buttons: [
					{type: 'button blue', text: 'Submit', click: function($noty) {
			  
						$noty.close();

						var d=new Date();
						$.ajax({ 
				  				type: 'GET', 
							    url:'remisitrn',
							    headers: {
								    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
						        data:{jsondata:JSON.stringify(formdata),instabledata:instabledata},
						        success:function(data){
						        	//$('#propertystatus').val('Registered');
									$('#finishloader').html('');
									
										msg = 'Remisi Detail Updated';
										type = 'Fail';
									
						        	var noty_id = noty({
										layout : 'top',
										text: msg,
										modal : true,
										type : 'success', 
									});			
						        	
									// window.opener.HandlePopupResult(sender.getAttribute("result"));
								
					        	},
						        error:function(data){
										
						        	$('#finishloader').html('');     	
						        		var noty_id = noty({
										layout : 'top',
										text: 'Problem while update!',
										modal : true,
										type : 'error', 
									});
					        	}
					    	});

						  }
					},
					{type: 'button pink', text: 'Cancel', click: function($noty) {
						$noty.close();
					  }
					}
					],
				 type : 'success', 
			 });
		
		
        });


	}

	

</script>
</body>
</html>