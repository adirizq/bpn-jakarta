<?php

namespace App\Http\Controllers;

use App\Models\PhysicalStatus;
use Illuminate\Http\Request;

class PhysicalStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('physicals.index')->with([
            'physicals' => PhysicalStatus::all(),
            'title' => 'Archive Physical Status'
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

        PhysicalStatus::create($validatedData);

        return back()->with('success', 'New physical status successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhysicalStatus  $physicalStatus
     * @return \Illuminate\Http\Response
     */
    public function show(PhysicalStatus $physicalStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PhysicalStatus  $physicalStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(PhysicalStatus $physicalStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PhysicalStatus  $physicalStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PhysicalStatus $physicalStatus)
    {
        $validatedData = $request->validate([
            'new_name' => 'required|max:255',
        ]);

        PhysicalStatus::where('id', $physicalStatus->id)->update([
            'name' => $validatedData['new_name']
        ]);

        return back()->with('success', 'Physical status name successfully changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhysicalStatus  $physicalStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhysicalStatus $physicalStatus)
    {
        PhysicalStatus::destroy($physicalStatus->id);
        return back()->with('success', 'Physical status successfully deleted');
    }

    public function apiIndex()
    {
        return PhysicalStatus::all();
    }
}
