<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Notis</title>

@include('includes.header-popup')
					
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">
        
				<div class="widget_wrap tabby">
					<div class="widget_top">
						<div id="widget_tab">
							<ul>
								<li><a href="remisidetail">Property Information</a></li>
								<li><a href="remisiregister" >Registration </a></li>
								<li><a href="investigation" class="active_tab">Investigation</a></li>
								<li><a href="insresult">Investigation Result</a></li>
							</ul>
						</div>
					</div>
					</br></br>
				<button id="" style="float:right;" name="btnadduser" type="button" class="basic-custom-modal1 btn_small btn_blue"><span>Add</span></button>
								</br>	</br></br>
					<div class="widget_content">			
						<table class="display data_tbl">
					<thead style="text-align: left;">
					<tr>
						<th class="table_sno">
							S No
						</th>
						<th>
							Investigation Date
						</th>
						<th>
							Investigation Officer
						</th>
						<th>
							Action 
						</th>
						
					</tr>
					</thead>
					<tbody>
				
					<tr>
						<td>
							1
						</td>
						<td>
							
						</td>
						<td>
							
						</td>
						<td>
							<span><a class="action-icons c-edit" onclick="editBasket()" href="#" title="Edit">Edit</a></span>
							<span><a class="action-icons c-Delete delete_tenant" onclick="deleteBasket()" href="#" title="Delete">Delete</a></span>
						</td>
					</tr>
				
					</table>
					</div>
				</div>
			</div>
				
		</div>
		
	</div>
	<span class="clear"></span>
	
	<script>



	</script>
</div>

</body>
</html>