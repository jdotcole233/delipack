@extends('systemheaders.dashboardheaders')
@section('content')

<div class="panel-header panel-header-lg">
        <canvas id="bigDashboardChart"></canvas>
</div>

      <div class="content" id="errandchart" data-errands="{{$totalerrandsdata}}" >
        <div class="row">
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Annual errands stats</h5>
                <h4 class="card-title">Total errands</h4>
                <div class="dropdown">
                  <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                    <i class="now-ui-icons loader_gear"></i>
                  </button>
                  <!-- <div class="dropdown-menu dropdown-menu-right"> -->
                    <!-- <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <a class="dropdown-item text-danger" href="#">Remove Data</a> -->
                  <!-- </div> -->
                </div>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="lineChartExample"></canvas>
                </div>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                </div>
              </div>
            </div>
          </div>




          <div class="col-lg-4 col-md-6" id="salechart" data-sales-summary="{{$totalsalesdata}}">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Annual Sales</h5>
                <h4 class="card-title">Sales quick summary</h4>
                <div class="dropdown">
                  <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                    <i class="now-ui-icons loader_gear"></i>
                  </button>
                  <!-- <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <a class="dropdown-item text-danger" href="#">Remove Data</a>
                  </div> -->
                </div>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="lineChartExampleWithNumbersAndGrid"></canvas>
                </div>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                </div>
              </div>
            </div>
          </div>



          <div class="col-lg-4 col-md-6" id="ratingchart" data-ratings="{{$totalratingsdata}}">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Rating Statistics</h5>
                <h4 class="card-title">Total Performance</h4>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="barChartSimpleGradientsNumbers"></canvas>
                </div>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons ui-2_time-alarm"></i> Last 7 days
                </div>
              </div>
            </div>
          </div>
        </div>


      <!-- Riders location map -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-category">All Riders</h5>
                <h4 class="card-title"> Employees location views </h4>
              </div>
              <div class="card-body">
                <div id="map" style="width:100%; height:400px;">
                   <script>
                   function initMap(){
                        console.log("Working");
                        var uluru = {lat: 5.64175, lng: -0.15190};
                        // The map, centered at Uluru
                        var map = new google.maps.Map(
                            document.getElementById('map'), {zoom: 11, center: uluru});
                        // The marker, positioned at Uluru
                        var marker = new google.maps.Marker({position: uluru, map: map});
                
                   }
                   </script>
                    <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_KEY')}}&callback=initMap">
                    </script>
                </div>
              </div>
            </div>
          </div>
        </div>
      <!-- End of riders location map -->




        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-category">All Persons List</h5>
                <h4 class="card-title"> Employees Stats for {Today}</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>Name</th>
                      <th>Bike Type</th>
                      <th>Bike Number</th>
                      <th>Phone</th>
                      <th>status</th>
                      <th >Sales </th>
                    </thead>
                    <tbody>
                    @foreach($riderassigneddatas as $riderassigneddata)
                      <tr>
                        <td> {{$riderassigneddata->first_name}} {{$riderassigneddata->last_name}}</td>
                        <td>{{$riderassigneddata->brand_name}} </td>
                        <td> {{$riderassigneddata->registered_number}} </td>
                        <td>{{$riderassigneddata->work_phone}} </td>
                        <td> Oud-Turnhout </td>
                        <td> <button class="btn btn-warning"> View sales </button> </td>
                      </tr>
                      @endforeach
                       
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


@endsection