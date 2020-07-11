@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>Story Detail</div>
                        <div>
                            <a href="{{ route('dashboard.index') }}" class="btn btn-info">Story List</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <b>{{ $story->title }} by {{ $story->user->name }}</b>
                        <br>
                        <hr>
                        {{ $story->body }}
                        <br>
                        <p class="font-italic">{{ $story->footnote }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
