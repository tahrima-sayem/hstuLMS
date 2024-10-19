@extends('layouts.master')

@section('content')

<div class="container mx-auto p-4">
    <div
        class="flex flex-col justify-between p-6 leading-normal w-full bg-white border border-green-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800">
        <h5 class="mb-2 text-xl font-bold tracking-tight text-black-600 dark:text-white">
            {{$distributions->first()->course->code }}
        </h5>
        <h6 class="mb-3 font-bold text-gray-700 dark:text-black-400">
            {{ $results[0]->category == 'quiz' ? 'Quiz' : ($results[0]->category == 'mid' ? 'MID' : ($results[0]->category == 'final' ? 'Final (Section A)' : '')) }}
            Topic - {{ $results[0]->syllabus }} <!-- Dynamically display the syllabus -->
        </h6>
        <h6 class="mb-3 font-bold text-gray-700 dark:text-black-400">
            Date - {{ \Carbon\Carbon::parse($results[0]->date)->format('d.m.Y') }}
            <!-- Display the dynamic date in the desired format -->
        </h6>
    </div>

    </br>
    </br>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Student ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Marks
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $result->student_id }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $result->fullname }}
                        </th>
                        <td class="px-6 py-4">
                            <form action="{{ route('updateexamMarks') }}" method="POST">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ $result->student_id }}">
                                <input type="hidden" name="exam_id" value="{{ $result->exam_id }}">
                                <input type="hidden" name="course_id" value="{{ $result->course_id }}">
                                <input type="number" name="marks" step="1" min="0" max="100"
                                    value="{{ $result->mark ?? '' }}" onkeydown="return event.key !== 'e'"
                                    placeholder="0 - 100" class="border rounded p-2" />
                                <button type="submit" class="p-2 rounded-lg border bg-blue-500 text-white">
                                    <i class="fas fa-upload"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>



</div>

@endsection