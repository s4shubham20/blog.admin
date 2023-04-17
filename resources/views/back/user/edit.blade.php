@extends('layouts.home')
@section('title', 'User Edit')
@section('css')
    <style>
        .cardheading h4{
            display: inline;
        }
        .cardheading .btn{
            display: inline;
            float: right;
        }
    </style>
@show
@section('content')
<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header cardheading">
            <h4>Edit User</h4>
            <a href="{{ route('user.index') }}"><button class="btn btn-info"><span class="fa fa-edit"></span> Users</button></a>
        </div>
        <div class="card-body">
            @php
                $eid = Crypt::encrypt($user->id);
            @endphp
            <form action="{{ route('user.update', $eid) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Name*</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', $user->name) }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Email*</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', $user->email) }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name">Password*</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><input type="checkbox" onclick="myFunction()"></span>
                            <input type="password" name="password" id="myInput" class="form-control" placeholder="Password">
                        </div>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <button class="btn btn-success">Submit</button>
                        <a href="{{ URL::previous() }}" class="btn btn-warning">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
            }
    </script>
@endsection
