@extends('layouts.master')

@section('content')
<div class="container mx-auto p-4">

    <a href="#" class="flex flex-col md:flex-row items-center bg-white border border-green-200 rounded-lg shadow w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 mb-6">
        <div class="flex flex-col justify-between p-6 leading-normal w-full">

            <h1 class="mb-2 text-4xl font-bold tracking-tight text-black-600 dark:text-white">Enrollment</h1>
        </div>
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Fee Details</h2>
            <p class="text-gray-700 dark:text-gray-400 mb-2">Academic Total Fee: 3500</p>
            <p class="text-gray-700 dark:text-gray-400 mb-2">Hall Fee: 500</p>
            <p class="text-gray-700 dark:text-gray-400 mb-2">Total Fee: 4000</p>
            <p class="text-gray-700 dark:text-gray-400 mb-6">Last date: 27-10-2024</p>


            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Pay
            </button>
        </div>


        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Repeat Exams</h2>
            <p class="text-gray-700 dark:text-gray-400 mb-2">You can sit for the following courses:</p>


            <div class="mb-6">
                <label class="flex items-center mb-2">
                    <input type="checkbox" class="mr-2"> CSE 101
                </label>
                <label class="flex items-center mb-2">
                    <input type="checkbox" class="mr-2"> CSE 102
                </label>

            </div>


            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Pay
            </button>
        </div>
    </div>


    <div class="mt-8 bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4">Improvement Options</h2>
        <p class="text-gray-700 dark:text-gray-400 mb-2">You can select any two of the following courses:</p>


        <div class="mb-6">
            <label class="flex items-center mb-2">
                <input type="checkbox" class="mr-2"> CSE 201
            </label>
            <label class="flex items-center mb-2">
                <input type="checkbox" class="mr-2"> CSE 202
            </label>

        </div>


        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Pay
        </button>
    </div>

</div>
@endsection