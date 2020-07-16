@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>Deleted Story List</div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>User</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($story as $stor)
                                <tr>
                                    <td>{{ $stor->title }}</td>
                                    <td>{{ $stor->type }}</td>
                                    <td>{{ $stor->user->name }}</td>
                                    <td class="text-right">
                                        <form class="d-inline-block" action="{{ route('admin.story.restore', [$stor]) }}" method="POST">
                                            @method('PUT')
                                                <button class="btn btn-warning">Restore</button>
                                            @csrf
                                        </form>
                                        <form class="d-inline-block" action="{{ route('admin.story.delete', [$stor]) }}" method="POST">
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $story->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
