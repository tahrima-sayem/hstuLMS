@extends('layouts.master')

@section('content')


<div class="container mx-auto">
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
    @foreach($distributions as $distribution)
    <a href="{{ route('gototeacherCourseDetails', ['course_id' => $distribution->course_id, 'course_code' => $distribution->course->code]) }}" class="flex flex-col items-center bg-white border border-green-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            
            <div class="flex flex-col justify-between p-6 leading-normal">
            <img src="{{ asset('images/assigned.png') }}" class="h-10 w-10 mb-2" alt="Logo" />
                <h5 class="mb-2 text-xl font-bold tracking-tight text-green-600 dark:text-white">{{ $distribution->course->code }}</h5>
                <h6 class="mb-3 font-bold text-gray-700 dark:text-black-400">{{$distribution->course->name}}</h6>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Session : {{$distribution->session}}</p>
            </div>
        </a>
    @endforeach
</div>
</div>
@endsection
