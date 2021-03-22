<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Models\Perfil;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PerfilRole
 *
 * @property int $id_pr
 * @property int $idPerfil
 * @property int $idRole
 * @property int $status
 *
 * @property Perfil $perfil
 * @property Role $role
 *
 * @package App\Models\Base
 */
class PerfilRole extends Model
{
	protected $table = 'perfil_role';
	protected $primaryKey = 'id_pr';
	public $timestamps = false;

	protected $casts = [
		'idPerfil' => 'int',
		'idRole' => 'int',
		'status' => 'int'
	];

	public function perfil()
	{
		return $this->belongsTo(Perfil::class, 'idPerfil');
	}

	public function role()
	{
		return $this->belongsTo(Role::class, 'idRole');
	}
}
