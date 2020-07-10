@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>Home Page</div>
                        <div>
                            <a href="{{ route('dashboard.index') }}" class="btn btn-success btn-sm">All</a>
                            <a href="{{ route('dashboard.index', ['type' => 'short']) }}" class="btn btn-success btn-sm">Short</a>
                            <a href="{{ route('dashboard.index', ['type' => 'long']) }}" class="btn btn-success btn-sm">Long</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Author</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($story as $stor)
                                <tr>
                                    <td>
                                        <a href="{{ route('dashboard.show', [$stor]) }}">{{ $stor->title }}</a>
                                    </td>
                                    <td>{{ $stor->type }}</td>
                                    <td>{{ $stor->user->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $story->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
