@extends('layouts.home')
@section('title', 'Add Page')
@section('css')
    <style>
        .card-header h4 {
            display: inline;
        }
    </style>
@endsection
@section('content')
<div class="container-fluid px-5">
    <div class="card mt-3">
        <div class="card-header">
            <h4>Add Page</h4>
            <div class="float-right">
                <a href="{{ route('page.index') }}"><button class="btn btn-primary"><span class="fa fa-eye"></span> View
                        Page</button></a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('page.store') }}" method="post" enctype="multipart/form-data">
                <div class="row">
                    {{ csrf_field() }}
                    <div class="col-md-6 mb-3">
                        <label for="name">Name*</label>
                        <input type="text" name="name" id="name" placeholder="Page Name"
                            class="form-control @if ($errors->has('name')) is-invalid @endif"
                            value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">Required field*</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug">Slug*</label>
                        <input type="text" name="slug" id="slug" placeholder="Page Slug"
                            class="form-control @if ($errors->has('slug')) is-invalid @endif"
                            value="{{ old('slug') }}">
                        @if ($errors->has('slug'))
                            <div class="invalid-feedback">Required field*</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="image">Image*</label>
                        <input type="file" name="image" id="image"
                            class="form-control @if ($errors->has('image')) is-invalid @endif"
                            value="{{ old('image') }}">
                        @if ($errors->has('image'))
                            <div class="invalid-feedback">Required field*</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="alt">Alt*</label>
                        <input type="text" name="alt" id="alt"
                            class="form-control @if ($errors->has('alt')) is-invalid @endif"
                            value="{{ old('alt') }}" placeholder="Image Alt">
                        @if ($errors->has('alt'))
                            <div class="invalid-feedback">Required field*</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1"
                            {{ old('status') == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="exampleRadios1">Active</label>
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="0"
                            {{ old('status') == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="exampleRadios2">Inactive</label>
                        @if ($errors->has('status'))
                            <div class="invalid-feedback">Required field*</div>
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control  @if ($errors->has('description')) is-invalid @endif"
                            cols="10" rows="5" placeholder="Description">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <div class="invalid-feedback">Required field*</div>
                        @endif
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="metatitle">Meta Title</label>
                        <input name="metatitle" id="metatitle"
                            class="form-control  @if ($errors->has('metatitle')) is-invalid @endif"
                            placeholder="Meta Title" value="{{ old('metatitle') }}">
                        @if ($errors->has('metatitle'))
                            <div class="invalid-feedback">Required field*</div>
                        @endif
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="metakeyword">Meta Keyword</label>
                        <input name="metakeyword" id="metakeyword"
                            class="form-control  @if ($errors->has('metakeyword')) is-invalid @endif"
                            placeholder="Meta Keyword" value="{{ old('metakeyword') }}">
                        @if ($errors->has('metakeyword'))
                            <div class="invalid-feedback">Required field*</div>
                        @endif
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="metadescription">Meta Description</label>
                        <textarea name="metadescription" id="metadescription"
                            class="form-control  @if ($errors->has('metadescription')) is-invalid @endif" cols="10" rows="5"
                            placeholder="Meta Description">{{ old('metadescription') }}</textarea>
                        @if ($errors->has('metadescription'))
                            <div class="invalid-feedback">Required field*</div>
                        @endif
                    </div>
                    <div>
                        <button class="btn btn-success" type="submit">Submit</button>
                        <a href="{{ URL::previous() }}" class="btn btn-warning">Back</a>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection
