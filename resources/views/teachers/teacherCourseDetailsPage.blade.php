@extends('layouts.master')

@section('content')
<div class="container mx-auto p-4">
    @php
        // Initialize a variable to hold the last course_id outside the loop
        $x = null; 
    @endphp
    @foreach($distributions as $distribution)

        <div
            class="flex flex-col justify-between p-6 leading-normal w-full bg-white border border-green-200 rounded-lg shadow w-full dark:border-gray-700 dark:bg-gray-800">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-black-600 dark:text-white">
                {{ $distribution->course->code }}</h5>
            <h6 class="mb-3 text-2xl font-bold text-gray-700 dark:text-black-400">{{ $distribution->course->name }}</h6>
            <p class="mb-3 text-2xl font-normal text-gray-700 dark:text-gray-400">Session: {{ $distribution->session }}</p>
            <p class="mb-3 text-2xl font-normal text-gray-700 dark:text-gray-400">Credit:
                {{ $distribution->course->credit_hour }}</p>
        </div>
        <a href="{{ route('gototeacherCourseDetails', ['course_id' => $distribution->course_id, 'course_code' => $distribution->course->code]) }}"
            class="flex flex-col md:flex-row items-center bg-white border border-green-200 rounded-lg shadow w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"></a>
        @php
            $course_id = $distribution->course_id; 
        @endphp
    @endforeach
    </br>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
        <a href="{{ route('gototeacherCourseStudentList', ['course_id' => $course_id])}}"
            class="flex flex-col items-center bg-white border border-green-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <div class="flex flex-col justify-between p-6 leading-normal">
                <img src="{{ asset('images/assigned.png') }}" class="h-10 w-10 mb-2" alt="Logo" />
                <h5 class="mb-2 text-xl font-bold tracking-tight text-green-600 dark:text-white">Students</h5> <i
                    class="fa-solid fa-table-columns"></i>

            </div>
        </a>

        <a href="{{ route('gototeacherCourseAssignment', ['course_id' => $course_id])}}"
            class="flex flex-col items-center bg-white border border-green-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <div class="flex flex-col justify-between p-6 leading-normal">
                <img src="{{ asset('images/online-course.png') }}" class="h-10 w-10 mb-2" alt="Logo" />
                <h5 class="mb-2 text-xl font-bold tracking-tight text-green-600 dark:text-white">Assignments</h5>
            </div>
        </a>

        <a href="{{ route('gototeacherCourseLabwork', ['course_id' => $course_id])}}"
            class="flex flex-col items-center bg-white border border-green-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <div class="flex flex-col justify-between p-6 leading-normal">
                <img src="{{ asset('images/assigned.png') }}" class="h-10 w-10 mb-2" alt="Logo" />
                <h5 class="mb-2 text-xl font-bold tracking-tight text-green-600 dark:text-white">Labwork</h5>
            </div>
        </a>

        <a href="{{ route('gototeacherCourseExam', ['course_id' => $course_id])}}"
            class="flex flex-col items-center bg-white border border-green-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <div class="flex flex-col justify-between p-6 leading-normal">
                <img src="{{ asset('images/assigned.png') }}" class="h-10 w-10 mb-2" alt="Logo" />
                <h5 class="mb-2 text-xl font-bold tracking-tight text-green-600 dark:text-white">Exam</h5>
            </div>
        </a>
        <a href="{{ route('gototeacherCourseMaterials', ['course_id' => $course_id]) }}"
            class="flex flex-col items-center bg-white border border-green-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <div class="flex flex-col justify-between p-6 leading-normal">
                <img src="{{ asset('images/assigned.png') }}" class="h-10 w-10 mb-2" alt="Logo" />
                <h5 class="mb-2 text-xl font-bold tracking-tight text-green-600 dark:text-white">Materials</h5>
            </div>
        </a>

        <a href="{{ route('gototeacherCourseResultProcess')}}"
            class="flex flex-col items-center bg-white border border-green-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <div class="flex flex-col justify-between p-6 leading-normal">
                <img src="{{ asset('images/assigned.png') }}" class="h-10 w-10 mb-2" alt="Logo" />
                <h5 class="mb-2 text-xl font-bold tracking-tight text-green-600 dark:text-white">Result Processing</h5>
            </div>
        </a>

    </div>
</div>
@endsection