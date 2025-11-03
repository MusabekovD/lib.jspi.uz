<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<base href="/public">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="yandex-verification" content="2c64e64bb2e8b427" />

    <!-- Favicons -->
    <link href="/storage/favicon.ico" rel="icon">
    <link href="/storage/favicon.ico" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">


    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">


    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-WBG7PM5');
    </script>
    <!-- End Google Tag Manager -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-8BVX44011L"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-8BVX44011L');
    </script>
</head>

<body>

    <!-- ======= Top Bar ======= -->
    {{-- <div id="topbar" class="d-none d-lg-flex align-items-center">
        <div class="container d-flex">
            <div class="contact-info mr-auto">
                <i class="icofont-envelope"></i> <a href="mailto:jspiarm@jspi.uz">jspiarm@jspi.uz</a>
                <i class="icofont-phone"></i> +998 72 226-37-28
            </div>
            <div class="social-links">
                <a href="https://twitter.com/jdpuuz" class="twitter"><i class="icofont-twitter"></i></a>
                <a href="https://www.facebook.com/jdpuuz/" class="facebook"><i class="icofont-facebook"></i></a>
                <a href="https://www.instagram.com/jdpuuz/" class="instagram"><i class="icofont-instagram"></i></a>
            </div>
        </div>
    </div> --}}
    <?php $menus = \App\Models\MenuFrontend::nested()->get(); ?>
    @include('widgets.header')

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <h1>Jizzax davlat pedagogika universitet</h1>
            <h2>Axborot-resurs markazi rasmiy sahifasi</h2>
        </div>
    </section><!-- End Hero -->

    <main id="main">
        @include('front.news')

        <div style="padding: 50px 0;background: #f1f6fe;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h4>Bizning <b>@jspilibbot</b> telegram botimiz orqali kitobxonga aylaning</h4>
                        <a href="https://t.me/jspilibbot" class="btn btn-primary">A'zo bo'lish</a>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')

        @include('widgets.newslib')

        <section id="kitobbuyurtma" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h3><span>Kitob buyurtma bering</span></h3>
                    <p>Siz bizning kutubxonamizdan qidirgan kitobingizni topaolamdingizmi marhamat buyurtma bering va
                        biz siz uchun xaridni amalga oshiramiz</p>
                </div>
                <div class="row  justify-content-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-6">
                        <form action="{{ route('kitobbuyurtma') }}" method="post" role="form" class="php-email-form">
                            @csrf
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" name="fio"
                                        class="form-control @error('fio') is-invalid @enderror" id="fio"
                                        placeholder="F.I.O" value="{{ old('fio') }}" required="">
                                    @error('fio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col form-group">
                                    <input type="textl" class="form-control @error('tell') is-invalid @enderror"
                                        name="tell" id="tell" value="{{ old('tell') }}"
                                        placeholder="Telefon raqamingiz" required="">
                                    @error('tell')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control @error('kitobnomi') is-invalid @enderror"
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
                                        class="form-control @error('muallif') is-invalid @enderror" id="muallif"
                                        value="{{ old('muallif') }}" placeholder="Muallif(lar)" required="">
                                    @error('muallif')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col form-group">
                                    <input type="text" class="form-control @error('nashryili') is-invalid @enderror"
                                        name="nashryili" id="nashryili" value="{{ old('nashryili') }}"
                                        placeholder="Nashr etilgan yili" required="">
                                    @error('nashryili')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Buyurtmangiz muvoffaqiyatli rasmiylashtirildi. Sizga rahmat!
                                </div>
                            </div>

                            <div class="text-center"><button type="submit">Buyurtma qilish</button></div>
                        </form>
                    </div>

                </div>

            </div>
        </section>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h4>Bizning telegram kanalimizga a'zo bo'ling</h4>
                        <a href="https://t.me/jdpiarm" class="btn btn-primary">A'zo bo'lish</a>
                    </div>
                </div>
            </div>
        </div>

        @include('front.footermenu')

        <div class="container py-4">
            <div class="copyright">
                &copy; Copyright <strong><span>JDPU.uz Library</span></strong>. All Rights Reserved</div>

        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
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
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/86871262" style="position:absolute; left:-9999px;" alt="" /></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->
</body>

</html>
