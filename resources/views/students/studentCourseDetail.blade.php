@extends('layouts.master')

@section('content')
<div class="container mx-auto">

    <div
        class="flex flex-col justify-between p-6 leading-normal w-full bg-white border border-green-200 rounded-lg shadow w-full dark:border-gray-700 dark:bg-gray-800">
        @foreach($distributions as $distribution)    
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-black-600 dark:text-white">
                    {{ $distribution->course->code }}</h5>
                <h6 class="mb-3 text-2xl font-bold text-gray-700 dark:text-black-400">{{ $distribution->course->name }}</h6>
                <p class="mb-3 text-2xl font-normal text-gray-700 dark:text-gray-400">Session:{{ $distribution->session }}</p>
                <p class="mb-3 text-2xl font-normal text-gray-700 dark:text-gray-400">
                    Credit:{{ $distribution->course->credit_hour }}</p>
                @php
                    $course_id = $distribution->course_id; 
                @endphp
        @endforeach
    </div><br><br>


    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
        <a href="{{ route('gotoStudentCourseAttendance',['course_id' => $course_id])}}"
            class="flex flex-col items-center bg-white border border-green-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <div class="flex flex-col justify-between p-6 leading-normal">
                <img src="{{ asset('images/assigned.png') }}" class="h-10 w-10 mb-2" alt="Logo" />

                <h5 class="mb-2 text-xl font-bold tracking-tight text-green-600 dark:text-white">Attendance</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">View your attendance records.</p>
            </div>
        </a>



        <a href="{{ route('gotoStudentCourseAssignment',['course_id' => $course_id]) }}"
            class="flex flex-col items-center bg-white border border-green-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">

            <div class="flex flex-col justify-between p-6 leading-normal">
                <img src="{{ asset('images/online-course.png') }}" class="h-10 w-10 mb-2" alt="Logo" />

                <h5 class="mb-2 text-xl font-bold tracking-tight text-green-600 dark:text-white">Assignments</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Access your assignments.</p>
            </div>
        </a>


        <a href="{{ route('gotoStudentCourseQuiz',['course_id' => $course_id]) }}"
            class="flex flex-col items-center bg-white border border-green-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">

            <div class="flex flex-col justify-between p-6 leading-normal">
                <img src="{{ asset('images/assigned.png') }}" class="h-10 w-10 mb-2" alt="Logo" />

                <h5 class="mb-2 text-xl font-bold tracking-tight text-green-600 dark:text-white">Exams</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">See your exam marks here.</p>
            </div>
        </a>


        <a href="{{ route('gotoStudentCourseMaterial',['course_id' => $course_id]) }}"
            class="flex flex-col items-center bg-white border border-green-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">

            <div class="flex flex-col justify-between p-6 leading-normal">
                <img src="{{ asset('images/online-course.png') }}" class="h-10 w-10 mb-2" alt="Logo" />

                <h5 class="mb-2 text-xl font-bold tracking-tight text-green-600 dark:text-white">Materials</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">View course materials.</p>
            </div>
        </a>

        <a href="{{ route('gotoStudentCourseLabwork',['course_id' => $course_id]) }}"
            class="flex flex-col items-center bg-white border border-green-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">

            <div class="flex flex-col justify-between p-6 leading-normal">
                <img src="{{ asset('images/online-course.png') }}" class="h-10 w-10 mb-2" alt="Logo" />

                <h5 class="mb-2 text-xl font-bold tracking-tight text-green-600 dark:text-white">Labworks</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">View your Labworks.</p>
            </div>
        </a>


    </div>
</div>
@endsection