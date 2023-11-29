<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view_users');

        $users = User::with('role')->paginate(10);
        return view('components.backend.pages.users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $user)
    {
        $this->authorize('view_users');

        $user = User::findOrFail($user);
        return view('components.backend.pages.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $user)
    {
        $this->authorize('update_users');

        $user = User::findOrFail($user);
        return view('components.backend.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $user)
    {
        $this->authorize('update_users');

        $user = User::where('id', $user);
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role
        ]);
        
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $user)
    {
        $this->authorize('delete_users');

        $user = User::findOrFail($user);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User info sent to trash');
    }

    public function trash()
    {
        $this->authorize('delete_users');

        $users = User::onlyTrashed()->get();
        return view('components.backend.pages.users.trash', compact('users'));
    }

    public function restore($user)
    {
        $this->authorize('delete_users');

        $user = User::onlyTrashed()->find($user);
        $user->restore();
        return redirect()->route('users.trash')->with('success', 'User Info restored successfully');
    }

    public function delete($user)
    {
        $this->authorize('delete_users');
        
        $user = User::onlyTrashed()->find($user);
        $user->forceDelete();
        return redirect()->route('users.trash')->with('success', 'User Info deleted successfully');
    }
}
