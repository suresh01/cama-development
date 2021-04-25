	            
								
								<button id="addtenant" onclick="addTenant()" name="btnadduser" type="button" class="btn_small btn_blue"><span>{{__('inspection.Add_Tenant')}}</span></button>

								<div id="tenanttable" class="widget_wrap">

									<div class="widget_content">						
										<table style="width:100%" id="tenanttble" class="display ">
										<thead style="text-align: left;">
								  		<tr>
											<th class="table_sno">{{__('inspection.SNo')}}</th>
											<th>{{__('inspection.Appln_Type')}} </th>
											<th>{{__('inspection.Tenant_Number_Name')}} </th>
											<th>{{__('inspection.Address1')}} </th>
											<th>{{__('inspection.Address2')}} </th>
											<th>{{__('inspection.Address3')}} </th>
											<th>{{__('inspection.Post_Code')}} </th>
											<th>{{__('inspection.State')}} </th>
											<th>{{__('inspection.Action')}} </th>
											<th>{{__('inspection.Actioncode')}} </th>
											<th>{{__('inspection.Tenantid')}} </th>
										</tr>
										</thead>
										<tbody>										
										</tbody>
										</table>
									</div>
								</div>
										
					<script type="text/javascript">

						 $(document).ready(function() {
						 	var account = $('#accnumber').val();
			
			
 		var tenantdata = [];
		@foreach ($tenant as $rec)
		 	tenantdata.push( [ '{{$loop->iteration}}', '{{ $rec->applntype }}', '{{ $rec->te_no }} / {{ $rec->te_name}}', '{{ $rec->te_addr_ln1 }}', '{{ $rec->te_addr_ln2 }}', '{{ $rec->te_addr_ln3 }}','{{ $rec->te_postcode }}','{{ $rec->state }}','<span><a class="action-icons c-Delete deletetenantrow"  href="#" title="Delete">Delete</a></span>','noaction','{{$rec->at_id}}'] );
		@endforeach

        $('#tenanttble').DataTable({
            data:           tenantdata,
            "columns":[ null, null, null,null,null,null,null,null,null,{visible:false},{visible:false}],
            "sPaginationType": "full_numbers",
			"iDisplayLength": 5,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			 
		});
		$("div.table_top select").addClass('tbl_length');
		$(".tbl_length").chosen({
			disable_search_threshold: 4	
		});

var table = $('#tenanttble').DataTable();
		$('#tenanttble tbody').on( 'click', '.deletetenantrow', function () {

			var row = table.row(table.row( $(this).parents('tr') ).index()),
			    data = row.data();
			    data[0]='Deleted';
				data[9]='delete';
				data[8]='';
				var noty_id = noty({
					layout : 'center',
					text: 'Are you want to delete?',
					modal : true,
					buttons: [
						{type: 'button pink', text: 'Delete', click: function($noty) {
					  			row.data(data);
								$noty.close();
						  	}
						},
						{type: 'button blue', text: 'Cancel', click: function($noty) {
								$noty.close();
						  	}
						}
						],
					type : 'success', 
			 	});
			
		   // table.row($(this).parents('tr') ).remove().draw();
		});


});


					</script>