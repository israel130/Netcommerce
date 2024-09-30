<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ModelTask;
use App\Models\ModelCompanies;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * @return json
    */
    public function index(){
        
        $tasks = ModelTask::with('companyBelong', 'userBelong')->get();
        return response()->json($tasks);
        
    }

    /** 
     * Mostrar una tarea específica
     * @return json
    */
    public function show($id){

        $task = ModelTask::with('companyBelong', 'userBelong')->findOrFail($id);
        return response()->json($task);

    }

    /** 
     * @return json
     * Crear una nueva tarea
    */
    public function store(Request $request){

        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'company_id' => 'required|exists:companies,id',
            'user_id' => 'required|exists:users,id',
            'is_completed' => 'boolean',
            'start_at' => 'required|date',
            'expired_at' => 'required|date',
        ],[
            'name.required' => 'El nombre es obligatorio.',
            'description.string' => 'La descripción debe ser un texto.',
            'company_id.required' => 'El ID de la empresa es obligatorio.',
            'company_id.exists' => 'La empresa especificada no existe.',
            'user_id.required' => 'El ID del usuario es obligatorio.',
            'user_id.exists' => 'El usuario especificado no existe.',
            'is_completed.boolean' => 'El estado de finalización debe ser verdadero o falso.',
            'start_at.required' => 'La fecha de inicio es obligatoria.',
            'start_at.date' => 'La fecha de inicio no es una fecha válida.',
            'expired_at.required' => 'La fecha de expiración es obligatoria.',
            'expired_at.date' => 'La fecha de expiración no es una fecha válida.',
        ]);

        $task = ModelTask::create($request->all());
        return response()->json($task, 201);
    }

    /**
     *  @return json
     *  Actualizar una tarea
    */
    public function update(Request $request, $id){
        
        $task = ModelTask::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'company_id' => 'required|exists:companies,id',
            'user_id' => 'required|exists:users,id',
            'is_completed' => 'boolean',
            'start_at' => 'required|date',
            'expired_at' => 'required|date',
        ],[
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser un texto válido.',
            
            'description.string' => 'La descripción debe ser un texto válido.',
            
            'company_id.required' => 'El ID de la empresa es obligatorio.',
            'company_id.exists' => 'La empresa especificada no existe.',
            
            'user_id.required' => 'El ID del usuario es obligatorio.',
            'user_id.exists' => 'El usuario especificado no existe.',
            
            'is_completed.boolean' => 'El estado de finalización debe ser verdadero o falso.',
            
            'start_at.required' => 'La fecha de inicio es obligatoria.',
            'start_at.date' => 'La fecha de inicio debe ser una fecha válida.',
            
            'expired_at.required' => 'La fecha de expiración es obligatoria.',
            'expired_at.date' => 'La fecha de expiración debe ser una fecha válida.',
        ]);

        $task->update($request->all());
        return response()->json($task);
    }

    /**
     * @return json
     * Eliminar una tarea
    */
    public function destroy(Request $request, $id)
    {

        /* $task = ModelTask::first($id);
        $task->delete();
        return response()->json('Eliminado', 204); */

        $task = ModelTask::find($id);
        if (is_null($task)) {
            return response()->json('Data not found', 404);
        }
        $task->delete();
        return response()->json(['Task deleted successfully.']);
        
    }
}
