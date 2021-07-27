<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{__('inspection.Property_Inspection')}}</title>
<style>
.disabled-btn{
    pointer-events:none;
    opacity:0.7;
}
</style>
@include('includes.header', ['page' => 'VP'])
	
	<div id="content">
		<div class="grid_container">	
			
		<div id="usertable" class="grid_12">	
			<div id="breadCrumb3" class="breadCrumb grid_12">
					<ul>
						<li><a href="#">{{__('inspection.Home')}} </a></li>
						<li><a href="valterm">{{__('inspection.Valuation_Data_Management')}} </a></li>
						<li><a href="valbasket?id={{$termid}}&ts=1">{{$viewparamterm}} </a></li>
						<li><a href="property?id={{$pb}}&ts=1">{{$viewparambasket}} - {{$viewparambasketstatus}}</a></li>
						<li>{{$accountnumber}} </li>
					</ul>
				</div>
			<br>

			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<!--<span class="h_icon list"></span>-->
						<h6>{{__('inspection.Property_Inspection')}}</h6>
						<div id="top_tabby">
						</div>
					</div>
					<input type="hidden" value="" id="propertystatus" >
					<div class="widget_content">
						<!--<h3>Property Registration</h3>-->
						<form action="" id="propertyinspectionform" class="form_container left_label">
							<fieldset title="Step 1">		
								<legend>{{__('inspection.Master_Information')}}</legend>	
								@include('inspection.tab.master')	
							</fieldset>
							<fieldset title="Step 2">
								<legend>{{__('inspection.Owner_Information')}}</legend>
								@include('inspection.tab.ownerold')	
							</fieldset>
							@if($applntype == 'C')
							<fieldset title="Step 2">
								<legend>{{__('inspection.Ratepayer_Information')}}</legend>
								@include('inspection.tab.ratepayer')	
							</fieldset>
							<fieldset title="Step 3">
								<legend>{{__('inspection.Tenant_Information')}}</legend>									
								@include('inspection.tab.tenant')							
							</fieldset>
							@endif
							<fieldset title="Step 4">
								<legend>{{__('inspection.Lot_Information')}}</legend>
								@include('inspection.tab.lot')	
							</fieldset>
							<fieldset title="Step 5">
								<legend>{{__('inspection.Property_Use')}}</legend>
								@include('inspection.tab.parameter')
							</fieldset>
							<fieldset title="Step 6">
								<legend>{{__('inspection.Building_Information')}}</legend>
								@include('inspection.tab.bldg')					
							</fieldset>
							<fieldset title="Step 7">
								<legend>{{__('inspection.Attachment')}}</legend>
								@include('inspection.tab.attachmentnew')
							</fieldset>			
							@if($iseditable == 1)
								<input type="submit" onclick="loader()" class="finish" id="finish" value="Finish!"/>	
							@else
								<input type="button" onclick="closePage()"  class="finish" value="Close!"/>
								
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
</div>
<script>
		function closePage(){
			//alert();
			window.location.assign('property?id={{$pb}}&ts=1');	
		}
		function addTenant() {
			
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');

		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "tenantSearch";
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}	  
			
		}
		
		function addRatepayer() {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');

		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "ratepayersearch";
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}


 
		function CallParent(table){
          	var id = $.map(table.rows('.selected').data(), function (item) {
        		return item[0]
   			});
            var data = table.data();
			var newarray=[];       
	        for (var i=0; i < data.length ;i++){
	           console.log(data[i][0]);
	           if(data[i][0] == id) {
	           		$('#ratepayertble').DataTable().row.add([ 'New',data[i][2],data[i][4]+ ' / '+data[i][5] , data[i][6],data[i][7], data[i][8], data[i][10], data[i][9], '<span><a class="action-icons c-Delete deleteratepayerrow"  href="#" title="Delete">Delete</a></span>', 'new',data[i][0]]).draw( false );
	           }
	        }
		}

		function tenantParent(table){
          	var id = $.map(table.rows('.selected').data(), function (item) {
        		return item[0]
   			});
            var data = table.data();
			var newarray=[];       
	        for (var i=0; i < data.length ;i++){
	           console.log(data[i][0]);
	           if(data[i][0] == id) {
	           		$('#tenanttble').DataTable().row.add([ 'New',data[i][2],data[i][4]+ ' / '+data[i][5] , data[i][6],data[i][7], data[i][8], data[i][11], data[i][10], '<span><a class="action-icons c-Delete deletetenantrow"  href="#" title="Delete">Delete</a></span>', 'new',data[i][0]]).draw( false );
	           }
	        }    		
		}

		$(document).ready(function() {


		
		
		let lotmap = new Map([["0","sno"],["1", "lotstate"], ["2", "lotdistrict"], ["3", "lotcity"],["4", "presint"], ["5", "lotype"],["6", "lotnum"], ["7", "altlotnum"],["8", "lttt"], ["9", "ltnum"],["10", "altnum"], ["11", "landar"],["12", "landaruni"],["13", "landcon"], ["14", "lanpos"],["15", "roadtype"], ["16", "roadcate"],["17", "landuse"], ["18", "expcon"],["19", "interest"], ["20", "tentype"],["21", "tenduration"], ["22", "tenstart"],["23", "tenend"], ["24", "status"],["25", "action"],["26", "actioncode"],["27", "lot_id"],["28", "lotaccnum1"],["29", "lotaccnum2"],["30", "lotaccnum3"],["31", "lotaccnum4"],["32", "lotaccnum5"],["33", "lotaccnum6"],["34", "lotaccnum7"],["35", "lotaccnum"],["36", "lostratano"]]);

		let ownermap = new Map([["0","sno"],["1", "ownaplntype"], ["2", "typeofown"], ["3", "ownnum"],["4", "ownname"], ["5", "ownaddr1"],["6", "ownaddr2"], ["7", "ownaddr3"],["8", "ownaddr4"], ["9", "ownpostcode"],["10", "ownstate"], ["11", "telno"],["12", "faxno"],["13", "citizen"], ["14", "race"],["15", "numerator"], ["16", "demominator"],["17", "action"], ["18", "actioncode"],["19", "ownerid"],["20","owneraccnum"]]);

		let bldgmap = new Map([["0","sno"],["1", "url"],["2", "bldgnum"],["3", "bldgnum1"],["4", "bldgnum2"],["5", "bldgnum3"],["6", "bldgnum4"],  ["7", "bldgttype"],["8", "bldgstorey"], ["9", "bldgcond"],["10", "bldgpos"], ["11", "bldgstructure"],["12", "rooftype"], ["13", "walltype"],["14", "floortype"], ["15", "cccdt"],["16", "occupieddt"],["17", "mainbldg"],["18", "action"],["19", "actioncode"],["20", "bldgid"],["21","bldgaccnum"],["22","mbldg"]]);

		
		 let bldgarmap = new Map([["0","sno"],["1", "bldgaccnum"],  ["2", "bldgnum"], ["3", "bldgnum2"], ["4", "bldgnum4"], ["5", "bldgnum5"], ["6", "bldgnum7"], ["7", "bldgnu8m"], ["8", "bldgnu2m"], ["9", "bldgnum7"], ["10", "bldgnu8m"], ["11", "bldgnu2m"], ["12", "bldgnu80m"],["13", "reffinfo"], ["14", "artype"],["15", "arcate"], ["16", "arlevel"],["17", "arzone"], ["18", "aruse"],["19", "ardesc"], ["20", "dimention"],["21", "arcnt"],["22", "size"],["23", "uom"],["24", "totsize"],["25", "fltype"],["26","dwalltype"],["27", "celingtype"],["28", "action"],["29","actioncode"],["30","bldgarid"]]);

		 let ratepayermap = new Map([["0","sno"],["1", "bldgaccnum"],  ["2", "bldgnum"], ["3", "bldgnum2"], ["4", "bldgnum4"], ["5", "bldgnum5"], ["6", "bldgnum7"], ["7", "bldgnu8m"], ["8", "bldgnu2m"],  ["9", "actioncode"], ["10", "rp_id"]]);

		  let tenantmap = new Map([["0","sno"],["1", "bldgaccnum"],  ["2", "bldgnum"], ["3", "bldgnum2"], ["4", "bldgnum4"], ["5", "bldgnum5"], ["6", "bldgnum7"], ["7", "bldgnu8m"], ["8", "bldgnu2m"],  ["9", "actioncode"], ["10", "te_id"]]);

		  let attachmap = new Map([["0","sno"],["1", "filename"], ["2", "attype"], ["3", "desc"],["4", "action"], ["5", "actioncode"],["6", "id"]]);
		
		  let attachmentmap = new Map([["0","sno"],["1", "filename"], ["2", "vattachtype"], ["3", "atdetail"],["4", "action"], ["5", "attachmentid"],["6", "attachtype"], ["7", "atpath"], ["8", "ext"], ["9", "orgname"],["10", "actioncode"]]);
		
           $("#propertyinspectionform").submit(function(e){
                //alert('submit intercepted');

                e.preventDefault(e);
                if({{$iseditable}} == 0) {
                	window.location.assign('property?id={{$pb}}&ts=1');
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

				var ratepayerdata = [];

				for (var j = 0;j<$('#ratepayertble').DataTable().rows().count();j++){
					var ldata1 = $('#ratepayertble').DataTable().row(j).data();
					var tempdata2 = {};
					$.each(ldata1, function( key, value ) {
						if (key !== 8) {
							tempdata2[ratepayermap.get(""+key+"")] = value; 
						} 
					//console.log(key);            
	            	});
	            	//console.log(templotdata);
	            	ratepayerdata.push(tempdata2);            	
				}

				var tenantdata = [];

				for (var j = 0;j<$('#tenanttble').DataTable().rows().count();j++){
					var ldata1 = $('#tenanttble').DataTable().row(j).data();
					var tempdata2 = {};
					$.each(ldata1, function( key, value ) {
						if (key !== 8) {
							tempdata2[tenantmap.get(""+key+"")] = value; 
						} 
					//console.log(key);            
	            	});
	            	//console.log(templotdata);
	            	tenantdata.push(tempdata2);            	
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
				var artable = $('#bldgartable1').DataTable(); 
				artable.search('').columns().search('').draw();
				for (var k = 0;k<artable.rows().count();k++){
					var ldata6 = artable.row(k).data();
					var tempdata6 = {};						
					$.each(ldata6, function( key, value ) {
						if (key !== 28) {
							tempdata6[bldgarmap.get(""+key+"")] = value;	
						}				           
	            	});
	            	//console.log(templotdata);
	            	bldgardata.push(tempdata6);
						
	            	//bldgdata[k].concat(tempdata3);            	
				}


				
				var attachmentdata = [];

				for (var j = 0;j<$('#attachmentdatatable').DataTable().rows().count();j++){
					var ldata1 = $('#attachmentdatatable').DataTable().row(j).data();
					var tempdata = {};
					$.each(ldata1, function( key, value ) {
						if (key !== 4) {
							tempdata[attachmentmap.get(""+key+"")] = value; 
						} 
					//console.log(key);            
	            	});
	            	//console.log(templotdata);
	            	attachmentdata.push(tempdata);            	
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

				if ($('#ratepayertble').DataTable().rows().count() > 1)
					ratepayerdata =  "["+  JSON.stringify(ratepayerdata).replace(/]|[[]/g, '') +"]";
				else
					ratepayerdata = JSON.stringify(ratepayerdata).replace(/]|[[]/g, '');

				if ($('#tenanttble').DataTable().rows().count() > 1)
					tenantdata =  "["+  JSON.stringify(tenantdata).replace(/]|[[]/g, '') +"]";
				else
					tenantdata = JSON.stringify(tenantdata).replace(/]|[[]/g, '');
				
				if ($('#attachmentdatatable').DataTable().rows().count() > 1)
					attachmentdata =  "["+  JSON.stringify(attachmentdata).replace(/]|[[]/g, '') +"]";
				else
					attachmentdata = JSON.stringify(attachmentdata).replace(/]|[[]/g, '');

				
				
				
				if(bldgardata === ''){
					bldgardata = "{}";
				}

				if(bldgdata === ''){
					bldgdata = "{}";
				}

				if(ratepayerdata === ''){
					ratepayerdata = "{}";

				}if(tenantdata === ''){
					tenantdata = "{}";
				}

				if($('#bldgtype').val() === 0){
					bldgdata = "{}";
					bldgardata = "{}";
				}

				if(attachmentdata === ''){
					attachmentdata = "{}";
				}
				
				//console.log(bldgdata);
				var masterdata = {};
				$('#propertyinspectionform').serializeArray().map(function(x){masterdata[x.name] = x.value;});
				var prop_id = '{{$prop_id}}';
				var basketid='{{$pb}}';
				//alert(basketid);
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
				} else if($('#lottble').DataTable().rows().count()  === 0){
					alert('please add atleast one Lot detail');
					$("#finishloader").html('');
				} else {
					var d=new Date();
					$.ajax({
			  				type: 'POST', 
						    url:'updateinspection',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{masterdata:JSON.stringify(masterdata),lotdata:lotdata,ratepayerdata:ratepayerdata,bldgdata:bldgdata,bldgardata:bldgardata,ownerdata:ownerdata,tenantdata:tenantdata,attachmentdata:attachmentdata,type:'tab',prop_id:prop_id,pb:basketid},
					        success:function(data){
					        	$('#propertystatus').val('Registered');
								$('#finishloader').html('');
					        	var noty_id = noty({
									layout : 'top',
									text: 'Property Registered successfully!',
									modal : true,
									type : 'success', 
								});			
								window.location.assign('property?id={{$pb}}&ts=1');		        		
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

</script>
</body>
</html>