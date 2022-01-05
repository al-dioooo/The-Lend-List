<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use App\Models\DataList;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index() {
        $datalist = DataList::all()->count();
        $item = Item::all()->count();
        $borrower = Borrower::all()->count();
        $report = DataList::reportFilter(['month' => Carbon::now()->month])->get()->count();

        $data = [
            'datalist' => $datalist,
            'item' => $item,
            'borrower' => $borrower,
            'report' => $report
        ];

        return Inertia::render('Dashboard', $data);
    }
}
