//bldgAR
$( document ).ready(function() {

	//if (bldgarhot == undefined){
	   $("#stepy_form-next-3").click(function(){
	   		if(bldgarhot == undefined){
	    	var bldgarDataObject = [];

			for(var i=0;i<maxrow;i++){
				bldgarDataObject.push({bldgnum:'',reffinfo:'',artype:'',arcate:'',arlevel:'',arzone:'',aruse:'',
							ardesc:'',dimention:'',arcnt:'1',uom:'',totsize:'',fltype:'',walltype:'',celingtype:''});
			}

			var acc_num = [];
			//acc_num = bldghot.getDataAtCol(0);  		

			for(var i=0;i<masterhot.countRows();i++){
				if(masterhot.getDataAtCell(i, 2) === 'BUILDING LOT'){
					acc_num.push(masterhot.getDataAtCell(i, 0));
				}
			}

	  		var bldg_num = [];
	  		//bldg_num = bldghot.getDataAtCol(1);
	  		//console.log(masterhot.getDataAtCol(0));

	  		for(var i = 0; i<bldghot.countRows();i++ ){
	  			//var bldg_accno = bldghot.getDataAtCell(i,0);
				//var bldgar_accno = bldgarhot.getDataAtCell(i,0);
				var bldg_no = bldghot.getDataAtCell(i,1);
				//if (bldg_accno === bldgar_accno){
						bldg_num.push(bldg_no);
				//}
		    }
		    
			var bldgArElement = document.querySelector('#bldgartable');
			var bldgArElementContainer = bldgArElement.parentNode;
			var bldgArSettings = {
				data: bldgarDataObject,
				columns: [
					{
					  	data: 'bldgaccnum',
					  	type: 'dropdown',
					  	source: acc_num,
						allowEmpty: false
					},
					{
					  	data: 'bldgnum',
					  	type: 'dropdown',
					  	source: bldg_num,
						allowEmpty: false
					},
					{
					  	data: 'reffinfo',
					  	type: 'text'
					},
					{
						data: 'artype',
						type: 'dropdown',
					  	source: artype,
						allowEmpty: false
					},
					{
						data: 'arcate',
						type: 'dropdown',
					  	source: arcaty,
						allowEmpty: false
					},
					{
						data: 'arlevel',
						type: 'dropdown',
					  	source: arlvl,
						allowEmpty: false
					},
					{
					  	data: 'arzone',
						type: 'dropdown',
					  	source: arzone,
						allowEmpty: false
					},
					{
					  	data: 'aruse',
						type: 'dropdown',
					  	source: aruse,
						allowEmpty: false
					},
					{
					  data: 'ardesc',
					  type: 'text'
					},
					{
					  	data: 'dimention',
					  	type: 'text'
					},
					{
					  	data: 'arcnt',
					  type: 'numeric'
					},
					{
					  	data: 'size',
						type: 'numeric'
					},
					{
					  data: 'uom',
						type: 'dropdown',
					  	source: unitsize,
					  	allowEmpty: false
					},
					{
					  data: 'totsize',
					  type: 'numeric'
					},
					{
					  	data: 'fltype',
						type: 'dropdown',
					  	source: fltype,
					  	allowEmpty: false
					},
					{
					  	data: 'walltype',
						type: 'dropdown',
					  	source: walltype,
					  	allowEmpty: false
					},
					{
					  	data: 'celingtype',
						type: 'dropdown',
					  	source: ceiling,
					  	allowEmpty: false
					}
				],
				minRows: 0,
				maxRows: 100,
		  		
				contextMenu: {
		          items: {
		            
			        "row_above": {
			          name: 'Add 5 rows above',
			          callback: function(key, options) {
			            bldgarhot.alter('insert_row', bldgarhot.getSelected()[0], 5)
			          }
			        },
			        "row_below": {
			          name: 'Add 5 rows below',
			          callback: function(key, options) {
			            bldgarhot.alter('insert_row', bldgarhot.getSelected()[0]+1, 5)
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
				colWidths: [150, 150, 150, 150, 150,200, 200, 200, 200, 150, 150, 150, 150,150, 150, 150, 150],
				dataSchema: {bldgaccnum:'', bldgnum:'',reffinfo:'',artype:'',arcate:'',arlevel:'',arzone:'',aruse:'',
							ardesc:'',dimention:'',arcnt:'1',size:'0',uom:'',totsize:'0',fltype:'',walltype:'',celingtype:''},
				colHeaders: [
					'ACCOUNT NUMBER',
					'BUILDING NUMBER',
					'REFF INFORMATION',
					'AREA TYPE',
					'AREA CATEGORY',
					'AREA LEVEL',
					'AREA ZONE',
					'AREA USE',
					'AREA DESCRIPTION',
					'DIMENTION',
					'AREA COUNT',
					'MEASUREMENT',
					'UNIT OF MEASUREMENT',
					'TOTAL SIZE',
					'FLOOR TYPE',
					'WALL TYPE',
					'CEILLING TYPE'
				]
				
			};


			bldgarhot = new Handsontable(bldgArElement, bldgArSettings);
			bldgarhot.addHook('afterPaste', function(data, coords) {
				//alert(data);
				bldg_num = [];
			    for(var i = 0; i<bldghot.countRows();i++ ){
		  			var bldg_accno = bldghot.getDataAtCell(i,0);
					var bldgar_accno = bldgarhot.getDataAtCell(row,0);
					var bldg_no = bldghot.getDataAtCell(i,1);
					if (bldg_accno === bldgar_accno){
							bldg_num.push(bldg_no);
					}

			    }
			    for(var i = 0; i<bldgarhot.countRows();i++ ){
		  			bldgarhot.setCellMeta(i, bldgarhot.propToCol('bldgnum'), 'source', bldg_num);

			    }
			});

			
			
			bldgarhot.addHook('afterChange', function(changes, src) {
				if (src === 'loadData' || src === 'internal' || changes.length > 1) {
		    		return;
		    	}

		    	
			    //console.log(changes, src);
			    var row = changes[0][0];
			    var prop = changes[0][1];
			    var value = changes[0][3];
			    if(prop === 'bldgaccnum'){
				    bldg_num = [];
				    for(var i = 0; i<bldghot.countRows();i++ ){
			  			var bldg_accno = bldghot.getDataAtCell(i,0);
						var bldgar_accno = bldgarhot.getDataAtCell(row,0);
						var bldg_no = bldghot.getDataAtCell(i,1);
						if (bldg_accno === bldgar_accno){
								bldg_num.push(bldg_no);
						}

				    }

		    		bldgarhot.setCellMeta(row, bldgarhot.propToCol('bldgnum'), 'source', bldg_num);
	        		//bldgarhot.setDataAtRowProp(row, 'bldgnum', bldg_num);
				}

				if(prop === 'reffinfo'){

				}

				if(prop === 'bldgnum'){
				    //bldg_num = [];
				    for(var i = 0; i<bldghot.countRows();i++ ){
			  			var bldgnum = bldgarhot.getDataAtRowProp(row,'bldgnum');
						var arbldgnum = bldghot.getDataAtRowProp(i,'bldgnum');
						var bldgcate = bldghot.getDataAtRowProp(i,'bldgcate');
						if (bldgnum === arbldgnum){
							var param = 'bldgartype'
							$.ajax({
							  url: "childparam",
							  cache: false,
							  data:{param_value:bldgcate,param:param},
							  success: function(data){
					    		bldgarhot.setCellMeta(row, bldgarhot.propToCol('arlevel'), 'source', data.storey_arr);
				        		bldgarhot.setDataAtRowProp(row, 'arlevel', data.storey_arr[0]);

					    		bldgarhot.setCellMeta(row, bldgarhot.propToCol('aruse'), 'source', data.res_arr);
				        		bldgarhot.setDataAtRowProp(row, 'aruse', data.res_arr[0]);
							  }
							});
						}
						
				    }

		    		bldgarhot.setCellMeta(row, bldgarhot.propToCol('bldgnum'), 'source', bldg_num);
	        		//bldgarhot.setDataAtRowProp(row, 'bldgnum', bldg_num);
				}

				if(prop === 'arcnt' || prop === 'size'){
					var arcnt = bldgarhot.getDataAtRowProp(row,'arcnt');
					var size = bldgarhot.getDataAtRowProp(row,'size');
					if (arcnt === 0) {
						size = 1;   
					}
					if (size === 0) {
						size = 1;   
					}
					var totalsize = arcnt * size;
					bldgarhot.setDataAtRowProp(row, 'totsize', totalsize);			
				}
			});

			for(var i=0;i<masterhot.countRows();i++) {
		    	
	    		//var acc = bldgarhot.getCellMeta(i, 0);
	    		//bldgarhot.setCellMeta(i, bldgarhot.propToCol('artype'), 'source', artype);
	    		
	    		if(masterhot.getDataAtCell(i, 2) === 'BUILDING LOT'){
					bldgarhot.setDataAtRowProp(i, 'bldgaccnum', acc_num[i]);
	    			bldgarhot.setDataAtRowProp(i, 'bldgnum', bldg_num[i]);			    		
			    }
	    		
		    }

		}
		});
	//}
});