<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Data Enquery</title>
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
<link href="css/scroller.dataTables.min.css" rel="stylesheet" type="text/css">


<link href="css/form.css" rel="stylesheet" type="text/css">
<link href="css/ui-elements.css" rel="stylesheet" type="text/css">
<link href="css/wizard.css" rel="stylesheet" type="text/css">
<link href="css/sprite.css" rel="stylesheet" type="text/css">
<link href="css/gradient.css" rel="stylesheet" type="text/css">
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
<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.scroller.min.js"></script>
<script src="js/bootstrap-dropdown.js"></script>

<script>
	$(document).ready(function() {
        var valuationdata = [];
        $.ajax({
	        type:'GET',
	        url:'valuationdata',
	        data:{id:''},
	        success:function(data){	        	
	        	//valuationdata= data.data;
		        $('#example').DataTable( {
		            data:            data.data,
		            deferRender:    true,
		            scrollY:        300,
		            scrollX:        true,
		            scrollCollapse: true,
		            scroller:       true,
		            columns: [
						          {'data':'id'},
						          {'data':'bangunan_nobangunan'},
						          {'data':'jenisbangunan_nama'},
						          {'data':'luasutama_jenisaras_id'},
						          {'data':'luasutama_tot_nlfa'}
	        				]
	        	} );
	        }
	    });
	    //alert(valuationdata);
	    /*valuationdata = 
        for ( var i=0 ; i<20000 ; i++ ) {
            valuationdata.push( [ i, 'CMK', i+16, i, (i+6)-5 ] );
        }*/
         
        /*$('#example').DataTable( {
            data:           valuationdata,
            deferRender:    true,
            scrollY:        300,
            scrollCollapse: true,
            scroller:       true
        } );*/

         $('.dropdown-submenu a.test').on("click", function(e){
	    $(this).next('ul').toggle();
	    e.stopPropagation();
	    e.preventDefault();
	  });
    } );


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
			<div class="logo">
				<img src="images/logo.jpeg" width="160" height="60" >
			</div>			
		</div>
		<div class="header_right">			
			<div id="user_nav">
				<ul>
					<li class="user_thumb"><a href="#"><span class="icon"><img src="images/user_thumb.png" width="30" height="30" alt="User"></span></a></li>
					<li class="user_info"><span class="user_name">{{ Session::get('username')}}</span><span><a href="#">Profile</a></span></li>
					<li class="logout"><a href="/" title="Logout"><span class="icon"></span>Logout</a></li>
				</ul>
			</div>
		</div>
	</div>


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
			<li><a onclick="check_access('4','#')" href="#"><span class="stats_icon data_maintance"></span><span class="label">Data Maintance</span></a></li>
			<li><a onclick="check_access('2','#')" href="#"><span class="stats_icon finished_work_sl"></span><span class="label">Tone of List</span></a></li>
			<li><a onclick="check_access('6','#')" href="#"><span class="stats_icon finished_work_sl"></span><span class="label">Valuation Process</span></a></li>
			<li><a onclick="check_access('3','#')" href="#"><span class="stats_icon archives_sl"></span><span class="label">Report</span></a></li>
			<li class="dropdown-submenu dropdown">
        <a class="test" tabindex="-1" href="#"><span class="stats_icon user_sl"></span><span class="label">Admin</span></a>
        <ul class="dropdown-menu" style="display:none">
          <li class="dropdown-submenu">
            <a class="test" href="#">User Management<span class="caret"></span></a>
            <ul class="dropdown-menu" style="display:none;">
                <li>					
					<a onclick="check_access('106','user');" href="#">Users</a>							
				</li>
				<li>
					<a onclick="check_access('107','role');" href="#">Role</a>
				</li>
				<li>
					<a onclick="return check_access('108','module');" href="#">Module</a>
				</li>
				<li>
					<a onclick="return check_access('109','access');" href="#">Access</a>
				</li>
            </ul>
          </li>
          <li><a tabindex="-1" href="#">Move Data</a></li>
          <li><a tabindex="-1" href="#">Active Account</a></li>
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
	
	<div id="content">
		<div class="grid_container">
		
		<div id="usertable" class="grid_12">
	
			<br>
			<div class="form_input">
				<button id="adduser" onclick="openAddUser()" name="btnadduser" type="button" class="btn_small btn_blue"><span>Add Module</span></button>
			</div>
		
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr style="text-align: left;">
                <th>id</th>
                <th>Building Number</th>
                <th>Jenisbangunan </th>
                <th>Jenis aras id</th>
                <th>Luastama NLFA</th>
            </tr>
        </thead>
    </table>

					</div>
				</div>
			</div>
				
	</div>
	<span class="clear"></span>
	
	
</div>
</body>
</html>