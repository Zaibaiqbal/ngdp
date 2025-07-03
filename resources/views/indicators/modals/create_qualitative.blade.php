<div id="qualitativeAdd" class="modal modal-adminpro-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title"><i class="fa fa-pencil"></i>Add Qualitative</h4>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>

            <form method="Post" action="{{route('qualitative.store')}}">
            <div class="modal-body">
                <!-- <i class="fa fa-plus modal-check-pro"></i> -->
                    @csrf

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
                        <input value="{{Crypt::encrypt($indicator->id)}}" type="hidden" name="indicator_id"/>
                        <input value="{{Crypt::encrypt($indicator->sub_theme_id)}}" type="hidden" name="sub_theme"/>
                      </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-primary">Cancel</button>
                <input type="submit" class="btn btn-success" value="Add Indicator"></input>
            </div>
            </form>
        </div>
    </div>
</div>
