@extends('layouts.newmain') 

@section('content')
   <!-- ======= Featured Services Section ======= -->
   <section id="featured-services" class="featured-services">
       <div class="container" data-aos="fade-up">

          <div class="row">
              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                  <div class="icon-box w-100" data-aos="fade-up" data-aos-delay="100">
                      <div class="icon"><i class="bx bx-user"></i></div>
                      <h4 class="title"><a href="">{{ $membersCount }} ta</a></h4>
                      <p class="description">Kitobxonlar soni</p>
                  </div>
              </div>

              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                  <div class="icon-box w-100" data-aos="fade-up" data-aos-delay="200">
                      <div class="icon"><i class="bx bx-book-heart"></i></div>
                      <h4 class="title"><a href="">{{ $likesCount }} ta</a></h4>
                      <p class="description">Yoqimlilar sarasidagi resurslar</p>
                  </div>
              </div>

              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                  <div class="icon-box w-100" data-aos="fade-up" data-aos-delay="300">
                      <div class="icon"><i class="bx bx-book-content"></i></div>
                      <h4 class="title"><a href="">{{ $booksCount }} ta</a></h4>
                      <p class="description">Elektron resurslar soni</p>
                  </div>
              </div>

              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                  <div class="icon-box w-100" data-aos="fade-up" data-aos-delay="400">
                      <div class="icon"><i class="bx bx-book"></i></div>
                      <h4 class="title"><a href="">20500 ta</a></h4>
                      <p class="description">AXborot-resurs markazi fondi</p>
                  </div>
              </div>

          </div>

      </div>
  </section><!-- End Featured Services Section -->




@endsection

