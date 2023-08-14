@extends('layouts.app')
@section('content')


<div class="container">
	<div class="row">
  
            <div class="card-body">
            	<h2 class="text-center">ALL Users</h2>
  <table class="table table-striped">
    <thead>
      <tr>
      	<th>S No -Id</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Image</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      @foreach($users as $user)
    <tr>
    	<td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->phone }}</td>
        <td>{{ $user->email }}</td>
        <td><img src="{{ asset('uploads/' . $user->image) }}" alt="User Image" width="50">

        </td>

        <td>
            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
            </form>
        </td>

    </tr>
    @endforeach
      
      
    </tbody>
  </table>
</div>
</div>
@endsection