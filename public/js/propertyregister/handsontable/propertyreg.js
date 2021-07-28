
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
			{ // 0
				data: 'accnumber',
				type: 'text',
        		validator: notEmpty,
        		validator: maxLength
			},
			{ // 1
			  	data: 'filenumber',
				type: 'text',		
				allowEmpty: false
			},
			{ // 2
				data: 'district',
			  	type: 'dropdown',
			  	source: district,
				allowEmpty: false
			},
			{ // 3
				data: 'zone',
			  	type: 'dropdown',
			  	source: zone,
				allowEmpty: false
			},
			{ // 4
				data: 'subzone',
				type: 'dropdown',
			  	source: subzone,	
				allowEmpty: false
			},
			{ // 5
			  data: 'address1',
			  type: 'text',		
        		validator: notEmpty
			},
			{ // 6
			  data: 'address2',
			  type: 'text'
			},
			{ // 7
			  data: 'address3',
			  type: 'text'
			},
			{ // 8
			  	data: 'address4',
			  	type: 'text'
			},
			{ // 9
			  data: 'city',
			  type: 'text',
			},
			{ // 10
			  data: 'postcode',
			  type: 'text',
				allowEmpty: false,
        		validator: postcodeValidator
			},
			{ //11
				data: 'state',
				type: 'dropdown',
			  	source: statedefault,
				allowEmpty: false
			},
			{ //12
			  data: 'bldgstatus',
			  type: 'dropdown',
			  source: ishasbuilding,
				allowEmpty: false
			},
			{ //13
				data: 'lotype',
				type: 'dropdown',
				source: lotcode,
				allowEmpty: false
			},
			{ //14
				data: 'lotnum',
				type: 'text',		
				validator: notEmpty
			},
			{ //15
				data: 'altlotnum',
				type: 'text'
			},
			{ //16
				data: 'lttt',
				type: 'dropdown',
				source: titiletype,
				allowEmpty: false
			},
			{ //17
				data: 'ltnum',
				type: 'text',		
				validator: notEmpty
			},
			{ //18
				data: 'ltaltnum',
				type: 'text'
			},
			{ //19
				data: 'ltstrata',
				type: 'text'
			},
			{ //20
				data: 'landar',
				type: 'numeric',				  
				allowEmpty: false
			},
			{ //21
				data: 'landaruni',
				type: 'dropdown',
				source: unitsize,
				allowEmpty: false
			},
			{ //22
				data: 'landcon',
				type: 'dropdown',
				source: landcond,
				allowEmpty: false
			},
			{ //23
				data: 'lanpos',
				type: 'dropdown',
				source: landpos,
				allowEmpty: false
			},
			{ //24
				data: 'roadtype',
				type: 'dropdown',
				source: roadtype,
				allowEmpty: false
			},
			{ //25
				data: 'roadcate',
				type: 'dropdown',
				source: roadcaty,
				allowEmpty: false
			},
			{ //26
				data: 'landuse',
				type: 'dropdown',
				source: landuse,
				allowEmpty: false
			},
			{ //27
				data: 'expcon',
				type: 'text'
			},
			{ //28
				data: 'interest',
				type: 'text'
			},
			{ //29
				data: 'tentype',
				type: 'dropdown',
				source: tnttype,
				allowEmpty: false
			},
			{ //30
				data: 'tenduration',
				type: 'numeric'
			},
			{ //31
				data: 'tenstart',
				type: 'date',
				dateFormat: 'DD/MM/YYYY'
			},
			{ //32
				data: 'tenend',
				type: 'date',
				dateFormat: 'DD/MM/YYYY'
			},
			{ //33
				data: 'lotstatus',
				type: 'dropdown',
				source: activeind,
				allowEmpty: false
			},
			{ //34
				data: 'ownaplntype',
				type: 'dropdown',
				source: ['KAD'],
				allowEmpty: false
			},
			{ //35
				data: 'typeofown',
				type: 'dropdown',
				source: owntype,
				allowEmpty: false
			},
			{ //36
				data: 'ownnum',
				type: 'text',
				validator: notEmpty,
				allowEmpty: false
			},
			{ //37
				data: 'ownname',
				type: 'text',		
				validator: notEmpty
			},
			{ //38
				data: 'ownaddr1',
				type: 'text',		
				validator: notEmpty
			},
			{ //39
				data: 'ownaddr2',
				type: 'text',
				allowEmpty: false
			},
			{ //40
				data: 'ownaddr3',
				type: 'text'
			},
			{ //41
				data: 'ownaddr4',
				type: 'text'
			},
			{ //42
				data: 'ownpostcode',
				type: 'text',		
				validator: notEmpty,
				validator: postcodeValidator
			},
			{ //43
				data: 'owncity',
				type: 'text'
			},
			{ //44
				data: 'ownstate',
				type: 'dropdown',
				source: state,
				allowEmpty: false
			},
			{ //45
				data: 'telno',
				type: 'text',		
				validator: notEmpty
			},
			{ //46
				data: 'mobno',
				type: 'text'
			},
			{ //47
			  	data: 'email',
			  	type: 'text'
			},
			{ //48
				data: 'citizen',
				type: 'dropdown',
				source: citizen,
				allowEmpty: false
			},
			{ //49
				data: 'race',
				type: 'dropdown',
				source: race,
				allowEmpty: false
			},
			{ //50
				data: 'numerator',
				type: 'numeric'
			},
			{ //51
				data: 'demominator',
				type: 'numeric'
			},
			{ //52
				data: 'bldgnum',
				type: 'text',
				allowEmpty: false
			},
			{ //53
				data: 'bldgcate',
				type: 'dropdown',
				source: bldgcate,
				allowEmpty: false
			},
			{ //54
				data: 'bldgttype',
				type: 'dropdown',
				source: bldgtype,
				allowEmpty: false
			},
			{ //55
				data: 'bldgstorey',
				type: 'dropdown',
				source: bldgstore,
				allowEmpty: false
			},
			{ //56
				data: 'bldgcond',
				type: 'dropdown',
				source: bldgcond,
				allowEmpty: false
			},
			{ //57
				data: 'bldgpos',
				type: 'dropdown',
				source: bldgpos,
				allowEmpty: false
			},
			{ //58
				data: 'bldgstructure',
				type: 'dropdown',
				source: bldgstructure,
				allowEmpty: false
			},
			{ //59
				data: 'rooftype',
				type: 'dropdown',
				source: rooftype,
				allowEmpty: false
			},
			{ //60
				data: 'walltype',
				type: 'dropdown',
				source: walltype,
				allowEmpty: false
			},
			{ //61
				data: 'floortype',
				type: 'dropdown',
				source: fltype,
				allowEmpty: false
			},
			{ //62
				data: 'cccdt',
				type: 'date',
				dateFormat: 'DD/MM/YYYY',
				allowEmpty: false
			},
			{ //63
				data: 'occupieddt',
				type: 'date',
				dateFormat: 'DD/MM/YYYY',
				allowEmpty: false
			},
			{ //64
				data: 'mainbldg',
				type: 'dropdown',
				source: mbldg,
				allowEmpty: false
			},
			{ //65
				data: 'reffinfo',
				type: 'text'
			},
			{ //66
				data: 'artype',
				type: 'dropdown',
				source: artype,
				allowEmpty: false
			},
			{ //67
				data: 'arcate',
				type: 'dropdown',
				source: arcaty,
				allowEmpty: false
			},
			{ //68
				data: 'arlevel',
				type: 'dropdown',
				source: arlvl,
				allowEmpty: false
			},
			{ //69
				data: 'arzone',
				type: 'dropdown',
				source: arzone,
				allowEmpty: false
			},
			{ //70
				data: 'aruse',
				type: 'dropdown',
				source: aruse,
				allowEmpty: false
			},
			{ //71
				data: 'ardesc',
				type: 'text'
			},
			{ //72
				data: 'dimention',
				type: 'text'
			},
			{ //73
				data: 'arcnt',
				type: 'numeric'
			},
			{ //74
				data: 'size',
				type: 'numeric'
			},
			{ //75
				data: 'uom',
				type: 'dropdown',
				source: unitsize,
				allowEmpty: false
			},
			{ //76
				data: 'totsize',
				type: 'numeric'
			},
			{ //77
				data: 'fltype',
				type: 'dropdown',
				source: fltype,
				allowEmpty: false
			},
			{ //78
				data: 'walltype',
				type: 'dropdown',
				source: walltype,
				allowEmpty: false
			},
			{ //79
				data: 'celingtype',
				type: 'dropdown',
				source: ceiling,
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
		colWidths: [
			150, 150, 150, 150, 150, 200, 200, 200, 200, 150, 
			150, 150, 150, 150, 150, 150, 150, 150, 200, 200, 
			150, 150, 150, 150, 150, 150, 150, 150, 200, 200, 
			150, 150, 150, 150, 150, 150, 150, 150, 200, 200, 
			150, 150, 150, 150, 150, 150, 150, 150, 200, 200, 
			150, 150, 150, 150, 150, 150, 150, 150, 200, 200, 
			150, 150, 150, 150, 150, 150, 150, 150, 200, 200, 
			150, 150, 150, 150, 150, 150, 150, 150, 200, 200],
    	dataSchema: {accnumber:'',filenumber:'',bldgtype:'',district:'',
    		zone:'',subzone:'',address1:'',address2:'',address3:'',
    		address4:'',city:'',postcode:'',state:''},
		colHeaders: [
			'0 ACC NUMBER',
			'1 FILE NUMBER',
			'2 DISTRICT',
			'3 ZONE',
			'4 SUBZONE',
			'5 ADDRESS 1',
			'6 ADDRESS 2',
			'7 ADDRESS 3',
			'8 ADDRESS 4',
			'9 CITY',
			'10 POST CODE',
			'11 STATE',
			'12 BUILDING STATUS',
			'13 LOT TYPE',
			'14 LOT NUMBER',
			'15 ALTERNATIVE LOT NUMBER',
			'16 TITLE TYPE',
			'17 TITLE NUMBER',
			'18 ALTERNATIVE TITLE NUMBER',
			'19 STRATA NUMBER',
			'20 LAND AREA',
			'21 LAND AREA UNIT',
			'22 LAND CONDITION',
			'23 LAND POSITION',
			'24 ROAD TYPE',
			'25 ROAD CATEGORY',
			'26 LAND USE',
			'27 EXPRESS CONDITION',
			'28 RESTRICTION OF INTEREST',
			'29 TENURE TYPE',
			'30 TENURE PERIOD',
			'31 TERURE START',
			'32 TENURE END',
			'33 IS ACTIVE',
			'34 OWNER APPLICATION TYPE',
			'35 TYPE OF OWNER',
			'36 OWNER NUMBER',
			'37 OWNER NAME',
			'38 OWNER ADDRESS 1',
			'39 OWNER ADDRESS 2',
			'40 OWNER ADDRESS 3',
			'41 OWNER ADDRESS 4',
			'42 OWNER POSTCODE',
			'43 OWNER CITY',
			'44 OWNER STATE',
			'45 TEL NUMBER',
			'46 MOBILE NUMBER',
			'47 EMAIL',
			'48 CITIZENSHIP',
			'49 RACE',
			'50 NUMERATOR',
			'51 DENOMURATOR',
			'52 BUILDING LABEL',
			'53 BUILDING CATEGORY',
			'54 BUILDING TYPE',
			'55 BUILDING STOREY',
			'56 BUILDING CONDITION',
			'57 BUILDING POSITION',
			'58 BUILDING STRUCTURE',
			'59 BUILDING ROOF',
			'60 BUILDING WALL',
			'61 BUILDING FLOOR',
			'62 CCC DATE',
			'63 OCCUPIED DATE',
			'64 IS MAIN BUILDING',
			'65 REFF INFORMATION',
			'66 AREA TYPE',
			'67 AREA CATEGORY',
			'68 AREA LEVEL',
			'69 AREA ZONE',
			'70 AREA USE',
			'71 AREA DESCRIPTION',
			'72 DIMENTION',
			'73 AREA COUNT',
			'74 MEASUREMENT',
			'75 UNIT OF MEASUREMENT',
			'76 TOTAL SIZE',
			'77 AREA FLOOR',
			'78 AREA WALL',
			'79 AREA CEILING'



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
			var cur_district = masterhot.getDataAtCell(row,2);
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

			var cur_zone = masterhot.getDataAtCell(row,3);
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

		if(prop === 'bldgcate'){

			var cur_bldgcate = masterhot.getDataAtCell(row,53);
			var param = "bldgtype";
			$.ajax({
			  url: "childparam",
			  cache: false,
			  data:{param_value:cur_bldgcate,param:param},
			  success: function(data){
			    //$("#results").append(html);
			    //console.log(data.zone);
				//alert(cur_bldgcate);
	    		masterhot.setCellMeta(row, masterhot.propToCol('bldgttype'), 'source', data.res_arr);
        		masterhot.setDataAtRowProp(row, 'bldgttype', data.res_arr[0]);

				masterhot.setCellMeta(row, masterhot.propToCol('bldgstorey'), 'source', data.storey_arr);
				masterhot.setDataAtRowProp(row, 'bldgstorey', data.storey_arr[0]);

				masterhot.setCellMeta(row, masterhot.propToCol('arlevel'), 'source', data.arelvl_arr);
				masterhot.setDataAtRowProp(row, 'arlevel', data.arelvl_arr[0]);

				masterhot.setCellMeta(row, masterhot.propToCol('aruse'), 'source', data.areuse_arr);
				masterhot.setDataAtRowProp(row, 'aruse', data.areuse_arr[0]);
			  }
			});
		}

	
  	});

  	//console.log(masterhot.validateCells(function(valid){return valid}));

  	/*if (row === 1) {
        cellProperties.readOnly = true;
      }*/
 
 
	


	

});