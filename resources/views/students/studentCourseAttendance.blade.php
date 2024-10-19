@extends('layouts.master')

@section('content')
<div class="container mx-auto p-4">
    <div
        class="flex flex-col justify-between p-6 leading-normal w-full bg-white border border-green-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800">
        <h6 class="mb-3 text-2xl font-bold text-gray-700 dark:text-black-400">{{$distributions->first()->course->code }}
        </h6>
        <h5 class="mb-2 text-4xl font-bold tracking-tight text-black-600 dark:text-white">Attendance</h5>
    </div>
    </br></br>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">


        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Class No</th>
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $index => $attendance)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $index + 1 }}</th>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}</td>
                            <td class="px-6 py-4">{{ $attendance->attendance_status == 1 ? 'Present' : 'Absent' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



        <div class="flex flex-col items-center justify-center">
            <div class="w-full max-w-xs bg-white border border-green-200 rounded-lg shadow p-4">
                @php
                    // Calculate present and absent percentages
                    $presentPercentage = $attendancePercentage;
                    $absentPercentage = 100 - $presentPercentage;
                @endphp

                <div class="flex justify-between mb-2">
                    <span class="font-bold text-yellow-600">Present</span>
                    <span>{{ number_format($presentPercentage, 2) }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-6 mb-4">
                    <div class="bg-green-500 h-6 rounded-full"
                        style="width: {{ number_format($presentPercentage, 2) }}%;"></div>
                </div>

                <div class="flex justify-between mb-2">
                    <span class="font-bold text-yellow-600">Absent</span>
                    <span>{{ number_format($absentPercentage, 2) }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-6">
                    <div class="bg-yellow-500 h-6 rounded-full"
                        style="width: {{ number_format($absentPercentage, 2) }}%;"></div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection