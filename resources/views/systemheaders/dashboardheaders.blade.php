<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="../asset/img/brand/favicon.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
     @auth
      {{DB::table('companies')->where('companies_id',Auth::user()->companiescompanies_id)->value('company_abbreviation')}} - {{DB::table('companies')->where('companies_id',Auth::user()->companiescompanies_id)->value('company_name')}}
     @endauth
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.3.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />

  <!-- <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" /> -->
  <link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet" />

  <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.19/css/dataTables.semanticui.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.semanticui.min.css" rel="stylesheet" />

  

</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <img  src="http://127.0.0.1:8001/company_logos/{{DB::table('companies')->where('companies_id',Auth::user()->companiescompanies_id )->value('company_logo_path')}}" alt="">
            </div>
        </div>
        <div class="row d-flex justify-content-center">
              <a class="simple-text logo-mini">
              @auth
                {{DB::table('companies')->where('companies_id',Auth::user()->companiescompanies_id)->value('company_abbreviation')}}
              @endauth
              </a> 
              <a class="simple-text logo-normal">
              @auth
                {{DB::table('companies')->where('companies_id',Auth::user()->companiescompanies_id )->value('company_name')}}
              @endauth
              </a>
              <a class="simple-text logo-normal " style="margin-top:-27px;">
              @auth
                Joined on :{{date('Y-m-d',strtotime(DB::table('companies')->where('companies_id',Auth::user()->companiescompanies_id )->value('created_at')))}}
              @endauth
               </a>
             </div>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li class="{{ (request()->is('maindashboard')) ? 'active' : '' }}">
            <a href="{{url('maindashboard')}}">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="{{ (request()->is('deliveries')) ? 'active' : '' }}"}>
            <a href="{{ url('/deliveries')}}">
              <i class="now-ui-icons business_money-coins"></i>
              <p>Deliveries</p>
            </a>
          </li>
          <li class="{{ (request()->is('riders')) ? 'active' : '' }}"}>
            <a href="{{ url('/riders')}}">
              <i class="now-ui-icons sport_user-run"></i>
              <p>Delivery guys</p>
            </a>
          </li>
          <li class="{{ (request()->is('rides')) ? 'active' : '' }}"}>  
            <a href="{{url('/rides')}}">
              <i class="now-ui-icons shopping_delivery-fast"></i>
              <p>Rides</p>
            </a>
          </li>
          <li class="{{ (request()->is('reports')) ? 'active' : '' }}"}>
            <a href="{{url('/reports')}}">
              <i class="now-ui-icons business_chart-pie-36"></i>
              <p>Generate reports</p>
            </a>
          </li>
          <!-- <li class="active-pro">
            <a href="#">
              <i class="now-ui-icons arrows-1_cloud-download-93"></i>
              <p>Upgrade to PRO</p>
            </a>
          </li> -->
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="now-ui-icons media-2_sound-wave"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li style="cursor:pointer" class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons location_world"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div  class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{url('/dashboardprofile')}}" style="cursor:pointer;">profile</a>
                  <a  class="dropdown-item" id="changepassBtn" style="cursor:pointer;">change password</a>
                  <a class="dropdown-item" href="{{ route('logout') }}" style="cursor:pointer;"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/dashboardprofile')}}">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      @yield('content')
      <!-- Content of the pages are extended in here -->


      <div class="modal fade" id="modalloader" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"  role="document">
          <div class="modal-content" style="background-color:rgba(0,0,0,0.2);">
            <div class="modal-body" >
              <div class="row">
                <div class="col-md-4">
                    <div class="spinner-grow text-dark" style="width: 10rem; height: 10rem;" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="spinner-border text-light" style="width: 10rem; height: 10rem;" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="spinner-grow text-dark" style="width: 10rem; height: 10rem;" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer">
        <div class="container-fluid">
          <nav>
            <ul>
              <li>
                <a href="https://delivpack.com/">
                  DeliPack
                </a>
              </li>
              <li>
                <a href="https://delivpack.com/aboutdelipack">
                  About Us
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy;
            <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>
            DeliPack
          </div>
        </div>
      </footer>
    </div>
  </div>



  <!--  -->

  <div class="modal fade" id="change_password_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title" id="exampleModalLongTitle">Change password</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  id="changePasswordFrom">
              <div style="display:none">
                <meta name="csrf-token" content="{{csrf_field()}}" >
              </div>
             <div class="form-group">
                <label for="new-pasword">New password</label>
                <input type="password" id="newPass" name="password" class="form-control" placeholder="Enter new password">
             </div> 
             <div class="form-group">
                <label for="confirm_password">Confirm password</label>
                <input type="password" id="confirmPass" name="confirm_password" class="form-control" placeholder="Confirm password">
             </div> 
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="changePassword" class="btn btn-info">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- / -->


  <!--   Core JS Files   -->
  <!-- <script src="../assets/js/core/jquery.min.js"></script> -->

  <!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#config-web-app -->
<script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-database.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <!-- The core Firebase JS SDK is always required and must be listed first -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
  <script src="../assets/js/now-ui-dashboard.js" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
  <script src="../assets/demo/demo.js"></script>
  <script src="../js/delipackjs.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-auth.js"></script>
 <script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-firestore.js"></script>
 







<script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();
    });

    $(document).ready(function() {
    $('#riderstable').DataTable({
         'dom': 'Bfrtip',
        'buttons': [
            'copy',
            'excel',
            'csv',
            'pdf',
            'print'
        ]

    });
} );
  </script>
<!-- https://code.jquery.com/jquery-3.3.1.js -->
</body>
</html>