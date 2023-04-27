<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $success = true;
            $message = "User login successfully";
        } else {
            $success = false;
            $message = "Unautorised";
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);
    }


    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => ['string', 'min:3', 'nullable', 'max:255'],
                'surname' => ['string', 'min:3', 'nullable', 'max:150'],
                'email' => ['required', 'string', 'email', 'min:8', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed']
            ],
            [
                'name.string' => 'Si accettano solo lettere',
                'name.min' => 'Inserire minimo 3 caratteri ',
                'name.max' => 'Inserire massimo 255 caratteri',
                'surname.string' => 'Si accettano solo lettere',
                'surname.min' => 'Inserire minimo 3 caratteri ',
                'surname.max' => 'Inserire massimo 150 caratteri',
                'date_of_birth.date' => 'Inserire una data valida',
                'email.required' => 'Email obbligatorio',
                'email.email' => 'Inserire un email valida',
                'email.unique' => 'Email gia presente',
                'email.min' => 'Inserire minimo 8 caratteri',
                'email.max' => 'Inserire massimo 255 caratteri',
                'password.required' => 'Password obbligatoria',
                'password.confirmed' => 'Password diversa'

            ]
        );
        try {
            $user = new User();
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $success = true;
            $message = "User register successfully";
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);
    }


    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = "Logout successfully";
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);
    }
}
