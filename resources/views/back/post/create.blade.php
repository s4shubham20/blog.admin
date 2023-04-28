@extends('layouts.home')
@section('title', 'Post')
@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="headingIn">Add Post</h4>
            <div class="float-right">
                <a href="{{ route('post.index') }}" class="btn btn-primary"><span class="fa fa-eye"></span> View Post</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" value="{{ old('slug') }}">
                        @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="category">Category Name</label>
                        <select name="category" id="category" class="form-control">
                            @foreach ($category as $item)
                            <option value="{{ $item->id }}" {{ old('category') == $item->id ?'selected':'' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="file">Image</label>
                        <input type="file" name="image" class="form-control" id="file">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="alt">Image Alt</label>
                        <input text="text" name="alt" class="form-control" id="file" placeholder="Alt" value="{{ old('alt') }}">
                        @error('alt')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="yt_iframe">Youtube iframe Link</label>
                        <input type="text" name="yt_iframe" class="form-control" id="yt_iframe" placeholder="Youtube iframe Link" value="{{ old('yt_iframe') }}">
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
                                        id="exampleRadios1" value="1">
                                    <label class="form-check-label" for="exampleRadios1">Active</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status"
                                        id="exampleRadios2" value="0" checked>
                                    <label class="form-check-label" for="exampleRadios2">Inactive</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3>Description</h3>
                    <hr class="hr3">
                    <div class="col-md-12 mb-3">
                        <label for="editor">Description</label>
                        <textarea name="description" class="form-control" id="editor" cols="30" rows="10">{{ old('description') }}</textarea>
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
                            placeholder="Meta Title" value="{{ old('meta_title') }}">
                        @error('meta_title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="meta_keyword">Meta Keyword</label>
                        <input type="text" name="meta_keyword" class="form-control" id="meta_keyword"
                            placeholder="Meta Keyword" value="{{ old('meta_keyword') }}">
                        @error('meta_keyword')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_description">Meta Description</label>
                        <textarea name="meta_description" class="form-control" id="meta_description" cols="5" rows="5"
                            placeholder="Meta Description">{{ old('meta_description') }}</textarea>
                        @error('meta_description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <button class="btn btn-success" type="submit">Submit</button>
                        <a href="{{ URL::previous() }}"><button class="btn btn-warning">Previous</button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.ckeditor.com/4.4.5.1/full-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>
@endsection
