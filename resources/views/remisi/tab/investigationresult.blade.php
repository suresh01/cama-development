
@foreach ($master as $master)
	<div class="grid_12 ">
		<ul>
			<li>
				<fieldset>
					<legend>Decision</legend>
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
					
					<div class="form_grid_12">
						<label class="field_title" id="lposition" for="position">Result Date<span class="req">*</span></label>
						<div  class="form_input">
							<input id="resultdate" tabindex="1" name="resultdate" type="text" value="{{$master->rg_regofficerdate}}" maxlength="100" >
						</div>
						<span class=" label_intro"></span>
					</div>
					
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
							<input id="impldate" tabindex="1" name="impldate" type="text" value="{{$master->rg_reimplementdate}}" maxlength="100" >
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
							
							<input name="rjreason1" value="1" class="checkbox rjreason" type="checkbox"  tabindex="7">
							</span>
						</div>
					</div>
					<div class="form_grid_10">
						<label style="width: 80%;" class="field_title">Reason 1</label>
						
					</div>
					<div class="form_grid_2">
												
						<div style="width: 20%;" class="form_input ">
							<span>
							
							<input name="rjreason2" value="2" class="checkbox rjreason" type="checkbox"  tabindex="7">
							</span>
						</div>
					</div>
					<div class="form_grid_10">
						<label style="width: 80%;" class="field_title">Reason 2</label>
						
					</div>
					<div class="form_grid_2">
												
						<div style="width: 20%;" class="form_input ">
							<span>
							
							<input name="rjreason3" value="3" class="checkbox rjreason" type="checkbox"  tabindex="7">
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
				$('#approvedesc').attr('checked', true).button("refresh");
				$('#approvepart').show();
				$('#rejectpart').hide();
			} else if('{{$master->rg_redecision_id}}' == 2){
				$('#rejectdesc').attr('checked', true);
				$('#approvepart').hide();
				$('#rejectpart').show();
			}

			$('#resultoffi').val('{{$master->rg_regofficer}}');
		});


	</script>

@endforeach

