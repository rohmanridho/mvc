@extends('layouts.dashboard')

@section('title', 'User - edit')

@section('content')
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        User - edit
    </h2>
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form action="{{ route('users.update', $user->id) }}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="level" value="staff">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Name</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="John Doe" type="text" name="name" value="{{ $user->name }}" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </label>
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Email</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="johndoe@gmail.com" type="email" name="email" value="{{ $user->email }}" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </label>
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Phone</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="090898912902" type="text" name="phone" value="{{ $user->phone }}" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </label>
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Password</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </label>
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Confirm password</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="password" name="password_confirmation" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" required />
            </label>
            <button type="submit"
                class="inline-block mt-4 px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-sm text-blue-50">Buat</button>
        </form>
    </div>
</div>
@endsection