<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 transition-colors">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300 transition-colors">
            {{ __('Perbarui informasi profil dan alamat email akun Anda.') }}
        </p>

    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- Input Avatar --}}
        <div class="mb-4">
            <x-input-label for="avatar"
                class="block font-medium text-sm text-gray-700 dark:text-gray-300 transition-colors">
                {{ __('Avatar Profil') }}
            </x-input-label>
            <div class="mt-2 flex items-center">
                {{-- Pratinjau Avatar Saat Ini / Default --}}
                @if ($user->avatar)
                    <img src="{{ Storage::url($user->avatar) }}" alt="Avatar Saat Ini"
                        class="h-20 w-20 rounded-full object-cover mr-4 shadow-md" id="current-avatar-preview">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF"
                        alt="Default Avatar" class="h-20 w-20 rounded-full object-cover mr-4 shadow-md"
                        id="current-avatar-preview">
                @endif

                {{-- Input File untuk Avatar Baru --}}
                <input type="file" name="avatar" id="avatar" accept="image/*"
                    class="block w-full text-sm text-gray-500 dark:text-gray-300
                           file:mr-4 file:py-2 file:px-4
                           file:rounded-md file:border-0
                           file:text-sm file:font-semibold
                           file:bg-blue-50 file:text-blue-700
                           hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300 dark:hover:file:bg-blue-800
                           cursor-pointer transition-colors duration-200"
                    onchange="previewNewAvatar(event)">
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
            <p class="text-sm text-gray-500 dark:text-gray-300 mt-1 transition-colors">
                Ukuran maksimal 2MB. Format: JPG, JPEG, PNG.
            </p>

            {{-- Checkbox Hapus Avatar (hanya tampil jika ada avatar) --}}
            @if ($user->avatar)
                <div class="mt-2 flex items-center">
                    <input type="checkbox" name="remove_avatar" id="remove_avatar" value="1"
                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700
                               text-red-600 dark:text-red-500 shadow-sm
                               focus:ring-red-500 dark:focus:ring-red-600 focus:ring-offset-2 dark:focus:ring-offset-gray-800
                               transition-colors">
                    <label for="remove_avatar"
                        class="ml-2 text-sm text-gray-600 dark:text-gray-300 transition-colors">{{ __('Hapus Avatar Saat Ini') }}</label>
                </div>
            @endif
        </div>

        {{-- Input Nama --}}
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Input Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200 transition-colors">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 rounded-md
                                   focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800
                                   transition-colors duration-200">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-300 transition-colors">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Tombol Simpan dan Status --}}
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-300 transition-colors">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

{{-- Script untuk preview avatar baru --}}
<script>
    function previewNewAvatar(event) {
        const output = document.getElementById('current-avatar-preview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                output.src = reader.result;
            };
            reader.readAsDataURL(file);
        } else {
            // Jika tidak ada file baru yang dipilih, kembalikan ke avatar default atau yang sudah ada
            const defaultAvatarUrl =
                "https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF";
            const currentAvatarUrl = "{{ $user->avatar ? Storage::url($user->avatar) : '' }}";
            output.src = currentAvatarUrl || defaultAvatarUrl;
        }

        // Pastikan checkbox "Hapus Avatar" tidak dicentang jika ada file baru yang dipilih
        const removeAvatarCheckbox = document.getElementById('remove_avatar');
        if (removeAvatarCheckbox && file) {
            removeAvatarCheckbox.checked = false;
        }
    }
</script>
