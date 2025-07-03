@extends('layouts.master')

@section('styles')
<style type="text/css">
  .tab-custon-menu-bg:before {
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    background: #fff;
    content: "";
    z-index: -1 !important;
    height: 100%;

}
.cus-btn {
    /*color: -webkit-link;*/
    cursor: pointer !important;
    /*text-decoration: underline;*/
}
h4{
  color: white !important;
}
.mypad{
  /* padding: 10px !important; */
}
.border-right{
  border-right: 1px solid;
}
.description-text{
  font-size: 18px;
}
.bbstyle{
  box-shadow: 0px 5px 3px rgba(0,0,0,.3);
      padding: 10px;
      color: #a24187;
      background: white;
      /* border-radius: 10px; */
}
.mycolorblack{
  background: #eeeeee !important;
}
</style>
@endsection
@section('content')
<!-- BREAD CRUMB -->
<div class="breadcome-area mg-t-40 mg-b-30">
    <div class="container">
        <div class="row">
            <form enctype="multipart/form-data" action="{{ route('uploadmyfileqit')}}" method="post">

             <div class="col-md-12">
               <label>File</label>
                <input type="file" class="form-control" name="file" required/>
            </div>

            <div class="col-md-12" style="margin-top:10px">
              <label>Type</label>
               <select class="form-control" name="type" required>
                 <option>QIT</option>
                 <option>MST</option>
                 <option>MIT</option>
                 <option>CIT</option>
                  <option>CSD</option>
                  <option>HSD</option>
                  <option>QUAL</option>
                  <option>NEWINDI</option>
                </select>
           </div>
            {{csrf_field()}}
            <div class="col-md-12" style="margin-top:10px">
               <input type="submit" name="submit" />
           </div>

          </form>
        </div>
    </div>
</div>
<!-- END BREAD CRUMB -->


@endsection
