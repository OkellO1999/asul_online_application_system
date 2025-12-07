<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_programmes' => Programme::count(),
            'active_programmes' => Programme::where('is_active', true)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function programmes()
    {
        $programmes = Programme::latest()->get();
        return view('admin.programmes', compact('programmes'));
    }

    public function createProgramme()
    {
        return view('admin.programme-form');
    }

    public function storeProgramme(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:programmes,code',
            'duration' => 'required|integer|min:1|max:6',
            'requirements' => 'required|string',
            'application_fee' => 'required|numeric|min:0',
        ]);

        $validated['is_active'] = true;

        Programme::create($validated);

        return redirect()->route('admin.programmes.index')
            ->with('success', 'Programme created successfully.');
    }

    public function editProgramme(Programme $programme)
    {
        return view('admin.programme-form', compact('programme'));
    }

    public function updateProgramme(Request $request, Programme $programme)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:programmes,code,' . $programme->id,
            'duration' => 'required|integer|min:1|max:6',
            'requirements' => 'required|string',
            'application_fee' => 'required|numeric|min:0',
            'is_active' => 'sometimes|boolean',
        ]);

        $programme->update($validated);

        return redirect()->route('admin.programmes.index')
            ->with('success', 'Programme updated successfully.');
    }

    public function users()
    {
        $users = User::where('role', '!=', 'admin')->latest()->get();
        return view('admin.users', compact('users'));
    }

    public function createUser()
    {
        return view('admin.user-form');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
            'role' => 'required|in:registrar,applicant',
            'password' => 'required|string|min:8',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }
}
