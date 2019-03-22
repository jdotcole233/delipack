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
                        <button class="btn btn-success pull-right" data-toggle="modal" data-target=".bd-example-modal-lg">Register rider</button>
                    </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="riderstable">
                    <thead class=" text-primary">
                      <th> Name</th>
                      <th> City </th>
                      <th> Area </th>
                      <th> Phone number </th>
                      <th> View</th>
                      <th> Assign</th>
                      <th> Delete</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td> Dakota Rice</td>
                        <td> Niger </td>
                        <td> Oud-Turnhout </td>
                        <td> $36,738 </td>
                        <td> 
                          <a href="{{url('/aboutriders')}}" class="btn btn-primary"> View </a>
                       </td>
                       <td> 
                          <button class="btn btn-success" data-toggle="modal" data-target=".bd-assignride-modal-sm"> Assign </button>
                       </td>
                       <td> 
                          <button class="btn btn-danger"> Deactivate </button>
                       </td>
                      </tr>
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
          <form>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                     <!-- <label for="recipient-name" class="col-form-label">Select Bike</label> -->
                        <select class="form-control form-control-lg">
                          <option value="">Select Bike</option>
                          <option>GH-4345</option>
                          <option>GE-41142</option>
                          <option>GS-4364</option>
                          <option>GT-4002</option>
                        </select>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                        <button type="button" class="btn btn-danger form-control">Assign</button>
                  </div>
                </div>
              </div>
          </form>
              
        </div>
    </div>
  </div>
</div>













<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register rider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form class="needs-validation" no-validate>
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
                        <input type="text" class="form-control" name="other_name" placeholder="Kojo" required>
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
                        <input type="text" min="10" max="14" class="form-control" name="personal_phonenumber" placeholder="Personal phone number" required>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Phone number 2:</label>
                        <input type="text" min="10" max="14" class="form-control" id="recipient-name" placeholder="Work phone number" required>
                      </div>
                  </div>
                </div>

               <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Gender</label>
                        <select class="form-control form-control-lg" required>
                          <option value="">Select gender</option>
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-file">
                      <label for="recipient-name" class="col-form-label">Profile picture</label>
                      <input type="file" class="form-control " id="validatedCustomFile" required>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">License class</label>
                        <input type="text"  class="form-control" id="recipient-name" placeholder="E.g A, B" required>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">License number</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="E.g G453773" required>
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Date of issue</label>
                        <input type="Date"  class="form-control" id="recipient-name" required>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Expiry date</label>
                        <input type="Date"  class="form-control" id="recipient-name"  required>
                      </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">About:</label>
                      <textarea class="form-control" id="message-text" required></textarea>
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



@endsection