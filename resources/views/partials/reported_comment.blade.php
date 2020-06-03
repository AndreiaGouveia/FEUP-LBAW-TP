<tr>
    <td><a href="{{ route('show.question', $comment->id_commentable_publication . '#' .  $comment->id_publication) }}" target="_blank">{{ $comment->publication->description }}</a></td>
    <td>
        @foreach ($comment->reported as $reported)
        <div class="btn btn-secondary btn-sm mt-1">{{ $reported->motive}}</div>
        @endforeach
    </td>
    <td>
        <input type="checkbox" class="form-control-lg" autocomplete="off"  data-publication-id="{{ $comment->id_publication }}">
    </td>
</tr>