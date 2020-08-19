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
                        <td>{{$user->role}}</td>
                        <td>{{$user->type}}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>{{$user->updated_at->diffForHumans()}}</td>
                        
                      </tr> 
                    @endforeach
                    
                    @endif
                  
                  
                </tbody>
              </table>
                











          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    

    @endsection
