<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Simulation Function</title>
<style type="text/css">

#proptble td.numericCol {
	text-align: right;
}
	.right-text {
		text-align:right;
	}
	.tbl-total {
		text-align:right;
		float: inline-end;
	}
</style>
 
@include('includes.header', ['page' => 'report'])
					
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">	
					<br>
				<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_3">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Report</a></li>
						<li>Statistical Report</li>
					</ul>
				</div>
				</div>
				<div style="float:right;margin-right: 10px;"  class="btn_24_blue">				
					
					@include('report.pivotsearch',['tableid'=>'proptble', 'action' => 'statisticaltable', 'searchid' => 16])	
				</div>
        <br><br>
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="proptble" class="display select">


							<thead >
								<tr>
					                <th rowspan="2">ZONE</th>
					                <th rowspan="2">SUBZONE</th>
					                <th rowspan="2">BULIDING CATEGORY</th>
					                <th rowspan="2">BULIDING TYPE</th>
					                <th colspan="2">GENERAL</th>
					                <th colspan="2">INITIAL</th>
					                <th colspan="2">SUGGESTION 1</th>
					                <th colspan="2">SUGGESTION 2</th>
					            </tr>
								<tr>	
									<th>
										COUNT
									</th>	
									<th>
										NT (RM)
									</th>	
									<th style="width: 5%">
										RATE (%)
									</th>	
									<th style="width: 10%">
										TAX (RM)
									</th>	
									<th style="width: 5%">
										RATE (%)
									</th>	
									<th style="width: 10%">
										TAX (RM)
									</th>
									<th style="width: 5%">
										RATE (%)
									</th>	
									<th style="width: 10%">
										TAX (RM)
									</th>	
								</tr>
							</thead>
							<tbody>			
								
							</tbody><tfoot>
												<tr>
													<td colspan="4" class="grand_total">
														
														Grand Total:
													</td>
													<td id="count_total" class="numericCol">
														
													</td>
													<td id="nt_total" class="numericCol">
														
													</td>
													<td >
														
													</td>
													<td id="rm_total" class="numericCol">
														
													</td>
													<td >
														
													</td>
													<td id="rm1_total" class="numericCol">
														
													</td>
													<td >
														
													</td>
													<td id="rm2_total" class="numericCol">
														
													</td>
												</tr></tfoot>
						</table>
					</div>
				</div>
			</div>
			
		<!-- <form style="display: hidden;" id="generateform" method="GET" action="generateinspectionreport">
            @csrf
            <input type="hidden" name="accounts" id="accounts">
		</form>-->
		<input type="hidden" name="tax" id="tax">
		
	</div>
	<span class="clear"></span>
	
	<script>
function setValue(val){
	$('#tax').val(val);

}
$(document).ready(function (){
	var table = $('#proptble').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // computing column Total of the complete result 
            var countTotal = api
                .column(4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
				
	    var ntTotal = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
				
            var rmTotal = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
				
	     var rm1Total = api
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
				
	     var rm2Total = api
                .column( 11 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			
				
            // Update footer by showing the total with the reference of the column index 
	    //$( api.column( 0 ).footer() ).html('Total');
            $( api.column( 4 ).footer() ).html(countTotal);
            $( api.column( 5 ).footer() ).html(ntTotal);
            $( api.column( 7 ).footer() ).html(rmTotal);
            $( api.column( 9 ).footer() ).html(rm1Total);
            $( api.column( 11 ).footer() ).html(rm2Total);
        },
		        /*"dom": '<"toolbar">frtip',*/
				 /*
		        "ajax": {
		            "type": "GET",
		            "url": 'statisticaltable',
		            "contentType": 'application/json; charset=utf-8',
				    "headers": {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		        },*/
					
		        // ajax: '{{ url("statisticaltable") }}',
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
			        {"data": "Zone", "name": "account number"},
			        {"data": "subzone", "name": "fileno"},
			        {"data": "bldgcategory", "name": "zone"},
			        {"data": "bldgtype", "name": "subzone"},
			        {"data": "propcount", "name": "owner", "sClass": "numericCol"}, 
			        {"data": "vt_approvednt", "name": "ishasbldg", "sClass": "numericCol"},
			        {"data":  "vt_approvedrate", "name": "owntype", "sClass": "numericCol",                   
            "render": function ( data, type, row ) {
            	                return '<input class="edit" onchange="setValue(this.value)" style=" width: 100%;" autocomplete="off" tabindex="0" name="taxapprovedtax"  type="text"  value="'+data+'" class="right-text " />';
            }}, 
			        {"data":  "rm", "name": "TO_OWNNAME", "sClass": "numericCol"}, 
			        {"data":  "tax1", "name": "bldgcount",                   
            "render": function ( data, type, row ) {
            	                return '<input class="edit1" onchange="setValue(this.value)" style=" width: 100%;" autocomplete="off" tabindex="1" name="taxapprovedtax"  type="text" value="'+data+'"  maxlength="50" class="right-text " />';
            }},
			        {"data":  "dumm1", "name": "owntype", "sClass": "numericCol"}, 
			        {"data":  "tax2", "name": "TO_OWNNAME",                   
            "render": function ( data, type, row ) {
            	              return '<input class="edit2" onchange="setValue(this.value)" style=" width: 100%;" autocomplete="off" tabindex="2" name="taxapprovedtax"  type="text" value="'+data+'"  maxlength="50" class="right-text " />';
            }}, 
			        {"data":  "dumm2", "name": "bldgcount", "sClass": "numericCol"}

		   		],
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  	
			        //$("td:nth-child(2)", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
			        return nRow;
			    },
			    "sPaginationType": "full_numbers",
			"iDisplayLength": 100,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
		    'columnDefs': [{
         'targets': 0,
         'searchable': true,
         'orderable': false,
         'width': '1%',
         'className': 'dt-body-center'
      }],
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			});
   // Array holding selected row IDs
   var rows_selected = [];
   
    $('#proptble tbody').on('change', '.edit', function () {
        var row = table.row(table.row( $(this).parents('tr') ).index());
        var data = row.data();

        console.log(data);
        var nt =  data['vt_approvednt'];
        var tax=$('#tax').val();
        //var rate = $('#rate_'+rowid).val();
        var calucaterm =  (nt*tax)/100;
      // alert(nt);
       //console.log(data);
       // data['vt_approvednt'] = calucaterm;
        //data[8] = 'ss';
        data['rm'] = calucaterm;
        data['vt_approvedrate'] = tax;
       // data['dumm1'] = calucaterm;
        row.data(data);

            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // computing column Total of the complete result 
            var rmTotal = row
                .column(7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( row.column( 7 ).footer() ).html(rmTotal);
    });
   
    $('#proptble tbody').on('change', '.edit1', function () {
        var row = table.row(table.row( $(this).parents('tr') ).index());
        var data = row.data();

        console.log(data);
        var nt =  data['vt_approvednt'];
        var tax=$('#tax').val();
        //var rate = $('#rate_'+rowid).val();
        var calucaterm =  (nt*tax)/100;
      // alert(nt);
      // alert(calucaterm);
       // data['vt_approvednt'] = calucaterm;
        //data[8] = 'ss';
        data['dumm1'] = calucaterm;
        data['tax1'] = tax;
        //data['dumm1'] = calucaterm;
        row.data(data); 
 
            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // computing column Total of the complete result 
            var rm1Total = row
                .column(9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( row.column( 9 ).footer() ).html(rm1Total);

    });
   
    $('#proptble tbody').on('change', '.edit2', function () {
        var row = table.row(table.row( $(this).parents('tr') ).index());
        var data = row.data();

        // console.log(data);
        var nt =  data['vt_approvednt'];
        var tax=$('#tax').val();
        //var rate = $('#rate_'+rowid).val();
        var calucaterm =  (nt*tax)/100;
       
        data['dumm2'] = calucaterm;
        data['tax2'] = tax;
        row.data(data);

            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // computing column Total of the complete result 
            var rmTotal = row
                .column(11 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $( row.column( 11 ).footer() ).html(rmTotal);
    });

 


});


	</script>
</div>

</body>
</html>