<?php

namespace App\Http\Controllers;

use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $superadmin = User::where('id', '=', '1');
        $user = User::latest()->get()->except(1);
        return view('admin.user.index', compact('user'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);
        Alert::success('Success', 'User berhasil ditambahkan!');
        return redirect()->back();
    }

    public function show($id)
    {
        $id1 = decrypt($id);
        $user = User::where('id', $id1)->first();
        return view('admin.user.index', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrfail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();
        Alert::info('Info', 'User berhasil diedit!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        Alert::warning('Warning', 'User berhasil dihapus!');
        return redirect()->back();
    }
}
