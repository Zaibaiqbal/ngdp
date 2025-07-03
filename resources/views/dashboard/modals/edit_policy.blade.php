<div id="editPolicy" class="modal modal-adminpro-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title"><i class="fa fa-pencil"></i>Edit Indicator</h4>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>

            <form method="Post" action="{{route('editPolicy')}}">
            <div class="modal-body">
                <!-- <i class="fa fa-plus modal-check-pro"></i> -->
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                      <label class="pull-left">Quantitative Indicator Name<span style="color:red">*</span></label>
                      <input class="form-control" value="{{$indicator->data_requirement}}" type="text" name="data_requirement" required>
                      <input type="hidden"  name="indicator_id" value="{{ Crypt::encrypt($indicator->id)}}" required>
                     </div>
                   </div>
                      <!-- <div class="col-md-12">
                        <label class="pull-left">SDGs<span style="color:red">*</span></label>
                        <select class="form-control" required name="sdg" id="sdg_id" onchange="sdgchange()">

                          @foreach($sdgs as $sdg)
                          <option @if($sdg->id == $indicator->sdg_id) selected @endif value="{{ Crypt::encrypt($sdg->id)}}">{{$sdg->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-12">
                        <label class="pull-left">Targets<span style="color:red">*</span></label>
                        <select class="form-control" required name="target" id="targets">
                          @foreach($targets as $t)
                          <option @if($t->id == $indicator->target_id) selected @endif value="{{ Crypt::encrypt($t->id)}}">{{$t->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-12">
                      <label class="pull-left">Target Name</label>
                      <input class="form-control" type="text" value="{{$indicator->target_name}}" maxlength="200" name="target_name">
                     </div>
                    </div> -->
                    <!-- <div class="row" style="padding-top: 10px;padding-bottom: 10px;border: 1px solid #eee;margin-top: 10px;margin-bottom: 10px;">
                      <div class="col-md-12">
                        <h5><b>Qualitative Indicators</b></h5>
                        <p style="color:red">(Note: In case of N/A leave input field null)</p>
                      </div>
                      <div class="col-md-12" style="margin-top:5px;">
                        <label class="pull-left">Constitutional & Legal Provisions</label>
                        <input class="form-control" type="text" value="{{$indicator->qualitative->policy_name}}" name="policy_nane">
                      </div>

                      <div class="col-md-12">
                        <label class="pull-left">Policy & Institutional Arrangments</label>
                        <input class="form-control" type="text" value="{{$indicator->qualitative->legal_name}}" name="legal_name">
                      </div>

                      <div class="col-md-12">
                      <label class="pull-left">CEDAW Link</label>
                      <input class="form-control" type="text" value="{{$indicator->qualitative->links}}" name="link">
                     </div>
                    </div> -->

                    <div class="row" style="display: none;">

                         <div class="col-md-12">
                         <label class="pull-left">Remarks</label>
                         <input class="form-control" value="{{$indicator->remarks}}" type="text" name="remarks">
                        </div>

                  </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-primary">Cancel</button>
                <input type="submit" class="btn btn-success" value="Edit Indicator"></input>
            </div>
            </form>
        </div>
    </div>
</div>
