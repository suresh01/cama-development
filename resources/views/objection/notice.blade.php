<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title> {{__('objection.Notice')}} </title>

@include('includes.header', ['page' => 'VP'])
					
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">	
					<br>
				<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_4">
					<ul>
						<li><a href="#"> {{__('objection.Home')}} </a></li>
						<li><a href="#"> {{__('objection.Valuation_Process')}} </a></li>
						<li><a href="meeting"> {{__('objection.Meeting')}} </a></li>
						<li>{{$objectiondetail}}</li>
					</ul>
				</div>
				</div>
				
				<div style="float:right;margin-right: 10px;"  class="btn_24_blue">	
					<a href="#" onclick="deleteProperty2()" > {{__('objection.Rejection_Notice')}} </a>	
					<a href="#" onclick="deleteProperty3(1)" >Notice 141 A </a>	
					<a href="#" onclick="deleteProperty3(2)" >Notice 141 B</a>	
					<a href="#" onclick="deleteProperty3(3)" >Notice 144 A</a>	
					<a href="#" onclick="deleteProperty3(4)" >Notice 144 B</a>	

					<a href="#" onclick="openNotice()" >Add Notice</a>	

					@include('objection.search.newsearch',['tableid'=>'proptble', 'action' => 'noticeTables', 'searchid' => '31'])
				</div>
				<div style="float:right;margin-right: 20px;"  class="btn_24_orange">   
		            <!--<a href="#" id="" onclick="getSelectedProp()" class=""><span>Add Basket </span></a>  -->
		          	<a href="#" id="" onclick="deleteNotice()" title="Delete Selected"><span>{{__('common.Delete')}} </span></a> 
		        </div>
						<br>
				<div id="addDetail" style="display:none" class="grid_12">
					<div class="widget_wrap">
						
						<div class="widget_content">
							<h3 id="title">{{__('objection.Generate_Report')}}</h3>
							<form style="" id="generateform2" method="GET" action="generateNotis2">
					            @csrf
					            <input type="hidden" name="accounts" id="accounts">
								<div  class="grid_12 form_container left_label">
									<ul>
										<li>											
											<fieldset>
												<legend>{{__('objection.Additional_Information')}}</legend>
												
												<div class="form_grid_12">
													<label class="field_title" id="lposition" for="position">{{__('objection.Signature_Person')}}<span class="req">*</span></label>
													<div  class="form_input">
														<select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="inspector" tabindex="7" name="inspector" tabindex="20">
																<option></option>
															@foreach ($userlist as $rec)
																	<option value='{{ $rec->tbuser }}'>{{ $rec->tbuser }}</option>
															@endforeach	
														</select>
													</div>
													<span class=" label_intro"></span>
												</div>
												
												
											
											</fieldset>

					
										</li>
									</ul>
								</div>
								
								<div class="grid_12">							
									<div class="form_input">
										<button id="addsubmit" name="adduser" class="btn_small btn_blue"><span>{{__('common.Submit')}}</span></button>									
										
										<button id="close" name="close" type="button" class="btn_small btn_blue simplemodal-close"><span>{{__('common.Close')}}</span></button>
										<span class=" label_intro"></span>
									</div>								
									<span class="clear"></span>
								</div>
							</form>
						</div>
					</div>
				</div>
        
        
				<div class="widget_wrap tabby">
					<div class="widget_top">
						<div id="widget_tab">
							<ul>
								<li><a href="agenda?term={{$term}}&id={{$id}}" >{{__('objection.Agenda')}}</a></li>
								<li><a href="notice?term={{$term}}&id={{$id}}" class="active_tab">{{__('objection.Existing_Notice')}}</a></li>
								<li><a href="objectionreport?term={{$term}}&id={{$id}}">{{__('objection.Objection')}}</a></li>
								<li><a href="decision?term={{$term}}&id={{$id}}">{{__('objection.Decision')}}</a></li>
								<li><a href="result?term={{$term}}&id={{$id}}">{{__('objection.Report')}}</a></li>
							</ul>
						</div>
					</div>
				<div class="social_activities">
					<div class="comments_s">
						<div class="block_label">
							{{__('objection.Agenda_Count')}}<span>@foreach ($agendacnt as $rec)
										{{$rec->agenda_count}}									
									@endforeach	</span>
						</div>
					</div>
					<div class="comments_s">
						<div class="block_label">
							{{__('objection.Property_Count')}}<span>@foreach ($propcnt as $rec)
										{{$rec->property_count}}
									@endforeach	</span>
						</div>
					</div>
					<div class="views_s">
						<div class="block_label">
							{{__('objection.Notice_Count')}}<span>@foreach ($notiscnt as $rec)
										{{$rec->notis_count}}
									@endforeach	</span>
						</div>
					</div>
					<div class="comments_s">
						<div class="block_label">
							{{__('objection.Objection_Count')}}<span>@foreach ($objectioncnt as $rec)
										{{$rec->objection_count}}
									@endforeach	</span>
						</div>
					</div>
				</div>
								</br>	
					<div class="widget_content">						
						<table id="proptble" class="display select">
							<thead style="text-align: left;">
								<tr>
									<th><input name="select_all" value="1" type="checkbox"></th>
									<th class="table_sno">
										 {{__('objection.SNO')}}
									</th>
									<th>
										 {{__('objection.Account_number')}}
									</th>
									<th>
										 {{__('objection.Term')}}
									</th>
									<th>
										 {{__('objection.Basket_Name')}}
									</th>
									<th>
										 {{__('objection.Meeting_Description')}}
									</th>
									<th>
										 {{__('objection.List_Year')}}
									</th>		
								</tr>
							</thead>
							<tbody>			
								
							</tbody>
						</table>
            <div><p id="info">0 {{__('objection.Row_Selected')}}</p></div>
					</div>
				</div>
			</div>
				
		 <form style="display: hidden;" id="generateform" method="GET" action="generateNotis">
            @csrf
            <input type="hidden" name="accounts" id="accounts2">
            <input type="hidden" name="type" id="nottype">
		</form>
		
		
	</div>
	<span class="clear"></span>
	
	<script>

		 function submitForm(){
		    //console.log($("#filterForm").serialize());


		    var table = $('#proptble').DataTable();
		    table.clear();

		    var date = new Date();
		    var timestamp = date.getTime();
		    
		    var table = $('#proptble').DataTable();

		    $('#searchLoader').attr('style','display:block');

		    xhr = $.ajax({
		            url: 'noticeTables?id={{$id}}&test=manual&ts_='+timestamp,
		            type: 'GET',
		            data: $("#filterForm").serialize()
		        }).done(function (result) {
		          if(result.recordsTotal == 0) {
		            alert('No records found');
		          }
		          $('#searchLoader').attr('style','display:none');
		          table.rows.add(result.data).draw();
		    
		        }).fail(function (jqXHR, textStatus, errorThrown) {              
		            console.log(errorThrown);        
		            alert(errorThrown);
		      		$('#searchLoader').attr('style','display:none');
		          
		    
		        });

		     
		  }

		function openNotice(){
			var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=no,statusbar=0,menubar=0,resizable=0,width=0,height=0,left = 312,top = 234');
		    if (w.closed || (!w.document.URL) || (w.document.URL.indexOf("about") == 0)) {
		        w.location = "getnotice?type=1&term={{$term}}&id={{$id}}";
		    }	    
		    if (w.outerWidth < screen.availWidth || w.outerHeight < screen.availHeight)
			{
				w.moveTo(0,0);
				w.resizeTo(screen.availWidth, screen.availHeight);
			}
		}

		function changeField(val){
			if(val == 'table'){
				$('#maxrow').removeAttr('style');
			} else {
				$('#maxrow').attr('style', "display:none;");
			}
		}

function deleteProperty2(){
	var table = $('#proptble').DataTable();
//console.log(table.rows('.selected').data());
			var account = $.map(table.rows('.selected').data(), function (item) {
				//console.log(item);
	        	return item['no_vd_id']
	   		});
			var type = "delete";
			$('#accounts').val(account.toString());
			$('#addDetail').modal();
			console.log(account.toString());
}
		function deleteProperty3(notype){
			var table = $('#proptble').DataTable();
//console.log(table.rows('.selected').data());
			var account = $.map(table.rows('.selected').data(), function (item) {
				//console.log(item);
	        	return item['no_vd_id']
	   		});
			//var type = "delete";
			//$('#accounts').val(account.toString());
			//$('#addDetail').modal();
			console.log(account.toString());
			var noty_id = noty({
				layout : 'center',
				text: 'Are want to Generate Report?',
				modal : true,
				buttons: [
					{type: 'button pink', text: 'Generate', click: function($noty) {
						$noty.close();
						$('#accounts2').val(account.toString());
						$('#nottype').val(notype);
						$('#generateform').submit();
					/*	$.ajax({
					        type:'GET',
					        url:'generateinspectionreport',
					        data:{accounts:account.toString(),type:type,id:'id'},
					        success:function(data){
					        	
								//location.reload();				        		
					        	//$("#finish").attr("disabled", true);
					        	//clearTableError(4);
				        	},
					        error:function(data){
								//$('#loader').css('display','none');	
					        	   	
					        		var noty_id = noty({
									layout : 'top',
									text: 'Report Not generated!',
									modal : true,
									type : 'error', 
								});
				        	}
						});*/
					  }
					},
					{type: 'button blue', text: 'Cancel', click: function($noty) {
						$noty.close();
					  }
					}
					],
				 type : 'success', 
			 });
			
		}
	

		


		function updateDataTableSelectAllCtrl(table){
		   var $table             = table.table().node();
		   var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
		   var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
		   var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

			   // If none of the checkboxes are checked
		   if($chkbox_checked.length === 0){
		      chkbox_select_all.checked = false;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = false;
		      }

		   // If all of the checkboxes are checked
		   } else if ($chkbox_checked.length === $chkbox_all.length){
		      chkbox_select_all.checked = true;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = false;
		      }

		   // If some of the checkboxes are checked
		   } else {
		      chkbox_select_all.checked = true;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = true;
		      }
		   }
	$('#info').html(selectedrow() + " Row Selected");
}

function selectedrow(){
  var table = $('#proptble').DataTable();
  var count = 0;
  $.map(table.rows('.selected').data(), function (item) {
       count++;
    });
  return count;
}

$(document).ready(function (){
	var table = $('#proptble').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				 "ajax": {
		            "type": "GET",
		            "url": 'noticeTables?type=1&id={{$id}}',
		            "contentType": 'application/json; charset=utf-8',
				    "headers": {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		        },
		        // ajax: '{{ url("noticeTables") }}',
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
			        {"data": "no_id", "orderable": false, "searchable": false, "name":"_id" },
			        {"data": null, "name": "sno"},
			        {"data": "no_accno", "name": "account number"},
			        {"data": "vt_name", "name": "term"},
			        {"data": "va_name", "name": "basket"},
			        {"data": "ob_desc", "name": "fileno"},
			        {"data": "ob_listyear", "name": "zone"}
		   		],
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  	
			        $("td:nth-child(2)", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
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
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox">';
         }
      }],
      'rowCallback': function(row, data, dataIndex){
         // Get row ID
         var rowId = data[0];

         // If row ID is in the list of selected row IDs
         if($.inArray(rowId, rows_selected) !== -1){
            $(row).find('input[type="checkbox"]').prop('checked', true);
            $(row).addClass('selected');
         }
      },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			});
   // Array holding selected row IDs
   var rows_selected = [];
   
    
   

   // Handle click on checkbox
   $('#proptble tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = $('#proptble').DataTable().row($row).data();

      // Get row ID
      var rowId = data[0];

      // Determine whether row ID is in the list of selected row IDs
      var index = $.inArray(rowId, rows_selected);

      // If checkbox is checked and row ID is not in list of selected row IDs
      if(this.checked && index === -1){
         rows_selected.push(rowId);

      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
      } else if (!this.checked && index !== -1){
         rows_selected.splice(index, 1);
      }

      if(this.checked){
         $row.addClass('selected');
      } else {
         $row.removeClass('selected');
      }

      // Update state of "Select all" control
      updateDataTableSelectAllCtrl($('#proptble').DataTable());

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', $('#proptble').DataTable().table().container()).on('click', function(e){
     if(this.checked){
        $('#proptble tbody input[type="checkbox"]').prop('checked', true);
         $('#proptble tbody tr').addClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      } else {
         $('#proptble tbody input[type="checkbox"]').prop('checked', false);
         $('#proptble tbody tr').removeClass('selected');
         $('#info').html(selectedrow() + " Row Selected");
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle table draw event
   $('#proptble').DataTable().on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl($('#proptble').DataTable());
   });
   // Handle form submission event

});

	function deleteNotice() {
	    var table = $('#proptble').DataTable();
	       
	    var account = $.map(table.rows('.selected').data(), function (item) {
	     return item['no_id']
	    });
	    var acc_legth = account.length;
	    if (acc_legth > 0 ){
	      var noty_id = noty({
	          layout : 'center',
	          text: 'Are want to Delete?',
	          modal : true,
	          buttons: [
	            {type: 'button pink', text: 'Delete', click: function($noty) {
	              $noty.close();
	                
	                 var id= "{{$id}}";
	                  var type = "delete";
	                     $.ajax({
	                       type:'GET',
	                       url:'noticedetailtrn',
	                       data:{accounts:account,id:id,type:type},
	                       success:function(data){           
	                         // alert(data.newcount + " Property Deleted");
	                          window.location.assign('notice?term={{$term}}&id={{$id}}');
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
	      alert('Please select Atleast one Property to Delete');
	    }
	    
	   }


	</script>
</div>

</body>
</html>