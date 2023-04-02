{{-- @php
dd($histories);
@endphp --}}

<x-frontend-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (Auth::user()->level == 'public')
        @if ($historiesOn->count() != 0 || $historiesEnd->count() != 0)
        @if ($historiesOn->count() != 0)
        <div class="">
            <h2 class="mt-8 mb-4 text-2xl font-bold">Lelang sedang diikuti</h2>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($historiesOn as $history)
                <a href="{{ route('detail', $history->auction_id) }}" class="block p-4 bg-white rounded-lg shadow">
                    <div class="flex gap-4">
                        <div class="">
                            <img src="{{ Storage::url($history->items->image) }}"
                                class="w-24 aspect-4/3 object-cover rounded-md" loading="lazy">
                        </div>
                        <div class="">
                            <div class="text-lg font-semibold text-purple-900 truncate mb-1">
                                {{ $history->items->name }}
                            </div>
                            <div class="text-sm text-purple-900/75">
                                Penawaranku: <span class="font-semibold">Rp{{ number_format($history->bid) }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        @if ($historiesEnd->count() != 0)
        <div class="">
            <h2 class="mt-8 mb-4 text-2xl font-bold">Lelang pernah diikuti</h2>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                @foreach($historiesEnd as $history)
                <a href="{{ route('detail', $history->auction_id) }}" class="block p-4 bg-white rounded-lg shadow">
                    <div class="flex gap-4">
                        <div class="">
                            <img src="{{ Storage::url($history->items->image) }}"
                                class="w-24 aspect-4/3 object-cover rounded-md" loading="lazy">
                        </div>
                        <div class="">
                            <div class="text-lg font-semibold text-purple-900 truncate mb-1">
                                {{ $history->items->name }}
                            </div>
                            <div class="text-sm text-purple-900/75">
                                Pemenang: <span class="font-semibold">{{ $history->auctions->user->name }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
        @else
        <div class="text-center font-medium text-xl text-purple-900/75 mt-4">No history</div>
        @endif
        @else
        <div class="text-center font-medium text-xl text-purple-900/75 mt-4">You're not a public</div>
        @endif
    </div>
    </x-app-layout>