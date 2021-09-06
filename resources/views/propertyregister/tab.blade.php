<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{__('propertyregister.Property_Registration')}}</title>
<style>
.disabled-btn{
    pointer-events:none;
    opacity:0.7;
}
</style>
@include('includes.header', ['page' => 'datamaintenance'])
	
	<div id="content">
		<div class="grid_container">
 
		<div id="usertable" class="grid_12">	
			<div id="breadCrumb3" class="breadCrumb grid_12">
					<ul>
						<li><a href="#">{{__('propertyregister.Home')}} </a></li>
						<li><a href="#">{{__('propertyregister.Data_Maintenance')}} </a></li>
						<li><a href="propertybasket">{{__('propertyregister.Property_Registration')}} </a></li>
						<li><a href="propertyregister?pb={{$pb}}">{{$basket_name}}</a></li>
						<li>{{$accountnumbber}}</li>
					</ul>
				</div>
			<br>

			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<!--<span class="h_icon list"></span>-->
						<h6>{{__('propertyregister.Property_Registration')}}</h6>
						<div id="top_tabby">
						</div>
					</div>
					<input type="hidden" value="" id="propertystatus" >
					<div class="widget_content">
						<!--<h3>Property Registration</h3>-->
						<form action="" id="propertyregsitration_from" class="form_container left_label">
							<fieldset title="Step 1">		
								<legend>{{__('propertyregister.Master_Information')}} </legend>						
								@if ($count == 0 && $basket_type =='K')
				            		@include('propertyregister.tab.masternew')
				            	@elseif ($count == 0 && $basket_type =='C')
				            		@include('propertyregister.tab.mastercmk')
				            	@else
				            		@include('propertyregister.tab.master')
				            	@endif								
							</fieldset>
							<fieldset title="Step 2">
								<legend>{{__('propertyregister.Owner_Information')}} </legend>
								@include('propertyregister.tab.owner')
							</fieldset>
							<fieldset title="Step 3">
								<legend>{{__('propertyregister.Lot_Inforamtion')}} </legend>
								@include('propertyregister.tab.lot')
							</fieldset>
							<fieldset title="Step 4">
								<legend>{{__('propertyregister.Building_Inforamtion')}} </legend>
								@include('propertyregister.tab.building')
							</fieldset>
							@if($iseditable == 1)
								<input type="submit" onclick="loader()" class="finish" id="finish" value="Finish!"/>
							@else
								<input type="button" onclick="close()" class="finish" id="finish" value="Close!"/>
							@endif
						</form>
					</div>
				</div>
			</div>
			</div>	
	</div>
	<div class="" id="finishloader"></div>
	<span class="clear"></span>
<script src="js/propertyregister/tab-script.js"></script>
<script>
	function close(){
		//	window.location.assign('propertyregister?pb={{$pb_id}}');	
	}
	$(document).ready(function() {


      $("#accnumber").keypress(function (e) {
      	var length = jQuery(this).val().length;
      	//var length = jQuery(this).val().length;
      	if($('#pagetype').val() == 'cmk'){

         	if(length > 11) {
	            return false;
	       } else if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
	            return false;
	       } else if((length == 0) && (e.which == 48)) {
	            return false;
	       }
      	} else {
      		if(length > 10) {
	            return false;
	       } else if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
	            return false;
	       } else if((length == 0) && (e.which == 48)) {
	            return false;
	       }
      	}
      
      });
   
		
		let lotmap = new Map([["0","sno"],["1", "lotstate"], ["2", "lotdistrict"], ["3", "lotcity"],["4", "presint"], ["5", "lotype"],["6", "lotnum"], ["7", "altlotnum"],["8", "lttt"], ["9", "ltnum"],["10", "altnum"], ["11", "landar"],["12", "landaruni"],["13", "landcon"], ["14", "lanpos"],["15", "roadtype"], ["16", "roadcate"],["17", "landuse"], ["18", "expcon"],["19", "interest"], ["20", "tentype"],["21", "tenduration"], ["22", "tenstart"],["23", "tenend"], ["24", "status"],["25", "action"],["26", "actioncode"],["27", "lot_id"],["28", "lotaccnum1"],["29", "lotaccnum2"],["30", "lotaccnum3"],["31", "lotaccnum4"],["32", "lotaccnum5"],["33", "lotaccnum6"],["34", "lotaccnum7"],["35", "lotaccnum"],["36", "lostratano"]]);

		let ownermap = new Map([["0","sno"],["1", "ownaplntype"], ["2", "typeofown"], ["3", "ownnum"],["4", "ownname"], ["5", "ownaddr1"],["6", "ownaddr2"], ["7", "ownaddr3"],["8", "ownaddr4"], ["9", "ownpostcode"],["10", "ownstate"], ["11", "telno"],["12", "faxno"],["13", "citizen"], ["14", "race"],["15", "numerator"], ["16", "demominator"],["17", "action"], ["18", "actioncode"],["19", "ownerid"],["20","owneraccnum"],["21","owncity"],["22","emailno"]]);

		let bldgmap = new Map([["0","sno"],["1", "url"],["2", "bldgnum"],["3", "bldgnum1"],["4", "bldgnum2"],["5", "bldgnum3"],["6", "bldgnum4"],  ["7", "bldgttype"],["8", "bldgstorey"], ["9", "bldgcond"],["10", "bldgpos"], ["11", "bldgstructure"],["12", "rooftype"], ["13", "walltype"],["14", "floortype"], ["15", "cccdt"],["16", "occupieddt"],["17", "mainbldg"],["18", "action"],["19", "actioncode"],["20", "bldgid"],["21","bldgaccnum"],["22","mbldg"]]);

		
		let bldgarmap = new Map([["0","sno"],["1", "bldgaccnum"],  ["2", "bldgnum"], ["3", "disparlevel"], ["4", "bldgnum2"], ["5", "bldgnum4"], ["6", "bldgnum5"], ["7", "bldgnum7"], ["8", "bldgnu8m"], ["9", "bldgnu2m"], ["10", "bldgnum7"], ["11", "bldgnu8m"], ["12", "bldgnu2m"],["13", "reffinfo"], ["14", "artype"],["15", "arcate"], ["16", "arlevel"],["17", "arzone"], ["18", "aruse"],["19", "ardesc"], ["20", "dimention"],["21", "arcnt"],["22", "size"],["23", "uom"],["24", "totsize"],["25", "fltype"],["26","dwalltype"],["27", "celingtype"],["28", "action"],["29","actioncode"],["30","bldgarid"],["31","bldgnumtxt"]]);
		//let bldgarmap = new Map([["0","sno"],["1", "bldgaccnum"],  ["2", "bldgnum"], ["3", "bldgnum2"], ["4", "bldgnum4"], ["5", "bldgnum5"], ["6", "bldgnum7"], ["7", "bldgnu8m"], ["8", "bldgnu2m"], ["9", "bldgnum7"], ["10", "bldgnu8m"], ["11", "bldgnu2m"],["12", "reffinfo"], ["13", "artype"],["14", "arcate"], ["15", "arlevel"],["16", "arzone"], ["17", "aruse"],["18", "ardesc"], ["19", "dimention"],["20", "arcnt"],["21", "size"],["22", "uom"],["23", "totsize"],["24", "fltype"],["25","dwalltype"],["26", "celingtype"],["27", "action"],["28","actioncode"],["29","bldgarid"],["30","bldgnumtxt"]]);
		
           $("#propertyregsitration_from").submit(function(e){
                //alert('submit intercepted');

                e.preventDefault(e);
                if({{$iseditable}} == 0) {
                	window.location.assign('propertyregister?pb={{$pb_id}}');
                } 	else {
				
				var noty_id = noty({
					layout : 'center',
					text: 'Are want to register property?',
					modal : true,
					buttons: [
						{type: 'button blue', text: 'Submit', click: function($noty) {
				  
							$noty.close();
			

	                //var ldata;

					//console.log($('#lottble').DataTable().row(0).data());
					
					var lotdata = [];

					for (var i = 0;i<$('#lottble').DataTable().rows().count();i++){
						var ldata = $('#lottble').DataTable().row(i).data();
						var tempdata1 = {};
						$.each(ldata, function( key, value ) {
							if (key !== 34) {
							tempdata1[lotmap.get(""+key+"")] = value; 
							} 
						//console.log(key);            
		            	});
		            	//console.log(templotdata);
		            	lotdata.push(tempdata1);            	
					}
					
					var ownerdata = [];

					for (var j = 0;j<$('#ownertble').DataTable().rows().count();j++){
						var ldata1 = $('#ownertble').DataTable().row(j).data();
						var tempdata2 = {};
						$.each(ldata1, function( key, value ) {
							if (key !== 17 && key !== 27) {
								tempdata2[ownermap.get(""+key+"")] = value; 
							} 
						//console.log(key);            
		            	});
		            	//console.log(templotdata);
		            	ownerdata.push(tempdata2);            	
					}
					
					var bldgdata = [];
					var test = [];
			
			//var bldgnum ="";
					for (var k = 0;k<$('#bldgtble').DataTable().rows().count();k++){
						var ldata2 = $('#bldgtble').DataTable().row(k).data();
						var tempdata3 = {};
						$.each(ldata2, function( key, value ) {
							if (key !== 18 && key !== 1 ) {
								tempdata3[bldgmap.get(""+key+"")] = value;	
							}	

							/*if(key === 2){
								bldgnum = value;
							}*/
												           
		            	});
		            	//console.log(templotdata);
		            	bldgdata.push(tempdata3);
		            	//bldgdata[k].concat(tempdata3);            	
					}

					var bldgardata = [];
		
					for (var k = 0;k<$('#bldgartable1').DataTable().rows().count();k++){
						var ldata2 = $('#bldgartable1').DataTable().row(k).data();
						var tempdata3 = {};
						$.each(ldata2, function( key, value ) {
							//masukk
							//alert(key + ' == ' + value);
							if (key !== 28) {
							tempdata3[bldgarmap.get(""+key+"")] = value;	
							}				           
		            	});
		            	//console.log(templotdata);
		            	bldgardata.push(tempdata3);
		            	//bldgdata[k].concat(tempdata3);            	
					}
					//bldgdata = bldgdata).replace('[', '{');
					//bldgdata = JSON.stringify(bldgdata).replace(']', '}');

					if ($('#bldgtble').DataTable().rows().count() > 1)
						bldgdata = "["+ JSON.stringify(bldgdata).replace(/]|[[]/g, '') +"]";
					else
						bldgdata = JSON.stringify(bldgdata).replace(/]|[[]/g, '');

					if ($('#lottble').DataTable().rows().count() > 1)
						lotdata =  "["+  JSON.stringify(lotdata).replace(/]|[[]/g, '') +"]";
					else
						lotdata = JSON.stringify(lotdata).replace(/]|[[]/g, '');
					

					if ($('#bldgartable1').DataTable().rows().count() > 1)
						bldgardata =  "["+  JSON.stringify(bldgardata).replace(/]|[[]/g, '') +"]";
					else
						bldgardata = JSON.stringify(bldgardata).replace(/]|[[]/g, '');


					if ($('#ownertble').DataTable().rows().count() > 1)
						ownerdata =  "["+  JSON.stringify(ownerdata).replace(/]|[[]/g, '') +"]";
					else
						ownerdata = JSON.stringify(ownerdata).replace(/]|[[]/g, '');
					
					if(bldgardata === ''){
						bldgardata = "{}";
					}

					if(bldgdata === ''){
						bldgdata = "{}";
					}

					if($('#bldgtype').val() === 0){
						bldgdata = "{}";
						bldgardata = "{}";
					}
					
					//console.log(bldgdata);
					var masterdata = {};
					$('#propertyregsitration_from').serializeArray().map(function(x){masterdata[x.name] = x.value;});
					var pb = '{{$pb}}';
	//console.log(JSON.stringify(bldgdata));
	$('#finishloader').html('<div class="simplemodal-overlay" style="background: none repeat scroll 0 0 black;opacity: 0.5; height: 100%; width: 100%; position: fixed; left: 0px; top: 0px; z-index: 1001;"><span><img style="    display: block; '+
						' margin-left: auto; '+
						' margin-right: auto; '+
						' text-align: center; '+
						' vertical-align: middle;'+
						' margin-top: 300px;" src="images/ajax-loader/ajax-loader(6).gif" alt="Loader"></span></div>');
				 
	var status = $('#propertystatus').val();
			
			if (status === "Registered") {
					
							$("#finishloader").html('');
				        	var noty_id = noty({
								layout : 'top',
								text: 'Property Already Registered successfully!',
								modal : true,
								type : 'success'
							});	
					} else if($('#ownertble').DataTable().rows().count()  === 0){
						alert('please add atleast one owner detail');
						$("#finishloader").html('');
					}  else if($('#lottble').DataTable().rows().count()  === 0){
						alert('please add atleast one owner detail');
						$("#finishloader").html('');
					} else {
						$.ajax({
				  				type: 'POST', 
							    url:'registerproperty',
							    headers: {
								    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
						        data:{masterdata:JSON.stringify(masterdata),lotdata:lotdata,ownerdata:ownerdata,bldgdata:bldgdata,bldgardata:bldgardata,type:'tab',pb:pb,prop_id:'{{$prop_id}}'},
						        success:function(data){
						        	$('#propertystatus').val('Registered');
									$('#finishloader').html('');
						        	var noty_id = noty({
										layout : 'top',
										text: 'Property Registered successfully!',
										modal : true,
										type : 'success', 
									});					        		
						        	//$("#finish").attr("disabled", true);
						        	//clearTableError(4);
					        	},
						        error:function(data){
									//$('#loader').css('display','none');
						        	$('#propertystatus').val('UnRegistered');	
						        	$('#finishloader').html('');     	
						        		var noty_id = noty({
										layout : 'top',
										text: 'Problem while registerting property!',
										modal : true,
										type : 'error', 
									});
					        	}
					    	});
					
					}
					$('#loader').html('');


						  }
						},
						{type: 'button pink', text: 'Cancel', click: function($noty) {
							$noty.close();
						  }
						}
						],
					 type : 'success', 
				 });
		
			
			}

            });

			

		
        });

function loader(){

}
</script>
</div>
</body>
</html>