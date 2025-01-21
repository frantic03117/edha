@extends('layouts.main')
@section('content')
    <div class="container-fluid">
       <div class="row">
           <div class="col-md-12 mb-4">
               <div class="text-end">
                   <a class="btn btn-success btn-sm" href="{{url('admin/get_excel_client')}}">
                       <i class="fi fi-rs-file-excel"></i>
                   </a>
               </div>
           </div>
           <div class="col-md-12">
               <div class="w-100 table-responsive">
                   <table class="table table-sm table-bordered">
                       <thead>
                           <tr>
                               <th>Sr No</th>
                               <th>Name</th>
                               <th>Mobile</th>
                               <th>Email</th>
                              
                               <th>State</th>
                               <th>City</th>
                               <th>Pincode</th>
                               <th>Created At</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach($items as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item['name']}}</td>
                                <td>{{$item['mobile']}}</td>
                                <td>{{$item['email']}}</td>
                                <td>{{$item['search_data']?->state_name?->state}}</td>
                                <td>{{$item['search_data']?->city_name?->city}}</td>
                               
                                
                                <td>{{$item['search_data']?->pincode}}</td>
                                <td>{{ date('d-M-Y', strtotime($item['created_at']))}}</td>
                            </tr>
                           @endforeach
                       </tbody>
                   </table>
                   {!!$items->links()!!}
               </div>
           </div>
       </div>
    </div>
@endsection
