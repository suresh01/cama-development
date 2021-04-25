
@foreach ($master as $master)
	<div class="grid_12 ">
		<ul>
			<li>
				<fieldset>
					<legend>Decision</legend>
					<div class="form_grid_6">
						<label class="field_title"  id="accnumberlbl" for="username">Result Officer<span class="req">*</span></label>
						<div  class="form_input">
							<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"   id="resultoffi" name="resultoffi" tabindex="14">
								<option></option>
								@foreach ($userlist as $rec)
										<option value='{{ $rec->usr_name }}'>{{ $rec->name }}</option>
								@endforeach	
							</select>
						</div>
						<span class=" label_intro"></span>
					</div>
					
					<div class="form_grid_6">
						<label class="field_title" id="lposition" for="position">Result Date<span class="req">*</span></label>
						<div  class="form_input">
							<input id="resultdate" tabindex="1" name="resultdate" type="text" value="{{$master->rg_reofficerdate}}" maxlength="100" >
						</div>
						<span class=" label_intro"></span>
					</div>

					<div class="grid_12">
						<br /><br />
						<div class="form_grid_6">
							<div class="form_grid_2">
								<label style="width: 80%;" class="field_title">Approved
								</label>
							</div>
							<div class="form_grid_2">

								<div style="width: 20%;" class="form_input ">
									<span>
									<input name="decision" id="approvedesc" onchange="decisionUpdate(this.value)" value="1" class="checkbox decision" type="radio"  tabindex="7">
								
								</span>
								</div>
							</div>					
						</div>

						<div class="form_grid_6">
							<div class="form_grid_2">
								<label style="width: 80%;" class="field_title">Rejected
								</label>
							</div>
							<div class="form_grid_2">

								<div style="width: 20%;" class="form_input ">
									<span>
									<input name="decision" id="rejectdesc" value="2" onchange="decisionUpdate(this.value)"  class="checkbox decision" type="radio"  tabindex="7">
								
								</span>
								</div>
							</div>
						
						</div>
					</div>
				</fieldset>
			</li>
		</ul>
	</div>
				
	<div id="approvepart" style="display: none;" class="grid_12 ">
		<ul>
			<li>
				<fieldset>
					<legend>Approved Information</legend>
					
					
					<div class="form_grid_12">
						<label class="field_title" id="llevel" for="level">Vacant Begin Date<span class="req">*</span></label>
						<div  class="form_input">
							<input id="vacantsdate" tabindex="1" name="vacantsdate" type="text" value="{{$master->rg_revacancystartdate}}" maxlength="100" >
						</div>
						<span class=" label_intro"></span>
					</div>
			 		
					<div class="form_grid_12">
						<label class="field_title" id="llevel" for="level">Vacant End Date<span class="req">*</span></label>
						<div  class="form_input">
							<input id="vacantedate" tabindex="1" name="vacantedate" type="text" value="{{$master->rg_revacancyenddate}}" maxlength="100" >
						</div>
						<span class=" label_intro"></span>
					</div>

					
					

					
					<div class="form_grid_12">
						<label class="field_title" id="llevel" for="level">Amount<span class="req">*</span></label>
						<div  class="form_input">
							<input id="insamount" tabindex="1" name="insamount" type="text" value="{{$master->rg_reamount}}" maxlength="100" >
						</div>
						<span class=" label_intro"></span>
					</div>
			 		
					<div class="form_grid_12">
						<label class="field_title" id="llevel" for="level">implemented DATE<span class="req">*</span></label>
						<div  class="form_input">
							<!--<input id="impldate" tabindex="1" name="impldate" type="text" value="{{$master->rg_reimplementdate}}" maxlength="100" >-->

							<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"   id="impldate" name="impldate" tabindex="14">
								<option></option>
								@foreach ($term as $rec)
										<option value='{{ $rec->vt_termDate }}'>{{ $rec->termDate }}</option>
								@endforeach	
							</select>
						</div>
						<span class=" label_intro"></span>
					</div>
				</fieldset>
			</li>
		</ul>
	</div>
	<div id="rejectpart" style="display: none;" class="grid_12" >
		<ul>
			<li>
				<fieldset>
					<legend>Rejected Information</legend>
					<div class="form_grid_2">
												
						<div style="width: 20%;" class="form_input ">
							<span>
							
							<input name="rjreason1" id="rjreason1" value="1" class="checkbox rjreason1" type="checkbox"  tabindex="7">
							</span>
						</div>
					</div>
					<div class="form_grid_10">
						<label style="width: 80%;" class="field_title">Reason 1</label>
						
					</div>
					<div class="form_grid_2">
												
						<div style="width: 20%;" class="form_input ">
							<span>
							
							<input name="rjreason2" id="rjreason2" value="2" class="checkbox rjreason2" type="checkbox"  tabindex="7">
							</span>
						</div>
					</div>
					<div class="form_grid_10">
						<label style="width: 80%;" class="field_title">Reason 2</label>
						
					</div>
					<div class="form_grid_2">
												
						<div style="width: 20%;" class="form_input ">
							<span>
							
							<input name="rjreason3" id="rjreason3" value="3" class="checkbox rjreason3" type="checkbox"  tabindex="7">
							</span>
						</div>
					</div>
					<div class="form_grid_10">
						<label style="width: 80%;" class="field_title">Reason 3</label>
						
					</div>

					
					
					
				</fieldset>
			</li>
		</ul>
	</div>
	<script>
		function decisionUpdate(id){
			if(id == 1){
				$('#approvepart').show();
				$('#rejectpart').hide();
			} else if(id == 2){
				$('#approvepart').hide();
				$('#rejectpart').show();
			}
		}

		$(document).ready(function() {
			if('{{$master->rg_redecision_id}}' == 1){
				$('#approvedesc').attr('checked', true);
				$('#approvepart').show();
				$('#rejectpart').hide();
				var to_replace = $("#uniform-approvedesc").find('span');
				to_replace.attr("class", "checked");
			} else if('{{$master->rg_redecision_id}}' == 2){
				$('#rejectdesc').attr('checked', true);
				$('#approvepart').hide();
				$('#rejectpart').show();
				var to_replace = $("#uniform-rejectdesc").find('span');
				to_replace.attr("class", "checked");
			}

			$('#resultoffi').val('{{$master->rg_reofficer}}');
			$('#impldate').val('{{$master->rg_reimplementdate}}');

			
			if('{{$master->rg_rerejectreason1}}' == 1){				
				var to_replace = $("#uniform-rjreason1").find('span');
				to_replace.attr("class", "checked");
			} 
			 if('{{$master->rg_rerejectreason2}}' == 2){		
				var to_replace = $("#uniform-rjreason2").find('span');
				to_replace.attr("class", "checked");
			} 
			 if('{{$master->rg_rerejectreason3}}' == 3){		
				var to_replace = $("#uniform-rjreason3").find('span');
				to_replace.attr("class", "checked");
			} 
		});


	</script>

@endforeach

