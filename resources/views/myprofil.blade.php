@extends('master')

@section('content')
<div class="card text-center">
    <div class="card-header">
     My profile
    </div>
    <div class="card-body">
      <h3 style="color:black" class="card-title">{{Auth::user()->name}}</h3>
      <p class="card-text">{{Auth::user()->email}}</p>
      <p class="card-text">Permissions :{{Auth::user()->type}}</p>
      <p class="card-text">Files created  :{{Auth::user()->files()->count()}}</p>
      <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalnewuser" data-bs-whatever="@getbootstrap">Edit/Change Password</a>

    </div>
    
  </div>
  <div class="modal fade" id="exampleModalnewuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit/Change Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('changePassword')}}">
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Name :</label>
                <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control" id="recipient-name">
              </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">New Password:</label>
              <input type="password" name="password"class="form-control" id="recipient-name">
            </div>
             <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"> Update</button>
        </div>
           
          </form>
        </div>
       
      </div>
    </div>
  </div>

@endsection