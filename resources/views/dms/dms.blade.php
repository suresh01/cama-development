<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>DMS</title>

<link href="multiselect/multiselect.css" rel="stylesheet"/>
<script src="multiselect/multiselect.min.js"></script>
@include('includes.header', ['page' => 'datamaintenance'])
					
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">	
					<br>
				<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Data Maintenance</a></li>
						<li>DMS</li>
					</ul>
				</div>
				</div>
				
				<div style="float:right;margin-right: 10px;" id="searchdev" class="btn_24_blue">					
					@include('dms.search')
				</div>
				<br>
				
        
        
				<div id="attachtable"  class="widget_wrap">					
					<div class="widget_content">						
						<table id="proptble" class="display select">

							<div class="social_activities">
								<div class="comments_s">
									<div class="block_label">
										Count<span id="prop_count">0</span>
									</div>
								</div>


							</div>	

							<thead style="text-align: left;">
								<tr>
									<th></th>
									<th class="table_sno">
										S No
									</th>
									<th>
										TERM
									</th>
									<th>
										DATE
									</th>
									<th>
										STATUS
									</th>
									<th>
										TERM TYPE
									</th>	
									<th>
										DETAIL
									</th>	
									<th>
										ACTION
									</th>	
								</tr>
							</thead>
							<tbody>			
								
							</tbody>
						</table>


						

					</div>
				</div>

				<div id="filelist" style="display: none;" class="widget_wrap">	
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6 id="filetitle">Files List</h6>
					</div>

					<table id="detble" class="display select">

							<thead style="text-align: left;">
								<tr>
									<th class="table_sno">
										S No
									</th>
									<th>
										File Name
									</th>
									<th>
										Create by
									</th>
									<th>
										Create Date
									</th>
									<th>
										Update by
									</th>	
									<th>
										Update Date
									</th>	
									<th>
										Action
									</th>	
								</tr>
							</thead>
							<tbody>			
								
							</tbody>
						</table>
					<div id="filelistdetail" >	
						
						
						
					</div>
				</div>
			</div>
			<div style="display:none;" id="attachdetail" >

								<input id="propid" tabindex="3" name="propid" type="hidden" value="" maxlength="50" class=""/>
								
									<div  class="grid_12">
									<ul>
									<li>
								
										<fieldset>
										<legend>Attachment</legend>
											<div class="form_grid_6">
												<label class="field_title" id="lusername" for="username">File Name<span class="req">*</span></label>
												<div  class="form_input">
											<input id="filename" tabindex="3" name="filename" type="text" value="" maxlength="50" class=""/>
												</div>
												<span class=" label_intro"></span>
											</div>
											<div class="form_grid_6">
												<label class="field_title" id="lusername" for="username">Attachment Type<span class="req">*</span></label>
												<div  class="form_input">
													<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="attachtype" name="attachtype" tabindex="1">
														<option></option>
														@foreach ($attachtype as $rec)
																<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
														@endforeach	
													</select>
												</div>
												<span class=" label_intro"></span>
											</div>
											<div class="form_grid_6">
												<label class="field_title" id="lusername" for="username">Description<span class="req">*</span></label>
												<div  class="form_input">
											<input id="filedesc" tabindex="3" name="filedesc" type="text" value="" maxlength="15" class=""/>
												</div>
												<span class=" label_intro"></span>
											</div>
											<div class="form_grid_6">
												<label class="field_title" id="lusername" for="username">File<span class="req">*</span></label>
												<div  class="form_input">
											<input id="filepath" tabindex="3" name="filepath" type="file" value=""  class=""/>
												</div>
												<span class=" label_intro"></span>
											</div>
										</fieldset>
									</li>
									</ul>
									</div>
									<div style="height: 48px; display: -webkit-box;text-align: -webkit-right;" class="grid_12">
									<button id="submitaddattachment" onclick="uploadbb()"  name="adduser" type="button" class="btn_small btn_blue"><span>Upload</span></button>
								<button id="close" onclick="uploadbb()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>
								</div>
									</div>	

		<!-- <form style="display: hidden;" id="generateform" method="GET" action="generateinspectionreport">
            @csrf
            <input type="hidden" name="accounts" id="accounts">
		</form>-->
		<div  style="display: none;" class="form_input">
			<input id="filepath" tabindex="3" name="filepath" type="file" value=""  class=""/>
		</div>
		
	</div>
	<span class="clear"></span>
	
	<script>
		
		function changeField(val){
			if(val == 'table'){
				$('#maxrow').removeAttr('style');
			} else {
				$('#maxrow').attr('style', "display:none;");
			}
		}
function uploadbb(id){
$('#attachtable').show();
$('#filelist').show();
$('#searchdev').show();
$('#attachdetail').hide();
		var data = new FormData();
							var fileInput = document.getElementById('filepath');
							var file = fileInput.files[0];
							
							//console.log(file.name.split('.').pop());

							//console.log(file);
							data.append("cmd", "upload");
							data.append("target", "l1_");
							data.append("upload[]", file, $('#filename').val()+'.'+file.name.split('.').pop());

							xhr = new XMLHttpRequest();
							xhr.withCredentials = false;

							xhr.addEventListener("readystatechange", function () {
							  if (this.readyState === 4) {
							    console.log(this.responseText);
							    var type = "ATTACHMENT";
												var data_removed = '';
												
												var filename = $('#filename').val();
												var desc = $('#filedesc').val();
												var propid = $('#propid').val();
												
						           				var resdata = '['+this.responseText+']';
						           				var parsed = JSON.parse(resdata);
												console.log(parsed[0].added); // logs "b1"
												var added_data =  JSON.stringify(parsed[0].added).replace(/]|[[]/g, '');

												console.log(JSON.stringify(this.responseText).added);
												$.ajax({
									  				type: 'POST', 
												    url:'filemanagertrn',
												    headers: {
													    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
													},
											        data:{data:added_data,data_removed:data_removed,type:type,filename:file.name,desc:desc,propid:propid},
											        success:function(data){
											        	
										        	},
											        error:function(data){
														
										        	}
										    	});
							  }
							});

							xhr.open("POST", "http://{{$serverhost}}/FileServer/connector.minimal.php");
							//xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
							//xhr.setRequestHeader("Cache-Control", "no-cache");

							xhr.send(data);
							
		}
		function uploadnew(id){
$('#propid').val(id);
$('#attachtable').hide();
$('#filelist').hide();
$('#searchdev').hide();
$('#attachdetail').show();
			// $('input[type=file]').trigger('click');
		}


		function deleteProperty(){
			var table = $('#proptble').DataTable();
//console.log(table.rows('.selected').data());
			var account = $.map(table.rows('.selected').data(), function (item) {
				//console.log(item);
	        	return item['vd_id']
	   		});
			var type = "delete";
			$('#accounts').val(account.toString());
			$('#addDetail').modal();
			console.log(account.toString());
			
			
		}
	
		function upload(){
			var data = new FormData();
			var fileInput = document.getElementById('filepath');
			var file = fileInput.files[0];
			var hashuploadpath = Base64.encode('');
			//console.log(file.name.split('.').pop());

			//console.log(file);
			data.append("cmd", "upload");
			data.append("target", "l1_"+hashuploadpath);
			data.append("upload[]", file, $('#filename').val()+'.'+file.name.split('.').pop());

			xhr = new XMLHttpRequest();
			xhr.withCredentials = false;
			
			xhr.open("POST", "http://{{$serverhost}}/FileServer/connector.minimal.php");
			//xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			//xhr.setRequestHeader("Cache-Control", "no-cache");

			xhr.send(data);
		}
		


		function updateDataTableSelectAllCtrl(table){
		   var $table             = table.table().node();
		   var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
		   var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
		   var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

			   // If none of the checkboxes are checked
		   /*if($chkbox_checked.length === 0){
		      chkbox_select_all.checked = false;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = false;
		      }

		   // If all of the checkboxes are checked
		   } else if ($chkbox_checked.length === $chkbox_all.length){
		      chkbox_select_all.checked = true;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = false;
		      }

		   // If some of the checkboxes are checked
		   } else {
		      chkbox_select_all.checked = true;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = true;
		      }
		   }*/
		}

		function check_usaccess(module,id){
			$.ajax({
		        type:'GET',
		        url:'/getaccess',
		        data:{module:module},
		        success:function(data){	        	
		        	if(data.msg === "false"){
		        		alert("You Don't have permission");
		        		return;
		        	} else {
						window.location.href = "datasearchdetail?prop_id="+id;
		        	}
		        }
		    });
		}

		function delRecord(id){
			var noty_id = noty({
						layout : 'center',
						text: 'Are want to delete Basket?',
						modal : true,
						buttons: [
							{type: 'button pink', text: 'Delete', click: function($noty) {
								$noty.close();
								$.ajax({
									  				type: 'POST', 
												    url:'filemanagertrn',
												    headers: {
													    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
													},
											        data:{type:'delete',propid:id},
											        success:function(data){
														alert('Record Deleted');
											        	
										        	},
											        error:function(data){
														alert(data);
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

function filelist(id){
	$('#filelist').show();
	$('#filelistdetail').html('');

	var table1 = $('#detble').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				 
				"lengthMenu":  [100, 200, 500, 1000],
		        // ajax: '{{ url("inspectionproperty") }}', 
		        /*"ajax": '/bookings/datatables',*/ 
		        "columns": [
			        {"data": null, "name": "sno", "title": "S No"},
			        {"data": function(data){
			        		//var url = 'datasearchdetail?prop_id='+data.vd_id;
			        		return "<a href='http://localhost:8002/download?Name="+data.filename+"&path="+data.path+"\\"+data.at_filename+"'>"+data.filename+"</a>";
			        	
			        }, "name": "account number"},
			        {"data": "at_createby", "name": "fileno"},
			        {"data": "at_createdate", "name": "zone"},
			        {"data": "at_updateby", "name": "subzone"},
			        {"data": "at_updatedate", "name": "subzone"},
			        {"data": function(data){
			        		//var url = 'datasearchdetail?prop_id='+data.vd_id;
			        		return '<span><a class="action-icons  delete_term"  onclick="delRecord('+data.at_id+')" disabled="true" title="Delete " href="#"></a></span>';
			        	
			        }, "name": "account number"}
		   		],
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  					var count = $('#proptble').DataTable().rows().count();
					//$('#prop_count').html(count);
			        $("td:nth-child(1)", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
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
            $(row).find('input[type="checkbox"]').prop('checked', true);
            $(row).addClass('selected');
         }
      },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			});
	
	$.ajax({
        type:'GET',
        url:'filelist',
        data:{id:id},
        success:function(data){	        	
        	var result = data.result;
        	
        	var table = $('#detble').DataTable();table.clear();
			table.rows.add(result).draw();
			/*for (var i = 0; i < result.length; i++) {	

	        $("#filelistdetail").append('<div class="widget_content">	<div class="notify_elem"><ul><li><a href="http://localhost:8002/download?Name='+result[i].filename+'&path='+result[i].path+'\\'+result[i].at_filename+'">'+result[i].filename+'</a></li> <li style="color: #333;" > '+result[i].at_createby+' </li> <li style="color: #333;" > '+result[i].at_createdate+'  </li>  <li style="color: #333;" > '+result[i].at_updateby+' </li>   <li style="color: #333;" > '+result[i].at_updatedate+'</li></ul></div></div>');	
	        		/*$("#filelistdetail").append('<div class="widget_content">		<div class="notify_elem"><h6>File Name</h6><ul><li><a href="http://localhost:8002/download?Name='+result[i].filename+'&path='+result[i].path+'\\'+result[i].at_filename+'">'+result[i].filename+'</a></li> </ul><div>');	
	        		$("#filelistdetail").append('<div class="notify_elem"><h6>create by</h6><ul><li> '+result[i].at_createby + i +' </li> </ul><div>');		
	        		$("#filelistdetail").append('<div class="notify_elem"><h6>create date</h6><ul><li> '+result[i].at_createdate+' </li> </ul><div>');		
	        		$("#filelistdetail").append('<div class="notify_elem"><h6>update by</h6><ul><li> '+result[i].at_updateby+' </li> </ul><div>');		
	        		$("#filelistdetail").append('<div class="notify_elem"><h6>update date</h6><ul><li> '+result[i].at_updatedate+' </li> </ul></div></div>');		
	        				
		    } 
        	
        	if(result ==''){
        		$("#filelistdetail").append(' No File Found');
        	}*/
        	
        }
    });
}

$(document).ready(function (){

document.multiselect('#testSelect1');

	$('.multiselect-checkbox').click(function() {
  // alert($(this).attr('data-val'););
var id  = $(this).attr('data-val');
    var table = $('#proptble').DataTable();
	var column = table.column( id);
	 //alert($('#'+id).prop("checked"));
	if (id != '-1'){
		column.visible( $(this).prop("checked"));
	}
});

	
	var table = $('#proptble').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				 
				"lengthMenu":  [100, 200, 500, 1000],
		        // ajax: '{{ url("inspectionproperty") }}', 
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
			        {"data": "vt_id", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": null, "name": "sno", "title": "S No"},
			        {"data": function(data){
			        		//var url = 'datasearchdetail?prop_id='+data.vd_id;
			        		return "<a onclick='filelist("+data.vt_id+")' href='#'>"+data.name+"</a>";
			        	
			        }, "name": "account number"},
			        {"data": "termDate", "name": "fileno"},
			        {"data": "termstage", "name": "zone"},
			        {"data": "valbase", "name": "subzone"},
			        {"data": "valbase", "name": "subzone"},
			        {"data": "valbase", "name": "subzone"}
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
            $(row).find('input[type="checkbox"]').prop('checked', true);
            $(row).addClass('selected');
         }
      },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			});
   // Array holding selected row IDs
   var rows_selected = [];
   
    
   

   // Handle click on checkbox
   $('#proptble tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = $('#proptble').DataTable().row($row).data();

      // Get row ID
      var rowId = data[0];

      // Determine whether row ID is in the list of selected row IDs
      var index = $.inArray(rowId, rows_selected);

      // If checkbox is checked and row ID is not in list of selected row IDs
      if(this.checked && index === -1){
         rows_selected.push(rowId);

      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
      } else if (!this.checked && index !== -1){
         rows_selected.splice(index, 1);
      }

      if(this.checked){
         $row.addClass('selected');
      } else {
         $row.removeClass('selected');
      }

      // Update state of "Select all" control
      updateDataTableSelectAllCtrl($('#proptble').DataTable());

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle click on table cells with checkboxes
   $('#proptble').on('click', 'tbody td, thead th:first-child', function(e){
      $(this).parent().find('input[type="checkbox"]').trigger('click');
   });

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', $('#proptble').DataTable().table().container()).on('click', function(e){
      if(this.checked){
         $('#proptble tbody input[type="checkbox"]:not(:checked)').trigger('click');
      } else {
         $('#proptble tbody input[type="checkbox"]:checked').trigger('click');
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle table draw event
   $('#proptble').DataTable().on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl($('#proptble').DataTable());
   });
   // Handle form submission event

});


	</script>
</div>

</body>
</html>