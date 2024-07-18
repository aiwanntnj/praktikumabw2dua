<?php
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users',
        'level' => 'required',
        'password' => 'required|min:8',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'level' => $request->level,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('users.index')->with('success', 'User created successfully.');
}

public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'level' => 'required',
        'password' => 'nullable|min:8',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'level' => $request->level,
        'password' => $request->password ? Hash::make($request->password) : $user->password,
    ]);

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}
