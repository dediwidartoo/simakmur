<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Transaction extends Model
{
    protected $table = 'transaction';

    protected $guarded = ['id'];

    protected $dates = ['tgl_transaksi', 'created_at', 'update_at'];

    public function scopeGetCode($query)
    {
        $string = "MK";

        $lastnumber = DB::raw("coalesce(MAX(CAST(RIGHT(kode_transaksi, 5)AS INT)), 0) as code");

        $getlastdata = $query->select($lastnumber)->where("kode_transaksi","like", "%".$string."%")->first();

        $number = sprintf("%'.05d",$getlastdata->code + 1);

        return $string.$number;
    }

    public function detailRelation()
    {
        return $this->hasMany(\App\Models\DetailTransaction::class,'transaksi_id','id');
    }

    public function userRelation()
    {
        return $this->hasOne(\App\Models\User::class,'id','user_id');
    }
}
