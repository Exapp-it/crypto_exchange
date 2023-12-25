@extends('layouts.app')

@section('title', 'Авторизация')

@section('content')
    <div class="mx-auto flex min-h-screen w-full items-center justify-center bg-gray-900 text-white">
        <section class="flex w-[30rem] flex-col space-y-10">
            <div class="text-center text-4xl font-medium">Log In</div>
            <form method="POST" action="{{ route('admin.login.store') }}">
                @csrf
                <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-indigo-500">
                    <input type="email" placeholder="Email" name="email" type="email"
                        class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none @error('email') border-red-500 @enderror" />
                </div>
                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-indigo-500">
                    <input name="password" type="password" placeholder="Password"
                        class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none @error('password') border-red-500 @enderror"" />

                </div>
                @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <button type="submit"
                    class="transform rounded-sm w-full mt-3 bg-indigo-600 py-2 font-bold duration-300 hover:bg-indigo-400">
                    LOG IN
                </button>
            </form>
        </section>
    </div>

@endsection
