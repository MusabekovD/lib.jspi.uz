<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use League\OAuth2\Client\Provider\GenericProvider;

class HemisAuthController extends Controller
{
    public function index(Request $request)
    {
        $base_url = env('APP_URL');
        session_start();

        $employeeProvider = new GenericProvider([
            'clientId' => env('AUTH_HEMIS_ID'),
            'clientSecret' => env('AUTH_HEMIS_KEY'),
            'redirectUri' => $base_url . '/hemis/student',
            'urlAuthorize' => 'https://student.jdpu.uz/oauth/authorize',
            'urlAccessToken' => 'https://student.jdpu.uz/oauth/access-token',
            'urlResourceOwnerDetails' => 'https://student.jdpu.uz/oauth/api/user?fields=id,uuid,type,name,login,picture,email,university_id,phone'
        ]);


        $guzzyClient = new \GuzzleHttp\Client([
            'defaults' => [
                \GuzzleHttp\RequestOptions::CONNECT_TIMEOUT => 5,
                \GuzzleHttp\RequestOptions::ALLOW_REDIRECTS => true
            ],
            \GuzzleHttp\RequestOptions::VERIFY => false,
        ]);

        $employeeProvider->setHttpClient($guzzyClient);

        if (!isset($_GET['code'])) {
            $authorizationUrl = $employeeProvider->getAuthorizationUrl();
            // Get the state generated for you and store it to the session.
            $_SESSION['oauth2state'] = $employeeProvider->getState();
            // Redirect the user to the authorization URL.
            header('Location: ' . $authorizationUrl);

            exit;
        } else {
            try {
                $accessToken = $employeeProvider->getAccessToken('authorization_code', [
                    'code' => $_GET['code']
                ]);
                // resource owner.
                $resourceOwner = $employeeProvider->getResourceOwner($accessToken);
                $d = $resourceOwner->toArray();
                // dd($d );
                // Assuming $d contains student data from OAuth2 provider
                if (!empty($d['student_id_number'])) {
                    // Check if student exists
                    $student = Student::where(['student_id_number' => $d['student_id_number']])->first();

                    if ($student) {
                        $student->name = $d['name'];
                        $student->save();
                        // Student exists, attempt to login
                        Auth::guard('students')->loginUsingId($student->id);

                        // Regenerate session and redirect
                        $request->session()->regenerate();
                        return redirect()->intended('/library_manual'); // Replace '/dashboard' with your intended redirect path
                    } else {
                        // dd( $student);
                        // Student does not exist, create new student
                        $newStudent = Student::firstOrCreate(
                            [
                                'student_id_number' => $d['student_id_number'],
                            ],
                            [
                                'name' => $d['name'],
                                'password' => Hash::make($d['student_id_number']), // Hash the student_id_number as password
                            ]
                        );

                        // Login the newly created student

                        Auth::guard('students')->login($newStudent);

                        // Regenerate session and redirect
                        $request->session()->regenerate();
                        return redirect()->intended('/library_manual'); // Replace '/dashboard' with your intended redirect path
                    }
                } else {
                    // dd('student id yoq');
                    // Handle case where student_id_number is empty
                    return redirect('/')->withInput()->withErrors([
                        'username' => "Student ID not found in response",
                    ]);
                }
            } catch (\Exception $e) {
                // Handle exceptions (e.g., OAuth2 errors)
                // dd($e); // For debugging
                return redirect('/')->withInput()->withErrors([
                    'username' => "Failed to authenticate student",
                ]);
            }
        }
    }



    public function employee(Request $request)
    {
        $base_url = env('APP_URL');
        session_start();

        $employeeProvider = new GenericProvider([
            'clientId' => env('AUTH_HEMIS_ID'),
            'clientSecret' => env('AUTH_HEMIS_KEY'),
            'redirectUri' => $base_url . '/hemis/employee',
            'urlAuthorize' => 'https://hemis.jdpu.uz/oauth/authorize',
            'urlAccessToken' => 'https://hemis.jdpu.uz/oauth/access-token',
            'urlResourceOwnerDetails' => 'https://hemis.jdpu.uz/oauth/api/user?fields=id,uuid,type,name,login,picture,email,university_id,phone'
        ]);


        $guzzyClient = new \GuzzleHttp\Client([
            'defaults' => [
                \GuzzleHttp\RequestOptions::CONNECT_TIMEOUT => 5,
                \GuzzleHttp\RequestOptions::ALLOW_REDIRECTS => true
            ],
            \GuzzleHttp\RequestOptions::VERIFY => false,
        ]);

        $employeeProvider->setHttpClient($guzzyClient);

        if (!isset($_GET['code'])) {
            $authorizationUrl = $employeeProvider->getAuthorizationUrl();
            // Get the state generated for you and store it to the session.
            $_SESSION['oauth2state'] = $employeeProvider->getState();
            // Redirect the user to the authorization URL.
            header('Location: ' . $authorizationUrl);

            exit;
        } else {
            try {
                $accessToken = $employeeProvider->getAccessToken('authorization_code', [
                    'code' => $_GET['code']
                ]);
                // resource owner.
                $resourceOwner = $employeeProvider->getResourceOwner($accessToken);
                $d = $resourceOwner->toArray();
                // dd($d );
                // Assuming $d contains student data from OAuth2 provider
                if (!empty($d['employee_id_number'])) {
                    // Check if student exists
                    $employee = Employee::where(['employee_id_number' => $d['employee_id_number']])->first();

                    if ($employee) {
                        $employee->name = $d['name'];
                        $employee->save();
                        // Student exists, attempt to login
                        Auth::guard('employees')->loginUsingId($employee->id);

                        // Regenerate session and redirect
                        $request->session()->regenerate();
                        return redirect()->intended('/library_manual'); // Replace '/dashboard' with your intended redirect path
                    } else {
                        // dd( $student);
                        // Student does not exist, create new student
                        $newStudent = Employee::firstOrCreate(
                            [
                                'employee_id_number' => $d['employee_id_number'],
                            ],
                            [
                                'name' => $d['name'],
                                'password' => Hash::make($d['employee_id_number']), // Hash the employee_id_number as password
                            ]
                        );

                        // Login the newly created student

                        Auth::guard('employees')->login($newStudent);

                        // Regenerate session and redirect
                        $request->session()->regenerate();
                        return redirect()->intended('/library_manual'); // Replace '/dashboard' with your intended redirect path
                    }
                } else {
                    // dd('student id yoq');
                    // Handle case where employee_id_number is empty
                    return redirect('/')->withInput()->withErrors([
                        'username' => "Student ID not found in response",
                    ]);
                }
            } catch (\Exception $e) {
                // Handle exceptions (e.g., OAuth2 errors)
                // dd($e); // For debugging
                return redirect('/')->withInput()->withErrors([
                    'username' => "Failed to authenticate student",
                ]);
            }
        }
    }
}
