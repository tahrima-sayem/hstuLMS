@extends('layouts.master')

@section('content')
<div class="container mx-auto p-4">
    <div
        class="flex flex-col justify-between p-6 leading-normal w-full bg-white border border-green-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800">
        <h6 class="mb-3 text-2xl font-bold text-gray-700 dark:text-black-400">{{$distributions->first()->course->code }}
        </h6>
        <h5 class="mb-2 text-4xl font-bold tracking-tight text-black-600 dark:text-white">Result Processing</h5>
    </div>
    </br></br>
    <div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Student ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Attendance
                </th>
                <th scope="col" class="px-6 py-3">
                    Assignment
                </th>
                <th scope="col" class="px-6 py-3">
                    Labwork
                </th>
                <th scope="col" class="px-6 py-3">
                    Quiz
                </th>
                <th scope="col" class="px-6 py-3">
                    Mid
                </th>
                <th scope="col" class="px-6 py-3">
                    Section A
                </th>
                <th scope="col" class="px-6 py-3">
                    Section B
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $result->student_id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ number_format($result->attendance_percentage, 2) }}%
                    </td>
                    <td class="px-6 py-4">
                        {{ $result->average_assignment_marks ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $result->average_labwork_marks ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $result->average_quiz_marks ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $result->average_mid_marks ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $result->section_a ?? '-' }} <!-- Adjust these if you have section-specific data -->
                    </td>
                    <td class="px-6 py-4">
                        {{ $result->section_b ?? '-' }} <!-- Adjust these if you have section-specific data -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>
@endsection