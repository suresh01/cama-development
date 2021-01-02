
$( document ).ready(function() {
	
	var masterDataObject = [];

	for(var i=0;i<maxrow;i++){
		masterDataObject.push({accnumber:'',filenumber:'',bldgtype:'',district:'',
    		zone:'',subzone:'',address1:'',address2:'',address3:'',
    		address4:'',city:'',postcode:'',state:''});
	}
	//var maxLength = 2;
// master 
	var hotElement = document.querySelector('#mastertable');
	var hotElementContainer = hotElement.parentNode;
	var hotSettings = {
		data: masterDataObject,
		columns: [
			{
				data: 'accnumber',
				type: 'text',
        		validator: notEmpty,
        		validator: maxLength
			},
			{
			  	data: 'filenumber',
				type: 'text',		
				allowEmpty: false
			},
			{
			  data: 'bldgtype',
			  type: 'dropdown',
			  source: ishasbuilding,
				allowEmpty: false
			},
			{
				data: 'district',
			  	type: 'dropdown',
			  	source: district,
				allowEmpty: false
			},
			{
				data: 'zone',
			  	type: 'dropdown',
			  	source: zone,
				allowEmpty: false
			},
			{
				data: 'subzone',
				type: 'dropdown',
			  	source: subzone,	
				allowEmpty: false
			},
			{
			  data: 'address1',
			  type: 'text',		
        		validator: notEmpty
			},
			{
			  data: 'address2',
			  type: 'text'
			},
			{
			  data: 'address3',
			  type: 'text'
			},
			{
			  	data: 'address4',
			  	type: 'text'
			},
			{
			  data: 'city',
			  type: 'text',
			},
			{
			  data: 'postcode',
			  type: 'text',
				allowEmpty: false,
        		validator: postcodeValidator
			},
			{
				data: 'state',
				type: 'dropdown',
			  	source: state,
				allowEmpty: false
			}
		],
		stretchH: 'all',
		height: 457,		
		comments: true,
		minRows: 1,
		fixedColumnsLeft: 1,
		maxRows: 100,
  		//contextMenu: true,
		contextMenu: {

          items: {
            
	        "row_above": {
	          name: 'Add 5 rows above',
	          callback: function(key, options) {
	            masterhot.alter('insert_row', masterhot.getSelected()[0], 5)
	          }
	        },
	        "row_below": {
	          name: 'Add 5 rows below',
	          callback: function(key, options) {
	            masterhot.alter('insert_row', masterhot.getSelected()[0]+1, 5)
	          }
	        },
            'separator': Handsontable.plugins.ContextMenu.SEPARATOR,
            'clear_custom': {
              name: 'Clear all cells',
              callback: function() {
                this.clear();
              }
            },"remove_row":{},
            "copy":{},
            
          }
        },
    	rowHeaders: true,
		colWidths: [150, 150, 150, 150, 150,200, 200, 200, 200,150, 150, 150, 150],
    	dataSchema: {accnumber:'',filenumber:'',bldgtype:'',district:'',
    		zone:'',subzone:'',address1:'',address2:'',address3:'',
    		address4:'',city:'',postcode:'',state:''},
		colHeaders: [
			'ACC NUMBER',
			'FILE NUMBER',
			'ACC TYPE',
			'DISTRICT',
			'ZONE',
			'SUBZONE',
			'ADDRESS 1',
			'ADDRESS 2',
			'ADDRESS 3',
			'ADDRESS 4',
			'CITY',
			'POST CODE',
			'STATE'
		]/*,
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


	masterhot = new Handsontable(hotElement, hotSettings);
	var setter = false;


 	masterhot.addHook('afterAutofill', function (start, end, data) {
      	console.log(start+" "+ end+" "+ data);
    });
	
 	masterhot.addHook('beforeAutofill', function (start, end, data) {
 		console.log(start+" "+ end+" "+ data);
      	if(start.col == 0 || start.col == 1 || start.col == 6 || start.col == 7){
		      for(var k = 0; k <= (end.col - start.col); k++) {
		      		
			        var str = data[0][k],
			          matches = str.match(/\d+$/),
			          number;

			        if (matches) {
			          let init = parseInt(matches[0], 10) + 1
			          let strInit = data[0][k].replace(matches[0], '')
			          data[0][k] = strInit + init
			          for(var i = 1; i <= (end.row - start.row); i++) {
			            if(!(data[i])) {
			              data.push(data[0].slice())
			            }
			            data[i][k] = strInit + (init + i)
			          }
			        }

		      }
  		}
    });

   
	
	masterhot.addHook('afterChange', function(changes, src) {
		
		if (src === 'loadData' || src === 'internal' || changes.length > 1) {
			    	return;
			    }
	    var row = changes[0][0];
	    var prop = changes[0][1];
	    var value = changes[0][3];
	    //alert(changes[i][1]);
	    if (prop === 'accnumber') {
		    if (!setter) {
				setter = true;
				var cur_acc = masterhot.getDataAtCell(row,0);
				var cell= masterhot.getCellMeta(row, 0);
				var data_acc = '';
				
				masterhot.render();
		    } else {
		      setter = false;
		    }
		}

		if(prop === 'district'){
			var cur_district = masterhot.getDataAtCell(row,3);
			var param = 'zone'
			$.ajax({
			  url: "childparam",
			  cache: false,
			  data:{param_value:cur_district,param:param},
			  success: function(data){
			    //$("#results").append(html);
			    //console.log(data.zone);
	    		masterhot.setCellMeta(row, masterhot.propToCol('zone'), 'source', data.res_arr);
        		masterhot.setDataAtRowProp(row, 'zone', data.res_arr[0]);
			  }
			});
		}
		

		if(prop === 'zone'){

			var cur_zone = masterhot.getDataAtCell(row,4);
			var param = "subzone";
			$.ajax({
			  url: "childparam",
			  cache: false,
			  data:{param_value:cur_zone,param:param},
			  success: function(data){
			    //$("#results").append(html);
			    //console.log(data.zone);
	    		masterhot.setCellMeta(row, masterhot.propToCol('subzone'), 'source', data.res_arr);
        		masterhot.setDataAtRowProp(row, 'subzone', data.res_arr[0]);
			  }
			});
		}

	
  	});

  	//console.log(masterhot.validateCells(function(valid){return valid}));

  	/*if (row === 1) {
        cellProperties.readOnly = true;
      }*/
 
 
	


	

});