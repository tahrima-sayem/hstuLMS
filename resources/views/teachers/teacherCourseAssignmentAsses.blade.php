@extends('layouts.master')

@section('content')

<div class="container mx-auto p-4">
    <div
        class="flex flex-col justify-between p-6 leading-normal w-full bg-white border border-green-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800">
        <h6 class="mb-3 text-2xl font-bold text-gray-700 dark:text-black-400">{{ $distributions->first()->course->code }}</h6>
        <h5 class="mb-2 text-3xl font-bold tracking-tight text-black-600 dark:text-white">Assignment No. - {{ $index }}</h5>
        <h5 class="mb-2 text-3xl font-bold tracking-tight text-black-600 dark:text-white">Assignment Title -{{ $assignments->first()->title }}</h5>

    </div>
    </br>
    </br>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Student ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        File
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Obtained Marks
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Insert Marks
                    </th>
                </tr>
            </thead>
            <tbody>
                @if($solutions->isNotEmpty())
                    @foreach($solutions as $solution)
                        <tr class="bg-white text-center border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $solution->student_id }}
                            </th>
                            <td class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $solution->fullname }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ asset('path/to/download/' . $solution->file) }}"
                                    class="text-blue-500 hover:text-blue-700">
                                    <p>Download</p>
                                    <i class="fas fa-download"></i>
                                </a>
                            </td>
                            <td class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $solution->mark }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form action="#" method="POST">
                                    @csrf
                                    <input type="number" name="marks" step="1" min="0" max="100"
                                        onkeydown="return event.key !== 'e'" placeholder="0 - 100" />
                                    <button type="submit" class="p-2 rounded-lg border bg-blue-500 text-white">
                                        <p>Upload <i class="fas fa-upload"></i></p>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="bg-white text-center border-b dark:bg-gray-800 dark:border-gray-700">
                        <td colspan="5" class="px-6 py-4 text-gray-500">
                            No solutions found for this assignment.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>


</div>

@endsection