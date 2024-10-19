<?php

namespace App\Http\Controllers;

use App\Models\SpecialRole;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Role;
use \Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->get('email'))->first();

        if ($user == null) {
            return redirect()->back()->with('error', 'Email does not exist'); 
        }

        if (!Hash::check($request->get('password'), $user->password)) {
            return redirect()->back()->with('error', 'Wrong Password');
        }

        Session::put('curr_user', $user);

        $user_role_id = $user->role_id;
        $user_id = $user->id;
        $user_role_name = Role::where('id', $user_role_id)->first()->title;

        Session::put('user_role', $user_role_name);
        Session::put('user_id', $user_id);
       

        if ($user_role_name == 'teacher') {
            //dd($user_role_name);
            $teacher = Teacher::where('user_id', $user_id)->first();
            session(['teacher_id' => $teacher->id]);
            return redirect()->route('gotoTeacherDashboard');
        }
        if ($user_role_name == 'student') {
            $student = Student::where('user_id', $user_id)->first();
            session(['student_id' => $student->id]);
            return redirect()->route('gotoStudentDashboard');
        }
        if ($user_role_name == 'admin') {
            return redirect()->route('gotoAdminDashboard');
        }

        return redirect('/')->with('error', 'You do not have access to this page.');
        
    }

    public function logout()
    {
        \Illuminate\Support\Facades\Session::forget('curr_user');
        \Illuminate\Support\Facades\Session::forget('user_role');
        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
