@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="text-end">
                        <a data-bs-toggle="tooltip" title="Download Excel" class="btn btn-sm btn-success" href="{{route('expert.export')}}">
                            <i class="fi fi-rs-file-excel"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 table-responsive">
                
                    <table class="table table-sm table-bordered text-nowrap  table-rep-plugin " id="example">
                        <thead class="bg-success text-white">
                            <tr>
                                <th class="bg-success text-white">Sr</th>
                                <th class="bg-success text-white">Profile</th>
                                <th class="bg-success text-white">Expert</th>
             
                            
                                <th class="bg-success text-white">Category</th>
                                <th class="bg-success text-white">Leads</th>
                                <th class="bg-success text-white">Points</th>
                                <th class="bg-success text-white">Recharge</th>
                                <th class="bg-success text-white">Join Date</th>
                                <th class="bg-success text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <img src="{{ url('public/upload/' . $item['profile_image']) }}" width="50"
                                            alt="" class="img-fluid">
                                    </td>
                                  
                                    <td>
                                        <ul class="mb-0 list-unstyled">
                                            <li>
                                                <b>Name : </b> {{ $item['name'] }}
                                            </li>
                                            <li>
                                                <b>Email : </b> {{ $item['email'] }}
                                            </li>
                                            <li>
                                                <b>Mobile : </b> {{ $item['mobile'] }}
                                            </li>
                                            <li>
                                                <p class="text-wrap">
                                                    <b>Language : </b>   {{ $item['languages'] }}
                                                </p>
                                                
                                            </li>
                                            <li>
                                                Address :  {{ $item['city']['city'] . ' ' . $item['state']['state'].' '.$item['pincode'] }}
                                            </li>
                                            <li>
                                                <div class="d-flex gap-1 align-items-center">
                                                     <a href="{{route('expert_edit.admin', ['expert_id' => base64_encode($item->id)])}}" class="btn btn-sm btn-warning">Edit Details</a>
                                                     <!--<a href="{{route('calendar.admin', ['expert_id' =>  base64_encode($item->id)])}}" class="btn btn-sm btn-info">View Slots</a>-->
                                                     <form action="{{route('add_points')}}" method="POST">
                                                         @csrf
                                                         <input type="hidden" name="expert_id" value="{{$item->id}}" /> 
                                                         <div class="input-group">
                                                             <input type="number" class="form-control" name="points" placeholder="Enter Points" />
                                                             <button class="btn btn-primary">Add Points</button>
                                                         </div>
                                                     </form>
                                                </div>
                                               
                                            </li>
                                        </ul>
                                        
                                    </td>
                                   
                                   
                                   
                                  
                                   
                                    <td>
                                        <ul>


                                        @foreach ($item['categories'] as $j => $ep)
                                        @if($j < 4)
                                        <li>
                                            {{$ep['category']}}
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                    </td>
                                   
                                    <td>
                                        <ul>
                                            <li>Purchased : {{$item['confirm_leads_count']}}</li>
                                            <li>Assigned Not Purchased : {{$item['unconfirm_leads_count']}}</li>
                                        </ul>
                                    </td>
                                   <td>
                                       <ul>
                                           <li>
                                                 Total Credit : {{$item->balance['total_credit']}}
                                           </li>
                                           <li>
                                                Total Debit : {{$item->balance['total_debit']}}
                                           </li>
                                           <li>
                                                Current Balance :  {{$item->balance['balance']}}
                                           </li>
                                       </ul>
                                   </td>
                                   <td>
                                       {{$item->recharges_sum_amount}}
                                   </td>
                                    <td>
                                        {{date('d-M-Y', strtotime($item['created_at']))}}
                                    </td>
                                    <td>
                                        {!!Form::open(['route' => 'close_account_expert', 'method' => 'DELETE', 'id' => 'form'.$item['id']])!!}
                                            <input type="hidden" name="id" value="{{$item['id']}}" >
                                            <a href="#" onclick="submitForm('{{$item['id']}}')" class="btn btn-sm btn-danger">Close Account</a>
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!!$items->links()!!}
                </div>
            </div>
        </div>
    </section>
    <script>
        const submitForm = (id) => {
            if(confirm("Are you Sure ?")){
                $("#form"+id).submit();
            }
        }
    </script>
@endsection
