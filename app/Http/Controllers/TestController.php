<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\MyTests;
use App\Students;

class TestController extends Controller
{


    public function userTest($user_id, $mytest_id)
    {
        $myTest = MyTests::where(['user_id' => $user_id, 'id' => $mytest_id])->first();
        if (empty($myTest)) return "OOPS";
        return view('test.results', compact('myTest'));
    }
}
