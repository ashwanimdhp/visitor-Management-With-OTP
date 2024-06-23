
@extends('Backend.master')
@section('bodyContent')
  
<div class="section-body">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <div class="card-body">
                <h4>Manage Role List </h4>
              </div>
              <button type="button" class="btn btn-primary" data-toggle="modal"
                  data-target="#exampleModalCenter">Add</button>
          
          </div>
          <div class="card-body">
            <table class="table" id="mytable">
                <thead>
                    <tr>
                        <th>Sr</th>
                        {{-- <th>id</th> --}}
                        <th>Role</th>
                      
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $sr=1;
                @endphp
                    @foreach ($role as $item)
                      
                    <tr>
                        <td scope="row">{{ $sr++ }}</td>
                      
                          <td class="Role_id" style="display: none">{{ $item->id }}</td>
                       
                        <td class="RoleName">{{ $item->roleName }}</td>
                        <td class="getId"> <button type="button" class="btn btn-primary" data-toggle="modal"
                          data-target="#exampleModalCenterUpdate" >Edit</button> </td>
                        <td> <a href="{{ route('Role.DeleteRole', ['id' => $item->id]) }}" onclick="return confirm('Are you sure to delete this record')" class="btn btn-danger btn-sm">Delete</a></td>

                   
                      </tr>
                  
                    @endforeach
                    
                  
                </tbody>
            </table>

            
         
          </div>
        </div>
      </div>
      <script>
        // document.getElementById("hideIdRow").style.display = "none";

      </script>

     <script>
      
        
        // $('.getId').click(function (e) { 
          $('#mytable tr').click(function() {
    var Message = $(this).find(".RoleName").html();   
         var RoleId = $(this).find(".Role_id").html();   

    $('#RoleName').val(Message);
    $('#Roleid').val(RoleId);
    
 });
          
        // });
  
     </script>


      
      <!--update category model form-->
      <div class="modal fade" id="exampleModalCenterUpdate" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalCenterTitle" aria-hidden="false" style="" >
      <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Update Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('Role.UpdateRole') }}" method="post">
            @csrf
        <div class="modal-body">
         <label for="">Edit Role</label>
         <input type="hidden" name="Roleid" id="Roleid">
         <input type="text" name="role" id="RoleName" class="form-control" placeholder="" autofocus>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
      </div>
      </div>
      </div>

      <!--add category model form-->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalCenterTitle" aria-hidden="false" style="" >
      <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Add Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('Role.StoreRole') }}" method="post">
            @csrf
        <div class="modal-body">
         <label for="">Create Role</label>
         <input type="text" name="role" class="form-control" placeholder="" autofocus>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
      </div>
      </div>
      </div>
     






    </div>
</div>

  @endsection