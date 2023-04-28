<div class="global-navbar">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @if($setting != null)
                <img src="{{ asset($setting->logo) }}" alt="{{ $setting->logo }}" class="w-50">
                @endif
            </div>
            <div class="col-md-9 my-auto">
                <div class="border text-center p-2">
                    <h5>Advertise here !</h5>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-green">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                    </li>
                    {{-- @php
                        $categories = App\Models\Category::where('status', 1)->get();
                        $post = App\Models\Post::withCount('post')->where('status', 1)->get();
                    @endphp --}}
                    @foreach ($categories as $item)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('category/'.$item->slug) }}">{{ $item->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</div>
