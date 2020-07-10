@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>Story List</div>
                        @can('create', App\Story::class)
                            <div>
                                <a href="{{ route('story.create') }}" class="btn btn-success">Story Create</a>
                            </div>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($story as $stor)
                                    <tr>
                                        <td>{{ $stor->title }}</td>
                                        <td>{{ $stor->type }}</td>
                                        <td>{{ $stor->status == 1 ? 'Yes' : 'No' }}</td>
                                        <td class="text-right">
                                            @can('view', $stor)
                                                <a href="{{ route('story.show', [$stor->id]) }}" class="btn btn-warning">View</a>
                                            @endcan
                                            @can('update', $stor)
                                                <a href="{{ route('story.edit', [$stor->id]) }}" class="btn btn-primary">Edit</a>
                                            @endcan
                                            @can('delete', $stor)
                                                <form class="d-inline-block" action="{{ route('story.destroy', [$stor]) }}" method="POST">
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">Delete</button>
                                                    @csrf
                                                </form>
                                            @endcan
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
