<div class="like-buttons ml-4">
    <button type="radio" class="btn px-1 py-0" toggle="" data-placement="bottom" title="Eu gosto disto">
        <i class="far fa-thumbs-up"></i>
        <label style="margin-bottom: 0px">{{ $likes }} </label>
    </button>

    <button type="radio" class="btn px-1 py-0 ml-2" toggle="" data-placement="bottom" title="Eu não gosto disto">
        <i class="far fa-thumbs-down d-inline"></i>
        <label style="margin-bottom: 0px" class="d-inline">{{ $dislikes }}</label>
    </button>
</div>