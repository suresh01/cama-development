<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>DMS</title>


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
<script src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="js/elfinder.min.js"></script>
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

		$(document).click(function() {
		    $('.dropdown-menu').hide();
		});

		$('.dropdown').click(function(event){
		   $('.dropdown-menu').hide();
		});  
		

	});

	function check_access(module,url){
		//var te = module;
		//alert();
		if (url ==  'propertyregister') {
			window.location.href = url;
		} else { 
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
		}
		//alert();
	}
</script>

</head>
<body id="theme-default" class="full_block">

<div id="container">
	<div id="header" class="blue_lin">
		<div class="header_left">
			<!--<div class="logo">
				<img src="images/logo.jpeg" width="160" height="60" >
			</div>	-->		
		</div>
		<div class="header_right">			
			<div id="user_nav">
				<ul>
					<li class="user_thumb"><a href="#"><span class="icon"><img src="images/user_thumb.png" width="30" height="30" alt="User"></span></a></li>
					<li class="user_info"><span class="user_name">{{ Auth::user()->name }}</span><span><a href="profile">Profile</a></span></li>
					<li class="logout"><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" title="Logout"><span class="icon"></span>Logout</a></li>
					
				</ul>
			</div>
		</div>
	</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
    </form>
	<div class="stats_bar">		
		
		<!--<ul>
	      <li><a tabindex="-1" href="#">HTML</a></li>
	      <li><a tabindex="-1" href="#">CSS</a></li>
	      <li class="dropdown-submenu">
	        <a class="test" tabindex="-1" href="#">New dropdown <span class="caret"></span></a>
	        <ul class="dropdown-menu" style="display:none">
	          <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
	          <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
	          <li class="dropdown-submenu">
	            <a class="test" href="#">Another dropdown <span class="caret"></span></a>
	            <ul class="dropdown-menu" style="display:none">
	              <li><a href="#">3rd level dropdown</a></li>
	              <li><a href="#">3rd level dropdown</a></li>
	            </ul>
	          </li>
	        </ul> 
	      </li>
	    </ul>-->
		<ul>						
			<li><a href="dashboard"><span class="stats_icon dashboard"></span><span class="label">Home</span></a></li>
			<li><a onclick="return check_access('1','enquery');" href="#"><span class="stats_icon data_enqury"></span><span class="label">Data Enquery</span></a></li>
			<li class="dropdown-submenu dropdown"><a style="background-color: #95C9F5;" class="test" tabindex="-1" href="#"><span class="stats_icon data_maintance"></span><span class="label">Data Maintenance</span></a>
				<ul class="dropdown-menu" style="display:none">
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;"  onclick="check_access('401','codemaintenance')" class="test" href="#">Code Maintenance<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('401','propertybasket')" class="test" href="#">Property Registration<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('401','tenant')" class="test" href="#">Tenant Registration<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('401','ratepayer')" class="test" href="#">Ratepayer Registration<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('401','filemanager')" class="test" href="#">DMS<span class="caret"></span></a>
			        </li>
    			</ul>
			</li>
			<li><a onclick="check_access('2','#')" href="#"><span class="stats_icon finished_work_sl"></span><span class="label">Tone of List</span></a></li>
			<li><a onclick="check_access('6','#')" href="#"><span class="stats_icon finished_work_sl"></span><span class="label">Valuation Process</span></a></li>
			<li><a onclick="check_access('3','#')" href="#"><span class="stats_icon archives_sl"></span><span class="label">Report</span></a></li>
			<li class="dropdown-submenu dropdown">
        <a class="test" tabindex="-1" href="#"><span class="stats_icon user_sl"></span><span class="label">Admin</span></a>
        <ul class="dropdown-menu" style="display:none">
          <li class="dropdown-submenu">
            <a style="padding: 5px;width: 172px;"  class="test" href="#">Users Management<span class="caret"></span></a>
            <ul class="dropdown-menu" style="display:none;">
                <li>					
					<a style="padding: 5px;width: 172px;" onclick="check_access('106','user');" href="#">Users</a>							
				</li>
				<li>
					<a style="padding: 5px;width: 172px;" onclick="check_access('107','role');" href="#">Role</a>
				</li>
				<li>
					<a style="padding: 5px;width: 172px;" onclick="return check_access('108','module');" href="#">Module</a>
				</li>
				<li>
					<a style="padding: 5px;width: 172px;" onclick="return check_access('109','access');" href="#">Access</a>
				</li>
            </ul>
          </li>
          <li><a style="padding: 5px;width: 172px;" tabindex="-1" href="#">Move Data</a></li>
          <li><a style="padding: 5px;width: 172px;" tabindex="-1" href="#">Active Account</a></li>
          <li><a style="padding: 5px;width: 172px;" tabindex="-1" onclick="return check_access('109','search');" href="#">Search Management</a></li>
        </ul>
      </li>
			<!--<li class="dropdown-submenu"><a data-toggle="dropdown" style="/*background-color: #95C9F5;*/" class="dropdown-toggle active"><span class="stats_icon user_sl"></span><span class="label">Admin</span></a>
				<div style="width: 100%;" class="notification_list dropdown-menu blue_d">
					<div class="white_lin nlist_block">
						<ul  >
							<li >
								
							<div class="list_inf">
								<a onclick="check_access('106','user')" href="#">Users</a>								
							</div>
							</li>
							<li>
							<div class="list_inf">
								<a onclick="check_access('107','role')" href="#">Role</a>
							</div>

							</li>
							<li>
							<div class="list_inf">
								<a onclick="return check_access('108','module');" href="#">Module</a>
							</div>
							</li>
							<li>
							<div class="list_inf">
								<a onclick="return check_access('109','access');" href="#">Access</a>
							</div>
							</li>
							
						</ul>
					</div>
				</div>
				</li>-->
		</ul>
	</div>
	


	<script src="js/elfinder.full.js"></script>
		<script>
$(document).ready(function() {		
			var options = {
		url  : 'php/connector.minimal.php?cmd=open&inti=1',
		//url  : 'http://10.201.49.202:84/FileServer/php/connector.minimal.php',
		lang : 'en'
	}
$('#elfinder').elfinder(options);
			});
		</script>
		<!-- Require JS (REQUIRED) -->
		<!-- Rename "main.default.js" to "main.js" and edit it if you need configure elFInder options or any things -->
	
	<div id="content">
		<div class="grid_container">

		<div id="usertable" class="grid_12">	
			<br>
			<div class="form_input">
				<div id="breadCrumb3" style="float:right;" class="breadCrumb grid_3">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Data Maintenance</a></li>
						<li><a href="fmterm">DMS</a></li>
						<li>File Manager</li>
					</ul>
				</div>
			</div>
			<div class="grid_container">
				<div class="grid_12 full_block">
					<div class="widget_wrap">
						<div class="widget_content">
							<div id="elfinder"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
				
		
		
	</div>
	<span class="clear"></span>


</div>
</body>
</html>
