@extends('layouts.main')
@section('content')
    <style>
        .depit .col-md-2 .w-100 {
            /*background-color: #55efc4;*/
            /*background-image : linear-gradient(315deg, #55efc4 0%, #000000 74%);*/
            padding: 10px;
            color: #000;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px #ccc;
            height: 100%;
            text-align: center;
        }
    </style>
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:%20void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-md-12">
                <table class="table table-sm table-bordered table-success">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Experts</th>
                            <th>Points Used</th>
                            <th>Recharge Amount</th>
                        </tr>
                    </thead>
                    @foreach($categories as $cats)
                        <tr>
                            <td>
                                {{$cats['category']}}
                            </td>
                            <td>
                                {{$cats['experts']}}
                            </td>
                             <td>
                                {{$cats['points']}}
                            </td>
                             <td>
                                {{$cats['amount']}}
                            </td>
                           
                           
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>



    </div>
@endsection
