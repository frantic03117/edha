@extends('layouts.main')
@section('content')
 <style>
        .plan_box {
               border-radius: 1rem;
            background: #07777345;
            padding: 1.4rem;
            box-shadow: inset -5px -2px 10px #077773;
        }

        .plan_box .plan_header {
            margin-bottom: 2.4rem;
        }

        .plan_box .plan_body {
            margin-bottom: 2.4rem;
        }

        .plan_box .plan_footer ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .plan_box .plan_footer ul li {
            padding: 10px 0;
            font-size: 14px;
            letter-spacing: 1px;

        }

        .plan_box .plan_footer ul li:not(:last-of-type) {
            border-bottom: 1px solid #ccc;
        }

        .plan_title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .plan_sort_desc {
            font-size: 12px;
        }

        .plan_body h2 {
            font-size: 25px;
            margin-bottom: 1.8rem;
            display: inline-block;
            font-weight: 700;
        }

        .popularplan {
            transform: scale(1.1)
        }

        .popularTag {
            font-size: 12px;
            font-weight: 300;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
    <div class="container">
        
        <div class="row">
            <div class="col-md-6">
                <h2>
                    List of Subscription Plan
                </h2>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{route('subscription.create')}}" class="btn btn-primary">Create</a>
            </div>
            @foreach($plans as $item)
            <div class="col-md-4 mb-4">
                <div class="w-100">
                    @include('admin.subscription.plan', ['item' => $item])
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
