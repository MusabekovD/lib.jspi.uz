<?php
use App\Models\Books;
$books = Books::take(8)->get();
?>

<div class="container">
    <div class="row">
        <div class="block_header d-flex justify-content-between align-items-end">
            <h3>Yangi qo‘shilgan adabiyotlar</h3>
            <h4> <a href="https://lib.jdpu.uz/library">Barchasi</a> </h4>
        </div>
    </div>
    <div class="row">
        @foreach ($books as $item)
        <div class="col-lg-3 mb-3">
            <article>
                <a  href="{{ route('viewbook', ['id' => $item->id]) }}">
                <div class="books_body">
                    <div class="post-title" style="width:100%; height:50px ; overflow-y:hidden ; text-transform:uppercase">
                        {{ $item->title }}
                    </div>
                    <img src="{{ $item->getImage() }}" class="books_image img-fluid">
                </div>
                </a>
                <div class="books_footer">
                    <div class="books_date">
                        <svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.625 14.8334V3.75004C14.625 2.87683 13.9149 2.16671 13.0417 2.16671H11.4583V0.583374H9.875V2.16671H5.125V0.583374H3.54167V2.16671H1.95833C1.08512 2.16671 0.375 2.87683 0.375 3.75004V14.8334C0.375 15.7066 1.08512 16.4167 1.95833 16.4167H13.0417C13.9149 16.4167 14.625 15.7066 14.625 14.8334ZM5.125 13.25H3.54167V11.6667H5.125V13.25ZM5.125 10.0834H3.54167V8.50004H5.125V10.0834ZM8.29167 13.25H6.70833V11.6667H8.29167V13.25ZM8.29167 10.0834H6.70833V8.50004H8.29167V10.0834ZM11.4583 13.25H9.875V11.6667H11.4583V13.25ZM11.4583 10.0834H9.875V8.50004H11.4583V10.0834ZM13.0417 6.12504H1.95833V4.54171H13.0417V6.12504Z" fill="#285BAD"/>
                        </svg>
                    {{$item->b_published_year}}</div>
                    <div class="books_info">
                        <span class="me-3">
                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.8333 5.5H9.50001V0.5H4.50001V5.5H1.16668L7.00001 12.1667L12.8333 5.5ZM0.333344 13.8333H13.6667V15.5H0.333344V13.8333Z" fill="#285BAD"/>
                            </svg>
                        {{$item->download_count}}</span>
                        <span>
                            <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 7.25C9.69036 7.25 10.25 6.69036 10.25 6C10.25 5.30964 9.69036 4.75 9 4.75C8.30964 4.75 7.75 5.30964 7.75 6C7.75 6.69036 8.30964 7.25 9 7.25Z" fill="#285BAD"/>
                                <path d="M17.225 5.58331C16.6917 4.65831 13.7583 0.016641 8.77501 0.166641C4.16667 0.283308 1.50001 4.33331 0.775006 5.58331C0.701866 5.70999 0.663361 5.85369 0.663361 5.99997C0.663361 6.14626 0.701866 6.28996 0.775006 6.41664C1.30001 7.32497 4.10834 11.8333 9.01667 11.8333H9.22501C13.8333 11.7166 16.5083 7.66664 17.225 6.41664C17.2981 6.28996 17.3367 6.14626 17.3367 5.99997C17.3367 5.85369 17.2981 5.70999 17.225 5.58331ZM9.00001 8.91664C8.42314 8.91664 7.85924 8.74558 7.37959 8.42509C6.89995 8.10461 6.52611 7.64909 6.30536 7.11613C6.0846 6.58318 6.02684 5.99674 6.13938 5.43096C6.25192 4.86518 6.52971 4.34548 6.93761 3.93758C7.34551 3.52968 7.86521 3.25189 8.43099 3.13935C8.99677 3.02681 9.58322 3.08457 10.1162 3.30533C10.6491 3.52608 11.1046 3.89992 11.4251 4.37956C11.7456 4.8592 11.9167 5.42311 11.9167 5.99997C11.9167 6.77352 11.6094 7.51539 11.0624 8.06237C10.5154 8.60935 9.77355 8.91664 9.00001 8.91664Z" fill="#285BAD"/>
                            </svg>
                            {{ $item->view_count }}</span>
                    </div>
                </div>
            </article>
        </div>
        @endforeach
    </div>
</div>
