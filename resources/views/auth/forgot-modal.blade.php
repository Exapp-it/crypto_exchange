<div x-data="Forgot()" x-cloak x-show="isForgotModalOpen" x-transition.opacity.duration.500ms
     class="min-w-screen h-screen animated fadeIn faster fixed flex justify-center items-center inset-0">
    <div @click="closeForgotModal" class="absolute bg-black opacity-80 inset-0 z-0"></div>
    <div class="w-full max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg bg-white">
        <div class="text-center px-5 flex-auto justify-center">
            <h2 class="text-xl font-bold py-4">{{__('Forgot Form')}}</h2>
            <p class="text-sm text-gray-500 pb-3 px-8">{{__('Forgot form text')}}</p>
            <div class="mb-4">
                <label for="f_email" class="block text-sm font-semibold text-gray-600">{{__('Email')}}</label>
                <input
                    x-model="state.email"
                    type="text"
                    id="f_email"
                    class="form-input w-full mt-1">
                <span class="text-red-600 text-sm" x-text="state.errors.email"></span>
            </div>
        </div>
        <div class="px-5 mt-2 text-center space-x-5 md:block">
            <button @click="forgotAction"
                    class="w-full bg-gradient-to-r from-green-500 to-indigo-500 text-white py-2 px-4 rounded-md hover:from-green-600 hover:to-indigo-600 focus:outline-none focus:ring focus:border-green-300">
                {{__('Confirm')}}
            </button>
        </div>
    </div>
    @include('components.alert')
</div>
