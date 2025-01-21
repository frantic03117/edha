@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-end">
                    <a class="btn btn-primary" href="{{route('subcategory.index')}}">Back</a>
                </div>
                <form action="{{ route('subcategory.update', $items['id']) }}" method="post" class="col-md-12 p-2 shadow-primary">
                    <div class="row">
                        
                        <div clas="col-md-12 mb-5">
                            <h2>Create New Subcategory</h2>
                        </div>
                        <div class="col-md-4">
                        

                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="">
                                    Select Category
                                </label>
                                <select name="category_id" id="" class="form-select">
                                    <option value="" selected disabled>---Select---</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item['id'] }}" @selected($item['id'] == $items['category_id']) >{{ $item['category'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="">
                                    Enter Sub Category
                                </label>
                                <input type="text" value="{{ $items['sub_category'] }}" name="sub_category"
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
               
            </div>
        </div>
    </section>
@endsection