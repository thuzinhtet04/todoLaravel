<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $attr =    $request->validate([
            "name" => ["required", "min:3", "max:50"],
            "email" => ["required", "email"],
            "password" => ["required", "min:8"],

        ]);
        $user = User::create($attr);
        if ($request->image) {
            $request->validate([
                "image" => ["max:2048", "mimes:jpg,png,jpeg,svg"]
            ]);
        }
        if ($user && $request->image) {

            $path = $request->file("image")->storeAs("profile", time() . $request->image->getClientOriginalName());
            $user->image = Storage::url($path);
            $user->save();
        } elseif (!$user) {
            return response()->json([
                "message" => "Failed to create user"
            ], 500);
        }

        // $checked = Hash::check($attr["password"], $user->password);

        $token = $user->createToken("token",  ['*'], now()->addWeek())->plainTextToken;
        return response()->json([
            "message" => "Create Account Successfully",
            // "token" => $token,
            "data" => [
                "user" => $user,
            ],
            "token" => $token
        ], 201);
    }
    public function login(Request $request)
    {
        $attr =    $request->validate([
            "email" => ["required", "email", "exists:User,email"],
            "password" => ["required", "min:8"]
        ]);

        $user = User::where("email", $request->email)->first();
        if (!$user) {
            return response()->json([
                "message" => "User not found!"
            ], 404);
        }

        $checked = Hash::check($attr["password"], $user->password);
        if (!$checked) {
            return response()->json([
                "message" => "Password is incorrect!"
            ], 401);
        }
        $token = $user->createToken("token")->plainTextToken;
        return response()->json([
            "message" => "Login Success",
            "token" => $token
        ]);
    }
}
