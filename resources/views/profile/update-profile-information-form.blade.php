<div>
    <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ __('Profile Information') }}</h3>
    <p class="text-sm text-gray-600 mb-6">{{ __('Update your account\'s profile information and email address.') }}</p>

    <form wire:submit="updateProfileInformation">
        <div class="space-y-6">
            <!-- Profile Photo -->
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div x-data="{photoName: null, photoPreview: null}">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Photo') }}</label>
                    
                    <!-- Profile Photo File Input -->
                    <input type="file" id="photo" class="hidden"
                                wire:model.live="photo"
                                accept="image/*"
                                x-ref="photo"
                                x-on:change="
                                        photoName = $refs.photo.files[0]?.name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        if ($refs.photo.files[0]) {
                                            reader.readAsDataURL($refs.photo.files[0]);
                                        }
                                " />

                    <div class="flex items-center gap-4">
                        <!-- Current Profile Photo -->
                        <div x-show="! photoPreview">
                            <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full size-20 object-cover border-2 border-gray-300">
                        </div>

                        <!-- New Profile Photo Preview -->
                        <div x-show="photoPreview" style="display: none;">
                            <span class="block rounded-full size-20 bg-cover bg-no-repeat bg-center border-2 border-gray-300"
                                  x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>

                        <div class="flex flex-col gap-2">
                            <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" x-on:click.prevent="$refs.photo.click()">
                                {{ __('Select A New Photo') }}
                            </button>

                            @if ($this->user->profile_photo_path)
                                <button type="button" class="inline-flex items-center px-4 py-2 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" wire:click="deleteProfilePhoto">
                                    {{ __('Remove Photo') }}
                                </button>
                            @endif
                        </div>
                    </div>

                    <x-input-error for="photo" class="mt-2" />
                </div>
            @endif

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Name') }}</label>
                <input id="name" type="text" class="w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" wire:model="state.name" required autocomplete="name" />
                <x-input-error for="name" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Email') }}</label>
                <input id="email" type="email" class="w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" wire:model="state.email" required autocomplete="username" />
                <x-input-error for="email" class="mt-2" />

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                    <p class="text-sm mt-2 text-gray-600">
                        {{ __('Your email address is unverified.') }}

                        <button type="button" class="underline text-sm text-indigo-600 hover:text-indigo-900" wire:click.prevent="sendEmailVerification">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if ($this->verificationLinkSent)
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                @endif
            </div>
        </div>

        <div class="flex items-center justify-end mt-6 pt-6 border-t border-gray-200">
            <x-action-message class="me-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:loading.attr="disabled" wire:target="photo">
                <span wire:loading.remove wire:target="photo">{{ __('Save') }}</span>
                <span wire:loading wire:target="photo">{{ __('Saving...') }}</span>
            </button>
        </div>
    </form>
</div>
