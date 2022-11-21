<div class="card-header">
    <a href="#">
        {{ $reply->owner->name }}
    </a> said {{ $reply->created_at->diffForHumans() }}...
</div>
<div>
    <div class="mb-2 card-body">
            {{ $reply->body }}
        </div>
    </div>
