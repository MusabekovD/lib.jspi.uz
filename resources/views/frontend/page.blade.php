@extends('layouts.newsingle')

@section('newcontent')

<div class="container">
    <div class="row">
        <div class="block_header d-flex justify-content-between align-items-end">
            <h3>{{ $page->title }}</h3>
        </div>
    </div>
    <div class="row">
        {!! $page->content !!}
    </div>	       
</div>

@endsection