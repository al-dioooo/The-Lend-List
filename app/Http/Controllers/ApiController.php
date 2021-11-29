<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use App\Models\Item;
use Illuminate\Http\Request;

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
}
