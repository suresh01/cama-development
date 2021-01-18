<script>
function caltotsize(){
							var arcnt = $('#arcnt').val();
					var size = $('#size').val()
					
					var totalsize = arcnt * size;
					$('#totsize').val(totalsize);
						}

						$(document).ready(function() {
			var account = $('#accnumber').val();
			let bldgarmap = new Map([["0","sno"],["1", "bldgaccnum"],  ["2", "bldgnum"],["3", "reffinfo"], ["4", "artype"],["5", "arcate"], ["6", "arlevel"],["7", "arzone"], ["8", "aruse"],["9", "ardesc"], ["10", "dimention"],["11", "arcnt"],["12", "size"],["13", "uom"],["14", "totsize"],["15", "fltype"],["16","walltype"],["17", "celingtype"],["18", "action"],["19","actioncode"],["20","bldgarid"]]);
 		var blsgardata = [];
		 		@foreach ($bldgardetail as $rec)
		 			blsgardata.push( [ '{{$loop->iteration}}', '{{ $rec->ma_accno}}', '{{$rec->bl_bldg_no}}', '{{$rec->BA_REF}}', '{{$rec->BA_AREATYPE_ID}}', '{{$rec->BA_AREACATEGORY_ID}}', '{{$rec->BA_AREALEVEL_ID}}', '{{$rec->BA_AREAZONE_ID}}', '{{$rec->BA_AERAUSE_ID}}','{{$rec->BA_AREADESC}}',  '{{$rec->BA_DIMENTION}}', '{{$rec->BA_UNITCOUNT}}','{{$rec->BA_SIZE}}','{{$rec->BA_SIZEUNIT_ID}}',  '{{$rec->BA_TOTSIZE}}', '{{$rec->BA_FLOORTYPE_ID}}','{{$rec->BA_WALLTYPE_ID}}','{{$rec->BA_CEILINGTYPE_ID}}','<span><a onclick="" class="action-icons c-edit edtbldgarrow" href="#" title="Edit">Edit</a></span><span><a onclick="" class="action-icons c-delete  deletebldgarrow" href="#" title="delete">Delete</a></span>', 'noaction','{{$rec->BA_ID}}' ] );
		 		@endforeach

        $('#bldgartable1').DataTable({
            data:           blsgardata,
            "columns":[ null, null, null, null, { "visible": false }, { "visible": false}, { "visible": false}, { "visible": false }, { "visible": false}, null, { "visible": false }, { "visible": false}, null, { "visible": false}, null, { "visible": false }, { "visible": false }, { "visible": false }, null,{ "visible": false },{ "visible": false }],
            "sPaginationType": "full_numbers",
			"iDisplayLength": 5,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			 
		});
		$("div.table_top select").addClass('tbl_length');
		$(".tbl_length").chosen({
			disable_search_threshold: 4	
		});

        var table = $('#bldgartable1').DataTable();

		$('#bldgartable1 tbody').on( 'click', '.deletebldgarrow', function () {

			var row = table.row(table.row( $(this).parents('tr') ).index()),
			    data = row.data();
			    data[0]='Deleted';
				data[19]='delete';
				data[18]='';
			row.data(data);
		   // table.row($(this).parents('tr') ).remove().draw();
		});

		/*$('#lottble tbody').on( 'click', '.dellotrow', function () {
		    var child = table.row( $(this).parents('tr') ).child;
		 
		    if ( child.isShown() ) {
		        child.hide();
		    }
		    else {
		        child.show();
		    }
		});*/


		$('#bldgartable1 tbody').on( 'click', '.edtbldgarrow', function () {
			//var editlotdata = JSON.stringify(table.row( $(this).parents('tr') ).data());
			var ldata = table.row( $(this).parents('tr') ).data();
			
			var bldgardata = {};
			
			$.each( ldata, function( key, value ) {
				bldgardata[bldgarmap.get(""+key+"")] = value;              
            });

           

            //$('#bldgnumar').html();
            $("#bldgnumar option").remove();
            for (var k = 0;k<$('#bldgtble').DataTable().rows().count();k++){
					var ldata2 = $('#bldgtble').DataTable().row(k).data();
					var tempdata3 = {};
					$.each(ldata2, function( key, value ) {
						if (key === 1) {
							$('#bldgnumar').append($("<option/>", {
						        value: value,
						        text: value
						    }));				
					    }	           
	            	});            	
				}

				$.each( bldgardata, function( key, val ) {
					
            		$('#'+key).val(val);
            		if(key === 2){
            			$('#bldgnumar').val(val);
					}
				});
        	$("#bldgardetail1").show();
			$("#addbldgar").hide();
			$("#bldgareatable1").hide();
			$('#propertyregsitration_from-back-4').hide();
							$('#finish').hide();
            //console.log( table.row( $(this).parents('tr') ).index() );		
			//$('#lot_operation').val(2);
			 //$('#tableindex').val(table.row( $(this).parents('tr') ).index());  
			 //table.row( $(this).parents('tr') ).remove().draw();
			 $('#submitedittblbldgar').show();
			 $('#submitaddtblbldgar').hide();


		});

});

						$(document).ready(function() {
						    $("#bldgcate").change(function() {
						    	//console.log(this.value);
						    	var param_value = this.value;
						    	var param = 'bldgtype';
						        $.ajax({
								  url: "subCategory",
								  cache: false,
								  data:{param_value:param_value,param:param},
								  success: function(data){
						    		createDropDownOptions(data.res_arr, 'bldgttype');
						    		createDropDownOptions(data.res_arr2, 'bldgstorey');
								  }
								});
						    });
						});
						
						</script>