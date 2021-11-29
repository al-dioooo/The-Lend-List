<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use App\Models\DataList;
use App\Models\Item;
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
        $loan = DataList::filter(request()->only('search', 'trashed'))->with('borrower', 'items')->latest()->paginate(10)->withQueryString();

        $data = [
            'datasheet' => $loan,
            'result' => $loan->count(),
        ];

        return Inertia::render('List/Index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $datasheet = DataList::with(['borrower', 'items'])->find($id);

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
        $datasheet = DataList::with(['borrower', 'items'])->find($id);

        $data = [
            'datasheet' => $datasheet
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
        //
    }
}
