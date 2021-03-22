<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Models\Perfil;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @property int $id_role
 * @property string $descricao
 *
 * @property Collection|Perfil[] $perfils
 *
 * @package App\Models\Base
 */
class Role extends Model
{
	protected $table = 'roles';
	protected $primaryKey = 'id_role';
	public $timestamps = false;

	public function perfils()
	{
		return $this->belongsToMany(Perfil::class, 'perfil_role', 'idRole', 'idPerfil')
					->withPivot('id_pr', 'status');
	}
}
