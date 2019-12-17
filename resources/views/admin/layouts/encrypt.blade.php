@extends('layouts.app')
@section('content')
    <hr>
    <div class="container">
        <div class="site section">
        <div class="col-md-10">
            <div class="alert alert-success">
                @if(Session::has('message'))
                    {{Session::get('message')}}
                @endif
            </div>
            <form action="{{route('/save/hash')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group-row col-md-4">
                   <div class=""> <input type="text" name="string" class="form-control" placeholder="String to Encrypt"></div>&nbsp
                    <button class="btn btn-success input-group">Hash</button><hr>
                </div>
                <div class="form-group-row col-md-4">
                    <div class="form-group-row">
                        <div class=""><input type="text" value="12" class="form-control" placeholder="Round"></div><br>
                    </div>
                </div>
            </form>

        </div>
        <hr>
        <div class="col-md-7">
            <form action="{{route('/check')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group-row col-md-6">
                    <div class="form-group-row">
                        <div class=""><input type="text" name="check" class="form-control" placeholder="Decrypt"></div><br>
                        <button class="btn btn-success input-group-inline">Check</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection