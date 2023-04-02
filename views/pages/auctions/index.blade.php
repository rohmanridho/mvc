@extends('layouts.dashboard')

@section('title', 'Auctions - index')

@section('content')
<div class="container px-6 mx-auto">
    @if ($auctions->count() != 0)
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Auctions - index
    </h2>
    <a href="{{ route('print-all-auctions') }}" target="_blank"
        class="px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-md inline-block mb-5">Print
        all</a>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-purple-100">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Name</th>
                        @if (Auth::user()->level == 'admin')
                        <th class="px-4 py-3">Staff</th>
                        @endif
                        <th class="px-4 py-3">User</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Opening</th>
                        <th class="px-4 py-3">Closing</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @foreach ($auctions as $auction)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 text-sm">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-4 py-3 text-sm font-semibold truncate" style="max-width: 25ch">
                            {{ $auction->item->name }}
                        </td>
                        @if (Auth::user()->level == 'admin')
                        <td class="px-4 py-3 text-sm">
                            {{ $auction->staff->name }}
                        </td>
                        @endif
                        <td class="px-4 py-3 text-sm">
                            {{ $auction->user_id ? $auction->user->name : '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Rp{{ $auction->final_price ? number_format($auction->final_price) :
                            number_format($auction->item->start_price) }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ date('d-m-Y', strtotime($auction->opening_date)) }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $auction->closing_date ? date('d-m-y', strtotime($auction->closing_date)) : '-' }}
                        </td>
                        <td class="px-4 py-3 text-xs">
                            <span
                                class="px-2 py-1 font-semibold leading-tight {{ $auction->status == 'open' ? 'text-green-700 bg-green-100 ' : 'text-red-700 bg-red-100 ' }} rounded-full">
                                {{ $auction->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <a href="{{ route('auctions.show', $auction->id) }}"
                                    class="text-sm font-medium text-purple-600 hover:underline">Show</a>
                                <form action="{{ route('close-open', $auction->id) }}" method="post">
                                    @csrf
                                    <button class="text-sm font-medium text-purple-600 hover:underline">
                                        Close
                                    </button>
                                </form>
                                <form action="{{ route('auctions.destroy', $auction->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Delete">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="text-center font-medium text-xl text-purple-900/75 mt-4">No auction</div>
    @endif
</div>
@endsection
