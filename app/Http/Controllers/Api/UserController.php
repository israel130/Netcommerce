<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Listar todos los usuarios
     * @return json
    */
    public function index(){

        $users = User::all();
        return response()->json($users);

    }

    /**
     * Mostrar un usuario específico
     * @return json
    */
    public function show($id){

        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Crear un nuevo usuario
     * @return json
     * @param name string
     * @param email email
     * @param password string min 8
    */
    public function store(Request $request){

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser un texto válido.',
            
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser un texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    /**
     * Actualizar un usuario
     * @param name string
     * @param email email
     * @param password string
    */
    public function update(Request $request, $id){

        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser un texto válido.',
            
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser un texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        $user->update($request->all());
        return response()->json($user);
    }

    /**
     * Eliminar un usuario
     * @return json
     * @param id int
     */
    public function destroy($id){

        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }

    /**
     * Listar tareas por usuario
     * @return json
     * @param id int 
     */
    public function tasks($userId){

        $tasks = User::findOrFail($userId)->tasks;
        return response()->json($tasks);
        
    }
}
