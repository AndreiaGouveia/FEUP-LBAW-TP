<div class="row">
    <div class="col">
        {{ $comment->publication->description }}
    </div>
    <div class="col-2">
        {{ $comment->publication->date }}
    </div>
    <div class="col-3">
        {{ $comment->publication->owner->name }}
    </div>
</div>