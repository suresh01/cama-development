<div  class="grid_12 ">
	<ul>
	<li>
		<fieldset>
			<legend>{{__('tab.Parameter')}}</legend>
				<div class="form_grid_12">
					<label class="field_title" id="llevel" for="level">{{__('tab.BUILDING_STATUS')}}<span class="req">*</span></label>
					<div  class="form_input">
						<select data-placeholder="Choose a Status..." disabled="" style="width:100%" class="cus-select"  id="parambldgstatus" name="parambldgstatus" tabindex="6">
							<option></option>
					@foreach ($ishasbuilding as $rec)
							<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
					@endforeach	
						</select>
					</div>
					<span class=" label_intro"></span>
				</div>
				<div class="form_grid_12">
					<label class="field_title" id="llevel" for="level">{{__('tab.PROPERTY_CATEGORY')}}<span class="req">*</span></label>
					<div  class="form_input">
						<select data-placeholder="Choose a Status..." disabled="" style="width:100%" class="cus-select"  id="parambldgcategory" name="parambldgcategory" tabindex="6">
							<option></option>
					@foreach ($bldgcate as $rec)
							<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
					@endforeach	
						</select>
					</div>
					<span class="label_intro"></span>
				</div>
				<div class="form_grid_12">
					<label class="field_title" id="llevel" for="level">{{__('tab.TYPE_OF_PROPERTY_USE')}}<span class="req">*</span></label>
					<div  class="form_input">
						<select data-placeholder="Choose a Status..." disabled="" style="width:100%" class="cus-select"  id="parambldgtype" name="parambldgtype" tabindex="6">
							<option></option>
					@foreach ($bldgtype as $rec)
							<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
					@endforeach	
						</select>
					</div>
					<span class=" label_intro"></span>
				</div>
				<div class="form_grid_12">
					<label class="field_title" id="llevel" for="level">{{__('tab.LEVEL_OF_PROPERTY_USE')}}<span class="req">*</span></label>
					<div  class="form_input">
						<select data-placeholder="Choose a Status..." disabled="" style="width:100%" class="cus-select"  id="paramarlevel" name="paramarlevel" tabindex="6">
							<option></option>
					@foreach ($bldgstore as $rec)
							<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
					@endforeach	
						</select>
					</div>
					<span class=" label_intro"></span>
				</div>
			</fieldset>
		</li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#parambldgcategory").change(function() {
		//console.log(this.value);
		var param_value = this.value;
		var param = 'parameter';
	    $.ajax({
		  url: "subCategory",
		  cache: false,
		  data:{param_value:param_value,param:param},
		  success: function(data){
		    //$("#results").append(html);		    
		    //$('#zone').append('<option value=""></option>');
			createDropDownOptions(data.res_arr, 'parambldgtype');
			createDropDownOptions(data.res_arr2, 'paramarlevel');
		  }
		});
	});
	
	@foreach($parameter as $rec)
		$('#parambldgstatus').val('{{$rec->ap_bldgstatus_id}}');
		$('#parambldgcategory').val('{{$rec->ap_propertycategory_id}}');
		var param_value = '{{$rec->ap_propertycategory_id}}';
		var param = 'parameter';
	    $.ajax({
		  url: "subCategory",
		  cache: false,
		  data:{param_value:param_value,param:param},
		  success: function(data){
		    //$("#results").append(html);		    
		     //$('#zone').append('<option value=""></option>');
			createDropDownOptions(data.res_arr, 'parambldgtype');
			createDropDownOptions(data.res_arr2, 'paramarlevel');
			$('#parambldgtype').val('{{$rec->ap_propertytype_id}}');
			$('#paramarlevel').val('{{$rec->ap_propertylevel_id}}');
		  }
		});
	@endforeach
});
</script>