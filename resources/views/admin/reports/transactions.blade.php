@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <form action="" method="GET">
            
      
        <div class="row mb-5">
            <div class="col-md-2">
                <label for="">Transaction Date</label>
                <input type="date" value="{{$fdate}}" class="form-control" name="fdate" />
            </div>
            <div class="col-md-3">
                <label for="">Expert</label>
                <input type="text" value="{{$expert}}" class="form-control" name="expert" />
            </div>
            <div class="col-md-2">
                <label for="">Type</label>
              <select class="form-control" name="type">
                  <option value="">All</option>
                  <option value="Credit">Credit</option>
                  <option value="Debit">Debit</option>
              </select>
            </div>
            <div class="col-md-2">
                <label for="">Status</label>
              <select class="form-control" name="status">
                  <option value="">All</option>
                  <option value="Success">Success</option>
                  <option value="Pending">Pending</option>
              </select>
            </div>
            <div class="col-md-2">
                <label for="">Amount</label>
                <input type="text" class="form-control" value="{{$amount}}" name="amount" />
            </div>
            <div class="col-md-12">
                <label for="" class="w-100 inline-block">&nbsp;</label>
                <button class="btn d-inline-block btn-primary">Search</button>
                <a href="{{route('transactions')}}" class="btn btn-sm btn-warning">Reset</a>
                <a href="{{route('transactions')}}?export=excel" class="btn btn-sm btn-info">Excel</a>
            </div>
        </div>
          </form>
       <div class="row">
           
           <div class="col-md-12">
               <div class="w-100 table-responsive">
                   <table class="table table-sm table-bordered">
                       <thead>
                           <tr>
                               <th>Sr No</th>
                               <th>Date</th>
                               <th>Expert</th>
                               <th>Credit Amount</th>
                               
                               <th>Credit Point</th>
                               <th>Debit Point</th>
                               <th>Status</th>
                               <th>Created At</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach($items as $item)
                            @if($item->amount || ($item->is_confirm))
                            <tr>
                                <td>{{$loop->iteration}}</td>
                               <td>  {{ date('d-M-Y', strtotime($item['created_at']))}}</td>
                                <td>
                                    @if($item->expert)
                                    <div class="d-flex gap-1">
                                        <div style="width:40px;height:40px;border-radius:50%;overflow:hidden;">
                                            <img src="{{url('public/upload/'.$item->expert?->profile_image)}}" class="w-100 h-100 " />
                                            
                                        </div>
                                        <div class="w-100">
                                            <p class="mb-0">
                                                {{$item->expert?->name}}
                                            </p>
                                            <p class="mb-0">
                                                {{$item->expert?->email}}
                                            </p>
                                        </div>
                                    </div>
                                    @else
                                    
                                    <p>
                                        Terminated
                                    </p>
                                    @endif
                                </td>
                                <td>
                                    {{$item->amount}}
                                </td>
                                <td>
                                    @if($item->type == "Credit")
                                        {{$item['points']}}
                                    @endif
                                </td>
                                <td>
                                    @if($item->type == "Debit")
                                        {{$item['points']}}
                                    @endif
                                </td>
                                <td>
                                    @if($item->is_confirm == "1")
                                        <span class="badge bg-primary">Success</span>
                                    @endif
                                    @if($item->is_confirm == "0")
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                
                               
                                <td>{{ date('d-M-Y', strtotime($item['created_at']))}}</td>
                            </tr>
                            @endif
                           @endforeach
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
    </div>
@endsection
