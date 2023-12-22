@extends('layouts.admin')

@section('title', 'Currencies')


@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ __('Currencies') }}</h3>
        <div class="flex justify-end my-8">
            <a href="{{ route('admin.currencies.create') }}"
                class="text-white py-2 px-4 rounded shadow-xl bg-blue-600 hover:bg-blue-800 transition duration-300">
                {{ __('Add Currency') }}
            </a>
        </div>
        <div class="flex flex-wrap justify-center px-5 py-5 gap-4 lg:gap-20">
            @foreach ($currencies as $currency)
                <div class="rounded-xl w-full shadow-2xl md:w-1/2 xl:w-1/3 bg-white p-4 ring ring-blue-50 sm:p-6 lg:p-8">
                    <div class="flex items-start sm:gap-8">
                        <div class="hidden sm:grid sm:h-20 sm:w-20 sm:shrink-0 sm:place-content-center" aria-hidden="true">
                            <div class="flex items-center gap-1">
                                <img class="rounded-2xl" src="{{ asset(Storage::url($currency->icon)) }}"
                                    alt="{{ $currency->symbol }}">
                            </div>
                        </div>

                        <div>
                            <span
                                class="rounded border-2 border-blue-600 px-3 py-1.5 text-[14px] font-bold text-black">
                                {{ $currency->name }} ({{$currency->symbol}})
                            </span>

                            <div class="mt-10 flex justify-between items-center gap-2">
                                <form action="{{ route('admin.currencies.status', $currency) }}" method="POST">
                                    @csrf
                                    <button
                                        class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring">
                                        <span
                                            class="absolute inset-0 border {{ $currency->status ? 'border-red-600' : 'border-green-600' }} rounded-xl group-active:{{ $currency->status ? 'border-red-500' : 'border-green-500' }}"></span>
                                        <span
                                            class="block border {{ $currency->status ? 'border-red-600' : 'border-green-600' }} rounded-xl {{ $currency->status ? 'bg-red-600' : 'bg-green-600' }} px-2 py-1 transition-transform active:{{ $currency->status ? 'bg-red-500' : 'bg-green-500' }} group-hover:-translate-x-1 group-hover:-translate-y-1">
                                            {{ $currency->status ? __('Deactivate') : __('Activate') }}
                                        </span>
                                    </button>
                                </form>

                                <form action="{{ route('admin.currencies.destroy', $currency) }}" method="POST">
                                    @csrf
                                    <button
                                        class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring">
                                        <span
                                            class="absolute inset-0 border rounded-xl border-red-600 group-active:border-red-400"></span>
                                        <span
                                            class="block border border-red-600 rounded-lg bg-red-600 px-2 py-1 transition-transform active:border-red-400 active:bg-red-400 group-hover:-translate-x-1 group-hover:-translate-y-1">
                                            {{ __('Delete') }}
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if (session('message'))
            @include('components.message', ['message' => session('message')])
        @endif
    </div>

@endsection
