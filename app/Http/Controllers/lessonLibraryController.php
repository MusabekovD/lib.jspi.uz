<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\KitobBuyurtma;
use App\Models\Books;
use App\Models\BooksLessonAndManual;
use App\Models\CategoriesBooks;
use App\Models\Department;
use App\Models\EducationYears;
use App\Models\LikeBooks;
use App\Models\Members;
use App\Models\MenuFrontend;
use App\Models\Science;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class lessonLibraryController extends Controller
{
    public function library(Request $request, $id = null)
    {
        $categories = Department::all();
        $eduYears = EducationYears::orderBy('code')->pluck('name','id');
        $libSubject = Science::withCount('books')->get();

        $subCategory = CategoriesBooks::where('sts', 1)->whereIn('id', [40, 41])->pluck('name', 'id');


        $query = BooksLessonAndManual::query();
        if ($id) {
            $query->whereHas('bookDepartments', function ($query) use ($id) {
                $query->where('department_id', $id);
            });
            $libSubject = Science::where('department_id', $id)->withCount('books')->get();

        }
        if ($request->filled('course') && $request->filled('category') && $request->filled('year') && $request->filled('subject')) {
            $query->whereHas('bookCourses', function ($query) use ($request) {
                $query->where('course_id', $request->course);
            })->where('category_id', $request->category)->where('education_years', $request->year)->where('lib_subject', $request->subject);
        }
        else {
            if ($request->filled('course')) {
                $query->whereHas('bookCourses', function ($query) use ($request) {
                    $query->where('course_id', $request->course);
                });
            }
            if ($request->filled('category')) {
                $query->where('category_id', $request->category);
            }
            if ($request->filled('year')) {
                $query->where('education_years', $request->year);
            }
            if ($request->filled('subject')) {
                $query->where('lib_subject', $request->subject);
            }
        }

        $books = $query->paginate(9);

        return view('library.lesson.newindex', compact('categories', 'eduYears', 'subCategory', 'books', 'libSubject','id'))
            ->with('pagination', $books->render());
    }
    public function statistic($id)
    {
        $sciences = Science::with(['department', 'books' => function ($query) use ($id) {
            $query->where('category_id', $id);
        }])
            ->withCount(['books as books_count' => function ($query) use ($id) {
                $query->where('category_id', $id);
            }])
            ->orderByRaw('books_count = 0, books_count DESC')
            ->get();

        $departments = $sciences->groupBy(function ($science) {
            return $science->department->name;
        });

        $result = [];
        foreach ($departments as $departmentName => $departmentSciences) {
            $booksCountSum = $departmentSciences->sum('books_count');
            $result[$departmentName] = [
                'total_books_count' => $booksCountSum,
                $departmentSciences
            ];
        }

        return $result;
    }

    public function viewbook($id)
    {
        $books = BooksLessonAndManual::findOrFail($id);
        $viewedPosts = session()->get('viewed_posts', []);
//        return $viewedPosts;
        if (!in_array($id, $viewedPosts)) {
            $books->view_count = $books->view_count + 1;
            $books->save();
            $viewedPosts[] = $id;
            session()->put('viewed_posts', $viewedPosts);
        }
        $categories = Department::all();

        return view('library.lesson.newview', compact('categories', 'books','id'));
    }

    public function download($id)
    {
        $books = BooksLessonAndManual::findOrFail($id);
        $books->download_count = $books->download_count + 1;
        $books->save();
        return response()->file($books->getFile());
    }


    public function searchContent(Request $request)
    {
        $query = $request->input('q');

        $books = BooksLessonAndManual::where('title', 'like', '%' . $query . '%')
            ->orWhere('desc', 'like', '%' . $query . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        $categories = Department::all();
        return view('frontend.search', compact('books', 'categories'));

    }
}
