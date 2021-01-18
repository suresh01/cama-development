

	
	
	<!--<form id="masterform"  autocomplete="off" onsubmit="return false;" class="" action="" >
				<div style="height: 48px;  display: -webkit-box;text-align: -webkit-right;" class="grid_12">
							
									<div class="form_input">
										<button id="mastersubmit" onclick="addmaster()" name="adduser" type="submit" class="btn_small btn_blue"><span>Submit</span></button>
			<button id="close" name="close"  onclick="location.href='propertyregister?pb={{$pb}}';" type="button" class="btn_small btn_blue"><span>Back</span></button>		
									</div>
								
									<span class="clear"></span>
						</div>-->
	<div  class="grid_6 ">
		<ul>
		<li>

			<fieldset>
										<legend>Account Information</legend>
			<input type="hidden" name="operation" value="1" id="master_operation">
			<input type="hidden" value="0" name="role_id" id="roleid">
			<div class="form_grid_12">
				<label class="field_title" id="lusername" for="username">ACCOUNT NUMBER<span class="req">*</span></label>
				<div  class="form_input">
					<input id="accnumber" tabindex="1" name="accnumber" type="text"  maxlength="12" class="">
					
				</div>
				<span class=" label_intro"></span>
			</div>
			
			<div class="form_grid_12">
				<label class="field_title" id="lposition" for="position">FILE NUMBER<span class="req">*</span></label>
				<div  class="form_input">
					<input id="filenumber" tabindex="2" name="filenumber"  type="text"  maxlength="30" class=""/>
				</div>
				<span class=" label_intro"></span>
			</div>
			
			<div class="form_grid_12">
				<label class="field_title" id="llevel" for="level">DISTRICT<span class="req">*</span></label>
				<div  class="form_input">
					<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="district" name="district" tabindex="3">
						<option></option> 
						@foreach ($district as $rec)
								<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
						@endforeach	
					</select>
				</div>
				<span class=" label_intro"></span>
			</div>

			<div class="form_grid_12">
				<label class="field_title" id="llevel" for="level">ZONE<span class="req">*</span></label>
				<div  class="form_input">
					<select data-placeholder="Choose a Status..." tabindex="3" style="width:100%" class="cus-select" id="zone" name="zone" tabindex="20">
						<option></option>
						@foreach ($zone as $rec)
								<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
						@endforeach	
					</select>
				</div>
				<span class=" label_intro"></span>
			</div>

			<div class="form_grid_12">
				<label class="field_title" id="llevel" for="level">SUBZONE<span class="req">*</span></label>
				<div  class="form_input">
					<select data-placeholder="Choose a Status..." tabindex="4" style="width:100%" class="cus-select"  id="subzone" name="subzone" tabindex="20">
						<option></option>
						@foreach ($subzone as $rec)
								<option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
						@endforeach	
					</select>
				</div>
				<span class=" label_intro"></span>
			</div>

			<div class="form_grid_12">
				<label class="field_title" id="llevel" for="level">IS BUILDING<span class="req">*</span></label>
				<div  class="form_input">
					<select data-placeholder="Choose a Status..." tabindex="5" style="width:100%" class="cus-select"  id="bldgtype" name="bldgtype" tabindex="20">
						<option></option>
						@foreach ($ishasbuilding as $rec)
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
	<div  class="grid_6 ">
		<ul>
		<li>	

			<fieldset>
										<legend>Address Information</legend>								
		<div class="form_grid_12">
			<label class="field_title" id="lposition" for="position">ADDRESS 1<span class="req">*</span></label>
			<div  class="form_input">
				<input id="address1" name="address1" type="text" tabindex="6"  maxlength="100" class=""/>
			</div>
			<span class=" label_intro"></span>
		</div>

		<div class="form_grid_12">
			<label class="field_title" id="lposition" for="position">ADDRESS 2</label>
			<div  class="form_input">
				<input id="address2"  name="address2"  type="text" tabindex="7" style="width:100%"  maxlength="100" class=""/>
			</div>
			<span class=" label_intro"></span>
		</div>
		<div class="form_grid_12">
			<label class="field_title" id="lposition" for="position">ADDRESS 3</label>
			<div  class="form_input">
				<input id="address3"  name="address3" tabindex="8" type="text" maxlength="100" class=""/>
			</div>
			<span class=" label_intro"></span>
		</div>
		<div class="form_grid_12">
			<label class="field_title" id="lposition" for="position">ADDRESS 4</label>
			<div  class="form_input">
				<input id="address4"  name="address4" tabindex="9" type="text" maxlength="100" class=""/>
			</div>
			<span class=" label_intro"></span>
		</div>
		<div class="form_grid_12">
			<label class="field_title" id="lposition" for="position">POST CODE<span class="req">*</span></label>
			<div  class="form_input">
				<input id="postcode" name="postcode" tabindex="10" type="number" minlength="5" maxlength="6" class=""/>
			</div>
			<span class=" label_intro"></span>
		</div>
		<div class="form_grid_12">
			<label class="field_title" id="lposition" for="position">CITY<span class="req">*</span></label>
			<div  class="form_input">
				<input id="city"  name="city" type="text" tabindex="11"  maxlength="50" class=""/>
			</div>
			<span class=" label_intro"></span>
		</div>
		<div class="form_grid_12">
			<label class="field_title" id="llevel" for="level">STATE<span class="req">*</span></label>
			<div  class="form_input">
				<select data-placeholder="Choose a Status..." tabindex="12" style="width:100%" class="cus-select"  id="state" name="state" tabindex="20">
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
	    		createDropDownOptions(data.res_arr, 'subzone')
			  }
			});
	    });

	    $("#accnumber").keyup(function(){
		    var account = this.value;
		    var length = account.length;
		    if (length > 11){
		    	alert('Please enter 11 digit account number');
		    	//$("#accnumber").val(account.slice(0,-1));
		    }
		    
		});

		$("#bldgtype").change(function() {
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


		});

	    $("#accnumber").change(function() {
	    	//console.log(this.value);
		    //$("#accnumber").val(this.value+""+Math.floor((Math.random() * 9) + 1));
		    var account = this.value;
		    var length = account.length;
		    if (length === 11){		    
			    $.ajax({
				  url: "checkdigit",
				  cache: false,
				  data:{param_value:this.value},
				  success: function(data){
				  	
				  		$("#accnumber").val(account+""+data.checkdigit);
				    	
				    	var valid = validateAccount(this.value).done(function(data){
					       var count = data.res_arr;
							if (count > 0 ) {
								$('#accnumber').focus();
								alert('Account Number already exists');
							} else {
			    				$('#propertystatus').val('');
							}
						});	
				   
				  }
				});
		    } else {
		    	alert("Please enter 11 digit account number");
		    }
	    		
	    });

	    $("#propertyregsitration_from-next-0").click(function(){
	    	var account = $("#accnumber").val();
	    	var valid = validateAccount(account).done(function(data){
		        var count = data.res_arr;
				if (count > 0 ) {
					$('#accnumber').focus();
					alert('Account Number already exists');
					//$('#accountvalid').val();							
					$( "#propertyregsitration_from-back-1").trigger("click");
				}
			});    	
	    	
	    });

	   


	});

	function validateAccount(account){

		return $.ajax({
				        type: "GET",
				        url: "validateAccount",
				        data: {param_value:account},
				        cache: false
				    });
	    	
	}

 	/*function addmaster(){
	   //alert();


	  
	    $('#masterform').validate({
	        rules: {
	            'accnumber': {
	                required: true,
	                minlength: 12,
	                maxlength: 12,
	            }
	        },
	        messages: {
	            'accnumber': {
	                minlength: 'Account number must be at least 12 characters long',
	                maxlength: 'Account number must be at least 12 characters long',
	                required: 'This field is required'
	            }
	        },
	        submitHandler: function(form) {
	            //form.submit();
	            $('#mastersubmit').text('Please Wait');
	            console.log('validation true');

	            var masterdata = {};
	            $('#masterform').serializeArray().map(function(x){masterdata[x.name] = x.value;});

	            //console.log(masterdata);
	            var masterjson = JSON.stringify(masterdata);
	            var pb = '{{$pb}}';
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
	                        text: 'Master while addinglot detail!',
	                        modal : true,
	                        type : 'error', 
	                    });
	                }
	            });
	        }
	    });
	}*/
</script>
<script src="js/propertyregister/tab-script.js" type="text/javascript"></script>