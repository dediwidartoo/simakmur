<?php

namespace App\Http\Controllers\Api;

use Auth;
use Response;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UsersApiController extends Controller
{
    public function users()
    {
        $users = User::paginate(10);

        // dd($users);

        return UserResource::collection($users);
    }

    public function user($iduser)
    {
        $user = User::find($iduser);

        if( $user == null){
            return Response::json([
                'status' => [
                    'code' => 404,
                    'deskripsi' => 'Data User tidak ditemukan!'
                ]
            ]);
        }

        return (new UserResource($user))->additional([
            'status' => [
                'code' => 200,
                'deskripsi' => 'OK'
            ]
        ])->response()->setStatusCode(200);
    }

    public function login(Request $request)
    {
        if (! Auth::attempt(["email"=>$request->email, "password"=>$request->password])) {
            
            return Response::json([
                'status' => [
                    "code"          => 401,
                    "deskripsi"   => "Perintah tidak dikenal!"
                ]
                ], 401 );
        }

        $loginUser = Auth::user();

        return (new UserResource($loginUser))->additional([
            'status' => [
                "code"          => 202,
                "deskripsi"   => "OK"
            ]
        ])->response()->setStatusCode(202);
    }

    public function register(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'nama'      => 'required|min:3',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:3',
        ]);

        $userBaru = User::create([
            'nama'      => $request->nama,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'api_token' => bcrypt($request->nama),
        ]);

        return (new UserResource($userBaru))->additional([
            'status' => [
                "code"          => 201,
                "deskripsi"   => "OK"
            ]
        ])->response()->setStatusCode(201);
    }

    public function updateUser(Request $request, $iduser)
    {
        $request->validate([
            'nama'      => 'max:20',
            'username'  => 'max:100|unique:users,id,'.$iduser,
            'email'     => 'email|unique:users,id,'.$iduser,
            'password'  => 'min:6'
        ]);

        $user = User::find($iduser);

        // return $request->all();

        if ($user == null) {
            return Response::json([
                'status' => [
                    "code"          => 404,
                    "deskripsi"   => "Data tidak ditemukan!"
                ]
            ], 404 );
        }else {
            $request->merge([
                'password' => bcrypt($request->password)
            ]);
            $user->update($request->all());
        }

        return (new UserResource($user))->additional([
            'status' => [
                "code"          => 200,
                "deskripsi"   => "OK"
            ]
        ])->response()->setStatusCode(200);
    }

    public function logout($iduser)
    {
        $user = User::find($iduser);

        if( $user == null){
            return Response::json([
                'status' => [
                    'code' => 400,
                    'desription' => 'Bad Request!'
                ]
            ],400);
        }

        Auth::logout();

        return Response::json([
            'status' => [
                'code' => 200,
                'deskripsi' => 'Logout Success',
            ]
        ],200);
    }
}
