@extends('layouts.master')

@section('content')

<div class="container mx-auto p-4">
    <div
        class="flex flex-col md:flex-row items-center bg-white border border-green-200 rounded-lg shadow w-full dark:border-gray-700 dark:bg-gray-800">
        <div class="flex flex-col justify-between p-6 leading-normal w-full">
            <h5 class="mb-2 text-4xl font-bold tracking-tight text-black-600 dark:text-white text-center"><u>Start
                    Enrollments</u></h5>

            <form action="{{ route('enrollment.start') }}" method="POST">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-3">
                    <div>
                        <label for="department"
                            class="block text-sm font-medium text-gray-900 dark:text-white">Department :</label>
                        <select id="department" name="department"
                            class="choices bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>Select a Department</option>
                            <option value="1">CSE</option>
                        </select>
                    </div>
                    <div>
                        <label for="level" class="block text-sm font-medium text-gray-900 dark:text-white">Level
                            :</label>
                        <select id="level" name="level"
                            class="choices bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>Select Level</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div>
                        <label for="semester" class="block text-sm font-medium text-gray-900 dark:text-white">Semester
                            :</label>
                        <select id="semester" name="semester"
                            class="choices bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>Select Semester</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                        </select>
                    </div>
                </div>
                <div class="w-full mb-6">
                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Enrollment
                        Date</label>
                    <div id="date" class="flex items-center w-full">
                        <div class="relative w-full">
                            <input id="date-start" name="start" type="date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Select date start">
                        </div>
                        <span class="mx-4 text-gray-500">to</span>
                        <div class="relative w-full">
                            <input id="date-end" name="end" type="date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Select date end">
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button type="submit"
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Start</button>
                    @if(\Illuminate\Support\Facades\Session::has('error'))
                        <div id="error-message"
                            class="w-full px-4 py-2 text-center bg-white text-green-600 rounded-md shadow-sm text-sm mb-5">
                            {{ \Illuminate\Support\Facades\Session::get('error') }}
                        </div>
                    @endif

                    @if(\Illuminate\Support\Facades\Session::has('success'))
                        <div id="success-message"
                            class="w-full px-4 py-2 text-center bg-white text-green-600 rounded-md shadow-sm text-sm mb-5">
                            {{ \Illuminate\Support\Facades\Session::get('success') }}
                        </div>
                    @endif
                </div>
            </form>
        </div>

    </div>
    <br>
    <div
        class="flex flex-col bg-white border border-green-200 rounded-lg shadow w-full dark:border-gray-700 dark:bg-gray-800 p-6">

        <div class="w-full text-center mb-4">
            <h5 class="text-4xl font-bold tracking-tight text-black dark:text-white">
                <u>Currently Running Enrollments</u>
            </h5>
        </div>

        <div class="relative w-full overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Department</th>
                        <th scope="col" class="px-6 py-3">Level</th>
                        <th scope="col" class="px-6 py-3">Semester</th>
                        <th scope="col" class="px-6 py-3">Start Date</th>
                        <th scope="col" class="px-6 py-3">End Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enrollments as $enrollment)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $enrollment['dept_code'] }}
                            </th>
                            <td class="px-6 py-4">{{ $enrollment['level'] }}</td>
                            <td class="px-6 py-4">{{ $enrollment['semester'] }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($enrollment['start_date'])->format('d.m.Y') }}
                            </td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($enrollment['end_date'])->format('d.m.Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>







    </div>

</div>
@endsection