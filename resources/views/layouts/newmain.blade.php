<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	<title>{{ config('app.name', 'Laravel') }}</title>
	<link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('/newassets/css/bootstrap.css') }}"> 
	<link rel="stylesheet" href="{{ asset('/newassets/css/main.css') }}"> 
</head>
<body>
	<header>
		@include('widgets.newheader')
	</header>
	<div class="body">
		<section class="banner d-flex align-items-center justify-content-center">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<h3>Jizzax davlat pedagogika universiteti</h3>
						<h1>Axborot-resurs markazi <br> rasmiy sahifasi</h1>	
						<form action="/search" role="search" class="d-block">
							<div class="form-row d-flex">
								<input type="text" name="q"  id="search_content" class="form-control" placeholder="Saytdan ma’lumot qidirish...">
								<button class="btn" type="submit">
									<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M8 16C9.77498 15.9996 11.4988 15.4054 12.897 14.312L17.293 18.708L18.707 17.294L14.311 12.898C15.405 11.4997 15.9996 9.77544 16 8C16 3.589 12.411 0 8 0C3.589 0 0 3.589 0 8C0 12.411 3.589 16 8 16ZM8 2C11.309 2 14 4.691 14 8C14 11.309 11.309 14 8 14C4.691 14 2 11.309 2 8C2 4.691 4.691 2 8 2Z" fill="white"></path>
									</svg>
								</button>
							</div>
						</form>
					</div>

				</div>
			</div>
		</section>
		<section class="main_news" style="padding: 50px 0;" >
			@include('frontend.news')
		</section>
		<section class="main_indicators" style="padding: 50px 0;" >
			<div class="container">
				<div class="row">
					<div class="col-lg-3">
						<div class="indicator_block">
							<svg width="32" height="37" viewBox="0 0 32 37" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M30 0.641113H6C4.4087 0.641113 2.88258 1.27325 1.75736 2.39847C0.632141 3.52369 0 5.04981 0 6.64111V30.6411C0 32.2324 0.632141 33.7585 1.75736 34.8838C2.88258 36.009 4.4087 36.6411 6 36.6411H30C30.5304 36.6411 31.0391 36.4304 31.4142 36.0553C31.7893 35.6803 32 35.1715 32 34.6411V2.64111C32 2.11068 31.7893 1.60197 31.4142 1.2269C31.0391 0.851827 30.5304 0.641113 30 0.641113ZM6 32.6411C5.46957 32.6411 4.96086 32.4304 4.58579 32.0553C4.21071 31.6803 4 31.1715 4 30.6411C4 30.1107 4.21071 29.602 4.58579 29.2269C4.96086 28.8518 5.46957 28.6411 6 28.6411H28V32.6411H6Z" fill="#2B2B2B"/>
							</svg>
							<div class="indicator_number">20 500 ta</div>
							<div class="indicator_text">Axborot-resurs markazi fondi</div>
						</div>
					</div>					
					<div class="col-lg-3">
						<div class="indicator_block">
							<svg width="36" height="37" viewBox="0 0 36 37" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M30 0.641113H6C4.4087 0.641113 2.88258 1.27325 1.75736 2.39847C0.632141 3.52369 0 5.04981 0 6.64111V30.6411C0 32.2324 0.632141 33.7585 1.75736 34.8838C2.88258 36.009 4.4087 36.6411 6 36.6411H30C31.5913 36.6411 33.1174 36.009 34.2426 34.8838C35.3679 33.7585 36 32.2324 36 30.6411V6.64111C36 5.04981 35.3679 3.52369 34.2426 2.39847C33.1174 1.27325 31.5913 0.641113 30 0.641113ZM18 6.64111C18.3956 6.64111 18.7822 6.75841 19.1111 6.97817C19.44 7.19794 19.6964 7.51029 19.8478 7.87575C19.9991 8.2412 20.0387 8.64333 19.9616 9.03129C19.8844 9.41926 19.6939 9.77562 19.4142 10.0553C19.1345 10.335 18.7781 10.5255 18.3902 10.6027C18.0022 10.6799 17.6001 10.6402 17.2346 10.4889C16.8692 10.3375 16.5568 10.0812 16.3371 9.75225C16.1173 9.42336 16 9.03668 16 8.64111C16 8.11068 16.2107 7.60197 16.5858 7.2269C16.9609 6.85183 17.4696 6.64111 18 6.64111V6.64111ZM10 6.64111C10.3956 6.64111 10.7822 6.75841 11.1111 6.97817C11.44 7.19794 11.6964 7.51029 11.8478 7.87575C11.9991 8.2412 12.0387 8.64333 11.9616 9.03129C11.8844 9.41926 11.6939 9.77562 11.4142 10.0553C11.1345 10.335 10.7781 10.5255 10.3902 10.6027C10.0022 10.6799 9.60009 10.6402 9.23463 10.4889C8.86918 10.3375 8.55682 10.0812 8.33706 9.75225C8.1173 9.42336 8 9.03668 8 8.64111C8 8.11068 8.21071 7.60197 8.58579 7.2269C8.96086 6.85183 9.46957 6.64111 10 6.64111V6.64111ZM32 30.6411C32 31.1715 31.7893 31.6803 31.4142 32.0553C31.0391 32.4304 30.5304 32.6411 30 32.6411H6C5.46957 32.6411 4.96086 32.4304 4.58579 32.0553C4.21071 31.6803 4 31.1715 4 30.6411V16.6411H32V30.6411Z" fill="#2B2B2B"/>
							</svg>
							<div class="indicator_number">{{$booksCount}} ta</div>
							<div class="indicator_text">Elektron resurslar soni</div>
						</div>
					</div>					
					<div class="col-lg-3">
						<div class="indicator_block">					
							<svg width="28" height="37" viewBox="0 0 28 37" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M14 16.6411C15.5823 16.6411 17.129 16.1719 18.4446 15.2929C19.7602 14.4138 20.7855 13.1644 21.391 11.7026C21.9965 10.2408 22.155 8.63224 21.8463 7.08039C21.5376 5.52855 20.7757 4.10308 19.6569 2.98426C18.538 1.86544 17.1126 1.10352 15.5607 0.794835C14.0089 0.486153 12.4003 0.64458 10.9385 1.25008C9.47672 1.85558 8.22729 2.88096 7.34824 4.19655C6.46919 5.51215 6 7.05887 6 8.64112C6 10.7628 6.84285 12.7977 8.34315 14.298C9.84344 15.7983 11.8783 16.6411 14 16.6411Z" fill="#2B2B2B"/>
								<path d="M26 36.6411C26.5304 36.6411 27.0391 36.4304 27.4142 36.0553C27.7893 35.6803 28 35.1715 28 34.6411C28 30.9281 26.525 27.3671 23.8995 24.7416C21.274 22.1161 17.713 20.6411 14 20.6411C10.287 20.6411 6.72601 22.1161 4.1005 24.7416C1.475 27.3671 5.53285e-08 30.9281 0 34.6411C0 35.1715 0.210714 35.6803 0.585787 36.0553C0.96086 36.4304 1.46957 36.6411 2 36.6411H26Z" fill="#2B2B2B"/>
							</svg>
							<div class="indicator_number">{{$membersCount}} ta</div>
							<div class="indicator_text">Kitobxonlar soni</div>
						</div>
					</div>					
					<div class="col-lg-3">
						<div class="indicator_block">
							<svg width="42" height="35" viewBox="0 0 42 35" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M21 34.6411C20.7368 34.6426 20.4759 34.5922 20.2322 34.4926C19.9885 34.3931 19.7669 34.2464 19.58 34.0611L4.03999 18.5011C2.09071 16.5314 0.997314 13.8722 0.997314 11.1011C0.997314 8.32995 2.09071 5.67073 4.03999 3.70109C6.00451 1.74211 8.66565 0.642029 11.44 0.642029C14.2143 0.642029 16.8755 1.74211 18.84 3.70109L21 5.86109L23.16 3.70109C25.1245 1.74211 27.7857 0.642029 30.56 0.642029C33.3343 0.642029 35.9955 1.74211 37.96 3.70109C39.9093 5.67073 41.0027 8.32995 41.0027 11.1011C41.0027 13.8722 39.9093 16.5314 37.96 18.5011L22.42 34.0611C22.2331 34.2464 22.0115 34.3931 21.7678 34.4926C21.5241 34.5922 21.2632 34.6426 21 34.6411Z" fill="#2B2B2B"/>
							</svg>
							<div class="indicator_number">{{$likesCount}} ta</div>
							<div class="indicator_text">Yoqimlilar sarasidagi resurslar</div>
						</div>
					</div>					
				</div>				
			</div>
		</section>



		<section class="main_books" style="padding: 50px 0;" >
			@include('widgets.newlet')
		</section>
		<section class="main_send text-center" style="padding: 50px 0;" >
			<div class="container">
				<div class="row">
					<h3>Kitob buyurtmasi</h3>
					<p>Kutubxonamizdan qidirgan kitobingizni topa olamdingizmi?</p>
					<p>Marhamat, buyurtma bering va biz siz uchun xaridni amalga oshiramiz</p>
				</div>
				<div class="row">
					<div class="col-lg-6 mx-auto d-table">
						<form action="{{ route('kitobbuyurtma') }}" method="POST" role="form" class="php-email-form">
                            @csrf
                            <div class="row">
                                <div class="col form-group col-lg-6 mb-3">
                                    <input type="text" name="fio"
                                        class="form-control" id="fio"
                                        placeholder="F.I.O" value="{{ old('fio') }}" required="">
                                    @error('fio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col form-group col-lg-6 mb-3">
                                    <input type="textl" class="form-control "
                                        name="tell" id="tell" value="{{ old('tell') }}"
                                        placeholder="Telefon raqamingiz" required="">
                                    @error('tell')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-lg-12 mb-3">
                                <input type="text" class="form-control"
                                    name="kitobnomi" id="kitobnomi" value="{{ old('kitobnomi') }}"
                                    placeholder="Kitob nomi" required="">
                                @error('kitobnomi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" name="muallif"
                                        class="form-control" id="muallif"
                                        value="{{ old('muallif') }}" placeholder="Muallif(lar)" required="">
                                    @error('muallif')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col form-group">
                                    <input type="text" class="form-control"
                                        name="nashryili" id="nashryili" value="{{ old('nashryili') }}"
                                        placeholder="Nashr etilgan yili" required="">
                                    @error('nashryili')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Buyurtmangiz muvoffaqiyatli rasmiylashtirildi. Sizga rahmat!
                                </div>
                            </div> --}}

                            <div class="text-center"><button class="btn btn-primary" type="submit">Buyurtma qilish</button></div>
                        </form>
					</div>
				</div>	
			</div>
		</section>
		<footer>
			@include('frontend.footermenu')
		</footer>
		<div class="footer"></div>
		
	</div><!-- end body  -->
	<div class="footer"></div>
	<!-- <script src="js/bootstrap.min.js"></script> -->
	 <!-- Yandex.Metrika counter -->
	 <script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(
                k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(86871262, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true
        });
    </script>

	  <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
	  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	  <script src="{{ asset('assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
	  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
	  <script src="{{ asset('assets/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
	  <script src="{{ asset('assets/vendor/counterup/counterup.min.js') }}"></script>
	  {{-- <script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script> --}}
	  {{-- <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script> --}}
	  {{-- <script src="{{ asset('assets/vendor/venobox/venobox.min.js') }}"></script> --}}
	  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>

	     <!-- Template Main JS File -->
		 <script src="{{ asset('assets/js/main.js') }}"></script>


	<script src="{{ asset('newassets/js/bootstrap.bundle.min.js') }}"></script> 
</body>
</html>