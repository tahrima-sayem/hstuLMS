@extends('layouts.master')

@section('content')
<div class="container mx-auto p-4">
    <div
        class="flex flex-col justify-between p-6 leading-normal w-full bg-white border border-green-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800">
        <h6 class="mb-3 text-2xl font-bold text-gray-700 dark:text-black-400">{{$distributions->first()->course->code }}
        </h6>
        <h5 class="mb-2 text-4xl font-bold tracking-tight text-black-600 dark:text-white">Labwork</h5>
    </div>
    </br></br>
    <div
        class="flex flex-col md:flex-row items-center bg-white border border-green-200 rounded-lg shadow w-full dark:border-gray-700 dark:bg-gray-800">
        <div class="flex flex-col justify-between p-6 leading-normal w-full">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-black-600 dark:text-white">
                <u>Create new Labwork</u>
            </h5>

            <!-- Form starts -->
            <form action="{{ route('labworkstore') }}" method="POST" enctype="multipart/form-data">
                @csrf <!-- CSRF token for security -->

                <!-- Title Input -->
                <div class="mb-5 flex items-center">
                    <label for="title"
                        class="text-sm font-medium text-gray-900 dark:text-white mr-2 shrink-0">Title:</label>
                    <input type="text" name="title" id="title" placeholder="Enter title here" required
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <!-- Description Textarea -->
                <div class="mb-5 flex items-center">
                    <label for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-2 shrink-0">Description:</label>
                    <textarea name="description" id="description" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="About The Labwork"></textarea>
                </div>

                <!-- File Upload Input -->
                <div class="mb-5 flex items-center">
                    <label class="text-sm font-medium text-gray-900 dark:text-white mr-2 shrink-0" for="file">Upload
                        file:</label>
                    <input
                        class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        name="file" id="file" type="file" required>
                </div>

                <!-- Date Input -->
                <div class="mb-5 flex items-center">
                    <label for="date"
                        class="text-sm font-medium text-gray-900 dark:text-white mr-2 shrink-0">Date:</label>
                    <input type="date" name="date" id="date" required
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <!-- Course ID Input (Hidden or Select Dropdown) -->
                <input type="hidden" name="course_id" value="{{$distributions->first()->course->id }}">
                <!-- Assuming you have the course ID available -->

                <!-- Submit Button -->
                <button type="submit"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    ADD
                </button>
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
            <!-- Form ends -->
        </div>

    </div>
    <br>
    <br>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        SL
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Watch Submission
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($distributions as $index => $distribution)
                    @foreach ($distribution->course->labWorks as $labwork)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $index + 1 }} <!-- SL -->
                            </th>
                            <td class="px-6 py-4">
                                @if($labwork->file)
                                    <a href="{{ asset('storage/' . $labwork->file) }}" class="text-blue-500 hover:text-blue-700"
                                        download>
                                        {{ $labwork->title }} <!-- Labwork Title -->
                                    </a>
                                @else
                                    {{ $labwork->title }} <!-- If no file, just display title -->
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('gototeacherCourseLabworkAssesment', ['labwork_id' => $labwork->id, 'index' => $index + 1]) }}"
                                    class="text-blue-500 hover:text-blue-700">
                                    <p>View</p>
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>


</div>

@endsection