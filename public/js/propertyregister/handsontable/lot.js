//lot
$( document ).ready(function() {
	//var count = 0;
    $("#stepy_form-next-0").click(function(){

    	 
	
    	 /*for(var i=0;i<masterhot.countRows();i++){
				
				var account = masterhot.getDataAtCell(i, 0);
				//var placcount = account.substring(0,11);
				$.ajax({
				  url: "validateAccount",
				  cache: false,
				  data:{param_value:account,TY:'PTBL'},
				  success: function(data){
					   var count = data.res_arr;
						if (count > 0 ) {
							//$('#accnumber').focus();
							alert(account+' this account Number already exists');
							//$('#accountvalid').val();							
							$( "#stepy_form-back-1").trigger("click");
						}
				  }
				});
			}*/

    if(lothot == undefined){	
 		var lotDataObject = [];



		for(var i=0;i<maxrow;i++){
			lotDataObject.push({lotaccnum:'',lotstate:'',lotdistrict:'',lotcity:'',presint:'',lotype:'',
						lotnum:'',altlotnum:'',lttt:'',ltnum:'',altnum:'',landar:'0',landaruni:'',landcon:'',
						lanpos:'',roadtype:'',roadcate:'',landuse:'',expcon:'',interest:'',tentype:'',
						tenduration:'0',tenstart:'',tenend:'',status:''});
		}
		var acc_num = [];
		acc_num = masterhot.getDataAtCol(0);

		

		var lotElement = document.querySelector('#lottable');
		var lotElementContainer = lotElement.parentNode;
		var lotSettings = {
			data:lotDataObject,
			columns: [
				{
					data: 'lotaccnum',
					type: 'dropdown',
				  	source: acc_num,		
        			validator: notEmpty
				},
				{
				  	data: 'lotstate',
					type: 'dropdown',
				  	source: state,
				  	allowEmpty: false
				},
				{
				  	data: 'lotdistrict',
				  	type: 'dropdown',
				  	source: district,
					allowEmpty: false
				},
				{
					data: 'lotcity',
				  	type: 'text',
					allowEmpty: false
				},
				{
					data: 'presint',
				  	type: 'dropdown',
				  	source: [],
					allowEmpty: true
				},
				{
					data: 'lotype',
					type: 'dropdown',
				  	source: lotcode,
					allowEmpty: false
				},
				{
				  data: 'lotnum',
				  type: 'text',		
        			validator: notEmpty
				},
				{
				  data: 'altlotnum',
				  type: 'text'
				},
				{
				  	data: 'lttt',
					type: 'dropdown',
				  	source: titiletype,
					allowEmpty: false
				},
				{
				  	data: 'ltnum',
				  	type: 'text',		
        			validator: notEmpty
				},
				{
				  data: 'altnum',
				  type: 'text'
				},
				{
				  data: 'landar',
				  type: 'numeric',				  
					allowEmpty: false
				},
				{
				  data: 'landaruni',
					type: 'dropdown',
				  	source: unitsize,
					allowEmpty: false
				},
				{
				  data: 'landcon',
					type: 'dropdown',
				  	source: landcond,
					allowEmpty: false
				},
				{
				  data: 'lanpos',
					type: 'dropdown',
				  	source: landpos,
					allowEmpty: false
				},
				{
				  data: 'roadtype',
					type: 'dropdown',
				  	source: roadtype,
					allowEmpty: false
				},
				{
				  data: 'roadcate',
					type: 'dropdown',
				  	source: roadcaty,
					allowEmpty: false
				},
				{
				  data: 'landuse',
					type: 'dropdown',
				  	source: landuse,
					allowEmpty: false
				},
				{
				  data: 'expcon',
				  type: 'text'
				},
				{
				  data: 'interest',
				  type: 'text'
				},
				{
				  data: 'tentype',
					type: 'dropdown',
				  	source: tnttype,
					allowEmpty: false
				},
				{
				  data: 'tenduration',
				  type: 'numeric'
				},
				{
				  data: 'tenstart',
				  type: 'date',
	      		  dateFormat: 'DD/MM/YYYY'
				},
				{
				  data: 'tenend',
				  type: 'date',
	      		  dateFormat: 'DD/MM/YYYY'
				},
				{
				  data: 'status',
				  type: 'dropdown',
				  source: activeind,
					allowEmpty: false
				}
			],
			minRows: 1,
			maxRows: 100,
	  		
			contextMenu: {
	          items: {
	            
		        "row_above": {
		          name: 'Add 5 rows above',
		          callback: function(key, options) {
		            lothot.alter('insert_row', lothot.getSelected()[0], 5)
		          }
		        },
		        "row_below": {
		          name: 'Add 5 rows below',
		          callback: function(key, options) {
		            lothot.alter('insert_row', lothot.getSelected()[0]+1, 5)
		          }
		        },
	            'separator': Handsontable.plugins.ContextMenu.SEPARATOR,
	            'clear_custom': {
	              name: 'Clear all cells',
	              callback: function() {
	                this.clear();
	              }
	            },"remove_row":{}
	          }
	        },
			stretchH: 'all',
			fixedColumnsLeft: 1,
			height: 457,
	    	rowHeaders: true,
			colWidths: [150, 150, 150, 150, 150,200, 200, 200, 200,150, 150, 150, 150,150, 150, 150, 150,150, 150, 150, 150,150, 150, 150, 150],
	    	dataSchema: {lotaccnum:'',lotstate:'',lotdistrict:'',lotcity:'',presint:'',lotype:'',
						lotnum:'',altlotnum:'',lttt:'',ltnum:'',altnum:'',landar:'',landaruni:'',landcon:'',
						lanpos:'',roadtype:'',roadcate:'',landuse:'',expcon:'',interest:'',tentype:'',
						tenduration:'0',tenstart:'',tenend:'',status:''},
			colHeaders: [
				'ACC NUMBER',
				'STATE',
				'DISCTRICT',
				'CITY',
				'PRESINT',
				'LOT TYPE',
				'LOT NUMBER',
				'ALTERNATIF LOT NUMBER',
				'LOT TITLE TYPE',
				'LOT TITLE NUMBER',
				'ALTERNATIF TITLE NUMBER',
				'LAND AREA',
				'LAND AREA UNIT',
				'LAND CONDITION',
				'LAND POSISION',
				'ROAD TYPE',
				'ROAD CATEGORY',
				'LAND USE',
				'Express Condition',
				'Restriction of interest',
				'TENURE TYPE',
				'TENURE PERIOD',
				'TENURE START DATE',
				'TENURE END DATE',
				'IS ACTIVE',

			],
			afterChange: function (changes, source) {
				if (source === 'loadData' || source === 'internal' || changes.length > 1) {
			    	return;
			    }
				var row = changes[0][0];
			    var prop = changes[0][1];
			    var value = changes[0][3];
			    //console.log(prop);
			    //console.log(prop === 'district');
			    //console.log(prop.text);
			    ///console.log(this.getDataAtRowProp(row, '2')[value]);
			    if(prop === 'tentype'){
			    	var tentype = lothot.getDataAtRowProp(row,'tentype');
		    		var period = lothot.getCellMeta(row, 21);
		    		var start = lothot.getCellMeta(row, 22);
		    		var end = lothot.getCellMeta(row, 23);
		    		//console.log(tentype);
			    	if (tentype === 'PAJAKAN'){
			    		period.valid = false;
			    		start.valid = false;
			    		end.valid = false;					   
			    	} else {
			    		period.valid = true;
			    		start.valid = true;
			    		end.valid = true;

			    	}
			    	//var data_acc = cur_acc + '1110';
			    	//var res = this.setDataAtRowProp(row, prop, data_acc);
			    	return;
			    }

			},
			afterChange: function (changes, source) {
				if (source === 'loadData' || source === 'internal' || changes.length > 1) {
			    	return;
			    }
				var row = changes[0][0];
			    var prop = changes[0][1];
			    var value = changes[0][3];
			    if(prop === 'lotstate'){
				   
				}

			}

			
		};

		

		lothot = new Handsontable(lotElement, lotSettings);	


		for(var i=0;i<masterhot.countRows();i++) {		    	
    		//var acc = masterhot.getCellMeta(i, 0);

    		//
		//	lothot.setCellMeta(i, lothot.propToCol('lotstate'), 'source', state);
			lothot.setDataAtRowProp(i, 'lotaccnum', acc_num[i]);

    		
	    }

		

	}
	});

});