@extends('layouts.set')
    <div style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
        <div style="max-width: 450px; width: 100%; padding: 30px;">
            <div style="background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); text-align: center;">
            <img src="{{ asset('assets/images/Logo.png') }}" alt="Logo" style="width: 100px; margin-bottom: 20px;">
            <h2 style="font: roboto; color: #4CAF50;">Welcome to PHREMS!</h2>
            <p style="font: roboto; font-size: 20px; color: #757575;">Set Your Password.</p>
            <form method="POST" action="{{ route('save-password', $user->id) }}">
                @csrf
                <div style="margin-bottom: 20px; text-align: left;">
                    <label for="password" style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Password</label>
                    <input type="password" id="password" name="password" style="width: 100%; padding: 10px; border: 1px solid #d2d6dc; border-radius: 4px;" placeholder="Enter password" autocomplete="off" required>
                    @error('password')
                        <div style="font-size: 14px; color: #e53e3e; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                <div style="margin-bottom: 20px; text-align: left;">
                    <label for="password-confirm" style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Confirm Password</label>
                    <input type="password" id="password-confirm" name="password_confirmation" style="width: 100%; padding: 10px; border: 1px solid #d2d6dc; border-radius: 4px;" placeholder="Confirm password" autocomplete="off" required>
                </div>
                <div style="text-align: center;">
                    <button type="submit" style="padding: 10px 20px; background-color: #000080; color: #ffffff; border: none; border-radius: 4px; cursor: pointer;">Set Password</button>
                </div>
            </form>
        </div>
    </div>