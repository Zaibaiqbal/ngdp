<div class="row">
<div class="col-md-12">

<div class="row">
<div class="col-md-12">

  <!-- <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item active">
        <a class="nav-link active" data-toggle="tab" href="#home">Graph</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#menu1">Tables</a>
      </li>
    </ul> -->

    <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
      <div style="width:1000px !important">
      <canvas id="chart-line" width="600" height="200" class="chartjs-render-monitor" style="display: block; width: 500px !important; height: 200px;"></canvas>
    </div>
    </div>
    <div id="menu1" class="container tab-pane fade" style="width:100%"><br>
      <table class="table table-striped" style="width:100%">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
    </div>
  </div>
</div>
</div>
</div>

</div>



<script>

   function showgraph()
{

  var count = 0;
  var colors = [];
      while (colors.length < 100) {
          do {
              var color = Math.floor((Math.random()*1000000)+1);
          } while (colors.indexOf(color) >= 0);
          colors.push("#" + ("000000" + color.toString(16)).slice(-6));
      }

  var ctx = $("#chart-line");
  var myLineChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [@foreach($grapharr as $gp) "{{$gp['district']}}", @endforeach],
                datasets: [
                  {
                    data: [@foreach($grapharr as $gp) "{{$gp['current_value']}}", @endforeach],
                    label: [ "Total"],
                    borderColor: "#3ba3d3",
                    backgroundColor: "#3ba3d3",
                    fill: false
                },
                
              ]
      },
      options: {
        scales: {
  yAxes: [{
    ticks: {
                  beginAtZero: true,
                  },
  scaleLabel: {
  display: true,
  labelString: "{{$unit}}"
  }
  }]
          }
      }
  });


}
</script>





<div class="row" style="margin-top:10px;">
<div class="col-md-12">
<!--
  <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item active">
        <a class="nav-link active" data-toggle="tab" href="#home">Graph</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link active" data-toggle="tab" href="#menu1">Tables</a>
      </li>
    </ul> -->

    <!-- Tab panes -->
  <div class="tab-content">
    <!-- <div id="home" class="container tab-pane "><br>
      <div style="width:500px !important">
      <canvas id="chart-line" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px !important; height: 200px;"></canvas>
    </div>
    </div> -->
   
  </div>
</div>
</div>
