<?php

namespace App\Helpers;

use App\Models\BooksLessonAndManual;

class CalculateCountHelper
{
    public static function calculateCount(int $departmentId, int $CoursePK = null)
    {
        if ($CoursePK != null) {
            return BooksLessonAndManual::whereHas('bookDepartments', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            })->whereHas('bookCourses', function ($query) use ($CoursePK) {
                $query->where('course_id', $CoursePK);
            })->count();
        } else {
            return BooksLessonAndManual::whereHas('bookDepartments', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            })->count();
        }
    }
}
