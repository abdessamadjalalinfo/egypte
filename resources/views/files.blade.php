@extends('master')

@section('content')
<style>
  tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif

<h1>Files  @if(Auth::user()->type=="admin" or (Auth::user()->type=="editor" )) <a class="btn btn-success" href="{{route('addfile')}}"><i class="fas fa-plus-square"></i>

  Add</a>@endif
<a style="margin-left: 5px;" class="btn btn-success" href="{{route('searchfiles')}}"><i class="fas fa-filter"></i> Advanced Filtre</a>
<input style="display:inline-block;width:25%" id="myInput" type="text" class="form-control" placeholder="Search..">
<a class="btn btn-warning" href="{{ route('export') }}"> <i class="fas fa-file-csv"></i>Export </a>



</h1>
<div class="row">
<div class="col-1"> {!! $files->links() !!}</div>


</div>

<table style="font-size: 12px;" class="table table-bordered" >
  <thead>
    <tr class="table-active">
      <th scope="col">File ID</th>
      <th scope="col">Scanning Date</th>
      <th scope="col">Added By</th>
       <th scope="col">Transaction Number</th>
      <th scope="col">Vendor name</th>
       <th scope="col">Date of docs</th>
      
     
     
      <th scope="col">Number of Pages</th>
       <th scope="col">Departement</th>
       <th scope="col">Sub Departement</th>
    <th scope="col">Document</th>
     @if(Auth::user()->type=="admin" or (Auth::user()->type=="editor" ))
    <th scope="col">Option</th>
    @endif

    </tr>
  </thead>
  <tbody id="myTable">
    @foreach($files as $file)
    <tr>
      <th scope="row">{{$file->target}}</th>
      <td>{{$file->scanning_date}}</td>
       <td>{{$file->user()->first()->name}}</td>
       <td>{{$file->transaction_number}}</td>
        <td>{{$file->vendor_name}}</td>
       <td>{{$file->date_of_docs}}</td>
       <td>{{$file->number_of_pages}}</td>
       <td>{{$file->departement()->first()->name}}</td>
       <td>{{$file->subdepartement()->first()->name}}</td>
      <td><a target="_blank" href="{{route('showfile',$file->id)}}"> <i class="fas fa-fw fa-folder"></i>Document({{$file->documents()->count()}})</a></td>
          @if(Auth::user()->type=="admin" or (Auth::user()->type=="editor" ))

      <td>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$file->id}}" data-bs-whatever="@getbootstrap"><i class="fas fa-edit"></i>

</button>

<div class="modal fade" id="exampleModal{{$file->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <form method="POST" action="{{route('editfile')}}">
          <input type="hidden" name="id" value="{{$file->id}}">
     @csrf
     <div class="row">
  <div class="col-6">
    <label for="exampleInputEmail1" class="form-label">Target:</label>
    <input type="text" required name="target" value="{{$file->target}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
 
  <div class="col-6">
    <label for="exampleInputPassword1" class="form-label">Number of pages:</label>
    <input type="number" required name="nb_pages" value="{{$file->number_of_pages}}" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="col-6">
    <label for="exampleInputPassword1" class="form-label">Vendor Name:</label>
    <input type="text" required name="vendor_name" value="{{$file->vendor_name}}" class="form-control" id="exampleInputPassword1">
  </div>

  <div class="col-6">
    <label for="exampleInputPassword1" class="form-label">Transaction Number:</label>
    <input type="text" required name="transaction_number" value="{{$file->transaction_number}}" class="form-control" id="exampleInputPassword1">
  </div>

  <div class="col-6">
    <label for="exampleInputPassword1" class="form-label">Date of Docs:</label>
    <input type="date" required name="date_of_docs" value="{{$file->date_of_docs}}" class="form-control" id="exampleInputPassword1">
  </div>

  <div class="col-6">
    <label for="exampleInputPassword1" class="form-label">Departement:</label>
    <select required name="departement" id="select-work" class="form-select select-work" aria-label="Default select example">
       @foreach(App\Models\Departement::all() as $departement)
       <option value="{{$departement->id}}">{{$departement->name}}</option>
       @endforeach
    </select>
  </div>

  <div class="col-6">
    <label for="exampleInputPassword1" class="form-label">Sub Departement:</label>
    <select required name="sub_departement" id="sub" class="form-select sub" aria-label="Default select example">
       
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
</div>


    </td>
    @endif
    </tr>
    @endforeach
    
  </tbody>
</table>
<div class="row">
<div class="col-3"> {!! $files->links() !!}</div>


</div>


   <script type="text/javascript">
   $(function() {
    $('.select-work').change(function() {
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
               
                var $sub = $('.sub');
            $sub.empty();
            $('.sub').empty();
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
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    console.log(value);
    
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>




@endsection