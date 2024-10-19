@extends('layouts.master')

@section('content')

<div class="container mx-auto p-4">
    <div class="flex flex-col md:flex-row items-center bg-white border border-green-200 rounded-lg shadow w-full dark:border-gray-700 dark:bg-gray-800">
                   
                    
    <div class="flex flex-col bg-white border border-green-200 rounded-lg shadow w-full dark:border-gray-700 dark:bg-gray-800 p-6">

    <div class="w-full text-center mb-4">
        <h5 class="text-4xl font-bold tracking-tight text-black dark:text-white">
            <u>Your Routine</u>
        </h5>
    </div>

    <div class="relative w-full overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Day</th>
                    <th scope="col" class="px-6 py-3">Slot 1</th>
                    <th scope="col" class="px-6 py-3">Slot 2</th>
                    <th scope="col" class="px-6 py-3">Slot 3</th>
                    <th scope="col" class="px-6 py-3">Slot 4</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">Sunday</td>
                    <td class="px-6 py-4">CSE 101</td>
                    <td class="px-6 py-4">CSE 202</td>
                    <td class="px-6 py-4">CSE 303</td>
                    <td class="px-6 py-4">CSE 404</td>
                </tr>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">Monday</td>
                    <td class="px-6 py-4">-</td>
                    <td class="px-6 py-4">CSE 102</td>
                    <td class="px-6 py-4">-</td>
                    <td class="px-6 py-4">CSE 104</td>
                </tr>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">Tuesday</td>
                    <td class="px-6 py-4">CSE 103</td>
                    <td class="px-6 py-4">-</td>
                    <td class="px-6 py-4">CSE 102</td>
                    <td class="px-6 py-4">CSE 104</td>
                </tr>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">Wednesday</td>
                    <td class="px-6 py-4">CSE 103</td>
                    <td class="px-6 py-4">CSE 104</td>
                    <td class="px-6 py-4">CSE 102</td>
                    <td class="px-6 py-4">-</td>
                </tr>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">Thursday</td>
                    <td class="px-6 py-4">-</td>
                    <td class="px-6 py-4">CSE 102</td>
                    <td class="px-6 py-4">-</td>
                    <td class="px-6 py-4">CSE 104</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

</div>

</div>
@endsection