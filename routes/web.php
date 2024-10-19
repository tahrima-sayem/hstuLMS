<?php


use Illuminate\Support\Facades\Route;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use App\Http\Middleware\StudentMiddleware;

use App\Http\Controllers\LoginController; 
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentPartController;
use App\Http\Controllers\DistributionController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login',[LoginController::class,'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/teacher/dashboard',[DashboardController::class,'gotoTeacherDashboard'])->name('gotoTeacherDashboard')->middleware(TeacherMiddleware::class);
Route::get('/student/dashboard',[DashboardController::class,'gotoStudentDashboard'])->name('gotoStudentDashboard')->middleware(StudentMiddleware::class);
Route::get('/admin/dashboard',[DashboardController::class,'gotoAdminDashboard'])->name('gotoAdminDashboard')->middleware(AdminMiddleware::class);

Route::get('/degree',[DegreeController::class,'gotoAddDegreePage'])->name('gotoAddDegreePage')->middleware(AdminMiddleware::class);
Route::post('/degree',[DegreeController::class,'createDegree'])->name('createDegree')->middleware(AdminMiddleware::class);

Route::get('/faculty',[FacultyController::class,'gotoAddFacultyPage'])->name('gotoAddFacultyPage')->middleware(AdminMiddleware::class);
Route::post('/faculty',[FacultyController::class,'createFaculty'])->name('createFaculty')->middleware(AdminMiddleware::class);

Route::get('/department',[DepartmentController::class,'gotoAddDepartmentPage'])->name('gotoAddDepartmentPage')->middleware(AdminMiddleware::class);
Route::post('/department',[DepartmentController::class,'createDepartment'])->name('createDepartment')->middleware(AdminMiddleware::class);

Route::get('/course',[CourseController::class,'gotoAddCoursePage'])->name('gotoAddCoursePage')->middleware(AdminMiddleware::class);
Route::post('/course',[CourseController::class,'createCourse'])->name('createCourse')->middleware(AdminMiddleware::class);

Route::get('/signup/teacher',[TeacherController::class,'gototeacherSignupPage'])->name('gototeacherSignupPage')->middleware(AdminMiddleware::class);
Route::post('/signup/teacher',[TeacherController::class,'createTeacher'])->name('createTeacher')->middleware(AdminMiddleware::class);

Route::get('/signup/student',[StudentController::class,'gotostudentSignupPage'])->name('gotostudentSignupPage')->middleware(AdminMiddleware::class);
Route::post('/signup/student',[StudentController::class,'createStudent'])->name('createStudent')->middleware(AdminMiddleware::class);

//distribution
Route::get('/course/distribution',[DistributionController::class,'gotoDistributeCoursePage'])->name('gotoDistributeCoursePage')->middleware(TeacherMiddleware::class);
Route::post('/course/distribution',[DistributionController::class,'distributeCourse'])->name('distributeCourse')->middleware(TeacherMiddleware::class);

//Display Teacher's Course
Route::get('/courses', [TeacherController::class, 'teacherAssignedCourses'])->name('teacherAssignedCourses')->middleware(TeacherMiddleware::class);

//Display Course Details

Route::get('/course-details/{course_id}/{course_code}', [TeacherController::class, 'gototeacherCourseDetails'])->name('gototeacherCourseDetails')->middleware(TeacherMiddleware::class);

//Display Course Student List
Route::get('/student-list/{course_id?}', [TeacherController::class, 'gototeacherCourseStudentList'])->name('gototeacherCourseStudentList');

//Display Course Assignments
Route::get('/assignments/{course_id?}', [TeacherController::class, 'gototeacherCourseAssignment'])->name('gototeacherCourseAssignment')->middleware(TeacherMiddleware::class);
Route::post('/assignments/store', [TeacherController::class, 'store'])->name('assignments.store');

//Display Course Result
Route::get('/course-details/result-processing', [TeacherController::class, 'gototeacherCourseResultProcess'])->name('gototeacherCourseResultProcess');


//Assignment assesment
Route::get('/assignment-assesments/{assignment_id}/{index}',[TeacherController::class,'gototeacherCourseAssignmentAssesment'])->name('gototeacherCourseAssignmentAssesment')->middleware(TeacherMiddleware::class);
Route::post('/upload-marks/{solution_id}', [TeacherController::class, 'uploadMarks'])->name('uploadMarks');


//Display Course Labwork
Route::get('/labwork/{course_id?}', [TeacherController::class, 'gototeacherCourseLabwork'])->name('gototeacherCourseLabwork')->middleware(TeacherMiddleware::class);
Route::post('/labworks/store', [TeacherController::class, 'labworkstore'])->name('labworkstore');

//Labwork assesment
Route::get('/labwork/assesments/{labwork_id}/{index}',[TeacherController::class,'gototeacherCourseLabworkAssesment'])->name('gototeacherCourseLabworkAssesment')->middleware(TeacherMiddleware::class);
//Route::post('/course/distribution',[DistributionController::class,'distributeCourse'])->name('distributeCourse')->middleware(TeacherMiddleware::class);

//Display Course Exams
Route::get('/exam/{course_id?}', [TeacherController::class, 'gototeacherCourseExam'])->name('gototeacherCourseExam')->middleware(TeacherMiddleware::class);
Route::post('/exam/store', [TeacherController::class, 'examstore'])->name('examstore');

//Quiz Marks Submit
Route::get('/course-detail/exam/quiz',[TeacherController::class,'gototeacherCourseExamQuizMarks'])->name('gototeacherCourseExamQuizMarks')->middleware(TeacherMiddleware::class);
//Route::post('/course/distribution',[DistributionController::class,'distributeCourse'])->name('distributeCourse')->middleware(TeacherMiddleware::class);

//Mid Marks Submit
Route::get('/course-detail/exam/mid/{exam_id}/{index}',[TeacherController::class,'gototeacherCourseExamMidMarks'])->name('gototeacherCourseExamMidMarks')->middleware(TeacherMiddleware::class);
Route::post('/update-marks', [TeacherController::class, 'updateexamMarks'])->name('updateexamMarks');

//Course Materials
Route::get('/course-detail/materials/{course_id}',[TeacherController::class,'gototeacherCourseMaterials'])->name('gototeacherCourseMaterials')->middleware(TeacherMiddleware::class);
Route::post('/materials', [TeacherController::class, 'materialsstore'])->name('materialsstore');

//Enrollment
Route::get('/start-enrollment',[TeacherController::class,'gotoEnrollPage'])->name('gotoEnrollPage')->middleware(TeacherMiddleware::class);
Route::post('/enrollment/start', [TeacherController::class, 'startEnrollment'])->name('enrollment.start');

//External Assign
Route::get('/external-assign',[TeacherController::class,'gototeacherExternalAssignPage'])->name('gototeacherExternalAssignPage')->middleware(TeacherMiddleware::class);
Route::post('/assign-externals', [TeacherController::class, 'teacherexternalassign'])->name('teacherexternalassign');

//Exam Committee Proposal
Route::get('/exam-commitee-proposal',[TeacherController::class,'gototeacherExamCommitteeProposalPage'])->name('gototeacherExamCommitteeProposalPage')->middleware(TeacherMiddleware::class);
Route::post('/exam-committee', [TeacherController::class, 'examcommitteecreate'])->name('examcommitteecreate');

//Teacher Class Routine
Route::get('/class-routine',[TeacherController::class,'gototeacherClassRoutinePage'])->name('gototeacherClassRoutinePage')->middleware(TeacherMiddleware::class);
//Route::post('/course/distribution',[DistributionController::class,'distributeCourse'])->name('distributeCourse')->middleware(TeacherMiddleware::class);


// Routes for StudentPartController methods
Route::get('/student/courses', [StudentPartController::class, 'gotoStudentYourCourses'])->name('gotoStudentYourCourses')->middleware(StudentMiddleware::class);
Route::get('/student/enrollment', [StudentPartController::class, 'gotoStudentEnrollment'])->name('gotoStudentEnrollment')->middleware(StudentMiddleware::class);
Route::get('/student/grades', [StudentPartController::class, 'gotoStudentGrade'])->name('gotoStudentGrade')->middleware(StudentMiddleware::class);
Route::get('/student/courses/coursedetail/{course_id}', [StudentPartController::class, 'gotoStudentCourseDetail'])->name('gotoStudentCourseDetail')->middleware(StudentMiddleware::class);
Route::get('/student/courses/attendance/{course_id}', [StudentPartController::class, 'gotoStudentCourseAttendance'])->name('gotoStudentCourseAttendance')->middleware(StudentMiddleware::class);
Route::get('/student/coursedetail/assignment/{course_id}', [StudentPartController::class, 'gotoStudentCourseAssignment'])->name('gotoStudentCourseAssignment')->middleware(StudentMiddleware::class);
Route::get('/student/coursedetail/exam/{course_id}', [StudentPartController::class, 'gotoStudentCourseQuiz'])->name('gotoStudentCourseQuiz')->middleware(StudentMiddleware::class);
Route::get('/student/coursedetail/material/{course_id}', [StudentPartController::class, 'gotoStudentCourseMaterial'])->name('gotoStudentCourseMaterial')->middleware(StudentMiddleware::class);
Route::get('/student/coursedetail/labwork/{course_id}', [StudentPartController::class, 'gotoStudentCourseLabwork'])->name('gotoStudentCourseLabwork')->middleware(StudentMiddleware::class);
Route::get('/student/courses/submitassignment/{assignment_id}', [StudentPartController::class, 'gotoStudentSubmitAssignment'])->name('gotoStudentSubmitAssignment')->middleware(StudentMiddleware::class);
Route::post('/submit-assignment/{assignment_id}', [StudentPartController::class, 'submitAssignment'])->name('submitAssignment');
Route::get('/student/courses/submitlabwork/{labwork_id}', [StudentPartController::class, 'gotoStudentSubmitLabwork'])->name('gotoStudentSubmitLabwork')->middleware(StudentMiddleware::class);
Route::post('/upload-labwork/{labwork_id}', [StudentPartController::class, 'submitLabwork'])->name('uploadLabwork');