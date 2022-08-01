<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Condition;
use App\Models\PhysicalStatus;
use App\Models\RightType;
use App\Models\ScanStatus;
use App\Models\Type;
use Laravolt\Indonesia\IndonesiaService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('dashboard', [
            'title' => 'dashboard'
        ]);
    }

    public function index()
    {
        return view('home', [
            'archives' => Archive::latest()->with(['type', 'rightType', 'scanStatus', 'physicalStatus', 'condition', 'user'])->where('user_id', auth()->user()->id)->paginate(10),
            'title' => 'home',
            'conditions' => Condition::all(),
            'types' => Type::all(),
            'provinsi' => \Indonesia::allProvinces(),
            'rights' => RightType::all(),
            'scans' => ScanStatus::all(),
            'physicals' => PhysicalStatus::all(),
        ]);
    }

    public function jsonArchives() {
        $archives = Archive::latest()->with(['type', 'rightType', 'scanStatus', 'physicalStatus', 'condition', 'editedBy',  'user'])->where('user_id', auth()->user()->id)->get();

        $dataTables = datatables()->of($archives)->toJson();

        return $dataTables;
    }
}
