//owner 
$( document ).ready(function() {
    $("#stepy_form-next-1").click(function(){
 		
    	if(ownerhot == undefined){
    	var ownerDataObject = [];

		for(var i=0;i<maxrow;i++){
			ownerDataObject.push({owneraccnum:'',ownaplntype:'',typeofown:'',ownnum:'',ownname:'',ownaddr1:'',
						ownaddr2:'',ownaddr3:'',ownaddr4:'',ownpostcode:'',ownstate:'',
						citizen:'',race:'',numerator:0,demominator:0});
		}
  		var acc_num = [];
  		acc_num = masterhot.getDataAtCol(0);
  		//console.log(masterhot.getDataAtCol(0));
		var ownerElement = document.querySelector('#ownertable');
		var ownerElementContainer = ownerElement.parentNode;
		var ownerSettings = {
			data: ownerDataObject,
			columns: [
				{
					data: 'owneraccnum',
					type: 'dropdown',
				  	source: acc_num,
				  	allowEmpty: false
				},
				{
				  	data: 'ownaplntype',
					type: 'dropdown',
				  	source: ['CMK','KAD'],
				  	allowEmpty: false
				},
				{
				  	data: 'typeofown',
					type: 'dropdown',
				  	source: owntype,
					allowEmpty: false
				},
				{
					data: 'ownnum',
				  	type: 'text',
        			validator: notEmpty,
					allowEmpty: false
				},
				{
					data: 'ownname',
				  	type: 'text',		
        			validator: notEmpty
				},
				{
					data: 'ownaddr1',
					type: 'text',		
        			validator: notEmpty
				},
				{
				  data: 'ownaddr2',
				  type: 'text',
					allowEmpty: false
				},
				{
				  data: 'ownaddr3',
				  type: 'text'
				},
				{
				  data: 'ownaddr4',
				  type: 'text'
				},
				{
				  	data: 'ownpostcode',
				  	type: 'text',		
        			validator: notEmpty,
        			validator: postcodeValidator
				},
				{
				  	data: 'ownstate',
					type: 'dropdown',
				  	source: state,
				  	allowEmpty: false
				},
				{
					data: 'telno',
				  	type: 'text',		
        			validator: notEmpty
				},
				{
					data: 'faxno',
					type: 'text'
				},
				{
				  data: 'citizen',
					type: 'dropdown',
				  	source: citizen,
				  	allowEmpty: false
				},
				{
				  data: 'race',
					type: 'dropdown',
				  	source: race,
				  	allowEmpty: false
				},
				{
				  data: 'numerator',
				  type: 'numeric'
				},
				{
				  data: 'demominator',
				  type: 'numeric'
				}
			],
			minRows: 1,
			maxRows: 100,
	  		
			contextMenu: {
	          items: {
	            
		        "row_above": {
		          name: 'Add 5 rows above',
		          callback: function(key, options) {
		            ownerhot.alter('insert_row', ownerhot.getSelected()[0], 5)
		          }
		        },
		        "row_below": {
		          name: 'Add 5 rows below',
		          callback: function(key, options) {
		            ownerhot.alter('insert_row', ownerhot.getSelected()[0]+1, 5)
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
			height: 457,
			fixedColumnsLeft: 1,
	    	rowHeaders: true,
			colWidths: [150, 200, 150, 150, 150,200, 200, 200, 200,150, 150, 150, 150,150, 150,150, 150],
	    	dataSchema: {owneraccnum:'',ownaplntype:'',typeofown:'',ownnum:'',ownname:'',ownaddr1:'',
						ownaddr2:'',ownaddr3:'',ownaddr4:'',ownpostcode:'',ownstate:'',telno:'',faxno:'',
						citizen:'',race:'',numerator:0,demominator:0},
			colHeaders: [
				'ACC NUMBER',
				'OWNER APPLICATION TYPE',
				'TYPE OF OWNER',
				'OWNER NO',
				'OWNER NAME',
				'OWNER ADDRES 1',
				'OWNER ADDRES 2',
				'OWNER ADDRES 3',
				'OWNER ADDRES 4',
				'POSTCODE',
				'STATE',
				'TEL NUMBER',
				'FAX NUMBER',
				'Citizenship',
				'RACE ',
				'Numerator',
				'Denominator',

			],
			afterChange: function (changes, source) {
				if (source === 'loadData' || source === 'internal' || changes.length > 1) {
			    	return;
			    }
				var row = changes[0][0];
			    var prop = changes[0][1];
			    var value = changes[0][3];
			    if(prop === 'ownaplntype'){
				   
				}

			}/*,
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
			    if(prop === 'accnumber'){
			    	var cur_acc = this.getDataAtCell(row,0);
			    	var data_acc = cur_acc + '1110';
		    		var res = this.setDataAtRowProp(row, 'accnumber', data_acc);
			    	//var data_acc = cur_acc + '1110';
			    	//var res = this.setDataAtRowProp(row, prop, data_acc);
			    	return;
			    }

			}*/
		};

		ownerhot = new Handsontable(ownerElement, ownerSettings);
		
		
	 for(var i=0;i<masterhot.countRows();i++) {		    	
			    		//var acc = masterhot.getCellMeta(i, 0);

			    		//
	    				//ownerhot.setCellMeta(i, ownerhot.propToCol('ownaplntype'), 'source', ['CMK','KAD']);
	    				ownerhot.setDataAtRowProp(i, 'owneraccnum', acc_num[i]);

			    		
				    }

	/*$("#stepy_form-back-3").click(function(){
 		ownerhot.updateSettings({
	  	 	cells: function(row, col, prop){
	    	var cellProperties = {};
	    	var lowneraccnum = ownerhot.getDataAtRowProp(row, 'owneraccnum');
	      	if(lowneraccnum != ''){
		      	if(prop === 'owneraccnum'){
		        	cellProperties.readOnly = 'true'
		        }
	    	}
	      	return cellProperties
	    	}
	  	})
 	});*/

		
	}
	});

});