<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Usuario;

class UsuarioAPI extends Controller
{

    public function index()
    {
        $usuarios = Usuario::with(['rPerfil'])->get();
        return response()->json(['code' => '200', 'response' => $usuarios], 200);
    }


    public function store(Request $request)
    {
        $usuario = new Usuario;
        $usuario->idPerfil = $request->idPerfil;
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password) ;
        $usuario->status = $request->status;
        $save = $usuario->save();

        if($request->fotocad){
            $file = $request->fotocad;
            $filename= $usuario->id_usuario.'.jpg';
            $info = getimagesize($file);
            $destination_path = 'storage/img/avatars/';

            if ($info['mime'] == 'image/jpeg') {
                $image = imagecreatefromjpeg($file);
            }elseif($info['mime'] == 'image/png'){
                $image = imagecreatefrompng($file);
            }

            imagejpeg($image, $destination_path.$filename, 70);
        }

        if ($save) {
            return response()->json(['code' => '201', 'response' => 'Registro salvo com sucesso!'], 201);
        } else {
            return response()->json(['code' => '406', 'response' => 'Erro ao salvar!'], 406);
        }
    }


    public function show($id)
    {
        $usuario = Usuario::where('id_usuario', $id)->with('rPerfil')->first();
        if (!$usuario) {
            return response()->json(['code' => '404', 'erro' => 'Nenhum usuario com esse ID.'], 404);
        } else {
            return response()->json(['code' => '200', 'response' => $usuario], 200);
        }
    }


    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        $update = $usuario->save($request->all());

        if ($update) {
            return response()->json(['code' => '200', 'response' => 'Registro atualizado com sucesso!'], 200);
        } else {
            return response()->json(['code' => '406', 'response' => 'Erro ao atualizar!'], 406);
        }
    }

    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        $delete = $usuario->delete();

        if ($delete) {
            return response()->json(['code' => '200', 'response' => 'Registro excluido com sucesso!'], 200);
        } else {
            return response()->json(['code' => '406', 'response' => 'Erro ao excluir!'], 406);
        }
    }
}
