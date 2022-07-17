<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Indonesia\IndonesiaService;

class AreaController extends Controller
{
    public function apiProvinces() {
        return \Indonesia::allProvinces();
    }

    public function apiCities() {
        request()->validate([
            'provinceId' => 'required'
        ]);

        return \Indonesia::findProvince(request('provinceId'), ['cities']);
    }

    public function apiDistricts() {
        request()->validate([
            'cityId' => 'required'
        ]);

        return \Indonesia::findCity(request('cityId'), ['districts']);
    }

    public function apiVillages() {
        request()->validate([
            'districtId' => 'required'
        ]);

        return \Indonesia::findDistrict(request('districtId'), ['villages']);
    }



    public function getCities($id) {
        $cities = \Indonesia::findProvince($id, ['cities'])->cities;

        return response()->json($cities);
    }

    public function getDistricts($id) {
        $districts = \Indonesia::findCity($id, ['districts'])->districts;

        return response()->json($districts);
    }

    public function getVillages($id) {
        $villages = \Indonesia::findDistrict($id, ['villages'])->villages;

        return response()->json($villages);
    }
}
