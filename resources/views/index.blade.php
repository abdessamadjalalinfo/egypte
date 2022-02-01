@extends('master')

@section('content')
<div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Number of Files</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{App\Models\File::all()->count()}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Number of Document</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{App\Models\Document::all()->count()}}</div>
                    </div>
                    <div class="col-auto">
                       <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Number of Users</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{App\Models\User::all()->count()}}</div>
                        </div>
                        <div class="col">
                          
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Number of Admins</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{App\Models\User::all()->where('type','admin')->count()}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="chart-container">
              <div class="chart has-fixed-height" id="pie_basic"></div>
            </div>
            
          </div>
          <div class="row">

          <div class="col-5" id="container"></div>

          
            <div class="col-md-6">
              <form action="{{route('index')}}">
            <div class="row">
              <div class="col-5">
              <select name="year" class="form-select" aria-label="Default select example">
                <option  >year</option>
                <option value="2021" >2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
              </select>
            </div>
           <div class="col-5">
            <button type="submit" class="btn btn-primary"><i class="fas fa-eye"></i>

            </button>

           </div>
          </div>
        </form>
          
              
                <div class="panel panel-default">
                   
                    <div class="panel-body">
                        <canvas id="canvas" height="280" width="600"></canvas>
                    </div>
                </div>
            </div>
        </div>
          <script src="https://code.highcharts.com/highcharts.js"></script>
          <script type="text/javascript">
            var userData = <?php echo json_encode($userData)?>;
        
            Highcharts.chart('container', {
                title: {
                    text: 'New User Growth, 2022'
                },
                subtitle: {
                    text: 'Source: positronx.io'
                },
                xAxis: {
                    categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                        'October', 'November', 'December'
                    ]
                },
                yAxis: {
                    title: {
                        text: 'Number of New Users'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true
                    }
                },
                series: [{
                    name: 'New Users',
                    data: userData
                }],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });
        
        </script>

        <script>
    var year = <?php echo $year; ?>;
    var user = <?php echo $files; ?>;
    var barChartData = {
        labels: year,
        datasets: [{
            label: 'Files',
            backgroundColor: "pink",
            data: user
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Files By Months in <?php echo $current;?> '
                }
            }
        });
    };
</script>


@endsection