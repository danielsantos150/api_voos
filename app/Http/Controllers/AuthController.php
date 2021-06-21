<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Helper;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use ApiResponser;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sUser' => 'required|string|unique:users|min:2|max:35',
            'sPassword' => 'required|string|min:8|max:256'
        ]);
        if ($validator->fails()) {
            return $this->error(
                'Requisição Inválida.', Response::HTTP_BAD_REQUEST, $validator->errors()
            );
        }
        $user = new User();
        $response = $user->registerAccess($request->input());
        return $this->success([
            'token' => $response, 'token_type' => 'Bearer',
        ], 'Usuário registrado com sucesso.');
    }
}
