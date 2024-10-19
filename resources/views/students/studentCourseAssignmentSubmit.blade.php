@extends('layouts.master')

@section('content')
<div class="container mx-auto mt-6">
    <div
        class="flex flex-col md:flex-row items-center bg-white border border-green-200 rounded-lg shadow w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <div class="flex flex-col justify-between p-6 leading-normal w-full">
            <h6 class="mb-3 text-2xl font-bold text-gray-700 dark:text-black-400">
                {{$distributions->first()->course->code }}
            </h6>
            <h5 class="mb-2 text-4xl font-bold tracking-tight text-black-600 dark:text-white">Assignment</h5>
        </div>
    </div>
    </br>
    </br>
    <div
        class="flex flex-col md:flex-row items-center bg-white border border-green-200 rounded-lg shadow w-full dark:border-gray-700 dark:bg-gray-800">
        <div class="flex flex-col justify-between p-6 leading-normal w-full">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-black-600 dark:text-white">
                <u>Submit Assignment:</u>
            </h5>

            <form action="{{ route('submitAssignment', ['assignment_id' => $assignment->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="mb-5 flex items-center">
                    <label for="title"
                        class="text-sm font-medium text-gray-900 dark:text-white mr-2 shrink-0">Title:</label>
                    <span class="ml-2">{{ $assignment->title }}</span>
                </div>

                <div class="mb-5 flex items-center">
                    <label for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-2 shrink-0">Description:</label>
                    <span class="ml-2">{{ $assignment->description }}</span>
                </div>

                <div class="mb-5 flex items-center">
                    <label class="text-sm font-medium text-gray-900 dark:text-white mr-2 shrink-0" for="file">Upload
                        file:</label>
                    <input
                        class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        name="file" id="file" type="file" required>
                </div>

                <div class="flex justify-center">
                    <button type="submit"
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Submit
                    </button>
                </div>

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
            </form>
        </div>


    </div>

</div>
@endsection