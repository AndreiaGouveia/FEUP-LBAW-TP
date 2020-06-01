<tr>
    <td><a href="{{ route('show.question', $answer->id_question  . '#' .  $answer->id_commentable_publication) }}" target="_blank">{{ $answer->publication->description }}</a></td>
    <td>
        @foreach ($answer->reported as $reported)
        <div class="btn btn-secondary btn-sm mt-1">{{ $reported->motive}}</div>
        @endforeach
    </td>
    <td><input type="checkbox" class="form-control-lg" autocomplete="off"  data-publication-id="{{ $answer->id_commentable_publication }}"></td>
</tr>