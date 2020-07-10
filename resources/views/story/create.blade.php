@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>Create Story</div>
                        <div>
                            <a href="{{ route('story.index') }}" class="btn btn-info">Story List</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('story.store') }}" method="POST" autocomplete="off">
                            @include('story.form')
                            <button type="submit" class="btn btn-success">Add</button>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
