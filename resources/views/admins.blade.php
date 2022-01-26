@extends('master')

@section('content')
<h1>Admins</h1>


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
    @foreach($admins as $admin)
    <tr>
      <th scope="row">{{$admin->name}}</th>
      <td>{{$admin->email}}</td>
      <td>{{$admin->type}}</td>
      <td><a href="{{route('markasviewer',$admin->id)}}" class="btn btn-warning">Mark as Viewr </a>
    <a href="{{route('markaseditor',$admin->id)}}" class="btn btn-success">Mark as Editor </a>
    </td>
    </tr>
    @endforeach
    
  </tbody>
</table>

@endsection