<div class="row">
<div class="col-md-12">

<a class="pull-right" href="#" style="color:black;" onclick="setchildedit()"><i class="fa fa-pencil"></i> </a>

<a class="pull-right" href="#" style="color:black;margin-right:10px" onclick="getdeleteindisub()"><i class="fa fa-trash"></i> </a>

</div></div>
<!-- <div class="col-md-12" style="margin-top:20px">
  @if($childid != 0)
  <h4 style="text-align: center;"><b>Sub Indicator</b></h4>
  @else
  <h4 style="text-align: center;"><b>Main indicator</b></h4>
  @endif

</div> -->

<div class="row" style="padding: 10px;
background: #a24187;
margin: 50px;color: white;margin-bottom:0px;">
  <div class="col-md-12">
    <h4 style="color: white;">Current Year: {{$currentyear}}</h4>

  </div>

  <div class="col-md-12">
    <h1 style="text-align: center;color: white">{{$currentvalue}}</h1>
    <br><br>
    <!-- <h3 style="color: white;text-align:center"><u>{{$gender}}</u></h3> -->
    <h3 style="text-align: center;color: white">{{$unit}}</h3>
@if(isset($females) && isset($males))
    <br><br>
    <h4 style="color: white;text-align:center">Female: {{$females}}</h4>
    <br>
    <h4 style="color: white;text-align:center">Male: {{$males}}</h4>
    @endif
  </div>


  <div class="col-md-12" style="margin-top:50px">

    <h4 style="color: white" class="pull-right">Base Year: {{$baseyear}}</h4>
  </div>
  <div class="col-md-12">
    <!-- <h5>Latest Survey Date: {{$baseyear}}</h5> -->
    <h4 class="pull-right" style="color: white">{{$basevalue}} {{$unit}}</h4>
  </div>
<input value="{{$childid}}" type="hidden" name="childid" id="childid"></input>


</div>

<a  class="pull-right" onclick="setdisplay2()" style="margin-right:50px;" > <u>Click for advanced user </u></a>

<!-- <div class="row" style="padding-left: 50px;">
  <div class="col-md-12" >
    <p><b>Foot note:</b>  {{$footnote}}</p>
  </div>
</div> -->
