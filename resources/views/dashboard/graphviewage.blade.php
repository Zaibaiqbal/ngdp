<div id="home" class="tab-pane active"><br>
    <div style="width:500px !important">
      <canvas id="chart-line" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px !important; height: 200px;"></canvas>
    </div>
   </div>

<script>
function mysetg(){
    var colors = [];
    while (colors.length < 100) {
        var color = Math.floor(Math.random() * 16777215).toString(16);
        colors.push("#" + ("000000" + color).slice(-6));
    }

    var ctx = $("#chart-line");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($data['age_groups'] as $gp)
                    "{{$gp}}",
                @endforeach
            ],
            datasets: [
                @foreach($data['current_value'][0] as $percentage)
                  {
                    data: [{{$percentage}}],
                    label: "Percentage by Age Group",
                    borderColor: colors[{{$loop->iteration}}],
                    backgroundColor: colors[{{$loop->iteration}}],
                    fill: false
                },@endforeach

              
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: '%'
                    }
                }
            }
        }
    });
}

</script>
