<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DetailTransactionResource;

class TransactionResource extends JsonResource
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
            'kode_transaksi'    => $this->kode_transaksi,
            'user'              => ucfirst($this->userRelation->nama),
            'tujuan'            => $this->tujuan ?: null,
            'tgl_transaksi'     => $this->tgl_transaksi->format('d-M-Y'),
            'total_akhir'       =>"Rp. ".number_format($this->total_akhir,0,'.','.'),
            'status_transaksi'  =>$this->status_transaksi,
            'detail_transaksi'  => DetailTransactionResource::collection($this->whenLoaded('detailRelation')),
        ];
    }
}
