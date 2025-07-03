
<div class="row">
<div class="col-md-12">
  <a class="btn btn-xs btn-primary pull-right" onclick="getheadindicator()" style="width:10%" href="#" ><i class="fa fa-pencil"></i> </a>
  <a  class="btn btn-xs btn-primary pull-right" onclick="getdeleteindihead()" style="width:10%;margin-right: 10px;" href="#" ><i class="fa fa-trash"></i> </a>

</div>


<div class="col-md-4">
<label>Please Select Sex</label>
<select name="filtersex" id="filtersex" class="form-control">
  <option value="All">All</option>
  @foreach($indisex as $is)
  <option value="{{$is->sex}}">{{$is->sex}}</option>
  @endforeach
</select>
</div>

<div class="col-md-4">
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

<div class="col-md-4">
<label>Please Select Residence</label>
<select name="filterresidence" id="filterresidence" class="form-control">
  <option value="All">All</option>
  @foreach($indresidence as $ir)
  <option value="{{$ir->residence}}">{{$ir->residence}}</option>
  @endforeach
</select>
</div>

<?php $t1= 0;?>
@foreach($infoarr as $arr)
<?php
  $nneww  = $headspec->where('information_id' , $arr)->where('specific_title' , '!=' , "");
$var = -1;
 ?>
 @foreach($nneww as $nbv)
 <?php
 $var++;
  ?>
 @if($var == 0)
<?php $t1++;?>
@endif
@endforeach
@endforeach

@if($t1 > 0)
<div class="col-md-6">
<label>Disaggregation Name 1</label>
<select name="filtername1" id="filtername1" class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspec->where('information_id' , $arr)->where('specific_title' , '!=' , "");
$var = -1;
   ?>
   @foreach($nneww as $nbv)
   <?php
   $var++;
    ?>
   @if($var == 0)
  <option value="{{$nbv->specific_title}}">{{$nbv->specific_title}}</option>
  @endif
  @endforeach
  @endforeach
</select>
</div>

<div class="col-md-6">
<label>Disaggregation Description 1</label>
<select name="filterdescription1" id="filterdescription1" class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspecname->where('information_id' , $arr)->where('specific_name' , '!=' , "");
$var = -1;
   ?>
   @foreach($nneww as $nbv)
   <?php
   $var++;
    ?>
   @if($var == 0)
  <option value="{{$nbv->specific_name}}">{{$nbv->specific_name}}</option>
  @endif
  @endforeach
  @endforeach
</select>
</div>
@endif



<?php $t2 = 0;?>
@foreach($infoarr as $arr)
<?php
  $nneww  = $headspec->where('information_id' , $arr)->where('specific_title' , '!=' , "");
$var = -1;
 ?>
 @foreach($nneww as $nbv)
 <?php
 $var++;
  ?>
 @if($var == 1)
<?php $t2++; ?>
@endif
@endforeach
@endforeach

@if($t2 > 0)
<div class="col-md-6">
<label>Disaggregation Name 2</label>
<select name="filtername2" id="filtername2" class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspec->where('information_id' , $arr)->where('specific_title' , '!=' , "");
$var = -1;
   ?>
   @foreach($nneww as $nbv)
   <?php
   $var++;
    ?>
   @if($var == 1)
  <option value="{{$nbv->specific_title}}">{{$nbv->specific_title}}</option>
  @endif
  @endforeach
  @endforeach
</select>
</div>

<div class="col-md-6">
<label>Disaggregation Description 2</label>
<select name="filterdescription2" id="filterdescription2" class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspecname->where('information_id' , $arr)->where('specific_name' , '!=' , "");
$var = -1;
   ?>
   @foreach($nneww as $nbv)
   <?php
   $var++;
    ?>
   @if($var == 1)
  <option value="{{$nbv->specific_name}}">{{$nbv->specific_name}}</option>
  @endif
  @endforeach
  @endforeach
</select>
</div>
@endif


<?php $t3 = 0; ?>
@foreach($infoarr as $arr)
<?php
  $nneww  = $headspec->where('information_id' , $arr)->where('specific_title' , '!=' , "");
$var = -1;
 ?>
 @foreach($nneww as $nbv)
 <?php
 $var++;
  ?>
 @if($var == 2)
<?php $t3++;?>
@endif
@endforeach
@endforeach

@if($t3 > 0)
<div class="col-md-6">
<label>Disaggregation Name 3</label>
<select name="filtername3" id="filtername3" class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspec->where('information_id' , $arr)->where('specific_title' , '!=' , "");
$var = -1;
   ?>
   @foreach($nneww as $nbv)
   <?php
   $var++;
    ?>
   @if($var == 2)
  <option value="{{$nbv->specific_title}}">{{$nbv->specific_title}}</option>
  @endif
  @endforeach
  @endforeach
</select>
</div>

<div class="col-md-6">
<label>Disaggregation Description 3</label>
<select name="filterdescription3" id="filterdescription3" class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspecname->where('information_id' , $arr)->where('specific_name' , '!=' , "");
$var = -1;
   ?>
   @foreach($nneww as $nbv)
   <?php
   $var++;
    ?>
   @if($var == 2)
  <option value="{{$nbv->specific_name}}">{{$nbv->specific_name}}</option>
  @endif
  @endforeach
  @endforeach
</select>
</div>
@endif


<?php $t4=0; ?>
@foreach($infoarr as $arr)
<?php
  $nneww  = $headspec->where('information_id' , $arr)->where('specific_title' , '!=' , "");
$var = -1;
 ?>
 @foreach($nneww as $nbv)
 <?php
 $var++;
  ?>
 @if($var == 3)
<?php $t4++; ?>
@endif
@endforeach
@endforeach

@if($t4 > 0)
<div class="col-md-6">
<label>Disaggregation Name 4</label>
<select name="filtername4" id="filtername4" class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspec->where('information_id' , $arr)->where('specific_title' , '!=' , "");
$var = -1;
   ?>
   @foreach($nneww as $nbv)
   <?php
   $var++;
    ?>
   @if($var == 3)
  <option value="{{$nbv->specific_title}}">{{$nbv->specific_title}}</option>
  @endif
  @endforeach
  @endforeach
</select>
</div>

<div class="col-md-6">
<label>Disaggregation Description 4</label>
<select name="filterdescription4" id="filterdescription4" class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspecname->where('information_id' , $arr)->where('specific_name' , '!=' , "");
$var = -1;
   ?>
   @foreach($nneww as $nbv)
   <?php
   $var++;
    ?>
   @if($var == 3)
  <option value="{{$nbv->specific_name}}">{{$nbv->specific_name}}</option>
  @endif
  @endforeach
  @endforeach
</select>
</div>
@endif


<?php $t5 = 0;?>
@foreach($infoarr as $arr)
<?php
  $nneww  = $headspec->where('information_id' , $arr)->where('specific_title' , '!=' , "");
$var = -1;
 ?>
 @foreach($nneww as $nbv)
 <?php
 $var++;
  ?>
 @if($var == 4)
<?php $t5++; ?>
@endif
@endforeach
@endforeach

@if($t5 > 0)
<div class="col-md-6">
<label>Disaggregation Name 5</label>
<select name="filtername5" id="filtername5" class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspec->where('information_id' , $arr)->where('specific_title' , '!=' , "");
$var = -1;
   ?>
   @foreach($nneww as $nbv)
   <?php
   $var++;
    ?>
   @if($var == 4)
  <option value="{{$nbv->specific_title}}">{{$nbv->specific_title}}</option>
  @endif
  @endforeach
  @endforeach
</select>
</div>

<div class="col-md-6">
<label>Disaggregation Description 5</label>
<select name="filterdescription5" id="filterdescription5" class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspecname->where('information_id' , $arr)->where('specific_name' , '!=' , "");
    $var = -1;
   ?>
   @foreach($nneww as $nbv)
   <?php
   $var++;
    ?>
   @if($var == 4)
  <option value="{{$nbv->specific_name}}">{{$nbv->specific_name}}</option>
  @endif
  @endforeach
  @endforeach
</select>
</div>
@endif

<div class="col-md-12" style="margin-top:10px;">
  <button class="btn btn-success pull-right" onclick="filterindicatorsearch()">Filter</button>
</div>

<div class="col-md-12">
<label>Please Select Headline Indicator</label>
<select class="form-control" name="headline_indicator" id="headline_indicator" onchange="filterindicatorchild()">
  <option value='0'>Select Headline Indicator</option>
  @foreach($info as $in)
    <option value="{{Crypt::encrypt($in->id)}}">
      {{$in->data_source_name}}-@if($in->survey_level == "National")National
      @else {{$in->province->title}} @endif
      @if($in->year_two == null && $in->year_one != null)
      - {{$in->year_one}}
      @elseif($in->year_one == null && $in->year_two != null)
      - {{$in->year_two}}
      @elseif($in->year_two != null && $in->year_one != null)
      - ({{$in->year_one}} - {{$in->year_two}})
      @endif</option>
  @endforeach
</select>
</div>
</div>
