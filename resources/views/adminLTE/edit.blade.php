@extends('layouts.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit User</h1>
        
          <div class="col-sm-3">
           <img src="{{$user->photo}}"class="img-thumbnail" alt="">
       </div> 
       
           <div class="col-sm-9">
           {{-- action must be smaller letter --}}
           {!! Form::model($user,['method' => 'patch','action'=>['adminController@update',$user->id],'files'=>true]) !!} 
           <div class="form-group">
       
           {!!Form::label('name',"Name");!!}
           {!!Form::text('name',null, ['class' => 'form-control']);!!}
           </div>
       
           <div class="form-group">
           {!!Form::label('email',"Email");!!}
           {!!Form::text('email',null, ['class' => 'form-control']);!!}
           </div>
       
           <div class="form-group">
           {!!Form::label('role',"Role");!!}
            {{--  {!!Form::select('role', ['admin' => 'Admin', 'system' => 'System','user' => 'User'],$user->role,['class' => 'form-control']);!!}   --}}
            {!!Form::select('role_id',[ ''=> 'Choose Role']+$roles, null, ['class' => 'form-control']);!!}

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
               {!!Form::password('password', ['class' => 'form-control']);!!}       
               </div>
       
            <div class="form-group">
               {!!Form::submit('Update User',['class'=>"btn btn-primary"]);!!}
       
               
           </div>  
       {!! Form::close() !!}
              
       
               
     
           <div>  
           {!!Form::open(['method' => 'delete','action' => ['adminController@destroy',$user->id]])!!}
               
                   {!!Form::submit('Delete User',['class'=>"btn btn-danger "]);!!}
                   <br>       
           {!! Form::close() !!}
       </div> 

       </div>
        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  </div>
@include('partials.error')
@endsection


