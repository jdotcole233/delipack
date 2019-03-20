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
                      <th> Action view</th>
                      <th> Action Delete</th>
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
        <form>
                <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">First name:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="Musa">
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Other name:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="Kojo">
                      </div>
                  </div>
                   <div class="col-md-4">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Last name:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="Anim">
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Home address:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="Hse No. 25 Haatso">
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Region:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="Accra">
                      </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">City:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="Greater Accra">
                      </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Area:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="East legon">
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Phone number 1:</label>
                        <input type="number" min="10" max="14" class="form-control" id="recipient-name" placeholder="Personal phone number">
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Phone number 2:</label>
                        <input type="number" min="10" max="14" class="form-control" id="recipient-name" placeholder="Work phone number">
                      </div>
                  </div>
                </div>

               <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Driver's License</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="G382376">
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
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">About:</label>
                      <textarea class="form-control" id="message-text"></textarea>
                    </div>
                  </div>
                </div>



        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Register</button>
      </div>
    </div>
</div>
</div>



@endsection