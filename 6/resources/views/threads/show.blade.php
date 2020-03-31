@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <a href="#">{{ $thread->creator->name}}</a> posted:
                    {{ $thread->title }}</div>

                   <div class="card-body">
                   {{ $thread->body }}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($thread->replies as $reply)
            <div><br></div>
                    @include('threads.reply')
            @endforeach
    </div>

    </div>
<br>
    @if (auth()->check())
    <div class="row justify-content-center">
        <div class="col-md-8">
        <form action="{{ $thread->path() . '/replies' }}" method="POST">
            @csrf
            <label for="body">Comments:</label>
            <div class="form-group">
            <textarea name="body" id="body" rows="5" class="form-control" placeholder="Have Something to say?"></textarea>
        </div>
        <button type="submit" class="btn btn-info">POST</button>
        </form>
    </div>
    @else
<p class="text-center">Please<a href="{{route('login')}}"> sign in</a> for participate in this Discusion</p>
    @endif
</div>
</div>
@endsection
