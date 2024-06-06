<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::orderBy('created_at', 'DESC')->get();
        return view('user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'no_ktp' => 'required|min_digits:16|unique:users,no_ktp',
            'roles' => 'required|in:staff,pasien',
            'password' => 'required',
            'cPassword' => 'required'
        ])->validate();

        if ($request->password != $request->cPassword) {
            return redirect()->route('user.create')->with('failed', 'password & confirm password tidak sama!');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_ktp' => $request->no_ktp,
            'roles' => $request->roles,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('user')->with('success','Success Create Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::where('id', $id)->first();
        return view('user.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        Validator::make($request->all(), [
            'no_ktp' => 'required|unique:users,no_ktp,'.$id.'|min_digits:16',
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id.'|email',
            'roles' => 'required|in:staff,pasien',
        ])->validate();


        User::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_ktp' => $request->no_ktp,
            'roles' => $request->roles,
        ]);

        return redirect()->route('user')->with('success','Success Update Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id',$id)->delete();

        return redirect()->route('user')->with('success','Success Delete Data');
    }
}
