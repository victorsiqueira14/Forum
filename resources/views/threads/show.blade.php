@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> posted:
                        {{ $thread->title }}
                    </div>

                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>



                @foreach ($replies as $reply)
                    <div class="card mt-4">
                    @include ('threads.reply')
                    </div>
                 @endforeach
                <div class="mt-2"> {{ $replies->links() }}</div>


                @if (auth()->check())
                    <form method="POST" action="{{ '/threads/'.$thread->path().'/replies' }}">
                        {{ csrf_field() }}

                        <div class="form-group mt-4">
                            <textarea name="body" id="body" class="form-control" placeholder="Have something to say?"
                                      rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2"> Post </button>
                    </form>
                @else
                    <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this
                        discussion.</p>
                @endif
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p>
                            This thread was published {{ $thread->created_at->diffForHumans() }} by
                            <a href="#">{{ $thread->creator->name }} </a>, and currently
                            has {{ $thread->replies_count }} {{ Str::plural('comment', $thread->replies_count) }}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


