 <div class="w-100 plan_box  ">
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
    </div>
    <div class="plan_footer">
        {!! $item->description !!}
    </div>
    <div class="w-100 mt-4 d-flex gap-4">
        <a href="{{route('subscription.edit', $item->id)}}" class="btn rounded-pill px-5 btn-light">Edit</a>
        
        
        <form action="{{route('subscription.destroy', $item->id)}}" onSubmit="deleteThisPlan(event)" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger px-5 rounded-pill ms-3">Delete</button>
        </form>
    </div>
</div>
<script>
    const deleteThisPlan = (e) => {
        e.preventDefault();
        if(confirm('Are you sure to delete this ?')){
            e.target.submit();
        }
    }
</script>