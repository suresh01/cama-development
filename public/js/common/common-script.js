function removeAttrbute(param){
	var inputs = param.split(",");
	for (var i = 0; i < inputs.length; i++) {			   
			$('#'+inputs[i]).removeAttr('readonly');
	}
}

function blockParent(id){
	var temp = $('#moduleid option:selected').text();
	if(id==2){
		lenght = temp.split("->").length - 1;
		if(length == 3) {
			return false;
		}
	} else {
		alert('You cannot select this module as parent');
		$('#moduleid').val(0);
	}
	return true;
	
}


$(function() {
	$('.sch_delete_cnf').click(function() {
		
		var noty_id = noty({
			layout : 'center',
			text: 'Do you want Delete?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Delete', click: function($noty) {
		  
					// this = button element
					// $noty = $noty element
		  			
		  			$("#search_trn_from").submit();
					$noty.close();
					//noty({force: true, text: 'You clicked "Ok" button', type: 'success',layout : 'center',modal : true,});
				  }
				},
				{type: 'button green', text: 'Cancel', click: function($noty) {
					$noty.close();
					//noty({force: true, text: 'You clicked "Cancel" button', type: 'error',layout : 'center',modal : true,});
				  }
				}
				],
			type : 'success', 
		});
	});


	$('.schdt_delete_cnf').click(function() {
		
		var noty_id = noty({
			layout : 'center',
			text: 'Do you want Delete?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Delete', click: function($noty) {
		  
					// this = button element
					// $noty = $noty element
		  			
		  			$("#searchdt_trn_from").submit();
					$noty.close();
					//noty({force: true, text: 'You clicked "Ok" button', type: 'success',layout : 'center',modal : true,});
				  }
				},
				{type: 'button green', text: 'Cancel', click: function($noty) {
					$noty.close();
					//noty({force: true, text: 'You clicked "Cancel" button', type: 'error',layout : 'center',modal : true,});
				  }
				}
				],
			type : 'success', 
		});
	});

	//usertrnfrom conformation
	$('.delete_usr').click(function() {
		
		var noty_id = noty({
			layout : 'center',
			text: 'Do you want Delete?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Delete', click: function($noty) {
		  
					// this = button element
					// $noty = $noty element
		  			
		  			$("#usertransform").submit();
					$noty.close();
					//noty({force: true, text: 'You clicked "Ok" button', type: 'success',layout : 'center',modal : true,});
				  }
				},
				{type: 'button green', text: 'Cancel', click: function($noty) {
					$noty.close();
					//noty({force: true, text: 'You clicked "Cancel" button', type: 'error',layout : 'center',modal : true,});
				  }
				}
				],
			type : 'success', 
		});
	});

	//usertrnfrom conformation
	$('.delete_codemaintenance').click(function() {
		
		var noty_id = noty({
			layout : 'center',
			text: 'Do you want Delete?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Delete', click: function($noty) {
		  
					// this = button element
					// $noty = $noty element
		  			
		  			$("#usertransform").submit();
					$noty.close();
					//noty({force: true, text: 'You clicked "Ok" button', type: 'success',layout : 'center',modal : true,});
				  }
				},
				{type: 'button green', text: 'Cancel', click: function($noty) {
					$noty.close();
					//noty({force: true, text: 'You clicked "Cancel" button', type: 'error',layout : 'center',modal : true,});
				  }
				}
				],
			type : 'success', 
		});
	});

	
	$('.codem_delete_cnf').click(function() {
		
		var noty_id = noty({
			layout : 'center',
			text: 'Do you want Delete?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Delete', click: function($noty) {
		  
					// this = button element
					// $noty = $noty element
		  			
		  			$("#usertransform").submit();
					$noty.close();
					//noty({force: true, text: 'You clicked "Ok" button', type: 'success',layout : 'center',modal : true,});
				  }
				},
				{type: 'button green', text: 'Cancel', click: function($noty) {
					$noty.close();
					//noty({force: true, text: 'You clicked "Cancel" button', type: 'error',layout : 'center',modal : true,});
				  }
				}
				],
			type : 'success', 
		});
	});
	


	//reset password
	$('#resetpwd').click(function() {
		
		var noty_id = noty({
			layout : 'center',
			text: 'Do you want to reset password?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Reset', click: function($noty) {
		  
					// this = button element
					// $noty = $noty element

					$("#resetpwd").prop('disabled', true);
					$("#resetpwd").text("Resetting...");
			        var username = $("#username").val();
			        var mail = $("#mail").val();
			        var haspwd = "password";
			        $.ajax({
				        type:'GET',
				        url:'resetpassword',
				        data:{password:haspwd,username:username,mail:mail},
				        success:function(data){	        	
				        	if(data.msg === "true"){
				        		var noty_id = noty({
								layout : 'top',
								text: 'Password reset successfully!',
								modal : true,
								type : 'success', 
								 });
				        		//return;
								$("#resetpwd").text("Reset Password");
			        			$("#resetpwd").prop('disabled', false);
				        	} 
			        }
			    	});
		  			
		  			//$("#usertransform").submit();
					$noty.close();
					//noty({force: true, text: 'You clicked "Ok" button', type: 'success',layout : 'center',modal : true,});
				  }
				},
				{type: 'button green', text: 'Cancel', click: function($noty) {
					$noty.close();
					//noty({force: true, text: 'You clicked "Cancel" button', type: 'error',layout : 'center',modal : true,});
				  }
				}
				],
			type : 'success', 
		});
	});



	/*$('.delete_tenant').click(function() {
		
		var noty_id = noty({
			layout : 'center',
			text: 'Do you want Delete?',
			modal : true,
			buttons: [
				{type: 'button pink', text: 'Delete', click: function($noty) {
		  
					// this = button element
					// $noty = $noty element
		  			var tenantdata = {};
		        	$('#tenantform').serializeArray().map(function(x){tenantdata[x.name] = x.value;});

		            //console.log(tenantdata);
		            var tenantjson = JSON.stringify(tenantdata);
		            //$('#jsondata').val(tenantjson);
		            //console.log(tenantjson);
		            window.location.assign('tenanttrn?jsondata='+tenantjson);
					$noty.close();
					//noty({force: true, text: 'You clicked "Ok" button', type: 'success',layout : 'center',modal : true,});
				  }
				},
				{type: 'button green', text: 'Cancel', click: function($noty) {
					$noty.close();
					//noty({force: true, text: 'You clicked "Cancel" button', type: 'error',layout : 'center',modal : true,});
				  }
				}
				],
			type : 'success', 
		});
	});*/

});



//Property Registration Table Module.


var notEmpty = function (value, callback) {
    if (!value || String(value).length === 0) {
    	//alert("You have Enter this value")
        callback(false);
    } else {
        callback(true);
    }
};


var maxLength = function (value, callback) {	
    if (String(value).length === 11) {
        callback(true);
    } else {
    	//alert("The value you have entered isn't valid for this field")
       callback(false);
    }
};

var postcodeValidator = function (value, callback) {
    if (String(value).length === 5 || String(value).length === 6) {
        callback(true);
    } else {
    	//alert("The value you have entered isn't valid for this field")
       callback(false);
    }
};

var arrayToJSON = function (value) {
	value = value.replace(/&quot;/g, '"');
	value = JSON.parse(value);
	return value;
};

/*-- Table View Property Validation --*/
var showTableError = function (a,b) {	
	$( "#stepy_form-title-"+a ).addClass( "error-image" );
	$( "div.cur_step_err" ).html('<label generated="true" class="error">Please Enter all mantory fields!</label>');	
	$( "#stepy_form-back-"+b ).trigger("click");	    	
    
};

var showTableCustError = function (a,b,c) {	
	$( "#stepy_form-title-"+a ).addClass( "error-image" );
	$( "div.cur_step_err" ).html('<label generated="true" class="error">'+c+'!</label>');	
	$( "#stepy_form-back-"+b ).trigger("click");	    	
    
};


var clearTableError = function (a) {
	$( "#stepy_form-title-"+a ).removeClass( "error-image" );
	$( "div.cur_step_err" ).html('');
};




/*var clearTableError = function (a) {
	$.each([ 52, 97 ], function( index, value ) {
  	//alert( index + ": " + value );
});

};*/	

var finish = function (a) {
	$('#loader-modal').modal();

		return false;
};




/* Datable Dynamic column view */

function defaultDatatableColumn(defaultcolumn){

	$( ".multiselect-checkbox" ).each(function( index ) {
  		//console.log( index + ": " + $( this ).attr('data-val') );
		var id = $( this ).attr('data-val');

		if (defaultcolumn.indexOf(id) < 0){
		 	$(this).prop('checked', false);
		 	$(this).parent().parent().attr('class','');
		}

	});

	$('#testSelect1_inputCount').html(defaultcolumn.length);
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
}

function formatMoneyHas(n, c, d, t) {
	var c = isNaN(c = Math.abs(c)) ? 2 : c,
		d = d == undefined ? "." : d,
		t = t == undefined ? "," : t,
		s = n < 0 ? "-" : "",
		i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
		j = (j = i.length) > 3 ? j % 3 : 0;

	//$('#'+field).val(s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : ""));
	return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

function waitingIndicator(id){
	$('#'+id).html('<img src="images/ajax-loader/ajax-loader(8).gif" alt="Loader">');
}

function hideCol(id, col){
	$.each( col, function( index, value ){
	    var table = $('#'+id).DataTable();
		var column = table.column( value);
		column.visible(false);
	});
}

function customround(num, inputcategory){
    var tmp=1;
    var temp1 = 0;
	var temp2 = 0.0;
	var temp3 = 0.0;
	var  diffParam = 0;

	if (num >= 10000){
        diffParam = 1000;
    } else if (num < 10000 && num >= 1000) {
        diffParam = 1000;
    } else if (num < 1000 && num >= 10) {
        diffParam = 100;
    } else if (num < 10) {
        diffParam = 1;
    }

    // Nearest Round
    if (inputcategory == 1 ) {
		
         while(num>diffParam){
	        num = Math.round(num/diffParam);
	        tmp*=diffParam;
	    }

	    return num*tmp;

	} else  if (inputcategory == 2 ){ // Upper Round
		temp1 = diffParam / 2;
		// temp1 = 1000/2 = 500
        temp2 = num % diffParam;
        //temp2 = 5550 % 1000 = 550
        temp3 = parseInt(num / diffParam);
        //temp3 = parseInt(5550/1000) = 5

        temp3 = temp3 + 1;
       
		return temp3 * diffParam;

	} else  if (inputcategory == 3 ){ // Lower Round
		temp1 = diffParam / 2;
		// temp1 = 1000/2 = 500
        temp2 = num % diffParam;
        //temp2 = 5550 % 1000 = 550
        temp3 = parseInt(num / diffParam);
        //temp3 = parseInt(5550/1000) = 5
       

		return temp3 * diffParam;
	} 

}


function customroundnt(num, inputcategory){
    var tmp=1;
    var temp1 = 0;
	var temp2 = 0.0;
	var temp3 = 0.0;
	var  diffParam = 0;

	if (num >= 10000){
        diffParam = 5000;
    } else if (num < 10000 && num >= 1000) {
        diffParam = 5000;
    } else if (num < 1000 && num >= 10) {
        diffParam = 100;
    } else if (num < 10) {
        diffParam = 1;
    }

    // Nearest Round
    if (inputcategory == 1 ) {
		
         while(num>diffParam){
	        num = Math.round(num/diffParam);
	        tmp*=diffParam;
	    }

	    return num*tmp;

	} else  if (inputcategory == 2 ){ // Upper Round
		temp1 = diffParam / 2;
		// temp1 = 1000/2 = 500
        temp2 = num % diffParam;
        //temp2 = 5550 % 1000 = 550
        temp3 = parseInt(num / diffParam);
        //temp3 = parseInt(5550/1000) = 5

        temp3 = temp3 + 1;
       
		return temp3 * diffParam;

	} else  if (inputcategory == 3 ){ // Lower Round
		temp1 = diffParam / 2;
		// temp1 = 1000/2 = 500
        temp2 = num % diffParam;
        //temp2 = 5550 % 1000 = 550
        temp3 = parseInt(num / diffParam);
        //temp3 = parseInt(5550/1000) = 5
       

		return temp3 * diffParam;
	} 

}
