<x-app-layout>
    {{-- Inclua o CSS externo no <head> do layout, ou direto aqui se for blade independente --}}
    @push('styles')
        <link href="{{ asset('css/profile.css') }}" rel="stylesheet" />
    @endpush

    <div class="profile-background"></div>
    <div class="profile-overlay-dark"></div>

    <div class="profile-container">
       
        <div class="profile-card">
            <div class="profile-card-header">📝 Edit Information</div>
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Profile Information') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Update your account's profile information and email address.") }}
                    </p>
                </header>

                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')

                    <div class="profile-form-group">
                        <label for="name" class="profile-label">{{ __('Name') }}</label>
                        <input id="name" name="name" type="text" class="profile-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="profile-form-group">
                        <label for="email" class="profile-label">{{ __('Email') }}</label>
                        <input id="email" name="email" type="email" class="profile-input" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div>
                                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                    {{ __('Your email address is unverified.') }}

                                    <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="profile-flex-center">
                        <button type="submit" class="profile-btn profile-btn-primary">{{ __('Save') }}</button>

                        @if (session('status') === 'profile-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400"
                            >{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </form>
            </section>
        </div>

      
        <div class="profile-card">
            <div class="profile-card-header">🔒 Change Password</div>
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Update Password') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Ensure your account is using a long, random password to stay secure.') }}
                    </p>
                </header>

                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')

                    <div class="profile-form-group">
                        <label for="current_password" class="profile-label">{{ __('Current Password') }}</label>
                        <input id="current_password" name="current_password" type="password" class="profile-input" autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                    </div>

                    <div class="profile-form-group">
                        <label for="password" class="profile-label">{{ __('New Password') }}</label>
                        <input id="password" name="password" type="password" class="profile-input" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="profile-form-group">
                        <label for="password_confirmation" class="profile-label">{{ __('Confirm Password') }}</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="profile-input" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="profile-flex-center">
                        <button type="submit" class="profile-btn profile-btn-primary">{{ __('Save') }}</button>

                        @if (session('status') === 'password-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400"
                            >{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </form>
            </section>
        </div>

        {{-- Deletar Conta --}}
        <div class="profile-card">
            <div class="profile-card-header" style="border-color:#bf2a2a;">⚠️ Delete Account</div>
            <section class="space-y-6">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Delete Account') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                    </p>
                </header>

                <button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                    class="profile-btn profile-btn-danger"
                >{{ __('Delete Account') }}</button>

                <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Are you sure you want to delete your account?') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <div class="mt-6">
                            <label for="password" class="sr-only">{{ __('Password') }}</label>

                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="profile-input"
                                placeholder="{{ __('Password') }}"
                            />

                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                        </div>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>

                            <x-danger-button class="ms-3">
                                {{ __('Delete Account') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>
            </section>
        </div>
    </div>
</x-app-layout>
