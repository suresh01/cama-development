
			<div  id="basic-modal-content">
				<h3>Filter</h3>
				<form action="" id="filterForm" method="get" class="form_container">	
					@csrf
				<input type="hidden" name="filter" value="true">			
					<ul id="filterrow">	
						<li class="li">
								<div class="form_grid_12 multiline">
									<div class="form_input">
										<div class="form_grid_3">
											<span class=" label_intro">Field</span>
											<select data-placeholder="Choose a Custom..." style="width:100%" class="cus-select field" id="custom" name="field[]" tabindex="20"><option value="0">Please select Filter</option>
												@foreach ($search as $rec)
												<option value="{{ $rec->sd_keymainfield }}">{{ $rec->sd_label }}</option>
												@endforeach
											</select>
										</div>
										<div class="form_grid_2">
											<span class=" label_intro">Condition</span>
											<select data-placeholder="Choose a Custom..." style="width:100%" class="cus-select" id="condition" name="condition[]" tabindex="20">
												<option value="=">Equal</option>
												<option value="LIKE">Like</option>
												<option value="<>">Not Equal</option>
											</select>
										</div>
										 <input type="hidden" class="firstrow" value="firstrow" id="firstrow"><div class="value form_grid_3"><span class="label_intro">Value</span>
											
											<input class="value" type="text" name="value[]" >
										</div>
										<div class="form_grid_2">
											<span class=" label_intro">Relation</span>
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
						<a href="#" id="" onclick="addfilter(1)" class=""><span>Add </span></a>
					</div>
					<div class="btn_24_blue">						
						<!--<button id="addsubmit"type="submit" class="btn_small btn_blue"><span>Submit</span></button>	-->
						<a href="#" disabled="true" onclick="submitForm()" class=""><span>Submit </span></a>	
					</div>
					<div class="btn_24_blue">
						<a href="#" onclick="terminate()" class="simplemodal-close"><span>Close </span></a>
					</div>
					</form>
			</div>
			<div style="display: none;" id="view"></div>
			<a href="#" class="basic-modal">Add Filter</a>

			<div style="display: none;" id="manaual-filter-placeholder">
				
			</div>
<script>
	var i = 0;
	var BULDINGTYPE = "";
	var BULDINGTYPE2 = "";
	var parenttypeid = "";
	var xhr;

	$(document).ready(function (){

		waitingIndicator('searchLoader'); //waiting indicator

		$('#simplemodal-overlay').css('display', 'block');
		$('.simplemodal-close').click(function(){
			//alert('');
			

			$('#manaual-filter-placeholder').html($('#filterrow').html());
			$('#basic-modal-content').css('display', 'none');
		});
		$('.basic-modal').click(function(){
			$.ajax({
		        type:'GET',
		        url:'/getaccess',
		        data:{module:211},
		        success:function(data){	        	
		        	if(data.msg === "false"){
		        		alert("211 - "
		        			+"We are sorry "
							+" The function you are trying to access does not have permission :(");

		        		//return "false";
		        	} else {
	        		
						var content = $('#manaual-filter-placeholder').html();
						if (content.trim() != "" ){
							$('#filterrow').html(content);
							$('#manaual-filter-placeholder').html('');

							
					
						}
						filterAction();
						
		        	}
		        }
		    });
			
			//$('#simplemodal-overlay').css('display', 'block');
			//$('#simplemodal-container').css('display', 'block');
			//$('#basic-modal-content').css('display', 'none');
		});

		


	});


	function submitForm(){
		//console.log($("#filterForm").serialize());
		var table = $('#proptble').DataTable();
		table.clear();

		var date = new Date();
		var timestamp = date.getTime();
		
		var table = $('#proptble').DataTable();

		$('#searchLoader').attr('style','display:block');

		xhr = $.ajax({
            url: 'existspropertydata?test=manual&ts_='+timestamp,
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


		filterAction();
		


	}

	function discardFilter() {

		alert('This will discard filters');		
		return false;

	}

	function terminate(){
		if (xhr != undefined)
		xhr.abort();
	}

	function filterAction(){
		//alert();
		$('.remove').click(function() {
			//event.preventDefault();
			$(this).closest(".li").remove();
		});
		$('#basic-modal-content').height("300");
		var searchid = 18;
		$(".value_drop").change(function(){
	    	//alert($("#value_BULDINGTYPE").find('option:selected').text());
	    	//alert(BULDINGTYPE2);
	    	var id  = BULDINGTYPE2;
	    	var parentid = $(this).val();
			var parentvalue = $("#value_vt_id").find('option:selected').val();
			if(parentvalue == ''){
				parentvalue = $("#value_va_vt_id").find('option:selected').val();
			}
		   // var parentvalue = $('#value_Term').find('option:selected').val();
	    	//parenttypeid = $(this).val();


		    //$(this).find("option").removeAttr('selected');
		    $(this).find("option[value=" + parentid +"]").attr('selected','true');


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
		   // var selectedvalue = $(this).find('option:selected').text();
		     var selectedvalue = $(this).val();
		    //selectedvalue =;
		    
		    $(this).find("option").removeAttr('selected');
		    $(this).find("option[value='" + id +"']").attr('selected', true);

		    BULDINGTYPE = selectedvalue.replace(/\s+\./g, '');
		    BULDINGTYPE = selectedvalue.replace(/\./g, '');
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
	    	//alert(BULDINGTYPE);
	    	/*if (BULDINGTYPE == "tbdefitems_subzonetdi_key") {
	    		termid = $('#value_tbdefitems_subzonetdi_parent_key').find('option:selected').val();
	    	} else if(BULDINGTYPE == "subzone.tdi_key"){
	    		termid = $('#value_subzone.tdi_parent_key').find('option:selected').val();
	    	} else if(BULDINGTYPE == "va_id"){

	    		termid = $('#value_va_vt_id').find('option:selected').val();
	    	} else if(BULDINGTYPE == "vt_id"){

	    		termid = $('#value_vt_applicationtype_id').find('option:selected').val();
	    	}*/

	    	if (BULDINGTYPE == "tbdefitems_subzonetdi_key") {
	    		termid = $('#value_tbdefitems_subzonetdi_parent_key').find('option:selected').val();
	    	} else if(BULDINGTYPE == "SUBZONEtdi_key"){
	    		termid = $('#value_SUBZONEtdi_parent_key').find('option:selected').val();
	    	} else if(BULDINGTYPE == "va_id"){
	    		termid = $('#value_va_vt_id').find('option:selected').val();
	    	} else if(BULDINGTYPE == "vt_id"){
	    		termid = $('#value_BULDINGTYPEtdi_key').find('option:selected').val();
	    	} else if(BULDINGTYPE == "vt_id"){
	    		termid = $('#value_BULDINGTYPEtdi_parent_key').find('option:selected').val();
	    	}
	    	//alert(BULDINGTYPE);
			//termid = $('#value_'+selectedvalue).find('option:selected').val();

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
							$(self).parent().parent().find(".value").html($valueLbl + '<select data-placeholder="Choose a Custom..." id="value_'+ selectedvalue.replace(/\./g, '')+'" style="width:100%;" class="cus-select value_drop" '+
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


</script>
</body>
</html>
		