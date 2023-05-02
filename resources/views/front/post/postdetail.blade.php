@extends('layouts.app')
@section('css')
    <style>
        a.active-color {
            color: #7c437c;
        }
        .btn {
            border: none;
            font-size: 16px;
            cursor: pointer;
            display: inline-block;
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
                        <h6>{{ $post->category->name . '/' . $post->name }}</h6>
                    </div>
                    <div class="card card-shadow mt-4">
                        <div class="card-body">
                            {!! $post->description !!}
                        </div>
                    </div>

                    <section style="background-color: #eee;">
                        <div class="container my-5 py-5">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-12 col-lg-10 col-xl-8">
                                    <div class="card">
                                        @forelse ($post->comment as $comments)

                                        <div class="card-body comment-container">
                                            <div class="d-flex flex-start align-items-center">
                                                <img class="rounded-circle shadow-1-strong me-3"
                                                src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp"
                                                alt="avatar" width="60" height="60" />
                                                <div>
                                                    @if ($comments->user)
                                                    <h6 class="fw-bold text-primary mb-1">{{ $comments->user->name }}</h6>
                                                    @endif
                                                    <p class="text-muted small mb-0">
                                                        {{ $comments->created_at }}
                                                    </p>
                                                </div>
                                            </div>

                                            <p class="mt-3 mb-4 pb-2">
                                                {{ $comments->comment }}
                                            </p>

                                            <div class="small d-flex justify-content-start">
                                                @if (Auth::check() && Auth::id() == $comments->user_id)
                                                @php
                                                    $eid = Crypt::encrypt($comments->id);
                                                @endphp
                                                <button type="button" value="{{ $eid }}" class="deleteComment btn mb-0 text-danger"><i class="fas fa-trash me-2"></i>Delete</button>
                                                @endif
                                            </div>
                                        </div>
                                        @empty
                                        <div class="card-body">
                                            <h5 class="ms-3 mt-2">No Comment Yet.</h5>
                                        </div>
                                        @endforelse
                                        <form action="{{ route('comment.store') }}" method="post">
                                            @csrf
                                            <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                                                <div class="d-flex flex-start w-100">
                                                    <input type="hidden" name="post_slug" value="{{ $post->slug }}">
                                                    {{-- <img class="rounded-circle shadow-1-strong me-3"
                                                        src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp"
                                                        alt="avatar" width="40" height="40" /> --}}
                                                    <div class="form-outline w-100">
                                                        <textarea class="form-control" name="comment" rows="4" style="background: #fff;" placeholder="Writer Message Here !"></textarea>
                                                    </div>
                                                </div>
                                                <div class="float-end mt-2 pt-1 mb-2">
                                                    <button type="submit" class="btn btn-primary btn-sm">Post
                                                        comment</button>
                                                    <button type="reset"
                                                        class="btn btn-outline-primary btn-sm">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
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
                                    <a href="{{ url('post/' . $item->category->slug . '/' . $item->slug) }}"
                                        class="text-decoration-none {{ Request::is('post/' . $item->category->slug . '/' . $item->slug) ? 'active-color' : '' }}">
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
@section('js')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).one('click','.deleteComment', function (e) {
                //alert('Hello');
                if(confirm('Are you sure you want to delete this comment?'))
                {
                    var thisClicked  = $(this);
                    var commentId = thisClicked.val();
                    //alert(commentId);
                    $.ajax({
                        type: "post",
                        url: "/comment/delete",
                        data: {'commentId':commentId},
                        success: function (response) {
                            if(response.status == 200){
                                thisClicked.closest('.comment-container').remove();
                                alert(response.message);
                            }else{
                                alert(response.message);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
