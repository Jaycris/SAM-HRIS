@extends('layouts.time')
@section('content')

    <div class="mb-0 border-none shadow-none lg:w-[500px] card bg-white/70 dark:bg-zink-500/70">
        <div class="!px-10 !py-12 card-body">
            <a href="https://samph.company/">
                <img src="assets/images/logo-light.png" alt="" class="hidden h-6 mx-auto dark:block">
                <img src="assets/images/logo-dark.png" alt="" class="block h-6 mx-auto dark:hidden">
            </a>
        
            <div class="mt-10">
                <img src="{{ asset('assets/images/error-500.png') }}" alt="" class="h-64 mx-auto">
            </div>
            <div class="mt-8 text-center">
                <h4 class="mb-2 title-login text-custom-500">Internal Server Error (500)</h4>
                <p class="mb-6 text-slate-500 dark:text-zink-200">Oops! Something went wrong on our end. Our team has been notified and is working on fixing the issue. Please try again later.</p>
                @if(in_array(Auth::user()->employee->designationType->designation, ['Chief Executive Officer', 'Chief Operation Officer', 'Human Resources']))
                <a href="{{ route('home')}}" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i data-lucide="home" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Back to Home</span></a>
                @else
                <a href="{{ route('emp')}}" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i data-lucide="home" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Back to Home</span></a>
                @endif
            </div>
        </div>
    </div>

@endsection