<?php
use App\Models\News;
$News = News::orderBy('pubdate', 'desc')
->take(4)
->get();
?>
<style>
    .post-title{
        height:66px;
         overflow:hidden;
         text-overflow:ellipsis
    }
.post-item{
    height: 100px;
    overflow-y: hidden;
    text-overflow: ellipsis
} 
</style>
@extends('layouts.newsingle')
@section('newcontent')

<div class="container">
    <div class="row">
        <div class="block_header d-flex justify-content-between align-items-end">
            <h3>Yangiliklar</h3>
        </div>
    </div>
    <div class="row">
        @foreach  ($news as $item)
        <div class="col-lg-4 mb-4">
            <article class="blog-post-item">
                <a href="{{ route('viewnews', ['slug' => $item->slug]) }}">
                    <img width="299" height="168" src="{{ $item->getImage() }}" class="size-default-news">
                </a>
                <div class="post-title">
                    <h5><a href="{{ route('viewnews', ['slug' => $item->slug]) }}" class="post-title">{{ $item->title }}</a></h5>	
                </div>		
                <div class="post-item">{{ $item->short_content }}</div>
                <a href="{{ route('viewnews', ['slug' => $item->slug]) }}" class="more-btn">Batafsil</a>
            </article>
        </div>		        	
        @endforeach   	
                    

    </div>
    <div class="row">
        <div class="col-md-12">
            {{ $news->links() }}
        </div>
    </div>		       
</div>

@endsection