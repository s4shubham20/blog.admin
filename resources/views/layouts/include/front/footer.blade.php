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
            <form id="form">
                <div class="row">
                    <div class="col-md-3">
                        {{-- Social media  --}}
                        @foreach ($socialmedia as $item)
                            <a class="btn btn-primary btn-floating m-1 radius-bd"
                                style="background-color: {{ $item->color }}" href="{{ $item->url }}" role="button"><i
                                    class="fab {{ $item->icon }}"></i></a>
                        @endforeach
                    </div>
                    <div class="col-md-6 cardinline">
                        <div class="row">
                            <div class="col-md-9 col-lg-9">
                                <div class="form-outline mb-4">
                                    <input type="email" id="newsletter" class="form-control" placeholder="Email Address" />
                                    <span class="text-danger" id="emailErrorMsg"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <input type="submit" value="Subscribe" class="btn btn-primary mb-4 float-right">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 ordered">
                        <ul class="ul-inline">
                            @foreach ($pages as $item)
                            <li class="list-unstyled">
                                <a href="{{ $item->slug }}" class="text-dark">{{ $item->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </form>
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
