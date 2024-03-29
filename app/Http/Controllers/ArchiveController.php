<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Archive;
use App\Models\Condition;
use App\Models\Log;
use App\Models\RightType;
use App\Models\ScanStatus;
use App\Models\PhysicalStatus;
use App\Models\User;
use App\Models\ViewArchiveData;
use App\Models\ViewArchiveModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
                'condition_id' => 'required',
                'type_id' => 'required',
                'sk_number' => 'nullable',
                'description' => 'nullable',
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

        $log = [
            'barcode_number' => $validatedData['barcode_number'],
            'sk_number' => $validatedData['sk_number'],
            'action' => 'CREATE',
            'detail' => 'Menyimpan Data Arsip Baru ',
            'actor_name' => '[ID: ' . auth()->user()->id . '] ' . auth()->user()->name
        ];

        $archive = Archive::create($validatedData);
        if ($archive) {
            Log::create($log);
        }

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
        $archive = Archive::with(['type:id,name', 'rightType:id,name', 'scanStatus:id,name', 'physicalStatus:id,name', 'condition:id,name', 'editedBy:id,name',  'user:id,name'])->where('id', $archive->id)->get();
        return $archive->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function edit(Archive $archive)
    {
        return view('archives.edit', [
            'archive' => $archive,
            'title' => 'edit archive',
            'conditions' => Condition::all(),
            'types' => Type::all(),
            'provinsi' => \Indonesia::allProvinces(),
            'rights' => RightType::all(),
            'scans' => ScanStatus::all(),
            'physicals' => PhysicalStatus::all(),
        ]);
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
        $validatedData = null;

        if ($request->condition_id == 4) {
            $validatedData = $request->validate([
                'barcode_number' => 'required|numeric',
                'type_id' => 'required',
                'condition_id' => 'required',
                'sk_number' => 'nullable',
                'description' => 'nullable',
            ]);

            $validatedData['name'] = null;
            $validatedData['address'] = null;
            $validatedData['kelurahan'] = null;
            $validatedData['kecamatan'] = null;
            $validatedData['kab_kota'] = null;
            $validatedData['provinsi'] = null;
            $validatedData['right_type_id'] = null;
            $validatedData['scan_status_id'] = null;
            $validatedData['physical_status_id'] = null;
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

        $validatedData['edited_by'] = auth()->user()->id;

        $log = [
            'barcode_number' => request('barcode_number'),
            'sk_number' => request('sk_number'),
            'action' => 'UPDATE',
            'detail' => 'Mengubah/Memperbarui Data Arsip',
            'actor_name' => '[ID: ' . auth()->user()->id . '] ' . auth()->user()->name
        ];

        $status = Archive::where('id', $archive->id)->update($validatedData);

        $updatedArchive = Archive::find($archive->id);

        foreach ($archive->getAttributes() as $key => $value) {
            if ($value != $updatedArchive->$key) {
                if ($key != 'updated_at') {
                    $log['detail'] .= ' [' . $key . ': ' . $value . '  >  ' . $updatedArchive->$key . '] ';
                }
            }
        };

        if ($status) {
            Log::create($log);
        }

        if (auth()->user()->role == 0) {
            return redirect()->route('home')->with('success', 'Archive successfully edited');
        } else {
            return redirect()->route('archive.index')->with('success', 'Archive successfully edited');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Archive $archive)
    {
        $log = [
            'barcode_number' => $archive->barcode_number,
            'sk_number' => $archive->sk_number,
            'action' => 'DELETE',
            'detail' => 'Menghapus Data Arsip',
            'actor_name' => '[ID: ' . auth()->user()->id . '] ' . auth()->user()->name
        ];

        $success = Archive::destroy($archive->id);

        $success = $archive->delete();

        if ($success) {
            Log::create($log);
        }

        return back()->with('success', 'Archive successfully deleted');
    }

    public function jsonArchives()
    {
        $archives = ViewArchiveData::all();

        $dataTables = datatables()->of($archives)
            ->addColumn('action', function ($archives) {
                $btn = "<a href='" . route('archive.edit', $archives->id) . "'  target='_blank' class='btn btn-sm btn-warning'><svg xmlns='http://www.w3.org/2000/svg' width='1.5em' height='1.5em' preserveAspectRatio='xMidYMid met' viewBox='0 0 24 24'><path fill='white' d='m18.988 2.012l3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287l-3-3L8 13z'/><path fill='white' d='M19 19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z'/></svg></a>";
                $btn .= "<button type='button' data-toggle='modal' data-target='#detailModal' data-id='" . $archives->id . "' class='btn btn-sm btn-info'><svg xmlns='http://www.w3.org/2000/svg' width='1.5em' height='1.5em' preserveAspectRatio='xMidYMid meet' viewBox='0 0 32 32'><circle cx='16' cy='16' r='4' fill='white'/><path fill='white' d='M30.94 15.66A16.69 16.69 0 0 0 16 5A16.69 16.69 0 0 0 1.06 15.66a1 1 0 0 0 0 .68A16.69 16.69 0 0 0 16 27a16.69 16.69 0 0 0 14.94-10.66a1 1 0 0 0 0-.68ZM16 22.5a6.5 6.5 0 1 1 6.5-6.5a6.51 6.51 0 0 1-6.5 6.5Z'/></svg></button>";

                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();

        return $dataTables;
    }


    //API
    public function apiIndex()
    {

        $userId = request('userId');

        $archives = null;

        if (isset($userId)) {
            $archives = Archive::with(['type', 'condition'])->where('user_id', $userId)->select('id', 'barcode_number', 'condition_id', 'type_id', 'sk_number', 'name', 'kelurahan',  'created_at')->get();
        } else {
            $archives = Archive::with(['type', 'condition'])->select('id', 'barcode_number', 'condition_id', 'type_id', 'sk_number', 'name', 'kelurahan',  'created_at')->get();
        }

        foreach ($archives as $archive) {
            $archive->sk_number = checkNull($archive->sk_number);
            $archive->name = checkNull($archive->name);
            $archive->kelurahan = checkNull($archive->kelurahan);
            $archive->type_name = checkNullCategory($archive->type);
            $archive->condition_name = checkNullCategory($archive->condition);
            $archive->created_at_date = checkNull($archive->created_at->toDateString());
        }

        return $archives;
    }

    public function apiShow(Archive $archive)
    {

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

    public function apiStore()
    {
        request()->validate([
            'barcode_number' => 'required|numeric',
            'type_id' => 'required',
            'condition_id' => 'required',
            'sk_number' => 'nullable',
            'description' => 'nullable',
            'user_id' => 'required',
        ]);

        $archive = Archive::create([
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

        $log = [
            'barcode_number' => request('barcode_number'),
            'sk_number' => request('sk_number'),
            'action' => 'CREATE',
            'detail' => 'Menyimpan Data Arsip Baru',
            'actor_name' => '[ID: ' . auth()->user()->id . '] ' . auth()->user()->name
        ];

        if ($archive) {
            Log::create($log);
        }

        return $archive;
    }

    public function apiDestroy(Archive $archive)
    {
        $log = [
            'barcode_number' => $archive->barcode_number,
            'sk_number' => $archive->sk_number,
            'action' => 'DELETE',
            'detail' => 'Menghapus Data Arsip',
            'actor_name' => '[ID: ' . auth()->user()->id . '] ' . auth()->user()->name
        ];

        $success = $archive->delete();

        if ($success) {
            Log::create($log);
        }

        return [
            'success' => $success
        ];
    }
}
