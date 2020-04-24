<div class="like-buttons ml-4 btn-group btn-group-toggle" data-toggle="buttons">
    <label class="btn btn-secondary px-1 py-0">
        <input type="radio" name="options" id="like" autocomplete="off">
        <i class="far fa-thumbs-up"></i>
        {{ $likes }}
    </label>
    <label class="btn btn-secondary px-1 py-0 ml-2">
        <input type="radio" name="options" id="dislike" autocomplete="off">
        <i class="far fa-thumbs-down d-inline"></i>
        {{ $dislikes }}
    </label>
</div>