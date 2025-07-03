
<div class="row">


<div class="col-md-12">
<label>Please Select Sex</label>
<select name="filtersex" id="filtersex" class="form-control">
  <option value="All">All</option>
  @foreach($indisex as $is)
  <option value="{{$is->sex}}">{{$is->sex}}</option>
  @endforeach
</select>
</div>

<div class="col-md-12">
<label>Please Select Age group</label>
<select name="filterage" id="filterage" class="form-control">
  <option value="All">All</option>
  @foreach($indiage as $ia)
  @if($ia != null)
  <option value="{{$ia->age_group}}">{{$ia->age_group}}</option>
  @endif
  @endforeach
</select>
</div>

<div class="col-md-12">
<label>Please Select Residence</label>
<select name="filterresidence" id="filterresidence" class="form-control">
  <option value="All">All</option>
  @foreach($indresidence as $ir)
  <option value="{{$ir->residence}}">{{$ir->residence}}</option>
  @endforeach
</select>
</div>


<div class="col-md-12" style="margin-top:10px;">
  <button class="btn btn-success pull-right" onclick="filterindicatorsearch()">Filter</button>
</div>


</div>
