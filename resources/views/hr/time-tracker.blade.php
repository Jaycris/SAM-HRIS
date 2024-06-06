@extends('layouts.time')
@section('content')
    <!-- Page-content -->
    <div class="mb-0 border-none shadow-none lg:w-[550px] card bg-white/70 dark:bg-zink-500/70">
        <div class="!px-10 !py-12 card-body">
            <div class="clock text-4xl mb-2" id="clock"></div>
            <div class="date text-xl mb-4" id="date"></div>
            <div id="attendance-form">
                <a href="#">
                    <img src="assets/images/Logo.png" alt="" class="hidden h-28 mx-auto dark:block">
                    <img src="assets/images/Logo.png" alt="" class="block h-28 mx-auto dark:hidden">
                </a>
                <div class="mt-8 text-center">
                    <div class="justify-center items-center mb-10">
                        <!-- Employee ID Input Form -->
                        <form id="employeeForm">
                            <input type="text" name="emp_id" id="employee-id" class="form-input" placeholder="Enter Employee ID" required>
                        </form>
                        <div style="margin-top: 5px;"></div>
                        <!-- Selection Type Below Employee ID Field -->
                        <select class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            data-choices="" data-choices-search-false="" name="breakType" id="break_type_start">
                            <option value="">Select Break</option>
                            <option value="lunch">Lunch Break</option>
                            <option value="coffe">Coffe Break</option>
                        </select>
                        <div style="margin-bottom: 5px;"></div>
                    </div>

                    <!-- Buttons row -->
                    <div class="flex justify-center items-center mt-2">
                        <form action="{{ route('attendancePunchIn') }}" method="POST" id="punchInForm">
                            @csrf
                            <input type="hidden" name="emp_id" id="employee-id-in">
                            <button type="submit" class="px-4 py-2 text-white bg-green-500 hover:bg-green-600 focus:bg-green-600 rounded">Punch In</button>
                        </form>
                        <form action="{{ route('attendancePunchOut') }}" method="POST" id="punchOutForm">
                            @csrf
                            <input type="hidden" name="emp_id" id="employee-id-out">
                            <button type="submit" class="px-4 py-2 text-white bg-red-500 hover:bg-red-600 focus:bg-red-600 rounded">Punch Out</button>
                        </form>
                        <form action="{{ route('attendanceBreakStart') }}" method="POST" id="breakStartForm">
                            @csrf
                            <input type="hidden" name="emp_id" id="employee-id-break-start">
                            <input type="hidden" name="breakType" id="break-type-hidden">
                            <button type="submit" class="btn-bg-color px-4 py-2 text-white bg-yellow-500 hover:bg-yellow-600 focus:bg-yellow-600 rounded">Start Break</button>
                        </form>
                        <form action="{{ route('attendanceBreakEnd') }}" method="POST" id="breakEndForm">
                            @csrf
                            <input type="hidden" name="emp_id" id="employee-id-break-end">
                            <button type="submit" class="btn-bg-color px-4 py-2 text-white bg-yellow-500 hover:bg-yellow-600 focus:bg-yellow-600 rounded">End Break</button>
                        </form>
                    </div>
                    <div class="mt-10 text-center">
                        <p class="mb-0 text-slate-500 dark:text-zink-200">Go back to <a href="{{ route('login') }}" class="font-semibold underline transition-all duration-150 ease-linear text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500"> Login </a> </p>
                    </div>
                </div>
                <div id="message" class="mt-4 text-md text-center">
                    @if(session('success'))
                        <p class="text-green-500 error-alert">{{ session('success') }}</p>
                    @endif
                    @if(session('error'))
                        <p class="text-red-500 error-alert">{{ session('error') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @section('script')
    <script>
        function updateTime() {
            var now = new Date();
            var options = { 
                timeZone: 'Asia/Manila', 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit', 
                hour12: true 
            };
            var time = new Intl.DateTimeFormat('en-US', options).format(now);
            
            var dateOptions = { 
                timeZone: 'Asia/Manila', 
                year: 'numeric', 
                month: '2-digit', 
                day: '2-digit' 
            };
            var date = new Intl.DateTimeFormat('en-US', dateOptions).format(now);
            
            document.getElementById('clock').textContent = time;
            document.getElementById('date').textContent = date;
        }

        setInterval(updateTime, 1000);
        window.onload = updateTime;

        document.getElementById('employee-id').addEventListener('input', function() {
            var employeeId = this.value;
            document.getElementById('employee-id-in').value = employeeId;
            document.getElementById('employee-id-out').value = employeeId;
            document.getElementById('employee-id-break-start').value = employeeId;
            document.getElementById('employee-id-break-end').value = employeeId;
        });

        document.getElementById('break_type_start').addEventListener('change', function() {
            var breakType = this.value;
            document.getElementById('break-type-hidden').value = breakType;
        });

        // document.getElementById('breakStartForm').addEventListener('submit', function(event) {
        //     var employeeId = document.getElementById('employee-id-break-start').value;
        //     var breakType = document.getElementById('break_type_start').value;
        //     if (employeeId.trim() === '' || breakType.trim() === '') {
        //         alert('Please enter an Employee ID and select a break type.');
        //         event.preventDefault();
        //     }
        // });
        document.getElementById('breakStartForm').addEventListener('submit', function(event) {
            var employeeId = document.getElementById('employee-id-break-start').value;
            var breakType = document.getElementById('break_type_start').value;
        });
    </script>
    @endsection
@endsection