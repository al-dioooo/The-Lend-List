<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use App\Models\DataList;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function item()
    {
        $item = Item::filter(request()->only('search'))->limit(5)->get(['id', 'name', 'description']);

        return $item;
    }

    public function borrower()
    {
        $borrower = Borrower::filter(request()->only('search'))->limit(5)->get(['id', 'name', 'email']);

        return $borrower;
    }

    public function year() {
        $year = DataList::select(DB::raw('YEAR(created_at) year'))->get();

        return $year;
    }

    public function month() {
        $month = DataList::select(DB::raw('MONTH(created_at) month'))->get();

        return $month;
    }
}
