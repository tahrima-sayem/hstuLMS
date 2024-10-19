<?php



namespace App\Http\Controllers;
use App\Models\Labwork;
use Illuminate\Http\Request;
use App\Models\CourseTaken;
use App\Models\SolutionAssignment;
use App\Models\Distribution;
use App\Models\Attendance;
use App\Models\Assignment;
use App\Models\Exam;
use App\Models\Result;
use App\Models\Material;
use Illuminate\Support\Facades\DB;



class StudentPartController extends Controller
{
    public function gotoStudentYourCourses()
    {
        $studentId = session('student_id');

        $courses = CourseTaken::where('student_id', $studentId)
            ->join('courses', 'course_taken.course_id', '=', 'courses.id')
            ->select(
                'courses.id AS course_id',
                'courses.code',
                'courses.name',
                'courses.level',
                'courses.semester',
                'courses.credit_hour',
                'courses.type',
                'courses.degree_id'
            )
            ->get();

        return view('students.studentCourses', compact('courses'));
    }

    public function gotoStudentCourseDetail($course_id)
    {
        $distributions = Distribution::where('course_id', $course_id)
            ->with('course')
            ->get();

        return view('students.studentCourseDetail', compact('distributions'));
    }

    public function gotoStudentCourseAttendance($course_id)
    {
        $studentId = session('student_id'); // Get the student ID from the session

        // Fetch the class distributions and attendance records
        $distributions = Distribution::where('course_id', $course_id)
            ->with('course')
            ->get();

        $studentId = session('student_id');
        // Fetch attendance records for the student in the specified course
        $attendances = Attendance::join('classes', 'attendence.class_id', '=', 'classes.id')
            ->where('attendence.student_id', $studentId)
            ->where('classes.course_id', $course_id)
            ->select('classes.date', 'attendence.attendance_status')
            ->get();

        $averageAttendance = DB::table('classes as c')
            ->leftJoin('attendence as a', 'c.id', '=', 'a.class_id')
            ->where('a.student_id', $studentId)
            ->where('c.course_id', $course_id)
            ->select(DB::raw('(SUM(CASE WHEN a.attendance_status = 1 THEN 1 ELSE 0 END) / COUNT(c.id)) * 100 AS average_attendance_percentage'))
            ->first();

        // Get the attendance percentage, default to 0 if null
        $attendancePercentage = $averageAttendance->average_attendance_percentage ?? 0;

        return view('students.studentCourseAttendance', compact('distributions', 'attendances', 'averageAttendance', 'attendancePercentage'));
    }

    public function gotoStudentSubmitAssignment($assignment_id)
    {
        $assignment = Assignment::select('id', 'title', 'description', 'course_id')
            ->where('id', $assignment_id)
            ->first();

        $course_id = $assignment->course_id;

        $distributions = Distribution::where('course_id', $course_id)
            ->with('course')
            ->get();
        return view('students.studentCourseAssignmentSubmit', compact('assignment', 'distributions'));
    }
    public function submitAssignment(Request $request, $assignment_id)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,zip|max:2048', // Validate the uploaded file
        ]);

        // Get the current student's ID
        $studentId = session('student_id');

        // Retrieve the assignment and course_id
        $assignment = Assignment::find($assignment_id);
        $course_id = $assignment->course_id;

        // Store the uploaded file
        $filePath = $request->file('file')->store('assignments/solutions', 'public'); // Save in storage/app/public/assignments/solutions

        // Save the data to the solution_assignment table
        SolutionAssignment::create([
            'student_id' => $studentId,
            'assignment_id' => $assignment_id,
            'course_id' => $course_id,
            'file' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Assignment submitted successfully!');
    }

    public function gotoStudentSubmitLabwork($labwork_id)
    {
        $labwork = Labwork::select('id', 'title', 'description', 'course_id')
            ->where('id', $labwork_id)
            ->first();

        $course_id = $labwork->course_id;

        $distributions = Distribution::where('course_id', $course_id)
            ->with('course')
            ->get();
        return view('students.studentCourseLabworkSubmit', compact('labwork', 'distributions'));
    }
    public function submitLabwork(Request $request, $labwork_id)
    {
        // Validate the request
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048', // Validate file type and size
        ]);

        // Handle the file upload
        if ($request->hasFile('file')) {
            $labwork = Labwork::findOrFail($labwork_id); // Retrieve the labwork

            // Store the file in the public/labworks directory
            $filePath = $request->file('file')->store('labworks', 'public');
            $studentId = session('student_id');

            // Create a new solution assignment
            SolutionAssignment::create([
                'student_id' => $studentId, // Assuming you have an authenticated user
                'assignment_id' => $labwork->id,
                'course_id' => $labwork->course_id,
                'file' => $filePath, // Save the path to the database
            ]);

            return redirect()->route('gotoStudentSubmitLabwork', ['labwork_id' => $labwork_id])->with('success', 'Labwork submitted successfully!');
        }

        return redirect()->route('gotoStudentSubmitLabwork', ['labwork_id' => $labwork_id])->with('error', 'File upload failed.');
    }



    public function gotoStudentCourseAssignment($course_id)
    {
        $distributions = Distribution::where('course_id', $course_id)
            ->with('course')
            ->get();
        $assignments = Assignment::select('id', 'title', 'file')
            ->where('course_id', $course_id)
            ->get();
        return view('students.studentCourseAssignment', compact('distributions', 'assignments'));
    }

    public function gotoStudentCourseQuiz($course_id)
    {
        $studentId = session('student_id');

        $distributions = Distribution::where('course_id', $course_id)
            ->with('course')
            ->get();

        $quizDetails = Exam::select('syllabus', 'date', 'exam_mark.mark')
            ->join('exam_mark', 'exam.id', '=', 'exam_mark.exam_id')
            ->where('exam.course_id', $course_id)
            ->where('exam_mark.student_id', $studentId)
            ->where('exam.category', 'quiz')
            ->get();

        // For mid exams
        $midDetails = Exam::select('syllabus', 'date', 'exam_mark.mark')
            ->join('exam_mark', 'exam.id', '=', 'exam_mark.exam_id')
            ->where('exam.course_id', $course_id)
            ->where('exam_mark.student_id', $studentId)
            ->where('exam.category', 'mid')
            ->get();

        return view('students.studentCourseQuiz', compact('distributions', 'quizDetails', 'midDetails'));
    }
    public function gotoStudentCourseMaterial($course_id)
    {
        $distributions = Distribution::where('course_id', $course_id)
            ->with('course')
            ->get();

        $materials = Material::where('course_id', $course_id)
            ->select('course_id', 'title', 'description', 'file')
            ->get();
        return view('students.studentCourseMaterial', compact('distributions', 'materials'));
    }
    public function gotoStudentCourseLabwork($course_id)
    {
        $distributions = Distribution::where('course_id', $course_id)
            ->with('course')
            ->get();

        $labworks = Labwork::select('id', 'title', 'file')
            ->where('course_id', $course_id)
            ->get();
        return view('students.studentCourseLabwork', compact('distributions', 'labworks'));
    }



    public function gotoStudentEnrollment()
    {

        return view('students.studentEnrollment');
    }

    public function gotoStudentGrade()
    {
        $studentId = session('student_id'); // Retrieve the student ID from the session

        // Fetch results for the logged-in student
        $results = Result::where('student_id', $studentId)->get();
        $cgpa = Result::where('student_id', $studentId)
            ->selectRaw('SUM(total_credit * gpa) / SUM(total_credit) AS CGPA')
            ->pluck('CGPA')
            ->first();

        return view('students.studentGrade', compact('results','cgpa')); // Pass the results to the view
    }
}
