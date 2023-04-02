@extends('layouts.dashboard')

@section('title', 'Auction - create')

@section('content')
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Auction - create
    </h2>
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form action="{{ route('auctions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="level" value="staff">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Name</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Heart" type="text" name="name" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </label>
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Image</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="file" name="image" required />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </label>
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Price</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Enter start price..." type="number" name="start_price" required />
                <x-input-error :messages="$errors->get('start_price')" class="mt-2" />
            </label>
            {{-- <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Duration</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Enter auction duration..." type="number" name="duration" required />
                <x-input-error :messages="$errors->get('duration')" class="mt-2" />
            </label> --}}
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Description</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Enter item description" type="text" name="description" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" required />
            </label>
            <button type="submit"
                class="inline-block mt-4 px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-sm text-blue-50">Buat</button>
        </form>
    </div>
</div>
@endsection