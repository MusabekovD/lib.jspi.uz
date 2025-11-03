<?php

namespace App\Admin\Controllers;

use App\Models\Authors;
use App\Models\Publishing;
use App\Models\Science;
use Encore\Admin\Controllers\AdminController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends AdminController
{
    public function authors(Request $request)
    {
        $q = $request->get('q');

        return Authors::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    public function publishings(Request $request)
    {
        $q = $request->get('q');

        return Publishing::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }
    public function getSciencesByDepartments(Request $request)
    {
        $departmentIds = $request->get('q');
        if (!empty($departmentIds)) {
            return Science::where('department_id', $departmentIds)->get(['id', 'name as text']);
        }
        return response()->json([]);
    }
}
