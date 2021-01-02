<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Permission Denied</title>
@include('includes.header', ['page' => 'admin'])
	


	<div id="content">
		<div class="grid_container">
			<!--<table id="example" class="display" >
        <thead>
            <tr>
                <th>ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>ZIP / Post code</th>
                <th>Country</th>
            </tr>
        </thead>
    </table>-->
    
    
<div style="height: 100%;
    width: 100%;
    position: absolute;    background: #f9f9f9;" id="error_404">
	<div class="error_container">
		<br><br><br><br>
		<div class="error_info">
			@foreach($detail as $rec)
			
			<div style=" width: 100%; color: #000;" class="error_meta">
				<!--<span style="  color: #000;">Oops!</span>Permission Denied...-->
				<span style="  color: #000;">{{ $rec->moduleid }}</span>{{ $rec->name }}
				
			</div>
			<span class="clear"></span>
			@endforeach
		</div>
		<div class="error_content">
			<div style="  color: #000;" class="error_message">
				<span style="  color: #000;">We are sorry</span> The page you are trying to reach does not have permission :(
			</div>
			<span class="clear"></span>
		</div>
		
	</div>
</div>
		
			
		</div>
		<span class="clear"></span>

</div>
	


</body>
</html>