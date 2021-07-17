@foreach ($master as $master)
		<script type="text/javascript">
			$(document).ready(function(){
				$("#subzone").val('{{$master->ma_subzone_id}}');
				$("#zone").val('{{$master->zone_id}}');
				$("#state").val('{{$master->ma_state_id}}');
				$("#bldgtype").val('{{$master->ma_ishasbuilding_id}}');
				$("#district").val('{{$master->ma_district_id}}');

			});
		</script>
<div  class="grid_6 ">
	<ul>
	<li>
		<fieldset>
			<legend>{{__('inspection.Account_Information')}}</legend>
				<div class="form_grid_12">
					<label class="field_title"  id="accnumberlbl" for="username">{{__('inspection.Account_Number')}} <span class="req">*</span></label>
					<div  class="form_input">
						<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="{{$master->ma_accno}}" maxlength="100" >
					</div>
					<span class=" label_intro"></span>
				</div>
				
				<div class="form_grid_12">
					<label class="field_title" id="lposition" for="position">{{__('inspection.File_Number')}} <span class="req">*</span></label>
					<div  class="form_input">
						<input id="filenumber" tabindex="2"name="filenumber"  type="text" value="{{$master->ma_fileno}}" maxlength="50" class=""/>
					</div>
					<span class=" label_intro"></span>
				</div>
				
				<div class="form_grid_12">
					<label class="field_title" id="llevel" for="level">{{__('inspection.District')}} <span class="req">*</span></label>
					<div  class="form_input">
						<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="district" name="district" tabindex="3">
							<option></option>
						@foreach ($district as $rec)
								<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
						@endforeach	
						</select>
					</div>
					<span class=" label_intro"></span>
				</div>
		 		
				<div class="form_grid_12">
					<label class="field_title" id="llevel" for="level">{{__('inspection.Zone')}} <span class="req">*</span></label>
					<div  class="form_input">
						<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="zone" name="zone" tabindex="4">
							<option></option>
						@foreach ($zone as $rec)
								<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
						@endforeach	
						</select>
					</div>
					<span class=" label_intro"></span>
				</div>

				<div class="form_grid_12">
					<label class="field_title" id="llevel" for="level">{{__('inspection.Subzone')}} <span class="req">*</span></label>
					<div  class="form_input">
						<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="subzone" name="subzone" tabindex="5">
							<option></option>
						@foreach ($subzone as $rec)
								<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
						@endforeach	
						</select>
					</div>
					<span class=" label_intro"></span>
				</div>
				
				<!--<div class="form_grid_12">
					<label class="field_title" id="llevel" for="level">{{__('inspection.Account_Information')}} IS BUILDING<span class="req">*</span></label>
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
			</fieldset>
		</li>
	</ul>
</div>
<div  class="grid_6 form_container left_label">
	<ul>
		<li>				
			<fieldset>
				<legend>{{__('inspection.Address_Information')}}</legend>					
				<div class="form_grid_12">
					<label class="field_title" id="lposition" for="position">{{__('inspection.Address1')}} <span class="req">*</span></label>
					<div  class="form_input">
						<input id="address1" tabindex="8" name="address1"  type="text" value="{{$master->ma_addr_ln1}}" maxlength="100" class=""/>
					</div>
					<span class=" label_intro"></span>
				</div>

				<div class="form_grid_12">
					<label class="field_title" id="lposition" for="position">{{__('inspection.Address2')}} </label>
					<div  class="form_input">
						<input id="address2"  tabindex="9" name="address2"  type="text" value="{{$master->ma_addr_ln2}}" maxlength="100" class=""/>
					</div>
					<span class=" label_intro"></span>
				</div>
				<div class="form_grid_12">
					<label class="field_title" id="lposition" for="position">{{__('inspection.Address3')}} </label>
					<div  class="form_input">
						<input id="address3"  name="address3" tabindex="10"  type="text" value="{{$master->ma_addr_ln3}}" maxlength="100" class=""/>
					</div>
					<span class=" label_intro"></span>
				</div>
				<div class="form_grid_12">
					<label class="field_title" id="lposition" for="position">{{__('inspection.Address4')}} </label>
					<div  class="form_input">
						<input id="address4"  name="address4" tabindex="11"  type="text" value="{{$master->ma_addr_ln4}}" maxlength="100" class=""/>
					</div>
					<span class=" label_intro"></span>
				</div>
				<div class="form_grid_12">
					<label class="field_title" id="lposition" for="position">{{__('inspection.Post_Code')}} <span class="req">*</span></label>
					<div  class="form_input">
						<input id="postcode" name="postcode" tabindex="12"  type="text" value="{{$master->ma_postcode}}" maxlength="50" class=""/>
					</div>
					<span class=" label_intro"></span>
				</div>
				<div class="form_grid_12">
					<label class="field_title" id="lposition" for="position">{{__('inspection.City')}} <span class="req">*</span></label>
					<div  class="form_input">
						<input id="city"  name="city" tabindex="13"  type="text" value="{{$master->ma_city}}" maxlength="50" class=""/>
					</div>
					<span class=" label_intro"></span>
				</div>
				<div class="form_grid_12">
					<label class="field_title" id="llevel" for="level">{{__('inspection.State')}} <span class="req">*</span></label>
					<div  class="form_input">
						<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="state" name="state" tabindex="14">
							<option></option>
					@foreach ($state as $rec)
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
@endforeach

<script type="text/javascript">

	$(document).ready(function() {
		

	    $("#district").change(function() {
	    	console.log(this.value);
	    	var param_value = this.value;
	    	var param = 'zone';
	        $.ajax({
			  url: "subCategory",
			  cache: false,
			  data:{param_value:param_value,param:param},
			  success: function(data){
			    //$("#results").append(html);
			    var d = jQuery.parseJSON(data.res_arr);
			    //console.log(d);
			    console.log(data.res_arr.length);
			    console.log(data.res_arr[0].tdi_value);
			     //$('#zone').append('<option value=""></option>');
	    		createDropDownOptions(data.res_arr, 'zone')
			  }
			});
	    });

	    $("#zone").change(function() {
	    	//console.log(this.value);
	    	var param_value = this.value;
	    	var param = 'subzone';
	        $.ajax({
			  url: "subCategory",
			  cache: false,
			  data:{param_value:param_value,param:param},
			  success: function(data){
			    //$("#results").append(html);
			    var d = jQuery.parseJSON(data.res_arr);
			    //console.log(d);
			    console.log(data.res_arr.length);
			    console.log(data.res_arr[0].tdi_value);
			     //$('#zone').append('<option value=""></option>');
	    		createDropDownOptions(data.res_arr, 'subzone')
			  }
			});
	    });
	    
	    $("#acclabel").html($("#accnumber").val());
		$("#ownerlabel").html($("#accnumber").val());
		$("#bldglabel").html($("#accnumber").val());
		
		/*$("#bldgtype").change(function() {
			console.log(this.value);
			console.log(this.value === '0');
			if (this.value === '0'){
				//$("#addbldg").attr("disabled", true);
				$("#bldgtable").hide();
				$("#addbldg").hide();
				//$('#propertyregsitration_from-title-3').hide();
			} else if (this.value === '1'){
				$("#bldgtable").show();
				$("#addbldg").show();
				//$("#addbldg").removeAttr("disabled");
			}
		});*/
			
	});
		
	 function addmaster(){

	    
	    $('#masterform').validate({
	        rules: {
				firstname: "required",
	            accnumber: {
	                required: true,
	                minlength: 12,
	                maxlength: 12,
	            }
	        },
	        messages: {
				sfirstname: "Enter your firstname",
	            accnumber: {
	                minlength: "Password must be at least 12 characters long",
	                maxlength: "Password must be at least 12 characters long",
	                required: "This field is required"
	            }
	        },
	        submitHandler: function(form) {
	            //form.submit();
	            //alert(2);
	            $('#mastersubmit').text('Please Wait');
	            //console.log('validation true');

	            var masterdata = {};
	            $('#masterform').serializeArray().map(function(x){masterdata[x.name] = x.value;});

	            //console.log(masterdata);
	            var masterjson = JSON.stringify(masterdata);
	            var pb = '{{$pb}}';
	            //alert({{$pb}});
	            $.ajax({
	                type:'POST',
	                url:'registerproperty',
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                },
	                data:{form:'master',type:'tab',jsondata:masterjson,pb:pb},
	                success:function(data){     
	                $('#mastersubmit').text('Submit');                                      
	                    var noty_id = noty({
	                        layout : 'top',
	                        text: 'Master detail added successfully!',
	                        modal : true,
	                        type : 'success', 
	                    });
	                        
	                },
	                error:function(data){   
	                $('#mastersubmit').text('Submit');      
	                    var noty_id = noty({
	                        layout : 'top',
	                        text: 'error while adding master detail!',
	                        modal : true,
	                        type : 'error', 
	                    });
	                }
	            });
	        }
	    });
	}
	</script>
