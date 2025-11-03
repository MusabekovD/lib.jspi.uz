@extends('layouts.newsingle')

@section('newcontent')

<div class="container">
    <div class="row">
        <div class="block_header d-flex justify-content-between align-items-end text-center">
            <h3>{{ $news->title }}</h3>
        </div>
    </div>
    <div class="row mb-4">
        <img src="{{ $news->getImage() }}" alt="">
    </div>
    <div class="row">
        {!! $news->content !!}
    </div>	       
</div>

@endsection