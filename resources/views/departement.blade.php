@extends('master')

@section('content')
<h1>Departement management</h1>

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
 @if(Auth::user()->type=="admin" or (Auth::user()->type=="editor" ))
<div class="row">
    <div class="col-3">
 <form method="POST" action="{{route('storedepartement')}}">
     @csrf
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name of departement:</label>
    <input type="text" required name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>

  <button type="submit" class="btn btn-success">Add new departement</button>
</form>
    </div>
</div>
@endif

<br>
<h2>Liste of departement:</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Departement name</th>
      <th scope="col">Number of sub departement</th>
      <th scope="col">created_at</th>
       @if(Auth::user()->type=="admin" or (Auth::user()->type=="editor" )) 
      <th scope="col">option</th>
      @endif

      
    </tr>
  </thead>
  <tbody>
    @foreach($departements as $departement)
    <tr>
      <th scope="row">{{$departement->name}}</th>
      <td>{{$departement->subdepartements()->count()}}</td>
      <td>{{$departement->created_at}}</td>
       @if(Auth::user()->type=="admin" or (Auth::user()->type=="editor" ))
      <td>
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$departement->id}}" data-bs-whatever="@getbootstrap">Edit</button>

<div class="modal fade" id="exampleModal{{$departement->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit {{$departement->name}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('edit_departement')}}">
          
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Departement Name:</label>
           <input type="text" value="{{$departement->name}}"  name="name"class="form-control" id="recipient-name">
           <input type="hidden" value="{{$departement->id}}"  name="id"class="form-control" id="recipient-name">
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>













      </td>
      @endif
      
    </tr>
    @endforeach
    
  </tbody>
</table>

@endsection