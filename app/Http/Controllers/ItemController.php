<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Item::filter(request()->only('search', 'trashed'))->latest()->paginate(20)->withQueryString();

        $data = [
            'datasheet' => $item,
            'result' => $item->count(),
        ];

        return Inertia::render('Item/Index', $data);
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
            'name' => [
                'required',
                'max:255',
            ],
            'description' => [
                'max:255'
            ]
        ]);

        $item = new Item();

        $item->name = $request->input('name');
        $item->description = $request->input('description');

        $item->save();

        return redirect()->back()->with('message', 'Successfully created ' . $item->name . '!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => [
                'required',
                'max:255'
            ],
            'description' => [
                'max:255'
            ]
        ]);

        if ($request->input('name') == $item->name && $request->input('description') == $item->description) {
            return redirect()->back()->with(['banner' => 'Nothing changed', 'bannerStyle' => 'danger']);
        }

        $name = $item->name;

        $item->name = $request->input('name');
        $item->description = $request->input('description');

        $item->save();

        return redirect()->back()->with('message', 'Successfully updated ' . $name . ' to ' . $item->name . '!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->back()->with('message', 'Successfully trashed an item!');
    }
}
