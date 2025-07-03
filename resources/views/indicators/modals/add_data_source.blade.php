
<!-- Modal ADD BANK -->
<div class="modal fade" id="md_add_datasource_dropdown" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Data Source</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body ">
        <div class = "card">
          <div class ="card-body form-fieldset">
            <div class="row">

          <div class="col-sm-12">
              <label class="label-color">Data Source: <i style = "color:red;">*</i></label>
            <small class="form-errors pull-right req" value="*">{{ $errors->first('status',":message") }}</small>

            <div class="input-group mb-3">
               <input type="text" name="new_data" class="form-control" placeholder="New Data Source">
            </div>
          </div>
               
         </div>
          </div>
        </div>    

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  class="btn btn-primary " onclick="addDataSourceInList(event,this)">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL ADD BANK -->
