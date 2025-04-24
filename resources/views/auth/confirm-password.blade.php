<x-guest-layout>
    <div class="w-full max-w-sm mx-auto mt-12 bg-white border border-gray-200 rounded-2xl shadow-lg p-6">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Confirmer votre mot de passe</h2>
            <p class="text-sm text-gray-500">Veuillez confirmer votre mot de passe avant de continuer</p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Mot de passe')" />

                <x-text-input id="password" class="block mt-1 w-full rounded-xl border border-gray-300 bg-gray-50 text-gray-900 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2"
                               type="password"
                               name="password"
                               required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
            </div>

            <div class="flex justify-end mt-4">
                <x-primary-button class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-xl hover:bg-indigo-700 transition duration-200 shadow-md">
                    {{ __('Confirmer') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
