@extends('layouts.time')
@section('content')

    <div class="mb-0 border-none shadow-none lg:w-[500px] card bg-white/70 dark:bg-zink-500/70">
        <div class="!px-10 !py-12 card-body">
            <div id="countDownText">
                <a href="https://samph.company/">
                    <img src="assets/images/logo-light.png" alt="" class="hidden h-6 mx-auto dark:block">
                    <img src="assets/images/logo-dark.png" alt="" class="block h-6 mx-auto dark:hidden">
                </a>
                <div class="mt-10">
                    <img src="assets/images/coming-soon-logo.png" alt="" class="h-64 mx-auto">
                </div>
                <div class="mt-8 text-center">
                    <h4 class="mb-4 text-2xl title-login text-custom-500 dark:text-purple-500">Under Maintenance</h4>
                    <p class="mb-6 text-slate-500 dark:text-zink-200">Sorry, we are currently undergoing maintenance.</p>
                    <div style="margin-bottom: 5px;"></div>
                </div>
            </div>
        </div>
    </div>

@endsection