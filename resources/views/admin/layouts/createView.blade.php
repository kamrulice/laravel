@extends('layouts.app')
@section('content')
    <hr>
    <div class="container">
        <div class="site section">
       <div class="col-md-8">
           <form action="{{route('/save/view')}}" method="post" enctype="multipart/form-data">
               {{ csrf_field() }}
               <div class="form-group">
                    <label>Group Name</label>
                   <input type="text" name="groupName" class="form-control">
               </div>
               <div class="form-group">
                   <label>Group type</label>
                   <input type="text" name="groupType" class="form-control">
               </div>
               <div class="form-group">
                   <label>Account Name</label>
                   <input type="text" name="account" class="form-control">
               </div>
               <div class="form-group">
                   <label>Post Text</label>
                   <input type="text" name="post" class="form-control">
               </div>
               <div class="form-group">
                   <label></label>
                 <button class="btn btn-success btn-block" type="submit">SUBMIT</button>
               </div>
           </form>
       </div>
    </div>
    </div>
@endsection