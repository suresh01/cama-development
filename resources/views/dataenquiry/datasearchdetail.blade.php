<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{__('tab.Property_Detail')}}</title>
<style>
.disabled-btn{
    pointer-events:none;
    opacity:0.7;
}

	.right-text {
		text-align:right;
	}
	.tbl-total {
		text-align:right;
		float: inline-end;
	}
</style>
@include('includes.header', ['page' => 'dataenquery'])
	
	<div id="content">
		<div class="grid_container">	
			
		<div id="usertable" class="grid_12">	
			<div id="breadCrumb3" class="breadCrumb grid_12">
					<ul>
						<li><a href="#">{{__('menu.home')}}</a></li>
						<li><a href="#">{{__('menu.dataenquiry')}}</a></li>
						<li>{{__('menu.propertysearch')}}</li>
					</ul>
				</div>
			<br>

			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<!--<span class="h_icon list"></span>-->
						<h6>{{__('datasearch.propdetail')}}</h6>
						<div id="top_tabby">
						</div>
					</div>
					<input type="hidden" value="" id="propertystatus" >
					<div class="widget_content">
						<!--<h3>Property Registration</h3>-->
						<form action="datasearch"  id="propertyinspectionform" class="form_container left_label">
							<fieldset title="{{__('datasearch.step')}} 1">		
								<legend>{{__('datasearch.masinfo')}}</legend>	
								@include('dataenquiry.tab.master')	
							</fieldset>
							<fieldset title="{{__('datasearch.step')}} 2">
								<legend>{{__('datasearch.owninfo')}}</legend>
								@include('dataenquiry.tab.ownerold')	
							</fieldset>
							@if($applntype == 'C')
								<fieldset title="{{__('datasearch.step')}} 2">
									<legend>{{__('datasearch.rateinfo')}}</legend>
									@include('dataenquiry.tab.ratepayer')	
								</fieldset>
								<fieldset title="{{__('datasearch.step')}} 3">
									<legend>{{__('datasearch.tenantinfo')}}</legend>									
									@include('dataenquiry.tab.tenant')							
								</fieldset>
							@endif
							<fieldset title="{{__('datasearch.step')}} 4">
								<legend>{{__('datasearch.lotinfo')}}</legend>
								@include('dataenquiry.tab.lot')	
							</fieldset>
							<fieldset title="{{__('datasearch.step')}} 5">
								<legend>{{__('datasearch.propuse')}}</legend>
								@include('dataenquiry.tab.parameter')
							</fieldset>
							<fieldset title="{{__('datasearch.step')}} 6">
								<legend>{{__('datasearch.bldginfo')}}</legend>
								@include('dataenquiry.tab.bldg')					
							</fieldset>	
							<fieldset title="{{__('datasearch.step')}} 7">
								<legend>{{__('datasearch.attachment')}}</legend>	
								@include('dataenquiry.tab.attachment_2')				
							</fieldset>	
							<fieldset title="{{__('datasearch.step')}} 8">
								<legend>{{__('datasearch.valinfo')}}</legend>
								@include('dataenquiry.tab.valuationdetail')					
							</fieldset>	
								<input type="button" onclick="closePage()" class="finish" value="Close!"/>
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
			window.location.assign('datasearch');	
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

		let attachmentmap = new Map([["0","sno"],["1", "filename"], ["2", "vattachtype"], ["3", "atdetail"],["4", "action"], ["5", "attachmentid"],["6", "attachtype"], ["7", "atpath"], ["8", "ext"], ["9", "orgname"],["10", "actioncode"]]);

		function updateAttachment(){

			$("#propertyinspectionform").submit(function(e){
	               

                e.preventDefault(e);
                //alert('submit intercepted');
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

				if ($('#attachmentdatatable').DataTable().rows().count() > 1)
					attachmentdata =  "["+  JSON.stringify(attachmentdata).replace(/]|[[]/g, '') +"]";
				else
					attachmentdata = JSON.stringify(attachmentdata).replace(/]|[[]/g, '');

				if(attachmentdata === ''){
					attachmentdata = "{}";
				}

				console.log(attachmentdata);
				//var prop_id = '{{$prop_id}}';
				/*$.ajax({
	  				type: 'GET', 
				    url:'updateattachment',
				    headers: {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
			        data:{attachmentdata:attachmentdata,prop_id:prop_id},
			        success:function(data){
			        	alert('success');
						//window.location.assign('property?id={{$pb}}');		        		
			        	//$("#finish").attr("disabled", true);
			        	//clearTableError(4);
		        	},
			        error:function(data){
						
		        	}
		    	});*/

				window.location.assign("updateattachment?prop_id={{$prop_id}}&attachmentdata="+attachmentdata);		 

			});
	
	
		}
		

</script>
</body>
</html>