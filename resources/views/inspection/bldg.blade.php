<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>New Property</title>


@include('includes.header-popup')
	<div id="content">
		<div class="grid_container">

		<div class="grid_12 full_block">
       <div class="widget_wrap collapsible_widget form_container left_label">
                    <div class="widget_top active">
                      <span class="h_icon"></span>
                      <h6>General Information</h6>
                    </div>
                    <div class="widget_content">
                      @include('inspection.info')
                    </div>
                  </div>

</div>

                  <div class="grid_12 invoice_details">
                  <div class="widget_wrap collapsible_widget">
                    <div class="widget_top active">
                      <span class="h_icon"></span>
                      <h6>Building</h6>
                    </div>
                    <div class="widget_content">
                      <div class="invoice_tbl">
                        <table id="landtable">
                        <thead>
                        <tr class=" gray_sai">
                          <th>
                            Area Category
                          </th>
                          <th>
                            Area type

                          </th>
                          <th>
                            Area Level

                          </th>
                          <th>
                            Area Use

                          </th>                         
                          <th >
                            Area

                          </th>
                        </tr>
                        </thead>
                        <tbody>
                         
                       @foreach ($bldgardetail as $rec)   
                            <td>
                            {{$rec->arcate}}
                          </td>
                          <td>
                           {{$rec->artype}}

                          </td>
                          <td>
                            {{$rec->arlvel}}

                          </td>
                          <td>
                            {{$rec->aruse}}

                          </td>                         
                          <td >
                            {{$rec->aba_totsize}}

                          </td>
                        </tr>
         
      @endforeach
      
                        </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
 </div>
                  <div class="grid_12 invoice_details">
                  <div class="widget_wrap collapsible_widget">
                    <div class="widget_top active">
                      <span class="h_icon"></span>
                      <h6>Building Information</h6>
                    </div>
                    <div class="widget_content">
                      <div class="invoice_tbl">
                        <table id="bldgartable">
                        <thead>
                        <tr class=" gray_sai">
                          <th>
                            Area Category
                          </th>
                          <th>
                            Area type

                          </th>
                          <th>
                            Area Level

                          </th>
                          <th>
                            Area Use

                          </th>                         
                          <th>
                            Area
                          </th>
                          <th style="display: none">
                            Area Use

                          </th>                         
                          <th style="display: none">
                            Area
                          </th>
                        </tr>
                        </thead>
                        <tbody>
                           <tr>
                          <td>
                          LUAS ASAL

                          </td>
                          <td>
                            LUAS UTAMA

                          </td>
                                <td >
                                  <select data-placeholder="Choose a Status..." onchange="levelChange(1)" style="width:100%" class="cus-select" id="arlevel1" name="arlevel" tabindex="1">
                            
                                        @foreach ($arlvl as $rec)
                                            <option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
                                        @endforeach 
                                  </select>  
                                </td>
                                <td class="category">
                                

                                </td>
                                <td  class="area">
                                   <input type="text" value="0" style="text-align:right;" onchange="areaChange(1)" id="area1">
                                </td>
                                <td id="harlevel1" style="display: none">
                                 
0
                                </td>                         
                                <td id="harea1" style="display: none">
                                 0
                                </td>
                        
                          </tr>
                           
                           <tr>
                          <td>
                           LUAS ASAL

                          </td>
                          <td>
                            LUAS SOKONGAN

                          </td>
                                <td >
                                  <select data-placeholder="Choose a Status..." style="width:100%" onchange="levelChange(2)" class="cus-select" id="arlevel2" name="arlevel" tabindex="1">
                            
                                        @foreach ($arlvl as $rec)
                                            <option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
                                        @endforeach 
                                  </select>  
                                </td>
                                <td class="category">
                                

                                </td>
                                <td  class="area">
                                   <input type="text" value="0" style="text-align:right;" onchange="areaChange(2)" id="area2">
                                </td>
                                <td id="harlevel2" style="display: none">
                                 0
                                </td>                         
                                <td id="harea2" style="display: none">
                                  0
                                </td>
                        
                          </tr>
                           <tr>
                          <td>
                           LUAS TAMBAHAN

                          </td>
                          <td>
                            LUAS UTAMA

                          </td>
                                <td >
                                  <select data-placeholder="Choose a Status..." style="width:100%" onchange="levelChange(3)" class="cus-select" id="arlevel3" name="arlevel" tabindex="1">
                            
                                        @foreach ($arlvl as $rec)
                                            <option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
                                        @endforeach 
                                  </select>  
                                </td>
                                <td class="category">
                                

                                </td>
                                <td  class="area">
                                   <input type="text" value="0" style="text-align:right;" onchange="areaChange(3)" id="area3">
                                </td>
                                <td id="harlevel3" style="display: none">
                                 0
                                </td>                         
                                <td id="harea3" style="display: none">
                                  0
                                </td>
                        
                          </tr>
                           <tr>
                          <td>
                           LUAS TAMBAHAN

                          </td>
                          <td>
                            LUAS SOKONGAN

                          </td>
                                <td >
                                  <select data-placeholder="Choose a Status..." style="width:100%" onchange="levelChange(4)" class="cus-select" id="arlevel4" name="arlevel" tabindex="1">
                            
                                        @foreach ($arlvl as $rec)
                                            <option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
                                        @endforeach 
                                  </select>  
                                </td>
                                <td class="category">
                                

                                </td>
                                <td  class="area">
                                   <input type="text" value="0" style="text-align:right;" onchange="areaChange(4)" id="area4">
                                </td>
                                <td id="harlevel4" style="display: none">
                                 0

                                </td>                         
                                <td id="harea4" style="display: none">
                                  0
                                </td>
                        
                          </tr>
                        </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
      </div>
	<div style="height: 48px; float: right; " class="grid_12">
                
                            <div class="form_input">
                             
                              <button id="addsubmit" name="adduser" style="float: right; "  onclick="updateValuation()" type="button" class="btn_small btn_blue"><span>Update</span></button>      
                               
                              <span class=" label_intro"></span>
                            </div>
                            
                            <span class="clear"></span>
                          </div>
	<span class="clear"></span>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#harlevel1').html($('#arlevel1').val());
    $('#harlevel2').html($('#arlevel2').val());
    $('#harlevel3').html($('#arlevel3').val());
    $('#harlevel4').html($('#arlevel4').val());

  });

     function levelChange(id){   
        $('#harlevel'+id).html($('#arlevel'+id).val());
      
     }

     function areaChange(id){   
        $('#harea'+id).html($('#area'+id).val());
       // alert($('#area'+id).val());
     }
   
    function updateValuation(){   

       let mapbldgareatable = new Map([["0","arcategory"],["1", "artype"],  ["2", "harlevel"], ["3", "aruse"], ["4", "harea"], ["5", "arlevel"], ["6", "area"]]);

       var bldgareadata = [];

      for (var i = 0;i<$('#bldgartable').DataTable().rows().count();i++){
        var ldata = $('#bldgartable').DataTable().row(i).data();
        var tempdata1 = {};
        $.each(ldata, function( key, value ) {
          if (key !== 2 && key !== 4) {
          tempdata1[mapbldgareatable.get(""+key+"")] = value; 
          }
        //console.log(key);            
            });
            //console.log(templotdata);;
            bldgareadata.push(tempdata1);             
      }
      bldgareadata = "["+ JSON.stringify(bldgareadata).replace(/]|[[]/g, '') +"]";
      $('#bldgartable_filter').remove();
        $('#bldgartable_info').remove();
        $('#bldgartable_paginate').remove();
        $('#bldgartablee_length').remove();
var prop_id = '{{$prop_id}}';
        var noty_id = noty({
          layout : 'center',
          text: 'Do want submit valuation?',
          modal : true,
          buttons: [
            {type: 'button pink', text: 'Submit', click: function($noty) {  
              console.log(bldgareadata);
                  $.ajax({
                        type: 'POST', 
                        url:'manualValuation2',
                        headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                          data:{bldgareadata:bldgareadata,prop_id:prop_id},
                          success:function(data){
                           // var api = $('#'+tableid).DataTable(); 
                             var api = window.opener.$("#proptble").DataTable();
                             var index = window.opener.$("#tableindex").val();
$( api.row( index ).nodes() ).css('background-color','#67DA83');
                        $('#finishloader').html('');
                            var noty_id = noty({
                          layout : 'top',
                          text: 'Update successfully!',
                          modal : true,
                          type : 'success', 
                        });     
                        
                          },
                          error:function(data){
                        //$('#loader').css('display','none');
                            $('#propertystatus').val('UnRegistered'); 
                            $('#finishloader').html('');      
                              var noty_id = noty({
                          layout : 'top',
                          text: 'Problem while update valuation!',
                          modal : true,
                          type : 'error', 
                        });
                          }
                      });

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
      
    }

</script>
</body>
</html>