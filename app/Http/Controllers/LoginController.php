<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\PerfilRole;
use App\Models\Usuario;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use App\User;

use Auth;
use Hash;

class LoginController extends Controller
{
    public function form()
    {
        if (Auth::user()) {

            $idUser = Auth::user()->id_usuario;
            $uNome = Auth::user()->nome;
            $uNomeSimples = explode(' ', $uNome)[0]. ' ' . explode(' ', $uNome)[1];
            $idPerfil = Auth::user()->idPerfil;
            $nomePerfil = Auth::user()->rPerfil->descricao;

            $countUsers = Usuario::all()->count();
            $rolesPerfil = PerfilRole::where('idPerfil',$idPerfil)->pluck('status');

            $arquivo = 'storage/img/avatars/' . $idUser . '.jpg';
            if (file_exists($arquivo)) {
                $avatar = $arquivo;
            } else {
                $avatar = 'storage/img/avatars/default.jpg';
            }

                return view('page.index', compact('idUser','uNome','uNomeSimples','idPerfil','rolesPerfil','nomePerfil','avatar','countUsers'));

        } else {

            return view('login');
        }
    }

    public function Login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'senha' => 'required'
        ]);


        $lembrar = empty($request->remember) ? false : true;

        $usuario = User::where('email', $request->email)
            ->where('status', 1)
            ->with('rPerfil')
            ->first();

        $statusUser = User::where('email', $request->email)
            ->select('status')
            ->first();


        if (!$usuario) {
            return redirect()->action('LoginController@form')->with('status_error', 'Email inválido.');
        }

        if ($usuario->rPerfil->status == 0) {
            return redirect()->action('LoginController@form')->with('status_error', 'Perfil do usuário Inativo!');
        }

        if ($usuario && Hash::check($request->senha, $usuario->password)) {

            Auth::loginUsingId($usuario->id_usuario, $lembrar);
        }

        if (!$usuario->status) {
            return redirect()->action('LoginController@form')->with('status_error', 'Usuário Inativo!');
        } else {
            return redirect()->action('LoginController@form')->with('status_error', 'Por favor, verifique os dados!');
        }
    }
}
