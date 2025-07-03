<div id="addindicatorInfo" class="modal modal-adminpro-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog" style="width: 900px;">
        <div class="modal-content">
            <div class="modal-header " style="background-color: #BCA0D8;">
                <h4 class="modal-title"><i class="fa fa-pencil"></i>Add  Indicator</h4>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>

            <form method="Post" action="{{ route('indicatorinfo.store')}}">
            <div class="modal-body">
                <!-- <i class="fa fa-plus modal-check-pro"></i> -->
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                      <label class="pull-left">Select Survey Level<span style="color:red">*</span></label>
                      <select name="survey_level"  id="survey_level" onchange="setpro()"  required class="form-control" >
                     @foreach(EF::getSurveyLevels() as $rows)

                          <option value="{{$rows}}">{{$rows}}</option>
                        @endforeach
                       {{-- <option selected value="National">National</option>
                        <option value="Province">Provincial</option>
                        --}}
                      </select>
                     </div>
                     <div id="prov" style="display:none;width:100%">
                     <div class="col-md-12" >
                     <label class="pull-left"> Province<span style="color:red">*</span></label>
                     <select name="province_id"  id="province_id" onchange="getdivisionsfun()" class="form-control" >
                       <option value="">Select Province</option>
                       @foreach($provinces as $province)
                       <option value="{{$province->id}}">{{$province->title}}</option>
                       @endforeach
                     </select>
                    </div>

                    <div class="col-md-6" id="mydiv">
                    <label class="pull-left">Division</label>
                    <select name="division_id"  id="division_id"  class="form-control" onchange="getdistricts()" >
                      <option value="">Select Divisions</option>
                    </select>
                   </div>

                   <div class="col-md-6" id="mydis">
                   <label class="pull-left">District</label>
                   <select name="district_id"  id="district_id"   class="form-control" >
                     <option value="">Select District</option>
                   </select>
                   </div>
                 </div>

                  </div>
<hr>

<div class="row">
  <div class="col-md-12">
  <h6>Generic Disaggregation Level</h6></div>
              <div class="col-md-4">
            <label>Sex</label>
            <select name="sex" class="form-control">
            <option value="">Select Option</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Transgender">Transgender</option>
            </select>
              </div>

              <div class="col-md-4">
            <label>Age Group</label>
            <input type="text" name="age" class="form-control"></input>
              </div>

              <div class="col-md-4">
            <label>Residence</label>
            <select name="residence" class="form-control">

            <option value="">Select Option</option>

            <option value="Urban">Urban</option>
            <option value="Rural">Rural</option>

            </select>
              </div>

</div>
<hr>
<div class="row">
  <div class="col-md-12">
  <h6>Specific Disaggregation Level</h6></div>

  <div id="duphead" style="width:100%">
            <div class="col-md-6 rmc">
            <label>Specific Disaggregation Name 1</label>
            <input type="text" name="specific_name1" class="form-control"></input>
            </div>

            <div class="col-md-6 rmc">
            <label>Specific Disaggregation Description 1</label>
            <input type="text" name="specific_description1" class="form-control"></input>
            </div>


            <div class="col-md-6 rmc">
            <label>Specific Disaggregation Name 2</label>
            <input type="text" name="specific_name2" class="form-control"></input>
            </div>

            <div class="col-md-6 rmc">
            <label>Specific Disaggregation Description 2</label>
            <input type="text" name="specific_description2" class="form-control"></input>
            </div>

            <div class="col-md-6 rmc">
            <label>Specific Disaggregation Name 3</label>
            <input type="text" name="specific_name3" class="form-control"></input>
            </div>

            <div class="col-md-6 rmc">
            <label>Specific Disaggregation Description 3</label>
            <input type="text" name="specific_description3" class="form-control"></input>
            </div>
            </div>

</div>
<hr>

                  <div class="row">
                   
                    <div class="col-md-12">
                    <button class="btn btn-sm btn-primary" style="margin-left: 80%;margin-bottom:1%;" onclick="addDataSource(event,this)"><i class="fa fa-plus"></i> Add Others </button>
                    <label class="pull-left">Data Source<span style="color:red">*</span></label>
                    <select name="data_source_name"  id="data_source_name" required class="form-control datasource_list" >
                    @foreach($data_source_list as $rows)
                      <option value="{{$rows}}">{{$rows}}</option>
                    @endforeach
                    </select>
                    <!-- <input type="text" name="data_source_name" id="data_source_name"  required class="form-control"></input> -->

                   </div>

                   <div class="col-md-12" id="ddid" style="display:none">
                   <label class="pull-left">Data Source Name<span style="color:red">*</span></label>
                   <input class="form-control" name="ddname"></input>

                  </div>

                  <div class="col-md-12">
                  <label class="pull-left">Nature</label>
                  <select name="nature" class="form-control" id="natureindi">
                  <option value="Secondary">Secondary</option>
                  <option value="Syntax">Syntax</option>
                  </select>
                 </div>

                   <input value="{{Crypt::encrypt($indicator->id)}}" type="hidden" name="indicator_id"/>



                   <div class="col-md-6">
                   <label class="pull-left">Source Link</label>
                   <input class="form-control" type="text" name="source_link" >
                  </div>

                  <div class="col-md-6">
                  <label class="pull-left">Level Of Measurement</label>
                  <input class="form-control" type="text" name="unit" >
                 </div>

                 <div class="col-md-6">
                 <label class="pull-left">Base Year</label>
                 <select name="base_year" class="form-control" >
                   <option selected value="None">Select</option>
                   @foreach(EF::getYearsList() as $rows)
                     <option value="{{$rows}}">{{$rows}}</option>
                   @endforeach
                 
                 </select>
                </div>

                <div class="col-md-6">
                <label class="pull-left">Base Value (Previous)</label>
                <input class="form-control" type="text" name="base_value" >
               </div>

                <div class="col-md-6">
                <label class="pull-left">Current Year</label>
                <select name="current_year" class="form-control" >
                  <option selected value="None">Select</option>
                      @foreach(EF::getYearsList() as $rows)
                        <option value="{{$rows}}">{{$rows}}</option>
                      @endforeach
                </select>
                </div>

                  <div class="col-md-6">
                  <label class="pull-left">Current Value </label>
                  <input class="form-control" type="text" name="current_value" >
                </div>

                <div class="col-md-12" style="padding:10px;margin-top:5px;">

                  <div class="row">
                    <div class="col-md-12"> <h5>Survey Duration</h5></div>
                    <div class="col-md-5">
                    <label class="pull-left">Lower Year</label>
                    <input class="form-control" type="text" name="lower_year" >
                    </div>
                    <div class="col-md-2"><h4 style="margin-top: 30px;">To</h4></div>
                    <div class="col-md-5">
                    <label class="pull-left">Upper Year</label>
                    <input class="form-control" type="text" name="upper_year" >
                    </div>
                  </div>
                </div>


             <div class="col-md-12">
             <label class="pull-left">Foot Note</label>
             <input class="form-control" type="text" name="footnote" >
            </div>




                  <!-- <div class="col-md-12">
                    <label class="pull-left">Availability</label>
                    <div class="chosen-select-single mg-b-20">

                  <select name="last_updated[]" class="chosen-select" multiple="" tabindex="-1" >
                    <option selected value="None">None</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="2009">2009</option>
                    <option value="2008">2008</option>
                    <option value="2007">2007</option>
                    <option value="2006">2006</option>
                  </select>
                </div>
                 </div> -->
                  </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-primary">Cancel</button>
                <input type="submit" class="btn btn-success" value="Add Info"></input>
            </div>
            </form>
        </div>
    </div>
</div>
