<div style="width:500px !important">
<canvas id="chart-line" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px !important; height: 200px;"></canvas>
</div>


<script>
    function mysetg3(){
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
                labels: ["{{$labels}}"],
                datasets: [
                  @foreach($indicators as $pro)
                  {
                    data: [{{$pro->current_value}}],
                    label: "{{$pro->mynames}}",
                    borderColor: colors[{{$loop->iteration}}],
                    backgroundColor: colors[{{$loop->iteration}}],
                    fill: false
                },@endforeach]
            },
            options: {
              scales: {
    yAxes: [{
      scaleLabel: {
        display: true,
        labelString: '%'
      }
    }]
                }
            }
        });
    }
</script>
