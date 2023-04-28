@extends('layouts.home')
@section('title', 'Post')
@section('content')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@show
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="headingIn">Add Post</h4>
            <div class="float-right">
                <a href="{{ route('post.index') }}" class="btn btn-primary"><span class="fa fa-eye"></span> View Post</a>
            </div>
        </div>
        <div class="card-body">
            @php
                $eid = Crypt::encrypt($post->id);
            @endphp
            <form action="{{ route('post.update', $eid) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="category">Name</label>
                        <input type="text" name="name" class="form-control" id="category"
                            placeholder="Category Name" value="{{ old('name', $post->name) }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug"
                            value="{{ old('slug', $post->slug) }}">
                        @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="category">Category Name</label>
                        <select name="category" id="category" class="form-control">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}"
                                    {{ $item->id == $post->category_id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="file">Image</label>
                        <img src="{{ asset($post->image) }}" alt="{{ $post->alt }}" width="100">
                        <input type="file" name="image" class="form-control" id="file">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="alt">Image Alt</label>
                        <input type="text" name="alt" class="form-control" id="alt" placeholder="Alt"
                            value="{{ old('alt', $post->alt) }}">
                        @error('alt')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="yt_iframe">Youtube iframe Link</label>
                        <input type="text" name="yt_iframe" class="form-control" id="yt_iframe"
                            placeholder="Youtube iframe Link" value="{{ old('yt_iframe', $post->yt_iframe) }}">
                        @error('yt_iframe')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <h3>Status</h3>
                    <hr class="hr3">
                    <div class="col-md-12 mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input success" type="radio" name="status"
                                        id="exampleRadios1" value="1" {{ $post->status == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="exampleRadios1">Active</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios2"
                                        value="0" {{ $post->status == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="exampleRadios2">Inactive</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3>Description</h3>
                    <hr class="hr3">
                    <div class="col-md-12 mb-3">
                        <label for="myTextarea">Description</label>
                        <textarea name="description" class="form-control" id="myTextarea" cols="30" rows="10">{{ old('description', $post->description) }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <hr class="hr3">
                    <h3>Meta Details</h3>
                    <hr class="hr-2" />
                    <div class="col-md-6 mb-3">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" id="meta_title"
                            placeholder="Meta Title" value="{{ old('meta_title', $post->meta_title) }}">
                        @error('meta_title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="meta_keyword">Meta Keyword</label>
                        <input type="text" name="meta_keyword" class="form-control" id="meta_keyword"
                            placeholder="Meta Keyword" value="{{ old('meta_keyword', $post->meta_keyword) }}">
                        @error('meta_keyword')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_description">Meta Description</label>
                        <textarea name="meta_description" class="form-control" id="meta_description" cols="5" rows="5"
                            placeholder="Meta Description">{{ old('meta_description', $post->meta_description) }}</textarea>
                        @error('meta_description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-success" type="submit">Submit</button>
                        <a href="{{ URL::previous() }}"><button class="btn btn-warning">Previous</button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-5">
        <div class="card-header bg-info text-white">
            <h4 class="">Add Faqs</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.postfaqs') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="postId" value="{{ $post->id }}">
                @csrf
                <div id="dynamic_field"></div>
                <div class="mt-3">
                    <button type="button" name="add" id="add" class="btn btn-primary">Add Faq</button>
                    <button class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
  </script>
@endsection
