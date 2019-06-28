@extends('systemheaders.dashboardheaders')
@section('content')
<div class="panel-header panel-header-sm">
</div>


<div class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Reports </h4>
                <form id="reportforms">
                <meta name="csrf-token" content="{{csrf_token()}}">
                <fieldset class="border p-2">
                    <legend class="w-auto">From - to</legend>
                     <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>From</label>
                                <input type="Date" id="fromdateid" name="fromdate" class="form-control" placeholder="Username" >
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>To</label>
                                <input type="Date" id="todateid" name="todate" class="form-control" placeholder="Username">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p></p>
                                <!-- <input type="submit" class="btn btn-primary" placeholder="Username" value="michael23"> -->
                                <button class="btn btn-primary querydatabtn">Generate</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
                </form>
                <br>
                <br>

              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="reportstable">
                    <thead class=" text-primary">
                      <th> Trans ID </th>
                      <th> Customer </th>
                      <th> Pick up </th>
                      <th> Delivery</th>
                      <th> Rider </th>
                      <th> Date & Time </th>
                      <th> Commission </th>
                      <th> Charge </th>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>

                 <div class="row">
                    <div class="col-md-12">
                        <form>
                            <fieldset class="border p-2">
                                <legend class="w-auto">Total</legend>
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td><strong>Total Charges</strong></td>
                                                <td id="totalresult">{GHC 00.00}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Commission</strong></td>
                                                <td id="totalcommission">{GHC 00.00}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>


                </div>
              </div>
            </div>
        </div>
    </div>
</div>



@endsection