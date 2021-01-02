<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Roles</title>

<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/layout.css" rel="stylesheet" type="text/css">
<link href="css/themes.css" rel="stylesheet" type="text/css">
<link href="css/typography.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet" type="text/css">
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

<script>
	$(document).ready(function(){

		$('.dropdown-submenu a.test').on("click", function(e){
			$(this).next('ul').toggle();
			e.stopPropagation();
			e.preventDefault();
		});

		$('body').click(function(event){
		   $('.dropdown-menu').hide();
		});  

	});

	function check_access(module,url){
		//var te = module;
		//alert();
		$.ajax({
	        type:'GET',
	        url:'/getaccess',
	        data:{module:module},
	        success:function(data){	        	
	        	if(data.msg === "false"){
	        		alert("You Don't have permission");
	        		return;
	        	} else {	        		
					window.location.href = url;
	        	}
	        }
	    });
		//alert();
	}
</script>

</head>
<body id="theme-default" class="full_block">

<div id="container">
	<div id="header" class="g_blue">
		<div class="header_left">
			<!--<div class="logo">
				<img src="images/logo.jpeg" width="160" height="60" >
			</div>	-->		
		</div>
		<div class="header_right">			
			<div id="user_nav">
				<ul>
					
				</ul>
			</div>
		</div>
	</div>


	
	<div id="content">
		<div class="grid_container">
		<div id="adduserform" class="grid_12">
			<div class="widget_wrap">
				
				<div class="widget_content">
					<!--<h3 id="title">Add User</h3>-->
					        
			        <form method="POST" action="{{ route('login') }}">
			            @csrf
			            <input type="hidden" name="email" value="{{$email}}">
			            <input type="hidden" name="password" value="{{$password}}">
			            <input type="hidden" name="relogin" value="true">
			            
			           <ul>
			           		<li>
			           			<div class="form_grid_12">
								
								<span class=" label_intro">user logged in another device. do you want to logout and login here</span>
							</div>
							
							</li>
							<li>							
							<div class="form_input">
									<button id="addsubmit" name="adduser" type="submit" class="btn_small btn_blue"><span></span>
										Logout
									</button>											
									<button id="close" onclick="redirectIndex()" name="close" type="button" class="btn_small btn_blue"><span>Exit</span></button>
								</div>
							</li>
						</ul>
			           
			        </form>
				</div>
			</div>
		</div>
	</div>
	<span class="clear"></span>
	
	<script>
	function redirectIndex(){
		window.location.href = "{{ route('logout') }}";		
	}
	</script>
</div>

</body>
</html>