@extends('layouts.single')

@section('content')
    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services " class="featured-services">
        <div class="container" data-aos="fade-up">

            <div class="row ">

                <div class="col-md-12 mb-5 mb-lg-0">
                    <div class="row">
                        <div class="col-md-12  mb-5">
                            <div class="box-container">
                                <h3 class="text-center">{{ $page->title }}</h3>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12  mb-5">
                            <div class="box-container">

                                {!! $page->content !!}
                            </div>
                        </div>

                    </div>
                </div>



            </div>

        </div>
    </section><!-- End Featured Services Section -->




@endsection
