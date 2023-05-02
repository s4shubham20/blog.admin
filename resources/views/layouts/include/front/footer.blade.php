<!-- Footer -->
<footer class="bg-link ">
    <!-- Grid container -->
    <div class="container p-4">

        <!-- Section: Social media -->
        <section class="mb-4">
            <!-- Facebook -->

        </section>
        <!-- Section: Social media -->


        <!-- Section: Form -->
        <section class="">
            <div class="row text-center mb-3">
                <h2>Subscribe our newsletter for daily updates</h2>
            </div>
            <div class="row">
                <div class="col-md-3">
                    {{-- Social media  --}}
                    @if (isset($socialmedia))
                    @foreach ($socialmedia as $item)
                    <a class="btn btn-primary btn-floating m-1 radius-bd"
                    style="background-color: {{ $item->color }}" href="{{ $item->url }}" role="button"><i
                    class="fab {{ $item->icon }}"></i></a>
                    @endforeach
                    @endif
                </div>
                <div class="col-md-6 cardinline">
                    <div class="row">
                        <div class="col-md-9 col-lg-9">
                            <div class="form-outline mb-4">
                                <input type="email" id="newsletter" class="form-control"
                                    placeholder="Email Address" />
                                <span class="text-danger" id="emailErrorMsg"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <input type="submit" onclick="submitBtn();" value="Subscribe" class="btn btn-primary mb-4 float-right">
                        </div>
                    </div>
                </div>
                @if (isset($pages))
                <div class="col-md-3 ordered">
                    <ul class="ul-inline">
                        @foreach ($pages as $item)
                        <li class="list-unstyled">
                            <a href="{{ $item->slug }}" class="text-dark">{{ $item->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </section>
        <!-- Section: Form -->



        <!-- Section: Links -->
        <section class="">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Links</h5>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#!" class="text-dark">Link 1</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark">Link 2</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark">Link 3</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark">Link 4</a>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
        </section>
        <!-- Section: Links -->

    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        © {{ date('Y') }} Copyright:
        <a class="text-dark text-decoration-none" href="">Developed by Shubham Rana</a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
@section('js')
    <script>
       function submitBtn(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var email = $("#newsletter").val();
            //alert(email);
            $.ajax({
                type: "post",
                url: "{{ route('newsletter') }}",
                data: {'email':email},
                success: function (response) {
                    if(response.status == 200)
                    {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Thank you for subscribe our newsletter !',
                            showConfirmButton: false,
                            timer: 6000
                        });
                    }else{
                        alert(response.message);
                    }
                    $('#newsletter').val('');
                },
                error:function (response) {
                    $('#emailErrorMsg').text(response.responseJSON.errors.email);
                }
            });
        }
    </script>
@endsection
