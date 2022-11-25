<div class="card-header">
    <a href="#">
        <div class="level">
            <h5 class="flex">
                <a href="#">
                    {{ $reply->owner->name }}
                </a> said {{ $reply->created_at->diffForHumans() }}...
            </h5>

            <div>
                <form method="POST" action="/replies/{{ $reply->id }}/favorites ">
                    {{ csrf_field() }}

                    <button type="submit" class="btn btn-primary mt-2" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites_count }} {{ Str::plural('Favorite', $reply->favorites_count) }}
                    </button>
                </form>
            </div>
        </div>
</div>
<div>
    <div class="mb-2 card-body">
        {{ $reply->body }}
    </div>
</div>
