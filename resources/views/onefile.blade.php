@extends('master')

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<h1>{{$file->target}}</h1>
<div class="row">
<div class="col-3">
<div class="card">
  <div class="card-body">
    <h4 style="color:black">Target :  {{$file->target}}</h4>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <h4 style="color:black">Scanning Date	 : {{$file->scanning_date}}</h4>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <h4 style="color:black"> Added By	 : {{$file->user()->first()->name}}</h4>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <h4 style="color:black"> Number of Pages	 : {{$file->number_of_pages}}</h4>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <h4 style="color:black"> Departement	 : {{$file->departement()->first()->name}}</h4>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <h4 style="color:black"> Sub Departement	 :{{$file->subdepartement()->first()->name}}</h4>
  </div>
</div>
</div>

<div class="col-7">

<table class="table">
  <thead>
    <tr class="table-active">
      <th scope="col">File ID</th>
      <th scope="col">Document Type</th>
      <th scope="col">Attachement</th>
      <th>Option</th>
      
    </tr>
  </thead>
  <tbody>
      @foreach($file->documents as $document)
    <tr>
      <th scope="row">{{$document->file_id}}</th>
      <td>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">{{$document->type1}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$document->type2}}</li>
  </ol>
</nav>  
        </td>
      <td><a target="_blank" href="{{asset("files/".$document->path)}}">{{$document->path}}</a></td>
      
      <td><a class="btn btn-danger" target="_blank" href="{{route('deletedocument',$document->id)}}">Delete</a>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal{{$document->id}}" data-bs-whatever="@getbootstrap">Edit</button>

<div class="modal fade" id="exampleModal{{$document->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit {{$document->target}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('updatedocument')}}">
          <input type="hidden" name="id" value="{{$document->id}}">
          <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Target:</label>
    <input type="text" required name="target" value="{{$document->target}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
    <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Type 1:</label>
    <select required name="type1" id="select-work" class="form-select select-work" aria-label="Default select example">
     <option selected value="{{$document->type1}}">{{$document->type1}}</option> 
      <option value="permissions">Permissions</option>
      <option value="Legder Transaction">Legder Transaction</option>
    </select>
  </div>
  
  
   <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Type2:</label>
    <select required name="type2" id="type2" class="form-select type2" aria-label="Default select example">
     
       
    </select>
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">File Id / Target File:</label>
    <select required name="file_id"  class="form-select" aria-label="Default select example">
        <option selected value="{{$document->file_id}}">{{$document->file->id}}: {{$document->file->target}}</option>
      @foreach(App\Models\File::all() as $file)
          <option value="{{$file->id}}">{{$file->id}}: {{$file->target}}</option>
        @endforeach
    </select>
  </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-warning">Update</button>
      </div>
          
        </form>
      </div>
      
    </div>
  </div>
</div></td>
      
    </tr>
    @endforeach
    
</tbody>
</table>

</div>
</div>

<script type="text/javascript">
   $(function() {
    $('.select-work').change(function() {
      console.log({
                type1: $(this).val(), _token: '{{csrf_token()}}'
            })
        
        $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
        $.ajax({
           
            method: "POST",
            url: "{{route('gettype2')}}",
            data: {
                type1: $(this).val(), _token: '{{csrf_token()}}' 
            },
            
            success: function(data){
               
                var $type2 = $('.type2');
            $type2.empty();
            $('.type2').empty();
            for (var i = 0; i < data.length; i++) {
              console.log(data[i]);
              
                $type2.append('<option value=' + data[i] + '>' + data[i] + '</option>');
              
            }

            //manually trigger a change event for the contry so that the change handler will get triggered
            $type2.change();
            

      
           

            }
        });
    });
});
</script>

@endsection