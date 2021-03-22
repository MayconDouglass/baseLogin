<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\PerfilRole;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class UsuarioController extends Controller
{


    public function create(Request $request)
    {
        if (Auth::user()) {

            $idUser = Auth::user()->id_usuario;
            $uNome = Auth::user()->nome;
            $uNomeSimples = explode(' ', $uNome)[0]. ' ' . explode(' ', $uNome)[1];
            $aUser = Auth::user()->avatar;
            $idPerfil = Auth::user()->idPerfil;
            $nomePerfil = Auth::user()->rPerfil->descricao;

            $usuarios = Usuario::all();
            $perfis = Perfil::where('status', 1)->get();

            $rolesPerfil = PerfilRole::where('idPerfil',$idPerfil)->pluck('status');
            $countUsers = Usuario::all()->count();

            if (file_exists($aUser)) {
                $avatar = $aUser;
            } else {
                $avatar = 'storage/img/avatars/default.jpg';
            }


            if ($rolesPerfil[0] == 1) {
                return view('page.usuario', compact('idUser', 'uNome','uNomeSimples', 'idPerfil','rolesPerfil', 'nomePerfil', 'avatar', 'usuarios', 'perfis'));
            } else {
                setcookie("status", "NoPermission", time() + 50);
                return view('page.index', compact('idUser','uNome','uNomeSimples','idPerfil','rolesPerfil','nomePerfil','avatar','countUsers'));
            }
        } else {

            return view('login');
        }
    }

    public function store(Request $request)
    {
        $usuario = new Usuario();
        $usuario->idPerfil = $request->perfilcad;
        $usuario->nome = $request->nomecad;
        $usuario->email = $request->emailcad;
        $usuario->password = bcrypt($request->passwordcad);
        $usuario->status = $request->statuscad;
        $save = $usuario->save();

        if ($request->fotocad) {
            $file = $request->fotocad;
            $filename = $usuario->id_usuario . '.jpg';
            $info = getimagesize($file);
            $destination_path = 'storage/img/avatars/';

            if ($info['mime'] == 'image/jpeg') {
                $image = imagecreatefromjpeg($file);
            } elseif ($info['mime'] == 'image/png') {
                $image = imagecreatefrompng($file);
            }
            imagejpeg($image, $destination_path . $filename, 70);
            $userAvatar = Usuario::find($usuario->id_usuario);
            $userAvatar->avatar = $destination_path . $filename;
            $userAvatar->save();
        }


        if ($save) {
            setcookie("status", "Salvo", time() + 50);
            return redirect()->action('UsuarioController@create');
        } else {
            setcookie("status", "Erro", time() + 50);
            return redirect()->action('UsuarioController@create');
        }
    }

    public function update(Request $request)
    {
        $usuario = Usuario::find($request->idUserAlt);
        $usuario->idPerfil = $request->perfilAlt;
        $usuario->nome = $request->nomeAlt;
        $usuario->email = $request->emailAlt;
        $usuario->status = $request->statusAlt;
        $save = $usuario->save();

        if ($request->fotoAlt) {
            $file = $request->fotoAlt;
            $filename = $usuario->id_usuario . '.jpg';
            $info = getimagesize($file);
            $destination_path = 'storage/img/avatars/';

            if ($info['mime'] == 'image/jpeg') {
                $image = imagecreatefromjpeg($file);
            } elseif ($info['mime'] == 'image/png') {
                $image = imagecreatefrompng($file);
            }
            imagejpeg($image, $destination_path . $filename, 70);

            $userAvatar = Usuario::find($usuario->id_usuario);
            $userAvatar->avatar = $destination_path . $filename;
            $userAvatar->save();
        }


        if ($save) {

            setcookie("status", "Salvo");
            return redirect()->action('UsuarioController@create');
        } else {
            setcookie("status", "Erro");
            return redirect()->action('UsuarioController@create');
        }
    }


    public function resetPassword(Request $request)
    {

        if (empty($request->idUser)) {
            setcookie("status", "Erro");
            return redirect()->action('UsuarioController@create');
        }

        $usuario = Usuario::find($request->idUser);
        $usuario->password = bcrypt('123');
        $save = $usuario->save();
        if ($save) {
            setcookie("status", "Resetado");
            return redirect()->action('UsuarioController@create');
        } else {
            setcookie("status", "Erro");
            return redirect()->action('UsuarioController@create');
        }
    }


    public function destroy(Request $request)
    {
        if (empty($request->iddelete)) {
            setcookie("status", "Erro", time() + 50);
            return redirect()->action('UsuarioController@create');
        }
        $usuario = Usuario::find($request->iddelete);
        $delete = $usuario->delete();
        if ($delete) {
            $arquivo = 'storage/img/avatars/' . $request->iddelete . '.jpg';
            if (file_exists($arquivo)) {
                unlink($arquivo);
            }
            setcookie("status", "Excluido");
            return redirect()->action('UsuarioController@create')->with('status_success', 'Usuário Excluída!');
        } else {
            setcookie("status", "Erro");
            return redirect()->action('UsuarioController@create')->with('status_error', 'Não foi possível excluir o usuário, possivelmente existem movimentação/cadastros!');
        }
    }
}
