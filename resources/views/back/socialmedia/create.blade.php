@extends('layouts.home')
@section('title', "Social Media")
@section('content')
@section('')
<style>
    .card-header h4{
        display: inline;
    }
    .card-header .btn{
        float:right;
    }
</style>
@show
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>Add Social Media</h4>
                <a href="{{ route('social.index') }}" class="btn btn-primary"><span class="fa fa-eye"></span> View Soical Media</a>
            </div>
            @foreach ( $errors as $error)
                {{ $error }}
            @endforeach
            <div class="card-body">
                <form action="{{ route('social.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control  @if ($errors->has('name')) is-invalid @endif" placeholder="Name" value="{{ old('name') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="url">Link</label>
                            <input type="url" name="url" id="url" class="form-control @if($errors->has('url')) is-invalid @endif" placeholder="Link" value="{{ old('url') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="icon">Icon</label>
                            <input type="text" name="icon" id="icon" class="form-control @if($errors->has('icon')) is-invalid @endif" placeholder="Icon" value="{{ old('icon') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="color">Icon Color</label>
                            <input type="color" name="color" id="color" class="form-control @if($errors->has('color')) is-invalid @endif" value="{{ old('color') }}">
                        </div>
                        <div>
                            <button class="btn btn-success">Submit</button>
                            <a href="{{ url()->previous() }}" class="btn btn-warning">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
