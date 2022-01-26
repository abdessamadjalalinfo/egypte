@extends('master')

@section('content')
<h1>Liste of Viewers</h1>
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Create new User</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New user</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('addnewuser')}}">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">name:</label>
            <input name="name" type="text" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">email:</label>
            <input name="email" class="form-control" id="message-text">
          </div>
           <div class="mb-3">
            <label for="message-text" class="col-form-label">Password:</label>
            <input name="password" class="form-control" id="message-text">
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Add</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>


<table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Type</th>
      <th scope="col">Option</th>
    </tr>
  </thead>
  <tbody>
    @foreach($viewers as $viewer)
    <tr>
      <th scope="row">{{$viewer->name}}</th>
      <td>{{$viewer->email}}</td>
      <td>{{$viewer->type}}</td>
      <td><a href="{{route('markasadmin',$viewer->id)}}" class="btn btn-danger">Mark as admin </a>
    <a href="{{route('markaseditor',$viewer->id)}}" class="btn btn-success">Mark as Editor </a>
    </td>
    </tr>
    @endforeach
    
  </tbody>
</table>

@endsection