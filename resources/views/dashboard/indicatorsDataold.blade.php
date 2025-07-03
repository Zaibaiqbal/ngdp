@foreach($info as $data)

  <div class="panel panel-default">
      <div class="panel-heading accordion-head">
          <h4 class="panel-title">
       <a data-toggle="collapse" data-parent="#accordion" href="#cc_{{$loop->iteration}}_c">
       {{$data->data_source_name}}
       -
       @if($data->survey_level == "Provincial")
       {{$data->province->title}}
       @else
       National
       @endif
       - {{$data->current_year}}
     </a>
    </h4>
      </div>
      <div id="cc_{{$loop->iteration}}_c" class="panel-collapse panel-ic collapse @if($loop->iteration == 1)in @endif">
          <div class="panel-body admin-panel-content animated bounce">

            <div class="row">
              <div class="col-md-12">
                <table class="table table-bordered">
                  <tbody>
                    @if($data->survey_level == "Provincial")
                    <tr >
                      <th>Survey Level</th>
                      <td colspan='4'>{{$data->survey_level}}</td>
                      <th>Province</th>
                      <td colspan='4'>{{$data->province->title}}</td>
                    </tr>
                    @else
                    <tr>
                      <th>Survey Level</th>
                      <td colspan='7'>{{$data->survey_level}}</td>
                    </tr>
                    @endif

                    <tr>
                      <th>Sex</th>
                      <td>{{$data->sex}}</td>
                      <th>Age Group</th>
                      <td>{{$data->age_group}}</td>
                      <th>Residence</th>
                      <td>{{$data->residence}}</td>
                      <th>Specific Title / Name</th>
                      <td>{{$data->specific_title}} / {{$data->specific_name}}</td>
                    </tr>
                    <tr>
                      <th>Base Year</th>
                      <td>{{$data->base_year}}</td>
                      <th>Base Value</th>
                      <td>{{$data->base_value}}</td>
                      <th>Current Year</th>
                      <td>{{$data->current_year}}</td>
                      <th>Current Value</th>
                      <td>{{$data->current_value}}</td>
                    </tr>
                    <tr>
                      <th>Unit</th>
                      <td>{{$data->unit}}</td>
                      <th>Footnote</th>
                      <td>{{$data->footnote}}</td>
                      <th>Nature</th>
                      <td>{{$data->nature}}</td>
                      <th>Source Link</th>
                      <td>{{$data->source_link}}</td>
                    </tr>
                  </tbody>

                </table>
              </div>
              <hr style="width:100%;color:black">

              <div class="col-md-12">
                <h4>Child Indicators</h4>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      @if($data->survey_level == "Provincial")
                      <th>Division</th>
                      <th>District</th>
                      @endif
                      <th>Base Value</th>
                      <th>Current Value</th>
                      <th>Footnote</th>
                      <th>Sex</th>
                      <th>Age</th>
                      <th>Specific Title</th>
                      <th>Specific Name</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach($data->childs($data->id) as $child)
                    <tr>
                      @if($data->survey_level == "Provincial")
                      <td>{{$child->division->title}}</td>
                      <td>{{$child->district->title}}</td>
                      @endif
                      <td>{{$child->base_value}}</td>
                      <td>{{$child->current_value}}</td>
                      <td>{{$child->footnote}}</td>
                      <td>{{$child->sex}}</td>
                      <td>{{$child->age_group}}</td>
                      <td>
                        @foreach($child->childspecific($child->id) as $csps)
                        {{$csps->specific_title}} ,
                        @endforeach
                      </td>
                      <td>  @foreach($child->childspecific($child->id) as $csps)
                        {{$csps->specific_name}} ,
                        @endforeach</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>


          </div>
      </div>
  </div>
  @endforeach
