@extends('layouts.admin')

@section('title', 'Currencies')


@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ __('Currencies') }}</h3>
        <div class="flex justify-between my-8">
            <form action="{{ route('admin.currencies.search') }}" method="GET">
                <input type="text" name="query" placeholder="Search..."
                    class="px-4 py-2 rounded-lg border border-gray-300" autofocus>
                <button type="submit"
                    class="ml-2 text-white py-2 px-4 rounded shadow-xl bg-blue-600 hover:bg-blue-800 transition duration-300">
                    {{ __('Search') }}
                </button>
            </form>

            <a href="{{ route('admin.currencies.create') }}"
                class="text-white py-2 px-4 rounded shadow-xl bg-blue-600 hover:bg-blue-800 transition duration-300">
                {{ __('Add new currency') }}
            </a>
        </div>
        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Currency') }}
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Symbol') }}
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Type') }}
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Status') }}
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                            </tr>
                        </thead>

                        <tbody class="bg-white">
                            @foreach ($currencies as $currency)
                                <tr>
                                    <td class="font-semibold px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <a href="{{ route('admin', $currency->id) }}" class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10">
                                                <img class="w-full h-full rounded-full"
                                                    src="{{ asset(Storage::url($currency->icon)) }}" alt="" />
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $currency->name }}
                                                </p>
                                            </div>

                                        </a>
                                    </td>
                                    <td class="font-semibold px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                            <a href="{{ route('admin', $currency->id) }}">
                                                {{ $currency->symbol }}
                                            </a>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                            <span
                                                class="px-3 inline-flex text-xs leading-5 font-bold rounded shadow 
                                                {{ $currency->type == 'crypto' ? 'text-green-600 bg-green-200' : '' }}
                                                {{ $currency->type == 'fiat' ? 'text-blue-600 bg-blue-200' : '' }}
                                                ">
                                                {{ walletTypes($currency->type) }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                            <span
                                                class="px-3 inline-flex text-white text-xs leading-5 font-semibold rounded-full shadow
                                            {{ $currency->status ? 'bg-green-600' : 'bg-red-600' }}">
                                                {{ $currency->status ? __('Active') : __('Inactive') }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

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

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                        <form action="{{ route('admin.currencies.destroy', $currency) }}" method="POST">
                                            @csrf
                                            <button
                                                class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring">
                                                <span
                                                    class="absolute inset-0 border rounded-xl border-red-600 group-active:border-red-400"></span>
                                                <span
                                                    class="block border border-red-600 rounded-lg bg-red-600 px-2 py-1 transition-transform active:border-red-400 active:bg-red-400 group-hover:-translate-x-1 group-hover:-translate-y-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>

                                                </span>
                                            </button>
                                        </form>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $currencies->links() }}
                </div>
            </div>
        </div>

        @if (session('message'))
            @include('components.message', ['message' => session('message')])
        @endif
    </div>



@endsection
{{-- <div class="flex flex-wrap justify-center px-5 py-5 gap-4 lg:gap-20">
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
                            <span class="rounded border-2 border-blue-600 px-3 py-1.5 text-[14px] font-bold text-black">
                                {{ $currency->name }} ({{ $currency->symbol }})
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
        </div> --}}
