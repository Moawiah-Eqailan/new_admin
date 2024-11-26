<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->get();
        return view('Users.index', compact('users'));
    }

    public function create()
    {
        return view('Users.create');
    }
    public function store(Request $request)
    {
        User::create($request->all());

        return redirect()->route('Users')->with('success', 'Users added successfully');
    }
    /**
     * Display the user's Users form.
     */
    public function edit(Request $request): View
    {
        return view('Users.edit', [
            'users' => $request->user(),
        ]);
    }

    public function show(string $id)
    {
        $users = User::findOrFail($id);

        return view('Users.show', compact('users'));
    }

    /**
     * Update the user's Users information.
     */
    public function update(Request $request, string $id)
    {
        $users = User::findOrFail($id);

        $users->update($request->all());

        return redirect()->route('Users')->with('success', 'User updated successfully');
    }

    /**
     * Delete the user's account.
     */

    public function destroy(string $id)
    {
        $users = User::findOrFail($id);

        $users->delete();

        return redirect()->route('Users')->with('success', 'User deleted successfully');
    }


    public function ssearchh(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('name', 'LIKE', "%$query%")->get();

        return view('users.index', ['users' => $users]);
    }
}
