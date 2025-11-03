<?php $menus = \App\Models\MenuFrontend::nested()->get(); ?>
<!-- ======= Header ======= -->
<header id="header">
    <div class="container d-flex align-items-center">
        <h1 class="logo mr-auto"><a href="/">JDPU ARM</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt=""></a>-->
        <nav class="nav-menu d-none d-lg-block">
            <ul>
                @foreach ($menus as $item)
                    @if (count($item['child']) > 0)
                        <li class="drop-down"><a href="{{ $item['link'] }}">{{ $item['title'] }}</a>
                            <ul>
                                @foreach ($item['child'] as $subitem)
                                    <li><a href="{{ $subitem['link'] }}">{{ $subitem['title'] }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
                    @endif
                @endforeach
            </ul>
        </nav><!-- .nav-menu -->
    </div>
</header><!-- End Header -->
