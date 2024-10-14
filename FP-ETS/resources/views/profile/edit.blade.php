@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">{{ __('Profile') }}</h2>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h3 class="text-lg font-medium text-white mb-4">{{ __('Profile Information') }}</h3>
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h3 class="text-lg font-medium text-white mb-4">{{ __('Update Password') }}</h3>
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h3 class="text-lg font-medium text-white mb-4">{{ __('Delete Account') }}</h3>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection