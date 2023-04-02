@php
// dd($auctionsEnd);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name') }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-purple-50">
  <div class="pb-10">
    <div class="h-32 min-w-full bg-purple-600 pt-5 text-center text-4xl font-bold text-white">Online Auction</div>
    <div class="container mx-auto -mt-10 rounded-none sm:rounded-md border bg-white px-5 py-6 shadow">
      <div class="flex justify-between items-center">
        @auth
        <div class="">
          <a href="/" class="text-3xl font-bold text-purple-600">OA</a>
        </div>
        <div class="">
          @if (Auth::user()->level == 'public')
          <a href="{{ route('dashboard') }}" class="font-semibold text-purple-900 hover:underline ml-2">Dashboard</a>
          @else
          <a href="{{ route('admin') }}" class="font-semibold text-purple-900 hover:underline ml-2">Dashboard</a>
          @endif
        </div>
        @else
        <div class="">
          <a href="/" class="text-3xl font-bold text-purple-600">OA</a>
        </div>
        <div class="">
          <a href="{{ route('login') }}"
            class="text-white bg-purple-600 font-semibold px-4 py-2.5 rounded mr-2">Login</a>
        </div>
        @endauth
      </div>
    </div>

    <div class="container px-4 md:px-0 mx-auto">
      @if ($auctionsOn->count() != 0)
      <div class="">
        <h2 class="mt-8 mb-4 text-2xl font-bold">Auctions on</h2>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
          @foreach($auctionsOn as $auction)
          <div class="block rounded-lg border border-purple-100 bg-white p-5 shadow">
            <div class="aspect-4/3 w-full rounded-md bg-purple-600 overflow-hidden">
              <img class="w-full h-full object-cover" src="{{ Storage::url($auction->item->image) }}" loading="lazy" />
            </div>
            <div class="mt-3">
              <a href="{{ route('detail', $auction->id) }}"
                class="inline-block mb-3 truncate text-2xl font-bold tracking-tight text-purple-900">{{
                $auction->item->name
                }}
              </a>
              <div class="mb-3 flex">
                <div class="w-1/2">
                  <div class="mb-1 text-sm font-semibold text-purple-900/75">Start price</div>
                  <div
                    class="truncate rounded-l-md border-r bg-purple-50 py-2.5 px-4 text-slate-800 hover:bg-purple-100">
                    Rp{{ number_format($auction->item->start_price) }}</div>
                </div>
                <div class="w-1/2">
                  <div class="mb-1 text-sm font-semibold text-purple-900/75">Highest price</div>
                  <div class="truncate rounded-r-md bg-purple-50 py-2.5 px-4 text-slate-800 hover:bg-purple-100">
                    Rp{{ $auction->final_price ? number_format($auction->final_price) : '-' }}</div>
                </div>
              </div>
              <div class="mb-4">
                <div class="mb-1 text-sm font-semibold text-purple-900/75">Description</div>
                <p class="truncate rounded-md bg-purple-50 py-2.5 px-4 font-normal text-slate-700 hover:bg-purple-100">
                  {{ $auction->item->description }}</p>
              </div>
              <a href="{{ route('detail', $auction->id) }}"
                class="block rounded-lg bg-purple-600 py-2.5 text-center text-sm font-medium text-white hover:bg-purple-700 uppercase">
                make offer </a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endif

      @if ($auctionsEnd->count() != 0)
      <div class="">
        <h2 class="mt-8 mb-4 text-2xl font-bold">Auctions end</h2>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
          @foreach($auctionsEnd as $auction)
          <div class="block rounded-lg border border-purple-100 bg-white p-5 shadow">
            <div class="aspect-4/3 w-full overflow-hidden rounded-md bg-purple-600">
              <img class="h-full w-full object-cover" src="{{ Storage::url($auction->item->image) }}" loading="lazy" />
            </div>
            <div class="mt-3">
              <a href="{{ route('detail', $auction->id) }}"
                class="mb-3 inline-block truncate text-2xl font-bold tracking-tight text-purple-900"> {{
                $auction->item->name }} </a>
              <div class="mb-3 flex">
                <div class="w-1/2">
                  <div class="mb-1 text-sm font-semibold text-purple-900/75">Start price</div>
                  <div
                    class="truncate rounded-l-md border-r bg-purple-50 py-2.5 px-4 text-slate-800 hover:bg-purple-100">
                    Rp{{ number_format($auction->item->start_price) }}</div>
                </div>
                <div class="w-1/2">
                  <div class="mb-1 text-sm font-semibold text-purple-900/75">Final price</div>
                  <div class="truncate rounded-r-md bg-purple-50 py-2.5 px-4 text-slate-800 hover:bg-purple-100">
                    Rp{{ $auction->final_price ? number_format($auction->final_price) : '-' }}</div>
                </div>
              </div>
              <div class="mb-4">
                <div class="mb-1 text-sm font-semibold text-purple-900/75">Description</div>
                <p class="truncate rounded-md bg-purple-50 py-2.5 px-4 font-normal text-slate-700 hover:bg-purple-100">
                  {{ $auction->item->description }}</p>
              </div>
              <a href="{{ route('detail', $auction->id) }}"
                class="block rounded-lg bg-purple-600 py-2.5 text-center text-sm font-medium uppercase text-white hover:bg-purple-700">
                show details </a>
            </div>
          </div>

          @endforeach
        </div>
      </div>
      @endif
    </div>
  </div>
</body>

</html>