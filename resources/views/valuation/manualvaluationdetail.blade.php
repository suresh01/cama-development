<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Valuation Details</title>
<style>
	.right-text {
		text-align:right;
	}
	.tbl-total {
		text-align:right;
		float: inline-end;
	}
</style>
@include('includes.header', ['page' => 'VP'])
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">

				<div id="breadCrumb3" class="breadCrumb grid_12">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Valuation Process</a></li>
						<li><a href="valbasket?id={{$termid}}&ts=1">{{$viewparamterm}} </a></li>
						<li><a href="property?id={{$pb}}&ts=1">{{$viewparambasket}} - {{$viewparambasketstatus}}</a></li>
						<li>{{$accountnumber}} </li>
					</ul>
				</div>
				<br>

				<div class="widget_wrap">
					<div class="widget_top">
						<h6>Valuation</h6>
					</div>
					<div class="widget_content">
						<div class=" page_content">
							<div class="invoice_container">	
								@foreach ($master as $rec)
								<fieldset>
									<div class="grid_4">		


										<div style="line-height: 2;">	
											<strong><span>Zone : </span></strong>
											<span>{{$rec->zone}}</span>	
										</div>
										<div style="line-height: 2;">		
											<strong><span>Sub Zone : </span></strong>
											<span>{{$rec->subzone}}</span>
										</div>
									</div>
									<div class="grid_4">		

										<div style="line-height: 2;">
											<strong><span>Property Category : </span></strong>
											<span>{{$rec->propcategorty}}</span>
										</div>
										<div style="line-height: 2;">
											<strong><span>Property Type : </span></strong>
											<span>{{$rec->proptype}}</span>
										</div>
										<div style="line-height: 2;">
											<strong><span>Property Status : </span></strong>
											<span>{{$rec->bldgstatus}}</span>
										</div>
										<div style="line-height: 2;">
											<strong><span>Property Storey : </span></strong>
											<span>{{$rec->bldgstorey}}</span>
										</div>
									</div>
								</fieldset>
								@endforeach

								<span class="clear"></span>
								<div class="grid_12 invoice_details">
									<div style="float:right;margin-right: 30px;"  class="btn_24_blue">
										<a href="#" onclick="addLand()">Add Land</a>	
									</div>
									<br>
									<div class="widget_wrap collapsible_widget">
										<div class="widget_top active">
											<span class="h_icon"></span>
											<h6>Land Calculation</h6>
										</div>
										<div class="widget_content">
											<div class="invoice_tbl">
												<table id="landtable">
												<thead>
												<tr class=" gray_sai">
													<th style="width: 40px;">
														S No
													</th>
													<th>
														Lot Code / Lot No
													</th>
													<th>
														Land Area
													</th>
													<th>
														Net Value
													</th>
													<th>
														Round Value
													</th>													
													<th style="display: none;">
														Lot id
													</th>
												</tr>
												</thead>
												<tbody>
													@php($totalland1 = 0)
													@php($totalbldg = 0)
													@foreach ($lot as $rec)
													<td>
														{{$loop->iteration}}
													</td>
													<td>
														<a href="#" onclick="addTanah('{{$rec->vl_id}}','{{$loop->iteration}}')">{{$rec->lotnumber}}</a>
													</td>
													<td style="text-align:right;">
														{{$rec->vl_size}}
													</td>
													<td id="gross_{{$loop->iteration}}" style="text-align:right;">
														{{number_format($rec->vl_grosslandvalue,2)}}

													</td>
													<td id="netvalue_{{$loop->iteration}}" style="text-align:right;">
														{{number_format($rec->vl_roundnetlandvalue,2)}}
													</td>
													<td>
														{{$rec->vl_id}}
													</td>
													@php($totalland1 = $totalland1 + $rec->vl_roundnetlandvalue)
												</tr>
												@endforeach												
												<tr>
													<td colspan="4" class="grand_total">
														Total Land Value:
													</td>
													<td>
														<input type="text" readonly="true" onchange="taxCalculation()" style="float: right; "  value="{{number_format($totalland1,2)}}" class="tbl-total" id="landtotal">
													</td>
												</tr>
												</tbody>
												</table>
											</div>
										</div>
									</div>

									<div class="widget_wrap collapsible_widget">
										<div class="widget_top active">
											<span class="h_icon"></span>
											<h6>Building Calculation</h6>
										</div>
										<div class="widget_content">
											<div class="invoice_tbl">
												<table id="bldgtable">
												<thead>
												<tr class=" gray_sai">
													<th  style="width: 40px;">
														S No
													</th>
													<th>
														Building Category
													</th>
													<th>
														Building Type
													</th>
													<!--<th>
														Building Area
													</th>-->
													<th>
														Building Value
													</th>
													<th>
														Allowancess Value
													</th>
													<th>
														Depreciation Value
													</th>
													<th>
														Net Building Value
													</th>
													<th>
														Round Value 
													</th>
													<th style="display: none;">
														bldgid 
													</th>
												</tr>
												</thead>
												<tbody>
												@foreach ($bldg as $rec)
												<tr>
													<td>
														{{$loop->iteration}}
													</td>
													<td>
														<a href="#" onclick="addBldg('{{$rec->vb_id}}','{{$loop->iteration}}')">{{$rec->bldgcategory}} </a>
													</td>
													<td>
														{{$rec->bldgtype}} 
													</td>
													<!--<td>
														
													</td>-->
													<td  style="text-align:right;">
														{{number_format($rec->vb_grossfloorvalue,2)}}
													</td>
													<td style="text-align:right;">
														{{number_format($rec->vb_grossallowancevalue,2)}}
													</td>
													<td style="text-align:right;">
														{{number_format($rec->vb_depreciationvalue,2)}}
													</td>
													<td style="text-align:right;">
														{{number_format($rec->vb_netnt,2)}}
													</td>
													<td style="text-align:right;">
														{{number_format($rec->vb_roundnetnt,2)}} 
													</td>
													<td style="text-align:right;display: none;">
														{{$rec->vb_id}} 
													</td>
													@php($totalbldg = $totalbldg + $rec->vb_roundnetnt)
												</tr>												
												@endforeach
												<tr>
													<td colspan="7" class="grand_total">
														Total Building Net Value
													</td>
													<td>
														<input type="text" style="float: right; " readonly="true" value="{{number_format($totalbldg,2)}}" class="tbl-total" id="vd_bldgtotal">
													</td>
												</tr>
												</tbody>
												</table>
											</div>
										</div>
									</div>


									<div class="widget_wrap collapsible_widget">
										<div class="widget_top active">
											<span class="h_icon"></span>
											<h6>Additional Calculation</h6>
										</div>
										<div class="widget_content">
											<div class="invoice_tbl">
												<table id="additionaltable">
												<thead>
												<th style="width: 40px;">
														S No
													</th>
													<th style="width: 30%;">
														Description
													</th>
													<th>
														Area
													</th>
													<th>
														Rate
													</th>
													<th>
														Gross Value
													</th>
													<th>
														Round Value
													</th>
													<th style="width: 10%;">
														Action 
													</th>
													<th style="display: none;">
														actioncode 
													</th>
												</tr>
												</thead>
												<tbody>
													@php($totaladditonal = 0)
													@foreach ($additional as $rec)
													<td>
														{{$loop->iteration}}
													</td>
													<td>
														{{$rec->vad_desc}}
													</td>
													<td style="text-align:right;">
														{{$rec->vad_area}}
													</td>
													<td style="text-align:right;">
														{{number_format($rec->vad_rate,2)}}
													</td>
													<td style="text-align:right;">
														{{number_format($rec->vad_grossvalue,2)}}
													</td>
													<td style="text-align:right;">
														{{number_format($rec->vad_roundnetvalue,2)}}
													</td>
													<td>
														<span><a class="action-icons c-edit editaddrow"  href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons c-delete deleteaddrow " href="#" title="delete">Delete</a></span>
													</td>
													<td style="display: none;">noaction</td>
													@php($totaladditonal = $totaladditonal + $rec->vad_roundnetvalue)
												</tr>
												@endforeach	
																								
												
												
												</tbody>
												<tr>
													<td colspan="6" class="grand_total">
														@if($iseditable == 1)
														<button id="addadditional" onclick="openModal()" name="adduser" style="float: left; "  type="button" class=" basic-modal btn_small btn_blue "><span>Add Additional value</span></button>@endif							
														Total Additional Value:
													</td>
													<td>
														<input type="text" readonly="true"  style="float: right; "  value="{{number_format($totaladditonal,2)}}" class="tbl-total" id="additionaltotal">
													</td>
												</tr>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div  id="basic-modal-content">
									<h3>Additional Valuation</h3>
									<div  class="grid_12 form_container left_label">
										<ul>	
											<li class="li">
												<input type="hidden" id="index">
												<div class="form_grid_12">
													<div class="form_grid_6">									
														<label class="field_title" id="luserid" for="userid">Description<span class="req">*</span></label>
														<div class="form_input">
															<input id="add_description" required="true"  name="add_description" type="text"  value="" />
														</div>
														<span class=" label_intro"></span>
													</div>
												</div>
												<div class="form_grid_12">
													<div class="form_grid_6">									
														<label class="field_title" id="luserid" for="userid">Area<span class="req">*</span></label>
														<div class="form_input">
															<input id="add_area" required="true" onchange="additionalCal()"  name="add_area" type="text"  value="" />
														</div>
														<span class=" label_intro"></span>
													</div>
												</div>
												<div class="form_grid_12">
													<div class="form_grid_6">									
														<label class="field_title" id="luserid" for="userid">Rate<span class="req">*</span></label>
														<div class="form_input">
															<input id="add_rate" required="true" onchange="additionalCal()" name="add_rate" type="text"  value="" />
														</div>
														<span class=" label_intro"></span>
													</div>
												</div>
												<div class="form_grid_12">
													<div class="form_grid_6">									
														<label class="field_title" id="luserid" for="userid">Grass value<span class="req">*</span></label>
														<div class="form_input">
															<input id="add_grossvalue" readonly="true"  name="add_grossvalue" type="text"  value="" />
														</div>
														<span class=" label_intro"></span>
													</div>
												</div>
												<div class="form_grid_12">
													<div class="form_grid_6">									
														<label class="field_title" id="luserid" for="userid">Round Value<span class="req">*</span></label>
														<div class="form_input">
															<input id="add_roundvalue" readonly="true"  name="add_roundvalue" type="text"  value="" />
														</div>
														<span class=" label_intro"></span>
													</div>
												</div>
											</li>				
										</ul>	
									</div>
									<span class="clear"></span>
										<div class="btn_24_blue">
											<a href="#" id="add" onclick="addAdditional()" class=""><span>Add </span></a>
											<a href="#" id="edit" onclick="editAdditional()" class=""><span>Update </span></a>
										</div>
										<div class="btn_24_blue">
											<a href="#" class="simplemodal-close"><span>Close </span></a>
										</div>
									
								</div>
										
								
								
								<fieldset>
									<legend>Tax Calculation</legend>
									<form action="" id="taxvaluationform" class="form_container left_label">
									<div style="float: right;" class="grid_5 form_container left_label">
											<ul>
												<li>
													<div class="form_grid_4">
													<label class="field_title"   id="accnumberlbl" style="width: 100%;" for="username">Valuer Discretion<span class="req">*</span></label>
													</div>
												<div class="form_grid_8">
													<div  class="form_input">
														<input id="taxvaluerdiscretion" class="right-text " tabindex="1" style="width: 100%;" name="taxvaluerdiscretion" value="" onchange="taxCalculation()" type="text" maxlength="100" >
													</div>
													<span class=" label_intro"></span>
												</div>
												
												<div class="form_grid_4">
													<label class="field_title"  id="accnumberlbl" style="width: 100%;" for="username">Gross NT<span class="req">*</span></label>
												</div>
												<div class="form_grid_8">
													<div  class="form_input">
														<input id="taxgrossnt" tabindex="1" value=""  readonly="true" style="width: 100%;" name="taxgrossnt" type="text" maxlength="100" class="right-text " >
													</div>
													<span class=" label_intro"></span>
												</div>
										
												<div class="form_grid_4">
													<label class="field_title" id="accnumberlbl" style="width: 100%;" id="lposition" for="position">Proposed NT<span class="req">*</span></label>
												</div>
												<div class="form_grid_8">
													<div  classs="form_input" style="width: 70%;  margin-left: 30%;  position: relative;">
														<input id="taxproposednt" style=""  readonly="true" value="" tabindex="2" name="taxproposednt"  type="text"  maxlength="50" class="right-text "/>
													</div>
													<span class=" label_intro"></span>
												</div>
											
												<div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lposition" for="position">Proposed Rate<span class="req">*</span></label>
												</div>
												<div class="form_grid_8">
													<div  class="form_input">
														<input id="taxproposedrate" style="width: 100%;"  value="" tabindex="2"name="taxproposedrate"  onchange="taxCalculation()" type="text"  maxlength="50" class="right-text "/>
													</div>
													<span class=" label_intro"></span>
												</div>
										 	
												<div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lposition" for="position">Calculated Rate (%)<span class="req">*</span></label>
												</div>
												<div class="form_grid_8">
													<div  class="form_input">
														<input id="taxcalculaterate" style="width: 100%;" value="" tabindex="2" name="taxcalculaterate"  type="text" onchange="taxCalculation()"  maxlength="50" class="right-text "/>
													</div>
													<span class=" label_intro"></span>
												</div>
											
												<div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lposition" for="position">Proposed Tax<span class="req">*</span></label>
												</div>
												<div class="form_grid_8">
													<div  class="form_input">
														<input id="taxproposedtax"
														value=""  tabindex="2" name="taxproposedtax"  readonly="true" type="text"  maxlength="50" class="right-text "/>
													</div>
													<span class=" label_intro"></span>
												</div>


												
												</li>
											</ul>
									</div>
									<div class="grid_5 form_container left_label">
										<ul>
											<li>													
												<br /><br /><br /><br /><br />
												<div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lposition" for="position">Approved NT<span class="req">*</span></label>
												</div>
												<div class="form_grid_8">
													<div  class="form_input">
														<input id="taxapprovednt" class="right-text allow_only_numbers" style="width: 100%;"  onchange="taxApprovedCalculation()"  tabindex="2" name="taxapprovednt"  type="text" value="" maxlength="50" class=""/>
													</div>
													<span class=" label_intro"></span>
												</div>
											
												<div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lposition" for="position">Approved Rate<span class="req">*</span></label>
												</div>
												<div class="form_grid_8">
													<div  class="form_input">
														<input id="taxapprovedrate" class="right-text " style="width: 100%;"  tabindex="2" name="taxapprovedrate"  type="text"value=""  readonly="true"  maxlength="50" class=""/>
													</div>
													<span class=" label_intro"></span>
												</div>
										 		
												<div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lposition" for="position">Adjustment<span class="req">*</span></label>
												</div>
												<div class="form_grid_8">
													<div  class="form_input">
														<input id="taxadjustment" class="right-text " style="width: 100%;" tabindex="2" name="taxadjustment" value="" onchange="taxApprovedCalculation()"  type="text"  maxlength="50" class=""/>
													</div>
													<span class=" label_intro"></span>
												</div>
											
												<div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lposition" for="position">Approved Tax<span class="req">*</span></label>
												</div>
												<div class="form_grid_8">
													<div  class="form_input">
														<input id="taxapprovedtax" value=""  readonly="true" tabindex="2" name="taxapprovedtax"  type="text"  maxlength="50" class="right-text " />
													</div>
													<span class=" label_intro"></span>
												</div>
												
												</li>
											</ul>
									</div>

									<div class="grid_12 form_container left_label">
										<ul>
											<li>													
												<br /><br /><br /><br /><br />
												<div class="form_grid_2">
													<label class="field_title" style="width: 100%;" id="lposition" for="position">NOTES<span class="req">*</span></label>
												</div>
												<div class="form_grid_9">
													<div style="margin-left: 0px"  class="form_input"> 
													<textarea rows="4" id="taxnotes" name="taxnotes" cols="50"></textarea>
													<span class=" label_intro"></span>
												</div>
												</div>
												</li>
											</ul>
									</div>
									<div style="height: 48px; float: right; " class="grid_12">                
					                  <div class="form_input">
					                  	@if($iseditable == 1)
					                    <button id="addsubmit" name="adduser" style="float: right; "  onclick="updateValuation()" type="button" class="btn_small btn_blue"><span>Update</span></button>      
					                       @endif      
					                    <button id="close" name="close" type="button" onclick="closePage()"  class="btn_small btn_blue"><span>Close</span></button>
					                    <span class=" label_intro"></span>
					                  </div>
					                  
					                  <span class="clear"></span>
					                </div>
					            </form>
								</fieldset>
								
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
<div style="display: none;">
	<table id="hiddenlandarea" class="display ">
		<thead style="text-align: left;">
				<tr>
                  <th>
                    Area Name
                  </th>
                  <th>
                    Area
                  </th>
                  <th>
                    Rate(smp)
                  </th>
                  <th>
                    Calculated Rate(%)
                  </th>
                  <th>
                    Gross Value
                  </th>
                  <th>
                    lot area id
                  </th>
                  <th>
                    lot id
                  </th>
			</tr>
		</thead>
		<tbody>
			@foreach ($lotarea as $rec)
			 	<tr>
					<td>
					{{$rec->vla_desc}}
					</td>
					<td style="text-align:right;">
					{{$rec->vla_area}}
					</td>
					<td >
					{{$rec->vla_landrate}}
					</td>
					<td >
					{{$rec->vla_discountrate}}                           
					</td>
					<td style="text-align:right;">
					{{number_format($rec->vla_grossareavalue,2)}}                               
					</td>   
					<td style="text-align:right;">
					{{$rec->vla_id}}                                  
					</td> 
					<td style="text-align:right;">
					{{$rec->vla_vt_id}}                                  
					</td>   
    			</tr>
			@endforeach						
		</tbody>
	</table>	


	<table id="hiddenbldgarea" class="display ">
        <thead>
            <tr class=" gray_sai">
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
				AREA USED
				</th>
				<th>
				AREA
				</th>
				<th>
				AREA RATE
				</th>
				<th>
				GROSS AREA VALUE
				</th>
				<th>
				BLDGAREA ID
				</th>
				<th>
				BLDG ID
				</th>
            </tr>
        </thead>
        <tbody>
			@foreach ($bldgar as $rec)
	            <tr>
					<td>
					{{$rec->artype}}
					</td>
					<td>
					{{$rec->arlvel}}
					</td>
					<td>
					{{$rec->arcate}}
					</td>
					<td >
					{{$rec->aruse}}
					</td>
					<td style="text-align:right;">
					{{$rec->vba_totsize}}
					</td>
					<td style="text-align:right;">
					{{$rec->vba_bldgrate}}
					</td>
					<td style="text-align:right;">
					{{$rec->vba_netareavalue}}
					</td>
					<td style="text-align:right;">
					{{$rec->vba_id}}
					</td>
					<td style="text-align:right;">
					{{$rec->vb_id}}
					</td>
	            </tr>
            
            @endforeach
                                        
        </tbody>
    </table>
	    @foreach($bldg as $rec)
			
			<input type="text" value="{{number_format($rec->vb_depreciationrate,2)}}" style="text-align:right;"  id="deprate_{{$rec->vb_id}}">
		<input type="text" value="{{number_format($rec->vb_depreciationvalue,2)}}" style="text-align:right;" id="depvalue_{{$rec->vb_id}}">

		 <input type="text" value="{{number_format($rec->vb_netnt,2)}}"   style="text-align:right;" id="netbldg_{{$rec->vb_id}}">
		 <input type="text" value="{{number_format($rec->vb_roundnetnt,2)}}"  style="text-align:right;" id="roundbldg_{{$rec->vb_id}}">

		@endforeach  

    <table id="hiddenbldgallowance" class="display ">
        <thead>
            <tr class=" gray_sai">
				<th>
				S No
				</th>
				<th>
				Description (Allwoance Cateory ,  Allowance Type)
				</th>
				<th>
				Calculation Method
				</th>
				<th>
				Percentage / Value
				</th>
				<th>
				Gross Allowance
				</th>
				<th>
				BLDGALLOWANCE ID
				</th>
				<th>
				BLDG ID
				</th>
            </tr>
        </thead>
        <tbody>
         	@foreach ($allowance as $rec)
	        <tr>
		          <td>
		            {{$loop->iteration}}
		          </td>
		          <td>
		            {{$rec->allowancecategory}} , {{$rec->allowancetype}}
		          </td>
		          <td>
		            {{$rec->allowancemethod}}
		          </td>
		          <td style="text-align:right;">
		            {{$rec->vbal_drivevalue}}
		          </td>
		          <td style="text-align:right;">
		            {{$rec->vbal_roundgrossallowancevalue}}
		          </td>
		          <td style="text-align:right;">
		            {{$rec->vbal_id}}
		          </td>
		          <td style="text-align:right;">
		            {{$rec->vb_id}}
		          </td>
	        </tr>
         	
        	@endforeach
	       
        
        </tbody>
    </table>
</div>
<script>
	var w;
	let tempmap = new Map([["0","sno"],["1", "add_description"],["2", "add_area"],["3", "add_rate"],["4", "add_grossvalue"],["5", "add_roundvalue"]]);

	function addLand(){
		var w = window.open('about:blank','Popup_Window','toolbar=0,resizable=0,location=no,statusbar=0,menubar=0,width=1000,height=500,left = 312,top = 50');
	    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
	       // w.location = "landval?id="+id;
	      // w.location.pathname = 'valuation/popup/land.blade.php';
	       w.location.assign("manualland");
	    }
	}


	function addTanah(id,i) {
	    w = window.open('about:blank','Popup_Window','toolbar=0,resizable=0,location=no,statusbar=0,menubar=0,width=0,height=0,left = 312,top = 234');
	    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
	       // w.location = "landval?id="+id;
	      // w.location.pathname = 'valuation/popup/land.blade.php';
	       w.location.assign("landval?id="+id+"&auto="+(i-1));
	    }	    
	    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
		{
			w.moveTo(0,0);
			w.resizeTo(screen.availWidth, screen.availHeight);

		}
		//w.document.write($("#landpagecontent").html());
		/*var win = window.open('','printwindow'); resizable=0,
		win.document.write('<html><head><title>Print it!</title><link rel="stylesheet" type="text/css" href="styles.css"></head><body>');
		win.document.write($("#content").html());
		win.document.write('</body></html>');*/
		//win.print();
		//win.close();
	}

	function closePage(){
		//alert();
		window.location.assign('property?id={{$pb}}');	
	}

	function loadPopupElements() {
	    var prefElements = document.getElementById("landdetail");
	    var childDoc = w.document;
	    childDoc.body.innerHTML = prefElements.innerHTML;
	}

	function taxDriveCalculation(){
		taxCalculation();   	
	}


	function taxCalculation(){
    	var landtotal = removeCommas($('#landtotal').val());
    	var bldgtotal = removeCommas($('#vd_bldgtotal').val());
    	var additionaltotal = removeCommas($('#additionaltotal').val());
    	var taxvaluerdiscretion = removeCommas($('#taxvaluerdiscretion').val());
    	var taxproposedrate = removeCommas($('#taxproposedrate').val());
    	var taxcalculaterate = removeCommas($('#taxcalculaterate').val());
    	var taxapprovednt = removeCommas($('#taxapprovednt').val());
    	var taxadjustment = removeCommas($('#taxadjustment').val());
    	var grossnt = Number(landtotal) + Number(bldgtotal) + Number(additionaltotal) + Number(taxvaluerdiscretion);
    	//var grossnt = Number(landtotal) + Number(additionaltotal) + Number(taxvaluerdiscretion);
    	//alert(bldgtotal);
    	//console.log(grossnt);
    	var propsednt = customround(grossnt,3);// Math.floor(grossnt/1000)*1000;
    	var propsedtax = propsednt * (Number(taxproposedrate) / 100) * ( Number(taxcalculaterate) / 100 );
    	var approvedtax = Number(taxapprovednt) * (Number(taxproposedrate) / 100) * ( Number(taxcalculaterate) / 100 ) + Number(taxadjustment);

    	$('#taxgrossnt').val(formatMoneyHas(grossnt));
    	$('#taxproposednt').val(formatMoneyHas(propsednt));
    	$('#taxapprovednt').val(formatMoneyHas(propsednt));
    	$('#taxproposedtax').val(formatMoneyHas(propsedtax));
    	$('#taxapprovedtax').val(formatMoneyHas(approvedtax));
    	$('#taxapprovedrate').val(taxproposedrate);
    	taxApprovedCalculation();
    }


	/*function taxCalculation(){
    	var landtotal = removeCommas($('#landtotal').val());
    	var bldgtotal = removeCommas($('#vd_bldgtotal').val());
    	var additionaltotal = removeCommas($('#additionaltotal').val());
    	var taxvaluerdiscretion = removeCommas($('#taxvaluerdiscretion').val());
    	var taxproposedrate = removeCommas($('#taxproposedrate').val());
    	var taxcalculaterate = removeCommas($('#taxcalculaterate').val());
    	var taxapprovednt = removeCommas($('#taxapprovednt').val());
    	var taxadjustment = removeCommas($('#taxadjustment').val());
    	var taxdrivevalue = removeCommas($('#taxdrivevalue').val());
    	//var grossnt = Number(landtotal) + Number(bldgtotal) + Number(additionaltotal) + Number(taxvaluerdiscretion);
    	//var grossnt = Number(landtotal) + Number(additionaltotal) + Number(taxvaluerdiscretion);
    	//console.log(grossnt);
    	//taxDriveCalculation();
    	var propsednt = Math.floor(taxdrivevalue/1000)*1000;
    	var propsedtax = propsednt * (Number(taxproposedrate) / 100) * ( Number(taxcalculaterate) / 100 );
    	var approvedtax = Number(taxapprovednt) * (Number(taxproposedrate) / 100) * ( Number(taxcalculaterate) / 100 ) + Number(taxadjustment);

    	$('#taxgrossnt').val(formatMoneyHas(taxdrivevalue));
    	$('#taxproposednt').val(formatMoneyHas(propsednt));
    	$('#taxapprovednt').val(formatMoneyHas(propsednt));
    	$('#taxproposedtax').val(formatMoneyHas(propsedtax));
    	$('#taxapprovedtax').val(formatMoneyHas(approvedtax));
    	$('#taxapprovedrate').val(taxproposedrate);
    	taxApprovedCalculation();
    }*/

    function taxApprovedCalculation(){
    	
    	var taxapprovednt = removeCommas($('#taxapprovednt').val());
    	var taxapprovedrate = removeCommas($('#taxapprovedrate').val());
    	var taxadjustment = removeCommas($('#taxadjustment').val());
    	var taxcalculaterate = removeCommas($('#taxcalculaterate').val());
    	
    	var approvedtax = Number(taxapprovednt) * (Number(taxapprovedrate) / 100) * ( Number(taxcalculaterate) / 100 ) + Number(taxadjustment);

    	$('#taxapprovedtax').val(formatMoneyHas(approvedtax));
    }

	function addBldg(id) {		
	    var w = window.open('about:blank','Popup_Window','toolbar=0,location=no,statusbar=0,menubar=0,width=0,height=0,left = 312,top = 234');
	    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
	        w.location = "bldgval?id="+id;
	    }	    
	    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
		{
			w.moveTo(0,0);
			w.resizeTo(screen.availWidth, screen.availHeight);
		}
	}

	@foreach ($tax as $rec)
		formatMoney('taxvaluerdiscretion','{{$rec -> vt_valuedescretion}}');
		formatMoney('taxapprovednt','{{$rec -> vt_approvednt}}');
		formatMoney('taxapprovedrate','{{$rec -> vt_approvedrate}}');
		formatMoney('taxadjustment','{{$rec -> vt_adjustment}}');
		formatMoney('taxapprovedtax','{{$rec -> vt_approvedtax}}');
		formatMoney('taxgrossnt','{{$rec -> vt_grossvalue}}');
		formatMoney('taxproposedrate','{{$rec -> vt_proposedrate}}');
		formatMoney('taxproposednt','{{$rec -> vt_proposednt}}');
		formatMoney('taxcalculaterate','{{$rec -> vt_calculatedrate}}');
		formatMoney('taxproposedtax','{{$rec -> vt_proposedtax}}');
		formatMoney('taxdrivevalue','{{$rec -> vt_derivedvalue}}');
		formatMoney('taxdriverate','{{$rec -> vt_derivedrate}}');

		

		//$('#taxnotes').val('{{$rec -> vt_note}}');
	@endforeach


	function formatMoney(field, n, c, d, t) {
		var c = isNaN(c = Math.abs(c)) ? 2 : c,
			d = d == undefined ? "." : d,
			t = t == undefined ? "," : t,
			s = n < 0 ? "-" : "",
			i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
			j = (j = i.length) > 3 ? j % 3 : 0;

		$('#'+field).val(s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : ""));
		//return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	};

	function formatMoneyHas(n, c, d, t) {
		var c = isNaN(c = Math.abs(c)) ? 2 : c,
			d = d == undefined ? "." : d,
			t = t == undefined ? "," : t,
			s = n < 0 ? "-" : "",
			i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
			j = (j = i.length) > 3 ? j % 3 : 0;

		//$('#'+field).val(s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : ""));
		return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	};

	function CallParent(grossvalue, rowid){
		//console.log(grossvalue+","+rowid);
		var table = $('#landtable').DataTable();
  		var row = table.row(rowid);

      	var data = row.data();
		//console.log(data);
          data[3]=grossvalue;
          data[7]=grossvalue;

		grossvalue = formatMoneyHas(grossvalue);
		$('#gross_'+rowid).html(grossvalue);
		$('#netvalue_'+rowid).html(grossvalue);
     
        $('#landdetail_filter').remove();
        $('#landdetail_info').remove();
        $('#landdetail_paginate').remove();
        $('#landdetail_length').remove();

        var grossland = 0;
        for (var j= 0;j<$('#landtable').DataTable().rows().count();j++){
          var ldata = $('#landtable').DataTable().row(j).data();
          
         	 $.each(ldata, function( key, value ) {
	           	if(key === 7 ){
	             	grossland = grossland + Number(value);
	          	}      

            }); 

        }
        formatMoney('landtotal',grossland);
	}

	

	$(document).ready(function(){

	    $('#additionaltable').DataTable({
            "columns":[ null, null, null, null, null, null, null, { "visible": false }],
            "sPaginationType": "full_numbers",
			"iDisplayLength": 5,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			 
		});

		$("div.table_top select").addClass('tbl_length');
		$(".tbl_length").chosen({
			disable_search_threshold: 4	
		});

		
	    var addtbl = $('#additionaltable').DataTable();
	    $('#additionaltable tbody').on('click', '.editaddrow', function () {
			//var editlotdata = JSON.stringify(table.row( $(this).parents('tr') ).data());
			//alert();
			$('#index').val(addtbl.row( $(this).parents('tr') ).index());
			
			var ldata = addtbl.row( addtbl.row( $(this).parents('tr') ).index()).data();
			
			var tdata = {};
			
			$.each( ldata, function( key, value ) {
				tdata[tempmap.get(""+key+"")] = value;              
            });

            $.each( tdata, function( key, val ) {
            	$('#'+key).val(val);
			});
			console.log($('#add_area').val());
			$('#edit').show();
			$('#add').hide();
            $('#basic-modal-content').modal();
			
		});

		$('#additionaltable tbody').on( 'click', '.deleteaddrow', function () {

			var row = addtbl.row(addtbl.row( $(this).parents('tr') ).index()),
			    data = row.data();
			    data[0]='Deleted';
				data[6]='';
				data[7]='delete';
				var noty_id = noty({
					layout : 'center',
					text: 'Are you want to delete?',
					modal : true,
					buttons: [
						{type: 'button pink', text: 'Delete', click: function($noty) {
					  			row.data(data);
					  			totalAdditionalCal();
								$noty.close();
						  	}
						},
						{type: 'button blue', text: 'Cancel', click: function($noty) {
								$noty.close();
						  	}
						}
						],
					type : 'success', 
			 	});
			
		   // table.row($(this).parents('tr') ).remove().draw();
		});

		$('#additionaltable_filter').remove();
	    $('#additionaltable_info').remove();
	    $('#additionaltable_paginate').remove();
	    $('#additionaltable_length').remove();

		$('#hiddenlandarea').DataTable({
            "sPaginationType": "full_numbers",
			"iDisplayLength": 100,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			 
		});
		$("div.table_top select").addClass('tbl_length');
		$(".tbl_length").chosen({
			disable_search_threshold: 4	
		});


		


	    $('#hiddenbldgarea').DataTable({
            "sPaginationType": "full_numbers",
			"iDisplayLength": 5,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			 
		});
		$("div.table_top select").addClass('tbl_length');
		$(".tbl_length").chosen({
			disable_search_threshold: 4	
		});

		//console.log($('#hiddenbldgarea').DataTable().rows().count());
		$('#hiddenbldgallowance').DataTable({
            "sPaginationType": "full_numbers",
			"iDisplayLength": 5,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			 
		});
		$("div.table_top select").addClass('tbl_length');
		$(".tbl_length").chosen({
			disable_search_threshold: 4	
		});


		 $('#landtable').DataTable({
            "columns":[ null, null, null, null, null,{ "visible": false }],
            "sPaginationType": "full_numbers",
			"iDisplayLength": 5,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			 
		});
		$("div.table_top select").addClass('tbl_length');
		$(".tbl_length").chosen({
			disable_search_threshold: 4	
		});

		$('#landtable_filter').remove();
	    $('#landtable_info').remove();
	    $('#landtable_paginate').remove();
	    $('#landtable_length').remove();

	    
    	
	});

	function openModal(){
			$('#edit').hide();
			$('#add').show();
		$('#basic-modal-content').modal();
	}

	function editAdditional(){
		var description = $('#add_description').val();
		var area = $('#add_area').val();
		var rate = $('#add_rate').val();
	
		
			var table = $('#additionaltable').DataTable();
			
			var row = table.row($('#index').val());
			var lotdata = table.row($('#index').val()).data();
			var recordtype = lotdata[0];
			var operation = "Updated";
			var operation_code = "update";
			if (recordtype==='New'){
				operation = "New";
				operation_code = "new";
			}
	    data=[operation,$('#add_description').val(), $('#add_area').val(), $('#add_rate').val(), $('#add_grossvalue').val(), $('#add_roundvalue').val(),'<span><a onclick="" class="action-icons c-edit editaddrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons c-delete deleteaddrow " href="#" title="delete">Delete</a></span>',operation_code ];



		row.data(data);
			
	totalAdditionalCal();
	$('#basic-modal-content').modal('toggle');
}

	function additionalCal(){
		var area = $('#add_area').val();
		var rate = $('#add_rate').val();
		var result = Number(area) * Number(rate);
		//console.log(result);
		$('#add_grossvalue').val(formatMoneyHas(result));
		$('#add_roundvalue').val(formatMoneyHas(customround(result,3)));
	}

	function addAdditional(){
		var description = $('#add_description').val();
		var area = $('#add_area').val();
		var rate = $('#add_rate').val();

		if (description === '') {
	        alert('Please enter description');
	        return false;
	    } else if (area === '') {
	        alert('Please enter area');
	        return false;
	    } else if (rate === '') {
	        alert('Please enter rate');
	        return false;
	    } else {
	    	var t = $('#additionaltable').DataTable({"columns":[ null, null, null, null, null, null, null, { "visible": false }]});
			$('#additionaltable_filter').remove();
		    $('#additionaltable_info').remove();
		    $('#additionaltable_paginate').remove();
		    $('#additionaltable_length').remove();
			t.row.add([ 'New',description, area, rate, $('#add_grossvalue').val(), $('#add_roundvalue').val(),'<span><a onclick="" class="action-icons c-edit editaddrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class=" action-icons c-delete deleteaddrow " href="#" title="delete">Delete</a></span>','new']).draw( false );
				var roundtotal = 0;
			for (var i = 0;i<t.rows().count();i++){
		        var ldata = t.row(i).data();
		        if(ldata[7] !== 'delete'){
		        	roundtotal = roundtotal +  Number(removeCommas(ldata[5]));
		    	}
		    }
		    $('#additionaltotal').val(formatMoneyHas(roundtotal));
		    taxCalculation();
	    }
	}

	function totalAdditionalCal(){
    	var additionatable = $('#additionaltable').DataTable();
		$('#additionaltable_filter').remove();
	    $('#additionaltable_info').remove();
	    $('#additionaltable_paginate').remove();
	    $('#additionaltable_length').remove();
		var roundtotal = 0;
		for (var i = 0;i<additionatable.rows().count();i++){
	        var ldata = additionatable.row(i).data();
	        if(ldata[7] !== 'delete'){
	        	roundtotal = roundtotal +  Number(removeCommas(ldata[5]));
	        }
	        
	    }
	    $('#additionaltotal').val(formatMoneyHas(roundtotal));
	    taxCalculation();
	}

	function removeCommas(str) {

		try {
			while (str.search(",") >= 0) {
	            str = (str + "").replace(',', '');
	        }
		}
		catch(err) {
		 	return str;
		}
        
        return str;
    };

    function updateValuation(){
	    let maplottable = new Map([["0","sno"],["1", "lotno"], ["2", "lotarea"], ["3", "netvalue"],["4", "roundvalue"], ["5", "lotid"]]);

	    let mapbldgtable = new Map([["0","sno"],["1", "bldgcategory"], ["2", "bldgtype"], ["3", "bldgvalue"],["4", "allowancevalue"], ["5", "depvalue"],["6", "netbldgvalue"], ["7", "roundbldgvalue"],["8", "bldgid"]]);

	    let mapadditionaltable = new Map([["0","sno"],["1", "desc"],["2", "area"],["3", "rate"],["4", "grossvalue"],["5", "roundvalue"],["6", "action"],  ["7", "actioncode"],  ["8", "addadditionalid"]]);

	    
	    let maplotareatable = new Map([["0","arname"],["1", "area"],  ["2", "rate"], ["3", "calculatedrate"], ["4", "grossvalue"], ["5", "lotareaid"], ["6", "lotid"]]);

	    let mapbldgareatable = new Map([["0","artype"],["1", "arlevel"],  ["2", "arcategory"], ["3", "arused"], ["4", "area"], ["5", "arearate"], ["6", "grossareavalue"],["7", "bldgarid"],["9", "bldgid"]]);

	    let mapallowancetable = new Map([["0","sno"],["1", "desc"],  ["2", "calmethod"], ["3", "percentage"], ["4", "grossvalue"], ["5", "bldgallowanceid"], ["6", "bldgid"], ["7", "actioncode"]]);
	    var noty_id = noty({
					layout : 'center',
					text: 'Do want submit valuation?',
					modal : true,
					buttons: [
						{type: 'button pink', text: 'Submit', click: function($noty) {	
								
						  
	    var lotdata = [];

		for (var i = 0;i<$('#landtable').DataTable().rows().count();i++){
			var ldata = $('#landtable').DataTable().row(i).data();
			var tempdata1 = {};
			$.each(ldata, function( key, value ) {
				if (key !== 1) {
				tempdata1[maplottable.get(""+key+"")] = value; 
				}
			//console.log(key);            
        	});
        	//console.log(templotdata);
        	lotdata.push(tempdata1);            	
		}

		var bldgdata = [];

		for (var i = 0;i<$('#bldgtable').DataTable().rows().count();i++){
			var ldata = $('#bldgtable').DataTable().row(i).data();
			var tempdata1 = {};
			$.each(ldata, function( key, value ) {
				if (key !== 1) {
				tempdata1[mapbldgtable.get(""+key+"")] = value; 
				 }
			//console.log(key);            
        	});
        	//console.log(templotdata);
        	bldgdata.push(tempdata1);            	
		}

		var additionaldata = [];

		for (var i = 0;i<$('#additionaltable').DataTable().rows().count();i++){
			var ldata = $('#additionaltable').DataTable().row(i).data();
			var tempdata1 = {};
			$.each(ldata, function( key, value ) {
				if (key !== 6) {
				tempdata1[mapadditionaltable.get(""+key+"")] = value; 
				} 
			//console.log(key);            
        	});
        	//console.log(templotdata);
        	additionaldata.push(tempdata1);            	
		}
		if ($('#additionaltable').DataTable().rows().count() == 0){
			additionaldata = '{}';
		}

		var lotareadata = [];

		for (var i = 0;i<$('#hiddenlandarea').DataTable().rows().count();i++){
			var ldata = $('#hiddenlandarea').DataTable().row(i).data();
			var tempdata1 = {};
			$.each(ldata, function( key, value ) {
				
				tempdata1[maplotareatable.get(""+key+"")] = value; 
				
			//console.log(key);            
        	});
        	//console.log(templotdata);
        	lotareadata.push(tempdata1);            	
		}

		var bldgareadata = [];

		for (var i = 0;i<$('#hiddenbldgarea').DataTable().rows().count();i++){
			var ldata = $('#hiddenbldgarea').DataTable().row(i).data();
			var tempdata1 = {};
			$.each(ldata, function( key, value ) {
				
				tempdata1[mapbldgareatable.get(""+key+"")] = value; 
				
			//console.log(key);            
        	});
        	//console.log(templotdata);
        	bldgareadata.push(tempdata1);            	
		}

		var bldgallowancedata = [];

		for (var i = 0;i<$('#hiddenbldgallowance').DataTable().rows().count();i++){
			var ldata = $('#hiddenbldgallowance').DataTable().row(i).data();
			var tempdata1 = {};
			$.each(ldata, function( key, value ) {
				
				tempdata1[mapallowancetable.get(""+key+"")] = value; 
				
			//console.log(key);            
        	});
        	//console.log(templotdata);
        	bldgallowancedata.push(tempdata1);            	
		}

		lotdata = "["+ JSON.stringify(lotdata).replace(/]|[[]/g, '') +"]";
		bldgdata = "["+ JSON.stringify(bldgdata).replace(/]|[[]/g, '') +"]";
		
		lotareadata = "["+ JSON.stringify(lotareadata).replace(/]|[[]/g, '') +"]";
		bldgareadata = "["+ JSON.stringify(bldgareadata).replace(/]|[[]/g, '') +"]";
		bldgallowancedata = "["+ JSON.stringify(bldgallowancedata).replace(/]|[[]/g, '') +"]";

		if ($('#additionaltable').DataTable().rows().count() > 1)
			additionaldata = "["+ JSON.stringify(additionaldata).replace(/]|[[]/g, '') +"]";
		else
			additionaldata = JSON.stringify(additionaldata).replace(/]|[[]/g, '');

		var taxdata = {};
		$('#taxvaluationform').serializeArray().map(function(x){taxdata[x.name] = x.value;});
		console.log(taxdata);
		var prop_id = '{{$prop_id}}';
		var d=new Date();
					$.ajax({
			  				type: 'POST', 
						    url:'manualValuation',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{lotdata:lotdata,bldgdata:bldgdata,lotareadata:lotareadata,bldgareadata:bldgareadata,bldgallowancedata:bldgallowancedata,additionaldata:additionaldata,prop_id:prop_id,taxdata:JSON.stringify(taxdata)},
					        success:function(data){
					        	
								$('#finishloader').html('');
					        	var noty_id = noty({
									layout : 'top',
									text: 'Update successfully!',
									modal : true,
									type : 'success', 
								});			
								
				        	},
					        error:function(data){
								//$('#loader').css('display','none');
					        	$('#propertystatus').val('UnRegistered');	
					        	$('#finishloader').html('');     	
					        		var noty_id = noty({
									layout : 'top',
									text: 'Problem while update valuation!',
									modal : true,
									type : 'error', 
								});
				        	}
				    	});
						$noty.close();
						}
						},
						{type: 'button blue', text: 'Cancel', click: function($noty) {
								$noty.close();
						  	}
						}
						],
					type : 'success', 
			 	});

	}	

   

</script>

 
</body>
</html>