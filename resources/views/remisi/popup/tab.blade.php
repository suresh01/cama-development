<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Property Inspection</title>
<style>
.disabled-btn{
    pointer-events:none;
    opacity:0.7;
}
</style>
@include('includes.header', ['page' => 'VP'])
	
	<div id="content">
		<div class="grid_container">	
			
		<div id="usertable" class="grid_12">	
			<div id="breadCrumb3" class="breadCrumb grid_12">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="valterm">Valuation Data Management</a></li>
						<li><a href="valbasket?id={{$termid}}">{{$viewparamterm}} </a></li>
						<li><a href="property?id={{$pb}}">{{$viewparambasket}} - {{$viewparambasketstatus}}</a></li>
						<li>{{$accountnumber}} </li>
					</ul>
				</div>
			<br>

			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<!--<span class="h_icon list"></span>-->
						<h6>Property Inspection</h6>
						<div id="top_tabby">
						</div>
					</div>
					<input type="hidden" value="" id="propertystatus" >
					<div class="widget_content">
						<!--<h3>Property Registration</h3>-->
						<form action="" id="propertyinspectionform" class="form_container left_label">
							<fieldset title="Step 1">		
								<legend>Master Information</legend>	
								@include('inspection.tab.master')	
							</fieldset>
							<fieldset title="Step 2">
								<legend>Owner Information</legend>
								@include('inspection.tab.ownerold')	
							</fieldset>
							@if($applntype == 'C')
							<fieldset title="Step 2">
								<legend>Ratepayer Information</legend>
								@include('inspection.tab.ratepayer')	
							</fieldset>
							<fieldset title="Step 3">
								<legend>Tenant Information</legend>									
								@include('inspection.tab.tenant')							
							</fieldset>
							@endif
							<fieldset title="Step 4">
								<legend>Lot Information</legend>
								@include('inspection.tab.lot')	
							</fieldset>
							<fieldset title="Step 5">
								<legend>Property Use</legend>
								@include('inspection.tab.parameter')
							</fieldset>
							<fieldset title="Step 6">
								<legend>Building Information</legend>
								@include('inspection.tab.bldg')					
							</fieldset>
							<fieldset title="Step 7">
								<legend>Attachment</legend>
								@include('inspection.tab.attachmentnew')
							</fieldset>			
								<input type="submit" onclick="loader()" class="finish" id="finish" value="Finish!"/>
						</form>
					</div>
				</div>
			</div>
			</div>	
	</div>
	<div class="" id="finishloader"></div>
	<span class="clear"></span>
</div>
<
</body>
</html>