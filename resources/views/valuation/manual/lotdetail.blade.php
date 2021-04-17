<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Land Detail</title>
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
<div id="vlottable" >
          <div class="widget_top">
            <h6>Valuation</h6>
          </div>
          <div class="widget_content">
            <div class=" page_content">
              <div class="invoice_container"> 
                
                <fieldset>
                  <legend>Land Detail</legend>             
                  @foreach ($lotdetail as $rec)
                  <div class="grid_3 invoice_to"> 
                    <strong><span>Code Lot / No : </span></strong>
                    <span>{{$rec->lotnumber}}</span>  
                  </div>
                  <div class="grid_3 invoice_to">   
                    <strong><span>Lot Position : </span></strong>
                    <span>{{$rec->landposition}}</span>
                  </div>
                  <div class="grid_3 invoice_from">
                    <strong><span>Alternate Lot No : </span></strong>
                    <span>{{$rec->titlenumber}}</span>
                  </div>
                  <div class="grid_3 invoice_from">
                    <strong><span>Tenure Type : </span></strong>
                    <span>{{$rec->tentype}}</span>
                  </div>
                  <br>  <br>  <br>
                  <div class="grid_3 invoice_from">
                    <strong><span>Land Area : </span></strong>
                    <span>{{$rec->al_size}}</span>
                    <input type="hidden" id="landsize" value="{{$rec->al_size}}">
                  </div>
                  <div class="grid_3 invoice_from">
                    <strong><span>Tenure Duration : </span></strong>
                    <span>{{$rec->duration}}</span>
                  </div>
               
            @endforeach
            
                <span class="clear"></span>
                <div class="grid_12 invoice_details">
                  <div style="float:right;margin-right: 30px;"  class="btn_24_blue">
                    <a href="#" onclick="addLand()">Add Lotdetail</a>  
                  </div>
                  <br>
                  <br>
                      <div class="">
                        <table id="landdetail">
                        <thead>
                        <tr class=" gray_sai">
                          <th>
                            S No
                          </th>
                          <th>
                            Area Name
                          </th>
                          <th>
                            Area
                          </th>
                          <th>
                            Rate(smp)
                          </th>
                          <th>
                            Discount Rate(%)
                          </th>
                          <th>
                            Gross Value
                          </th>
                          <th>
                            Action
                          </th>
                          <th>
                            rate
                          </th>
                          <th>
                            discountreate
                          </th>
                          <th>
                            lotareaid
                          </th>
                          <th >
                            lotid
                          </th>
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
                          <label class="field_title"  id="accnumberlbl" style="width: 100%;" for="username">Net Land Value<span class="req">*</span></label>
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
                          <label class="field_title"  id="accnumberlbl" style="width: 100%;" for="username">Rounded Value <span class="req">*</span></label>
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
                    <button id="addsubmit" name="adduser" style="float: right; "  onclick="updateCalculation()" type="button" class="btn_small btn_blue"><span>Update</span></button>      
                              
                    <button id="close" name="close" type="button" onclick="closeWindow()"  class="btn_small btn_blue"><span>Close</span></button>
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

      <div id="addgroup" style="display:none" class="grid_10 full_block">
        <div class="widget_wrap">
          <div class="widget_content">
            <h3 id="title">Add Land Area</h3>
            
              <input type="hidden" name="id" id="id" value="0">
              <input type="hidden" name="operation" id="operation" value="0">
              <div  class="grid_12 form_container left_label">
                <ul>
                  <li>                
                    <div class="form_grid_12">                  
                      <label class="field_title" id="termname" for="termid">Area Description<span class="req">*</span></label>
                      <div class="form_input">                        
                        <input id="desc" required="true"  name="desc" type="text"  value="" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>                
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">Area Size<span class="req">*</span></label>
                      <div class="form_input">
                        <input id="size" required="true" onchange="calBalance()" name="size" type="text"  value="" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>                 
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">Total Area<span class="req">*</span></label>
                      <div class="form_input">
                        <input id="totsize" readonly="true"  name="totsize" type="text"  value="" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>                  
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">Balance Area<span class="req">*</span></label>
                      <div class="form_input">
                        <input id="balancesize" readonly="true"  name="balancesize" type="text"  value="" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>            
                    <!--<div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">Discount<span class="req">*</span></label>
                      <div class="form_input">
                        <input id="name" required="true"  name="discount" type="text"  value="" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>               
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">Gross Value<span class="req">*</span></label>
                      <div class="form_input">
                        <input id="grossvalue" required="true"  name="grossvalue" type="text"  value="" />
                      </div>-->
                      <span class=" label_intro"></span>
                    </div>              
                  </li>
                </ul>
              </div>
              
              <div style="height: 48px; float: none; display: -webkit-box;text-align: -webkit-center;" class="grid_12">                
                <div class="form_input">
                  <button id="addsubmit" name="adduser" type="submit" onclick="addLanddetail()" class="btn_small btn_blue"><span>Submit</span></button>     
                            
                  <button id="close" onclick="closeLand()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>
                  <span class=" label_intro"></span>
                </div>
                
                <span class="clear"></span>
              </div>
           
          </div>
        </div>
      </div>
    </div>
    <span class="clear"></span>
</div>
<script>
  function calBalance(){
    var balance = $('#balancesize').val();
    var size = $('#size').val();
    var bal = parseInt(balance) - parseInt(size);
    if(bal >= 0){
      if(size != ''){
        $('#balancesize').val(bal);
      }
      
    } else {
      alert('Area size exceed. Avaialable limit is '+balance);
      $('#size').val('');
      $('#balancesize').val(balance);
    }
  }
//var parenrowid = 0;
$(document).ready(function(){
    //var prmstr = window.location.search.split("=");
    //parenrowid = prmstr[2];

    $('#landdetail').DataTable({
      "columns":[ null, null, null, null, null,  { className: "numericCol" },null, { "visible": false }, { "visible": false }, { "visible": false}, { "visible": false}],
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

    var lotareatable = window.opener.$("#hiddenlandarea").DataTable();
    var description, area, rate, calucatedrate, grossvalue, lotid, lotareaid;
    var totalgross = 0;
    //alert(lotareatable.rows().count());
    for (var i = 0;i<lotareatable.rows().count();i++){
          var ldata = lotareatable.row(i).data();
         // if (ldata[6] == {{$id}}){
            rate = ldata[2];
            calucatedrate = ldata[3];
            grossvalue = ldata[4];
            var rowid = i+1;
             $('#landdetail').DataTable().row.add([ rowid,ldata[0], ldata[1], '<input type="text" class="editrate" style="text-align:right;" id="rate_'+rowid+'" value="'+rate+'" name="rate">', '<input type="text" style="text-align:right;"  class="editcalrate" id="calucatedrate_'+rowid+'" value="'+calucatedrate+'" name="rate">', grossvalue,'<span><a class="action-icons c-Delete delete_tenant" onclick="deleteBasket()" href="#" title="Delete">Delete</a></span>', rate,calucatedrate,0,0]).draw( false );      
             
              totalgross = totalgross + Number(removeCommas(grossvalue));
          //}
    }

    
    formatMoney('netlandvalue',totalgross);
    formatMoney('roundnetlandvalue',customround(totalgross,3));


    var table = $('#landdetail').DataTable();
    $('#landdetail tbody').on('change', '.editrate', function () {
        var row = table.row(table.row( $(this).parents('tr') ).index());
        var data = row.data();

       // table.row( $(this).parents('tr')).index();
        var rowid =  table.row( $(this).parents('tr')).index() +1;
        //console.log(rowid);
        var rate = $('#rate_'+rowid).val();
        var calucaterate =  $('#calucatedrate_'+rowid).val();
        var area =  data[2];
        console.log(calucaterate);
        console.log(area);
        area = removeCommas(area);
        rate = removeCommas(rate);
        calucaterate = removeCommas(calucaterate);
        
        var gross = area * rate * (1 - (calucaterate / 100));
        data[3] = '<input type="text" class="editrate" style="text-align:right;" id="rate_'+rowid+'" value="'+rate+'" name="rate">';
        data[4] = '<input type="text" class="editcalrate"  style="text-align:right;" id="calucatedrate_'+rowid+'" value="'+calucaterate+'" name="rate">';
        data[5] = formatMoneyHas(gross);
        data[7] = rate;
        data[8] = calucaterate;
        row.data(data);

        var grossland = 0;
        for (var j= 0;j<$('#landdetail').DataTable().rows().count();j++){
          var ldata = $('#landdetail').DataTable().row(j).data();
          
          grossland = grossland + Number(removeCommas(ldata[5]));
                  
        }
        formatMoney('netlandvalue',grossland);
        formatMoney('roundnetlandvalue',customround(grossland,1));
    });
    

});

function addLand(){
  $('#totsize').val($('#landsize').val());
  var usedsize=0;
  var landdetailtable = $("#landdetail").DataTable();
  for (var l = 0;l < landdetailtable.rows().count() ;l++){
      var ldata = landdetailtable.row(l).data();
     usedsize = parseInt(usedsize) + parseInt(ldata[2]);
  }
 // alert(usedsize);
  var balance = $('#landsize').val() - parseInt(usedsize);
  if(balance < 0){
    $('#balancesize').val(0);
  } else {
    $('#balancesize').val(balance);
  }

  $('#desc').val('');
  $('#size').val('');
  
  $('#vlottable').hide();
  $('#addgroup').show();
}

function closeLand(){
  $('#vlottable').show();
  $('#addgroup').hide();
}

function addLanddetail(){
    var t = $('#landdetail').DataTable();
    var rowid = (t.rows().count())+1;
    t.row.add([ 'New', $('#desc').val(), $('#size').val(), '<input type="text" class="editrate" style="text-align:right;" value="0" id="rate_'+rowid+'">', '<input type="text" class="editcalrate" style="text-align:right;" value="0" id="calucatedrate_'+rowid+'">', '<input type="text" class="editgross" style="text-align:right;" readonly="true" value="0" id="grossvalue_'+rowid+'">','<span><a class="action-icons c-Delete delete_tenant" onclick="deleteBasket()" href="#" title="Delete">Delete</a></span>',0,0,0,0]).draw( false );  
    $('#vlottable').show();
    $('#addgroup').hide();
}

function updateCalculation(){

    var gross = $('#roundnetlandvalue').val();
    
    var lotareatable = $("#landdetail").DataTable();
    
    
    var parenttable = window.opener.$('#landtable').DataTable();
    var landtotal = 0;

    for (var m = 0;m < parenttable.rows().count() ;m++){
      var parenttableldata = parenttable.row(m).data();

      var parenttablerow = parenttable.row(m);

      var parenttabledata = parenttablerow.data();
        
      parenttabledata[3]=$('#netlandvalue').val();
      parenttabledata[4]=$('#roundnetlandvalue').val();
      parenttablerow.data(parenttabledata);
    
      if (parenttabledata[4] != undefined)
        landtotal = landtotal + Number(removeCommas(parenttabledata[4]));

    }

    var lotareatable = window.opener.$("#hiddenlandarea").DataTable();
    var landdetailtable = $("#landdetail").DataTable();
    
    for (var l = 0;l < landdetailtable.rows().count() ;l++){
        var ldata = landdetailtable.row(l).data();
        
      //  if (ldata[6] == {{$id}}) {
            var row = landdetailtable.row(l);
            var data = row.data();
            var temptable = $("#landdetail").DataTable();            

            lotareatable.row.add([ ldata[1], ldata[2],ldata[7], ldata[8], ldata[5], ldata[9],ldata[10],ldata[0] ]).draw(false);   
                        
      //  } else {
          
       // }
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