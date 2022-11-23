@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row  justify-content-center">
            <div class="col-md-8">
                <div class="">
                    <div class="card">
                        <div class="card-header "> Forum Threads</div>
                    </div>

                    @foreach ($threads as $thread)
                        <div class="mt-2">
                            <article class="card">
                                <div class="card-header">
                                    <h4 class="">
                                        <a class="" href="/threads/{{ $thread->path() }}">
                                            {{ $thread->title }}
                                        </a>
                                    </h4>
                                </div>
                                <div class="">
                                    <div class="card-body"> {{ $thread->body }} </div>
                                </div>

                            </article>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
