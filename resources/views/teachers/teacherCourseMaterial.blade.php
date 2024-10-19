@extends('layouts.master')

@section('content')
<div class="container mx-auto p-4">
    <div
        class="flex flex-col justify-between p-6 leading-normal w-full bg-white border border-green-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800">
        <h6 class="mb-3 text-2xl font-bold text-gray-700 dark:text-black-400">{{$distributions->first()->course->code }}
        </h6>
        <h5 class="mb-2 text-4xl font-bold tracking-tight text-black-600 dark:text-white">Materials</h5>
    </div>
    </br></br>
    <div
        class="flex flex-col md:flex-row items-center bg-white border border-green-200 rounded-lg shadow w-full dark:border-gray-700 dark:bg-gray-800">
        <div
            class="flex flex-col md:flex-row items-center bg-white border border-green-200 rounded-lg shadow w-full dark:border-gray-700 dark:bg-gray-800">
            <div class="flex flex-col justify-between p-6 leading-normal w-full">
                <h5 class="mb-2 text-xl font-bold tracking-tight text-black-600 dark:text-white"><u>Upload New
                        Material</u></h5>

                <form action="{{ route('materialsstore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="course_id" value="{{$distributions->first()->course->id }}">
                    <div class="mb-5 flex items-center">
                        <label for="title" class="text-sm font-medium text-gray-900 dark:text-white mr-2 shrink-0">Title
                            :</label>
                        <input type="text" name="title" id="title" placeholder="Enter title here"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div class="mb-5 flex items-center">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-2 shrink-0">Description
                            :</label>
                        <textarea name="description" id="description" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="About the material"></textarea>
                    </div>
                    <div class="mb-5 flex items-center">
                        <label class="text-sm font-medium text-gray-900 dark:text-white mr-2 shrink-0" for="file">Upload
                            file :</label>
                        <input name="file"
                            class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="file" type="file" required>
                    </div>

                    <div class="flex justify-center w-full">
                        <button type="submit"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 w-1/3">
                            <!-- Button with 1/3 width -->
                            ADD Material
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
                    </div>
                </form>
            </div>
        </div>

    </div>
    </br>
    </br>
    @foreach ($materials as $material)
        <div
            class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $loop->index + 1 }}. {{ $material->title }}
            </h5>
            <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">{{ $material->description }}</p>
            <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 rtl:space-x-reverse">
                <a href="{{ asset('storage/' . $material->file) }}" download
                    class="sm:w-20 h-12 px-4 bg-green-800 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg flex items-center justify-center dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                    <i class="fas fa-download"></i>
                    <div class="text-left rtl:text-right">
                        <div class="mb-1 text-xs">Download</div>
                    </div>
                </a>
            </div>
        </div>
        <br>
    @endforeach

    </br>
    </br>
</div>

@endsection