<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Property Registeration - Master Information</title>

<link rel="stylesheet" type="text/css" href="js/handsontable/handsontable.full.min.css">


<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/layout.css" rel="stylesheet" type="text/css">
<link href="css/themes.css" rel="stylesheet" type="text/css">
<link href="css/typography.css" rel="stylesheet" type="text/css">
<!--<link href="css/styles.css" rel="stylesheet" type="text/css">-->
<link href="css/shCore.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/jquery.jqplot.css" rel="stylesheet" type="text/css">
<link href="css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css">
<link href="css/data-table.css" rel="stylesheet" type="text/css">
<link href="css/form.css" rel="stylesheet" type="text/css">
<link href="css/ui-elements.css" rel="stylesheet" type="text/css">
<link href="css/wizard.css" rel="stylesheet" type="text/css">
<link href="css/sprite.css" rel="stylesheet" type="text/css">
<link href="css/gradient.css" rel="stylesheet" type="text/css">
<link href="css/tree.css" rel="stylesheet" type="text/css"> 
<style>
.dropdown-submenu .dropdown-menu {
    /**left: 100%;*/
}
.disabled-btn{
    pointer-events:none;
    opacity:0.7;
}
.button-back {
	/*display: none;*/
}

</style>
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="css/ie/ie7.css" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="css/ie/ie8.css" />
<![endif]-->
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" href="css/ie/ie9.css" />
<![endif]-->
<!-- Jquery -->
<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="js/jquery.ui.touch-punch.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="js/uniform.jquery.js"></script>
<script src="js/bootstrap-dropdown.js"></script>
<script src="js/bootstrap-colorpicker.js"></script>
<script src="js/sticky.full.js"></script>
<script src="js/jquery.noty.js"></script>
<script src="js/selectToUISlider.jQuery.js"></script>
<script src="js/fg.menu.js"></script>
<script src="js/jquery.tagsinput.js"></script>
<script src="js/jquery.cleditor.js"></script>
<script src="js/jquery.tipsy.js"></script>
<script src="js/jquery.peity.js"></script>
<script src="js/jquery.simplemodal.js"></script>
<script src="js/jquery.jBreadCrumb.1.1.js"></script>
<script src="js/jquery.colorbox-min.js"></script>
<script src="js/jquery.idTabs.min.js"></script>
<script src="js/jquery.multiFieldExtender.min.js"></script>
<script src="js/jquery.confirm.js"></script>
<script src="js/elfinder.min.js"></script>
<script src="js/accordion.jquery.js"></script>
<script src="js/autogrow.jquery.js"></script>
<script src="js/check-all.jquery.js"></script>
<script src="js/data-table.jquery.js"></script>
<script src="js/ZeroClipboard.js"></script>
<script src="js/TableTools.min.js"></script>
<script src="js/jeditable.jquery.js"></script>
<script src="js/ColVis.min.js"></script>
<script src="js/duallist.jquery.js"></script>
<script src="js/easing.jquery.js"></script>
<script src="js/full-calendar.jquery.js"></script>
<script src="js/input-limiter.jquery.js"></script>
<script src="js/inputmask.jquery.js"></script>
<script src="js/iphone-style-checkbox.jquery.js"></script>
<script src="js/meta-data.jquery.js"></script>
<script src="js/quicksand.jquery.js"></script>
<script src="js/raty.jquery.js"></script>
<script src="js/smart-wizard.jquery.js"></script>
<script src="js/stepy.jquery.js"></script>
<script src="js/treeview.jquery.js"></script>
<script src="js/ui-accordion.jquery.js"></script>
<script src="js/vaidation.jquery.js"></script>
<script src="js/mosaic.1.0.1.min.js"></script>
<script src="js/jquery.collapse.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/jquery.autocomplete.min.js"></script>
<script src="js/localdata.js"></script>
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.jqplot.min.js"></script>
<script src="js/custom-scripts.js"></script>
<script src="js/common/common-script.js"></script>
<script src="js/common/validation/validation.js"></script>	

<script src="js/handsontable/handsontable.full.js"></script>
</head>
<body id="theme-default" class="full_block">
<script type = "text/javascript">  
    window.onload = function () {  
        document.onkeydown = function (e) {  
            return (e.which || e.keyCode) != 116 || (e.keyCode == 65 && e.ctrlKey);  
        };  
        $(function() {
            $(this).bind("contextmenu", function(e) {
                e.preventDefault();
            });
        }); 
    }  
</script> 
<div style="margin-top: 0px;" id="container">
<!--<div class="page_title">
		<span class="title_icon"><span class="blocks_images"></span></span>
		<h3>Users</h3>
		<div class="top_search">
			<form action="#" method="post">
				<ul id="search_box">
					<li>
					<input name="" type="text" class="search_input" id="suggest1" placeholder="Search...">
					</li>
					<li>
					<input name="" type="submit" value="" class="search_btn">
					</li>
				</ul>
			</form>
		</div>
	</div>-->
	<div id="content">
		<div class="grid_container">

		
			
			<div class="full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<!--<span class="h_icon list"></span>
						<h6>Property Registration</h6>-->
						<div id="top_tabby">
						</div>
					</div>
					<div class="widget_content">
						<h3>Property Registration</h3>
						<p>
							<i>user instruction</i>
							<div class="cur_step_err"></div>
							<!--<input type="button" class="finish" id="save" value="Save!"/>-->
						</p>
						<div id="stepy_form" class="form_container left_label">
							<fieldset title="Step 1">
								<legend>Master Information</legend>
								<div id="mastertable"></div>								
							</fieldset>
							<fieldset title="Step 2">
								<legend>Lot Information</legend>
								<div id="lottable"></div>
							</fieldset>
							<fieldset title="Step 3">
								<legend>Owner Information</legend>
								<div id="ownertable"></div>
									
							</fieldset>
							<fieldset title="Step 4">
								<legend>Building Information</legend>
								<div id="bldgtable"></div>								
							</fieldset>
							<fieldset title="Step 5">
								<legend>Building Area Information</legend>	
								<div id="bldgartable"></div>							
							</fieldset>
							<a href="#" id="finish" class="finish">Finish!</a>
							<!--<input type="button" id="finish" class="finish" value="Finish!"/>-->
						</div>
					</div>
				</div>
			</div>
		
			
				
			</div>
	</div>

	<div id="loader">
		
	</div>
		
		

	<span class="clear"></span>

</div>

<script src="js/propertyregister/handsontable/master.js"></script>
<script src="js/propertyregister/handsontable/lot.js"></script>
<script src="js/propertyregister/handsontable/owner.js"></script>
<script src="js/propertyregister/handsontable/bldg.js"></script>
<script src="js/propertyregister/handsontable/bldgarea.js"></script>
<script>
var maxrow = '{{$maxRow}}';
var bldghot, bldgarhot, ownerhot, lothot,masterhot;

//Meta data
var district = arrayToJSON('{{$district}}');
var state = arrayToJSON('{{$state}}');
var bldgcate = arrayToJSON('{{$bldgcate}}');
var ishasbuilding = arrayToJSON('{{$ishasbuilding}}');
var lotcode = arrayToJSON('{{$lotcode}}');
var titiletype = arrayToJSON('{{$titiletype}}');
var unitsize = arrayToJSON('{{$unitsize}}');
var landcond = arrayToJSON('{{$landcond}}');
var landpos =  arrayToJSON('{{$landpos}}');
var roadtype = arrayToJSON('{{$roadtype}}');
var roadcaty = arrayToJSON('{{$roadcaty}}');
var landuse = arrayToJSON('{{$landuse}}');
var tnttype = arrayToJSON('{{$tnttype}}');
var owntype = arrayToJSON('{{$owntype}}');
var citizen = arrayToJSON('{{$citizen}}');
var race = arrayToJSON('{{$race}}');
var bldgcond = arrayToJSON('{{$bldgcond}}');
var bldgpos = arrayToJSON('{{$bldgpos}}');
var bldgstructure = arrayToJSON('{{$bldgstructure}}');
var rooftype = arrayToJSON('{{$rooftype}}');
var walltype = arrayToJSON('{{$walltype}}');
var fltype = arrayToJSON('{{$fltype}}');
var artype = arrayToJSON('{{$artype}}');
var arlvl = arrayToJSON('{{$arlvl}}');
var arcaty = arrayToJSON('{{$arcaty}}');
var arzone = arrayToJSON('{{$arzone}}');
var aruse = arrayToJSON('{{$aruse}}');
var fltype = arrayToJSON('{{$fltype}}');
var walltype = arrayToJSON('{{$walltype}}');
var ceiling = arrayToJSON('{{$ceiling}}');
var activeind = arrayToJSON('{{$activeind}}');
var zone = arrayToJSON('{{$zone}}');
var subzone = arrayToJSON('{{$subzone}}');
var bldgstore = arrayToJSON('{{$bldgstore}}');
var bldgtype = arrayToJSON('{{$bldgtype}}');
var statedefault = arrayToJSON('{{$statedefault}}');




//submit data
$(document).ready(function(){

	$("#stepy_form-titles").children('li').addClass('disabled-btn');

	/*stepy_form-back-1
	$("#finish").click(function(){

	});*/
/*
			var noty_id = noty({
				layout : 'center',
				text: 'Are want to approve properties?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Approve', click: function($noty) {
						$noty.close();
						
					},
					{type: 'button blue', text: 'Cancel', click: function($noty) {
						$noty.close();
					  }
					}
					],
				 type : 'success', 
			 });*/
$("#finish").click(function(){
		//console.log(bldghot);
	



		var masterdata = "";
		var lotdata = "";
		var ownerdata = "";
		var bldgdata = "";
		var bldgardata = "";
		var pb = '{{$pb}}';
		var masterValid = false;
		var lotValid = false;
		var ownerValid = false;
		var bldgValid = false;
		var bldgarValid = true;

		
					
				//finish();
				
				masterdata = JSON.stringify(masterhot.getSourceData());
				console.log(masterdata);
 
				bldgarhot.validateCells(function(valid) {
					if (valid){		
						var noty_id = noty({
						layout : 'center',
						text: 'Are want to register properties?',
						modal : true,
						buttons: [
							{type: 'button pink', text: 'Register', click: function($noty) {
								$noty.close();
								$.ajax({
					  				type: 'POST', 
								    url:'registerproperty',
								    headers: {
									    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
									},
							        data:{masterdata:masterdata,pb:pb},
							        success:function(data){
										$('#loader').html('');
											alert('Properties Updated');
							        		var noty_id = noty({
											layout : 'top',
											text: data.text,
											modal : true,
											type : 'success', 
										 });					        		
							        	$("#finish").attr("disabled", true);
							        	clearTableError(4);
						        	},
							        error:function(data){
										//$('#loader').css('display','none');	
							        	$('#loader').html('');     	
							        		var noty_id = noty({
											layout : 'top',
											text: 'Problem while registerting property!',
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

					} else {
						showTableError(4,5);
					}
				})
			

		
		/*console.log(masterdata);
		console.log(lotdata);
		console.log(ownerdata);*/

		
	});
});



</script>	
</body>
</html>