<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index() {
        $historiesOn = History::with(['items', 'auctions', 'user'])->where('user_id', Auth::user()->id)->whereHas('auctions', function($auction){
            $auction->where('status', 'open');
        })->get()->unique('auction_id');
        $historiesEnd = History::with(['items', 'auctions', 'user'])->where('user_id', Auth::user()->id)->whereHas('auctions', function($auction){
            $auction->where('status', 'close');
        })->get();
        return view('pages.history', [
            'historiesOn' => $historiesOn,
            'historiesEnd' => $historiesEnd
        ]);
    }
}