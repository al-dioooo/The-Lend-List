<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use App\Models\DataList;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DataListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loan = DataList::filter(request()->only('search'))->with('borrower', 'items')->latest()->paginate(20)->withQueryString();

        $data = [
            'datasheet' => $loan,
            'result' => $loan->count(),
        ];

        return Inertia::render('List/Index', $data);
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
            'item' => 'required',
            'borrower' => 'required'
        ]);

        $data = new DataList();

        $borrower = Borrower::find($request->input('borrower'));

        $data->borrower()->associate($borrower);
        $data->note = $request->input('note');

        $data->unique_id = floor(time() - 999999999);

        $data->save();

        $data->items()->sync($request->input('item'));

        return redirect()->back()->with('message', 'Successfully created a new list!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datasheet = DataList::with(['borrower', 'items'])->findOrFail($id);

        $data = [
            'datasheet' => $datasheet
        ];

        return Inertia::render('List/Show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataList = DataList::with(['borrower', 'items'])->findOrFail($id);

        $data = [
            'datasheet' => $dataList
        ];

        return Inertia::render('List/Edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataList $dataList)
    {
        $request->validate([
            'item' => 'required',
            'borrower' => 'required',
            'note' => 'string|nullable',
            'returned_at' => 'required_if:is_returned,true',
            'accepted_by' => 'required_if:is_returned,true'
        ]);

        $borrower = Borrower::find($request->input('borrower'));
        $dataList->borrower()->associate($borrower);
        $dataList->note = $request->input('note');

        if ($request->input('is_returned') == true) {
            $dataList->returned_at = Carbon::parse($request->input('returned_at'))->toDateTimeString();
            $dataList->accepted_by = $request->input('accepted_by');
            $dataList->is_returned = 1;
        } else {
            $dataList->returned_at = null;
            $dataList->accepted_by = null;
            $dataList->is_returned = 0;
        }

        $dataList->save();

        if (!is_array($request->input('item')[0])) {
            $dataList->items()->sync($request->input('item'));
        }

        return redirect()->route('data-list.show', $dataList)->with('message', 'Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataList $dataList)
    {
        $id = $dataList->unique_id;

        $dataList->delete();

        return redirect()->route('data-list.index')->with('message', 'Successfully moved data ' . $id . ' to trash!');
    }
}
