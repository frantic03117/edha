 <div class="w-100 plan_box @if ($item->is_popular == '1') popularplan @endif ">
    <div class="plan_header  position-relative">
        <h4 class="plan_title">{{ $item->title }}</h4>
        <p class="plan_sort_desc">{{ $item->sub_title }}</p>
        @if ($item->is_popular)
            <span class="popularTag badge bg-primary text-white rounded-pill">Popular</span>
        @endif
    </div>
    <div class="plan_body">
        <h2>
            ₹ {{ $item->amount }}
        </h2>
        <div class="w-100 px-5">
            <form action="{{ route('purchase_plan') }}" method="post">
                @csrf
                <input type="hidden" name="plan_id" value="{{ $item->id }}">
                <button
                    class="btn @if ($item->is_popular == '1') btn-primary @else btn-outline-success @endif rounded-pill btn-sm w-100 text-uppercase">Get
                    Started</button>
            </form>

        </div>
    </div>
    <div class="plan_footer">
        {!! $item->description !!}
    </div>
</div>