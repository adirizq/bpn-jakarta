<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('archives.index')->with([
            'archives' => Archive::with('type', 'user')->get(),
            'title' => 'archives',
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
        $validatedData = null;

        if ($request->condition_id == 4) {
            $validatedData = $request->validate([
                'barcode_number' => 'required|numeric',
                'type_id' => 'required',
                'condition_id' => 'required',
            ]);
        } else {
            $validatedData = $request->validate([
                'barcode_number' => 'required|numeric',
                'rack_location' => 'required',
                'condition_id' => 'required',
                'type_id' => 'required',
                'sk_number' => 'required',
                'name' => 'required',
                'address' => 'required',
                'kelurahan' => 'required',
                'kecamatan' => 'required',
                'kab_kota' => 'required',
                'provinsi' => 'required',
                'right_type_id' => 'required',
                'scan_status_id' => 'required',
                'physical_status_id' => 'required',
                'description' => 'nullable',
            ]);

            $validatedData['provinsi'] = \Indonesia::findProvince($validatedData['provinsi'])->name;
            $validatedData['kab_kota'] = \Indonesia::findCity($validatedData['kab_kota'])->name;
            $validatedData['kecamatan'] = \Indonesia::findDistrict($validatedData['kecamatan'])->name;
            $validatedData['kelurahan'] = \Indonesia::findVillage($validatedData['kelurahan'])->name;
        }

        $validatedData['user_id'] = auth()->user()->id;

        Archive::create($validatedData);

        return back()->with('success', 'New archive successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function show(Archive $archive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function edit(Archive $archive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archive $archive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Archive $archive)
    {
        Archive::destroy($archive->id);
        return back()->with('success', 'Archive successfully deleted');
    }


    //API
    public function apiIndex(){

        $userId = request('userId');

        $archives = null;

        if (isset($userId)){
            $archives = Archive::with(['type', 'condition'])->where('user_id', $userId)->select('id', 'barcode_number', 'condition_id', 'type_id', 'sk_number', 'name', 'kelurahan',  'created_at')->get();
        } else {
            $archives = Archive::with(['type', 'condition'])->select('id', 'barcode_number', 'condition_id', 'type_id', 'sk_number', 'name', 'kelurahan',  'created_at')->get();
        }

        foreach($archives as $archive) {
            $archive->sk_number = checkNull($archive->sk_number);
            $archive->name = checkNull($archive->name);
            $archive->kelurahan = checkNull($archive->kelurahan);
            $archive->type_name = checkNullCategory($archive->type);
            $archive->condition_name = checkNullCategory($archive->condition);
            $archive->created_at_date = checkNull($archive->created_at->toDateString());
        }

        return $archives;
    }

    public function apiShow(Archive $archive){

        $archive->barcode_number = checkNull($archive->barcode_number); 
        $archive->rack_location = checkNull($archive->rack_location); 
        $archive->type_name = checkNullCategory($archive->type); 
        $archive->sk_number = checkNull($archive->sk_number); 
        $archive->name = checkNull($archive->name); 
        $archive->address = checkNull($archive->address); 
        $archive->provinsi = checkNull($archive->provinsi); 
        $archive->kab_kota = checkNull($archive->kab_kota); 
        $archive->kecamatan = checkNull($archive->kecamatan); 
        $archive->kelurahan = checkNull($archive->kelurahan); 
        $archive->right_type_name = checkNullCategory($archive->rightType); 
        $archive->scan_status_name = checkNullCategory($archive->scanStatus); 
        $archive->physical_status_name = checkNullCategory($archive->physicalStatus); 
        $archive->condition_name = checkNullCategory($archive->condition); 
        $archive->description = checkNull($archive->description); 
        $archive->user_name = checkNullCategory($archive->user); 
        $archive->created_at_date = checkNull($archive->created_at->toDateString());

        return $archive;
    }

    public function apiStore(){
        request()->validate([
            'barcode_number' => 'required|numeric',
            'type_id' => 'required',
            'condition_id' => 'required',
            'user_id' => 'required',
        ]);
    
        return Archive::create([
            'barcode_number' => request('barcode_number'),
            'rack_location' => request('rack_location'),
            'type_id' => request('type_id'),
            'sk_number' => request('sk_number'),
            'name' => request('name'),
            'address' => request('address'),
            'kelurahan' => request('kelurahan'),
            'kecamatan' => request('kecamatan'),
            'kab_kota' => request('kab_kota'),
            'provinsi' => request('provinsi'),
            'right_type_id' => request('right_type_id'),
            'scan_status_id' => request('scan_status_id'),
            'physical_status_id' => request('physical_status_id'),
            'condition_id' => request('condition_id'),
            'description' => request('description'),
            'user_id' => request('user_id'),
        ]);
    }

    public function apiDestroy(Archive $archive){
       $success = $archive->delete(); 

       return [
        'success' => $success
       ];
    }
}
