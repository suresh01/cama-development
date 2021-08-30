/**
*/
var createDropDownOptions = function(data, field) {
    var options = "<option></option>";
    // Create the list of HTML Options

    for (i = 0; i < data.length; i++)
    {
        options += "<option value='" + data[i].tdi_key + "'>" + data[i].tdi_value + "</option>\r\n";
    }

    // Assign the options to the HTML Select container
    $('select#' + field)[0].innerHTML = options;
 
    // Set the option to be Selected
    //$('#' + field).val(data[0].tdi_key);

    // Refresh the HTML Select so it displays the Selected option
    //$('#' + field).selectmenu('refresh');
};

var accountnumbercher= function(accountnumber) {
   var a,B,C,D;
   var account = accountnumber.slice(0,-1);
   a = 0;
   B = 0;
   C = 0;
   D = 0;
   for(var i = 0;i<account.length;i++){
        a = 86 - i;
        B = (i+1) * a;
        C = C + B;
   }

    a =  (C / 9);
   // alert(a);
        a = a * 9;
        B = C - a;
 
        D = 9 - B;
     return D;
};


var validateLot = function() {
    if($('#lotype').val()===''){
        alert('Please select lot type');
        return false;
    } else if ($('#lotnum').val()==='') {
        alert('Please enter lot number');
        return false;
    } else if ($('#lttt').index() === '') {
        alert('Please select title type');
        return false;
    } else if ($('#ltnum').val()==='') {
        alert('Please enter lot title number');
        return false;
    } else if ($('#lotstate').val()==='') {
        alert('Please select state');
        return false;
    } else if ($('#lotdistrict').val()==='') {
        alert('Please select district');
        return false;
    } else if ($('#landar').val()==='') {
        alert('Please enter Land Area');
        return false;
    } else if ($('#landaruni').val()==='') {
        alert('Please select unit');
        return false;
    } else if ($('#landcon').val()==='') {
        alert('Please select land condition');
        return false;
    } else if ($('#lanpos').val()==='') {
        alert('Please select land position');
        return false;
    } else if ($('#roadtype').val()==='') {
        alert('Please select road type');
        return false;
    } else if ($('#roadcate').val()==='') {
        alert('Please select road category');
        return false;
    } else if ($('#landuse').val()==='') {
        alert('Please select land user');
        return false;
    } else if ($('#status').val()==='') {
        alert('Please select status');
        return false;
    } else if ($('#tentype').val()==='') {
        alert('Please select tenant type');
        return false;
    } else {
        if($('#tentype option:selected').text() === 'PAJAKAN'){
            if ($('#tenduration').val()==='') {
                alert('Please enter tenant period');
                return false;
            } if ($('#tenduration').val()=== 0) {
                alert('Please enter tenant period');
                return false;
            }  else if ($('#tenstart').val()==='') {
                alert('Please select tenant start date');
                return false;
            } else if ($('#tenend').val()==='') {
                alert('Please select tenant end date');
                return false;
            }
        }
        var status = 0;
        var lotindex = '';
        var lotnumber = 0;
        for (var i = 0;i<$('#lottble').DataTable().rows().count();i++){
            var ldata = $('#lottble').DataTable().row(i).data();
            //var tempdata1 = {};

            $.each(ldata, function( key, value ) {
                if (value == 'Y'&&ldata[0]!='Deleted'){
                    status = value; 
                   // lotindex = ldata[0]; 
                    lotnumber = ldata[6]+ldata[5];
                }
                            
            });
        }
        if (lotnumber !== $('#lotnum').val()+$('#lotype').val()) {
              // alert(lotindex);
            if(status == 'Y' && $('#status').val() == 'Y'){
                alert('There should be only one lot is active');
                return false;
            }
        }
        return true;
    }
};

var validateOwner = function() {
    if($('#ownaplntype').val()===''){
        alert('Please select application type');
        return false;
    } else if ($('#typeofown').val()==='') {
        alert('Please select owner type');
        return false;
    } else if ($('#ownnum').val() === '') {
        alert('Please enter owner number');
        return false;
    } else if ($('#ownname').val()==='') {
        alert('Please enter owner name');
        return false;
    } else if ($('#citizen').val()==='') {
        alert('Please select citizen');
        return false;
    } else if ($('#race').val()==='') {
        alert('Please select race');
        return false;
    } else if ($('#ownaddr1').val()==='') {
        alert('Please enter address 1');
        return false;
    } else if ($('#ownpostcode').val()==='') {
        alert('Please enter post code');
        return false;
    } else if ($('#ownstate').val()==='') {
        alert('Please select state');
        return false;
    } else {
        if($('#ownpostcode').val().length < 5 ){
            
            alert('Please enter 5 digit post code');
            return false;
            
        } else if($('#ownpostcode').val().length > 6 ){
            
            alert('Please enter 6 digit post code');
            return false;
            
        } 

        return true;
    }
};

var validateBldg = function() {
    if($('#bldgnum').val()===''){
        alert('Please enter building number');
        $('#bldgnum').focus();
        return false;
    } else if ($('#bldgcate').val()==='') {
        alert('Please select category');
        $('#bldgcate').focus();
        return false;
    } else if ($('#bldgstorey').val() === '') {
        alert('Please select building storey');
        $('#bldgstorey').focus();
        return false;
    } else if ($('#bldgcond').val()==='') {
        alert('Please select building condition');
        $('#bldgcond').focus();
        return false;
    } else if ($('#bldgpos').val()==='') {
        alert('Please select building position');
        $('#bldgpos').focus();
        return false;
    } else if ($('#bldgstructure').val()==='') {
        alert('Please select building structure');
        $('#bldgstructure').focus();
        return false;
    } else if ($('#rooftype').val()==='') {
        alert('Please select roof type');
        $('#rooftype').focus();
        return false;
    } else if ($('#walltype').val()==='') {
        alert('Please select wall type');
        $('#walltype').focus();
        return false;
    } else if ($('#floortype').val()==='') {
        alert('Please select floor type');
        $('#floortype').focus();
        return false;
    } else if ($('#cccdt').val()==='') {
        alert('Please select ccc date');
        $('#cccdt').focus();
        return false;
    } else if ($('#occupieddt').val()==='') {
        alert('Please select occupied date');
        $('#occupieddt').focus();
        return false;
    } else if ($('#mbldg').val()==='') {
        alert('Please select main building');
        $('#mbldg').focus();
        return false;
    } else {
        var mainbldg = "";
        var mainbldgnumber = "";
        var bldgid = "";
        var bilbldg = 0;
        for (var i = 0;i<$('#bldgtble').DataTable().rows().count();i++){
            var ldata = $('#bldgtble').DataTable().row(i).data();
            //var tempdata1 = {};
            console.log(ldata);
            $.each(ldata, function( key, value ) {
                //alert(key + '=' + value);
                if (key == 22 && value ==1 ){
                    mainbldg = value; 
                    mainbldgnumber = ldata[2]; 
                    bldgid =  ldata[20];
                }          
            });
            bilbldg = i;
        }
        console.log(mainbldgnumber);
        console.log($('#bldgnum').val());
        console.log(mainbldg);
        console.log($('#mbldg').val());
        //alert(mainbldgnumber);
        //alert(bldgid + ' = ' + $('#bldgid').val());
        if (mainbldgnumber != $('#bldgnum').val()  && bldgid != $('#bldgid').val()  ){
        //if (bldgid != $('#bldgid').val()){
            //alert('bil bgn:' + bilbldg + ' ' + bldgid + ' = ' + $('#bldgid').val());
            //&& bilbldg != 1
            if(mainbldg == '1' && $('#mbldg').val() == mainbldg   ){

                alert('Only one building should be main building');
                $('#mbldg').focus();
                return false;
            }
        }
        return true;


    }
};

var validateBldgDetail = function() {
    if($('#arcate').val()===''){
        alert('Please select area category');
        return false;
    } else if ($('#arlevel').val()==='') {
        alert('Please select area level');
        return false;
    } else if ($('#arzone').val() === '') {
        alert('Please select area zone');
        return false;
    } else if ($('#aruse').val()==='') {
        alert('Please select area use');
        return false;
    } else if ($('#celingtype').val()==='') {
        alert('Please select celing type');
        return false;
    } else if ($('#dwalltype').val()==='') {
        alert('Please select wall type');
        return false;
    } else if ($('#fltype').val()==='') {
        alert('Please select floor type');
        return false;
    } else if ($('#size').val()==='') {
        alert('Please enter size');
        $('#size').focus();
        return false;
    } else if ($('#uom').val()==='') {
        alert('Please select unit of measurment');
        return false;
    } else if ($('#totsize').val()==='') {
        alert('Please enter total size');
        $('#totsize').focus();
        return false;
    } else {
        
        return true;
    }
};

var addDisableTab =function(){
    $("#propertyregsitration_from-titles").children('li').addClass('disabled-btn');
}

var removeDisableTab =function(){
    $("#propertyregsitration_from-titles").children('li').removeClass('disabled-btn');
}

function formatMoney(field, n, c, d, t) {
        var c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
            j = (j = i.length) > 3 ? j % 3 : 0;

        $('#'+field).val(s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : ""));
        //return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    };

    function formatMoneyHas(n, c, d, t) {
        var c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
            j = (j = i.length) > 3 ? j % 3 : 0;

        //$('#'+field).val(s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : ""));
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    };

    function removeCommas(str) {

        try {
            while (str.search(",") >= 0) {
                str = (str + "").replace(',', '');
            }
        }
        catch(err) {
            return str;
        }
        
        return str;
    };