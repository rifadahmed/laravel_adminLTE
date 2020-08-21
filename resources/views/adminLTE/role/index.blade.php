@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
<h1>Add new Role</h1>
<div class="col-sm-4">
    {!!Form::open(['method' => 'post','action' => 'adminRoleController@store'])!!}
            <div class="form-group">
            {!!Form::text('name',null,['class' => 'form-control']); !!}
            </div>
            <div class="form-group">
                {!!Form::submit('Add!',['class'=>'btn btn-primary'])!!}
            </div>
          
    {!! Form::close() !!}
</div>

<div class="col-sm-8">
<table class="table table-hover">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>

      </tr>
    </thead>

    <tbody>
        @if ($roles)
        @foreach ($roles as $role)
        <tr>
            <td>{{$role->id}}</td>
            <td><a href="">{{$role->name}}</a> </td>        
          </tr> 
        @endforeach
      
      @endif
    
    </tbody>

  </table>
</div>
</div><!-- /.col -->

</div><!-- /.row -->
</div><!-- /.container-fluid -->
</div>
@endsection