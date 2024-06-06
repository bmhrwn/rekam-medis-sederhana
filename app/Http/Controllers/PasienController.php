<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Pasien::orderBy('created_at','desc')->get();
        return view('pasien.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'no_ktp' => 'required|unique:pasiens,no_ktp|min_digits:16',
            'name' => 'required',
            'gender' => 'required|in:MALE,FEMALE',
            'dob' => 'required|date',
            'phone' => 'required|string',
            'address' => 'required|max:100'
        ])->validate();


        Pasien::create([
            'name' => $request->name,
            'no_ktp' => $request->no_ktp,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('pasien')->with('success','Success Create Data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pasien $pasien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $data = Pasien::where('id', $id)->first();
        return view('pasien.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        Validator::make($request->all(), [
            'no_ktp' => 'required|unique:dokters,no_ktp,'.$id.'|min_digits:16',
            'name' => 'required',
            'gender' => 'required|in:MALE,FEMALE',
            'dob' => 'required|date',
            'phone' => 'required|string',
            'address' => 'required|max:100'
        ])->validate();


        Pasien::where('id', $id)->update([
            'name' => $request->name,
            'no_ktp' => $request->no_ktp,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('pasien')->with('success','Success Update Data.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        Pasien::where('id', $id)->delete();

        return redirect()->route('pasien')->with('success','Success Delete Data.');
    }
}
