@extends('systemheaders.dashboardheaders')
@section('content')
   
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Accredited Riders</h4>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success pull-right" id="initialregisterbtn">Register rider</button>
                    </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="ridersoutputtable">
                    <thead class=" text-primary">
                      <th> Name</th>
                      <th> City </th>
                      <th> Area </th>
                      <th> Phone number </th>
                      <th> View</th>
                      <th> Assign</th>
                      <th> Delete</th>
                    </thead>
                    <tbody id="riderTable">
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bd-assignride-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign ride to {rider name}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div class="modal-body">
          <form class="assignform" id="assignrideform" no-validate>
            <meta name="csrf-token" content="{{ csrf_token() }}">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                     <!-- <label for="recipient-name" class="col-form-label">Select Bike</label> -->
                        <select id="ridesselecttag" class="form-control form-control-lg" name="motor_bikesbike_id" required>
                         
                        </select>
                        <div class="row" style="display:none;">
                              <div class="col-md-6">
                                 <input type="text" name="companiescompanies_id" value="1">
                              </div>
                              <div class="col-md-6">
                                 <input type="text" id="assigncmp_rider" name="company_riderscompany_rider_id" value="1">
                              </div>
                              <div>
                                <input type="text" id="assigncmp_rider" name="assigned_bike" value="1">
                              </div>
                        </div>
                    </div>
                </div>
              </div>
            </form>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                        <button type="button" class="btn btn-danger form-control assignridebtn">Assign</button>
                  </div>
                </div>
              </div>

              
        </div>
    </div>
  </div>
</div>













<div class="modal fade rideregistrationforms" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register rider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form class="needs-validation" id="riderforms"  no-validate>
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">First name:</label>
                        <input type="text" class="form-control"  name="first_name"  placeholder="Musa" required>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Other name:</label>
                        <input type="text" class="form-control" name="other_name" placeholder="Kojo">
                      </div>
                  </div>
                   <div class="col-md-4">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Last name:</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Anim" required>
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Home address:</label>
                        <input type="text" class="form-control" name="address" placeholder="Hse No. 25 Haatso" required>
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Region:</label>
                        <select class="form-control form-control-lg" name="region" required>
                          <option value="">Select region</option>
                          <option value="Greater Accra Region">Greater Accra Region</option>
                          <option value="Ashanti Region">Ashanti Region</option>
                          <option value="Eastern Region">Eastern Region</option>
                          <option value="Central Region">Central Region</option>
                          
                        </select>
                      </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">City:</label>
                        <input type="text" class="form-control" name="city" placeholder="Greater Accra" required>
                      </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Area:</label>
                        <input type="text" class="form-control" name="area" placeholder="East legon" required>
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Phone number 1:</label>
                        <input type="text" min="10" max="14" class="form-control" name="personal_phone" placeholder="Personal phone number" required>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Phone number 2:</label>
                        <input type="text" min="10" max="14" class="form-control" name="work_phone" placeholder="Work phone number" required>
                      </div>
                  </div>
                </div>

              <div class="row" style="display:none;">
                  <div class="col-md-12">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="assigned_bike" value="0" >
                      </div>
                  </div>
                </div>

               <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Gender</label>
                        <select class="form-control form-control-lg" name="gender" required>
                          <option value="">Select gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                  </div>
                  <!-- <div class="col-md-6">
                    <div class="custom-file">
                      <label for="recipient-name" class="col-form-label">Profile picture</label>
                      <input type="file" class="form-control " id="profile_picture_get" name="profile_picture" required>
                    </div>
                  </div> -->
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">License class</label>
                        <input type="text"  class="form-control" name="license_type" placeholder="E.g A, B" required>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">License number</label>
                        <input type="text" class="form-control" name="license_number" placeholder="E.g G453773" required>
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Date of issue</label>
                        <input type="Date"  class="form-control" name="date_of_issue" required>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Expiry date</label>
                        <input type="Date"  class="form-control" name="expiry_date"  required>
                      </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">About:</label>
                      <textarea class="form-control" name="about" required></textarea>
                    </div>
                  </div>
                </div>
      </div>
    </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" id="ridersubmitbtn" >Register</button>
      </div>

    </div>
</div>
</div>


<div class="modal fade bd-pictureupload-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
         <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload profile picture</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
                <img  id="displayprofilepic" style="width:100%; height:100%; border-radius:50%;">
            </div>
            <div class="col-md-2">
              
            </div>
          </div>
          <form method="POST" action="/uploadriderphoto" enctype="multipart/form-data" id="imageuploadform" >
                <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
                {{ csrf_field() }}
              <div class="row">
                  <div class="col-md-12">
                    <div class="custom-file">
                      <label for="recipient-name" class="col-form-label">Profile picture</label>
                      <input type="file" class="form-control " id="profile_picture_get" name="profile_picture" required>
                    </div>
                  </div>
                </div>
            <div class="row">
              <div class="col-md-12 pull-right">
                <button type="submit" class="btn btn-primary" id="riderimageupload" >Upload</button>
              </div>
            </div>
          </form>


        </div>


    </div>
  </div>
</div>

                <!-- <div class="alert alert-danger">
                  <button type="button" aria-hidden="true" class="close">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                  </button>
                  <span>
                    <b> Danger - </b> This is a regular notification made with ".alert-danger"
                  </span>
                </div> -->

@endsection