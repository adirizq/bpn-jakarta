<?php

namespace App\Http\Controllers;

use App\Models\ScanStatus;
use Illuminate\Http\Request;

class ScanStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('scans.index')->with([
            'scans' => ScanStatus::all(),
            'title' => 'Archive Scan Status'
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

        ScanStatus::create($validatedData);

        return back()->with('success', 'New scan status successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ScanStatus  $scanStatus
     * @return \Illuminate\Http\Response
     */
    public function show(ScanStatus $scanStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ScanStatus  $scanStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(ScanStatus $scanStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScanStatus  $scanStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScanStatus $scanStatus)
    {
        $validatedData = $request->validate([
            'new_name' => 'required|max:255',
        ]);

        ScanStatus::where('id', $scanStatus->id)->update([
            'name' => $validatedData['new_name']
        ]);

        return back()->with('success', 'Scan status name successfully changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ScanStatus  $scanStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScanStatus $scanStatus)
    {
        ScanStatus::destroy($scanStatus->id);
        return back()->with('success', 'Scan status successfully deleted');
    }

    public function apiIndex()
    {
        return ScanStatus::all();
    }
}
