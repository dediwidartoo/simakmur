<?php

namespace App\Http\Controllers\Api;

use DB;
use Response;
use App\Models\Notification;
use App\Http\Resources\NotificationResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationApiController extends Controller
{
    public function byUser($userid)
    {
        $query = Notification::where('user_id',$userid)->get();

        if ($query->isEmpty()) {
            return Response::json([
                'status' => [
                    'code'  => 404,
                    'description'   => 'Data tidak ditemukan!',
                ]
            ], 404);
        }else {
            return NotificationResource::collection($query)->additional([
                'status' => [
                    'code'  => 200,
                    'description'   => 'Ok!',
                ]
            ])->response()->setStatusCode(200);
        }
    }
}
