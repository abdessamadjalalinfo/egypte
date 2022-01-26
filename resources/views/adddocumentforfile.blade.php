@extends('master')

@section('content')
<h1>Add new document for {{$file->id}} </h1>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
<div class="row">
<div class="col-4">
<form method="POST" action="{{route('storedocument')}}" enctype="multipart/form-data">
     @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Target:</label>
    <input type="text" required name="target" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">File ID:</label>
    <input type="text" required name="file_id" value="{{$file->id}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
    <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Type 1:</label>
    <select required name="type1" id="select-work" class="form-select" aria-label="Default select example">
      <option value="permissions">Permissions</option>
       <option value="Legder Transaction">Legder Transaction</option>
    </select>
  </div>
  
  
   <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Type2:</label>
    <select required name="type2" id="type2" class="form-select" aria-label="Default select example">
       
    </select>
  </div>

 
  <div class="mb-3">
  <div class="custom-file">
    <input type="file" name="filenames[]" >

  </div>
  </div>


  <button type="submit" class="btn btn-primary">Add</button>
</form>





</div>
<div class="col-6">
  <table class="table">
  <thead>
    <tr class="table-active">
      <th scope="col">File ID</th>
      <th scope="col">Document Type</th>
      <th scope="col">Attachement</th>
      
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
      <td><a a target="_blank" href="{{asset("files/".$document->path)}}">{{$document->path}}</a></td>
      
    </tr>
    @endforeach
    
</tbody>
</table>
</div>

</div>



   <script type="text/javascript">
   $(function() {
    $('#select-work').change(function() {
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
               
                var $type2 = $('#type2');
            $type2.empty();
            $('#type2').empty();
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