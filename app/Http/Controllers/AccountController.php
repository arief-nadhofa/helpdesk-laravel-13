<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $account = Account::all();
        return view('pages.account.show', compact('account'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.account.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_number = $request->id_number;
        $name = $request->name;
        $ldap = $request->ldap;
        $role = $request->role;
        $username = $request->username;
        $password = $request->password;

        Account::create([
            'id_number' => $id_number,
            'name' => $name,
            'ldap' => $ldap,
            'role' => $role,
            'username' => $username,
            'password' => $password,
            'created_at' => Carbon::now('Asia/Jakarta'),
        ]);

        return redirect()->route('account.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

        return redirect()->route('account.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
