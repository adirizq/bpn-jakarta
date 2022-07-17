<?php

namespace App\Http\Controllers;

use App\Models\RightType;
use Illuminate\Http\Request;

class RightTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rights.index')->with([
            'rightTypes' => RightType::all(),
            'title' => 'Archive Right Type'
        ]);
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        RightType::create($validatedData);

        return back()->with('success', 'New right type successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RightType  $rightType
     * @return \Illuminate\Http\Response
     */
    public function show(RightType $rightType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RightType  $rightType
     * @return \Illuminate\Http\Response
     */
    public function edit(RightType $rightType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RightType  $rightType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RightType $rightType)
    {
        $validatedData = $request->validate([
            'new_name' => 'required|max:255',
        ]);

        RightType::where('id', $rightType->id)->update([
            'name' => $validatedData['new_name']
        ]);

        return back()->with('success', 'Right type name successfully changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RightType  $rightType
     * @return \Illuminate\Http\Response
     */
    public function destroy(RightType $rightType)
    {
        RightType::destroy($rightType->id);
        return back()->with('success', 'Right type successfully deleted');
    }

    public function apiIndex()
    {
        return RightType::all();
    }
}
