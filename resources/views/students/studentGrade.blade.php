@extends('layouts.master')

@section('content')
<div class="container mx-auto p-4">

    <div
        class="flex flex-col md:flex-row items-center bg-white border border-green-200 rounded-lg shadow w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 mb-6">
        <div class="flex flex-col justify-between p-6 leading-normal w-full">

            <h1 class="mb-2 text-4xl font-bold tracking-tight text-black-600 dark:text-white">Grades</h1>
            <h6 class="mb-3 text-2xl font-bold text-gray-700 dark:text-black-400">
                CGPA - {{ number_format($cgpa, 2) }}
            </h6>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Level & Semester</th>
                        <th scope="col" class="px-6 py-3">Credit</th>
                        <th scope="col" class="px-6 py-3">GPA</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($results->isEmpty())
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td colspan="3" class="px-6 py-4 text-center">No results found.</td>
                        </tr>
                    @else
                        @foreach ($results as $result)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Level-{{ $result->level }}, Semester-{{ $result->semester }}</th>
                                <td class="px-6 py-4">{{ number_format($result->total_credit, 2) }}</td>
                                <td class="px-6 py-4">{{ $result->gpa }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <div class="flex flex-col items-center justify-center">
            <div class="w-full max-w-xs bg-white border border-green-200 rounded-lg shadow p-4">
                <div class="w-full">
                    @if ($results->isEmpty())
                        <p class="text-gray-500 text-center">No results available.</p>
                    @else
                        @foreach ($results as $result)
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-500">L-{{ $result->level }}, S-{{ $result->semester }}</span>
                                <div class="bg-gray-200 rounded-full h-6 w-full mx-2">
                                    <div class="bg-green-600 h-6 rounded-full"
                                        style="width: {{ ($result->gpa / 4.0) * 100 }}%;"></div>
                                </div>
                                <span class="text-gray-500">{{ $result->gpa }}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>



</div>
@endsection