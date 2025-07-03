
<script>

function setthemeid(id)
{
  $("#themesubtheme").val(id);
}
function setsubthemeid(id,key)
{

  $("#indicatorsubtheme").val(id);
  $("#indicatorsubthemekey").val(key);
}
function setsubthemeidtoedit(id,name,theme_id)
{
  $("#subthemeid").val(id);
  $("#subthemenme").val(name);
  $("#subthemenme_themeid").val(theme_id);
}
function deletethemeclick(id)
{
  $("#deletethemeid").val(id);
}
function setsubthemeiddelete(id)
{
  $("#deletesubthemeid").val(id);
}
// function call(id)
// {
//   @if(Auth::user())
//   var url = "{{ route('indicators',':id')}}";
//     url = url.replace(':id', id);
//       window.location.href = url;
//   @else
//   $("#setidroute").val(id);
//    $("#ajaxlogin").modal('show');
//   @endif
// }


function call(id)
{
  var url = "{{ route('indicators',':id')}}";
    url = url.replace(':id', id);
      window.location.href = url;
 
}

$(function() {

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('form.login:first').on('submit', function(e){
    e.preventDefault();

    var $this = $(this);

    $.ajax({
        type: $this.attr('method'),
        url: $this.attr('action'),
        data: $this.serializeArray(),
        dataType: $this.data('type'),
        success: function (response) {
           if(response.success) {
             // location.reload();
             var url = "{{ route('indicators',':id')}}";
             var myid= $("#setidroute").val();
               url = url.replace(':id', myid);
                 window.location.href = url;
           }
           else{
             Lobibox.notify('error', {
                   msg: 'Authrization Failed'
               });
           }
        },
        error: function (jqXHR) {
          var response = $.parseJSON(jqXHR.responseText);
          if(response.message) {
            Lobibox.notify('error', {
                  msg: response.message
              });
          }
        }
    });
  });

});

</script>

<script>
function sdgchange(id)
{
  var aa = "#sdg_id_"+id;
  var bb = "#targets_"+id;

  var id = $(aa).val();

  $('#sdg_id option[value="0"]').attr('disabled','disabled');
  $.ajax({
      type : 'post',
      url : "{{ route('gettargetsnew')}}",
      data:{"id":id,"_token": "{{ csrf_token() }}"},
      success:function(data){
      if(data != 0)
      {
      $(bb).html(data);
      }
      else{
        alert('something went wrong');
      }
      }
      });
}
</script>
<script>
function targetchange(id)
{
  var aa = "#targets_"+id;
  var bb = "#indicators_"+id;
  var id = $(aa).val();

  $('#targets option[value="0"]').attr('disabled','disabled');
  $.ajax({
      type : 'post',
      url : "{{ route('getindicatorsnew')}}",
      data:{"id":id,"_token": "{{ csrf_token() }}"},
      success:function(data){
      if(data != 0)
      {
      $(bb).html(data);
      }
      else{
        alert('something went wrong or no data found');
      }
      }
      });
}
</script>
<script>
$("#droptypechange").change(function () {
        var end = this.value;
        if(end == "qualitative")
        {
          $("#typequalitativechange").css("display","block");
        }
        else{
            $("#typequalitativechange").css("display","none");
        }
    });
</script>


<!-- Tree Viewer JS
============================================ -->
<script src="{{ asset('assets/js/tree-line/jstree.min.js') }}"></script>
<script src="{{ asset('assets/js/tree-line/jstree.active.js') }}"></script>

<script>
@foreach($themes as $theme)
@foreach($theme->subTheme as $subtheme)
  (function ($) {
   "use strict";
   $('#jstree1_{{$subtheme->id}}').jstree({
            'core' : {
                'check_callback' : true
            },
            'plugins' : [ 'types', 'dnd' ],
            'types' : {
                'default' : {
                    'icon' : 'fa fa-link'
                },
                'html' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'svg' : {
                    'icon' : 'fa fa-file-picture-o'
                },
                'css' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'img' : {
                    'icon' : 'fa fa-file-image-o'
                },
                'js' : {
                    'icon' : 'fa fa-file-text-o'
                }

            }
        });
        })(jQuery);
@endforeach
@endforeach
</script>
<script>
function search_indicator()
{
  var value = $("#searchindi").val();
  if(value == null || value == '')
  {

    $('#ulshow').html('');
    document.getElementById('ulshow').style.display = 'none';
  }
  else{
  $.ajax({
      type : 'post',
      url : "{{ route('search_indicator')}}",
      data:{"search":value,"_token": "{{ csrf_token() }}"},
      success:function(data){
      document.getElementById('ulshow').style.display = 'block';
      $('#ulshow').html(data);
      }
      });
    }
}
</script>
<script>
var elList = document.getElementsByClassName('tf-class');
$('.tf-class').addClass('fa-folder').removeClass('fa-link');
</script>

<script>
var globvalue = 0;
function mydup()
{

  if(globvalue == 0)
  {

  var mval = $("#targets").val();
  if(mval != 0)
  {
// var $button = $('#dup').clone();
//   $('#setdup').html($button);
var $button = $('#setdup');
  $('#dup').clone().appendTo($button);
  globvalue++;
}
else{
  alert('select SDG first');
}
}
else{
  var $button = $('#setdup');
    $('#dup').clone().appendTo($button);
}
}
</script>


<script>
@if(Session::get('theme_key') != null)

var my = "themebox_"+{{Session::get('theme_key')}};
var element = document.getElementById(my);
var element2 = document.getElementById("themebox_1");
element2.classList.remove("active");
  element.classList.add("active");

var myt = "mytheme_"+{{Session::get('theme_key')}};
  var element3 = document.getElementById(myt);
  var element4 = document.getElementById("myt_1");
  element4.classList.remove("active");
    element3.classList.add("active");

    <?php Session::forget('theme_key'); ?>
@endif
</script>
<script>
@if(Session::get('sub_theme_key') != null)

var my = "subthemecollaspe_"+{{Session::get('sub_theme_key')}};
var element = document.getElementById(my);
var element2 = document.getElementById("subthemecollaspe_1");
element2.classList.remove("in");
  element.classList.add("in");

    <?php Session::forget('sub_theme_key'); ?>
@endif
</script>

<script>
function getdashboardcounts(id)
{
  var value = id;

  $.ajax({
      type : 'post',
      url : "{{ route('getdashboardcounts')}}",
      data:{"id":value,"_token": "{{ csrf_token() }}"},
      success:function(data){
      $("#subtcount").html(data.subthemecount);
      $("#qualcount").html(data.qualitativecount);
      $("#quantcount").html(data.quantitativecount);
      $("#firstdiv").css("display","block");
      $("#secdiv").css("display","block");
      $("#card_1").removeClass("animate-me");
      $("#card_2").removeClass("animate-me");
      $("#card_3").removeClass("animate-me");
      setTimeout(function(){
        $("#card_1").addClass("animate-me");
        $("#card_2").addClass("animate-me");
        $("#card_3").addClass("animate-me");
      }, 2000);

      }
      });
}
</script>
@if($id != null)
<script>
var iii = {{$id}};
getdashboardcounts(iii);
</script>
@endif
<script>

function showsearch()
{
  var x = document.getElementById("searchdiv");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>



<script>
$(document).ready(function() {
	var max_fields      = 10; //maximum input boxes allowed
	var wrapper   		= $("#mynewdiv"); //Fields wrapper
	var add_button      = $("#add_field_button"); //Add button ID

	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append('<div class="row"><div class="col-md-12">'+
        '<label class="pull-left">Select SDG<span style="color:red">*</span></label>'+
        '<select class="form-control" required name="sdg[]" id="sdg_id_'+x+'" onchange="sdgchange('+x+')">'+
          '<option value="0">Please Select SDG</option>'+
          '@foreach($new_goals as $newgoal)'+
          '<option value="{{ Crypt::encrypt($newgoal->id)}}">{{$newgoal->goal_number}} {{$newgoal->goal_name}}</option>'+
          '@endforeach'+
        '</select>'+
      '</div>'+
      '<div class="col-md-12">'+
        '<label class="pull-left">Select SDG Target<span style="color:red">*</span></label>'+
        '<select class="form-control" required name="target[]" id="targets_'+x+'" onchange="targetchange('+x+')">'+
          '<option value="0">Please Select SDG Target</option>'+
        '</select>'+
      '</div>'+
      '<div class="col-md-12">'+
        '<label class="pull-left">Select SDG Indicator<span style="color:red">*</span></label>'+
        '<select class="form-control" required name="indicator[]" id="indicators_'+x+'">'+
          '<option value="0">Please Select SDG Indicator</option>'+
        '</select>'+
      '</div><a style="margin-left: 15px;" href="#" class="remove_field">Remove</a></div>');
		}
	});

	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});
</script>