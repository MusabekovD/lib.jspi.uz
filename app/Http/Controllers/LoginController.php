<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        // dd(Auth::guard('employees')->user());
        return view('frontend.login');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'student_id_number' => 'required',
            'password' => 'required',
        ], [
            'student_id_number' => 'Student ID kiritilmagan',
            'password' => 'Parol kiritilmagan',
        ]);

        try {
            // Find the student based on student_id_number
            $student = Student::where('student_id_number', $request->student_id_number)->first();

            if ($student) {
                // Attempt to log in the student
                Auth::guard('students')->loginUsingId($student->id);

                // Regenerate session and redirect
                $request->session()->regenerate();
                return redirect()->intended('/library_manual'); // Redirect to intended URL after login
            } else {
                // Handle case where student is not found
                return redirect()->back()->with('error', 'Talaba malumotlari topilmadi');
            }
        } catch (Exception $e) {
            // Handle any exceptions
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function logout(Request $request)
    {

        if (Auth::guard() ==  'students') {
            Auth::guard('students')->logout(); // Logout the user
        } else {
            Auth::guard('employees')->logout();
        }

        $request->session()->invalidate(); // Invalidate the session

        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/'); // Redirect to the desired page after logout
    }


    public function logoutemployee(Request $request)
    {
        Auth::guard('employees')->logout(); // Logout the user

        $request->session()->invalidate(); // Invalidate the session

        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/'); // Redirect to the desired page after logout
    }



    public function employee(Request $request)
    {
        $validate = $request->validate([
            'employee_id_number' => 'required',
            'password' => 'required',
        ], [
            'employee_id_number' => 'Xodim ID kiritilmagan',
            'password' => 'Parol kiritilmagan',
        ]);

        try {
            // Find the student based on employee_id_number
            $employee = Employee::where('employee_id_number', $request->employee_id_number)->first();

            if ($employee) {
                // Attempt to log in the employee
                Auth::guard('employees')->loginUsingId($employee->id);

                // Regenerate session and redirect
                $request->session()->regenerate();
                return redirect()->intended('/library_manual'); // Redirect to intended URL after login
            } else {
                // Handle case where employee is not found
                return redirect()->back()->with('error', 'Xodim malumotlari topilmadi');
            }
        } catch (Exception $e) {
            // Handle any exceptions
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
