<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>

<meta name="csrf-token" content="{{ csrf_token() }}">
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

	<!-- Section CSS -->
	<!-- jQuery UI (REQUIRED) -->
	<link rel="stylesheet" href="elfinder/jquery/jquery-ui-1.12.0.css" type="text/css">

	<!-- elfinder css -->
	<link rel="stylesheet" href="elfinder/css/commands.css"    type="text/css">
	<link rel="stylesheet" href="elfinder/css/common.css"      type="text/css">
	<link rel="stylesheet" href="elfinder/css/contextmenu.css" type="text/css">
	<link rel="stylesheet" href="elfinder/css/cwd.css"         type="text/css">
	<link rel="stylesheet" href="elfinder/css/dialog.css"      type="text/css">
	<link rel="stylesheet" href="elfinder/css/fonts.css"       type="text/css">
	<link rel="stylesheet" href="elfinder/css/navbar.css"      type="text/css">
	<link rel="stylesheet" href="elfinder/css/places.css"      type="text/css">
	<link rel="stylesheet" href="elfinder/css/quicklook.css"   type="text/css">
	<link rel="stylesheet" href="elfinder/css/statusbar.css"   type="text/css">
	<link rel="stylesheet" href="elfinder/css/theme.css"       type="text/css">
	<link rel="stylesheet" href="elfinder/css/toast.css"       type="text/css">
	<link rel="stylesheet" href="elfinder/css/toolbar.css"     type="text/css">

	<!-- Section JavaScript -->
	<!-- jQuery and jQuery UI (REQUIRED) -->
	<script src="elfinder/jquery/jquery-1.12.4.js" type="text/javascript" charset="utf-8"></script>
	<script src="elfinder/jquery/jquery-ui-1.12.0.js" type="text/javascript" charset="utf-8"></script>

	<!-- elfinder core -->
	<script src="elfinder/js/elFinder.js"></script>
	<script src="elfinder/js/elFinder.version.js"></script>
	<script src="elfinder/js/jquery.elfinder.js"></script>
	<script src="elfinder/js/elFinder.mimetypes.js"></script>
	<script src="elfinder/js/elFinder.options.js"></script>
	<script src="elfinder/js/elFinder.options.netmount.js"></script>
	<script src="elfinder/js/elFinder.history.js"></script>
	<script src="elfinder/js/elFinder.command.js"></script>
	<script src="elfinder/js/elFinder.resources.js"></script>
<script src="js/jquery.simplemodal.js"></script>

	<!-- elfinder dialog -->
	<script src="elfinder/js/jquery.dialogelfinder.js"></script>

	<!-- elfinder default lang -->
	<script src="elfinder/js/i18n/elfinder.en.js"></script>

	<!-- elfinder ui -->
	<script src="elfinder/js/ui/button.js"></script>
	<script src="elfinder/js/ui/contextmenu.js"></script>
	<script src="elfinder/js/ui/cwd.js"></script>
	<script src="elfinder/js/ui/dialog.js"></script>
	<script src="elfinder/js/ui/fullscreenbutton.js"></script>
	<script src="elfinder/js/ui/navbar.js"></script>
	<script src="elfinder/js/ui/navdock.js"></script>
	<script src="elfinder/js/ui/overlay.js"></script>
	<script src="elfinder/js/ui/panel.js"></script>
	<script src="elfinder/js/ui/path.js"></script>
	<script src="elfinder/js/ui/places.js"></script>
	<script src="elfinder/js/ui/searchbutton.js"></script>
	<script src="elfinder/js/ui/sortbutton.js"></script>
	<script src="elfinder/js/ui/stat.js"></script>
	<script src="elfinder/js/ui/toast.js"></script>
	<script src="elfinder/js/ui/toolbar.js"></script>
	<script src="elfinder/js/ui/tree.js"></script>
	<script src="elfinder/js/ui/uploadButton.js"></script>
	<script src="elfinder/js/ui/viewbutton.js"></script>
	<script src="elfinder/js/ui/workzone.js"></script>

	<!-- elfinder commands -->
	<script src="elfinder/js/commands/archive.js"></script>
	<script src="elfinder/js/commands/back.js"></script>
	<script src="elfinder/js/commands/chmod.js"></script>
	<script src="elfinder/js/commands/colwidth.js"></script>
	<script src="elfinder/js/commands/copy.js"></script>
	<script src="elfinder/js/commands/cut.js"></script>
	<script src="elfinder/js/commands/download.js"></script>
	<script src="elfinder/js/commands/duplicate.js"></script>
	<script src="elfinder/js/commands/edit.js"></script>
	<script src="elfinder/js/commands/empty.js"></script>
	<script src="elfinder/js/commands/extract.js"></script>
	<script src="elfinder/js/commands/forward.js"></script>
	<script src="elfinder/js/commands/fullscreen.js"></script>
	<script src="elfinder/js/commands/getfile.js"></script>
	<script src="elfinder/js/commands/help.js"></script>
	<script src="elfinder/js/commands/hidden.js"></script>
	<script src="elfinder/js/commands/hide.js"></script>
	<script src="elfinder/js/commands/home.js"></script>
	<script src="elfinder/js/commands/info.js"></script>
	<script src="elfinder/js/commands/mkdir.js"></script>
	<script src="elfinder/js/commands/mkfile.js"></script>
	<script src="elfinder/js/commands/netmount.js"></script>
	<script src="elfinder/js/commands/open.js"></script>
	<script src="elfinder/js/commands/opendir.js"></script>
	<script src="elfinder/js/commands/opennew.js"></script>
	<script src="elfinder/js/commands/paste.js"></script>
	<script src="elfinder/js/commands/places.js"></script>
	<script src="elfinder/js/commands/preference.js"></script>
	<script src="elfinder/js/commands/quicklook.js"></script>
	<script src="elfinder/js/commands/quicklook.plugins.js"></script>
	<script src="elfinder/js/commands/reload.js"></script>
	<script src="elfinder/js/commands/rename.js"></script>
	<script src="elfinder/js/commands/resize.js"></script>
	<script src="elfinder/js/commands/restore.js"></script>
	<script src="elfinder/js/commands/rm.js"></script>
	<script src="elfinder/js/commands/search.js"></script>
	<script src="elfinder/js/commands/selectall.js"></script>
	<script src="elfinder/js/commands/selectinvert.js"></script>
	<script src="elfinder/js/commands/selectnone.js"></script>
	<script src="elfinder/js/commands/sort.js"></script>
	<script src="elfinder/js/commands/undo.js"></script>
	<script src="elfinder/js/commands/up.js"></script>
	<script src="elfinder/js/commands/upload.js"></script>
	<script src="elfinder/js/commands/view.js"></script>

	<!-- elfinder 1.x connector API support (OPTIONAL) -->
	<script src="elfinder/js/proxy/elFinderSupportVer1.js"></script>

	<!-- Extra contents editors (OPTIONAL) -->
	<script src="elfinder/js/extras/editors.default.js"></script>

	<!-- GoogleDocs Quicklook plugin for GoogleDrive Volume (OPTIONAL) -->
	<script src="elfinder/js/extras/quicklook.googledocs.js"></script>

	<!-- elfinder initialization  -->
	<script>

		function initelfinder(){

			$('#elfinder').elfinder(
				// 1st Arg - options
				{
					// Disable CSS auto loading
					cssAutoLoad : false,

					// Base URL to css/*, js/*
					baseUrl : './',
					
					// Connector URL
					//url : 'php/connector.minimal.php?host=localhost&username=root&password=',
					url  : 'http://{{$serverhost}}/FileServer/connector.minimal.php',

					// Callback when a file is double-clicked
					getFileCallback : function(file) {
						// ...
					},
				},
				
				// 2nd Arg - before boot up function
				function(fm, extraObj) {
					// `init` event callback function
					fm.bind('init', function() {
						// Optional for Japanese decoder "extras/encoding-japanese.min"
						delete fm.options.rawStringDecoder;
						if (fm.lang === 'ja') {
							fm.loadScript(
								[ fm.baseUrl + 'js/extras/encoding-japanese.min.js' ],
								function() {
									if (window.Encoding && Encoding.convert) {
										fm.options.rawStringDecoder = function(s) {
											return Encoding.convert(s,{to:'UNICODE',type:'string'});
										};
									}
								},
								{ loadType: 'tag' }
							);
						}
					});

					// Optional for set document.title dynamically.
					var title = document.title;

					fm.bind('add', function(event) {
						var added_data = event.data.added;
						var data_removed = event.data.removed;
						var type = "ADD";
						data_removed = JSON.stringify(data_removed);
						added_data =  JSON.stringify(added_data).replace(/]|[[]/g, '');
						//console.log(event.data);
						//console.log(event.data.removed);
						//console.log(added_data);
						$.ajax({
			  				type: 'POST', 
						    url:'filemanagertrn',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{data:added_data,data_removed:data_removed,type:type},
					        success:function(data){
					        	
				        	},
					        error:function(data){
								
				        	}
				    	});
						
					});

					fm.bind('remove', function(event) {
						console.log(fm);
						var currentReqCmd = fm.currentReqCmd;
						if (currentReqCmd === "rm"){
						
						var added_data = '';
						var data_removed = event.data.removed;
						var type = "REMOVE";
						//added_data
						added_data =  JSON.stringify(added_data);
						data_removed = JSON.stringify(data_removed);
						
						//console.log(event.data);
						$.ajax({
			  				type: 'POST', 
						    url:'filemanagertrn',
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
					        data:{data:added_data,data_removed:data_removed,type:type},
					        success:function(data){
					        	
				        	},
					        error:function(data){
								
				        	}
				    	});
						}
					});
				}
			);

		}



		$(function() {
		//	console.log('http://{{$serverhost}}:8002/FileServer/connector.minimal.php');
			initelfinder();
		});
	</script>
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
			<li><a style="" href="dashboard"><span class="stats_icon dashboard"></span><span class="label">Home</span></a></li>
			<li class="dropdown-submenu dropdown"><a style="" class="test" tabindex="-1" href="#"><span class="stats_icon data_enqury"></span><span class="label">Data Enquery</span></a>

				<ul class="dropdown-menu" style="display:none">
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;"  onclick="check_access('21','datasearch')" class="test" href="#">Property Search<span class="caret"></span></a>
			        </li>
			        
    			</ul>
			</li>
			<li class="dropdown-submenu dropdown"><a style="background-color: #95C9F5;" class="test" tabindex="-1" href="#"><span class="stats_icon data_maintance"></span><span class="label">Data Maintenance</span></a>
				<ul class="dropdown-menu" style="display:none">
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;"  onclick="check_access('31','codemaintenance')" class="test" href="#">Code Maintenance<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('32','propertybasket')" class="test" href="#">Property Registration<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('33','tenant')" class="test" href="#">Tenant Registration<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('34','ratepayer')" class="test" href="#">Ratepayer Registration<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('35','filemanager')" class="test" href="#">DMS<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('36','term')" class="test" href="#">Term Management<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('37','evidentmgmt')" class="test" href="#">Evident Management<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('39','plan')" class="test" href="#">Plan Registeration<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px; "  class="test" href="#">Property Owner Maintenance<span class="caret" style=""></span></a>
			            <ul class="dropdown-menu child" style="display:none;">
			                <li>					
								<a style="padding: 5px;width: 172px;" onclick="check_access('391','ownerregister');" href="#">Ownership Transfer Registration</a>							
							</li>
							<li>
								<a style="padding: 5px;width: 172px;" onclick="check_access('392','ownertransfer?page=1');" href="#">Ownership Transfer Process</a>
							</li>
							<li>
								<a style="padding: 5px;width: 172px;" onclick="check_access('393','ownertransfer?page=2');" href="#">Ownership Address Process</a>
							</li>
							<li>
								<a style="padding: 5px;width: 172px;" onclick="check_access('394','ownerlog');" href="#">Property Ownership Log</a>
							</li>
			            </ul>
		          	</li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px; "  class="test " href="#">Property Information Maintenance<span class="caret" style=""></span></a>
			            <ul class="dropdown-menu child" style="display:none;">
			                <li>					
								<a style="padding: 5px;width: 172px;" onclick="check_access('3101','propertyaddress');" href="#">Property Address and File No</a>							
							</li>
							<li>
								<a style="padding: 5px;width: 172px;" onclick="check_access('3102','propertylot');" href="#">Property No Lot</a>
							</li>
			            </ul>
		          	</li>
    			</ul>
			</li>
			<li class="dropdown-submenu dropdown"><a style=""  href="#" class="test"><span class="stats_icon finished_work_sl"></span><span class="label">Tone of List</span></a>
				<ul class="dropdown-menu" style="display:none">
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;"  onclick="check_access('41','tonebasket')" class="test" href="#">Basket Management<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('42','ratebasket')" class="test" href="#">Rate Basket<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('43','tonebldg')" class="test" href="#">Building<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('44','toneland')" class="test" href="#">Land<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('45','toneallowance')" class="test" href="#">Allowance<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('46','tonedepreciation')" class="test" href="#">Depreciation<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('47','tonelandstandart')" class="test" href="#">Land Standard<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('48','taxrate')" class="test" href="#">Tax Rate<span class="caret"></span></a>
			        </li>
    			</ul>
			</li>
			<li class="dropdown-submenu dropdown"><a style=""  href="#" class="test"><span class="stats_icon finished_work_sl"></span><span class="label">Valuation Process</span></a>
				<ul class="dropdown-menu" style="display:none">
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;"  onclick="check_access('51','group')" class="test" href="#">Basket Management<span class="caret"></span></a>
			        </li>
			        <!--<li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('401','objection')" class="test" href="#">Approve Objection<span class="caret"></span></a>
			        </li>-->
		          	<li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('52','meeting')" class="test" href="#">Meeting<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('53','deactive')" class="test" href="#">Delete / Deactivate Property<span class="caret"></span></a>
			        </li>
    			</ul>
			</li>
			
			<li class="dropdown-submenu dropdown"><a style=""  href="#" class="test"><span class="stats_icon finished_work_sl"></span><span class="label">Report</span></a>
				<ul class="mainNav dropdown-menu" style="display:none">
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('61','inspectionform')" class="test" href="#">Inspection Form<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('62','valuationform')" class="test" href="#">Valuation Form<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;"  class="test" href="#">Valuation Data<span class="caret"></span></a>
			            <ul class="dropdown-menu child" style="display:none;">
			                <li>					
								<a style="padding: 5px;width: 172px;" onclick="check_access('631','valuationdata?page=1');" href="#">Valuation List By Basket</a>							
							</li>
							<li>
								<a style="padding: 5px;width: 172px;" onclick="check_access('632','valuationdata?page=2');" href="#">Valuation List By Term</a>
							</li>
							<li>
								<a style="padding: 5px;width: 172px;" onclick="check_access('633','valuationdata?page=3');" href="#">Valuation List By Active Term</a>
							</li>
			            </ul>
		          	</li>
		          	<li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;"  class="test" href="#">Statistical Report<span class="caret"></span></a>
			            <ul class="dropdown-menu child" style="display:none;">
			                <li>					
								<a style="padding: 5px;width: 172px;" onclick="check_access('714','subzonesummary');" href="#">Summary By Zone/Sub Zone</a>							
							</li>
							<li>
								<a style="padding: 5px;width: 172px;" onclick="check_access('714','zonebldgsummary');" href="#">Summary By Zon and Property Status vs Bulding Category</a>
							</li>
							<li>
								<a style="padding: 5px;width: 172px;" onclick="check_access('714','racesummary');" href="#">Summary By Property Status and Building Categori vs Race</a>
							</li>
			            </ul>
		          	</li>
		          	<li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;"  class="test" href="#">Collection Report<span class="caret"></span></a>
			            <ul class="dropdown-menu child" style="display:none;">
			                <li>					
								<a style="padding: 5px;width: 172px;" onclick="check_access('714','subzonecollection');" href="#">Summary By Zone/Sub Zone</a>							
							</li>
							<li>
								<a style="padding: 5px;width: 172px;" onclick="check_access('714','districtcollection');" href="#">Summary By District</a>
							</li>
							<li>
								<a style="padding: 5px;width: 172px;" onclick="check_access('714','bldgcollection');" href="#">Summary By Zon and Property Status vs Bulding Category</a>
							</li>
			            </ul>
		          	</li>

			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('714','exportexcel')" class="test" href="#">Export Excel<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('714','borangc')" class="test" href="#">Borang C<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="padding: 5px;width: 172px;" onclick="check_access('714','borangb')" class="test" href="#">Borang B<span class="caret"></span></a>
			        </li>
		          	
    			</ul>
			</li>
			<li class="dropdown-submenu dropdown">
       			 <a style="" class="test" tabindex="-1" href="#"><span class="stats_icon user_sl"></span><span class="label">Admin</span></a>
		        <ul class="dropdown-menu" style="display:none">
		          <li class="dropdown-submenu">
		            <a style="padding: 5px;width: 172px;"  class="test" href="#">Users Management<span class="caret"></span></a>
		            <ul class="dropdown-menu" style="display:none;">
		                <li>					
							<a style="padding: 5px;width: 172px;" onclick="check_access('711','user');" href="#">Users</a>							
						</li>
						<li>
							<a style="padding: 5px;width: 172px;" onclick="check_access('712','role');" href="#">Role</a>
						</li>
						<li>
							<a style="padding: 5px;width: 172px;" onclick="return check_access('713','module');" href="#">Module</a>
						</li>
						<li>
							<a style="padding: 5px;width: 172px;" onclick="return check_access('714','access');" href="#">Access</a>
						</li>
		            </ul>
		          </li>
		          <li><a style="padding: 5px;width: 172px;" tabindex="-1" href="#">Transfer Data</a></li>
		          <li><a style="padding: 5px;width: 172px;" tabindex="-1" href="#">Active Account</a></li>
		          <li><a style="padding: 5px;width: 172px;" tabindex="-1" onclick="return check_access('73','search');" href="#">Search Parameter Management</a></li>
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

			<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Data Maintenance</a></li>
						<li><a href="fmterm">DMS</a></li>
						<li>File Manager</li>
					</ul>
				</div>
				</div>
				
				<div style="float:right;margin-right: 10px;"  class="btn_24_blue">					
					@include('dms.search')
				</div>
			<!--<div class="form_input">
				<div id="breadCrumb3" class="breadCrumb grid_3">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Data Maintenance</a></li>
						<li><a href="fmterm">DMS</a></li>
						<li>File Manager</li>
					</ul>
				</div>
			</div>-->
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
