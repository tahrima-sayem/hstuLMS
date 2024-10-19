<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Distribution;

class DistributionController extends Controller
{
    public function gotoDistributeCoursePage()
    {
        $courses = Course::all();
        $teachers = Teacher::all();
        //dd($teachers);
        return view('teachers.distribution.distributeCoursePage' , [
            'courses' => $courses,
            'teachers' => $teachers,
        ]);
    }

    public function distributeCourse(Request $request)
    {
        $request->validate([
            'course' => 'required',
            'teacher' => 'required',
            'session' => 'required',
        ]);
    
        try {
            // Check if the distribution already exists
            $existingDistribution = Distribution::where('course_id', $request->course)
                                                ->where('session', $request->session)
                                                ->first();
            
            // Retrieve the course code from the Course model
            $course = Course::find($request->course);
            if ($existingDistribution) {
                // Update the existing distribution with the new teacher
                $existingDistribution->update([
                    'teacher_id' => $request->teacher,
                ]);
    
                return redirect()->back()->with('success', "{$course->name} has been updated for session {$request->session}!");
            }else {

                // Create a new distribution if it doesn't exist
                Distribution::create([
                    'course_id' => $request->course,
                    'teacher_id' => $request->teacher,
                    'session' => $request->session,
                ]);
    
                // Use the course code in the success message
                return redirect()->back()->with('success', "{$course->name} has been distributed successfully!");
            }
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
