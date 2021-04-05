<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Lot Search</title>
<style type="text/css">

#proptble td.numericCol {
	text-align: right;
}

.multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}

</style>

<link href="multiselect/multiselect.css" rel="stylesheet"/>
<script src="multiselect/multiselect.min.js"></script>
@include('includes.header-popup', ['page' => 'datamaintenance'])
	<!--<div class="page_title">
		<span class="title_icon"><span class="blocks_images"></span></span>
		<h3>Users</h3>
		<div class="top_search">
			<form action="#" method="post">
				<ul id="search_box">
					<li>
					<input name="" type="text" class="search_input" id="suggest1" placeholder="Search...">
					</li>
					<li>
					<input name="" type="submit" value="" class="search_btn">
					</li>
				</ul>
			</form>
		</div>
	</div>-->
	<div style="margin-top: 0px !important" id="content">
		<div class="grid_container">


		<div class="grid_12">	
			<br>
				<div style="float:right;margin-right: 10px;"  class="btn_24_blue">					
					<a href="#" onclick="closeWindow()">Close</a>
				</div>
				<br>
				<div class="widget_wrap">	
					<div class="widget_top">
						<h6>Land</h6>
					</div>					
					<div class="widget_content">						
						<table style="width: 100%;" id="propdatatable" class="display ">							
							<thead style="text-align: left;">
					  		<tr>
								<th class="table_sno"> S NO</th>
								<th>LOT TYPE</th>
								<th>LOT NUMBER</th>
								<th>LOT TITLE TYPE</th>
								<th>LOT TITLE NUMBER</th>
								<th>ALTERNATIF TITLE NUMBER</th>
								<th>LAND AREA</th>
								<th>LAND AREA UNIT</th>
								<th>LAND USE</th>
								<th>ACTION</th>
								<th style="display: none;">id</th>
							</tr>
							</thead>
							<tbody>
								@foreach ($lot as $rec)
								<tr>
									<td>
										{{$loop->iteration}}
									</td>
									<td>
										{{$rec->lotcode}}
									</td>
									<td>
										{{$rec->al_no}}
									</td>
									<td>
										{{$rec->titletype}}
									</td>
									<td>
										{{$rec->titlenumber}}
									</td>
									<td>
										{{$rec->al_altno}}
									</td>
									<td>
										{{$rec->al_size}}
									</td>
									<td>
										{{$rec->unitsize}}
									</td>
									<td>
										{{$rec->landuse}}
									</td>
									<td>
										<span><a onclick="addLot()" class="action-icons c-edit editaddrow" href="#" title="Add">Add</a></span>
									</td>
									<td style="display: none;">
										{{$rec->al_id}}
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<br><br>

				<div class="widget_wrap">	
					<div class="widget_top">
						<h6>Building</h6>
					</div>				
					<div class="widget_content">						
						<table style="width: 100%;" id="bldgtable" class="display ">							
							<thead style="text-align: left;">
					  		<tr>
								<th class="table_sno"> S NO</th>
								<th>BUILDING NUMBER</th>
								<th>BUILDING CATEGORY</th>
								<th>BUILDING TYPE</th>
								<th>BUILDING STOREY</th>
								<th>BUILDING STRUCTURE</th>
								<th>ROOF TYPE</th>
								<th>MAIN BUILDING</th>
								<th>ACTION</th>
								<th style="display: none;">id</th>
							</tr>
							</thead>
							<tbody>
								@foreach ($building as $rec)
								<tr>
									<td>
										{{$loop->iteration}}
									</td>
									<td>
										{{$rec->ab_bldg_no}}
									</td>
									<td>
										{{$rec->bldgcategory}}
									</td>
									<td>
										{{$rec->bldgtype}}
									</td>
									<td>
										{{$rec->bldgstorey}}
									</td>
									<td>
										{{$rec->bldgstr}}
									</td>
									<td>
										{{$rec->rootype}}
									</td>
									<td>
										{{$rec->ab_ismainbldg_id}}
									</td>
									<td>
										<span><a onclick="addBldg()" class="action-icons c-edit editbldgrow" href="#" title="Add">Add</a></span>
									</td>
									<td style="display: none;">
										{{$rec->ab_id}}
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>

			</div>
				
		</div>
	</div>
		
		
	<span class="clear"></span>

<script>


	$(document).ready(function() {	

	

	    var table = $('#propdatatable').DataTable();

		$('#propdatatable_filter').remove();
	    $('#propdatatable_info').remove();
	    $('#propdatatable_paginate').remove();
	    $('#propdatatable_length').remove();

		$('#propdatatable tbody').on( 'click', '.editaddrow', function () {

			var row = table.row(table.row( $(this).parents('tr') ).index()),
			    data = row.data();
			    
			    var t = window.opener.$('#landtable').DataTable();
				window.opener.$('#landtable_filter').remove();
			    window.opener.$('#landtable_info').remove();
			    window.opener.$('#landtable_paginate').remove();
			    window.opener.$('#landtable_length').remove();
				t.row.add([ 'New','<a href="#" onclick="addLandStandard()">'+data[1]+' '+data[2]+'</a>', data[6], '0', '0', '<span><a onclick="" class="action-icons c-edit editaddrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons c-delete deleteaddrow " href="#" title="delete">Delete</a></span>',data[10],'new']).draw( false );	
				alert('Land Added');
		   	
		});

		var bldgtable = $('#bldgtable').DataTable();

		$('#bldgtable_filter').remove();
	    $('#bldgtable_info').remove();
	    $('#bldgtable_paginate').remove();
	    $('#bldgtable_length').remove();

		$('#bldgtable tbody').on( 'click', '.editbldgrow', function () {

			var row = bldgtable.row(bldgtable.row( $(this).parents('tr') ).index()),
			    data = row.data();
			    console.log(data);
			    //alert(data[8]);
			    var t = window.opener.$('#bldgtable').DataTable();
				window.opener.$('#bldgtable_filter').remove();
			    window.opener.$('#bldgtable_info').remove();
			    window.opener.$('#bldgtable_paginate').remove();
			    window.opener.$('#bldgtable_length').remove();
				t.row.add([ 'New','<a href="#" onclick="addBldg('+data[9]+','+data[0]+')">'+data[3]+'</a>', data[4], '0', '0','0','0','0', '<span><a onclick="" class="action-icons c-edit editaddrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons c-delete deleteaddrow " href="#" title="delete">Delete</a></span>']).draw( false );	
				alert('Building Added');
		   	
		});

	});


	function closeWindow(){
		window.close();
	}


	/*function addBldgAR(){		
    	var t = window.opener.$('#landtable').DataTable();
		window.opener.$('#landtable_filter').remove();
	    window.opener.$('#landtable_info').remove();
	    window.opener.$('#landtable_paginate').remove();
	    window.opener.$('#landtable_length').remove();
		t.row.add([ 'New','<a href="#" onclick="addLandStandard()">PT 10001</a>', '300', '0', '0', '<span><a onclick="" class="action-icons c-edit editaddrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons c-delete deleteaddrow " href="#" title="delete">Delete</a></span>','new']).draw( false );	
		//window.close();
	}*/
	

</script>
</div>
</body>
</html>