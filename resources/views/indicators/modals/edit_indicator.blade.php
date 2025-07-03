<div id="indicatorAdd" class="modal modal-adminpro-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title"><i class="fa fa-pencil"></i>Edit Indicator</h4>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>

            <form method="Post" action="{{route('requirement.storenew')}}">
            <div class="modal-body">
                <!-- <i class="fa fa-plus modal-check-pro"></i> -->
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                      <input type="hidden" name="sub_theme" id="indicatorsubtheme" required>
                      <input type="hidden" name="sub_theme_key" id="indicatorsubthemekey" required>
                     </div>

                     <div class="col-md-12" style="margin-top:5px;">
                       <label class="pull-left">Enter Indicator Name<span style="color:red">*</span></label>
                       <input class="form-control" type="text" name="data_requirement" value="{{$indicator->data_requirement}}">
                     </div>


                      <div class="col-md-12">
                        <label class="pull-left">Select SDG<span style="color:red">*</span></label>
                        <select class="form-control" required name="sdg" id="sdg_id" onchange="sdgchange()">
                          <option value="0">Please Select SDG</option>
                          @foreach($new_goals as $newgoal)
                          <option  value="{{ Crypt::encrypt($newgoal->id)}}">{{$newgoal->goal_number}} {{$newgoal->goal_name}}</option>
                          @endforeach
                        </select>
                      </div>



                      <div class="col-md-12">
                        <label class="pull-left">Select SDG Target<span style="color:red">*</span></label>
                        <select class="form-control" required name="target" id="targets" onchange="targetchange()">
                          <option value="0">Please Select SDG Target</option>
                        </select>
                      </div>

                      <div class="col-md-12">
                        <label class="pull-left">Select SDG Indicator<span style="color:red">*</span></label>
                        <select class="form-control" required name="indicator" id="indicators">
                          <option value="0">Please Select SDG Indicator</option>
                        </select>
                      </div>

                      <div class="col-md-12">
                        <label class="pull-left">Select Beijings + 25</label>
                        <select class="form-control"  name="beijing_id" id="beijing_id" >
                          <option value="{{ Crypt::encrypt(0)}}">Please Select Beijing + 25</option>
                          @foreach($new_beijings as $new_beijing)
                          <option value="{{ Crypt::encrypt($new_beijing->id)}}">{{$new_beijing->target_number}} {{$new_beijing->indicator_name}}</option>
                          @endforeach
                        </select>
                      </div>
  </div>

                    <div class="row" style="padding-top: 10px;padding-bottom: 10px;border: 0px solid #eee;margin-top: 10px;margin-bottom: 10px;">
                      <div class="col-md-12">
                        <h5><b>Qualitative Indicators</b></h5>
                        <p style="color:red">(Note: In case of N/A leave input field null)</p>
                      </div>

                      <div class="col-md-12" style="margin-top:5px;">
                        <label class="pull-left">Constitutional & Legal Provisions</label>
                        <input class="form-control" type="text" name="legal_name">
                      </div>

                      <div class="col-md-12">
                        <label class="pull-left">Policy & Institutional Arrangements</label>

                        <input class="form-control" type="text" name="policy_nane">
                      </div>


                    </div>

                                       <div class="row">
                                         <div class="col-md-12">
                                         <label class="pull-left">CEDAW Link</label>
                                         <input class="form-control" type="text" name="link">
                                         </div>
                                        </div>

                    <!-- <div class="row">

                         <div class="col-md-12">
                         <label class="pull-left">Remarks</label>
                         <input class="form-control" type="text" name="remarks">
                        </div>

                  </div> -->
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-primary">Cancel</button>
                <input type="submit" class="btn btn-success" value="Add Indicator"></input>
            </div>
            </form>
        </div>
    </div>
</div>
