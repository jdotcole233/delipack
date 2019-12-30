@extends('systemheaders.dashboardheaders')
@section('content')
<div class="panel-header panel-header-sm">
</div>


<div class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
              <div class="card-header">
                <h4 class="card-title"> {{$company_rider_name->first_name . " " . $company_rider_name->last_name."'s"}} work</h4>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary pull-right riderprofilebtn" >{{$company_rider_name->first_name . " " . $company_rider_name->last_name."'s"}} profile</button>
                    </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="riderstable">
                    <thead class=" text-primary">
                      <th> Ref </th>
                      <th> Customer </th>
                      <th> Phone number </th>
                      <th> Pick up  </th>
                      <th> Delivery </th>
                      <th> Rating </th>
                      <th> Status</th>
                      <th> Date/Time </th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade bd-riderprofile-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">



      <div class="modal-body">
          <div class="content">
<div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Edit Profile</h5>
              </div>
              <div class="card-body">
                <form class="editridersinformation" no-validate>
                  <meta name="csrf-token" content="{{csrf_token()}}">
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label> First name</label>
                        <input type="text" name="first_name" class="form-control" id="edit_first_name" placeholder="" required>
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Other name</label>
                        <input type="text" name="other_name" class="form-control" id="edit_other_name" placeholder="" >
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">last name</label>
                        <input type="text" name="last_name" class="form-control" id="edit_last_name" placeholder="" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Personal phone</label>
                        <input type="text" name="personal_phone" class="form-control" id="edit_personal_phone" placeholder="" required>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Work phone</label>
                        <input type="text" name="work_phone" class="form-control" id="edit_work_phone" placeholder=" " >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" id="edit_address" placeholder="" required>
                      </div>
                    </div>
                  </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Gender</label>
                        <select class="form-control form-control-lg" name="gender" id="edit_gender" required>
                          <option value="">Select gender</option>
                          <option value="Male">Male</option>
                          <option vale="Female">Female</option>
                        </select>
                      </div>
                  </div>
                </div>

                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Region:</label>
                            <select name="region" class="form-control form-control-lg" id="edit_region" required>
                                <option value="">Select region</option>
                                <option vale="Greater Accra Region">Greater Accra Region</option>
                                <option vlaue="Ashanti Region">Ashanti Region</option>
                                <option value="Eastern Region">Eastern Region</option>
                                <option value="Central Region">Central Region</option>
                            </select>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" class="form-control" id="edit_city" placeholder=" " required>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Area</label>
                        <input name="area" type="text" class="form-control" id="edit_area" placeholder=" " required>
                      </div>
                    </div>
                  </div>


                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">License class</label>
                        <input type="text" name="License_type"  class="form-control" id="edit_license_class" placeholder=" " required>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">License number</label>
                        <input type="text" name="License_number" class="form-control" id="edit_license_number" placeholder=" " required>
                      </div>
                  </div>
                </div>

                <div class="row" style="display:none;">
                  <div class="col-md-6">
                    <div class="form-group">
                        <input type="hidden" name="rider_id" class="form-control" id="riderident" >
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Date of issue</label>
                        <input type="Date" name="date_of_issue" class="form-control"  id="edit_date_of_issue" required>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Expiry date</label>
                        <input type="Date" name="Expiry_date"  class="form-control" id="edit_expiry_date" required>
                      </div>
                  </div>
                </div>


                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>About Me</label>
                        <textarea rows="4" cols="80" name="about" class="form-control" placeholder="Here can be your description" id="edit_about_me" value="Mike"></textarea>
                      </div>
                    </div>
                  </div>
                </form>
                  <div class="row">
                      <div class="col-md-12">
                          <button class="btn btn-primary ridereditinfobtn">Edit</button>
                      </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="../assets/img/bg5.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a style="z-index:1000; position:relative;" href="#">
                  @if(DB::table('companies')->where('companies_id',Auth::user()->companiescompanies_id )->value('company_logo_path') != null)
                    <img class="avatar body-gray"  src="http://superuser.delipackport.com/company_logos/{{DB::table('companies')->where('companies_id',Auth::user()->companiescompanies_id )->value('company_logo_path')}}" alt="{{DB::table('companies')->where('companies_id',Auth::user()->companiescompanies_id )->value('company_name')}}">
                    @else
                      <img  src="http://superuser.delipackport.com/company_logos/deli_s.png" alt="Default" width="150px" height="150px">
                    @endif
                    <h5 class="title" id="user_full_name">Mike Andrew</h5>
                  </a>
                  <p class="description" id="user_access">
                    michael24
                  </p>
                </div>
                <!-- <p class="description text-center" id="user_about">
                  "Lamborghini Mercy
                  <br> Your chick she so thirsty
                  <br> I'm in that two seat Lambo"
                </p> -->
              </div>
              <hr>
              <div class="button-container">
                <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-facebook-f"></i>
                </button>
                <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-twitter"></i>
                </button>
                <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-google-plus-g"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
</div>

      </div>
    </div>
  </div>
</div>


@endsection
