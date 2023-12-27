<div x-data="Login()" x-cloak x-show="isLoginModalOpen" x-transition.opacity.duration.500ms
    class="min-w-screen h-screen animated fadeIn faster fixed flex justify-center items-center inset-0">
    <div @click="closeLoginModal" class="absolute bg-black opacity-80 inset-0 z-0"></div>
    <div class="w-full max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg bg-white">
        <div class="text-center px-5 flex-auto justify-center">
            <h2 class="text-xl font-bold py-4">{{ __('Login Form') }}</h2>
            <p class="text-sm text-gray-500 pb-3 px-8">{{ __('Login form text') }}</p>
            <div class="my-6">
                <label for="l_email" class="block text-sm font-semibold text-gray-600">{{ __('Email') }}</label>
                <div
                    class="p-2 mt-2 transition duration-500 ease-in-out transform border2 bg-gray-100 md:mx-auto rounded-xl sm:max-w-lg">
                    <input id="l_email" x-model="email" type="text"
                        class="block w-full px-5 py-3 text-base text-neutral-600 placeholder-gray-400 transition duration-500 ease-in-out transform bg-transparent border border-transparent rounded-md focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300"
                        placeholder="Enter your email  ">
                </div>
                <span class="text-red-600 text-sm" x-text="errors.email"></span>
            </div>
            <div class="my-6">
                <label for="l_password" class="block text-sm font-semibold text-gray-600">{{ __('Password') }}</label>
                <div
                    class="p-2 mt-2 transition duration-500 ease-in-out transform border2 bg-gray-100 md:mx-auto rounded-xl sm:max-w-lg">
                    <input id="l_password" x-model="password" type="password"
                        class="block w-full px-5 py-3 text-base text-neutral-600 placeholder-gray-400 transition duration-500 ease-in-out transform bg-transparent border border-transparent rounded-md focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300"
                        placeholder="Enter your password">
                </div>
                <span class="text-red-600 text-sm pt-5" x-text="errors.password"></span>
            </div>
        </div>
        <div class="flex items-center justify-end">
            <div class="text-sm text-blue-600 px-5 pb-5">
                <span @click="openForgotModal"
                    class="cursor-pointer hover:text-blue-400 hover:underline decoration-blue-400 underline-offset-2 transition-all duration-300">
                    {{ __('Forgot your password?') }}
                </span>
            </div>
        </div>
        <div class="px-5 mt-5">
            <button @click="loginAction"
                class="flex items-center justify-center w-full px-10 py-4 text-base font-medium text-center text-white transition duration-500 ease-in-out transform bg-blue-600 rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ __('Login') }}
            </button>
        </div>
    </div>
    @include('components.alert')
</div>

{{-- <form action="" method="post" id="revue-form" name="revue-form" target="_blank" class="p-2 mt-8 transition duration-500 ease-in-out transform border2 bg-gray-50 md:mx-auto rounded-xl sm:max-w-lg sm:flex">
    <div class="flex-1 min-w-0 revue-form-group">
        <label for="member_email" class="sr-only">Email address</label>
        <input id="cta-email" type="email" class="block w-full px-5 py-3 text-base text-neutral-600 placeholder-gray-300 transition duration-500 ease-in-out transform bg-transparent border border-transparent rounded-md focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300" placeholder="Enter your email  ">
    </div>
    <div class="mt-4 sm:mt-0 sm:ml-3 revue-form-actions">
        <button type="submit" value="Subscribe" name="member[subscribe]" id="member_submit" class="block w-full px-5 py-3 text-base font-medium text-white bg-blue-600 border border-transparent rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300 sm:px-10">Notify me</button>
    </div>
</form> --}}
