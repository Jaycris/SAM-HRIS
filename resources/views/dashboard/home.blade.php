@extends('layouts.master')

@section('content')
<!-- Page-content -->
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Human Resources Information Systems</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboards</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">HR</li>
                </ul>
            </div>
                <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
                    <div class="col-span-12 md:order-1 xl:col-span-8 2xl:col-span-8">
                        <h1 class="mb-2">Welcome {{Auth::user()->employee->fname}}</h1>
                        <p class="mb-5 text-slate-500 dark:text-zink-200">Streamline your workday with our Human Resource Information System (HRIS). 
                            Here, you can easily manage your personal information, access important documents, track your leave balances, 
                            and stay updated with company news. We're here to support you, ensuring a smooth and efficient experience. Let's make your work life easier!</p>
                    </div>
                    <div class="col-span-12 md:order-2 xl:col-span-4 2xl:col-start-9 card">
                        <div class="p-2 h-full flex items-center justify-center"> <!-- Set flexbox for centering -->
                            <div class="grid grid-cols-3 gap-4 w-full"> <!-- Added gap and full width -->
                                <div class="px-2 py-2 flex flex-col justify-center items-center text-center border-slate-200 dark:border-zinc-500 ltr:border-r rtl:border-l last:border-0">
                                    <h6 class="mb-0 font-bold text-xl"><span class="counter-value" data-target="0"></span></h6>
                                    <p class="text-slate-500 dark:text-zinc-200 text-md">Absent</p>
                                </div>
                                <div class="px-2 py-2 flex flex-col justify-center items-center text-center border-slate-200 dark:border-zinc-500 ltr:border-r rtl:border-l last:border-0">
                                    <h6 class="mb-0 font-bold text-xl"><span class="counter-value" data-target="{{ $attendances }}"></span></h6>
                                    <p class="text-slate-500 dark:text-zinc-200 text-md">Attendance</p>
                                </div>
                                <div class="px-2 py-2 flex flex-col justify-center items-center text-center border-slate-200 dark:border-zinc-500 ltr:border-r rtl:border-l last:border-0">
                                    <h6 class="mb-0 font-bold text-xl"><span class="counter-value" data-target="0"></span></h6>
                                    <p class="text-slate-500 dark:text-zinc-200 text-md">Late</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="col-span-12 md:order-3 lg:col-span-6 2xl:col-span-3 card">
                    <div class="card-body">
                        <div class="grid grid-cols-12">
                            <div class="col-span-8 md:col-span-9">
                                <p class="text-slate-500 dark:text-slate-200">Total Employee</p>
                                <h5 class="mt-3 mb-4"><span class="counter-value" data-target="{{ $empCnt }}">{{ $empCnt }}</span></h5>
                            </div>
                            <div class="col-span-4 md:col-span-3">
                                <div id="totalEmployee" data-chart-colors='["bg-custom-500"]' dir="ltr" class="grow apex-charts"></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 mt-3">
                            <p class="text-slate-500 dark:text-slate-200">This Month</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:order-4 lg:col-span-6 2xl:col-span-3 card">
                    <div class="card-body">
                        <div class="grid grid-cols-12">
                            <div class="col-span-8 md:col-span-9">
                                <p class="text-slate-500 dark:text-slate-200">Total Application</p>
                                <h5 class="mt-3 mb-4"><span class="counter-value" data-target="0">0</span></h5>
                            </div>
                            <div class="col-span-4 md:col-span-3">
                                <div id="totalApplication" data-chart-colors='["bg-purple-500"]' dir="ltr" class="grow apex-charts"></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 mt-3">
                            <p class="text-slate-500 dark:text-slate-200">This Month</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:order-7 2xl:order-5 lg:col-span-12 2xl:col-span-6 2xl:row-span-2 card">
                    <div class="card-body">
                        <div class="flex items-center gap-2 MB-3">
                            <h6 class="mb-0 text-15 grow">Application Received</h6>
                            <div class="relative flex items-center gap-2 dropdown shrink-0">
                                <button type="button" class="flex items-center justify-center p-0 text-xs text-white size-8 btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">All</button>
                            </div>
                        </div>
                        <div id="applicationReceivedChart" class="apex-charts" data-chart-colors='["bg-custom-500", "bg-green-500"]' dir="ltr"></div>
                    </div>
                </div>
                 <div class="col-span-12 md:order-5 2xl:order-6 lg:col-span-6 2xl:col-span-3 card">
                    <div class="card-body">
                        <div class="grid grid-cols-12">
                            <div class="col-span-8 md:col-span-9">
                                <p class="text-slate-500 dark:text-slate-200">Hired Candidates</p>
                                <h5 class="mt-3 mb-4"><span class="counter-value" data-target="0">0</span></h5>
                            </div>
                            <div class="col-span-4 md:col-span-3">
                                <div id="hiredCandidates" data-chart-colors='["bg-green-500"]' dir="ltr" class="grow apex-charts"></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 mt-3">
                            <p class="text-slate-500 dark:text-slate-200">This Month</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:order-6 2xl:order-7 lg:col-span-6 2xl:col-span-3 card">
                    <div class="card-body">
                        <div class="grid grid-cols-12">
                            <div class="col-span-8 md:col-span-9">
                                <p class="text-slate-500 dark:text-slate-200">Rejected Candidates</p>
                                <h5 class="mt-3 mb-4"><span class="counter-value" data-target="0">0</span></h5>
                            </div>
                            <div class="col-span-4 md:col-span-3">
                                <div id="rejectedCandidates" data-chart-colors='["bg-red-500"]' dir="ltr" class="grow apex-charts"></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 mt-3">
                            <p class="text-slate-500 dark:text-slate-200">This Month</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
<!-- End Page-content -->

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var options = {
                chart: {
                    type: 'bar',
                    height: 100
                },
                series: [{
                    name: 'Total Employees',
                    data: [{{ $empCnt }}]
                }],
                colors: ['#5A8DEE'],
                xaxis: {
                    categories: ['Total']
                }
            }

            var chart = new ApexCharts(document.querySelector("#totalEmployee"));
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var options = {
                chart: {
                    type: 'bar',
                    height: 100
                },
                series: [{
                    name: 'Total Application',
                    data: [{{ 0 }}]
                }],
                colors: ['#5A8DEE'],
                xaxis: {
                    categories: ['Total']
                }
            }

            var chart = new ApexCharts(document.querySelector("#totalApplication"));
        });
    </script>
@endsection
@endsection
