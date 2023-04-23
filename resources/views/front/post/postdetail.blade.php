@extends('layouts.app')
@section('css')
    <style>
        a.active-color{
            color: #7c437c;
        }
    </style>
@endsection
@section('content')
<div class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="category-heading">
                    <h4 class="mb-0">{!! $post->name !!}</h4>
                </div>
                <div class="mt-3">
                    <h6>{{ $post->category->name.'/'.$post->name }}</h6>
                </div>
                <div class="card card-shadow mt-4">
                    <div class="card-body">
                        {!! $post->description !!}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="border p-2">
                    <h4>Advertisign Area</h4>
                </div>
                @if (count($recentpost) > 0)

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Latest Post</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($recentpost as $item)
                        <a href="{{ url('post/'.$item->category->slug.'/'.$item->slug) }}" class="text-decoration-none {{ Request::is('post/'.$item->category->slug.'/'.$item->slug) ? "active-color":"" }}">
                            <h6>{{ $item->name }}</h6>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
