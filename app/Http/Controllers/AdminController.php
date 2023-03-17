<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = DB::table('users')
        ->get();

        return view('admin.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

            try {
                $newDataUser = new User();
                $newDataUser->name = $request->name;
                $newDataUser->email = $request->email;
                $newDataUser->password = Hash::make($request->password);
                $newDataUser->role = $request->role;
                $newDataUser->save();

                return redirect('users');
            } catch (Exception $e) {
                $user = DB::table('users')->get();
                $err = $e->getMessage();
                return view('admin.index', compact('err', 'user'));
                // throw $th;
            }
     
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
    public function edit($id)
    {
        //
        $user = DB::table('users')
        ->where('id', '=', $id)
        ->first();

        return view('admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $newDataUser = User::find($id);
            $newDataUser->name = $request->name;
            $newDataUser->email = $request->email;
            $newDataUser->password = Hash::make($request->password);
            $newDataUser->role = $request->role;
            $newDataUser->save();

            return redirect('users');
        } catch (Exception $e) {
            throw $e;    
        }
          

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = User::findOrFail($id);
        $delete->delete();

        return redirect('users');
    }
}
