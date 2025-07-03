<script type="text/javascript">
var province_ids = [];
  function provinceFilter(event,obj,province_id)
  {

    if($(obj).prop('checked') == false)
    {

      province_ids.push($(obj).val());

    }
    else
    {
        province_ids = jQuery.grep(province_ids, function(value) {

            return value != $(obj).val();
        });
    }

    var indicator_id = $("#indicator_id").val();
    var data_source = $("#data_source").val();
    var year = $("#year").val();
    var type = $("input:radio[name=naturecheck]:checked").val();

    var value = "Province"

    $.ajax({
      type : 'post',
      url : "{{ route('filterprovince')}}",
      data:{"province_ids":province_ids,"indicator_id":indicator_id,"value" : value,"data_source":data_source,"year":year,"type":type,"_token": "{{ csrf_token() }}"},
      success:function(data){
        $('#mygraphview').html("<h4 style='margin-top: 50px;'>No graph available for the selection</h4>");
        $('#mygraphview').html(data.view);

        if(data.mycount == 0)
        {
          $('#mygraphview').html("<h4 style='margin-top: 50px;'>No graph available for the selection</h4>");
          filterindicatoradvance(1);
        }
        else
        {
                  mysetg();
                    filterindicatoradvance(1);
        }
      }
      });

  }

  

var data_source_list = @json($data_source_list);

function addDataSource(event,obj)
  {
      event.preventDefault();

         $('#md_add_datasource_dropdown').modal('show');
  }
 function addDataSourceInList(event,obj)
  {
     var  new_data = $('input[name=new_data]').val();
     count = 0;
     $.each(data_source_list,function(index,val){
        
          if(new_data == val)
          {
             count++;
          }
     })


     if(count == 0)
     {
        data_source_list.push(new_data)
     }
     var view = '';
     $.each(data_source_list,function(index,val){

      view+='<option>'+val+'</option>';

     });

     $('select[name=data_source_name]').html(view);

     $('#md_add_datasource_dropdown').modal('hide');

  }

function sdgchange()
{
  var id = $("#sdg_id").val();

  $('#sdg_id option[value="0"]').attr('disabled','disabled');
  $.ajax({
      type : 'post',
      url : "{{ route('gettargets')}}",
      data:{"id":id,"_token": "{{ csrf_token() }}"},
      success:function(data){
      if(data != 0)
      {
      $('#targets').html(data);
      }
      else{
        alert('something went wrong');
      }
      }
      });
}


function getdivisionsfun()
{
  var id = $("#province_id").val();
  $.ajax({
      type : 'post',
      url : "{{ route('getdivisions')}}",
      data:{"id":id,"_token": "{{ csrf_token() }}"},
      success:function(data){
      $('#division_id').html(data);
      $('#district_id').html("");
      }
      });
}


function getdistricts()
{
  var id = $("#division_id").val();
  $('#division_id option[value="0"]').attr('disabled','disabled');
  $.ajax({
      type : 'post',
      url : "{{ route('getdistricts')}}",
      data:{"id":id,"_token": "{{ csrf_token() }}"},
      success:function(data){
      if(data != 0)
      {
      $('#district_id').html(data);
      }
      else{
        alert('something went wrong');
      }
      }
      });
}


function getdivisionsfun2()
{
  var id = $("#province_id2").val();
  $.ajax({
      type : 'post',
      url : "{{ route('getdivisions')}}",
      data:{"id":id,"_token": "{{ csrf_token() }}"},
      success:function(data){
      $('#division_id2').html(data);
      $('#district_id2').html("");
      }
      });
}


function getdistricts2()
{
  var id = $("#division_id2").val();
  $.ajax({
      type : 'post',
      url : "{{ route('getdistricts')}}",
      data:{"id":id,"_token": "{{ csrf_token() }}"},
      success:function(data){
      if(data != 0)
      {
      $('#district_id2').html(data);
      }
      else{
        alert('something went wrong');
      }
      }
      });
}




@if(Session::has('success1'))
Lobibox.notify('success', {
    msg: '{!! Session::get('success1') !!}'
});
@endif

function setsource()
{

  if($("#data_source_name").val() == "Other")
  {
    document.getElementById("ddid").style.display = "block";
    $('#natureindi option[value="Secondary"]').removeAttr('disabled');
    $('#natureindi option[value="Primary"]').removeAttr('disabled');
  }
  else{
    $('#natureindi option[value="Primary"]').attr('disabled','disabled');
    $('#natureindi option[value="Secondary"]').removeAttr('disabled');
    $('#natureindi').val('Secondary');
    document.getElementById("ddid").style.display = "none";
  }
}


function setsource1()
{

  if($("#data_source_name1").val() == "Other")
  {
    document.getElementById("ddid1").style.display = "block";

  }
  else{

    document.getElementById("ddid1").style.display = "none";
  }
}


function setpro()
{

  if($("#survey_level").val() == "Province")
  {
    document.getElementById("prov").style.display = "block";
    document.getElementById("prov2").style.display = "block";
    document-getElementByID("province_id").addClass('required');
  }
  else{
    document.getElementById("prov").style.display = "none";
    document.getElementById("prov2").style.display = "none";
  }
}


function editinfo(id,sourcename,last_updated,source_link)
{
  $("#data_source_name1").val(sourcename);
  $("#info_id").val(id);
  $("#source_link").val(source_link);
  // $("#lastyear").val(last_updated);
  // $("#editindicatorInfo").show();

}


var golbmvc = 1;
function mydup()
{
  if(golbmvc < 5)
   {
  var $button = $('#setdup');
  $('#dup').clone().appendTo($button);
  golbmvc++;
  }
  else{
    alert("limit for 5 to add");
  }
}


 var golbv = 1;
function myduphead()
{ if(golbv < 5)
  {
  var $button = $('#setduphead');
  $('#duphead').clone().appendTo($button);
  golbv++;
  }
  else{
    alert("limit for 5 to add");
  }
}

function removeduphead()
{
var col_wrapper = document.getElementsByClassName("rmc");
var len = col_wrapper.length;

if(len != 2)
{ golbv = golbv-1;
  var sub = len-1;
col_wrapper[sub].remove();
var sub2= len-2;
col_wrapper[sub2].remove();
}

}


function removedupchild()
{
var col_wrapper = document.getElementsByClassName("dupch");
var len = col_wrapper.length;

if(len != 2)
{ golbmvc = golbmvc-1;
  var sub = len-1;
col_wrapper[sub].remove();
var sub2= len-2;
col_wrapper[sub2].remove();
}

}



function filterindicator(ck)
{
  var indicator_id = $("#indicator_id").val();
  var data_source = $("#data_source").val();
  var year = $("#year").val();
  var arr = [];
  var chk = 1;
  var tttt = 0;
  var tv = "nat";
  var type = $("input:radio[name=naturecheck]:checked").val();

  if(ck == 0)
  {
    chk = 1;
    arr.push(tttt);
  }
  else{
    chk = 1;
    tv = $("input:radio[name=mycheckb1]:checked").val();
    if(tv == "nat")
    {
      value = "National";

      arr.push(tttt);
    }
    else if(tv == "fed")
    {
      value = "Federal";

      arr.push(tttt);
    }
     else if(tv == "div")
    {
      value = "Division";
      chk = 2;
      arr.push(tttt);
    }
     else if(tv == "dis")
    {
      value = "District";

      chk  = 3;
      arr.push(tttt)
    }
     else if(tv == "pro"){
      value = "Province";

      $("input:checkbox[name=mycheckb]:checked").each(function(){
                arr.push($(this).val());
             });
    }
    if(arr.length == 0)
    {
      alert("Please Select One");
      return;
    }
  }

  $.ajax({
      type : 'post',
      url : "{{ route('filterindicators')}}",
      data:{"indicator_id":indicator_id,"chk":chk,"value" : value,"arr":arr,"data_source":data_source,"year":year,"type":type,"_token": "{{ csrf_token() }}"},
      success:function(data){
        $('#mygraphview').html("<h4 style='margin-top: 50px;'>No graph available for the selection</h4>");
        $('#mygraphview').html(data.view);

        if(data.mycount == 0)
        {
          $('#mygraphview').html("<h4 style='margin-top: 50px;'>No graph available for the selection</h4>");
          filterindicatoradvance(1);
        }
        else
        {
                  mysetg();
                    filterindicatoradvance(1);
        }
      }
      });
}

function filterindicatorresiadva(ck)
{
  var indicator_id = $("#indicator_id").val();
  var data_source = $("#data_source").val();
  var year = $("#year").val();
  var arr = [];
  var chk = 0;
  var tttt = 0;
  var tv = "nat";
  var value = "";
  var type = $("input:radio[name=naturecheck]:checked").val();
  if(ck ==0)
  {
    chk = 1;
    arr.push(tttt);
  }
  else{
    chk = 1;
    tv = $("input:radio[name=mycheckb1]:checked").val();
    if(tv == "nat")
    {
       value = "National"
      arr.push(tttt);
    }
    else if(tv == "fed"){
       value = "Federal"
      arr.push(tttt);

    }
    else{
    $("input:checkbox[name=mycheckb]:checked").each(function(){
              arr.push($(this).val());
        });
  }
  if(arr.length == 0)
  {
    alert("Please Select One");
    return;
  }
  }

  $.ajax({
      type : 'post',
      url : "{{ route('filterindicatorsresiadva')}}",
      data:{"indicator_id":indicator_id,"chk":chk,"arr":arr,"value":value,"data_source":data_source,"year":year,"type":type,"_token": "{{ csrf_token() }}"},
      success:function(data){
        $('#homem').html("");
        $('#homem').html(data.view);
        setbl();
      }
      });
}

function filterindicatoradva(ck)
{
  var indicator_id = $("#indicator_id").val();
  var data_source = $("#data_source").val();
  var year = $("#year").val();
  var arr = [];
  var chk = 1;
  var tttt = 0;
  var tv = "nat";
  var value = "";
  var type = $("input:radio[name=naturecheck]:checked").val();
  if(ck == 0)
  {
    chk = 1;
    arr.push(tttt);
  }
  else{
    chk = 1;
    tv = $("input:radio[name=mycheckb1]:checked").val();
    if(tv == "nat")
    {
      value = "National"
      arr.push(tttt);
    }
    else if(tv == "fed"){
      value = "Federal"

      arr.push(tttt);
    }
    else{
    $("input:checkbox[name=mycheckb]:checked").each(function(){
              arr.push($(this).val());
           });
  }
  if(arr.length == 0)
  {
    alert("Please Select One");
    return;
  }
  }

  $.ajax({
      type : 'post',
      url : "{{ route('filterindicatorsadva')}}",
      data:{"indicator_id":indicator_id,"chk":chk,"value":value,"arr":arr,"data_source":data_source,"year":year,"type":type,"_token": "{{ csrf_token() }}"},
      success:function(data){
        $('#homem').html("");
        $('#homem').html(data.view);
        setbl();
      }
      });
}


function filterindicatoradvaall(ck)
{
  var indicator_id = $("#indicator_id").val();
  var data_source = $("#data_source").val();
  var year = $("#year").val();
  var arr = [];
  var chk = 1;
  var tttt = 0;
  var tv = "nat";
  var value = "National";
  var type = $("input:radio[name=naturecheck]:checked").val();
  if(ck == 0)
  {
    chk = 1;
    arr.push(tttt);
  }
  else{
    chk = 1;
    tv = $("input:radio[name=mycheckb1]:checked").val();
    if(tv == "nat")
    {
      value = "National";
      arr.push(tttt);
    }
    else if(tv == "fed")
    {
      value = "Federal";
      arr.push(tttt);
    }
    else if(tv == "div")
    {
      value = "Division";
      chk = 2;
      arr.push(tttt);
    }
    else if(tv == "dis")
    {
      value = "District";
      chk  = 3;
      arr.push(tttt);
    }
    else if(tv == "pro"){
      value = "Province";

      $("input:checkbox[name=mycheckb]:checked").each(function(){
                arr.push($(this).val());
             });
    }
  if(arr.length == 0)
  {
    alert("Please Select One");
    return;
  }
  }
  $.ajax({
      type : 'post',
      url : "{{ route('filterindicatorsadvaall')}}",
      data:{"indicator_id":indicator_id,"value":value,"chk":chk,"arr":arr,"data_source":data_source,"year":year,"type":type,"_token": "{{ csrf_token() }}"},
      success:function(data){

        $('#homem').html("");
        $('#homem').html(data.view);
        setbl();

      if(data.view1 == "")
      {
        $('#mygraphview').html("<h4 style='margin-top: 50px;'>No graph available for the selection</h4>");

      }
      else{
        
        $('#mygraphview').html(data.view1);
        showgraph();
      }
      }
      });
}

function filterindicatorspecific2table(ck)
{
  var indicator_id = $("#indicator_id").val();
  var data_source = $("#data_source").val();
  var year = $("#year").val();
  var arr = [];
  var chk = 0;
  var tttt = 0;
  var tv = "nat";
  var value = "";
  var type = $("input:radio[name=naturecheck]:checked").val();

  if(ck ==0)
  {
    chk = 1;
    arr.push(tttt);
  }
  else{
    chk = 1;
    tv = $("input:radio[name=mycheckb1]:checked").val();
    if(tv == "nat")
    {
       value = "National"
      arr.push(tttt);
    }
    else if(tv == "fed"){
       value = "Federal"
      arr.push(tttt);

    }
    else{
    $("input:checkbox[name=mycheckb]:checked").each(function(){
              arr.push($(this).val());
        });
  }
  if(arr.length == 0)
  {
    alert("Please Select One");
    return;
  }
  }

  $.ajax({
      type : 'post',
      url : "{{ route('filterindicatorsspecific2table')}}",
      data:{"indicator_id":indicator_id,"chk":chk,"arr":arr,"value":value,"data_source":data_source,"year":year,"type":type,"_token": "{{ csrf_token() }}"},
      success:function(data){
        $('#homem').html("");
        $('#homem').html(data.view);
        setbl();
      }
      });
}

function filterindicatorspecific3table(ck)
{
  var indicator_id = $("#indicator_id").val();
  var data_source = $("#data_source").val();
  var year = $("#year").val();
  var arr = [];
  var chk = 0;
  var tttt = 0;
  var tv = "nat";
  var value = "";
  var type = $("input:radio[name=naturecheck]:checked").val();

  if(ck ==0)
  {
    chk = 1;
    arr.push(tttt);
  }
  else{
    chk = 1;
    tv = $("input:radio[name=mycheckb1]:checked").val();
    if(tv == "nat")
    {
       value = "National"
      arr.push(tttt);
    }
    else if(tv == "fed"){
       value = "Federal"
      arr.push(tttt);

    }
    else{
    $("input:checkbox[name=mycheckb]:checked").each(function(){
              arr.push($(this).val());
        });
  }
  if(arr.length == 0)
  {
    alert("Please Select One");
    return;
  }
  }

  $.ajax({
      type : 'post',
      url : "{{ route('filterindicatorsspecific3table')}}",
      data:{"indicator_id":indicator_id,"chk":chk,"arr":arr,"value":value,"data_source":data_source,"year":year,"type":type,"_token": "{{ csrf_token() }}"},
      success:function(data){
        $('#homem').html("");
        $('#homem').html(data.view);
        setbl();
      }
      });
}


function filterindicatorspecifictable(ck)
{
  var indicator_id = $("#indicator_id").val();
  var data_source = $("#data_source").val();
  var year = $("#year").val();
  var arr = [];
  var chk = 0;
  var tttt = 0;
  var tv = "nat";
  var value = "";
  var type = $("input:radio[name=naturecheck]:checked").val();

  if(ck ==0)
  {
    chk = 1;
    arr.push(tttt);
  }
  else{
    chk = 1;
    tv = $("input:radio[name=mycheckb1]:checked").val();
    if(tv == "nat")
    {
       value = "National"
      arr.push(tttt);
    }
    else if(tv == "fed"){
       value = "Federal"
      arr.push(tttt);

    }
    else{
    $("input:checkbox[name=mycheckb]:checked").each(function(){
              arr.push($(this).val());
        });
  }
  if(arr.length == 0)
  {
    alert("Please Select One");
    return;
  }
  }

  $.ajax({
      type : 'post',
      url : "{{ route('filterindicatorsspecificadva')}}",
      data:{"indicator_id":indicator_id,"chk":chk,"arr":arr,"value":value,"data_source":data_source,"year":year,"type":type,"_token": "{{ csrf_token() }}"},
      success:function(data){
        $('#homem').html("");
        $('#homem').html(data.view);
        setbl();
      }
      });
}






function filterindicatorresi(ck)
{
  var indicator_id = $("#indicator_id").val();
  var data_source = $("#data_source").val();
  var year = $("#year").val();
  var arr = [];
  var chk = 0;
  var tttt = 0;
  var tv = "nat";
  var type = $("input:radio[name=naturecheck]:checked").val();
  if(ck ==0)
  {
    chk = 1;
    arr.push(tttt);
  }
  else{
    chk = 1;
    tv = $("input:radio[name=mycheckb1]:checked").val();
    if(tv == "nat")
    {
      value= "National";
      arr.push(tttt);
    }
    else if(tv == "fed")
    {
      value = "Federal";
      arr.push(tttt);
    }
    else if(tv = "pro"){

      value = "Province";

    $("input:checkbox[name=mycheckb]:checked").each(function(){
              arr.push($(this).val());
           });
  }
  if(arr.length == 0)
  {
    alert("Please Select One");
    return;
  }
  }

  $.ajax({
      type : 'post',
      url : "{{ route('filterindicatorsresi')}}",
      data:{"indicator_id":indicator_id,"chk":chk,"value":value,"arr":arr,"data_source":data_source,"year":year,"type":type,"_token": "{{ csrf_token() }}"},
      success:function(data){
        $('#mygraphview').html("");
        $('#mygraphview').html(data.view);
        if(data.mycount == 0)
        {
          $('#mygraphview').html("<h4 style='margin-top: 50px;'>No graph available for the selection</h4>");
          filterindicatoradvance(1);
        }
        else
        {
                  mysetg();
                  filterindicatoradvance(1);
        }
      }
      });
}




function filterindicatorspecific1(ck)
{
  
  var indicator_id = $("#indicator_id").val();
  var data_source = $("#data_source").val();
  var year = $("#year").val();
  var arr = [];
  var chk = 0;
  var tttt = 0;
  var tv = "nat";
  var type = $("input:radio[name=naturecheck]:checked").val();
  if(ck ==0)
  {
    chk = 1;
    arr.push(tttt);
  }
  else{
    chk = 1;
    tv = $("input:radio[name=mycheckb1]:checked").val();
    if(tv == "nat")
    {
      value = "National";

      arr.push(tttt);
    }
    if(tv == "fed")
    {
      value = "Federal";
      arr.push(tttt);
    }
    if(tv == "pro"){
      value = "Province";

    $("input:checkbox[name=mycheckb]:checked").each(function(){
              arr.push($(this).val());
           });
  }
  if(arr.length == 0)
  {
    alert("Please Select One");
    return;
  }
  }

  $.ajax({
      type : 'post',
      url : "{{ route('filterindicatorsspecific1')}}",
      data:{"indicator_id":indicator_id,"chk":chk,"value":value,"arr":arr,"data_source":data_source,"year":year,"type":type,"_token": "{{ csrf_token() }}"},
      success:function(data){
        $('#mygraphview').html("");
        $('#mygraphview').html(data.view);
        if(data.mycount == 0)
        {
          $('#mygraphview').html("<h4 style='margin-top: 50px;'>No graph available for the selection</h4>");
          filterindicatoradvance(1);
        }
        else
        {
                  mysetg();
                  filterindicatoradvance(1);
        }
      }
      });
}

</script>





<script>
function filterindicatorspecific2(ck)
{
  var indicator_id = $("#indicator_id").val();
  var data_source = $("#data_source").val();
  var year = $("#year").val();
  var arr = [];
  var chk = 0;
  var tttt = 0;
  var tv = "nat";
  var type = $("input:radio[name=naturecheck]:checked").val();
  var value = '';
  if(ck ==0)
  {
    chk = 1;
    arr.push(tttt);
  }
  else{
    chk = 1;
    tv = $("input:radio[name=mycheckb1]:checked").val();
    if(tv == "nat")
    {
      arr.push(tttt);
      value = "National";
    }
    else if(tv == "fed")
    {
      arr.push(tttt);
      value = "Federal";

    }
    else{
    $("input:checkbox[name=mycheckb]:checked").each(function(){
              arr.push($(this).val());
           });
  }
  if(arr.length == 0)
  {
    alert("Please Select One");
    return;
  }
  }

  $.ajax({
      type : 'post',
      url : "{{ route('filterindicatorsspecific2')}}",
      data:{"indicator_id":indicator_id,"chk":chk,"arr":arr,"data_source":data_source,"value":value,"year":year,"type":type,"_token": "{{ csrf_token() }}"},
      success:function(data){
        $('#mygraphview').html("");
        $('#mygraphview').html(data.view);

        if(data.mycount == 0)
        {
          $('#mygraphview').html("<h4 style='margin-top: 50px;'>No graph available for the selection</h4>");
          filterindicatoradvance(1);
        }
        else
        {
                  mysetg();
                  filterindicatoradvance(1);
        }
      }
      });
}



function filterindicatorspecific3(ck)
{
  var indicator_id = $("#indicator_id").val();
  var data_source = $("#data_source").val();
  var year = $("#year").val();
  var arr = [];
  var chk = 0;
  var tttt = 0;
  var tv = "nat";
  var type = $("input:radio[name=naturecheck]:checked").val();
  if(ck ==0)
  {
    chk = 1;
    arr.push(tttt);
  }
  else{
    chk = 1;
    tv = $("input:radio[name=mycheckb1]:checked").val();
    if(tv == "nat")
    {
      arr.push(tttt);
    }
    else{
    $("input:checkbox[name=mycheckb]:checked").each(function(){
              arr.push($(this).val());
           });
  }
  if(arr.length == 0)
  {
    alert("Please Select One");
    return;
  }
  }

  $.ajax({
      type : 'post',
      url : "{{ route('filterindicatorsspecific3')}}",
      data:{"indicator_id":indicator_id,"chk":chk,"arr":arr,"data_source":data_source,"year":year,"type":type,"_token": "{{ csrf_token() }}"},
      success:function(data){
        $('#mygraphview').html("");
        $('#mygraphview').html(data.view);
        if(data.mycount == 0)
        {
          $('#mygraphview').html("<h4 style='margin-top: 50px;'>No graph available for the selection</h4>");
          filterindicatoradvance(1);
        }
        else
        {
                  mysetg();
                  filterindicatoradvance(1);
        }
      }
      });
}


function filterindicatorage(ck)
{
  var indicator_id = $("#indicator_id").val();
  var data_source = $("#data_source").val();
  var year = $("#year").val();
  var arr = [];
  var chk = 0;
  var tttt = 0;
  var tv = "nat";
  var value = "";
  var type = $("input:radio[name=naturecheck]:checked").val();
  if(ck ==0)
  {
    chk = 1;
    arr.push(tttt);
  }
  else{
    chk = 1;
    tv = $("input:radio[name=mycheckb1]:checked").val();
    if(tv == "nat")
    {
      arr.push(tttt);
      value = "National";
    } 
    else if(tv == "fed")
    {
      arr.push(tttt);
      value = "Federal";

    }
    else{
    $("input:checkbox[name=mycheckb]:checked").each(function(){
        arr.push($(this).val());
      });
  }
  if(arr.length == 0)
  {
    alert("Please Select One");
    return;
  }
  }
  $.ajax({
      type : 'post',
      url : "{{ route('filterindicatorsage')}}",
      data:{"indicator_id":indicator_id,"chk":chk,"arr":arr,"data_source":data_source,"value":value,"year":year,"type":type,"_token": "{{ csrf_token() }}"},
      success:function(data){
        $('#homem').html("");
        $('#homem').html(data.view);
        setbl();
        if(data.view1 == "")
        {
          $('#mygraphview').html("<h4 style='margin-top: 50px;'>No graph available for the selection</h4>");

        }
        else{
          
          $('#mygraphview').html(data.view1);
          mysetg();
        }
      
      }
      });
}

function filterindicatorsearch()
{
  var indicator_id = $("#indicator_id").val();
  var type = $("#type").val();
  var data_source = $("#data_source").val();
  var year = $("#year").val();
  var filtersex = $("#filtersex").val();
  var filterage = $("#filterage").val();
  var filterresidence = $("#filterresidence").val();
  var filtername1 = $("#filtername1").val();
  var filterdescription1 = $("#filterdescription1").val();
  var filtername2 = $("#filtername2").val();
  var filterdescription2 = $("#filterdescription2").val();
  var filtername3 = $("#filtername3").val();
  var filterdescription3 = $("#filterdescription3").val();
  var filtername4 = $("#filtername4").val();
  var filterdescription4 = $("#filterdescription4").val();
  var filtername5 = $("#filtername5").val();
  var filterdescription5 = $("#filterdescription5").val();
$('#setdataview').html("<h3>No Selection Done Yet</h3>");
  $.ajax({
      type : 'post',
      url : "{{ route('filterindicatorssearch')}}",
      data:{"filtername1":filtername1,"filtername2":filtername2,"filtername3":filtername3,"filtername4":filtername4,"filtername5":filtername5,"filterdescription3":filterdescription3,"filterdescription5":filterdescription5,"filterdescription4":filterdescription4,
      "filterdescription2":filterdescription2,"filterdescription1":filterdescription1,"indicator_id":indicator_id,"type":type,"data_source":data_source,"year":year,"filtersex":filtersex,"filterage":filterage,"filterresidence":filterresidence,"_token":"{{ csrf_token() }}"},
      success:function(data){
      $('#headline_indicator').html(data);
      document.getElementById("setdataview").style.display = "block";
      }
      });
}

function filterindicatorchild()
{
  var headline_id = $("#headline_indicator").val();

  $.ajax({
      type : 'post',
      url : "{{ route('filterindicatorschild')}}",
      data:{"headline_id":headline_id,"_token": "{{ csrf_token() }}"},
      success:function(data){
      $('#setdataview').html(data);
      }
      });
}

function searchchilds()
{
  var headline_id = $("#headline_indicator").val();
  var age_group = $("#age_group").val();
  var sex = $("#sex").val();
  var residence = $("#residence").val();
  var district = $("#district").val();
  var division = $("#division").val();
  var stitle = $("#stitle").val();
  var title = $("#title").val();
  var sname = $("#sname").val();
  var sfiltername1 = $("#sfiltername1").val();
  var sfilterdescription1 = $("#sfilterdescription1").val();
  var sfiltername2 = $("#sfiltername2").val();
  var sfilterdescription2 = $("#sfilterdescription2").val();
  var sfiltername3 = $("#sfiltername3").val();
  var sfilterdescription3 = $("#sfilterdescription3").val();
  var sfiltername4 = $("#sfiltername4").val();
  var sfilterdescription4 = $("#sfilterdescription4").val();
  var sfiltername5 = $("#sfiltername5").val();
  var sfilterdescription5 = $("#sfilterdescription5").val();

  $.ajax({
      type : 'post',
      url : "{{ route('filterindicatorschildsearch')}}",
      data:{"sfiltername1":sfiltername1,"sfiltername2":sfiltername2,"sfiltername3":sfiltername3,"sfiltername4":sfiltername4,"sfiltername5":sfiltername5,"sfilterdescription3":sfilterdescription3,"sfilterdescription5":sfilterdescription5,"sfilterdescription4":sfilterdescription4,
      "sfilterdescription2":sfilterdescription2,"sfilterdescription1":sfilterdescription1,"headline_id":headline_id,"age_group":age_group,"sex":sex,
      "residence":residence,"district":district,"title":title,"stitle":stitle,"sname":sname,"division":division,"_token": "{{ csrf_token() }}"},
      success:function(data){
        if(data == 0)
        {
          alert("No data found with this combination");
        }
      else{
      $('#childdata').html(data);
      }
      }
      });
}

function getdeleteindihead(id)
{
  var headline_id = id;
  if(headline_id == 0)
  {
    alert("Please Select Headline Indicator First");
  }

  else{
    $("#head_indi_id").val(headline_id);
    $("#deleteIndihead").modal('show');

    }
}

function getdeleteindisub()
{
  var childid = $("#childid").val();
  if(childid == 0  )
  {
alert("Please Filter Sub Indicator First");

  }

  else{
    $("#sub_indi_id").val(childid);
    $("#deleteIndisub").modal('show');

    }
}

function setchildedit()
{
  var headline_id = $("#headline_indicator").val();
  var age_group = $("#age_group").val();
  var sex = $("#sex").val();
  var residence = $("#residence").val();
  var district = $("#district").val();
  var childid = $("#childid").val();
  if(age_group == 0 && sex == 0 && residence == 0 && district == 0 )
  {
alert("Please Filter Sub Indicator First");

  }

  else{


    $.ajax({
        type : 'post',
        url : "{{ route('getinfosubchild')}}",
        data:{"headline_id":headline_id,"age_group":age_group,
        "sex":sex,"residence":residence,"childid":childid,"district":district,"_token": "{{ csrf_token() }}"},
        success:function(data){
          if(data == 0)
          {
            alert("No data found with this combination");
          }
        else{
        $('#editchildindi').html(data);
        $('#editchildindi').modal('show');
        }
        }
        });
    }
}

function getsurveyyear()
{
  var data_source = $("#data_source").val();
  var indicator_id = $("#indicator_id").val();

    $.ajax({
        type : 'post',
        url : "{{ route('getsurveyyear')}}",
        data:{"data_source":data_source,"indicator_id":indicator_id,"_token": "{{ csrf_token() }}"},
        success:function(data){
          if(data == 0)
          {
            alert("No data found with this combination");
          }
        else{
        $('#year').html(data);
        getmyfiltercheck();
        $("#mygraphview").html("");
        }
        }
        });

}

function getsurveyarea()
{
  var data_source = $("#data_source").val();
  var year = $("#type").val();

    $.ajax({
        type : 'post',
        url : "{{ route('getsurveyarea')}}",
        data:{"data_source":data_source,"year":year,"_token": "{{ csrf_token() }}"},
        success:function(data){
          if(data == 0)
          {
            alert("No data found with this combination");
          }
        else{
        $('#type').html(data);
        }
        }
        });

}


function setdisplay()
{
  var x = document.getElementById("fildiv");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}


function setdisplay2()
{
  var x = document.getElementById("fildiv2");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function getlevel(id)
{
  var sfiltername = "sfiltername"+id;
  var sfilterdescription = "sfilterdescription"+id;
  var value = $("#sfiltername"+id).val();
  var option = $("#sfiltername"+id);
  var myid = $("#sfiltername"+id+" option:selected").data("id");
    $.ajax({
        type : 'post',
        url : "{{ route('getlevel')}}",
        data:{"value":value,"myid":myid,"_token": "{{ csrf_token() }}"},
        success:function(data){
          if(data == 0)
          {
            alert("No data found with this combination");
          }
        else{
        $("#sfilterdescription"+id).html(data);
        }
        }
        });

}

var aggt = 0;
function getmyfilterchecksecond()
{
  var data_source = $("#data_source").val();
  var indicator_id = $("#indicator_id").val();
  var year = $("#year").val();
  var tv = $("input:radio[name=mycheckb1]:checked").val();
  var valuee = "";
  if(tv == "nat")
  {
    valuee = "National";
  }
  if(tv == "fed")
  {
    valuee = "Federal";
  }
  if(tv == "div")
  {
    valuee = "Division";
  }
  if(tv == "dis")
  {
    valuee = "District";
  }
  if(tv == "pro"){
  valuee = "Province";
  }
    $.ajax({
        type : 'post',
        url : "{{ route('myfilterchecksecond')}}",
        data:{"data_source":data_source,"indicator_id":indicator_id,"year":year,"valuee":valuee,"_token": "{{ csrf_token() }}"},
        success:function(data){

          $("#mygraphviewsecond").html(data.view);

          if(data.sex == 0 && data.resi == 0 && data.age == 0 && data.specific1 == 0 && data.specific2 == 0 && data.specific3 == 0)
          {
            aggt = 1;
          }
          else{
            aggt = 0;

          }
          getmyfiltercheckthird();
        }
        });

}

function getmyfiltercheckthird()
{
  var data_source = $("#data_source").val();
  var indicator_id = $("#indicator_id").val();
  var year = $("#year").val();
  var tv = $("input:radio[name=mycheckb1]:checked").val();
  var filter = $("input:radio[name=filter]:checked").val();
  var valuee = "";

  if(tv == "nat")
  {
    valuee = "National";
  }
  if(tv == "fed")
  {
    valuee = "Federal";
  }
  if(tv == "div")
  {
    valuee = "Division";
  }
  if(tv == "dis")
  {
    valuee = "District";
  }
  if(tv == "pro"){
  valuee = "Province";
  }
    $.ajax({
        type : 'post',
        url : "{{ route('myfiltercheckthird')}}",
        data:{"data_source":data_source,"indicator_id":indicator_id,"year":year,"valuee":valuee,"_token": "{{ csrf_token() }}"},
        success:function(data){

          $("#mygraphviewthird").html(data);

          if(tv == "div")
          {
            filterindicatoradvaall();
          }
          else if(tv == "dis")
          {
            filterindicatoradvaall();

          }
          else{
          if(aggt == 1)
          {
            filterindicatoradvaall();
          }
          filterindicatorset(1);
        }

        }
        });

}

function getmyfiltercheck()
{
  var data_source = $("#data_source").val();
  var indicator_id = $("#indicator_id").val();
  var year = $("#year").val();

    $.ajax({
        type : 'post',
        url : "{{ route('myfiltercheck')}}",
        data:{"data_source":data_source,"indicator_id":indicator_id,
        "year":year,"_token": "{{ csrf_token() }}"},
        success:function(data){
          $("#mygraphviewfirst").html(data);
          getmyfilterchecksecond();
        }
        });

}

$(document).on('click', '.panel-heading span.clickable', function(e){
  var $this = $(this);
if(!$this.hasClass('panel-collapsed')) {
  $this.parents('.panel').find('.panel-body').slideUp();
  $this.addClass('panel-collapsed');
  $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
} else {
  $this.parents('.panel').find('.panel-body').slideDown();
  $this.removeClass('panel-collapsed');
  $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
}
})


function filterindicatorset(dissaggregation)
{
  var my = $("input[type='radio'][name='filter']:checked").val();

  if(my == 1)
  {
    filterindicator(1);
  }
  if(my == 2)
  {
    filterindicatorresi(1);
  }
  if(my == 3)
  {
    filterindicatorage(1);
  }
  if(my == 4)
  {
    filterindicatorspecific1(1);
  }

  if(my == 5)
  {
    filterindicatorspecific2(1);
  }

  if(my == 6)
  {
    filterindicatorspecific3(1);
  }

}

function filterindicatoradvance(d)
{
  var my = $("input[type='radio'][name='filter']:checked").val();
  // alert(my);
  if(my == 1)
  {
    filterindicatoradva(1);
  }
  if(my == 2)
  {
    filterindicatorresiadva(1);
  }
  if(my == 3)
  {
    filterindicatorageadva(1);
  }
  if(my == 4)
  {
    filterindicatorspecific2table(1);
  }
  if(my == 5)
  {
    filterindicatorspecifictable(1);
  }
  if(my == 6)
  {
    filterindicatorspecific3table(1);
  }
}

function setchecks() {
  var my = $("input[type='radio'][name='mycheckb1']:checked").val();
  if( my == "pro")
  {
    $("input:checkbox[name=mycheckb]").prop('checked', true);
    getmyfilterchecksecond();
  }
  else{
    $("input:checkbox[name=mycheckb]").prop('checked', false);
    getmyfilterchecksecond();
  }
}


function setbl()

{
  $('#example').DataTable( {

       initComplete: function () {
           this.api().columns().every( function () {
               var column = this;
               var select = $('<select><option value=""></option></select>')
                   .appendTo( $(column.footer()).empty() )
                   .on( 'change', function () {
                       var val = $.fn.dataTable.util.escapeRegex(
                           $(this).val()
                       );

                       column
                           .search( val ? '^'+val+'$' : '', true, false )
                           .draw();
                   } );

               column.data().unique().sort().each( function ( d, j ) {
                   select.append( '<option value="'+d+'">'+d+'</option>' )
               } );
           } );
       },"bSort": false,
   } );
}


setTimeout(
  function()
  {
    getsurveyyear();
  }, 1000);

var iii = 2;

function setico()
{

var element = document.getElementById("myico");
  if(iii % 2 == 0)
  {
    document.getElementById("myico").classList.add("fa-minus");
    document.getElementById("myico").classList.remove("fa-plus");
    iii++;
  }
  else{
      document.getElementById("myico").classList.add("fa-plus");
      document.getElementById("myico").classList.remove("fa-minus");
      iii++;
  }
}

function getheadindicator(id)
{
  var headline_id = id;
  if(headline_id == 0)
  {
    alert("Please Select Source First");
  }

  else{

  $.ajax({
      type : 'post',
      url : "{{ route('getinfoheadline')}}",
      data:{"headline_id":headline_id,"_token": "{{ csrf_token() }}"},
      success:function(data){
      $('#editheadline').html(data);
      $('#editheadline').modal('show');
      }
      });

    }
}

function getcustomgraphoption()
{
  var data_source = $("#data_source").val();
  var indicator_id = $("#indicator_id").val();
  var year = $("#year").val();
  var tv = $("input:radio[name=mycheckb1]:checked").val();
  var valuee = "";
  if(tv == "nat")
  {
    valuee = "National";
  }
  if(tv == "div")
  {
    valuee = "Division";
  }
  if(tv == "dis")
  {
    valuee = "District";
  }
  if(tv == "pro"){
  valuee = "Province";
  }
    $.ajax({
        type : 'post',
        url : "{{ route('getcustomgraphoptionreq')}}",
        data:{"data_source":data_source,"indicator_id":indicator_id,"year":year,"valuee":valuee,"_token": "{{ csrf_token() }}"},
        success:function(data){
          $("#mygraphview").html(data.view);
          getcustomgraphoption2();
        }
        });

}

function getcustomgraphoption2()
{
  var data_source = $("#my_data_source").val();
  var indicator_id = $("#my_indicator_id").val();
  var year = $("#my_year").val();
  var option = $("#option1").val();
  var type = $("#my_type").val();
    $.ajax({
        type : 'post',
        url : "{{ route('getcustomgraphoption2')}}",
        data:{"data_source":data_source,"indicator_id":indicator_id,"year":year,"option":option,"type":type,"_token": "{{ csrf_token() }}"},
        success:function(data){
          $("#option2").html(data.view);
          getcustomgraphoption3();
        }
        });

}

function getcustomgraphoption3()
{
  var data_source = $("#my_data_source").val();
  var indicator_id = $("#my_indicator_id").val();
  var year = $("#my_year").val();
  var option = $("#option1").val();
  var option2 = $("#option2").val();
  var option3 = $("#option3").val();
  var type = $("#my_type").val();
    $.ajax({
        type : 'post',
        url : "{{ route('getcustomgraphoption3')}}",
        data:{"data_source":data_source,"indicator_id":indicator_id,"year":year,"option":option,"option3":option3,"option2":option2,"type":type,"_token": "{{ csrf_token() }}"},
        success:function(data){
          $("#mynewgraphdiv").html(data.view);
          mysetg3();
        }
        });

}
</script>