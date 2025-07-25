<x-guest-layout>
    <div class="text-center mb-4">
        <h1 class="h3 fw-bolder text-white shadow-sm">Sign in to Trackit</h1> 
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-3" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                   class="form-control rounded">
            @error('email')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
            
                <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <div class="input-group">
                    <input id="password" type="password" name="password" required autocomplete="current-password" 
                        class="form-control rounded-start">
                    <button class="btn btn-outline-secondary rounded-end" type="button" id="togglePassword">
                        <i class="fa-solid fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>


        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
            <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            @if (Route::has('password.request'))
                <a class="text-white text-decoration-none" href="{{ route('password.request') }}"> 
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="btn btn-primary">
                {{ __('Log in') }}
            </button>
        </div>
    </form>

    {{-- Script q mostra/ocultar senha --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            togglePassword.addEventListener('click', function () {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                toggleIcon.classList.toggle('fa-eye');
                toggleIcon.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</x-guest-layout>
