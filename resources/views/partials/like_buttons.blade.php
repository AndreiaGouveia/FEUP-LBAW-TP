<div class="like-buttons ml-4 btn-group btn-group-toggle" data-toggle="buttons" data-publication-id="{{ $id_publication }}">
    <label class="btn btn-secondary px-1 py-0 like">
        <input type="radio" name="options" autocomplete="off">
        <i class="far fa-thumbs-up"></i>
        {{ $likes }}
    </label>
    <label class="btn btn-secondary px-1 py-0 ml-2 dislike">
        <input type="radio" name="options" autocomplete="off">
        <i class="far fa-thumbs-down"></i>
        {{ $dislikes }}
    </label>
</div>