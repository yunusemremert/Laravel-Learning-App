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
{{--                        <b>{{ $story->title }} by {{ $story->user->name }}</b>--}}
{{--                        <br>--}}
{{--                        <hr>--}}
{{--                        {{ $story->body }}--}}
{{--                        <br>--}}
{{--                        <p class="font-italic">{{ $story->footnote }}</p>--}}
                        <img class="card-img-top" src="{{ $story->thumbnail }}" alt="Story image cap">
                        <h5 class="card-title mt-3">{{ ($story->title) }}</h5>
                        <p class="card-text">{{ ($story->body) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">{{ $story->user->name }}</button>
                            </div>
                            <small class="text-muted">{{ $story->type }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
