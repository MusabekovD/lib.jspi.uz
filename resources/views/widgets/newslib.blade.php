<?php
use App\Models\Books;
$books = Books::take(8)->get();
?>
<section style="padding: 50px 0;background: #f1f6fe;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center mb-4">Yangi qo'shilgan adabiyotlar</h3>
            </div>
        </div>
        <div class="row">
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
    </div>

</section>
