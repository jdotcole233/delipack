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
                    <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
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
                  

       const availablekeysarray = [];
    const availablevalsarray = [];
    const availablecss = {
         "backgroundColor": "green", 
         "color": "white", 
         "padding": "5px",
         "borderRadius": "5px 5px 5px 5px"
     }

    const workingcss = {
        "backgroundColor": "#fd7e14",
        "color": "white",
        "padding": "5px",
        "borderRadius": "5px 5px 5px 5px"
    }

    const unavailablecss = {
        "backgroundColor": "#a6a6a6",
        "color": "white",
        "padding": "5px",
        "borderRadius": "5px 5px 5px 5px"
    }

    function checkRiderStatus(riderskeys) {
        const ab =riderskeys;
        const ba = riderskeys;
        const mg = new Set();
        const mapleyval = new Set();


        const riderlocationavailable = firebase.database().ref().child('RiderLocationAvailable');
        const riderworking = firebase.database().ref().child("RiderFoundForCustomer");
        riderlocationavailable.on('child_added', function (snapshot) {
            console.log(typeof(snapshot.key));
            
            $.each(ab, function (i) {
                if (snapshot.key.includes(ab[i])) {
                    console.log(snapshot.key + " " + snapshot.key.includes(ab[i]));
                    console.log($('#status' + snapshot.key));
                    $('#status' + snapshot.key).children().text("Available").css(availablecss);
                    const obj = {};
                      obj["lat"] = snapshot.val().l[0];
                      obj["lng"] = snapshot.val().l[1];
                    mapleyval.add(obj);

                } 
            });
            
            riderlocationavailable.on('child_removed', function (snap) {
                $('#status' + snap.key).children().text("Unavailable").css(unavailablecss);
                riderlocationavailable.on('child_removed').off();
            });
        });

       

        riderworking.on('child_added', function(snap){
                $.each(ba, function(index){
                        if(snap.key.includes(ba[index])){
                            $('#status' + snap.key).children().text("On-errand").css(workingcss);
                        }
                });

            riderworking.on('child_removed', function (snap) {
                $('#status' + snap.key).children().text("Unavailable").css(unavailablecss);
                riderworking.on('child_removed').off();
            });
        });

        console.log([...mapleyval.values()]);
        return mapleyval;
    }
    // checkRiderStatus([64, 90, 61, 92, 34, 59]);
    setInterval(checkRiderStatus, 1000, [64, 90, 61, 92, 34, 59]);
 

     function initMap(){
  
                        console.log("Working");
                        var uluru = {lat: 5.64175, lng: -0.15190};
                        // The map, centered at Uluru
                        var map = new google.maps.Map(
                            document.getElementById('map'), {zoom: 11, center: uluru});
                        // The marker, positioned at Uluru
                        var marker = new google.maps.Marker({position: uluru, map: map});
                        console.log([...mapleyval.keys()]);

                        var markers = [...mapleyval.values()].map(function(location, i) {
                          return new google.maps.Marker({
                            position: location
                          });
                        });

                        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});

                   }


                   </script>
                   <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
                    <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKBYaQubmWi0ockGK4hmMAPG_RcKcZ7mk&callback=initMap">
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
                <p class="card-title" id="mainemptitle"> Employees Stats for {Today}</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="employeecurrentactivitytable">
                    <thead class=" text-primary">
                      <th>Name</th>
                      <th>Bike Type</th>
                      <th>Bike Number</th>
                      <th>Phone</th>
                      <th>status</th>
                      <th >Sales </th>
                    </thead>
                    <tbody id="employeeactivity">
                    @foreach($riderassigneddatas as $riderassigneddata)
                      <tr>
                        <td id="ridernameid"> {{$riderassigneddata->first_name}} {{$riderassigneddata->last_name}}</td>
                        <td>{{$riderassigneddata->brand_name}} </td>
                        <td> {{$riderassigneddata->registered_number}} </td>
                        <td>{{$riderassigneddata->work_phone}} </td>
                        <td id="status{{$riderassigneddata->company_rider_id}}"> <span style= "background-color: #a6a6a6; color: white; padding : 5px;borderRadius: 5px 5px 5px 5px"> Unavailable </span> </td>
                        <td> <button data-riderid="{{$riderassigneddata->company_rider_id}}" class="btn btn-warning viewtodaysalesbtn"> View sales </button> </td>
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



<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title" id="exampleModalLongTitle">Modal title</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                      <th>No. Trips</th>
                      <th>Sale</th>
                      <th>Commission</th>
                      <th>Total sale</th>
                    </thead>
                    <tbody>
                        <tr>
                          <td id="tripssum">2</td>
                          <td id="salessum">2</td>
                          <td id="commissionsum">2</td>
                          <td id="totalsale">2</td>
                        </tr>
                    </tbody>
                </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@endsection