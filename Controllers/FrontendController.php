<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $auctionsOn = Auction::with(['item'])->where('status', 'open')->get();
        $auctionsEnd = Auction::with(['item'])->where('status', 'close')->get();
        return view('pages.home', [
            'auctionsOn' => $auctionsOn,
            'auctionsEnd' => $auctionsEnd
        ]);
    }

    public function detail($id)
    {
        $auction = Auction::with(['item'])->find($id);
        if ($auction->final_price) {
            $min_price = $auction->final_price + 1;
        } else {
            $min_price = $auction->item->start_price + 1;
        }
        $history = History::where('auction_id', $id)->count();
        $histories = History::with('user')->where('auction_id', $id)->orderByDesc('bid')->take(3)->get();
        if (Auth::check()) {
            $hasHistories = History::where([
                'auction_id' => $id,
                'user_id' => Auth::user()->id
            ])->first();

            return view('pages.detail', [
                'auction' => $auction,
                'history' => $history,
                'histories' => $histories,
                'min_price' => $min_price,
                'hasHistories' => $hasHistories
            ]);
        }

        return view('pages.detail', [
            'auction' => $auction,
            'history' => $history,
            'histories' => $histories,
            'min_price' => $min_price,
        ]);
    }

    public function bid(Request $request, $id)
    {
        $auction = Auction::with('item')->find($id);
        $history_data = [
            'item_id' => $auction->item_id,
            'auction_id' => $id,
            'user_id' => Auth::user()->id,
            'bid' => $request->bid
        ];

        if ($auction->status == 'open') {
            if ($auction->final_price) {
                $min_price = $auction->final_price + 1;
            } else {
                $min_price = $auction->item->start_price + 1;
            }
            if ($request->bid < $min_price) {
                return redirect()->back();
            }

            if (Auth::user()->level == 'admin' || Auth::user()->level == 'staff') {
                return redirect()->back()->with('error', 'You are not a public');
            }

            $top = History::where('auction_id', $id)->orderByDesc('bid')->first();
            if ($top && $top->user_id == Auth::user()->id) {
                $history_id = History::create($history_data)->id;
                Auction::where('id', $id)->update([
                    'user_id' => Auth::user()->id,
                    'final_price' => $request->bid
                ]);
                $history = History::where('auction_id', $id)->where('user_id', Auth::user()->id)->where('id', '<', $history_id);
                $history->delete();
                return redirect()->back();
            }

            $history_id = History::create($history_data)->id;
            Auction::where('id', $id)->update([
                'user_id' => Auth::user()->id,
                'final_price' => $request->bid
            ]);
            $history = History::where('auction_id', $id)->where('user_id', Auth::user()->id)->where('id', '<', $history_id);
            $history->delete();
        }
        return redirect()->back();
    }

    public function cancel_bid($id)
    {
        $histories = History::where([
            'auction_id' => $id,
            'user_id' => Auth::user()->id
        ]);
        $histories->delete();

        $hasHistories = History::where('auction_id', $id)->orderByDesc('bid')->first();
        if ($hasHistories) {
            Auction::where('id', $id)->update([
                'user_id' => $hasHistories->user_id,
                'final_price' => $hasHistories->bid
            ]);
        } else {
            Auction::where('id', $id)->update([
                'user_id' => NULL,
                'final_price' => NULL
            ]);
        }
        return redirect()->back();
    }
}