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
                    <form action="">
                        <div class="input-group mb-3">
                            <input name="search" type="text" class="form-control" placeholder="Kitob nomini kiriting"
                                aria-label="Kitob nomini kiriting" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Qidirish</button>
                            </div>
                        </div>
                    </form>
                    <div class="row row-eq-height library">
                        @foreach ($books as $item)
                            <div class="col-md-3 mb-5">
                                <a href="{{ route('viewbook', ['id' => $item->id]) }}" class="card">
                                    <img class="card-img-top" src="{{ $item->getImage() }}" alt="Card image cap">
                                    <div class="card-body">
                                        <h6 class="card-title"> {{ $item->title }}</h6>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center">
                        {!! $books->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Featured Services Section -->
@endsection
