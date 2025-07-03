

  <!-- <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item active">
        <a class="nav-link active" data-toggle="tab" href="#home">Graph</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#menu1">Tables</a>
      </li>
    </ul> -->

    <!-- Tab panes -->
  <div id="home" class="tab-pane active"><br>
    <div style="width:500px !important">
      <canvas id="chart-line" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px !important; height: 200px;"></canvas>
    </div>
   </div>


<script>
    function mysetg(){
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
                labels: ["{{$label}}"],
                datasets: [
                  @foreach($speicific_info as $pro)
                  {
                    data: [{{$pro->current_value}}],
                    label: "{{$pro->specific_description1}}",
                    borderColor: colors[{{$loop->iteration}}],
                    backgroundColor: colors[{{$loop->iteration}}],
                    fill: false
                },@endforeach]
            },
            options: {
              scales: {
    yAxes: [{
      ticks: {
					beginAtZero: true,
					},
      scaleLabel: {
        display: true,
        labelString: '{{$unit}}'
      }
    }]
                }
            }
        });
    }
</script>
