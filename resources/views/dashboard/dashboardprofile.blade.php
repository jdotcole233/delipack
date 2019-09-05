@extends('systemheaders.dashboardheaders')
@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
<div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Edit Profile</h5>
              </div>
              <div class="card-body">
                <form action="{{url('/updateProfile')}}" method="POST">
                @csrf
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Company (disabled)</label>
                        <input type="text" class="form-control" disabled="" name="company_name" placeholder="Company" value="{{$company->company_name}}">
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Abbreviation</label>
                        <input type="text" class="form-control" placeholder="abbreviation" name="company_abbreviation" value="{{$company->company_abbreviation}}">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" value={{Auth::user()->email}}>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Primary Phone</label>
                        <input type="text" name="company_phone_one" class="form-control" placeholder="primary phone" value="{{$company->company_phone_one}}">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Secondary Phone</label>
                        <input type="text" name="company_phone_two" class="form-control" placeholder="secondary phone"value="{{$company->company_phone_two}}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" placeholder="Home Address" name="address" value="{{$company->address}}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" placeholder="City" name="city" value="{{$company->city}}">
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Region</label>
                        <input type="text" class="form-control" name="region" placeholder="Region" value="{{$company->region}}">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Area</label>
                        <input type="number" class="form-control" placeholder="Area" name="area" value="{{$company->area}}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <input type="submit" value="Update" class="btn btn-info">
                      </div>
                    </div>
                  </div>
                </form>

                  @if(Session::has("message"))
                    <div class="alert alert-success">
                      {!! Session::get("message") !!}
                    </div>
                  @endif

              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img style="z-index:-1" src="../assets/img/bg5.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a style="z-index:1000; position:relative;" href="#">
                    @if($company->company_logo_path != null)
                    <img  src="http://superuser.delipackport.com/company_logos/{{DB::table('companies')->where('companies_id',Auth::user()->companiescompanies_id )->value('company_logo_path')}}" alt="{{$company->company_name}}">
                    @else
                      <img  src="http://superuser.delipackport.com/company_logos/deli_s.png" alt="Default" width="150px" height="150px">
                    @endif
                    <h5 class="title">{{$company->company_name}}</h5>
                  </a>
                  <p class="description">
                      {{$company->company_abbreviation}}
                  </p>
                </div>
                <div class="row  d-flex justify-content-center">
                  <a href="" class="simple-text logo-normal">
                    Joined on :{{date('Y-m-d',strtotime(DB::table('companies')->where('companies_id',Auth::user()->companiescompanies_id )->value('created_at')))}}
                  </a>
                </div >
              </div>
              <hr>
              <div class="button-container">
                <a target="_blank" href="https://fb.com/{{$company->facebook_handle}}" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <a target="_blank" href="https://twitter.com/users/{{$company->twitter_handle}}" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-twitter"></i>
                </a>
                <a target="_blank" href="https://instagram.com/{{$company->instagram_handle}}" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-instagram"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
</div>





@endsection