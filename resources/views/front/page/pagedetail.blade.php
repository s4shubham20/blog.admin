@extends('layouts.app')
@section('content')
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
<div class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="category-heading">
                    <h4 class="mb-0">{!! $pagedetail->name !!}</h4>
                </div>
                <div class="card card-shadow mt-4">
                    <div class="card-body">
                        {!! $pagedetail->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
