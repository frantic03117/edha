@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-end">
                <a href="{{route('subscription.index')}}" class="btn btn-primary">Back</a>
            </div>
            <div class="col-md-12">
                <form action="{{route('subscription.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                Create New Subscription Plan
                            </h2>
                        </div>
                        <div class="col-md-3">
                            <div class="w-100">
                                <label for=''>Enter Title</label>
                                <input type="text" name="title" id=""
                                    class="form-control border border-success">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="w-100">
                                <label for=''>Short Description</label>
                                <input type="text" name="sub_title" id=""
                                    class="form-control border border-success">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="">Enter Amount</label>
                            <input type="number" name="amount" id="" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">Enter Points</label>
                            <input type="number" name="points" id="" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">Enter Convenience Fee</label>
                            <input type="number" name="convenience_fee" id="" class="form-control">
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="">
                                Enter Description
                            </label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                            <script>
                                CKEDITOR.replace('description');
                            </script>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary">Create New Plan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="w-100">

                </div>
            </div>
        </div>
    </div>
@endsection
