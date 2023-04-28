@extends('layouts.home')
@section('title', 'Setting')
@show
@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Setting</h4>
        </div>
        @php
            if($setting != null){
                if ($setting->id == 1) {
                    $eid = Crypt::encrypt($setting->id);
                }else{
                    $eid = null;
                }
                $route = route('setting.update', $eid);
                $robot = $setting->robot;
            }else{
                $route = route('setting.store');
                $robot = old('robot');
            }
        @endphp
        <div class="card-body">
            <form action="{{ $route }}" method="post" enctype="multipart/form-data">
                @csrf
                @if($setting != null)
                @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Website Name</label>
                        <input type="text" name="name"
                            class="form-control @if ($errors->has('name')) is-invalid @endif"
                            placeholder="Website Name" value="{{ $setting != '' ? $setting->name : old('name') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="url">Website Link</label>
                        <input type="url" name="url"
                            class="form-control @if ($errors->has('url')) is-invalid @endif"
                            placeholder="Website Link" value="{{ $setting != '' ? $setting->url : old('url') }}">
                        @error('url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Website Email</label>
                        <input type="email" name="email"
                            class="form-control @if ($errors->has('email')) is-invalid @endif"
                            placeholder="Website Email" value="{{ $setting != '' ? $setting->email : old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="mobile">Website Mobile</label>
                        <input type="number" name="mobile"
                            class="form-control @if ($errors->has('mobile')) is-invalid @endif"
                            placeholder="Website Mobile" value="{{ $setting != '' ? $setting->mobile : old('mobile') }}">
                        @error('mobile')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="logo">Website Logo</label>
                        <a data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Logo extension should be in webp , jpg , jpeg and png and size less than 200kb ">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </a>
                        <br/>
                        @if($setting != '')
                            <img src="{{ asset($setting->logo) }}" alt="{{ $setting->logo }}" width="100">
                        @endif
                        <input type="file" name="logo"
                            class="form-control @if ($errors->has('logo')) is-invalid @endif"
                            value="{{ old('logo') }}">
                        @error('logo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fevicon">Website Fevicon</label>
                        <a data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Fevicon extension should be in webp , jpg , jpeg and png and size less than 200kb ">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </a>
                        <br/>
                        @if($setting != '')
                            <img src="{{ asset($setting->fevicon) }}" alt="{{ $setting->fevicon }}" width="100">
                        @endif
                        <input type="file" name="fevicon"
                            class="form-control @if ($errors->has('fevicon')) is-invalid @endif"
                            value="{{ old('fevicon') }}">
                        @error('fevicon')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="header">Header</label>
                        <textarea name="header" id="header" class="form-control @if ($errors->has('header')) is-invalid @endif" cols="30" rows="10" placeholder="Header Code!">{{ $setting != '' ? $setting->header : old('header') }}</textarea>
                        @error('header')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="footer">Footer</label>
                        <textarea name="footer" id="footer" class="form-control @if ($errors->has('footer')) is-invalid @endif" cols="30" rows="10" placeholder="Footer Code!">{{ $setting != '' ? $setting->footer : old('footer') }}</textarea>
                        @error('footer')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="radio" name="robot" class="form-check-input" id="robot1" value="1" {{ $robot == 1 ? 'checked' : '' }}>
                        <label for="robot1" class="form-check-label">Index</label>
                        <input type="radio" name="robot" class="form-check-input" id="robot2" value="0"  {{ $robot == 0 ? 'checked' : '' }}>
                        <label for="robot2" class="form-check-label">No Index</label>
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
@section('js')
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>
@endsection
