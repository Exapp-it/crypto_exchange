@extends('layouts.user')

@section('user.content')
    <section class="container px-4 mx-auto">
        <div class="flex items-center gap-x-3">
            <h2 class="text-lg font-medium text-gray-800">{{ __('Trade') }}</h2>
        </div>
        <div class="flex flex-col mt-6">
            <div class="font-sans leading-normal tracking-normal">
                <div class="flex justify-center pt-10">
                    <div class="inline-block align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden bg-white p-10 border border-gray-200 md:rounded-lg shadow-2xl">
                            <h1 class="text-3xl font-bold mb-6">Sell Cryptocurrency</h1>

                            <form action="{{ route('trade.sell') }}" method="post">
                                @csrf

                                <div class="mb-4 flex space-x-4">
                                    <div class="my-6">
                                        <label for="l_email"
                                            class="block text-sm font-semibold text-gray-600">{{ __('I Get') }}</label>
                                        <div
                                            class="p-2 mt-2 transition duration-500 ease-in-out transform border2 bg-gray-100 md:mx-auto rounded-xl sm:max-w-lg">
                                            <input id="l_email" x-model="state.email" type="text"
                                                class="block w-full px-5 py-3 text-base text-neutral-600 placeholder-gray-400 transition duration-500 ease-in-out transform bg-transparent border border-transparent rounded-md focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300"
                                                placeholder="Enter your email  ">
                                        </div>
                                        <span class="text-red-600 text-sm" x-text="state.errors.email"></span>
                                    </div>
                                    <div class="my-6">
                                        <label for="l_email" class="block text-sm font-semibold text-gray-600">{{ __('Currency') }}</label>
                                        <div class="p-2 mt-2 transition duration-500 ease-in-out transform border2 bg-gray-100 md:mx-auto rounded-xl sm:max-w-lg">
                                            <select id="l_email" x-model="state.email"
                                                class="block w-full px-6 py-3 text-base text-neutral-600 placeholder-gray-400 transition duration-500 ease-in-out transform bg-transparent border border-transparent rounded-md focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300">
                                                @foreach ($currencies as $currency)
                                                    <option class="" value="{{ $currency->symbol }}">
                                                        {{ $currency->symbol }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-red-600 text-sm" x-text="state.errors.email"></span>
                                    </div>
                                    

                                </div>
                                <div class="mb-4 flex space-x-4">
                                    <div class="">
                                        <label for="l_email"
                                            class="block text-sm font-semibold text-gray-600">{{ __('Email') }}</label>
                                        <div
                                            class="p-2 mt-2 transition duration-500 ease-in-out transform border2 bg-gray-100 md:mx-auto rounded-xl sm:max-w-lg">
                                            <input id="l_email" x-model="state.email" type="text"
                                                class="block w-full px-5 py-3 text-base text-neutral-600 placeholder-gray-400 transition duration-500 ease-in-out transform bg-transparent border border-transparent rounded-md focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300"
                                                placeholder="Enter your email  ">
                                        </div>
                                        <span class="text-red-600 text-sm" x-text="state.errors.email"></span>
                                    </div>
                                    <div class=""">
                                        <label for="l_email" class="block text-sm font-semibold text-gray-600">{{ __('Email') }}</label>
                                        <div class="p-2 mt-2 transition duration-500 ease-in-out transform border2 bg-gray-100 md:mx-auto rounded-xl sm:max-w-lg">
                                            <select id="l_email" x-model="state.email"
                                                class="block w-full px-6 py-3 text-base text-neutral-600 placeholder-gray-400 transition duration-500 ease-in-out transform bg-transparent border border-transparent rounded-md focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300">
                                                @foreach ($currencies as $currency)
                                                    <option class="" value="{{ $currency->symbol }}">
                                                        {{ $currency->symbol }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-red-600 text-sm" x-text="state.errors.email"></span>
                                    </div>
                                    

                                </div>

                                <div class="mt-5">
                                    <button @click="loginAction"
                                        class="flex items-center justify-center w-full px-10 py-4 text-base font-medium text-center text-white transition duration-500 ease-in-out transform bg-red-600 rounded-xl hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        {{ __('Sell') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
