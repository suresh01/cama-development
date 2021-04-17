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
						<table id="baskttable" class="display tbl_details">
							<thead style="text-align: left;">
			  					<tr>
									<th class="table_sno">
										S No
									</th>
									<th>
										Basket Name
									</th>
									<th>
										Application Type
									</th>
									<th>
										Term Name
									</th>
									<th>
										Property Count
									</th>
									<th>
										Inspection Submitted
									</th>
									<th>
										Valuation Submitted
									</th>
									<th>
										Agenda Name
									</th>
									<th>
										Status
									</th>
									<th style="display: none;">
										Update By /
										Update At
									</th>
									<th style="display: none;">
										Create By /
										Create At
									</th>
									<th style="display: none;">
										Notice Count
									</th>
									<th style="display: none;">
										Objection Count
									</th>
									<th style="display: none;">
										Decision Count
									</th>
									<th>
										Action
									</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($group as $rec)
								<tr>
									<td>
										{{$loop->iteration}}
									</td>
									<td>
										<a onclick="isUrlAllowed(514,'property?id={{$rec->id}}')" href="#">{{$rec->l_group}}</a>
									</td>
									<td>
										{{$rec->applntype}}
									</td>
									<td>
										{{$rec->termaname}}
									</td>
									<td>
										{{$rec->propertycount}}
									</td>
									<td>
										{{$rec->inspropertyccount}}
									</td>
									<td>
										{{$rec->valcount}}
									</td>
									<td>
										{{$rec->ob_desc}}
									</td>
									<td>{{$rec->approval}}										
									</td>
									<td style="display: none;">
										{{$rec->updateby}} /
										{{$rec->updatedate}}
									</td>
									<td style="display: none;">
										{{$rec->createby}} / 
										{{$rec->createdate}}
									</td>
									<td style="display: none;">{{$rec->notiscount}}										
									</td>
									<td style="display: none;">{{$rec->objectioincount}}										
									</td>
									<td style="display: none;">{{$rec->decisioncount}}										
									</td>
									<td>
										
									</td>
								</tr>
								<div style="display: none;">
									<input type="text" id="name_{{ $rec->id }}" value="{{ $rec->l_group }}">
									<input type="text" id="term_{{ $rec->id }}" value="{{ $rec->termid }}">
								</div>
								@endforeach						
							</tbody>
						</table>
					</div>
				</div>
			</div>

		


	<span class="clear"></span>
	
	

</div>
</body>
</html>