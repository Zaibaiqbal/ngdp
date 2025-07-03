


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
      <div style="width:500px !important">
      <canvas id="chart-line" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px !important; height: 200px;"></canvas>
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




<script>
    function mysetg(){

        var ctx = $("#chart-line");
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [@foreach($grapharr as $gp) "{{$gp['province']}}", @endforeach],
                datasets: [{
                    data: [@foreach($grapharr as $gp) "{{$gp['current_value']}}", @endforeach],
                    label: "Total",
                    borderColor: "#458af7",
                    backgroundColor: '#458af7',
                    fill: false
                }, {
                    data: [@foreach($grapharr as $gp) "{{$gp['male']}}", @endforeach],
                    label: "Male",
                    borderColor: "#8e5ea2",
                    fill: true,
                    backgroundColor: '#8e5ea2'
                }, {
                    data: [@foreach($grapharr as $gp) "{{$gp['female']}}", @endforeach],
                    label: "Female",
                    borderColor: "#3cba9f",
                    fill: false,
                    backgroundColor: '#3cba9f'
                }
                , {
                    data: [@foreach($grapharr as $gp) "{{$gp['trans']}}", @endforeach],
                    label: "Transgender",
                    borderColor: "#FFC0CB",
                    fill: false,
                    backgroundColor: '#FFC0CB'
                }
              ]
            },
            options: {
              scales: {
    yAxes: [{
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
