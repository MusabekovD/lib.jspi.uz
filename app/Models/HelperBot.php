<?php

namespace App\Models;

use App\Models\Books;
use App\Models\SearchKeywords;
use App\Models\MyBooks;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class HelperBot
{


    public static function generatePaginate($pageNumber = 1, $params_where = [], $title = "", $callback_query)
    {

        $books = Books::where($params_where)->paginate(8,  ['*'], 'page', $pageNumber);

        $text = "<b>" . $title . "</b>" . PHP_EOL;
        $show_count = $books->currentPage() == 1 ? count($books->items()) : (($books->currentPage() - 1) * 8) + count($books->items());
        $start_count = $books->currentPage() == 1 ? "1" : (($books->currentPage() - 1) * 8) + 1;
        $text .= "<b> {$books->total()} dan " . $start_count . "-" . $show_count  . " natija</b>" . PHP_EOL;
        $rows = [];
        $PerPageRow = [];

        foreach ($books->items() as $key => $itemBook) {
            $text .= (++$key) . '. ' . $itemBook['title'] . PHP_EOL;
            $PerPageRow[] = ['text' => $key, 'callback_data' => "book_" . $itemBook['id']];
        }
        if (count($books->items()) == 0) {
            return ['keyboard' => [], 'text' => $text . "Ma'lumot topilmadi"];
        }
        $bulish = count($PerPageRow) % 2 == 0 ? count($PerPageRow) / 2 : 5;
        $keyboard_items = array_chunk($PerPageRow, $bulish);
        foreach ($keyboard_items as  $k_item) {
            $rows[] = $k_item;
        }
        $next_page = $books->currentPage() + 1;
        $prev_page = $books->currentPage() - 1;

        if ($books->lastPage() != 1) {
            $navigation = [];

            if ($books->currentPage() > 1) {
                $navigation[] = ['text' => "⬅️", 'callback_data' => $callback_query . $prev_page];
            }
            if ($books->hasMorePages()) {
                $navigation[] = ['text' => "➡️", 'callback_data' => $callback_query . $next_page];
            }
            $rows[] = $navigation;
        }

        return ['keyboard' => $rows, 'text' => $text];
    }


    public static function generatePaginateSearch($pageNumber = 1,  $searchKey = "", $callback_query)
    {
        if ($searchKey == null || strlen($searchKey) < 3) return ['keyboard' => [], 'text' => "Kamida 3 ta harf kiriting!"];
        $search =  SearchKeywords::updateOrCreate(
            [
                'keyword' => $searchKey
            ]
        );
        $search->count_using = $search->count_using + 1;
        $search->save();
        $books = Books::where('title', 'like', '%' . $searchKey . '%')->paginate(8,  ['*'], 'page', $pageNumber);
        $text = "<b>" . $searchKey . "</b>" . PHP_EOL;
        $show_count = $books->currentPage() == 1 ? count($books->items()) : (($books->currentPage() - 1) * 8) + count($books->items());
        $start_count = $books->currentPage() == 1 ? "1" : (($books->currentPage() - 1) * 8) + 1;
        $text .= "<b> {$books->total()} ta natijadan " . $start_count . " - " . $show_count  . " </b>" . PHP_EOL;
        $rows = [];
        $PerPageRow = [];

        foreach ($books->items() as $key => $itemBook) {
            $text .= "<b>" . (++$key) . "</b>. " . $itemBook['title'] . PHP_EOL;
            $PerPageRow[] = ['text' => $key, 'callback_data' => "book_" . $itemBook['id']];
        }
        if (count($books->items()) == 0) {
            return ['keyboard' => [], 'text' => $text . "Ma'lumot topilmadi"];
        }
        $bulish = count($PerPageRow) % 2 == 0 ? count($PerPageRow) / 2 : 5;
        if (count($PerPageRow) > 2) {
            $keyboard_items =  array_chunk($PerPageRow, $bulish);
            foreach ($keyboard_items as  $k_item) {
                $rows[] = $k_item;
            }
        } else {
            $rows[] = $PerPageRow;
        }

        $next_page = $books->currentPage() + 1;
        $prev_page = $books->currentPage() - 1;
        $navigation = [];

        if ($books->currentPage() > 1) {
            $navigation[] = ['text' => "⬅️", 'callback_data' => $callback_query . $prev_page];
        }
        if ($books->hasMorePages()) {
            $navigation[] = ['text' => "➡️", 'callback_data' => $callback_query . $next_page];
        }
        if (count($navigation) > 0) $rows[] = $navigation;

        return ['keyboard' => $rows, 'text' => $text];
    }

    public static function generatePaginateLibs($pageNumber = 1,  $user_id, $callback_query)
    {
        $books = MyBooks::where('members_id', $user_id)->paginate(8,  ['*'], 'page', $pageNumber);
        $text = "<b>Mening kutubxonam</b>" . PHP_EOL;
        $show_count = $books->currentPage() == 1 ? count($books->items()) : (($books->currentPage() - 1) * 8) + count($books->items());
        $start_count = $books->currentPage() == 1 ? "1" : (($books->currentPage() - 1) * 8) + 1;
        $text .= "<b> {$books->total()} ta natijadan " . $start_count . " - " . $show_count  . " </b>" . PHP_EOL;
        $rows = [];
        $PerPageRow = [];

        foreach ($books->items() as $key => $itemBook) {

            $text .= "<b>" . (++$key) . "</b>. " . $itemBook->book->title . PHP_EOL;
            $PerPageRow[] = ['text' => $key, 'callback_data' => "book_" . $itemBook->book->id];
        }
        if (count($books->items()) == 0) {
            return ['keyboard' => [], 'text' => $text . "Ma'lumot topilmadi"];
        }
        $bulish = count($PerPageRow) % 2 == 0 ? count($PerPageRow) / 2 : 5;
        if (count($PerPageRow) > 2) {
            $keyboard_items =  array_chunk($PerPageRow, $bulish);
            foreach ($keyboard_items as  $k_item) {
                $rows[] = $k_item;
            }
        } else {
            $rows[] = $PerPageRow;
        }

        $next_page = $books->currentPage() + 1;
        $prev_page = $books->currentPage() - 1;
        $navigation = [];

        if ($books->currentPage() > 1) {
            $navigation[] = ['text' => "⬅️", 'callback_data' => $callback_query . $prev_page];
        }
        if ($books->hasMorePages()) {
            $navigation[] = ['text' => "➡️", 'callback_data' => $callback_query . $next_page];
        }
        if (count($navigation) > 0) $rows[] = $navigation;
        return ['keyboard' => $rows, 'text' => $text];
    }
}