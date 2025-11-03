<?php
use App\Models\News;
$News = News::orderBy('pubdate', 'desc')
->take(4)
->get();
?>
@extends('layouts.single')

@section('content')

    <section style="padding: 50px 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center mb-4">Yangiliklar</h3>
                </div>
            </div>
            <div class="row">
                @foreach ($news as $item)
                    <div class="col-md-3 mb-5">
                        <a href="{{ route('viewnews', ['slug' => $item->slug]) }}" class="card">
                            <img class="card-img-top" src="{{ $item->getImage() }}" alt="Card image cap">
                            <div class="card-body">
                                <h6 class="card-title"> {{ $item->title }}</h6>
                                <p class="card-text">{{ $item->short_content }}</p>

                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{ $news->links() }}
                </div>
            </div>
        </div>

    </section>
@endsection
