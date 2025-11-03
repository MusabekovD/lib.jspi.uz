<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Science;

class ScienceController extends Controller
{
    public function getSciencesByDepartments(Request $request)
    {
        $departmentIds = $request->get('q');
        if (is_array($departmentIds) && !empty($departmentIds)) {
            $sciences = Science::whereIn('department_id', $departmentIds)->pluck('name', 'id');
            return response()->json($sciences);
        }
        return response()->json([]);
    }
}
