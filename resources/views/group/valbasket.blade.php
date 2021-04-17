<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Basket</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
@include('includes.header', ['page' => 'VP'])
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
	<div onload="setFilter()" id="content">
		<div class="grid_container">
			
			<div id="grouptable" class="grid_12">
	
				<br>
				<div class="form_input">
					

					<div id="breadCrumb3"  class="breadCrumb grid_3">
						<ul >
							<li><a href="#">Home</a></li>
							<li><a href="valterm">Valuation Data Management</a></li>
							<li>Basket Management</li>
						</ul>
					</div>
					<button id="adduser" style="float:right;margin-right: 10px;" onclick="newGroup()" name="btnadduser" type="button" class="btn_small btn_blue"><span>Add Basket</span></button>
					
					<br>
				</div>		
				<div class="widget_wrap">					
					<div class="widget_content">	
						
										
						<br>					
						
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