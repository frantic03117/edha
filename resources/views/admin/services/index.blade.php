@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="w-100 text-end">
                        <a href="{{ route('services.create') }}" class="btn btn-success">
                            Add New Service
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-sm table-bordered table-hover table-rep-plugin">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Thumbnail</th>
                                <th>Category</th>
                                <th>Title</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $item->category?->category }}
                                    </td>
                                    <td>
                                        <img class="img-fluid" src="{{ url('public/assets/img/' . $item['image']) }}"
                                            width="200" />
                                    </td>
                                    <td>
                                        {{ $item['title'] }}
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <form id="deleteForm" action="{{ route('services.destroy', $item['id']) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this service?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                            <a href="{{ route('services.edit', $item['id']) }}"
                                                class="btn btn-primary btn-sm">
                                                Edit
                                            </a>
                                        </div>
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
