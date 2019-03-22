@extends('systemheaders.dashboardheaders')
@section('content')
<div class="panel-header panel-header-sm">
</div>


<div class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
              <div class="card-header">
                <h4 class="card-title"> {Rider name} work</h4>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary pull-right" data-toggle="modal" data-target=".bd-riderprofile-modal-lg">{Ride name} profile</button>
                    </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="riderstable">
                    <thead class=" text-primary">
                      <th> Sender </th>
                      <th> Sender No. </th>
                      <th> Source </th>
                      <th> Receiver </th>
                      <th> Receiver No. </th>
                      <th> Destination </th>
                      <th> Delivery St.</th>
                      <th> Date/Time </th>
                    </thead>
                    <tbody>
                      <tr>
                        <td> Dakota Rice </td>
                        <td> Oud-Turnhout </td>
                        <td> $36,738 </td>
                        <td> Dakota Rice</td>
                        <td> Niger </td>
                        <td> Oud-Turnhout </td>
                        <td> $36,738 </td>
                        <td> 1/9/9090</td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade bd-riderprofile-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
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
                <form>
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label> First name</label>
                        <input type="text" class="form-control" placeholder="Company" value="Creative Code Inc.">
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Other name</label>
                        <input type="text" class="form-control" placeholder="Username" value="michael23">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">last name</label>
                        <input type="email" class="form-control" placeholder="Email">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Personal phone</label>
                        <input type="text" class="form-control" placeholder="Company" value="Mike">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Work phone</label>
                        <input type="text" class="form-control" placeholder="Last Name" value="Andrew">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                      </div>
                    </div>
                  </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Gender</label>
                        <select class="form-control form-control-lg">
                          <option value="">Select gender</option>
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                      </div>
                  </div>
                </div>

                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Region:</label>
                            <select class="form-control form-control-lg">
                                <option value="">Select region</option>
                                <option>Greater Accra Region</option>
                                <option>Ashanti Region</option>
                                <option>Eastern Region</option>
                                <option>Central Region</option>
                            </select>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" placeholder="Country" value="Andrew">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Area</label>
                        <input type="text" class="form-control" placeholder="ZIP Code">
                      </div>
                    </div>
                  </div>


                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">License class</label>
                        <input type="text"  class="form-control" id="recipient-name" placeholder="E.g A, B">
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">License number</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="E.g G453773">
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Date of issue</label>
                        <input type="Date"  class="form-control" id="recipient-name">
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Expiry date</label>
                        <input type="Date"  class="form-control" id="recipient-name" >
                      </div>
                  </div>
                </div>


                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>About Me</label>
                        <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description" value="Mike">Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <button class="btn btn-primary">Edit</button>
                      </div>
                  </div>
                </form>
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
                  <a href="#">
                    <img class="avatar border-gray" src="../assets/img/mike.jpg" alt="...">
                    <h5 class="title">Mike Andrew</h5>
                  </a>
                  <p class="description">
                    michael24
                  </p>
                </div>
                <p class="description text-center">
                  "Lamborghini Mercy
                  <br> Your chick she so thirsty
                  <br> I'm in that two seat Lambo"
                </p>
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