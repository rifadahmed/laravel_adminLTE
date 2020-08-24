<link rel="stylesheet" href="/css/requiredField.css">
@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>

            <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Type</th>
                    <th>Created</th>
                    <th>Updated</th>
                  </tr>
                </thead>
                <tbody>
            
                    @if ($users)
                    @foreach ($users as $user)
                    
                        <td>{{$user->id}}</td>
                        <td><a href="{{route('admin.edit',$user->id)}}">{{$user->name}}</a> </td>
            
                          <td>
                            <img src="{{$user->photo}}"class="img-thumbnail" alt="">
                        </td>  
                        <td>{{$user->email}}</td>
                        <td>{{$user->role->name}}</td>
                        <td>{{$user->type}}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>{{$user->updated_at->diffForHumans()}}</td>
                        <td><button type="button" class="btn btn-info" data-toggle="modal" 
                            data-username={{$user->name}} data-useremail={{$user->email}} data-userphoto={{$user->photo}} data-usertype={{$user->type}}
                            data-userrole={{$user->role->name}} data-userid={{$user->id}}
                          data-target="#editMyModal"  >Edit</button>
                        </td>  
                        <td>                                        
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-deleteuserid={{$user->id}} data-target="#deleteMyModal">Delete
                             </button>
                        </td>               
                      </tr> 
                    @endforeach                 
                    @endif              
                </tbody>
              </table>
                
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  </div>



    {{--  EDIT MODAL STARTS HERE  --}}
    {!! Form::open(['method' => 'patch','action'=>['adminController@update',$user->id],'files'=>true]) !!} 
    <div class="container">
      <!-- Trigger the modal with a button -->
    
      <!-- Modal -->
      <div class="modal fade" id="editMyModal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            {{--  <div class="modal-header">
              <h4 class="modal-title">Modal Header</h4>
            </div>  --}}
            <div class="modal-body">
                <!-- Content Header (Page header) -->
                <div class="col-sm-3">
                  <img src="" id="img" class="img-thumbnail" alt="">
              </div> 
  
                  <div class="col-sm-9">                 
                  <div class="form-group">
                    <input type="hidden" name='userid' id='user_id' value="">
                  {!!Form::label('name',"Name");!!}
                  {!!Form::text('name',null, ['class' => 'form-control']);!!}

                  @error('name')
                  <div class="error_field">
                  <ion-icon name="alert-circle-outline" class="error_icon" style="margin-top:2px"></ion-icon> <p class="error_required_field"> {{ $message }}</p>
                 </div>
                  @enderror
                  </div>
              
                  <div class="form-group">
                  {!!Form::label('email',"Email");!!}
                  {!!Form::text('email',null, ['class' => 'form-control']);!!}
                  @error('email')
                  <div class="error_field">
                    <ion-icon name="alert-circle-outline" class="error_icon" style="margin-top:2px"></ion-icon> <p class="error_required_field"> {{ $message }}</p>
                   </div>
                  @enderror
                  </div>

              
                  <div class="form-group">
                  {!!Form::label('role',"Role");!!}
                   {{--  {!!Form::select('role', ['admin' => 'Admin', 'system' => 'System','user' => 'User'],$user->role,['class' => 'form-control']);!!}   --}}
                   {!!Form::select('role_id',$roles,null, ['class' => 'form-control']);!!}  
       
                  </div>
              
                  <div class="form-group">
                  {!!Form::label('type',"Type");!!}
                  {!!Form::select('type', ['top' => 'Top', 'mid' => 'Mid'], $user->type,['class' => 'form-control']);!!} 
                  
                  </div>
                  
                  <div class="form-group">
                      {!!Form::file('photo', ['class' => 'form-control']);!!}
                  </div>
              
                      <div class="form-group">
                      {!!Form::label('password',"Password");!!}
                      {{--  {!!Form::password('password', ['class' => 'form-control','required' => 'required']);!!}         --}}
                      {!!Form::password('password', ['class' => 'form-control']);!!}       
                      </div>       
              {{--  @include('partials.error')    --}}
              </div>

              </div>
              <div class="modal-footer">
                <div class="form-group">
                  {{--  {!!Form::submit('Update User',['class'=>"btn btn-primary"]);!!}  --}}
                 <button  class="btn btn-primary" id='updateUser' data-backdrop="static" >Update the user</button>
              
              </div> 
                <button type="button"  class="btn btn-default"data-dismiss="modal" >Close</button>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      {!! Form::close() !!}
   
    {{--  EDIT MODAL ENDS HERE  --}}




    {{--  DELETE MODAL STARTS HERE  --}}
    <!-- Modal -->
    <div class="modal fade" id="deleteMyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Waring!!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Do you want to delete this user?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <div>  
              {!!Form::open(['method' => 'delete','action' => ['adminController@destroy',$user->id]])!!}
              <input type="hidden" name='deleteuserid' id='delete_user_id' >
              {!!Form::submit('Yes',['class'=>"btn btn-danger "]);!!}
                      <br>       
              {!! Form::close() !!}
          </div> 
          </div>
        </div>
      </div>
    </div>
    {{--  DELETE MODAL ENDS HERE  --}}


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
      @if(Session::has('errors'))
      
      $('#editMyModal').modal('show');
      @endif
      $('#deleteMyModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id   =button.data('deleteuserid')
        var modal = $(this)
        modal.find('.modal-footer #delete_user_id').val(id)

      })
      $('#editMyModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var name = button.data('username') // Extract info from data-* attributes
        var email = button.data('useremail')
        var photo = button.data('userphoto')
        var type = button.data('usertype')
        var id   =button.data('userid')
        var modal = $(this)
       modal.find('.modal-body #img').attr("src",photo)
       modal.find('.modal-body #name').val(name)
       modal.find('.modal-body #email').val(email)
       modal.find('.modal-body #type').val(type)
       modal.find('.modal-body #user_id').val(id)
      })

      


    </script>

    @endsection

