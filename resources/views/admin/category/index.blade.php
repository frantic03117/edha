@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
               <div class="col-md-12">
                <table class="table table-sm table-bordered table-hover table-rep-plugin">
                    <thead>
                        <tr>
                            <th>Sr</th>
                            <th>Category</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$item['category']}}
                            </td>
                            <td>
                                <form action="{{route('category.update', $item['id'])}}" method="POST">
                                    
                                    @method('PUT')
                                    @csrf
                                  
                                
                                <div class="input-group flex-nowrap"  style="width:160px;" >
                                     <input name="points" style="width:100px;" value="{{$item['lead_price']['points']}}" type="number" class="form-control border border-success"  />
                                     <button class="btn btn-primary">Update</button>
                                </div>
                                
                                </form>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
               </div>
            </div>
        </div>
    </section>
@endsection
