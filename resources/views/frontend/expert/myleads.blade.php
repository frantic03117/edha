@extends('frontend.user.main')

@section('ucontent')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                @if (!count($items))
                    <div class="alert alert-warning">
                        No Lead found!
                    </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="w-100 leadcontainer">
                    @foreach ($items as $k => $item)
                        <div id="lead{{ $item['id'] }}" onclick="openLeadDetails({{ $item['id'] }})" role="button"
                            class="w-100 mb-1  leadbox">
                            <div class="w-100 text-end ">
                                @if ($item->created_at)
                                    <span class="leadtime">
                                        {{ date('d-M-Y h:i A', strtotime($item->created_at)) }}
                                    </span>
                                @endif
                            </div>
                            <ul>
                                <li>
                                    <strong>
                                        Name :
                                    </strong> {{ $item->name }}
                                </li>
                                <li>
                                    <strong> Preferred Language :</strong> {{ $item->search_data?->languages }}
                                </li>
                                <li>
                                    <strong>Address :</strong>
                                    {{ $item->search_data?->state_name?->state . ' ' . $item->search_data?->city_name?->city . ' ' . $item->search_data?->pincode }}
                                </li>
                                <li>
                                    <strong>How Soon Start :</strong> {{ $item->search_data?->how_soon }}
                                </li>

                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-8">
                <div class="w-100">
                    <img src="{{ url('public/assets/img/loading_gif.gif') }}" alt="" class="img-fluid"
                        id="loadingimg" style="display: none;">
                    <div id="leadBoxcontainer"> </div>
                </div>
            </div>
        </div>
    </div>
    <script>
       
        const openLeadDetails = (id) => {
            let elem = "";
            $("#loadingimg").show();
           
            const routef =
                $.post("{{ route('leads.show') }}", {
                    id: id
                }, function(res) {

                    const itms = JSON.parse(res.sub_cats);
                    let spans = "";
                    itms.forEach(ct => {
                        return spans +=
                            `<span class="badge border  border-success me-1 text-primary">${ct.sub_category}</span>`;
                    })
                    elem = `<div class="w-100 px-3 leaddetails">
                    <h4 class="leadname">${res.name}</h4>
                    <p class="leadAddress"> <i class="fa-solid fa-location-dot"></i> : ${res.city_name?.city} ${res.state_name?.state} ${res.pincode}</p>
                    <div class="w-100 mb-2">
                        <strong> <i class="fa-solid fa-phone"></i> :</strong> +91-${res.mobile}  <span data-bs-toggle="tooltip"  title="Verified Mobile"><i class="fa-solid fa-circle-check"></i></span>
                    </div>
                   
                    <div class="w-100 mb-2">
                        <strong> <i class="fa-solid fa-envelope"></i> :</strong> ${res.email}
                    </div>
                   
                    <div class="w-100 mt-3 leadDescription">
                        <div class="w-100 mb-2">
                            <h5>Are you looking out for?</h5>
                            <p>${res.category_name.category}</p>
                        </div>
                        <div class="w-100 mb-2">
                            <h5>Concerns</h5>
                            <p>${spans}</p>
                        </div>
                        <div class="w-100 mb-2">
                            <h5>Are you looking out for?</h5>
                            <p>${res.for_me == "1" ? "For Self" : res.for_whome}</p>
                        </div>
                        <div class="w-100 mb-2">
                            <h5>How soon can you start ?</h5>
                            <p>${res.how_soon}</p>
                        </div>
                        <div class="w-100 mb-2">
                            <h5>Your age ?</h5>
                            <p>${res.age_group}</p>
                        </div>
                        <div class="w-100 mb-2">
                            <h5> Your preferred mode of consultation ?</h5>
                            <p>${res.contact_mode == "Yes" ? "Online" : "Offline"}</p>
                        </div>
                        <div class="w-100 mb-2">
                            <h5>My preferred Languages</h5>
                            <p>${res.languages}</p>
                        </div>


                    </div>
                </div>`
                    $("#loadingimg").css('display', 'block');
                    setTimeout(() => {
                        $("#loadingimg").css('display', 'none');

                        $("#leadBoxcontainer").html(elem);
                        $(".leadbox").css({
                            border: "1px solid #ccc",
                            background: "#fff"
                        })
                        $("#lead" + id).css({
                            border: "2px solid #077773",
                            background: "#07777333"
                        })
                    }, 300);


                })
        };
        const discardLead = (e) => {
            e.preventDefault();
            if(confirm('Are you sure ?')){
                const discardLeadRoute = "{{route('discard_lead')}}";
                const lead_id = $("#lead_id").val();
                $.post(discardLeadRoute, {
                lead_id: lead_id
            }, function(res) {
                if (res.success == "1") {
                    window.location.reload();
                }
                if (res.success == "0") {
                    toastr.error(res.message, 'Error')
                }
            })
            }
        }
        const assignLeadForm = (e) => {
            e.preventDefault();
            const furl = "{{ route('assign_lead') }}";
            const id = $("#id").val();
            const lead_id = $("#lead_id").val();
            $.post(furl, {
                id: id,
                lead_id: lead_id
            }, function(res) {
                if (res.success == "1") {
                    window.location.reload();
                }
                if (res.success == "0") {
                    toastr.error(res.message, 'Error')
                }
            })
        };
    </script>
@endsection
