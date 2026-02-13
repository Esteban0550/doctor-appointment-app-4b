<x-admin-layout
    title="Perfil"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Perfil'],
    ]"
>
    <div class="space-y-6">
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            <div class="p-6 bg-white rounded-lg shadow-lg">
                @livewire('profile.update-profile-information-form')
            </div>
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="p-6 bg-white rounded-lg shadow-lg">
                @livewire('profile.update-password-form')
            </div>
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="p-6 bg-white rounded-lg shadow-lg">
                @livewire('profile.two-factor-authentication-form')
            </div>
        @endif

        <div class="p-6 bg-white rounded-lg shadow-lg">
            @livewire('profile.logout-other-browser-sessions-form')
        </div>

        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <div class="p-6 bg-white rounded-lg shadow-lg">
                @livewire('profile.delete-user-form')
            </div>
        @endif
    </div>
</x-admin-layout>
