@foreach ($master as $master)
		
<div  class="grid_4 ">
	<ul>
	<li>
		<fieldset>
			<legend>Account Information</legend>
				<div class="form_grid_12">
					<label class="field_title"  id="accnumberlbl" for="username">ACCOUNT NUMBER<span class="req">*</span></label>
					<div  class="form_input">
						{{$master->ma_accno}}
					</div>
					<span class=" label_intro"></span>
				</div>
				
				<div class="form_grid_12">
					<label class="field_title" id="lposition" for="position">FILE NUMBER<span class="req">*</span></label>
					<div  class="form_input">
						{{$master->ma_fileno}}
					</div>
					<span class=" label_intro"></span>
				</div>
		 		
				<div class="form_grid_12">
					<label class="field_title" id="llevel" for="level">ZONE<span class="req">*</span></label>
					<div  class="form_input">
						{{$master->zone}}
					</div>
					<span class=" label_intro"></span>
				</div>

				<div class="form_grid_12">
					<label class="field_title" id="llevel" for="level">SUBZONE<span class="req">*</span></label>
					<div  class="form_input">
						{{$master->subzone}}
					</div>
					<span class=" label_intro"></span>
				</div>
				
				<!--<div class="form_grid_12">
					<label class="field_title" id="llevel" for="level">IS BUILDING<span class="req">*</span></label>
					<div  class="form_input">
						<select data-placeholder="Choose a Status..."  style="width:100%" class="cus-select"  id="bldgtype" name="bldgtype" tabindex="6">
							<option></option>
						@foreach ($ishasbuilding as $rec)
								<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
						@endforeach	
						</select>
					</div>
					<span class=" label_intro"></span>
				</div>-->
							
				<div class="form_grid_12">
					<label class="field_title" id="lposition" for="position">ADDRESS 1<span class="req">*</span></label>
					<div  class="form_input">
						{{$master->ma_addr_ln1}}
					</div>
					<span class=" label_intro"></span>
				</div>

				<div class="form_grid_12">
					<label class="field_title" id="lposition" for="position">ADDRESS 2</label>
					<div  class="form_input">
						{{$master->ma_addr_ln2}}
					</div>
					<span class=" label_intro"></span>
				</div>
				<div class="form_grid_12">
					<label class="field_title" id="lposition" for="position">ADDRESS 3</label>
					<div  class="form_input">
						{{$master->ma_addr_ln3}}
					</div>
					<span class=" label_intro"></span>
				</div>
				<div class="form_grid_12">
					<label class="field_title" id="lposition" for="position">ADDRESS 4</label>
					<div  class="form_input">
						{{$master->ma_addr_ln4}}
					</div>
					<span class=" label_intro"></span>
				</div>
				<div class="form_grid_12">
					<label class="field_title" id="llevel" for="level">STATE<span class="req">*</span></label>
					<div  class="form_input">
						
					</div>
					<span class=" label_intro"></span>
				</div>
			</fieldset>
		</li>
	</ul>
</div>
@endforeach
@foreach ($ownerd as $owner)

								<div class="grid_4 ">
								<ul>
								<li>
									
								
								<fieldset>
										<legend>Owner Information</legend>
<div class="form_grid_4">
											<br><br><br>
										</div>
										
								
								

								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER NUMBER<span class="req">*</span></label>
									<div  class="form_input">
										{{$owner->TO_OWNNO}}
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER NAME<span class="req">*</span></label>
									<div  class="form_input">
										<{{$owner->TO_OWNNAME}}
									</div>
									<span class=" label_intro"></span>
								</div>
								
								
								

								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER ADDRES 1<span class="req">*</span></label>
									<div  class="form_input">
										{{$owner->TO_ADDR_LN1}}
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER ADDRES 2</label>
									<div  class="form_input">
										{{$owner->TO_ADDR_LN2}}
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">OWNER ADDRES 3</label>
									<div  class="form_input">
										{{$owner->TO_ADDR_LN3}}
									</div>
									<span class=" label_intro"></span>
								</div>
								<div class="form_grid_12">
									<label class="field_title" id="lposition" for="position">OWNER ADDRES 4</label>
									<div  class="form_input">
										{{$owner->TO_ADDR_LN4}}
									</div>
									<span class=" label_intro"></span>
								</div>

								<div class="form_grid_12">
									<label class="field_title" id="llevel" for="level">STATE<span class="req">*</span></label>
									<div  class="form_input">
										
									</div>
									<span class=" label_intro"></span>
								</div>
							</fieldset>
								</li></ul>
							</div>

@endforeach

@foreach ($building as $rec)
@php($category =  $rec->bldgcategory)
<script type="text/javascript">
	$(document).ready(function(){
		$('.category').html('{{$rec->bldgcategory}}')
	});
</script>
<div class="grid_4 ">
				<ul>
					<li>
						<fieldset>
										<legend>Building Information</legend>

						<div class="form_grid_12">
							<label class="field_title" id="lusername" for="username">BUILDING NUMBER<span class="req">*</span></label>
							<div  class="form_input">
								{{ $rec->ab_bldg_no }}
							</div>
							<span class=" label_intro"></span>
						</div>
					
						<div class="form_grid_12">
							<label class="field_title" id="lposition" for="position">BUILDING CATEGORY<span class="req">*</span></label>
							<div  class="form_input">
								{{ $rec->bldgcategory }}
							</div>
							<span class=" label_intro"></span>
						</div>
						
						<div class="form_grid_12">
							<label class="field_title" id="llevel" for="level">BUILDING TYPE<span class="req">*</span></label>
							<div  class="form_input">{{ $rec->bldgtype }}
							</div>
							<span class=" label_intro"></span>
						</div>
						<div class="form_grid_12">
							<label class="field_title" id="llevel" for="level">BUILDING STOREY<span class="req">*</span></label>
							<div  class="form_input">{{ $rec->bldgstorey }}
							</div>
							<span class=" label_intro"></span>
						</div></fieldset>
					</li>
				</ul>
			</div>
@endforeach