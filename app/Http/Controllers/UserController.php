<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $title = 'User';
        $listUser = User::all();
        return view('pages.user.index', compact('title', 'listUser'));
    }

    public function create()
    {
        $title = 'Add User';
        return view('pages.user.create', compact('title'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8'
            ]);
            
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->save();

            return redirect('user')->with('success', 'User added successfully.');

        } catch (\Throwable $th) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to add user. ' . $th->getMessage()]);
        }
    }

    public function edit($id)
    {
        $title = 'Edit User';
        $user = User::find($id);
        return view('pages.user.edit', compact('title', 'user'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();
    
            return redirect('user')->with('success', 'User updated successfully.');
    
        } catch (\Exception $th) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update user. ' . $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect('user')->with('success', 'Data deleted successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete data!. Error : '.$th->getMessage());
        }
    }

}
