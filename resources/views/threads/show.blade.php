@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row  mb-4 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="#"> {{ $thread->creator->name }} </a> posted:

                    {{ $thread->title }}
            </div>
                <div class="card-body">

                    {{ $thread->body }}

                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4 justify-content-center ">
        <div class="col-md-8  col-md-offset-2">
            <div class="card">
                <div>
                    @foreach ($thread->replies as $reply)
                        @include ('threads.reply')
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    @if (auth()->check())
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <form method="POST" action="{{ '/threads/'.$thread->path().'/replies' }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <textarea name="body" id="body" class="form-control" placeholder="have something to say?" rows="5" ></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2"> Post </button>
            </form>
        </div>
    </div>
    @else
    <p class="text-center"> Please <a href="{{ route('login') }}"> Sign in </a> sign in to participate in this discussion </p>
    @endif


</div>
@endsection
