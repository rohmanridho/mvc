<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Auction</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container mx-auto">
        <h1 class="text-center mb-4 font-bold text-2xl">Auction</h1>
        <div class="mb-4">
            <div class=""><span class="">Item: </span>{{ $auction->item->name }}</div>
            <div class=""><span class="">Staff: </span>{{ $auction->staff->name }}</div>
            <div class=""><span class="">Status: </span>{{ $auction->status }}</div>
            <div class=""><span class="">Opening: </span>{{ $auction->opening_date }}</div>
            <div class=""><span class="">Closing: </span>{{ $auction->closing_date }}</div>
        </div>
        <div class="w-full overflow-hidden border border-black">
            <div class="w-full overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-xs tracking-wide text-left text-gray-500 uppercase border-b border-black">
                            <th class="px-4 py-3 border-r border-black">No</th>
                            <th class="px-4 py-3 border-r border-black">User</th>
                            <th class="px-4 py-3">Bid</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach ($histories as $history)
                        <tr class="text-gray-700">
                            <td class="px-4 py-2 text-sm border-r border-black">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-4 py-2 text-sm border-r border-black">
                                {{ $history->user->name }}
                            </td>
                            <td class="px-4 py-2 text-sm border-black">
                                IDR {{ number_format($history->bid) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>