<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Dokter::orderBy('created_at','desc')->get();
        return view('dokter.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dokter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'no_ktp' => 'required|unique:dokters,no_ktp|min_digits:16',
            'name' => 'required',
            'gender' => 'required|in:MALE,FEMALE',
            'spesialis' => 'required',
            'phone' => 'required|string',
            'address' => 'required|max:100'
        ])->validate();


        Dokter::create([
            'name' => $request->name,
            'no_ktp' => $request->no_ktp,
            'gender' => $request->gender,
            'spesialis' => $request->spesialis,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('dokter')->with('success','Success Create Data.');
    }   

    /**
     * Display the specified resource.
     */
    public function show(Dokter $dokter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $data = Dokter::where('id', $id)->first();
        return view('dokter.edit',compact('data'));
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
            'spesialis' => 'required',
            'phone' => 'required|string',
            'address' => 'required|max:100'
        ])->validate();

        Dokter::where('id', $id)->update([
            'name' => $request->name,
            'no_ktp' => $request->no_ktp,
            'gender' => $request->gender,
            'spesialis' => $request->spesialis,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('dokter')->with('success','Success Update Data.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        Dokter::where('id', $id)->delete();

        return redirect()->route('dokter')->with('success','Success Delete Data.');
    }
}
