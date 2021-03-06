@extends('master')


@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif

<h1>Add New File</h1>

<div class="row">
    
 <form method="POST" action="{{route('storefile')}}">
     @csrf
     <div class="row"> 
     <div class="col-4">
       
        <label for="exampleInputEmail1" class="form-label">File ID:</label>
        <input type="text" required name="target" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      
     </div>
   
    
      <div class="col-4">
        <label for="exampleInputPassword1" class="form-label">Number of pages:</label>
        <input type="number" required name="nb_pages" class="form-control" id="exampleInputPassword1">
      </div>
      <div class="col-4">
        <label for="exampleInputPassword1" class="form-label">Vendor Name:</label>
        <input type="text" required  name="vendor_name" class="form-control" id="exampleInputPassword1">
      </div>

      <div class="col-4">
        <label for="exampleInputPassword1" class="form-label">Transaction Number:</label>
        <input type="text"  name="transaction_number" required class="form-control" id="exampleInputPassword1">
      </div>
    <div class="col-4">
    <label for="exampleInputPassword1" class="form-label">Date of Docs:</label>
    <input type="date"  name="date_of_docs" required class="form-control" id="exampleInputPassword1">
    </div>
    <div div class="col-4">
      <label for="exampleInputPassword1" class="form-label">Departement:</label>
      <select required name="departement " id="select-work" class="form-select" aria-label="Default select example">
        @foreach($departements as $departement)
        <option value="{{$departement->id}}">{{$departement->name}}</option>
        @endforeach
      </select>
    </div>

      <div class="col-4">
        <label for="exampleInputPassword1" class="form-label">Sub Departement:</label>
        <select required name="sub_departement" id="sub" class="form-select" aria-label="Default select example">
        </select>
      </div>
      <div class="col-4">
          <label for="disabledSelect" class="form-label">Added By:</label>
          <select name="user_id" id="disabledSelect" class="form-select">
            <option value="{{Auth::user()->id}}">{{Auth::user()->name}}</option>
          </select>
      </div>


    </div>
  </div>
<br>
  <button type="submit" class="btn btn-primary">Add</button>
   </form>
    </div>
</div>
   <script type="text/javascript">
   $(function() {
    $('#select-work').change(function() {
      console.log({
                departement: $(this).val(), _token: '{{csrf_token()}}'
            })
        
        $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
        $.ajax({
           
            method: "POST",
            url: "{{route('getsubdepartements')}}",
            data: {
                departement: $(this).val(), _token: '{{csrf_token()}}' 
            },
            
            success: function(data){
               
                var $sub = $('#sub');
            $sub.empty();
            $('#sub').empty();
            for (var i = 0; i < data.length; i++) {
              console.log(data[i]);
              
                $sub.append('<option value=' + data[i].id + '>' + data[i].name + '</option>');
              
            }

            //manually trigger a change event for the contry so that the change handler will get triggered
            $sub.change();
            

      
           

            }
        });
    });
});
</script>
@endsection