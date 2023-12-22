@extends('layouts.admin')

@section('title', 'Currencies')


@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ __('Adding currency') }}</h3>
        <div class="flex justify-end my-8">
            <a href="{{ route('admin.currencies') }}"
                class="text-white py-2 px-4 rounded shadow-xl bg-blue-600 hover:bg-blue-800 transition duration-300">
                {{ __('Back') }}
            </a>
        </div>
        <div class="flex flex-col mt-8 bg-white rounded-lg drop-shadow-lg px-10 py-10 border border-gray-200">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
                <form action="{{ route('admin.currencies.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="align-middle inline-block min-w-full overflow-hidden">
                        <div class="lg:flex items-center mt-5">
                            <div class="px-2 py-4 lg:w-1/2">
                                <div class="relative">
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        class="peer w-full py-2 border-2 border-blue-200 rounded-md focus:ring-1 focus:ring-blue-300 focus:border-blue-300 focus:outline-none placeholder-transparent">
                                    <label for="name"
                                        class="text-neutral-500 text-sm font-semibold  absolute -top-4 left-2 -translate-y-1/2 transition-all peer-placeholder-shown:left-4 peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-neutral-900 peer-focus:-top-4 peer-focus:left-2 peer-focus:text-neutral-600">
                                        {{ __('Name') }}
                                    </label>
                                </div>

                                @error('name')
                                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="px-2 py-4 lg:w-1/2">
                                <div class="relative">
                                    <input type="text" name="symbol" id="symbol" value="{{ old('symbol') }}"
                                        class="peer w-full py-2 border-2 border-blue-200 rounded-md focus:ring-1 focus:ring-blue-300 focus:border-blue-300 focus:outline-none placeholder-transparent">
                                    <label for="symbol"
                                        class="text-neutral-500 text-sm font-semibold  absolute -top-4 left-2 -translate-y-1/2 transition-all peer-placeholder-shown:left-4 peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-neutral-900 peer-focus:-top-4 peer-focus:left-2 peer-focus:text-neutral-600">
                                        {{ __('Symbol') }}
                                    </label>
                                </div>
                                @error('symbol')
                                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="lg:flex">
                            <div x-data="{ iconUrl: '', iconUploaded: false }" class="flex items-center justify-center px-2 py-4 w-full">
                                <div class="shrink-0" x-show="iconUploaded">
                                    <img x-bind:src="iconUrl" class="w-20 object-cover rounded"
                                        alt="Current profile photo" />
                                </div>
                                <label class="flex items-center gap-4">
                                    <span class="text-neutral-500 text-sm font-semibold">{{ __('Icon') }}</span>
                                    <input type="file" name="icon"
                                        x-on:change="iconUploaded = true; iconUrl = URL.createObjectURL($event.target.files[0])"
                                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-1 file:border-blue-400 file:text-sm file:font-semibold file:bg-blue-50 file:text-black hover:file:bg-blue-400 file:cursor-pointer" />
                                </label>
                                @error('icon')
                                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <div class="px-2 py-4">
                                <button type="submit"
                                    class="group relative inline-block overflow-hidden border border-blue-400 px-8 py-3 focus:outline-none focus:ring">
                                    <span
                                        class="absolute inset-y-0 left-0 w-[2px] bg-blue-400 transition-all group-hover:w-full group-active:bg-blue-400"></span>
                                    <span
                                        class="relative text-sm font-medium text-black  transition-colors group-hover:text-black">
                                        {{ __('Add') }}
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
