
			<div  id="basic-modal-content">
				<h3>Filter</h3>
				<form action="inspectionform" id="filterForm" method="get" class="form_container">	
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
						<a href="#" onclick="addfilter(1)" class=""><span>Add </span></a>
					</div>
					<div class="btn_24_blue">						
						<!--<button id="addsubmit"type="submit" class="btn_small btn_blue"><span>Submit</span></button>	-->
						<a href="#" onclick="submitForm()" class=""><span>Submit </span></a>	
					</div>
					<div class="btn_24_blue">
						<a href="#" class="simplemodal-custom-close"><span>Close </span></a>
					</div>
					</form>
			</div>
			<div style="display: none;" id="view"></div>
			<a href="#" class="basic-custom-modal1">Add Filter</a>
<script>
	var i = 0;
	var BULDINGTYPE = "";
	var BULDINGTYPE2 = "";
	var parenttypeid = "";
	$(document).ready(function (){
		
		waitingIndicator('searchLoader'); //waiting indicator

		$('#simplemodal-overlay').css('display', 'block');
		$('.simplemodal-custom-close').click(function(){
			//alert('');
			$('#simplemodal-overlay').css('display', 'none');
			$('#simplemodal-container').css('display', 'none');
			$('#basic-modal-content').attr('name','hide');

			
			//$('#basic-modal-content').css('display', 'none');
		});
		$('.basic-custom-modal1').click(function(){
			$.ajax({
		        type:'GET',
		        url:'/getaccess',
		        data:{module:211},
		        success:function(data){	        	
		        	if(data.msg === "false"){
		        		alert("You Don't have permission");
		        		//return "false";
		        	} else {
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
		        	}
		        }
		    });
			
			//$('#simplemodal-overlay').css('display', 'block');
			//$('#simplemodal-container').css('display', 'block');
			//$('#basic-modal-content').css('display', 'none');
		});


		$('.remove').click(function() {
			//event.preventDefault();
			$(this).closest(".li").remove();
		});
		$('#basic-modal-content').height("300");
		
		
		var searchid = '23';
		$(".value_drop").change(function(){
	    	//alert($("#value_BULDINGTYPE").find('option:selected').text());
	    	//alert(BULDINGTYPE2);
	    	var id  = BULDINGTYPE2;
	    	var parentid = $(this).val();
		    var parentvalue = $('#value_Term').find('option:selected').val();
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
		    var selectedvalue = $(this).find('option:selected').text();
		    //selectedvalue =;
		    
		    $(this).find("option").removeAttr('selected');
		    $(this).find("option[value='" + id +"']").attr('selected', true);

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
	    	} else if(BULDINGTYPE == "Basket"){

	    		termid = $('#value_Term').find('option:selected').val();
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


	});

	function submitForm(){
		//console.log($("#filterForm").serialize());
		//alert($('#value_AttachmentType').val());
		if ($('#value_AttachmentType').val() != undefined) {
			var table = $('#proptble').DataTable();
			table.clear();
			table.destroy();
			reinitate();
			var date = new Date();
			var timestamp = date.getTime();
			$('#searchLoader').attr('style','display:block');
			var table = $('#proptble').DataTable();
			$.ajax({
	            url: 'dmsSearchTables?test=manual&ts_='+timestamp,
	            type: 'GET',
	            data: $("#filterForm").serialize()
	        }).done(function (result) {
	        	if(result.recordsTotal == 0) {
	        		alert('No records found');
	        	}
	        	$('#searchLoader').attr('style','display:none');
		        table.rows.add(result.data).draw();
	        }).fail(function (jqXHR, textStatus, errorThrown) {            	 
	            console.log(errorThrown);
	            alert(errorThrown);
	            $('#searchLoader').attr('style','display:none');
	        });
    	} else {
    		alert('Please select Attahment type');
    	}
	}

	function reinitate(){
		var strname= "vd_id";
		var type = $('#value_AttachmentType').val();
		if (type == '0') {
		$('#proptble').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				
		        // ajax: '{{ url("inspectionproperty") }}',
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
			        {"data": "vd_id", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": null, "name": "sno", "title": "S No"},
			        {"data":  function(data){
			        		//var url = 'datasearchdetail?prop_id='+data.vd_id;
			        		return "<a onclick='filelist("+data.vd_id+")' href='#'>"+data.vd_accno+"</a>";
			        	
			        }, "name": "account number", "title": "Account Number"},
			        {"data": "zone", "name": "fileno", "title": "Zone"},
			        {"data": "subzone", "name": "zone", "title": "Subzone"},
			        {"data":  function(data){
			        		//var url = 'datasearchdetail?prop_id='+data.vd_id;
			        		return data.isbldg+" | "+data.bldgcategory+" | "+data.bldgtype+" | "+data.bldgsotery;
			        	
			        }, "name": "account number", "title": "Building Detail"},
			        {"data": "vt_name", "name": "zone", "title": "Term"},
			        {"data":  function(data){
			        		//var url = 'datasearchdetail?prop_id='+data.vd_id;
			        		return '<span><a onclick="uploadnew('+data.vd_id+')" class="action-icons c-add  addbldgarearow" href="#" title="Upload">Add</a></span>';
			        	
			        }, "name": "account number", "title": "Action"}

		   		], 
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  					var count = $('#proptble').DataTable().rows().count();
					$('#prop_count').html(count);
			        $("td:nth-child(2)", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
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
          //  $(row).find('input[type="checkbox"]').prop('checked', true);
          //  $(row).addClass('selected');
         }
      },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			});
	} else {
		strname= "vt_id";
		var table = $('#proptble').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				 
		        // ajax: '{{ url("inspectionproperty") }}',
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
			        {"data": "vt_id", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": null, "name": "sno", "title": "S No"},
			        {"data": function(data){
			        		//var url = 'datasearchdetail?prop_id='+data.vd_id;
			        		return "<a onclick='filelist("+data.vt_id+")' href='#'>"+data.name+"</a>";
			        	
			        }, "name": "account number","title": "TERM"},
			        {"data": "termDate", "name": "fileno","title": "TERM DATE"},
			        {"data": "termstage", "name": "zone","title": "TERM STATUS"},
			        {"data": "valbase", "name": "subzone","title": "TERM TYPE"},
			        {"data": "applntype", "name": "zone", "title": "Application Type"},
			        {"data":  function(data){
			        		//var url = 'datasearchdetail?prop_id='+data.vd_id;
			        		return '<span><a onclick="uploadnew("'+data.vd_id+'")" class="action-icons c-add  addbldgarearow" href="#" title="Upload">Add</a></span>';
			        	
			        }, "name": "account number", "title": "Action"}
		   		],
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  					var count = $('#proptble').DataTable().rows().count();
					$('#prop_count').html(count);
			        $("td:nth-child(2)", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
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
           /// $(row).find('input[type="checkbox"]').prop('checked', true);
          //  $(row).addClass('selected');
         }
      },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			});
	}

	}

	function uploadnew(id){
		$("#filelistdetail").append('<li><a href="#">Image F</a></li>');	
		$('#filelist').show();
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

		var searchid = '23';
		$(".value_drop").change(function(){
	    	//alert($("#value_BULDINGTYPE").find('option:selected').text());
	    	//alert(BULDINGTYPE2);
	    	var id  = BULDINGTYPE2;
	    	var parentid = $(this).val();
		    var parentvalue = $('#value_Term').find('option:selected').val();
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
		    var selectedvalue = $(this).find('option:selected').text();
		    //selectedvalue =;
		    
		    $(this).find("option").removeAttr('selected');
		    $(this).find("option[value='" + id +"']").attr('selected', true);

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
	    	} else if(BULDINGTYPE == "Basket"){

	    		termid = $('#value_Term').find('option:selected').val();
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




</script>
</body>
</html>