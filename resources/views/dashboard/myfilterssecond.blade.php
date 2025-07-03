
  <div class="panel panel-info">
  <div class="panel-heading">
  <h3 class="panel-title">Select Disaggregation</h3>
  <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
  </div>
  <div class="panel-body">
    @if($sex != 0)
    <input type="radio" name="filter" checked value="1" onclick="filterindicatorset(1)"> Gender <br>
    @endif
    @if($resi != 0)
    <input type="radio" name="filter" @if($sex == 0) checked @endif value="2" onclick="filterindicatorset(1)"> Residence <br>
    @endif
    @if($age != 0)
    <input type="radio" name="filter" @if($resi == 0) checked @endif value="3" onclick="filterindicatorset(1)"> Age <br>
    @endif
    @if($specific1 != 0)
    @foreach($specific1_name as $rows)

    <input type="radio" name="filter" @if($age == 0) checked @endif value="4" onclick="filterindicatorset(1)"> {{$rows}} <br>
    @endforeach

    @endif
    @if($specific2 != 0)
    <input type="radio" name="filter" @if($specific1 == 0) checked @endif value="5" onclick="filterindicatorset(1)"> {{$specific2_name[0]}} <br>
    @endif
    @if($specific3 != 0)
    @foreach($specific3_name as $rows)

    <input type="radio" name="filter" @if($specific2 == 0) checked @endif value="6" onclick="filterindicatorset(1)"> {{$rows}} <br>

    @endforeach


    @endif

  </div>
  </div>
  <!-- <button style="margin-top:5px" onclick="filterindicatorset(1)" class="btn-sm btn-primary">Filter Results</button> -->



