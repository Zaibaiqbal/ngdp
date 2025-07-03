<div class="col-md-12" style="background: #a24187;
    padding: 5px;">
<label style="color:white">Select Source</label>
<a class="pull-right" style="color:white" onclick="setdisplay()"><u>Click Here For Filters</u></a>
<select class="form-control" name="headline_indicator" id="headline_indicator" onchange="filterindicatorchild()">
  <option value='0'>Select Source</option>
  @foreach($info as $in)
    <option value="{{Crypt::encrypt($in->id)}}">
      {{$in->data_source_name}}-@if($in->survey_level == "National")National
      @else {{$in->province->title}} @endif
      @if($in->year_two == null && $in->year_one != null)
      - {{$in->year_one}}
      @elseif($in->year_one == null && $in->year_two != null)
      - {{$in->year_two}}
      @elseif($in->year_two != null && $in->year_one != null)
      - ({{$in->year_two}} - {{$in->year_one}})
      @endif</option>
  @endforeach
</select>
<a class="btn btn-xs btn-primary pull-right" onclick="getheadindicator()" style="" href="#" ><i class="fa fa-pencil"></i> </a>
<a  class="btn btn-xs btn-primary pull-right" onclick="getdeleteindihead()" style="margin-right: 10px;" href="#" ><i class="fa fa-trash"></i> </a>

</div>
