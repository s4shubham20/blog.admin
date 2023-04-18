@extends('layouts.app')
@section('metatitle', "$category->meta_title")
@section('metakeyword', "$category->meta_keyword")
@section('description', "$category->meta_description")
@section('css')
    <style>
        .category-heading{
            padding: 10px 12px;
            border-left: 6px solid #000;
            background-color: #ddd
        }
        .post-heading{
            font-size: 26px;
            color: #000;
        }
    </style>
@show
@section('content')
<div class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="category-heading">
                    <h4>{{ $category->name }}</h4>
                </div>
                @forelse ($post as $item)
                <div class="card card-shadow mt-4">
                    <div class="card-body">
                        <a href="{{ url('post/'.$category->slug.'/'.$item->slug) }}" class="text-decoration-none">
                            <h2 class="post-heading">{{ $item->name }}</h2>
                        </a>
                        <h6>
                            Posted on : {{ $item->created_at }}
                            <span class="ms-3">Post By : {{ $item->user->name }}</span>
                        </h6>
                    </div>
                </div>
                @empty
                <div class="card card-shadow mt-4">
                    <div class="card-body">
                        <h1>Not Post Available</h1>
                    </div>
                </div>
                @endforelse
                <div class="paginate mt-4">
                    {{ $post->links() }}
                </div>
            </div>
            <div class="col-md-3">
                <div class="border p-2">
                    <h4>Advertising Area</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
