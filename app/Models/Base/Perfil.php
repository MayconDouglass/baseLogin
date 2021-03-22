<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Role;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Perfil
 * 
 * @property int $id_perfil
 * @property string $descricao
 * @property int $status
 * 
 * @property Collection|Role[] $roles
 * @property Collection|Usuario[] $usuarios
 *
 * @package App\Models\Base
 */
class Perfil extends Model
{
	protected $table = 'perfil';
	protected $primaryKey = 'id_perfil';
	public $timestamps = false;

	protected $casts = [
		'status' => 'int'
	];

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'perfil_role', 'idPerfil', 'idRole')
					->withPivot('id_pr', 'status');
	}

	public function usuarios()
	{
		return $this->hasMany(Usuario::class, 'idPerfil');
	}
}
