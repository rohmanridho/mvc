<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Auction;
use illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        if (Auth::user()->level == 'staff') {
            $countAuctions = Auction::where('staff_id', Auth::user()->id)->count();
            $onAuctions = Auction::where([
                'status' => 'open',
                'staff_id' => Auth::user()->id
            ])->count();
            $endAuctions = Auction::where([
                'status' => 'close',
                'staff_id' => Auth::user()->id
            ])->count();
            $errorAuctions = Auction::where([
                'status' => 'close',
                'staff_id' => Auth::user()->id,
                'user_id' => null
                ])->count();
            $auctions = Auction::with(['item', 'staff', 'user'])->where('staff_id', Auth::user()->id)->where('user_id', '!=', null)->take(5)->orderByDesc('closing_date')->get();
            return view('pages.staff.dashboard', [
                'countAuctions' => $countAuctions,
                'onAuctions' => $onAuctions,
                'endAuctions' => $endAuctions,
                'errorAuctions' => $errorAuctions,
                'auctions' => $auctions
            ]);
        }

        if (Auth::user()->level == 'admin') {
            $staffs = User::where('level', 'staff')->count();
            $publics = User::where('level', 'public')->count();
            $autionTotals = Auction::count();
            $onAuctions = Auction::where('status', 'open')->count();
            $endAuctions = Auction::where('status', 'close')->count();
            $auctions = Auction::with(['item', 'staff', 'user'])->take(5)->get();
            return view('pages.admin.dashboard', [
                'staffs' => $staffs,
                'publics' => $publics,
                'auctionTotals' => $autionTotals,
                'onAuctions' => $onAuctions,
                'endAuctions' => $endAuctions,
                'auctions' => $auctions
            ]);
        }
    }
}