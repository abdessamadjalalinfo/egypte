@extends('master')

@section('content')
<h1>Sub Departement management</h1>

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
 @if(Auth::user()->type=="admin" or (Auth::user()->type=="editor" ))
<div class="row">
    <div class="col-3">
 <form method="POST" action="{{route('storesubdepartement')}}">
     @csrf
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name of sub departement:</label>
    <input placeholder="name of Sub departement" type="text" required name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Departement:</label>
   <select name="departement" class="form-select" aria-label="Default select example">
  @foreach($departements as $dep)
    <option value="{{$dep->id}}" >{{$dep->name}}</option>
  @endforeach
</select>
  </div>

  <button type="submit" class="btn btn-success">Add new Sub departement</button>
</form>
    </div>
</div>
@endif


<br>
<h2>Liste of departement:</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Sub Departement </th>
      <th scope="col">Departement</th>
      <th scope="col">created_at</th>
       @if(Auth::user()->type=="admin" or (Auth::user()->type=="editor" )) 
      <th scope="col">option</th>
      @endif

      
    </tr>
  </thead>
  <tbody>
    @foreach($subdepartements as $sub)
   
    <tr>
      <th scope="row">{{$sub->name}}</th>
      <td>{{$sub->departement->name}}</td>
      <td>{{$sub->created_at}}</td>
       @if(Auth::user()->type=="admin" or (Auth::user()->type=="editor" ))
      <td>
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$sub->id}}" data-bs-whatever="@getbootstrap">Edit</button>

<div class="modal fade" id="exampleModal{{$sub->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit {{$sub->name}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('edit_subdepartement')}}">
          <input type="hidden" value="{{$sub->id}}" name="id"class="form-control" id="recipient-name">
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Sub Departement Name:</label>
           <input type="text" value="{{$sub->name}}" name="name"class="form-control" id="recipient-name">
          </div>
        
        <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Departement:</label>
   <select name="departement_id" class="form-select" aria-label="Default select example">
  @foreach($departements as $dep)
    <option value="{{$dep->id}}" >{{$dep->name}}</option>
  @endforeach
</select>
  </div>
  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      </div>
      </form>
      
      
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