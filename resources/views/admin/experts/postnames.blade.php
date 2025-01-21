@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            
            <form action="{{route('postname.store')}}" class="w-100 p-4 mb-4 rounded-4 shadow shdaow-lg border border-primary" method="POST">
                @csrf
                <div class="row mb-4">
                <div class="col-md-12">
                    <div class="w-100 mb-4">
                        <h2>Create New Postname</h2>
                    </div>
                </div>
                <div class="col-md-2">
                     <label for="">Select Category</label>
                     <select class="form-select" name="category_id" >
                         <option value="all">All</option>
                           @foreach($categories as $cat)
                         <option value="{{$cat['id']}}">{{$cat['category']}}</option>
                         @endforeach
                     </select>
                </div>
                <div class="col-md-2">
                    <label for="">Enter Postname</label>
                    <input type="text" class="form-control" name="title" />
                </div>
                <div class="col-md-1">
                    <button class="btn d-block mt-4 btn-primary">Submit</button>
                </div>
            </div>
             </form>
            <div class="row">
                
                <div class="col-md-12 table-responsive">
                    <form method="GET">
                        
                   
                    <div class="w-100 mb-4">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Profile Category</label>
                                <select class="form-control" name="category">
                                    <option value="">All</option>
                                           @foreach($categories as $cat)
                                         <option value="{{$cat['id']}}" @selected($cat['id'] == $catg)>{{$cat['category']}}</option>
                                         @endforeach
                                    
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="">Filter Postname</label>
                                <input type="text" class="form-control" value="{{$key}}" name="postname" />
                            </div>
                            <div class="col-md-4">
                                <div class="mt-4">
                                     <button class="block  btn btn-primary">Search</button>
                                     <a href="{{route('postname.index')}}" class="btn btn-warning ms-2">Reset</a>
                                </div>
                               
                                
                            </div>
                        </div>
                    </div>
                     </form>
                    <table class="table table-responsive text-nowrap table-sm table-bordered  table-rep-plugin " id='example'>
                        <thead class="bg-success text-white">
                            <tr>
                                <th class="bg-success text-white">Sr</th>
                                <th class="bg-success text-white">Profile</th>
                                <th class="bg-success text-white">Post</th>
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
                                        {{$item?->category?->category}}
                                    </td>
                                    <td>
                                        {{$item->post}}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            
                                       
                                        <button data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$item['id']}}" class="btn btn-primary">Edit</button>
                                        <form class="d-inline-block" action="{{route('postname.destroy', $item->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                             </div>
                                        
                                        
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop{{$item['id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title text-white" id="staticBackdropLabel">Edit</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                    <form action="{{route('postname.update', $item->id)}}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                     <div class="form-group">
                                                         <label for="">Select Category</label>
                                                         <select class="form-select" name="category_id" >
                                                             <option value="">---Select--</option>
                                                             @foreach($categories as $cat)
                                                             <option value="{{$cat['id']}}" @if($cat['id'] == $item->category_id) selected @endif >{{$cat['category']}}</option>
                                                             @endforeach
                                                         </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Enter Postname</label>
                                                        <input type="text" value="{{$item->post}}" class="form-control" name="title" />
                                                    </div>
                                                    <div class="mt-5">
                                                        <button class="btn btn-primary">Update</button>
                                                    </div>
                                                    </form>
                                              </div>
                                             
                                            </div>
                                          </div>
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
