<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Titulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class tituloController extends Controller
{
    public function index ()
    { 
            $titulo = Titulo::all();
    

            
    
            $data = [
                'titulo' => $titulo,
                'status' => 200
            ];
    
            return response()->json($data, 200);
    }

        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'titulo' => 'required', 
                'autor' => 'required',
                'fecha_hora' => 'required',
                'cuerpo_nota' => 'required',
                'clasificacion' => 'required'

            ]);

            if ($validator->fails()) {
                $data = [
                    'message' => 'Error en la validacion de los datos', 
                    'errors'=> $validator->errors(), 
                    'status'=> 400
                ];
                return response()->json($data, 400);
            }

            $titulo = Titulo::create([
                'titulo' => $request->titulo,
                'autor' => $request->autor,
                'fecha_hora'=> $request->fecha_hora,
                'cuerpo_nota' => $request->cuerpo_nota,
                'clasificacion' => $request->clasificacion,
            
            ]);

            if (!$titulo) {
                $data = [
                    'message' => 'Error al crear el titulo', 
                    'status'=> 500
                ];
                return response()->json($data, 500);
            }

            $data = [
                'serie' => $titulo,
                'status'=> 201
            ];
    
            return response()->json($data, 201);

        }

    public function show($id)
    {

            $titulo = Titulo::find($id);

        if (!$titulo) {
            $data = [
            'message' => 'Estudiante no encontrado',
            'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'titulo' => $titulo,
            'status'=> 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $titulo = Titulo::find($id);
        
        if (!$titulo) {
            $data = [
                'message' => 'Titulo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $titulo->delete();

        $data = [
            'message' > 'Titulo eliminado',
            'status'=> 200
        ];
        
        return response()->json($data, 200);
    }

    public function update (Request $request, $id)
    {
        $titulo = Titulo::find($id);
        if (!$titulo) {
            $data = [
                'message' => 'Titulo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'titulo' => 'required', 
            'autor' => 'required',
            'fecha_hora' => 'required',
            'cuerpo_nota' => 'required',
            'clasificacion' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos', 
                'errors'=> $validator->errors(), 
                'status'=> 400
            ];
            return response()->json($data, 400);
        }

        $titulo->titulo = $request->titulo;
        $titulo->autor = $request->autor;
        $titulo->fecha_hora = $request->fecha_hora;
        $titulo->cuerpo_nota = $request->cuerpo_nota;
        $titulo->clasificacion = $request->clasificacion;

        $titulo->save();

        $data = [
            'message'=> 'Titulo actualizado',
            'titulo'=> $titulo,
            'status'=> 200
        ];

        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $titulo = Titulo::find($id);

        if (!$titulo) {
            $data = [
                'message' => 'Titulo no encontrado',
                'status'=> 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'titulo' => '', 
            'autor' => '',
            'fecha_hora' => '',
            'cuerpo_nota' => '',
            'clasificacion' => ''
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos', 
                'errors'=> $validator->errors(), 
                'status'=> 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('titulo')) {
            $titulo->titulo = $request->titulo;
        }
        
        if ($request->has('autor')) {
            $titulo->autor = $request->autor;
        }
            
        if ($request->has('fecha_hora')) {
            $titulo->fecha_hora = $request->fecha_hora;
        }

        if ($request->has('cuerpo_nota')) {
            $titulo->cuerpo_nota = $request->cuerpo_nota;
        }

        if ($request->has('clasificacion')) {
            $titulo->clasificacion = $request->clasificacion;
        }

        $titulo->save();

        $data = [

            'message' => 'Titulo actualizado',
            'serie'=> $titulo,
            'status'=> 200
        ];

        return response()->json($data, 200);
    }
}