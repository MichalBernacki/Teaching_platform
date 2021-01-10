<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.change.confirm') }}">
            @csrf

            <!-- Password_old -->
            <div class="mt-4">
                <x-label for="password_old" :value="__('Old password')" />

                <x-input id="password_old" class="block mt-1 w-full" type="password" name="password_old" required />
            </div>

            <div class="mt-4">
                <x-label for="password_new" :value="__('New password')" />

                <x-input id="password_new" class="block mt-1 w-full" type="password" name="password_new" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_new_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_new_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_new_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Change Password') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
