<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('add.balance', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        <x-input-label for="balance" :value="__('Balance')" />
                        <x-text-input id="balance" name="balance" type="number" class="mt-1 block w-full" :value="old('balance', $user->balance)" />
                        <x-input-error class="mt-2" :messages="$errors->get('balance')" />
                        <x-primary-button class="mt-2">Add Balance</x-primary-button>
                    </form>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="/picture-route" enctype="multipart/form-data">
                        @csrf
                        <x-input-label for="profile_picture" :value="__('Profile Picture')" />
                        <x-text-input id="profile_picture" name="profile_picture" type="file" class="mt-1 block w-full" :value="old('profile_picture', $user->profile_picture)" />
                        <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
                        <x-primary-button class="mt-2">Upload</x-primary-button>
                    </form>
                    @php
                    $storageDisk = 'public'; // Or 'local'
                    @endphp
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
