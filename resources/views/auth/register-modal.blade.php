<div x-data="Register()" x-cloak x-show="isRegisterModalOpen" x-transition.opacity.duration.500ms
    class="min-w-screen h-screen animated fadeIn faster fixed flex justify-center items-center inset-0">
    <div @click="closeRegisterModal" class="absolute bg-black opacity-80 inset-0 z-0"></div>
    <div class="w-full max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg bg-white">
        <div class="text-center p-5 flex-auto justify-center">
            <h2 class="text-xl font-bold py-4">{{ __('Register Form') }}</h2>
            <p class="text-sm text-gray-500 pb-3 px-8">{{ __('Register form text') }}</p>

            <div class="my-6">
                <label for="r_email" class="block text-sm font-semibold text-gray-600">{{ __('Email') }}</label>
                <div
                    class="p-2 mt-2 transition duration-500 ease-in-out transform border2 bg-gray-100 md:mx-auto rounded-xl sm:max-w-lg">
                    <input id="r_email" x-model="email" type="text"
                        class="block w-full px-5 py-3 text-base text-neutral-600 placeholder-gray-400 transition duration-500 ease-in-out transform bg-transparent border border-transparent rounded-md focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300"
                        placeholder="Enter your email">
                </div>
                <span class="text-red-600 text-sm" x-text="errors.email"></span>

            </div>
            <div class="my-6">
                <label for="r_password" class="block text-sm font-semibold text-gray-600">{{ __('Password') }}</label>
                <div
                    class="p-2 mt-2 transition duration-500 ease-in-out transform border2 bg-gray-100 md:mx-auto rounded-xl sm:max-w-lg">
                    <input id="r_password" x-model="password" type="password"
                        class="block w-full px-5 py-3 text-base text-neutral-600 placeholder-gray-400 transition duration-500 ease-in-out transform bg-transparent border border-transparent rounded-md focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300"
                        placeholder="Enter your password">
                </div>
                <span class="text-red-600 text-sm" x-text="errors.password"></span>
            </div>
            <div class="my-6">
                <label for="r_password_confirmation"
                    class="block text-sm font-semibold text-gray-600">{{ __('Password Confirmation') }}</label>
                <div
                    class="p-2 mt-2 transition duration-500 ease-in-out transform border2 bg-gray-100 md:mx-auto rounded-xl sm:max-w-lg">
                    <input id="r_password_confirmation" x-model="password_confirmation" type="password"
                        class="block w-full px-5 py-3 text-base text-neutral-600 placeholder-gray-400 transition duration-500 ease-in-out transform bg-transparent border border-transparent rounded-md focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300"
                        placeholder="Enter your password">
                </div>
                <span class="text-red-600 text-sm" x-text="errors.password_confirmation"></span>
            </div>
        </div>
        <div class="flex items-center justify-end">
            <div class="text-sm text-blue-600 px-5 pb-5">
                <span @click="openLoginModal"
                    class="cursor-pointer hover:text-blue-400 hover:underline decoration-blue-400 underline-offset-2 transition-all duration-300">
                    {{ __('Forgot your password?') }}
                </span>
            </div>
        </div>
        <div class="px-5 mt-5">
            <button @click="registerAction"
                class="flex items-center justify-center w-full px-10 py-4 text-base font-medium text-center text-white transition duration-500 ease-in-out transform bg-blue-600 rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ __('Register') }}
            </button>
        </div>
    </div>
    @include('components.alert')
</div>
