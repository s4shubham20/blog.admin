@extends('layouts.home')
@section('title' ,'Edit Page')
@section('css')
    <style>
        .card-header h4{
            display: inline;
        }
    </style>
@endsection
@section('content')
<div class="container-fluid px-5">
    <div class="card mt-3">
        <div class="card-header">
            <h4>Edit Page</h4>
            <div class="float-right">
                <a href="{{ route('page.index') }}"><button class="btn btn-primary">
                    <span class="fa fa-eye"></span> View Page</button></a>
            </div>
        </div>
        @php
            $eid = Crypt::encryptString($page->id);
        @endphp
        <div class="card-body">
            <form action="{{ route('page.update', $eid) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Name*</label>
                        <input type="text" name="name" id="name" placeholder="Page Name"
                            class="form-control @if ($errors->has('name')) is-invalid @endif"
                            value="{{ old('name', $page->name) }}">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">Required field*</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug">Slug*</label>
                        <input type="text" name="slug" id="slug" placeholder="Page Slug"
                            class="form-control @if ($errors->has('slug')) is-invalid @endif"
                            value="{{ old('slug', $page->slug) }}">
                        @if ($errors->has('slug'))
                            <div class="invalid-feedback">Required field*</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="image">Image*</label>
                        <img src="{{ asset($page->image) }}" alt="{{ $page->alt }}" width="100">
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
                            value="{{ old('alt', $page->alt) }}" placeholder="Image Alt">
                        @if ($errors->has('alt'))
                            <div class="invalid-feedback">Required field*</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1"
                            {{ old('status', $page->status) == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="exampleRadios1">Active</label>
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="0"
                            {{ old('status', $page->status) == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="exampleRadios2">Inactive</label>
                        @if ($errors->has('status'))
                            <div class="invalid-feedback">Required field*</div>
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control  @if ($errors->has('description')) is-invalid @endif"
                            cols="10" rows="5" placeholder="Description">{{ old('description', $page->description) }}</textarea>
                        @if ($errors->has('description'))
                            <div class="invalid-feedback">Required field*</div>
                        @endif
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="metatitle">Meta Title</label>
                        <input name="metatitle" id="metatitle"
                            class="form-control  @if ($errors->has('metatitle')) is-invalid @endif"
                            placeholder="Meta Title" value="{{ old('metatitle', $page->metatitle) }}">
                        @if ($errors->has('metatitle'))
                            <div class="invalid-feedback">Required field*</div>
                        @endif
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="metakeyword">Meta Keyword</label>
                        <input name="metakeyword" id="metakeyword"
                            class="form-control  @if ($errors->has('metakeyword')) is-invalid @endif"
                            placeholder="Meta Keyword" value="{{ old('metakeyword', $page->metakeyword) }}">
                        @if ($errors->has('metakeyword'))
                            <div class="invalid-feedback">Required field*</div>
                        @endif
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="metadescription">Meta Description</label>
                        <textarea name="metadescription" id="metadescription"
                            class="form-control  @if ($errors->has('metadescription')) is-invalid @endif" cols="10" rows="5"
                            placeholder="Meta Description">{{ old('metadescription', $page->metadescription) }}</textarea>
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
