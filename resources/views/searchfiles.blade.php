@extends('master')

@section('content')
<h1>Filter </h1>
<div class="row">
<div class="col-5">
 <form method="POST" action="{{route('search')}}">
     @csrf
     <div class="row">
  <div class="col-6">
    <label for="exampleInputEmail1" class="form-label">File Id:</label>
    <input type="text"  name="target" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="col-6">
    <label for="exampleInputPassword1" class="form-label">Scanning date:</label>
    <input type="date"  name="scanning_date" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="col-6">
    <label for="exampleInputPassword1" class="form-label">Number of pages:</label>
    <input type="number"  name="nb_pages" class="form-control" id="exampleInputPassword1">
  </div>
   <div class="col-6">
    <label for="exampleInputPassword1" class="form-label">Vendor Name:</label>
    <input type="text"  name="vendor_name" class="form-control" id="exampleInputPassword1">
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Transaction Number:</label>
    <input type="text"  name="transaction_number" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Departement:</label>
    <select  name="departement" id="select-work" class="form-select" aria-label="Default select example">
       <option value="" selected></option>
        @foreach($departements as $departement)
       <option value="{{$departement->id}}">{{$departement->name}}</option>
       @endforeach
    </select>
  </div>

  <div class="mb-3">
      <label for="disabledSelect" class="form-label">Added By:</label>
      <select name="user_id" id="disabledSelect" class="form-select">
        <option value="" selected></option>
        @foreach(App\Models\User::all() as $user)
        <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
      </select>
    </div>
  </div> 

  <button type="submit" class="btn btn-primary">Search</button>
   <a href="{{route('file')}}" class="btn btn-success">Show All</a>
  
  </form>



</div>



</div>

@endsection