<?php $menus = \App\Models\MenuFrontend::nested()->get(); ?>

<nav class="navbar navbar-expand-xl" aria-label="Seventh navbar example">
    <div class="container">
        <a class="navbar-brand" href="{{ '/' }}"><img src="{{ asset('newassets/img/logo.png') }}"
                alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleXxl"
            aria-controls="navbarsExampleXxl" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleXxl">
            <ul class="navbar-nav mx-auto mb-2 mb-xl-0">
                @foreach ($menus as $item)
                    @if (count($item['child']) > 0)
                        <li class="nav-item me-3 dropdown">
                            <a class="nav-link dropdown-toggle" href="{{ $item['link'] }}" data-bs-toggle="dropdown"
                                aria-expanded="false">{{ $item['title'] }}</a>
                            <ul class="dropdown-menu">
                                @foreach ($item['child'] as $subitem)
                                    <li><a class="dropdown-item"
                                            href="{{ $subitem['link'] }}">{{ $subitem['title'] }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="nav-item me-3">
                            <a class="nav-link" aria-current="page" href="{{ $item['link'] }}">{{ $item['title'] }}</a>
                        </li>
                    @endif
                @endforeach
                <li class="nav-item me-3">
                    @if (!Auth::guard('students')->check() && !Auth::guard('employees')->check())
                        <a style="background-color: white; border-radius: 5px;" class="nav-link" aria-current="page"
                            href="{{ route('loginstudent') }}">
                            Tizimga kirish
                        </a>
                    @else
                <li class="nav-item me-3 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        @if (Auth::guard('students')->check())
                            {{ Auth::guard('students')->user()->name }}
                        @else
                            {{ Auth::guard('employees')->user()->name }}
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="text-center">
                            <a class="text-danger" href="{{ route('logout-student') }}">Tizimdan chiqish</a>
                        </li>
                    </ul>
                </li>
                @endif
                </li>


            </ul>

        </div>
    </div>
</nav>
