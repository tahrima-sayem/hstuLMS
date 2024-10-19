@extends('layouts.master')

@section('content')
<div class="container mx-auto p-4">



    <div
        class="flex flex-col justify-between p-6 leading-normal w-full bg-white border border-green-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800">
        <h6 class="mb-3 text-2xl font-bold text-gray-700 dark:text-black-400">{{$distributions->first()->course->code }}
        </h6>
        <h5 class="mb-2 text-4xl font-bold tracking-tight text-black-600 dark:text-white">Exam</h5>
    </div>
    </br></br>


    <h3 class="text-xl font-bold mb-4 text-green-600 dark:text-white">Quiz</h3>
<div class="relative overflow-x-auto mb-8">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">No</th>
                <th scope="col" class="px-6 py-3">Topic</th>
                <th scope="col" class="px-6 py-3">Date</th>
                <th scope="col" class="px-6 py-3">Marks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quizDetails as $index => $quiz)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4">{{ $quiz->syllabus }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($quiz->date)->format('d-m-Y') }}</td>
                    <td class="px-6 py-4">{{ $quiz->mark }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<h3 class="text-xl font-bold mb-4 text-green-600 dark:text-white">Mid</h3>
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">No</th>
                <th scope="col" class="px-6 py-3">Topic</th>
                <th scope="col" class="px-6 py-3">Date</th>
                <th scope="col" class="px-6 py-3">Marks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($midDetails as $index => $mid)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4">{{ $mid->syllabus }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($mid->date)->format('d-m-Y') }}</td>
                    <td class="px-6 py-4">{{ $mid->mark }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>
@endsection