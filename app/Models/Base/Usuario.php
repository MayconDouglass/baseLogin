<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Perfil;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 * 
 * @property int $id_usuario
 * @property int $idPerfil
 * @property string $nome
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $avatar
 * @property int $status
 * 
 * @property Perfil $perfil
 *
 * @package App\Models\Base
 */
class Usuario extends Model
{
	protected $table = 'usuarios';
	protected $primaryKey = 'id_usuario';
	public $timestamps = false;

	protected $casts = [
		'idPerfil' => 'int',
		'status' => 'int'
	];

	public function perfil()
	{
		return $this->belongsTo(Perfil::class, 'idPerfil');
	}
}
