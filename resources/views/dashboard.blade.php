<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Dashboard</title>

@include('includes.header', ['page' => 'dash'])
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
			<!--<table id="example" class="display" >
        <thead>
            <tr>
                <th>ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>ZIP / Post code</th>
                <th>Country</th>
            </tr>
        </thead>
    </table>-->
  

			<div id="usertable" class="grid_12" style="text-align: center;vertical-align: middle;margin-top: 100px;">
				<img src="images/logo.jpeg" >
			</div>
		</div>
		<span class="clear"></span>
    <!--<p>{{__('message.welcome')}}</p>-->
		<!--<div id="nav">
 <ul class="main-navigation">
  <li><a href="#">Home</a></li>
  <li><a href="#">Front End Design</a>
    <ul>
      <li><a href="#">HTML</a></li>
      <li><a href="#">CSS</a>
        <ul>
          <li><a href="#">Resets</a></li>
          <li><a href="#">Grids</a></li>
          <li><a href="#">Frameworks</a></li>
        </ul>
      </li>
      <li><a href="#">JavaScript</a>
        <ul>
          <li><a href="#">Ajax</a></li>
          <li><a href="#">jQuery</a></li>
        </ul>
      </li>
    </ul>
  </li>
  <li><a href="#">WordPress Development</a>
    <ul>
      <li><a href="#">Themes</a></li>
      <li><a href="#">Plugins</a></li>
      <li><a href="#">Custom Post Types</a>
        <ul>
          <li><a href="#">Portfolios</a></li>
          <li><a href="#">Testimonials</a></li>
        </ul>
      </li>
      <li><a href="#">Options</a></li>
    </ul>
  </li>
  <li><a href="#">About Us</a></li>
</ul>
</div>
</div>-->
<!--<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<!--<script type="text/javascript" src="https://cdn.datatables.net/scroller/1.5.1/js/dataTables.scroller.min.js"></script>-->
<!--<script>
    $(document).ready(function() {
        var data = [];
        @foreach ($module as $rec)
        data.push( [ '{{$loop->iteration}}', '{{$rec->mod_name}}', '{{$rec->mod_description}}', '{{$rec->mod_iscanselect}}', '{{$rec->mod_iscanselect}}' ] );
        @endforeach
        
         
        $('#example').DataTable( {
            data:           data,
            "sPaginationType": "full_numbers",
			"iDisplayLength": 10,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
			 "sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			 
		});
		$("div.table_top select").addClass('tbl_length');
		$(".tbl_length").chosen({
			disable_search_threshold: 4	
		});
		       
    });
    </script>-->
</body>
</html>