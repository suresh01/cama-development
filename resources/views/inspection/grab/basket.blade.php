<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('inspection.Basket')}} </title>
@include('includes.header-popup')

	<div id="content">
		<div class="grid_container">		
		  <div id="usertable" class="grid_12">
		  		<br>
				<div style="float:right;margin-right: 0px;"  class="btn_24_blue">   
					<a href="#" id="" onclick="closeWindow()" class=""><span>{{__('common.Close')}}  </span></a> 
				</div>
				<br>
				<div class="widget_wrap">
					<div class="widget_content">
						<table class="display data_tbl">
							<thead style="text-align: left;">
								<tr>
									<th class="table_sno">{{__('inspection.SNo')}} </th>
									<th>{{__('inspection.Bakset_Name')}} </th>
									<th>{{__('inspection.Property_Count')}} </th>
									<th>{{__('inspection.Approve_By_At')}} </th>
								</tr>
							</thead>
							<tbody>
								@foreach ($basket as $rec)
								<tr>
									<td>
										{{$loop->iteration}}
									</td>
									<td>
										<a href="newproperty?basket_id={{ $rec->pb_id }}&id={{ $id }}">{{ $rec->pb_name }}</a>
									</td>
									<td>
										{{ $rec->propcnt }}
									</td>
									<td>
										{{ $rec->pb_approvedby }} /
										{{ $rec->pb_approvedate }}
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
	
	</div>
	<span class="clear"></span>


</div>
<script type="text/javascript">
	function closeWindow(){
	    try {
	        window.opener.HandlePopupResult(sender.getAttribute("result"));
	    }
	    catch (err) {}
	    window.close();
	    return false;
  	}

</script>
</body>
</html>