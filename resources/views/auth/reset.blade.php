@extends('layouts.home')

@section('home.content')
    <div x-data="Reset()" x-init="() => { token = '{{$token}}'; email = '{{$email}}' }" class="w-full max-w-lg p-5 mx-auto my-auto rounded-xl shadow-lg bg-white">
        <div class="text-center px-5 flex-auto justify-center">
            <h2 class="text-xl font-bold py-4">{{__('Reset Form')}}</h2>
            <p class="text-sm text-gray-500 pb-3 px-8">{{__('Reset form text')}}</p>
            <div class="mb-4">
                <label for="r_password"
                       class="block text-sm font-semibold text-gray-600">{{__('Password Confirmation')}}</label>
                <input
                    x-model="password"
                    type="password"
                    id="r_password"
                    name="password"
                    class="form-input w-full mt-1">
                <span class="text-red-600 text-sm" x-text="errors.password"></span>
            </div>
            <div class="mb-4">
                <label for="r_password_confirmation"
                       class="block text-sm font-semibold text-gray-600">{{__('Password')}}</label>
                <input
                    x-model="password_confirmation"
                    type="password"
                    id="r_password_confirmation"
                    name="password_confirmation"
                    class="form-input w-full mt-1">
                <span class="text-red-600 text-sm" x-text="errors.password_confirmation"></span>
            </div>
        </div>
        <div class="px-5 mt-2 text-center space-x-5 md:block">
            <button @click="resetAction"
                    class="w-full bg-gradient-to-r from-green-500 to-indigo-500 text-white py-2 px-4 rounded-md hover:from-green-600 hover:to-indigo-600 focus:outline-none focus:ring focus:border-green-300">
                {{__('Confirm')}}
            </button>
        </div>
    @include('components.alert')
    </div>
@endsection
