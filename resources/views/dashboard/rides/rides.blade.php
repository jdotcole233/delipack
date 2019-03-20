@extends('systemheaders.dashboardheaders')
@section('content')
 
<div class="panel-header panel-header-sm">
      </div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
              <div class="card-header">
                <h4 class="card-title"> All Registered Rides</h4>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success pull-right" data-toggle="modal" data-target=".bd-rideform-modal-lg">Add new ride</button>
                    </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="riderstable">
                    <thead class=" text-primary">
                      <th>ID</th>
                      <th>Brand Name</th>
                      <th>Reg Number</th>
                      <th>Date of expiry</th>
                      <th>Action</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Dakota Rice</td>
                        <td>Niger</td>
                        <td>Oud-Turnhout</td>
                        <td>$36,738</td>
                        <td><button class="btn btn-primary" data-toggle="modal" data-target=".bd-rideeditform-modal-lg">View</button></td>
                        <td><button class="btn btn-primary">Delete</button></td>
                      </tr>
 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade bd-rideform-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">


      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register ride</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
         <form>
              <div class="row">
                   <div class="col-md-6">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Brand name:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="Musa">
                      </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Registered number:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="Musa">
                      </div>
                   </div> 
              </div>
              <div class="row">
                   <div class="col-md-6">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Date of registration:</label>
                        <input type="Date" class="form-control" id="recipient-name" placeholder="Musa">
                      </div>
                   </div>
                   <div class="col-md-6">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Date of expiry:</label>
                        <input type="Date" class="form-control" id="recipient-name" placeholder="Musa">
                      </div>
                   </div> 
              </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Register</button>
                </div>
         </form>
      </div>



    </div>
  </div>
</div>



<div class="modal fade bd-rideeditform-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">


      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register ride</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
         <form>
              <div class="row">
                   <div class="col-md-6">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Brand name:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="Musa">
                      </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Registered number:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="Musa">
                      </div>
                   </div> 
              </div>
              <div class="row">
                   <div class="col-md-6">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Date of registration:</label>
                        <input type="Date" class="form-control" id="recipient-name" placeholder="Musa">
                      </div>
                   </div>
                   <div class="col-md-6">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Date of expiry:</label>
                        <input type="Date" class="form-control" id="recipient-name" placeholder="Musa">
                      </div>
                   </div> 
              </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-primary">Edit</button>
                </div>
         </form>
      </div>



    </div>
  </div>
</div>

@endsection