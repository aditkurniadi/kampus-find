<x-layouts.auth_layout>
    <x-slot:title>
        Register - {{ config('app.name') }}
    </x-slot:title>
    <div class="flex min-h-full">

        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <x-app-logo-icon class="h-20 w-auto text-indigo-500" />

                    <h2 class="mt-8 text-2xl/9 font-bold tracking-tight text-white">
                        {{ __('Create your account Kampus - Find') }}</h2>

                    @if (Route::has('login'))
                        <p class="mt-2 text-sm/6 text-gray-400">
                            {{ __('Already have an account?') }}
                            <a href="{{ route('login') }}" wire:navigate
                                class="font-semibold text-indigo-400 hover:text-indigo-300">{{ __('Sign in') }}</a>
                        </p>
                    @endif
                </div>

                <div class="mt-10">
                    <div>
                        <form action="{{ route('register.store') }}" method="POST" class="space-y-6">
                            @csrf

                            <div>
                                <label for="name"
                                    class="block text-sm/6 font-medium text-gray-100">{{ __('Name') }}</label>
                                <div class="mt-2">
                                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                                        required autocomplete="name" autofocus
                                        class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />

                                    @error('name')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="email"
                                    class="block text-sm/6 font-medium text-gray-100">{{ __('Email address') }}</label>
                                <div class="mt-2">
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                        required autocomplete="email"
                                        class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />

                                    @error('email')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="password"
                                    class="block text-sm/6 font-medium text-gray-100">{{ __('Password') }}</label>
                                <div class="mt-2">
                                    <input id="password" type="password" name="password" required
                                        autocomplete="new-password"
                                        class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />

                                    @error('password')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm/6 font-medium text-gray-100">{{ __('Confirm Password') }}</label>
                                <div class="mt-2">
                                    <input id="password_confirmation" type="password" name="password_confirmation"
                                        required autocomplete="new-password"
                                        class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />

                                    @error('password_confirmation')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <button type="submit"
                                    class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="mt-10">
                        <div class="relative">
                            <div aria-hidden="true" class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-700"></div>
                            </div>
                            <div class="relative flex justify-center text-sm/6 font-medium">
                                <span class="bg-gray-900 px-6 text-gray-300">Atau Log in melalui</span>
                            </div>
                        </div>

                        <a href="{{ route('google.login') }}"
                            class="flex w-full mt-3 items-center justify-center gap-3 rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white inset-ring inset-ring-white/5 hover:bg-white/20 focus-visible:inset-ring-transparent">
                            <svg viewBox="0 0 24 24" aria-hidden="true" class="h-5 w-5">
                                <path
                                    d="M12.0003 4.75C13.7703 4.75 15.3553 5.36002 16.6053 6.54998L20.0303 3.125C17.9502 1.19 15.2353 0 12.0003 0C7.31028 0 3.25527 2.69 1.28027 6.60998L5.27028 9.70498C6.21525 6.86002 8.87028 4.75 12.0003 4.75Z"
                                    fill="#EA4335" />
                                <path
                                    d="M23.49 12.275C23.49 11.49 23.415 10.73 23.3 10H12V14.51H18.47C18.18 15.99 17.34 17.25 16.08 18.1L19.945 21.1C22.2 19.01 23.49 15.92 23.49 12.275Z"
                                    fill="#4285F4" />
                                <path
                                    d="M5.26498 14.2949C5.02498 13.5699 4.88501 12.7999 4.88501 11.9999C4.88501 11.1999 5.01998 10.4299 5.26498 9.7049L1.275 6.60986C0.46 8.22986 0 10.0599 0 11.9999C0 13.9399 0.46 15.7699 1.28 17.3899L5.26498 14.2949Z"
                                    fill="#FBBC05" />
                                <path
                                    d="M12.0004 24.0001C15.2404 24.0001 17.9654 22.935 19.9454 21.095L16.0804 18.095C15.0054 18.82 13.6204 19.245 12.0004 19.245C8.8704 19.245 6.21537 17.135 5.2654 14.29L1.27539 17.385C3.25539 21.31 7.3104 24.0001 12.0004 24.0001Z"
                                    fill="#34A853" />
                            </svg>
                            <span class="text-sm/6 font-semibold">Google</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative hidden w-0 flex-1 lg:block">
            <img src="https://images.unsplash.com/photo-1496917756835-20cb06e75b4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto:format&fit=crop&w=1908&q=80"
                alt="" class="absolute inset-0 size-full object-cover" />
        </div>
    </div>
</x-layouts.auth_layout>
