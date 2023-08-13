<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view("auth.register");
    }

    public function store(Request $request)
    {
        //dd($request->get("username"));
        //dd($request);

        //Modificar el Request
        $request->request->add(["username" => Str::slug($request->username)]);

        //validacion
        $this->validate($request, [
            "name" => "required|max:30",
            "username" => "required|unique:users|min:3|max:20",
            "email" => "required|unique:users|email|max:60",
            "password" => "required|confirmed|min:6"
        ]);

        User::create([
            "name" => $request->name,
            "username" => Str::slug($request->username),
            "email" => $request->email,
            "password" => $request->password,
        ]);

        //Autenticar un usuario
        auth()->attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        //redireccionar al usuario
        return redirect()->route("posts.index");
    }
}
