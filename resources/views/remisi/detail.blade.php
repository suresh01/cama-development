<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Notis</title>

@include('includes.header-popup')
					
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">	
				
				<br>
				<br>
				
        
        
				<div class="widget_wrap tabby">
					<div class="widget_top">
						<div id="widget_tab">
							<ul>
								<li><a href="remisidetail"  >Property Information</a></li>
								<li><a href="remisiregister" class="active_tab">Registration</a></li>
								<li><a href="investigation" >Investigation</a></li>
								<li><a href="insresult" >Investigation Result</a></li>
							</ul>
						</div>
					</div>
				
								</br>	
					<div class="widget_content">						
						<div class="grid_6 form_container left_label">
							<ul>
							<li>
								<fieldset>
									<legend>Information</legend>
										<div class="form_grid_12">
											<label class="field_title"  id="accnumberlbl" for="username">Applicant Reff No<span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="lposition" for="position">Applicant Later Date<span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">Applicant Name<span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
								 		
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">Applicant Address1<span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">Applicant Address2<span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
										
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">Applicant Address3<span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
								 		
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">Applicant Address4<span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">Applicant City<span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
								 		
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">Applicant State<span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">Vacancy Start Date<span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">Vacancy End Date<span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
								 		
										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">Registration Officer<span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>

										<div class="form_grid_12">
											<label class="field_title" id="llevel" for="level">Registration Date<span class="req">*</span></label>
											<div  class="form_input">
												<input id="accnumber" tabindex="1" readonly="true" name="accnumber" type="text" value="" maxlength="100" >
											</div>
											<span class=" label_intro"></span>
										</div>
										
									</fieldset>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
				
		 <form style="display: hidden;" id="generateform" method="GET" action="generateNotis">
            @csrf
            <input type="hidden" name="accounts" id="accounts2">
		</form>
		
		
	</div>
	<span class="clear"></span>
	</div>


</body>
</html>