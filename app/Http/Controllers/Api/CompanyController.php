<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelCompanies;

class CompanyController extends Controller
{
    
    /**
     * Listar todas las empresas
     * @return json 
    */
    public function index()  {
        $companies = ModelCompanies::all();
        return response()->json($companies);
    }

    /**
     * Mostrar una empresa específica
     * @return json
     * @param id
     */
    public function show($id)  {
        $company = ModelCompanies::findOrFail($id);
        return response()->json($company);
    }

    /**
     * Crear una nueva empresa
     * @return json
    */
    public function store(Request $request)  {

        $request->validate([
            'name' => 'required|string',
        ], [
            'name.required' => 'El nombre es obligatorio.', // Mensaje personalizado para 'required'
            'name.string' => 'El nombre debe ser un texto válido.' // Mensaje personalizado para 'string'
        ]);

        $company = ModelCompanies::create($request->all());
        return response()->json($company, 201);
    }

    /**
     * Actualizar una empresa
     * @return json
     * @param name string
     * @param id  int 
     */
    public function update(Request $request, $id){
        $company = ModelCompanies::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
        ], [
            'name.required' => 'El nombre es obligatorio.', // Mensaje personalizado si 'name' está vacío
            'name.string' => 'El nombre debe ser un texto válido.' // Mensaje personalizado si 'name' no es un string
        ]);

        $company->update($request->all());
        return response()->json($company);
    }

    /**
     * Eliminar una empresa
     * @return json
     * @param id
     */
    public function destroy($id){
        
        $company = ModelCompanies::findOrFail($id);
        $company->delete();

        return response()->json(null, 204);
    }

    /**
     * Listar tareas por empresa
     * @return json
     * @param id int
    */
    public function tasks($companyId)
    {
        $tasks = ModelCompanies::findOrFail($companyId)->taksMuch;
        return response()->json($tasks);
    }
}
