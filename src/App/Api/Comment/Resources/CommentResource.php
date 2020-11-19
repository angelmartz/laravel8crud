<?php

namespace Crud\App\Api\Comment\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'propietario' => $this->author,
            'comentario' => $this->text,
            'fecha' => $this->created_at
        ];
    }
}
