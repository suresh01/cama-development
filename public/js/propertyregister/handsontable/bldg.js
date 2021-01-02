//bldg 
$( document ).ready(function() {
	
	   $("#stepy_form-next-2").click(function(){
//onsole.log('test'+bldghot);
		//if(bldghot == undefined){
		if(bldghot == undefined){
	    // ... code for validated cells		
	    	var bldgDataObject = [];

			
	 	
	  		var acc_num = [];
	  		var isbldglot = false;
			for(var i=0;i<masterhot.countRows();i++){
				if(masterhot.getDataAtCell(i, 2) === 'BUILDING LOT'){
					acc_num.push(masterhot.getDataAtCell(i, 0));
					isbldglot = true;
				}
			}
	  		
	  		if(isbldglot){
	  			for(var i=0;i<maxrow;i++){
					bldgDataObject.push({bldgnum:'',reffinfo:'',artype:'',arlevel:'',arcate:'',arzone:'',aruse:'',
							ardesc:'',dimention:'',arcnt:'',uom:'',totsize:'',fltype:'',walltype:'',celingtype:''});
				}
	  		}

			var bldgElement = document.querySelector('#bldgtable');
			var bldgElementContainer = bldgElement.parentNode;
			var bldgSettings = {
				data: bldgDataObject,
				columns: [
					{
						data: 'bldgaccnum',
						type: 'dropdown',
					  	source: acc_num,
					  	allowEmpty: false
					},
					{
					  	data: 'bldgnum',
						type: 'text',
					  	allowEmpty: false
					},
					{
					  	data: 'bldgcate',
					  	type: 'dropdown',
					  	source: bldgcate,
						allowEmpty: false
					},
					{
					  	data: 'bldgttype',
						type: 'dropdown',
					  	source: bldgtype,
						allowEmpty: false
					},
					{
						data: 'bldgstorey',
						type: 'dropdown',
					  	source: bldgstore,
						allowEmpty: false
					},
					{
						data: 'bldgcond',
						type: 'dropdown',
					  	source: bldgcond,
						allowEmpty: false
					},
					{
						data: 'bldgpos',
						type: 'dropdown',
					  	source: bldgpos,
						allowEmpty: false
					},
					{
					  data: 'bldgstructure',
						type: 'dropdown',
					  	source: bldgstructure,
						allowEmpty: false
					},
					{
					  data: 'rooftype',
						type: 'dropdown',
					  	source: rooftype,
					  	allowEmpty: false
					},
					{
					  data: 'walltype',
						type: 'dropdown',
					  	source: walltype,
					  	allowEmpty: false
					},
					{
					  	data: 'floortype',
						type: 'dropdown',
					  	source: fltype,
					  	allowEmpty: false
					},
					{
					  	data: 'cccdt',
						type: 'date',
		      		  	dateFormat: 'DD/MM/YYYY',
					  	allowEmpty: false
					},
					{
					  	data: 'occupieddt',
						type: 'date',
		      		  	dateFormat: 'DD/MM/YYYY',
					  	allowEmpty: false
					},
					{
					  	data: 'mainbldg',
					  	type: 'dropdown',
					  	source: ['Y','N'],
					  	allowEmpty: false
					}
				],
				minRows: 0,
				maxRows: 100,
			  	//contextMenu: true,
				contextMenu: {
		          items: {
		            
			        "row_above": {
			          name: 'Add 5 rows above',
			          callback: function(key, options) {
			            bldghot.alter('insert_row', bldghot.getSelected()[0], 5)
			          }
			        },
			        "row_below": {
			          name: 'Add 5 rows below',
			          callback: function(key, options) {
			            bldghot.alter('insert_row', bldghot.getSelected()[0]+1, 5)
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
				fixedColumnsLeft: 2,
		    	rowHeaders: true,
				colWidths: [150, 200, 150, 150, 150, 150,200, 200, 200, 200,150, 150, 150, 150,150],
				dataSchema: {bldgaccnum:'',bldgnum:'',bldgcate:'',bldgttype:'',bldgstorey:'',bldgcond:'',
							bldgpos:'',bldgstructure:'',rooftype:'',walltype:'',floortype:'',
							cccdt:'',occupieddt:'',mainbldg:''},
				colHeaders: [
					'ACC NUMBER',
					'BUILDING NUMBER',
					'BUILDING CATEGORY',
					'BUILDING TYPE',
					'BUILDING STOREY',
					'BUILDING CONDITION',
					'BUILDING POSITION',
					'BUILDING STRUCTURE',
					'ROOF TYPE',
					'WALL TYPE',
					'FLOOR TYPE',
					'CCC DATE',
					'OCCUPIED DATE',
					'MAIN BUILDING'


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


			bldghot = new Handsontable(bldgElement, bldgSettings);
			

			bldghot.addHook('beforeAutofill', function (start, end, data) {
		      console.log('beforeAutofill')
		      if(start.col == 1 ){
		      for(var k = 0; k <= (end.col - start.col); k++) {
		      	console.log(k)
		      	if (k != 2 && k !=3 && k !=4 && k !=5){
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



		      }
		    })

		    bldghot.addHook('afterAutofill', function (start, end, data) {
		    	console.log('afterAutofill');
			      for(var i=0;i<bldghot.countRows();i++) {			    	
			    		//bldghot.setCellMeta(i, bldghot.propToCol('bldgcond'), 'source', bldgcond);
			    		//bldghot.setDataAtRowProp(row, 'bldgcate', cur_bldgcate);
			    	if(bldghot.getDataAtCell(i, 2) !== ''){
						var cur_bldgcate = bldghot.getDataAtCell(i,2);
						var param = 'bldgtype'
						$.ajax({
						  url: "childparam",
						  cache: false,
						  data:{param_value:cur_bldgcate,param:param},
						  success: function(data){
						  	

				    		bldghot.setCellMeta(row, bldghot.propToCol('bldgttype'), 'source', data.res_arr);
			        		bldghot.setDataAtRowProp(i, 'bldgttype', data.res_arr[0]);

				    		bldghot.setCellMeta(i, bldghot.propToCol('bldgstorey'), 'source', data.storey_arr);
			        		bldghot.setDataAtRowProp(i, 'bldgstorey', data.storey_arr[0]);
						  }
						});	    		
				    }
				}
		    })




			bldghot.addHook('afterChange', function(changes, src) {
				if (src === 'loadData' || src === 'internal' || changes.length > 1) {
		    		return;
		    	}
			    //console.log(changes, src);
			    var row = changes[0][0];
			    var prop = changes[0][1];
			    var value = changes[0][3];

			  

				if(prop === 'bldgcate'){
					var cur_bldgcate = bldghot.getDataAtCell(row,2);
					var param = 'bldgtype'
					$.ajax({
					  url: "childparam",
					  cache: false,
					  data:{param_value:cur_bldgcate,param:param},
					  success: function(data){
					  	

			    		bldghot.setCellMeta(row, bldghot.propToCol('bldgttype'), 'source', data.res_arr);
		        		bldghot.setDataAtRowProp(row, 'bldgttype', data.res_arr[0]);

			    		bldghot.setCellMeta(row, bldghot.propToCol('bldgstorey'), 'source', data.storey_arr);
		        		bldghot.setDataAtRowProp(row, 'bldgstorey', data.storey_arr[0]);
					  }
					});
				}

			
	  		});
			
			
		 	for(var i=0;i<masterhot.countRows();i++) {			    	
			    		//bldghot.setCellMeta(i, bldghot.propToCol('bldgcond'), 'source', bldgcond);
			    		//bldghot.setDataAtRowProp(row, 'bldgcate', cur_bldgcate);
			    	if(masterhot.getDataAtCell(i, 2) === 'BUILDING LOT'){
						bldghot.setDataAtRowProp(i, 'bldgaccnum', acc_num[i]);				    		
				    }
			}
			    		

			
			
			}
		});

	//}

});