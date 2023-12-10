<?php

namespace App\Http\Controllers;

use App\Http\Resources\FormResource;
use App\Models\Formulario;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;


class FormController extends Controller
{
    use ApiResponder;

    public function store(Request $request)
    {
        try {
            $rules = [
                'nombre' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'mensaje' => 'required|string|max:255',
                'telefono' => 'required|string|max:255',
                'localidad' => 'required|string|max:255',
            ];

            $validator = Validator::make( $request->all(), $rules, $messages = [
                'required' => 'El campo :attribute es requerido.',
                'numeric' => 'El campo :attribute debe ser númerico.',
                'string' => 'El campo :attribute debe ser tipo texto.',
                'max' => 'El campo :attribute excede el tamaño requerido((:max).',
                'date_format' => 'El campo :attribute debe tener formato fecha (Y-m-d) ó formato fecha hora (YYYY-MM-DD HH:mm:ss)',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return $this->error("Error al crear el registro", $errors);
            }

            $agent = new Agent;
            $result = $agent->isMobile();

            $form = new Formulario([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'mensaje' => $request->mensaje,
                'telefono' => $request->telefono,
                'localidad' => $request->localidad,
                'ip'=> $request->ip(),
                'fecha'=> now()->format('Y-m-d'),
                'movil' => $result ? 1 : 0,
                'user_id' => null,
            ]);
            $form->save();

            $resource = new FormResource($form);

            return $this->success('Formulario registrado correctamente', [
                'form' => $resource
            ]);

        } catch (\Throwable $th) {
            return $this->error("Error al registrar el test, error:{$th->getMessage()}.");
        }
    }
}
