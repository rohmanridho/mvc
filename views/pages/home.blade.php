<x-frontend-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($auctionsOn->count() != 0 || $auctionsEnd->count() != 0)
        @if ($auctionsOn->count() != 0)
        <div class="">
            <h2 class="mt-8 mb-4 text-2xl font-bold">Lelang berjalan</h2>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                @foreach($auctionsOn as $auction)
                <div class="block rounded-lg border border-purple-100 bg-white p-5 shadow">
                    <div class="aspect-4/3 w-full rounded-md bg-purple-600 overflow-hidden">
                        <img class="w-full h-full object-cover" src="{{ Storage::url($auction->item->image) }}"
                            loading="lazy" />
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('detail', $auction->id) }}"
                            class="inline-block mb-3 truncate text-2xl font-bold tracking-tight text-purple-900 w-full">
                            {{ $auction->item->name }}
                        </a>
                        @if ($auction->user_id != null)
                        <div class="mb-3 flex">
                            <div class="w-1/2">
                                <div class="mb-1 text-sm font-semibold text-purple-900/75">Harga tertinggi</div>
                                <div
                                    class="truncate rounded-l-md border-r bg-purple-50 py-2.5 px-4 text-slate-800 hover:bg-purple-100">
                                    Rp{{ number_format($auction->final_price) }}
                                </div>
                            </div>
                            <div class="w-1/2">
                                <div class="mb-1 text-sm font-semibold text-purple-900/75">Penawar tertinggi</div>
                                <div
                                    class="truncate rounded-r-md bg-purple-50 py-2.5 px-4 text-slate-800 hover:bg-purple-100">
                                    {{ ($auction->user->name) }}
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="mb-3 flex">
                            <div class="w-1/2">
                                <div class="mb-1 text-sm font-semibold text-purple-900/75">Harga awal</div>
                                <div
                                    class="truncate rounded-l-md border-r bg-purple-50 py-2.5 px-4 text-slate-800 hover:bg-purple-100">
                                    Rp{{ number_format($auction->item->start_price) }}
                                </div>
                            </div>
                            <div class="w-1/2">
                                <div class="mb-1 text-sm font-semibold text-purple-900/75">Harga akhir</div>
                                <div
                                    class="truncate rounded-r-md bg-purple-50 py-2.5 px-4 text-slate-800 hover:bg-purple-100">
                                    Rp{{ $auction->final_price ? number_format($auction->final_price) : '-' }}
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="mb-4">
                            <div class="mb-1 text-sm font-semibold text-purple-900/75">Deskripsi</div>
                            <p
                                class="truncate rounded-md bg-purple-50 py-2.5 px-4 font-normal text-slate-700 hover:bg-purple-100">
                                {{ $auction->item->description }}</p>
                        </div>
                        <a href="{{ route('detail', $auction->id) }}"
                            class="block rounded-lg bg-purple-600 py-2.5 text-center text-sm font-medium text-white hover:bg-purple-700 uppercase">
                            buat tawaran
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if ($auctionsEnd->count() != 0)
        <div class="">
            <h2 class="mt-8 mb-4 text-2xl font-bold">Lelang berakhir</h2>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                @foreach($auctionsEnd as $auction)
                <div class="block rounded-lg border border-purple-100 bg-white p-5 shadow">
                    <div class="aspect-4/3 w-full overflow-hidden rounded-md bg-purple-600">
                        <img class="h-full w-full object-cover" src="{{ Storage::url($auction->item->image) }}"
                            loading="lazy" />
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('detail', $auction->id) }}"
                            class="mb-3 inline-block truncate text-2xl font-bold tracking-tight text-purple-900 w-full">
                            {{
                            $auction->item->name }} </a>
                        <div class="mb-3 flex">
                            <div class="w-1/2">
                                <div class="mb-1 text-sm font-semibold text-purple-900/75">Pemenang</div>
                                <div
                                    class="truncate rounded-l-md border-r bg-purple-50 py-2.5 px-4 text-slate-800 hover:bg-purple-100">
                                    {{ $auction->user->name }}
                                </div>
                            </div>
                            <div class="w-1/2">
                                <div class="mb-1 text-sm font-semibold text-purple-900/75">Harga akhir</div>
                                <div
                                    class="truncate rounded-r-md bg-purple-50 py-2.5 px-4 text-slate-800 hover:bg-purple-100">
                                    Rp{{ number_format($auction->final_price) }}
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="mb-1 text-sm font-semibold text-purple-900/75">Deskripsi</div>
                            <p
                                class="truncate rounded-md bg-purple-50 py-2.5 px-4 font-normal text-slate-700 hover:bg-purple-100">
                                {{ $auction->item->description }}
                            </p>
                        </div>
                        <a href="{{ route('detail', $auction->id) }}"
                            class="block rounded-lg bg-purple-600 py-2.5 text-center text-sm font-medium uppercase text-white hover:bg-purple-700">
                            lihat detail </a>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
        @endif
        @else
        <div class="text-center font-medium text-xl text-purple-900/75 mt-4">No auction</div>
        @endif

    </div>
</x-frontend-layout>