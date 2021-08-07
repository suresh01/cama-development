
			<div  id="basic-modal-content">
				<h3>{{__('search.filter')}}</h3>
				<form action="" id="filterForm" method="get" class="form_container">	
					@csrf
				<input type="hidden" name="filter" value="true">			
					<ul id="filterrow">	
						<li class="li">
								<div class="form_grid_12 multiline">
									<div class="form_input">
										<div class="form_grid_3">
											<span class=" label_intro">{{__('search.field')}}</span>
											<select data-placeholder="Choose a Custom..." style="width:100%" class="cus-select field" id="custom" name="field[]" tabindex="20"><option value="0">{{__('search.selectfilter')}}</option>
												@foreach ($search as $rec)
												<option value="{{ $rec->sd_keymainfield }}">{{ $rec->sd_label }}</option>
												@endforeach
											</select>
										</div>
										<div class="form_grid_2">
											<span class=" label_intro">{{__('search.condition')}}</span>
											<select data-placeholder="Choose a Custom..." style="width:100%" class="cus-select" id="condition" name="condition[]" tabindex="20">
												<option value="=">Equal</option>
												<option value="LIKE">Like</option>
												<option value="<>">Not Equal</option>
											</select>
										</div>
										 <input type="hidden" class="firstrow" value="firstrow" id="firstrow"><div class="value form_grid_3"><span class="label_intro">{{__('search.value')}}</span>
											
											<input class="value" type="text" name="value[]" >
										</div>
										<div class="form_grid_2">
											<span class=" label_intro">{{__('search.relation')}}</span>
											<select data-placeholder="Choose a Custom..." style="width:100%" class="cus-select" id="relation" name="logic[]" tabindex="20">
												<option value="AND">AND</option>
												<option value="OR">OR</option>
											</select>
										</div> 
										<span class="clear"></span>
									</div>
								</div>
							</li>						
					</ul>	
					<div style="display: none;" id="searchLoader">
						
					</div>
					<div class="btn_24_blue">
						<a href="#" id="" onclick="addfilter(1)" class=""><span>{{__('search.add')}} </span></a>
					</div>
					<div class="btn_24_blue">						
						<!--<button id="addsubmit"type="submit" class="btn_small btn_blue"><span>Submit</span></button>	-->
						<a href="#" disabled="true" onclick="submitForm()" class=""><span>{{__('search.submit')}} </span></a>	
					</div>
					<div class="btn_24_blue">
						<a href="#" onclick="terminate()" class="simplemodal-custom-close"><span>{{__('search.close')}} </span></a>
					</div>
					</form>
			</div>
			<div style="display: none;" id="view"></div>
			<a href="#" class="basic-custom-modal1">{{__('search.addfilter')}}</a>
<script>
	var i = 0;
	var BULDINGTYPE = "";
	var BULDINGTYPE2 = "";
	var parenttypeid = "";
	var xhr;

	$(document).ready(function (){

		waitingIndicator('searchLoader'); //waiting indicator

		$('#simplemodal-overlay').css('display', 'block');
		$('.simplemodal-custom-close').click(function(){
			//alert('');
			$('#simplemodal-overlay').css('display', 'none');
			$('#simplemodal-container').css('display', 'none');
			$('#basic-modal-content').attr('name','hide');

			
			//$('#basic-modal-content').css('display', 'none');;JSON.parse(this.responseText)
		});
		$('.basic-custom-modal1').click(function(){
			
    		var status = $('#basic-modal-content').attr('name');
			//alert($('#basic-modal-content').attr('name'));
			if(status == 'hide'){
				console.log("23");
				$('#simplemodal-overlay').css('display', 'block');
				$('#simplemodal-container').css('display', 'block');
			} else {
				console.log("24");
				$('#simplemodal-overlay').css('display', 'block');
				$('#simplemodal-container').css('display', 'block');
				$('#basic-modal-content').modal();
			}
        	
		});

		$('.remove').click(function() {
			//event.preventDefault();
			$(this).closest(".li").remove();
		});

		$('#basic-modal-content').height("300");
		var selectedparentvalue = '';
		$(".value_drop").change(function(){
	    	//alert($("#value_BULDINGTYPE").find('option:selected').text());
	    	//alert(BULDINGTYPE2);
	    	var id  = BULDINGTYPE2;
	    	var parentid = $(this).val();
		    var parentvalue = $('#value_Term').find('option:selected').val();
	    	//parenttypeid = $(this).val();
	    	selectedparentvalue = parentid;
	    	console.log(parentid);
	    	var date=new Date();
	    	var filter = "true";
	    	//$(selector).trigger("change");
	    	$.ajax({
		        type:'GET',
		        url:'getcustomfilterdata?date='+ date.getTime(),
		        data:{id:id,filter:filter,parentid:parentid,type:'report',parentvalue:parentvalue},
		        success:function(data){
					//alert("#value_"+BULDINGTYPE);
					$("#value_"+BULDINGTYPE).html("");
					var result = data.result;
					for (var i = 0; i < result.length; i++) {					
			        		$("#value_"+BULDINGTYPE).append('<option value="'+result[i].tdi_key+'">'+result[i].sd_definitionkeyname+'</option> ');						
				    }     
	        	}
	    	});

	    });

		$(".field").change(function(){
			//value_drop
			//alert();
			console.log($(this).val());
		    var id= $(this).val();
		    var selectedvalue = $(this).find('option:selected').text();
		    //selectedvalue =;
		    
		    BULDINGTYPE = selectedvalue.replace(/\s+/g, '');
		    BULDINGTYPE2 = selectedvalue;
		    var self = this;
		    var flag = "true";
		    var d=new Date();
		    var proplist = '';
			var firstrow = $(self).parent().parent().find("#firstrow").val();
			if(firstrow == "firstrow"){
				$valueLbl = "<span class='label_intro'>Value</span>";
			} else {
				$valueLbl = "";
			}
			var searchid = 39;
			var termid = selectedparentvalue;// $('#value_Term').find('option:selected').val();
			console.log('ttt ==: '+$(this).find('option:selected').text());
	        $.ajax({
		        type:'GET',
		        url:'getcustomfilterdata?date='+ d.getTime(),
		        data:{id:selectedvalue,searchid:searchid,parentid:termid},
		        success:function(data){
					var isparent = false;
					$(".field").each(function () {
						//alert(data.parent+" - "+$(this).find('option:selected').text());
						if (data.parent == "" || data.parent == null){
							isparent = true;
							return;
						} else if (data.parent == $(this).find('option:selected').text()){
							isparent = true;
							return;
						}x
					});
					//alert(isparent);
					if(isparent){
			        	var result = data.result;
			        	
			        	for (var i = 0; i < result.length; i++) {
			        		flag = "false";
							proplist += '<option value="'+result[i].tdi_key+'">'+result[i].sd_definitionkeyname+'</option> ';
				        }
				        if(flag == "false"){
							$(self).parent().parent().find(".value").html($valueLbl + '<select data-placeholder="Choose a Custom..." id="value_'+ selectedvalue.replace(/\s+/g, '')+'" style="width:100%;" class="cus-select value_drop" '+
							'id="value" name="value[]"  tabindex="20"> '+
							proplist +
							'</select>');
						} else {
							$(self).parent().parent().find(".value").html($valueLbl + '<input type="text"  name="value[]" >');			
						}
					} else {
						alert('Please select '+data.parent+' first');
						$(this).val(0);
					}
			        
	        	}
	    	});
	        
			//alert();
			if(flag != "false"){
				$(self).parent().parent().find(".value").html($valueLbl + '<input type="text" name="value[]">');
			}
			
		});	


	});

	function submitForm(){
		//console.log($("#filterForm").serialize());
		var table = $('#propdatatable').DataTable();
		table.clear();

		var date = new Date();
		var timestamp = date.getTime();
		
		var table = $('#propdatatable').DataTable();

		$('#searchLoader').attr('style','display:block');

		xhr = $.ajax({
            url: 'accountsearchdata?test=manual&ts_='+timestamp,
            type: 'GET',
            data: $("#filterForm").serialize()
        }).done(function (result) {
        	if(result.recordsTotal == 0) {
        		alert('No records found');
        	}
        	$('#searchLoader').attr('style','display:none');
	        table.rows.add(result.data).draw();
			
			//alert();
	       // $('#searchLoader').hide();
		
        }).fail(function (jqXHR, textStatus, errorThrown) {            	 
            console.log(errorThrown);      	 
            alert(errorThrown);
			$('#searchLoader').attr('style','display:none');
           // $('#searchLoader').hide();
		
        });

      //  $.ajax.abortAll();
	}

	function addfilter(isFirstRow){
		$('.simplemodal-wrap').css('overflow-y', 'scroll');
		var $container = $("#filterrow");
		var $removeRow = "";
		var $valueLbl = "";
		if(isFirstRow == 1){
			$removeRow ='<div class=""> <div class="btn_24_blue"> '+
						'<a href="#" style="color:#111;" class="remove"><span class="icon cross_co"></span><span>Remove </span></a>'+
						' </div></div>';

				$valueLbl = "";
				$container.append('<li class="li"><div class="form_grid_12 multiline"><div class="form_input">'+
								' <div class="form_grid_3">'+
								'			<select data-placeholder="Choose a Custom..." style="width:100%" class="cus-select field" id="custom" name="field[]" tabindex="20"><option value="0">Please select Filter</option>'+
								'				@foreach ($search as $rec)'+
								'				<option value="{{ $rec->sd_keymainfield }}">{{ $rec->sd_label }}</option>'+
								'				@endforeach'+
								'			</select>'+
								'		</div>'+
								'		<div class="form_grid_2">'+
								'			<select data-placehsolder="Choose a Custom..." style="width:100%" class="cus-select" id="condition" name="condition[]" tabindex="20">'+
								'				<option value="=">Equal</option>'+
								'				<option value="LIKE">Like</option>'+
								'				<option value="<>">Not Equal</option>'+
								'			</select>'+
								'		</div>'+
								'		<div  class="value form_grid_3">'+
								'			<input type="text" name="value[]" >'+
								'		</div>'+
								'		<div class="form_grid_2">'+
								'			<select data-placeholder="Choose a Custom..." style="width:100%" class="cus-select" id="relation" name="logic[]" tabindex="20">'+
								'				<option value="AND">AND</option>'+
								'				<option value="OR">OR</option>'+
								'			</select>'+
								'		</div>'+ $removeRow +
								'		<span class="clear"></span>'+
								'	</div>'+
								'</div>'+
							'</li>');
		}


		
		$('.remove').click(function() {
			//event.preventDefault();
			$(this).closest(".li").remove();
		});
		$('#basic-modal-content').height("300");
		var searchid = 39;
		$(".value_drop").change(function(){
	    	//alert($("#value_BULDINGTYPE").find('option:selected').text());
	    	//alert(BULDINGTYPE2);
	    	var id  = BULDINGTYPE2;
	    	var parentid = $(this).val();
		    var parentvalue = $('#value_Term').find('option:selected').val();
	    	//parenttypeid = $(this).val();
	    	console.log(parentid);
	    	var date=new Date();
	    	var filter = "true";
	    	$.ajax({
		        type:'GET',
		        url:'getcustomfilterdata?date='+ date.getTime(),
		        data:{id:id,searchid:searchid,filter:filter,parentid:parentid,type:'report',parentvalue:parentvalue},
		        success:function(data){
					//alert("#value_"+BULDINGTYPE);
					$("#value_"+BULDINGTYPE).html("");
					var result = data.result;
					for (var i = 0; i < result.length; i++) {					
			        		$("#value_"+BULDINGTYPE).append('<option value="'+result[i].tdi_key+'">'+result[i].sd_definitionkeyname+'</option> ');						
				    }     
	        	}
	    	});

	    });

		$(".field").change(function(){
			//value_drop
			//alert();
			console.log($(this).val());
		    var id= $(this).val();
		    var selectedvalue = $(this).find('option:selected').text();
		    //selectedvalue =;
		    
		    BULDINGTYPE = selectedvalue.replace(/\s+/g, '');
		    BULDINGTYPE2 = selectedvalue;
		    var self = this;
		    var flag = "true";
		    var d=new Date();
		    var proplist = '';
			var firstrow = $(self).parent().parent().find("#firstrow").val();
			if(firstrow == "firstrow"){
				$valueLbl = "<span class='label_intro'>Value</span>";
			} else {
				$valueLbl = "";
			}
			//alert(BULDINGTYPE);
			//filter:"true"
			/*$.ajax({
		        type:'GET',
		        url:'getparentid?date='+ d.getTime(),
		        data:{label:BULDINGTYPE,searchid:22},
		        success:function(data){
	        	} Subzone
	    	});*/
	    	var termid = "";
	    	if (BULDINGTYPE == "PropertyType") {
	    		termid = $('#value_PropertyCategory').find('option:selected').val();
	    	} else if(BULDINGTYPE == "Subzone"){

	    		termid = $('#value_Zone').find('option:selected').val();
	    	}


	    	
	    	if (BULDINGTYPE == "JenisHarta") {
	    		termid = $('#value_KategoriHarta').find('option:selected').val();
	    	} else if(BULDINGTYPE == "Taman/Kawasan"){

	    		termid = $('#value_Mukim').find('option:selected').val();
	    	}
	    	//alert(BULDINGTYPE);
			

	        $.ajax({
		        type:'GET',
		        url:'getcustomfilterdata?date='+ d.getTime(),
		        data:{id:selectedvalue,searchid:searchid,parentid:termid},
		        success:function(data){
					var isparent = false;
					$(".field").each(function () {
						//alert(data.parent+" - "+$(this).find('option:selected').text());
						if (data.parent == "" || data.parent == null){
							isparent = true;
							return;
						} else if (data.parent == $(this).find('option:selected').text()){
							isparent = true;
							return;
						}

					});
					//alert(isparent);
					if(isparent){
			        	var result = data.result;
			        	
			        	for (var i = 0; i < result.length; i++) {
			        		flag = "false";
							proplist += '<option value="'+result[i].tdi_key+'">'+result[i].sd_definitionkeyname+'</option> ';
				        }
				        if(flag == "false"){
							$(self).parent().parent().find(".value").html($valueLbl + '<select data-placeholder="Choose a Custom..." id="value_'+ selectedvalue.replace(/\s+/g, '')+'" style="width:100%;" class="cus-select value_drop" '+
							'id="value" name="value[]"  tabindex="20"> '+
							proplist +
							'</select>');
						} else {
							$(self).parent().parent().find(".value").html($valueLbl + '<input type="text"  name="value[]" >');			
						}
					} else {
						alert('Please select '+data.parent+' first');
						$(this).val(0);
					}
			        
	        	}
	    	});
	        
			//alert();
			if(flag != "false"){
				$(self).parent().parent().find(".value").html($valueLbl + '<input type="text" name="value[]">');
			}
			
		});	 


	}

	function discardFilter() {

		alert('This will discard filters');		
		return false;

	}

	function terminate(){
		if (xhr != undefined)
		xhr.abort();
	}



</script>
</body>
</html>