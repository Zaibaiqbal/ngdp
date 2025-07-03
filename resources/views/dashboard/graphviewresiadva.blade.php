
  <!-- <div class="col-md-6">

    <div class="panel panel-success">
<div class="panel-heading">
<h3 class="panel-title">Others</h3>
<span class="pull-right clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-down"></i></span>
</div>
<div class="panel-body" style="display:none">

<input type="radio" name="filter2"> Location vs Gender vs Residence <br>
<input type="radio" name="filter2"> Location vs Gender vs Age <br>
<input type="radio" name="filter2"> Location vs Residence vs Age <br>
<input type="radio" name="filter2"> Location vs Specific Disaggregation <br>
</div>
</div>

</div> -->

  <!-- <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item active">
        <a class="nav-link active" data-toggle="tab" href="#home">Graph</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link active" data-toggle="tab" href="#menu1">Tables</a>
      </li>
    </ul> -->

    <!-- Tab panes -->
    <!-- <div id="home" class="container tab-pane "><br>
      <div style="width:500px !important">
      <canvas id="chart-line" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px !important; height: 200px;"></canvas>
    </div>
    </div> -->
      <table id="example" class="table table-responsive">
  <thead>
    <tr>
      <th >#</th>
      <th >Type</th>
      @if($info->where('province_id' , '!=' , '')->count() > 0 )
      <th >Province</th>
      @endif
      @if($info->where('division_id' , '!=' , '')->count() > 0 )
      <th >Division</th>
      @endif
      @if($info->where('district_id' , '!=' , '')->count() > 0 )
      <th >District</th>
      @endif
      @if($info->where('age_group' , '!=' , '')->count() > 0 )
      <th >Age Group</th>
      @endif
      @if($info->where('sex' , '!=' , '')->count() > 0 )
      <th >Sex</th>
      @endif
      @if($info->where('residence' , '!=' , '')->count() > 0 )
      <th >Residence</th>
      @endif
      <th >Value</th>
      @if($info->where('unit' , '!=' , '')->count() > 0 )
      <th >Unit</th>
      @endif
      @if($info->where('specific_name1' , '!=' , '')->count() > 0 )
      <th >Disaggregation Title 1</th>
      @endif
      @if($info->where('specific_description1' , '!=' , '')->count() > 0 )
      <th >Disaggregation Description 1</th>
      @endif
      @if($info->where('specific_name2' , '!=' , '')->count() > 0 )
      <th >Disaggregation Title 2</th>
      @endif
      @if($info->where('specific_description2' , '!=' , '')->count() > 0 )
      <th >Disaggregation Description 2</th>
      @endif
      @if($info->where('specific_name3' , '!=' , '')->count() > 0 )
      <th >Disaggregation Title 3</th>
      @endif
      @if($info->where('specific_description3' , '!=' , '')->count() > 0 )
      <th >Disaggregation Description 3</th>
      @endif
      <th >Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($info as $i)
    <tr>
      <th>{{$loop->iteration}}</th>
      <td>{{$i->survey_level}}</td>
      @if($info->where('province_id' , '!=' , '')->count() > 0 )
      <td>@if($i->survey_level == "Province"){{$i->province->title}} @endif</td>
      @endif

      @if($info->where('division_id' , '!=' , '')->count() > 0 )
      <td>@if($i->division_id != ""){{$i->division->title}} @endif</td>
      @endif

      @if($info->where('district_id' , '!=' , '')->count() > 0 )
      <td>@if($i->district_id != ""){{$i->district->title}} @endif</td>
      @endif

      @if($info->where('age_group' , '!=' , '')->count() > 0 )
      <td>{{$i->age_group}}</td>
      @endif

      @if($info->where('sex' , '!=' , '')->count() > 0 )
      <td>{{$i->sex}}</td>
      @endif

      @if($info->where('residence' , '!=' , '')->count() > 0 )
      <td>{{$i->residence}}</td>
      @endif

      @if($i->unit == "Number")
      <td>{{EF::numberFormat($i->current_value)}}</td>

      @else
    <td>{{$i->current_value}}</td>
      @endif

      @if($info->where('unit' , '!=' , '')->count() > 0 )
      <td>{{$i->unit}}</td>
      @endif

      @if($info->where('specific_name1' , '!=' , '')->count() > 0 )
      <td>{{$i->specific_name1}}</td>
      @endif

      @if($info->where('specific_description1' , '!=' , '')->count() > 0 )
      <td>{{$i->specific_description1}}</td>
      @endif

      @if($info->where('specific_name2' , '!=' , '')->count() > 0 )
      <td>{{$i->specific_name2}}</td>
      @endif

      @if($info->where('specific_description2' , '!=' , '')->count() > 0 )
      <td>{{$i->specific_description2}}</td>
      @endif

      @if($info->where('specific_name3' , '!=' , '')->count() > 0 )
      <td>{{$i->specific_name3}}</td>
      @endif

      @if($info->where('specific_description3' , '!=' , '')->count() > 0 )
      <td>{{$i->specific_description3}}</td>
      @endif
<td>

@if(isset(Auth::user()->id) && Auth::user()->hasAnyPermission(['All','Edit Portal']))
  <a class="btn btn-xs" onclick="getheadindicator({{$i->id}})"><i class="fa fa-pencil"></i></a> <a onclick="getdeleteindihead({{$i->id}})"><i class="fa fa-trash"></i></a>
@endif
</td>
    </tr>
    @endforeach
  </tbody>
  <!-- <tfoot>
            <tr>
              <th >#</th>
              <th >Type</th>
              <th >Province</th>
              <th >Age Group</th>
              <th >Sex</th>
              <th >Residence</th>
              <th >Value</th>
              <th >Specific Name 1</th>
              <th >Specific Description 1</th>
              <th >Specific Name 2</th>
              <th >Specific Description 2</th>
              <th >Specific Name 3</th>
              <th >Specific Description 3</th>
            </tr>
        </tfoot> -->
</table>
