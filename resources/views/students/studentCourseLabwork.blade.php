@extends('layouts.master')

@section('content')
<div class="container mx-auto mt-6">

    <div
        class="flex flex-col justify-between p-6 leading-normal w-full bg-white border border-green-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800">
        <div class="flex flex-col justify-between p-6 leading-normal w-full">
            <h6 class="mb-3 text-2xl font-bold text-gray-700 dark:text-black-400">
                {{$distributions->first()->course->code }}
            </h6>

            <h1 class="mb-2 text-4xl font-bold tracking-tight text-black-600 dark:text-white">Labworks</h1>
        </div>
    </div>
    </br></br>


    <div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Serial No</th>
                <th scope="col" class="px-6 py-3">Title</th>
                <th scope="col" class="px-6 py-3">Submit Task</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($labworks as $index => $labwork)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ asset('storage/' . $labwork->file) }}" class="text-blue-500 hover:text-blue-700" download>
                            {{ $labwork->title }}
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('gotoStudentSubmitLabwork', ['labwork_id' => $labwork->id]) }}" class="text-blue-500 hover:text-blue-700">
                            <button type="button" class="p-2 rounded-lg border bg-green-600 text-white">
                                <p>Upload</p>
                                <i class="fas fa-upload"></i>
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


</div>
@endsection