@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <form action="{{ route('subcategory.store') }}" method="post" class="col-md-12 p-2 shadow-primary">
                    <div class="row">
                        <div clas="col-md-12 mb-5">
                            <h2>Create New Subcategory</h2>
                        </div>
                        <div class="col-md-4">
                        

                            @csrf
                            <div class="form-group mb-3">
                                <label for="">
                                    Select Category
                                </label>
                                <select name="category_id" id="" class="form-select">
                                    <option value="" selected disabled>---Select---</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['category'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="">
                                    Enter Sub Category
                                </label>
                                <input type="text" value="{{ old('sub_category') }}" name="sub_category"
                                    id="sub_category" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="" class="form-label d-block">
                                    &nbsp;
                                </label>
                                <input type="submit" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-md-12 mt-4">
                        <div class="w-100 mb-5">
                            <h4>Filter</h4>
                        <form method="GET">
                            
                       
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Category</label>
                                <select name="category_id"  class="form-select">
                                    <option value="" >---All---</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item['id'] }}" @selected($catg == $item['id'])>{{ $item['category'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="">SubCategory</label>
                                <input type="text" class="form-control" value="{{$key}}" name="subcategory" />
                                
                            </div>
                            <div class="col-md-4">
                                 <label for="" class="d-block w-full ">Action</label>
                                 <button class="btn btn-sm btn-primary">Search</button>
                                 <a href="{{route('subcategory.index')}}" class="btn btn-sm btn-warning">Reset</a>
                            </div>
                        </div>
                         </form>
                    </div>
                    <div class="row">
                        
                    
                    <div class="col-md-6 table-responsive">
                        <table class="table  bg-white shadow table-sm table-bordered">
                            <thead>
                               
                                <tr>
                                    <th>
                                        Sr No.
                                    </th>
                                  
                                    <th>
                                        Subcategory
                                    </th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                           <tbody>
    @php
        
        $citems = $items->filter(function($row) {
            return $row['category_id'] == "1";
        });
    @endphp

    @foreach ($items as $item)
        <tr>
            <td>
                {{ $loop->iteration }}
            </td>
            <td>
                {{$item['category']}}
            </td>
            <td>
                {{ $item['sub_category'] }}
            </td>
            <td>
                <div class="d-flex gap-1">
                    
               
                <form action="{{route('subcategory.destroy', $item->id)}}" onSubmit="handleSubmit(event)" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
                <a href="{{route('subcategory.edit', $item->id)}}" class="btn btn-sm btn-info ms-1">Edit</a>
             </div>
            </td>
        </tr>
    @endforeach
    <script>
        const handleSubmit =(e) => {
            e.preventDefault();
            if(confirm('Are you sure ?')){
                e.target.submit();
            }
        }
    </script>
</tbody>

                        </table>
                    </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
