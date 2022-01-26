@extends('master')

@section('content')
<h1>Add new document</h1>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="row">
<div class="col-6">
<form method="POST" action="{{route('storedocument')}}" enctype="multipart/form-data">
     @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Target:</label>
    <input type="text" required name="target" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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
    <label for="exampleInputPassword1" class="form-label">File Id / Target File:</label>
    <select required name="file_id"  class="form-select" aria-label="Default select example">
        @foreach($files as $file)
          <option value="{{$file->id}}">{{$file->id}}: {{$file->target}}</option>
        @endforeach
    </select>
  </div>
  <div class="mb-3">
  <div class="custom-file">
    <input type="file" name="filenames[]" >

  </div>
  </div>


  <button type="submit" class="btn btn-success">+Add</button>
</form>





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