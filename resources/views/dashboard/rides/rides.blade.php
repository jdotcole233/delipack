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
                  <table class="table" id="ridestable">
                    <thead class=" text-primary">
                      <th>Brand Name</th>
                      <th>Reg Number</th>
                      <th>Date of expiry</th>
                      <th>Action</th>
                      <th>Action</th>
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
         <form class="ridesformsval" no-validate>
           <meta name="csrf-token" content="{{ csrf_token() }}">
              <div class="row">
                   <div class="col-md-6">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Brand name:</label>
                        <input type="text" class="form-control" name="brand_name" placeholder="Yamaha" required>
                      </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Registered number:</label>
                        <input type="text" class="form-control" name="registered_number" placeholder="GS-223" required>
                      </div>
                   </div> 
              </div>
              <div class="row" style="display:none;">
                   <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" name="companiescompanies_id" value="{{Auth::user()->companiescompanies_id}}">
                      </div>
                   </div>
                   <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" name="status" value="0">
                      </div>
                   </div>
              </div>
              <div class="row">
                   <div class="col-md-6">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Date of registration:</label>
                        <input type="Date" class="form-control" name="date_of_registration" required>
                      </div>
                   </div>
                   <div class="col-md-6">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Date of expiry:</label>
                        <input type="Date" class="form-control" name="date_of_expiry"  required>
                      </div>
                   </div> 
              </div>
          </form>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary registerridebtn">Register</button>
                </div>

      </div>



    </div>
  </div>
</div>



<div class="modal fade bd-rideeditform-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">


      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit ride</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
         <form class="editrideform" no-validate>
              <meta name="csrf-token" content="{{ csrf_token() }}" >
              <div class="row">
                   <div class="col-md-6">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Brand name:</label>
                        <input type="text" class="form-control" id="brand_name" name="brand_name" required>
                      </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Registered number:</label>
                        <input type="text" class="form-control" id="registered_number" name="registered_number"  required>
                      </div>
                   </div> 
              </div>
              <div class="row">
                   <div class="col-md-6">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Date of registration:</label>
                        <input type="Date" class="form-control" id="date_of_registration" name="date_of_registration"  required>
                      </div>
                   </div>
                   <div class="col-md-6">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Date of expiry:</label>
                        <input type="Date" class="form-control" id="date_of_expiry" name="date_of_expiry" required>
                      </div>
                   </div> 
              </div>
              <div class="row" style="display:none;">
                   <!-- <div class="col-md-6">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Date of registration:</label>
                        <input type="Date" class="form-control" name="date_of_registration" >
                      </div>
                   </div> -->
                   <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="bike_ident" name="bike_id">
                      </div>
                   </div> 
              </div>
            </form>
               <div class="modal-footer">
                  <button type="button" class="btn btn-primary editridebtn">Edit</button>
                </div>
      </div>



    </div>
  </div>
</div>

@endsection