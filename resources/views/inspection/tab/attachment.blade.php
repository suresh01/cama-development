	            
								@if($iseditable == 1)
								<button onclick="openattach()" id="addattach" name="btnadduser" type="button" class="btn_small btn_blue"><span>Add Attachment</span></button>
								@endif
								<div id="attachtable" class="widget_wrap">

									<div class="widget_content">						
										<table style="width:100%" id="attachtble" class="display ">
										<thead style="text-align: left;">
								  		<tr>
											<th class="table_sno">S No</th>
											<th>FILENAME</th>
											<th>ATTACHMENT TYPE</th>
											<th>DECRIPTION</th>
											<th>ACTION</th>
											<th>actioncode</th>
											<th>id</th>
											<th>orginalfilename</th>
										</tr>
										</thead>
										<tbody>										
										</tbody>
										</table>
									</div>
								</div>
								<div style="display:none;" id="attachdetail" >

								<div style="height: 48px; display: -webkit-box;text-align: -webkit-right;" class="grid_12">
									<button id="submitaddattachment" onclick="addAttachment()"  name="adduser" type="button" class="btn_small btn_blue"><span>Add New</span></button>
								<button id="close" onclick="closeattach()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>
								</div>
								
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
									</div>	
								

					<script type="text/javascript">

						 $(document).ready(function() {

						/* 	var floderdata = new FormData();
	floderdata.append("cmd", "mkdir");
	floderdata.append("target", "l1_");
	floderdata.append("name", "{{$termname}}");
	var hashtermname =  Base64.encode('{{$termname}}');
	var hashaccountnumber = Base64.encode('{{$accountnumber}}');

	var hashuploadpath = Base64.encode('{{$termname}}\\{{$accountnumber}}');

	var xhr = new XMLHttpRequest();
	xhr.withCredentials = false;

	xhr.addEventListener("readystatechange", function () {
		if(this.readyState === 4) {
			console.log(this.responseText);
			

	  	}
	});

	xhr.open("POST", "http://{{$serverhost}}/FileServer/connector.minimal.php");
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
   // xhr.setRequestHeader("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
	//xhr.setRequestHeader("Cache-Control", "no-cache");
	//xhr.setRequestHeader("Postman-Token", "ee531202-4b00-406a-ac71-c4a676dc8bbc");

	xhr.send(floderdata);*/
						 	var account = $('#accnumber').val();
			
			
 		var attachdata = [];
		@foreach ($attachment as $rec)
 			attachdata.push( [ '{{$loop->iteration}}', '<a href="http://{{$serverhost}}/downloadfile?id={{$rec->at_id}}&Name={{$rec->at_filename}}&path={{$rec->at_path}}\\{{$rec->at_filename}}">{{$rec->at_filename}}</a>','{{$rec->attachment}}', '{{$rec->at_detail}}',
 				'@if($iseditable == 1)<span><a onclick="" class="action-icons c-delete deleteattachrow" href="#" title="delete">Delete</a></span>@endif','noaction','{{$rec->at_id}}','{{$rec->at_oringinalfilename}}' ] );
 		@endforeach

        $('#attachtble').DataTable({
            data:           attachdata,
            "columns":[ null, null, null,null,null,{visible:false},{visible:false},{visible:false}],
            "sPaginationType": "full_numbers",
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			 
		});
		$("div.table_top select").addClass('tbl_length');
		
        var table = $('#attachtble').DataTable();

		$('#attachtble tbody').on( 'click', '.deleteattachrow', function () {
			var row = table.row(table.row( $(this).parents('tr') ).index()),
			    data = row.data();
			    data[0]='Deleted';
				data[4]='';
				data[5]='delete';
				var noty_id = noty({
					layout : 'center',
					text: 'Are you want to delete?',
					modal : true,
					buttons: [
						{type: 'button pink', text: 'Delete', click: function($noty) {
					  			row.data(data);
					  			var floderdata = new FormData();
									floderdata.append("cmd", "rm");
									floderdata.append("targets[]", "l1_"+Base64.encode('{{$termname}}\\{{$accountnumber}}\\'+data[1]));

									var xhr = new XMLHttpRequest();
									xhr.withCredentials = false;

									xhr.addEventListener("readystatechange", function () {
										if(this.readyState === 4) {
											console.log(this.responseText);								           
									  	}
									});

									xhr.open("POST", "http://{{$serverhost}}/FileServer/connector.minimal.php");
									//xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
									//xhr.setRequestHeader("Cache-Control", "no-cache");
									//xhr.setRequestHeader("Postman-Token", "ee531202-4b00-406a-ac71-c4a676dc8bbc");
 
									xhr.send(floderdata);
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

});


function closeattach(){
	$('#attachtable').show();
	$('#attachdetail').hide();
	$('#addattach').show();
	$('#propertyinspectionform-back-5').show();
	$('#finish').show();
}

function openattach(){
	$('#attachdetail').show();
	$('#attachtable').hide();
	$('#addattach').hide();
	$('#propertyinspectionform-back-5').hide();
	$('#finish').hide();
}

function addAttachment(){
	$('#attachdetail').hide();
	$('#attachtable').show();
	$('#propertyinspectionform-back-5').show();
	$('#finish').show();
	$('#addattach').show();
	
	//console.log(operation);
	var t = $('#attachtble').DataTable();
	var fileInput = document.getElementById('filepath');
	var oringfile = fileInput.files[0];
	
	console.log(oringfile.name);
	t.row.add([ 'New',$('#filename').val(), $('#attachtype option:selected').text(), $('#filedesc').val(),'<span><a onclick="" class="action-icons c-delete deleteattachrow" href="#" title="delete">Delete</a></span>','new','0',oringfile.name]).draw( false );
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
												var propid = "{{$prop_id}}";
												
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
	
	
	$('#attachtable').show();
	$('#attachdetail').hide();
	$('#addattach').show();
	$('#propertystatus').val('');
	$('#propertyinspectionform-back-5').show();
	$('#finish').show();
}

var Base64 = {
    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
    encode: function(input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;

        input = Base64._utf8_encode(input);

        while (i < input.length) {

            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);

            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;

            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }

            output = output + this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) + this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

        }

        return output;
    },


    decode: function(input) {
        var output = "";
        var chr1, chr2, chr3;
        var enc1, enc2, enc3, enc4;
        var i = 0;

        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

        while (i < input.length) {

            enc1 = this._keyStr.indexOf(input.charAt(i++));
            enc2 = this._keyStr.indexOf(input.charAt(i++));
            enc3 = this._keyStr.indexOf(input.charAt(i++));
            enc4 = this._keyStr.indexOf(input.charAt(i++));

            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;

            output = output + String.fromCharCode(chr1);

            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }

        }

        output = Base64._utf8_decode(output);

        return output;

    },

    _utf8_encode: function(string) {
        string = string.replace(/\r\n/g, "\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    },

    _utf8_decode: function(utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;

        while (i < utftext.length) {

            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            }
            else if ((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i + 1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            }
            else {
                c2 = utftext.charCodeAt(i + 1);
                c3 = utftext.charCodeAt(i + 2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
    }

}
    
</script>