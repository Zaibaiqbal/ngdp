<div class="modal-dialog" style="width: 900px;">
    <div class="modal-content">
        <div class="modal-header header-color-modal bg-color-1">
            <h4 class="modal-title"><i class="fa fa-pencil"></i>Edit Sub Indicator</h4>
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
        </div>

        <form method="Post" action="{{ route('editInfochild')}}">
        <div class="modal-body">
            <!-- <i class="fa fa-plus modal-check-pro"></i> -->
                @csrf
                <div class="row">
                  <div class="col-md-12" >
                  <label class="pull-left">Select Headline Indicator Info<span style="color:red">*</span></label>
                  <select name="headline_id"  id="headline_id"  required class="form-control" onchange="checkheadline()">
                    <option value="0">Select Headline Indicator</option>
                    @foreach($info as $ii)
                    <option @if($ii->id == $childata->information_id) selected @endif value="{{Crypt::encrypt($ii->id)}}">{{$ii->data_source_name}}
                      -
                      @if($ii->survey_level == "Provincial")
                      {{$ii->province->title}}
                      @else
                      National
                      @endif
                      - {{$ii->current_year}}</option>
                    @endforeach
                  </select>
                 </div>

                 <div class="col-md-6" id="mydiv">
                 <label class="pull-left">Select Division</label>
                 <select name="division_id"  id="division_id2"  class="form-control" onchange="getdistricts2()" >
                   <option value="0">Select Divisions</option>
                   @foreach($divisions as $diiv)
                   <option value="{{Crypt::encrypt($diiv->id)}}">{{$diiv->title}}</option>
                   @endforeach
                 </select>
                </div>

                <div class="col-md-6" id="mydis">
                <label class="pull-left">Select District</label>
                <select name="district_id"  id="district_id2"   class="form-control" >
                  <option value="0">Select District</option>
                </select>
               </div>
              </div>
<hr>

<div class="row">
<h6>Generic Disaggregation Level</h6>
          <div class="col-md-4">
        <label>Sex</label>
        <select name="sex" class="form-control">
        <option @if($childata->sex == "None") selected @endif value="None">None</option>
        <option @if($childata->sex == "Male") selected @endif value="Male">Male</option>
        <option @if($childata->sex == "Female") selected @endif value="Female">Female</option>
        <option @if($childata->sex == "Transgender") selected @endif value="Transgender">Transgender</option>
        </select>
          </div>

          <div class="col-md-4">
        <label>Age Group</label>
        <input type="text" value="{{$childata->age_group}}" name="age" class="form-control"></input>
          </div>

          <div class="col-md-4">
        <label>Residence</label>
        <select name="residence" class="form-control">
        <option @if($childata->residence == "Urban") selected @endif value="Urban">Urban</option>
        <option @if($childata->residence == "Rural") selected @endif  value="Rural">Rural</option>
        <option @if($childata->residence == "None") selected @endif  value="None">None</option>
        </select>
          </div>

</div>
<hr>
<div class="row">
<h6>Specific Disaggregation Level</h6>
<!-- <div class="col-md-12"><a class="pull-right" onclick="mydup()" style="margin:5px;"><i class="fa fa-plus"></i>Add</a>
&nbsp;&nbsp;
<a class="pull-right" onclick="removedupchild()" style="margin:5px;"><i class="fa fa-trash"></i>Remove</a>
</div> -->
@foreach($child_specifics as $hs)
<div id="duphead3">
          <div class="col-md-6 rmc3">
          <label>Specific Disaggregation Name</label>
          <input type="text" value="{{$hs->specific_title}}" name="specific_title[]" class="form-control"></input>
          </div>

          <div class="col-md-6 rmc3">
          <label>Specific Disaggregation Description</label>
          <input type="text" value="{{$hs->specific_name}}" name="specific_name[]" class="form-control"></input>
          </div>
          </div>
@endforeach
        <div id="setdup3">
        </div>


</div>
<hr>

              <div class="row">

                <div class="col-md-12">
                <label class="pull-left">Current Year</label>
                <select name="current_year" class="form-control" >
                  <option @if($childata->current_year == "None") selected @endif value="None">Select</option>
                  <option @if($childata->current_year == "2020") selected @endif value="2020">2020</option>
                  <option @if($childata->current_year == "2019") selected @endif value="2019">2019</option>
                  <option @if($childata->current_year == "2018") selected @endif value="2018">2018</option>
                  <option @if($childata->current_year == "2017") selected @endif value="2017">2017</option>
                  <option @if($childata->current_year == "2016") selected @endif value="2016">2016</option>
                  <option @if($childata->current_year == "2015") selected @endif value="2015">2015</option>
                  <option @if($childata->current_year == "2014") selected @endif value="2014">2014</option>
                  <option @if($childata->current_year == "2013") selected @endif value="2013">2013</option>
                  <option @if($childata->current_year == "2012") selected @endif value="2012">2012</option>
                  <option @if($childata->current_year == "2011") selected @endif value="2011">2011</option>
                  <option @if($childata->current_year == "2010") selected @endif value="2010">2010</option>
                </select>
                </div>
            <div class="col-md-6">
            <label class="pull-left">Base Value (Previous)</label>
            <input class="form-control" value="{{$childata->base_value}}" type="text" name="base_value" >
           </div>



          <div class="col-md-6">
          <label class="pull-left">Current Value </label>
          <input class="form-control" value="{{$childata->current_value}}" type="text" name="current_value" >
         </div>

         <div class="col-md-6">
         <label class="pull-left">FootNote</label>
         <input class="form-control" value="{{$childata->footnote}}" type="text" name="footnote" >
        </div>

        <div class="col-md-6">
        <label class="pull-left">Nature</label>
        <input class="form-control" value="{{$childata->nature}}" type="text" name="nature" >
        <input class="form-control" type="hidden" value="{{$childata->id}}"  name="subline_id" >
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
            <input type="submit" class="btn btn-success" value="Edit Sub Indictor"></input>
        </div>
        </form>
    </div>
</div>
