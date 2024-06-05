@component('mail::message')
<div style="text-align: center;">
    <img src="{{ asset('path/to/your/logo.png') }}" alt="Company Logo" style="max-width: 200px;">
</div>

# Greetings!

Welcome to SAM HR Information System. We are excited to have you in our team.

@component('mail::button', ['url' => $actionUrl, 'color' => 'primary'])
Set Initial Password
@endcomponent

Thank you!

Regards,  
HRIS Portal

If you're having trouble clicking the "Set Initial Password" button, copy and paste the URL below
into your web browser: [{{ $actionUrl }}]({{ $actionUrl }})

© 2024 HRIS-Portal. All rights reserved.
@endcomponent