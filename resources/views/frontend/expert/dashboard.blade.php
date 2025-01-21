@extends('frontend.user.main')

@section('ucontent')
    <style>
        .infobox h5 {
            font-size: 18px;
            
            font-weight: 800;
            letter-spacing:1px;
        }

        .infobox h2 {
            font-size: 20px;
            font-weight: 800;
        }
        .infobox{
            background:radial-gradient(circle at right top, #07777073 5%, #07777000 20%), radial-gradient(circle at left bottom, #07777082 5%, #0777700d 20%);
            padding: 11px;
            border: 1px solid #077770;
            border-radius: 10px;
            box-shadow: 2px 4px 0px 0px #077770;
        }
        .servicespan span{
            font-size:14px;
            padding-right:10px;
            padding-bottom:10px;
            position:relative;
            color:orange;
            
        }
          .servicespan span::before{
              content : "|";
              position:absolute;
              top: 0;
              right: 0;
              color: #077770;
              
          }
    </style>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="w-1000 mb-4 text-end">
                    <h4 class="text-primary"> {{ Auth::user()->name }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="w-100">
                    <figure class="w-100">
                        <img src="{{ url('public/upload/' . $expert['profile_image']) }}" alt="" class="img-fluid">
                    </figure>
                    <div class="w-100  text-center">
                        <h4 class="mb-0"> {{ $expert->name }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="w-100">
                    <div class="row">
                       
                        <div class="col-md-4">
                             <div class="w-100 infobox mb-4">
                                <h5>Current Balance</h5>
                                <div class="w-100 expertises_span">
                                    <p>  {{ number_format($points['balance'], 2) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                             <div class="w-100 infobox mb-4">
                                <h5>Total Leads</h5>
                                <div class="w-100 expertises_span">
                                    <p> {{ $expert['leads_count'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                             <div class="w-100 infobox mb-4">
                                <h5>Purchased Leads</h5>
                                <div class="w-100 expertises_span">
                                    <p>{{ $expert['confirmed_leads_count'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="w-100 mb-4">
                                <h5>Services</h5>
                                <div class="w-100 servicespan">
                                    @foreach ($expert['expertize'] as $et)
                                        <span
                                            class="d-inline-block">{{ $et->sub_category }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="w-100 mb-4">
                                <h5>Availability Modes</h5>
                                <div class="w-100 expertises_span">
                                    @foreach (explode(',', $expert['modes']) as $mod)
                                        {{ $mod }} @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                        </div>
                       
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
