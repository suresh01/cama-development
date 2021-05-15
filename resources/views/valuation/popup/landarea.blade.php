<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('valuation.Land_Detail')}} </title>
<style type="text/css">
  #landdetail td.numericCol {
    text-align: right;
  }
</style>
@include('includes.header-popup')
	 <div id="content">
    <div class="grid_container">
      <div class="grid_12">
        <div class="widget_wrap">
          <div class="widget_top">
            <h6>Valuation</h6>
          </div>
          <div class="widget_content">
            <div class=" page_content">
              <div class="invoice_container"> 
                
                <fieldset>
                  <legend>{{__('valuation.Land_Detail')}}</legend>             
                  @foreach ($lotdetail as $rec)
                  <div class="grid_3 invoice_to"> 
                    <strong><span>{{__('valuation.Code_Lot_No')}} : </span></strong>
                    <span>{{$rec->lotnumber}}</span>  
                  </div>
                  <div class="grid_3 invoice_to">   
                    <strong><span>{{__('valuation.Lot_Position')}}  : </span></strong>
                    <span>{{$rec->landposition}}</span>
                  </div>
                  <div class="grid_3 invoice_from">
                    <strong><span>{{__('valuation.Alternate_Lot_No')}}  : </span></strong>
                    <span>{{$rec->titlenumber}}</span>
                  </div>
                  <div class="grid_3 invoice_from">
                    <strong><span>{{__('valuation.Tenure_Type')}}  : </span></strong>
                    <span>{{$rec->tentype}}</span>
                  </div>
                  <br>  <br>  <br>
                  <div class="grid_3 invoice_from">
                    <strong><span>{{__('valuation.Land_Area')}}  : </span></strong>
                    <span>{{$rec->vl_size}}</span>
                  </div>
                  <div class="grid_3 invoice_from">
                    <strong><span>{{__('valuation.Tenure_Duration')}}  : </span></strong>
                    <span>{{$rec->duration}}</span>
                  </div>
               
            @endforeach
                <span class="clear"></span>
                <div class="grid_12 invoice_details">
                  
                      <div class="">
                        <table id="landdetail">
                        <thead>
                        <tr class=" gray_sai">
                          <th>  {{__('valuation.SNo')}} </th>
                          <th>  {{__('valuation.Area_Name')}} </th>
                          <th>  {{__('valuation.Area')}} </th>
                          <th>  {{__('valuation.Rate_smp')}} </th>
                          <th>  {{__('valuation.Discount_Rate')}} (%)</th>
                          <th>  {{__('valuation.Gross_Value')}} </th>                        
                          <th>  {{__('valuation.Rate')}} </th>
                          <th>  {{__('valuation.calucate_rate')}} </th>
                          <th>  {{__('valuation.lotareaid')}} </th>
                          <th>  {{__('valuation.lotid')}} </th>
                        </tr>
                        </thead>
                        <tbody>
                         
                        </tbody>
                        </table>
                      </div>
                      <div style="float:right;" class="grid_4 form_container left_label">
                    <ul>
                      <li>
                          <div class="form_grid_6">
                          <label class="field_title"  id="accnumberlbl" style="width: 100%;" for="username">{{__('valuation.Net_Land_Value')}}  <span class="req">*</span></label>
                        </div>
                        <div class="form_grid_6">
                          <div  class="form_input">
                          <input type="text" value="" onchange="testTable()" style="text-align:right;" id="netlandvalue">
                          </div>
                          <span class=" label_intro"></span>
                        </div>
                      </li>
                      <li>
                          <div class="form_grid_6">
                          <label class="field_title"  id="accnumberlbl" style="width: 100%;" for="username">{{__('valuation.Rounded_Value')}} <span class="req">*</span></label>
                        </div>
                        <div class="form_grid_6">
                          <div  class="form_input">
                          <input type="text" value="" style="text-align:right;" id="roundnetlandvalue">
                          </div>
                          <span class=" label_intro"></span>
                        </div>
                      </li>
                    </ul>
                  </div>                 
                </div>
                <div style="height: 48px; float: right; " class="grid_12">
                
                  <div class="form_input">
                    <button id="addsubmit" name="adduser" style="float: right; "  onclick="updateCalculation()" type="button" class="btn_small btn_blue"><span>{{__('common.Update')}}  </span></button>      
                              
                    <button id="close" name="close" type="button" onclick="closeWindow()"  class="btn_small btn_blue"><span>{{__('common.Close')}}  </span></button>
                    <span class=" label_intro"></span>
                  </div>
                  
                  <span class="clear"></span>
                </div>
                 </fieldset>
                <span class="clear"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <span class="clear"></span>
</div>
<script>
var parenrowid = 0;
$(document).ready(function(){
    var prmstr = window.location.search.split("=");
    parenrowid = prmstr[2];

    $('#landdetail').DataTable({
      "columns":[ null, null, null, null, null,  { className: "numericCol" }, { "visible": false }, { "visible": false }, { "visible": false}, { "visible": false}],
        "sPaginationType": "full_numbers",
        "iDisplayLength": 5,
        "lengthMenu": [5, 10, 15],
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

   // $('#landdetail_filter').remove();
    $('#landdetail_info').remove();
    //$('#landdetail_paginate').remove();
    //$('#landdetail_length').remove();

    //copy row from parent
    var lotareatable = window.opener.$("#hiddenlandarea").DataTable();
    var description, area, rate, calucatedrate, grossvalue, lotid, lotareaid;
    var totalgross = 0;
    //alert(lotareatable.rows().count());
    for (var i = 0;i<lotareatable.rows().count();i++){
          var ldata = lotareatable.row(i).data();
          if (ldata[6] == {{$id}}){
            rate = ldata[2];
            calucatedrate = ldata[3];
            grossvalue = ldata[4];
            var rowid = i+1;
             $('#landdetail').DataTable().row.add([ rowid,ldata[0], ldata[1], '<input type="text" class="editrate" style="text-align:right;" id="rate_'+rowid+'" value="'+rate+'" name="rate">', '<input type="text" style="text-align:right;" class="editcalrate" id="calucatedrate_'+rowid+'" value="'+calucatedrate+'" name="rate">', grossvalue,rate,calucatedrate,ldata[5], ldata[6] ]).draw( false );      
             
              totalgross = totalgross + Number(removeCommas(grossvalue));
          }
    }
     

    //lotareatable.draw();
    formatMoney('netlandvalue',totalgross);
    formatMoney('roundnetlandvalue',customround(totalgross,3));


    //Manual Rate Calculation
    var table = $('#landdetail').DataTable();
    $('#landdetail tbody').on('change', '.editrate', function () {
        var lrow = table.row(table.row( $(this).parents('tr') ).index());
        var ldata = lrow.data();
        var lrowid =  ldata[0];
        // console.log(data);
       /* var rowid =  data[0];
        var rate = $('#rate_'+rowid).val();
        var calucaterate =  $('#calucatedrate_'+rowid).val();
        var area =  data[2];
        //console.log(calucaterate);
        area = removeCommas(area);
        rate = removeCommas(rate);
        calucaterate = removeCommas(calucaterate);
    
        var gross = area * rate * (1 - (calucaterate / 100));
        data[3] = '<input type="text" class="editrate" style="text-align:right;" id="rate_'+rowid+'" value="'+rate+'" name="rate">';
        data[4] = '<input type="text" class="editcalrate"  style="text-align:right;" id="calucatedrate_'+rowid+'" value="'+calucaterate+'" name="rate">';
        data[5] = formatMoneyHas(gross);
        data[6] = rate;
        data[7] = calucaterate;
        row.data(data);*/

        for (var i = 0;i<table.rows().count();i++){
            var row = table.row(table.row(i).index());
            var data = table.row(i).data();
            //var id_val = i+1;
            var rowid =  data[0];
            var rate = $('#rate_'+lrowid).val();
            var calucaterate =  $('#calucatedrate_'+rowid).val();
            var area =  data[2];
            //console.log(calucaterate);
            area = removeCommas(area);
            rate = removeCommas(rate);
            calucaterate = removeCommas(calucaterate);
           // data[1]  = data[1];
            var gross = area * rate * (1 - (calucaterate / 100));
            data[3] = '<input type="text" class="editrate" style="text-align:right;" id="rate_'+rowid+'" value="'+rate+'" name="rate">';
            data[4] = '<input type="text" class="editcalrate"  style="text-align:right;" id="calucatedrate_'+rowid+'" value="'+calucaterate+'" name="rate">';
            data[5] = formatMoneyHas(gross);
            data[6] = rate;
            data[7] = calucaterate;
            row.data(data);
            //totalgross = totalgross + Number(removeCommas(grossvalue));
         
        }

        var grossland = 0;
        for (var j= 0;j<$('#landdetail').DataTable().rows().count();j++){
          var ldata = $('#landdetail').DataTable().row(j).data();
          
          grossland = grossland + Number(removeCommas(ldata[5]));
                  
        }
        formatMoney('netlandvalue',grossland);
        formatMoney('roundnetlandvalue',customround(grossland,1));
    });

    //Manual Calculated Rate Calculation
    $('#landdetail tbody').on( 'change', '.editcalrate', function () {

        var row = table.row(table.row( $(this).parents('tr') ).index());
        var data = row.data();

        // console.log(data);
        var rowid =  data[0];
        var rate = $('#rate_'+rowid).val();
        var calucaterate =  $('#calucatedrate_'+rowid).val();
        var area =  data[2];
       // console.log(calucaterate);
        area = removeCommas(area);
        rate = removeCommas(rate);
        calucaterate = removeCommas(calucaterate);
        
        
        var gross = area * rate * (calucaterate / 100);
        //console.log(gross);
        data[3] = '<input type="text" class="editrate" style="text-align:right;" id="rate_'+rowid+'" value="'+rate+'" name="rate">';
        data[4] = '<input type="text" class="editcalrate"  style="text-align:right;" id="calucatedrate_'+rowid+'" value="'+calucaterate+'" name="rate">';
        data[5] = formatMoneyHas(gross);
        data[6] = rate;
        data[7] = calucaterate;
        row.data(data);

        var grossland = 0;
        for (var j= 0;j<$('#landdetail').DataTable().rows().count();j++){
          var ldata = $('#landdetail').DataTable().row(j).data();
          console.log(grossland);
          console.log(ldata[5]);
          grossland = grossland + Number(removeCommas(ldata[5]));
                     
        }
        console.log(grossland);
        
        formatMoney('netlandvalue',grossland);
        formatMoney('roundnetlandvalue',customround(grossland,1));
        //$('#netlandvalue').val(formatMoneyHas(grossland));
        // $('#roundnetlandvalue').val(formatMoneyHas(grossland));
        // table.row($(this).parents('tr') ).remove().draw();
    });

});

function updateCalculation(){

    var gross = $('#roundnetlandvalue').val();
    
    var lotareatable = window.opener.$("#hiddenlandarea").DataTable();
    
    for (var l = 0;l < lotareatable.rows().count() ;l++){
        var ldata = lotareatable.row(l).data();
        
        if (ldata[6] == {{$id}}) {
            var row = window.opener.$("#hiddenlandarea").DataTable().row(l);
            var data = row.data();
            var temptable = $("#landdetail").DataTable();
            for (var k = 0;k<temptable.rows().count() ;k++){
                var localdata = temptable.row(k).data();
                if (localdata[8] == ldata[5]) {
                  data[2] = localdata[6];
                  data[3] = localdata[7];
                  data[4] = localdata[5];
                  row.data(data);
                }
                //lotareatable.row.add([ ldata[1], ldata[2], ldata[6], ldata[7], ldata[5],ldata[8],ldata[9] ]).draw(false);   
            }            
        }
    }

//console.log(parenrowid);
    var parenttable = window.opener.$('#landtable').DataTable();
    var landtotal = 0;
    for (var m = 0;m < parenttable.rows().count() ;m++){
      var parenttableldata = parenttable.row(m).data();

      var parenttablerow = parenttable.row(m);

      var parenttabledata = parenttablerow.data();
      if (parenttableldata[5] == {{$id}}) {        
        parenttabledata[3]=$('#netlandvalue').val();
        parenttabledata[4]=$('#roundnetlandvalue').val();
        parenttablerow.data(parenttabledata);
      }
//console.log(parenttabledata[4]);
    if (parenttabledata[4] != undefined)
      landtotal = landtotal + Number(removeCommas(parenttabledata[4]));

    }
     
    window.opener.$('#landtotal').val( formatMoneyHas(landtotal));
    window.opener.taxDriveCalculation();
    window.close();
}

function closeWindow(){
  window.close();
}


</script>
</body>
</html>