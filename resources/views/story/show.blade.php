@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>Story Detail</div>
                        <div>
                            <a href="{{ route('story.index') }}" class="btn btn-info">Story List</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <b>{{ $story->title }}</b>
                        <br>
                        <hr>
                        {{ $story->body }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
