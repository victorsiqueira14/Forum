@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row  justify-content-center">
            <div class="col-md-8">
                <div class="">
                    {{-- titulo ??  se for coloque aqui --}}
                    @foreach ($threads as $thread)
                        <div class="mt-2">
                            <article class="card">
                                <div class="card-header">

                                    <div class="level">
                                        <h4 class="flex">
                                            <a class="" href="/threads/{{ $thread->path() }}">
                                                {{ $thread->title }}
                                            </a>
                                        </h4>

                                        <a href="/threads/{{ $thread->path() }}">
                                            {{ $thread->replies_count }}
                                            {{ Str::plural('reply', $thread->replies_count) }}</a>
                                    </div>


                                </div>
                                <div class="">
                                    <div class="card-body"> {{ $thread->body }}</div>
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
