<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BorrowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrower = Borrower::filter(request()->only('search', 'trashed'))->latest()->paginate(10)->withQueryString();

        $data = [
            'datasheet' => $borrower,
            'result' => $borrower->count(),
        ];

        return Inertia::render('Borrower/Index', $data);
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
            'name' => [
                'required',
                'max:255'
            ],
            'email' => [
                'email',
                'max:255'
            ],
            'contact' => [
                'max:255'
            ],
            'organization' => [
                'max:255'
            ]
        ]);

        $borrower = new Borrower();

        $borrower->name = $request->input('name');
        $borrower->email = $request->input('email');
        $borrower->contact = $request->input('contact');
        $borrower->organization = $request->input('organization');
        $borrower->address = $request->input('address');

        $borrower->save();

        return redirect()->back()->with('message', 'Successfully created a new borrower!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Borrower $borrower)
    {
        $request->validate([
            'name' => [
                'required',
                'max:255'
            ],
            'email' => [
                'email',
                'max:255'
            ],
            'contact' => [
                'max:255'
            ],
            'organization' => [
                'max:255'
            ]
        ]);

        $name = $borrower->name;

        $borrower->name = $request->input('name');
        $borrower->email = $request->input('email');
        $borrower->contact = $request->input('contact');
        $borrower->organization = $request->input('organization');
        $borrower->address = $request->input('address');

        $borrower->save();

        return redirect()->back()->with('message', 'Successfully updated ' . $name . ' to ' . $borrower->name .  '!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Borrower $borrower)
    {
        $borrower->delete();

        return redirect()->back()->with('message', 'Successfully trashed a borrower!');
    }
}
