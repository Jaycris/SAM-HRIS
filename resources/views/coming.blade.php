@extends('layouts.time')
@section('content')

    <div class="mb-0 border-none shadow-none lg:w-[500px] card bg-white/70 dark:bg-zink-500/70">
        <div class="!px-10 !py-12 card-body">
            <div id="countDownText">
                <a href="#">
                    <img src="assets/images/logo-light.png" alt="" class="hidden h-6 mx-auto dark:block">
                    <img src="assets/images/logo-dark.png" alt="" class="block h-6 mx-auto dark:hidden">
                </a>
                <div class="mt-10">
                    <img src="assets/images/coming-soon-logo.png" alt="" class="h-64 mx-auto">
                </div>
                <div class="mt-8 text-center">
                    <h4 class="mb-4 text-2xl text-purple-500 dark:text-purple-500">Coming Soon ...</h4>
                    <p class="mb-6 text-slate-500 dark:text-zink-200">Thank you for your patience! We are working hard to bring you new and exciting features. Stay tuned as we finalize the details and ensure everything is perfect. We appreciate your understanding and can't wait to share this with you soon.</p>
                    <div style="margin-bottom: 5px;"></div>
                    @if(in_array(Auth::user()->employee->designationType->designation, ['Chief Executive Officer', 'Chief Operation Officer', 'Human Resources']))
                    <a href="{{ route('home')}}" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i data-lucide="home" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Back to Home</span></a>
                    @else
                    <a href="{{ route('emp')}}" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i data-lucide="home" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Back to Home</span></a>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection