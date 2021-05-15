<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>{{__('officialsearch.New_Property')}} </title>


@include('includes.header-popup')
	<div id="content">
		<div class="grid_container">

		<div id="usertable" class="grid_6">	
			<br>
        
				<div style="float:right;margin-right: 0px;"  class="btn_24_blue">	      
          
          <a href="#" id="" onclick="validateGroup()" class=""><span>{{__('common.Update')}}  </span></a> 
          <a href="#" id="" onclick="window.close()" class=""><span>{{__('common.Close')}}  </span></a> 
				</div>

				<br>
        
				<div class="widget_wrap">					
					<div class="widget_content">						
						<h3 id="title">{{__('officialsearch.Application')}} </h3>
            <form id="addgroupfrom" autocomplete="off" class="" method="get" action="#" >
              @csrf
              <input type="hidden" name="id" id="id" value="{{$id}}">
              <input type="hidden" name="operation" id="operation" value="2">
              <div  class="grid_12 form_container left_label">
                <ul>
                  <li>                
                    <div class="form_grid_12">                  
                      <label class="field_title" id="termname" for="termid">{{__('officialsearch.Applicant_Name')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="name"  name="name" autocomplete="off" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>                
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Address1')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="addrln1"  name="addrln1" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>                
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Address2')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="addrln2"  name="addrln2" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>             
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Address3')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="addrln3"  name="addrln3" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>             
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Address4')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="addrln4"  name="addrln4" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>             
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.City')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="city"  name="city" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>              
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Postcode')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="postcode"  name="postcode" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>               
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.State')}} <span class="req">*</span></label>
                      <div class="form_input">
                         <select data-placeholder="Choose a Status..." style="width:100%" class="cus-select" id="state" name="state" tabindex="20">
                          @foreach ($state as $rec)
                              <option value='{{ $rec->state_id }}'>{{ $rec->state }}</option>
                          @endforeach 
                        </select>
                      </div>
                      <span class=" label_intro"></span>
                    </div>           
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Applicant_Ref')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="appref"  name="appref" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>                   
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Our_Ref')}} <span class="req">*</span></label>
                      <div class="form_input">
                        <input id="ref" name="ref" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>                  
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Date')}} Date<span class="req">*</span></label>
                      <div class="form_input">
                        <input id="date" name="date" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>                  
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Hijri_Date')}} Hijri Date<span class="req">*</span></label>
                      <div class="form_input">
                        <input id="hdate"  name="hdate" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>                   
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">{{__('officialsearch.Letter_Date')}} Letter Date<span class="req">*</span></label>
                      <div class="form_input">
                        <input id="letterdate"  name="letterdate" type="text"  value="{{ old('term') }}" />
                      </div>
                      <span class=" label_intro"></span>
                    </div>        
                    <div class="form_grid_12">                  
                      <label class="field_title" id="lblgroup" for="name">Group Id<span class="req">*</span></label>
                      <div class="form_input">
                        
                        <select placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="group" name="group" tabindex="2">
                          <option value=""></option>                          
                            @foreach ($group as $rec)
                                <option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
                            @endforeach 
                        </select>
                      </div>
                      <span class=" label_intro"></span>
                    </div>        
                  </li>
                </ul>
              </div>
              
              <div style="height: 48px; float: none; display: -webkit-box;text-align: -webkit-center;" class="grid_12">
                
                <div class="form_input">
                 <!-- <button id="addsubmit" name="adduser" onclick="validateGroup()" class="btn_small btn_blue"><span>Submit</span></button>    --> 
                            
              <!--    <button id="close" onclick="closeGroup()" name="close" type="button" class="btn_small btn_blue"><span>Close</span></button>-->
                  <span class=" label_intro"></span>
                </div>
                
                <span class="clear"></span>
              </div>
            </form>
					</div>
				</div>
			</div>
      
	</div>

  
        
	<span class="clear"></span>
</div>
<script>
function validateGroup(){
    var transdata = {};
    $('#addgroupfrom').serializeArray().map(function(x){transdata[x.name] = x.value;});

    //console.log(transdata);
    var transjson = JSON.stringify(transdata);

    var id =$('#id').val();
    var type = "addapplication";
    $.ajax({
        type:'GET',
        url:'addapplicationdata',
        data:{jsondata:transjson,id:id},
        success:function(data){   
          alert("Application Updated");
          closeWindow();
        }
    });
  }

$(document).ready(function (){

  @foreach ($property as $master)
      $("#name").val('{{$master->os_applnname}}');
      $("#addrln1").val('{{$master->os_applnaddr_ln1}}');
      $("#addrln2").val('{{$master->os_applnaddr_ln2}}');
      $("#addrln3").val('{{$master->os_applnaddr_ln3}}');
      $("#addrln4").val('{{$master->os_applnaddr_ln4}}');
      $("#city").val('{{$master->os_city}}');
      $("#postcode").val('{{$master->os_postcode}}');
      $("#state").val('{{$master->os_state}}');
      $("#appref").val('{{$master->os_applnno}}');
      $("#ref").val('{{$master->os_ref}}');
      $("#date").val('{{$master->os_applndate}}');
      $("#hdate").val('{{$master->os_applnhijridate}}');
      $("#letterdate").val('{{$master->os_applnletterdate}}');
      $("#group").val('{{$master->os_applngroup_id}}');
  @endforeach

  $( "#letterdate" ).datepicker({dateFormat: 'dd/mm/yy'});
  $( "#date" ).datepicker({dateFormat: 'dd/mm/yy'});
  
   

  
});
  
</script>
</body>
</html>