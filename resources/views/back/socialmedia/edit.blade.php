@extends('layouts.home')
@section('title', "Social Media")
@section('content')
@section('')
<style>
    .card-header h4{
        display: inline;
    }
    .card-header .btn{
        float: right;
    }
</style>
@show
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>Edit Social Media</h4>
                <a href="{{ route('social.index') }}" class="btn btn-primary"><span class="fa fa-eye"></span> View Soical Media</a>
            </div>
            @php
                $eid = Crypt::encrypt($social->id);
            @endphp
            <div class="card-body">
                <form action="{{ route('social.update', $eid) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control  @if ($errors->has('name')) is-invalid @endif" placeholder="Name" value="{{ old('name', $social->name) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="url">Link</label>
                            <input type="url" name="url" id="url" class="form-control @if($errors->has('url')) is-invalid @endif" placeholder="Link" value="{{ old('url', $social->url) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="icon">Icon</label>
                            <input type="text" name="icon" id="icon" class="form-control @if($errors->has('icon')) is-invalid @endif" placeholder="Icon" value="{{ old('icon', $social->icon) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="color">Icon Color</label>
                            <input type="color" name="color" id="color" class="form-control @if($errors->has('color')) is-invalid @endif" value="{{ old('color', $social->color) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1"
                            {{ old('status', $social->status) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleRadios1">Active</label>
                            <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="0"
                                {{ old('status', $social->status) == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleRadios2">Inactive</label>
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
