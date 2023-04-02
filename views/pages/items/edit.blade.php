@extends('layouts.dashboard')

@section('title', 'Item - edit')

@section('content')
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Item - edit
    </h2>
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form action="{{ route('items.update', $item->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <label class="block text-sm">
                <span class="text-gray-700">Name</span>
                <input
                    class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" type="text" name="name" value="{{ $item->name }}" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </label>
            <label class="block mt-4 text-sm">
                <span class="text-gray-700">Image</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                    type="file" name="image" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </label>
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Price</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="number" name="start_price" value="{{ $item->start_price }}" required />
                <x-input-error :messages="$errors->get('start_price')" class="mt-2" />
            </label>
            <label class="block mt-4 text-sm">
                <span class="text-gray-700">Description</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="text" name="description" value="{{ $item->description }}"
                    required />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </label>
            <button type="submit"
                class="inline-block mt-4 px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-sm text-blue-50 outline-none">
                Update
            </button>
        </form>
    </div>
</div>
@endsection
