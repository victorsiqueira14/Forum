@extends('layouts.app')

@section('content')
<div class="container">
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-8 card">
                <div class="row card-header"> Create a new Thread </div>

                    <div class="card-body">
                        <form method="POST" action="/threads">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" >
                            </div>
                                <div class="form-group">
                                    <label for="body">Body: </label>
                                    <textarea name="body" id="body" class="form-control" rows="8" name="" ></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-2"> Publish </button>
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
