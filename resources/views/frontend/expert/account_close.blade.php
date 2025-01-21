@extends('frontend.user.main')
@section('ucontent')
    <section>
       <div class="container">
           <div class="row">
               <div class="col-md-12 mb-4">
                   <div class="w-100 alert alert-warning closingWarning">
                       <p>
                          In case you, as a service provider no longer wish to be there on the website (www.edha.life) due to any reason and you have a recharge balance in your account, then the same shall not be refunded. You can utilize balance credit points and then choose to close your account.
                       </p>
                       <p>
                           You can close your account by yourself, at any time from this page.
                       </p>
                       <p>
                           Once you close your account, then your data cannot be retrieved, post-closure. Edha shall make no efforts to get back your data and share it with you, whatsoever. Please be sure before you close your account.
                       </p>
                       <p>
                           Any questions, please feel free to drop in an email or call Edha office.
                       </p>
                   </div>
               </div>
               <div class="col-md-12 close_account ">
                   <form action="{{route('save_close_account')}}" method="POST">
                       @csrf
                       <div class="row">
                           <div class="col-md-6">
                               <div class="form-group mb-4">
                                  @if(session()->has('errors'))
    <div class="alert alert-danger">
        {{session('errors')}}
    </div>
@endif
                               </div>
                               <div class="form-group mb-4">
                                   <label for="">Enter Password</label>
                                   <input type="password" name="password" required class="form-control border border-success"/>
                               </div>
                               <div class="form-group mb-4">
                                   <label for="">Enter Remark</label>
                                   <textarea  name="remark" required class="form-control border border-success"></textarea>
                               </div>
                               <div class="form-group">
                                   <button class="btn btn-primary">Submit</button>
                               </div>
                           </div>
                       </div>
                   </form>
               </div>
           </div>
       </div>
    </section>


  
@endsection
