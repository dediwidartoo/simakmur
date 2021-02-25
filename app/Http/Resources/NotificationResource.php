<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'user_id'       => $this->user_id,
            'transaksi_id'  => $this->transaksi_id,
            'kode_transaksi'=> $this->kode_transaksi,
            'deskripsi'     => $this->deskripsi,
        ];
    }
}
