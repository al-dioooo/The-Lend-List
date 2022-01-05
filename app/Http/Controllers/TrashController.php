<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use App\Models\DataList;
use App\Models\Item;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TrashController extends Controller
{
    public function index()
    {
        $datalist = DataList::filter(request()->only('search'))->onlyTrashed()->with('borrower', 'items')->latest()->get();
        $item = Item::filter(request()->only('search'))->onlyTrashed()->latest()->get();
        $borrower = Borrower::filter(request()->only('search'))->onlyTrashed()->latest()->get();
        $datasheet = [];

        foreach ($datalist as $row) {
            array_push($datasheet, [
                'type' => 'Data List',
                'data' => $row
            ]);
        }

        foreach ($item as $row) {
            array_push($datasheet, [
                'type' => 'Item',
                'data' => $row
            ]);
        }

        foreach ($borrower as $row) {
            array_push($datasheet, [
                'type' => 'Borrower',
                'data' => $row
            ]);
        }

        $data = [
            'datasheet' => $datasheet,
            'result' => count($datasheet),
        ];

        return Inertia::render('Trash/Index', $data);
    }

    public function restore(Request $request)
    {
        $message = null;

        if ($request->type == "Data List") {
            $datalist = DataList::onlyTrashed()->find($request->data['id'])->restore();

            $message = 'Data successfully restored';
        } else if ($request->type == "Item") {
            $item = Item::onlyTrashed()->find($request->data['id'])->restore();

            $message = 'Item successfully restored';
        } else if ($request->type == "Borrower") {
            $borrower = Borrower::onlyTrashed()->find($request->data['id'])->restore();

            $message = 'Borrower successfully restored';
        }

        return redirect()->back()->with('message', $message);
    }

    public function destroy(Request $request)
    {
        $message = null;

        if ($request->type == "Data List") {
            $datalist = DataList::onlyTrashed()->find($request->data['id'])->forceDelete();

            $message = 'Data successfully deleted';
        } else if ($request->type == "Item") {
            $item = Item::onlyTrashed()->find($request->data['id'])->forceDelete();

            $message = 'Item successfully deleted';
        } else if ($request->type == "Borrower") {
            $borrower = Borrower::onlyTrashed()->find($request->data['id'])->forceDelete();

            $message = 'Borrower successfully deleted';
        }

        return redirect()->back()->with('message', $message);
    }

    public function empty() {
        DataList::onlyTrashed()->forceDelete();
        Item::onlyTrashed()->forceDelete();
        Borrower::onlyTrashed()->forceDelete();

        return redirect()->back()->with('message', 'Successfully emptied the recycle bin');
    }
}
