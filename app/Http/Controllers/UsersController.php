<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol;
use Illuminate\Http\Request;

class UsersController extends Controller
{
     public function index()
    {
        $users = User::all(); // corregido el nombre de la variable
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Rol::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'estado' => 'required|in:activo,inactivo',
            'id_rol' => 'required|exists:rols,id'
        ]);

        User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'estado' => $request->estado,
            'id_rol' => $request->id_rol,
        ]);
        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');

    }



    public function edit(User $user)
    {
        $roles = Rol::all();
        return view('users.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user){
        $request->validate([
            'full_name' => 'required|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'estado' => 'required|in:activo,inactivo',
            'id_rol' => 'required|exists:rols,id'
        ]);

        $data = $request->all();
        if($request->filled('password')){
            $data['password'] = Hash::make($request->password);
        }else{
            unset($data['password']);
        }

        $user->update($data);
        return redirect()->route('users.index')->with('success', 'ususario actualizado correctamente');
    }
}
