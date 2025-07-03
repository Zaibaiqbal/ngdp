@php($uniqid = uniqid())
<!-- Modal -->
<div class="modal fade" id="md_add_role" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle"> Add New Role   <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a></h4>
        <div class="modal-close-area modal-close-df">
                  
                </div>
      </div>
      {!! Form::open(array('route' => 'store.role')) !!}
      <div class="modal-body">

        <!--- Form -->

            <div class="form-group row">

                @php($name  = 'name')
                @php($label = 'Name')

                <div class="col-lg-12 col-sm-12">
                    <div class="form-group">
                        
                        <label for="example-text-input">{{$label}}  <i style = "color:red;">*</i></label>
                            <small class="text-danger form-errors req" value="*">{{ $errors->first($name,":message") }}</small>
                        <input required type="text" class="form-control form-control-sm " name="{{$name}}" value="{{old($name)}}" placeholder="{{$label}}">
                    </div>
                </div>


        <!--- End Form -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" content="add role" class="btn btn-primary cls_submit">Submit</button>

      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>

<script type="text/javascript">

</script>
