@extends('layouts.app')
@section('content')
    <div class="mb-0 w-screen lg:mx-auto lg:w-[500px] card shadow-lg border-none relative">
        <div class="!px-10 !py-12 card-body">
            <a href="#!">
                <img src="assets/images/Logo.png" alt="" class="hidden h-28 mx-auto dark:block">
                <img src="assets/images/Logo.png" alt="" class="block h-28 mx-auto dark:hidden">
            </a>

            <div class="mt-8 text-center">
                <h4 class="mb-1 text-custom-500 text-base-500 title-login">Welcome to SAM Intranet!</h4>
                <p class="text-slate-500 dark:text-zink-200">Sign in to continue.</p>
            </div>
            @if(Session::has('error'))
                <div class="text-sm text-red-500 error-alert" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            <form action="{{ route('login') }}" class="mt-10" id="" method="POST">
                @csrf
                <div class="hidden px-4 py-3 mb-3 text-sm text-green-500 border border-green-200 rounded-md bg-green-50 dark:bg-green-400/20 dark:border-green-500/50" id="successAlert">
                    You have <b>successfully</b> signed in.
                </div>
                <div class="mb-3">
                    <label for="username" class="inline-block mb-2 text-base font-medium">Email ID</label>
                    <input type="text" id="email" name="email" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Enter email" autocomplete="off">
                    @if($error = $errors->first('email'))
                        <div class="text-sm text-red-500">{{ $error }}</div>
                    @endif
                    <!-- <div id="username-error" class="hidden mt-1 text-sm text-red-500">Please enter a valid email address.</div> -->
                </div>
                <div class="mb-3">
                    <label for="password" class="inline-block mb-2 text-base font-medium">Password</label>
                    <input type="password" id="password" name="password" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Enter password" autocomplete="off">
                    @error('password')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                    @enderror
                    <!-- <div id="password-error" class="hidden mt-1 text-sm text-red-500">Password must be at least 8 characters long and contain both letters and numbers.</div> -->
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <input id="checkboxDefault1" class="border rounded-sm appearance-none size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400" type="checkbox" value="">
                        <label for="checkboxDefault1" class="inline-block text-base font-medium align-middle cursor-pointer">Remember me</label>
                    </div>
                    <div id="remember-error" class="hidden mt-1 text-sm text-red-500">Please check the "Remember me" before submitting the form.</div>
                </div>
                <div class="mt-10">
                    <button type="submit" class="btn-bg-color w-full text-white btn bg-custom-500 border-custom-500 ">Sign In</button>
                </div>
                <div class="mt-10 text-center">
                        <p class="mb-0 text-slate-500 dark:text-zink-200">Ready to work ? <a href="{{ route('time-tracker') }}" class="font-semibold underline transition-all duration-150 ease-linear text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500"> Attendance System</a> </p>
                </div>
            </form>
        </div>
    </div>

    @section('script')
       
    @endsection
@endsection
