<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FormResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'nombre' => $this->name,
            'email' => $this->email,
            'mensaje' => $this->mensaje,
            'telefono' => $this->telefono,
            'localidad' => $this->localidad,
            'ip' => $this->ip,
            'fecha' => $this->fecha,
            'movil' => $this->movil,
            'user_id' => $this->user_id,
            'creado' => date_format($this->created_at, 'Y-m-d H:m:s'),
            'actualizado' => date_format($this->updated_at, 'Y-m-d H:m:s')
        ];
        return $data;
    }
}
