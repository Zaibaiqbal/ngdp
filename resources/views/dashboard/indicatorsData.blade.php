<div class="row">
  <div class="col-md-12">
    <h4 style="text-align: center;">{{$headlinename}}</h4>
  </div>

  <div class="col-md-12" id="childdata" style="margin-bottom:50px;">
    @include('dashboard.childdata')
  </div>
  <div class="col-md-12" id="fildiv2" style="display:none">
    <div class="row">
    <div class="col-md-4">
      <label>Age</label>
      <select class="form-control" name="age_group" id="age_group">
        <option value="0">Select Age Group</option>
        @foreach($childindiage as $childage)
        @if($childage->age_group != null)
        <option value="{{$childage->age_group}}">{{$childage->age_group}}</option>
        @endif
        @endforeach
      </select>
    </div>

    <div class="col-md-4">
      <label>Sex</label>
      <select class="form-control" name="sex" id="sex">
        <option value="0">Select Sex/Gender</option>
        @foreach($childindisex as $chilsex)
        @if($chilsex->sex == null)
        <option value="None">None</option>
        @else
        <option value="{{$chilsex->sex}}">{{$chilsex->sex}}</option>
        @endif
        @endforeach
      </select>
    </div>

    <div class="col-md-4">
      <label>Residence</label>
      <select class="form-control" name="residence" id="residence">
        <option value="0">Select Residence</option>
        @foreach($childindresidence as $childresi)
        @if($childresi->residence != null)
        <option value="{{$childresi->residence}}">{{$childresi->residence}}</option>
        @endif
        @endforeach
      </select>
    </div>

    <div class="col-md-4">
      <label>Division</label>
      <select class="form-control" name="division" id="division">
        <option value="0">Select Division</option>
        @foreach($childinddivision as $childdist)
        @if($childdist->division_id != null)
        <option value="{{$childdist->division_id}}">{{$childdist->division->title}}</option>
        @endif
        @endforeach
      </select>
    </div>

    <div class="col-md-4">
      <label>District</label>
      <select class="form-control" name="district" id="district">
        <option value="0">Select District</option>
        @foreach($childinddistrict as $childdist)
        @if($childdist->district_id != null)
        <option value="{{$childdist->district_id}}">{{$childdist->district->title}}</option>
        @endif
        @endforeach
      </select>
    </div>

    <!-- <div class="col-md-12">
      <label>Disaggregation Title/Name</label>
      <select class="form-control" name="stitle" id="stitle">
        <option value="0">Select Title</option>
        @foreach($childname as $cn)
        @if($cn->specific_title != null)
        <option value="{{$cn->specific_title}}">{{$cn->specific_title}}</option>
        @endif
        @endforeach
      </select>
    </div>

    <div class="col-md-12">
      <label>Disaggregation Description</label>
      <select class="form-control" name="sname" id="sname">
        <option value="0">Select Description</option>
        @foreach($childdescription as $cd)
        @if($cd->specific_name != null)
        <option value="{{$cd->specific_name}}">{{$cd->specific_name}}</option>
        @endif
        @endforeach
      </select>
    </div> -->

<!-- vvvvvvvvvv -->

</div>
<div class="row">
<?php $t1= 0;?>
@foreach($infoarr as $arr)
<?php
  $nneww  = $headspec->where('child_information_id' , $arr)->where('specific_title' , '!=' , "");
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
<select name="sfiltername1" id="sfiltername1"  class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspec->where('child_information_id' , $arr)->where('specific_title' , '!=' , "");
$var = -1;
   ?>
   @foreach($nneww as $nbv)
   <?php
   $var++;
    ?>
   @if($var == 0)
  <option value="{{$nbv->specific_title}}" data-id="{{$arr}}">{{$nbv->specific_title}}</option>
  @endif
  @endforeach
  @endforeach
</select>
</div>

<div class="col-md-6">
<label>Disaggregation Description 1</label>
<select name="sfilterdescription1" id="sfilterdescription1" class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspecname->where('child_information_id' , $arr)->where('specific_name' , '!=' , "");
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
  $nneww  = $headspec->where('child_information_id' , $arr)->where('specific_title' , '!=' , "");
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
<select name="sfiltername2" id="sfiltername2" class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspec->where('child_information_id' , $arr)->where('specific_title' , '!=' , "");
$var = -1;
   ?>
   @foreach($nneww as $nbv)
   <?php
   $var++;
    ?>
   @if($var == 1)
  <option value="{{$nbv->specific_title}}" data-id="{{$arr}}">{{$nbv->specific_title}}</option>
  @endif
  @endforeach
  @endforeach
</select>
</div>

<div class="col-md-6">
<label>Disaggregation Description 2</label>
<select name="sfilterdescription2" id="sfilterdescription2" class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspecname->where('child_information_id' , $arr)->where('specific_name' , '!=' , "");
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
  $nneww  = $headspec->where('child_information_id' , $arr)->where('specific_title' , '!=' , "");
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
<select name="sfiltername3" id="sfiltername3" class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspec->where('child_information_id' , $arr)->where('specific_title' , '!=' , "");
$var = -1;
   ?>
   @foreach($nneww as $nbv)
   <?php
   $var++;
    ?>
   @if($var == 2)
  <option value="{{$nbv->specific_title}}" data-id="{{$arr}}">{{$nbv->specific_title}}</option>
  @endif
  @endforeach
  @endforeach
</select>
</div>

<div class="col-md-6">
<label>Disaggregation Description 3</label>
<select name="sfilterdescription3" id="sfilterdescription3" class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspecname->where('child_information_id' , $arr)->where('specific_name' , '!=' , "");
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
  $nneww  = $headspec->where('child_information_id' , $arr)->where('specific_title' , '!=' , "");
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
<select name="sfiltername4" id="sfiltername4"  class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspec->where('child_information_id' , $arr)->where('specific_title' , '!=' , "");
$var = -1;
   ?>
   @foreach($nneww as $nbv)
   <?php
   $var++;
    ?>
   @if($var == 3)
  <option value="{{$nbv->specific_title}}" data-id="{{$arr}}">{{$nbv->specific_title}}</option>
  @endif
  @endforeach
  @endforeach
</select>
</div>

<div class="col-md-6">
<label>Disaggregation Description 4</label>
<select name="sfilterdescription4" id="sfilterdescription4" class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspecname->where('child_information_id' , $arr)->where('specific_name' , '!=' , "");
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
  $nneww  = $headspec->where('child_information_id' , $arr)->where('specific_title' , '!=' , "");
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
<select name="sfiltername5" id="sfiltername5"  class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspec->where('child_information_id' , $arr)->where('specific_title' , '!=' , "");
$var = -1;
   ?>
   @foreach($nneww as $nbv)
   <?php
   $var++;
    ?>
   @if($var == 4)
  <option value="{{$nbv->specific_title}}" data-id="{{$arr}}">{{$nbv->specific_title}}</option>
  @endif
  @endforeach
  @endforeach
</select>
</div>

<div class="col-md-6">
<label>Disaggregation Description 5</label>
<select name="sfilterdescription5" id="sfilterdescription5" class="form-control">
  <option value="All">All</option>
  @foreach($infoarr as $arr)
  <?php
    $nneww  = $headspecname->where('child_information_id' , $arr)->where('specific_name' , '!=' , "");
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


    <div class="col-md-6" style="margin-top:10px;">
      <button style="width:100%" class="btn btn-success" onclick="searchchilds()">Search</button>
    </div>
    <div class="col-md-6" style="margin-top:10px;">
      <button style="width:100%" class="btn btn-danger" onclick="filterindicatorchild()">Reset</button>
    </div>



  </div>
  </div>




</div>
