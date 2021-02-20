<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailTransactionResource extends JsonResource
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
            'id' => $this->id,
            'produk_id' => $this->produk_id,
            'produk' => ucfirst($this->produk),
            'jumlah_barang' => $this->jumlah_barang,
            'harga' =>"Rp ".number_format($this->harga,0,'.','.'),
            'total' =>"Rp ".number_format($this->total,0,'.','.'),
        ];
    }
}
