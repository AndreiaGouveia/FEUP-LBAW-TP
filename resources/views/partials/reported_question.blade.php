<div class="row">
    <div class="col">
        {{ $question->title }}
    </div>
    <div class="col-2">
        {{ $question->publication->date }}
    </div>
    <div class="col-3">
        {{ $question->publication->owner->name }}
    </div>
</div>