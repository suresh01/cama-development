<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Search Detail</title>
@include('includes.header', ['page' => 'admin'])
	
	<div id="content">
		<div class="grid_container">
		
		<div id="usertable" class="grid_12">
			
			<br>
			<div class="form_input">
				<button id="adduser" onclick="openAddUser()" name="btnadduser" type="button" class="btn_small btn_blue"><span>Add Search Detail</span></button>

				<div id="breadCrumb3" style="float:right;" class="breadCrumb grid_4">
					<ul >
						<li><a href="#">Home</a></li>
						<li><a href="#">Admin</a></li>
						<li><a href="search">Search Management</a></li>
						<li>Search Management Detail</li>
					</ul>
				</div>
			</div>
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table class="display data_tbl">
						<thead style="text-align: left;">
						<tr>
							<th class="table_sno">
								S No
							</th>
							<th>
								Key Name
							</th>
							<th>
								Label Name
							</th>
							<th>
								Key Type
							</th>
							<th>
								Key Main Table
							</th>
							<th>
								Key Main Field	
							</th>
							<th>
								Deffination Source	
							</th>
							<th>
								Deffination Key Id
							</th>
							<th>
								Deffination Key Name
							</th>
							<th>
								Deffination Filter Key
							</th>			
							<th>
								Custiom Include
							</th>	
							<th>
								Action
							</th>
						</tr>
						</thead>
						<tbody>
							@foreach ($tsearchdetail as $rec)
							<tr>
								<td>
									{{$loop->iteration}}
								</td>
								<td>
									{{ $rec->sd_key }}
								</td>
								<td>
									{{ $rec->sd_label }}
								</td>
								<td>
									{{ $rec->sd_keytype }}
								</td>
								<td>
									{{ $rec->sd_keymaintable }}
								</td>
								<td>
									{{ $rec->sd_keymainfield }}
								</td>
								<td>
									{{ $rec->sd_definitionsource }}
								</td>
								<td>
									{{ $rec->sd_definitionkeyid }}
								</td>
								<td>
									{{ $rec->sd_definitionkeyname }}
								</td>
								<td>
									{{ $rec->sd_definitionfilterkey }}
								</td>		
								<td>
									{{ $rec->sd_custominclude}}
								</td>	
								<td>
									<span><a class="action-icons c-edit" onclick="openEditDetail({{ $rec->sd_id }})" href="#" title="Edit">Edit</a></span>
									<span><a class="action-icons c-Delete schdt_delete_cnf" onclick="deleteSdt({{ $rec->sd_id }})" href="#" title="Delete">Delete</a></span>
								</td>
							</tr>
							<div style="display:none;">
								<input type="text" id="key_{{ $rec->sd_id }}" value="{{ $rec->sd_key }}">
								<input type="text" id="keytype_{{ $rec->sd_id }}" value="{{ $rec->sd_keytype }}">
								<input type="text" id="keymaintable_{{ $rec->sd_id }}" value="{{ $rec->sd_keymaintable }}">
								<input type="text" id="keyfield_{{ $rec->sd_id }}" value="{{ $rec->sd_keymainfield }}">
								<input type="text" id="defsource_{{ $rec->sd_id }}" value="{{ $rec->sd_definitionsource }}">
								<input type="text" id="defkeyid_{{ $rec->sd_id }}" value="{{ $rec->sd_definitionkeyid }}">
								<input type="text" id="defkeyname_{{ $rec->sd_id }}" value="{{ $rec->sd_definitionkeyname }}">
								<input type="text" id="deffilterkey_{{ $rec->sd_id }}" value="{{ $rec->sd_definitionfilterkey }}">
								<input type="text" id="custom_{{ $rec->sd_id }}" value="{{ $rec->sd_custom }}">
								<input type="text" id="custominc_{{ $rec->sd_id }}" value="{{ $rec->sd_custominclude }}">
								<input type="text" id="label_{{ $rec->sd_id }}" value="{{ $rec->sd_label }}">

							</div>
							@endforeach
						</tbody>
						</table>
					</div>
				</div>
			</div>
		
		
		
		<div id="adduserform" style="display:none" class="grid_12">
			<div class="widget_wrap">
				<div class="widget_top">
					<span class="h_icon list"></span>
					<h6></h6>
				</div>
				<div class="widget_content">
					<form id="searchdt_trn_from" autocomplete="off" method="post" action="searchdetail?se_id={{ $se_id }}" class="form_container left_label">
						<ul>
							<li>
								@csrf
								<input type="hidden" value="1" name="operation" id="operation">
								<input type="hidden" name="se_id" id="se_id" value="{{ $se_id }}">
								<input type="hidden" name="transaction" id="transaction" value="proc">
								<input type="hidden" value="0" name="sd_id" id="sd_id" >


								<div class="form_grid_12">
									<label class="field_title" id="lkey_name" for="key_name">Key Name<!--<span class="req">*</span>--></label>
									<div class="form_input">
										<input id="key_name" name="key_name" type="text" value="" maxlength="100" class="large">
									</div>
									<span class=" label_intro"></span>
								</div>		

								<div class="form_grid_12">
									<label class="field_title" id="lkey_name" for="key_name">Label Name<!--<span class="req">*</span>--></label>
									<div class="form_input">
										<input id="label_name" name="label_name" type="text" value="" maxlength="100" class="large">
									</div>
									<span class=" label_intro"></span>
								</div>						
								
								<div class="form_grid_12">
									<label class="field_title" id="lkey_type" for="key_type">Key Type</label>
									<div class="form_input">
										<select id="key_type" data-placeholder="Choose a KeyType..." style="width:52%" class="cus-select" id="key_type" name="key_type" tabindex="20">
											@foreach ($keytype as $rec)
											<option value="{{ $rec->skt_id }}">{{ $rec->skt_name }}</option>
											@endforeach
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
								
								<div class="form_grid_12">
									<label class="field_title" id="ltable_name" for="table_name">Table Name</label>
									<div class="form_input">
										<input id="table_name" name="table_name" type="text" value="" maxlength="50" class="large"/>
									</div>
									<span class=" label_intro"></span>
								</div>
								
								<div class="form_grid_12">
									<label class="field_title" id="lbltable_field_name" for="table_field_name">Table Field Name</label>
									<div class="form_input">
										<input id="table_field_name" name="table_field_name" type="text" value="" maxlength="50" class="large"/>
									</div>
									<span class=" label_intro"></span>
								</div>
								
								<div class="form_grid_12">
									<label class="field_title" id="ldef_source" for="def_source">Definition Source</label>
									<div class="form_input">
										<input id="def_source" name="def_source" type="text" value="" class="large"/>
									</div>
									<span class=" label_intro"></span>
								</div>
								
								<div class="form_grid_12">
									<label class="field_title" id="lbldef_keyid" for="def_keyid">Definition Keyid</label>
									<div class="form_input">
										<input id="def_keyid" name="def_keyid" type="text" value="" class="large"/>
									</div>
									<span class=" label_intro"></span>
								</div>
								
								<div class="form_grid_12">
									<label class="field_title" id="lbldef_keyname" for="def_keyname">Definition Key Name</label>
									<div class="form_input">
										<input id="def_keyname" name="def_keyname" type="text" value=""  class="large"/>
									</div>
									<span class=" label_intro"></span>
								</div>
								
								<div class="form_grid_12">
									<label class="field_title" id="lbldef_filterkey" for="def_filterkey">Definition Filter Key</label>
									<div class="form_input">
										<input id="def_filterkey" name="def_filterkey" type="text" value="" maxlength="50" class="large"/>
									</div>
									<span class=" label_intro"></span>
								</div>
								
								<div class="form_grid_12">
									<label class="field_title" id="lbldef_fieldid" for="def_fieldid">Definition Field Id</label>
									<div class="form_input">
										<input id="def_fieldid" name="def_fieldid" type="text" value="" maxlength="50" class="large"/>
									</div>
									<span class=" label_intro"></span>
								</div>					
								
								<div class="form_grid_12">
									<label class="field_title" id="lblcustom" for="custom">Custom</label>
									<div class="form_input">
										<select data-placeholder="Choose a Custom..." style="width:52%" class="cus-select" id="custom" name="custom" tabindex="20">
											<option value="0">True</option>
											<option value="1">False</option>
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>					
								
								<div class="form_grid_12">
									<label class="field_title" id="lblcustom_include" for="custom_include">Custom Include</label>
									<div class="form_input">
										<select data-placeholder="Choose a Custom Include..." style="width:52%" class="cus-select" id="custom_include" name="custom_include" tabindex="20">
											<option value="0">True</option>
											<option value="1">False</option>
										</select>
									</div>
									<span class=" label_intro"></span>
								</div>
								
							</li>
							<li>
							<div class="form_grid_12">
								<div class="form_input">
									<button id="addsubmit" name="adduser" type="submit" class="btn_small btn_blue"><span>Submit</span></button>												
									<button id="close" onclick="closeAddUser()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>
								</div>
							</div>
							</li>
						</ul>
					</form>
				</div>
			</div>
		</div>
	
	</div>
	<span class="clear"></span>	
	
</div>

<script>
	function openAddUser(){
		$("#key_name").val("");
		$("#table_name").val("");
		$("#table_field_name").val("");
		$("#def_source").val("");
		$("#def_keyid").val("");
		$("#def_keyname").val("");
		$("#label_name").val("");
		$("#def_filterkey").val("");
		$("#operation").val(1);
		$("#usertable").hide(600);
		$("#adduserform").show(200);
	}

	function closeAddUser(){
		$("#key_name").val("");
		$("#table_name").val("");
		$("#table_field_name").val("");
		$("#def_source").val("");
		$("#def_keyid").val("");
		$("#def_keyname").val("");
		$("#def_filterkey").val("");
		 $("#usertable").show(200);
		 $("#adduserform").hide(600);
	}

	function openEditDetail(id){
		$("#sd_id").val(id);
		$("#key_name").val($("#key_"+id).val());
		$("#table_name").val($("#keymaintable_"+id).val());
		$("#table_field_name").val($("#keyfield_"+id).val());
		$("#def_source").val($("#defsource_"+id).val());
		$("#def_keyid").val($("#defkeyid_"+id).val());
		$("#def_keyname").val($("#defkeyname_"+id).val());
		$("#def_filterkey").val($("#deffilterkey_"+id).val());
		$("#key_type").val($("#keytype_"+id).val());
		$("#custom").val($("#custom_"+id).val());
		$("#custom_include").val($("#custominc_"+id).val());
		$("#label_name").val($("#label_"+id).val());

		$("#operation").val(2);
		 $("#usertable").hide(600);
		 $("#adduserform").show(200);		
	}

	function deleteSdt(id){
		$("#operation").val(3);
		$("#sd_id").val(id);
	}
</script>
</body>
</html>