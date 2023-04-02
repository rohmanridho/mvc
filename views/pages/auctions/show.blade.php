@extends('layouts.dashboard')

@section('title', 'Auctions - show')

@section('content')
<div class="container px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Auction - {{ $auction->item->name }}
    </h2>
    <div class="flex gap-4">
        <button class="px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-md inline-block mb-5"
            onclick="history.back()">
            Back
        </button>
        <a href="{{ route('print-per-auction', $auction->id) }}" target="_blank"
            class="px-4 py-2 bg-purple-100 text-slate-900 text-sm font-medium rounded-md inline-block mb-5 hover:text-white hover:bg-purple-500">Print</a>
    </div>
    <div class="">Current price: Rp{{ number_format($auction->final_price) }}</div>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-purple-100">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Phone</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Delete</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @foreach ($histories as $history)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 text-sm">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-4 py-3 text-sm font-semibold truncate" style="max-width: 25ch">
                            {{ $history->user->name }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $history->user->phone ? $history->user->phone : '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            Rp{{ number_format($history->bid) }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ date('d-m-Y', strtotime($history->created_at)) }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <form action="{{ route('auctions.deleteHistory', $history->id) }}" method="post">
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
</div>
@endsection