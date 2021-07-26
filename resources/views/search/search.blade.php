<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Search Management</title>
@include('includes.header', ['page' => 'admin'])
	
	<div id="content">
		<div class="grid_container">
		
		<div id="usertable" class="grid_12">
			
			<br>
			<div class="form_input">
				<button id="adduser" onclick="openAddUser()" name="btnadduser" type="button" class="btn_small btn_blue"><span>Add Search</span></button>

				<div id="breadCrumb3" style="float:right;" class="breadCrumb grid_2">
					<ul >
						<li><a href="#">Home</a></li>
						<li><a href="#">Admin</a></li>
						<li>Search Management</li>
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
								Search Name
							</th>
							<th>
								Search Description
							</th>
							<th>
								Action
							</th>							
						</tr>
						</thead>
						<tbody>
							@foreach ($tsearch as $rec)
								<tr>
									<td>{{$loop->iteration}}</td>		
									<td><a href="searchdetail?se_id={{ $rec->se_id }}">{{ $rec->se_name }}</a></td>		
									<td>{{ $rec->se_desc }}</td>		
									<td><span><a class="action-icons c-edit" onclick="openEditSearch({{ $rec->se_id }})" href="#" title="Edit">Edit</a></span>
									<span><a class="action-icons c-Delete sch_delete_cnf" id="sch_delete_cnf" href="#" onclick="deleteSearch({{ $rec->se_id }})"  title="Delete">Delete</a></span></td>	
								</tr>	
								<div style="display:none;">
									<input type="text" id="se_name_{{ $rec->se_id }}" value="{{ $rec->se_name }}">
									<input type="text" id="se_desc_{{ $rec->se_id }}" value="{{ $rec->se_desc }}">
									<input type="text" id="se_query_{{ $rec->se_id }}" value="{{ $rec->se_mainquery }}">
									<input type="text" id="se_mod_{{ $rec->se_id }}" value="{{ $rec->se_mod_id }}">
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
					<form id="search_trn_from" autocomplete="off" method="post" action="searchtrn" class="form_container left_label">
						<ul>
							<li>
								@csrf
								<input type="hidden" value="1" name="operation" id="operation">
								<input type="hidden" name="se_id" id="se_id">

								<div class="form_grid_12">
									<label class="field_title" id="lsearch_name" for="search_name">Search Name<span class="req">*</span></label>
									<div class="form_input">
										<input id="search_name" name="search_name" type="text" value="" maxlength="100" class="large">
									</div>
									<span class=" label_intro"></span>
								</div>	

								<div class="form_grid_12">
								<label class="field_title" id="llevel" for="level">Module Name<span class="req">*</span></label>
								<div class="form_input">
									<select style="width:50.7%;" data-placeholder="Choose a Parent..." class="cus-select" id="moduleid" name="mod_id" tabindex="20">
										@foreach ($module as $rec)
											<option value="{{ $rec->mod_id }}"> {{ $rec->mod_name }}  </option>											
										@endforeach
										
									</select>
								</div>
								<span class=" label_intro"></span>
							</div>					
								
								<div class="form_grid_12">
									<label class="field_title" id="lsearch_query" for="search_query">Search Main Query</label>
									<div class="form_input">
										<textarea name="search_query" id="search_query" style="overflow-y: scroll;" class="" cols="70" rows="5" tabindex="5"></textarea>
									</div>
									<span class=" label_intro"></span>
								</div>
								
								<div class="form_grid_12">
									<label class="field_title" id="ldescription" for="description">Description</label>
									<div class="form_input">
										<input id="description" name="description" type="text" value="" maxlength="50" class="large"/>
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
	function deleteSearch(id){
		$("#operation").val(3);
		$("#se_id").val(id);
	}

	function openAddUser() {
		$("#se_id").val("0");
		$("#search_name").val("");
		$("#description").val("");
		$("#search_query").val("");
		$("#moduleid").val("");
		$("#operation").val(1);
		$("#usertable").hide();
		$("#adduserform").show();
	}

	function closeAddUser() {
		$("#search_name").val("");
		$("#description").val("");
		$("#search_query").val("");
		$("#usertable").show(200);
		$("#adduserform").hide(600);
	}

	function openEditSearch(id) {
		$("#se_id").val(id);
		$("#search_name").val($("#se_name_"+id).val());
		$("#description").val($("#se_desc_"+id).val());
		$("#search_query").val($("#se_query_"+id).val());
		$("#moduleid").val($("#se_mod_"+id).val());
		$("#operation").val(2);
		$("#usertable").hide(600);
		$("#adduserform").show(200);		
	}
</script>

</body>
</html>