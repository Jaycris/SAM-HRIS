<x-mail::layout>
    {{-- Header --}}
    <x-slot name="header">
        <x-mail::header :url="config('app.url')">
            {{-- Custom header content --}}
            <img src="{{ asset('assets/images/Logo-landscape.png') }}" style="max-width: 200px;" alt="SAM Logo">
        </x-mail::header>
    </x-slot>

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        <x-slot name="subcopy">
            <x-mail::subcopy>
                {{ $subcopy }}
            </x-mail::subcopy>
        </x-slot>
    @endisset

    {{-- Footer --}}
    <x-slot name="footer">
        <x-mail::footer>
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        </x-mail::footer>
    </x-slot>
</x-mail::layout>