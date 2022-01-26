@extends('master')

@section('content')
<h1>List of Editors</h1>


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
    @foreach($editors as $editor)
    <tr>
      <th scope="row">{{$editor->name}}</th>
      <td>{{$editor->email}}</td>
      <td>{{$editor->type}}</td>
      <td><a href="{{route('markasadmin',$editor->id)}}" class="btn btn-danger">Mark as Admin </a>
    <a href="{{route('markasviewer',$editor->id)}}" class="btn btn-success">Mark as viewer </a>
    </td>
    </tr>
    @endforeach
    
  </tbody>
</table>

@endsection