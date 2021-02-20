<?php

namespace App\Http\Controllers\Api;

use DB;
use Auth;
use Response;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users()
    {
        $users = User::orderBy('nama')->paginate(10);

        // dd($users);

        return UserResource::collection($users);
    }

    public function user($id)
    {
        $user = User::findOrFail($id);

        
    }

    public function login(Request $request)
    {
        if (! Auth::attempt(["email"=>$request->email, "password"=>$request->password])) {
            
            return Response::json([
                'status' => [
                    "code"          => 401,
                    "description"   => "Perintah tidak dikenal!"
                ]
                ], 401 );
        }

        $loggedUser = User::find(Auth::user()->id);

        return (new UserResource($loggedUser))
        ->additional([
            'status' => [
                "code"          => 202,
                "description"   => "OK"
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
            'api_token' => bcrypt($request->email),
        ]);

        return (new UserResource($userBaru))
        ->additional([
            'status' => [
                "code"          => 201,
                "description"   => "OK"
            ]
        ])->response()->setStatusCode(201);
    }

    public function updateUser(Request $request, $iduser)
    {
        $request->validate([
            'nama'      => 'max:20',
            'username'  => 'unique:users,id,'.$iduser,
            'email'     => 'email|unique:users,id,'.$iduser,
            'password'  => 'min:6'
        ]);

        $user = User::where('id',$iduser)->firstOrFail();

        // return $request->all();

        if ($user == null) {
            return Response::json([
                'status' => [
                    "code"          => 404,
                    "description"   => "Data tidak ditemukan!"
                ]
            ], 404 );
        }else {
            if ($request->password != null) {
                $request->merge([
                    'password' => bcrypt($request->password)
                ]);
            }
        }

        $user->update($request->all());

        return (new UserResource($user))
        ->additional([
            'status' => [
                "code"          => 200,
                "description"   => "OK"
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
                'description' => 'Logout Success',
            ]
        ],200);
    }
}
