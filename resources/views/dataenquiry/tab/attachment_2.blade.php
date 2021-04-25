
		<div id="attachmenttable" class="grid_12">	
			<br>
				<div style="float:right;margin-right: 30px;"  class="btn_24_blue">
					<a href="#" id="btn_addattachment" onclick="openAddNew()">{{__('tab.Add_Attachment')}}</a>
				</div>
				<br>
		
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table style="width: 100%;" id="attachmentdatatable" class="display ">							
							<thead style="text-align: left;">
					  		<tr>
								<th class="table_sno"> {{__('tab.S_No')}}</th>
								<th> {{__('tab.File_Name')}}</th>								
								<th> {{__('tab.Attachment_Type')}}</th>
								<th> {{__('tab.Description')}}</th>
								<th> {{__('tab.Action')}}</th>								
								<th> {{__('tab.id')}}</th>
								<th> {{__('tab.filetypeid')}}</th>
								<th> {{__('tab.path')}}</th>
								<th> {{__('tab.extension')}}</th>
								<th> {{__('tab.orginalfilename')}}</th>
								<th> {{__('tab.Actioncode')}}</th>
							</thead>
							<tbody>
							
							</tbody>
						</table>
					</div>
				</div>
			</div>

			
		<div id="addattachmentform" style="display:none" class="grid_12 full_block">
			
		<div class="widget_wrap" style="display: -webkit-box;">					
					<div class="widget_content grid_12">
					<h3 id="title">{{__('common.Add_New')}}</h3>
					
						<div  class="grid_6 form_container left_label">
							<ul>
								<li>								
									<div class="form_grid_12">									
										<label class="field_title" id="luserid" for="userid">{{__('tab.File_Name')}}<span class="req">*</span></label>
										<div class="form_input">
											<input id="filename" name="filename" type="text"  onkeypress="return alpha(event)" />
										</div>
										<span class=" label_intro"></span>
									</div>		
									
									
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('tab.Attachment_Type')}}<span class="req">*</span></label>
										<div class="form_input ">
											<select style="width: 100%;" data-placeholder="{{__('common.Choose_a_Role')}}..." class="cus-select" id="attachtype" name="filetype" tabindex="20">	<option></option>
											@foreach ($attachtype as $rec)
												<option value="{{ $rec->tdi_key }}"> {{ $rec->tdi_value }}  </option>
											@endforeach	
											</select>
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('tab.Description')}}</label>
										<div class="form_input ">
											<input id="atdesc" name="atdesc" type="text"   />
										</div>
										<span class=" label_intro"></span>
									</div>
									<div class="form_grid_12">
										<label class="field_title" id="llevel" for="level">{{__('tab.File')}}<span class="req">*</span></label>
										<div class="form_input ">
											<input id="path" name="path" type="file"   />
										</div>
										<span class=" label_intro"></span>
									</div>
									
								</li>
							</ul>
						</div>
						<div id="hidden_path">
							
						</div>
						<div style="text-align: right;    height: 48px;" class="grid_12">
							
									<div class="form_input">
										<input type="button" id="addsubmit" onclick="addAttachment();" class="btn_small btn_blue" value="Submit">				
																
										<button id="close" onclick="closeNew()" name="close" type="button" class="btn_small btn_blue"><span>{{__('common.Close')}} </span></button>
										<span class=" label_intro"></span>
									</div>
								
									<span class="clear"></span>
						</div>
					
				</div>
			</div>
		</div>
		
		<script>
	
	function alpha(e) {
	    var k;
	    document.all ? k = e.keyCode : k = e.which;
	    return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
	}
	function openAddNew(){
		$('#desc').val('');
		$('#filename').val('');

		$('#filename').removeAttr("readonly")
		$("#attachmenttable").hide();
		//$("#assetdetailtable").hide();
		
		$("#addattachmentform").show();
		$("#propertyinspectionform-back-5").hide();
		$("#propertyinspectionform-next-5").hide();
		//$("#propertyinspectionform-next-2").hide(); 
	}

	function addAttachment(){
		var attachmenttable = $("#attachmentdatatable").DataTable();
		var chkStatus = true;
 
		for (var i = 0;i<attachmenttable.rows().count();i++){
			var ldata = attachmenttable.row(i).data();
		 	if(ldata[1] == $('#filename').val()){
		 		chkStatus = false;
		 	}
		}
		if(chkStatus){
			var request = new XMLHttpRequest();
			var formdata = new FormData();
			var fileInput = document.getElementById('path');
			var file = fileInput.files[0];
			var filearr = file.name.split('.');
			var fext = filearr[filearr.length-1];
			var FileSize = fileInput.files[0].size / 1024 / 1024; // in MB
	        if (FileSize > 2) {
	            alert('File Size limit Exceed. Max size 2MB');
	           // $(file).val(''); //for clearing with Jquery	        
			} else {
				//console.log(file.name.split('.'));
				//console.log(ext);
				///console.log(file.name[0]);
				var zone = $('#zone').val();
				var subzone = $('#subzone').val();

				var accountnumber = $('#accnumber').val();

				formdata.append('path', file);
				formdata.append('id', '{{$prop_id}}');
				formdata.append('name', $('#filename').val());
				formdata.append('zone', zone);
				formdata.append('accnumber', accountnumber);
				formdata.append('subzone', subzone);
				formdata.append('ext', fext);
				formdata.append('_token', '{{csrf_token()}}');
				request.open('post','upload');
				//request.addEventListener("load",transferComplete);
				request.onreadystatechange = function () {
				  // In local files, status is 0 upon success in Mozilla Firefox
					if(request.readyState === XMLHttpRequest.DONE) {
						var status = request.status;
						if (status === 0 || (status >= 200 && status < 400)) {
						    // The request has been completed successfully
						 	var resdata = JSON.parse(request.responseText);

						 	console.log(resdata);
						 	//alert('Up');

						 	var attachmenttable = $('#attachmentdatatable').DataTable();
						 	var orgfilename = file.name;
						 	var ext = orgfilename.split('.').pop();
							attachmenttable.row.add(['New', $('#filename').val(), $('#attachtype option:selected').text(), $('#atdesc').val(),   '<span><a class="action-icons c-edit edit-data"    title="Update Property" href="#"></a></span>&nbsp;&nbsp;&nbsp;<span><a class="action-icons delete-data "   disabled="true" title="Delete Property" href="#"></a></span>', 0,  $('#attachtype').val(), resdata.storepath, ext, orgfilename, 'new' ]).draw(false);							
							$("#attachmenttable").show();
							$("#addattachmentform").hide();
							//$("#assetdetailtable").show();
							
							$("#propertyinspectionform-back-5").hide();
							$("#propertyinspectionform-next-5").hide();
							sendDB();
							//$("#propertyinspectionform").submit(function(e){
	               

				              //  e.preventDefault(e);
				                //alert('submit intercepted');
				               	 

							//});
						}
					}
				};
				request.send(formdata);

	        }
		} else {
			alert("Enter New Name");
		}

	}

	function sendDB(){
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
	}


	function closeNew(){
		$("#attachmenttable").show();
		$("#addattachmentform").hide();
		//$("#assetdetailtable").show();
		
		$("#propertyinspectionform-back-5").hide();
		$("#propertyinspectionform-next-5").hide();
	}

	$(document).ready(function (){
		var attachmentdata = [];
		@foreach ($attachment as $rec)	
			attachmentdata.push([ '{{$loop->iteration}}',  '{{$rec->at_name}}', '{{$rec->attachment }}','{{$rec->at_detail}}','<span><a class="action-icons c-edit edit-data"    title="Update Property" href="#"></a></span>&nbsp;&nbsp;&nbsp;<span><a class="action-icons delete-data "   disabled="true" title="Delete Property" href="#"></a></span>&nbsp;&nbsp;&nbsp; <span><a style="height: 20px; width: 20px; margin-top: 5px; background: url(../images/sprite-icons/icons-color.png) no-repeat;background-position: -402px -3px !important;display: inline-block; float: left;" disabled="true" title="Muat turun Lampiran" class="  new-action-icons "   href="download?id={{$rec->at_id}}"></a></span>','{{$rec->at_id}}','{{$rec->at_attachtype_id}}','{{$rec->at_path}}', '{{$rec->at_fileextention}}', '{{$rec->at_oringinalfilename}}', 'noaction' ]);		
	    @endforeach
		 
		$('#attachmentdatatable').DataTable({
        	data:           attachmentdata,
        	"columns":[  null, null, null, null, null, { "visible": false},  { "visible": false}, { "visible": false}, { "visible": false}, { "visible": false}, { "visible": false}],
			"iDisplayLength": 5,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Penyertaan setiap halaman:</span>",	
		        "sSearch": "Carian",	
		    },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			 
		});

		$('#attachmentdatatable tbody').on( 'click', '.delete-data', function () {  
			var table = $('#attachmentdatatable').DataTable();
			var row = table.row(table.row( $(this).parents('tr') ).index()),
		    data = row.data();
		    data[0]='Deleted';
			data[10]='delete';
			data[4]='';
			var noty_id = noty({
				layout : 'center',
				text: 'Are you want to delete?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Delete', click: function($noty) {
				  			row.data(data);
							var request = new XMLHttpRequest();
							//var formdata = new FormData();
							
							request.onreadystatechange = function () {
							  // In local files, status is 0 upon success in Mozilla Firefox
								if(request.readyState === XMLHttpRequest.DONE) {
									var status = request.status;
									if (status === 0 || (status >= 200 && status < 400)) {
										sendDB();
									}
								}
							};
							//formdata.append('id', data[5]);
							//formdata.append('_token', '{{csrf_token()}}');
							request.open('get','filedelete?id='+data[5]);
							//request.addEventListener("load",transferComplete);
							
							request.send();

							$noty.close();
					  	}
					},
					{type: 'button blue', text: 'Cancel', click: function($noty) {
							$noty.close();
					  	}
					}
					],
				type : 'success', 
		 	});     		
			
    	});

		$('#attachmentdatatable tbody').on( 'click', '.edit-data', function () {  
			$("#attachmenttable").hide();
			//$("#assetdetailtable").hide();
			
			$("#addattachmentform").show();
			$("#assetdetailform-back-4").hide();
			$("#finish").hide();   		

			var table = $('#attachmentdatatable').DataTable();
      	
			var ldata = table.row(table.row( $(this).parents('tr') ).index()).data();
			
			var attdata = {};	


			$.each( ldata, function( key, value ) {
				attdata[attachmentmap.get(""+key+"")] = value;              
	        });

	        $.each( attdata, function( key, val ) {
	        	$('#'+key).val(val);
			});

			$('#filename').attr("readonly","true")

    	});

		$("div.table_top select").addClass('tbl_length');
		$(".tbl_length").chosen({
			disable_search_threshold: 4	
		});
	});
</script>