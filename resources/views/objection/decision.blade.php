<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('objection.Objection_List')}}</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
	.right-text {
		text-align:right;
	}
	.tbl-total {
		text-align:right;
		float: inline-end;
	}
	.numericCol {
		text-align: right;
	}
</style>


@include('includes.header', ['page' => 'VP'])
	
	<div id="content">
		<div class="grid_container">
			
			<div id="grouptable" class="grid_12">
				
				<br>
				<div class="form_input">
					<div id="breadCrumb3"  class="breadCrumb grid_4">
						<ul>
							<li><a href="#">{{__('objection.Home')}}</a></li>
							<li><a href="#">{{__('objection.Valuation_Process')}}</a></li>
							<li><a href="meeting">{{__('objection.Meeting')}}</a></li>
							<li>{{$objectiondetail}}</li>
						</ul>
					</div>
					<div style="float:right;margin-right: 0px;"  class="btn_24_blue">   
						<!--<a href="#" onclick="deleteProperty()">Generate Report</a>		-->
						<a href="#" onclick="addProperty()" title="Add_Property">{{__('objection.Add_Property')}}</a>
					</div>
					<div style="float:right;margin-right: 20px;"  class="btn_24_orange">   
			            <!--<a href="#" id="" onclick="getSelectedProp()" class=""><span>Add Basket </span></a>  -->
			          	<a href="#" id="" onclick="deleteDecision()" title="Delete Selected"><span>{{__('common.Delete')}} </span></a> 
		        	</div>

		        	 <div style="float:right;margin-right: 10px;"  class="btn_24_blue">   
			          @include('objection.search.newsearch',['tableid'=>'agendatbl', 'action' => '', 'searchid' => '37'])
			           
			        </div>

					<br>
				</div>	
				<div class="grid_12">
				<div class="widget_wrap tabby">
					<div class="widget_top">
						<div id="widget_tab">
							<ul>
								<li><a href="agenda?term={{$term}}&id={{$id}}" >{{__('objection.Agenda')}}</a></li>
								<li><a href="notice?term={{$term}}&id={{$id}}">{{__('objection.Existing_Notice')}}</a></li>
								<li><a href="objectionreport?term={{$term}}&id={{$id}}" >{{__('objection.Objection')}}</a></li>
								<li><a href="decision?term={{$term}}&id={{$id}}" class="active_tab">{{__('objection.Decision')}}</a></li>
								<li><a href="result?term={{$term}}&id={{$id}}">{{__('objection.Report')}}</a></li>
							</ul>
						</div>
					</div>			
					<div class="social_activities">
					<div class="comments_s">
						<div class="block_label">
							{{__('objection.Agenda_Count')}}<span>@foreach ($agendacnt as $rec)
										{{$rec->agenda_count}}									
									@endforeach	</span>
						</div>
					</div>
					<div class="comments_s">
						<div class="block_label">
							{{__('objection.Property_Count')}}<span>@foreach ($propcnt as $rec)
										{{$rec->property_count}}
									@endforeach	</span>
						</div>
					</div>
					<div class="views_s">
						<div class="block_label">
							{{__('objection.Notice_Count')}}<span>@foreach ($notiscnt as $rec)
										{{$rec->notis_count}}
									@endforeach	</span>
						</div>
					</div>
					<div class="comments_s">
						<div class="block_label">
							Objection_Count<span>@foreach ($objectioncnt as $rec)
										{{$rec->objection_count}}
									@endforeach	</span>
						</div>
					</div>
				</div>
								</br>					
							<table id="agendatbl" class="display ">
							<thead style="text-align: left;">
			  					<tr>
			  						<th><input name="select_all" value="1" type="checkbox"></th>
									<th class="table_sno"> {{__('objection.SNO')}}</th>
									<th> {{__('objection.Account_number')}} </th>
									<th> {{__('objection.Basket_Name')}} </th>
									<th> Land Value </th>
									<th> Building Value </th>
									<th> {{__('objection.Proposed_NT')}} </th>
									<th> {{__('objection.Proposed_Rate')}} </th>
									<th> {{__('objection.Proposed_Tax')}} </th>
									<th> {{__('objection.Valuer_Recommend')}}  </th>
									<th> {{__('objection.Approved_NT')}}  </th>
									<th> {{__('objection.Approved_Tax')}} </th>
									<th> Difference </th>
									<th> Percentage </th>
									<th> {{__('objection.Action')}} </th>
								</tr>
							</thead>
							<tbody>
								

							</tbody>
						</table>
            <div><p id="info">0 {{__('objection.Row_Selected')}}</p></div>				
				</div>	
			</div>
				

				@foreach ($objectionlist as $rec)
								<div style="display: none;">
									<input type="text" id="time_{{$rec->de_id}}" value="{{$rec->ol_time}}">
									<input type="text" id="reason_{{$rec->de_id}}" value="{{$rec->ol_reason}}">
									<input type="text" id="recommend_{{$rec->de_id}}" value="{{$rec->ol_valuerrecommend}}">
									<input type="text" id="nt_{{$rec->de_id}}" value="{{$rec->vt_approvednt}}">
									<input type="text" id="rate_{{$rec->de_id}}" value="{{$rec->vt_approvedrate}}">
									<input type="text" id="adjust_{{$rec->de_id}}" value="{{$rec->vt_adjustment}}">
									<input type="text" id="tax_{{$rec->de_id}}" value="{{$rec->vt_approvedtax}}">
									<input type="text" id="accno_{{$rec->de_id}}" value="{{$rec->vd_accno}}">
									<input type="text" id="vd_id_{{$rec->de_id}}" value="{{$rec->vd_id}}">
									<input type="text" id="zone_{{$rec->de_id}}" value="{{$rec->zone}}">
									<input type="text" id="subzone_{{$rec->de_id}}" value="{{$rec->subzone}}">
									<input type="text" id="proptype_{{$rec->de_id}}" value="{{$rec->proptype}}">
									<input type="text" id="propcate_{{$rec->de_id}}" value="{{$rec->propcategorty}}">
									<input type="text" id="vt_valuedescretion_{{$rec->de_id}}" value="{{$rec->vt_valuedescretion}}">
									<input type="text" id="vt_grossvalue_{{$rec->de_id}}" value="{{$rec->vt_grossvalue}}">
									<input type="text" id="vt_calculatedrate_{{$rec->de_id}}" value="{{$rec->vt_calculatedrate}}">
									<input type="text" id="vt_proposednt_{{$rec->de_id}}" value="{{$rec->vt_proposednt}}">
									<input type="text" id="vt_proposedrate_{{$rec->de_id}}" value="{{$rec->vt_proposedrate}}">
									<input type="text" id="vt_proposedtax_{{$rec->de_id}}" value="{{$rec->vt_proposedtax}}">
									<input type="text" id="note_{{$rec->de_id}}" value="{{$rec->vt_note}}">
									<input type="text" id="landvalue_{{$rec->de_id}}" value="{{$rec->landvalue}}">
									<input type="text" id="bldgvalue_{{$rec->de_id}}" value="{{$rec->bldgvalue}}">
									<input type="text" id="valid_{{$rec->de_id}}" value="{{$rec->vd_id}}">
								</div>
								@endforeach	
			</div>

			<div id="addgroup" style="display:none" class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_content">
						<h3 id="title">{{__('objection.Update_Decision')}}</h3>
						<form id="addgroupfrom"  autocomplete="off" class="" method="get" action="#" >
							@csrf
							<input type="hidden" name="vd_id" id="vd_id" value="0">
							<input type="hidden" name="operation" id="operation" value="0">
							<input type="hidden" name="ob_id" id="operation" value="{{$id}}">
							<div  class="grid_6 form_container left_label">
								<ul>
									<li>		
									<fieldset>
										<legend>{{__('objection.Basic_Information')}}</legend>						
										<div class="form_grid_12">									
											<label class="field_title" id="termname" for="termid">{{__('objection.Time')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="time" readonly="true"  name="time" type="text"  value="{{ old('time') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>								
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Reason')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="reason" readonly="true"  name="reason" type="text"  value="{{ old('reason') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>								
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Valuer_Recommend')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="valuerrec" readonly="true"  name="valuerrec" type="text"  value="{{ old('valuerrec') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>									
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Account_number')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="accno" required="true" readonly="true"  name="accno" type="text"  value="{{ old('accno') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>	
										</fieldset>
										
									</li>
								</ul>
							</div>
							<div  class="grid_6 form_container left_label">
								<ul>
									<li>		
									<fieldset>
										<legend>{{__('objection.Location_Information')}}</legend>						
										<div class="form_grid_12">									
											<label class="field_title" id="termname" for="termid">{{__('objection.Zone')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="zone" readonly="true"   name="zone" type="text"  value="{{ old('time') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>								
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Sub_Zone')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="subzone"  readonly="true" name="subzone" type="text"  value="{{ old('reason') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>								
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Property_Category')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="propcate"   readonly="true" name="propcate" type="text"  value="{{ old('valuerrec') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>									
										<div class="form_grid_12">									
											<label class="field_title" id="lblgroup" for="name">{{__('objection.Property_Type')}}<span class="req">*</span></label>
											<div class="form_input">
												<input id="proptype"  readonly="true"  name="accno" type="text"  value="{{ old('accno') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>	
										</fieldset>
										
									</li>
								</ul>
							</div>

							<div  class="grid_12 form_container left_label">
								<ul>
									<li>		
									<fieldset>
										<legend>Land / Building Information</legend>						
										<div class="form_grid_10">									
											<label class="field_title" id="termname" for="termid">Land Value<span class="req">*</span></label>
											<div class="form_input">
												<input id="landvalue" readonly="true"   name="landvalue" type="text"  value="{{ old('time') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>	
										<div class="form_grid_2">	
											<div style="float:right;margin-right: 30px;"  class="btn_24_blue">
												<a href="#" onclick="udpateland()">Update Valuation</a>
											</div>		
										</div>					
										<div class="form_grid_10">									
											<label class="field_title" id="lblgroup" for="name">Building Value<span class="req">*</span></label>
											<div class="form_input">
												<input id="bldgvalue"  readonly="true" name="bldgvalue" type="text"  value="{{ old('reason') }}" />
											</div>
											<span class=" label_intro"></span>
										</div>	
										</fieldset>
										
									</li>
								</ul>
							</div>
							<div  class="grid_12 form_container left_label">
								<ul>
									<li>		
									<fieldset>
										<legend>{{__('objection.Valuation_Information')}}</legend>		
										<div  class="grid_6 form_container left_label">		
										<br /><br /><br /><br /><br />		
										<div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lposition" for="position">{{__('objection.Approved_NT')}}<span class="req">*</span></label>
												</div>
												<div class="form_grid_8">
													<div  class="form_input">
														<input id="taxapprovednt" class="right-text allow_only_numbers" style="width: 100%;"  onchange="taxApprovedCalculation()"  tabindex="2" name="taxapprovednt"  type="text" value="" maxlength="50" class=""/>
													</div>
													<span class=" label_intro"></span>
												</div>
											
												<div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lposition" for="position">{{__('objection.Approved_Rate')}}<span class="req">*</span></label>
												</div>
												<div class="form_grid_8">
													<div  class="form_input">
														<input id="taxapprovedrate" class="right-text " style="width: 100%;"  tabindex="2" name="taxapprovedrate"  type="text"value=""  readonly="true"  maxlength="50" class=""/>
													</div>
													<span class=" label_intro"></span>
												</div>
										 		
												<div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lposition" for="position">{{__('objection.Adjustment')}}<span class="req">*</span></label>
												</div>
												<div class="form_grid_8">
													<div  class="form_input">
														<input id="taxadjustment" class="right-text " style="width: 100%;" tabindex="2" name="taxadjustment" value="" onchange="taxApprovedCalculation()"  type="text"  maxlength="50" class=""/>
													</div>
													<span class=" label_intro"></span>
												</div>
											
												<div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lposition" for="position">{{__('objection.Approved_Tax')}}<span class="req">*</span></label>
												</div>
												<div class="form_grid_8">
													<div  class="form_input">
														<input id="taxapprovedtax" value=""  readonly="true" tabindex="2"  name="taxapprovedtax"  type="text"  maxlength="50" class="right-text " />
													</div>
													<span class=" label_intro"></span>
												</div>	
											</div>
											<div  class="grid_6 form_container left_label">	
												<div class="form_grid_4">
													<label class="field_title"   id="accnumberlbl" style="width: 100%;" for="username">{{__('objection.Valuer_Discretion')}}<span class="req">*</span></label>
												</div>
												<div class="form_grid_8">
													<div  class="form_input">
														<input id="taxvaluerdiscretion" class="right-text " tabindex="1" style="width: 100%;" name="taxvaluerdiscretion" readonly="true"  onchange="taxCalculation()" type="text" maxlength="100" >
													</div>
													<span class=" label_intro"></span>
												</div>
													<div class="form_grid_4">
													<label class="field_title"  id="accnumberlbl" style="width: 100%;" for="username">{{__('objection.Gross_NT')}}<span class="req">*</span></label>
												</div>
												<div class="form_grid_8">
													<div  class="form_input">
														<input id="taxgrossnt" tabindex="1" value=""  readonly="true" style="width: 100%;" name="taxgrossnt" type="text" maxlength="100" class="right-text " >
													</div>
													<span class=" label_intro"></span>
												</div>
										
												<div class="form_grid_4">
													<label class="field_title" id="accnumberlbl" style="width: 100%;" id="lposition" for="position">{{__('objection.Proposed_NT')}}<span class="req">*</span></label>
												</div>
												<div class="form_grid_8">
													<div  classs="form_input" style="width: 70%;  margin-left: 30%;  position: relative;">
														<input id="taxproposednt" style=""  readonly="true" value="" tabindex="2" name="taxproposednt"  type="text"  maxlength="50" class="right-text "/>
													</div>
													<span class=" label_intro"></span>
												</div>
											
												<div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lposition" for="position">{{__('objection.Proposed_Rate')}}<span class="req">*</span></label>
												</div>
												<div class="form_grid_8">
													<div  class="form_input">
														<input id="taxproposedrate" style="width: 100%;"  value="" tabindex="2"name="taxproposedrate"  readonly="true" onchange="taxCalculation()" type="text"  maxlength="50" class="right-text "/>
													</div>
													<span class=" label_intro"></span>
												</div>
										 	
												<div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lposition" for="position">{{__('objection.Calculated_Rate')}} (%)<span class="req">*</span></label>
												</div>
												<div class="form_grid_8">
													<div  class="form_input">
														<input id="taxcalculaterate" style="width: 100%;" value="" tabindex="2" name="taxcalculaterate" readonly="true"  type="text" onchange="taxCalculation()"  maxlength="50" class="right-text "/>
													</div>
													<span class=" label_intro"></span>
												</div>
											
												<div class="form_grid_4">
													<label class="field_title" style="width: 100%;" id="lposition" for="position">{{__('objection.Proposed_Tax')}}<span class="req">*</span></label>
												</div>
												<div class="form_grid_8">
													<div  class="form_input">
														<input id="taxproposedtax"
														value=""  tabindex="2" name="taxproposedtax"  readonly="true" type="text"  maxlength="50" class="right-text "/>
													</div>
													<span class=" label_intro"></span>
												</div>
											</div>
										</fieldset>
										
									</li>
								</ul>
							</div>

							<div class="grid_12 form_container left_label">
										<ul>
											<li>													
												<fieldset>
										<legend>{{__('objection.Valuation_Description')}}</legend>		
												<div class="form_grid_2">
													<label class="field_title" style="width: 100%;" id="lposition" for="position">{{__('objection.Notes')}}<span class="req">*</span></label>
												</div>
												<div class="form_grid_9">
													<div style="margin-left: 0px"  class="form_input"> 
													<textarea rows="4" id="taxnotes" name="taxnotes" cols="50"></textarea>
													<span class=" label_intro"></span>
												</div>
												</div>
											</fieldset>
												
												</li>
											</ul>
									</div>
							
							<div style="height: 48px; float: none; display: -webkit-box;text-align: -webkit-center;" class="grid_12">
								
								<div class="form_input">
									<button id="addsubmit" name="adduser" type="submit" onclick="validateGroup()" class="btn_small btn_blue"><span>{{__('common.Submit')}}</span></button>			
														
									<button id="close" onclick="closeGroup()" name="close" type="button" class="btn_small btn_blue"><span>{{__('common.Close')}}</span></button>
									<span class=" label_intro"></span>
								</div>
								
								<span class="clear"></span>
							</div>
						</form>
					</div>
				</div>
			</div>
			
		</div>
	<span class="clear"></span>
	
	<script>

		function taxCalculation(){
	    	var landtotal = removeCommas($('#landvalue').val());
	    	var bldgtotal = removeCommas($('#bldgvalue').val());
	    	var taxvaluerdiscretion = removeCommas($('#taxvaluerdiscretion').val());
	    	var taxproposedrate = removeCommas($('#taxproposedrate').val());
	    	var taxcalculaterate = removeCommas($('#taxcalculaterate').val());
	    	var taxapprovednt = removeCommas($('#taxapprovednt').val());
	    	var taxadjustment = removeCommas($('#taxadjustment').val());
	    	var grossnt = Number(landtotal) + Number(bldgtotal) + Number(taxvaluerdiscretion);
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



	    function taxApprovedCalculation(){
	    	
	    	var taxapprovednt = removeCommas($('#taxapprovednt').val());
	    	var taxapprovedrate = removeCommas($('#taxapprovedrate').val());
	    	var taxadjustment = removeCommas($('#taxadjustment').val());
	    	var taxcalculaterate = removeCommas($('#taxcalculaterate').val());
	    	
	    	var approvedtax = Number(taxapprovednt) * (Number(taxapprovedrate) / 100) * ( Number(taxcalculaterate) / 100 ) + Number(taxadjustment);

	    	$('#taxapprovedtax').val(formatMoneyHas(approvedtax));
   		}

		function udpateland() {
			//alert();
			var id =$('#vd_id').val();
		    w = window.open('about:blank','Popup_Window','toolbar=0,resizable=0,location=no,statusbar=0,menubar=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		       // w.location = "landval?id="+id;
		      // w.location.pathname = 'valuation/popup/land.blade.php';
		       w.location.assign("decisioncal?id="+id);
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
		
		function submitForm(){
		    //console.log($("#filterForm").serialize());


		    var table = $('#agendatbl').DataTable();
		    table.clear();

		    var date = new Date();
		    var timestamp = date.getTime();
		    
		    var table = $('#agendatbl').DataTable();

		    $('#searchLoader').attr('style','display:block');

		    xhr = $.ajax({
		            url: 'decisiontable?id={{$id}}&test=manual&ts_='+timestamp,
		            type: 'GET',
		            data: $("#filterForm").serialize()
		        }).done(function (result) {
		          if(result.recordsTotal == 0) {
		            alert('No records found');
		          }
		          $('#searchLoader').attr('style','display:none');
		          table.rows.add(result.data).draw();
		      /*var count = table.rows().count();
		      
		      $('#prop_count').html(count);
		      if (count < totalcount ){
		        $('#prop_count').html(count+" ( filtered from total "+totalcount+") ");
		      }*/
		      
		      //alert();
		         // $('#searchLoader').hide();
		    
		        }).fail(function (jqXHR, textStatus, errorThrown) {              
		            console.log(errorThrown);        
		            alert(errorThrown);
		      $('#searchLoader').attr('style','display:none');
		           // $('#searchLoader').hide();
		    
		        });

		      //  $.ajax.abortAll();
		  }

		function addProperty() {		
		    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "decisiongrab?term={{$term}}&id={{$id}}";
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}

		function newGroup(){
			$("#operation").val(1);
			$("#grouptable").hide();
			$("#addgroup").show();

			$("#siries").val('');
			$("#desc").val('');
			$("#addsubmit").html("Save");
		 	$("label.error").remove();	
		}

		function updateMeeting(id){


			$("#operation").val(2);
			$("#grouptable").hide();
			$("#addgroup").show();

			$("#id").val(id);
			$("#time").val($("#time_"+id).val());
			$("#reason").val($("#reason_"+id).val());
			$("#valuerrec").val($("#recommend_"+id).val());
			$("#accno").val($("#accno_"+id).val());
			$("#vd_id").val($("#vd_id_"+id).val());


			$("#zone").val($("#zone_"+id).val());
			$("#subzone").val($("#subzone_"+id).val());
			$("#proptype").val($("#proptype_"+id).val());
			$("#propcate").val($("#propcate_"+id).val());
			$("#taxnotes").val($("#note_"+id).val());

			$("#landvalue").val($("#landvalue_"+id).val());
			$("#bldgvalue").val($("#bldgvalue_"+id).val());


			$("#taxapprovednt").val($("#nt_"+id).val());
			$("#taxproposednt").val($("#vt_proposednt_"+id).val());
			
			formatMoney("taxvaluerdiscretion",$("#vt_valuedescretion_"+id).val());
			formatMoney("taxgrossnt",$("#vt_grossvalue_"+id).val());
			formatMoney("taxcalculaterate",$("#vt_calculatedrate_"+id).val());
			//formatMoney("taxproposednt",$("#vt_proposednt_"+id).val());
			formatMoney("taxproposedrate",$("#vt_proposedrate_"+id).val());
			formatMoney("taxproposedtax",$("#vt_proposedtax_"+id).val());
			//formatMoney("taxapprovednt",$("#nt_"+id).val());
			formatMoney("taxapprovedrate",$("#rate_"+id).val());
			formatMoney("taxadjustment",$("#adjust_"+id).val());
			formatMoney("taxapprovedtax",$("#tax_"+id).val());
			
			//console.log($("#nt_"+id).val());
			//console.log($("#vt_proposednt_"+id).val());

			$("#addsubmit").html("Update");
		 	$("label.error").remove();	
		}

		function taxApprovedCalculation(){
    	
	    	var taxapprovednt = removeCommas($('#taxapprovednt').val());
	    	var taxapprovedrate = removeCommas($('#taxapprovedrate').val());
	    	var taxadjustment = removeCommas($('#taxadjustment').val());
	    	//var taxcalculaterate = removeCommas($('#taxcalculaterate').val());
	    	
	    	var approvedtax = Number(taxapprovednt) * (Number(taxapprovedrate) / 100) + Number(taxadjustment);

	    	$('#taxapprovedtax').val(formatMoneyHas(approvedtax));
    	}

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

    	function removeCommas(str) {
	        while (str.search(",") >= 0) {
	            str = (str + "").replace(',', '');
	        }
	        return str;
    	};

		function approveProperty(id){
			var noty_id = noty({
				layout : 'center',
				text: 'Are want to approve properties?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Approved', click: function($noty) {
						$noty.close();
						$.ajax({
			  				type: 'GET', 
						    url:'objectionapprove',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{param_value:id,module:'objection'},
					        success:function(data){
					        	//var count = data.propertycnt;
					        	
						        	var noty_id = noty({
										layout : 'top',
										text: 'Basket Approved!',
										modal : true,
										type : 'success', 
									});	
									window.location.assign("objection");	
									        		
					        	//$("#finish").attr("disabled", true);
					        	//clearTableError(4);
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

		function deleteMeeting(id){
			
			var noty_id = noty({
					layout : 'center',
					text: 'Are you want to delete?',
					modal : true,
					buttons: [
						{type: 'button pink', text: 'Delete', click: function($noty) {
					  			$("#operation").val(3);
					  			$("#id").val(id);
					  			
								$("#termid").val($("#termid_"+id).val());
					  			var groupdata = {};
		        				$('#addgroupfrom').serializeArray().map(function(x){groupdata[x.name] = x.value;});

		            			var groupjson = JSON.stringify(groupdata);
		           				window.location.assign('meetingtrn?jsondata='+groupjson)	
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

		function closeGroup(){
			//$('#addsubmit').removeAttr('disabled');
			$("#operation").val(1);
			$("#termid").val('');
			$("#name").val('');
			$("#grouptable").show();
			$("#addgroup").hide();
		 	$('#err_lbl').html('');
		 	$("label.error").remove();
		}

		function validateGroup(){
			
											
			$('#addgroupfrom').validate({
		        rules: {
		            'termid': 'required',
		            'name': 'required'
		        },
		        messages: {
					"term": "Please select term name",
					"name": "Please enter basket name"
		        },
		        submitHandler: function(form) {
					var d=new Date();		        	
					var operation = $('#operation').val();
					var page = "ratepayer";
					var groupdata = {};
		        	$('#addgroupfrom').serializeArray().map(function(x){groupdata[x.name] = x.value;});

		            var groupjson = JSON.stringify(groupdata);
		            //console.log(groupjson);
		            $.ajax({
			  				type: 'GET', 
						    url:'decisiontrn',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{jsondata:groupjson,type:'update',id:'{{$id}}'},
					        success:function(data){
					        	window.location.assign('decision?term={{$term}}&id={{$id}}')											
				        	}
				    	});
		                  	
		        }
		    });

		    		
		}



		function updateDataTableSelectAllCtrl(table){
		   var $table             = table.table().node();
		   var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
		   var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
		   var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

			   // If none of the checkboxes are checked
		   if($chkbox_checked.length === 0){
		      chkbox_select_all.checked = false;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = false;
		      }

		   // If all of the checkboxes are checked
		   } else if ($chkbox_checked.length === $chkbox_all.length){
		      chkbox_select_all.checked = true;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = false;
		      }

		   // If some of the checkboxes are checked
		   } else {
		      chkbox_select_all.checked = true;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = true;
		      }
		   }
				    $('#info').html(selectedrow() + " Row Selected");
}

function selectedrow(){
  var table = $('#agendatbl').DataTable();
  var count = 0;
  $.map(table.rows('.selected').data(), function (item) {
       count++;
    });
  return count;
}

$(document).ready(function (){
	var table = $('#agendatbl').DataTable({
		       "processing": false,
            "serverSide": false,
            /*"dom": '<"toolbar">frtip',*/
            "ajax": {
                "type": "GET",
                "url": 'decisiontable?id={{$id}}',
                "contentType": 'application/json; charset=utf-8',
            "headers": {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          		}
            },              

            // ajax: '{{ url("inspectionproperty") }}',
            /*"ajax": '/bookings/datatables',*/
            "columns": [
              {"data": "de_id", "name": "account number"},
              {"data": null, "name": "sno"},
              {"data": "de_accno", "name": "account number"},
              {"data": "va_name", "name": "account number"},
              {"data": "landvalue", "name": "zone", "sClass": "numericCol"},
              {"data": "bldgvalue", "name": "subzone", "sClass": "numericCol"},
              {"data": "vt_proposednt", "name": "zone", "sClass": "numericCol"},
              {"data": "vt_proposedrate", "name": "subzone", "sClass": "numericCol"},
              {"data": "vt_proposedtax", "name": "address", "sClass": "numericCol"},
              {"data": "ol_valuerrecommend", "name": "account number", "sClass": "numericCol"},
              {"data": "vt_approvednt", "name": "zone", "sClass": "numericCol"},
              {"data": "vt_approvedtax", "name": "subzone", "sClass": "numericCol"},
              {"data": "diff", "name": "address", "sClass": "numericCol"},
              {"data": "percentage", "name": "address", "sClass": "numericCol"},
              {"data":function(data){
			        	return '<span><a onclick="updateMeeting('+data.de_id+')" class="action-icons c-edit  edtlotrow" href="#" title="New Agenda">New Agenda</a></span>';
			        }, "name": "address"}
          ],
		        
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  		
         			//$("td:nth-child(2)", row).html(dataIndex + 1);
			        $("td:nth-child(2)", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
			        return nRow;
			    },
			    "sPaginationType": "full_numbers",
			"iDisplayLength": 100,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
		    'columnDefs': [{
         'targets': 0,
         'searchable': true,
         'orderable': false,
         'width': '1%',
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox">';
         }
      }],
      'rowCallback': function(row, data, dataIndex){
         // Get row ID
         var rowId = data[0];

         // If row ID is in the list of selected row IDs
         if($.inArray(rowId, rows_selected) !== -1){
            $(row).find('input[type="checkbox"]').prop('checked', true);
            $(row).addClass('selected');
         }
      },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			});
   // Array holding selected row IDs
   var rows_selected = [];
   
    
   

   // Handle click on checkbox
   $('#agendatbl tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = $('#agendatbl').DataTable().row($row).data();

      // Get row ID
      var rowId = data[0];

      // Determine whether row ID is in the list of selected row IDs
      var index = $.inArray(rowId, rows_selected);

      // If checkbox is checked and row ID is not in list of selected row IDs
      if(this.checked && index === -1){
         rows_selected.push(rowId);

      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
      } else if (!this.checked && index !== -1){
         rows_selected.splice(index, 1);
      }

      if(this.checked){
         $row.addClass('selected');
      } else {
         $row.removeClass('selected');
      }

      // Update state of "Select all" control
      updateDataTableSelectAllCtrl($('#agendatbl').DataTable());

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', $('#agendatbl').DataTable().table().container()).on('click', function(e){
     if(this.checked){
        $('#agendatbl tbody input[type="checkbox"]').prop('checked', true);
         $('#agendatbl tbody tr').addClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      } else {
         $('#agendatbl tbody input[type="checkbox"]').prop('checked', false);
         $('#agendatbl tbody tr').removeClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle table draw event
   $('#agendatbl').DataTable().on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl($('#agendatbl').DataTable());
   });
   // Handle form submission event

});

function generateRepro(){
		var table = $('#agendatbl').DataTable();
	var account = $.map(table.rows('.selected').data(), function (item) {
				//console.log(item);
	        	return item['id']
	   		});
}
function deleteDecision() {
	    var table = $('#agendatbl').DataTable();
	       
	    var account = $.map(table.rows('.selected').data(), function (item) {
	    	return item['de_id']
	    });
	    var acc_legth = account.length;
	    if (acc_legth > 0 ){
	      var noty_id = noty({
	          layout : 'center',
	          text: 'Are want to Delete?',
	          modal : true,
	          buttons: [
	            {type: 'button pink', text: 'Delete', click: function($noty) {
	              $noty.close();	                
	                 var id= "{{$id}}";
	                  var type = "delete";
	                     $.ajax({
	                       type:'GET',
	                       url:'decisiongrabtrn',
	                       data:{accounts:account,id:id,type:type},
	                       success:function(data){           
	                         // alert(data.newcount + " Property Deleted");
	                          window.location.assign('decision?term={{$term}}&id={{$id}}');
	                       }
	                  });
	            
	              }
	            },
	            {type: 'button blue', text: 'Cancel', click: function($noty) {
	              $noty.close();
	              }
	            }
	            ],
	           type : 'success', 
	         });
	    } else {
	      alert('Please select Atleast one Property to Delete');
	    }
	    
	   }
		
	</script>

</div>
</body>
</html>