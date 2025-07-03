<div class="row" style="
    padding: 50px;
">
<input type="hidden" name="my_data_source" id="my_data_source" value="{{$data_source}}">
<input type="hidden" name="my_indicator_id" id="my_indicator_id" value="{{$indicator_id}}">
<input type="hidden" name="my_year" id="my_year" value="{{$year}}">
<input type="hidden" name="my_type" id="my_type" value="{{$type}}">

<div class="col-md-4">
<label>Select Option</label>
<select class="form-control" name="option1" id="option1" onchange="getcustomgraphoption2()">
  @if($sex != 0)
  <option value="sex">Gender / Sex</option>
  @endif

  @if($resi != 0)
  <option value="residence">Residence</option>
  @endif

  @if($age != 0)
  <option value="age_group">Age</option>
  @endif

  @if($specific1 != 0)
  <option value="specific_name1">Specific Disaggregation Title 1</option>
  @endif

  @if($specific2 != 0)
  <option value="specific_name2">Specific Disaggregation Title 2</option>
  @endif

  @if($specific3 != 0)
  <option value="specific_name3">Specific Disaggregation Title 3</option>
  @endif
</select>
</div>




<div class="col-md-4">
<label>Select Option2</label>
<select class="form-control" name="option2" id="option2" onchange="getcustomgraphoption3()">
<option></option>
</select>
</div>


<div class="col-md-4">
<label>Select Option3</label>
<select class="form-control" name="option3" id="option3" onchange="getcustomgraphoption3()">
  @if($sex != 0)
  <option value="sex">Gender / Sex</option>
  @endif

  @if($resi != 0)
  <option value="residence">Residence</option>
  @endif

  @if($age != 0)
  <option value="age_group">Age</option>
  @endif

  @if($specific1 != 0)
  <option value="specific_name1">Specific Disaggregation Title 1</option>
  @endif

  @if($specific2 != 0)
  <option value="specific_name2">Specific Disaggregation Title 2</option>
  @endif

  @if($specific3 != 0)
  <option value="specific_name3">Specific Disaggregation Title 3</option>
  @endif
</select>
</div>

</div>

<div class="row">

<div class="col-md-12" id="mynewgraphdiv">

</div>
</div>
