
@if($tag != null)
<a class="btn btn-secondary btn-sm px-2 py-0 my-1 mr-2" href="{{ route('search.topic', ['tag' => $tag]) }}">{{ $tag }}</a>
@endif