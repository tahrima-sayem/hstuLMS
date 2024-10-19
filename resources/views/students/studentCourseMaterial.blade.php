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
</div>

@endsection