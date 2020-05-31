<div class="row">
    <div class="col">
        {{ $answer->publication->description }}
    </div>
    <div class="col-2">
        {{ $answer->publication->date }}
    </div>
    <div class="col-3">
        {{ $answer->publication->owner->name }}
    </div>
</div>