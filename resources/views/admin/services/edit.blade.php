@extends('layouts.main')
@section('content')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <section>
        <div class="container">
            <div class='row'>
                <div class="col-md-12 mb-3">
                    <div class="w-100 text-end">
                        <a class='btn btn-primary btn-sm rounded-0' href="{{ route('services.index') }}">View All</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <form action="{{ route('services.update', $service['id']) }}" enctype="multipart/form-data" method="post"
                    class="col-md-12 p-2 shadow-primary">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Category</label>
                            <select onchange="getsubcategories(event)" class="form-select" name="category_id">
                                <option value="">---Select---</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat['id'] }}" @selected($cat['id'] == $service['category_id'])>{{ $cat['category'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Sub Category</label>
                            <select name="sub_category_id" class="form-select" id="sub_categories" >
                                <option value="">---Select---</option>
                                @foreach ($sub_categories as $item)
                                    <option value="{{$item->id}}" {{$item->id == $service['sub_category_id'] ? 'selected' : ''}}>{{$item->sub_category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <script>
                            const getsubcategories = (e) => {
                                const value = e.target.value;
                                const resp = $.get("{{route('get_sub_category')}}", {id : value}, function(res){
                                    $("#sub_categories").html(res);
                                });
                            };
                        </script>
                        <div class="col-md-4">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="">
                                    Upload Image
                                </label>
                                <input type="file" name="image" class="form-control">
                                <img src="{{ url('public/assets/img/' . $service['image']) }}" class="img-fluid" />
                                <input type="hidden" name="hfile" value="{{ $service['image'] }}" />
                            </div>
                        </div>
                        <div class="col-md-4 d-none">
                            <div class="form-group mb-3">
                                <label for="">
                                    Enter Service Title
                                </label>
                                <input type="text" value="{{ $service['title'] }}" name="title" id="title"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="">
                                Enter Service Meta Title
                            </label>
                            <input type="text" value="{{ $service['meta_title'] }}" name="meta_title" id="meta_title"
                                class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">
                                Enter Service Meta Description
                            </label>
                            <input type="text" value="{{ $service['meta_description'] }}" name="meta_description"
                                id="meta_description" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="">
                                Description
                            </label>
                            <textarea name="description" id="description" cols="30" rows="10">{!! $service['description'] !!}</textarea>
                            <script>
                                CKEDITOR.replace('description');
                            </script>
                        </div>
                        <div class="col-md-12">
                            <label for="">
                                Key Points
                            </label>
                            <textarea name="key_points" id="keypoints" cols="30" rows="10">{!! $service['key_points'] !!}</textarea>
                            <script>
                                CKEDITOR.replace('keypoints');
                            </script>
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
