<hr style="width:100%">
<div class="row">
  <div class="col-md-12">
@if($syn != 0 && $sec != 0)
  <input type="radio" value="Syntax" onclick="filterindicatorset(1)"  name="naturecheck" checked> Syntax
@endif
@if($syn != 0 && $sec == 0)
  <input type="radio" value="Syntax" style="display:none" onclick="filterindicatorset(1)"  name="naturecheck" checked>
@endif
@if($sec != 0 && $syn != 0)
<input type="radio" value="Secondary" onclick="filterindicatorset(1)"  name="naturecheck" @if($syn == 0) checked @endif> Secondary <br>
@endif
@if($sec != 0 && $syn == 0)
<input type="radio" value="Secondary" style="display:none" onclick="filterindicatorset(1)"  name="naturecheck" @if($syn == 0) checked @endif>  <br>
@endif
  </div>
</div>
