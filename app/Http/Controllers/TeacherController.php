<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Faculty;
use App\Models\Department;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Distribution;
use App\Models\Course;
use App\Models\Student;
use App\Models\ClassModel;
use App\Models\Assignment;
use App\Models\Labwork;
use App\Models\ExamCommittee;
use App\Models\AssignExternal;
use App\Models\Exam;
use App\Models\Material;
use App\Models\Enrollment;
use App\Models\External;
use App\Models\SolutionAssignment;
use App\Models\SolutionLabwork;
use Illuminate\Support\Facades\DB;


class TeacherController extends Controller
{
    public function gotoEnrollPage()
    {

        $enrollments = Enrollment::with('department')
            ->select('level', 'semester', 'start_date', 'end_date', 'department') // Include department_id to access dept_code
            ->get();

        // Transform the data to include the dept_code in the result
        $result = $enrollments->map(function ($enrollment) {
            return [
                'dept_code' => 'CSE',
                'level' => $enrollment->level,
                'semester' => $enrollment->semester,
                'start_date' => $enrollment->start_date,
                'end_date' => $enrollment->end_date,
            ];
        });

        // Pass the transformed result to the view
        return view('teachers.teacherEnrollPage', ['enrollments' => $result]);
    }
    public function startEnrollment(Request $request)
    {
        // Validate form input
        $request->validate([
            'department' => 'required|string',
            'level' => 'required|integer',
            'semester' => 'required|string',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start'
        ]);

        // Create a new enrollment record
        Enrollment::create([
            'department' => $request->input('department'),
            'level' => $request->input('level'),
            'semester' => $request->input('semester'),
            'start_date' => $request->input('start'),
            'end_date' => $request->input('end')
        ]);

        // Redirect or return a success response
        return redirect()->back()->with('success', 'Enrollment started successfully!');
    }
    public function gototeacherSignupPage()
    {
        $faculties = Faculty::all();
        $departments = Department::all();
        return view('teachers.teacherSignupPage', [
            'faculties' => $faculties,
            'departments' => $departments,
            'designations' => ['Lecturer', 'Assistant Professor', 'Associate Professor', 'Professor'],
        ]);
    }

    public function createTeacher(Request $request)
    {
        //dd($request);
        $request->validate([
            'fullname' => 'required',
            'email' => 'required',
            'contact_number' => 'required',
            'department' => 'required',
            'faculty' => 'required',
            'designation' => 'required',
            'password' => 'required',
        ]);
        try {

            $user = User::create([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'contact_number' => $request->contact_number,
                'password' => $request->password,
                'role_id' => "2",
            ]);

            $teacher = Teacher::create([
                'department_id' => $request->department,
                'faculty_id' => $request->faculty,
                'designation' => $request->designation,
                'user_id' => $user->id,
            ]);

            return redirect()->back()->with('success', "Teacher added successfully!");

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function teacherAssignedCourses(Request $request)
    {
        // Get the teacher ID from the session
        $teacherId = session('teacher_id');

        // Fetch the distributions assigned to the teacher with course data
        $distributions = Distribution::where('teacher_id', $teacherId)->with('course')->get();

        // Return the view with the fetched distributions
        return view('teachers.teacherAssignedCourses', compact('distributions'));
    }
    public function gototeacherClassRoutinePage()
    {

        return view('teachers.teacherClassRoutine');
    }
    public function gototeacherCourseAssignmentAssesment($assignment_id, $index)
    {
        // Fetch the assignment details
        $assignments = Assignment::select('id', 'title', 'course_id')
            ->where('id', $assignment_id)
            ->get();

        // Fetch the course distributions
        $distributions = Distribution::where('course_id', $assignments->first()->course_id)
            ->with('course')
            ->get();

        // Fetch the solutions for the specific assignment
        $solutions = SolutionAssignment::select(
            'students.s_id as student_id',
            'solution_assignment.student_id as s_id',
            'users.fullname',
            'assignments.title',
            'solution_assignment.mark',
            'solution_assignment.file'
        )
            ->join('assignments', 'solution_assignment.assignment_id', '=', 'assignments.id')
            ->join('students', 'solution_assignment.student_id', '=', 'students.id')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->where('solution_assignment.assignment_id', $assignment_id)
            ->get();

        return view('teachers.teacherCourseAssignmentAsses', compact('assignments', 'distributions', 'index', 'solutions'));
    }
    public function gototeacherCourseLabworkAssesment($labwork_id, $index)
    {
        $labworks = Labwork::select('id', 'title', 'course_id')
            ->where('id', $labwork_id)
            ->get();

        $distributions = Distribution::where('course_id', $labworks->first()->course_id)
            ->with('course')
            ->get();

        // Assuming you have a relationship in SolutionLabwork model to get related data
        $solutions = SolutionLabwork::with(['student.user'])
            ->where('labwork_id', $labwork_id)
            ->get();

        return view('teachers.teacherCourseLabworkAsses', compact('labworks', 'distributions', 'index', 'solutions'));
    }



    public function gototeacherCourseAssignment($course_id)
    {
        // Fetching distributions for the given course_id
        $distributions = Distribution::where('course_id', $course_id)
            ->with('course')
            ->get();

        // Fetching assignments for the given course_id
        $assignments = Assignment::select('id', 'title', 'file')
            ->where('course_id', $course_id)
            ->get();

        // Return the view with the fetched distributions and assignments
        return view('teachers.teacherCourseAssignment', compact('distributions', 'assignments'));
    }
    public function gototeacherCourseMaterials($course_id)
    {
        $distributions = Distribution::where('course_id', $course_id)
            ->with('course')
            ->get();

        $materials = Material::where('course_id', $course_id)
            ->select('course_id', 'title', 'description', 'file')
            ->get();

        return view('teachers.teacherCourseMaterial', compact('distributions', 'materials'));
    }
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|integer',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt|max:2048',
            'deadline' => 'required|date',
        ]);

        // Store the file if it exists
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('assignments', 'public');
        }

        // Create a new assignment
        Assignment::create([
            'title' => $request->title,
            'course_id' => $request->course_id,
            'description' => $request->description,
            'file' => $filePath,
            'deadline' => $request->deadline,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Assignment created successfully!');
    }
    public function gototeacherCourseExam($course_id)
    {
        // Fetching distributions for the given course_id
        $distributions = Distribution::where('course_id', $course_id)
            ->with('course')
            ->get();

        $quizzes = Exam::where('course_id', $course_id)
            ->where('category', 'quiz')
            ->select('id', 'syllabus', 'course_id', 'category', 'date')
            ->get();

        // Fetching mid-terms for the given course_id
        $midTerms = Exam::where('course_id', $course_id)
            ->where('category', 'mid')
            ->select('id', 'syllabus', 'course_id', 'category', 'date')
            ->get();

        // Fetching finals for the given course_id
        $finals = Exam::where('course_id', $course_id)
            ->where('category', 'final')
            ->select('id', 'syllabus', 'course_id', 'category', 'date')
            ->get();
        // Return the view with the fetched distributions
        return view('teachers.teacherCourseExam', compact('distributions', 'quizzes', 'midTerms', 'finals'));
    }
    public function examstore(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'syllabus' => 'required|string|max:255',
            'category' => 'required|in:mid,quiz,final',
            'date' => 'required|date',
        ]);

        Exam::create($validatedData);

        return redirect()->back()->with('success', 'Exam added successfully.');
    }
    public function gototeacherCourseLabwork($course_id)
    {
        $distributions = Distribution::where('course_id', $course_id)
            ->with('course')
            ->get();

        // Fetch labwork records for the given course_id
        $labworks = Labwork::where('course_id', $course_id)
            ->select('id', 'title', 'file')
            ->get();

        return view('teachers.teacherCourseLabwork', compact('distributions', 'labworks'));
    }

    public function labworkstore(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf|max:2048', // Example for PDF file
            'date' => 'required|date',
            'course_id' => 'required|exists:courses,id', // Assuming you have a course_id field
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('labworks', 'public'); // Store in public storage
        }

        // Create the lab work entry
        Labwork::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'file' => $filePath ?? null, // Store the file path if uploaded
            'course_id' => $validatedData['course_id'],
            'date' => $validatedData['date'],
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Labwork created successfully!');
    }

    public function materialsstore(Request $request)
    {
        // Validate input data
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,zip,jpg,png|max:10240', // Set allowed file types and max size
        ]);

        // Handle the file upload
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('materials', 'public'); // Save file in the 'storage/app/public/materials' folder
        }

        // Create the material record in the database
        Material::create([
            'course_id' => $request->input('course_id'), // Make sure to pass the course ID in the request or set it manually
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file' => $filePath, // Store the file path in the database
        ]);

        // Redirect or return success response
        return redirect()->back()->with('success', 'Material added successfully!');
    }
    public function gototeacherCourse()
    {
        $distributions = Distribution::all();
        $teachers = Teacher::all();
        return view('teachers.teacherCourse', [
            'distributions' => $distributions,
            'teachers' => $teachers
        ]);
    }
    public function gototeacherCourseDetails($course_id, $course_code)
    {
        // Fetch the distributions with the matching course ID and course code
        $distributions = Distribution::where('course_id', $course_id)
            ->whereHas('course', function ($query) use ($course_code) {
                $query->where('code', $course_code);
            })
            ->with('course')
            ->get();

        // Return the view with the fetched distributions
        return view('teachers.teacherCourseDetailsPage', compact('distributions'));
    }
    public function gototeacherCourseResultProcess()
    {
        $course_id=9;
        $distributions = Distribution::where('course_id', $course_id)
            ->with('course')
            ->get();

            $results = Student::select(
                'students.Id as student_id',
                DB::raw('(SUM(CASE WHEN attendence.attendance_status = 1 THEN 1 ELSE 0 END) / COUNT(attendence.id)) * 100 AS attendance_percentage'),
                DB::raw('AVG(solution_assignment.mark) AS average_assignment_marks'),
                DB::raw('AVG(solution_labwork.mark) AS average_labwork_marks'),
                DB::raw('AVG(CASE WHEN exam.category = "quiz" THEN exam_mark.mark END) AS average_quiz_marks'),
                DB::raw('AVG(CASE WHEN exam.category = "mid" THEN exam_mark.mark END) AS average_mid_marks')
            )
            ->leftJoin('attendence', 'students.Id', '=', 'attendence.student_id')
            ->leftJoin('solution_assignment', function($join) use ($course_id) {
                $join->on('students.Id', '=', 'solution_assignment.student_id')
                     ->where('solution_assignment.course_id', $course_id);
            })
            ->leftJoin('solution_labwork', function($join) use ($course_id) {
                $join->on('students.Id', '=', 'solution_labwork.student_id')
                     ->where('solution_labwork.course_id', $course_id);
            })
            ->leftJoin('exam_mark', 'students.Id', '=', 'exam_mark.student_id')
            ->leftJoin('exam', function($join) use ($course_id) {
                $join->on('exam_mark.exam_id', '=', 'exam.Id')
                     ->where('exam.course_id', $course_id);
            })
            ->groupBy('students.Id')
            ->get();

        return view('teachers.teacherCourseResultProcessing', compact('distributions','results'));
    }
    public function gototeacherCourseStudentList($course_id)
    {
        // Fetch the distributions with the matching course ID and course code
        $distributions = Distribution::where('course_id', $course_id)
            ->with('course')
            ->get();

        // Fetch attendance data
        $studentsData = DB::table('attendence as a')
            ->join('students as s', 'a.student_id', '=', 's.id')
            ->join('users as u', 's.user_id', '=', 'u.id')
            ->join('classes as c', 'a.class_id', '=', 'c.id')
            ->select(
                's.s_id AS student_id',
                'u.fullname',
                DB::raw('SUM(a.attendance_status = 1) AS present_count'),
                DB::raw('COUNT(c.id) AS total_classes'),
                DB::raw('(SUM(a.attendance_status = 1) * 100.0 / COUNT(c.id)) AS attendance_percentage')
            )
            ->where('c.course_id', $course_id) // Use the passed course_id
            ->groupBy('s.s_id', 'u.fullname')
            ->get();

        return view('teachers.teacherCourseStudentList', compact('studentsData', 'distributions'));
    }
    public function gototeacherCourseExamMidMarks($exam_id, $index)
    {
        // Eloquent query to fetch exam marks along with student and user details
        $results = DB::table('exam_mark')
            ->join('exam', 'exam_mark.exam_id', '=', 'exam.Id')
            ->join('students', 'exam_mark.student_id', '=', 'students.Id')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->select(
                'students.s_id as student_id',
                'exam_mark.student_id as s_id',
                'users.fullname',
                'exam.syllabus',
                'exam.course_id',
                'exam.category',
                'exam.date',
                'exam_mark.mark',
                'exam_mark.exam_id'
            )
            ->where('exam_mark.exam_id', $exam_id) // Filter by passed exam_id
            ->get();
        if (!$results->isEmpty()) {
            $course_id = $results[0]->course_id; // Store the first result's course_id
        }
        $distributions = Distribution::where('course_id', $course_id)
            ->with('course')
            ->get();
        // Pass the results to the view along with the exam_id and index
        return view('teachers.teacherCourseExamMarks', compact('distributions', 'results', 'exam_id', 'index'));
    }
    public function updateexamMarks(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'student_id' => 'required|integer',
            'exam_id' => 'required|integer',
            'course_id' => 'required|integer',
            'marks' => 'required|integer|min:0|max:100',
        ]);

        // Find the record in the exam_mark table and update the marks
        DB::table('exam_mark')
            ->where('student_id', $request->student_id)
            ->where('exam_id', $request->exam_id)
            ->where('course_id', $request->course_id)
            ->update(['mark' => $request->marks]);

        // Optionally, redirect back with a success message
        return redirect()->back()->with('success', 'Marks updated successfully!');
    }
    public function gototeacherCourseExamQuizMarks()
    {

        return view('teachers.teacherCourseExamQuizMarks');
    }

    public function gototeacherExternalAssignPage()
    {
        $teacherId = session('teacher_id');

        // Fetch the distributions assigned to the teacher with course data
        $distributions = Distribution::where('teacher_id', $teacherId)->with('course')->get();
        $externals = External::all();
        $teachers = Teacher::all();

        return view('teachers.teacherExternalAssign', compact('distributions', 'externals', 'teachers'));
    }
    public function teacherexternalassign(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'external_1' => 'required|exists:externals,id',
            'external_2' => 'required|exists:externals,id',
            'scrutinizer' => 'required|exists:teachers,id',
        ]);

        // Create a new assigned external record
        AssignExternal::create([
            'course_id' => $request->course_id,
            'external_1' => $request->external_1,
            'external_2' => $request->external_2,
            'scrutinizer' => $request->scrutinizer,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'External examiners assigned successfully.');
    }
    public function gototeacherExamCommitteeProposalPage()
    {
        $teachers = Teacher::all();

        return view('teachers.teacherExamCommitteeProposal', compact('teachers'));
    }
    public function examcommitteecreate(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'year' => 'required|integer',
            'type' => 'required|string',
            'level' => 'required|integer',
            'semester' => 'required|string',
            'chairman' => 'required|exists:teachers,id',
            'member_1' => 'required|exists:teachers,id',
            'member_2' => 'required|exists:teachers,id',
        ]);

        // Create a new exam committee record
        ExamCommittee::create([
            'year' => $request->year,
            'type' => $request->type,
            'level' => $request->level,
            'semester' => $request->semester,
            'chairman' => $request->chairman,
            'member_1' => $request->member_1,
            'member_2' => $request->member_2,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Exam committee created successfully.');
    }
}
