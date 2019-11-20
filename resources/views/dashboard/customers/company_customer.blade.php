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
                  <table class="table" id="companyclientstable">
                    <thead class=" text-primary">
                      <th> Client Name</th>
                      <th> Phone Number </th>
                      {{-- <th> Location </th> --}}
                      {{-- <th> Email Address </th> --}}
                      {{-- <th> Company Name  </th> --}}
                      <th> Created On </th>
                      <th> Action </th>
                    </thead>
                    <tbody id="clientTable">

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
          <form class="form container client_record_form">
            <meta name="csrf-token" content="{{csrf_token()}}">
              <div class="row mb-2">
                <div class="form-group col-md-6">
                  <label for="First Name">First Name</label>
                  <input type="text" name="first_name"  id="client_first_name" class="form-control" placeholder="John" required>
                </div>

                <div class="form-group col-md-6">
                  <label for="Last Name">Last Name</label>
                  <input type="text" name="last_name" id="client_last_name" class="form-control"  placeholder="Asare" required>
                </div>
              </div>
              <div class="row mb-2">
                <div class="form-group col-md-6">
                  <label for="Primary Phone">Primary Phone No.</label>
                  <input type="text" name="contact_number" class="form-control" placeholder="0203 444 4444" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="Alt Phone">Alt Phone No.</label>
                  <input type="text" name="number_two" value="N/A" class="form-control" placeholder="0203 444 4444" >
                </div>
              </div>
              <div class="row mb-2">
                <div class="form-group col-md-6">
                  <label for="Email">Email (Optional)</label>
                  <input type="text" name="email"  class="form-control" value="N/A" placeholder="kwame@me.com" >
                </div>
                <div class="form-group col-md-6">
                  <label for="Location">Location</label>
                  <input type="text" name="customer_location" class="form-control" placeholder="Achimota" required>
                </div>
              </div>
              <div class="row mb-2">
                <div class="form-group col-md-12">
                  <label for="Company Name">Company Name (Optional)</label>
                  <input type="text" name="company_name" class="form-control" value="N/A" placeholder="Asare company Ltd">
                </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
          <button type="button" id="client_record_form_button" name="button" class="btn btn-success pull-right">Submit</button>
          <button type="button" name="button" data-dismiss="modal" id="client_manual_cancel" class="btn btn-secondary pull-right">Cancel</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade bd-example-modal-lg" id="more_client_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="clientDetailsName">Client {Name}</h5>
          <button class="btn btn-info pull-right editClientDetailsBtn">Edit Details</button>
      </div>
      <div class="modal-body">
          <form class="form container client_record_form_more" id="clientToggleMore" action="index.html" method="post">
              <div class="row mb-2">
                <div class="form-group col-md-6">
                  <meta name="csrf-token" content="{{csrf_token()}}">
                  <label for="brand">First Name</label>
                  <input type="text" name="client_first_name_more" value="" id="client_first_name_more" class="form-control toggleInput" placeholder="John" readonly required>
                </div>

                <div class="form-group col-md-6">
                  <label for="brand">Last Name</label>
                  <input type="text" name="client_last_name_more" value="" id="client_last_name_more" class="form-control toggleInput"  placeholder="Asare" readonly required>
                </div>
              </div>
              <div class="row mb-2">
                <div class="form-group col-md-6">
                  <label for="brand">Primary Phone No.</label>
                  <input type="text" name="client_contact_number_more" id="client_contact_number_more" value="" class="form-control toggleInput" placeholder="0203 444 4444" readonly required>
                </div>
                <div class="form-group col-md-6">
                  <label for="brand">Alt Phone No.</label>
                  <input type="text" name="client_contact_number_two_more" id="client_contact_number_two_more" value="" class="form-control toggleInput" placeholder="0203 444 4444" readonly  required>
                </div>
              </div>
              <div class="row mb-2">
                <div class="form-group col-md-6">
                  <label for="brand">Email (Optional)</label>
                  <input type="text" name="email_more" value="" id="email_more" class="form-control toggleInput" placeholder="kwame@me.com" readonly required>
                </div>
                <div class="form-group col-md-6">
                  <label for="brand">Location</label>
                  <input type="text" name="customer_location_more" id="customer_location_more" value="" class="form-control toggleInput" placeholder="Achimota" readonly required>
                </div>
              </div>
              <div class="row mb-2">
                <div class="form-group col-md-12">
                  <label for="brand">Company Name (Optional)</label>
                  <input type="text" name="company_name_more" id="company_name_more" value="" class="form-control toggleInput" placeholder="Asare company Ltd" readonly required>
                </div>
              </div>
          </form>
          <div class="row mb-2 emailsmsaction" >
                <div class="form-group col-md-12">
                  <label for="">Select Action</label>
                  <select class="form-control" id="clientActionChange" name="clientActionChange_more">
                    <option value="No Action">No Action</option>
                    <option value="Send Email">Send Email</option>
                    <option value="Send SMS">Send SMS</option>
                  </select>
                </div>
            </div>

          <div class="row emailsmssection" style="display:none;">
                <div class="form-group col-md-12">
                  <label for="emailaddress">Email To:</label>
                  <input type="text" name="emailaddress" value="" class="form-control toggleInput" id="clientSendEmailAddress"   required readonly>
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
          <button type="button" id="client_record_form_button_more" name="button" class="btn btn-success pull-right">Submit</button>
          <button type="button" name="button" data-dismiss="modal" id="manual_cancel_more" class="btn btn-secondary pull-right">Cancel</button>
      </div>
    </div>
  </div>
</div>



@endsection
