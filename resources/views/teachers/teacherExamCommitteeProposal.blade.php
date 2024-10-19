@extends('layouts.master')

@section('content')
<div class="container mx-auto p-4">
    <div
        class="flex flex-col md:flex-row items-center bg-white border border-green-200 rounded-lg shadow w-full dark:border-gray-700 dark:bg-gray-800">
        <div class="flex flex-col justify-between p-6 leading-normal w-full">
            <h5 class="mb-2 text-4xl font-bold tracking-tight text-black-600 dark:text-white text-center">
                <u>Exam Committee</u>
            </h5>

            <form action="{{ route('examcommitteecreate') }}" method="POST"> <!-- Add action and method -->
                @csrf <!-- Include CSRF token for security -->
                <div class="grid gap-6 mb-6 md:grid-cols-1">
                    <div class="flex gap-4 mb-6">
                        <div class="flex-1">
                            <label for="exam_year" class="block text-sm font-medium text-gray-900 dark:text-white">Exam
                                Year :</label>
                            <input type="text" id="exam_year" name="year"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Year" required />
                        </div>
                        <div class="flex-1">
                            <label for="isregular"
                                class="block text-sm font-medium text-gray-900 dark:text-white invisible">Select:</label>
                            <select id="isregular" name="type"
                                class="choices bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Select</option>
                                <option value="Regular">Regular</option>
                                <option value="Repeat">Repeat</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="level" class="block text-sm font-medium text-gray-900 dark:text-white">Level
                            :</label>
                        <select id="level" name="level"
                            class="choices bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select Level</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div>
                        <label for="semester" class="block text-sm font-medium text-gray-900 dark:text-white">Semester
                            :</label>
                        <select id="semester" name="semester"
                            class="choices bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select Semester</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                        </select>
                    </div>
                    <div>
                        <label for="chairman" class="block text-sm font-medium text-gray-900 dark:text-white">Chairman
                            :</label>
                        <select id="chairman" name="chairman"
                            class="choices bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select Chairman</option>
                            @foreach ($teachers as $teacher)                         <option value="{{ $teacher->id }}">{{ $teacher->user->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="member_1" class="block text-sm font-medium text-gray-900 dark:text-white">Member 1
                            :</label>
                        <select id="member_1" name="member_1"
                            class="choices bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select Member 1</option>
                            @foreach ($teachers as $teacher)                              <option value="{{ $teacher->id }}">{{ $teacher->user->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="member_2" class="block text-sm font-medium text-gray-900 dark:text-white">Member 2
                            :</label>
                        <select id="member_2" name="member_2"
                            class="choices bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select Member 2</option>
                            @foreach ($teachers as $teacher)                         <option value="{{ $teacher->id }}">{{ $teacher->user->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <br>
                <div class="flex justify-center">
                    <button type="submit"
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create</button>
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
</div>
@endsection