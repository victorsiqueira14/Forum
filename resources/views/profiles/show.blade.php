@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="page-header">
                    <h1>
                        {{ $profileUser->name }}
                        <small> Since {{ $profileUser->created_at->diffForHumans() }}</small>
                    </h1>
                </div>

                @foreach ($threads as $thread)
                    <div class="card">
                        <div class="card-header">
                            <div class="level">
                                <span class="flex">
                                    <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> posted:
                                    <a href="{{ '/threads/'.$thread->path() }}">{{ $thread->title }}</a>
                                </span>

                                <span>
                                    {{ $thread->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>

                        <div class="card-body">
                            {{ $thread->body }}
                        </div>
                    </div>
                @endforeach
                <div class="mt-2"> {{ $threads->links() }} </div>
            </div>
        </div>
    </div>
@endsection