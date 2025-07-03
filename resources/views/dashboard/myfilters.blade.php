
    <div class="panel panel-warning">
  <div class="panel-heading">
  <h3 class="panel-title">Select Location</h3>
  <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
  </div>
  <div class="panel-body">
    @if($national != 0)
  <input type="radio" value="nat" onchange="setchecks()" name="mycheckb1" checked> National <br>
    @endif


  @if($province != 0)
  <input type="radio" value="pro" onchange="setchecks()" name="mycheckb1" @if($national == 0) checked @endif> Provincial <br>
  @foreach($provinces as $rows)
    <?php $myp = App\Province::where('id', $rows->id)->first();?>
    &emsp; <input type="checkbox" style="  -webkit-appearance: none !important;
    -moz-appearance: none !important;
    appearance: none !important;
    border: none !important;
    outline: none !important;" class="text-muted" name="mycheckb" @if($national == 0) checked @endif value="{{$rows->id}}" > {{$myp->title}} <br>
  @endforeach
  @endif

  @if($federal != 0)
  <input type="radio" value="fed" onchange="setchecks()" name="mycheckb1" checked> Federal <br>
    @endif

  @if($division != 0)
  <input type="radio" value="div" onchange="setchecks()" name="mycheckb1" > Division Wise <br>
  @endif

  @if($district != 0)
<input type="radio" value="dis" onchange="setchecks()" name="mycheckb1" > District Wise <br>
  @endif
{{--
  <button class="btn btn-xs btn-primary pull-right" onclick="getcustomgraphoption()">Switch to custom graph view</button>

--}}
  </div>
  </div>
