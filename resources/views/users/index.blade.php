@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <h1 class="my-4">Users</h1>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Created at</th>
                <th scope="col" colspan="2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td><a href="{{route('users.show', ['user'=>$user])}}">{{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>
                        <a href="{{route('users.edit',['user' => $user])}}" class="btn btn-primary">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('users.destroy',['user' => $user])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination justify-content-center mb-4">
            {{ $users->links() }}
        </div>
    </div>

@endsection
