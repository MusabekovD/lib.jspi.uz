@extends('layouts.newsingle')
@php
    use App\Helpers\CalculateCountHelper;

    function departmentType($categories)
    {
        //        dd($categories);
        $cateOptions = [];
        $idsToCheck = [19, 32, 33, 27, 28];
        $idsToCheck3 = [25, 26, 12];
        foreach ($categories as $key => $category) {
            if ($category['id'] == 30) {
                $cateOpt = [
                    'id' => $category['id'],
                    'title' => $category['name'],
                    'course' => 6,
                ];
            } elseif (in_array($category['id'], $idsToCheck)) {
                $cateOpt = [
                    'id' => $category['id'],
                    'title' => $category['name'],
                    'course' => 5,
                ];
            } elseif (in_array($category['id'], $idsToCheck3)) {
                $cateOpt = [
                    'id' => $category['id'],
                    'title' => $category['name'],
                    'course' => 3,
                ];
            } else {
                $cateOpt = [
                    'id' => $category['id'],
                    'title' => $category['name'],
                    'course' => 4,
                ];
            }
            $cateOptions[] = $cateOpt;
        }
        return $cateOptions;
    }
    $cateOptions = departmentType($categories);
@endphp
@section('newcontent')
    <style>
        .main-nav__drop {
            text-align: center;
            top: 78px;
            transition: all 0.2s ease-in-out;
            position: absolute;
            left: -9999px;
            height: 0;
        }

        .main-nav__drop-holder {
            display: block;
            float: none;
            position: relative;
        }


        .main-nav__drop-active .main-nav__drop {
            position: static;
            height: 100%;
        }

        .main-nav__drop-item {
            color: #fff;
            padding: 8px 20px;
            margin: 0;
            display: block;
            border: 0;
        }

        .main-nav__drop-list {
            background: 0;
            border-radius: 0;
            padding: 0;
            position: static;
            float: none;
            text-align: center;
            box-shadow: none;
            display: block;
            font-size: 12px;
            line-height: 20px;
        }

        .act {
            border: solid 1px #adb5bd !important;
            color: #fff !important;
            padding: 20px !important;
            border-radius: 10px;
        }

        .act-text {
            color: #fff !important;
        }
    </style>
    <section class="main_books post_item" style="padding: 50px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 mb-4">
                    <h3 class="block_header mb-5">Elektron kutubxona</h3>
                    <div class="sidebar mb-5">
                        <ul>
                            <li>
                                <div class="main-nav__drop-holder main-nav__drop-parent">
                                    <a href="/library_manual" class="main-nav__drop-parent">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_90_1140)">
                                                <path
                                                    d="M14.625 15.375H3.375C2.88496 15.381 2.4125 15.1926 2.06107 14.851C1.70965 14.5094 1.5079 14.0425 1.5 13.5525V4.44749C1.5079 3.95747 1.70965 3.49055 2.06107 3.14897C2.4125 2.80738 2.88496 2.61897 3.375 2.62499H6.825C6.93578 2.62572 7.04502 2.65098 7.14487 2.69897C7.24473 2.74695 7.33271 2.81645 7.4025 2.90249L9.3525 5.28749H14.6025C14.847 5.28151 15.0903 5.32403 15.3183 5.41257C15.5463 5.50112 15.7546 5.63394 15.931 5.80338C16.1074 5.97282 16.2485 6.17552 16.3462 6.39978C16.4438 6.62404 16.4961 6.86542 16.5 7.10999V13.5525C16.4921 14.0425 16.2903 14.5094 15.9389 14.851C15.5875 15.1926 15.115 15.381 14.625 15.375Z"
                                                    fill="#2B2B2B" />
                                            </g>
                                        </svg>
                                        <span>Barchasi</span>
                                    </a>
                                </div>
                            </li>
                            @foreach ($cateOptions as $cateOption)
                                <li @if ($cateOption['id'] == $id) class="act" @endif>
                                    <div class="main-nav__drop-holder main-nav__drop-parent">
                                        <a href="javascript:void(0);" class="main-nav__drop-parent">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_90_1140)">
                                                    <path
                                                        d="M14.625 15.375H3.375C2.88496 15.381 2.4125 15.1926 2.06107 14.851C1.70965 14.5094 1.5079 14.0425 1.5 13.5525V4.44749C1.5079 3.95747 1.70965 3.49055 2.06107 3.14897C2.4125 2.80738 2.88496 2.61897 3.375 2.62499H6.825C6.93578 2.62572 7.04502 2.65098 7.14487 2.69897C7.24473 2.74695 7.33271 2.81645 7.4025 2.90249L9.3525 5.28749H14.6025C14.847 5.28151 15.0903 5.32403 15.3183 5.41257C15.5463 5.50112 15.7546 5.63394 15.931 5.80338C16.1074 5.97282 16.2485 6.17552 16.3462 6.39978C16.4438 6.62404 16.4961 6.86542 16.5 7.10999V13.5525C16.4921 14.0425 16.2903 14.5094 15.9389 14.851C15.5875 15.1926 15.115 15.381 14.625 15.375Z"
                                                        fill="#2B2B2B" />
                                                </g>
                                            </svg>
                                            <span> {{ $cateOption['title'] }} <span
                                                    class="badge rounded-pill bg-info text-dark">{{ CalculateCountHelper::calculateCount($cateOption['id']) }}</span></span>
                                        </a>
                                        <div class="main-nav__drop">
                                            <ul class="main-nav__drop-list">
                                                @for ($i = 1; $i <= $cateOption['course']; $i++)
                                                    <li class="main-nav__drop-item">
                                                        <a
                                                            href="/library_manual/{{ $cateOption['id'] }}?course={{ $i }}">{{ $i }}
                                                            - kurs
                                                            <span
                                                                class="badge rounded-pill bg-info text-dark">{{ CalculateCountHelper::calculateCount($cateOption['id'], $i) }}</span></a>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar_soc">
                        <p class="mb-4 fw-bold">Bizni ijtimoiy tarmoqlar orqali kuzatib boring: </p>
                        <div class="d-flex footer_soc justify-content-around">
                            <a href="https://t.me/jdpuuz" target="_blank">
                                <svg width="28" height="24" viewBox="0 0 28 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M25.2925 0.405398L1.26649 9.67025C-0.373187 10.3288 -0.363701 11.2435 0.965657 11.6514L7.1341 13.5757L21.4061 4.57099C22.0809 4.1604 22.6975 4.38128 22.1907 4.83117L10.6276 15.2668H10.6248L10.6276 15.2682L10.2021 21.6264C10.8254 21.6264 11.1005 21.3404 11.4501 21.003L14.4462 18.0895L20.6784 22.6928C21.8275 23.3257 22.6528 23.0004 22.9387 21.6291L27.0298 2.34862C27.4485 0.669644 26.3888 -0.0905703 25.2925 0.405398Z"
                                        fill="#2B2B2B" />
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/jdpuuz/" target="_blank">
                                <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M25.2252 7.67616C25.2111 6.61992 25.0134 5.57417 24.6408 4.5857C24.3178 3.75194 23.8243 2.99473 23.1921 2.36246C22.5598 1.73018 21.8026 1.23675 20.9688 0.913692C19.9931 0.547407 18.9622 0.34935 17.9202 0.327955C16.5786 0.267987 16.1532 0.251251 12.7476 0.251251C9.34194 0.251251 8.90542 0.251251 7.57357 0.327955C6.53202 0.349507 5.50166 0.547562 4.52635 0.913692C3.69245 1.23653 2.93512 1.72988 2.30282 2.36218C1.67052 2.99448 1.17717 3.75181 0.854335 4.5857C0.487316 5.56072 0.289689 6.59131 0.269993 7.63293C0.210024 8.97594 0.191895 9.4013 0.191895 12.8069C0.191895 16.2126 0.191895 16.6477 0.269993 17.9809C0.290912 19.0241 0.487552 20.0533 0.854335 21.031C1.17771 21.8646 1.67143 22.6216 2.30394 23.2537C2.93646 23.8857 3.69385 24.3788 4.52774 24.7016C5.50039 25.0826 6.53092 25.2948 7.57497 25.3291C8.91798 25.3891 9.34333 25.4072 12.749 25.4072C16.1546 25.4072 16.5911 25.4072 17.923 25.3291C18.965 25.3086 19.9959 25.111 20.9716 24.7448C21.8051 24.4214 22.5622 23.9278 23.1944 23.2956C23.8266 22.6634 24.3202 21.9063 24.6436 21.0728C25.0104 20.0966 25.207 19.0673 25.228 18.0228C25.2879 16.6812 25.306 16.2558 25.306 12.8488C25.3033 9.44313 25.3033 9.0108 25.2252 7.67616ZM12.7392 19.2472C9.17737 19.2472 6.29192 16.3618 6.29192 12.8C6.29192 9.23813 9.17737 6.35267 12.7392 6.35267C14.4491 6.35267 16.089 7.03194 17.2981 8.24104C18.5072 9.45014 19.1865 11.09 19.1865 12.8C19.1865 14.5099 18.5072 16.1498 17.2981 17.3589C16.089 18.568 14.4491 19.2472 12.7392 19.2472ZM19.4431 7.61759C19.2456 7.61777 19.05 7.57901 18.8676 7.50352C18.6851 7.42804 18.5193 7.3173 18.3796 7.17766C18.24 7.03802 18.1293 6.87222 18.0538 6.68974C17.9783 6.50725 17.9395 6.31168 17.9397 6.1142C17.9397 5.91686 17.9786 5.72146 18.0541 5.53914C18.1296 5.35683 18.2403 5.19117 18.3798 5.05163C18.5194 4.91209 18.685 4.80141 18.8674 4.72589C19.0497 4.65037 19.2451 4.6115 19.4424 4.6115C19.6397 4.6115 19.8351 4.65037 20.0175 4.72589C20.1998 4.80141 20.3654 4.91209 20.505 5.05163C20.6445 5.19117 20.7552 5.35683 20.8307 5.53914C20.9062 5.72146 20.9451 5.91686 20.9451 6.1142C20.9451 6.94538 20.2729 7.61759 19.4431 7.61759Z"
                                        fill="#2B2B2B" />
                                    <path
                                        d="M12.7393 16.9881C15.0523 16.9881 16.9273 15.1131 16.9273 12.8001C16.9273 10.4871 15.0523 8.61206 12.7393 8.61206C10.4263 8.61206 8.55127 10.4871 8.55127 12.8001C8.55127 15.1131 10.4263 16.9881 12.7393 16.9881Z"
                                        fill="#2B2B2B" />
                                </svg>
                            </a>
                            <a href="https://www.facebook.com/jdpuuz/" target="_blank">
                                <svg width="27" height="27" viewBox="0 0 27 27" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.4339 0.246704C6.22177 0.246704 0.374512 6.09397 0.374512 13.3061C0.374512 19.8233 5.14949 25.2252 11.3938 26.2087V17.0819H8.07639V13.3061H11.3938V10.4288C11.3938 7.15319 13.3438 5.3469 16.3255 5.3469C17.7543 5.3469 19.2511 5.60158 19.2511 5.60158V8.8132H17.6002C15.9807 8.8132 15.4739 9.82148 15.4739 10.8546V13.3035H19.0931L18.5145 17.0793H15.4739V26.2061C21.7183 25.2278 26.4932 19.8246 26.4932 13.3061C26.4932 6.09397 20.646 0.246704 13.4339 0.246704Z"
                                        fill="#2B2B2B" />
                                </svg>
                            </a>
                            <a href="https://twitter.com/jdpuuz" target="_blank">
                                <svg width="28" height="23" viewBox="0 0 28 23" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M24.8985 5.74618C24.9164 5.98772 24.9164 6.22787 24.9164 6.46802C24.9164 13.8175 19.3225 22.2863 9.09956 22.2863C5.94999 22.2863 3.02401 21.374 0.561768 19.7895C1.00895 19.8406 1.43956 19.8585 1.90468 19.8585C4.40694 19.8646 6.83833 19.0278 8.80696 17.4832C7.64681 17.4622 6.52218 17.0795 5.59009 16.3884C4.658 15.6973 3.96499 14.7324 3.60782 13.6284C3.95149 13.6795 4.29653 13.714 4.65814 13.714C5.15638 13.714 5.65739 13.645 6.12251 13.5249C4.86346 13.2707 3.73131 12.5882 2.91859 11.5936C2.10586 10.5989 1.66273 9.35349 1.66453 8.06903V8.00002C2.40569 8.41269 3.26554 8.67078 4.17646 8.70529C3.41334 8.19819 2.78761 7.51009 2.35509 6.70236C1.92257 5.89463 1.69671 4.99241 1.69766 4.07617C1.69766 3.04379 1.97231 2.09699 2.45399 1.27164C3.85093 2.98999 5.59322 4.39576 7.56802 5.39791C9.54283 6.40005 11.7061 6.97622 13.9178 7.0891C13.8322 6.67504 13.7797 6.24581 13.7797 5.81519C13.7794 5.08502 13.9229 4.36194 14.2022 3.68729C14.4814 3.01263 14.8909 2.39963 15.4072 1.88332C15.9235 1.36701 16.5365 0.957528 17.2112 0.678272C17.8859 0.399016 18.6089 0.255467 19.3391 0.25583C20.9401 0.25583 22.3852 0.926597 23.401 2.01142C24.6456 1.77074 25.8391 1.31639 26.9287 0.668503C26.5138 1.9532 25.6448 3.04256 24.4844 3.7325C25.5883 3.6066 26.6671 3.31631 27.6851 2.87127C26.9248 3.97969 25.9826 4.95168 24.8985 5.74618Z"
                                        fill="#2B2B2B" />
                                </svg>
                            </a>
                            <a href="https://www.youtube.com/@jdpuuz" target="_blank">
                                <svg width="28" height="20" viewBox="0 0 28 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M27.3249 3.25048C27.1706 2.67777 26.8689 2.15548 26.45 1.73559C26.031 1.3157 25.5094 1.01285 24.9371 0.857189C22.8148 0.27445 14.3244 0.264964 14.3244 0.264964C14.3244 0.264964 5.83544 0.255477 3.71183 0.812467C3.13984 0.97529 2.6193 1.28242 2.20019 1.70437C1.78109 2.12633 1.47749 2.64893 1.31854 3.22202C0.758841 5.34428 0.75342 9.74598 0.75342 9.74598C0.75342 9.74598 0.747999 14.1694 1.30363 16.2699C1.61533 17.4314 2.5301 18.3488 3.69286 18.6619C5.8368 19.2446 14.3041 19.2541 14.3041 19.2541C14.3041 19.2541 22.7945 19.2636 24.9167 18.708C25.4893 18.5526 26.0114 18.2504 26.4314 17.8314C26.8514 17.4124 27.1547 16.8909 27.3114 16.3187C27.8724 14.1978 27.8765 9.79748 27.8765 9.79748C27.8765 9.79748 27.9036 5.37273 27.3249 3.25048ZM11.6086 13.8238L11.6154 5.69256L18.6719 9.76496L11.6086 13.8238Z"
                                        fill="#2B2B2B" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <form action="" role="search" class="d-block mb-5">
                        <div class="form-row d-flex">
                            <input type="text" name="s" class="form-control"
                                placeholder="Saytdan ma’lumot qidirish...">
                            <button class="btn" type="submit">
                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8 16C9.77498 15.9996 11.4988 15.4054 12.897 14.312L17.293 18.708L18.707 17.294L14.311 12.898C15.405 11.4997 15.9996 9.77544 16 8C16 3.589 12.411 0 8 0C3.589 0 0 3.589 0 8C0 12.411 3.589 16 8 16ZM8 2C11.309 2 14 4.691 14 8C14 11.309 11.309 14 8 14C4.691 14 2 11.309 2 8C2 4.691 4.691 2 8 2Z"
                                        fill="white"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <div class="row mb-5">
                        <div class="col-lg-4 mb-4">
                            <article>
                                <div class="books_body">
                                    <div class="post-title"
                                        style="width:100%; height:70px ; overflow-y:hidden ; text-transform:uppercase">
                                        <a href="{{ $books->getImage() }}">{{ $books->title }}</a>
                                    </div>
                                    <img src="{{ $books->getImage() }}" class="books_image">
                                </div>
                                <div class="books_footer">
                                    <div class="books_date">
                                        <svg width="15" height="17" viewBox="0 0 15 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14.625 14.8334V3.75004C14.625 2.87683 13.9149 2.16671 13.0417 2.16671H11.4583V0.583374H9.875V2.16671H5.125V0.583374H3.54167V2.16671H1.95833C1.08512 2.16671 0.375 2.87683 0.375 3.75004V14.8334C0.375 15.7066 1.08512 16.4167 1.95833 16.4167H13.0417C13.9149 16.4167 14.625 15.7066 14.625 14.8334ZM5.125 13.25H3.54167V11.6667H5.125V13.25ZM5.125 10.0834H3.54167V8.50004H5.125V10.0834ZM8.29167 13.25H6.70833V11.6667H8.29167V13.25ZM8.29167 10.0834H6.70833V8.50004H8.29167V10.0834ZM11.4583 13.25H9.875V11.6667H11.4583V13.25ZM11.4583 10.0834H9.875V8.50004H11.4583V10.0834ZM13.0417 6.12504H1.95833V4.54171H13.0417V6.12504Z"
                                                fill="#285BAD" />
                                        </svg> {{ $books->b_published_year }}
                                    </div>
                                    <div class="books_info"> <span class="me-3">
                                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.8333 5.5H9.50001V0.5H4.50001V5.5H1.16668L7.00001 12.1667L12.8333 5.5ZM0.333344 13.8333H13.6667V15.5H0.333344V13.8333Z"
                                                    fill="#285BAD" />
                                            </svg>
                                            {{ $books->download_count }}</span> <span>
                                            <svg width="18" height="12" viewBox="0 0 18 12" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M9 7.25C9.69036 7.25 10.25 6.69036 10.25 6C10.25 5.30964 9.69036 4.75 9 4.75C8.30964 4.75 7.75 5.30964 7.75 6C7.75 6.69036 8.30964 7.25 9 7.25Z"
                                                    fill="#285BAD" />
                                                <path
                                                    d="M17.225 5.58331C16.6917 4.65831 13.7583 0.016641 8.77501 0.166641C4.16667 0.283308 1.50001 4.33331 0.775006 5.58331C0.701866 5.70999 0.663361 5.85369 0.663361 5.99997C0.663361 6.14626 0.701866 6.28996 0.775006 6.41664C1.30001 7.32497 4.10834 11.8333 9.01667 11.8333H9.22501C13.8333 11.7166 16.5083 7.66664 17.225 6.41664C17.2981 6.28996 17.3367 6.14626 17.3367 5.99997C17.3367 5.85369 17.2981 5.70999 17.225 5.58331ZM9.00001 8.91664C8.42314 8.91664 7.85924 8.74558 7.37959 8.42509C6.89995 8.10461 6.52611 7.64909 6.30536 7.11613C6.0846 6.58318 6.02684 5.99674 6.13938 5.43096C6.25192 4.86518 6.52971 4.34548 6.93761 3.93758C7.34551 3.52968 7.86521 3.25189 8.43099 3.13935C8.99677 3.02681 9.58322 3.08457 10.1162 3.30533C10.6491 3.52608 11.1046 3.89992 11.4251 4.37956C11.7456 4.8592 11.9167 5.42311 11.9167 5.99997C11.9167 6.77352 11.6094 7.51539 11.0624 8.06237C10.5154 8.60935 9.77355 8.91664 9.00001 8.91664Z"
                                                    fill="#285BAD" />
                                            </svg>
                                            {{ $books->view_count }}</span></div>
                                </div>
                            </article>
                        </div>
                        <div class="col-lg-8 d-flex flex-wrap align-content-around">
                            <div class="block col-12">
                                <p><span class="fw-bold">ISBN:</span>{{ $books->isbn }}</p>
                                <p><span class="fw-bold">Muallif:</span>{{ $books->muallif->name }}</p>
                                <p><span class="fw-bold">Til:</span>{{ $books->lang->name }}</p>
                                <p><span class="fw-bold">Yozuv:</span>{{ $books->read_lang() }}</p>
                                <p><span class="fw-bold">Resurs turi:</span>Darslik</p>
                                <p><span class="fw-bold">Betlar soni:</span>{{ $books->b_page_count }}</p>
                                <p><span class="fw-bold">Adadi:</span>{{ $books->b_publishing }}</p>
                                <p><span class="fw-bold">Nashriyot:</span> {{ $books->publishing->name }}</p>
                                <p><span class="fw-bold">Nashr yili:</span> {{ $books->b_published_year }}</p>
                                <p><span class="fw-bold">Kurs:</span>
                                    @foreach ($books->bookCourses as $course)
                                        {{ $course->course_id }} kurs,
                                    @endforeach
                                </p>
                                <p><span class="fw-bold">Kafedra:</span>
                                    @foreach ($books->bookDepartments as $department)
                                        @foreach ($cateOptions as $dep)
                                            @if ($dep['id'] == $department['department_id'])
                                                {{ $dep['title'] }} <br />
                                            @endif
                                        @endforeach
                                    @endforeach
                                </p>
                            </div>
                            <div class="post_buttons col-12">
                                @if (Auth::guard('students')->check() || Auth::guard('employees')->check())

                                    <!-- <div class="btn btn-primary ">
                                        <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.8333 5.5H9.49992V0.5H4.49992V5.5H1.16659L6.99992 12.1667L12.8333 5.5ZM0.333252 13.8333H13.6666V15.5H0.333252V13.8333Z"
                                                fill="white" />
                                        </svg>
                                        <a href="{{ route('pdf.viewer', $books->id) }}" target="_blank">Yuklab olish</a>
                                    </div> -->

                                    <div class="btn btn-secondary ">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11 12.375C11.7594 12.375 12.375 11.7594 12.375 11C12.375 10.2406 11.7594 9.625 11 9.625C10.2406 9.625 9.625 10.2406 9.625 11C9.625 11.7594 10.2406 12.375 11 12.375Z"
                                                fill="#2B2B2B" />
                                            <path
                                                d="M20.0474 10.5417C19.4607 9.52417 16.2341 4.41833 10.7524 4.58333C5.68323 4.71167 2.7499 9.16667 1.9524 10.5417C1.87195 10.681 1.82959 10.8391 1.82959 11C1.82959 11.1609 1.87195 11.319 1.9524 11.4583C2.5299 12.4575 5.61907 17.4167 11.0182 17.4167H11.2474C16.3166 17.2883 19.2591 12.8333 20.0474 11.4583C20.1279 11.319 20.1702 11.1609 20.1702 11C20.1702 10.8391 20.1279 10.681 20.0474 10.5417ZM10.9999 14.2083C10.3654 14.2083 9.74505 14.0202 9.21745 13.6676C8.68984 13.3151 8.27862 12.814 8.03579 12.2278C7.79296 11.6415 7.72942 10.9964 7.85321 10.3741C7.97701 9.75173 8.28257 9.18006 8.73127 8.73137C9.17996 8.28267 9.75163 7.97711 10.374 7.85331C10.9963 7.72952 11.6414 7.79305 12.2277 8.03589C12.8139 8.27872 13.315 8.68994 13.6675 9.21754C14.0201 9.74515 14.2082 10.3655 14.2082 11C14.2082 11.8509 13.8702 12.667 13.2685 13.2686C12.6669 13.8703 11.8508 14.2083 10.9999 14.2083Z"
                                                fill="#2B2B2B" />
                                        </svg>
                                        <a href="{{ route('pdf.viewer-manual', $books->id) }}">Online o’qish</a>
                                    </div>
                                @else

                                    <!-- <div style="background-color: gray; border-color: gray" class="btn btn-primary ">
                                        <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.8333 5.5H9.49992V0.5H4.49992V5.5H1.16659L6.99992 12.1667L12.8333 5.5ZM0.333252 13.8333H13.6666V15.5H0.333252V13.8333Z"
                                                fill="white" />
                                        </svg>
                                        <a href="#" target="_blank">Yuklab olish</a>
                                    </div>

                                    <div style="background-color: gray; border-color: gray" class="btn btn-secondary ">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11 12.375C11.7594 12.375 12.375 11.7594 12.375 11C12.375 10.2406 11.7594 9.625 11 9.625C10.2406 9.625 9.625 10.2406 9.625 11C9.625 11.7594 10.2406 12.375 11 12.375Z"
                                                fill="#2B2B2B" />
                                            <path
                                                d="M20.0474 10.5417C19.4607 9.52417 16.2341 4.41833 10.7524 4.58333C5.68323 4.71167 2.7499 9.16667 1.9524 10.5417C1.87195 10.681 1.82959 10.8391 1.82959 11C1.82959 11.1609 1.87195 11.319 1.9524 11.4583C2.5299 12.4575 5.61907 17.4167 11.0182 17.4167H11.2474C16.3166 17.2883 19.2591 12.8333 20.0474 11.4583C20.1279 11.319 20.1702 11.1609 20.1702 11C20.1702 10.8391 20.1279 10.681 20.0474 10.5417ZM10.9999 14.2083C10.3654 14.2083 9.74505 14.0202 9.21745 13.6676C8.68984 13.3151 8.27862 12.814 8.03579 12.2278C7.79296 11.6415 7.72942 10.9964 7.85321 10.3741C7.97701 9.75173 8.28257 9.18006 8.73127 8.73137C9.17996 8.28267 9.75163 7.97711 10.374 7.85331C10.9963 7.72952 11.6414 7.79305 12.2277 8.03589C12.8139 8.27872 13.315 8.68994 13.6675 9.21754C14.0201 9.74515 14.2082 10.3655 14.2082 11C14.2082 11.8509 13.8702 12.667 13.2685 13.2686C12.6669 13.8703 11.8508 14.2083 10.9999 14.2083Z"
                                                fill="#2B2B2B" />
                                        </svg>
                                        <a data-toggle="tooltip" data-placement="top" href="{{ route('pdf.viewer', $books->id) }}"
                                            title="Onlayn o'qish uchun tizimga kiring">Online o’qish</a>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="post_desc">
                            <h5>Kitob tavsifi</h5>
                            <p> {{ $books->desc }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('.main-nav__drop-parent').on('click', function() {
                var dh = $(this).parent('.main-nav__drop-holder');
                dh.toggleClass('main-nav__drop-active');
                //$('body').append('<div id="hide"></div>');
            });
        });
    </script>
@endsection
