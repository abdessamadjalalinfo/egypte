@extends('master')

@section('content')

<style>
  tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<h1>Documents  @if(Auth::user()->type=="admin" or (Auth::user()->type=="editor" ))<a class="btn btn-success" href="{{route('addnewdocument')}}">+Add</a>@endif
   @if(Auth::user()->type=="admin" or (Auth::user()->type=="editor" ))    <button style="margin: 5px;" class="btn btn-danger btn-xs delete-all" data-url="">Delete Selected</button>@endif


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Search</button>
<a class="btn btn-success" href="{{route('showdocuments')}}">Reset</a>
<input style="display:inline-block;width:25%" id="myInput" type="text" class="form-control" placeholder="Search..">

</h1>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Search for documents</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('searchdocuments')}}">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">File id:</label>
            <input type="text" name="file_id"class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Target :</label>
            <input type="text" name="target" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Document Type:</label>
           <select class="form-select" name="type1" aria-label="Default select example">
           
           
            <option value="permissions">permissions</option>
           <option value="Legder Transaction">Legder Transaction</option>
          
         </select>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send message</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>



<div class="row">
<div class="col-8">



<table class="table">
  <thead>
    <tr class="table-active">
       <th><input type="checkbox" id="check_all"></th>
      <th >File_id</th>
        <th>Target</th>
      <th >Created at</th>
      <th >Document name</th>
      <th>Attachement</th>
      @if(Auth::user()->type=="admin" or (Auth::user()->type=="editor" ))
      <th>Option</th>
      @endif

    </tr>
  </thead>
  <tbody  id="myTable">
    @foreach($documemnts as $document)
    <tr id="tr_{{$document->id}}">
      <td><input type="checkbox" class="checkbox" data-id="{{$document->id}}"></td>
      <th scope="row">{{$document->file_id}}</th>
        <th>{{$document->target}}</th>
      <td>{{$document->created_at}}</td>
       <td><nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">{{$document->type1}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$document->type2}}</li>
  </ol>
</nav></td>

      <td><a target="_blank" href="{{asset("files/".$document->path)}}"> <i class="fas fa-fw fa-folder"></i>{{$document->path}}</a></td>
     @if(Auth::user()->type=="admin" or (Auth::user()->type=="editor" ))
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
</div>
      </td>
      @endif
      
  

    </tr>
    @endforeach
    
  </tbody>
</table>
 {!! $documemnts->links() !!}
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
<script type="text/javascript">

    $(document).ready(function () {



        $('#check_all').on('click', function(e) {

         if($(this).is(':checked',true))  

         {

            $(".checkbox").prop('checked', true);  

         } else {  

            $(".checkbox").prop('checked',false);  

         }  

        });



         $('.checkbox').on('click',function(){

            if($('.checkbox:checked').length == $('.checkbox').length){

                $('#check_all').prop('checked',true);

            }else{

                $('#check_all').prop('checked',false);

            }

         });



        $('.delete-all').on('click', function(e) {



            var idsArr = [];  

            $(".checkbox:checked").each(function() {  

                idsArr.push($(this).attr('data-id'));

            });  



            if(idsArr.length <=0)  

            {  

                alert("Please select atleast one record to delete.");  

            }  else {  



                if(confirm("Are you sure, you want to delete the selected categories?")){  



                    var strIds = idsArr.join(","); 



                    $.ajax({

                        url: "{{ route('category.multiple-delete') }}",

                        type: 'DELETE',

                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                        data: 'ids='+strIds,

                        success: function (data) {

                            if (data['status']==true) {

                                $(".checkbox:checked").each(function() {  

                                    $(this).parents("tr").remove();

                                });

                                alert(data['message']);

                            } else {

                                alert('Whoops Something went wrong!!');

                            }

                        },

                        error: function (data) {

                            alert(data.responseText);

                        }

                    });



                }  

            }  

        });



        $('[data-toggle=confirmation]').confirmation({

            rootSelector: '[data-toggle=confirmation]',

            onConfirm: function (event, element) {

                element.closest('form').submit();

            }

        });   

    

    });

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection