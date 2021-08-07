<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Valuation Failed</title>
<style>
	.left-text {
		text-align:right;
	}
</style>
@include('includes.header', ['page' => 'VP'])
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div id="breadCrumb3"  class="breadCrumb grid_3">
						<ul >
							<li><a href="#">Home</a></li>
							<li>Valuation Process</li>
						</ul>
					</div>
					<button id="adduser" style="float:right;margin-right: 10px;" onclick="back()" name="btnadduser" type="button" class="btn_small btn_blue"><span>Back</span></button>
					<br>
				<div class="widget_wrap">
					<div class="widget_top">
						<h6>Tone of list missing property value	</h6>
					</div>
					<div class="widget_content">
						<div class=" page_content">
							<div class="invoice_container">	
								
						
								<span class="clear"></span>
								<div class="grid_12 invoice_details">
									<div class="widget_wrap collapsible_widget">
										<div class="widget_top active">
											<span class="h_icon"></span>
											<h6>Bulidind Detail</h6>
										</div>
										<div class="widget_content">
											<div class="invoice_tbl">
												<table id="bldgtable">
												<thead>
												<tr class=" gray_sai">
													<th style="width: 40px;">
														S No
													</th>
													<th>
														ZONE 
													</th>
													<th>
														SUBZONE 
													</th>
													<th>
														BUILDING CATEGORY
													</th>
													<th>
														BUILDING TYPE
													</th>
													<th>
														BUILDING STOREY
													</th>
													<th>
														AREA TYPE
													</th>
													<th>
														AREA LEVEL
													</th>
													<th>
														AREA CATEGORY
													</th>
													<th>
														AREA USE
													</th>
													<th>
														STATUS
													</th>
												</tr>
												</thead>
												<tbody>
													@foreach ($bldgar as $rec)
													<td style="width: 40px;">
														{{$loop->iteration}}
													</td>
													<td>
														@if($rec->approvalstatus == '')
															<a id="bldglinkid_{{$loop->iteration}}" class="bldg-modal" onclick="addbldg('{{$loop->iteration}}')" href="#">{{$rec->zone}}</a>
														@else
															{{$rec->zone}}
														@endif
													</td>
													<td>{{$rec->subzone}}
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
														{{$rec->artype}}
													</td>
													<td>
														{{$rec->arlvl}}
													</td>
													<td>
														{{$rec->arcate}}
													</td>
													<td>
														{{$rec->aruse}}	
													</td>
													<td>
														{{$rec->approvalstatus}}	
													</td>
												</tr>
												<div style="display:none">
													<input type="hidden" id="suzone_{{$loop->iteration}}" value="{{ $rec->ma_subzone_id }}">
													<input type="hidden" id="proptype_{{$loop->iteration}}" value="{{ $rec->ab_bldgtype_id }}">	
													<input type="hidden" id="propstoery_{{$loop->iteration}}" value="{{ $rec->ab_bldgstorey_id }}">			
													<input type="hidden" id="artype_{{$loop->iteration}}" value="{{ $rec->aba_areatype_id }}">
													<input type="hidden" id="arlvl_{{$loop->iteration}}" value="{{ $rec->aba_arealevel_id }}">
													<input type="hidden" id="arcate_{{$loop->iteration}}" value="{{ $rec->aba_areacategory_id }}">	
													<input type="hidden" id="aruse_{{$loop->iteration}}" value="{{ $rec->aba_areause_id }}">	
													<input type="hidden" id="zone_{{$loop->iteration}}" value="{{ $rec->zone }}">	
													<input type="hidden" id="category_{{$loop->iteration}}" value="{{ $rec->bldgcategory }}">	
													<input type="hidden" id="valtype_{{$loop->iteration}}" value="{{ $rec->vt_valbase_id }}">		
												</div>
												@endforeach
												
												
												</tbody>
												</table>
											</div>
										</div>
									</div>

									
								</div>

								<div id="addBldgForm" style="display:none" class="grid_12">
									<div class="widget_wrap">
										
										<div class="widget_content">
											<h3 id="title">Add Building Tone</h3>
											<form id="bldgform" autocomplete="off" method="post" action="#" >
												<div  class="grid_12 form_container left_label">
													<ul>
														<li>
															<input type="hidden" name="operation" value="1" id="operation">
															<input type="hidden" name="basketid" value="{{$tonebasket_id}}" id="basketid">
															<input type="hidden" name="bldg_id" id="bldg_id">
															<fieldset>
																<legend>Information</legend>
																
																<div class="form_grid_12">
																	<label class="field_title" id="accnumberlbl" for="username">Transaction Type<span class="req">*</span></label>
																	<div  class="form_input">
																		<select data-placeholder="Choose a type..." style="width:100%" disabled="disabled"  class="cus-select" id="transtype" name="trnstype" tabindex="20">
																			<option></option>
																			@foreach ($transtype as $rec)
																				<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
																			@endforeach	
																		</select>
																	</div>
																	<span class=" label_intro"></span>
																</div>
																
																
																<div class="form_grid_12">
																	<label class="field_title" id="lposition" for="position">ZONE<span class="req">*</span></label>
																	<div  class="form_input">
																		<input type="text" disabled="" id="bldgzone" name="zone">
																	</div>
																	<span class=" label_intro"></span>
																</div>
																
																<div class="form_grid_12">
																	<label class="field_title" id="accnumberlbl" for="username">SUBZONE<span class="req">*</span></label>
																	<div  class="form_input">
																		<select data-placeholder="Choose a type..." style="width:100%" disabled="disabled"  class="cus-select" id="subzone" name="subzone" tabindex="20">
																			<option></option>
																			@foreach ($subzone as $rec)
																				<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
																			@endforeach	
																		</select>
																	</div>
																	<span class=" label_intro"></span>
																</div>
																
																<div class="form_grid_12">
																	<label class="field_title" id="llevel" for="level">PROPERTY CATEGORY<span class="req">*</span></label>
																	<div  class="form_input">
																		<input type="text" disabled="" id="bldgcate" name="bldgcate">
																		
																	</div>
																	<span class=" label_intro"></span>
																</div>

																<div class="form_grid_12">
																	<label class="field_title" id="llevel" for="level">PROPERTY TYPE<span class="req">*</span></label>
																	<div  class="form_input">
																		<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="proptype" name="proptype" disabled="disabled"  tabindex="20">
																			<option></option>
																			@foreach ($bldgtype as $rec)
																				<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
																			@endforeach	
																		</select>
																	</div>
																	<span class=" label_intro"></span>
																</div>

																<div class="form_grid_12">
																	<label class="field_title" id="llevel" for="level">PROPERTY STOREY<span class="req">*</span></label>
																	<div  class="form_input">
																		<select data-placeholder="Choose a type..." style="width:100%" disabled="disabled" class="cus-select" id="propstoery" name="propstoery" tabindex="20">
																			<option></option>
																			@foreach ($bldgstore as $rec)
																				<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
																			@endforeach	
																		</select>
																	</div>
																	<span class=" label_intro"></span>
																</div>
																<div class="form_grid_12">
																	<label class="field_title" id="llevel" for="level">AREA TYPE<span class="req">*</span></label>
																	<div  class="form_input">
																		<select disabled="disabled" data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="artype" name="artype" tabindex="20">
																			<option></option>
																			@foreach ($artype as $rec)
																				<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
																			@endforeach	
																		</select>
																	</div>
																	<span class=" label_intro"></span>
																</div>
																<div class="form_grid_12">
																	<label class="field_title" id="llevel" for="level">AREA LEVEL<span class="req">*</span></label>
																	<div  class="form_input">
																		<select disabled="disabled" data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="arlvl" name="arlvl" tabindex="20">
																			<option></option>
																			@foreach ($arlvl as $rec)
																				<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
																			@endforeach	
																		</select>
																	</div>
																	<span class=" label_intro"></span>
																</div>
																<div class="form_grid_12">
																	<label class="field_title" id="llevel" for="level">AREA CATEGORY<span class="req">*</span></label>
																	<div  class="form_input">
																		<select disabled="disabled" data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="arcate" name="arcate" tabindex="20">
																			<option></option>
																			@foreach ($arcaty as $rec)
																				<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
																			@endforeach	
																		</select>
																	</div>
																	<span class=" label_intro"></span>
																</div>

																<div class="form_grid_12">
																	<label class="field_title" id="llevel" for="level">AREA USE<span class="req">*</span></label>
																	<div  class="form_input">
																		<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" disabled="disabled" id="aruse" name="aruse" tabindex="20">
																			<option></option>
																			@foreach ($aruse as $rec)
																				<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
																			@endforeach	
																		</select>
																	</div>
																	<span class=" label_intro"></span>
																</div>

																<div class="form_grid_12">
																	<label class="field_title" id="llevel" for="level">VALUE<span class="req">*</span></label>
																	<div  class="form_input">
																		<input id="value" name="value"  type="text"  maxlength="50" class="required"/>
																	</div>
																	<span class=" label_intro"></span>
																</div>

															</fieldset>

									
														</li>
													</ul>
												</div>
												
												<div  class="grid_12">							
													<div class="form_input">
														<button id="addsubmit" name="adduser" onclick="updateBldg()" class="btn_small btn_blue"><span>Submit</span></button>									
														
														<button id="close" onclick="closeBldg()" name="close" type="button" class="btn_small btn_blue simplemodal-close"><span>Close</span></button>
														<span class=" label_intro"></span>
													</div>								
													<span class="clear"></span>
												</div>
											</form>
										</div>
									</div>
								</div>
								<div class="grid_12 invoice_details">
									<div class="widget_wrap collapsible_widget">
										<div class="widget_top active">
											<span class="h_icon"></span>
											<h6>Depreciation Detail</h6>
										</div>
					        	
										<div class="widget_content">
											<div class="invoice_tbl">
												<table id="deptable">
												<thead>
												<tr class=" gray_sai">
													<th style="width: 40px;">
														S No
													</th>
													<th>
														BUILDING CONDITION
													</th>
													<th>
														STATUS
													</th>
												</tr>
												</thead>
												<tbody>
													@foreach ($depreciation as $rec)
													<td style="width: 40px;">
														{{$loop->iteration}}
													</td>
													<td>
														@if($rec->approvalstatus == '')
															<a class="dep-modal" onclick="editDep('{{$loop->iteration}}')" href="#">{{$rec->bldgcond}}</a>
														@else
															{{$rec->bldgcond}}
														@endif
													</td>
													<td style="width: 190px;">
														{{$rec->approvalstatus}}
													</td>
												</tr>
												<div style="display:none">
													<input type="hidden" id="bldgcond_{{ $loop->iteration }}" value="{{ $rec->ab_bldgcondn_id }}">
												</div>
												@endforeach
												
												
												</tbody>
												</table>
											</div>
										</div>
									</div>

									
								</div>
								<div id="addDepreciation" style="display:none" class="grid_12">
									<div class="widget_wrap">
										
										<div class="widget_content">
											<h3 id="title">Add </h3>
											<form id="debform" autocomplete="off" method="post" action="#" >
												<div  class="grid_12 form_container left_label">
													<ul>
														<li>
															<input type="hidden" name="operation" value="1" id="operation">
															<input type="hidden" name="basketid" value="{{$tonebasket_id}}" id="basketid">
															<input type="hidden" name="dep_id" id="dep_id">
															<fieldset>
																<legend>Basket Information</legend>
																
																<div class="form_grid_12">
																	<label class="field_title" id="lposition" for="position">BUILDING CONDITION<span class="req">*</span></label>
																	<div  class="form_input">
																		<select data-placeholder="Choose a type..." style="width:100%" disabled="disabled" class="cus-select" id="bldgcond" name="bldgcond" tabindex="20">
																			<option></option>
																			@foreach ($bldgcond as $rec)
																				<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
																			@endforeach
																		</select>
																	</div>
																	<span class=" label_intro"></span>
																</div>
																
																<div class="form_grid_12">
																	<label class="field_title" id="llevel" for="level">VALUE<span class="req">*</span></label>
																	<div  class="form_input">
																		<input id="value" name="value"  type="text"  maxlength="50" class="required"/>
																	</div>
																	<span class=" label_intro"></span>
																</div>
															
															</fieldset>

									
														</li>
													</ul>
												</div>
												
												<div class="grid_12">							
													<div class="form_input">
														<button id="addsubmit" name="adduser" onclick="addDep()" class="btn_small btn_blue"><span>Submit</span></button>									
														
														<button id="close" onclick="closeDep()" name="close" type="button" class="btn_small btn_blue simplemodal-close"><span>Close</span></button>
														<span class=" label_intro"></span>
													</div>								
													<span class="clear"></span>
												</div>
											</form>
										</div>
									</div>
								</div>


								<div class="grid_12 invoice_details">
									<div class="widget_wrap collapsible_widget">
										<div class="widget_top active">
											<span class="h_icon"></span>
											<h6>Land Detail</h6>
										</div>
										<div class="widget_content">
											<div class="invoice_tbl">
												<table id="landtable">
												<thead>
													<tr class=" gray_sai">
														<th style="width: 40px;"  class="table_sno">
															S No
														</th>
														<th>
															Zone
														</th>
														<th>
															Subzone
														</th>
														<th>
															Building Status
														</th>
														<th>
															Property Category
														</th>
														<th>
															Property type
														</th>
														<th>
															Property Storey
														</th>
														<th>
															STATUS
														</th>
														
													</tr>
												</thead>
												<tbody>
													@foreach ($land as $rec)
													<tr  style="width: 40px;">
													<td>
														{{$loop->iteration}}
													</td>
													<td>
														@if($rec->approvalstatus == '')
															<a class="bldg-modal" onclick="addLand('{{$loop->iteration}}')" href="#">{{$rec->zone}}</a>
														@else
															{{$rec->zone}}
														@endif
														
													</td>
													<td>{{$rec->subzone}}
													</td>
													<td>
														{{$rec->bldgstatus}}
													</td>
													<td>
														{{$rec->bldgcate}}
													</td>
													<td>
														{{$rec->bldgtype}}
													</td>
													<td>
														{{$rec->bldglevel}}
													</td>
													<td style="width: 190px;">
														{{$rec->approvalstatus}}
													</td>
													</tr>
													<div style="display:none">
														<input type="hidden" id="lsuzone_{{$loop->iteration}}" value="{{ $rec->ma_subzone_id }}">
														<input type="hidden" id="lproptype_{{$loop->iteration}}" value="{{ $rec->ap_propertytype_id }}">	
														<input type="hidden" id="lpropstoery_{{$loop->iteration}}" value="{{ $rec->ap_propertylevel_id }}">			
														<input type="hidden" id="lhasbldg_{{$loop->iteration}}" value="{{ $rec->ap_bldgstatus_id }}">	
													</div>
													@endforeach
												</tbody>
												</table>
											</div>
										</div>
									</div>

									
								</div>

								<div id="addlotform" style="display:none" class="grid_12">
									<div class="widget_wrap">
										
										<div class="widget_content">
											<h3 id="title">Add </h3>
											<form id="lotform" autocomplete="off" method="post" action="#" >
												<div  class="grid_12 form_container left_label">
													<ul>
														<li>
															<input type="hidden" name="operation" value="1" id="operation">
															<input type="hidden" name="basketid" value="{{$tonebasket_id}}" id="basketid">
															<input type="hidden" name="land_id" id="land_id">
															<fieldset>
																<legend>Basket Information</legend>
															
																
																
																<div class="form_grid_12">
																	<label class="field_title" id="accnumberlbl" for="username">SUBZONE<span class="req">*</span></label>
																	<div  class="form_input">
																		<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" disabled="disabled" id="lsubzone" name="subzone" tabindex="20">
																			<option></option>
																			@foreach ($subzone as $rec)
																				<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
																			@endforeach	
																		</select>
																	</div>
																	<span class=" label_intro"></span>
																</div>

																
																
																<div class="form_grid_12">
																	<label class="field_title" id="llevel" for="level">PROPERTY TYPE<span class="req">*</span></label>
																	<div  class="form_input">
																		<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" disabled="disabled" id="lproptype" name="proptype" tabindex="20">
																			<option></option>
																			@foreach ($bldgtype as $rec)
																				<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
																			@endforeach	
																		</select>
																	</div>
																	<span class=" label_intro"></span>
																</div>

																<div class="form_grid_12">
																	<label class="field_title" id="llevel" for="level">PROPERTY STOREY<span class="req">*</span></label>
																	<div  class="form_input">
																		<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" disabled="disabled" id="lpropstoery" name="propstoery" tabindex="20">
																			<option></option>
																			@foreach ($bldgstore as $rec)
																				<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
																			@endforeach	
																		</select>
																	</div>
																	<span class=" label_intro"></span>
																</div>
																<div class="form_grid_12">
																	<label class="field_title" id="llevel" for="level">HAS BUILDING<span class="req">*</span></label>
																	<div  class="form_input">
																		<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" disabled="disabled" id="lhasbldg" name="hasbldg" tabindex="20">
																			<option></option>
																			@foreach ($hasbldg as $rec)
																				<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
																			@endforeach	
																		</select>
																	</div>
																	<span class=" label_intro"></span>
																</div>

																<div class="form_grid_12">
																	<label class="field_title" id="llevel" for="level">VALUE<span class="req">*</span></label>
																	<div  class="form_input">
																		<input id="lvalue" name="value"  type="text"  maxlength="50" class="required"/>
																	</div>
																	<span class=" label_intro"></span>
																</div>

															</fieldset>

									
														</li>
													</ul>
												</div>
												
												<div class="grid_12">							
													<div class="form_input">
														<button id="addsubmit" name="adduser" onclick="updateLand()" class="btn_small btn_blue"><span>Submit</span></button>									
														
														<button id="close" name="close" type="button" class="btn_small btn_blue simplemodal-close"><span>Close</span></button>
														<span class=" label_intro"></span>
													</div>								
													<span class="clear"></span>
												</div>
											</form>
										</div>
									</div>
								</div>
								<div class="grid_12 invoice_details">
									<div class="widget_wrap collapsible_widget">
										<div class="widget_top active">
											<span class="h_icon"></span>
											<h6>Land Standard</h6>
										</div>
										<div class="widget_content">
											<div class="invoice_tbl">
												<table id="landstd">
												<thead>
												<tr class=" gray_sai">
													<th style="width: 40px;">
														S No
													</th>
													<th>
														ZONE 
													</th>
													<th>
														SUBZONE 
													</th>
													<th>
														BUILDING CATEGORY
													</th>
													<th>
														BUILDING TYPE
													</th>
													<th>
														BUILDING STOREY
													</th>
													<th>
														STATUS
													</th>
												</tr>
												</thead>
												<tbody>
													@foreach ($landstandard as $rec)
													<td style="width: 40px;">
														{{$loop->iteration}}
													</td>
													<td>

														@if($rec->approvalstatus == '')
															<a class="bldg-modal" onclick="addLandSd('{{$loop->iteration}}')" href="#">{{$rec->zone}}</a>
														@else
															{{$rec->zone}}
														@endif
													</td>
													<td>{{$rec->subzone}}
													</td>
													<td>
														{{$rec->bldgcategory}}
													</td>
													<td>
														{{$rec->bldgtype}}
													</td>
													<td>
														{{$rec->bldglevel}}
													</td>
													<td style="width: 190px;">
														{{$rec->approvalstatus}}
													</td>
												</tr>
												<div style="display:none">
													<input type="hidden" id="lssubzone_{{$loop->iteration}}" value="{{ $rec->ma_subzone_id }}">
													<input type="hidden" id="lsproptype_{{$loop->iteration}}" value="{{ $rec->ap_propertytype_id }}">
													<input type="hidden" id="lspropstoery_{{$loop->iteration}}" value="{{ $rec->ap_propertylevel_id }}">			
												</div>
												@endforeach
												
												
												</tbody>
												</table>
											</div>
										</div>
									</div>

									
								</div>

		<div id="landstandard-section" style="display:none" class="grid_12">
			<div class="widget_wrap">
				
				<div class="widget_content">
					<h3 id="title">Add </h3>
					<form id="landstatardform" autocomplete="off" method="post" action="#" >
						<div  class="grid_12 form_container left_label">
							<ul>
								<li>
															<input type="hidden" name="operation" value="1" id="operation">
															<input type="hidden" name="basketid" value="{{$tonebasket_id}}" id="basketid">
															<input type="hidden" name="landstd_id" id="landstd_id">
									<fieldset>
										<legend>Basket Information</legend>
																			
										
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">SUBZONE<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="lssubzone" disabled="disabled" name="subzone" tabindex="20">
													<option></option>
													@foreach ($subzone as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>										

										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">PROPERTY TYPE<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="lsproptype" disabled="disabled" name="proptype" tabindex="20">
													<option></option>
													@foreach ($bldgtype as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">PROPERTY STOREY<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="lspropstoery" disabled="disabled" name="propstoery" tabindex="20">
													<option></option>
													@foreach ($bldgstore as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">STANDARD AREA NUMBER<span class="req">*</span></label>
											<div  class="form_input">
												<input id="standardarea" name="standardarea"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">NEXT AREA NUMBER<span class="req">*</span></label>
											<div  class="form_input">
												<input id="nextarea" name="nextarea"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">MAX AREA NUMBER<span class="req">*</span></label>
											<div  class="form_input">
												<input id="maxarea" name="maxarea"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>
									
									</fieldset>

			
								</li>
							</ul>
						</div>
						
						<div class="grid_12">							
							<div class="form_input">
								<button id="addsubmit" name="adduser" onclick="updateLandSd()" class="btn_small btn_blue"><span>Submit</span></button>									
								
								<button id="close" name="close" type="button" class="btn_small btn_blue simplemodal-close"><span>Close</span></button>
								<span class=" label_intro"></span>
							</div>								
							<span class="clear"></span>
						</div>
					</form>
				</div>
			</div>
		</div>
								<div class="grid_12 invoice_details">
									<div class="widget_wrap collapsible_widget">
										<div class="widget_top active">
											<span class="h_icon"></span>
											<h6>Tax Detail</h6>
										</div>
										<div class="widget_content">
											<div class="invoice_tbl">
												<table id="taxtable">
												<thead>
												<tr class=" gray_sai">
													<th style="width: 40px;">
														S No
													</th>
													<th>
														ZONE 
													</th>
													<th>
														BUILDING CATEGORY
													</th>
													<th>
														BUILDING TYPE
													</th>
													<th>
														BUILDING STATUS
													</th>
													<th>
														STATUS
													</th>
												</tr>
												</thead>
												<tbody>
													@foreach ($tax as $rec)
													<td style="width: 40px;">
														{{$loop->iteration}}
													</td>
													<td>
														@if($rec->approvalstatus == '')
															<a id="linkid_{{$loop->iteration}}" class="bldg-modal" onclick="editTax('{{$loop->iteration}}')" href="#">{{$rec->zone}}</a>
														@else
															{{$rec->zone}}
														@endif
													</td>
													<td>
														{{$rec->bldgcategory}}
													</td>
													<td>
														{{$rec->proptype}}
													</td>
													<td>
														{{$rec->bldgstatus}}
													</td>
													<td  style="width: 190px;">
														{{$rec->approvalstatus}}
													</td>
												</tr>
												<div style="display:none">
													<input type="hidden" id="tzone_{{$loop->iteration}}" value="{{ $rec->tdi_parent_key }}">
													<input type="hidden" id="thasbldg_{{$loop->iteration}}" value="{{ $rec->ap_bldgstatus_id }}">	
													<input type="hidden" id="tproptype_{{$loop->iteration}}" value="{{ $rec->ap_propertytype_id }}">			
												</div>
												@endforeach
												
												
												</tbody>
												</table>
											</div>
										</div>
									</div>

									
								</div>

								<div id="taxsection" style="display:none" class="grid_12">
			<div class="widget_wrap">
				
				<div class="widget_content">
					<h3 id="title">Add </h3>
					<form id="taxform" autocomplete="off" method="post" action="#" >
						<div  class="grid_12 form_container left_label">
							<ul>
								<li>
															<input type="hidden" name="operation" value="1" id="operation">
															<input type="hidden" name="basketid" value="{{$tonetaxbasket_id}}" id="basketid">
															<input type="hidden" name="tax_id" id="tax_id">
									<fieldset>
										<legend>Basket Information</legend>
										
										
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">ZONE<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="tzone" disabled="disabled" name="zone" tabindex="20">
													<option></option>
													@foreach ($zone as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										
										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">PROPERTY TYPE<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="tproptype" disabled="disabled" name="proptype" tabindex="20">
													<option></option>
													@foreach ($bldgtype as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>


										<div class="form_grid_12">
											<label class="field_title" id="accnumberlbl" for="username">HAS BUILDING<span class="req">*</span></label>
											<div  class="form_input">
												<select data-placeholder="Choose a type..." style="width:100%" class="cus-select" id="thasbldg" disabled="disabled" name="hasbldg" tabindex="20">
													<option></option>
													@foreach ($hasbldg as $rec)
														<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
													@endforeach	
												</select>
											</div>
											<span class=" label_intro"></span>
										</div>
										
										

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">VALUE<span class="req">*</span></label>
											<div  class="form_input">
												<input id="value" name="value"  type="text"  maxlength="50" class="required"/>
											</div>
											<span class=" label_intro"></span>
										</div>
									
									</fieldset>

			
								</li>
							</ul>
						</div>
						
						<div class="grid_12">							
							<div class="form_input">
								<button id="addsubmit" name="adduser" onclick="addTax()" class="btn_small btn_blue"><span>Submit</span></button>									
								
								<button id="close" name="close" type="button" class="btn_small btn_blue simplemodal-close"><span>Close</span></button>
								<span class=" label_intro"></span>
							</div>								
							<span class="clear"></span>
						</div>
					</form>
				</div>
			</div>
		</div>
								<span class="clear"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>

<Script>
function addbldg(id) {
		$('#subzone').val($('#suzone_'+id).val());
		$('#propstoery').val($('#propstoery_'+id).val());
		$('#proptype').val($('#proptype_'+id).val());
		$('#artype').val($('#artype_'+id).val());
		$('#arlvl').val($('#arlvl_'+id).val());
		$('#arcate').val($('#arcate_'+id).val());
		$('#aruse').val($('#aruse_'+id).val());
		$('#value').val($('#value_'+id).val());
		$('#bldgcate').val($('#propcate_'+id).val());
		$('#bldgcate').val($('#category_'+id).val());
		$('#bldgzone').val($('#zone_'+id).val());
		$('#transtype').val($('#valtype_'+id).val());
		$('#bldg_id').val(id);
		$('#addBldgForm').modal();
}

function updatetablestatus(tableid, indexid){
	$( "select" ).attr( "disabled","" );
	var api = $('#'+tableid).DataTable();    
		$('#'+tableid+'_filter').remove();
    $('#'+tableid+'_info').remove();
    $('#'+tableid+'_paginate').remove();
    $('#'+tableid+'_length').remove();     

		var row = $('#'+indexid).val();
		//alert(row);
	$( api.row( row-1 ).nodes() ).css('background-color','#67DA83');
}

function updateBldg(){
	$( "select" ).removeAttr( "disabled" );
 
	$('#bldgform').validate(
		{rules: {
	            
	            value: {
	                required: true
	            }
	        },
	        messages: {
				value: "Enter your Value"
	        },
		submitHandler: function(form) {
			var noty_id = noty({
			layout : 'center',
			text: 'Do you want Add?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Update', click: function($noty) {
					var d=new Date();					
					var transdata = {};
			        	$('#bldgform').serializeArray().map(function(x){transdata[x.name] = x.value;});
			            //console.log(transdata);
			            var transjson = JSON.stringify(transdata);
			            //$('#jsondata').val(transjson);
			            console.log(transjson);
			            
			            $.ajax({
			  				type: 'GET', 
						    url:'tonebldgtrn',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{jsondata:transjson},
					        success:function(data){
					        	
						        	var noty_id = noty({
										layout : 'top',
										text: 'Value Added',
										modal : true,
										type : 'success', 
									});	
									     		$noty.close();	
					        	//$("#finish").attr("disabled", true);
					        	//clearTableError(4);
					        	updatetablestatus("bldgtable", "bldg_id");
				        	},
					        error:function(data){
								//$('#loader').css('display','none');	
					        	$('#finishloader').html('');     	
					        		var noty_id = noty({
									layout : 'top',
									text: 'Problem while approve property!',
									modal : true,
									type : 'error', 
								});
				        	}
				    	});
			            //window.location.assign('tonebldgtrn?jsondata='+transjson)
			            //$('#tenantform').submit();				
					
				
					//noty({force: true, text: 'You clicked "Ok" button', type: 'success',layout : 'center',modal : true,});
				  }
				},
				{type: 'button green', text: 'Cancel', click: function($noty) {
					$noty.close();
					//noty({force: true, text: 'You clicked "Cancel" button', type: 'error',layout : 'center',modal : true,});
				  }
				}
				],
			type : 'success', 
		});
		}
	 });
}

function editDep(id){
	$('#bldgcond').val($('#bldgcond_'+id).val());
		$('#dep_id').val(id);

	$('#addDepreciation').modal();
}

function addDep(){
	$( "select" ).removeAttr( "disabled" );
		$('#debform').validate({
	        rules: {
	            value: {
	                required: true
	            }
	        },
	        messages: {
				firstname: "Enter the value"
	        },
	        submitHandler: function(form) {
	        	
	        		msg ="Do you want Add?";
	        	
	        	var noty_id = noty({
			layout : 'center',
			text: msg,
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Update', click: function($noty) {
		  
					var d=new Date();
	        	

				
					
					var transdata = {};
			        	$('#debform').serializeArray().map(function(x){transdata[x.name] = x.value;});

			            //console.log(transdata);
			            var transjson = JSON.stringify(transdata);
			            //$('#jsondata').val(transjson);
			            //console.log(tenantjson);
			          //  window.location.assign('tonedepreciationtrn?jsondata='+transjson)
			            //$('#tenantform').submit();
						$.ajax({
			  				type: 'GET', 
						    url:'tonedepreciationtrn',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{jsondata:transjson},
					        success:function(data){
					        	
						        	var noty_id = noty({
										layout : 'top',
										text: 'Value Added',
										modal : true,
										type : 'success', 
									});	
									     		$noty.close();	
					        	//$("#finish").attr("disabled", true);
					        	//clearTableError(4);
													updatetablestatus("deptable", "dep_id");
				        	},
					        error:function(data){
								//$('#loader').css('display','none');	
					        	$('#finishloader').html('');     	
					        		var noty_id = noty({
									layout : 'top',
									text: 'Problem while Add!',
									modal : true,
									type : 'error', 
								});
				        	}
				    	});
					
					$noty.close();
					//noty({force: true, text: 'You clicked "Ok" button', type: 'success',layout : 'center',modal : true,});
				  }
				},
				{type: 'button green', text: 'Cancel', click: function($noty) {
					$noty.close();
					//noty({force: true, text: 'You clicked "Cancel" button', type: 'error',layout : 'center',modal : true,});
				  }
				}
				],
			type : 'success', 
		});
	        }
	    });
	}
function addLand(id){
		$('#lsubzone').val($('#lsuzone_'+id).val());
		$('#lpropstoery').val($('#lpropstoery_'+id).val());
		$('#lproptype').val($('#lproptype_'+id).val());
		$('#lhasbldg').val($('#lhasbldg_'+id).val());
		$('#land_id').val(id);
		$('#addlotform').modal();
}

function updateLand(){
	$( "select" ).removeAttr( "disabled" );
		$('#lotform').validate({
	        rules: {
	            value: {
	                required: true
	            }
	        },
	        messages: {
				firstname: "Enter your value"
	        },
	        submitHandler: function(form) {
	        	
	        		msg ="Do you want Add?";
	        	
	        	var noty_id = noty({
			layout : 'center',
			text: msg,
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Update', click: function($noty) {
		  
					var d=new Date();
	        	

				
					
					var transdata = {};
			        	$('#lotform').serializeArray().map(function(x){transdata[x.name] = x.value;});

			            //console.log(transdata);
			            var transjson = JSON.stringify(transdata);
			            //$('#jsondata').val(transjson);
			            //console.log(tenantjson);
			          //  window.location.assign('tonelandtrn?jsondata='+transjson)
			            //$('#tenantform').submit();
					$.ajax({
			  				type: 'GET', 
						    url:'tonelandtrn',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{jsondata:transjson},
					        success:function(data){
					        	
						        	var noty_id = noty({
										layout : 'top',
										text: 'Value Added!',
										modal : true,
										type : 'success', 
									});	
									     		$noty.close();	
					        	//$("#finish").attr("disabled", true);
					        	//clearTableError(4);
													updatetablestatus("landtable", "land_id");
				        	},
					        error:function(data){
								//$('#loader').css('display','none');	
					        	$('#finishloader').html('');     	
					        		var noty_id = noty({
									layout : 'top',
									text: 'Problem while Add!',
									modal : true,
									type : 'error', 
								});
				        	}
				    	});
					
					$noty.close();
					//noty({force: true, text: 'You clicked "Ok" button', type: 'success',layout : 'center',modal : true,});
				  }
				},
				{type: 'button green', text: 'Cancel', click: function($noty) {
					$noty.close();
					//noty({force: true, text: 'You clicked "Cancel" button', type: 'error',layout : 'center',modal : true,});
				  }
				}
				],
			type : 'success', 
		});
	        }
	    });
	}


	function addLandSd(id){
		$('#lssubzone').val($('#lssubzone_'+id).val());
		$('#lsproptype').val($('#lsproptype_'+id).val());
		$('#lspropstoery').val($('#lspropstoery_'+id).val());
		$('#landstd_id').val(id);
		$('#landstandard-section').modal();
	}

	function updateLandSd(){
	$( "select" ).removeAttr( "disabled" );
		$('#landstatardform').validate({
	        rules: {
	            standardarea: {
	                required: true
	            },nextarea: {
	                required: true
	            },maxarea: {
	                required: true
	            }
	        },
	        messages: {
				firstname: "Enter your firstname"
	        },
	        submitHandler: function(form) {
	        	
	        		msg ="Do you want Add?";
	        	
	        	var noty_id = noty({
			layout : 'center',
			text: msg,
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Update', click: function($noty) {
		  
					var d=new Date();
	        	

				
					
					var transdata = {};
			        	$('#landstatardform').serializeArray().map(function(x){transdata[x.name] = x.value;});

			            //console.log(transdata);
			            var transjson = JSON.stringify(transdata);
			            //$('#jsondata').val(transjson);
			            //console.log(tenantjson);
			           // window.location.assign('tonelandstandarttrn?jsondata='+transjson)
			            //$('#tenantform').submit();
					$.ajax({
			  				type: 'GET', 
						    url:'tonelandstandarttrn',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{jsondata:transjson},
					        success:function(data){
					        	
						        	var noty_id = noty({
										layout : 'top',
										text: 'Value Added!',
										modal : true,
										type : 'success', 
									});	
									     		$noty.close();	
					        	//$("#finish").attr("disabled", true);
					        	//clearTableError(4);
													updatetablestatus("landstd", "landstd_id");
				        	},
					        error:function(data){
								//$('#loader').css('display','none');	
					        	$('#finishloader').html('');     	
					        		var noty_id = noty({
									layout : 'top',
									text: 'Problem while Add!',
									modal : true,
									type : 'error', 
								});
				        	}
				    	});
					
					$noty.close();
					//noty({force: true, text: 'You clicked "Ok" button', type: 'success',layout : 'center',modal : true,});
				  }
				},
				{type: 'button green', text: 'Cancel', click: function($noty) {
					$noty.close();
					//noty({force: true, text: 'You clicked "Cancel" button', type: 'error',layout : 'center',modal : true,});
				  }
				}
				],
			type : 'success', 
		});
	        }
	    });
	}

	function editTax(id){
		$('#tzone').val($('#tzone_'+id).val());
		$('#thasbldg').val($('#thasbldg_'+id).val());
		$('#tproptype').val($('#tproptype_'+id).val());
		$('#tax_id').val(id);
		$('#taxsection').modal();
		
	}


	function addTax(){
	$( "select" ).removeAttr( "disabled" );
		$('#taxform').validate({
	        rules: {
	            value: {
	            	required: true
	            }
	        },
	        messages: {
				firstname: "Enter your firstname"
	        },
	        submitHandler: function(form) {
	        	
	        		msg ="Do you want Add?";
	        	
	        	var noty_id = noty({
			layout : 'center',
			text: msg,
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Update', click: function($noty) {
		  
					var d=new Date();        	

				
					
					var transdata = {};
			        	$('#taxform').serializeArray().map(function(x){transdata[x.name] = x.value;});

			            //console.log(transdata);
			            var transjson = JSON.stringify(transdata);
			            //$('#jsondata').val(transjson);
			            //console.log(tenantjson);
			          //  window.location.assign('taxratetrn?jsondata='+transjson)
			            //$('#tenantform').submit();
				
					$.ajax({
			  				type: 'GET', 
						    url:'taxratetrn',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{jsondata:transjson},
					        success:function(data){
					        	
						        	var noty_id = noty({
										layout : 'top',
										text: 'Value Added!',
										modal : true,
										type : 'success', 
									});	
									     		$noty.close();	
					        	//$("#finish").attr("disabled", true);
					        	//clearTableError(4);
								updatetablestatus("taxtable", "tax_id");
				        	},
					        error:function(data){
								//$('#loader').css('display','none');	
					        	$('#finishloader').html('');     	
					        		var noty_id = noty({
									layout : 'top',
									text: 'Problem while Add!',
									modal : true,
									type : 'error', 
								});
				        	}
				    	});
					
					$noty.close();
					//noty({force: true, text: 'You clicked "Ok" button', type: 'success',layout : 'center',modal : true,});
				  }
				},
				{type: 'button green', text: 'Cancel', click: function($noty) {
					$noty.close();
					//noty({force: true, text: 'You clicked "Cancel" button', type: 'error',layout : 'center',modal : true,});
				  }
				}
				],
			type : 'success', 
		});
	        }
	    });
	}

	function back(){
		window.location.assign('valterm');
	}

</Script>
</body>
</html>