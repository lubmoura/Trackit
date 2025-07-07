<x-guest-layout>
    <div class="text-center mb-4">
        <h1 class="h3 fw-bolder text-white shadow-sm">Join in Trackit</h1>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="form-control rounded">
            @error('name')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   class="form-control rounded">
            @error('email')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <div class="input-group">
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="form-control rounded-start">
                <button class="btn btn-outline-secondary rounded-end" type="button" id="togglePassword" style="border-left: 0;">
                    <i class="fa-solid fa-eye" id="toggleIcon"></i>
                </button>
            </div>
            @error('password')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password Confirmation --}}
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <div class="input-group">
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="form-control rounded-start">
                <button class="btn btn-outline-secondary rounded-end" type="button" id="togglePasswordConfirm" style="border-left: 0;">
                    <i class="fa-solid fa-eye" id="toggleIconConfirm"></i>
                </button>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <a class="text-white text-decoration-none" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
        </div>
    </form>

    {{-- Script para mostrar/ocultar senha --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function setupToggle(toggleId, inputId, iconId) {
                const toggleBtn = document.getElementById(toggleId);
                const input = document.getElementById(inputId);
                const icon = document.getElementById(iconId);

                toggleBtn.addEventListener('click', function () {
                    const isPassword = input.type === 'password';
                    input.type = isPassword ? 'text' : 'password';
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                });
            }

            setupToggle('togglePassword', 'password', 'toggleIcon');
            setupToggle('togglePasswordConfirm', 'password_confirmation', 'toggleIconConfirm');
        });
    </script>
</x-guest-layout>
