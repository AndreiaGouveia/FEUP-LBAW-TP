<tr>
    <td><a href="{{ route('show.question', $question->id_commentable_publication) }}" target="_blank">{{ $question->title }}</a></td>
    <td>
        @foreach ($question->reported as $reported)
        <div class="btn btn-secondary btn-sm mt-1">{{ $reported->motive}}</div>
        @endforeach
    </td>
    <td>
        <input type="checkbox" class="form-control-lg" autocomplete="off" data-publication-id="{{ $question->id_commentable_publication }}">
    </td>

</tr>