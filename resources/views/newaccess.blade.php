<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Access</title>
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
<link href="css/tree.css" rel="stylesheet" type="text/css">

<link href="css/custom-nav.css" rel="stylesheet" type="text/css">

   
<!--<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
    
<style>
.dropdown-submenu .dropdown-menu {
    /**left: 100%;*/
}
.number_algin {
	text-align:right;
}

.mainNav li.has-child > a:after {
       color: #444;
       content: ' ▾';
    }
    .breadCrumb {
 background: none;

    	}   

</style>

<style type="text/css">
	
.glyphicon {
    height: 20px;
    width: 20px;
    display: inline-block;
    background: #fff url(../images/sprite-icons/icons-color.png) no-repeat;
    text-indent: -999999px;
    border: #ccc 1px solid;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    margin-left: 3px
}

.glyphicon-plus-sign:before{background: url('../images/sprite-icons/icons-color.png') no-repeat -262px -202px;
	width: 16px;
	height: 16px;}
.glyphicon-plus-sign{background: url('../images/sprite-icons/icons-color.png') no-repeat -262px -202px;
	width: 16px;
	height: 16px;}
.glyphicon-minus-sign:before{background: url('../images/sprite-icons/icons-color.png') no-repeat -242px -202px;
	width: 16px;
	height: 16px;}
.glyphicon-minus-sign{background: url('../images/sprite-icons/icons-color.png') no-repeat -242px -202px;
	width: 16px;
	height: 16px;}
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
<style type="text/css">
	.tree, .tree ul {
    margin:0;
    padding:0;
    list-style:none
}
.tree ul {
    margin-left:1em;
    position:relative
}
.tree ul ul {
    margin-left:.5em
}
.tree ul:before {
    content:"";
    display:block;
    width:0;
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    border-left:1px solid
}
.tree li {
    margin:0;
    padding:0 1em;
    line-height:2em;
    color:#369;
    font-weight:700;
    position:relative
}
.tree ul li:before {
    content:"";
    display:block;
    width:10px;
    height:0;
    border-top:1px solid;
    margin-top:-1px;
    position:absolute;
    top:1em;
    left:0
}
.tree ul li:last-child:before {
    background:#F5F5F5;
    height:auto;
    top:1em;
    bottom:0
}
.indicator {
    margin-right:5px;
}
.tree li a {
    text-decoration: none;
    color:#369;
}
.tree li button, .tree li button:active, .tree li button:focus {
    text-decoration: none;
    color:#369;
    border:none;
    background:transparent;
    margin:0px 0px 0px 0px;
    padding:0px 0px 0px 0px;
    outline: 0;
}
</style>
 <script src="js/tree/jquery.min.js"></script>
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
<!--<script src="js/data-table.jquery.js"></script>-->
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
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
$('.mainNav li:has(ul)').addClass('has-child');
		$('.dropdown-submenu a.test').on("click", function(e){		
		    //$('.dropdown-menu').hide();
			$(this).next('ul').toggle();
			e.stopPropagation();
			e.preventDefault();
		});

		
		$('.sub_test').click(function(event){			
		   $('.dropdown-menu').hide();
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

	function check_function_access(module){
		//var te = module;
		//alert();
		 var status = false;
			$.ajax({
		        type:'GET',
		        url:'/getaccess',
		        data:{module:module},
		        success:function(data){	        	
		        	if(data.msg === "false"){
		        		alert("You Don't have permission");
		        		//return "false";
		        	} else {
		        		//return "true";
		        		status = true;
		        	}
		        }
		    });
		return status;
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
	<div id="nav" class="stats_bar">		
		
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
			<li><a style="" href="dashboard"><span class="stats_icon dashboard"></span><span class="label">{{__('menu.home')}}</span></a></li>
			<li class="dropdown-submenu dropdown"><a style="" class="test" tabindex="-1" href="#"><span class="stats_icon data_enqury"></span><span class="label">{{__('menu.dataenquiry')}}</span></a>

				<ul class="dropdown-menu" style="display:none">
			        <li class="dropdown-submenu">
			            <a style=""  onclick="check_access('21','datasearch')" class="test" href="#">{{__('menu.propertysearch')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style=""  onclick="check_access('21','termsearch')" class="test" href="#">{{__('menu.termsearch')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('21','officialsearch')" class="test" href="#">{{__('menu.officialsearch')}}<span class="caret"></span></a>
			        </li>			        
    			</ul>
			</li>
			<li class="dropdown-submenu dropdown"><a style="    width: 100%;" class="test" tabindex="-1" href="#"><span class="stats_icon data_maintance"></span><span class="label">{{__('menu.datamaintenance')}}</span></a>
				<ul class="mainNav dropdown-menu" style="display:none">
			        <li style="" class="dropdown-submenu">
			            <a style=""  onclick="check_access('31','codemaintenance')" class="test" href="#">{{__('menu.codemaintenance')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('32','propertybasket')" class="test" href="#">{{__('menu.masterlistregister')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('32','existspropertybasket')" class="test" href="#">{{__('menu.masterlistmaintenance')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('33','tenant')" class="test" href="#">{{__('menu.tenantreg')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('34','ratepayer')" class="test" href="#">{{__('menu.ratepayerreg')}}<span class="caret"></span></a>
			        </li>
			       <!-- <li class="dropdown-submenu">
			            <a style="" onclick="check_access('35','filemanager')" class="test" href="#">{{__('menu.dms')}}<span class="caret"></span></a>
			        </li>-->
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('36','term')" class="test" href="#">{{__('menu.term')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('37','evidentmgmt')" class="test" href="#">{{__('menu.evident')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('38','plan')" class="test" href="#">{{__('menu.planreg')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style=""  class="test" href="#">{{__('menu.ownermaintenance')}}...<span class="caret" style=""></span></a>
			            <ul class="dropdown-menu child" style="display:none;">
							<li>
								<a style="" onclick="check_access('392','ownertransferapproval');" href="#">{{__('menu.transferapproval')}}</a>
							</li>
			                <li>					
								<a style="" onclick="check_access('391','ownerregister');" href="#">{{__('menu.transferreg')}}</a>							
							</li>
							<li>
								<a style="" onclick="check_access('392','ownertransfer?page=1');" href="#">{{__('menu.transferprocess')}}</a>
							</li>
							<li>
								<a style="" onclick="check_access('393','ownertransfer?page=2');" href="#">{{__('menu.addressprocess')}}</a>
							</li>
							<li>
								<a style="" onclick="check_access('394','ownerlog');" href="#">{{__('menu.transferlog')}}</a>
							</li>
			            </ul>
		          	</li>
			        <li class="dropdown-submenu">
			            <a style=""  class="test " href="#">{{__('menu.maintenanceprocess')}}...<span class="caret" style=""></span></a>
			            <ul class="dropdown-menu child" style="display:none;">
			                <li>					
								<a style="" onclick="check_access('3101','propertyaddress');" href="#">{{__('menu.propertyaddress')}}</a>							
							</li>
							<li>
								<a style="" onclick="check_access('3102','propertylot');" href="#">{{__('menu.propertylot')}}</a>
							</li>
							<li>
								<a style="" onclick="check_access('394','addresslog?page=1');" href="#">{{__('menu.maintenancelog')}}</a>
							</li>
							<li>
								<a style="" onclick="check_access('394','addresslog?page=2');" href="#">Property Lot Log</a>
							</li>
			            </ul>
		          	</li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('38','remisi')" class="test" href="#">Remisi<span class="caret"></span></a>
			        </li>
    			</ul>
			</li>
			<li class="dropdown-submenu dropdown"><a style=""  href="#" class="test"><span class="stats_icon finished_work_sl"></span><span class="label">{{__('menu.tol')}}</span></a>
				<ul class="dropdown-menu" style="display:none">
			        <li class="dropdown-submenu">
			            <a style=""  onclick="check_access('41','tonebasket')" class="test" href="#">{{__('menu.tolbasket')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('42','ratebasket')" class="test" href="#">{{__('menu.tolratebasket')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('43','tonebldg')" class="test" href="#">{{__('menu.tolbulding')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('44','toneland')" class="test" href="#">{{__('menu.tolland')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('45','toneallowance')" class="test" href="#">{{__('menu.tolallownace')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('46','tonedepreciation')" class="test" href="#">{{__('menu.toldepreciation')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('47','tonelandstandart')" class="test" href="#">{{__('menu.standardlandarea')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('48','taxrate')" class="test" href="#">{{__('menu.tolrate')}}<span class="caret"></span></a>
			        </li>
    			</ul>
			</li>
			<li class="dropdown-submenu dropdown"><a style=""  href="#" class="test"><span class="stats_icon finished_work_sl"></span><span class="label">{{__('menu.valuationprocess')}}</span></a>
				<ul class="dropdown-menu" style="display:none">
			        <li class="dropdown-submenu">
			            <a style=""  onclick="check_access('51','valterm')" class="test" href="#">{{__('menu.valuationmgmt')}}<span class="caret"></span></a>
			        </li>
			        <!--<li class="dropdown-submenu">
			            <a style="" onclick="check_access('401','objection')" class="test" href="#">Approve Objection<span class="caret"></span></a>
			        </li>-->
		          	<li class="dropdown-submenu">
			            <a style="" onclick="check_access('52','meeting')" class="test" href="#">{{__('menu.objection')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('53','deactive')" class="test" href="#">{{__('menu.defunct')}}<span class="caret"></span></a>
			        </li>
    			</ul>
			</li>
			<li class="dropdown-submenu dropdown"><a style=""  href="#" class="test"><span class="stats_icon finished_work_sl"></span><span class="label">{{__('menu.report')}}</span></a>
				<ul class="mainNav dropdown-menu" style="display:none">
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('61','inspectionform')" class="test" href="#">Inspection Form<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('62','valuationform')" class="test" href="#">Valuation Form<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style=""  class="test" href="#">Valuation Data...<span class="caret"></span></a>
			            <ul class="dropdown-menu child" style="display:none;">
			                <li>					
								<a style="" onclick="check_access('631','valuationdata?page=1');" href="#">Valuation List By Basket</a>							
							</li>
							<li>
								<a style="" onclick="check_access('632','valuationdata?page=2');" href="#">Valuation List By Term</a>
							</li>
							<li>
								<a style="" onclick="check_access('633','valuationdata?page=3');" href="#">Valuation List By Active Term</a>
							</li>
			            </ul>
		          	</li>
		          	<li class="dropdown-submenu">
			            <a style=""  class="test" href="#">Statistical Report...<span class="caret"></span></a>
			            <ul class="dropdown-menu child" style="display:none;">
			                <li>					
								<a style="" onclick="check_access('714','subzonesummary');" href="#">Summary By Zone/Sub Zone</a>							
							</li>
							<li>
								<a style="" onclick="check_access('714','zonebldgsummary');" href="#">Summary By Zon and Property Status vs Bulding Category</a>
							</li>
							<li>
								<a style="" onclick="check_access('714','racesummary');" href="#">Summary By Property Status and Building Categori vs Race</a>
							</li>
			            </ul>
		          	</li>
		          	<li class="dropdown-submenu">
			            <a style=""  class="test" href="#">Collection Report...<span class="caret"></span></a>
			            <ul class="dropdown-menu child" style="display:none;">
			                <li>					
								<a style="" onclick="check_access('714','subzonecollection');" href="#">Summary By Zone/Sub Zone</a>							
							</li>
							<li>
								<a style="" onclick="check_access('714','districtcollection');" href="#">Summary By District</a>
							</li>
							<li>
								<a style="" onclick="check_access('714','bldgcollection');" href="#">Summary By Zon and Property Status vs Bulding Category</a>
							</li>
			            </ul>
		          	</li>

			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('714','exportexcel')" class="test" href="#">Export Excel<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('714','borangc')" class="test" href="#">Borang C<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('714','borangb')" class="test" href="#">Borang B<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('714','statistical')" class="test" href="#">Simulation Function<span class="caret"></span></a>
			        </li>
		          	
    			</ul>
			</li>
			<li class="dropdown-submenu dropdown">
       			 <a style="background-color: #95C9F5" class="test" tabindex="-1" href="#"><span class="stats_icon user_sl"></span><span class="label">Admin</span></a>
		        <ul class="mainNav dropdown-menu" style="display:none">
		          <li class="dropdown-submenu">
		            <a style=""  class="test" href="#">Users Management...<span class="caret"></span></a>
		            <ul class="dropdown-menu child" style="display:none;">
		                <li>					
							<a style="" onclick="check_access('711','user');" href="#">Users</a>							
						</li>
						<li>
							<a style="" onclick="check_access('712','role');" href="#">Role</a>
						</li>
						<li>
							<a style="" onclick="return check_access('713','module');" href="#">Module</a>
						</li>
						<li>
							<a style="" onclick="return check_access('714','access');" href="#">Access</a>
						</li>
		            </ul>
		          </li>
		          <li><a style="" tabindex="-1" onclick="return check_access('73','search');" href="#">Search Parameter Management</a></li>
		        </ul>
      		</li>
		</ul>
	</div>
	
	
	<div id="content">
		<div class="grid_container">
			<br>
			
					<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
					<ul >
						<li><a href="#">Home</a></li>
						<li><a href="#">Admin</a></li>
						<li><a href="#">User Management</a></li>
						<li>Access</li>
					</ul>
				</div>
			</div>
			<br><br>
				<div class="widget_wrap">					
					<div class="widget_content">
			<div id="sidetree" class=" leftmenu grid_6 widget_wrap">

			  	<ul id="tree1"> 
		            @foreach($categories as $category)
		                <li>		
							<input type="hidden" id="ename_{{ $category->mod_id }}" value="{{ $category->mod_name }}">
					        <input type="hidden" id="eparent_{{ $category->mod_id }}" value="{{ $category->mod_parent }}">
							<input type="hidden" id="eroleid_{{ $category->mod_id }}" value="{{ $category->rol_id }}">
		                 	<a onclick="openEditRole({{ $category->mod_id }})" href="#">( {{$category->mod_id}} ) {{ $category->mod_name }}</a>
		                    @if(count($category->childs))
		                        @include('manageChild',['childs' => $category->childs])
		                    @endif
		                </li>
		            @endforeach
				</ul>
			</div>
		
		
		<div id="adduserform"  style="    position: fixed;
    ;" class="grid_6">
			<div class="widget_wrap">
				<div class="widget_top">
					<h6 id="lblmodulename"></h6>
				</div>
				<div class="widget_content">
					<!--<form id="signupform" onsubmit="return setRole()" autocomplete="off" method="post" action="accesstrn" class="form_container left_label">-->
					<div class="form_container left_label">
						<ul>
							<li>
							@csrf
							<input type="hidden" name="operation" id="operation">
							<input type="hidden"  name="module_id" id="module_id">
							<input type="hidden" name="s_role_id" id="s_role_id">
							<fieldset style="width: 30%;">
										<legend>Roles</legend>
										<ul>
											<li>
											<div id="rolelistHtm">
												@foreach ($role as $rec)
												<span class="grid_12">
												<input name="role_id" id="role_id_{{ $rec->rol_id }}" class="checkbox role_id"  type="checkbox" value="{{ $rec->rol_id }}" tabindex="7">
												<label class="choice">{{ $rec->rol_name }}</label>
												</span>
												<br /><br /><br />
												@endforeach
												
											</div>
											</li>
										</ul>
									</fieldset>
							</li>
							<li>
							<div class="form_grid_12">
								<div class="form_input">
									<button id="addsubmit" name="adduser" data-loading-text="Updating..." onclick="updateRoleAccess()" class="btn_small btn_blue"><span>Submit</span></button>									
									<!--<button id="reset" name="reset" onclick="clear()" type="button" class="btn_small btn_blue"><span>Reset</span></button>										
									<button id="close" onclick="closeAddUser()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>-->
								</div>
							</div>
							</li>
						</ul>
					</div>
					<!--</form>-->
				</div>
			</div>
		</div>
	</div></div>
	
	</div>
	<span class="clear"></span>
</div>
<script>

$.fn.extend({
    treed: function (o) {
      
      var openedClass = 'glyphicon-minus-sign';
      var closedClass = 'glyphicon-plus-sign';
      
      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };
      
        /* initialize each of the top levels */
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this);
            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });
        /* fire event from the dynamically added icon */
        tree.find('.branch .indicator').each(function(){
            $(this).on('click', function () {
                $(this).closest('li').click();

            });
        });
        /* fire event to open branch if the li contains an anchor instead of text */
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
               // $(this).closest('li').click();
                e.preventDefault();
            });
        });
        /* fire event to open branch if the li contains a button instead of text */
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});

/* Initialization of treeviews */

$(document).ready(function() {
    console.log( "ready!" );
    $('#tree1').treed();


});

function setCheck(){
	 var checked = $(this).is(":checked");
    if($(".role_id>input:checkbox").attr("checked",checked)){
      //alert('Checked Successfully');
      $(this).attr("css","checked");
    }
}

</script>
<script>

	function updateRoleAccess(){
		$("#addsubmit").prop('disabled', true);
		$("#addsubmit").text("Updating...");

		var role_arr = []; 
		var operation = $('#operation').val();
		var module_id = $('#module_id').val();

		

		@foreach ($role as $pop_rec)
			//alert(document.getElementById('#role_id_{{ $pop_rec->rol_id }}').checked);
		 // var value = $('#role_id_{{ $pop_rec->rol_id }}').find('.checked').find('#role_id_{{ $pop_rec->rol_id }}').val();
//console.log(value);``
		if (document.getElementById("role_id_{{ $pop_rec->rol_id }}").checked){

			role_arr.push(document.getElementById("role_id_{{ $pop_rec->rol_id }}").value);
		}
		  /*if (value != undefined) {
		  	role_arr.push(value);
		  }*/

		@endforeach	
//console.log(role_arr);
		$("#s_role_id").val(role_arr);
		
		var role_id = $("#s_role_id").val();
		
		$.ajax({
	        type:'POST',
	        url:'accesstrn',
	        data:{s_role_id:role_id,operation:operation,module_id:module_id,_token: '{{csrf_token()}}'},
	        success:function(data){	 
	        	$("#addsubmit").text("submit");
	        	var noty_id = noty({
						layout : 'top',
						text: 'Roles updated successfully!',
						modal : true,
						type : 'success', 
						 });    	
	        	$("#addsubmit").prop('disabled', false);
	        }
		});
	}

	function openAddUser(){
		$("#module_id").val("");
		$("#operation").val(1);
		 $("#usertable").hide(0);
		 $("#adduserform").show(0);
	}
	
	function clear(){
		@foreach ($role as $clear_rec)
			var rol_id='{{ $clear_rec->rol_id }}';
			$('#uniform-role_id_'+rol_id).find('span').attr("class", "");
		@endforeach
	}

	function addRoleHtm(){
		$('#rolelistHtm').html('');
		$('#rolelistHtm').html('@foreach ($role as $rec)'+
												'<span class="grid_12">'+
												'<input name="role_id" id="role_id_{{ $rec->rol_id }}" class="checkbox role_id"  type="checkbox" value="{{ $rec->rol_id }}" tabindex="7">'+
												'<label class="choice">{{ $rec->rol_name }}</label>'+
												'</span>'+
												'<br /><br /><br />'+
												'@endforeach');
	}

	function openEditRole(id){
		//alert($('#proleid_1').val();
		var name = "ename_"+id;
		var curmodule = name.substring(0, name.length - 1);
		addRoleHtm();
		//alert(name);
		//var lastmodulename =  $('#'+name).val();
		var modtext = $('#'+curmodule).val();
		if (modtext != undefined) {
			modtext = $('#'+curmodule).val() + " - " + $("#ename_"+id).val();
		} else {
			modtext = $("#ename_"+id).val();
		}
	
		$("#adduserform").show(0);
		var roleid = $("#eroleid_"+id).val();
		var parentid = $("#eparent_"+id).val();
		$("#module_id").val(id);
		$("#operation").val(1);
		$("#lblmodulename").html('');
		$("#lblmodulename").append("Module - "+modtext);		
		
		$("#s_role_id").val('');
		//$('.role_id').find('input:checkbox').attr('checked', false);
		@foreach ($role as $pop_rec)
			var rol_id='{{ $pop_rec->rol_id }}';
		document.getElementById("role_id_"+rol_id).removeAttribute("checked");
		$('#role_id_'+rol_id).find('span').attr("checked", "");
		@endforeach
		var role_list = "";
		$.ajax({
	        type:'GET',
	        url:'getaccessajax',
	        data:{module_id:id,_token: '{{csrf_token()}}'},
	        success:function(data){	 
	        	var char = data.roles.toString().split(",");  
	        	for (var i in char) {   
					var to_replace = $("#role_id_"+char[i]).find('span');
					//alert();
					//console.log(to_replace.prop('checked', true));
					to_replace.attr("class", "checked");
					document.getElementById("role_id_"+char[i]).setAttribute("checked", "checked");
					//$("#uniform-role_id_"+char[i]).attr("checked", "checked");
					var element = document.getElementById("role_id_"+char[i]);
  					element.classList.add("checked");
					//to_replace.attr("checked", "checked");

				//	to_replace.prop('checked', true);
				}
	        }
		});
		
		
		
				
	}

	function setRole(){
		var role_arr = []; 
		/*var role_arr = $('input:checkbox:checked.role_id').map(function () {
			return this.value; // $(this).val()
		}).get();*/

		@foreach ($role as $pop_rec)
			var rol_id='{{ $pop_rec->rol_id }}';
		  //$('#uniform-role_id_'+{{ $pop_rec->rol_id }}).find('span').attr("class", "");
		  var value = $('#uniform-role_id_'+rol_id).find('.checked').find('#role_id_'+rol_id).val();
		  if (value != undefined) {
		  	role_arr.push(value);
		  }
		@endforeach

		//alert(role_arr);
		$("#s_role_id").val(role_arr);
		//alert(role_arr);
		return true;
	}  


//to_replace.text("The new text");

	
		//alert(1);
            /*$.ajax({
               type:'POST',
               url:'getmsg',
               data:'_token = @csrf',
               success:function(data){
                  alert(data.msg);//$("#msg").html(data.msg);
               }
            });*/
        
	
</script>
</body>
</html>