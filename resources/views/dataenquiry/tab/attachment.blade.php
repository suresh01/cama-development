	            

<button onclick="openattach()" id="addattach" name="btnadduser" type="button" class="btn_small btn_blue"><span>{{__('tab.Add_Attachment')}}</span></button>

<div id="attachtable" class="widget_wrap">

	<div class="widget_content">						
		<table style="width:100%" id="attachtble" class="display ">
			<thead style="text-align: left;">
				<tr>
					<th class="table_sno">{{__('tab.S_No')}}</th>
					<th> {{__('tab.File_Name')}}</th>
					<th> {{__('tab.Attachment_Type')}}</th>
					<th> {{__('tab.Description')}}</th>
					<th> {{__('tab.Action')}}</th>
					<th> {{__('tab.Actioncode')}}</th>
					<th> {{__('tab.id')}}</th>
					<th> {{__('tab.orginalfilename')}}</th>
				</tr>
			</thead>
			<tbody>										
			</tbody>
		</table>
	</div>
</div>
<div style="display:none;" id="attachdetail" >

	<div style="height: 48px; display: -webkit-box;text-align: -webkit-right;" class="grid_12">
		<button id="submitaddattachment" onclick="addAttachment()"  name="adduser" type="button" class="btn_small btn_blue"><span>{{__('common.Add_New')}} </span></button>
		<button id="close" onclick="closeattach()" name="close" type="button" class="btn_small btn_blue"><span>{{__('common.Close')}} </span></button>
	</div>

	<div  class="grid_12">
		<ul>
			<li>
				<fieldset>
					<legend>{{__('tab.Attachment')}}</legend>
					<div class="form_grid_6">
						<label class="field_title" id="lusername" for="username">{{__('tab.File_Name')}}<span class="req">*</span></label>
						<div  class="form_input">
					<input id="filename" tabindex="3" onkeypress="return alpha(event)" name="filename" type="text" value="" maxlength="50" class=""/>
						</div>
						<span class=" label_intro"></span>
					</div>
					<div class="form_grid_6">
						<label class="field_title" id="lusername" for="username">{{__('tab.Attachment_Type')}}<span class="req">*</span></label>
						<div  class="form_input">
							<select data-placeholder="{{__('common.Choose_a_Status')}}" style="width:100%" class="cus-select" id="attachtype" name="attachtype" tabindex="1">
								<option></option>
								@foreach ($attachtype as $rec)
										<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
								@endforeach	
							</select>
						</div>
						<span class=" label_intro"></span>
					</div>
					<div class="form_grid_6">
						<label class="field_title" id="lusername" for="username">{{__('tab.Description')}}<span class="req">*</span></label>
						<div  class="form_input">
					<input id="filedesc" tabindex="3" name="filedesc" type="text" value="" maxlength="15" class=""/>
						</div>
						<span class=" label_intro"></span>
					</div>
					<div class="form_grid_6">
						<label class="field_title" id="lusername" for="username">{{__('tab.File')}}<span class="req">*</span></label>
						<div  class="form_input">
					<input id="filepath" tabindex="3" name="filepath" type="file" value=""  class=""/>
						</div>
						<span class=" label_intro"></span>
					</div>
				</fieldset>
			</li>
		</ul>
	</div>
</div>	
								

<script type="text/javascript">						 
	$(document).ready(function() {
 		var attachdata = [];
		
        $('#attachtble').DataTable({
            data:           attachdata,
            "columns":[ null, null, null,null,null,{visible:false},{visible:false},{visible:false}],
            "sPaginationType": "full_numbers",
			"iDisplayLength": 5,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			 
		});
		$("div.table_top select").addClass('tbl_length');
		$(".tbl_length").chosen({
			disable_search_threshold: 4	
		});

		

	});

	function addAttachment(){
		var attachmenttable = $("#attachtble").DataTable();
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
			var fileInput = document.getElementById('filepath');
			var file = fileInput.files[0];
			var filearr = file.name.split('.');
			var ffext = filearr[filearr.length-1];
			var FileSize = fileInput.files[0].size / 1024 / 1024; // in MB
	        if (FileSize > 2) {
	            alert('Size Above 2MB');
	           // $(file).val(''); //for clearing with Jquery	        
			} else {
				//console.log(file.name.split('.'));
				//console.log(ext);
				///console.log(file.name[0]);
				formdata.append('path', file);
				formdata.append('id', '{{$prop_id}}');
				formdata.append('name', $('#filename').val());
				formdata.append('ext', ffext);
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
						 	//alert(resdata.storepath);
						 	var attachmenttable = $('#attachtble').DataTable();
						 	var orgfilename = file.name;
						 	var ext = orgfilename.split('.').pop();
						 	attachmenttable.row.add([ 'New',$('#filename').val(), $('#attachtype option:selected').text(), $('#filedesc').val(),'<span><a onclick="" class="action-icons c-delete deleteattachrow" href="#" title="delete">Delete</a></span>','new','0',orgfilename]).draw( false );
													
							$("#attachmenttable").show();
							$("#addattachmentform").hide();
							//$("#assetdetailtable").show();
							$("#assetdetailform-back-4").show();
							$("#finish").show();
						}
					}
				};
				request.send(formdata);

	        }
		} else {
			alert("Enter New Name");
		}
	}

	function alpha(e) {
	    var k;
	    document.all ? k = e.keyCode : k = e.which;
	    return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
	}

	function closeattach(){
		$('#attachtable').show();
		$('#attachdetail').hide();
		$('#addattach').show();
		$('#propertyinspectionform-back-6').show();
		$('#finish').show();
	}

	function openattach(){
		$('#attachdetail').show();
		$('#attachtable').hide();
		$('#addattach').hide();
		$('#propertyinspectionform-back-6').hide();
		$('#finish').hide();
	}

	function addAttachment(){
		$('#attachdetail').hide();
		$('#attachtable').show();
		$('#attachtable').show();
		$('#attachdetail').hide();
		$('#addattach').show();
		$('#propertystatus').val('');
		$('#propertyinspectionform-back-6').show();
		$('#finish').show();
	}	 
</script>