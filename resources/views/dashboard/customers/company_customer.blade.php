@extends('systemheaders.dashboardheaders')
@section('content')
<div class="panel-header panel-header-sm">
</div>


<div class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
              <div class="card-header">
                <h4 class="card-title"> All Clients </h4>
                <button type="button" class="btn btn-success btn-outline pull-right" name="button" data-toggle="modal" data-target="#client_record_modal">Clients</button>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" >
                    <thead class=" text-primary">
                      <th> Client Name</th>
                      <th> Phone Number </th>
                      <th> Location </th>
                      <th> Email Address </th>
                      <th> Company Name  </th>
                      <th> Action </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Kwame Ansah</td>
                            <td>0235550099/0240555999</td>
                            <td>Achimota</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>
                                <button class="btn btn-info btn-outline"  data-toggle="modal" data-target="#more_client_modal"> More </button>
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




<div class="modal fade bd-example-modal-lg" id="client_record_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">Add Client</h5>
      </div>
      <div class="modal-body">
          <form class="form container manual_record_form" action="index.html" method="post">

              <div class="row mb-2">
                <div class="form-group col-md-6">
                  <meta name="csrf-token" content="{{csrf_token()}}">
                  <label for="brand">First Name</label>
                  <input type="text" name="client_first_name" value="" id="client_first_name" class="form-control" placeholder="John" required>
                </div>

                <div class="form-group col-md-6">
                  <label for="brand">Last Name</label>
                  <input type="text" name="client_last_name" value="" id="client_last_name" class="form-control"  placeholder="Asare" required>
                </div>
              </div>
              <div class="row mb-2">
                <div class="form-group col-md-6">
                  <label for="brand">Primary Phone No.</label>
                  <input type="text" name="client_contact_number" value="" class="form-control" placeholder="0203 444 4444" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="brand">Alt Phone No.</label>
                  <input type="text" name="client_contact_number_two" value="" class="form-control" placeholder="0203 444 4444"  required>
                </div>
              </div>
              <div class="row mb-2">
                <div class="form-group col-md-6">
                  <label for="brand">Email (Optional)</label>
                  <input type="text" name="email" value="" class="form-control" placeholder="kwame@me.com" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="brand">Location</label>
                  <input type="text" name="customer_location" value="" class="form-control" placeholder="Achimota" required>
                </div>
              </div>
              <div class="row mb-2">
                <div class="form-group col-md-12">
                  <label for="brand">Company Name (Optional)</label>
                  <input type="text" name="company_name" value="" class="form-control" placeholder="Asare company Ltd" required>
                </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
          <button type="button" id="manual_record_form_button" name="button" class="btn btn-success pull-right">Submit</button>
          <button type="button" name="button" data-dismiss="modal" id="manual_cancel" class="btn btn-secondary pull-right">Cancel</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade bd-example-modal-lg" id="more_client_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">Client {Name}</h5>
          <button class="btn btn-info pull-right editClientDetailsBtn">Edit Details</button>
      </div>
      <div class="modal-body">
          <form class="form container client_record_form" id="clientToggleMore" action="index.html" method="post">
              <div class="row mb-2">
                <div class="form-group col-md-6">
                  <meta name="csrf-token" content="{{csrf_token()}}">
                  <label for="brand">First Name</label>
                  <input type="text" name="client_first_name" value="" id="client_first_name" class="form-control toggleInput" placeholder="John" readonly required>
                </div>

                <div class="form-group col-md-6">
                  <label for="brand">Last Name</label>
                  <input type="text" name="client_last_name" value="" id="client_last_name" class="form-control toggleInput"  placeholder="Asare" readonly required>
                </div>
              </div>
              <div class="row mb-2">
                <div class="form-group col-md-6">
                  <label for="brand">Primary Phone No.</label>
                  <input type="text" name="client_contact_number" value="" class="form-control toggleInput" placeholder="0203 444 4444" readonly required>
                </div>
                <div class="form-group col-md-6">
                  <label for="brand">Alt Phone No.</label>
                  <input type="text" name="client_contact_number_two" value="" class="form-control toggleInput" placeholder="0203 444 4444" readonly  required>
                </div>
              </div>
              <div class="row mb-2">
                <div class="form-group col-md-6">
                  <label for="brand">Email (Optional)</label>
                  <input type="text" name="email" value="" class="form-control toggleInput" placeholder="kwame@me.com" readonly required>
                </div>
                <div class="form-group col-md-6">
                  <label for="brand">Location</label>
                  <input type="text" name="customer_location" value="" class="form-control toggleInput" placeholder="Achimota" readonly required>
                </div>
              </div>
              <div class="row mb-2">
                <div class="form-group col-md-12">
                  <label for="brand">Company Name (Optional)</label>
                  <input type="text" name="company_name" value="" class="form-control toggleInput" placeholder="Asare company Ltd" readonly required>
                </div>
              </div>
          </form>
          <div class="row mb-2" >
                <div class="form-group col-md-12">
                  <label for="">Select Action</label>
                  <select class="form-control" id="clientActionChange" name="clientActionChange">
                    <option value="">No Action</option>
                    <option value="Send Email">Send Email</option>
                    <option value="Send SMS">Send SMS</option>
                  </select>
                </div>
              </div>

          <div class="row emailsmssection" style="display:none;">
                <div class="form-group col-md-12">
                  <label for="emailaddress">Email To:</label>
                  <input type="text" name="emailaddress" value="" class="form-control toggleInput" placeholder="asare@me.com"  required>
                </div>
                <div class="form-group col-md-12">
                  <label for="subject">Subject: </label>
                  <input type="text" name="emailsubject" value="" class="form-control toggleInput" placeholder="Items delivered"  required>
                </div>
                <div class="col-md-12">
                    <div>
                        <label for="message"> Message: </label>
                    </div>
                    <div id="summernote"></div>
                     <script>
                    $('#summernote').summernote({
                        placeholder: 'Type message to be sent',
                        tabsize: 2,
                        height: 200
                    });
                    </script>
                </div>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" id="client_record_form_button" name="button" class="btn btn-success pull-right">Submit</button>
          <button type="button" name="button" data-dismiss="modal" id="manual_cancel" class="btn btn-secondary pull-right">Cancel</button>
      </div>
    </div>
  </div>
</div>



@endsection
