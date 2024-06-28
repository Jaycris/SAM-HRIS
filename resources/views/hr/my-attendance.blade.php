@extends('layouts.master')
@section('content')
    <div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
        <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
            <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

                <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                    <div class="grow">
                        <h5 class="text-16">My Attendance</h5>
                    </div>
                    <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                        <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                            <a href="#!" class="text-slate-400 dark:text-zink-200">My Attendance</a>
                        </li>
                        <li class="text-slate-700 dark:text-zink-100">
                            My Attendance
                        </li>
                    </ul>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-1 xl:grid-cols-12 gap-x-5">
                    <div class="xl:col-span-12 lg:col-span-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="grid grid-cols-1 gap-4 mb-5 lg:grid-cols-2 xl:grid-cols-12">
                                    <div class="xl:col-span-3">
                                        <form id="filterForm" action="{{ route('emp.date') }}" method="GET">
                                            @csrf
                                            <input type="text" name="date" id="datepicker" class="form-input datepicker border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-provider="flatpickr" data-date-format="m,d,Y" data-range-date="true" placeholder="Select Date" onchange="this.form.submit()">
                                        </form>                        
                                    </div><!--end col-->
                                </div><!--end grid-->
                                <div class="overflow-x-auto">
                                    <table class="w-full whitespace-nowrap">
                                        <thead class="ltr:text-left rtl:text-right bg-slate-100 text-slate-500 dark:text-zink-200 dark:bg-zink-600">
                                            <tr>
                                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Date</th>
                                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Employee ID</th>
                                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Name</th>
                                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Time In</th>
                                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Time Out</th>
                                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Meal Break</th>
                                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Work Hours</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($attendances as $attendance)
                                            <tr>
                                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                        {!! \Carbon\Carbon::parse($attendance->attendance_date)->format('d M, Y') ?? 'N/A' !!}
                                                    <span class="px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-white border-slate-400 text-slate-500 dark:bg-zink-700 dark:border-zink-400 dark:text-zink-200 ltr:ml-1 rtl:mr-1 align-middle">
                                                        {!! \Carbon\Carbon::parse($attendance->attendance_date)->format('D') !!}
                                                    </span>                                    
                                                </td>
                                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $attendance->employee->emp_id }}</td>
                                                <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 flex items-center gap-3 Name">
                                                    <div class="avatar w-6 h-6 rounded-full shrink-0 bg-slate-100">
                                                        <img src="{{ URL::to('/assets/images/employee/'. $attendance->employee->avatar) }}" alt="" class="h-6 rounded-full">
                                                    </div>
                                                    <h6 class="grow">{{ $attendance->employee->fullName() }}</h6>         
                                                </td>
                                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ isset($attendance->timeIn) ? \Carbon\Carbon::createFromFormat('H:i:s', $attendance->timeIn)->format('h:i A') : 'N/A' }}</td>
                                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ isset($attendance->timeOut) ? \Carbon\Carbon::createFromFormat('H:i:s', $attendance->timeOut)->format('h:i A') : 'N/A' }}</td>
                                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                                    <span class="inline-block rounded bg-yellow-100 text-yellow-500 px-2.5 py-1 text-xs dark:bg-yellow-500/20 dark:text-yellow-400">
                                                        {{ $attendance->getTotalBreakTime() }}
                                                    </span>
                                                </td>
                                                <td class="px-2.5 py-0.5 border-y border-slate-200 dark:border-zink-500">
                                                    <span class="inline-block rounded bg-custom-100 text-custom-500 px-2.5 py-1 text-xs dark:bg-custom-500/20 dark:hover:bg-custom-500">
                                                        {{ $attendance->getTotalHoursWorked() }}
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="flex flex-col items-center gap-4 px-4 mt-4 md:flex-row" id="pagination-element">
                                    <div class="grow">
                                        <p class="text-slate-500 dark:text-zink-200">Showing <b><b>{{ $attendances->lastItem() }}</b> of <b class="total-records">{{ $attendances->total() }}</b> Results
                                    </div>

                                    <div class="col-sm-auto mt-sm-0">
                                        <div class="flex gap-2 pagination-wrap justify-content-center">
                                            {{ $attendances->appends(request()->query())->links('pagination.custom') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end grid-->
            </div>

        </div>
        <!-- container-fluid -->
    </div>
    @section('script')
    {{-- date filter js --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr('#datepicker', {
                dateFormat: 'Y-m-d', // Use Y-m-d to match the expected format
            });
        });
    </script>
@endsection
@endsection