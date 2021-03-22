<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\PerfilRole;
use App\Models\Role;
use App\Models\Usuario;
use Illuminate\Http\Request;

use Auth;

class PerfilController extends Controller
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

            $perfis = Perfil::all();
            $rolesPerfil = PerfilRole::where('idPerfil',$idPerfil)->pluck('status');
            $countUsers = Usuario::all()->count();

            if (file_exists($aUser)) {
                $avatar = $aUser;
            } else {
                $avatar = 'storage/img/avatars/default.jpg';
            }


            if ($rolesPerfil[0] == 1) {
                return view('page.perfil', compact('idUser', 'uNome','uNomeSimples', 'idPerfil','rolesPerfil', 'nomePerfil', 'avatar', 'perfis'));
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
        $select = 'role';
        $sizeRole = Role::all()->max('id_role');


        $perfil = new Perfil();
        $perfil->descricao = $request->descricao;
        $perfil->status = $request->status;
        $save = $perfil->save();

        if ($save) {
            foreach (range(1, $sizeRole) as $regras => $role) {

                $status = $request->input($select . $role) ? 1 : 0;

                $perfilRole = new PerfilRole();
                $perfilRole->idPerfil = $perfil->id_perfil;
                $perfilRole->idRole = $role;
                $perfilRole->status = $status;
                $perfilRole->save();
            }
        }


        if ($save) {
            setcookie("status", "Salvo", time() + 50);
            return redirect()->action('PerfilController@create');
        } else {
            setcookie("status", "Erro", time() + 50);
            return redirect()->action('PerfilController@create');
        }
    }

    public function update(Request $request)
    {
        $select = 'altRole';
        $sizeRole = Role::all()->max('id_role');


        $perfil = Perfil::find($request->idPerfil);
        $perfil->descricao = $request->descricaoAlt;
        $perfil->status = $request->statusAlt;
        $save = $perfil->save();

        if ($save) {
            for ($i = 1; $i < $sizeRole + 1; $i++) {
                $roleExist = PerfilRole::where('idPerfil', '=', $request->idPerfil)
                    ->where('idRole', '=', $i)
                    ->get();

                if (count($roleExist) > 0) {

                    $perfilAcesso = PerfilRole::where('idPerfil', '=', $request->idPerfil)
                        ->where('idRole', '=', $i)
                        ->first();
                    $status = $request->input($select . $i) ? 1 : 0;

                    $perfilAcesso->idPerfil = $request->idPerfil;
                    $perfilAcesso->idRole = $i;
                    $perfilAcesso->status = $status;
                    $perfilAcesso->save();
                }
            }
        }


        if ($save) {
            setcookie("status", "Salvo", time() + 50);
            return redirect()->action('PerfilController@create');
        } else {
            setcookie("status", "Erro", time() + 50);
            return redirect()->action('PerfilController@create');
        }
    }

    public function destroy(Request $request)
    {
        if (empty($request->iddelete)) {
            setcookie("status", "Erro", time() + 50);
            return redirect()->action('PerfilController@create');
        }

        $perfil = Perfil::find($request->iddelete);
        $delete = $perfil->delete();

        if ($delete) {
            setcookie("status", "Excluido");
            return redirect()->action('PerfilController@create');
        } else {
            setcookie("status", "Erro");
            return redirect()->action('PerfilController@create');
        }
    }
}
