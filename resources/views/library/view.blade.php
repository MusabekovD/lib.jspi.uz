@extends('layouts.single')

@section('content')
    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services " class="featured-services">
        <div class="container" data-aos="fade-up">
            <div class="row ">
                <div class="col-md-3 mb-5 mb-lg-0">
                    <div class="list-group">
                        @foreach ($categories as $item)
                            <a href="https://lib.jdpu.uz/library?category={{ $item->id }}"
                                class="list-group-item list-group-item-action">
                                {{ $item->name }} ({{ $item->books_count }})
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-9 mb-5 mb-lg-0">
                    <div class="row">
                        <div class="col-md-4  mb-5">
                            <div class="box-container">
                                <img src="{{ $books->getImage() }}" class="img-fluid" alt="{{ $books->title }}">
                            </div>
                        </div>
                        <div class="col-md-8 mb-5">
                            <h4 class="mb-5">{{ $books->title }}</h4>
                            <h6><b>Muallif:</b> {{ $books->muallif->name }}</h6>
                            <h6><b>Til:</b> {{ $books->lang->name }}</h6>
                            <h6><b>Yozuv:</b> {{ $books->read_lang() }}</h6>
                            <h6><b>Nashiryot:</b> {{ $books->publishing->name }}</h6>
                            <h6><b>Nashr yili:</b> {{ $books->b_published_year }}</h6>
                            <h6><b>Ko'rishlar soni:</b> {{ $books->view_count }}</h6>
                            <br />
                            <div class="d-flex">
                                @if (Auth::guard('students')->check() || Auth::guard('employees')->check())
                                    <a class="btn btn-primary mr-3" target="_blank" href="{{ $books->getFile() }}"
                                        role="button">Yuklab olish</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12  mb-5">
                            <div class="box-container">
                                {{ $books->desc }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Featured Services Section -->
@endsection
