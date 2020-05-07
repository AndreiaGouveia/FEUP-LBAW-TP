
@if($tag != null)
<a class="btn btn-secondary btn-sm px-2 py-0 my-1 mr-2" href="{{ route('search_topic', ['tag' => $tag]) }}">{{ $tag }}</a>
@endif