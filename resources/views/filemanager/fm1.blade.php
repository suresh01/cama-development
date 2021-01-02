<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>DMS</title>


@include('includes.header', ['page' => 'datamaintenance'])
	

	<div id="content">
		<div class="grid_container">
			<script>
			$(document).ready(function() {		
	/*======================
	FILE EXPLORER
	========================*/
	var f = $('#elfinder').elfinder({
				//url : 'http://host/blue/connectors/php/connector.php',
				url : 'http://{{$serverhost}}/FileServer/connectors/php/connector.php?host={{$serverhost}}&db_host=localhost&db_user=root&db_pass=',
				lang : 'en',
				docked : true
				// dialog : {
				// 	title : 'File manager',
				// 	height : 500
				// }
				// Callback example
				//editorCallback : function(url) {
				//	if (window.console && window.console.log) {
				//		window.console.log(url);
				//	} else {
				//		alert(url);
				//	}
				//},
				//closeOnEditorCallback : true	
				});
			});
		</script>		
		
		<div id="usertable" class="grid_12">	
			<br>
			<div class="form_input">
				<div id="breadCrumb3" style="float:right;" class="breadCrumb grid_3">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Data Maintenance</a></li>
						<li><a href="fmterm">DMS</a></li>
						<li>File Manager</li>
					</ul>
				</div>
			</div>
			<div class="grid_container">
				<div class="grid_12 full_block">
					<div class="widget_wrap">
						<div class="widget_content">
							<div id="elfinder">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
				
		
		
	</div>
	<span class="clear"></span>


</div>
</body>
</html>