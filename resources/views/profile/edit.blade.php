@extends(
    auth()->user()->roles->contains('name', 'admin')
        ? 'layouts.adminSideBar'
        : 'layouts.userSideBar'
)
@section('content')
@section('title', 'Profile Settings')

<body class="bg-gray-100 font-family-karla flex">

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        @include('components.Navbar')

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="w-full text-3xl text-black pb-6">Profile Settings</h1>

                <div class="flex flex-wrap">
                    <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
                        <p class="text-xl pb-6 flex items-center">
                            <i class="fa-solid fa-address-card mr-3"></i> Update Profile Information
                        </p>
                        <div class="leading-loose">
                            <form action="{{ route('profile.update') }}" method="post"
                                class="p-10 bg-white rounded shadow-xl">
                                @csrf
                                @method('patch')
                                <div class="">
                                    <label class="block text-sm text-gray-600" for="name">Name</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name"
                                        name="name" type="text" required="" placeholder="Your Name"
                                        aria-label="Name" value="{{ auth()->user()->name }}">

                                </div>
                                <div class="mt-2">
                                    <label class="block text-sm text-gray-600" for="email">Email</label>
                                    <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" id="email"
                                        name="email" type="email" value="{{ auth()->user()->email }}" required
                                        autocomplete="username" aria-label="Email">
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                        <div>
                                            <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                                {{ __('Your email address is unverified.') }}

                                                <button form="send-verification"
                                                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
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
                                <div class="mt-6">
                                    <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
                                        type="submit">Update Profile</button>
                                    <div id="statusMessage">
                                        @if (session('status'))
                                            <p class="text-green-400 text-md">{{ session('status') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </form>

                            {{-- Delete Account --}}
                            <section class="space-y-6 p-10 bg-white rounded shadow-xl mt-5">
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Delete Account') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                                    </p>
                                </header>

                                <x-danger-button x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Delete Account') }}</x-danger-button>

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
                                            <x-input-label for="password" value="{{ __('Password') }}"
                                                class="sr-only" />

                                            <x-text-input id="password" name="password" type="password"
                                                class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" />

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

                    <div class="w-full lg:w-1/2 mt-6 pl-0 lg:pl-2">
                        <p class="text-xl pb-6 flex items-center">
                            <i class="fa-solid fa-unlock-keyhole mr-3"></i>Set New Password?
                        </p>
                        <div class="leading-loose">
                            <form method="post" action="{{ route('password.update') }}"
                                class="p-10 bg-white rounded shadow-xl">
                                @csrf
                                @method('put')
                                <div class="mt-2">
                                    <label class=" block text-sm text-gray-600" for="cus_email">Current Password</label>
                                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_email"
                                        name="current_password" type="text" required=""
                                        placeholder="Current Password">
                                </div>
                                <div class="mt-2">
                                    <label class=" block text-sm text-gray-600" for="cus_email">New Password</label>
                                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_email"
                                        name="password" type="text" required="" placeholder="New Password">
                                </div>
                                <div class="mt-2">
                                    <label class=" text-sm block text-gray-600" for="cus_email">Confirm Password</label>
                                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_email"
                                        name="password_confirmation" type="text" required=""
                                        placeholder="Confirm Password">
                                </div>
                                <div class="mt-6">
                                    <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
                                        type="submit">Update Password</button>
                                </div>
                                <div id="passStatusMessage">
                                    @if (session('passStatus'))
                                        <p class="text-green-400 text-md">{{ session('passStatus') }}</p>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>

    <script>
        // Set a timeout to hide the status message after 2 seconds
        setTimeout(function() {
            document.getElementById('statusMessage').classList.add('hidden');
        }, 2000); // 2000 milliseconds = 2 seconds
    </script>
    <script>
        // Set a timeout to hide the status message after 2 seconds
        setTimeout(function() {
            document.getElementById('passStatusMessage').classList.add('hidden');
        }, 2000); // 2000 milliseconds = 2 seconds
    </script>
</body>

@endsection
