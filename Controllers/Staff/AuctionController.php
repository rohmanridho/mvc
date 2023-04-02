<?php

namespace App\Http\Controllers\Staff;

use App\Models\Item;
use App\Models\History;
use App\Models\Auction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->level == 'staff') {
            $auctions = Auction::with(['item', 'staff', 'user'])->where('staff_id', Auth::user()->id)->get();
        }

        if (Auth::user()->level == 'admin') {
            $auctions = Auction::with(['item', 'staff', 'user'])->get();
        }

        return view('pages.auctions.index', [
            'auctions' => $auctions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.auctions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'start_price' => 'required',
            'image' => 'required',
            'description' => 'required'
            // 'duration' => 'required',
        ]);
        $item_data = [
            'image' => $request->file('image')->store('item', 'public'),
            'name' => $request->name,
            'date' => now(),
            'start_price' => $request->start_price,
            'description' => $request->description
        ];
        $item_id = Item::create($item_data)->id;

        // $duration = $request->duration;
        $auction_data = [
            'item_id' => $item_id,
            'opening_date' => now(),
            'staff_id' => Auth::user()->id,
            // 'closing_date' => null
            // 'closing_date' => date('Y-m-d H:i:s', strtotime(now() . "+ $duration days")),
        ];
        Auction::insert($auction_data);

        return redirect()->route('auctions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auction = Auction::find($id);
        $histories = History::with(['items', 'auctions', 'user'])->where('auction_id', $id)->orderByDesc('bid')->paginate(10);
        return view('pages.auctions.show', [
            'auction' => $auction,
            'histories' => $histories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $auction = Auction::find($id);
        if ($auction->status == 'close' && $auction->user_id != null) {
            return redirect()->back();
        }

        $item = Item::find($auction->item_id);
        $item->delete();
        $auction->delete();
        return redirect()->back();
    }

    public function closeOpen(Request $request, $id)
    {
        $auction = Auction::find($id);

        if ($auction->user_id != null && $auction->final_price != null) {
            $auction->update([
                'status' => 'close',
                'closing_date' => now()
            ]);
        } else {
            $auction->update([
                'status' => 'open',
                'closing_date' => null
            ]);
        }
        return redirect()->back();
    }

    public function printAllAuctions()
    {
        if (Auth::user()->level == 'admin') {
            $auctions = Auction::with(['item', 'staff', 'user'])->get();
        }

        if (Auth::user()->level == 'staff') {
            $auctions = Auction::with(['item', 'user'])->where('staff_id', Auth::user()->id)->get();
        }

        return view('pages.auctions.print-all-auctions', [
            'auctions' => $auctions
        ]);
    }

    public function printPerAuction($id)
    {
        $auction = Auction::with(['item', 'staff'])->find($id);
        $histories = History::with(['user'])->where('auction_id', $id)->orderByDesc('bid')->take(10)->get();
        return view('pages.auctions.print-per-auction', [
            'auction' => $auction,
            'histories' => $histories
        ]);
    }

    public function deleteHistory($id)
    {
        $history = History::find($id);
        $auctionId = $history->auction_id;
        $history->delete();
        $hasHistories = History::where('auction_id', $auctionId)->orderByDesc('bid')->first();
        if ($hasHistories) {
            Auction::where('id', $auctionId)->update([
                'user_id' => $hasHistories->user_id,
                'final_price' => $hasHistories->bid
            ]);
        } else {
            Auction::where('id', $auctionId)->update([
                'user_id' => NULL,
                'final_price' => NULL
            ]);
        }
        return redirect()->back();
    }
}