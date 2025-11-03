<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Books;
use App\Models\BooksLessonAndManual;
use App\Models\CategoriesBooks;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function library(Request $request)
     {

         $books = Books::with('Category')->paginate(10);
         $manuals = BooksLessonAndManual::with('Category')->paginate(10);

             // 2. Ma'lumotlarni birlashtirish
        $allBooks = $books->merge($manuals);

         return response()->json($allBooks);
     }

     public function viewbook($id)
     {
         // 1. `books` jadvalidan kitobni qidirish
         $book = Books::with('category')->where('id', $id)->first();

         // 2. `books_lesson_and_manual` jadvalidan kitobni qidirish
         $manual = BooksLessonAndManual::with('category')->where('id', $id)->first();

         // 3. Ikkisini tekshirib, ma'lumotni birlashtirish
         if ($book && $manual) {
             $mergedBook = collect([$book, $manual]); // Agar har ikkala jadvalda mavjud bo'lsa, kolleksiya sifatida birlashtiramiz
         } elseif ($book) {
             $mergedBook = $book; // Faqat `books` jadvalida mavjud bo'lsa
         } elseif ($manual) {
             $mergedBook = $manual; // Faqat `books_lesson_and_manual` jadvalida mavjud bo'lsa
         } else {
             return response()->json(['message' => 'Book not found'], 404);
         }

         // 4. Ma'lumotni JSON formatida qaytarish
         return response()->json($mergedBook);
     }



    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
