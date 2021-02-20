<?php

namespace App\Http\Resources;

use App\Http\Resources\ImagesProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id'        => $this->id,
            'produk'    => ucfirst($this->produk),
            'harga'     => (int) $this->harga,
            'stok'      => (int) $this->stok,
            'deskripsi' => $this->deskripsi,
            'gambar'    => $this->whenLoaded(
                'latestImage',
                asset('uploads/'.$this->latestImage->first()->gambar)
                ),
            'images'    => ImagesProductResource::collection($this->whenLoaded('imageRelation')),
        ];
    }
}
