<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\PerfilRole;

class PerfilAPI extends Controller
{

    public function index()
    {
        $perfis = Perfil::with(['roles'])->get();
        return response()->json(['code' => '200', 'response' => $perfis], 200);
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $perfil = Perfil::where('id_perfil', $id)->with('roles')->first();
        $permissoes = PerfilRole::where('idPerfil', $id)->pluck('status');
        if (!$perfil) {
            return response()->json(['code' => '404', 'erro' => 'Nenhum perfil com esse ID.'], 404);
        } else {
            return response()->json(['code' => '200', 'response' => $perfil,'permissoes'=>$permissoes], 200);
        }
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
