<div class="row">
    <div class="col-lg-12">
        <div class="product__pagination">
            {{-- <a class="active" href="#">1</a> --}}
            {{-- <a href="#">2</a> --}}
            {{-- <a href="#">3</a> --}}
            {{-- <span>...</span> --}}
            {{-- <a href="#">21</a> --}}
            @if ($paginator->lastPage() > 1)
                @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                    <a class="{{ $paginator->currentPage() == $i ? ' active' : '' }}" href="{{ request()->fullUrlWithQuery(['page'=>$i]) }}">{{ $i }}</a>
                @endfor
            @endif
        </div>
    </div>
</div>
