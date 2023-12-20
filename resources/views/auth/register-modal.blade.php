<div x-data="Register()" x-cloak x-show="isRegisterModalOpen" x-transition.opacity.duration.500ms
     class="min-w-screen h-screen animated fadeIn faster fixed flex justify-center items-center inset-0">
    <div @click="closeRegisterModal" class="absolute bg-black opacity-80 inset-0 z-0"></div>
    <div class="w-full max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg bg-white">
        <div class="text-center p-5 flex-auto justify-center">
            <h2 class="text-xl font-bold py-4">{{__('Register Form')}}</h2>
            <p class="text-sm text-gray-500 pb-3 px-8">{{__('Register form text')}}</p>
            <div class="mb-4">
                <label for="r_login" class="block text-sm font-semibold text-gray-600">{{__('Username')}}</label>
                <input
                    x-model="state.login"
                    type="text"
                    id="r_login"
                    class="form-input w-full mt-1">
                <span class="text-red-600 text-sm" x-text="state.errors.login"></span>
            </div>
            <div class="mb-4">
                <label for="r_email" class="block text-sm font-semibold text-gray-600">{{__('Email')}}</label>
                <input
                    x-model="state.email"
                    type="text"
                    id="r_email"
                    class="form-input w-full mt-1">
                <span class="text-red-600 text-sm" x-text="state.errors.email"></span>

            </div>
            <div class="mb-4">
                <label for="r_password"
                       class="block text-sm font-semibold text-gray-600">{{__('Password Confirmation')}}</label>
                <input
                    x-model="state.password"
                    type="password"
                    id="r_password"
                    name="password"
                    class="form-input w-full mt-1">
                <span class="text-red-600 text-sm" x-text="state.errors.password"></span>
            </div>
            <div class="mb-4">
                <label for="r_password_confirmation"
                       class="block text-sm font-semibold text-gray-600">{{__('Password')}}</label>
                <input
                    x-model="state.password_confirmation"
                    type="password"
                    id="r_password_confirmation"
                    name="password_confirmation"
                    class="form-input w-full mt-1">
                <span class="text-red-600 text-sm" x-text="state.errors.password_confirmation"></span>
            </div>
        </div>
        <div class="p-3 mt-2 text-center space-x-4 md:block">
            <button @click="registerAction"
                    class="w-full bg-gradient-to-r from-green-500 to-indigo-500 text-white py-2 px-4 rounded-md hover:from-green-600 hover:to-indigo-600 focus:outline-none focus:ring focus:border-green-300">
                {{__('Register')}}
            </button>
        </div>
    </div>
    @include('components.alert')
</div>
