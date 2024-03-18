<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    {{-- <x-danger-button
        x-data=""
        class="btn btn-danger"
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty() ? 'true' : 'false' ">
        <form method="post" action="{{ route('profile.destroy',['profile' => $user->id]) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="btn btn-danger ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal> --}}

    <div x-data="{ open: {{ $errors->userDeletion->isNotEmpty() ? 'true' : 'false' }} }">

        <x-danger-button class="btn btn-danger" x-on:click="open = ! open">
            {{ __('Delete Account') }}
        </x-danger-button>

        <div x-show="open" @click.outside="open = false">
            <form method="post" action="{{ route('profile.destroy', ['profile' => $user->id]) }}">
                @csrf
                @method('delete')

                <p style="margin-top:1em">
                    {{ __('Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="form-group" style="margin-bottom:10px">

                    <x-text-input id="password" name="password" type="password" class="form-control"
                        placeholder="{{ __('Password') }}" />
                    <x-text-input id="current_password" name="current_password" type="hidden" autofocus
                        autocomplete="password" :value="old('password', $user->password)" />

                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>

                <div class="form-group">
                    <x-secondary-button x-on:click="open = false">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button x-on:click="open = true" class="btn btn-danger">
                        {{ __('Delete Account') }}
                    </x-danger-button>
                </div>
            </form>
        </div>
    </div>
    {{-- <button onclick="load_main_content()" type="button">load</button>
    <div class="row" id="main_content_div" style = "display:none">
        <h1>hugugygfyfy</h1>
    </div>

    <script type="text/javascript">
        function load_main_content() {
                $('#main_content_div').show();
        }
    </script> --}}
</section>