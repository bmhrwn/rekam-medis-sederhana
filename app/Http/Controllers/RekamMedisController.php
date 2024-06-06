<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\RekamMedis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = RekamMedis::query();
        
        $user = Auth::user();

        if($user->roles == 'pasien'){
            $data = $data->where('pasiens.no_ktp' ,$user->no_ktp);
        }

        if($user->roles == 'staff'){
            $data = $data->where('dokters.no_ktp' ,$user->no_ktp);
        }

        $data = $data->select('rekam_medis.*', 'dokters.name as dokter_name', 'pasiens.no_ktp as pasien_no_ktp', 'pasiens.name as pasien_name')
            ->leftJoin('dokters', 'dokters.id', '=', 'rekam_medis.dokter_id')
            ->leftJoin('pasiens', 'pasiens.id', '=', 'rekam_medis.patient_id')
            ->orderBy('created_at', 'desc')
            ->get();



        return view('rekamMedis.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $pasien = Pasien::orderBy('created_at', 'DESC')->get();
        $dokter = Dokter::orderBy('created_at', 'DESC')->get();
        return view('rekamMedis.create', compact('pasien', 'dokter'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        Validator::make($request->all(), [
            'dokter_id' => 'required',
            'patient_id' => 'required',
            'diagnosa' => 'required',
            'harga' => 'required'
        ])->validate();

        $date = Carbon::now();
        $formatedDate = $date->format('Y-m-d');
        $regist_number = null;


        $data = RekamMedis::orderBy('created_at', 'DESC')->where('regist_date', $formatedDate)->first();

        if ($data == null) {
            $regist_number = str_replace('-', '', $formatedDate) . "0001";
        } else {
            $number = (int)$data->no_rekam_medis + 1;
            $regist_number = (string)$number;
        }

        RekamMedis::create([
            'dokter_id' => $request->dokter_id,
            'patient_id' => $request->patient_id,
            'diagnosa' => $request->diagnosa,
            'harga' => $request->harga,
            'status' => 'PEMERIKSAAN',
            'regist_date' => $formatedDate,
            'no_rekam_medis' => $regist_number
        ]);

        return redirect()->route('rekamMed')->with('success', 'Success Create Data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RekamMedis $rekamMedis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $pasien = Pasien::orderBy('created_at', 'DESC')->get();
        $dokter = Dokter::orderBy('created_at', 'DESC')->get();
        $data = RekamMedis::where('id', $id)->first();
        return view('rekamMedis.edit', compact('pasien', 'dokter', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        Validator::make($request->all(), [
            'dokter_id' => 'required',
            'patient_id' => 'required',
            'diagnosa' => 'required',
            'harga' => 'required'
        ])->validate();

        RekamMedis::where('id', $id)->update([
            'dokter_id' => $request->dokter_id,
            'patient_id' => $request->patient_id,
            'diagnosa' => $request->diagnosa,
            'harga' => $request->harga,
        ]);

        return redirect()->route('rekamMed')->with('success', 'Success Update Data.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        RekamMedis::where('id', $id)->delete();

        return redirect()->route('rekamMed')->with('success', 'Success Delete Data.');
    }

    public function finish(int $id){

        $data = RekamMedis::where('id',$id)->first();

        if($data->status == 'SELESAI'){
            return redirect()->route('rekamMed')->with('failed', 'Failed Finish Data.');
        }

        RekamMedis::where('id',$id)->update([
            'status' => 'SELESAI'
        ]);

        return redirect()->route('rekamMed')->with('success', 'Success Finish Data.');
    }
}
