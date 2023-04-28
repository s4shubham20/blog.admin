@extends('layouts.app')
@section('content')
<div class="bg-danger py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    @foreach ($category as $item)
                    <div class="item">
                        <a href="{{ url('category/'.$item->slug) }}" class="text-decoration-none">
                            <div class="card">
                                <img src="{{ asset($item->image) }}" alt="{{ $item->alt }}">
                                <div class="card-body text-center">
                                    <h5 class="text-dark">{{ $item->name }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="py-5 bg-light">
    <div class="container">
        <div class="border p-3 text-center">
            <h3>Advertisement here</h3>
        </div>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Fundamental Of Web</h4>
                <div class="underline"></div>
                <p class="text-justify">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nostrum consectetur blanditiis soluta exercitationem fuga asperiores numquam nesciunt aperiam sapiente libero. Odit dolores minus suscipit aperiam rem voluptatibus eius alias nulla.Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nostrum consectetur blanditiis soluta exercitationem fuga asperiores numquam nesciunt aperiam sapiente libero. Odit dolores minus suscipit aperiam rem voluptatibus eius alias nulla.</p>
            </div>
        </div>
    </div>
</div>
<div class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>All Category</h4>
                <div class="underline"></div>
            </div>
            @foreach ($category as $item)
                <div class="col-md-3">
                    <div class="card card-body mb-2">
                        <a href="{{ url('category/'.$item->slug) }}" class="text-decoration-none">
                            <h5 class="text-dark mb-0">{{ $item->name }}</h5>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="py-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Latest Post</h4>
                <div class="underline"></div>
            </div>
            <div class="col-md-8">
                @foreach ($latestpost as $item)
                <div class="card card-body mb-2 bg-light shadow">
                    <a href="{{ url('post/'.$item->category->slug.'/'.$item->slug) }}" class="text-decoration-none">
                        <h5 class="text-dark mb-0">{{ $item->name }}</h5>
                    </a>
                    <h6 class="mt-2">Posted On: {{ $item->created_at }}</h6>
                </div>
                @endforeach
                </div>
            <div class="col-md-4">
                <div class="border p-3">
                    <h4>Advertisement</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
