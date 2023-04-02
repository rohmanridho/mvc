<x-frontend-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-5" id="auction">
        <div class="flex flex-wrap md:flex-nowrap mx-4 md:mx-0 gap-5 md:gap-10">
            <div class="md:w-1/3 md:p-5 md:bg-white md:shadow md:rounded-lg">
                <div class="aspect-4/3 w-full bg-purple-600 rounded-md mb-3 overflow-hidden">
                    <img src="{{ Storage::url($auction->item->image) }}" alt="{{ $auction->item->name }}"
                        class="w-full h-full object-cover" loading="lazy">
                </div>
                <div class="">
                    <div class="flex flex-wrap gap-4 mb-3">
                        <div class="">Harga awal <span class="font-semibold">Rp{{
                                number_format($auction->item->start_price) }}</span>
                        </div>
                        -
                        <div class="">Total penawar <span class="font-semibold">{{ $history }}</span>
                        </div>
                        -
                        <div class="">Dibuat <span class="font-semibold">{{ date('d-m-Y',
                                strtotime($auction->opening_date))
                                }}</span>
                        </div>
                    </div>
                    <h2 class="text-slate-800 font-semibold text-lg mb-2">Deskripsi</h2>
                    <p class="text-slate-600">
                        {{ $auction->item->description }}
                    </p>
                </div>
            </div>
            <div class="w-full md:w-2/3 md:p-5 md:bg-white md:shadow md:rounded-lg">
                <div class="">
                    <h1 class="font-bold text-4xl text-purple-900 mb-4">
                        {{ $auction->item->name }}
                    </h1>
                    <p class="mb-5 text-slate-700">Dilelang oleh <span class="text-blue-600 font-medium">{{
                            $auction->staff->name
                            }}</span></p>
                    <div class="border rounded-md mb-4">
                        <div class="text-slate-600 border-b p-4">
                            @if ($auction->status == 'open')
                            Lelang akan segera berakhir
                            @else
                            Lelang berakhir pada {{ date('F j, Y', strtotime($auction->closing_date)) }}
                            @endif
                        </div>
                        <div class="p-4">
                            @if (Auth::check() && $auction->status == 'close' && $auction->user_id == Auth::user()->id)
                            you are winner
                            @else
                            <div class="text-slate-500">
                                {{ $auction->status == 'open' ? 'Harga saat ini' : 'Harga akhir' }}
                            </div>
                            <div class="font-bold text-3xl text-slate-700">
                                Rp{{ $auction->final_price ? number_format($auction->final_price) :
                                number_format($auction->item->start_price) }}
                                @if ($auction->user_id)
                                <span class="font-normal text-sm text-slate-500">
                                    oleh {{ $auction->user->name }}
                                </span>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                @if ($history)
                <div class="overflow-x-auto shadow rounded-lg mb-5">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-purple-100">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Penawaran
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histories as $history)
                            <tr class="bg-white border-t hover:bg-gray-50">
                                <th class="px-6 py-4 font-medium text-gray-900">
                                    {{ $loop->iteration }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{ $history->user->name }}
                                </th>
                                <td class="px-6 py-4">
                                    Rp{{ number_format($history->bid) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                @if ($auction->status == 'open')
                <div class="">
                    <label for="fbid" class="font-semibold inline-block mb-1" id="bid">Place Bid</label>
                    <div class="flex w-full gap-2">
                        <form action="{{ route('detail', $auction->id) }}" method="post" class="flex-grow">
                            @csrf
                            <div class="flex gap-2">
                                <input type="number" name="bid" id="fbid"
                                    class="py-2 px-4 border rounded-md focus:outline-none focus:ring-0 focus:border-purple-900/25 border-purple-900/25 flex-grow"
                                    min="{{ $min_price }}" max="{{ $min_price * 1000 }}" required>
                                <button type="submit"
                                    class="py-2 px-6 text-white bg-purple-600 rounded-md text-sm font-medium">
                                    Bid
                                </button>
                            </div>
                        </form>
                        @if (Auth::check() && $hasHistories)
                        <form action="{{ route('cancel_bid', $auction->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="px-4 py-2.5 bg-white md:bg-purple-50 rounded-md">
                                Cancel all bid
                            </button>
                        </form>
                        @endif
                    </div>
                    @if (session('error'))
                    <p class="mt-2 text-sm text-red-600 font-medium">
                        {{ session('error') }}</p>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
    {{-- <input type="hidden" class="auctionId" value="{{ $auction->id }}">
    <script>
        const auctionId = document.querySelector('.auctionId').value;
        setInterval(() => {
            let auction = document.getElementById('auction');
            let httpRequest = new XMLHttpRequest();
            httpRequest.onreadystatechange = function() {
                if(httpRequest.readyState === XMLHttpRequest.DONE) {
                    if (httpRequest.status === 200) {
                        auction.innerHTML = httpRequest.responseText;
                    }
                }
            };
            httpRequest.open('GET', 'http://localhost:8000/auction/'+ auctionId, true);
            httpRequest.send();
        }, 3000);
    </script> --}}
</x-frontend-layout>