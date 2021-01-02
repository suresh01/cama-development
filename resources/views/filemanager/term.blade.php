<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>DMS Term</title>
@include('includes.header', ['page' => 'datamaintenance'])

	<div id="content">
		<div class="grid_container">		
		
		
		<div id="usertable" class="grid_12">
	
			<br>
			<div class="form_input">

				<div id="breadCrumb3" style="float:right;" class="breadCrumb grid_3">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Data Maintenance</a></li>
						<li>DMS</li>
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
								TERM NAME
							</th>
							<th>
								DESCRIPTION
							</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>
								1
							</td>
							<td>
								 <a href="filemanager?term=1">TERM0001</a>
							</td>
							<td>
								TERM DESC
							</td>
						</tr>
						<tr>
							<td>
								2
							</td>
							<td>
								<a href="filemanager?term=2">TERM0003</a>
							</td>
							<td>
								DESC
							</td>
						</tr>
						</tbody>
						</table>
					</div>
				</div>
			</div>

	</div>
	<span class="clear"></span>


</div>
</body>
</html>